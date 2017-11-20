<template>
    <div>
        <titulo>
            Estados de tablas

            <button class="btn btn-primary">
                Nuevo
                <i class="fa fa-plus"></i>
            </button>

        </titulo>

        <div>
            <div class="row">

                <div class="col-xs-12 col-md-3">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">
                                Tablas
                            </h3>
                        </div>
                        <div class="box-body">

                        </div> <!--fin de body-->
                    </div> <!--fin del Box-->
                </div> <!--Fin de la columna-->


                <div class="col-xs-12 col-md-9">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">
                                Estados
                            </h3>
                        </div>
                        <div class="box-body">

                        </div> <!--fin de body-->
                    </div> <!--fin del Box-->
                </div>

            </div>

        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            estados:''
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        }
    }
}

</script>