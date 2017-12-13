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
                            :p_instancia="p_instancia">
                       </create-menu>
                   </div>
               </div>
            </div>

        </div>


    </div>

</template>


<script>

import CreateMenu from '../../../menus/Create.vue';

export  default{
    data(){
        return{

        }
    },
    components:{
        CreateMenu,
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

      }
    }
}

</script>