<template>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                Posibles comensales
            </h3>
        </div>
        <div class="box-body">

            <div>
                <ul class="list-group">
                    <li class="list-group-item" v-for="comensal in comensales">
                        {{comensal.usuario.apellido}} {{comensal.usuario.nombre}}
                    </li>
                </ul>
            </div>

        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            comensales : {}
        }
    },
    props: {
        p_instancia : {
            required : true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comida.attribure(
                    this.p_instancia.comida.id,
                    'comensales',
                    comensales => this.comensales = comensales
            )
        }
    }
}

</script>