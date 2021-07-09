<!DOCTYPE html>
<html lang="en">

<head>
    @include('User/includes.head')
</head>

<body>
    @if(!Request::is('login', 'register', 'introduce-affiliate', 'index-affiliate', 'index-affiliate/*'))
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        @include('User/includes.header')
    </header>
    <!--================ End Header Menu Area =================-->
    <div class="notification" style="z-index: 99999"></div>
    @endif

    <!-- Messenger Plugin chat Code -->
    @include('User/includes.messenger-chat')
    <main class="site-main">
      @yield('content')
    </main>


    @if(!Request::is('login', 'register', 'introduce-affiliate', 'index-affiliate', 'index-affiliate/*'))
    <!--================ Start footer Area  =================-->
    <footer class="footer">
        @include('User/includes.footer')
    </footer>
    <!--================ End footer Area  =================-->
    @endif
     
    @include('User/includes.script')
</body>

</html>
