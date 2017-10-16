<template>
    <div>
        <titulo>
            Usuarios
            <button class="btn btn-primary padding-left-10" @click="showCreate">
                <span class="fa  fa-plus"></span> Crear Usuario
            </button>
        </titulo>
        <div class="row">
            <!--Columna del listado de usuario-->
            <div class="col-xs-12 col-md-8">

                <tabla source="usuarios/getData" title="" @selectItem="showUsuario" @updatedList="updateList" :list="usuarios" :itemSelected="usuarioShow" :attributes="{nombre:'Nombre',apellido:'Apelliddo',dni:'DNI',email:'Correo'}"></tabla>

            <!--<data-viewer source="usuarios/getData" title="Usuarios" @selectItem="showUsuario" @updatedList="updateList" :list="usuarios" :itemSelected="usuarioShow" :atributos="columnasTabla"/>-->
                <!--<div id="content_table" class="white content-table">-->
                    <!--<table class="table table-bordered">-->
                        <!--<tbody>-->
                            <!--<tr>-->
                                <!--<th>id</th>-->
                                <!--<th>nombre</th>-->
                                <!--<th>apellido</th>-->
                                <!--<th>dni</th>-->
                                <!--<th>email</th>-->
                            <!--</tr>-->
                            <!--<tr v-for="usuario in usuarios" @click="(showUsuario(usuario))"  :id="'tr_usuario_' + usuario.id" :class="classRow(usuario)">-->
                                <!--<td>{{usuario.id}}</td>-->
                                <!--<td>{{usuario.nombre}}</td>-->
                                <!--<td>{{usuario.apellido}}</td>-->
                                <!--<td>{{usuario.dni}}</td>-->
                                <!--<td>{{usuario.email}}</td>-->
                                <!--</td>-->
                            <!--</tr>-->
                        <!--</tbody>-->
                    <!--</table>-->
                <!--</div>-->
            </div>

            <!--Columna para crear,editar,visualizar a un usuario-->
            <div class="col-xs-12 col-md-4" id="columnaDerecha">
                <div v-if="colDerecha == 'edit'">
                    <edit-usuario @usuarioModificado="editUsuario" @cancelar="showUsuario(null)"  :usuario="usuarioEdit"></edit-usuario>
                </div>

                <div v-if="colDerecha == 'show'">
                    <show-usuario @editUsuario="showEdit" @deletUsuario="showDelet" @cancelar="showUsuario(null)" :usuario="usuarioShow"></show-usuario>
                </div>


                <div v-if="colDerecha == 'create'">
                    <create-usuario @cancelar="showUsuario(null)" @usuarioCreado="addUsuario" ></create-usuario>
                </div>
            </div>
        </div>

        <modal-delet v-if="usuarioDelet"
                     :titulo="'Eliminar Usuario'"
                     :text="'Esta seguro de eliminar al usuario ' + usuarioDelet.nombre+' '+ usuarioDelet.apellido"
                     :url="'usuario/' + usuarioDelet.id"
                     @eliminado="deletUsuario(usuarioDelet)"
                     @cancelado="usuarioDelet = null"
        ></modal-delet>
    </div>
</template>

<script >

import CreateUsuario from '../components/user/CreateUsuario';
import EditUsuario from '../components/user/EditUsuario';
import ShowUsuario from '../components/user/ShowUsuario';
import ModalDelet from '../components/oters/ModalDelet';

export default{

    components :{
        CreateUsuario,
        EditUsuario,
        ShowUsuario,
        ModalDelet
    },

    data(){
        return{
            usuarios : {},
            colDerecha : 'show',
            usuarioShow:null,
            usuarioEdit :null,
            usuarioDelet: '',
        }
    },
    boforeMount:function () {
        console.log('created');
    },
    mounted:function () {
        console.log('mounted')
    },
    methods : {
        getUsuarios(){
            this.reset();
            var self = this;
//            axios.get(PATH + 'usuarios')
//                    .then(data => this.usuarios = data.data)
//                    .catch(error => alert('error') )
            Utilidades.getJson(PATH + 'usuarios','content_table',function (data) {
                self.usuarios = data.data;
            })
        },
        addUsuario(usuario){
            this.usuarios.unshift(usuario);
            this.showUsuario(usuario);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Usuario registrado',
                type: 'success',
                duration: 2000,
            });

            window.scrollTo(0,0);
        },
        editUsuario(usuario){
            this.usuarios = Utilidades.changeObjectListById(this.usuarios,usuario.id,usuario)
            this.showUsuario(usuario);
            this.$notify({
                group: 'g',
                title: 'Felicitaciones',
                text: 'Usuario Modificado',
                type: 'success',
                duration: 20000,
            });
        },
        deletUsuario(usuario){
            if (Utilidades.deleteObjectList(this.usuarios,usuario.id)){
                this.$notify({
                    group: 'g',
                    title: 'Felicitaciones',
                    text: 'Usuario Eliminado',
                    type: 'success',
                    duration: 2000,
                });
                this.showUsuario(null);
            }
        },

        showCreate(){
            this.colDerecha = 'create'
            this.usuarioSelect = {};
        },
        showUsuario(usuario){
            this.colDerecha = 'show';
            this.usuarioShow = usuario;
        },
        showEdit(usuario){
            this.usuarioEdit = usuario;
            this.colDerecha = 'edit';
        },showDelet(usuario){
            this.usuarioDelet = usuario;
        },
        updateList(list){
            this.usuarios = list
        },
        viewVisible(col){
            console.log(col)
            return this.colDerecha == col;
        },
        classRow(usuario){
            return this.usuarioSelect == usuario ? 'tr-active' : 'tr-list';
        },
        reset(){
            this.colDerecha = 'show';
            this.usuarioShow=null;
            this.usuarioEdit =null;
            this.usuarioSelect = '';
            this.usuarioDelet ='';
        }

    }

}


</script>