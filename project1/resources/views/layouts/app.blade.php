<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UGrant - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color:orangered;">
        <div class="container">
            <a class="navbar-brand" style="color: white;" href="{{ url('/') }}">UGrant</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">

                <!--@auth
                @if(Auth::user()->userCategory == 'Admin')

                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ route('students.index') }}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ route('lecturers.index') }}">Lecturers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ route('subjects.index') }}">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ route('assessments.index') }}">Assessments</a>
                    </li>

                @elseif(Auth::user()->userCategory == 'Lecturer')

                    <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('subjects.index') }}">My Subjects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('assessments.create') }}">Create Assessment</a>
                            </li>

                @elseif(Auth::user()->userCategory == 'Student')

                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('subjects.index') }}">My Subjects</a>
                            </li>

                @endif
                @endauth

                @guest

                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('register') }}">Register</a>
                        </li>

                @else
                
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                @endguest-->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!--@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif-->

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Common form for displaying validation errors -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif