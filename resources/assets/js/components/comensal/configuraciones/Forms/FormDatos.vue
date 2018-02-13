<template>
    <div>
        <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

            <div class="row">

                <div class="col-xs-12 col-md-6">

                    <p class="text-center">
                        <img class="manita" height="150px" width="150px" :src="form.foto" alt="" @click="toggleShow"/>
                    </p>
                    <p class="text-center">
                        Foto de perfil
                    </p>

                </div>

                <div class="col-xs-12 col-md-6">

                    <div :class="form.getClassForm('email')" >
                        <label >Email</label>
                        <input type="text" class="form-control"  v-model="form.email">
                        <span class="help-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                    </div>

                    <div :class="form.getClassForm('fecha_nacimiento')" >
                        <label >Fecha Nacimiento</label>
                        <input type="date" class="form-control"  v-model="form.fecha_nacimiento">
                        <span class="help-block" v-if="form.errors.has('fecha_nacimiento')" v-text="form.errors.get('fecha_nacimiento')"></span>
                    </div>

                </div>

            </div>

        <button type="submit" :disabled="form.errors.any()" class="btn btn-success pull-right">Modificar</button>

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
        img-format="png">
    </my-upload>


        </div>
</template>


<script>

export  default{
    data(){
        return{
            comensal: vm.app.comensal,
            show:false,
            form:{},
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
        }
    },
    props: {
        /*form:{
            required : true
        },*/
        edit : {
            required:false,
            default : false
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

            this.form = new Form(this.comensal.usuario);

        },

        onSubmit(){
            var form2 = this.form;
            form2.put( PATH +'usuario/' + this.comensal.usuario.id)
                    .then(usuario =>{
                        //Vue.set(vm.app.comensal,'usuario',usuario);
                        this.updateObject(this.comensal.usuario,usuario);
                        this.init();
                        this.$notify({
                            group: 'g',
                            title: '',
                            text: 'Los datos se modificaron exitosamente',
                            type: 'success',
                            duration: 2000,
                        });
                    })
                    .catch(error=>{
                        console.log(error);
                    });
        },

        toggleShow() {
            this.show = !this.show;
        },

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
    }
}

</script>