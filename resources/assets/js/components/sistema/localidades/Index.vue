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
                    :p_pais="paisSelect"
                    @provinciaSelect="selectProvincia">

                </provincias>

            </div>

            <div class="col-xs-12 col-md-4">

                <localidades
                    :p_provincia="provinciaSelect">

                </localidades>

            </div>
        </div>
    </div>
</template>


<script>

import Paises from './paises/Index.vue';
import Provincias from './provincias/Index.vue';
import Localidades from './localidades/Index.vue';


export  default{
    data(){
        return{
            paises : new Coleccion({}),
            paisSelect:null,
            provinciaSelect:null

        }
    },
    components:{
        Paises,
        Provincias,
        Localidades
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
        },
        selectProvincia(provincia){
            this.provinciaSelect = provincia;
        }
    }
}

</script>