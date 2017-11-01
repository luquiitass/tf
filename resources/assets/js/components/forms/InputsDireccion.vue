<template>
    <div>

        <!--<div :class="form.getClassForm('nombre')" >-->
            <!--<label >Nombre</label>-->
            <!--<input type="text" class="form-control"  v-model="form.nombre">-->
            <!--<span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>-->
        <!--</div>-->

        <!--<div :class="form.getClassForm('apellido')">-->
            <!--<label >Apellido</label>-->
            <!--<input type="text" class="form-control"  v-model="form.apellido">-->
            <!--<span class="help-block" v-if="form.errors.has('apellido')" v-text="form.errors.get('apellido')"></span>-->
        <!--</div>-->


    </div>
</template>

<script>

export default{
    props : {
        edit:{
            required : true,
        },
        form:{
            required :true,
        },
        autocomplete:{
            default:false,
        }
    },

    data(){
        return{
            conPass : false,
            listAutocomplete:[]
        }

    },
    created(){

//        $('.datepicker').datepicker({
//            endDate: "now",
//            maxViewMode: 3,
//            language: "es",
//            calendarWeeks: true,
//            autoclose: true,
//            todayHighlight: true
//        });
    },
    computed : {
        conCont : function (){
            return this.conPass ? 'LA contrtaseña sera el DNI' : '';
        }
    },

    methods:{
        conContra(){
            if (!this.edit){
                this.form.password = this.conPass ? '' : this.form.dni;
            }
            if(this.autocomplete && this.form.dni.length > 6){
                this.searchUsuario();
            }
        },
        searchUsuario(){
            var parms = '?query='+ this.form.dni + '&columns=dni';
            axios.get(PATH + 'usuarios/search' + parms )
                    .then(response =>{
                        this.listAutocomplete = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
        }
        ,
        completarCampos(usuario){
            this.$emit('atthachUsuario',usuario);
        }
    }
}

</script>