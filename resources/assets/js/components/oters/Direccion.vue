<template>
    <div>

        <div class="row">
                    <div class="col-xs-12 col-md-9">

                        <div :class="form.getClassForm('direccion.calle')" >
                            <label >Calle</label>
                            <input type="text" class="form-control"  v-model="form.direccion.calle">
                            <span class="help-block" v-if="form.errors.has('direccion.calle')" v-text="form.errors.get('direccion.calle')"></span>
                        </div>

                    </div>
                </div>


                <div class=" row">

                    <div class="col-xs-12 col-md-3">
                        <div :class="form.getClassForm('direccion.altura')" >
                            <label >Altura</label>
                            <input type="number" class="form-control"  v-model="form.direccion.altura">
                            <span class="help-block" v-if="form.errors.has('direccion.altura')" v-text="form.errors.get('direccion.altura')"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">

                        <div :class="form.getClassForm('direccion.calle')" >
                            <label >Departamento</label>
                            <input type="text" class="form-control"  v-model="form.direccion.dpto">
                            <span class="help-block" v-if="form.errors.has('direccion.dpto')" v-text="form.errors.get('direccion.dpto')"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div :class="form.getClassForm('direccion.piso')" >
                            <label >Piso</label>
                            <input type="number" class="form-control"  v-model="form.direccion.piso">
                            <span class="help-block" v-if="form.errors.has('direccion.piso')" v-text="form.errors.get('direccion.piso')"></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <label >Pais</label>
                        <select class="form-control"  v-model="idPais" @change="cargarProvincias(idPais)">
                            <option v-for="pais in paises"  :value="pais.id" > {{pais.nombre}}</option>
                        </select>
                        <span class="help-block" v-if="!paises.length" >Sin Paises</span>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <label >Provincia</label>
                        <select class="form-control" v-model="idProvincia"  @change="cargarLocalidades(idProvincia)" >
                            <option v-for="provincia in provincias" :value="provincia.id">{{provincia.nombre}}</option>
                        </select>
                        <span class="help-block" v-if="!idPais" >Seleccionar pais</span>
                        <span class="help-block" v-if="sinProvincias" >No posee provincias</span>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <label >Localidad</label>
                        <select class="form-control" v-model="form.direccion.localidad_id">
                            <option v-for="localidad in localidades" :value="localidad.id">{{localidad.nombre}}</option>
                        </select>
                        <span class="help-block" v-if="!idProvincia" >Seleccionar Provincia</span>
                        <span class="help-block" v-if="sinLocalidades" >No posee Localidades</span>
                    </div>
                </div>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            form : this.p_form,
            idPais:null,
            idProvincia:null,
            idLocalidad:null,
            paises:{},
            provincias:{},
            localidades:{},
            sinPaises:false,
            sinProvincias:false,
            sinLocalidades:false,

        }
    },
    props: {
        p_form : {
            required : true,
        }
    },
    computed:{
        /*calle(){
            return this.form.direccion.calle;
        },
        altura(){
            return this.form.direccion.altura;
        },
        piso(){
            return this.form.direccion.piso;
        },
        dpto(){
            return this.form.direccion.dpto;
        },
        localidad_id(){
            return this.form.direccion.localidad_id;
        },*/

    },
    watch:{
       /* calle(){
            this.update();
        },altura(){
            this.update();
        },
        piso(){
            this.update();
        },
        dpto(){
            this.update();
        },
        localidad_id(){
            this.update();
        },*/

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.form = this.p_form;


            if (this.form.direccion && this.form.direccion.localidad){
                this.cargarLocalidad(this.form.direccion.localidad);

            }

            Conexion.get(PATH + 'select2/Pais').then(paises => this.paises = paises);

        },
        update(){
            console.log('update');
            //this.$emit('update',this.form.direccion);
            this.$set(this.p_form ,'direccion',this.form.direccion);
            //this.$forceUpdate();
        },
        cargarProvincias(pais){
            console.log(pais)
            this.clear()
            Pais.attribure(
                    pais,
                    'provincias',
                    provincias  => {
                        this.provincias = provincias;
                        this.sinProvincias = provincias.length == 0;
                    }
            );
        },
        cargarLocalidades(provincia){
            Provincia.attribure(
                    provincia,
                    'localidades',
                    localidadaes  => {
                        this.localidades = localidadaes;
                        this.sinLocalidades = localidadaes.length == 0;
                    }
            );
        },
        clear(){
            this.provincias = null;
            this.sinProvincias =false;
            this.localidades = null;
            this.sinLocalidades = false;
        },
        cargarLocalidad(localidad){
            this.localidades = [];
            this.provincias = [];
            this.paises = [];

            this.idPais = localidad.provincia.pais.id;
            this.idProvincia = localidad.provincia.id;

            this.addFirstList(this.localidades,localidad);
            this.addFirstList(this.provincias,localidad.provincia);
            this.addFirstList(this.paises,localidad.provincia.pais);

            this.cargarProvincias(this.idPais);
            this.cargarLocalidades(this.idProvincia);


        }
    }
}

</script>