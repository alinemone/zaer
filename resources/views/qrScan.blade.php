@extends('layouts.client.app')

@section('scripts')
    <script src="{{asset('js/html5-qrcode.min.js')}}"></script>



    <script>

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            // console.log(`Scan result: ${decodedText}`, decodedResult);
            // window.alert(decodedText);
            let result = decodedText;
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{route('qrScanStore')}}',
                type:"POST",
                data:{
                    result:result,
                    _token: _token
                },
                success:function(response){
                    if(response) {
                        // $('.success').text(response.success);
                        swal("Good job!", response, "success");
                    }
                },
            });

        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="h-100" id="reader"></div>
            </div>
        </div>
    </div>
</div>
@include('sweet::alert')
@endsection
