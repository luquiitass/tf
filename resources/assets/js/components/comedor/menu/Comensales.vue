<template>
    <div>

        <router-view></router-view>

        <!--<index v-show="!comensalShow" :comensal="comensalShow" @showComensal="showComensal"></index>-->

        <!--<show v-if="comensalShow" :p_comensal="comensalShow" @cancelar="cancelarShow" @updateComensal="updateComensal"></show>-->
    </div>
</template>

<script>
import Index from './comensales/Index.vue';
import Show from './comensales/Show.vue';

export default{

    data(){
        return {
            view:'index',
            comensalShow:''

        }
    },
    components:{
        Index,
        Show
    },
    created : function () {

    },
    methods:{
        showView(view){
            this.view = view;
        },
        isView(view){
            return this.view == view;
        },
        showComensal(comensal){
            this.comensalShow = comensal;
        }
        ,updateComensal(comensal){
           this.comensalShow = comensal;
        }
        ,
        cancelarShow(comensal){
            this.showComensal(comensal);
            var self = this;
            new Promise((resolve, reject) => {
                setTimeout(function(){
                    self.showComensal(null);
                    resolve("¡Éxito!");
                }, 250);
            });

        }

    }

}
</script>