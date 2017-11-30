<template>
    <div>
        <titulo>
            Titulo
        </titulo>

        <div id="create-edit-show">


        </div>

    </div>

</template>


<script>
import Create from './Create.vue';
import Edit from './Edit.vue';
import Show from './Show.vue';
import List from './List.vue';

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            list : []
        }
    },
    components:{
        Create,
        Edit,
        Show,
        List
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        add(item){
            this.addFirstList(this.list,item);
            //Otras operaciones;
        },
        edited(item){
            this.replaceObjectList(this.lsit,item);
            //Ocultar view Edit
        },
        deleted(item){
            this.removeObjectList(this.item,item.id);
            Notificacion.mostrarMensaje({
                titulo:'Felicides',
                mensaje:'El #### ha sido eliminado',
                tipo:'success'
            })
        },


        //Mostrar Ocultar Vista Create, Edit, Show ,Delet}

        showCreate(){

        },
        showEdit(item){

        },
        showDelet(item){

        }
    }
}

</script>