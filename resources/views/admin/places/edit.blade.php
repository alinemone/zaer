@component('layouts.app')
    <div>
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش اقامتگاه :  {{$place->name}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.place.update',$place->id)}}" method="post">
                            @csrf
{{--                            <input type="hidden" name="id" value="{{request()->id}}">--}}
                            <div class="box-body">
                                <div class="row">
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputName">نام</label>
                                            <input type="text" class="form-control" placeholder="نام" name="name"
                                                   value="{{$place->name}}">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputName">آدرس</label>
                                            <input type="text" class="form-control" placeholder="آدرس" name="address"
                                                   value="{{$place->address}}">
                                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputName">تلفن تماس</label>
                                            <input type="number" class="form-control" placeholder="تلفن تماس" name="phone"
                                                   value="{{$place->phone}}">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputName">تعداد طبقات</label>
                                            <input type="number" class="form-control" placeholder="تعداد طبقات"
                                                   name="floor_count" value="{{$place->floor_count}}">
                                            @error('floor_count') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label>جنسیت</label>
                                            <select class="form-control" name="gender_type">
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" {{ $place->gender_type == 1 ? 'selected' : '' }}>اقایان</option>
                                                <option value="2" {{ $place->gender_type == 2 ? 'selected' : '' }}>بانوان</option>
                                            </select>
                                            @error('gender_type') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class=" col-md-3">
                                        <div class="form-group">
                                            <label>وضعیت فعالی</label>
                                            <select class="form-control"  name="is_active">
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" {{ $place->is_active == 1 ? 'selected' : '' }}>فعال</option>
                                                <option value="0" {{ $place->is_active == 0 ? 'selected' : '' }}>غیرفعال</option>
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
