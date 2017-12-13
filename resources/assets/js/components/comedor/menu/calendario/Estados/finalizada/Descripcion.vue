<template>
    <div>
        <div class="callout callout-info">
            <h4>
                <i class="icon fa fa-info"></i>
                Instancia con inscripciones "Finalizada"
            </h4>

            <p> Las inscripciones a esta se encuantran cerradas y se llevaran a cabo el dia "@@Dia@@"</p>
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