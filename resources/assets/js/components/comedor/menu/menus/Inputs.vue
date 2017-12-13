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
        <h3>Comidas, ensaladas y postres</h3>

        <div class="row">
            <div class="col-xs-12 col-md-6">

                <ul class="list-group">
                    <li class="list-group-item" v-for="receta in form.recetas">
                        {{receta.nombre}}
                    </li>
                </ul>

                <div>
                    <add-receta
                        @select="selectReceta">
                    </add-receta>

                    <div v-if="recetaSelect">

                        <div>

                            <h3 class="text-center">{{recetaSelect.nombre}}</h3>

                            <div :class="{'form-group col-xs-12 col-md-6 text-center':true,'has-error':mensajeIngredienteCantidad.length}">
                                <label class="control-label">Cantidad</label>
                                <div class="">
                                    <input type="number"  class="form-control input-sm" :placeholder="insumoSelect.unidad_de_medida.abreviatura" v-model="nuevoIngrediente.cantidad">
                                    <span class="help-block" v-if="mensajeIngredienteCantidad.length" v-text="mensajeIngredienteCantidad"></span>

                                </div>
                            </div>

                            <a class="manita pull-right" @click="addRecetaa()">
                                <i class="fa fa-plus"></i>
                                añadir
                            </a>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-md-6">

                <div class="col-xs-12 col md-6">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="ingrediente in ingredientes">
                            {{ingrediente.nombre}}
                        </li>
                    </ul>
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
            mensajeIngredienteCantidad : ''
        }
    },
    components:{
        AddReceta
    },
    computed:{
        total(){
            return parseInt(this.diferencia) + parseInt(4);
        },
        ingredientes(){
            return [{nombre:'Papa'},{nombre:'Cebolla'},{nombre:'Carne'}]
        }
    },
    props: {
        form:{
            required : true
        },
        edit : {
            required:false,
            default : false
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.form.cant_comensales = this.todo;
        },
        selectReceta(receta){
            var rece = {instanci}
            this.recetaSelect = receta;
        },
        addRecetaa(){

            this.addFirstList(this.form.recetas,this.recetaSelect);
            this.recetaSelect = null;
        }
    }
}

</script>