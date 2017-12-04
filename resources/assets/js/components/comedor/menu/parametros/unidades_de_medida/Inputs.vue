<template>
    <div>

        <div :class="form.getClassForm('nombre')" >
            <label >Nombre</label>
            <input type="text" class="form-control"  v-model="form.nombre">
            <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
        </div>


        <div :class="form.getClassForm('abreviatura')" >
            <label >Abreviatura</label>
            <input type="text" class="form-control"  v-model="form.abreviatura">
            <span class="help-block" v-if="form.errors.has('abreviatura')" v-text="form.errors.get('abreviatura')"></span>
        </div>


        <div v-if="isEditAdmin()" :class="form.getClassForm('publico')" >
            <label >Publico</label>
            <input type="checkbox"  v-model="form.publico">
            <span class="help-block" v-if="form.errors.has('publico')" v-text="form.errors.get('publico')"></span>
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
        form:{
            required : true
        },
        edit : {
            required:false,
            default : false
        },
        admin : {
            required:false,
            default : false
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        isEditAdmin(){
            return this.edit && this.admin;
        }
    }
}

</script>