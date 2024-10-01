<div>
    <nav class="sb-topnav navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
        <div class="px-4 d-flex w-100 justify-content-start">
            <div class="">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <strong>GKE</strong> Sinta Kuala Kapuas
                </a>

                <button class="btn btn-link btn-md order-1 order-lg-0 fs-5" id="sidebarToggle" href="#!"
                    style="color: #404040;"><i class="bi bi-list "></i></button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                   
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <p class="fs-6 my-auto">{{ Auth::user()->name }}</p>
                            
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>
