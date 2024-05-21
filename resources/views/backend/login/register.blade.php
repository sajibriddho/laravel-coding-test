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
    <title>Coding Test | Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('assets/backend/images/Ghost.gif') }}" />
    <style>
        .login .login__panel .login__form .form__body .form-control {
            background-color: #fff;
            border-radius: 8px;
            padding: 5px 15px;
        }

        .login .login__panel .login__form .login__head {
            text-align: center;
            margin: 20px 0;
        }
    </style>
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
                                    <h3 class="m-0">Coding Test Laravel </h3>
                                    <p class="text-muted m-0">Create New User</p>
                                </div>
                                @if (session()->has('status'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"><i
                                            class="flaticon-cancel-12 close" data-dismiss="alert"></i>
                                        {{ session()->get('status') }}!
                                    </div>
                                @endif

                                <form action="{{ route('store_new_user') }}" method="post" class="form__body">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="">
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            autocomplete="off" class="form-control" placeholder="Enter User Name"
                                            required />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">
                                            Account Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="account_type" id="account_type" class="form-control" required>
                                            <option value="" selected disabled>Select Account Type</option>
                                            <option value="business"
                                                {{ old('account_type') == 'business' ? 'selected' : '' }}>Business
                                            </option>
                                            <option value="individual"
                                                {{ old('account_type') == 'individual' ? 'selected' : '' }}>Individual
                                            </option>
                                        </select>
                                        @error('account_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">
                                            Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            autocomplete="off" class="form-control" placeholder="Enter Email Address"
                                            required />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" name="password" class="form-control" id=""
                                            placeholder="Enter Password" required />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Confirm Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="" placeholder="Confirm Password" required />
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="custom__button btn__purple w-100 m-0">Sign Up</button>
                                </form>
                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}">Login</a>
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
