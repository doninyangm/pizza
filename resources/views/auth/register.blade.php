<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pizzaspot</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="pizza/css/login.css">
    <link rel="stylesheet" href="pizza/css/main.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-center">
            <span class="nav-icon">
                <a href="#"><i class="fas fa-user"></i></a>
            </span>
            <a href="index.html"><img src="pizza/images/logo.svg" alt="store logo"></a>
            <div class="cart-btn">
                <span class="nav-icon">
                    <i class="fas fa-cart-plus"></i>
                </span>
                <div class="cart-items">0</div>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="pizza/images/img-01.png" alt="IMG">
				</div>

				<form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
          @csrf
					<span class="login100-form-title">Register</span>

					<div class="wrap-input100 validate-input">
						<input id="name" class="input100 form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Fullname"  value="{{ old('name') }}" required autocomplete="name" autofocus>
						<span class="focus-input100"></span>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
					</div>

					<div class="wrap-input100 validate-input">
						<input id="email" class="input100 form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
						<span class="focus-input100"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
					</div>

					<div class="wrap-input100 validate-input">
						<input id="password" class="input100 form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="new-password">
						<span class="focus-input100"></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
					</div>

          <div class="wrap-input100 validate-input">
						<input iid="input100 password-confirm" type="password" class="input100 form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">Register</button>
					</div>

					<div class="text-center p-t-20">
						<a class="txt1" href="/login"> Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
    </div>


    <script src="pizza/js/app.js"></script>
</body>
</html>
