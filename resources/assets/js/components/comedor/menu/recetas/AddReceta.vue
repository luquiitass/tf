<template>
    <div>
        <search
            :url="'receta/comedor/'+ comedor.id +'/search'"
            :columns="'nombre'"
            :items="recetas"
            @update="rece=>{recetas=rece}"
            @itemSelected="selectReceta">
        </search>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            recetas: [],
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        selectReceta(receta){
            this.$emit('select',receta);
        }
    }
}

</script>