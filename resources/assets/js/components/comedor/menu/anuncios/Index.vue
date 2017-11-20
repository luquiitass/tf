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
                            <button class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Nuevo Anuncio" @click="toggleCreate()">
                                <i class="fa fa-plus"></i>
                            </button>

                        </div>
                        <h3 class="box-title">
                            <i class="fa fa-comment"></i>
                        </h3>
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

                            <div class="anuncios" v-if="anuncios.length">
                                <!-- Message. Default to the left -->
                                <div v-for="anuncio in anuncios">

                                    <show
                                        :p_anuncio="anuncio"
                                        :isAdmin="true"
                                        @editar="selectAnuncio(anuncio)"
                                        @eliminar="showDelet(anuncio)"
                                    >
                                    </show>


                                </div>

                                <!--<div :id="'anuncio_' + anuncio.id" :class="classAnuncio(anuncio)" v-for="anuncio in anuncios">
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <i class="fa fa-clock-o"></i> {{anuncio.registrado}}

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
                                            <i :class="classAnuncioVisible(anuncio)"></i>
                                             visible hasta <cite title="Source Title">{{anuncio.hasta}}</cite></small>
                                    </div>

                                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;
                                </div>-->
                                <!-- /.direct-chat-msg -->

                            </div>

                            <div v-else="">
                                Sin anuncios
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
import Show from './Show.vue';

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
            Comedor.attribure(
                    vm.app.comedor.id,
                    'anuncios',
                    anuncios => this.anuncios =anuncios
            );

        },
        addAnuncio(anuncio){
            this.addFirstList(this.anuncios,anuncio);
            //this.anuncios.unshift(anuncio);
        },
        editedAnuncio(anuncio){
            this.replaceObjectList(this.anuncios,anuncio);
        },
        deletedAnuncio(anuncio){
            this.$notify({
                group: 'g',
                title: 'Felicidades',
                text: 'Anuncio Eliminado',
                type: 'success',
                duration: 20000,
            });
            this.removeObjectList(this.anuncios,anuncio);
            //this.anuncios = this.removeObjectList(this.anuncios,anuncio.id);
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
        },
        classAnuncio(anuncio){
            return anuncio.visible ? 'anuncios-item': 'anuncios-item bg-danger';
        },
        classAnuncioVisible(anuncio){
            return anuncio.visible ? 'fa fa-eyes' :'fa fa-eye-slash';
        }
    }
}

</script>