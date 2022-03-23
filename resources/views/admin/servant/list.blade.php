@section('title') مدیریت خدام  @endsection
@component('layouts.app')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست خدام</h3>
                            @can('add-servant')
                                <a href="{{route('admin.servant.create')}}" class="pr-2">
                                    <button type="submit" class="btn btn-primary">ثبت خادم جدید</button>
                                </a>
                            @endcan
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>موبایل</th>
                                    <th>کد ملی</th>
                                    <th>جنسیت</th>
                                    <th>تاریخ تولد</th>
                                    <th> تحصیلات</th>
                                    <th>کشور</th>
                                    <th>استان</th>
                                    <th>شهر</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @forelse($servants as $servant)
                                    <tr>
                                        <td>{{$servant->id}}</td>
                                        <td>{{$servant->name_family}}</td>
                                        <td>{{$servant->mobile}}</td>
                                        <td>{{$servant->national_code}}</td>
                                        <td>@if($servant->gender == 1) مرد @else زن @endif</td>
                                        <td>{{$servant->birthday}}</td>
                                        <td>{{getTitleDegree($servant->degree)}}</td>
                                        <td>@if($servant->country == 1) ایران @else {{$servant->country}} @endif</td>
                                        <td>
                                            @if($servant->country == 1)
                                                {{getProvinceCity($servant->province)}}
                                            @else
                                                {{$servant->province}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($servant->country == 1)
                                            {{getProvinceCity($servant->city)}}
                                            @else
                                                {{$servant->city}}
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex ">
                                                @can('edit-servant')
                                                    <a class="text-dark pl-2" title="ویرایش"
                                                       href="{{route('admin.servant.edit',$servant->id)}}"><i
                                                            class="ion-edit h5"></i></a>
                                                @endcan
                                                @can('delete-servant')
                                                    <form method="POST"
                                                          action="{{ route('admin.servant.delete', $servant->id) }}">
                                                        @csrf
                                                        <a class="text-dark show_confirm" type="submit" title='حذف'><i
                                                                class="ion-android-delete h4"></i></a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">{{$servants->links('vendor.pagination.bootstrap-4')}}</div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </section>
    </div>

@endcomponent
