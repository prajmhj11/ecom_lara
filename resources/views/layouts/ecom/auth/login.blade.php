@extends('layouts.ecom.layout')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="left-auth">
            <h3>Returning Customer</h3>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="login-email">
                    <i class="fas fa-user-alt input-icon"></i>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="login-password">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror"  placeholder="Password" required autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="login-container">
                    <button type="submit" class="auth-button btn btn-dark">Login</button>
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') }} ? 'checked' : '' >
                        <label class="form-check-label">
                        Remember Me
                        </label>
                    </div>
                </div>

                <a href="{{route('password.request')}}">
                    Forgot Your Password?
                </a>

            </form>
        </div>
        <div class="right-auth">
            <h3>New Customer</h3>
            <p><strong>Save time later</strong></p>
            <p>Create an account for checkout and easy access to order history.</p>
            <a href="{{route('register')}}" class="btn btn-light">Create Account</a>
        </div>
    </div>
</div>
@endsection
