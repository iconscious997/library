<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Library') }}</title>
</head>
<body>
    <section id="site-border">
    </section>

    <header id="app-header">
        <h1><a href="{{ url('/') }}">{{ config('app.name', 'Library') }}</a></h1>

        <section id="user-panel">
            @if(Auth::check())
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Sign out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @else
                <a href="{{ url()->route('login') }}">Sign in</a>
                <a href="{{ url()->route('register') }}">Sign up</a>
            @endif
        </section>
    </header>

    <section id="content" class="@yield('content-class')">
        <form action="{{ route('book.search') }}" method="get" id="search-form">
            <input type="search" name="query" placeholder="{{ trans('search.search-books') }}">
        </form>

        @yield('content')
    </section>

    <script type="text/javascript" src="{{ url('js/jQuery/jquery-3.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/webfontloader/webfontloader.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/select2/select2.full.min.js') }}"></script>
    <script>
        WebFont.load({
            custom: {
                families: ['Varela Round', 'Oswald'],
                urls: ['/css/app.css']
            }
        });
        $.fn.select2.defaults.set("theme", "library");
    </script>

    @yield('javascript')
</body>
</html>