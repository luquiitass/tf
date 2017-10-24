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
                    <!--<button class="btn btn-warning" @click="cancelar()">Cancelar</button>-->
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
            form : new Form({nombre: ''}),

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
            this.form.post(PATH + 'tipoComida')
                    .then(tipo => {
                        this.$emit('add',tipo)
                    });
        }
    }
}

</script>