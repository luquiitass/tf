<template>
    <div>
        <titulo>
            Localidades
        </titulo>
        <div class="row">
            <div class="col-xs-12 col-md-4 bg-success">
                <h3>
                    Paises

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Nuevo
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                                <create-pais
                                    @nuevoPais="">
                                </create-pais>


                            </li>

                        </ul>
                    </div>

                </h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="pais in paises">
                        <a>{{pais.nombre}}</a>
                    </li>
                </ul>


            </div>
            <div class="col-xs-12 col-md-4"></div>
            <div class="col-xs-12 col-md-4"></div>
        </div>
    </div>
</template>


<script>

import CreatePais from './paises/Create.vue';

export  default{
    data(){
        return{
            paises : new Coleccion({});

        }
    },
    components:{
        CreatePais
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

            Pais.all(all => {
                this.paises = all
            });
        }
    }
}

</script>