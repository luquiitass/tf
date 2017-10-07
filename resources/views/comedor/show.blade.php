<!DOCTYPE html>

<html lang="es">
@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div id="app" class="wrapper">

@include('layouts.partials.mainheader')

@include('comedor.partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    {{--@include('layouts.partials.contentheader')--}}

    <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <router-view name="content_comedor"></router-view>

            <notifications group="g" />

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')
</div><!-- ./wrapper -->

@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>
