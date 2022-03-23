@extends('layouts.auth.app')
@section('title')پرینت اطلاعات ثبت نام@endsection
@section('content')
    <div class="container-fluid d-md-flex align-items-center justify-content-center vh-100">

            <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-body">

                                    <table class="table table-striped table-bordered border-primary">
                                        <thead>
                                        <tr>
                                            <th scope="col">عنوان</th>
                                            <th scope="col">جزئیات</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>نام و نام خانوادگی</td>
                                            <td>{{$reception->people->name_family }}</td>
                                        </tr>
                                        <tr>
                                            <td>کدملی</td>
                                            <td>{{$reception->people->national_code}}</td>
                                        </tr>
                                        <tr>
                                            <td>شماره پاسپورت</td>
                                            <td>{{$reception->people->passport_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>موبایل</td>
                                            <td>{{$reception->people->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>اقامتگاه</td>
                                            <td>{{$reception->place->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>ادرس اقمتگاه</td>
                                            <td>{{$reception->place->address}}</td>
                                        </tr>
                                        <tr>
                                            <td>نام اتاق</td>
                                            <td>{{$reception->room->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>طبقه</td>
                                            <td>{{$reception->room->floor}}</td>
                                        </tr>
                                        <tr>
                                            <td>تخت</td>
                                            <td>{{$reception->bed->bed_number}}</td>
                                        </tr>

                                        <tr>
                                            <td>تاریخ ورود</td>
                                            <td>{{$reception->start_at}}</td>
                                        </tr>
                                        <tr class=" p-2 text-dark bg-opacity-10 @if(jalali_to_carbon($reception->expired_at) >= now()) bg-success @else bg-danger @endif">
                                            <td>تاریخ خروج</td>
                                            <td>{{$reception->expired_at}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
    </div>
@endsection



@section('styles')
{{--    <style>--}}


{{--        .qr-image svg {--}}
{{--            height: 100%;--}}
{{--            width: 100%;--}}
{{--            padding: 15px;--}}
{{--        }--}}


{{--        @media print {--}}
{{--            body {--}}
{{--                size: A5;--}}
{{--            }--}}

{{--            .qr-image {--}}
{{--                max-width: 150px;--}}
{{--                padding: 0;--}}
{{--            }--}}

{{--            .btn {--}}
{{--                display: none;--}}
{{--            }--}}

{{--            .position-print {--}}
{{--                justify-content: start !important;--}}
{{--                align-items: start !important;--}}
{{--                width: fit-content;--}}
{{--            }--}}

{{--            .card {--}}
{{--                display: inline-grid;--}}

{{--            }--}}

{{--            .print-header {--}}
{{--                position: absolute;--}}
{{--                top: 25px;--}}
{{--                right: 150px;--}}
{{--            }--}}

{{--            .card-body {--}}
{{--                padding-top: 0;--}}
{{--            }--}}

{{--        }--}}


{{--    </style>--}}
@endsection
