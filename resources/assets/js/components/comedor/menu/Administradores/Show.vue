<template>
    <div>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" :src="admin.foto" alt="User profile picture">

                <h3 class="profile-username text-center">{{admin.apellido}} {{admin.nombre}}</h3>

                <p class="text-muted text-center">{{admin.email}}</p>
                <p class="text-muted text-center">{{admin.fecha_nacimiento}}</p>

                <ul class="list-group list-group-unbordered" v-if="oculto">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                </ul>

                <div class="text-center">
                    <a class="btn btn-danger" @click="detachAdmin()"><b>{{textEliminarAdministrador(p_admin)}}</b></a>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            admin : this.p_admin,
            oculto : false,
        }
    },
    props: {
        p_admin: {
            requerid: true,
        }
    },
    watch:{
        p_admin(){
            this.admin = this.p_admin;
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        detachAdmin(){
            this.$emit('showDetachAdmin',this.p_admin);
        },
        textEliminarAdministrador(admin){
            return vm.app.usuario.id == admin.id ? 'Abandonar' : 'Eliminar';
        }

    }
}

</script>