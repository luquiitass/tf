<template>
    <div>
        <div class="callout callout-info">
            <h4>
                <i class="icon fa fa-info"></i>
                Instancia "Suspendida"
            </h4>

            <p> Esta instancia se encuantran Suspendida"</p>
        </div>

    </div>

</template>


<script>

export  default{
    data(){
        return{

        }
    },
    props: {
        p_instancia :{
            required : true
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