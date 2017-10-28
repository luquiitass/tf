<template>
    <div >
        <div v-if="!comida.legth">

            <titulo>

                <ol class="breadcrumb" slot="breadcrump">
                    <li>
                        <a class="manita" @click="atras()">Anotados</a>
                        </li>
                        <li class="active">
                            {{comida.dia.nombre}}
                        </li>
                    </ol>

                    Lista de Anotados - <b>{{comida.tipo_comida.nombre}}</b> del <b>{{comida.dia.nombre}}</b>
                </titulo>

            <div  class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3">

                    <label class="btn-block text-center">
                        Comensal/es Anotados : {{comida.comensales.length}}
                    </label>
                    <ul class="list-group">
                        <li v-for="(comensal,count) in comida.comensales" class="list-group-item">
                            <b>{{count +1}}_ </b> {{comensal.usuario.apellido}} {{comensal.usuario.nombre}}
                        </li>

                    </ul>

                </div>
            </div>

        </div>

        <loading v-show="comida.legth">

        </loading>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            comida : {},
            numAnotados : 0,
        }
    },
    computed:{

    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comida.find(this.$route.params.id, comida => this.comida = comida);
        },
        atras(){
            router.go(-1)
        },

    }
}

</script>