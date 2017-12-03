<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-md-6">

                <div :class="form.getClassForm('nombre')" >
                    <label >Nombre</label>
                    <input type="text" class="form-control"  v-model="form.nombre">
                    <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
                </div><!--Input Nombre-->

                <div :class="form.getClassForm('porciones')" >
                    <label >Porciones</label>
                    <input type="number" class="form-control"  v-model="form.porciones">
                    <span class="help-block" v-if="form.errors.has('porciones')" v-text="form.errors.get('porciones')"></span>
                </div><!--Input Porciones-->

                <div :class="form.getClassForm('preparacion')" >
                    <label >Preparacion</label>
                    <textarea  cols="10" rows="3" class="form-control"  v-model="form.preparacion"></textarea>
                    <span class="help-block" v-if="form.errors.has('preparacion')" v-text="form.errors.get('preparacion')"></span>
                </div><!--TextArea preparacion-->

            </div><!--Fin de columna 1-->

            <div class="col-xs-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ingredientes</h3>
                    </div>
                    <div class="box-body">

                        <ul class="list-group" style="list-style: none;max-height: 300px;overflow: auto;padding-top: 10px">
                            <li class="list-group-item" v-for="(ingrediente,num) in form.ingredientes">

                                <a class="manita pull-right" @click="removerIngrediente(ingrediente)">
                                    <i class="fa fa-close"></i>
                                </a>
                                <strong>{{num+1}}</strong>

                                {{ingrediente.insumo.nombre}}

                                <span>
                                    {{ingrediente.cantidad}}
                                    <cite class="text-muted">{{ingrediente.insumo.unidad_de_medida.abreviatura}}</cite>
                                </span>

                                <small :class="classPrimordial(ingrediente)">{{esPrimordial(ingrediente)}}</small>
                            </li>
                        </ul>

                        <a
                            id="link_nuevoIngrediente"
                            class="manita"
                            @click="showNuevoIngrediente(true)">
                            Nuevo ingrediente
                            <i class="fa fa-plus"></i>

                        </a>

                        <div id="nuevo_ingrediente" class="not-display">
                            <div class="ingrediente">

                                <a class="pull-right" @click="showNuevoIngrediente(false)">
                                    <i class="fa fa-close"></i>
                                </a>

                                <div>
                                    <b>Buscar Ingrediente</b>

                                    <add-insumo
                                        @select="addInsumo">
                                    </add-insumo>

                                </div>


                                <div class=" bg-info text-center" v-if="insumoSelect">
                                    <h3>{{insumoSelect.nombre}}</h3>

                                    <div>
                                        <div :class="{'form-group col-xs-12 col-md-6 text-center':true,'has-error':mensajeIngredienteCantidad.length}">
                                            <label class="control-label">Cantidad</label>
                                            <div class="">
                                                <input type="number"  class="form-control input-sm" :placeholder="insumoSelect.unidad_de_medida.abreviatura" v-model="nuevoIngrediente.cantidad">
                                                <span class="help-block" v-if="mensajeIngredienteCantidad.length" v-text="mensajeIngredienteCantidad"></span>

                                            </div>
                                        </div>

                                        <div class="form-group col-xs-12 col-md-6 text-center">
                                            <label class="control-label">
                                                Es primordial
                                            </label>
                                            <div>
                                                <input type="checkbox" v-model="nuevoIngrediente.primordial">
                                            </div>
                                        </div>

                                        <div class="box-footer pull-right">
                                            <button class="btn btn-success"@click="addIngrediente()">Añadir</button>
                                            <button class="btn btn-warning" @click="cancelarIngrediente()">Cancelar</button>
                                        </div>

                                    </div><!--Inputs - Cantidad, prioridad-->
                                </div>
                            </div>
                        </div><!--div que se oculta-->

                        <span class="help-block" v-if="form.errors.has('ingredientes')" v-text="form.errors.get('ingredientes')"></span>

                    </div><!--Fin de Body-->
                </div><!--fin del Box-->
            </div><!--Fin de columna 2-->
        </div>

        <modal
            :p_show="showModal"
            v-show="showModal"
            @cancelado="showModal=false">

                <div slot="title"> Buscar Insumo</div>

                <add-insumo
                    v-if="showModal"
                    @select="addIngrediente">
                </add-insumo>

        </modal>


    </div>
</template>


<script>

import AddInsumo from  '../almacen/insumos/AddInsumo.vue'

export  default{
    data(){
        return{
            showModal:false,
            insumoSelect:null,
            nuevoIngrediente:{},

            mensajeIngredienteCantidad:'',

        }
    },
    components:{
        AddInsumo,
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
    methods: {
        init(){
            this.showNuevoIngrediente(false);
        },
        addInsumo(insumo){
            this.nuevoIngrediente = {insumo: insumo, insumo_id: insumo.id, cantidad: '', primordial: false};
            this.insumoSelect = insumo;
        },
        showNuevoIngrediente(visible){
            if (visible) {
                $('#nuevo_ingrediente').removeClass('not-display');
                $('#nuevo_ingrediente').show(1000);
                $('#link_nuevoIngrediente').hide(1000);
            } else {
                $('#nuevo_ingrediente').hide(1000);
                $('#link_nuevoIngrediente').show(1000);

            }
        },
        cancelarIngrediente(){
            this.nuevoIngrediente = null;
            this.insumoSelect = null;
        },
        addIngrediente(){
            if (this.nuevoIngrediente.cantidad.length > 0) {
                this.form.ingredientes.unshift(this.nuevoIngrediente);
                this.cancelarIngrediente();
                this.mensajeIngredienteCantidad = ''
            } else {
                this.mensajeIngredienteCantidad = 'El campo cantidad es obligatorio'
            }
        },
        removerIngrediente(ingrediente){
            this.removeObjectList(this.form.ingredientes, ingrediente);
        },

        /*Ingrediente*/

        esPrimordial(ingrediente){
            return ingrediente.primordial ? 'Primordial' : 'No primordial';
        },
        classPrimordial(ingrediente){
            return ingrediente.primordial ? 'label label-success' : 'label label-warning';
        }
    }
}

</script>