<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FarmLink Soko</title>
    <!-- Bootstrap core CSS -->
    <link href="/soko/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/soko/css/shop-homepage.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">FarmLink Soko</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://www.farmlinkkenya.com/category/market-prices/">Market Prices</a>
                    <span class="sr-only">(current)</span>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://www.farmlinkkenya.com/category/farm-inputs/">Farm Inputs</a>
                    <span class="sr-only">(current)</span>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://www.farmlinkkenya.com/">Agriposts</a>
                    <span class="sr-only">(current)</span>
                </li>
                @if (Route::has('login'))
                        @auth
                        <li class="nav-item active">
                            <a href="{{ url('/home') }}" class="nav-link">Home</a>
                        </li>
                        @else
                        <li class="nav-item active">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <a href="http://farmlinkkenya.com"><b>FarmLink Kenya </b></a> {{ date('Y') }}</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/soko/vendor/jquery/jquery.min.js"></script>
<script src="/soko/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>