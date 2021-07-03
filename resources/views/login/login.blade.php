
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>Login | Kasir Application</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" />
        <meta name="author" />
        <link rel="shortcut icon" href="{{asset('login/assets/images/favicon.ico')}}">
        <link href="{{asset('login/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="{{asset('login/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('login/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    </head>
    <body style="background-color: #43a7f9">
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to Kasir Application.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{asset('login/assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    <a href="#" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('login/assets/images/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>

                                    <a href="#" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('login/assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                <div class="p-2">
                                    <form class="form-horizontal" action="{{ url('admin/postlogin') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" @if(old('email')) value="{{ old('email') }}" @else value="" @endif autofocus>
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" autocomplete="current-password">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            {!! NoCaptcha::renderJs() !!}
                                            
                                            {!! NoCaptcha::display() !!}
                                            {{-- {!! NoCaptcha::renderJs() !!} --}}
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="remember" type="checkbox" id="remember-check" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember-check">
                                                Remember Me
                                            </label>
                                        </div>
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>© <script>document.write(new Date().getFullYear())</script> Crafted with <i class="mdi mdi-heart text-danger"></i> by RizkyDev</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('login/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('login/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('login/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('login/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('login/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('login/assets/js/app.js')}}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove();
                    });
                }, 2000);
            });    
        </script>
    </body>
</html>
