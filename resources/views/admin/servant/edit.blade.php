@component('layouts.app')
{{--    @role('admin')--}}
    <div>
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش خادم</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.servant.update',$servant->id) }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="family" class="col col-form-label text-md-right"> نام و نام
                                            خانوادگی</label>
                                        <input id="name_family" type="text"
                                               class="form-control @error('name_family') is-invalid @enderror" name="name_family"
                                               value="{{ $servant->name_family }}" required autofocus>
                                        @error('name_family')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="national_code"
                                               class="col-md-4 col-form-label text-md-right">کدملی</label>
                                        <input id="national_code" type="number"
                                               class="form-control @error('national_code') is-invalid @enderror"
                                               name="national_code" value="{{$servant->national_code }}" required>
                                        @error('national_code')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mobile" class="col-md-4 col-form-label text-md-right">موبایل</label>
                                        <input id="mobile" type="number"
                                               class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                               value="{{ $servant->mobile  }}" required autocomplete="mobile">
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="col-md-12 col-form-label text-md-right">تلفن اضطراری</label>
                                        <input id="phone" type="number"
                                               class="form-control @error('mobile') is-invalid @enderror" name="phone"
                                               value="{{ $servant->phone }}" required >
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12 col-form-label text-md-right">جنسیت</label>
                                            <select class="form-control" name="gender">
                                                <option value="{{\App\Enumerations\Gender::MALE}}" @if($servant->gender == 1) selected @endif>مرد</option>
                                                <option value="{{\App\Enumerations\Gender::FEMALE}}" @if($servant->gender == 2) selected @endif>زن</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthday" class="col-md-4 col-form-label text-md-right">
                                            تاریخ تولد
                                        </label>
                                        <input id="birthday" type="text"
                                               class="form-control @error('birthday') is-invalid @enderror"
                                               name="birthday" value="{{$servant->birthday}}" required data-jdp>
                                        @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="job" class="col-md-4 col-form-label text-md-right">شغل</label>
                                        <input id="job" type="text"
                                               class="form-control @error('job') is-invalid @enderror" name="job"
                                               value="{{ $servant->job}}" required autofocus>
                                        @error('job')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="degree"
                                               class="col-md-12 col-form-label text-md-right">تحصیلات</label>
                                        <select class="form-control" name="degree">
                                            @foreach($degrees as $key => $degree)
                                                <option value="{{$key}}" @if($servant->degree == $key) selected @endif>{{$degree}}</option>
                                            @endforeach
                                        </select>
                                        @error('degree')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="how_to" class="col-md-4 col-form-label text-md-right">
                                            نحوه اشنایی
                                        </label>
                                        <textarea type="text"
                                                  class="form-control @error('how_to') is-invalid @enderror"
                                                  name="how_to">{{ $servant->how_to }}</textarea>
                                        @error('how_to')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="start_at" class="col-md-12 col-form-label text-md-right">شروع اقامت</label>
                                        <input id="start_at" type="text"
                                               class="form-control @error('start_at') is-invalid @enderror" name="start_at"
                                               value="{{ jdate($servant->start_at)->format('Y/m/d')  }}" data-jdp>
                                        @error('start_at')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="expired_at" class="col-md-12 col-form-label text-md-right"> پایان اقامت </label>
                                        <input id="expired_at" type="text"
                                               class="form-control @error('expired_at') is-invalid @enderror" name="expired_at"
                                               value="{{ jdate($servant->expired_at)->format('Y/m/d') }}" data-jdp>
                                        @error('expired_at')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="referrer_user" class="col-md-12 col-form-label text-md-right">شماره موبایل معرف</label>
                                        <input id="referrer_user" type="text"
                                               class="form-control @error('referrer_user') is-invalid @enderror" name="referrer_user"
                                               value="{{ $servant->referrer_user }}">
                                        @error('referrer_user')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="workplace" class="col-md-12 col-form-label text-md-right">محل فعالیت خادم</label>
                                        <input id="workplace" type="text"
                                               class="form-control @error('workplace') is-invalid @enderror" name="workplace"
                                               value="{{ $servant->workplace }}" >
                                        @error('workplace')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="quota" class="col-md-12 col-form-label text-md-right"> تعداد سهم </label>
                                        <input id="quota" type="text"
                                               class="form-control @error('quota') is-invalid @enderror" name="quota"
                                               value="{{ $servant->quota  }}" >
                                        @error('quota')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>






                                </div>


                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label for="city" class="col-md-12 col-form-label text-md-right">کشور</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="iranRadio" value="{{\App\Enumerations\Country::IRAN}}" name="country" checked
                                                   onclick="iranRadiofunc();">
                                            <label class="form-check-label" for="inlineRadio1">ایران</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="atbaRadio" name="country"
                                                   onclick="atbaRadiofunc();">
                                            <label class="form-check-label" for="inlineRadio2">اتباع</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="selectProvince">
                                        <label for="province" class="col-md-12 col-form-label text-md-right">استان</label>
                                        <select class="form-control" name="province" id="province" onchange="getcity(this.value)">
                                            @foreach($provinces as $key => $province)
                                                <option value="{{$province}}" @if($servant->province == $province) selected @endif>{{$key}}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4" id="selectcity">
                                        <label for="city" class="col-md-12 col-form-label text-md-right">شهر</label>
                                        <select class="form-control" name="city" id="city">

                                        </select>
                                        @error('town')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="form-group row" id="atba">

                                    <div class="col-md-4 d-none" id="inputCountry">
                                        <label for="country2" class="col-md-10 col-form-label text-md-right">نام کشور را وارد کنید</label>
                                        <input id="country2" type="text"
                                               class="form-control @error('country') is-invalid @enderror" name="country"
                                               value="{{ $servant->country}}">
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 d-none" id="inputCity">
                                        <label for="city2" class="col-md-10 col-form-label text-md-right">نام استان را وارد کنید</label>
                                        <input id="city2" type="text"
                                               class="form-control @error('city') is-invalid @enderror" name="city"
                                               value="{{ $servant->province }}">
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 d-none" id="inputTown">
                                        <label for="town2" class="col-md-10 col-form-label text-md-right">نام شهر را وارد کنید</label>
                                        <input id="town2" type="text"
                                               class="form-control @error('town') is-invalid @enderror" name="town"
                                               value="{{ $servant->city }}">
                                        @error('town')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            ویرایش
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
            <!-- /.row -->
        </section>
    </div>
{{--    @else--}}
{{--        {{abort(403)}}--}}
{{--    @endhasrole--}}
    @endcomponent

    <script>
        jalaliDatepicker.startWatch()


        function iranRadiofunc(){
            document.getElementById('province').disabled = false;
            document.getElementById('city').disabled = false;
            document.getElementById('inputCountry').classList.remove('d-block');
            document.getElementById('inputCountry').classList.add('d-none');
            document.getElementById('country2').disabled = true;
            document.getElementById('town2').disabled = true;
            document.getElementById('inputCity').classList.remove('d-block');
            document.getElementById('inputCity').classList.add('d-none');
            document.getElementById('city2').disabled = true;
            document.getElementById('town2').disabled = true;
            document.getElementById('inputTown').classList.remove('d-block');
            document.getElementById('inputTown').classList.add('d-none');

        }
        // selectProvince
        function atbaRadiofunc() {
            document.getElementById('province').disabled = true;
            document.getElementById('city').disabled = true;
            document.getElementById('country2').disabled = false;
            document.getElementById('city2').disabled = false;
            document.getElementById('town2').disabled = false;
            document.getElementById('inputCountry').classList.remove('d-none');
            document.getElementById('inputCity').classList.remove('d-none');
            document.getElementById('inputTown').classList.remove('d-none');
            document.getElementById('inputCountry').classList.add('d-block');

        }

        function getcity(sel) {

            axios.get('/province/'+sel+'/cities')
                .then(res => {
                    const towns = res.data
                    $('#city').find('option').remove();
                    for (const [key, value] of Object.entries(towns))  {
                        $('#city').append(`<option value="${value}">${key}</option>`);
                    }
                    var option = document.getElementById('city').value = {{$servant->city}}

                })
                .catch(err => console.log(err));
        }


        function setValue(){
            document.getElementById('country2').disabled = true
            document.getElementById('city2').disabled = true;
            document.getElementById('town2').disabled = true;
            getcity({{$servant->province}})
        }

        window.onload = setValue();
    </script>

