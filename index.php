<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LumiFrame | Photography & Cinematography</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMdQ1mF1DA93k1Qa5QYxwZ4nqEqN9zYSHf7kE" crossorigin="anonymous">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: #000;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
            position: relative;
        }

        /* Fullscreen Background Video/Image */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('your-image.jpg') center/cover no-repeat; /* Replace with your image */
            z-index: -1;
            opacity: 0.5; /* Semi-transparent */
            filter: grayscale(30%); /* Desaturated look for background */
        }

        /* Overlay with gradient */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.8), rgba(255, 255, 255, 0.1));
        }

        /* Main content container */
        .container {
            text-align: center;
            padding: 60px;
            z-index: 1;
            animation: fadeIn 1.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: clamp(40px, 10vw, 64px); /* Responsive font size */
            background: linear-gradient(45deg, #2a916f, #2a916f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 5px;
            text-transform: uppercase;
            animation: glow 3s infinite alternate;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: text-shadow 0.3s ease;
        }

        h1:hover {
            text-shadow: 0 0 20px #2a916f, 0 0 30px #2a916f; /* Glow effect on hover */
        }

        .icon {
            font-size: clamp(50px, 12vw, 80px); /* Responsive icon size */
            margin-bottom: 20px; /* Space between icon and title */
            color: #2a916f; /* Icon color */
            animation: bounce 2s infinite; /* Bounce animation */
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        p {
            font-size: clamp(16px, 3vw, 20px); /* Responsive paragraph size */
            margin: 0px 100 0px;
            max-width: 700px;
            text-align: center;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
            position: relative;
            opacity: 0; /* Start hidden */
            transform: translateY(20px); /* Start from below */
            animation: fadeInUp 1s ease forwards 0.5s; /* Added delay for animation */
        }

        @keyframes fadeInUp {
            to {
                opacity: 1; /* Fade in */
                transform: translateY(0); /* Move to original position */
            }
        }

        /* Additional Content Styles */
        .additional-content {
            margin-top: 40px; /* Space between sections */
            max-width: 800px;
            text-align: left;
            color: rgba(255, 255, 255, 0.85);
            opacity: 0; /* Start hidden */
            transform: translateY(20px); /* Start from below */
            animation: fadeInUp 1s ease forwards 0.8s; /* Added delay for animation */
        }

        /* Services List Styles */
        ul {
            list-style: none; /* Remove default list styling */
            padding: 0; /* Remove padding */
            margin-top: 20px; /* Add space above */
            display: grid; /* Use grid for layout */
            gap: 15px; /* Space between grid items */
        }

        li {
            position: relative;
            padding-left: 30px; /* Space for icon */
            font-size: clamp(16px, 2vw, 18px); /* Responsive list item size */
            transition: color 0.3s ease; /* Smooth color transition */
            cursor: pointer; /* Change cursor to pointer */
        }

        li::before {
            content: "✔️"; /* Checkmark icon */
            position: absolute;
            left: 0; /* Position it to the left */
            color: #2a916f; /* Checkmark color */
        }

        li:hover {
            color: #2a916f; /* Change color on hover */
            transform: scale(1.05); /* Scale effect on hover */
            transition: transform 0.3s ease; /* Smooth scale transition */
        }

        /* Explore Us Button */
        .explore-btn {
            padding: 15px 45px;
            font-size: 22px;
            color: #fff;
            background: #2a916f; /* Button background */
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.4s ease;
            margin-top: 20px; /* Add space above the button */
            font-weight: bold; /* Bold text for button */
        }

        .explore-btn:hover {
            background: #2a916f; /* Maintain the same color on hover */
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(42, 145, 111, 0.5); /* Adjusted shadow color */
            animation: pulse 0.6s infinite; /* Pulsing effect */
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .explore-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            z-index: -1;
        }

        .explore-btn:hover::before {
            width: 150%;
            height: 150%;
            opacity: 0;
        }

        /* Floating Circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            animation: floatCircle 18s infinite ease-in-out;
            pointer-events: none;
        }

        .circle.small {
            width: 50px;
            height: 50px;
            top: 10%;
            left: 25%;
        }

        .circle.large {
            width: 100px;
            height: 100px;
            bottom: 15%;
            right: 30%;
        }

        @keyframes floatCircle {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-80px);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: clamp(30px, 8vw, 50px); /* Responsive font size for smaller screens */
            }
            p {
                font-size: clamp(14px, 2.5vw, 18px); /* Responsive paragraph size */
            }
            .explore-btn {
                font-size: 18px; /* Smaller button font size */
                padding: 10px 30px; /* Adjust button padding */
            }
        }
    </style>
</head>
<body>
    <div class="background"></div> <!-- Optional background image -->
    <div class="overlay"></div> <!-- Optional overlay for better text visibility -->
    
    <div class="container">
        <div class="icon"><i class="fas fa-camera-retro"></i></div>
        <!-- Replace the title with an image -->
        <img src="assests\logo.png" alt="LumiFrame Logo" style="max-width: 50%; height: 50%;"> <!-- Update with your image path -->
        <p>Where memories are captured and stories are told through the art of photography and cinematography. Join us in exploring the world through our lens.</p>
        
        <!-- Additional Content -->
        <div class="additional-content">
            <h2>Our Services</h2>
            <ul>
                <li>Photography and Cinematography for Events</li>
                <li>Basic Tutorials for Free</li>
                <li>Showcase for Your Creations</li>
                <li>Buy Accessories</li>
                <li>Paid Courses</li>
            </ul>
        </div>
        <a href="registration.php">
            <button class="explore-btn">Explore Us</button>
        </a>
        <!-- Floating Circles -->
        <div class="circle small"></div>
        <div class="circle large"></div>
    </div>
</body>
</html>
