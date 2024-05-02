<!DOCTYPE html>
<html lang="en">
  <head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ModelMosaic</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0ef7962d4a.js" crossorigin="anonymous"></script>



  </head>

  <body >
    
  <nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <ul class="navbar-nav justify-content-center">
      @if(auth()->check())
        @if(auth()->user()->email_verified_at!=null)
          @if(auth()->user()->isAdmin())
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/add_new_model">Add New Model</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/edit_model">Edit Model</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/about_me">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/logout">Logout</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/purchase_record">Purchase Record</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/search_model">Search Model</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/about_me">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="/logout">Logout</a>
            </li>
          @endif
        @else
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Please verify your email inorder to get more accesses!</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/email/verify">Verify Email</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-light" href="/logout">Logout</a>
          </li>
        @endif
      @else
        <li class="nav-item">
          <a class="nav-link btn btn-light" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-light" href="/about_me">About Me</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-light" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        </li>
      @endif
    </ul>
</nav>
    <!-- END Topbar -->

    <!-- Main container -->
    <main>
      <div id="header">
        @yield('header')
      </div>
      
      <div id="content">
        @yield('content')
      </div>
      
    </main>
    <!-- END Main container -->


  </body>
  <div id="app">
      <vue-login />
  </div>
</html>
