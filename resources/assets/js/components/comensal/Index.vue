<template>

    <router-view name="content_comensal"></router-view>

</template>

<script>

export default{
    props:{
        p_comensal:{
            required:true,
        },
        p_usuario:{
            required:true,
        }
    },
    data(){
        return{
            comensal : this.p_comensal,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Vue.set(vm.$data.app,'comedor',this.p_comensal.comedor);
            Vue.set(vm.$data.app,'comensal',this.p_comensal);
            Vue.set(vm.$data.app,'usuario',this.p_usuario);
        }
    }

}

</script>