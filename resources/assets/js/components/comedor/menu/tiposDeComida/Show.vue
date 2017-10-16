<template>
    <div>
        <div v-if="tipo">
            <div>
                <div class="pull-right btn-group">
                    <button class="btn btn-md btn-default" @click="showEdit()">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-md btn-default" @click="showDelet()">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>

            <h2>
                {{tipo.nombre}}
            </h2>
            <hr/>
            <div>
                <ul class="list-group">
                    <li class="list-group-item not-border">
                        <strong>Inicia: </strong> {{tipo.inicio}}
                    </li>
                    <li class="list-group-item not-border">
                        <strong>Finaliza: </strong> {{tipo.fin}}
                    </li>
                    <li class="list-group-item not-border">
                        <h3>Dias </h3>
                        <ul v-if="tipo.comidas_por_dia.length">
                            <li v-for="comida in tipo.comidas_por_dia">
                               {{comida.dia}}
                            </li>
                        </ul>
                        <div v-else="" class="alert alert-info">
                            <p>
                                Nada
                            </p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

        <div v-else>
            Seleccione un tipo de Comida
        </div>
    </div>
</template>

<script >


export default{

    props:{
        p_tipo:{
            required:true,
        }
    },
    data(){
        return{
            dias : Constants.dias(),
            tipo : this.p_tipo,

        }
    },
    components:{
    },
    watch:{
        p_tipo:function () {
            this.tipo = this.p_tipo;
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        showEdit(){
            this.$emit('showEdit');
        },
        showDelet(){
            this.$emit('showDelet');
        }
    }
}
</script>