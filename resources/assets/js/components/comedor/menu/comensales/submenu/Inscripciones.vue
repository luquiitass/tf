<template>
    <div>

        <div class="dias">


                    <div class="dia" v-for="(comidas,dia) in comidasPorDia()" style="border: 0px; background-color: transparent !important;">
                        {{dia}}
                                <div class="btn-group btn-block comidas"  v-for="comida in comidas">

                                    <button type="button" :class="classButton(comida)" :disabled="comida == select" @click="change(comida)">
                                        {{nombreComidaCambiando(comida)}}
                                        <i :class="iconButton(comida)" v-if="comida != select"></i>
                                        <i v-else class="fa fa-spinner fa-spin fa-fw pull-right"></i>
                                    </button>
                                    <!--<div class="form-group input-group conBordes link manita" >-->
                                        <!--<span class="input-group-addon sinBordes">-->
                                            <!--<img :src="img(comida) | path" alt="anotado" width="30px"/>-->
                                        <!--</span>-->
                                        <!--<p style="margin: 0px">-->
                                            <!--{{comida.tipo_comida.nombre}}-->
                                            <!--<span style="font-size: small">-->
                                            <!--(Anotado)-->
                                        <!--</span>-->
                                        <!--</p>-->
                                        <!--<span class="input-group-addon sinBordes" data-toggle="dropdown" aria-expanded="false">-->
                                            <!--<i class="fa fa-refresh"></i>-->
                                        <!--</span>-->

                                    <!--</div>-->

                                </div>

                    </div>
        </div>
    </div>
</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            inscripciones : [],
            select:null,
            dias : Constants.dias(),
        }
    },
    props: {
        comensal :{
            required:true
        }

    },
    created(){
        this.init();
    },
    computed:{

    },
    methods: {
        init(){
            this.inscripciones = new Coleccion(this.comensal.inscripciones);
            Comedor.attribure(
                    this.comedor.id,
                    'comidasPorDia',
                    comidas => this.comedor.comidasPorDia = comidas
            );
            Comensal.attribure(
                    this.comensal.id,
                    'inscripciones',
                    inscripciones => this.comensal.inscripciones = new Coleccion(inscripciones)
            );
            //
        },
        change(comida){
            this.select = comida;
            var form = new Form({comida: comida});
            var self = this;
            form.post(PATH + 'comensal/cambiarInscripcion/' + this.comensal.id)
                    .then(data=> {
                        self.select = null;
                        if (self.isInscripto(comida)) {
                            self.inscripciones.remove(comida);
                        } else {
                            self.inscripciones.addOrReplace(comida);
                        }

                    })
                    .catch(error => {
                        console.log(error);
                        this.select = null;

                    })

        },
        isInscripto(comida){
            return this.inscripciones.has(comida.id);
        },
        classButton(comida){
            return this.isInscripto(comida) ? 'btn  btn-block dropdown-toggle btn-success' : 'btn  btn-block dropdown-toggle btn-danger';
        },
        iconButton(comida){
            return this.isInscripto(comida) ? 'pull-right fa fa-check' : 'pull-right fa fa-times'
        },
        img(comida){
            return this.isInscripto(comida) ? 'img/si_comida.png' : 'img/no_comida.png';
        },
        nombreComidaCambiando(comida){
            return (comida == this.select) ? 'Cambiando' : comida.tipo_comida.nombre;
        },
        comidasPorDia(){
            var retorno = {};
            var dias = this.dias;
            for( var key in dias){
                var exist = _.has(this.comedor.comidasPorDia , dias[key]);
                if(exist){
                    retorno[dias[key]] = this.comedor.comidasPorDia[dias[key]];
                }
            }
            return retorno;
        }
    }
}

</script>