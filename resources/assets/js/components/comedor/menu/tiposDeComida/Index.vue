<template>
    <div>
        <titulo>
            Tipos de comida

            <button class="btn btn-primary " @click="modalShow=true">Nuevo
                <i class="fa fa-plus"></i>
            </button>

        </titulo>

    <div class="row match-my-cols">

        <div class="col-xs-12 col-md-2" id="colmin">

            <ul class="nav nav-pills nav-stacked">
                <li v-for="(tipo,nombre) in tiposComidas" :class="isActive(tipo)">
                    <a @click="showTipoComida(tipo)" >{{nombre}}</a>
                </li>
            </ul>

        </div>

        <div class="col-xs-12 col-md-10">
            <div>

                <show-tipo-comida
                    v-if="componenteDerecho=='show'"
                    :p_tipo="tipoComidaShow"
                    @showEdit="showEdit()"
                    @showDelet="showDelet()">
                </show-tipo-comida>

                <edit-tipo-comida
                    v-if="componenteDerecho=='edit'"
                    :p_tipo="tipoComidaEdit"
                    @tipoComidaEdited="tipoComidaEdited"
                    @cancelado="showTipoComida(tipoComidaShow)">
                </edit-tipo-comida>

                <modal-delet v-if="tipoComidaDelet"
                    :titulo="'Eliminar'"
                    :text="'Esta seguro de eliminar  ' + tipoComidaDelet.nombre "
                    :url="'tipoComida/' + tipoComidaDelet.id"
                    @eliminado="tipoComidaDeleted(tipoComidaShow)"
                    @cancelado="tipoComidaDelet = null">
                </modal-delet>
            </div>
        </div>
        <!--Fin de columna-->
    </div>
    <!-- fin Row -->
    <modal
        :p_show="modalShow"
        v-show="modalShow"
        @cancelado="modalShow=false">

        <div slot="title">Nuevo Comensal</div>

        <create
            v-if="modalShow"
            @addTipoComida="addTipoComida"
            @cancelado="modalShow=false">
        </create>

    </modal>

    </div>
</template>

<script>

import Create from './Create.vue';
import ShowTipoComida from './Show.vue';
import EditTipoComida from './Edit.vue';


export default{
    data(){
        return{
            comedor : vm.app.comedor,
            modalShow :false,
            tiposComidas : '',
            componenteDerecho:'show',
            tipoComidaShow:null,
            tipoComidaEdit:null,
            tipoComidaDelet:null,

        }
    },
    components:{
        Create,
        ShowTipoComida,
        EditTipoComida,
    },
    props: {

    },
    created(){
        this.init();
        this.getTiposComidas()
    },
    methods:{
        init(){

            Comedor.attribure(this.comedor.id,
            'comidasByTipoComida',
            tipos => this.tiposComidas = tipos);
        },
        getTiposComidas(){
//            axios.get(PATH + 'tiposComida?comedor=' + this.comedor.id)
//                    .then(response=>{
//                        this.tiposComida = response.data;
//                        this.showTipoComida(_.first(this.tiposComida));
//                    })
//                    .catch(error=>{
//                        console.log(error);
//                    })
            //Comedor.attribure(this.comedor.id,'tiposComidas',tipos => this.tiposComidas = tipos);
        },

        addTipoComida(tipo){
            this.tiposComidas.push(tipo);
            this.showTipoComida(tipo);
            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'Tipo decomida creado',
                type:'success',
                duration:1000
            });

        },
        tipoComidaEdited(tipo){
            this.showTipoComida(tipo);
            Utilidades.changeObjectListById(this.tiposComidas,tipo.id,tipo);
            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'Tipo de comida modificado',
                type:'success',
                duration:2000
            })
        },
        tipoComidaDeleted(tipo){
            Utilidades.deleteObjectList(this.tiposComidas,tipo.id);
            this.showTipoComida(_.first(this.tiposComidas));
            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'Tipo de comida ha sido eliminado',
                type:'success',
                duration:2000
            })
        },


        showTipoComida(tipo){
            this.tipoComidaShow = tipo;
            this.componenteDerecho = 'show'
        },
        showEdit(){
            this.componenteDerecho = 'edit'
            this.tipoComidaEdit = this.tipoComidaShow;
        },
        showDelet(){
            this.tipoComidaDelet = this.tipoComidaShow;
        },
        isActive(tipo){
            return this.tipoComidaShow == tipo ? 'manita active' : 'manita';
        }
    }

}
</script>