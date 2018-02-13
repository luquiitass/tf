<template>
    <div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div :class="form.getClassForm('nombre')" >
                    <label >Diferencia</label>
                    <input type="number" class="form-control"  v-model="diferencia">
                    <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
                </div>
            </div>

            <div class="col-xs-12 col-md-8">
                <div class="callout callout-warning">

                    <p>El sistema obtendra un presupuesto de los insumos necesetados</p>
                    <h3>Para {{total}} comensales</h3>

                </div>
            </div>
        </div>

        <hr/>

        <h3>Comidas, ensaladas y postres</h3>

        <div class="row">
            <div class="col-xs-12 col-md-6">

                <ul class="list-group">
                    <li class="list-group-item" v-for="receta in form.recetas">
                        {{receta.receta.nombre}}
                        <a class="manita pull-right" @click="removeReceta(receta)"><i class="fa fa-close"></i></a>
                        <span class="pull-right"><strong>{{receta.cantidad}}</strong> comensales </span>
                    </li>
                </ul>

                <div>
                    <div class="clearfix" v-if="!recetaSelect">
                        <add-receta
                            @select="selectReceta">
                        </add-receta>
                    </div>


                    <div v-else="">

                        <a class="btn btn-xs pull-right" @click="recetaSelect = null"><i class="fa fa-close"></i></a>

                        <div class="text-center">

                            <h3 >{{recetaSelect.receta.nombre}}</h3>

                            <div :class="{'form-group col-xs-12 col-md-6 col-md-offset-3 text-center':true,'has-error':mensajeIngredienteCantidad.length}">
                                <label class="control-label">Cantidad de comensales</label>
                                <div class="">
                                    <input type="number"  class="form-control input-sm" placeholder="Numero de Comensales" v-model="recetaSelect.cantidad">
                                    <span class="help-block" v-if="mensajeIngredienteCantidad.length" v-text="mensajeIngredienteCantidad"></span>

                                </div>
                            </div>

                            <div class="col-xs-12 text-center">
                                <a class="manita" @click="addRecetaa()">
                                    <i class="fa fa-plus"></i>
                                    añadir
                                </a>
                            </div>



                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-md-6">

                <div class="col-xs-12 col md-6">
                    <!--<ul class="list-group">
                        Ingredientes necesarios
                        <li class="list-group-item" v-for="ingrediente in ingre()">
                            {{ingrediente.ingrediente.insumo.nombre}} <span class="pull-right">{{ingrediente.necesario}}</span>
                        </li>
                    </ul>-->
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

        <div class="clearfix">
        <div>
            *Recordar menú
            <input type="checkbox" v-model="form.recordar" @click="toggleRecordar()"/>
            
            <div id="recordar" style="display: none">
                <label >Nombre del menu</label>
                <input type="text" class="form-control"  v-model="form.nombre">
                <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
            </div>
        </div>

        </div>

    </div>
</template>


<script>

import AddReceta from '../recetas/AddReceta.vue';

export  default{
    data(){
        return{
            comedor: vm.app.comedor,
            diferencia : 0,
            recetaSelect:null,
            mensajeIngredienteCantidad : '',
        }
    },
    components:{
        AddReceta
    },
    computed:{
        countComensales(){
            if (!this.p_instancia.count_comensales){
                //this.p_instancia.count_comensales = 0;
            }
            return this.p_instancia.count_comensales ;
        },
        total(){
            //var cantComensales = this.p_instancia.count_comensales ? this.p_instancia.count_comensales : 0;
            return parseInt(this.diferencia) + parseInt(this.p_instancia.count_comensales);
        },
        ingredientes(){
            var ingredientes = [];
            var self = this;
            _.each(this.form.recetas, function(receta){
                _.each(receta.receta.ingredientes, function(ingrediente){
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
                        var necesario =parseFloat( parseFloat(receta.cantidad) * parseFloat(cantXPorcion) );

                        var ingre = {ingrediente_id : ingrediente.id, abreviatura :ingrediente.insumo.unidad_de_medida.abreviatura, cantUM: cantXPorcion, necesario : necesario,ingrediente:ingrediente}

                        self.addFirstList(ingredientes,ingre);
                    }

                });
            });

            return ingredientes;

        }
    },
    props: {
        form:{
            required : true
        },
        edit : {
            required:false,
            default : false
        },
        p_instancia:{
            required:true,
        }
    },
    created(){
        this.init();
    },
    watch:{
        countComensales:function(val){
            console.log(val)
            console.log(this.total);
        },
    },
    methods:{
        init(){
            this.p_instancia.count_comensales = this.p_instancia.count_comensales ? this.p_instancia.count_comensales : 0;
            this.toggleRecordar();
            //
        },
        selectReceta(receta){
            var rece = {receta : receta, cantidad : this.total};
            this.recetaSelect = rece;
        },
        addRecetaa(){
            if(this.recetaSelect.cantidad > 0){
                this.form.cantidad = this.total;
                this.addFirstList(this.form.recetas,this.recetaSelect);
                this.recetaSelect = null;
            }else{
                this.mensajeIngredienteCantidad = 'Debe indicar la cantidad de comensales que comeran';
            }
        },

        removeReceta(receta){
            this.removeObjectList(this.form.recetas,receta);
        },
        toggleRecordar(){
            console.log('toggle');
            if (this.form.recordar){
                console.log('show');

                $('#recordar').show(400);
            }else{
                console.log('hide');

                $('#recordar').hide(400);
            }
        }
       /* ingre(){
            var ingredientes = [];
            var self = this;
            _.each(this.form.recetas, function(receta){
                _.each(receta.receta.ingredientes, function(ingrediente){
                    var cantXPorcion = ingrediente.cantidad;
                    var necesario =parseFloat( parseFloat(receta.cantidad) * parseFloat(cantXPorcion) );
                    var ingre = {necesario : necesario,ingrediente:ingrediente}
                    self.addFirstList(ingredientes,ingre);
                });
            });

            return ingredientes;
        }*/
    }
}

</script>