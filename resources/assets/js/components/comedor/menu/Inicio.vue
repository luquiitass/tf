<template>
    <div>
        <h1>Inicio</h1>
        <!--<input type="text" v-model="ruta"/>-->
        <button class="btn btn-primary " @click="cargar()">Cargar</button>

        <div>
            {{at | json}}
        </div>
    </div>
</template>

<script>


export default{

    data(){
        return{
            ruta : 'comensales/com',
            at:{}
        }
    },



    methods:{
        ir(){
            console.log(this.ruta)
            var comensal =vm.app.comedor.comensales[0];
            console.log(comensal)

            router.push({ path: this.ruta , query:{p_comensal : vm.app.comedor.comensales[0] }});
        },

        cargar(){
            Instancia.all2(comedores => this.at = comedores) ;  ;
        }
    }

}
</script>