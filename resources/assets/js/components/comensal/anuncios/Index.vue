<template>
    <div>
        <titulo>
            Anuncios Comensal
        </titulo>

        <div class="row">
            <div class="col xs 12 col-md-8 col-md-offset-2">
                <div class="box box-solid">
                    <div class="box-header with-border">

                        <div class="box-tools">

                        </div>
                        <h3 class="box-title">
                            <i class="fa fa-comment"></i>
                        </h3>
                    </div>

                    <div class="box-body">
                        <div class="anuncios" v-if="anuncios.length">
                            <!-- Message. Default to the left -->
                            <div v-for="anuncio in anuncios">

                                <show
                                    :p_anuncio="anuncio"
                                    @editar="selectAnuncio(anuncio)"
                                    @eliminar="showDelet(anuncio)">
                                </show>

                            </div>

                        </div>

                        <div v-else="">
                            Sin anuncios
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>


<script>

import Show from '../../comedor/menu/anuncios/Show.vue'

export  default{
    data(){
        return{
            anuncios :vm.app.comensal.comedor.anuncios_activos,
            comensal : vm.app.comensal,

        }
    },
    props: {

    },
    components:{
        Show
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comedor.attribure(this.comensal.comedor.id,
                    'anunciosActivos',
                    anuncios => this.anuncios = anuncios
            );

        }
    }
}

</script>