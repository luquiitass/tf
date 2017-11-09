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

                            <div id="create_anuncio" style="display: none">
                                <create
                                    @addAnuncio="addAnuncio"
                                    @cancelado="toggleCreate()"

                                >
                                </create>
                            </div>

                            <div class="anuncios">
                                <!-- Message. Default to the left -->
                                <div class="anuncios-item" v-for="anuncio in anuncios">
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <i class="fa fa-clock-o"></i>{{anuncio.registrado}}</span>
                                        <p class="anuncio-title pull-left">{{anuncio.asunto}}</p>
                                    </div>

                                    <div class="anuncio-cuerpo">
                                        <p>{{anuncio.cuerpo}}</p>
                                    </div>

                                    <div class="clearfix">
                                        <span class="anuncio-usuario pull-left">
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