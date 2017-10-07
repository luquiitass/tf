<template>
    <div class="box box-solid">
        <div class="box-body">
            <div v-if="comedor">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de comedor</h3>

                    <div class="pull-left">
                        <a class="btn btn-xs" @click="editComedor(comedor)" >
                            Editar
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-xs " @click="deletComedor(comedor)">
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
                        <li class="list-group-item" v-for="(value,key ) in comedor" v-if="isArray(value)">
                            <strong>{{key}}</strong> : {{value}}
                        </li>
                        <li class="list-group-item">
                            <strong>Administradores:</strong>
                            <ul>
                                <li v-for="admin in comedor.administradores">
                                    {{admin.apellido}} {{admin.nombre}} , {{admin.email}}

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <a :href="'comedor/' + comedor.id" class="btn btn-info btn-block">Administrar</a>

            </div>

            <div v-if="!comedor">
                Seleccione un comedor de la Lista
            </div>
        </div>
    </div>
</template>


<script>

export default{

    props : {
        comedor:{
            required :true,
        }
    },

    methods : {
        editComedor(comedor){
            this.$emit('editComedor',comedor);
        },
        deletComedor(comedor){
            this.$emit('deletComedor',comedor);
        },
        cerrar(){
            this.$emit('cancelar');
        },
        isArray(val){
            return !Array.isArray(val);
        }
    }

}

</script>