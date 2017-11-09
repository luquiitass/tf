<template>

    <div>
        <titulo>
            Calendario

            <a @click="calendar()"> probar</a>
        </titulo>

        <div id="calendar"></div>

        <div id="m"></div>

    </div>

</template>



<script>

export  default{
    data(){
        return{

        }
    },
    props: {

    },
    created(){
        this.init();
    },
    methods:{
        init(){


        },
        calendar(){

            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            $('#calendar').fullCalendar({
                locale: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
            });
        }
    }
}

</script>