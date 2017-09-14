@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
						<p v-if="is(user)"> @{{ user.email }}</p>
                        <input type="text" v-model="email" :keyup="emailc()">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@parent
<script type="text/javascript">



</script>
@endsection
