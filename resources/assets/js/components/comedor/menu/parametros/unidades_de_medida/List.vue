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
                    <li class="list-group-item" v-for="unidad in p_list">
                        <div class="btn-group pull-right tools" v-if="esEditable(unidad)">
                            <button class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="edit(unidad)">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="delet(unidad)">
                                <i class="fa fa-trash"></i>
                            </button>

                        </div>
                        <strong>{{unidad.nombre}}</strong>

                        <span class="abreviatura"> {{unidad.abreviatura}} </span>

                        <small v-if="unidad.publico" class="label label-info"> Publico </small>
                        <small v-else="" class="label label-warning"> Privado </small>

                        <small v-if="esComedor(unidad)" class="label label-success"> Mio </small>


                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{

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
        edit(unidad){
            this.$emit('edit',unidad)
        },
        delet(unidad){
            this.$emit('delet',unidad)
        },
        esComedor(unidad){
            if (unidad.comedor_id){
                return unidad.comedor_id == vm.app.comedor.id;
            }
            return false;
        },
        esEditable(unidad){
            return !unidad.publico && this.esComedor(unidad);
        },
    }
}

</script>