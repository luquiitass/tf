<template>
    <div>
        <search
            :url="'insumo/comedor/'+ comedor.id +'/search'"
            :columns="'nombre'"
            :items="insumos"
            @update="insu=>{insumos=insu}"
            @itemSelected="selectInsumo">
        </search>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            insumos: [],
            form: new Form()
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
        selectInsumo(insumo){
            this.$emit('select',insumo);
        }
    }
}

</script>