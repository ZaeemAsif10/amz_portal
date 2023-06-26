@extends('setup.login_master')

@section('login_content')
    <div class="account-content">
        <div class="container">
            <!-- /Account Logo -->
            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Please Login First</p>

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Error !</strong> {{ session('error') }}
                        </div>
                    @endif

                    <!-- Account Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                                {{-- <div class="col-auto">
                                <a class="text-muted" href="forgot-password.html">
                                    Forgot password?
                                </a>
                            </div> --}}
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                        {{-- <div class="account-footer">
                        <p>Don't have an account yet? <a href="register.html">Register</a></p>
                    </div> --}}
                    </form>
                    <!-- /Account Form -->

                </div>
            </div>
        </div>
    </div>
@endsection
