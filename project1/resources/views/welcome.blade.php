<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UGrant - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style type="text/css">
        /*font*/
        @import url("CSS/clash-display.css");

        /*Variable*/
        :root{
            --c-dark: #212529;
            --c-brand: #FF4600;
            --c-brand-light: #FB7C4C;
            --c-brand-rgb: 212, 135, 78;
            --c-body: #727272;
            --font-base: "ClashDisplay", sans-serif;
            --box-shadow: 0px 15px 25px rgba(0,0,0,0.08);
            --transition: all 0.5s ease;
        }

        /*reset & helpers*/
        body{
            font-family: var(--font-base);
            line-height: 1.7;
            color: var(--c-body);
            word-spacing: 1.5px;
        }

        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6{
            font-weight: 600;
            color: var(--c-dark)
        }

        a{
            text-decoration: none;
            color: var(--c-brand);
            transition: var(--transition);
        }

        a:hover{
            color: var(--c-brand-light);
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .section-padding{
            padding-top: 140px;
            padding-bottom: 140px;
        }

        .theme-shadow{
            box-shadow: var(--box-shadow);
        }

        p,
        pre{
            font-size: 15px;
        }

        /* Prevent scrolling */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Prevents scrolling */
        }

        /* Fixed hero section */
        #hero {
            background: linear-gradient(rgba(0,0,0,0.507), rgba(0,0,0,0.438)), url("Images/discussion.jpg");
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            height: 100vh;
            position: relative;
            overflow: hidden; /* Prevents scrolling within the section */
        }

        /*button*/
        .btn{
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 0;
            padding: 10px 24px;
        }

        .btn-brand{
            background-color: var(--c-brand);
            border-color: var(--c-brand);
            color: white;
        }

        .btn-brand:hover{
            background-color: var(--c-brand-light);
            border-color: var(--c-brand-light);
            color: white;
        }

        .navbar .btn-brand {
            font-size: 10px;        /* Smaller font size */
            padding: 8px 16px;      /* Reduced padding */
            text-transform: uppercase;
            font-weight: 600;
        }

        /*hero*/
        #hero{
            background: linear-gradient(rgba(0,0,0,0.507), rgba(0,0,0,0.438)), url("Images/discussion.jpg");
            background-position: center;
            background-size: cover;
            background-attachment: fixed; 
            height: 100vh; 
            position: relative;
        } 

        #hero .btn-brand {
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            padding: 10px 24px;
        }

        /* Center the navbar content vertically */
        .navbar .container {
            display: flex;
            align-items: center;
            min-height: 50px;  /* Set minimum height for consistency */
        }

        .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <!--Nav Bar-->
    <nav class="navbar navbar-expand-lg" style="background-color:orangered;">
        <div class="container">
            <a class="navbar-brand" style="color: white;" href="{{ url('/') }}">
                <h1 style="font-weight: bold; color: white;">UGrant</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('grant-projects.index') }}">
                                    <i class="fas fa-folder"></i> Research Grants
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('academicians.index') }}">
                                    <i class="fas fa-users"></i> Academicians
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('milestones.index') }}">
                                    <i class="fas fa-flag"></i> Milestones
                                </a>
                            </li>

                        @elseif(Auth::user()->role === 'academician')
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('academicians.index') }}">
                                    <i class="fas fa-users"></i> Academicians
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('milestones.index') }}">
                                    <i class="fas fa-flag"></i> Milestones
                                </a>
                            </li>

                        @elseif(Auth::user()->role === 'staff')
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('grant-projects.index') }}">
                                    <i class="fas fa-folder"></i> Grant Projects
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Side Navigation -->
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link" style="background: none; border: none; color: white;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!--Hero-->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-uppercase text-white fw-semibold display-1">Welcome to UGRANT</h1>
                    <h5 class="text-white mt-3 mb-4">ONE STOP GRANT CENTER</h5>
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-brand me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-light ms-2">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>