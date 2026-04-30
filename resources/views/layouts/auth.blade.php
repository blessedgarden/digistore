<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#BCB4FF',
                        dark: '#222222',
                        darkLight: '#333333',
                    },
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #222222;
            color: #ffffff;
        }

        * {
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #BCB4FF;
            color: #222222;
            font-weight: 600;
            border-radius: 12px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: transparent;
            color: #BCB4FF;
            box-shadow: 0 0 20px rgba(188, 180, 255, 0.5);
        }

        .btn-secondary {
            background-color: transparent;
            color: #BCB4FF;
            font-weight: 600;
            border-radius: 12px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #BCB4FF;
            color: #222222;
            box-shadow: 0 0 20px rgba(188, 180, 255, 0.5);
        }

        .card {
            background-color: #333333;
            border-radius: 16px;
            border: 1px solid rgba(188, 180, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #BCB4FF, #9b8fd9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        input, textarea, select {
            background-color: #333333 !important;
            border: 1px solid rgba(188, 180, 255, 0.3) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #BCB4FF !important;
            outline: none;
            box-shadow: 0 0 15px rgba(188, 180, 255, 0.2) !important;
        }

        input::placeholder {
            color: #999999;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>