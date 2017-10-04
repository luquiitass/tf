<template>
    <div class="box box-solid">
        <div class="box-body">
            <div v-if="usuario">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de usuario</h3>

                    <div class="pull-left">
                        <a class="btn btn-xs" @click="editUsuario(usuario)" >
                        Editar
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-xs " @click="deletUsuario(usuario)">
                            Eliminar
                            <i class="fa  fa-trash"></i>
                        </a>
                        <a class="btn btn-xs " @click="cerrar">
                            Cancelar
                            <i class="fa  fa-close"></i>
                        </a>
                     </div>

                </div>

                <div>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(value,key ) in usuario">
                            <b>{{key | key}}</b> : {{value}}
                        </li>
                    </ul>
                </div>

            </div>

            <div v-if="!usuario">
                Seleccione un usuario de la Lista
            </div>
        </div>
    </div>
</template>


<script>

export default{

    props : {
        usuario:{
            required :true,
        }
    },

    methods : {
        editUsuario(usuario){
            this.$emit('editUsuario',usuario);
        },
        deletUsuario(usuario){
            this.$emit('deletUsuario',usuario);
        },
        cerrar(){
            this.$emit('cancelar');
        }
    }

}

</script>