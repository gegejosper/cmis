<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.name')}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/front.css') }}" rel="stylesheet" />
        <link href="{{asset('css/custom.css') }}" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @yield('scripts')
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0" style="min-height:94vh;">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container px-5">
                    <img src="{{asset('img/logo.png')}}" style="width:70px; margin:0px 10px;">
                    <a class="navbar-brand" href="/"> Providence Memorial Park</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item px-3"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item border-start px-3"><a class="nav-link" href="/about">About</a></li>
                        <li class="nav-item border-start px-3"><a class="nav-link" href="/contact">Contact</a></li>
                        <li class="nav-item border-start px-3"><a class="nav-link" href="/gallery">Gallery</a></li>
                        <li class="nav-item border-start px-3"><a class="nav-link" href="/gardens">Gardens</a></li>
                        <li class="nav-item border-start px-3"><a class="nav-link" href="/search">Search</a></li>

                        <!-- Logout button for authenticated users -->
                        @auth
                            <li class="nav-item px-3 border-start">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="nav-link"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span class="sb-nav-link-icon"><i class="fas fa-lock"></i></span>
                                        <span class="sb-nav-link-text">Logout</span>
                                    </a>
                                </form>
                            </li>
                        @endauth

                    </ul>
                    </div>
                </div>
            </nav>
            <!-- Header-->
            
            @yield('content_front')
        </main>
      
        <!-- Footer-->
        <footer class="bg-dark py-4">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; {{config('app.name')}}</div></div>
                    <!-- <div class="col-auto">
                        <a class="link-light small" href="#!">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        @yield('footer_scripts')
    </body>
</html>
