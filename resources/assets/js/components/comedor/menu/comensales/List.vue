<template>
    <div>
        <titulo>
            Comensales
        </titulo>

        <tabla
            :source="'comensales/getData?comedor=' + comedor.id"
            @selectItem="showComensal"
            @updatedList="updateList"
            :list="comensales"
            :itemSelected="comensalShow"
            :attributes="{nombre:'Nombre',apellido:'Apelliddo',dni:'DNI',email:'Correo'}"
            :nuevo="true"
            :ver="true"
            @nuevo="showModal('create')">
        </tabla>

        <modal
            :p_show="isModalShow('create')"
            v-show="isModalShow('create')"
            @cancelado="showModal(null)">
            <div slot="title">Nuevo Comensal</div>

            <create-comensal
                v-if="isModalShow('create')"
                @comensalAdd="comensalAdd">
            </create-comensal>

            <div slot="footer"></div>
        </modal>
    </div>

</template>


<script>
import CreateComensal from './Create.vue';
import Modal from '../../../oters/Modal.vue'
import ModalScreenSize from '../../../oters/ModalScreemSize.vue'



export default{

    data(){
        return {
            comedor: vm.app.comedor,
            comensales:[],
            modalShow:'',
            comensalShow:''
        }
    },
    props:{
        comensal:{

        }
    },
    components:{
        Modal,
        ModalScreenSize,
        CreateComensal,
    },
    created : function () {

    },
    watch: {
        comensalShow: function () {
            //this.$emit('showComensal', this.comensalShow);
            router.push({ path: 'comensales/' + this.comensalShow.id});

        },
        comensal: function(){
            this.showComensal(this.comensal)
            if (this.comensal){
                console.log(this.comensal);
                Utilidades.changeObjectListBykeyAndValue(this.comensales,'id',this.comensal.id,this.comensal);
            }
        },
        comensales(){
            this.$set(vm.app.comedor,'comensales',this.comensales);
            //router.push({ path: 'comensales'});

        }
    },
    methods:{
        showModal(modal){
            this.modalShow = modal;
        },
        isModalShow(modal){
            return this.modalShow == modal;
        },


        comensalAdd(comensal){
            this.comensales.unshift(comensal);
            this.showComensal(comensal);
            this.showModal(null);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Comensal registrado',
                type: 'success',
                duration: 20000,
            });

            window.scrollTo(0,0);
        },

        showComensal(comensal){
            this.comensalShow = comensal;
        },
        updateList(list){
            this.comensales = list;
        }
    }

}

</script>