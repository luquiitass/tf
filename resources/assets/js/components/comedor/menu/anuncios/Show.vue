<template>
    <div :id="'anuncio_' + anuncio.id" :class="classAnuncio(anuncio)" >
        <div class="clearfix">
            <span class="pull-right" >
                <i class="fa fa-clock-o"></i> {{anuncio.registrado}}

                <a v-if="isAdmin" class="btn btn-xs hov" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar" @click="eliminar()">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a v-if="isAdmin" class="btn btn-xs hov"  data-toggle="tooltip" data-placement="top" data-original-title="Editar" @click="editar()"  >
                    <i class="fa fa-edit"></i>
                </a>
            </span>

                <p class="anuncio-title pull-left">{{anuncio.asunto}}</p>
        </div>

        <div class="anuncio-cuerpo">
            <p>{{anuncio.cuerpo}}</p>
        </div>

        <div class="clearfix">
            <span class="anuncio-usuario pull-left ">
                <i class="fa fa-user"></i>
                {{anuncio.usuario.apellido}} {{anuncio.usuario.nombre}}
            </span>
            <small  class="pull-right">
                <i :class="classAnuncioVisible(anuncio)"></i>
                visible hasta <cite title="Source Title">{{anuncio.hasta}}</cite>
            </small>
        </div>

    </div>

</template>


<script>

export  default{
    data(){
        return{
            anuncio : this.p_anuncio,
        }
    },
    props: {
        p_anuncio:{
            required :true
        },
        isAdmin:{
            required:false,
            default :false
        }

    },
    watch:{
        p_anuncio(){
            this.anuncio = this.p_anuncio;
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        editar(){
            this.$emit('editar',this.p_anuncio);
        },
        eliminar(){
            this.$emit('eliminar',this.p_anuncio);
        },
        classAnuncio(anuncio){
            return anuncio.visible ? 'anuncios-item': 'anuncios-item bg-danger';
        },
        classAnuncioVisible(anuncio){
            return anuncio.visible ? 'fa fa-eye' :'fa fa-eye-slash';
        }
    }
}

</script>