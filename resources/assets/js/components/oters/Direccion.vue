<template>
    <div>

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body row">

                <div class="col-xs-12 col-md-6">

                    <div :class="form.getClassForm('direccion.calle')" >
                        <label >Nombre</label>
                        <input type="text" class="form-control"  v-model="form.direccion.calle">
                        <span class="help-block" v-if="form.errors.has('direccion.calle')" v-text="form.errors.get('direccion.calle')"></span>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>

                </div>

                <div class="col-xs-12 col-md-6">

                </div>

            </div>
            <!-- /.box-body -->
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            form : this.p_form,
        }
    },
    props: {
        p_form : {
            required : true,
        }
    },
    computed:{
        calle(){
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
        },

    },
    watch:{
        calle(){
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
        },

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.form = this.p_form;
            if (!this.form.direccion){
                this.form.direccion = new Direccion.new();
            }
        },
        update(){
            console.log('update');
            //this.$emit('update',this.form.direccion);
            this.$set(this.p_form ,'direccion',this.form.direccion);
            //this.$forceUpdate();
        }
    }
}

</script>