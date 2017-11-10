<template>
    <div>
        <div class="text-center">
            <h3>Modificar Anuncio</h3>
        </div>

        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form"></inputs>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit"  class="btn btn-success">Modificar</button>
                    <a class="btn btn-warning" @click="cancelar()">Cancelar</a>
                </div>
            </div>

        </form>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsAnuncio.vue';

export  default{
    data(){
        return{

            form : new Form(this.p_anuncio),
        }
    },
    components:{
        Inputs
    },
    props: {
        p_anuncio:{
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        onSubmit(){
            this.form.put( PATH +'anuncio/' + this.p_anuncio.id)
                    .then(anuncio =>{
                        this.$emit('editedAnuncio',anuncio);
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