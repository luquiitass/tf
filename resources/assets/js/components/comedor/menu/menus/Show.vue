<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                Comidas
                <ul class="list-group">
                    <li class="list-group-item" v-for="receta in p_menu.recetas">
                        {{receta.nombre}}
                    </li>
                </ul>

            </div>
            <div class="col-xs-12 col-md-6">
                Ingredientes
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>disponible</th>
                        <!--<th>Necesario</th>-->
                        <th>Necesario</th>
                    </tr>
                    <tr v-for="(ingrediente,num) in ingredientes">
                        <td>{{num + 1}}</td>
                        <td>{{ingrediente.ingrediente.insumo.nombre}}</td>
                        <td>{{ingrediente.ingrediente.insumo.disponibilidad}} {{ingrediente.abreviatura}}</td>
                        <!--<td>{{ingrediente.cantUM}} {{ingrediente.abreviatura}}</td>-->
                        <td>{{ingrediente.necesario}} {{ingrediente.abreviatura}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{

        }
    },
    props: {
        p_menu:{
            required:true
        }

    },
    created(){
        this.init();
    },
    computed:{
        ingredientes(){
            var ingredientes = [];
            var self = this;
            _.each(this.p_menu.recetas, function(receta){
                _.each(receta.ingredientes, function(ingrediente){
                    var exist = false;
                    var ingreExist = {}

                    _.each(ingredientes, function(ing){
                        if (!exist){
                            exist = ing.ingrediente.insumo.id == ingrediente.insumo.id;
                            if (exist){
                                ingreExist = ing;
                            }
                        }
                    });

                    if (exist){

                        var cantXPorcion = ingrediente.cantidad;
                        var necesario =parseFloat( parseFloat(receta.cantidad) * parseFloat(cantXPorcion) );

                        ingreExist.necesario = parseFloat( parseFloat(ingreExist.necesario) + parseFloat(necesario) );

                    }else{

                        var cantXPorcion = ingrediente.cantidad;
                        var necesario =parseFloat( parseFloat(receta.pivot.cantidad) * parseFloat(cantXPorcion) );

                        var ingre = {ingrediente_id : ingrediente.id, abreviatura :ingrediente.insumo.unidad_de_medida.abreviatura, cantUM: cantXPorcion, necesario : necesario,ingrediente:ingrediente}

                        self.addFirstList(ingredientes,ingre);
                    }

                });
            });

            return ingredientes;

        }
    },
    methods:{
        init(){

        },
    }
}

</script>