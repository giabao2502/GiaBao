<!DOCTYPE htm>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-inverse">

        <div class="container">
            <a class="navbar-brand" href="#">My Shopping</a>
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

             <!-- Right Side Of Navbar -->
             <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest('cus')
                    @if (Route::has('customer.login'))
                        <li><a href="{{ route('customer.login') }}">{{ __('Customer Login') }}</a></li>
                    @endif

                    @if (Route::has('customer.register'))
                        <li><a href="{{ route('customer.register') }}">{{ __('Customer Register') }}</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a id="navbarDropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('cus')->user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Customer Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>

    </nav>

    <div class="container">
        @yield('main')
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
