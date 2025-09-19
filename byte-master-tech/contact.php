<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page title -->
    <title>Contact Us - Byte Masters</title>

    <!-- css link -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/font.css">

    <!-- javascript link -->
    <script src="./assets/js/W3.mjs"></script>
    
    <style>
    

        /* move class animation */
        .move_in{
            opacity: 0;
            transform: translateY(80px);
            transition: opacity 0.6s ease-out, transform 0.8s ease-out;
        }
        .move_in.visible{
            opacity: 1;
            transform: translateY(0);
        }

        .head-text{
            position: relative;
            text-align: center;
            margin-top: 2rem;
            color: var(--text-clr);
            font-size: var(--large-font-size);
            padding: 0 1rem;
            z-index: 3;
            font-family: Heading;
        }
        .service-card-head-text::after{
            z-index: -1;
            content: "Our Best Services";
            position: absolute;
            color: var(--hover-clr);
            opacity: 0.6;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 55px;
            transform: translateY(-40px);
        }
        @media (max-width: 820px) {
            .service-card-head-text::after{
                font-size: 40px;
            }
            
        }
        @media (max-width: 560px) {
            .service-card-head-text::after{
                font-size: 37px;
            }
        }

        .card-wrapper {
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            padding: 4rem 1rem;
            margin: 0 auto;
        }

        .card {
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--line-clr);
            box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);
            transition: all 0.4s ease;
            padding: 2rem;


        }

        .card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 2.4px;
            background: var(--accent-clr);
            opacity: 0;
            scale: 0;
            transition: scale 0.6s ease;
            z-index: 1;
        }

        .card:hover::before {
            opacity: 1;
            scale: 1;
        }

        .card > * {
            position: relative;
            z-index: 1;
        }



        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--accent-clr);

        }

        .icon {
            width: 50px;
            height: 50px;
            margin-bottom: 1.5rem;
            color: var(--accent-clr);
            background-color: var(--hover-clr);
            border-radius: 50%;
            display: grid;
            place-content: center;
        }

        .icon i {
            width: 100%;
            font-size: 1.4rem;
            height: 100%;
        }

        /* card wrapper 2 */
        .card-wrapper2{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            padding: 4rem 2rem;
            margin: 0 auto;
            overflow: hidden;
        }
        .card-wrapper2 .text-card p{
            line-height: 28px;
        }
        @media (max-width: 1183px) {
            .card-wrapper2{
                grid-template-columns: repeat(1, 1fr);
            }
        }

        .trust-container {
            max-width: 1400px;
            margin: 0 1rem;
            padding: 2rem;
            border: 2px solid var(--accent-clr);
            border-radius: 24px;
            position: relative;
        }

        .trust-container .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
        }

        .text-content {
            padding-right: 2rem;
        }

        .text-content h1 {
            font-size: 3rem;
            color: var(--text-clr);
            margin-bottom: 1rem;
            line-height: 1.2;
            font-family: Heading;
        }

        .brand {
            color: var(--accent-clr);
            display: block;
            font-family: Heading;

        }

        h2 {
            color: var(--text-clr);
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

         p {
            color: var(--secondary-text-clr);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .learn-more {
            display: inline-block;
            background-color: var(--accent-clr);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .learn-more:hover {
            background-color: va;
        }

        .image-container {
            position: relative;
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background-color: var(--accent-clr);
            z-index: -1;
        }

        .image-container::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 100px;
            height: 100px;
            background-color: var(--accent-clr);
            z-index: -1;
        }

        .event-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            display: block;
        }

        @media (max-width: 1024px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .trust-container {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .trust-container .content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .text-content {
                padding-right: 0;
            }

            h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
          

            .trust-container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            .image-container::before,
            .image-container::after {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 320px) {
            h1 {
                font-size: 1.5rem;
            }

            .learn-more {
                padding: 0.75rem 1.5rem;
                font-size: 0.9rem;
            }
        }
        .hero {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 90px;
        }
        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-content h1 {
            font-size: 64px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(to right, var(--text-clr), var(--accent-clr));
            -webkit-background-clip: text;
            color: transparent;
        }

        .tagline {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .bio {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
            font-size: 16px;
            opacity: 0.9;
        }

        .social-icons {
            display: flex;
            gap: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent-clr);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #fff;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px);
        }

        .banner-image {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            background-color: #7c3aed;
            border-radius: 8px;
            position: relative;
            z-index: 2;
        }

        .banner-image-border {
            position: absolute;
            width: 100%;
            max-width: 500px;
            height: 100%;
            border: 2px solid #7c3aed;
            border-radius: 8px;
            top: 20px;
            left: 10px;
            z-index: 1;
        }

        /* Responsive Styles */
        @media (max-width: 900px) {
           .hero-content h1 {
                font-size: 48px;
            }
            
            .tagline {
                font-size: 20px;
            }
            
            .bio {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                grid-template-columns: 1fr;
            }
            
            .banner-image {
                order: -1;
                margin-bottom: 30px;
            }
            
            .profile-image, .banner-image-border {
                max-width: 400px;
            }
            
            .banner-image-border {
                top: 15px;
                left: 15px;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 20px 0;
            }
            
            .logo {
                font-size: 20px;
            }
            
            .hero-content h1 {
                font-size: 36px;
            }
            
            .tagline {
                font-size: 18px;
                margin-bottom: 30px;
            }
            
            .profile-image, .banner-image-border {
                max-width: 300px;
            }
            
            .banner-image-border {
                top: 10px;
                left: 10px;
            }
            
            .social-icon {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 320px) {
        
            
            header {
                padding: 15px 0;
            }
            
            .logo {
                font-size: 18px;
            }
            
            .github-icon {
                font-size: 28px;
            }
            
            h1 {
                font-size: 32px;
            }
            
            .tagline {
                font-size: 16px;
                margin-bottom: 25px;
            }
            
            .bio {
                font-size: 14px;
                gap: 15px;
            }
            
            .profile-image, .banner-image-border {
                max-width: 250px;
            }
            
            .social-icon {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }
        }
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1000;
            opacity: 0.1;
        }

        
    </style>
</head>
<body>
    <?php include("./assets/components/navbar.php"); ?>
    <!-- active links -->
    <script>
        const NavLink = document.querySelectorAll('.nav-link')[3];
        NavLink.style.color = 'var(--accent-clr)';
    </script>
    <style>
        .nav-link:nth-of-type(4)::after {
            width: 100%;
        }
    </style>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .bread-crumb {
            /* background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); */
            color: white;
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        .bread-crumb h1 {
            font-size: 3.3rem;
            margin-bottom: 20px;
        }

        .bread-crumb p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .contact-card {
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--line-clr);
            box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);
            transition: all 0.4s ease;
            padding: 2rem;
            text-align: center;
        }
        .contact-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 2.4px;
            background: var(--accent-clr);
            opacity: 0;
            scale: 0;
            transition: scale 0.6s ease;
            z-index: 1;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: none;
            background: linear-gradient(145deg, rgba(138, 43, 226, 0.1), rgba(90, 0, 190, 0.1));
            border-radius: 0;
        }
        .contact-card:hover::before {
            opacity: 1;
            scale: 1;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--accent-clr);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }

        .contact-card h3 {
            color: var(--text-clr);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .contact-card p {
            color: var(--secondary-text-clr);
            margin-bottom: 20px;
        }

        .contact-link {
            color: var(--accent-clr);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .contact-link:hover {
            color: var(--accent-clr);
        }

        .contact-form {
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;

            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 1rem;
            box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);

        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--secondary-text-clr);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--line-clr);
            border-radius: 6px;
            font-size: 1rem;
            background: var(--base-clr);
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: var(--accent-clr);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background: #4338ca;
        }

        @media (max-width: 768px) {
            .bread-crumb h1 {
                font-size: 2rem;
            }

            .contact-form {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            .bread-crumb {
                padding: 40px 20px;
            }

            .bread-crumb h1 {
                font-size: 1.75rem;
            }
            .bread-crumb p {
                font-size: 1rem;
            }

            .contact-card {
                padding: 20px;
            }
        }

        @media (max-width: 320px) {
            .container {
                padding: 10px;
            }

            .contact-header h1 {
                font-size: 1.5rem;
            }

            .contact-form {
                padding: 20px;
            }
        }
   
    </style>

    <div style="margin-top: 7rem;"></div>


    <div class="bread-crumb">
        <div class="container">
            <h1 style="line-height: 1.1;">Get in Touch</h1>
            <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </div>

    <div class="container">
        <div class="contact-grid">
            <div class="contact-card move_in">
                <div class="contact-icon">
                    <i class="fa fa-phone"></i>
                </div>
                <h3>Call Us</h3>
                <p>Mon-Fri from 8am to 5pm</p>
                <a href="tel:+2341234567890" class="contact-link">
                    +234 123 456 7890
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="contact-card move_in">
                <div class="contact-icon">
                    <i class="fa fa-whatsapp"></i>
                </div>
                <h3>WhatsApp</h3>
                <p>Chat with us anytime</p>
                <a href="https://wa.me/2341234567890" class="contact-link" target="_blank">
                    Send Message
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="contact-card move_in">
                <div class="contact-icon">
                    <i class="fa fa-map"></i>
                </div>
                <h3>Visit Us</h3>
                <p>Come say hello at our office</p>
                <a href="https://maps.google.com" class="contact-link" target="_blank">
                    View on Map
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="contact-form move_in">
            <h2 style="text-align: center; margin-bottom: 30px; color: var(--text-clr);">Send us a Message</h2>
            <form>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" required placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" required placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" required placeholder="How can we help?">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" required placeholder="Your message here..."></textarea>
                </div>
                <br>
                <?php 
                    $buttonText = "submit";
                    $buttonHref = "#";
                    include("./assets/components/button.php"); 
                ?>
            </form>
        </div>
    </div>
    <?php include("./assets/components/footer.php"); ?>
 

    <script src="./assets/js/toggleNavbar.mjs"></script>
    <script src="./assets/js/W3.mjs"></script>
    <script src="./assets/js/cardOject.mjs"></script>
    <script src="./assets/js/scrollAnimation.js"></script>
    <script src="./assets/js/Three.mjs"></script>
</body>
</html>