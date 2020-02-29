<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- dynamic title -->
    <title>{{$title}}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Summernote WYSIWYG -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

    <!-- my CSS -->
    <link href={{asset('css/main.css')}} rel="stylesheet">

    <script>

        // define basic URL
        var BASE_URL = "{{url('')}}";

    </script>

</head>

<body>

    <header>

        <!-- TOP NAVBAR -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm flex-nowrap">

            @if(Session::has('user_id'))
            <!-- toggler button -->
            <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#sideBar"
                aria-controls="sideBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endif

            <!-- logo -->
            <a class="navbar-brand pl-3 pl-lg-2" href="{{url('/')}}">
                <img src="{{url('img/asibuy-logo.png')}}" width="150" />
            </a>

            @if(Session::has('user_id'))
            <!-- nav -->
            <div class="ml-auto flex-grow-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('user/signout')}}"><span data-feather="log-out"></span><span
                                class="d-none d-lg-inline text-capitalize"> sign out</span></a>
                    </li>
                </ul>
            </div>
            @endif

        </nav>

    </header>

    <!-- CONTENT -->
    <div class="d-flex align-items-stretch">

        <!-- if user signed in -->
        @if(Session::has('user_id'))

        <!-- SIDEBAR -->
        <nav id="sideBar" class="sidebar collapse navbar-collapse d-lg-block bg-white pl-2 pr-3">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">

                    <!-- if user is admin -->
                    @if (session::get('user_role') == 'admin')
                    <li class="nav-item sidebar-headline text-uppercase my-1">
                        <span>admin</span>
                    </li>
                    <li class="nav-item text-capitalize">
                        <a class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}" href="{{url('admin/users')}}">
                            <span data-feather="user-check"></span>
                            users
                        </a>
                    </li>
                    @endif

                    <!-- menu -->
                    <li class="nav-item sidebar-headline text-uppercase my-1">
                        <span>menu</span>
                    </li>

                    <!-- dashboard -->
                    <li class="nav-item text-capitalize">
                        <a class="nav-link {{ (request()->is('/*')) ? 'active' : '' }}" href="{{url('/')}}">
                            <span data-feather="home"></span>
                            dashboard
                        </a>
                    </li>

                    <!-- customers -->
                    <li class="nav-item text-capitalize">
                        <a class="nav-link {{ (request()->is('customers*')) ? 'active' : '' }}"
                            href="{{url('customers')}}">
                            <span data-feather="users"></span>
                            customers
                        </a>
                    </li>

                    <!-- tickets -->
                    <li class="nav-item text-capitalize">
                        <a class="nav-link {{ (request()->is('tickets*')) ? 'active' : '' }}" href="{{url('tickets')}}">
                            <span data-feather="file-text"></span>
                            tickets
                        </a>
                    </li>

                </ul>

            </div>
        </nav>



        <!-- MAIN -->
        <main id="main" class="d-flex flex-fill flex-column px-3 px-lg-4 vw-100">

            <!-- Headline -->
            <div id="mainHeadline" class="pt-4 pt-lg-3 pb-2 my-3 border-bottom">
                <h3 class="page-headline text-capitalize">{{ $headline }}</h3>
            </div>

            <!-- View content -->
            <div id="mainContent" class="justify-content-center align-items-start">
                @yield('content')
            </div>

        </main>


        <!-- if user not signed in -->
        @else

        <!-- SIGNIN -->
        <main id="signinMain" class="d-flex flex-fill flex-column px-4">

            <!-- View sign in content -->
            <div class="d-flex justify-content-center mt-5 mt-lg-0">
                @yield('content')
            </div>

        </main>

        @endif

    </div>

    <!-- Spinner of ajax -->
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <!-- JQUERY Script -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Popper Script -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <!-- Feather Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

    <!-- Chart Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <!-- Sweetalert Script -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Summernote WYSIWYG Script -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript">

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 230,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['help']],
                ]
            });
        });

        @if(Session::has('errMsg'))
        var msg = '{{Session::get('errMsg')}}';
        swal(msg, '', "warning");
        @endif

        @if(Session::has('msg'))
        var msg = '{{Session::get('msg')}}';
        swal(msg, '', "success");
        @endif

    </script>

    <!-- my SCRIPTS -->
    <script src={{asset('js/scripts.js')}}></script>

</body>

</html>
