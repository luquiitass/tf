<!DOCTYPE html>

<html lang="es">
@section('htmlheader')
    @include('comensal.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div id="app" class="wrapper">

@include('comensal.partials.mainheader')

@include('comensal.partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    {{--@include('layouts.partials.contentheader')--}}

    <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <comensal-index :p_comensal="{{$comensal}}" :p_usuario="{{$usuario}}">

            </comensal-index>

            <notifications group="g" />

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')
</div><!-- ./wrapper -->

@section('scripts')
    @include('comensal.partials.scripts')
@show

</body>
</html>
