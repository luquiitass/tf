<template>
    <div>
        <router-view></router-view>
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
            router.push({path:'/anotados/' + comida.dia , query : {comida:comida}});
        }
    }
}

</script>