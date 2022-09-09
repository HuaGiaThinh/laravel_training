@extends('layouts.login-template')

@section('content')
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        @if (session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session()->get('error') }}
            </div>
        @endif
        @if (session('message'))
            {{ session('message') }}
        @endif

        <form action="{{ route('postLogin') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Password" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <button type="submit" class="btn btn-info btn-block">Sign In</button>
                <a href="{{ route('home') }}" class="btn btn-danger btn-block">Back To Home</a>
            </div>
        </form>
    </div>
@endsection
