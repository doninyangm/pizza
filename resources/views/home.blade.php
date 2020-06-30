<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Pizzaspot</title>
    <!-- font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <!-- custom css -->
    <link rel="stylesheet" href="pizza/css/main.css">

</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-center">
            <span class="nav-icon">
                <a href="#"><i class="fas fa-user"></i></a>
            </span>
            <!-- <span class="h1">Pizza <span style="color:f09d51;!important">Spot</span></span> -->
            <a href="/cart">
                <div class="cart-btn">
                    <span class="nav-icon">
                        <i class="fas fa-cart-plus"></i>
                    </span>
                    <div class="cart-items">0</div>
                </div>
            </a>
            <!-- GUEST DIV -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            <!-- END GUEST DIV -->
        </div>
    </nav>
    <!-- end of navbar -->
    <!-- hero -->
    <header class="hero">
        <div class="banner">
            <h1 class="banner-title">Pizza Menu</h1>
        </div>
    </header>
    <!-- end of hero -->
    <!-- Products -->
    <section class="products">
        <div class="section-title">
            <h2>Our Products</h2>
        </div>
        <div class="products-center">

        </div>
    </section>
    <!-- End Of Products -->
    <!-- my cart -->
    <div class="cart-overlay">
        <div class="cart">
            <span class="close-cart">
                <i class="fas fa-window-close"></i>
            </span>
            <h2>Your Cart</h2>
            <div class="cart-content">
                <!-- cart-item -->

                <!-- end of cart-item -->
            </div>
            <div class="cart-footer">
                <h3>Total: $<span class="cart-total">0</span> </h3>
                <!-- <h3>Total: &euro;<span class="cart-total"></span> </h3> -->
                <a href="/cart"><button class="clear-cart banner-btn">Check Out</button></a>
                <button class="clear-cart banner-btn">Clear Cart</button>
            </div>
        </div>
    </div>
    <!-- end of my cart -->
    <!-- Footer -->
    <section class="footer">

    </section>
    <!-- end of footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="/pizza/js/app.js"></script>
</body>

</html>
