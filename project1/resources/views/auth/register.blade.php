@extends('layouts.app')

@section('content')
<section class="section-padding bg-dark">
    <div class="container">    
        <div class="row justify-content-between align-item-center">
            <div class="col-lg-6">
                <img src="{{ asset('Images/about_us.jpg') }}" alt="about_us_image">
            </div>
            <div class="col-lg-5">    
                <form method="POST" action="{{ route('register') }}">
                    @csrf     
                    <div class="mb-md-3 mt-md-2 pb-3">
                        <h1 class="fw-bold mb-2 text-uppercase display-4 text-white">{{ __('Register') }}</h1>
                        <div class="line"></div>
                        <p class="text-white mb-5">{{ __('Create your account') }}</p>
                        
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="form-label text-left text-white" for="name">{{ __('Name:') }}</label>
                            <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="form-label text-left text-white" for="email">{{ __('Email:') }}</label>
                            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="form-label text-left text-white" for="password">{{ __('Password:') }}</label>
                            <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="form-label text-left text-white" for="password-confirm">{{ __('Confirm Password:') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button class="btn btn-brand btn-lg px-5" style="background-color: #FF4600; color: white;" type="submit">{{ __('Register') }}</button>
                    </div>
                    <div>
                        <p class="h6 text-white">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="text-brand fw-bold">{{ __('Login') }}</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    @import url("CSS/clash-display.css");

/*Variable*/
:root{
    --c-dark: #212529;
    --c-brand: #FF4600;
    --c-brand-light: #FB7C4C;
    --c-brand-rgb: 212, 135, 78;
    --c-body: #727272;
    --font-base: "ClashDisplay", sans-serif;
    --box-shadow: 0px 15px 25px rgba(0,0,0,0.08);
    --transition: all 0.5s ease;
}

/*reset & helpers*/
body{
    font-family: var(--font-base);
    line-height: 1.7;
    color: var(--c-body);
    word-spacing: 1.5px;
}

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6{
    font-weight: 600;
    color: var(--c-dark)
}

a{
    text-decoration: none;
    color: var(--c-brand);
    transition: var(--transition);
}

a:hover{
    color: var(--c-brand-light);
}

img {
    max-width: 100%;
    height: auto;
}

.section-padding{
    padding-top: 50px;
    padding-bottom: 50px;
    padding-left: 50px;
    padding-right: 50px;
}

.theme-shadow{
    box-shadow: var(--box-shadow);
}

p,
label{
    font-size: 15px;
}

.btn{
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    border-radius: 0;
    padding: 10px 24px;
}

.btn-brand{
    background-color: var(--c-brand);
    border-color: var(--c-brand);
    color: white;
}

.btn-brand:hover{
    background-color: var(--c-brand-light);
    border-color: var(--c-brand-light);
    color: white;
}

.line{
    width: 80px;
    height: 4px;
    background-color: var(--c-brand);
    margin: 16px 0px 24px 0px;
}
</style>
@endsection

<!--@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection-->
