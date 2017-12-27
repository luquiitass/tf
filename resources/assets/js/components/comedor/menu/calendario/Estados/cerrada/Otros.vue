<template>

    <div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Menu
                </h4>
            </div>
            <div class="box-body">
               <div>
                   <div id="create">
                       <create-menu
                        v-if="!p_instancia.menu"
                        :p_instancia="p_instancia"
                        @add="addMenu"
                       >
                       </create-menu>

                       <show-menu
                        v-else=""
                        :p_menu="p_instancia.menu">
                       </show-menu>


                   </div>
               </div>
            </div>

        </div>


    </div>

</template>


<script>

import CreateMenu from '../../../menus/Create.vue';
import ShowMenu from '../../../menus/Show.vue';

export  default{
    data(){
        return{

        }
    },
    components:{
        CreateMenu,
        ShowMenu,
    },
    props: {
        p_instancia:{
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        addMenu(menu){
          Vue.set(this.p_instancia,'menu',menu);
        }
    }
}

</script>