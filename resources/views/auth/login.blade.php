@extends('layouts.auth.app')
@section('styles')
    <style>
        .app{
            background-position: center center;
            background-size: cover;
        }
    </style>
@endsection
@section('content')
    <div class="container ">
        <div class="row min-vh-100">
            <div class="container container--mini d-flex justify-content-center align-items-center">
                <div class="login-form w-100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_login">شماره موبایل</label>
                            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"  value="{{ old('mobile') }}" required autofocus>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_pass">رمزعبور</label>

                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info mb-4 mt-4 w-100"
                                   value="ورود">
                        </div>

                    </form>
                    <p class="small text-center text-gray-soft">آیا حساب کاربری ندارید ؟ <a
                            href="/register">ایجاد حساب</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let images = ['1.jpg', '2.jpg', '3.jpg','4.jpg'];
        document.getElementsByClassName('app')[0].style.backgroundImage = 'url(' + "/images/background/" + images[Math.floor(Math.random() * images.length)] + ')';
    </script>
@endsection
