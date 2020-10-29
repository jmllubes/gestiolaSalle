
<html>
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
    <body>
        <div class="container-fluid">
            <img src="{{asset('images/LaSalle_logo.jpg')}}" style="width: 128px; height: 128px;"/>
            <br>
            <strong>Data: </strong><?= date('d/m/Y - H:i:s', strtotime(date('Y/m/d H:i:s', time()))) ?>
            <main class="py-2">
                @yield('content')
            </main>
        </div>
    </body>
</html>
