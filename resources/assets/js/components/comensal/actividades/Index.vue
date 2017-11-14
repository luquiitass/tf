<template>
    <div>
        <titulo>
            Actividades Comensal
        </titulo>
        <div class="row">

            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <historial :comensal="comensal"></historial>
            </div>
        </div>
    </div>
</template>


<script>

import Historial from '../../comedor/menu/comensales/submenu/Historial.vue'

export  default{
    data(){
        return{
            comensal : vm.app.comensal
        }
    },
    props: {

    },
    components:{
        Historial,
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