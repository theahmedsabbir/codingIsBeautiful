<header>
    <div class="container">
        <div class="row">

            <!-- logo -->
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 pl-0">

                <!-- mobile -->
                <div class="menu-btn d-block d-xl-none">
                    <a href="#" title="" class="d-inline-block pt-0"><i class="fa fa-bars"></i></a>
                    <a href="index.html d-inline-block d-xl-none" title="" class="logo_sm">
                        <img src="{{ asset('frontend') }}/images/logo_sm.png" alt=""
                            class="d-block d-xl-none logo_img_sm" id="logo_img_sm">
                    </a>
                </div>

                <!-- desktop -->

                <div class="logo d-none d-xl-block">
                    <a href="{{ route('root') }}" title="" class="logo_link">
                        <img src="{{ asset('frontend') }}/images/logo.png" alt=""
                            class="d-none d-xl-block logo_img" id="logo_img">
                    </a>
                </div><!--logo end-->

            </div>

            <!-- search bar -->
            <div class="col-md-3 pl-0">
                <div class="search-bar d-none d-md-block">
                    <form action="{{ url('/') }}">
                        <input type="text" name="search" value="{{ request()->search }}" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div><!--search-bar end-->

            <!-- nav -->
            <div class="col-md-6 pr-0">
                <div class="nav_parent">
                    @if (Auth::user())
                        {{-- auth desktop --}}
                        <nav class="d-none d-xl-block nav_desktop">
                            <!-- auth -->
                            <ul>
                                <li class="create_account">
                                    <a href="index.html" title=""
                                        onclick="event.preventDefault(); document.getElementById('logout').submit()">
                                        Logout
                                    </a>
                                    <form action="{{ route('logout') }}" class="d-none" method="post" id="logout">
                                        @csrf</form>
                                </li>
                                <li class="blue_heighlight">
                                    <a href="{{ route('dashboard') }}" title="" class="">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <a title="" class="d-inline d-xl-none close_nav"
                                        onclick="document.querySelector('.nav_parent nav').classList.remove('active')">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                </li>
                            </ul>
                        </nav>

                        {{-- auth mobile --}}
                        <nav class="d-block d-xl-none nav_mobile">
                            <!-- auth -->
                            <ul>
                                <li class="">
                                    <a href="{{ route('dashboard') }}" title="" class="">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <a title="" class="d-inline d-xl-none close_nav"
                                        onclick="document.querySelector('.nav_parent nav.nav_mobile').classList.remove('active')">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="create_account">
                                    <a href="index.html" title=""
                                        onclick="event.preventDefault(); document.getElementById('logout').submit()">
                                        Logout
                                    </a>
                                    <form action="{{ route('logout') }}" class="d-none" method="post" id="logout">
                                        @csrf</form>
                                </li>


                                @include('frontend.includes.navMobileGeneral')
                            </ul>
                        </nav>
                    @else
                        <!-- unauth desktop -->
                        <nav class="d-none d-xl-block nav_desktop">
                            <ul>
                                <li>
                                    <a href="{{ url('login') }}" title="">
                                        Login
                                    </a>
                                    <a title="" class="d-inline d-xl-none close_nav"
                                        onclick="document.querySelector('.nav_parent nav').classList.remove('active')">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="blue_heighlight">
                                    <a href="{{ route('register') }}" title="">
                                        Create account
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        {{-- unauth mobile --}}
                        <nav class="d-block d-xl-none nav_mobile">
                            <ul>
                                <li>
                                    <a href="{{ url('login') }}" title="">
                                        Login
                                    </a>
                                    <a title="" class="d-inline d-xl-none close_nav"
                                        onclick="document.querySelector('.nav_parent nav.nav_mobile').classList.remove('active')">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('register') }}" title="">
                                        Create account
                                    </a>
                                </li>

                                @include('frontend.includes.navMobileGeneral')

                            </ul>
                        </nav>
                    @endif

                </div>
            </div>
        </div>
    </div>
</header>
