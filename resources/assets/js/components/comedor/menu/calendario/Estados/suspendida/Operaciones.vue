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
                    <div class="col-xs-12 col-md-4">

                        <div class="callout">
                            <p>Descripcion</p>
                            <button class="btn btn-primary" @click="finalizarInstancia()">Finalizar Instancia</button>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-4">

                        <div class="callout">
                            <p>Descripcion</p>
                            <button class="btn btn-primary" @click="suspenderInscripcion()">Suspender instancia</button>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-4">

                        <div class="callout">
                            <p>Descripcion</p>
                            <button class="btn btn-primary" @click="suspenderInscripcion()">Suspender instancia</button>
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
        finalizarInstancia(){
            Instancia.function(
                    'Instancia',
                    this.p_instancia.id,
                    'finalizarInstancia',
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