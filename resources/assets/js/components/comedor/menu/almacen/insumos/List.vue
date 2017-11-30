<template>
    <div>

        <tabla
            :source="'insumo/getData?comedor_id=' + comedor.id"
            :list="p_list"

            :attributes="{'nombre':'Nombre',disponibilidad:'Disponibilidad',minimo:'Cant minimo'}"

            :itemSelected="p_itemSelect"

            :nuevo="true"
            @nuevo="nuevoInsumo()"
            @selectItem="select">


            <th slot="th1">
              U
            </th>

            <td v-for="insumo in p_list" :slot="slotTd(1,insumo)">
                {{insumo.unidad_de_medida.nombre}}
            </td>

        </tabla>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor
        }
    },
    components:{

    },
    props: {
        p_list : {
            required:true,
        },
        p_itemSelect:{
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        nuevoInsumo(){
            this.$emit('nuevo');
        },
        select(item){
            this.$emit('select',item);
        },
        slotTd(num,row){
            console.log('list'+num + '_td_' + row.id)
            return num + '_td_' + row.id;
        }

    }
}

</script>