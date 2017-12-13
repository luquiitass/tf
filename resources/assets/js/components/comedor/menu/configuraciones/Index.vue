<template>
    <div>
        <div>
            <titulo>
                Configuraciones
            </titulo>

            <div>
                <edit-inicio-fin
                    :objeto="objInicioFin">
                </edit-inicio-fin>
            </div>

        </div>
    </div>

</template>


<script>

import EditInicioFin from './InicioFin.vue';

export  default{
    data(){
        return{
            objInicioFin:{}
        }
    },
    components:{
        EditInicioFin,
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.objInicioFin = {inicia:'',finaliza:''};
        }
    }
}

</script>