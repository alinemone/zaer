@section('title') تنظیمات  @endsection

@component('layouts.app')
    @role('admin')
    <div>
        <section class="content-header d-flex">
            <h1>
                تنظیمات
            </h1>

        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست تنظیمات</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>عنوان</th>
                                    <th>مقدار</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($settings as $setting)
                                    <tr>

                                        <td>{{$setting->title}}</td>
                                        <form action="{{route('admin.setting.update',$setting->id)}}" method="post">
                                        <td>
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" class="form-control" name="value" value="{{$setting->value}}">
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <button type="submit" class="btn btn-info pull-right">ویرایش</button>
                                            </div>
                                        </td>
                                        </form>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div--}}
{{--                                class="d-flex justify-content-center">{{$settings->links('vendor.pagination.bootstrap-4')}}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>
    @else
        {{abort(403)}}
    @endhasrole
@endcomponent
