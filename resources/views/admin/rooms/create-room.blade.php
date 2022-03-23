@section('title') ایجاد اتاق های اقامتگاه @endsection

@component('layouts.app')
    @role('admin')
    <div>
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد اتاق</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.place.rooms.create',request()->place)}}" method="post">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <input type="hidden" name="place_id" value="{{request()->place}}">
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputName">نام</label>
                                            <input type="text" class="form-control" placeholder="نام اتاق" name="title"
                                                   value="{{old('title')}}" required>
                                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputName">طبقه</label>
                                            <input type="number" class="form-control" placeholder="طبقه"
                                                   name="floor" value="{{old('floor')?:1}}">
                                            @error('floor') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputName">ظرفیت اتاق</label>
                                            <input type="number" class="form-control" placeholder="تعداد تخت"
                                                   name="capacity" value="{{old('capacity')}}" required>
                                            @error('capacity') <span
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
                                <button type="submit" class="btn btn-primary">ایجاد اتاق</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
            <!-- /.row -->
        </section>
    </div>
    @else
        {{abort(403)}}
        @endhasrole
        @endcomponent
