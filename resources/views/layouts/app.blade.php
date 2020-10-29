<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!--  <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/table-sorting.css') }}" type="text/css">
        <!-- Bootstrap core JavaScript-->
        <script href="{{ asset('jquery/jquery.min.js') }}"></script>
        <script href="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script href="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script href="{{ asset('js/sb-admin-2.js') }}"></script>
        <script href="{{ asset('js/chart.js/Chart.js') }}"></script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <!-- Datepicker -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" type='text/css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                    <div class="sidebar-brand-text mx-3"><img src="{{asset('svg/logo-salle-mollerussa.png')}}" style="height: 60px;margin-top: 20px;margin-bottom: 20px;"></div>
                </a>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Inici</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <!-- Nav Item - Pages Collapse Menu -->
                @if (Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseUsers">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>@lang('log.user')</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('createuser')}}">
                                <i class="fa fa-user-plus mr-2" aria-hidden="true"> </i>
                                @lang('log.create_user')
                            </a>
                            <a class="collapse-item" href="{{url('modifyuser')}}">
                                <i class="fas fa-user-edit mr-2" aria-hidden="true"></i>
                                @lang('log.modificate_user')
                            </a>
                        </div>
                    </div>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        <span>@lang('log.incidence')</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('/incidence')}}">
                                <i class="fa fa-file mr-2" aria-hidden="true"></i>
                                @lang('log.create_incidence_button')
                            </a>
                            <a class="collapse-item" href="{{url('my-incidences')}}">@lang('log.my_incidences')</a>
                            <a class="collapse-item" href="{{url('show-incidences')}}">@lang('log.edit_incidence')</a>
                            @if (Auth::user()->isAdmin() || Auth::user()->hasRols() > 0)
                            <a class="collapse-item" href="{{url('searchIncidences')}}">Buscar incidències</a>
                            @endif
                        </div>
                    </div>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    @if (Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{url('category')}}">
                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                        <span>Categories</span>
                    </a>
                </li>
                @endif
                <!-- Divider -->
                <hr class="sidebar-divider">
            </ul>
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    <!-- style="background-color: #04339f" -->
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" id="topBar">
                        <!-- Sidebar Toggle (Topbar) -->

                        <!-- Topbar Search -->

                        <!-- URL translations
                        
                        <div class="input-group">
                            <ul class="navbar-nav mr-auto">  
                                <li class="nav-item ml-2">
                                    <a class="nav-link text-white" href="locale/ca"><img src="{{asset('svg/country_images/catalonia_flag.png')}}" style="height: 12px;"><span class='ml-2'>Català</span></a>
                                </li>
                                <li class="nav-item ml-2">
                                    <a class="nav-link text-white" href="locale/es"><img src="{{asset('svg/country_images/spain_flag.png')}}" style="height: 12px;"><span class='ml-2'>Español</span></a>
                                </li>
                                <li class="nav-item ml-2">
                                    <a class="nav-link text-white" href="locale/en"><img src="{{asset('svg/country_images/united_kingdom.png')}}" style="height: 12px;"><span class='ml-2'>English</span></a>
                                </li> 
                            </ul>
                        </div>
                        -->

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow mr-2" onclick="markAsRead()">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-bell fa-lg"></i>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span id="numberNotifications" class="badge badge-light mb-4">{{auth()->user()->unreadNotifications->count()}}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="notificationDropdown">
                                    <a class="p-3 mb-1 mt-3" style="font-weight: bold">
                                        Notificacions
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <div class="overflow-auto" style="width: 400; height: 300;">
                                        @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a class="dropdown-item mb-1" style="font-weight: bold; color: lightgray">
                                            NOVES
                                        </a>
                                        @endif
                                        @foreach(auth()->user()->unreadNotifications as $notification)
                                        <div>
                                            <a class="dropdown-item" href="<?= $notification->data['url'] ?>">
                                                <i class="far fa-file-alt fa-sm fa-fw mr-2"></i>
                                                {{$notification->data['data']}}
                                                <br>
                                                <div class="form-row ml-4">
                                                    <span>Categoria: </span>
                                                    <span class="ml-1">{{$notification->data['category']}}</span>
                                                </div>
                                                <span class="text-gray-500 ml-4" style="font-weight: bold"><?= date('d/m/Y - H:i', strtotime($notification->created_at)) ?></span>
                                            </a>
                                        </div>
                                        @endforeach
                                        @if(auth()->user()->readNotifications->count() > 0)
                                        <a class="dropdown-item mb-1 mt-3" style="font-weight: bold; color: lightgray">
                                            ANTERIORS
                                        </a>
                                        @endif
                                        @foreach(auth()->user()->readNotifications as $notification)
                                        <a class="dropdown-item" href="<?= $notification->data['url'] ?>">
                                            <i class="far fa-file-alt fa-sm fa-fw mr-2"></i>
                                            {{$notification->data['data']}}
                                            <br>
                                            <div class="form-row ml-4">
                                                <span>Categoria: </span>
                                                <span class="ml-1">{{$notification->data['category']}}</span>
                                            </div>
                                            <span class="text-gray-500 ml-4" style="font-weight: bold"><?= date('d/m/Y - H:i', strtotime($notification->created_at)) ?></span>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle" src="{{asset('images/profile/default_m.jpg')}}">
                                    <span class="mr-2 ml-3 d-none d-lg-inline text-gray-600 text-white">{{ Auth::user()->username}}</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{url('/profile')}}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('log.profile')
                                    </a>
                                    <!--    <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            @lang('log.setting')
                                        </a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('log.session')
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid">
                        <main class="py-2">
                            @yield('content')
                        </main>
                    </div>
                    <!-- End of Main Content -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; La Salle Mollerussa - 2020</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('log.ready_logout')</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">@lang('log.log_out')</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('log.cancel')</button>
                            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">@lang('log.session')</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function markAsRead() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: '<?= url('markNotifications') ?>',
                    success: function (data) {
                        $('#numberNotifications').hide();

                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        </script>
    </body>
</html>