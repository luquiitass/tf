<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Unidades de medidas
                </h4>
            </div>
            <div class="box-body">


                <ul class="list-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="10px">#</th>
                                <th>Nombre</th>
                                <th>Abreviatura</th>
                                <th>Acceso</th>
                                <th>Op</th>
                            </tr>

                            <tr v-for="(unidad,count) in p_list">
                                <td>{{count +1}}</td>
                                <td>{{unidad.nombre}}</td>
                                <td>{{unidad.abreviatura}}</td>
                                <td>
                                    <small :class="{'label label-info' : unidad.publico,'label label-warning' : !unidad.publico}">{{acceso(unidad)}}</small></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="edit(unidad)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="delet(unidad)">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                   <!-- <li class="list-group-item" v-for="unidad in p_list">
                        <strong >{{unidad.nombre}}</strong>
                        <span class="text-sm"> {{unidad.abreviatura}} </span>
                        <small class="label label-info">{{acceso(unidad)}}</small>
                    </li>-->
                </ul>
            </div>
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            count:0
        }
    },
    components:{

    },
    props: {
        p_list : {
            required:true
        }

    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        acceso(unidad){
            var retorno = 'Privado ';
            if (unidad.publico){
                retorno =  'Publico ';
            }
            if(unidad.comedor){
                retorno = retorno + unidad.comedor.nombre;
            }
            return retorno;
        },
        edit(unidad){
            this.$emit('edit',unidad)
        },
        delet(unidad){
            this.$emit('delet',unidad)
        },

    }
}

</script>