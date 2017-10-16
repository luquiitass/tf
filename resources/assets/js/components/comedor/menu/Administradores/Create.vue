<template>
    <div>
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

        <inputs :form="form"></inputs>

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
                <button class="btn btn-warning" @click="cancelar()">Cancelar</button>
        </div>
    </div>

</form>
        </div>
</template>

<script>

import Ipnputs from "../../../forms/InputsUsuario.vue"

export default{
    data(){
        return{
            form:new Form({});
        }
    },
    created(){
        this.init();
    },
    methods(){
        init(){

        },
        cancelar(){
            this.$3mit('cancelado'),
        }
    }
}

</script>