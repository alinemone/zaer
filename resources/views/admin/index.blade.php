@component('layouts.app')
    @section('title')
        داشبرد مدیریت
    @endsection
    <div>
        <!-- Main content -->
        <section class="content container-fluid">
            @role('admin|reception')
            @include('admin.clearance-list')
            @endrole
        </section>
    </div>
@endcomponent
