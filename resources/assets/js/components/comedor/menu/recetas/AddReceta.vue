<template>
    <div>

        <div v-if="!listar">
            <search
                :url="'receta/comedor/'+ comedor.id +'/search'"
                :columns="'nombre'"
                :items="recetas"
                @update="rece=>{recetas=rece}"
                @itemSelected="selectReceta">
            </search>

            <a class="pull-right manita" @click="listarRecetas()" ><i class="fa  fa-list-ul"></i> Listar todas</a>

        </div>


        <modal
            :p_show="listar"
            @cancelado="listar=false">

            <div slot="title"> Todos</div>

            <ul class="list-group lista">
                <li class="list-group-item manita" v-for="receta in recetas" @click="selectReceta(receta)">
                    {{receta.nombre}}
                </li>
            </ul>

        </modal>


    </div>


</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            recetas: [],
            listar : false,
            recetas:{}
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        selectReceta(receta){
            this.listar = false;
            this.$emit('select',receta);
        },
        listarRecetas(){
            this.listar = true;
            Receta.all(recetas=> {
               this.recetas = recetas
            });

          /*  Receta.functionStatic('with("ingredientes")->get',recetas=>{
                console.log(recetas);
            });*/
        }
    }
}

</script>