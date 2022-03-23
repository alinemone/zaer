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
                                <label for="family" class="col-md-4 col-form-label text-md-right">نام خانوادگی</label>
                                <input id="family" type="text" class="form-control @error('family') is-invalid @enderror" name="family" value="{{ old('family') }}" required autocomplete="family" autofocus>
                                @error('family')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="col-md-4 col-form-label text-md-right">نام </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="passport_number" class="col-md-12 col-form-label text-md-right">شماره پاسپورت</label>
                                <input id="passport_number" type="number" class="form-control @error('passport_number') is-invalid @enderror" name="passport_number" value="{{ old('passport_number') }}" required >
                                @error('passport_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="national_code" class="col-md-4 col-form-label text-md-right">کدملی</label>
                                <input id="national_code" type="number" class="form-control @error('national_code') is-invalid @enderror" name="national_code" value="{{ old('national_code') }}" required >
                                @error('national_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
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
                                <div class="form-group">
                                    <label class="col-md-4 col-form-label text-md-right">جنسیت</label>
                                    <select class="form-control" name="gender">
                                        <option value="{{\App\Enumerations\Gender::MALE}}">مرد</option>
                                        <option value="{{\App\Enumerations\Gender::FEMALE}}">زن</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">تاریخ تولد</label>
                                <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" required data-jdp>
                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="job" class="col-md-4 col-form-label text-md-right">شغل</label>
                                <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') }}" required  autofocus>
                                @error('job')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="degree" class="col-md-12 col-form-label text-md-right">تحصیلات</label>
                                <select class="form-control" name="degree">
                                    @foreach($degrees as $key => $degree)
                                        <option value="{{$key}}">{{$degree}}</option>
                                    @endforeach
                                </select>
                                @error('degree')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="col-md-12 col-form-label text-md-right">استان</label>
                                <select class="form-control" name="city">
                                    @foreach($provinces as $key => $province)
                                        <option value="{{$province}}">{{$key}}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="city" class="col-md-12 col-form-label text-md-right">کشور</label>
                                <select class="form-control" name="city">
                                    @foreach($countries as $key => $country)
                                        <option value="{{$country}}" @if($country == 118) selected @endif>{{$key}}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-md-10 col-form-label text-md-right">تکرار رمز عبور</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
