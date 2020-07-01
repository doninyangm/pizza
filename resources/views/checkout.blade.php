<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out - Pizzaspot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="pizza/css/checkout.css">
    <link rel="stylesheet" href="pizza/css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-center">
            <span class="nav-icon">
                <a href="/login"><i class="fas fa-user"></i></a>
            </span>
            <!-- <a href="/home"><img src="pizza/images/logo.svg" alt="store logo"></a> -->
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
    <div class='container' style="width: 100% !important;">
        <div class='window'>
            <div class='order-info'>
                <div class='order-info-content my-4'>
                    <!-- <img src="pizza/images/product-.jpg" alt="hh"> -->
                    <div class='total'>
                        <span style='float:left;'>
                            <div class='thin dense'>Delivery</div>
                            TOTAL
                        </span>
                        <span style='float:right; text-align:right;'>
                            <div id="deliveryFee" class='thin dense'>$4.95 | &euro;2.3 </div>
                            <span id="checkoutTotal"></span>
                        </span>
                    </div>
                </div>
            </div>



            <div class='credit-info'>
                <div class='credit-info-content'>
                    <form id="payForm">
                          <input class='input-field' id="name" type="text" placeholder="Full Name"></input>
                          <input class='input-field' id="email" type="email" placeholder="Email"></input>
                          <input class='input-field' id="number" type="tel" placeholder="Phone Number"></input>
                          <table class='half-input-table'>
                              <tr>
                                  <td>
                                      <input class='input-field' id="postalCode" type="text" placeholder="Postal Code"></input>
                                  </td>
                              </tr>
                          </table>
                          <textarea class='input-field' name="address" id="address" type="text" rows="4" placeholder="Address"></textarea>
                          <button type="submit" class='pay-btn' style="position:unset;">Checkout</button>
                      </form>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js" integrity="sha256-bd8XIKzrtyJ1O5Sh3Xp3GiuMIzWC42ZekvrMMD4GxRg=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="pizza/js/checkout.js"></script>

</body>

</html>
