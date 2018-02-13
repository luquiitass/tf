<template>
    <div>
        <titulo>
            Configuraciones
        </titulo>

        <div>

            <div class="box box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Datos
                    </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
                <div class="box-body">
                    <form-datos>
                    </form-datos>
                </div>
            </div><!--Box Datos-->

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Direccion
                    </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form-direccion
                        :form="formDireccion"
                        :usuario ="comensal.usuario">
                    </form-direccion>
                </div>
            </div><!--Box Direccion-->

            <!--<div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Contacto
                    </h3>
                </div>
                <div class="box-body">
                    Form
                </div>
            </div>&lt;!&ndash;Box Contacto&ndash;&gt;-->

        </div>

    </div>

</template>


<script>

import FormDatos from './Forms/FormDatos.vue';
import FormDireccion from './Forms/FormDireccion.vue';

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            comensal : vm.app.comensal,
            list : [],
            formDatos: {},
            formDireccion:{}
        }
    },
    components:{
        FormDatos,
        FormDireccion
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.formDatos = new Form(vm.app.comensal.usuario);
            this.formDireccion = new Form({direccion:this.comensal.usuario.direccion});
        },
    }
}

</script>