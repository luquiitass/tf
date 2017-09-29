<template>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Usuario</h3>
            <a class="btn btn-xs  pull-right" @click="cancelar">
                <i class="fa  fa-close"></i>
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >
                <div :class="getClass('nombre')" >
                    <label >Nombre</label>
                    <input type="text" class="form-control"  v-model="form.nombre">
                    <span class="help-block" v-if="form.errors.has('nombre')" v-text="form.errors.get('nombre')"></span>
                </div>

                <div :class="getClass('apellido')">
                    <label >Apellido</label>
                    <input type="text" class="form-control"  v-model="form.apellido">
                    <span class="help-block" v-if="form.errors.has('apellido')" v-text="form.errors.get('apellido')"></span>
                </div>

                <div :class="getClass('fecha_nacimiento')">
                    <label >Fecha nacimiento</label>
                    <input type="text" class="form-control"  v-model="form.fecha_nacimiento">
                    <span class="help-block" v-if="form.errors.has('fecha_nacimiento')" v-text="form.errors.get('fecha_nacimiento')"></span>
                </div>

                <div :class="getClass('dni')">
                    <label >DNI</label>
                    <input type="text" class="form-control"  v-model="form.dni" @keyup="conContra">
                    <span class="help-block" v-if="form.errors.has('dni')" v-text="form.errors.get('dni')"></span>
                </div>

                <div :class="getClass('email')">
                    <label >Email</label>
                    <input type="text" class="form-control"  v-model="form.email">
                    <span class="help-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                </div>

                <div :class="getClass('password')">
                    <label >Contraseña</label>
                    <div>
                        Otra contraseña
                        <input type="checkbox" id="checkbox" v-model="conPass" @change="conContra">
                    </div>
                    <input type="text" class="form-control"  v-model="form.password" :disabled="!conPass">
                    <span class="help-block" >{{conPass ? '' : 'La contraseña por defecto sera el DNI'}}</span>
                    <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')" ></span>
                </div>

                <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>

            </form>


        </div>
        <!-- /.box-body -->
    </div>
</template>

<script >


export default{

    data(){
        return{
            form : new Form({nombre:'',apellido: '',dni: '',fecha_nacimiento: '',email: '',password: ''}),
            conPass:false
        }

    },

    computed : {
        conCont : function (){
            return this.conPass ? 'LA contrtaseña sera el DNI' : '';
        }
    },

    methods:{
        onSubmit(){
           this.form
                   .post(PATH +'/usuarios')
                   .then(usurio => this.$emit('usuarioCreado',usurio));
        },
        getClass(valor){
            var retorno = 'form-group';
            if (this.form.errors.any()) {
                retorno = this.form.errors.has(valor) ? 'form-group has-error' : 'form-group has-success';
            }
            return retorno;
        },
        conContra(){
            this.form.password = this.conPass ? '' : this.form.dni;
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>