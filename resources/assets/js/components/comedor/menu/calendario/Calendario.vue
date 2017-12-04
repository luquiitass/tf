<template>

    <div>
        <titulo>
            Calendario
        </titulo>

        <div class="text-center">
            <a :href="crearInstancia" class="btn btn-primary"> Generar instancias por una semana</a>
        </div>

        <div id="calendar"></div>

        <div id="m"></div>

    </div>

</template>



<script>

export  default{
    data(){
        return{
            comedor : vm.app.comedor,
            instancias : [],
            events : [],
            crearInstancia :PATH
        }
    },
    props: {

    },
    created(){
        this.init();
    },
    watch:{
        instancias(){
            var url = document.URL;
            this.events = _.map(this.instancias , function (item) {
                var link =  url + '/' + item.id + '/' + 'instancia';
                return {
                    title: item.comida.tipo_comida.nombre,
                    start : item.fecha,
                    url : link,
                    backgroundColor : '#f56954'
                }
            });
            this.calendar();
        }
    },
    methods:{
        init(){
            this.crearInstancia =  PATH + 'comedor/' + this.comedor.id + '/crearInstancias';

            Comedor.attribure(
                    vm.app.comedor.id,
                    'instancias',
                    instancias => {
                        this.instancias = instancias
                    }
            );
        },
        calendar(){

            $('#calendar').fullCalendar({
                locale: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                events :this.events
            });
        },
        generarInstancias(){
            Comedor.attribure(
                    this.comedor.id,
                    'crearInstanciasSemanal',
                    instancias => {
                        this.instancias = instancias;
                        this.calendar();
                    }
            );
        }
    }
}

</script>