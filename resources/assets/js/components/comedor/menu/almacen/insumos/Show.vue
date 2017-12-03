<template>
    <div>
        <div v-if="insumo">
            <titulo>
                <ol class="breadcrumb" slot="breadcrump">
                    <li>
                        <a class="manita" @click="cancelar()">Insumos</a>
                    </li>
                    <li class="active">
                        {{insumo.nombre}}
                    </li>
                </ol>
                Insumo
            </titulo>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="box box-info">
                        <div class="box-body">

                            <h3 class="profile-username text-center">{{insumo.nombre}}</h3><!--Nombre Insumo-->

                            <hr/>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Disponible</b> <a class="pull-right">{{insumo.disponibilidad}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Cantidad minima</b> <a class="pull-right">{{insumo.minimo}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Unidad de medida</b> <a class="pull-right">{{insumo.unidad_de_medida.nombre}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Estado</b> <a class="pull-right">{{estado(insumo)}}</a>
                                </li>
                            </ul><!--Lista de datos de un Insumo-->

                        </div>
                        <div class="box-footer text-center">
                            <button class="btn btn-success" @click="showEdit(true)" >Editar</button>
                            <button class="btn btn-danger" @click="showDelet(true)"> Eliminar</button>
                        </div>

                    </div>

                </div><!--Fin de columna 1-->

                <div class="col-xs-12 col-md-4" v-if="!edit">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title with-border">
                                Recetas en la que se utiliza
                            </h3>
                        </div>
                        <div class="box-body">
                            <ul class="list-group" v-if="insumo.recetas.length">
                                <li class="list-group-item" v-for="receta in insumo.recetas">
                                    <a class="manita"
                                        @click="irReceta(receta)">
                                        {{receta.nombre}}
                                    </a>
                                </li>
                            </ul>
                            <p v-else="" class="text-info">Este insumo no es utilizado en ningina receta</p>
                        </div>
                    </div>
                </div><!--Fin de columna 2-->

                <div class="col-xs-12 col-md-4" v-if="!edit">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title with-border">
                                Ingresos y Egresos
                            </h3>
                        </div>
                        <div class="box-body">
                            <p class="text-info">
                                El modulo Ingreso y egreso esta en desarrollo

                            </p>
                        </div>
                    </div>
                </div><!--Fin de columna 3-->

                <div class="col-xs-12 col-md-8" v-if="edit">
                    <div class="box box-success">
                        <div class="box-body">

                            <edit
                                :objeto="insumo"
                                @edited="editedInsumo"
                                @cancelar="showEdit(false)">
                            </edit>
                            <!--Formualrio para editar Insumo-->

                        </div>
                    </div>
                </div><!--Fin de columna 3-->

                <modal-delet
                    v-if="deletShow"
                    :titulo="'Eliminar'"
                    :text="'Esta seguro de eliminar  ' + insumo.nombre "
                    :url="'insumo/' + insumo.id "
                    @eliminado=""
                    @cancelado="showDelet(false)">
                </modal-delet>



            </div>
        </div>
        <loading v-else=""></loading>
    </div>
</template>


<script>
import Edit from './Edit.vue';
export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            insumo:null,
            edit:false,
            deletShow:false,
        }
    },
    components:{
        Edit
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Insumo.find(
                    this.$route.params.id,
                    insumo => this.insumo = insumo
            );
        },
        cancelar(){
            router.push({ path: '/almacen/insumos'});
        },
        irReceta(receta){
            router.push({ path: '/receta/' + receta.id});
        },

        showDelet(visible){
            this.deletShow = visible;
        },
        showEdit(visible){
            this.edit = visible;
        },
        editedInsumo(insumo){
            this.insumo = insumo;
            this.showEdit(false);
        },

        /*Metodos Propios*/
        estado(insumo){
            return insumo.activo ? 'Activo' :'Inactivo';
        }
    }
}

</script>