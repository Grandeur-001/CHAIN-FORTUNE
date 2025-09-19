<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#11121a',
                        line: '#42434a',
                        hover: '#222533',
                        textColor: '#e6e6ef',
                        accent: '#5e63ff',
                        secondaryText: '#b0b3c1',
                    },
                    animation: {
                        'rotate': 'rotate 2s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite',
                    },
                    keyframes: {
                        rotate: {
                            '0%': { transform: 'rotate(0deg)' },
                            '100%': { transform: 'rotate(360deg)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles that can't be easily done with Tailwind utilities */
        .loader-circle:nth-child(1) {
            border-color: #5e63ff transparent transparent transparent;
            animation-delay: 0s;
        }
        
        .loader-circle:nth-child(2) {
            border-color: transparent #5e63ff transparent transparent;
            animation-delay: 0.2s;
        }
        
        .loader-circle:nth-child(3) {
            border-color: transparent transparent #5e63ff transparent;
            animation-delay: 0.4s;
        }
    </style>
</head>
<body class="m-0 min-h-screen flex justify-center items-center bg-base font-sans">
    <button class="bg-accent text-textColor border-none py-4 px-8 rounded-lg text-base font-medium cursor-pointer transition-all duration-200 hover:bg-[#4a4eff] active:scale-[0.98]">
        Click Me
    </button>

    <div id="loader-overlay" class="fixed top-0 left-0 w-full h-full bg-base flex justify-center items-center z-[9999] opacity-100 visible transition-all duration-300">
        <div class="loader relative w-[120px] h-[120px]">
            <div class="loader-circle absolute w-full h-full border-4 border-line rounded-full animate-rotate"></div>
            <div class="loader-circle absolute w-full h-full border-4 border-line rounded-full animate-rotate"></div>
            <div class="loader-circle absolute w-full h-full border-4 border-line rounded-full animate-rotate"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-sm text-textColor whitespace-nowrap">
                Loading...
            </div>
        </div>
    </div>
</body>
</html>