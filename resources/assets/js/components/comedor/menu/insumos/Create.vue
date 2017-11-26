<template>
    <div :id="id" class="box box-solid">
        <div class="box-header wit-border">

            <h3 class="box-title">Crear Insumo</h3>
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
            id: + Utilidades.random4(),
            form: {},
        }
    },
    props:{
    },
    watch:{
    },
    components:{
        Inputs
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.form = new Form({nombre:'',disponibilidad:'0',unidad_de_medida_id:'',minimo:'1',comedor_id:vm.app.comedor.id});
        },
        onSubmit(){
            this.form
                    .post(PATH +'insumo')
                    .then(data => {
                        this.$emit('add',data);
                        this.init()
                        this.cancelar();
                    });
        },
        cancelar(){
            this.$emit('cancelar');
        },
    }
}

</script>