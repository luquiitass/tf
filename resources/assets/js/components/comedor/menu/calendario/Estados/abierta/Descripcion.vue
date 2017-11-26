<template>

    <div class="callout callout-info">
        <h4>
            <i class="icon fa fa-info"></i>
            Instancia con inscripciones "Abierta"
        </h4>

        <p> Las inscripciones a esta comida se encuentran abiertas hasta el dia "Obtener fecha"</p>
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