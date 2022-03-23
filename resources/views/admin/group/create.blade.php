@section('title') ایجاد کاروان  @endsection
@component('layouts.app')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد کاروان</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{route('admin.group.store')}}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">نام کاروان</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                         @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">نام سرپرست</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="owner_name" value="{{old('owner_name')}}" class="form-control">
                                         @error('owner_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">موبایل سرپرست</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="owner_mobile" value="{{old('owner_mobile')}}" class="form-control">
                                         @error('owner_mobile') <span class="text-danger">{{ $message }}</span> @enderror
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
                </div>

            </div>
        </section>
    </div>

@endcomponent
