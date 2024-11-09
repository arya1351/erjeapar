<title>Login Monitoring RJ Apar</title>
@extends('layouts.guest')

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <divalign-items-center
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex  justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png " width="180"
                                        alt="">
                                </a>
                                <h5 class="text-center fw-bolder">Monitoring Apar</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        <label for="emaillabel" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        <label for="passwordlabel" class="form-label">{{ __('Password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password" required
                                            autocomplete="current-password">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" name="remember"
                                                value="" id="remember_me" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                {{ __('Remember me') }}
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="">Forgot Password ?</a>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </divalign-items-center>
    </div>
@endsection
