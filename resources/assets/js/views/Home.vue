<template>
    <div>
        <titulo>
            Inicio
        </titulo>

        <direccionn
            :p_form="form"
            @update="dire=>{form.direccion = dire}">
        </direccionn>

    </div>
</template>

<script >

import Titulo from '../components/oters/Titulo.vue';
import Direccionn from '../components/oters/Direccion.vue';

export default{
    data(){
        return {
            form : new Form({ direccion : new Direccion()})
        }
    },

    created(){


    },
    components :{
        Titulo,
        Direccionn
    },
    methods:{

    }
}

</script>