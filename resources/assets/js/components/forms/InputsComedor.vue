<template>
    <div>
        <div :class="form.getClassForm('nombre')" >
            <label >Nombre</label>
            <input type="text" class="form-control"  v-model="form.nombre">
            <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
        </div>

        <div :class="form.getClassForm('creado')" >
            <label >Creado el</label>
            <input type="text" class="form-control"  v-model="form.creado">
            <span class="help-block" v-if="form.errors.has('creado')" v-text="form.errors.get('creado')"></span>
        </div>

        <div :class="form.getClassForm('administradores')" >
            <label >Buscar administradores</label>

            <search :url="'usuarios/search'"
                    :columns="'id,nombre,apellido,dni,email'"
                    :items="form.administradores"
                    @itemSelected="addAdministrador">
            </search>
            <div v-if="form.administradores.length">
                <label for="">Administradores</label>
                <ul class="list-group">
                    <li class="list-group-item" v-for="administrador in form.administradores">

                        <div>
                            <a class="btn pull-right" @click="removeAdministrador(administrador)">
                                <i class="fa fa-close"></i>
                            </a>
                            {{administrador.apellido}} {{administrador.nombre}}
                        </div>

                    </li>
                </ul>
            </div>

            <span class="help-block" v-if="form.errors.has('administradores')" v-text="form.errors.get('administradores')"></span>
        </div>

    </div>


</template>

<script>

import Search from '../oters/Search'

export default{

    data(){
        return{

        }
    },
    components :{
        Search
    },
    props : {
        edit:{
            required : true,
        },
        form:{
            required :true,
        }
    },
    methods:{
        addAdministrador(administrador){
            this.form.administradores.unshift(administrador);
        },
        removeAdministrador(administrador){
            Utilidades.deleteObjectList(this.form.administradores,administrador.id);
        }
    }
}
</script>