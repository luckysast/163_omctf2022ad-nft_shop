<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('js/bootstrap.bundle.min.js') }}" rel="script">

    <title>{{config('app.name','APP')}} -@yield('title')</title>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center link-dark">
            <i class="bi-shop" style="font-size: 2rem; color: cornflowerblue;"></i>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
            @if(App\Models\Users::checkAuth())
            <li><a href="/search" class="nav-link px-2 link-dark">
                    <i class="bi-alarm"></i> Search
                </a></li>
            <li><a href="/catalog" class="nav-link px-2 link-dark">
                    <i class="bi bi-columns-gap"></i> Catalog
                </a></li>

            <li><a href="/profile" class="nav-link px-2 link-dark">
                    <i class="bi-person"></i> Profile
                </a></li>
            @endif
            <li><a href="/about" class="nav-link px-2 link-dark">
                    <i class="bi-info-square"></i> About
                </a></li>
        </ul>

        <div class="col-md-3 text-end">
            @if(App\Models\Users::checkAuth())
                <a href="/logout" class="btn btn-outline-primary me-2"><i class="bi-door-open"></i> Logout</a>
            @else
                <a href="/login" class="btn btn-outline-primary me-2"><i class="bi-door-closed"></i> Login</a>
                <a href="/register" class="btn btn-primary"><i class="bi-person-square"></i> Register</a>
            @endif
        </div>
    </header>
</div>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="align-items-center g-lg-5">
        @yield('content')
    </div>
</div>
<footer class="footer pt-4 my-md-5 pt-md-5 border-top">
    <div class="container">
        © NFT-SHOP. 2022 Created by OmCTF.
    </div>
</footer>
</body>
</html>
