<template>
    <div>
        <div v-if="!edit">

            <div :class="form.getClassForm('tipo_comida_id')" v-if="!edit">
                <label >Tipo de Comida</label>
                <select class="form-control" v-model="form.tipo_comida_id">
                    <option  v-for="tipo in tipos" :value="tipo.id">{{tipo.nombre}}</option>
                </select>
                <span class="help-block" v-if="form.errors.has('tipo_comida_id')" v-text="form.errors.get('tipo_comida_id')"></span>
            </div>

            <div :class="form.getClassForm('inicio')" >
            <label >Inicia:</label>
            <input type="time" class="form-control  "  v-model="form.inicio">
            <span class="help-block" v-if="form.errors.has('inicio')" v-text="form.errors.get('inicio')"></span>
            </div>

            <div :class="form.getClassForm('fin')" >
            <label >Finaliza:</label>
            <input type="time" class="form-control "  v-model="form.fin">
            <span class="help-block" v-if="form.errors.has('fin')" v-text="form.errors.get('fin')"></span>
            </div>

            <div :class="form.getClassForm('hora_pre_inscripcion')" >
            <label >Hora:</label>
            <input type="time" class="form-control "  v-model="form.hora_pre_inscripcion">
            <div class="has-info">
            <span class="help-block"> explicación </span>
            </div>
            <span class="help-block" v-if="form.errors.has('hora_pre_inscripcion')" v-text="form.errors.get('hora_pre_inscripcion')"></span>
            </div>

            <label v-for="dia in dias.all()" for="dia" class="checkbox-inline" @click="selectDia(dia.nombre)">
            <input type="checkbox" :id="dia.nombre" :value="dia.id" v-model="diasSelect"/>
            {{dia.nombre}}
            </label>
            <div :class="form.getClassForm('dias')">
                <span class="help-block" v-if="form.errors.has('dias')" v-text="form.errors.get('dias')"></span>
            </div>



    </div>

        <div v-if="edit">

            <div class="form-group">
                <label class="checkbox">Dias</label>

                <label class="btn-block">
                    <input type="checkbox" v-model="todos"/>
                    Seleccionar/Quitar todos.
                </label>

                <ul class="list-unstyled">
                    <li v-for="comida in form.comidas" :class="'row border-top ' + getClassComida(comida)">

                        <div class="col-xs-3">
                            <label for="dia" class="checkbox-inline" @click="selectDia(comida.dia.nombre)">
                                <input type="checkbox" :id="comida.dia.nombre" :value="comida.dia.id" v-model="comida.activo"/>
                                {{comida.dia.nombre}}
                            </label>
                        </div>

                        <div class="col-xs-9" >
                            <div class="row">
                                <div class=" col-xs-12 col-md-4 form-group  input-group-sm">
                                    <span class="input-group-addon bg-gray">inicia</span>
                                    <input type="time" class="form-control" placeholder="Hora" v-model="comida.inicio" :disabled="!comida.activo">
                                </div>
                                <div class="col-xs-12 col-md-4 form-group  input-group-sm">
                                    <span class="input-group-addon bg-gray">Finaliza</span>
                                    <input type="time" class="form-control " placeholder="Hora" v-model="comida.fin" :disabled="!comida.activo" >
                                </div>
                                <div class="col-xs-12 col-md-4 form-group  input-group-sm">
                                    <span class="input-group-addon bg-gray">Hora</span>
                                    <input type="time" class="form-control " placeholder="Hora" v-model="comida.hora_pre_inscripcion" :disabled="!comida.activo">
                                </div>
                            </div>

                        </div>
                    </li>
                </ul>

            </div>




        </div>


    </div>


</template>

<script>


export default{

    data(){
        return{
            dias : new Coleccion({}),
            diasSelect:[],
            tipos : [],
            todos:'',
            d:{}
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

            this.diasSelect = _.pluck(this.form.dias, 'id');


            $('.timepicker').wickedpicker();


        },

        selectDia(dia){
            $('#' + dia).click()
        },
        isDiaSelect( dia){
            return _.contains(this.diasSelect,dia.id);
        },
        getClassDia(dia){
            var retorno = this.isDiaSelect(dia) ? '' : 'inputs-disable';

            return retorno;
        },
        getClassComida(comida){
            return comida.activo ? 'bg-success' : 'bg-danger';
        }
    },
    watch:{
        diasSelect:function (value) {
            this.form.dias = value
        },
        todos:function (value) {
            for (var comida in this.p_comidas){
                comida.activo = value;
            }
        },


    }
}
</script>