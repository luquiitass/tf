<template>
    <div>

        <titulo>
            Insumos
        </titulo>

        <div>
            <div id="create-insumo" class="not-display">

                <create
                    v-if="viewShow == 'create'"
                    @add="addInsumo"
                    @cancelar="toggleCreateEditInsumo(false)">
                </create>

                <edit
                    v-if="viewShow == 'edit'"
                    :objeto="insumoEdit"
                    @edited="editedInsumo"
                    @cancelar="toggleCreateEditInsumo(false)">
                </edit>

            </div>


            <list
                :p_list="insumos"
                @nuevo="showCreate()"
                :p_itemSelect="insumoSelect"
                @select="showInsumo">
            </list>


            <modal
                :p_show="insumoSelect"
                v-show="insumoSelect"
                @cancelado="showInsumo(null)">
                <div slot="title">Insumo</div>

                <show
                    :p_insumo="insumoSelect"
                    @cancelar="showInsumo(null)"
                    @edit="showEdit"
                    @delet=""
                    >
                </show>

                <div slot="footer"></div>
            </modal>

        </div>
    </div>

</template>


<script>
import Create from './Create.vue'
import Edit from './Edit.vue'
import List from './List.vue'
import Show from './Show.vue'


export  default{
    data(){
        return{
            insumos:[],
            insumoSelect:null,
            insumoEdit:null,
            viewShow : 'create'
        }
    },
    components:{
        Create,
        List,
        Show,
        Edit
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comedor.attribure(
                    vm.app.comedor.id,
                    'insumos',
                    insumos => this.insumos = insumos
            );

            //this.toggleCreateEditInsumo();
        },
        addInsumo(insumo){
            this.addFirstList(this.insumos,insumo)
            this.toggleCreateEditInsumo(false);
        },
        editedInsumo(insumo){
            this.replaceObjectList(this.insumos, insumo);
            this.toggleCreateEditInsumo(false);
        },


        toggleCreateEditInsumo(visible){
            if (visible){
                $('#create-insumo').show(1000);
            }else{
                $('#create-insumo').hide(1000);
            }
        },

        showInsumo(insumo){
            this.insumoSelect = insumo;
        },
        showEdit(insumo){
            this.viewShow = 'edit';
            this.insumoEdit = insumo;
            this. toggleCreateEditInsumo(true);
        },
        showCreate(){
            this.viewShow = 'create';
            this. toggleCreateEditInsumo(true);
        }
    }
}

</script>