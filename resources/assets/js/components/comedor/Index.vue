<template>

    <router-view name="content_comedor"></router-view>

</template>

<script>

export default{
    props:{
        p_comedor:{
            required:true,
        }
    },
    data(){
        return{
            comedor : this.p_comedor,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            console.log(vm.path)
            Vue.set(vm.$data.app,'comedor',this.p_comedor);
        }
    }

}

</script>