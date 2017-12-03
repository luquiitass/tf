<template>
    <div>
        <div v-if="receta">
            <titulo>
                <ol class="breadcrumb" slot="breadcrump">
                    <li>
                        <a class="manita" @click="cancelar()">Recetas</a>
                    </li>
                    <li class="active">
                        Receta
                    </li>
                </ol>
                Receta
            </titulo>

            <div>
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="box box-success">
                            <div class="box-body">
                                <div class="col-xs-10 col-xs-offset-1">
                                <div class="text-center">
                                    <h2>{{receta.nombre}}</h2>

                                </div>

                                    <p class="text-center text-info"> Esta receeta es para <b>{{receta.porciones}}</b> porción/es </p>

                                    <strong>Preparacion</strong>
                                    <div class="parrafo text-muted">
                                        <p class="" v-for="text in text(receta.preparacion)">
                                            {{text}}
                                        </p>
                                    </div>


                                    <!--<strong>Dscripcion</strong>
                                    <div class="parrafo text-muted">
                                        <p class="" v-for="text in text(receta.descripcion)">
                                            {{text}}
                                        </p>
                                    </div>-->
                                </div>
                            </div><!--Fin body-->
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" @click="showEdit(true)">Editar</button>
                                <button class="btn btn-danger">Elimnar</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-6" v-if="!edit">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ingredientes</h3>
                            </div>
                            <div class="box-body">
                                <ul class="todo-list ui-sortable">
                                    <li class="" v-for="(ingrediente,num) in receta.ingredientes">
                                        <span class="text">
                                            <strong>{{num+1}} </strong> {{ingrediente.insumo.nombre}}
                                        </span>

                                        <span class="label label-info">{{ingrediente.cantidad}}</span>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-md-7" v-else="">
                        <div class="box box-success">
                            <div class="box-body">

                                <edit-receta
                                    :objeto="receta"
                                    @edited="edited"
                                    @cancelar="showEdit(false)">
                                </edit-receta>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <loading v-else=""></loading>
    </div>
</template>


<script>
import EditReceta from './Edit.vue';
export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            receta:null,
            edit:false,
            deletShow:false,
        }
    },
    components:{
        EditReceta
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Receta.find(
                    this.$route.params.id,
                    receta => this.receta = receta
            );
        },
        edited(receta){
            this.receta = receta;
            this.showEdit(false)
        },
        cancelar(){
            router.push({ path: '/recetas'});
        },


        showDelet(visible){
            this.deletShow = visible;
        },
        showEdit(visible){
            this.edit = visible;
        },
        editedreceta(receta){
            this.receta = receta;
            this.showEdit(false);
        },

        /*Metodos Propios*/
        estado(receta){
            return receta.activo ? 'Activo' :'Inactivo';
        }
    }
}

</script>