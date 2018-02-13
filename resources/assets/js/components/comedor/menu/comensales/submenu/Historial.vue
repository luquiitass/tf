<template>
    <div>
        <div class="alert alert-info" v-if="isEmpty(todas)">
            <p>No ha realizado modificaciones en sus inscripciones</p>
        </div>
        <ul class="timeline timeline-inverse" v-for="(todas , mes) in groupByMes()">

            <li class="time-label">
                <span class="bg-info">
                  {{mes}}
                </span>
            </li>

            <li v-for="inscripcion in todas ">

                <i :class="classIcon(inscripcion)"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{inscripcion.created_at}} </span>

                    <h3 class="timeline-header">{{getOperacion(inscripcion)}}</h3>

                    <div class="timeline-body">
                        {{modificador(inscripcion)}} indicado q {{isInscripto(inscripcion) ? 'asistiras' : 'no asistiras' }} a {{inscripcion.comida.tipo_comida.nombre | tipoComida}} del {{inscripcion.comida.dia.nombre}} {{ inscripcion.fecha | moment('Do MMMM')}}
                    </div>
                </div>
            </li>


        </ul>


        <ul class="timeline timeline-inverse" v-if="false">
            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-red">
                  10 Feb. 2014
                </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                    <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
                <i class="fa fa-user bg-aqua"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                    </h3>
                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
                <i class="fa fa-comments bg-yellow"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                    <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <!-- END timeline item -->
            <li>
                <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>

    </div>
</template>


<script>

export  default{
    data(){
        return{
            inscripciones : this.comensal.inscripciones,

        }
    },
    props: {
        comensal:{
            reaquired :true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            Comensal.attribure(
                    this.comensal.id,
                    'inscripcionesByDate',
                    inscripciones=> this.inscripciones = inscripciones
            )
        },
        isInscripto(inscripcion){
            return inscripcion.inscripto == 1;
        },
        getOperacion(inscripcion){
            return inscripcion.inscripto == 1 ? 'Anotado' : 'No Anotado';
        },
        groupByMes(){
            return _.groupBy(this.inscripciones,'mes');
        },
        classIcon(insc){
            return this.isInscripto(insc)? 'fa fa-check bg-green' : 'fa fa-ban bg-red';
        },
        modificador(insc){
            return insc.usuario.id == vm.app.usuario.id ? 'Has ' : insc.usuario.apellido + ' ' + insc.usuario.nombre +' ha';
        }
    }
}

</script>