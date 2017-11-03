<template>

        <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >
        <div class="input-group">
            <input type="text" class="form-control"  v-model="form.nombre">
            <span class="input-group-addon manita" @click="cancelar()">
                <i class="fa fa-close"></i>
            </span>
        </div>

        <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>

        </form>

    </div>
</template>


<script>

import Inputs from '../../../forms/InputPais.vue'

export  default{
    data(){
        return{
            form : new Form(this.p_pais),
        }
    },
    components:{
        Inputs
    },
    props: {
        p_pais : {
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        onSubmit(){
            this.form.put(PATH + 'pais/'+ this.p_pais.id)
                    .then(pais=>{

                        this.p_pais.nombre = pais.nombre

                        this.cancelar();
                    })
        },
        cancelar(){
            this.$emit('cancelado');
        }
    }
}

</script>