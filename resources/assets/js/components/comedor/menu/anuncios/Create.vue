<template>
    <div>
        <div class="text-center">
            <h3>Nuevo Anuncio</h3>
        </div>

        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form"></inputs>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit"  class="btn btn-success">Guardar</button>
                    <a class="btn btn-warning" @click="cancelar()">Cancelar</a>
                </div>
            </div>

        </form>
        <hr/>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsAnuncio.vue';

export  default{
    data(){
        return{

            form : new Form({asunto:'' , cuerpo:'' ,  hasta:'',comedor_id : vm.app.comedor.id , user_id : vm.app.usuario.id}),
        }
    },
    components:{
        Inputs
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        onSubmit(){
            this.form.post( PATH +'anuncio')
                    .then(anuncio =>{
                        this.$emit('addAnuncio',anuncio);
                        this.form =  new Form({asunto:'' , cuerpo:'' ,  hasta:'',comedor_id : vm.app.comedor.id , user_id : vm.app.usuario.id});
                        this.cancelar();
                    })
                    .catch(error=>{
                        console.log(error);
                    });
        },
        cancelar(){
            this.$emit('cancelado');
        }
    }
}

</script>