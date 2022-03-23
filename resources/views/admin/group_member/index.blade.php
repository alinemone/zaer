@section('title') اعضای کاروان  @endsection
@component('layouts.app')
    <div>
        <section class="col-lg-12 col-md-12 pt-2">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">ورود اعضای کاروان</h3>
                    <a href="{{asset('/files/sample.xlsx')}}" target="_blank">نمونه اکسل</a>

                    <!-- tools box -->
                    <div class="pull-left box-tools">

                        <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body" style="">
                    <form role="form" action="{{route('admin.group.member.store',request()->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="box-body">
                            <div class="row">
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName">فایل اکسل اعضا</label>
                                        <input type="file" class="form-control"
                                               name="exel" value="{{old('exel')}}">
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group" id="div_select_country">
                                        <label>کشور</label>
                                        <select class="form-control" name="country" id="select_country"
                                                onchange="country_change(this.value)">
                                            <option value="{{\App\Enumerations\Country::IRAN}}" selected>ایران</option>
                                        </select>
                                    </div>

                                    <div class="form-group" style="display:none" id="div_input_country">
                                        <label>کشور</label>
                                        <input type="text" id="input_country" class="form-control"
                                               name="country" value="{{old('country')}}" disabled>
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group" id="div_select_province">
                                        <label>استان</label>
                                        <select class="form-control" id="select_province" name="province"
                                                onchange="getCity(this.value)">
                                            @foreach ($provinces as $province => $key)
                                                <option value="{{$key}}">{{$province}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="div_input_province" style="display:none">
                                        <label>استان</label>
                                        <input type="text" id="input_province" class="form-control"
                                               name="province" value="{{old('province')}}" disabled>
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group" id="div_select_city">
                                        <label>شهر</label>
                                        <select class="form-control" id="select_city" name="city">
                                        </select>
                                    </div>

                                    <div class="form-group" id="div_input_city" style="display:none">
                                        <label>شهر</label>
                                        <input type="text" id="input_city" class="form-control"
                                               name="city" value="{{old('city')}}" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">ثبت اعضا</button>
                            <button type="button" class="btn bg-info btn-sm "
                                    id="button_country" style="display:none;"
                                    onclick="country_change(1)">
                                رفرش کشور
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">اعضا</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>موبایل</th>
                                    <th>کد ملی</th>
                                    <th>جنسیت</th>
                                    <th>وضعیت ترخیص</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </tr>

                                @forelse($qroupMemeber as $memeber)

                                    <tr>
                                        <td>{{$memeber->id}}</td>
                                        <td>{{$memeber->people->name_family}}</td>
                                        <td>{{$memeber->people->mobile}}</td>
                                        <td>{{$memeber->people->national_code}}</td>
                                        <td>@if($memeber->people->gender == 1) مرد @else زن @endif</td>
                                        <td>
                                            @if(isset($memeber->people->allocatedBed->id))
                                                <a href="{{route('admin.reception.cart',$memeber->people->allocatedBed->id)}}"
                                                   class="text-dark confirm_release">
                                                    <span class="text-success">پذیرش شده</span>
                                                </a>
                                            @else
                                                <span class="text-warning">عدم پذیرش</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <form method="POST" action="#">
                                                    @csrf
                                                    <a class="text-dark confirm_release" title="حذف عضو"
                                                       type="submit"><i
                                                            class="ion-android-delete h5"></i></a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="row">
                        {{--                        <div class="col-md-12">--}}
                        {{--                            <div--}}
                        {{--                                class="d-flex justify-content-center">{{$groups->links('vendor.pagination.bootstrap-4')}}</div>--}}
                        {{--                        </div>--}}
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>

@endcomponent

<script>

    function setValue() {
        getCity(1)
    }

    window.onload = setValue();


    function country_change(id) {

        let div_select_country = document.getElementById('div_select_country')
        let select_country = document.getElementById('select_country')
        let div_input_country = document.getElementById('div_input_country')
        let input_country = document.getElementById('input_country')
        let button_country = document.getElementById('button_country')


        let div_select_province = document.getElementById('div_select_province')
        let select_province = document.getElementById('select_province')
        let div_input_province = document.getElementById('div_input_province')
        let input_province = document.getElementById('input_province')


        let div_select_city = document.getElementById('div_select_city')
        let select_city = document.getElementById('select_city')
        let div_input_city = document.getElementById('div_input_city')
        let input_city = document.getElementById('input_city')


        if (id == 2) {

            div_select_country.style.display = "none";
            div_input_country.style.display = "block";
            button_country.style.display = "inline-flex";
            select_country.disabled = true;
            input_country.disabled = false;

            div_select_province.style.display = "none";
            div_input_province.style.display = "block";
            select_province.disabled = true;
            input_province.disabled = false;

            div_select_city.style.display = "none";
            div_input_city.style.display = "block";
            select_city.disabled = true;
            input_city.disabled = false;


        } else {
            div_select_city.style.display = "block";
            div_input_city.style.display = "none";
            select_city.disabled = false;
            input_city.disabled = true;

            div_select_province.style.display = "block";
            div_input_province.style.display = "none";
            select_province.disabled = false;
            input_province.disabled = true;

            div_select_country.style.display = "block";
            div_input_country.style.display = "none";
            button_country.style.display = "none";
            select_country.disabled = false;
            input_country.disabled = true;
            select_country.value = 1
        }

    }

    function getCity(sel) {

        axios.get('/province/' + sel + '/cities')
            .then(res => {
                const city = res.data
                $('#select_city').find('option').remove();
                for (const [key, value] of Object.entries(city)) {
                    $('#select_city').append(`<option value="${value}">${key}</option>`);
                }
            })
            .catch(err => console.log(err));
    }
</script>
