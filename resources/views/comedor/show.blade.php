<!DOCTYPE html>

<html lang="es">
@section('htmlheader')
    @include('comedor.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div id="app" class="wrapper">

@include('comedor.partials.mainheader')

@include('comedor.partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    {{--@include('layouts.partials.contentheader')--}}

    <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <comedor-index :p_comedor="{{$comedor}}">

            </comedor-index>

            <notifications group="g" />

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')
</div><!-- ./wrapper -->

@section('scripts')
    @include('comedor.partials.scripts')
@show

</body>
</html>
