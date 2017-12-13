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

                <component :p_instancia="instancia" :is="getViewEstado(instancia.estadoActivo,'desc')" ></component>

                <component :p_instancia="instancia" @update="update" :is="getViewEstado(instancia.estadoActivo,'op')" ></component>

                <component :p_instancia="instancia" :is="getViewEstado(instancia.estadoActivo,'info')" ></component>

                <component :p_instancia="instancia" :is="getViewEstado(instancia.estadoActivo,'otros')" ></component>


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
                                <li :class="getClassEstado(estado)" v-for="estado in allEstados()">
                                    {{estado.nombre}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9">

                    <component :p_instancia="instancia" :is="getViewEstado(instancia.estadoActivo,'tabla')" ></component>

                </div>
            </div>
        </div>

    </div>
</template>


<script>

import DescAbierta from './Estados/abierta/Descripcion.vue';
import OpAbierta from './Estados/abierta/Operaciones.vue';
import InfoAbierta from './Estados/abierta/Informacion.vue';
import TablaAbierta from './Estados/abierta/Tabla.vue';

import DescCerrada from './Estados/cerrada/Descripcion.vue';
import OpCerrada from './Estados/cerrada/Operaciones.vue';
import InfoCerrada from './Estados/cerrada/Informacion.vue';
import TablaCerrada from './Estados/cerrada/Tabla.vue';
import OtrosCerrada from './Estados/cerrada/Otros.vue';

import DescFinalizada from './Estados/finalizada/Descripcion.vue';
import OpFinalizada from './Estados/finalizada/Operaciones.vue';
import InfoFinalizada from './Estados/finalizada/Informacion.vue';
import TablaFinalizada from './Estados/finalizada/Tabla.vue';

import DescSuspendida from './Estados/suspendida/Descripcion.vue';
import OpSuspendida from './Estados/suspendida/Operaciones.vue';
import InfoSuspendida from './Estados/suspendida/Informacion.vue';
import TablaSuspendida from './Estados/suspendida/Tabla.vue';


export  default{
    data(){
        return{
            instancia :{}
        }
    },
    components:{
        DescAbierta,
        OpAbierta,
        InfoAbierta,
        TablaAbierta,

        DescCerrada,
        OpCerrada,
        InfoCerrada,
        TablaCerrada,
        OtrosCerrada,

        DescFinalizada,
        OpFinalizada,
        InfoFinalizada,
        TablaFinalizada,

        DescSuspendida,
        OpSuspendida,
        InfoSuspendida,
        TablaSuspendida
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

            Instancia.find(this.$route.params.id, instancia => {
                this.instancia = instancia;
            })
        },
        atras(){
            router.go(-1)
        },
        isEstadoActivo(estado){
            return this.instancia.estadoActivo.id == estado.id
        },
        isEstado(estado,nombre){
            return estado.nombre == nombre;
        },
        getClassEstado(estado){
            var misEstados =_.indexBy(this.instancia.estados, 'id')

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
        },
        allEstados(){
            return _.sortBy(this.instancia.allEstados, 'id');
        },
        getViewEstado(est,pre){
            var estado= '';
            if(this.isEstado(est,'Inscripcion abierta')){
                estado = 'abierta';
            }else if(this.isEstado(est,'Inscripcion cerrada')){
                estado = 'cerrada';
            }else if(this.isEstado(est,'Finalizada')){
                estado = 'finalizada';
            }else{
                estado = 'suspendida';
            }
            return pre + '-' + estado;
        },
        update(instancia){
            this.instancia = instancia;
        }

    }
}

</script>