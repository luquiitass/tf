<template>
    <div>
        <titulo>
            <ol class="breadcrumb" slot="breadcrump">
                <li>
                    <a class="manita" @click="cancelar()">Comensales</a>
                </li>
                <li class="active">
                    Comensal
                </li>
            </ol>
            Comensal
        </titulo>

        <div class="row" v-if="comensal.usuario">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" :src="comensal.usuario.foto" alt="User profile picture">

                    <h3 class="profile-username text-center">{{comensal.usuario.apellido}} {{comensal.usuario.nombre}}</h3>

                    <p class="text-muted text-center">{{comensal.usuario.email}}</p>
                    <p class="text-muted text-center">{{comensal.usuario.fecha_nacimiento}}</p>

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

                    <a v-if="oculto" href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary" v-if="oculto">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">Malibu, California</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                    <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#inscripciones" data-toggle="tab">Inscripciones</a></li>
                    <li><a href="#timeline" data-toggle="tab">Actividad</a></li>
                    <li><a href="#settings" data-toggle="tab">Editar datos</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="inscripciones">
                        <inscripciones
                            :comensal="comensal">
                        </inscripciones>
                    </div>



                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->

                        <historial
                            :comensal="comensal">

                        </historial>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">

                        <edit :p_comensal="comensal" @usuarioEdited="usuario=>{comensal.usuario = usuario}"></edit>

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div v-if="sinComiensal">
        No existe el comensal
    </div>

    </div>

</template>


<script>

import Inscripciones from './submenu/Inscripciones.vue';
import Historial from  './submenu/Historial.vue';
import Edit from './Edit.vue';

export  default{
    data(){
        return{
            comensal:{},
            oculto:false,
            sinComiensal:false,
        }
    },
    components:{
        Edit,
        Inscripciones,
        Historial
    },
    watch:{
        usuario(){
            //this.$emit('updateComensal',this.comensal.usuario);
        }
    },
    props: {
        p_comensal: {
            requerid: true,
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            window.scrollTo(0,0);
            this.loadComensal();
        },
        loadComensal(){

            Comensal.find(this.$route.params.id,comensal => this.comensal = comensal)
                    .catch(error=>{
                        this.sinComiensal = true;
                    });

        },
        cancelar(){
            //this.comensal.usuario.id = this.comensal.id;
            //this.$emit('cancelar',this.comensal.usuario);
            router.go(-1);

        }
    },
    computed:{
        usuario(){
            return this.comensal.usuario;
        }
    }
}

</script>