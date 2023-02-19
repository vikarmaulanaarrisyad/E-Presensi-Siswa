@extends('layouts.guest')

@section('title', 'Halaman Login')

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <img src="{{ asset('images/img/logo.jpg') }}" alt="img-logo" class="img-fluid" width="120"> <br>
            <a href="{{ route('login') }}" class="h2">{{ config('app.name') }}</a>
        </div>
        <div class="card-body">
            <p class="text-center">Silakan inputkan Username dan Password!</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control email  @error('email') is-invalid @enderror"
                        name="email" id="email" autocomplete="off" value="{{ old('email') }}"
                        placeholder="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control password" id="password"
                        placeholder="Password" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="form-checkbok" class="form-checkbok">
                            <label for="form-checkbok">
                                <p>Show Password</p>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <button onclick="submitForm(this.form)" class="btn btn-block btn-primary btn-login">
                        Login
                    </button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
