<template>
    <div>
        <h3>
            Modificar Tipo de Comida {{p_comidas[0].tipo_comida.nombre}}
        </h3>
        <hr/>
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form" edit="true"></inputs>

            <div class="pull-right">
                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Modificar</button>
                <a class="btn btn-warning" @click="cancelar()">Cancelar</a>

            </div>

        </form>
    </div>

</template>


<script>

import Inputs from '../../../forms/InputsComidas.vue';

export  default{
    data(){
        return{
            form:'',
            comidas:{}
        }
    },
    components:{
        Inputs
    },
    props: {
        p_comidas:{
            required:true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.comidas = this.p_comidas;
            this.form = new Form(this.comidas);
        },
        onSubmit(){
            this.form.put( PATH +'comida/' + '0')
                    .then(tipos =>{
                        //this.$emit('tipoComidasEdited',tipos);
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