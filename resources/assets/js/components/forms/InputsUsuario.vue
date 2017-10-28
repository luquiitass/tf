<template>
    <div>
        <div :class="form.getClassForm('dni')">
            <label >DNI</label>
            <input type="text" class="form-control"  v-model="form.dni" @keyup="conContra">
            <div v-if="listAutocomplete.length">
                <ul class="list-group " >
                    <li class="list-group-item alert-danger">
                        Estos DNI ya se encuentran registrados.
                    </li>
                    <li class="list-group-item select-wrapper" v-for="user in listAutocomplete">
                        <span class="btn btn-xs btn-success pull-right" @click="completarCampos(user)">Asociar</span>
                    {{user.dni}}
                </li>
            </ul>
            </div>
            <span class="help-block" v-if="form.errors.has('dni')" v-text="form.errors.get('dni')"></span>
        </div>

        <div :class="form.getClassForm('nombre')" >
            <label >Nombre</label>
            <input type="text" class="form-control"  v-model="form.nombre">
            <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
        </div>

        <div :class="form.getClassForm('apellido')">
            <label >Apellido</label>
            <input type="text" class="form-control"  v-model="form.apellido">
            <span class="help-block" v-if="form.errors.has('apellido')" v-text="form.errors.get('apellido')"></span>
        </div>

        <div :class="form.getClassForm('fecha_nacimiento')">
            <label >Fecha nacimiento</label>
            <!--<input type="text" class="form-control datepicker"  v-model="form.fecha_nacimiento">-->

            <datepicker v-model="form.fecha_nacimiento" language="es" :bootstrapStyling="true"></datepicker>

            <span class="help-block" v-if="form.errors.has('fecha_nacimiento')" v-text="form.errors.get('fecha_nacimiento')"></span>
        </div>

        <div :class="form.getClassForm('email')" id="datepicker">
            <label >Email</label>
            <input type="text" class="form-control"  v-model="form.email">
            <span class="help-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
        </div>

        <div v-if="!edit" :class="form.getClassForm('password')">
            <label >Contraseña</label>
            <div>
                Otra contraseña
                <input type="checkbox" id="checkbox" v-model="conPass" @change="conContra">
            </div>
            <input type="text" class="form-control"  v-model="form.password" :disabled="!conPass">
            <span class="help-block" >{{conPass ? '' : 'La contraseña por defecto sera el DNI'}}</span>
            <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')" ></span>
        </div>



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