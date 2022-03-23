@section('title') لیست اتاق های اقامتگاه {{$placeName}} @endsection

@component('layouts.app')
    <div>
        <section class="content-header d-flex">
            <h1>
                لیست اتاق های اقامتگاه {{$placeName}}
            </h1>
            @can('add-room')
            <a href="{{route('admin.place.rooms.create',request()->place)}}" class="pr-2">
                <button type="submit" class="btn btn-primary">ایجاد اتاق</button>
            </a>
            @endcan
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست اتاق ها</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>نام اتاق</th>
                                    <th>طبقه</th>
                                    <th>وضعیت اتاق</th>
                                    <th>تعداد تخت</th>
                                    <th>تخت فعال</th>
                                    <th>تخت غیر فعال</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td><a class="text-dark" href="{{route('admin.place.rooms.beds.list',[request()->place,$room->id])}}">
                                                {{$room->title}}
                                            </a>
                                        </td>
                                        <td>{{$room->floor}}</td>
                                        <td>@if($room->is_active==1)<span class="label label-success">فعال</span>@else<span class="label label-danger">غیرفعال</span>@endif</td>
                                        <td>{{$room->beds_count}}</td>
                                        <td><span class="label label-success">{{$room->beds_active}}</span></td>
                                        <td><span class="label label-danger">{{$room->beds_disable}}</span></td>
                                        <td>
                                            <div class="d-flex ">

                                                <a class="text-dark pl-2" title="مدیریت"
                                                   href="{{route('admin.place.rooms.beds.list',[request()->place,$room->id])}}"><i
                                                        class="ion-settings h5"></i></a>
                                                @can('edit-room')
                                                <a class="text-dark pl-2" title="ویرایش"
                                                   href="{{route('admin.place.rooms.edit',[request()->place,$room->id])}}"><i
                                                        class="ion-edit h5"></i></a>
                                                @endcan
                                                @can('delete-room')
                                                <form method="POST" action="{{ route('admin.place.rooms.delete', [request()->place,$room->id]) }}">
                                                    @csrf
                                                    <a class="text-dark show_confirm" type="submit" title='حذف'><i
                                                            class="ion-android-delete h4"></i></a>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="d-flex justify-content-center">{{$rooms->links('vendor.pagination.bootstrap-4')}}</div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>
@endcomponent
