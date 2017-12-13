<template>

    <div class="box box-default">
        <div class="box-header with-border">
            <h4 class="box-title">
                Informacion
            </h4>
        </div>
        <div class="box-body">
            <div class="text-center">

                <div class="row">

                    <div class="col-xs-12 col-md-4 col-md-offset-1"  >
                        <div class="info-box">
                            <span class="info-box-icon bg-red">
                                <i class="fa fa-users"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Comensales</span>
                                <span class="info-box-number">{{countComensales}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                     <div class="col-xs-12 col-md-4 col-md-offset-1"  >
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow">
                                <i class="fa fa-clock-o"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Fecha y hora</span>
                                <span class="info-box-number">{{p_instancia.fecha}}</span>
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
                     count => {
                        this.countComensales = count
                        this.p_instancia.count_comensales = count;
                    }
            )
        }
    }
}

</script>