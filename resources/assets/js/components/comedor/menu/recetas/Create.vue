<template>
    <div class="box box-solid">
        <div class="box-header wit-border">
            <a class="btn btn-xs pull-right" @click="cancelar()"><i class="fa fa-close"></i></a>
            <h3 class="box-title">Crear Receta</h3>
        </div>

        <div class="box-body">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                <inputs :form="form" :edit="false" @cancelar(cancelarCreate)></inputs>

                <div class="box-footer pull-right">
                    <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
                    <a class="btn btn-warning" @click="cancelar()">Cancelar</a>
                </div>

                <div class="has-error">
                    <span class="help-block" v-if="form.errors.any()">Verificar los datos ingresados</span>
                </div>

            </form>
        </div>
    </div>
</template>

<script>

import Inputs from './Inputs.vue';

export default{

    data(){
        return{
            form: new Form({}),
        }
    },
    components:{
        Inputs
    },
    created(){
        this.loadForm();
    },
    methods:{
        loadForm(){
            this.form = new Form({nombre:'',porciones:'',descripcion:'',preparacion:'',comedor_id:vm.app.comedor.id,ingredientes:[]});
        },
        onSubmit(){
            this.form
                    .post(PATH +'receta')
                    .then(data =>{
                        this.$emit('add',data)
                        this.loadForm();
                    });
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>