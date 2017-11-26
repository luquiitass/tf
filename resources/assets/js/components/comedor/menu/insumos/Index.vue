<template>
    <div>
        <titulo>
            Insumos
        </titulo>

        <div>
            <div id="create-insumo" class="not-display">

                <create
                    @add="addInsumo"
                    @cancelar="toggleCreateInsumo()">
                </create>

            </div>


            <list
                :p_list="insumos"
                @nuevo="toggleCreateInsumo()">
            </list>







        </div>
    </div>

</template>


<script>
import Create from './Create.vue'
import List from './List.vue'


export  default{
    data(){
        return{
            insumos:[]
        }
    },
    components:{
        Create,
        List
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

            this.toggleCreateInsumo();
        },
        addInsumo(insumo){
            this.addFirstList(this.insumos,insumo);
        },


        toggleCreateInsumo(){
            $('#create-insumo').removeClass('hide');
            $('#create-insumo').toggle(2000);
        }
    }
}

</script>