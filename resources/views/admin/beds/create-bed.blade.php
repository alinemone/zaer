@role('admin')

<div class="row">
    <section class="col-lg-12 col-md-12">
        <div class="box box-info collapsed-box">
            <div class="box-header">
                <h3 class="box-title">ایجاد تخت</h3>
                <!-- tools box -->
                <div class="pull-left box-tools">
                    <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body" style="">
                <form role="form" action="{{route('admin.place.rooms.beds.create',[request()->place,request()->room])}}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class=" col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName">شماره تخت</label>
                                    <input type="text" class="form-control" placeholder="شماره تخت" name="bed_number"
                                           value="{{old('bed_number')}}">
                                    @error('bed_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group">
                                    <label>وضعیت اختصاص</label>
                                    <select class="form-control"  name="assigned">
                                        <option value="0" selected>عدم اختصاص</option>
                                        <option value="1">اختصاص یافته</option>
                                    </select>
                                    @error('assigned') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group">
                                    <label>وضعیت فعالی</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                    @error('is_active') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">ایجاد تخت</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@else

@endhasrole
