<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Trang quản trị hệ thống</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"href="{{ asset('admin/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet"href="{{ asset('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"href="{{ asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    {{-- Thông báo Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- Thông báo Sweetalert (Xóa) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Validation --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>




</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ route('admin.home') }}">
                    <b class="logo-abbr"><img src="{{ asset('admin/images/logo.png') }}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ asset('admin/images/logo-compact.png') }}"
                            alt=""></span>
                    <span class="brand-title">
                        <img src="{{ asset('admin/images/logo-text.png') }}" alt="">
                    </span>
                </a href=>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
                                    class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard"
                            aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="{{ asset('admin/javascript:void(0)') }}" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>
                                    <a href="{{ asset('admin/javascript:void()') }}" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <img class="float-left mr-3 avatar-img"src="{{ asset('admin/images/avatar/1.jpg ') }}"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you
                                                        ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <img class="float-left mr-3 avatar-img"src="{{ asset('admin/images/avatar/2.jpg') }}"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <img class="float-left mr-3 avatar-img"src="{{ asset('admin/images/avatar/3.jpg') }}"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you
                                                        ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <img class="float-left mr-3 avatar-img"src="{{ asset('admin/images/avatar/4.jpg') }}"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <a href="{{ asset('admin/javascript:void(0)') }}" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                    <a href="{{ asset('admin/javascript:void()') }}" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <span class="username">
                                    <img src="{{ asset('admin/images/user/1.png') }}" height="40" width="40"
                                        alt="">
                                    {{-- @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif --}}
                                </span>
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i>
                                                <span>Name: {{ Auth::user()->name }}</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/app-profile.html') }}"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('admin/javascript:void()') }}">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li>

                                        <hr class="my-2">
                                        <li>
                                            <a href="{{ asset('admin/page-lock.html') }}"><i class="icon-lock"></i>
                                                <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.logout') }}"><i class="icon-key"></i>
                                                <span>Đăng xuất</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a class=""href="{{ route('admin.home') }}" aria-expanded="true">
                            <i class="icon-home"></i><span class="nav-text">Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-solid fa-bars"></i><span class="nav-text">Danh mục</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listCategory') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                            <li>
                                <a href="{{ route('admin.createCategory') }}" aria-expanded="false">
                                    <i class="icon-note menu-icon"></i>
                                    Thêm mới
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-solid fa-bars"></i><span class="nav-text">Thương hiệu</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listBrand') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                            <li>
                                <a href="{{ route('admin.createBrand') }}" aria-expanded="false">
                                    <i class="icon-note menu-icon"></i>
                                    Thêm mới
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-regular fa-database"></i><span class="nav-text">Sản phẩm</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listProduct') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                            <li>
                                <a href="{{ route('admin.createProduct') }}" aria-expanded="false">
                                    <i class="icon-note menu-icon"></i>
                                    Thêm mới
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-solid fa-truck"></i><span class="nav-text">Phí vận chuyển</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.delivery') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i><span class="nav-text">Đơn hàng</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{ route('admin.listOrders') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-sharp fa-solid fa-comment"></i><span class="nav-text">Bình luận</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listComment') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                        </ul>
                    </li>
                    {{-- Phân quyền nhìu role có thể truy cập (xem chi tiết Provider/BladeServiceProvider) --}}

                    {{-- @hasrole(['Admin', 'Author']) --}}
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-solid fa-user"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listUser') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách Users</a></li>
                            <li>
                            <li><a href="{{ route('admin.listRole') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh
                                    sách các vai trò</a></li>
                        </ul>
                    </li>
                    {{-- @endhasrole --}}
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-sharp fa-solid fa-sliders"></i><span class="nav-text">Slider</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('admin.listSlider') }}" aria-expanded="false"><i
                                        class="icon-notebook menu-icon"></i>Danh sách</a></li>
                            <li>
                                <a href="{{ route('admin.createSlider') }}" aria-expanded="false">
                                    <i class="icon-note menu-icon"></i>
                                    Thêm mới
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            @yield('contentMain')

            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by
                    <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                    2023
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/gleek.js') }}"></script>
    <script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('admin/js/delivery.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('admin/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('admin/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('admin/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
    {{-- ckeditor soạn mô tả nội dung --}}
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('desc-add-product');
        CKEDITOR.replace('content-add-product');
        CKEDITOR.replace('desc-edit-product');
        CKEDITOR.replace('content-edit-product');
    </script>
    {{-- Thông báo Toastr --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Bạn chắc chắn mún xóa chứ ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#productDataTable').DataTable();
        });
    </script>


</body>

</html>
