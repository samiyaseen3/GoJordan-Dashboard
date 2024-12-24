<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets_userside/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('/assets_userside/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets_userside/css/style.css')}}">
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
          body {
            font-family: 'Poppins', sans-serif;
        }
        #search-form-container {
          position: absolute;
          top: 80px;
          left: 0;
          width: 100%;
          background: #24242a; 
          padding: 10px 0;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          z-index: 1000;
        }
      
        .search-container {
          display: flex;
          justify-content: center;
          align-items: center;
        }
      
        .search-input {
          border: 1px solid #ccc;
          padding: 10px 20px;
          font-size: 16px;
          width: 50%;
          outline: none;
        }
      
        .search-btn {
          background-color: #007bff;
          border: none;
          color: #fff;
          padding: 10px 20px;
          font-size: 16px;
        }
      
        .search-btn:hover {
          background-color: #0056b3;
        }
      
        .close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    z-index: 10;
}
.close-btn:hover {
    color: #f15d30; 
}
      </style>
    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{route('userside.index')}}">Go<span>Jordan</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
    
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item {{ request()->routeIs('userside.index') ? 'active' : '' }}">
                            <a href="{{route('userside.index')}}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('full-adventure') || request()->is('mini-adventure') || request()->is('day-adventure') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="adventureDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Group Adventures
                            </a>
                            <div class="dropdown-menu Adventure" aria-labelledby="adventureDropdown" style="background-color: #000;">
                                <a class="dropdown-item d-flex align-items-center" href="{{route('tours.full-adventure')}}" style="color: #ffffff;">
                                    <img src="{{asset('assets_userside/images/full-advanture.jpg')}}" alt="Full Adventure" class="dropdown-img">
                                    <span>Full Adventure</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('tours.mini-adventure')}}" style="color: #ffffff;">
                                    <img src="{{asset('assets_userside/images/mini-advanture.jpg')}}" alt="Mini Adventure" class="dropdown-img">
                                    <span>Mini Adventure</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('tours.day-adventure')}}" style="color: #ffffff;">
                                    <img src="{{asset('assets_userside/images/day-adnvature.jpg')}}" alt="Day Adventure" class="dropdown-img">
                                    <span>Day Adventure</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('tours.all-adventure')}}" style="color: #ffffff;">
                                    <img src="{{asset('assets_userside/images/day-adnvature.jpg')}}" alt="Day Adventure" class="dropdown-img">
                                    <span>Show All</span>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->routeIs('userside.private-tour') ? 'active' : '' }}">
                            <a href="{{route('userside.private-tour')}}" class="nav-link">Private Tours</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('userside.about') ? 'active' : '' }}">
                            <a href="{{route('userside.about')}}" class="nav-link">About</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('userside.contact') ? 'active' : '' }}">
                            <a href="{{route('userside.contact')}}" class="nav-link">Contact</a>
                        </li>

                        
                        
                    </ul>
    
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle mr-2"></i> <!-- Profile Icon -->
                                {{ Auth::user()->name }} <!-- User Name -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{route('userside.profile')}}">
                                    <i class="fa fa-user mr-2"></i> Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out mr-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @else
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        <li class="nav-item"><a href="{{ route('user.login') }}" class="nav-link">Login</a></li>
                        @endauth

                        <li class="nav-item">
                            <a href="#" id="search-icon" class="nav-link">
                              <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                          </li>
                          <li class="nav-item" id="search-form-container" style="display: none;">
                            <div class="search-container">
                                <span class="close-btn" id="close-btn">&times;</span>
                                <form action="{{ route('userside.search') }}" method="GET">
                                  <div class="input-group">
                                    <input type="text" class="form-control search-input" name="query" placeholder="Search for tours..." aria-label="Search" aria-describedby="search-btn">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary search-btn" type="submit" id="search-btn">
                                        <i class="fa fa-search"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                          </li>
                        
                        

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(function () {
  $("#search-icon").click(function (e) {
    e.preventDefault();
    $("#search-form-container").fadeToggle();
  });
});
$("#close-btn").click(function () {
        $("#search-form-container").fadeOut();
    });
    </script>
</body>


</html>
