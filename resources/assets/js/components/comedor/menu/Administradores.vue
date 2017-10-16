<template>
    <div>
        <titulo>
            Personal

            <button class="btn btn-primary btn-md" title="Nuevo Personal" @click="showModal=true">
                Nuevo
                <i class="fa fa-plus"></i>
            </button>

        </titulo>
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <ul class="list-group">
                    <li :class="isActive(admin)" v-for="admin in administradores.all()" @click="idSelect = admin.id">
                        {{admin.apellido}} {{admin.nombre}}
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-10">
                <div v-if="adminSelect">

                    <show-admin
                        :p_admin="adminSelect"
                        @showDetachAdmin="showDetachAdmin"
                        >
                    </show-admin>

                </div>

                <div v-else="">
                    Seleccione o cree un administrador
                </div>
            </div>
        </div>
        <!-- Fin row -->
       <modal
            :p_show="showModal"
            v-show="showModal"
            @cancelado="showModal=false">

            <div slot="title"> Buscar Usuario</div>

            <attach-admin
                v-if="showModal"
                :p_urlPost="'comedor/attachUsuario/' + comedor.id"
                @asociado="attachAdministrador">
            </attach-admin>

       </modal>


        <modal-delet
            v-if="showDelet"
            :titulo="'Eliminar'"
            :text="'Esta seguro de eliminar a ' + adminSelect.nombre "
            :url="'comedor/detachUsuario/' + comedor.id + '?usuario=' + adminSelect.id"
            @eliminado="detachAdmin()"
            @cancelado="showDelet = null">
        </modal-delet>

    </div>
</template>

<script>

import ShowAdmin from './Administradores/Show.vue';
import AttachAdmin from './Administradores/AttachUsuario.vue';


export default{
    data(){
        return{
            comedor: vm.app.comedor,
            administradores : new Coleccion(vm.app.comedor.administradores),
            viewShow :'show',
            idSelect:'',
            showModal:false,
            showDelet : false
        }
    },
    components:{
        ShowAdmin,
        AttachAdmin
    },
    computed:{
        adminSelect(){
            return this.administradores.get(this.idSelect);
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            console.log(this.administradores.all());
            console.log(Array.isArray(this.administradores.all()));
            this.idSelect = this.administradores.first().id;
        },
        attachAdministrador(admin){
            this.idSelect = admin.id;
            this.showModal = false;
            this.administradores.addOrReplace(admin);

            this.$notify({
                group:'g',
                title:'Felicitaciones',
                text:'El usuario ha sido asociado',
                type:'success',
                duration:1000
            });
        },
        detachAdmin(){

            if(this.administradores.remove(this.idSelect)){
                this.$notify({
                    group:'g',
                    title:'Felicitaciones',
                    text:'Se ha quitado al usuario',
                    type:'success',
                    duration:1000
                });
            }
            this.idSelect = this.administradores.first().id
        },

        showDetachAdmin(admin){
            this.showDelet = true;
        },


        isActive(admin){
            return admin.id == this.idSelect ? 'list-group-item manita  active' : 'list-group-item manita';
        }
    }


}
</script>