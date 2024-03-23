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
                    <nav>
                        @if (Auth::user())
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
                        @else
                            <!-- unauth -->
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

                                <!-- categories **show conditionally** -->
                                {{-- <li class="nav_label">
                                    <h6 class="">Categories</h6>
                                </li>
                                <li class=""><a href="index.html" title="">Home</a></li>
                                <li class=""><a href="index.html" title="">Laravel</a></li>
                                <li class=""><a href="index.html" title="">Javascript</a></li>
                                <li class=""><a href="index.html" title="">Php</a></li>
                                <li class=""><a href="index.html" title="">React</a></li> --}}


                                <!-- others **show conditionally** -->
                                {{-- <li class="nav_label">
                                <h6 class="">Others</h6>
                            </li>
                            <li class=""><a href="index.html" title="">About</a></li>
                            <li class=""><a href="index.html" title="">Contact</a></li>
                            <li class="">
                                <div class="category_link_socials_list">
                                    <a href="" class="category_link_socials">
                                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                    </a>
                                    <a href="" class="category_link_socials">
                                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                    </a>
                                    <a href="" class="category_link_socials">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                    <a href="" class="category_link_socials">
                                        <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    </a>
                                    <a href="" class="category_link_socials">
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li> --}}

                            </ul>
                        @endif
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>
