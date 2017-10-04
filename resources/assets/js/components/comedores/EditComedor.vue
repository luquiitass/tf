<template>
    <div class="box box-solid">
        <div class="box-header wit-border">
            <a class="btn btn-xs pull-right" @click="cancelar()"><i class="fa fa-close"></i></a>
            <h3 class="box-title">Editar Comedor</h3>
        </div>

        <div class="box-body">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputsComedor :form="form" :edit="true" @cancelar(cancelarCreate)></inputsComedor>

            <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
        </form>
        </div>


    </div>

</template>

<script>

import InputsComedor from '../forms/InputsComedor';

export default{

    props :{
        comedor : {
            required : true,
        }
    },
    data(){
        return{
            form: new Form(this.comedor),
        }
    },
    components:{
        InputsComedor
    },
    methods:{
        onSubmit(){
            this.form
                    .put(PATH +'/comedor/' + this.comedor.id)
                    .then(comedor => this.$emit('comedorModificado',comedor));
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>