<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Chain Fortune</title>
    <link rel="stylesheet" href="../styles/config/config.css">
    <link rel="stylesheet" href="../styles/colors/colors.css">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <style>
        body{
            background: var(--base-clr);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: var(--index-font);
        }
        a{
            text-decoration: none;
        }
        .wrapper{
            display: flex;
            justify-content: center;
            align-items: center;

            > div{
                display: flex;
                flex-direction: column;
                gap: 10px;
                justify-content: center;
            }

            > div h1{
                color: var(--text-clr);
                text-align: center;
                font-size: 44px;
            }
            > div p{
                color: var(--secondary-text-clr);
                text-align: center;
                font-size: 30px;
                text-transform: capitalize;

            }
        }
       @media (max-width: 898px) {
        .wrapper {
            flex-direction: column;
        }

       }
       @media (max-width: 768px) {
        .wrapper {
            > div h1{
                font-size: 36px;
            }
            > div p{
                font-size: 17px;
            }
            .button_component3{
                width: 120px;
            }


        }
        img{
            width: 400px;
            animation: pulse 1s infinite;

        }
       }
       .button_component3{
            width: 160px;
            margin: auto;
        }

       .search-box {
            position: relative;
            margin-bottom: 16px;
            margin-top: 20px;
        }

        .search-box input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            /* border-radius: 12px; */
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;

        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .search-box svg {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-text-clr);
        }


    </style>

</head>
<body>
       <div class="wrapper">
            <img src="/chain-fortune/images/something-lost.webp" width="600" alt="" srcset="">
            <div class="">
                <h1>Page Not Found !</h1>
                <p>looks like, page doesn't exist!</p>
                <?php 
                    $buttonOutlinedText = "BACK";
                    $buttonOutlinedHref = "#";
                ?>
                
                <div id="go_back">
                    <?php include("../components/button_outlined.php"); ?>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="Search ..." id="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                
            </div>
       </div>
       <script src="/chain-fortune/js/history.back.js"></script>
    
</body>
</html>