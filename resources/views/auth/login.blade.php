<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>La Salle - Iniciar sessió</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!--  <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/app.css"> -->
        <!-- Styles -->
    </head>
    <body style="background-color: #EDEDED;">
        <div class="w3-container w3-center w3-animate-zoom">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl- col-lg-12 col-md-9" style="max-width: 500px;">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-3 d-none d-lg-block"></div>
                                <div class="col-lg-12">
                                    <div class="mt-3">
                                        <img src="{{asset('svg/logo-salle-mollerussa.png')}}" style="height: 64px; justify-content: center;">
                                    </div>
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">@lang('log.title')</h1>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=@lang('log.email')>                                                
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>@lang('auth.failed')</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="@lang('log.pass')">                                       
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>@lang('auth.failed')}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <div class="form-check">
                                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="custom-control-label" for="remember">
                                                            @lang('log.record')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">             
                                                <input type="submit" value="@lang('log.button')" class="btn btn-primary btn-user btn-block"/>
                                                <hr>
                                                @if (Route::has('password.request'))
                                                <a class="small" href="{{ route('reset') }}">
                                                    @lang('log.forgot_pass')
                                                </a>
                                                @endif
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>