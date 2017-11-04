<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nueva Localidad</h3>
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
            form : new Form({nombre:'',provincia_id : this.p_provincia.id}),
        }
    },
    components:{
        Inputs
    },
    props: {
        p_provincia : {
            required : true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        onSubmit(){
            this.form.post(PATH + 'localidad')
                    .then(localidad=>{
                        this.$emit('nuevaLocalidad',localidad);
                        this.form =  new Form({nombre:'',provincia_id : this.p_provincia.id});
                    })
        }
    }
}

</script>