<?php
    require_once 'connection.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: /chain-fortune/action/logout");
        exit();
    }
    

    $user_id = $_SESSION['user_id'];



    $sql = "SELECT role FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    

    function require_admin() {
        require_once __DIR__ . '/vendor/autoload.php'; 
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $adminUserId = trim($_ENV['ADMIN_USER_ID']); 
        global $role;

        if ($_SESSION['user_id'] !== $adminUserId && $role !== 'admin') {
            http_response_code(403); 
            die(<<<HTML
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>403 | Chain Fortune</title>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                        <script src="https://cdn.tailwindcss.com"></script>
                        <script>
                            tailwind.config = {
                                theme: {
                                    extend: {
                                        colors: {
                                            base: '#11121a',
                                            darker: '#07070a',
                                            line: '#42434a',
                                            hover: '#222533',
                                            text: '#e6e6ef',
                                            accent: '#5e63ff',
                                            secondary: '#b0b3c1',
                                            negative: '#ff004a',
                                            positive: '#10B981',
                                            pending: 'rgb(255, 255, 0)',
                                            info: 'rgb(0, 145, 255)',
                                        },
                                        animation: {
                                            'fade-in': 'fadeIn 0.5s ease-out',
                                        },
                                        keyframes: {
                                            fadeIn: {
                                                '0%': { opacity: '0', transform: 'translateY(-20px)' },
                                                '100%': { opacity: '1', transform: 'translateY(0)' },
                                            }
                                        }
                                    }
                                }
                            }
                        </script>
                    </head>
                    <body class="m-0 p-0 font-sans bg-base text-text flex justify-center items-center min-h-screen leading-relaxed">
                        <div class="max-w-[550px] p-10 bg-darker rounded-xl shadow-lg text-center animate-fade-in border border-line mx-4">
                            <div class="mb-6">
                                <div class="w-20 h-20 bg-opacity-15 bg-[#ff004a] rounded-full flex justify-center items-center mx-auto">
                                    <i class="fas fa-ban text-4xl text-negative"></i>
                                </div>
                            </div>
                            
                            <h1 class="text-4xl font-bold mb-4 text-text">Page Not Found !</h1>
                            
                            <div class="bg-opacity-15 bg-[#e74c3c] rounded-lg p-4 mb-6 border-l-4 border-negative">
                                <p class="m-0 text-[text] text-text">looks like, page doesn't exist!</p>
                            </div>
                            
                            <p class="text-secondary mb-8 text-[0.95rem]">This action was taken to protect the integrity, security, and experience of our users. If you believe this is a mistake or require further information, you may reach out to our support team for review.</p>
                            
                            <a href="#contact" class="inline-block bg-accent text-text py-3 px-6 rounded-md no-underline font-medium transition-all duration-200 border-none cursor-pointer text-[0.95rem] hover:bg-opacity-90">Go back</a>
                            
                            <div class="mt-8 pt-6 border-t border-line text-secondary text-[0.85rem]">
                                <p class="m-0">Error Code: 403 | Forbidden Access</p>
                            </div>
                        </div>
                        
                        <style>
                            @media (max-width: 600px) {
                                body > div {
                                    margin: 1rem;
                                    padding: 1.5rem;
                                }
                            }
                        </style>
                    </body>
                </html>
                HTML
            );
            session_unset();
            session_destroy();
            exit();
        }
    }
    require_admin();
?>
