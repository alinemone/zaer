@section('title') گزارش گیری  @endsection

@component('layouts.app')
    <div>
        <section class="content-header d-flex">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">فیلتر</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="get">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{request('name')}}"  name="name" placeholder="نام و نام خانوادگی">
                            </div>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{request('mobile')}}"  name="mobile" placeholder="شماره موبایل">
                            </div>


                        </div>


                            <div class="form-group">
                                <div class="col-sm-4">
                                    <select class="form-control" name="country" id="country" onchange="disableProvinceCity(this.value)">
                                        <option value="" {{request('country') == "" ? 'selected' :''}} ></option>
                                        <option value="1" {{request('country') == "1" ? 'selected' :''}}>ایران</option>
                                        <option value="2" {{request('country') == "2" ? 'selected' :''}}>اتباع</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <select class="form-control" name="province" id="province" onchange="getcitis(this.value)">
                                        <option key=""></option>
                                        @foreach($provinces as $province =>$key)
                                        <option value="{{$key}}" {{request('province') == $key ? 'selected' :''}}>{{$province}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <select class="form-control" name="city" id="city">
                                    </select>
                                </div>

                            </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                <select class="form-control" name="place" id="place"  onchange="getRooms(this);">
                                    <option key=""></option>
                                    @foreach($places as $place )
                                        <option value="{{$place->id}}" {{request('place') == "" ? 'selected' :''}}>{{$place->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <select class="form-control" name="room" id="room" onchange="getallBeds(this);">

                                </select>
                            </div>

                            <div class="col-sm-4">
                                <select class="form-control" name="bed" id="bed" >

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="{{request('start_at')}}" data-jdp name="start_at" placeholder="شروع اقامت">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="{{request('expired_at')}}" data-jdp name="expired_at" placeholder="پایان اقامت">
                            </div>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{request('birthday')}}" data-jdp name="birthday" placeholder="تاریخ تولد">
                            </div>

                            <div class="col-sm-4">
                                <select class="form-control" name="degree" id="degree">
                                    <option key=""></option>
                                    @foreach($degrees as $key => $degree )
                                        <option value="{{$key}}" {{request('degree') == $key ? 'selected' :''}}>{{$degree}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">فیلتر</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">گزارشات</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>کشور</th>
                                    <th>استان</th>
                                    <th>شهر</th>
                                    <th>اقامتگاه</th>
                                    <th>اتاق</th>
                                    <th>تخت</th>
                                    <th>تاریخ تولد</th>
                                    <th>شروع اقامت</th>
                                    <th>پایان اقامت</th>
                                    <th>تحصیلات</th>
                                </tr>
                                @foreach($allocated as $allocate)
                                    <tr>
                                        @if($allocate->people_type == "App\Models\People")
                                        <td>{{$allocate->name_family}}</td>
                                        <th>{{$allocate->country == 1 ? 'ایران' : 'اتباع'}}</th>
                                        <th>{{ getProvinceCity($allocate->province)}}</th>
                                        <th>{{ getProvinceCity($allocate->city)}}</th>
                                        <td>{{$allocate->name}}</td>
                                        <td>{{$allocate->room_title}}</td>
                                        <td>{{$allocate->bed_number}}</td>
                                        <td>{{jdate($allocate->birthday)->format('Y/m/d')}}</td>
                                        <td>{{$allocate->start_at}}</td>
                                        <td>{{$allocate->expired_at}}</td>
                                        <th>{{getTitleDegree($allocate->degree)}}</th>
                                        @else
                                        <td>{{$allocate->s_name_family}}</td>
                                        <th>{{$allocate->s_country == 1 ? 'ایران' : 'اتباع'}}</th>
                                        <th>{{ getProvinceCity($allocate->s_province)}}</th>
                                        <th>{{ getProvinceCity($allocate->s_city)}}</th>
                                        <td>{{$allocate->name}}</td>
                                        <td>{{$allocate->room_title}}</td>
                                        <td>{{$allocate->bed_number}}</td>
                                        <td>{{jdate($allocate->s_birthday)->format('Y/m/d')}}</td>
                                        <td>{{$allocate->start_at}}</td>
                                        <td>{{$allocate->expired_at}}</td>
                                        <th>{{getTitleDegree($allocate->s_degree)}}</th>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
{{--                            <div class="d-flex justify-content-center">{{$settings->links('vendor.pagination.bootstrap-4')}}</div>--}}
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>
@endcomponent
