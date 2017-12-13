<template>
    <div>
        <div class="callout callout-info">
            <h4>
                <i class="icon fa fa-info"></i>
                Instancia con estado : "{{p_instancia.estadoActivo.nombre}}"
            </h4>

            <p> Las inscripciones a esta comida se encuantran cerradas desde
                <span class="badge badge-secondary">
                    <i class="fa fa-clock-o"></i>
                     {{p_instancia.fechaCierreInscripcion.date}}
                </span>
                y se llevara a cabo el
                <span class="badge badge-secondary">
                    <i class="fa fa-clock-o"></i>
                     {{p_instancia.fecha}}
                </span>
            </p>

        </div>

    </div>

</template>


<script>

export  default{
    data(){
        return{

        }
    },
    props: {
        p_instancia :{
            required : true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        }
    }
}

</script>