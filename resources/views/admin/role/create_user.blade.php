@section('title') ایجاد کاربر  @endsection

@component('layouts.app')
    <div>
        <section class="content-header d-flex">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد دسترسی ها</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('admin.user.create')}}" method="post">
                    <div class="box-body">
                        @csrf

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">نام و نام خانوادی</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">موبایل</label>
                                <input type="text" class="form-control" name="mobile">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">رمز عبور</label>
                                <input id="password" type="password" class="form-control " name="password" required=""
                                       autocomplete="new-password" aria-autocomplete="list">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">تکرار رمز عبور</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required="" autocomplete="new-password">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">ایجاد</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </section>
    </div>
@endcomponent
