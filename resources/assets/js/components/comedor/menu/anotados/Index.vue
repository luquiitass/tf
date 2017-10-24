<template>
    <div>
        <titulo>
            Anotados
        </titulo>

        <div class="dias">
            <div v-for="(comidas,dia) in comidasPorDia()" class="dia sinBordes transpatente">

                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class=""> {{dia}}</div>
                            </div>
                        </div>
                    </div>
                    <a v-for="comida in comidas" @click="verAnotados(comida)">
                    <div class="panel-footer">
                        <span class="pull-left">{{comida.tipo_comida.nombre}} </span>
                        <span class="pull-right badge">{{ comida.comensales_count }}</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</div>

        </template>


<script>

export  default{
    data(){
        return{
            dias : Constants.dias(),
            comedor : vm.app.comedor
        }
    },
    props: {
        usuario: {
            requerid: true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comedor.attribure(
                    this.comedor.id,
                    'comidasPorDiaCount',
                    comidas => this.comedor.comidasPorDiaCount = comidas
            )
        },
        comidasPorDia(){
            var retorno = {};
            var dias = this.dias;
            for( var key in dias){
                var exist = _.has(this.comedor.comidasPorDiaCount , dias[key]);
                if(exist){
                    retorno[dias[key]] = this.comedor.comidasPorDiaCount[dias[key]];
                }
            }
            return retorno;
        },
        verAnotados(comida){

            router.push({ path:'/anotados/' + comida.id,query : {comida : comida}});

        }
    }
}

</script>