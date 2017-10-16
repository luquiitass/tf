<template>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Editar Usuario</h3>
            <a class="btn btn-xs  pull-right" @click="cancelar" >
                <i class="fa  fa-close"></i>
            </a>
        </div>
    <!-- /.box-header -->
        <div class="box-body">


            <form  @submit.prevent="onSubmit" @keydown="formModificado()" >

                <inputs-usuario :edit="true" :form="form" ></inputs-usuario>


                <button type="submit"  :disabled="form.errors.any() || !formMod" class="btn btn-success">Modificar</button>

                <button class="btn btn-danger" @click="cancelar">Cancelar</button>

            </form>


        </div>
        <!-- /.box-body -->
    </div>
</template>

<script >

import InputsUsuario from '../forms/InputsUsuario'

export default{

    props: {
        usuario :{
            required:true
        }
    },

    data(){
        return{
            form : new Form(this.usuario),
            formMod:false
        }

    },
    components :{
        InputsUsuario
    },
    computed : {
        conCont : function (){
            return this.conPass ? 'La contrtaseña sera el DNI' : '';
        }
    },
    methods:{
        onSubmit(){
            this.form
                    .put(PATH +'/usuario/'+this.usuario.id)
                    .then(usurio => this.$emit('usuarioModificado',usurio));
        },
        cancelar(){
            this.$emit('cancelar');
        },
        formModificado(){
            this.form.errors.clear();
            this.formMod = true;
        }

    }
}

</script>