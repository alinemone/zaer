@extends('layouts.auth.app')
@section('title')پرینت اطلاعات ثبت نام@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex" style=" justify-content: space-between;">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example"
                 style=" direction: ltr; ">
                <a href="{{route('admin.reception.create',['male'])}}" type="button"
                   class="btn btn-success">پذیرش برادران</a>
                <a href="{{route('admin.reception.create',['female'])}}" type="button"
                   class="btn btn-info">پذیرش خواهران</a>
                <a href="{{route('admin.admin')}}" type="button"
                   class="btn btn-danger">صفحه اصلی</a>
                <a href="{{route('admin.admin')}}" type="button"
                   class="btn btn-success" onclick="window.print();">پرینت</a>
            </div>
        </div>
        <div class="row vh-100">
            <div class="d-flex position-print align-items-center justify-content-center flex-column">
                <div class="col-md-6 d-print-inline">

                    <div class="card mb-3">

                        <div class="row g-0 print-card">
                            <div class="col-md-4 position-print">
                                <div class="img-fluid rounded-start qr-image">

                                    {!! QrCode::size(250)->encoding('UTF-8')->generate($text); !!}

                                </div>
                            </div>
                            <div class="col-md-8">
                                <img src="{{asset('/images/mokeb.png')}}" class="watermark" />
                                <div class="card-body">
                                    <div class="print-header">
                                        <h5 class="card-title">

                                            @if($reception->people_type == \App\Models\People::class)
                                            {{$reception->people->name_family}}
                                            @else
                                                {{$reception->servant->name_family}}
                                            @endif

                                        </h5>
                                        <h6 class="card-title">
                                            @if($reception->people_type == \App\Models\People::class)
                                                شماره تلفن : {{$reception->people->mobile}}
                                            @else
                                                شماره تلفن : {{$reception->servant->mobile}}
                                            @endif


                                        </h6>
                                        <h6 class="card-title">تاریخ انقضای اقامت : {{$reception->expired_at}}</h6>
                                    </div>
                                    <hr>
                                    <p class="card-text">آدرس
                                        : {{ $reception->place->address . ' اقامتگاه ' .$reception->place->name .  ', طبقه '.$reception->room->floor .',اتاق '.$reception->room->title .', تخت ' . $reception->bed->bed_number}}
                                    </p>
                                    <h6 class="card-title">تلفن اقامتگاه : {{$reception->place->phone}}</h6>
                                    <h5 class="card-title"> جایگاه : {{Jaygah($reception)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-print-inline">
                    <div class="card mb-3">
                        <div class="row g-0 print-card">
                            <div class="col-md-12">

                                <div class="card-body">
                                    <ul>
                                        <li class="card-text">
                                            مراقب تلفن همراه و سایر اشیاء خود باشید .
                                        </li>

                                        <li class="card-text">
                                            همواره جهت ورود و خروج به موکب کارت تردد خود را همراه داشته باشید
                                        </li>
                                        <li class="card-text">
                                            از آوردن غذای نذری به داخل موکب خودداری فرمایید .
                                        </li>
                                        <li class="card-text">
                                            جهت برقراری نظم و ارائه خدمات بهتر به خادمین خود در موکب همکاری را بفرمایید.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('styles')
    <style>


        .qr-image svg {
            height: 100%;
            width: 100%;
            padding: 15px;
        }

        .watermark{
            position: absolute; left: 25%; opacity: 0.1; width: 300px;
        }


        @media print {
            body {
                size: A5;
            }

            .qr-image {
                max-width: 150px;
                padding: 0;
            }

            .btn {
                display: none;
            }

            .position-print {
                justify-content: start !important;
                align-items: start !important;
                width: fit-content;
            }

            .card {
                display: inline-grid;

            }

            .print-header {
                position: absolute;
                top: 25px;
                right: 150px;
            }

            .card-body {
                padding-top: 0;
            }

            .watermark{
                position: absolute; left: 15%; top: -0%; opacity: 0.08; width: 250px;
            }

        }


    </style>
@endsection
