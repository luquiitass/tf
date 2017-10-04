<template>
    <div class="box box-solid">
        <div class="box-header wit-border">
            <a class="btn btn-xs pull-right" @click="cancelar()"><i class="fa fa-close"></i></a>
            <h3 class="box-title">Crear Comedor</h3>
        </div>

        <div class="box-body">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputsComedor :form="form" :edit="false" @cancelar(cancelarCreate)></inputsComedor>

            <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
            <div class="has-error">
                <span class="help-block" v-if="form.errors.any()">Verificar los datos ingresados</span>
            </div>
        </form>
        </div>


    </div>

</template>

<script>

import InputsComedor from '../forms/InputsComedor';

export default{

    data(){
        return{
            form: new Form({nombre:'',creado:'',administradores:[]}),
        }
    },
    components:{
        InputsComedor
    },
    methods:{
        onSubmit(){
            this.form
                    .post(PATH +'comedor')
                    .then(comedor => this.$emit('comedorCreado',comedor));
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>