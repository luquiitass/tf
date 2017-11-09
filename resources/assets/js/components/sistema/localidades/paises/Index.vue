<template>
    <div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Paises
                </h3>
                <div class="box-tools">
                    <div class="dropdown">
                        <button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown">                                    <i class="fa fa-plus"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left">
                            <li>
                                <create-pais
                                    @nuevoPais="addPais">
                                </create-pais>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Fin del header-->
        <div class="box-body">

            <ul class="list-group">
                <li class="list-group-item" v-for="pais in paises.datos">
                    <edit-pais
                            v-if="paisEdit == pais"
                            :p_pais="pais"
                            @paisModificado="pa => {pais = pa}"
                            @cancelado="paisEdit = null"
                    ></edit-pais>

                    <div v-else="">

                        <a>{{pais.nombre}}</a>

                        <div class="btn-group btn-xs pull-right">
                            <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="eliminarPais(pais)">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="editarPais(pais)">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn" data-toggle="tooltip" data-placement="top" data-original-title="Ver Provincias" @click="selectPais(pais)">
                            <i class="fa fa-chevron-right"></i>
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
            :text="'Esta seguro de eliminar el pais ' + paisDelet.nombre "
            :url="'pais/' + paisDelet.id"
            @eliminado="deleted(paisDelet)"
            @cancelado="modalDelet = false">
        </modal-delet>


</div>

</template>


<script>

import CreatePais from './Create.vue';
import EditPais from './Edit.vue';

export  default{
    data(){
        return{
            paises : new Coleccion({}),
            paisEdit : null,
            modalDelet : false,
        }
    },
    components :{
        CreatePais,
        EditPais
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
          init(){

              Pais.all(all => {
                  this.paises.record(all)
              });
          },
        addPais(pais){
            this.paises.addOrReplace(pais);
            this.paises.update();
            $('.dropdown-toggle').dropdown();
        },
        deleted(pais){
            this.paises.remove(pais);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Pais eliminado',
                type: 'success',
                duration: 20000,
            });
        },
        editarPais(pais){
            this.paisEdit = pais;
        },
        eliminarPais(pais){
            this.modalDelet = true;
            this.paisDelet = pais;
        },
        selectPais(pais){
            this.$emit('paisSelect',pais)
        }
    }
}

</script>