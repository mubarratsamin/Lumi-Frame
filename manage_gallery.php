<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'lf');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle photo deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    
    // Get the image path before deleting
    $sql = "SELECT image_path FROM gallery_images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $imagePath = $row['image_path'];

    // Delete the image from the database
    $sql = "DELETE FROM gallery_images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $deleteId);
    if ($stmt->execute()) {
        // Delete the image file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        echo "Image deleted successfully.";
    } else {
        echo "Error deleting image.";
    }
    $stmt->close();
}

// Fetch images
$sql = "SELECT id, image_path, uploader_name, caption, uploaded_at FROM gallery_images ORDER BY uploaded_at DESC";
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

        .delete-button {
            background-color: #d32f2f;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .delete-button:hover {
            background-color: #f44336;
        }

        .logo {
            position: absolute;
            top: 10px;
            right: 30px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<a href="admin.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>
    <h1>Manage Gallery</h1>
    <br>
    <br>
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
                    <!-- Delete button -->
                    <a href="?delete_id=<?php echo $row["id"]; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>

    <!-- Remove upload form -->
</body>
</html>

<?php $conn->close(); ?>
