<template>
    <div>
        <titulo>
            Inicio
        </titulo>

        <direccion
            :p_form="form"
            @update="dire=>{form.direccion = dire}">
        </direccion>

    </div>
</template>

<script >

import Titulo from '../components/oters/Titulo.vue';
import Direccion from '../components/oters/Direccion.vue';

export default{
    data(){
        return {
            form : new Form()
        }
    },

    created(){


    },
    components :{
        Titulo,
        Direccion
    },
    methods:{

    }
}

</script>