<template>
    <div class="box box-solid">
        <div class="box-header wit-border">
            <h3 class="box-title">Temporada</h3>
        </div>

        <div class="box-body">

            <div id="form_inicio">

                <form @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                    <div class="col-xs-6">

                        <div :class="form.getClassForm('inicia')" >
                            <label >Fecha que inicia</label>
                            <input type="date" class="form-control"  v-model="form.inicia">
                            <span class="help-block" v-if="form.errors.has('inicia')" v-text="form.errors.get('inicia')"></span>
                        </div>

                    </div>



                    <div class="col-xs-6">

                        <div :class="form.getClassForm('finaliza')" >
                            <label >Fecha que finaliza</label>
                            <input type="date" class="form-control"  v-model="form.finaliza">
                            <span class="help-block" v-if="form.errors.has('finaliza')" v-text="form.errors.get('finaliza')"></span>
                        </div>

                    </div>


                    <div class="box-footer pull-right">
                        <button type="submit" :disabled="form.errors.any()" class="btn btn-success">Guardar</button>
                    </div>

                    <div class="has-error">
                        <span class="help-block" v-if="form.errors.any()">Verificar los datos ingresados</span>
                    </div>

                </form>

            </div>
        </div>
    </div>
</template>

<script>



export default{

    data(){
        return{
            configuracion :{},
            form: {}//new Form(this.objeto),
        }
    },
    props:{
        objeto:{
            required:true
        }
    },
    created(){
        this.configuracion = vm.app.comedor.configuracion;
        this.loadForm();
    },
    components:{

    },
    methods:{
        loadForm(){
            this.form = new Form({inicia:this.configuracion.inicia,finaliza : this.configuracion.finaliza });
        },
        onSubmit(){
            this.form
                    .put(PATH +'configuracionesComedor/' + this.configuracion.id +'/inicioFin')
                    .then(data => {
                        //this.$emit('edited',data)
                        this.configuracion = data;
                        Vue.set(vm.app.comedor,'configuracion',data);
                        this.loadForm();
                    });
        },
        cancelar(){
            this.$emit('cancelar');
        }
    }
}

</script>