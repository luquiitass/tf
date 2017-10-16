<template>
    <div>
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form"></inputs>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
                    <button class="btn btn-warning" @click="cancelar()">Cancelar</button>
                </div>
            </div>

        </form>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsTiposDeComida.vue';

export  default{
    data(){
        return{
            form:new Form({nombre:'',inicio:'',fin:'',comedor_id:vm.app.comedor.id,comidas_por_dia:[]}),
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
            this.form.post( PATH +'tipoComida')
                    .then(tipo =>{
                        this.$emit('addTipoComida',tipo);
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