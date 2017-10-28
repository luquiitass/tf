<template>
    <div>
        <div :class="form.getClassForm('tipo')" v-if="!edit">
            <label >Tipo de Comida</label>
            <select class="form-control" v-model="form.tipo_comida_id">
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

        <div :class="form.getClassForm('hora_pre_inscripcion')" >
            <label >Hora:</label>
            <input type="text" class="form-control timepicker"  v-model="form.hora_pre_inscripcion">
                <div class="has-info">
                    <span class="help-block"> explicación </span>
                </div>
            <span class="help-block" v-if="form.errors.has('hora_pre_inscripcion')" v-text="form.errors.get('hora_pre_inscripcion')"></span>
        </div>

        <div class="form-group">
            <label class="checkbox">Dias</label>

            <label class="btn-block">
                <input type="checkbox" v-model="todos"/>
                Seleccionar todos
            </label>

            <!--<ul class="list-unstyled">-->
                <!--<li v-for="dia in dias.all()" class="row">-->
                    <!--<div class="col-xs-4">-->
                        <!--<label for="dia" class="checkbox-inline" @click="selectDia(dia.nombre)">-->
                            <!--<input type="checkbox" :id="dia.nombre" :value="dia.id" v-model="diasSelect"/>-->
                            <!--{{dia.nombre}}-->
                        <!--</label>-->
                    <!--</div>-->
                    <!--<div class="col-xs-6">-->
                        <!--<div class="form-group input-group input-group-sm">-->
                            <!--<span class="input-group-addon bg-gray">inicia</span>-->
                            <!--<input type="text" class="form-control" placeholder="Hora">-->
                        <!--</div>-->
                        <!--<div class="form-group input-group input-group-sm">-->
                            <!--<span class="input-group-addon bg-gray">Finaliza</span>-->
                            <!--<input type="text" class="form-control " placeholder="Hora">-->
                        <!--</div>-->
                        <!--<div class="form-group input-group input-group-sm">-->
                            <!--<label >Hora:</label>-->
                            <!--<input type="text" class="form-control " placeholder="Hora">-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</li>-->
            <!--</ul>-->

            <label v-for="dia in dias.all()" for="dia" class="checkbox-inline" @click="selectDia(dia.nombre)">
                <input type="checkbox" :id="dia.nombre" :value="dia.id" v-model="diasSelect"/>
                {{dia.nombre}}
            </label>
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