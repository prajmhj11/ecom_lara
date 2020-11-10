@extends('layouts.ecom.layout')

@section('title', 'My Profile')

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')
    @component('layouts.ecom.components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Account</span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Profile</span>
    @endcomponent
    <div class="container">
        @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
        @endif
        <div class="row my-5">
            <div class="col-4 sidebar text-center text-md-left">
                <ul>
                    <li class="active"><a href="{{ route('users.edit') }}">My Profile</a></li>
                    <li><a href="{{route('orders.index')}}">My orders</a></li>
                </ul>

            </div> <!-- end sidebar -->
            <div class="col-8 my-2 border-left">
                <div class="my-profile-header d-flex flex-column flex-md-row justify-content-between mb-5 pb-2 border-bottom">
                    <h3 class="stylish-heading">My Profile</h3>
                </div>
                <div class="my-profile">
                    <form action="{{route('users.update')}}" method="post" autocomplete="off">
                        @csrf
                        @method('patch')
                        <div class="user-avatar text-center">
                            <img class="rounded-circle" src="{{Voyager::image($user->avatar)}}" alt="img">
                        </div>
                        <div class="user-name">
                            <i class="fas fa-user-alt input-icon"></i>
                            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="user-email">
                            <i class="fas fa-mail-bulk input-icon"></i>
                            <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" readonly autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="user-password">
                            <i class="fas fa-user-lock input-icon"></i>
                            <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span>Leave password blank to keep current password</span>
                        </div>
                        <div class="user-confirm">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autofocus autocomplete="new-password">
                        </div>

                        <div class="update-button">
                            <button type="submit" class="auth-button btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script type="text/javascript" src="{{asset('js/algolia.js')}}"></script>
@endsection
