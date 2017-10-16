<template>
    <div class="box box-solid">

        <div class="box-body">

            <div v-if="!usuarioAttach">
                <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                    <p class="text-center">
                        <img height="150px" width="150px" :src="form.foto" alt="" @click="toggleShow"/>
                    </p>

                    <input-usuario :edit="true" :form="form" ></input-usuario>

                    <ul v-if="form.errors.has('error')" class="alert alert-danger">
                        <li v-for="error in from.errors.get('error')"></li>
                    </ul>

                    <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>

                </form>
            </div>

            <div v-else>
                <attach-usuario :usuario="usuarioAttach" @cancelar="cancelarAttach" @comensalAdd="comensalAdd"></attach-usuario>
            </div>


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
import AttachUsuario from './AttachUsuario';


export default{
    props:{
        p_comensal:{
            required:true
        }
    },
    data(){
        return {
            form : new Form(this.p_comensal.usuario),
            show: false,
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
            imgDataUrl: '',
            usuarioAttach:null,
        }
    },
    watch:{
        p_comensal:function () {
            this.form = new Form(this.p_comensal.usuario);
        }
    },
    components:{
        InputUsuario,
        myUpload,
        AttachUsuario
    },
    methods:{
        onSubmit(){
            this.form.put( PATH +'usuario/' + this.p_comensal.usuario.id)
                    .then(usuario =>{
                        this.$emit('usuarioEdited',usuario);
                        this.form = new Form(usuario);
                        this.$notify({
                            group: 'g',
                            title: 'Felicitaciones',
                            text: 'Los datos se modificaron exitosamente',
                            type: 'success',
                            duration: 200,
                        });
                    })
                    .catch(error=>{
                        console.log(error);
                    });
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
        },
        atthachUsuario(usuario){
           this.usuarioAttach = usuario;
        },
        cancelarAttach(){
            this.usuarioAttach=null;
        }


        ,comensalAdd(comensal){
            this.$emit('comensalAdd',comensal);
        }

    }

}

</script>