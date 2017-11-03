<template>
    <div>
        <titulo>
            Localidades
        </titulo>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <paises
                    @paisSelect="selectPais">

                </paises>
            </div>
            <div class="col-xs-12 col-md-4">

                <provincias
                    :p_pais="paisSelect">

                </provincias>

            </div>

            <div class="col-xs-12 col-md-4">


            </div>
        </div>
    </div>
</template>


<script>

import Paises from './paises/Index.vue';
import Provincias from './provincias/Index.vue';


export  default{
    data(){
        return{
            paises : new Coleccion({}),
            paisSelect:null,

        }
    },
    components:{
        Paises,
        Provincias
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        selectPais(pais){
            this.paisSelect = pais;
        }
    }
}

</script>