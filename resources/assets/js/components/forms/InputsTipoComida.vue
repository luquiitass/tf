<template>
    <div>
        <div :class="form.getClassForm('nombre')" >
            <label >Nombre</label>
            <input type="text" class="form-control"  v-model="form.nombre">
            <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
        </div>
    </div>


</template>

<script>


export default{

    data(){
        return{

        }
    },
    props : {
        edit:{
            required : false,
            dfault:false
        },
        form:{
            required :true,
        }
    }
}
</script>