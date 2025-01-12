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
    <style>
    /*.card {
        transition: transform .2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }*/
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
<body>
    <nav class="navbar navbar-expand-lg" style="background-color:orangered;">
        <div class="container">
            <a class="navbar-brand" style="color: white;" href="{{ url('/') }}">
                <h1 style="font-weight: bold;">UGrant</h1>
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
                                <a class="nav-link" style="color: white;" href="{{ route('grant-projects.index') }}">
                                    <i class="fas fa-folder"></i> Research Grants
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

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
        @if(Auth::user()->role === 'admin')
            <!-- Admin Dashboard -->
            <div class="container-fluid">
                <h2 class="mb-4">Dashboard</h2>
                
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Projects</h5>
                                <p class="card-text display-4">{{ App\Models\GrantProject::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card text-white" style="background-color:orange;">
                            <div class="card-body">
                                <h5 class="card-title">Total Academicians</h5>
                                <p class="card-text display-4">{{ App\Models\User::where('role', 'academician')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Completed Milestones</h5>
                                <p class="card-text display-4">
                                    {{ App\Models\Milestone::where('status', 'completed')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">Pending Milestones</h5>
                                <p class="card-text display-4">
                                    {{ App\Models\Milestone::where('status', 'pending')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Divider line with spacing -->
            <div class="row mb-4">
                <div class="col-12">
                    <hr class="my-4" style="border-top: 2px solid black;">
                </div>
            </div>
        @endif
    @endauth

    @yield('content')
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>