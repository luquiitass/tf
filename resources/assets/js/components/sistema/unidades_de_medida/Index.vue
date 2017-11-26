<template>
    <div>
        <titulo>
            Unidades de medida
        </titulo>

        <div class="row">

            <div class="col-xs-12 col-md-9">
                <list
                    :p_list="unidades"
                    @edit="showEdit"
                    @delet="showDelet">
                </list>
            </div>
            <div class="col-xs-12 col-md-3">
                <create
                    v-if="columnaDerecha == 'create'"
                    @add="addUnidadDeMedida">
                </create>

                <edit
                    v-if="columnaDerecha == 'edit'"
                    :objeto="unidadEdit"
                    @edited="editedUnidad"
                    @cancelar="showCreate()">
                </edit>

                <modal-delet
                    v-if="unidadDelet"
                    :titulo="'Eliminar'"
                    :text="'Esta seguro de eliminar a ' + unidadDelet.nombre "
                    :url="'unidadDeMedida/' + unidadDelet.id"
                    @eliminado="deleteUnidad()"
                    @cancelado="unidadDelet = null">
                </modal-delet>

            </div>

        </div>
    </div>

</template>


<script>
import Create from  './Create.vue'
import Edit from  './Edit.vue'
import List from './List.vue'

export  default{
    data(){
        return{
            unidades : [],
            unidadEdit : null,
            unidadDelet : null,
            columnaDerecha : 'create'
        }
    },
    components:{
        List,
        Create,
        Edit
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            UnidadDeMedida.all(unidades => this.unidades = unidades);
        },



        addUnidadDeMedida(unidad){
            this.addFirstList(this.unidades,unidad);
        },
        editedUnidad(unidad){
            this.replaceObjectList(this.unidades,unidad);
            this.showCreate();
        },
        deleteUnidad(){
            this.removeObjectList(this.unidades,this.unidadDelet);
            Notificacion.mostrarMensaje({
                titulo:'Felicidades',
                mensaje:'La unidad de medida ha sido eliminado',
                tipo:'success',
            })
        },



        showCreate(){
            this.columnaDerecha = 'create';
            this.unidadEdit = null;
            this.unidadDelet = null;
        },
        showDelet(unidad){
            this.unidadDelet = unidad;
        },
        showEdit(unidad){
            this.columnaDerecha = 'edit';
            this.unidadEdit = unidad;

        }
    }
}

</script>