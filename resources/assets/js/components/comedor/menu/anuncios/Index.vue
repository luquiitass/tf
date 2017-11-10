<template>
    <div>
        <titulo>
            Anuncios
        </titulo>

        <div class="row">
            <div class="col xs 12 col-md-8 col-md-offset-2">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div class="box-tools">
                            <button class="btn btn-xs btn-default" @click="toggleCreate()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="body">
                        <div class="chat">

                            <div id="create_edit_anuncio" style="display: none">

                                <edit
                                    v-if="anuncioSelect"
                                    :p_anuncio="anuncioSelect"
                                    @editedAnuncio="editedAnuncio"
                                    @cancelado="selectAnuncio(null)">
                                </edit>

                                <create
                                    v-else=""
                                    @addAnuncio="addAnuncio"
                                    @cancelado="selectAnuncio(null)">
                                </create>
                            </div>

                            <div class="anuncios">
                                <!-- Message. Default to the left -->
                                <div :id="'anuncio_' + anuncio.id" class="anuncios-item" v-for="anuncio in anuncios">
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <i class="fa fa-clock-o "></i>{{anuncio.registrado}}

                                            <a class="btn btn-xs hov" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="showDelet(anuncio)">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            <a class="btn btn-xs hov"  data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="selectAnuncio(anuncio)"  >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </span>
                                        <p class="anuncio-title pull-left">{{anuncio.asunto}}</p>
                                    </div>

                                    <div class="anuncio-cuerpo">
                                        <p>{{anuncio.cuerpo}}</p>
                                    </div>

                                    <div class="clearfix">
                                        <span class="anuncio-usuario pull-left ">
                                            <i class="fa fa-user"></i>
                                             {{anuncio.usuario.apellido}} {{anuncio.usuario.nombre}}
                                        </span>
                                        <small  class="pull-right">
                                            <i class="fa fa-eye"></i>
                                             visible hasta <cite title="Source Title">{{anuncio.hasta}}</cite></small>
                                    </div>

                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal-delet v-if="anuncioDelet"
             :titulo="'Eliminar'"
             :text="'Esta seguro de eliminar el anuncio con asunto: ' + anuncioDelet.asunto "
             :url="'anuncio/' + anuncioDelet.id"
            @eliminado="deletedAnuncio(anuncioDelet)"
            @cancelado="anuncioDelet = null">
        </modal-delet>


    </div>

</template>


<script>

import Create from './Create.vue';
import Edit from './Edit.vue';

export  default{
    data(){
        return{
            anuncios : {},
            anuncioSelect :'',
            anuncioDelet :''

        }
    },
    components:{
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
            Comedor.attribure(
                    vm.app.comedor.id,
                    'anuncios',
                    anuncios => this.anuncios =anuncios
            );

        },
        addAnuncio(anuncio){
            this.anuncios.unshift(anuncio);
        },
        editedAnuncio(anuncio){
            this.anuncios = this.replaceObjectList(this.anuncios,anuncio);
        },
        deletedAnuncio(anuncio){
            this.$notify({
                group: 'g',
                title: 'Felicidades',
                text: 'Anuncio Eliminado',
                type: 'success',
                duration: 20000,
            });
            this.anuncios = this.removeObjectList(this.anuncios,anuncio.id);
        },



        toggleCreate(){
            $('#create_edit_anuncio').toggle(1000);
        },
        selectAnuncio(anuncio){
            this.anuncioSelect = anuncio;
            this.toggleCreate();
            window.scrollTo(0,0)
        },
        showDelet(anuncio){
            this.anuncioDelet = anuncio;
        }
    }
}

</script>