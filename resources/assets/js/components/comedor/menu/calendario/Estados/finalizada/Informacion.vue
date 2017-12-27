<template>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h4 class="box-title">
                Informacion
            </h4>
        </div>
        <div class="box-body">
            <div class="text-center">

                <div class="row">

                    <div class="col-xs-12 col-md-4"  >
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Comensales Anotados</span>
                                <span class="info-box-number">{{countComensales}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4" v-if="p_instancia.presentes" >
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Presentes</span>
                                <span class="info-box-number">{{p_instancia.presentes.length}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4"  v-if="p_instancia.ausentes">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Ausente</span>
                                <span class="info-box-number">{{p_instancia.ausentes.length}}</span>
                            </div>
                            <!-- /.info-box-content -->
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
            countComensales : 0
        }
    },
    props: {
        p_instancia:{
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comida.attribure(
                    this.p_instancia.comida.id,
                    'comensales_count',
                     count => { this.countComensales = count }
            )
        }
    }
}

</script>