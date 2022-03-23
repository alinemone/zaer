@section('title') پذیرش کاروان @endsection
@component('layouts.app')
    {{--    @dd(session()->get('errors'))--}}
    <div>
        <section class="content">

            <div class="row justify-content-center ">
                <div class="col-md-12 register-form">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ثبت نام کاروان</h3>
                        </div>
                        <form method="POST" action="{{route('admin.group.reception',request()->gender)}}">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="national_code"
                                                       class="col col-form-label text-md-right">شماره کاروان </label>
                                                <input id="group_id" type="text"
                                                       class="form-control @error('group_id') is-invalid @enderror"
                                                       name="group_id" value="{{ old('group_id') }}" required>
                                                @error('group_id')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!-- general form elements -->
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">اطلاعات اقامتگاه</h3>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 pt-2">
                                                    <label for="place"
                                                           class="col-md-12 col-form-label text-md-right">اقامتگاه</label>
                                                    <select class="form-control" name="place" id="place">
                                                        @foreach($places as  $place)
                                                            <option value="{{$place->id}}">{{$place->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('place')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 pt-2">
                                                    <label for="start_at" class="col col-form-label text-md-right">
                                                        شروع اقامت
                                                    </label>
                                                    <input id="start_at" type="text"
                                                           class="form-control @error('start_at') is-invalid @enderror"
                                                           name="start_at"
                                                           value="{{old('start_at') ?:jdate()->format('Y/m/d') }}"
                                                           data-jdp>
                                                    @error('start_at')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 pt-2">
                                                    <label for="expired_at" class="col col-form-label text-md-right">
                                                        پایان اقامت
                                                    </label>
                                                    <input id="expired_at" type="text"
                                                           class="form-control @error('expired_at') is-invalid @enderror"
                                                           value="{{old('expired_at') ?:jdate()->addDays(getSetting('days_reserve'))->format('Y/m/d')}}"
                                                           name="expired_at" data-jdp>
                                                    @error('expired_at')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>




                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group pt-2 pr-2">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                رزرو
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
            </div>

        </section>
    </div>
@endcomponent

<script>
    jalaliDatepicker.startWatch()
</script>
