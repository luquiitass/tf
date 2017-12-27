<template>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                Comensales inscriptos
            </h3>
        </div>
        <div class="box-body">

            <div>
                <ul class="list-group">
                    <li class="list-group-item" v-for="presencia in presencias">
                        {{presencia.comensal.usuario.apellido}} {{presencia.comensal.usuario.nombre}}

                        <span class="pull-right">{{isPresente(presencia)}}</span>
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
            presencias : {}
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
            Instancia.attribure(
                    this.p_instancia.id,
                    'presencias',
                    presencias => this.presencias = presencias
            );
           /* Comida.attribure(
                    this.p_instancia.comida.id,
                    'comensales',
                    comensales => this.comensales = comensales
            )*/
        },
        isPresente(presencia){
            return presencia.estado == 1 ? "Presente" : "Ausente";
        }
    }
}

</script>