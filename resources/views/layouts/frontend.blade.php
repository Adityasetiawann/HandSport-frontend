<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HANDSPORT</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('frontend/img/logohs.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{ route('keranjang') }}"><i class="fa fa-shopping-bag"></i> </a></li>
            </ul>
            {{-- <div class="header__cart__price"> --}}
                
                <div class="header__top__right__auth">
                    @if(Session::has('access_token'))
                        <a href="#">
                            <i class="fa fa-user"></i> {{ Session::get('user_name') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fa fa-user"></i> Login
                        </a>
                    @endif
                </div>
                </div>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ route('shop.index') }}">Home</a></li>
                <li><a href="{{ route('shop.index') }}">Halaman</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('keranjang') }}">Keranjang</a></li>
                    <li><a href="{{ route('jersey') }}">Jersey</a></li>
                    <li><a href="{{ route('celana') }}">Celana</a></li>
                    <li><a href="{{ route('sepatu') }}">Sepatu</a></li>
                </ul>
                <li style="margin-top: 15px;">
                    <!-- Tombol Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       style="
                           display: block;
                           text-align: center;
                           padding: 10px;
                           background-color: #ff4d4d;
                           color: white;
                           border-radius: 5px;
                           font-weight: bold;
                           text-transform: uppercase;
                           letter-spacing: 1px;
                           transition: background-color 0.3s ease;
                       ">
                        Logout
                    </a>
                </li>
               
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
        </div>
        <div class="humberger__menu__contact">
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right" style="display: flex; align-items: center; justify-content: flex-end;">
                            <!-- Social icon with margin to separate from auth section -->
                            <div class="header__top__right__social" style="margin-right: 20px;">
                                <a href="#"><i class="fa fa-instagram" style="color: #000; font-size: 1.2em; padding: 10px; background-color: #f1f1f1; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s;"></i></a>
                            </div>
                            <div class="header__top__right__auth" style="display: flex; align-items: center;">
                                @if(Session::has('access_token'))
                                    <div class="header__user__auth" style="display: flex; align-items: center; position: relative;">
                                        <!-- Username with styling -->
                                        <a class="user-name" onclick="toggleDropdown(event)" style="display: flex; align-items: center; padding: 10px 15px; background-color: #343434; color: white; border-radius: 25px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s; margin-right: 10px; cursor: pointer;">
                                            <i class="fa fa-user" style="margin-right: 5px;"></i> 
                                            {{ Session::get('user_name') }}
                                        </a>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownMenu" style="display: none; position: absolute; top: 45px; right: 0; background-color: #343434; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 1;">
                                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                                @csrf
                                                <button type="submit" style="background: #5e5e5e; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s; width: 100%;">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <!-- Login button styling -->
                                    <a href="{{ route('login') }}" style="display: flex; align-items: center; padding: 10px 15px; background-color: #4CAF50; color: white; border-radius: 25px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s;">
                                        <i class="fa fa-user" style="margin-right: 5px;"></i> Login
                                    </a>
                                @endif
    
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleDropdown(event) {
                event.stopPropagation();
                var dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            }
        
            window.onclick = function(event) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        </script>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('shop.index') }}"><img src="{{ asset('frontend/img/logohs.png') }}" alt="" style="width: 150px; height: auto;"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ route('shop.index') }}">Home</a></li>
                            <li><a href="{{ route('jersey') }}">Jersey</a></li>
                            <li><a href="{{ route('celana') }}">Celana</a></li>
                            <li><a href="{{ route('sepatu') }}">Sepatu</a></li>
                       
                                    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{ route('keranjang') }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div> 
                    </div>
                </div>
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="{{ route('search.product') }}" method="GET">
                                    <input type="text" name="nama_barang" placeholder="What do you need?">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    @yield('content')

      <!-- Footer Section Begin -->
      <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('frontend/img/logohs.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Jl. Dr. Sutomo No.154</li>
                            <li>Kota Pontianak, Kalimantan Barat 78113</li>

                        </ul>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('frontend/img/payment-item.png') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>



</body>

</html> 