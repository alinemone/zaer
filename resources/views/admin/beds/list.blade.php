@component('layouts.app')
    <div>
        <section class="content-header">
            <h1>
                لیست تخت های {{$room->title}}
            </h1>
        </section>
        <section class="content">

            @include('admin.beds.create-bed')

            <div class="row">


                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست تخت ها</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>شماره تخت</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت تخصیص</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($beds as $bed)
                                    <tr>
                                        <td>{{$bed->bed_number}}</td>
                                        <td><span @class(['label','label-success'=>$bed->is_active
                                            ,'label-danger'=>!$bed->is_active])> {{$bed->is_active == 1 ? 'فعال': 'غیرفعال'}}</span>
                                        </td>

                                        <td><span @class(['label','label-danger'=>$bed->assigned
                                            ,''=>!$bed->assigned])> {{$bed->assigned == 1 ? 'تخصیص یافته': ''}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                @can('edit-bed')
                                                <a class="text-dark pl-2" title="ویرایش"
                                                   href="{{route('admin.place.rooms.beds.edit',[request()->place,request()->room,$bed->id])}}"><i
                                                        class="ion-edit h5"></i></a>
                                                @endcan
                                                @can('delete-bed')
                                                <form method="POST"
                                                      action="{{route('admin.place.rooms.beds.delete',[request()->place,request()->room,$bed->id])}}">
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
                                class="d-flex justify-content-center">{{$beds->links('vendor.pagination.bootstrap-4')}}</div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
@endcomponent
