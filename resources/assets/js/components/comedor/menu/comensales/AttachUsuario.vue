<template>
    <div class="perfil-datos">
        <div>
            <p class="text-center">
                <img class="perfil-img" :src="path + '/img/user.png'" alt="Foto de perfil" height="150px"/>
            </p>
        </div>
        <div>
            <ul>
                <li>
                    <strong>Nombre: </strong>{{usuario.nombre}}
                </li>
                <li>
                    <strong>Apellido:</strong>{{usuario.apellido}}
                </li>
                <li>
                    <strong>DNI: </strong>{{usuario.dni}}
                </li>
                <li>
                    <strong>Fecha de nacimiento: </strong>{{usuario.fecha_nacimiento}}
                </li>
                <li>
                    <strong>Email</strong>{{usuario.email}}
                </li>
            </ul>
        </div>

        <div class="alert alert-warning">
            <p>
                Este usuario ya se encuentra registrado al en el sistema.
            </p>
            <p>¿Decea asociar el comensal a esta cuenta?</p>
        </div>

        <div class="alert alert-danger" v-if="form.errors.any()">
            <ul>
                <li v-for="(value,key) in form.errors.errors">
                    {{value}}
                </li>
            </ul>
        </div>

        <div class="text-center">
            <a class="btn btn-success" @click="attach()">Asociar</a>
            <a class="btn btn-danger" @click="cancelar()">Cancelar</a>
</div>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            form : {},
            path:PATH,
        }
    },
    props: {
        usuario: {
            required: true,
        }
    },
    created(){
        this.init();
    },
    methods:{
      init(){
          this.form = new Form(this.usuario);
      },
        attach(usuario){
          this.form.post(PATH + 'comensal/attachUsuario/' + this.usuario.id)
                  .then(response=>{
                      this.$emit('comensalAdd',response)
                  })
                  .catch(error=> {
                      console.log(error)
                  })
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>