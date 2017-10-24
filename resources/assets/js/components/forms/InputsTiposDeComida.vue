<template>
    <div>
        <div :class="form.getClassForm('tipo')" >
            <label >Tipo de Comida</label>
            <select class="form-control" v-model="form.tipoComida">
                <option  v-for="tipo in tipos" :value="tipo.id">{{tipo.nombre}}</option>
            </select>
            <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
        </div>

         <div :class="form.getClassForm('inicio')" >
            <label >Inicia:</label>
            <input type="text" class="form-control  timepicker"  v-model="form.inicio">
            <span class="help-block" v-if="form.errors.has('inicio')" v-text="form.errors.get('inicio')"></span>
        </div>

        <div :class="form.getClassForm('fin')" >
            <label >Finaliza:</label>
            <input type="text" class="form-control timepicker"  v-model="form.fin">
            <span class="help-block" v-if="form.errors.has('fin')" v-text="form.errors.get('fin')"></span>
        </div>

        <div :class="form.getClassForm('horas_pre_inscripcion')" >
            <label >Hora:</label>
            <input type="text" class="form-control timepicker"  v-model="form.horas_pre_inscripcion">
                <div class="has-info">
                    <span class="help-block"> explicación </span>
                </div>
            <span class="help-block" v-if="form.errors.has('horas_pre_inscripcion')" v-text="form.errors.get('horas_pre_inscripcion')"></span>
        </div>

        <div class="form-group">
            <label class="checkbox">Dias</label>

            <label class="btn-block">
                <input type="checkbox" v-model="todos"/>
                Seleccionar todos
            </label>

            <label v-for="dia in dias.all()" for="dia" class="checkbox-inline" @click="selectDia(dia.nombre)">
                <input type="checkbox" :id="dia.nombre" :value="dia.id" v-model="diasSelect"/>
                {{dia.nombre}}
            </label>
            <!-- fin checkbox -->
        </div>


    </div>


</template>

<script>


export default{

    data(){
        return{
            dias :'',
            diasSelect:[],
            tipos : [],
            todos:'',
        }
    },
    props : {
        edit:{
            required : false,
            default:false
        },
        form:{
            required :true,
        }
    },
    mounted(){
        this.init();
    },
    methods:{
        init(){
            Dia.all(dias => this.dias = new Coleccion( dias ) );
            TipoComida.all(tipos => this.tipos = tipos);


        },
        selectDia(dia){
            $('#' + dia).click()
        }
    },
    watch:{
        diasSelect:function (value) {
            this.form.dias = value
        },
        todos:function (value) {
            if (value){
                this.diasSelect = _.keys(this.dias.datos);
            }else{
                this.diasSelect = [];
            }
        }
    }
}
</script>