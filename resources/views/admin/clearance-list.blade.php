<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست ترخیصی ها</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="جستجو">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>شماره پذیرش</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ساختمان</th>
                            <th>طبقه</th>
                            <th>اتاق</th>
                            <th>تخت</th>
                            <th>تاریخ ورود</th>
                            <th>تاریخ خروج</th>
                            <th>تنظیمات</th>
                        </tr>
                        @forelse($receptions as $reception)
                            <tr>
                                <td>{{$reception->id}}</td>
                                <td>
                                    <a target="_blank" href="{{route('admin.reception.cart',$reception->id)}}">
                                        {{$reception->people->name_family}}
                                    </a>
                                </td>
                                <td>{{$reception->place->name}}</td>
                                <td>{{$reception->room->floor}}</td>
                                <td>{{$reception->room->title}}</td>
                                <td>{{$reception->bed->bed_number}}</td>
                                <td>{{$reception->start_at}}</td>
                                <td>{{$reception->expired_at}}</td>
                                <td>
                                    <div class="d-flex ">
                                        @can('clearance')
                                        <form method="POST" action="{{ route('admin.reception.clearance',$reception->id) }}">
                                            @csrf
                                            <a class="text-dark confirm_release" onclick="showInfo({{$reception}})" title="ترخیص"
                                               type="submit"><i
                                                    class="ion-clipboard h4"></i></a>
                                        </form>
                                        @endcan
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
            <!-- /.box -->
        </div>
    </div>
</div>

