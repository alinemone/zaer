@component('layouts.app')
<div>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ویرایش تخت</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.place.rooms.beds.edit',[request()->place,request()->room,$bed->id])}}" method="post">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName">شماره تخت</label>
                                        <input type="text" class="form-control" placeholder="شماره تخت" name="bed_number"
                                                value="{{$bed->bed_number}}">
                                        @error('bed_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label>وضعیت اختصاص</label>
                                        <select class="form-control"  name="assigned">
                                            <option value="0" {{ $bed->assigned == 0 ? 'selected' : '' }}>عدم اختصاص</option>
                                            <option value="1" {{ $bed->assigned == 1 ? 'selected' : '' }}>اختصاص یافته</option>
                                        </select>
                                        @error('assigned') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label>وضعیت فعالی</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1" {{ $bed->is_active == 1 ? 'selected' : '' }}>فعال</option>
                                            <option value="0" {{ $bed->is_active == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        </select>
                                        @error('is_active') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
        <!-- /.row -->
    </section>
</div>
@endcomponent
