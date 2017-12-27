<template>

    <div>
        <titulo>
            Calendario
        </titulo>

        <div class="text-center">
            <a :href="crearInstancia" class="btn btn-primary"> Generar instancias por una semana</a>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <div id="calendar"></div>
            </div>
        </div>


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
            var self = this;
            this.events = _.map(this.instancias , function (item) {
                var link =  url + '/' + item.id + '/' + 'instancia';
                var color = self.getColorEstado(item);
                return {
                    title: item.comida.tipo_comida.nombre,
                    start : item.fecha,
                    url : link,
                    backgroundColor: color,
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
                editable: false,
                droppable : false,
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
        },
        getColorEstado(instancia){
            console.log(instancia);
            var color = '#000';
            var estado = instancia.instancia_estado_actual.estado.nombre;
            if(estado == 'Inscripcion abierta'){
                color = '#00a65a';
            }else if(estado == 'Inscripcion cerrada'){
                color = '#8080ff';
            }else if(estado == 'Finalizada'){
                color = '#1aa3ff';
            }else{
                color = '#ff471a';
            }
            return color;
        }

    }
}

</script>