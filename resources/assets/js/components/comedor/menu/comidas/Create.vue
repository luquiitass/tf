<template>
    <div>
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form"></inputs>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit"  class="btn btn-success">Guardar</button>
                    <button class="btn btn-warning" @click="cancelar()">Cancelar</button>
                </div>
            </div>

        </form>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsComidas.vue';

export  default{
    data(){
        return{
            form:new Form({tipo_comida_id:'',inicio:'',fin:'',comedor_id:vm.app.comedor.id,dias:[],hora_pre_inscripcion:''}),
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
            this.form.post( PATH +'comida')
                    .then(tipos =>{
                        this.$emit('addTiposComida',tipos);
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