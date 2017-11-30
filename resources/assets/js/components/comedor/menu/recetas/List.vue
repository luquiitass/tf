<template>
    <div>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            list : []
        }
    },
    components:{

    },
    props: {
        p_list:{
            required:true,
        }
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