@extends('layouts.app')

@section('htmlheader_title')

@endsection

@section('contentheader_title','Menu')

@section('main-content')

	<router-view name="menu"></router-view>

@endsection

@section('scripts')
@parent
<script language="JavaScript">


</script>
@endsection
