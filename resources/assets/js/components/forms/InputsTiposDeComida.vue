<template>
    <div>
        <div :class="form.getClassForm('nombre')" >
            <label >Nombre</label>
            <input type="text" class="form-control"  v-model="form.nombre">
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

        <div class="form-group">
            <label class="checkbox">Dias</label>

            <label class="btn-block">
                <input type="checkbox" v-model="todos"/>
                Todos
            </label>

            <label v-for="dia in dias" for="dia" class="checkbox-inline" @click="selectDia(dia)">
                <input type="checkbox" :id="dia" :value="dia" v-model="diasSelect"/>
                {{dia}}
            </label>
            <!-- fin checkbox -->
        </div>


    </div>


</template>

<script>


export default{

    data(){
        return{
            dias :Constants.dias(),
            diasSelect : [],
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
            var self = this;
            for ( var item in this.form.comidas_por_dia) {
                self.diasSelect.unshift(this.form.comidas_por_dia[item].dia)
            }

            this.form.comidas_por_dia = self.diasSelect;
        },
        selectDia(dia){
            $('#' + dia).click()
        }
    },
    watch:{
        diasSelect:function (value) {
            this.form.comidas_por_dia = value
        },
        todos:function (value) {
            if (value){
                this.diasSelect = Constants.dias();
            }else{
                this.diasSelect = [];
            }
        }
    }
}
</script>