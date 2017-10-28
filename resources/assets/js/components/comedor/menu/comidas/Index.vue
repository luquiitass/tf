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
                <li v-for="(tipo,nombre) in comidasByTipo" :class="isActive(tipo)">
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
                    @tipoComidasEdited="tipoComidasEdited"
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
            @addTiposComida="addTiposComida"
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
            comidasByTipo : '',
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
    },
    methods:{
        init(){

            Comedor.attribure(this.comedor.id,
            'comidasByTipoComida',
            tipos => {
                this.comidasByTipo = tipos;
            });


        },

        addTiposComida(tipos){
            this.comidasByTipo = tipos;
            this.componenteDerecho = 'create'
            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'Tipo decomida creado',
                type:'success',
                duration:1000
            });

        },
        tipoComidasEdited(tipos){
            //this.showTipoComida(tipo);
            this.comidasByTipo = tipos;
            this.showTipoComida( this.comidasByTipo[this.tipoComidaShow.nombre]);

            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'Tipo de comida modificado',
                type:'success',
                duration:2000
            })
        },
        tipoComidaDeleted(tipo){
            Utilidades.deleteObjectList(this.comidasByTipo,tipo.id);
            this.showTipoComida(_.first(this.comidasByTipo));
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
            this.tipoComidaEdit = this.tipoComidaShow ;
        },
        showDelet(){
            this.tipoComidaDelet = this.tipoComidaShow;
        },
        isActive(tipo){
            return this.tipoComidaShow == tipo ? 'manita active' : 'manita';
        },
        getTipoEdit(tipo){
            var dias = [];
            for (var comida in tipo){
                dias.unshift(tipo[comida].dia.id);
            }
            var comida = tipo[0];

            return {comedor_id:this.comedor.id,inicio:comida.inicio,fin:comida.fin,hora_pre_inscripcion : comida.hora_pre_inscripcion,tipo_comida : comida.tipo_comida_id,dias : dias};

        }
    }

}
</script>