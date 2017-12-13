<template>
    <div class="row">

        <div class="col-xs-12 col-md-6">

            <div :class="form.getClassForm('nombre')" >
                <label >Nombre</label>
                <input type="text" class="form-control"  v-model="form.nombre">
                <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
            </div>

            <div :class="form.getClassForm('minimo')" >
                <label >Minimo</label>
                <input type="number" step="any" class="form-control"  v-model="form.minimo">
                <span class="help-block" v-if="form.errors.has('minimo')" v-text="form.errors.get('minimo')"></span>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div :class="form.getClassForm('unidad_de_medida_id')" >
                <label >Unidad de medida</label>

                <select  class="form-control" v-model="form.unidad_de_medida_id">
                    <option v-for="op in unidadesDeMedidas" :value="op.id">
                        {{op.nombre}}
                    </option>
                </select>

                <span class="help-block" v-if="form.errors.has('unidad_de_medida_id')" v-text="form.errors.get('unidad_de_medida_id')"></span>
            </div>

            <div :class="form.getClassForm('disponibilidad')" >
                <label >Disponibilidad</label>
                <input type="number" step="any" class="form-control"  v-model="form.disponibilidad">
                <span class="help-block" v-if="form.errors.has('disponibilidad')" v-text="form.errors.get('disponibilidad')"></span>
            </div>

            <div :class="form.getClassForm('activo')" v-if="edit" >
                <label >Activo</label>
                <input type="checkbox"  v-model="form.activo">
                <span class="help-block" v-if="form.errors.has('activo')" v-text="form.errors.get('activo')"></span>
            </div>

        </div>


    </div>
</template>


<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            unidadesDeMedidas:[]
        }
    },
    props: {
        form:{
            required : true
        },
        edit : {
            required:false,
            default : false
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comedor.attribure(
                    this.comedor.id,
                    'unidadesDeMedidasWithPublic',
                    unidades => {
                        this.unidadesDeMedidas = unidades
                    }
            )
            //UnidadDeMedida.all(unidades =>this.unidadesDeMedidas = unidades);
        }
    }
}

</script>