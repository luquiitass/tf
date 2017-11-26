<template>
    <div>

        <tabla
            source="insumo/getData"
            :list="p_list"
            :attributes="{nombre:'Nombre',disponibilidad:'Disponibilidad',minimo:'Cant minimo'}"
            :nuevo="true"
            @nuevo="nuevoInsumo()">
        </tabla>

    </div>

</template>


<script>

export  default{
    data(){
        return{

        }
    },
    components:{

    },
    props: {
        p_list : {
            required:true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        nuevoInsumo(){
            this.$emit('nuevo');
        }
    }
}

</script>