<template>
    <div>
        <titulo>
            Comensales
            <button class="btn btn-primary" @click="modalShow = 'create'">
                Nuevo Comensal
                <i class="fa fa-plus"></i>
            </button>
        </titulo>

        <tabla source="usuarios/getData" title="" @selectItem="" @updatedList="" :list="[]" :itemSelected="null" :attributes="{nombre:'Nombre',apellido:'Apelliddo',dni:'DNI',email:'Correo'}"></tabla>

        <modal
            v-if="isModalShow('create')"
            @cancelado="showModal(null)"
        >
            <div slot="title">Nuevo Comensal</div>

            <create-comensal>
            </create-comensal>

            <div slot="footer"></div>
        </modal>

    </div>
</template>

<script>
import CreateComensal from './comensales/Create.vue';
import Modal from '../../oters/Modal.vue'
import ModalScreenSize from '../../oters/ModalScreemSize.vue'



export default{

    data(){
        return {
            comensales:[],
            modalShow:'',
        }
    },
    components:{
        Modal,
        ModalScreenSize,
        CreateComensal,
    },
    created : function () {

    },
    methods:{
        showModal(modal){
            this.modalShow = modal;
        },
        isModalShow(modal){
            return this.modalShow == modal;
        }
    }

}
</script>