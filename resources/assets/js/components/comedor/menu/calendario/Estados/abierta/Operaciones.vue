<template>
    <div>

        <div class="box ">

            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body text-center">
                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        <div class="callout text-center">
                            <button class="btn btn-primary" @click="cerrarInscripcion()">
                                Cerrar Inscripcion
                            </button>

                        <p class="text-warning">Al cerrar la inscripcion los comensales no podran inscribirce ni cancelar sus inscripciones.</p>

                    </div>

                    </div>



                    <div class="col-xs-12 col-md-6 ">

                        <div class="callout text-center">
                            <button class="btn btn-primary" @click="suspenderInscripcion()">
                                Suspender instancia
                            </button>

                        <p class="text-warning">Descripcion</p>

                    </div>

                    </div>
                </div>



            </div>

        </div>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            instancia : vm.app.instancia
        }
    },
    props: {
        p_instancia :{
            required : true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        cerrarInscripcion(){
            Instancia.function(
                    'Instancia',
                    this.p_instancia.id,
                    'cerrarInscripcion',
                    instancia=>{
                        this.$emit('update',instancia);
                        //Vue.set(vm.app,'instancia',instancia);
                        //console.log(estados);
                    }
            )
        },
        suspenderInscripcion(){
            Instancia.function(
                    'Instancia',
                    this.p_instancia.id,
                    'suspenderInstancia',
                    instancia=>{
                        this.$emit('update',instancia);
                    }
            )
        }
    }
}

</script>