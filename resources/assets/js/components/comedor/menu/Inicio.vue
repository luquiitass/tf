<template>
    <div>
        <h1>Inicio</h1>
        <!--<input type="text" v-model="ruta"/>-->
        <!--<button class="btn btn-primary " @click="ir()">Ir</button>-->
    </div>
</template>

<script>


export default{

    data(){
        return{
            ruta : 'comensales/com'
        }
    },

    methods:{
        ir(){
            console.log(this.ruta)
            var comensal =vm.app.comedor.comensales[0];
            console.log(comensal)

            router.push({ path: this.ruta , query:{p_comensal : vm.app.comedor.comensales[0] }});
        }
    }

}
</script>