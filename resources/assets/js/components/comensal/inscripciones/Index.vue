<template>
    <div>
        <titulo>
            Incripciones Comensal
        </titulo>

        <inscripciones
            :comensal="comensal">
        </inscripciones>

    </div>


</template>


<script>

import Inscripciones from '../../comedor/menu/comensales/submenu/Inscripciones.vue'

export  default{
    data(){
        return{
            comensal : vm.app.comensal,
        }
    },
    components:{
        Inscripciones
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        }
    }
}

</script>