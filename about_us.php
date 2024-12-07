<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LumiFrame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, rgba(42, 145, 111, 0.9), rgba(0, 118, 147, 0.9));
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            position: relative; /* Set positioning context for the logo */
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
            animation: slideIn 1s ease forwards;
            opacity: 0; /* Start hidden for animation */
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

        .content {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            margin-top: 20px;
            position: relative; /* Position for inner animations */
            overflow: hidden; /* Prevent overflow of animations */
        }

        .content p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #000000;
            opacity: 0; /* Start hidden for animation */
            transform: translateY(20px); /* Start slightly below */
            animation: fadeInUp 0.5s ease forwards; /* Slide up effect */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Button Styles */
        .explore-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(45deg, #174f3c, #007694);
            color: white;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: color 0.3s;
            text-decoration: none; /* Remove underline for links */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .explore-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.4s;
            z-index: 0;
        }

        .explore-button:hover::after {
            transform: translate(-50%, -50%) scale(1);
        }

        .explore-button:hover {
            color: #fff; /* Change text color on hover */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .content p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <a href="welcome.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>

    <h1>About Us</h1>
    
    <div class="content">
        <p>Welcome to LumiFrame, where we believe every moment tells a story. Founded by passionate photographers and videographers, LumiFrame is dedicated to capturing the beauty and emotion of life’s most precious events while empowering others to explore their creative potential.</p>
        
        <p>In addition to providing high-quality, professional photography and videography services, we offer comprehensive tutorials for beginners. Our goal is to help aspiring photographers and videographers develop their skills, gain confidence, and unlock their artistic vision. Whether you’re just starting or looking to refine your techniques, our easy-to-follow guides and workshops are designed to inspire and educate.</p>
        
        <p>At LumiFrame, we also understand the importance of having the right tools for your creative journey. That’s why we offer a curated selection of accessories that cater to both beginners and seasoned professionals. From camera gear to lighting equipment, we have everything you need to elevate your craft and enhance your creative experience.</p>
        
        <p>We take pride in our commitment to excellence and our ability to connect with our clients, making the entire process enjoyable and stress-free. With a keen eye for detail and a passion for storytelling, we transform moments into stunning visual narratives.</p>
        
        <p>Join us at LumiFrame, where you can capture your life's milestones, learn from the best, and find the perfect accessories to fuel your creativity. Together, we’ll create lasting memories and inspire the next generation of visual storytellers.</p>
        
        <a href="gallery.php" class="explore-button">Explore Our Gallery</a>
    </div>

    <script>
        // Reveal elements after page load
        window.onload = function() {
            document.querySelector('h1').style.opacity = 1; // Fade in for h1
            document.querySelectorAll('.content p').forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = 1; // Fade in for paragraphs
                }, index * 300); // Staggered effect
            });
        };
    </script>

</body>
</html>
