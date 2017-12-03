<template>
    <div>
        <tabla
            :source="'receta/getData?comedor_id=' + comedor.id"
            :list="p_list"

            :attributes="{'nombre':'Nombre','porciones':'Num porciones'}"

            :itemSelected="p_itemSelect"

            @updatedList="updateList"

            :nuevo="true"
            @nuevo="nuevo"
            @selectItem="select">


            <!--<th slot="th1">
                UM
            </th>

            <td v-for="insumo in p_list" :slot="slotTd(1,insumo)">
                {{insumo.unidad_de_medida.nombre}}
            </td>
-->
        </tabla>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            comedor:vm.app.comedor,
        }
    },
    components:{

    },
    props: {
        p_list:{
            required:true,
        },
        p_itemSelect:{
            required:false
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },

        /*Propios*/
        nuevo(){
            this.$emit('nuevo');
        },
        select(item){
            if (item.id){
                this.$emit('select',item);
            }
        },
        updateList(items){
            this.p_list = items;
        }
    }
}

</script>