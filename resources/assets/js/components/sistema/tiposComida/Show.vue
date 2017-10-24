<template>
    <div class="box box-solid">
        <div class="box-header with-border">
            <div class="btn-group pull-right">
                <button class="btn btn-xs btn-default" @click="showDelet()">
                    <i class="fa fa-trash"></i>
                </button>
                <button class="btn btn-xs btn-default" @click="showEdit()">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-xs btn-default" @click="cancelar()">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <h3 class="box-title"> Tipo de Comida</h3>
        </div>
        <div class="box body">
            <div class="alert">
                <h3>{{tipo.nombre}}</h3>
            </div>
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{

        }
    },
    props: {
        tipo:{
            requirec:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        showEdit(){
            this.$emit('edit');
        },
        showDelet(){
            this.$emit('delet');
        },
        cancelar(){
            this.$emit('cancelado');
        }
    }
}

</script>