<template>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Tipo de Comida</h3>
        </div>
    <!-- /.box-header -->
    <div class="box-body">

        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form"></inputs>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
                    <a class="btn btn-warning" @click="cancelar()">Cancelar</a>
                </div>
            </div>

        </form>
    </div>
        <!-- /.box-body -->
    </div>

</template>


<script>

import Inputs from "../../forms/InputsTipoComida.vue"


export  default{
    data(){
        return{
            form :'',

        }
    },
    components:{
        Inputs
    },
    props: {
        tipo:{
            required:true
        }

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.form = new Form(this.tipo);
        },
        onSubmit(){
            this.form.put(PATH + 'tipoComida/' + this.tipo.id)
                    .then(tipo => {
                        this.$emit('edited',tipo)
                    });
        },
        cancelar(){
            this.$emit('cancelado');
        }
    }
}

</script>