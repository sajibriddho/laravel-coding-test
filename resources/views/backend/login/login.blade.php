<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/backend/custom/login.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/backend/core/css/adminlte.min.css') }}">
    <title>Coding Test | Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('assets/backend/images/Ghost.gif') }}" />

</head>

<body>
    <div class="login">
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="login__panel shadow-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftside__image">
                                <img src="{{ URL::asset('assets/backend/images/login_bg-4.jpg') }}" class="img-fluid"
                                    alt="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login__form">
                                <div class="login__head">
                                    <img src="{{ URL::asset('assets/backend/images/Ghost.gif') }}" class=""
                                        alt="" />
                                    <h3 class="m-0">Coding Test Laravel </h3>
                                    <p class="text-muted m-0">Welcome</p>
                                </div>
                                @if (session()->has('status'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"><i
                                            class="flaticon-cancel-12 close" data-dismiss="alert"></i>
                                        {{ session()->get('status') }}!
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"><i
                                            class="flaticon-cancel-12 close" data-dismiss="alert"></i>
                                        {{ session()->get('success') }}!
                                    </div>
                                @endif

                                <form action="{{ route('login') }}" method="post" class="form__body">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" autocomplete="off" class="form-control"
                                            placeholder="Enter Email Address" required />
                                        @error('email')
                                            <div class="text-danger font-weight-bold">{{ $message }}!</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Your Password" required />
                                        @error('password')
                                            <div class="text-danger font-weight-bold">{{ $message }}!</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="custom__button btn__purple w-100 m-0">Sign In</button>
                                </form>
                                <div class="text-center pt-3">
                                    <a href="{{ route('create_user') }}" class=""><strong>Create New
                                            User</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
