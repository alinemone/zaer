@section('title') ویرایش پذیریش  @endsection
@component('layouts.app')
    {{--    @dd(session()->get('errors'))--}}
    <div>
        <section class="content">

            <div class="row justify-content-center ">
                <div class="col-md-12 register-form">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش ثبت نام</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.reception.update') }}">
                            @csrf
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="national_code"
                                                       class="col col-form-label text-md-right">کدملی </label>
                                                <input id="national_code" type="text"
                                                       class="form-control @error('national_code') is-invalid @enderror"
                                                       name="national_code" value="{{ $reception->people->{\App\Models\People::NATIONAL_CODE} }}" >

                                                @error('national_code')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="name_family" class="col col-form-label text-md-right">نام و
                                                    نام خانوادگی </label>
                                                <input id="name_family" type="text"
                                                       class="form-control @error('name_family') is-invalid @enderror"
                                                       name="name_family"
                                                       value="{{ $reception->people->{\App\Models\People::NAME_FAMILY} }}" >
                                                @error('name_family')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="mobile"
                                                       class="col col-form-label text-md-right">موبایل</label>
                                                <input id="mobile" type="text"
                                                       class="form-control @error('mobile') is-invalid @enderror"
                                                       name="mobile"
                                                       value="{{ $reception->people->{\App\Models\People::MOBILE} }}">
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                            <div class="col-md-4">
                                                <label for="birthday" class="col col-form-label text-md-right">
                                                    تاریخ تولد
                                                </label>
                                                <input id="birthday" type="text"
                                                       class="form-control @error('birthday') is-invalid @enderror"
                                                       name="birthday" value="{{ $reception->people->{\App\Models\People::BIRTHDAY} }}" data-jdp>
                                                @error('birthday')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-md-4">
                                                <label for="job" class="col col-form-label text-md-right">شغل</label>
                                                <input id="job" type="text"
                                                       class="form-control @error('job') is-invalid @enderror"
                                                       name="job"
                                                       value="{{ $reception->people->{\App\Models\People::JOB} }}">
                                                @error('job')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="degree"
                                                       class="col-md-12 col-form-label text-md-right">تحصیلات</label>
                                                <select class="form-control" name="degree" id="degree">
                                                    @foreach($degrees as $key => $degree)

                                                        <option value="{{$key}}" @if($reception->people->degree == $key ) selected @endif>{{$degree}}</option>
                                                    @endforeach
                                                </select>
                                                @error('degree')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="how_to" class="col col-form-label text-md-right">
                                                    نحوه اشنایی
                                                </label>
                                                <input id="how_to" type="text"  value="{{ $reception->people->{\App\Models\People::HOW_TO} }}"
                                                       class="form-control @error('how_to') is-invalid @enderror"
                                                       name="how_to">
                                                @error('how_to')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>




                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4" style=" padding-top: 1.7%; ">
                                                <label for="city"
                                                       class="col  col-form-label text-md-right">کشور</label>
                                                <div class="form-check d-inline-flex align-items-start">
                                                    <input class="form-check-input ml-1" type="radio" id="iranRadio"
                                                           value="{{\App\Enumerations\Country::IRAN}}"
                                                           name="country" @if($reception->people->country == \App\Enumerations\Country::IRAN ) checked @endif
                                                           onclick="iranRadiofunc();">
                                                    <label class="form-check-label" for="inlineRadio1">ایران</label>
                                                </div>
                                                <div class="form-check d-inline-flex align-items-start">
                                                    <input class="form-check-input ml-1" type="radio" id="atbaRadio"
                                                           name="country" @if($reception->people->country != \App\Enumerations\Country::IRAN ) checked @endif
                                                           onclick="atbaRadiofunc();">
                                                    <label class="form-check-label" for="inlineRadio2">اتباع</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="selectProvince">
                                                <label for="city"
                                                       class="col-md-12 col-form-label text-md-right">استان</label>
                                                <select class="form-control" name="city" id="city" onchange="getcity(this.value)">
                                                    @foreach($provinces as $key => $province)
                                                        <option value="{{$province}}" @if($reception->people->province == $province) selected @endif>{{$key}}</option>
                                                    @endforeach
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4" id="selectTown">
                                                <label for="town"
                                                       class="col-md-12 col-form-label text-md-right">شهر</label>
                                                <select class="form-control" name="town" id="town" >
                                                </select>
                                                @error('town')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <div class="col-md-4 d-none" id="inputCountry">
                                                <label for="country" class="col col-form-label text-md-right">نام
                                                    کشور را
                                                    وارد کنید</label>
                                                <input id="country2" type="text"
                                                       class="form-control @error('country') is-invalid @enderror"
                                                       name="country"
                                                       value="{{ $reception->people->country != \App\Enumerations\Country::IRAN ? $reception->people->country :''}}">
                                                @error('country')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 d-none" id="inputCity">
                                                <label for="country" class="col-md-10 col-form-label text-md-right">نام
                                                    استان را
                                                    وارد کنید</label>
                                                <input id="city2" type="text"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       name="city"
                                                       value="{{$reception->people->country != \App\Enumerations\Country::IRAN ? $reception->people->province :'' }}">
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                            <div class="col-md-4 d-none" id="inputCity">
                                                <label for="country" class="col-md-10 col-form-label text-md-right">نام
                                                    شهر را
                                                    وارد کنید</label>
                                                <input id="town2" type="text"
                                                       class="form-control @error('town') is-invalid @enderror"
                                                       name="town"
                                                       value="{{$reception->people->country != \App\Enumerations\Country::IRAN ? $reception->people->city :''}}">
                                                @error('town')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                        </div>


                                    </div>

                                    <div class="col-md-12">
                                        <!-- general form elements -->
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">اطلاعات اقامتگاه</h3>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 pt-2">
                                                    <label for="start_at" class="col col-form-label text-md-right">
                                                        شروع اقامت
                                                    </label>
                                                    <input id="start_at" type="text"
                                                           class="form-control @error('start_at') is-invalid @enderror"
                                                           name="start_at"
                                                           value="{{$reception->start_at }}"
                                                           onchange="getPlacesByRoomByBeds('{{request()->gender}}')"
                                                           data-jdp>
                                                    @error('start_at')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 pt-2">
                                                    <label for="expired_at" class="col col-form-label text-md-right">
                                                        پایان اقامت
                                                    </label>
                                                    <input id="expired_at" type="text"
                                                           class="form-control @error('expired_at') is-invalid @enderror"
                                                           name="expired_at"
                                                           value="{{$reception->expired_at}}"
                                                           onchange="getPlacesByRoomByBeds('{{request()->gender}}')"

                                                           data-jdp>
                                                    @error('expired_at')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 pt-2">
                                                    <label for="place"
                                                           class="col-md-12 col-form-label text-md-right">اقامتگاه</label>
                                                    <select class="form-control" name="place" id="place"
                                                            onchange="getRooms(this);">
                                                        @foreach($places as  $place)
                                                            <option value="{{$place->id}}" @if($reception->place->id == $place->id ) selected @endif>{{$place->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('place')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>


                                                <div class="col-md-4 pt-2">
                                                    <label for="room"
                                                           class="col-md-12 col-form-label text-md-right">اتاق</label>
                                                    <select class="form-control" name="room" id="room"
                                                            onchange="getBeds(this);">
                                                        @if($places->first())
                                                            @foreach($places->first()->rooms as $room)
                                                                <option
                                                                    value="{{$room->id}}" @if($reception->room->id == $room->id ) selected @endif>{{$room->title . ' - طبقه ' .$room->floor}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('room')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 pt-2">
                                                    <label for="bed"
                                                           class="col-md-12 col-form-label text-md-right">تخت</label>
                                                    <select class="form-control" name="bed" id="bed">
                                                        @if($places->first() && $places->first()->rooms->first())
                                                            @foreach($places->first()->rooms->first()->beds as $bed)
                                                                <option
                                                                    value="{{$bed->id}}" @if($reception->bed->id == $bed->id ) selected @endif>{{$bed->bed_number}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('bed')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group pt-2 pr-2">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                ثبت نام
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
            </div>

        </section>
    </div>

    <script>

        function getPerson($national_code) {

            axios.get('/admin/people/' + $national_code)
                .then(res => {
                    const person = res.data

                    if (person.length === 0) {
                        alert('کاربری یافت نشد')
                        return true;
                    }

                    document.getElementById("personId").value = person["id"]
                    document.getElementById("name_family").value = person["name_family"]
                    document.getElementById("mobile").value = person["mobile"]
                    document.getElementById("birthday").value = person["birthday"]
                    document.getElementById('how_to').value = person["how_to"];
                    document.getElementById('job').value = person["job"];
                    document.getElementById('degree').value = person["degree"];
                    if (person["country"] == "1") {
                        document.getElementById('iranRadio').checked = true;
                        document.getElementById('city').value = person["city"];
                        iranRadiofunc()
                    } else {
                        document.getElementById('atbaRadio').checked = true;
                        document.getElementById('country2').value = person["country"];
                        document.getElementById('city2').value = person["city"];
                        atbaRadiofunc()
                    }
                })
                .catch(err => console.log(err));
        }


        jalaliDatepicker.startWatch()

        function iranRadiofunc() {
            document.getElementById('city').disabled = false;
            document.getElementById('inputCountry').classList.remove('d-block');
            document.getElementById('inputCountry').classList.add('d-none');
            document.getElementById('country2').disabled = true;
            document.getElementById('inputCity').classList.remove('d-block');
            document.getElementById('inputCity').classList.add('d-none');
            document.getElementById('city2').disabled = true;
            document.getElementById('town2').disabled = true;
            document.getElementById('town').disabled = false;
        }

        // selectProvince
        function atbaRadiofunc() {
            document.getElementById('city').disabled = true;
            document.getElementById('town').disabled = true;
            document.getElementById('country2').disabled = false;
            document.getElementById('city2').disabled = false;
            document.getElementById('town2').disabled = false;
            document.getElementById('inputCountry').classList.remove('d-none');
            document.getElementById('inputCity').classList.remove('d-none');
            document.getElementById('inputCountry').classList.add('d-block');
        }


        function setValue() {
            document.getElementById('country2').disabled = true
            document.getElementById('city2').disabled = true;
            document.getElementById('town2').disabled = true;
            getcity({{$reception->people->province}},{{$reception->people->city}})
        }

        window.onload = setValue();


        function getRooms(sel) {
            axios.get('/admin/place/' + sel.value + '/rooms')
                .then(res => {
                    const rooms = res.data
                    $('#room').find('option').remove();
                    for (var key of rooms) {
                        $('#room').append(`<option value="${key['id']}">${key['title'] + ' - طبقه ' + key['floor']}</option>`);
                    }
                    getBeds({'value': document.getElementById('room').value})
                })
                .catch(err => console.log(err));
        }

        function getBeds(sel) {
            axios.get('/admin/place/room/' + sel.value + '/beds', {
                params: {
                    start_at: document.getElementById('start_at').value,
                    expired_at: document.getElementById('expired_at').value
                }
            })
                .then(res => {
                    const beds = res.data
                    $('#bed').find('option').remove();
                    for (var key of beds) {
                        $('#bed').append(`<option value="${key['id']}" >${key['bed_number']}</option>`);
                    }
                })
                .catch(err => console.log(err));
        }

        function getPlacesByRoomByBeds(sel) {
            axios.post('/admin/reception/get_free_beds/' + sel, {
                start_at: document.getElementById('start_at').value,
                expired_at: document.getElementById('expired_at').value
            })
                .then(res => {
                    const places = res.data
                    $('#place').find('option').remove();
                    $('#room').find('option').remove();
                    $('#bed').find('option').remove();

                    for (var place of places) {
                        $('#place').append(`<option value="${place['id']}">${place['name']}</option>`);
                    }

                    for (var room of places[0]['rooms']) {
                        $('#room').append(`<option value="${room['id']}">${room['title'] + ' - طبقه ' + room['floor']}</option>`);
                    }

                    for (var bed of places[0]['rooms'][0]['beds']) {

                        $('#bed').append(`<option value="${bed['id']}">${bed['bed_number']}</option>`);
                    }
                })
                .catch(err => console.log(err));
        }

        function getcity(sel,town) {
            axios.get('/province/'+sel+'/cities')
                .then(res => {
                    const towns = res.data
                    $('#town').find('option').remove();
                    for (const [key, value] of Object.entries(towns)) {
                        $('#town').append(`<option value="${value}" ${value === town ? 'selected' :''}>${key}</option>`);
                    }
                })
                .catch(err => console.log(err));
        }

    </script>
@endcomponent

