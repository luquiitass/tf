<template>

    <router-view name="content_comedor"></router-view>

</template>

<script>

export default{
    props:{
        p_comedor:{
            required:true,
        },
        p_usuario:{
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
            Vue.set(vm.$data.app,'comedor',this.p_comedor);
            Vue.set(vm.$data.app,'usuario',this.p_usuario);
        }
    }

}

</script>