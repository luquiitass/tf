<template>
    <div v-if="instancia.comida">
        <titulo>

            <ol class="breadcrumb" slot="breadcrump">
                <li>
                    <a class="manita" @click="atras()">Calendario</a>
                </li>
                <li class="active">
                    instancia
                </li>
            </ol>

            Instancia - {{instancia.comida.tipo_comida.nombre}} del {{instancia.comida.dia.nombre}}
            <span>
                <i class="fa fa-clock-o"></i>
                {{instancia.fecha}}
            </span>

        </titulo>

        <div>
            <div>
                <div class="callout callout-info">
                    <h4>
                        <i class="icon fa fa-info"></i>
                        Estado de instancia
                    </h4>

                    <p>Descripcion del estado</p>
                </div>
                <!--Descripcion de cuando la fecha esta abierta-->


                <div>
                    <!--info y operaciones de este estado-->
                </div>
                <!--fin de  info y operaciones del estado-->

            </div>
            <!--descripciones de el estado actual-->


            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Estados
                            </h3>
                        </div>
                        <div class="box-body">
                            <ul class="list-group">
                                <li :class="getClassEstado(estado)" v-for="estado in instancia.estados">
                                    {{estado.nombre}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Anotados
                            </h3>
                        </div>
                        <div class="box-body">

                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item" v-for="presencia in instancia.presencias">
                                        {{presencia.comensal.usuario.apellido}} {{presencia.comensal.usuario.nombre}}
                                    </li>
                                </ul>
                            </div>

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
            instancia :{}
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Instancia.find(this.$route.params.id, instancia => this.instancia = instancia)
        },
        atras(){
            router.go(-1)
        },
        isEstadoActivo(estado){
            return this.instancia.instanciaEstadoActivo.estado.id == estado.id
        },
        isEstado(estado,nombre){
            return estado.nombre == nombre;
        },
        getClassEstado(estado){
            var misEstados =_.indexBy(this.instancia.instancias_estado, 'estado_id')

            var contain =  _.has(misEstados, estado.id);

            if (contain){
                if (this.isEstadoActivo(estado)){
                     return 'list-group-item bg-green-active';
                }
                return 'list-group-item bg-gray ';
            }
            return 'list-group-item bg-gray disabled';
        },
        getComensales(){
            return this.instancia.presencias ? this.instancia.presencias : [] ;
        }
    }
}

</script>