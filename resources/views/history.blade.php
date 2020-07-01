<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Pizzaspot</title>
    <!-- font awesome -->
    <link href="pizza/css/font-awesome.css" rel="stylesheet">
    <!-- <link href="pizza/css/font-awesome-13.5.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="pizza/css/main.css">
    <link rel="stylesheet" href="pizza/css/cart.css">

</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-center">
            <span class="nav-icon">
                <a href="/home"><i class="fas fa-user"></i></a>
            </span>
            <!-- <a href="index.html"><img src="pizza/images/logo.svg" alt="store logo"></a> -->
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
  <!-- Cart -->
  <section class="container mb-4">
    <div class="mt-4">
      <h3 class="text-center">SHOPPING CART</h3>
    </div>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">ID</th>
          <th scope="col" class="text-center">Image</th>
          <th scope="col" class="text-center">Name</th>
          <th scope="col" class="text-center">Price($)</th>
          <th scope="col" class="text-center">Price(&euro;)</th>
          <th scope="col" class="text-center">Size</th>
          <th scope="col" class="text-center">Quantity</th>
        </tr>
      </thead>
      <tbody class="item">
        @foreach($histories as $history)
            <tr class="text-center">
                <td scope="row">{{ $history->pizza_id }}</td>
                <td scope="row"><img src="{{ $history->image }}" height="100px" width="100px" class="img-thumbnail" alt=""></td>
                <td scope="row">{{ $history->pizza_name }}</td>
                <td scope="row" class="dollarPrice">{{ $history->dollar_price }}</td>
                <td scope="row" class="euroPrice">{{ $history->euro_price }}</td>
                <td scope="row">{{ $history->pizza_size }}</td>
                <td scope="row">{{ $history->quantity }}</td>
            </tr>

        @endforeach
      </tbody>
    </table>
  </section>

  <!-- End of Cart -->
    <script src="pizza/js/jquery.min.js"></script>
    <!-- <script src="pizza/jquery.js"></script> -->
    <script src="/pizza/js/history.js" charset="utf-8"></script>
</body>

</html>
