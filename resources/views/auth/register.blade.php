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
<div class="container">
    <div class="row justify-content-center text-right min-vh-100">
        <div class="col-md-10 d-flex justify-content-center align-items-center">
            <div class="card login-form w-100">
                <div class="card-body ">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name" class="col-md-4 col-form-label text-md-right">نام </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">موبایل</label>
                                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-md-10 col-form-label text-md-right">تکرار رمز عبور</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="small text-center text-gray-soft mt-4">حساب کاربری دارید؟ <a
                            href="/login">ورود به حساب</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let images = ['1.jpg', '2.jpg', '3.jpg','4.jpg'];
        document.getElementsByClassName('app')[0].style.backgroundImage = 'url(' + "/images/background/" + images[Math.floor(Math.random() * images.length)] + ')';


        jalaliDatepicker.startWatch([separatorChar = ","]);

        // separatorChar
    </script>
@endsection
