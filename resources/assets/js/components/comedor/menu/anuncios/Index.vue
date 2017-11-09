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
                        <h3 class="box-title">Operaciondes de filtro y otros</h3>
                    </div>
                    <div class="body">
                        <div class="chat">

                            <div id="create_anuncio">
                                <create
                                    @addAnuncio="addAnuncio">
                                </create>
                            </div>

                            <div class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                <div class="direct-chat-msg border-top" v-for="anuncio in anuncios">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{{anuncio.usuario.apellido}} {{anuncio.usuario.nombre}}</span>
                                        <span class="direct-chat-timestamp pull-right">{{anuncio.registrado}}</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" :src="anuncio.usuario.foto" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        <p class="direct-chat-title">{{anuncio.asunto}}</p>
                                        <p>{{anuncio.cuerpo}}</p>
                                    </div>

                                    <div class="">
                                        <small  class="pull-right">visible hasta <cite title="Source Title">{{anuncio.hasta}}</cite></small>
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

    </div>

</template>


<script>

import Create from './Create.vue';

export  default{
    data(){
        return{
            anuncios : {},

        }
    },
    components:{
        Create,
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
        toggleCreate(){
            $('#create_anuncio').toggle(1000);
        }
    }
}

</script>