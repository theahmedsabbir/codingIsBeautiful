<header class="header home">
    <div class="header-top bg-primary text-uppercase">
        <div class="container">
            <div class="header-left">

        @php
            

            
            // session e kono code na thakle initially session e store koro, cookie set koro 
            if (Session::get('language_code') == null) {
                // Session::put('language_code', 'my');
                // setcookie('googtrans', null); 
                // setcookie('googtrans', '/en/my');       
            }else{
                
                // update cookie
                // setcookie('googtrans', null); 
                // setcookie('googtrans', '/en/' . Session::get('language_code'));
            } 

            // if(Session::has('language_code')){
            //     setcookie('googtrans', '/en/' . Session::get('language_code'));
            // }else{
            //     setcookie('googtrans', '/en/my');
            // }
        @endphp

                <div id="google_translate_element"></div>
                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                    <a href="#" class="pl-0"><i class="flag-{{Session::get('language_code') == 'en'? 'us'  :'mm'}} flag"></i>{{Session::get('language_code') == 'en'? 'ENG'  :'BUR'}}</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{ url('set-language/my') }}"><i class="flag-mm flag mr-2"></i>BUR</a></li>
                            <li><a href="{{ url('set-language/en') }}"><i class="flag-us flag mr-2"></i>ENG</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <div class="header-dropdown ml-3 pl-1">
                    <a href="#">MMK</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">MMK</a></li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto">
                <div class="header-dropdown dropdown-expanded mr-3">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            {{-- <li><a href="dashboard.html">My Account</a></li> --}}
                            <li><a href="demo1-contact.html">Contact Us</a></li>
                            {{-- <li><a href="wishlist.html">My Wishlist</a></li> --}}
                            <li><a href="{{ url('order/cart') }}">Cart</a></li>
                            @if (!Auth::check())
                                
                                <li><a href="{{ url('/login') }}" class="">Log In</a></li>

                            @else
                                
                                <li><a style="cursor: pointer" onclick="document.getElementById('logout').submit()" class="">Log Out</a></li>
                                <form action="{{ url('/logout') }}" id="logout" method="POST" class="d-none">
                                    @csrf
                                    
                                </form>


                            @endif
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <span class="separator"></span>

                <div class="social-icons">
                    <a href="#" class="social-icon social-facebook icon-facebook ml-0" target="_blank"></a>
                    <a href="#" class="social-icon social-twitter icon-twitter ml-0" target="_blank"></a>
                    <a href="#" class="social-icon social-instagram icon-instagram ml-0" target="_blank"></a>
                </div>
                <!-- End .social-icons -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-top -->

    <div class="header-middle text-dark sticky-header">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('frontend/') }}/assets/images/logo.png" width="111" height="44" alt="Porto Logo">
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max pl-2">
                <div class="header-search header-icon header-search-inline header-search-category w-lg-max">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="{{ url('products/all') }}" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" name="search" class="form-control" name="q" id="q" placeholder="Search..." required value="{{ Request::get('search') }}">
                            <div class="select-custom">
                                <select id="cat">
                                    <option value="">All Products</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-5 mr-xl-3 ml-5">
                    <i class="icon-phone-2"></i>
                    <h6 class="pt-1 line-height-1">Call us now<a href="tel:#" class="d-block text-dark ls-10 pt-1">+123 5678 890</a></h6>
                </div>
                <!-- End .header-contact -->

                <a href="{{ !Auth::check() ? url('/login') : url('/')  }}" class="header-icon header-icon-user"><i class="icon-user-2"></i></a>

                <a href="#" class="header-icon"><i class="icon-wishlist-2"></i></a>

                <div class="dropdown cart-dropdown">
                    <a href="{{ url('order/cart') }}" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">

                        @php
                            $cart_products_total = 0;
                            $cartProducts = App\Models\CartOrderProduct::where('type', 'cart')
                                                    ->where('user_ip', request()->ip())
                                                    ->get();
                            foreach ($cartProducts as $cartProduct) {
                                $cart_products_total += $cartProduct->qty;
                            }
                        @endphp

                        <i class="minicart-icon"></i>
                        <span class="cart-count badge-circle">{{ $cart_products_total }}</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            @php
                                $total = 0;
                            @endphp
                            <div class="dropdown-cart-products">

                                @foreach ($cartProducts as $cartProduct)
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            @if ($cartProduct->product)
                                            <a href="{{ url('products/details/' . $cartProduct->product->id) }}">{{ $cartProduct->product->name }}</a>
                                            @endif
                                        </h4>

                                        <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $cartProduct->qty }}</span> × MMK{{ $cartProduct->price }}
                                                </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="demo1-product.html" class="product-image">

                                            @if ($cartProduct->product && count(json_decode($cartProduct->product->images )) > 0)
                                                <img src="{{ asset('/products/' . json_decode($cartProduct->product->images )[0] ) }}" alt="product" width="80" height="80">
                                            @endif
                                        </a>

                                        <a href="{{ url('order/cart/remove/' . $cartProduct->id  ) }}" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>

                                @php
                                    $total += $cartProduct->total;
                                @endphp
                                @endforeach
                                <!-- End .product -->
                            </div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">MMK {{ $total }}</span>
                            </div>
                            <!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ url('order/cart') }}" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="{{ url('order/checkout') }}" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->
</header>
