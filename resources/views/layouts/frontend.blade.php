<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>Omnilegal</title>

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Favicon -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-XyGZ1AvwLhkdME9YyUw5o2qvWZt1Qo8h1FZZbGQUFdA+cS9bYOzCXh3n4gxQ3VnTZhKLG1rKcsEtTXCvC8Ybnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <div class="page-wrapper">

        <!-- preloader -->
<div class="loader-wrap">
  <div class="preloader">
    <div class="preloader-close">x</div>
    <div id="handle-preloader" class="handle-preloader">
      <div class="animation-preloader">

        <!-- loader hourglass dari Uiverse -->
        <div class="hourglassBackground">
          <div class="hourglassContainer">
            <div class="hourglassCurves"></div>
            <div class="hourglassCapTop"></div>
            <div class="hourglassGlassTop"></div>
            <div class="hourglassSand"></div>
            <div class="hourglassSandStream"></div>
            <div class="hourglassCapBottom"></div>
            <div class="hourglassGlass"></div>
          </div>
        </div>
        <!-- /loader hourglass -->

      </div>
    </div>
  </div>
</div>
<!-- preloader end -->


        <!-- header -->
        <header class="main-header header-style-one">

            <!-- Header Lower -->
            <div class="header-lower">
                <div class="container">
                    <div class="inner-container d-flex align-items-center justify-content-between">
                        <div class="header-left-column">
                            <div class="logo-box">
                                <div class="logo"><a href="{{ url('/') }}">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                 <span class="logo-text ms-2">OMNILEGAL</span>
                                </a></div>
                            </div>
                        </div>
                        <div class="header-center-column">
                            <div class="nav-outer">
                                <div class="mobile-nav-toggler"><img
                                        src="{{ asset('assets/images/icons/icon-bar.png') }}" alt="icon"></div>
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation">
                                            <li><a href="{{ locale_route('frontend.index') }}">{{ __('frontend.home') }}</a></li>
                                            <li><a href="{{ locale_route('frontend.service') }}">{{ __('frontend.services') }}</a></li>
                                            <li><a href="{{ locale_route('frontend.index') }}">{{ __('frontend.about') }}</a></li>
                                            <li><a href="{{ locale_route('frontend.index') }}">{{ __('frontend.news') }}</a></li>
                                            <li><a href="{{ locale_route('frontend.index') }}">{{ __('frontend.career') }}</a></li>
                                            <li><a href="{{ locale_route('frontend.index') }}">{{ __('frontend.contact') }}</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="header-right-column d-flex align-items-center">
                            <div class="header-right-btn-area">
                                {{-- Language Switch --}}
                                @include('layouts.partials.language-switch', ['context' => 'lower', 'type' => 'radio'])
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Header Lower -->

            <!-- sticky header -->
            <div class="sticky-header">
                <div class="header-upper">
                    <div class="container">
                        <div class="inner-container d-flex align-items-center justify-content-between">
                            <div class="left-column d-flex align-items-center">
                                <div class="logo-box">
                                    <div class="logo"><a href="{{ url('/') }}"><img
                                                src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                            <span class="logo-text ms-2">OMNILEGAL</span></a></div>
                                </div>
                            </div>

                            <div class="nav-outer gap-5 d-flex align-items-center">
                                <div class="mobile-nav-toggler"><img
                                        src="{{ asset('assets/images/icons/icon-bar.png') }}" alt="icon"></div>
                                <nav class="main-menu navbar-expand-md navbar-light"></nav>
                            </div>

                            <div class="header-right-column d-flex align-items-center">
                                <div class="header-right-btn-area">
                                    {{-- Language Switch for Sticky Header --}}
@include('layouts.partials.language-switch', ['context' => 'sticky', 'type' => 'radio'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sticky header -->

            <!-- mobile menu -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><span class="fal fa-times"></span></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="{{ url('/') }}"><img
                                src="{{ asset('assets/images/logo.png') }}" alt="logo"></a></div>
                    
                    {{-- Language Switch for Mobile Menu --}}
                    @include('layouts.partials.language-switch', ['context' => 'mobile', 'type' => 'dropdown'])
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                </nav>
            </div>

        </header>
        <!-- header -->


        @yield('content')

        <!-- Footer -->
<footer id="footer" class="main-footer py-5 border-top">
    <div class="container">
        <div class="row">

            <!-- Left Section -->
            <div class="col-lg-6 mb-4">
                <h3 class="fw-bold text-primary">{{ __('frontend.footer1') }}<br>{{ __('frontend.footer2') }}</h3>
                <p class="mt-3">{{ __('frontend.footer-caption') }}</p>

                <!-- Social Media -->
                <div class="mt-3">
                    @if($website && $website->instagram)
                        <a href="{{ $website->instagram }}" target="_blank" class="me-2">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    @endif
                    @if($website && $website->linkedin)
                        <a href="{{ $website->linkedin }}" target="_blank" class="me-2">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    @endif
                    @if($website && $website->facebook)
                        <a href="{{ $website->facebook }}" target="_blank" class="me-2">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                    @endif
                    @if($website && $website->x)
                        <a href="{{ $website->x }}" target="_blank" class="me-2">
                            <i class="fab fa-x-twitter fa-2x"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-lg-6 mb-4">
                <h4 class="fw-bold text-primary mb-3">{{ __('frontend.contact-us') }}</h4>
                <p class="mb-0">
    <i class="fas fa-paper-plane me-2 text-primary"></i>
    <a href="{{ locale_route('frontend.contact') }}" class="text-dark text-decoration-none">
        {{ __('frontend.send-message') }}
    </a>
</p>
<p class="mb-2">
    <i class="fas fa-phone me-2 text-primary"></i>
    <a href="tel:{{ $website->phone }}" class="text-dark text-decoration-none">
        {{ $website->phone ?? '-' }}
    </a>
</p>
<p class="mb-4">
    <i class="fas fa-envelope me-2 text-primary"></i>
    <a href="mailto:{{ $website->email }}" class="text-dark text-decoration-none">
        {{ $website->email }}
    </a>
</p>





                


                <h4 class="fw-bold text-primary mb-3">{{ __('frontend.visit-us') }}</h4>
                <p>
                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                    {{ $website->address }}
                </p>
            </div>

        </div>
    </div>
</footer>


        <!-- Copyright -->
        <div class="text-center border-top pt-3 mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} {{ $website->nama ?? 'Company' }} | All rights reserved</p>
        </div>
    </div>
</footer>


    </div>


    <!--Scroll to top-->
    <div class="scroll-to-top">
        <div>
            <div class="scroll-top-inner">
                <div class="scroll-bar">
                    <div class="bar-inner"></div>
                </div>
                <div class="scroll-bar-text">Go To Top</div>
            </div>
        </div>
    </div>
    <!-- Scroll to top end -->



    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr-min.js') }}"></script>
    <script src="{{ asset('assets/js/socialSharing.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    
    @stack('scripts')

</body>

</html>