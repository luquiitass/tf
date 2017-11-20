<template>

    <div>
        <titulo>
            Calendario
        </titulo>

        <div id="calendar"></div>

        <div id="m"></div>

    </div>

</template>



<script>

export  default{
    data(){
        return{
            instancias : [],
            events : []
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
        }
    }
}

</script>