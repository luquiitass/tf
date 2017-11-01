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
                    <div class="panel-footer" v-if="comida.activo">
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
    computed:{
        comidas(){
            return _.each(this.comidasPorDia,function (item) {
                return _.filter(item,function (item) {
                    return item.activo;
                })
            })
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comedor.attribure(
                    this.comedor.id,
                    'comidasByDia',
                    comidas => this.comedor.comidas = comidas
            )
        },
        comidasPorDia(){
            var retorno = {};
            var dias = this.dias;
            for( var key in dias){
                var exist = _.has(this.comedor.comidas , dias[key]);
                if(exist){
                    retorno[dias[key]] = this.comedor.comidas[dias[key]];
                }
            }
            return retorno;
        },
        verAnotados(comida){

            router.push({ path:'/anotados/' + comida.id});

        }
    }
}

</script>