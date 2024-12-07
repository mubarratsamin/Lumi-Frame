<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - LumiFrame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, rgba(42, 145, 111, 0.8), rgba(0, 118, 147, 0.8)), url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1s ease forwards;
            opacity: 0;
        }

        h1 {
            margin-bottom: 20px;
            font-size: clamp(30px, 6vw, 40px);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        p {
            margin-bottom: 50px;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.85);
        }
        q {
            margin-bottom: 30px;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.85);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            margin-bottom: 10px;
            transition: box-shadow 0.3s;
        }

        input:focus, textarea:focus {
            box-shadow: 0 0 5px rgba(42, 145, 111, 0.8);
        }

        button {
            background: linear-gradient(45deg, #174f3c, #007694);
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: bold;
        }

        button:hover {
            background: linear-gradient(45deg, #007694, #174f3c);
            transform: scale(1.05);
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo button */
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

    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us!</p>

        <div class="contact-details" style="margin-top: 20px;">
            <q><strong>Phone:</strong> 01321868891</q><br>
            <q><strong>Facebook:</strong> <a href="https://www.facebook.com/LumiFrame" target="_blank" style="color: #fff;">LumiFrame</a></q><br>
            <q><strong>WhatsApp:</strong> 01321868891</q>
        </div>
    </div>

</body>
</html>
