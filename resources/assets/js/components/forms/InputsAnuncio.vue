<template>
    <div>

        <div :class="form.getClassForm('asunto')" >
            <label >Asunto:</label>
            <input type="text" class="form-control"  v-model="form.asunto">
            <span class="help-block" v-if="form.errors.has('asunto')" v-text="form.errors.get('asunto')"></span>
        </div>

        <div :class="form.getClassForm('cuerpo')">
            <label >Anuncio:</label>
            <textarea rows="5" class="form-control"  v-model="form.cuerpo"></textarea>
            <span class="help-block" v-if="form.errors.has('cuerpo')" v-text="form.errors.get('cuerpo')"></span>
        </div>

        <div :class="form.getClassForm('hasta')">
            <label >Visible hasta:</label>
            <!--<input type="text" class="form-control datepicker"  v-model="form.hasta">-->

            <datepicker v-model="form.hasta" language="es" :bootstrapStyling="true"></datepicker>

            <span class="help-block" v-if="form.errors.has('hasta')" v-text="form.errors.get('hasta')"></span>
        </div>


    </div>
</template>

<script>

export default{
    props : {
        edit:{
            required : false,
            default:false
        },
        form:{
            required :true,
        }
    },

    data(){
        return{

        }

    },
    created(){

    },


    methods:{

    }
}

</script>