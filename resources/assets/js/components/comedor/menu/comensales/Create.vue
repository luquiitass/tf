<template>
    <div class="box box-solid">

        <div class="box-body">


            <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                <p class="text-center">
                    <img height="150px" width="150px" :src="form.foto" alt="" @click="toggleShow"/>
                </p>

                <input-usuario :edit="false" :form="form"></input-usuario>


                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>

            </form>

            <my-upload field="img"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            v-model="show"
            :width="300"
            :height="300"
            lang-type="es-MX"
            :params="params"
            :headers="headers"
            img-format="png"></my-upload>

        </div>
        <!-- /.box-body -->
    </div>

</template>

<script>
import myUpload from 'vue-image-crop-upload';
import InputUsuario from '../../../forms/InputsUsuario.vue';

export default{

    data(){
        return {
            form : new Form({foto:'',nombre:'',apellido: '',dni: '',fecha_nacimiento: '',email: '',password: ''}),
            show: false,
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
            imgDataUrl: ''
        }
    },
    components:{
        InputUsuario,
        myUpload
    },
    methods:{
        onSubmit(){
            this.form
                    .post(PATH +'/comensal')
                    .then(usurio => this.$emit('comensalCreado',usurio));
        },
        toggleShow() {
            this.show = !this.show;
        },
        /**
         * crop success
         *
         * [param] imgDataUrl
         * [param] field
         */
        cropSuccess(imgDataUrl, field){
            console.log('-------- crop success --------');
            this.form.foto = imgDataUrl;
        },
        /**
         * upload success
         *
         * [param] jsonData  server api return data, already json encode
         * [param] field
         */
        cropUploadSuccess(jsonData, field){
            console.log('-------- upload success --------');
            console.log(jsonData);
            console.log('field: ' + field);
        },
        /**
         * upload fail
         *
         * [param] status    server api return error status, like 500
         * [param] field
         */
        cropUploadFail(status, field){
            console.log('-------- upload fail --------');
            console.log(status);
            console.log('field: ' + field);
        }
    }

}

</script>