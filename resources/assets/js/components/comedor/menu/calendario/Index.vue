<template>
    <div>
        <router-view name="submenu"></router-view>
    </div>
</template>


<script>

export  default{
    data(){
        return{

        }
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