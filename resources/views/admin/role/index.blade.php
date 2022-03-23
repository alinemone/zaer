@section('title') دسترسی ها  @endsection

@component('layouts.app')
    @hasrole('admin')

    <div>
        <section class="content-header d-flex">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد دسترسی ها</h3>
                    <a class="btn btn-primary" href="{{route('admin.user.create')}}">ایجاد کاربر جدید</a>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('admin.role.store')}}" method="post">
                    <div class="box-body">

                        @csrf
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="">کاربر ها</label>
                                    <select class="form-control" name="user_id" id="user_id" >
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="">دسترسی ها</label>
                                    <select class="form-control" name="role[]" id="role" >
                                        @foreach($roles as $key => $role)
                                        <option value="{{$role->id}}" >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">اعطای دسترسی</button>
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
                            <h3 class="box-title"> افراد دارای دسترسی </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>دسترسی</th>

                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <th>
                                            @forelse($user->roles as $role)
                                                {{$role->name . ' '}}
                                            @empty

                                            @endforelse
                                        </th>
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

    @else
        {{abort(403)}}
    @endhasrole
@endcomponent
