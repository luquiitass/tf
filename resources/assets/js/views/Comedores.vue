<template>
    <div>
        <titulo>
            Comedores
            <button class="btn btn-primary" @click="componenteDerecho = 'create'">
                Nuevo Comedor
                <i class="fa fa-plus-circle"></i>
            </button>
        </titulo>

        <div class="row">
            <div class="col-xs-12 col-md-8">

                <tabla source="comedores/getData" title="" @selectItem="showComedor" @updatedList="updateList" :list="comedores" :itemSelected="comedorSelect" :attributes="{nombre:'Nombre'}"></tabla>

            <!--<data-viewer source="comedores/getData" title="" @selectItem="showComedor" @updatedList="updateList" :list="comedores" :itemSelected="comedorSelect"/>-->
            </div>
            <div class="col-xs-12 col-md-4">
                <create-comedor
                    v-if="componenteDerecho == 'create'"
                    @comedorCreado="comedorAdd"
                    @cancelar="showComedor(null)"
                ></create-comedor>

                <show-comedor
                    v-if="componenteDerecho == 'show'"
                    :comedor="comedorShow"
                    @editComedor="showEdite"
                    @deletComedor="showDelete"
                    @cancelar="showComedor(null)">
                </show-comedor>

                <edit-comedor
                        v-if="componenteDerecho == 'edit'"
                        :comedor="comedorEdite"
                        @comedorModificado="comedorEdited"
                        @cancelar="showComedor(null)">
                </edit-comedor>
            </div>
        </div>
        <modal-delet v-if="comedorDelete"
             :titulo="'Eliminar Comedor'"
             :text="'Esta seguro de eliminar el comedor ' + comedorDelete.nombre"
             :url="'comedor/' + comedorDelete.id"
            @eliminado="comedorDeleted"
            @cancelado="comedorDelete=null;"
            ></modal-delet>
    </div>

</template>

<script>

import CreateComedor from '../components/comedor/view/CreateComedor';
import EditComedor from '../components/comedor/view/EditComedor';
import ShowComedor from '../components/comedor/view/ShowComedor';
import ModalDelet from '../components/oters/ModalDelet';



export default{

    data(){
        return{
            componenteDerecho:'create',
            comedores :{},
            comedorSelect:'',
            comedorShow:'',
            comedorEdite:'',
            comedorDelete:'',
        }
    },
    components:{
        CreateComedor,
        EditComedor,
        ShowComedor,
        ModalDelet
    },
    methods:{
        showComedor(comedor){
            this.componenteDerecho = 'show';
            this.comedorShow = comedor;
            this.comedorSelect = comedor;
            this.componentDrecho = 'show-comedor';
        },
        showEdite(comedor){
            this.componenteDerecho = 'edit';
            this.comedorEdite =comedor;
        },
        showDelete(comedor){
            this.comedorDelete = comedor;
        },
        comedorAdd(comedor){
            this.comedores.unshift(comedor);
            this.showComedor(comedor);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Comedor registrado',
                type: 'success',
                duration: 2000,
            });

            window.scrollTo(0,0);
        },
        comedorEdited(comedor){
            Utilidades.changeObjectListById(this.comedores,comedor.id,comedor);
            this.showComedor(comedor);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Comedor Modificado',
                type: 'success',
                duration: 2000,
            });
        },
        comedorDeleted(){
            if (Utilidades.deleteObjectList(this.comedores,this.comedorDelete.id)){
                this.$notify({
                    group: 'g',
                    title: 'Felicitaciones',
                    text: 'Comedor Eliminado',
                    type: 'success',
                    duration: 2000,
                });
                this.comedorDelete = null;
                this.showComedor(null);
            }
        },


        updateList(list){
            this.comedores = list;
        }

    }
}

</script>