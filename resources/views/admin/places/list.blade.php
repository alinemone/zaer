@section('title') اقامتگاه ها  @endsection
@component('layouts.app')
    <div>
        <section class="content-header d-flex">
            <h1>
                اقامتگاه ها
            </h1>
            @can('add-place')
            <a href="{{route('admin.place.create')}}" class="pr-2">
                <button type="submit" class="btn btn-primary">ایجاد اقامتگاه</button>
            </a>
            @endcan
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست اقامتگاه</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover text-center">
                                <tbody>
                                <tr>
                                    <th>نام اقامتگاه</th>
                                    <th>وضعیت</th>
                                    <th>تعداد اتاق</th>
                                    <th>اتاق فعال</th>
                                    <th>اتاق غیر فعال</th>
                                    <th>تعداد تخت ها</th>
                                    <th>تخت فعال</th>
                                    <th>تخت غیر فعال</th>
{{--                                    <th>تخت قابل تخصیص</th>--}}
                                    <th>تنظیمات</th>
                                </tr>
                            @forelse($places as $place)
                                <tr>
                                    <td><a class="text-dark" href="{{route('admin.place.rooms.list',$place->id)}}">{{$place->name}}</a></td>
                                    <td>@if($place->is_active == 1)<span class="label label-success">فعال</span> @else <span class="label label-danger">غیرفعال</span>@endif</td>
                                    <td><span class="label label-success">{{$place->rooms_count}}</span></td>
                                    <td><span class="label label-success">{{$place->rooms_active}}</span></td>
                                    <td><span class="label label-danger">{{$place->rooms_disable}}</span></td>
                                    <td><span class="label label-success">{{$place->beds}}</span></td>
                                    <td><span class="label label-success">{{$place->beds_active}}</span></td>
                                    <td><span class="label label-danger">{{$place->beds_disable}}</span></td>
{{--                                    <td><span class="label label-danger">{{$place->beds_disable}}</span></td>--}}
                                    <td>
                                        <div class="d-flex ">
                                            <a class="text-dark pl-2" title="مدیریت"
                                               href="{{route('admin.place.rooms.list',$place->id)}}"><i
                                                    class="ion-settings h5"></i></a>
                                            @can('edit-place')
                                            <a class="text-dark pl-2" title="ویرایش"
                                               href="{{route('admin.place.edit',$place->id)}}"><i
                                                    class="ion-edit h5"></i></a>
                                            @endcan
                                            @can('delete-place')
                                            <form method="POST" action="{{ route('admin.place.delete', $place->id) }}">
                                                @csrf
                                                <a class="text-dark show_confirm" type="submit" title='حذف'><i
                                                        class="ion-android-delete h4"></i></a>
                                            </form>
                                            @endcan
                                            @can('add-room')
                                            <a class="text-dark pr-2" title="ایجاد اتاق"
                                               href="{{route('admin.place.rooms.create',$place->id)}}"><i
                                                    class="ion-home h5"></i></a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="d-flex justify-content-center">{{$places->links('vendor.pagination.bootstrap-4')}}</div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>

@endcomponent
