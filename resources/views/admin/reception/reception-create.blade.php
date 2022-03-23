@section('title') پذیریش  @endsection
@component('layouts.app')
    {{--    @dd(session()->get('errors'))--}}
    <div>
        <section class="content">

            <div class="row justify-content-center ">
                <div class="col-md-12 register-form">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">پیش ثبت نام</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.reception.allocatedToPerson',[request()->gender,'type' => request()->type??1]) }}">
                            @csrf

                            <input type="hidden" name="person_id" id="personId" value="{{old('person_id')}}">


                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="national_code"
                                                       class="col col-form-label text-md-right">کدملی </label>
                                                <input id="national_code" type="text"
                                                       onfocusout="return getPerson(document.getElementById('national_code').value)"
                                                       class="form-control @error('national_code') is-invalid @enderror"
                                                       name="national_code" value="{{ old('national_code') }}" required>

                                                @error('national_code')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>



                                            @if(request()->type == 2)


                                                    <div class="col-md-4">
                                                        <label for="referrer_user" class="col col-form-label text-md-right">
                                                            آیدی معرف
                                                        </label>
                                                        <input id="referrer_user" type="text"  value="{{old('referrer_user')}}"
                                                               class="form-control @error('referrer_user') is-invalid @enderror"
                                                               name="referrer_user">
                                                        @error('referrer_user')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>



                                            @endif


                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="name_family" class="col col-form-label text-md-right">نام و
                                                    نام خانوادگی </label>
                                                <input id="name_family" type="text"
                                                       class="form-control @error('name_family') is-invalid @enderror"
                                                       name="name_family"
                                                       value="{{ old('name_family') }}" required>
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
                                                       value="{{ old('mobile') }}">
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
                                                       name="birthday" value="{{old('birthday')}}" data-jdp>
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
                                                       value="{{ old('job') }}">
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
                                                        <option value="{{$key}}">{{$degree}}</option>
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
                                                <input id="how_to" type="text"  value="{{old('how_to')}}"
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
                                                           name="country" checked
                                                           onclick="iranRadiofunc();">
                                                    <label class="form-check-label" for="inlineRadio1">ایران</label>
                                                </div>
                                                <div class="form-check d-inline-flex align-items-start">
                                                    <input class="form-check-input ml-1" type="radio" id="atbaRadio"
                                                           name="country"
                                                           onclick="atbaRadiofunc();">
                                                    <label class="form-check-label" for="inlineRadio2">اتباع</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4" id="selectProvince">
                                                <label for="city"
                                                       class="col-md-12 col-form-label text-md-right">استان</label>
                                                <select class="form-control" name="province" id="province" onchange="getcity(this.value)">
                                                    @foreach($provinces as $key => $province)
                                                        <option value="{{$province}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                                @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4" id="selectTown">
                                                <label for="city"
                                                       class="col-md-12 col-form-label text-md-right">شهر</label>
                                                <select class="form-control" name="city" id="city" >
                                                </select>
                                                @error('city')
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
                                                       value="{{ old('country') }}">
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
                                                       value="{{ old('city') }}">
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
                                                       value="{{ old('town') }}">
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
                                                           value="{{old('start_at') ?:jdate()->format('Y/m/d') }}"
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
                                                            <option value="{{$place->id}}">{{$place->name}}</option>
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
                                                                    value="{{$room->id}}">{{$room->title . ' - طبقه ' .$room->floor}}</option>
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
                                                                    value="{{$bed->id}}">{{$bed->bed_number}}</option>
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
                                               @if(request()->type??1 == 2) پذیریش @else  ثبت نام @endif
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

            let person_route = '/admin/people/' + $national_code

            if ({{request()->type ?? 1}} == 2){
                person_route = '/admin/servant/' + $national_code
            }

            axios.get(person_route)
                .then(res => {
                    const person = res.data

                    if (person.length === 0) {
                        alert('کاربری یافت نشد')
                        return true;
                    }

                    if (person['receptiveInLastMonthAgo']) {
                        alert('این شخص یکبار پذیرش شده است.')
                    }

                    document.getElementById("personId").value = person["id"]
                    document.getElementById("name_family").value = person["name_family"]
                    document.getElementById("mobile").value = person["mobile"]
                    document.getElementById("birthday").value = person["birthday"]
                    document.getElementById('how_to').value = person["how_to"];
                    document.getElementById('job').value = person["job"];
                    document.getElementById('degree').value = person["degree"];
                    if (person["country"] === "1") {
                        document.getElementById('iranRadio').checked = true;
                        document.getElementById('city').value = person["province"];
                        getcity(person["province"])
                        setInterval(function () {
                            document.getElementById('province').value = person["province"];
                        }, 500);
                        iranRadiofunc()
                    } else {
                        document.getElementById('atbaRadio').checked = true;
                        document.getElementById('country2').value = person["country"];
                        document.getElementById('city2').value = person["city"];
                        atbaRadiofunc()
                    }
                })
                .catch(err => {

                    if (err.response.status === 404){
                        if ({{request()->type ?? 1}} === 2){
                            alert('خادم یافت نشد ابتدا در قسمت ثبت نام خادم اطلاعات را وارد کنید.')
                        }else{
                            alert('کاربری یافت نشد')
                        }
                        return true;
                    }
                    // console.log(err);
                });
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
            getcity(1)
            getdate()
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

        function getcity(sel) {

            axios.get('/province/'+sel+'/cities')
                .then(res => {
                    const towns = res.data
                    $('#city').find('option').remove();
                    for (const [key, value] of Object.entries(towns)) {
                        $('#city').append(`<option value="${value}">${key}</option>`);
                    }
                })
                .catch(err => console.log(err));
        }


        function getdate(){

            if ({{request()->type ?? 1}} == 2){
                document.getElementById('expired_at').value = '{{jdate()->addDays(getSetting('servant_capacity'))->format('Y/m/d')}}'
            }else{
                document.getElementById('expired_at').value = '{{jdate()->addDays(getSetting('days_reserve'))->format('Y/m/d')}}'
            }



        }

    </script>
@endcomponent

