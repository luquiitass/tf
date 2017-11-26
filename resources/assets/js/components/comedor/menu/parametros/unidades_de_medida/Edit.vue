<template>
    <div class="box box-solid">
        <div class="box-header wit-border">
            <h3 class="box-title">Editar Unidad de Medida</h3>
        </div>

        <div class="box-body">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                <inputs :form="form" :edit="true" :admin="false" @cancelar(cancelarCreate)></inputs>

                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Modificar</button>

                <a class="btn btn-warning" @click="cancelar()">Cancela</a>

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
            form: new Form(this.objeto),
        }
    },
    props:{
        objeto:{
            required:true
        }
    },
    watch:{
        objeto(){
            this.loadForm();
        }
    },
    components:{
        Inputs
    },
    methods:{
        loadForm(){
            this.form = new Form(this.objeto);
        },
        onSubmit(){
            this.form
                    .put(PATH +'unidadDeMedida/' + this.objeto.id)
                    .then(data => {
                        this.$emit('edited',data);
                        this.loadForm();
                    });
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>