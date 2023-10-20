<!DOCTYPE html>

<html>



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Welcome To | Loyola</title>

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}">


    <link rel="shortcut icon" href="">

    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Core Css -->

    <link href="{{ asset('public/admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">



    <!-- Waves Effect Css -->

    <link href="{{ asset('public/admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />



    <!-- Animation Css -->

    <link href="{{ asset('public/admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />



    <!-- JQuery DataTable Css -->

    <link href="{{ asset('public/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">



    <!-- Custom Css -->

    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">



    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->

    <link href="{{ asset('public/admin/css/themes/all-themes.css') }}" rel="stylesheet" />

</head>



<body class="theme-red">

    <!-- Page Loader -->

    <!-- <div class="page-loader-wrapper">

        <div class="loader">

            <div class="preloader">

                <div class="spinner-layer pl-red">

                    <div class="circle-clipper left">

                        <div class="circle"></div>

                    </div>

                    <div class="circle-clipper right">

                        <div class="circle"></div>

                    </div>

                </div>

            </div>

            <p>Please wait...</p>

        </div>

    </div> -->

    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->

    <div class="overlay"></div>

    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->

    <div class="search-bar">

        <div class="search-icon">

            <i class="material-icons">search</i>

        </div>

        <input type="text" placeholder="START TYPING...">

        <div class="close-search">

            <i class="material-icons">close</i>

        </div>

    </div>

    <!-- #END# Search Bar -->

    <!-- Top Bar -->

    @php
        
        $user = \Session::get('admin');
        
        if (!empty($user)) {
            $email = DB::table('users')
                ->where('id', $user->id)
                ->first();
        } else {
            $email = '';
        }
        
    @endphp

    <nav class="navbar">


        <div class="container-fluid">

            <div class="navbar-header">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>

                <a href="javascript:void(0);" class="bars"></a>

             
                <div class="image">
                    
                 
                    <img src="{{ asset('public/images/company-icon.png') }}"
                        width="50" height="50" alt="User" />
                
                        <a class="navbar-brand" href="javascript:void(0)">{{ ucfirst($email->user_type) }}</a>
                </div>
                

            </div>



        </div>

    </nav>

    <!-- #Top Bar -->



    <section>

        <!-- Left Sidebar -->

        <aside id="leftsidebar" class="sidebar">

            <!-- User Info -->

            {{-- <div class="user-info">

                <div class="image">
                    
                 
                    <img src="{{ asset('public/images/company-icon.png') }}"
                        width="50" height="50" alt="User" />
                

                </div>

                <div class="info-container">

                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ ucfirst($email->name) }}</div>

                    <div class="email">{{ $email->email }}</div>

                    <div class="btn-group user-helper-dropdown">

                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">keyboard_arrow_down</i>

                        <ul class="dropdown-menu pull-right">

                            <li><a href="{{ route('admin.profile') }}"><i class="material-icons">person</i>Profile</a>
                            </li>

                    
                            <li role="separator" class="divider"></li>

                            <li><a href="{{ route('admin.logout') }}"><i class="material-icons">input</i>Sign Out</a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div> --}}

            <!-- #User Info -->

            <!-- Menu -->

            

            <div class="menu">

                <ul class="list">

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/home') }}">Dashboard</a></li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Signup Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/user/lists') }}">Lists</a></li>
                            
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">feedback</i>
                            <span>Feedbacks</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/user/feedbacks') }}">Feedback</a></li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">notifications</i>
                            <span>Notifications</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/user/notifications') }}">Notification</a></li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Survey Category</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/category') }}">Lists</a></li>
                            <li><a href="{{ url('admin/category/create') }}">Add Category</a></li>
                        </ul>

                    </li>

                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>Survey</span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/survey') }}">Survey Lists</a></li>
                            <li> <a href="{{ url('admin/survey/create') }}">Add Survey</a></li>
                            <li> <a href="{{ url('admin/survey/questions') }}">Question Lists</a></li>
                            <li> <a href="{{ url('admin/survey/options') }}">Option Lists</a></li>
                        </ul>

                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">mail</i>
                            <span>Email </span>
                        </a>
                        <ul class="ml-menu">
                            <li> <a href="{{ url('admin/user/send-email') }}">Send Email-Registered Users</a></li>
                            <li> <a href="{{ url('admin/user/send-email-user') }}">Send Email-Unregistered Users</a></li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>My Profile</span>
                        </a>
                        <ul class="ml-menu">
                            {{-- <li> <a href="{{ url('admin/home') }}">Profile</a></li> --}}
                            <li> <a href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>

                    </li>

                    

                    


                </ul>

            </div>

          

            <!-- #Footer -->

        </aside>

        <!-- #END# Left Sidebar -->

    </section>



    @yield('content')



    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>



    <!-- Bootstrap Core Js -->

    <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.js') }}"></script>



    <!-- Select Plugin Js -->





    <!-- Slimscroll Plugin Js -->

    <script src="{{ asset('public/admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>



    <!-- Waves Effect Plugin Js -->

    <script src="{{ asset('public/admin/plugins/node-waves/waves.js') }}"></script>



    <!-- Jquery DataTable Plugin Js -->

    <script src="{{ asset('public/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}">
    </script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>



    <!-- Custom Js -->

    <script src="{{ asset('public/admin/js/admin.js') }}"></script>

    <script src="{{ asset('public/admin/js/pages/tables/jquery-datatable.js') }}"></script>



    <!-- Demo Js -->

    <script src="{{ asset('public/admin/js/demo.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>

@include('admin.layout.admin_script')

</html>
