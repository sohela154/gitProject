<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title> Event Planner </title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <!-- add icon link -->
        <link rel = "icon" href ="{{asset('contents/admin/assets')}}/img/logo.jpeg" type = "image/x-icon">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/all.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/style.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/jquery.dataTables.min.css">
        <script src="{{asset('contents/admin/assets')}}/js/jquery-3.4.1.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <header>
            <div class="container-fluid header_container">
                <div class="row p-1 mb-2 header_row">
                    <div class="col-md-3 col-5"></div>

                    <div class="col-md-3 col-3"></div>
                    <div class="col-md-5 col-1"></div>

                    <div class="col-md-1 col-3">
                        @php
                            $photo = Auth::user()->photo;
                        @endphp
                        @if($photo!='')
                            <img src="{{asset('uploads/customer/'.$photo)}}" alt="User photo" class="rounded-circle img-fluid mx-auto d-block profile-img img-thumbnail" height="57px" width="57px">
                        @else
                            <img src="{{asset('contents/admin/assets')}}/img/avatar.png" alt="User photo" class="rounded-circle img-fluid mx-auto d-block profile-img img-thumbnail" height="57px" width="57px">
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <section class="content-section">
            <div class="container-fluid">

                <!-- dashboard -->
                <div class="row">
                    <!-- start sidebar menu -->
                    <div class="col-lg-2 col-md-12 p-3 mb-2 text-white side_bars">

                            <p class="dsb_text text-center">Dashboard</p>
                            <!-- <img src="{{asset('contents/admin/assets')}}/img/user_profile_photo.jpg" alt="User photo" class="rounded-circle img-fluid mx-auto d-block profile-img img-thumbnail" height="85px" width="85px"> -->

                            <h5 class="text-center dsb_sidebar_info">@php echo Auth::user()->name; @endphp</h5>

                            <!-- <h6 class="t                              next-center dsb_sidebar_info">User Role</h6> -->

                            <nav class="navbar navbar-expand-lg navbar-light"> <!-- responsive break point -->

                                <!-- icon & target for collapse -->

                                <div class="col-xl-12">

                                    <button type="button" class="navbar-toggler bg-light" data-toggle="collapse"
                                            data-target="#menus" > <!-- target id collapse -->
                                            <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="row menu">
                                        <!-- div for collapse with target id -->
                                        <div id="menus" class="collapse navbar-collapse sidevars">
                                            <ul>
                                                @php
                                                    $role_id = Auth::user()->role_id;
                                                @endphp
                                                @if($role_id=='1')
                                                <!-- start dropdown menu -->
                                                <li><a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-list"></i> Category </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu1">
                                                        <li><a href="{{ route('all_category') }}"> <i class="fas fa-list"></i> All Category </a></li>
                                                        <li><a href="{{ route('add_category') }}"> <i class="far fa-edit"></i> Add Category </a></li>
                                                    </ul>
                                                </li>

                                                <!-- start dropdown menu -->
                                                <li><a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-list"></i> Service </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu2">
                                                        <li><a href="{{ route('all_service') }}"> <i class="fas fa-list"></i> All Service </a></li>
                                                        <li><a href="{{ route('add_service') }}"> <i class="far fa-edit"></i> Add Service </a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ url('all/book/information') }}" class="menul"><i class="fas fa-users"></i> All Booking Info</a></li>
                                                @endif

                                                <!-- end dropdown menu -->
                                                @if($role_id=='2')
                                                <li><a href="{{ url('customer/book/information') }}" class="menul"><i class="fas fa-users"></i> My Booking Info</a></li>
                                                @endif
                                                <li><a href="{{url('/')}}"><i class="fas fa-globe-asia"></i> Website </a></li>

                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menul"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>


                                                <!-- Authentication -->

												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <!-- div end collapse -->
                        </nav>
                    </div>
                    <!-- end sidebar menu -->
                    <!-- start dashboard information/content section -->

                    <div class="col-lg-10 col-md-12 p-3 mb-2 bg-light text-dark" id="dashboard_section">
                        <div class="scrollable">
                        <!--data/content -->

                            @yield('contents')

                        </div>
                    </div>
                    <!-- end dashboard information/content section -->
                </div>
            </div>

        </section>
        <footer class="footer-section">
            <div class="container-fluid">

            </div>

        </footer>
        <!-- all js link -->
        <script src="{{asset('contents/admin/assets')}}/js/bootstrap.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/all.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/custom.js"></script>
        @yield('scripts')
    </body>
</html>