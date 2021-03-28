<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Buyler</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">

        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet"> 
    </head>
    <body class="bg-gray-200  font-serif text-xl">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center ">
                <li>
                    <a href="{{ route('home')}}" class="p-3 ">Home</a>
                </li>
                @auth
                <li>
                    <a href="{{ route('dashboard')}}" class="p-3">Dashboard</a>
                </li>
                @endauth
                @auth
                <li>
                    <a href="{{route('product')}}" class="p-3">New Product</a>
                </li>
                @endauth
                
            </ul>

            <ul class="flex items-center">
                @auth
                    <li>
                        <p class="pr-2">{{auth()->user()->name}}</p>
                        <!--<a href="" class="p-3">{{auth()->user()->name}}</a> Change to link, if user profile is implemented-->
                    </li>
                    <li>
                        <form action="{{ route('logout')}}" method="POST" class="p-3 inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>

                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="p-3">Register</a>
                    </li>
                @endguest
            </ul>
        </nav>
        @yield('content')
    </body>
</html>
