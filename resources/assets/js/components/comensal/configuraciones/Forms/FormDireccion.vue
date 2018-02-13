<template>
    <div>
        <div class="alert alert-danger" v-if="!conDireccion">
            <i></i>
            <p>Debe Indicar su dirección</p>
        </div>

            <form  @submit.prevent="onSubmit" @keydown="form.errors.clear()" >

                <direccion
                :p_form="form">

                </direccion>

                <button type="submit" :disabled="form.errors.any()" class="btn btn-success pull-right">{{edit? 'Modificar' : 'Guardar'}}</button>

            </form>


    </div>
</template>


<script>

export  default{
    data(){
        return{
            comensal: vm.app.comensal,
            show:false,
            conDireccion:true,
            edit:false
        }
    },
    props: {
        form:{
            required : true
        },
        usuario:{
            required:true
        }
    },
    computed:{

    },
    created(){
        this.init();
    },
    methods:{
        init(){

            if (this.isEmpty(this.usuario.direccion)){
                this.form.direccion = new Direccion();
                this.form.direccion.usuario_id = this.usuario.id;
            }else {
                this.form.direccion = this.usuario.direccion;
                this.edit = true
            }

            this.conDireccion = !this.isEmpty(this.usuario.direccion);


        },

        onSubmit(){
            if (this.edit){
                this.form.put( PATH +'direccion/' + this.form.direccion.id)
                        .then(direccion =>{
                            this.usuario.direccion = direccion;
                            this.init();
                            //Vue.set(vm.app.comensal,'usuario',usuario);
                            console.log(direccion);
                            //this.init();
                        })
                        .catch(error=>{
                            console.log(error);
                        });
            }else{
                this.form.post( PATH +'direccion')
                        .then(direccion  =>{
                            this.usuario.direccion = direccion;
                            this.init()

                            console.log(direccion);
                        })
                        .catch(error=>{
                            console.log(error);
                        });
            }
        },

    }
}

</script>