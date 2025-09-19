<?php
    include("../../../backend/connection.php");
    include("../../../backend/section_handler.php");
    include("../../../backend/fetch_sensitive_info.php");
    $userId = $_SESSION['user_id'];
    $userRole = $_SESSION['user_role'] ?? null;
    
    if (isset($_SESSION['attempted_url'])) {
        $redirect = $_SESSION['attempted_url'];
        unset($_SESSION['attempted_url']);
    } else {
        $redirect = ($userId === $adminUserId && $userRole === 'admin') 
            ? '/chain-fortune/admin/dashboard' 
            : '/chain-fortune/dashboard';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chain Fortune</title>
    <style>
        :root {
            --base-clr: #11121a;
            --black-clr: #07070a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--base-clr);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family:  -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;    
            overflow: hidden;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 600px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .loader-wrapper {
        width: 200px;
        height: 60px;
        position: relative;
        z-index: 1;
        }

        .circle {
        width: 20px;
        height: 20px;
        position: absolute;
        border-radius: 50%;
        background-color: var(--accent-clr);
        left: 15%;
        transform-origin: 50%;
        animation: circle7124 .5s alternate infinite ease;
        }

        @keyframes circle7124 {
        0% {
            top: 60px;
            height: 5px;
            border-radius: 50px 50px 25px 25px;
            transform: scaleX(1.7);
        }

        40% {
            height: 20px;
            border-radius: 50%;
            transform: scaleX(1);
        }

        100% {
            top: 0%;
        }
        }

        .circle:nth-child(2) {
        left: 45%;
        animation-delay: .2s;
        }

        .circle:nth-child(3) {
        left: auto;
        right: 15%;
        animation-delay: .3s;
        }

        .shadow {
        width: 20px;
        height: 4px;
        border-radius: 50%;
        background-color: rgba(0,0,0,0.9);
        position: absolute;
        top: 62px;
        transform-origin: 50%;
        z-index: -1;
        left: 15%;
        filter: blur(1px);
        animation: shadow046 .5s alternate infinite ease;
        }

        @keyframes shadow046 {
        0% {
            transform: scaleX(1.5);
        }

        40% {
            transform: scaleX(1);
            opacity: .7;
        }

        100% {
            transform: scaleX(.2);
            opacity: .4;
        }
        }

        .shadow:nth-child(4) {
        left: 45%;
        animation-delay: .2s
        }

        .shadow:nth-child(5) {
        left: auto;
        right: 15%;
        animation-delay: .3s;
        }
        

        .text-container {
            position: relative;
            opacity: 0;
            transform: translateY(30px);
            display: none;
        }
        .main-text-wrapper{
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }
        .main-text {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--text-clr);
            text-align: center;
            letter-spacing: 2px;
            position: relative;
            
        }

        .letter {
            display: inline-block;
            opacity: 0;
            transform: translateY(20px);
        }

        .highlight {
            color: var(--accent-clr);
        }

        .sub-text {
            color: var(--secondary-text-clr);
            font-size: 1.1rem;
            text-align: center;
            margin-top: 1rem;
            opacity: 0;
            transform: translateY(20px);
        }

        .background-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(var(--line-clr) 1px, transparent 1px),
                            linear-gradient(90deg, var(--line-clr) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.1;
            z-index: -1;
            animation: gridMove 20s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }

        @keyframes gridMove {
            0% { transform: translateY(0); }
            100% { transform: translateY(-40px); }
        }

        .loading-bar {
            width: 200px;
            height: 4px;
            background-color: var(--line-clr);
            border-radius: 2px;
            margin-inline: auto;
            overflow: hidden;
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
            display: none;
        }

        .progress {
            width: 100%;
            height: 100%;
            background-color: var(--accent-clr);
            animation: loading 3s linear;
            transform-origin: left;
        }
        @keyframes loading {
            0% {
            transform: scaleX(0);
            }
            100% {
            transform: scaleX(1);
            }
        }


        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .main-text {
                font-size: 2.5rem;
            }

            .sub-text {
                font-size: 1rem;
            }

           
        }

        @media (max-width: 480px) {
            .main-text {
                font-size: 2rem;
            }

            .sub-text {
                font-size: 0.9rem;
            }

        
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>
    <div class="container">
        <div class="spinner">
            <div class="loader-wrapper">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="shadow"></div>
                <div class="shadow"></div>
                <div class="shadow"></div>
            </div>
        </div>
        <div class="text-container">
            <div class="main-text-wrapper">
              <img src="/chain-fortune/images/logo/logo_5.png" style="margin-bottom: 10px;" width="90" alt="Chain Fortune Logo" class="logo">
              <div class="main-text">
              </div>
            </div>
            <div class="sub-text">Trading Crypto with Confidence</div>
        </div>

        <div class="loading-bar">
            <div class="progress"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const text = 'Chain Fortune';
            const mainText = document.querySelector('.main-text');
            const textContainer = document.querySelector('.text-container');
            const spinner = document.querySelector('.spinner');
            const subText = document.querySelector('.sub-text');
            const LoadingBar = document.querySelector('.loading-bar');
            const progress = document.querySelector('.progress');

            const letters = text.split('').map((letter, index) => {
                const span = document.createElement('span');
                span.textContent = letter;
                span.className = 'letter';
                if (index < 5) span.classList.add('highlight');
                return span;
            });

            mainText.append(...letters);

            setTimeout(() => {
                spinner.style.transition = 'all 0.5s ease';
                spinner.style.opacity = '0';
                spinner.style.transform = 'scale(0.5)';
                textContainer.style.display = 'block';
                
                setTimeout(() => {
                    spinner.style.display = 'none';
                    textContainer.style.opacity = '1';
                    textContainer.style.transform = 'translateY(0)';
                    textContainer.style.transition = 'all 0.5s ease';

                    letters.forEach((letter, index) => {
                        setTimeout(() => {
                            letter.style.transition = 'all 0.5s ease';
                            letter.style.opacity = '1';
                            letter.style.transform = 'translateY(0)';
                            letter.style.animation = 'bounce 1s ease';
                        }, index * 100);
                    });

                    setTimeout(() => {
                        subText.style.transition = 'all 0.5s ease';
                        subText.style.opacity = '1';
                        subText.style.transform = 'translateY(0)';
                    }, letters.length * 100 + 200);
                }, 500);
            }, 2000);

            setTimeout(() => {
                LoadingBar.style.display = 'block';
            }, 5000);
            setTimeout(() => {
              window.location.href = '<?php
                 echo($redirect); 
              ?>'
            }, 8000);
        });
    </script>
</body>
</html>
