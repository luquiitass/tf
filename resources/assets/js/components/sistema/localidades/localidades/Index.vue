<template>
    <div v-if="p_provincia">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Localidades de {{p_provincia.nombre}}
                </h3>
                <div class="box-tools">
                    <div class="dropdown">
                        <button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">                                    <i class="fa fa-plus"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left">
                            <li>
                                <create-localidad
                                    @nuevaLocalidad="addLocalidad"
                                    :p_provincia="p_provincia">
                                </create-localidad>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Fin del header-->
        <div class="box-body">

            <ul class="list-group">
                <li class="list-group-item" v-for="localidad in localidades.datos">
                    <edit-localidad
                            v-if="localidadEdit == localidad"
                            :p_localidad="localidad"
                            @localidadModificado="pa => {localidad = pa}"
                            @cancelado="localidadEdit = null"
                    ></edit-localidad>

                    <div v-else="">

                        <a>{{localidad.nombre}}</a>

                        <div class="btn-group btn-xs pull-right">
                            <a class="btn"  data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="eliminarLocalidad(localidad)">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a class="btn"  data-toggle="tooltip" data-placement="top" data-original-title="Editar Localidad" @click="editarLocalidad(localidad)">
                                <i class="fa fa-edit"></i>
                            </a>

                        </div>

                    </div>

                </li>
            </ul>
        </div>
        <!--Fin del body-->
    </div>
        <!--Fin del box-->

        <modal-delet
            v-if="modalDelet"
            :titulo="'Eliminar'"
            :text="'Esta seguro de eliminar el localidad ' + localidadDelet.nombre "
            :url="'localidad/' + localidadDelet.id"
            @eliminado="deleted(localidadDelet)"
            @cancelado="modalDelet = false">
        </modal-delet>


</div>

</template>


<script>

import CreateLocalidad from './Create.vue';
import EditLocalidad from './Edit.vue';

export  default{
    data(){
        return{
            localidades : new Coleccion({}),
            localidadEdit : null,
            modalDelet : false,
        }
    },
    components :{
        CreateLocalidad,
        EditLocalidad
    },
    props: {
        p_provincia:{
            required:true
        }
    },
    watch:{
        p_provincia(value){
            if (value){
                Provincia.attribure(
                        this.p_provincia.id,
                        'localidades',
                        all => {this.localidades.record(all)});
            }
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        addLocalidad(localidad){
            this.localidades.addOrReplace(localidad);
            this.localidades.update();
            $('.dropdown-toggle').dropdown();
        },
        deleted(localidad){
            this.localidades.remove(localidad);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Localidad eliminado',
                type: 'success',
                duration: 20000,
            });
        },
        editarLocalidad(localidad){
            this.localidadEdit = localidad;
        },
        eliminarLocalidad(localidad){
            this.modalDelet = true;
            this.localidadDelet = localidad;
        },
        selectLocalidad(localidad){
            this.$emit('localidadSelect',localidad)
        }
    }
}

</script>