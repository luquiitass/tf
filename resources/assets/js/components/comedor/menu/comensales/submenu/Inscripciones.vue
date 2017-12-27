<template>
    <div>

        <div class="dias">


                    <div class="dia" v-for="(comidas,dia) in comidasByDia" >
                        {{dia}}
                        <span>{{comidas[0].fecha.date | moment('Do MMMM') }}</span>
                        <div class="btn-group btn-block comidas"  v-for="comida in comidas" v-if="comida.activo">

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
            asistencias : [],
            comidasByDia : [],
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
    computed : {

    },
    watch:{


    },
    methods: {
        init(){
            this.asistencias = new Coleccion(this.comensal.asistencias);
            Comedor.function2(
                    this.comedor.id,
                    'comidasByDia',
                    comidas => {
                        this.comedor.comidas = comidas;
                        this.updateComidasByDia();
                    }
            );

            Dia.all(dias => {
                this.dias = _.pluck(dias, 'nombre');
                this.updateComidasByDia();
            });

            Comensal.attribute2(
                    this.comensal.id,
                    'comidas',
                    asistencias => {
                        this.asistencias = new Coleccion(asistencias);
                        this.updateComidasByDia();
                    }
            );
            //
        },
        updateComidasByDia(){
            this.comidasByDia = this.comidasPorDia();
        },
        change(comida){
            this.select = comida;
            var form = new Form({comida: comida});
            var self = this;
            form.post(PATH + 'comensal/cambiarInscripcion/' + this.comensal.id)
                    .then(inscripcion=> {
                        self.select = null;
                        if (self.isInscripto(comida)) {
                            self.asistencias.remove(comida);
                        } else {
                            self.asistencias.addOrReplace(comida);
                        }
                        this.comensal.inscripciones.unshift(inscripcion);
                    })
                    .catch(error => {
                        console.log(error);
                        this.select = null;

                    })

        },
        isInscripto(comida){
            return this.asistencias.has(comida.id);
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
            var dias = this.dias
            var comidas = this.comedor.comidas;
            for( var key in dias){
                var exist = _.has(comidas , dias[key]);
                if(exist){
                    retorno[dias[key]] = comidas[dias[key]];
                }
            }
            return retorno;
        }
    }
}

</script>