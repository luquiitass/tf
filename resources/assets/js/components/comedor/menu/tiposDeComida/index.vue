<template>
    <div>
        <titulo>
            Tipos de comida

            <button class="btn btn-success ">Nuevo
                <i class="fa fa-plus"></i>
            </button>

        </titulo>


        <div class="row">
            <div class="col-xs-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" href="#home">Desayuno</a></li>
                    <li><a data-toggle="tab" href="#menu1">Almuerzo</a></li>
                    <li><a data-toggle="tab" href="#menu2">Merienda</a></li>
                    <li><a data-toggle="tab" href="#menu3">Cena</a></li>
                </ul>

            </div>
            <div class="col-xs-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>Menu 3</h3>
                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
            </div>
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

    },
    created(){
        this.init();
    },
    methods:{
      init(){
        console.log('parth desde Tipos de comida : ' + vm.path);
      }
    }
}

</script>