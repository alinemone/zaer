@component('layouts.app')
<div>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ویرایش اتاق</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.place.rooms.update',[request()->place,$room->id])}}" method="post">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName">نام</label>
                                        <input type="text" class="form-control" placeholder="نام اتاق" name="title"
                                               value="{{$room->title}}">
                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName">طبقه</label>
                                        <input type="number" class="form-control"  placeholder="طبقه"
                                               name="floor" value="{{$room->floor}}">
                                        @error('floor') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label>وضعیت فعالی</label>
                                        <select class="form-control"  name="is_active">
                                            <option selected>انتخاب کنید</option>
                                            <option value="1" {{ $room->is_active == 1 ? 'selected' : '' }}>فعال</option>
                                            <option value="0" {{ $room->is_active == 0 ? 'selected' : '' }}>غیرفعال</option>
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
