<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCH E-Count</title>

    {{-- Bootstrap css --}}
    <link rel="stylesheet" href="/bootstrap-4.0.0-dist/css/bootstrap.css">


    {{-- GOOGLE Font NOTO SANS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

    <!-- fontawesome  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- โหลด jQuery จาก CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: #EDFCF6;
            font-family: "Noto Sans Thai", serif;

        }
    </style>

    @stack('style')
</head>

<body>

    {{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="height: 40px" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Furni<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li><a class="nav-link" href="shop.html">Shop</a></li>
                    <li><a class="nav-link" href="about.html">About us</a></li>
                    <li><a class="nav-link" href="services.html">Services</a></li>
                    <li><a class="nav-link" href="blog.html">Blog</a></li>
                    <li><a class="nav-link" href="contact.html">Contact us</a></li>
                </ul>
            </div>
        </div>
    </nav> --}}

    @yield('content')

    <script src="/bootstrap-4.0.0-dist/js/bootstrap.js"></script>

    @stack('script')
</body>

</html>
