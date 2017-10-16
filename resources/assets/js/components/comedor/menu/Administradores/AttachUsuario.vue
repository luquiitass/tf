<template>
    <div>
        <search
            :url="'usuarios/search'"
            :columns="'nombre,apellido,dni,email'"
            :items="administradores"
            @update="admins=>{administradores=admins}"
            @itemSelected="">

            <div slot="showList">
                <hr/>
                <div class="direct-chat-msg manita"  v-for="admin in administradores" @click="attachAdministrador(admin)">
                    <img class="direct-chat-img" :src="admin.foto" alt="foto Perfil">
                    <!-- /.direct-chat-img -->
                    <div class="nombre-usuario-list-search">
                        {{admin.apellido}} {{admin.nombre}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
            </div>

        </search>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            administradores: [],
            form: new Form()
        }
    },
    props: {
        p_urlPost:{
            required:true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        attachAdministrador(admin){
            this.form = new Form({usuario:admin.id});
            this.form.post(PATH + this.p_urlPost)
                    .then(admin=>{
                        this.$emit('asociado',admin);
                    })
                    .catch(errors=>{
                       var msjError='';
                        for(var error in errors){
                           msjError = msjError + '\n' + errors[error]
                       }
                        this.$notify({
                            group:'g',
                            title:'Error',
                            text:msjError,
                            type:'error',
                            duration:4000
                        });
                    })
        }
    }
}

</script>