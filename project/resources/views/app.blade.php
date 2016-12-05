<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>VICE Digital | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/fav_icon.ico') }}"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/fav_icon.ico') }}"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <!-- NProgress -->
    <link rel="stylesheet" href="{{ asset('/css/nprogress.css') }}">
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-progressbar-3.3.4.min.css') }}">
    
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ asset('/css/custom.min.css') }}">
    <!-- Developer Style -->
    <link rel="stylesheet" href="{{ asset('/css/developer.css') }}">
    
    @yield('css')
</head>
<?php   $current_url = Request::url(); 
        $login_url = url('/').'/auth/login'; 
        $register_url = url('/').'/auth/register'; 
        $register_url2 = url('/').'/register'; 
        $login_url2 = url('/'); 
?>
<body <?php if($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2) { ?> class="login" <?php } else { ?> class="nav-md" <?php } ?>>
    @include('header')		
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2)) { ?>
	    @include('aside')
            
            <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('/images/user.png') }}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->        
        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
            <?php Session::pull('message', 'User Registered Successfully!'); } ?>
        
    <?php } ?>
    @yield('content')
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2)) { ?>
        </div>
    <?php } ?>
    
    @include('footer')
    
    <!-- Scripts -->
    <!-- Jquery -->
    <script src="{{ asset('/js/jquery-1.11.2.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- Path JS -->
    <script src="{{ asset('/js/path.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/js/fastclick.js') }}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/js/custom.min.js') }}"></script>
        @yield('js')
</body>
</html>