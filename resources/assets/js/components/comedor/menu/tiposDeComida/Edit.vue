<template>
    <div>
        <h3>
            Modificar Tipo de Comida
        </h3>
        <hr/>
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form" edit="true"></inputs>

            <div class="pull-right">
                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Modificar</button>
                <button class="btn btn-warning" @click="cancelar()">Cancelar</button>

            </div>

        </form>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsTiposDeComida.vue';

export  default{
    data(){
        return{
            form:new Form(this.p_tipo),
        }
    },
    components:{
        Inputs
    },
    props: {
        p_tipo:{
            required:true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        onSubmit(){
            this.form.put( PATH +'tipoComida/' + this.p_tipo.id)
                    .then(tipo =>{
                        this.$emit('tipoComidaEdited',tipo);
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