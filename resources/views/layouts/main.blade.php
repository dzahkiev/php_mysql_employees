<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', '') }}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
          src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a 
                            class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('index') }}"
                        >
                            Departments & Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a 
                            class="nav-link {{ Request::is('department*') ? 'active' : '' }}"
                            href="{{ route('department_list') }}"
                        >
                            Departments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a 
                            class="nav-link {{ Request::is('employee*') ? 'active' : '' }}"
                            href="{{ route('employee_list') }}"
                        >
                            Employees
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>