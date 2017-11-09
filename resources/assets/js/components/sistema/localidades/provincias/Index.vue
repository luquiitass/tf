<template>
    <div v-if="p_pais">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Provincias de {{p_pais.nombre}}
                </h3>
                <div class="box-tools">
                    <div class="dropdown">
                        <button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown">                                    <i class="fa fa-plus"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left">
                            <li>
                                <create-provincia
                                    :p_pais="p_pais"
                                    @nuevaProvincia="addProvincia">
                                </create-provincia>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Fin del header-->
        <div class="box-body">

            <ul class="list-group">
                <li class="list-group-item" v-for="provincia in provincias.datos">
                    <edit-provincia
                            v-if="provinciaEdit == provincia"
                            :p_provincia="provincia"
                            @provinciaModificado="pa => {provincia = pa}"
                            @cancelado="provinciaEdit = null"
                    ></edit-provincia>

                    <div v-else="">

                        <a>{{provincia.nombre}}</a>

                        <div class="btn-group btn-xs pull-right">
                            <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="eliminarProvincia(provincia)">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="editarProvincia(provincia)">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Ver Localidades" @click="selectProvincia(provincia)">
                                <i class="fa fa-chevron-right" ></i>
                            </a>
                        </div>

                    </div>
                </li>
                <li class="list-group-item" v-if="false">
                    No posee provincias
                </li>
            </ul>
        </div>
        <!--Fin del body-->
    </div>
        <!--Fin del box-->

        <modal-delet
            v-if="modalDelet"
            :titulo="'Eliminar'"
            :text="'Esta seguro de eliminar el provincia ' + provinciaDelet.nombre "
            :url="'provincia/' + provinciaDelet.id"
            @eliminado="deleted(provinciaDelet)"
            @cancelado="modalDelet = false">
        </modal-delet>


</div>

</template>


<script>

import CreateProvincia from './Create.vue';
import EditProvincia from './Edit.vue';

export  default{
    data(){
        return{
            provincias : new Coleccion({}),
            provinciaEdit : null,
            modalDelet : false,
        }
    },
    components :{
        CreateProvincia,
        EditProvincia
    },
    props: {
        p_pais:{
            required:true
        }
    },
    watch:{
        p_pais(value){
            if (value){
                Pais.attribure(
                        this.p_pais.id,
                        'provincias',
                        all => {this.provincias.record(all)});
            }
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
        },
        addProvincia(provincia){
            this.provincias.addOrReplace(provincia);
            this.provincias.update();
            $('.dropdown-toggle').dropdown();
        },
        deleted(provincia){
            this.provincias.remove(provincia);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Provincia' +
                ' eliminado',
                type: 'success',
                duration: 20000,
            });
        },
        editarProvincia(provincia){
            this.provinciaEdit = provincia;
        },
        eliminarProvincia(provincia){
            this.modalDelet = true;
            this.provinciaDelet = provincia;
        },
        provinciasCount(){
            return this.provincias.datos.length;
        },
        selectProvincia(provincia){
            this.$emit('provinciaSelect',provincia);
        }
    }
}

</script>