<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Laracast | @yield("title")</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->
        <!-- public/app.css compiled file-->
        <link rel="stylesheet" href="/css/app.css"/>
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="/css/custom.css">
        
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <div id="app" class="container">
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand {{ Request::is('/') ? 'active text-under' : '' }}" href="/">LaracastScratch</a>

              <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="/welcome">Welcome</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active text-under' : '' }}" href="/about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active text-under' : '' }}" href="/contact">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ Request::is('projects') ? 'active text-under' : '' }}" href="/projects">Projects</a>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    @guest
                        <li class="nav-item">
                          <a class="nav-link {{ Request::is('login') ? 'active text-under' : '' }}" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ Request::is('register') ? 'active text-under' : '' }}" href="{{route('register')}}">Register</a>
                        </li>
                      
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('profile') }}">
                                      {{ __('Profile') }}
                                  </a>
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

                <!--<form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>-->
              </div>
            </nav>

            <hr>
            
            <div class="container">
              @yield('content')
            </div>
        </div>
        
        @auth
          <script>
              window.user = @json(auth()->user());
          </script>
        @endauth
        <!-- public/app.js compiled file-->
        <script src="/js/app.js"></script>
        <script src="/vendor/jquery-mask/jquery.mask.min.js"></script>
        @yield('js')

    </body>
</html>