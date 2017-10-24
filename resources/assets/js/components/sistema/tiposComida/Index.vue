<template>

    <div>
        <titulo>
            Tipos de comidas

            <button class="btn btn-primary" @click="showCreate()">
                Nuevo
                <i class="fa fa-plus"></i>
            </button>
        </titulo>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <ul class="list-group">
                    <li :class="isActive(tipo)" v-for="tipo in tipos.all()">

                        <a class=" btn pull-right manita "  @click="showTipo(tipo)">
                            <i class="fa fa-arrow-circle-o-right"></i>
                        </a>

                        {{tipo.nombre}}

                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6">

                <create
                    v-if="colDerecha == 'create'"
                    @add="addTipo"
                >
                </create>

                <show
                    v-if="colDerecha == 'show'"
                    :tipo="tipoSelect"
                    @edit="showEdit"
                    @delet="showDelet"
                    @cancelado="showCreate()">
                </show>

                <edit
                    v-if="colDerecha == 'edit'"
                    :tipo="tipoSelect"
                    @edited="edited"
                    @cancelado="colDerecha = 'show'">
                </edit>

                <modal-delet v-if="modalDelet"
                    :titulo="'Eliminar'"
                    :text="'Esta seguro de eliminar  ' + tipoSelect.nombre "
                    :url="'tipoComida/' + tipoSelect.id"
                    @eliminado="deleted(tipoSelect)"
                    @cancelado="modalDelet = false">
                </modal-delet>

            </div>
        </div>


    </div>

</template>


<script>

import Create from './Create.vue';
import Edit from  './Edit.vue';
import Show from './Show.vue';

export  default{
    data(){
        return{
            tipos : new Coleccion([]),
            colDerecha : 'create',
            tipoSelect : '',
            modalDelet : false,
        }
    },
    components:{
        Create,
        Edit,
        Show
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            TipoComida.all(data => this.tipos.record(data));
        },
        addTipo(tipo){
            this.tipos.addOrReplace(tipo);
            this.tipos.update();
            this.$notify({
                group: 'g',
                title : 'Felicidades',
                text:'Tipo de comida registrada',
                type:'success',
                duration:2000
            })
            this.showTipo(tipo);
        },
        edited(tipo){
            this.tipos.addOrReplace(tipo);
            this.$notify({
                group: 'g',
                title : 'Felicidades',
                text:'El Tipo de comida ha sido modificado',
                type:'success',
                duration:2000
            });
            this.showTipo(tipo);
            this.colDerecha = 'show'

        },
        deleted(tipo){
            this.tipos.remove(tipo);
            this.$notify({
                group: 'g',
                title : 'Felicidades',
                text:'El Tipo de comida ha sido Eliminado',
                type:'success',
                duration:2000
            });
            this.colDerecha = 'create'
        },

        showTipo(tipo){
            this.colDerecha = 'show';
            this.tipoSelect = tipo;
        },
        showEdit(){
            this.colDerecha = 'edit';
        },
        showCreate(){
            this.colDerecha = 'create';
            this.tipoSelect = null;
        },
        showDelet(){
            this.modalDelet = true;
        },
        isActive(tipo){
            return tipo == this.tipoSelect ? 'list-group-item manita  active' : 'list-group-item manita';
        }
    }
}

</script>