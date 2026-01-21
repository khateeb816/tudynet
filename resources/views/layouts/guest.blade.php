<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Tudynet')</title>
    <link href="{{ asset('assets/images/logo.jpeg') }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <style>
        body { font-family: 'Roboto', sans-serif; overflow-x: hidden; background-color: #fff; }
        .auth-wrapper { min-height: 100vh; }
        .auth-left { background-color: #fff; position: relative; overflow: hidden; }
        .auth-right { background-color: #fff; }
        
        /* Red wave pattern simulation using SVG-like effect with gradients */
        .wave-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(139, 0, 0, 0.05) 10px,
                rgba(139, 0, 0, 0.05) 20px
            );
            z-index: 0;
            transform: skewY(-5deg);
            transform-origin: bottom left;
        }

        .feature-list { list-style: none; padding: 0; }
        .feature-list li { margin-bottom: 12px; display: flex; align-items: start; font-size: 0.95rem; }
        .feature-list li i { color: #8B0000; margin-right: 10px; flex-shrink: 0; margin-top: 3px; }
        
        .btn-tudynet {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-tudynet:hover {
            background-color: #600000;
            color: white;
        }
        
        .form-control:focus {
            border-color: #8B0000;
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
        }
        
        .auth-logo { max-height: 60px; margin-bottom: 2rem; }
    </style>
</head>
<body>
    @yield('content')
    
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
