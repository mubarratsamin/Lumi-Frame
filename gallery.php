<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'lf');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle photo upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploaderName = $conn->real_escape_string($_POST['uploader_name']);
    $caption = $conn->real_escape_string($_POST['caption']);
    $uploadOk = 1;

    // Validate image file
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (max 5MB)
    if ($_FILES["photo"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allowed file types
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Only JPG, JPEG, PNG, & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Upload if no errors
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Save to database
            $sql = "INSERT INTO gallery_images (image_path, uploader_name, caption) VALUES ('$targetFile', '$uploaderName', '$caption')";
            if ($conn->query($sql) === TRUE) {
                echo "Upload successful!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error uploading your file.";
        }
    }
}

// Fetch images
$sql = "SELECT image_path, uploader_name, caption, uploaded_at FROM gallery_images ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(to right, #174f3c, #000000);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            text-align: center;
        }

        h1, h2 {
            color: #fff;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 10px;
            margin: auto;
            max-width: 1200px;
        }

        .photo-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            height: 400px;
            backdrop-filter: blur(10px);
        }

        .photo-container img {
            width: 100%;
            height: 70%;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .photo-info {
            color: #ddd;
            flex-grow: 1;
        }

        .caption {
            font-style: italic;
            color: #fff;
            margin-top: 5px;
        }

        .upload-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 500px;
            margin: 30px 0;
        }

        .upload-form input[type="file"], 
        .upload-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .upload-form button {
            background-color: #003565;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .upload-form button:hover {
            background-color: #0062bc;
        }

        @media (max-width: 768px) {
            .photo-container {
                height: auto;
            }
        }
        .logo {
            position: absolute; /* Position the logo */
            top: 10px; /* Distance from the top */
            right: 30px; /* Distance from the right */
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
    </style>
</head>
<body>
<a href="welcome.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>
    <h1>Gallery</h1>

    <div class="gallery">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="photo-container">
                    <img src="<?php echo htmlspecialchars($row["image_path"]); ?>" alt="Photo">
                    <div class="photo-info">
                        Uploaded by: <?php echo htmlspecialchars($row["uploader_name"]); ?><br>
                        Date: <?php echo date("F j, Y, g:i a", strtotime($row["uploaded_at"])); ?>
                        <div class="caption"><?php echo htmlspecialchars($row["caption"]); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>

    <!-- Upload Photo Form -->
    <div class="upload-form">
        <h2>Upload Your Photo</h2>
        <form action="gallery.php" method="post" enctype="multipart/form-data">
            <input type="file" name="photo" accept="image/*" required><br>
            <input type="text" name="uploader_name" placeholder="Your Name" required><br>
            <input type="text" name="caption" placeholder="Add a caption" required><br>
            <button type="submit">Upload Photo</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
