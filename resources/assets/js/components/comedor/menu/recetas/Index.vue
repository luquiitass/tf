<template>
    <div>
        <titulo>
            Recetas
        </titulo>

        <div id="create" class="not-display">

            <create
                @add="add"
                @cancelar="showCreate(false)">
            </create>
            <!--Form create-->
        </div><!--Vreta toggle-->

        <div>
            <list
                :p_list.sync="recetas"
                @nuevo="showCreate(true)"
                @select="showItem">
            </list>
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
            recetas : []
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
            Comedor.attribure(
                    comedor.id,
                    'recetas',
                    recetas => this.recetas = recetas
            )
        },
        add(item){
            this.addFirstList(this.recetas,item);
            //Otras operaciones;
        },
        edited(item){
            this.replaceObjectList(this.recetas,item);
            //Ocultar view Edit
        },
        deleted(item){
            this.removeObjectList(this.recetas,item.id);
            Notificacion.mostrarMensaje({
                titulo:'Felicides',
                mensaje:'El #### ha sido eliminado',
                tipo:'success'
            })
        },


        //Mostrar Ocultar Vista Create, Edit, Show ,Delet}

        showCreate(visible){
            if(visible){
                $('#create').show(1000)
            }else{
                $('#create').hide(1000)
            }

        },
        showEdit(item){

        },
        showDelet(item){

        },



        /*List*/
        showItem(item){
            router.push({ path: '/receta/' + item.id});
        }
    }
}

</script>