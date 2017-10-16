<template>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Usuario</h3>
            <a class="btn btn-xs  pull-right" @click="cancelar" >
                <i class="fa  fa-close"></i>
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                <inputs-usuario :edit="false"  :form="form"></inputs-usuario>


                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>

            </form>


        </div>
        <!-- /.box-body -->
        </div>
        </template>

<script >

import InputsUsuario from '../forms/InputsUsuario'

export default{

    data(){
        return{
            form : new Form({nombre:'',apellido: '',dni: '',fecha_nacimiento: '',email: '',password: ''}),
            conPass:false
        }

    },
    components :{
        InputsUsuario
    },

    methods:{
        onSubmit(){
            this.form
                    .post(PATH +'/usuario')
                    .then(usurio => this.$emit('usuarioCreado',usurio));
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>