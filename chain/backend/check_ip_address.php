<?php
    require_once 'connection.php'; 

    function getClientIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        }
    }

    $ip_address = getClientIP();

    if ($ip_address) {
        $stmt = $conn->prepare("SELECT * FROM blocked_ip WHERE ip_address = ? AND is_permanent = 1 LIMIT 1");
        $stmt->bind_param("s", $ip_address);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            session_unset();
            session_destroy();
            http_response_code(403); 
            die(<<<HTML
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Access Denied</title>
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
                <style>
                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
                    }
                </style>
                <body class="bg-base text-text flex justify-center items-center min-h-screen leading-relaxed">
                    <div class="max-w-[550px] p-10 bg-darker rounded-xl shadow-lg text-center animate-fade-in border border-line mx-4">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-opacity-15 bg-[#ff004a] rounded-full flex justify-center items-center mx-auto">
                                <i class="fas fa-ban text-4xl text-negative"></i>
                            </div>
                        </div>
                        
                        <h1 class="text-4xl font-bold mb-4 text-text">Access Denied</h1>
                        
                        <div class="bg-opacity-15 bg-[#e74c3c] rounded-lg p-4 mb-6 border-l-4 border-negative">
                            <p class="m-0 text-text">Access to this platform has been permanently restricted.</p>
                        </div>
                        
                        <p class="text-secondary mb-8 text-[0.95rem]">This action was taken to protect the integrity, security, and experience of our users. If you believe this is a mistake or require further information, you may reach out to our support team for review.</p>
                        
                        <a href="/chain-fortune/page/contact" class="inline-block bg-accent text-text py-3 px-6 rounded-md no-underline font-medium transition-all duration-200 border-none cursor-pointer text-[0.95rem] hover:bg-opacity-90">Contact Support</a>
                        
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
            HTML);
        }
    }
?>
