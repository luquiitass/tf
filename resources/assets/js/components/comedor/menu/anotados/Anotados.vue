<template>
    <div>
        <titulo>
            Lista de Anotados
        </titulo>

        <div>
            <ul>
                <li v-for="comensal in comensales">
                    {{comensal.apellido}} {{comensal.nombre}}
                </li>
            </ul>
        </div>
    </div>

</template>


<script>

export  default{
    data(){
        return{
            comensales : {}
        }
    },
    props: {
        comida: {
            requerid: true,
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