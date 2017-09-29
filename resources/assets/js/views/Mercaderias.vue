<template>
	<div>
		<h4>Mercaderias</h4>
		<div class="row">
			<div class="col-xs-8">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#">Lista de Mercaderia</a></li>
				  <li><a href="#">Stock</a></li>
				  <li><a href="#">Provedores</a></li>
				</ul>
			</div>

			<div class="col-xs-4">
				<h3>Seleccionar un campo</h3>
			</div>
		</div>

	</div>
</template>

<script type="text/javascript">
	
export default{

	data(){
		return {nombre : 'hola'}
	},
	method(){
		return $get('home');
		
	}
}

</script>