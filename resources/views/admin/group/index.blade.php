@section('title') کاروان ها  @endsection
@component('layouts.app')
    <div>
        <section class="content-header d-flex">
            <h1>
                کاروان ها
            </h1>
            @can('add-group')
                <a href="{{route('admin.group.create')}}" class="pr-2">
                    <button type="submit" class="btn btn-primary">ایجاد کاروان </button>
                </a>
            @endcan
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست کاروان ها</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>شماره کاروان</th>
                                    <th>نام</th>
                                    <th>سرپرست</th>
                                    <th>موبایل</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @forelse($groups as $group)
                                    <tr>
                                        <td>{{$group->id}}</td>
                                        <td><a class="text-dark" href="{{route('admin.group.member.index',$group->id)}}">{{$group->title}}</a></td>
                                        <td>{{$group->owner_name}}</td>
                                        <td>{{$group->owner_mobile}}</td>
                                        <td>{{jdate($group->created_at)->format('Y/m/d')}}</td>
                                        <td>
                                            <div class="d-flex ">
{{--                                                <a class="text-dark pl-2" title="مدیریت"--}}
{{--                                                   href="{{route('admin.place.rooms.list',$place->id)}}"><i--}}
{{--                                                        class="ion-settings h5"></i></a>--}}
{{--                                                @can('edit-place')--}}
{{--                                                    <a class="text-dark pl-2" title="ویرایش"--}}
{{--                                                       href="{{route('admin.place.edit',$place->id)}}"><i--}}
{{--                                                            class="ion-edit h5"></i></a>--}}
{{--                                                @endcan--}}
{{--                                                @can('delete-place')--}}
{{--                                                    <form method="POST" action="{{ route('admin.place.delete', $place->id) }}">--}}
{{--                                                        @csrf--}}
{{--                                                        <a class="text-dark show_confirm" type="submit" title='حذف'><i--}}
{{--                                                                class="ion-android-delete h4"></i></a>--}}
{{--                                                    </form>--}}
{{--                                                @endcan--}}
{{--                                                @can('add-room')--}}
{{--                                                    <a class="text-dark pr-2" title="ایجاد اتاق"--}}
{{--                                                       href="{{route('admin.place.rooms.create',$place->id)}}"><i--}}
{{--                                                            class="ion-home h5"></i></a>--}}
{{--                                                @endcan--}}
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
                                class="d-flex justify-content-center">{{$groups->links('vendor.pagination.bootstrap-4')}}</div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>

@endcomponent
