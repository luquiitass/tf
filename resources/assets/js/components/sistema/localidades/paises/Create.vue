<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Pais</h3>
        </div>

        <form class="box-body"  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <inputs :form="form" ></inputs>


            <div class="footer ">
                <button type="submit" class="btn btn-success btn-xs pull-right">Guardar</button>
            </div>

        </form>

    </div>
</template>


<script>

import Inputs from '../../../forms/InputPais.vue'

export  default{
    data(){
        return{
            form : new Form({nombre:''}),
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
            this.form.post(PATH + 'pais')
                    .then(pais=>{
                        this.$emit('nuevoPais',pais);
                    })
        }
    }
}

</script>