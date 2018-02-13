<template>
    <div>
        <titulo>
            Faltas Comensal
        </titulo>

        <div>
            <div class="alert alert-info" v-if="isEmpty(presencias)">
                <p>No posee Faltas</p>
            </div>

            <ul class="list-group">
                <li class="list-group-item" v-for="presencia in presencias">
                    <a class="text-info" v-if="bol(presencia.estado)"> Presente <span>{{presencia.instancia.fecha}}</span></a>
                    <a class="text-black" v-else="">Falta <span>{{presencia.instancia.fecha}}</span></a>
                </li>
            </ul>
        </div>
    </div>


</template>


<script>

export  default{
    data(){
        return{
            comensal : vm.app.comensal,
            presencias : {}
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comensal.attribure(
                    this.comensal.id,
                    'presencias',
                    presencias => this.presencias = presencias
            );
        }
    }
}

</script>