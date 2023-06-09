<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title??'Dasboard'}}</title>
    <link href=' {{ asset('assets/css/crud.css')}} ' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('/lib/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/lib/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    @yield('head')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>
    <body id="page-top">
        <div id="wrapper">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                        <div class="sidebar-brand-text mx-3"><span style="font-size: 13px;">MYcompanystatus</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-light" id="accordionSidebar">
                        <div class="sidebar-heading">
                            Personal Data
                        </div>
                        @if($title == 'Home')
                        <li class="nav-item"><a class="nav-link active" href="{{ route('homePage') }}"><i class="far fa-user-circle"></i><span>Home</span></a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('homePage') }}"><i class="far fa-user-circle"></i><span>Home</span></a></li>
                        @endif
                        @if($title == 'Companies')
                        <li class="nav-item"><a class="nav-link active" href="{{ route('companies') }}"><i class="fas fa-building"></i><span>My Companies</span></a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('companies') }}"><i class="fas fa-building"></i><span>My Companies</span></a></li>
                        @endif
                        @if($title == 'Reports')
                        <!-- route reports with company_id and user_id -->
                        <li class="nav-item"><a class="nav-link active" href="{{ route('reports') }}"><i class="fas fa-chart-bar"></i><span>My Reports</span></a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports') }}"><i class="fas fa-chart-bar"></i><span>My Reports</span></a></li>
                        @endif
                        <hr class="sidebar-divider my-5">
                        <div class="sidebar-heading">
                            Public Data
                        </div>
                        @if($title == 'Public Reports')
                        <li class="nav-item"><a class="nav-link active" href="{{ route('publicReports') }}"><i class="fas fa-chart-bar"></i><span>Public Reports</span></a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('publicReports') }}"><i class="fas fa-chart-bar"></i><span>Public Reports</span></a></li>
                        @endif
                    </ul>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                </div>
            </nav>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>                            
                            @if($title == 'Reports')
                                <div class="navbar-collapse collapse ">
                                    <ul class="navbar-nav mr-auto ml-3 mt-2 mt-lg-0 w-100">
                                        <form id="company-form">
                                            @component('_components.formSelect',[
                                            'required' => true,
                                            'class' => '',
                                            'attributes' => 'ajax-url="/api/select/companies" fill:company_id|company_name',
                                            'name' => 'company_id',
                                            'placeholder' => 'Choose Your Company',
                                            'array' => [],
                                            'key' => 'id',
                                            'value' => 'title'
                                            ])
                                            @endcomponent
                                            <input type="submit" class="btn btn-primary" form="company-form" value="Go">
                                        </form>
                                        <div class="d-none d-sm-block topbar-divider"></div>
                                        <a id="download-excel" class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('download-excel') }}"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Excel</a>
                                    </ul>
                                </div>  
                            @endif
                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"> {{ $user->user_name ?? null}}</span><img class="border rounded-circle img-profile" id="profile-photo"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="container-fluid">    
                    @yield('body')
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © MyCompanyStatus
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            </span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
    </body>
    <script src="{{ asset('/lib/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('/lib/datatables/datatables.min.js') }}"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('/lib/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    
    <script> 
        // define toast options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "positionClass": "toast-bottom-right",
        "css": {
        "background-color": "green !important",
        "background-image": "none !important"
        }
    };

    // get user looged in
    let user = @json($user);
    
    // get user_id
    let user_id = user.user_id;


    // ajax request to get user data
    $.ajax({
        type: 'GET',
        data: {user_id: user_id},
        url: '{{ route('users.getPhoto') }}',
        success: function (data){
            console.log(data);
            let photo = data.photo;

            // Get element profile-photo
            let profilePhoto = document.getElementById('profile-photo');

            // Set the src attribute of the image to the photo using storage symlink to public folder in storage/app/public/profile-photos
            profilePhoto.setAttribute('src', '/storage/profile-photos/' + photo);

        },
        error: function (data){
            console.log(data);
        }
    });
    </script>
@yield('scripts')
</body>
</html>