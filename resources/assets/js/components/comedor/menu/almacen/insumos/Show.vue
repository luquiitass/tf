<template>
    <div v-if="p_insumo">
        <div class="text-center">
            <h3>{{p_insumo.nombre}}</h3>
            <p>
                disponible
            </p>
            <p>
                <span class="bg-info" style="padding: 3px">{{p_insumo.disponibilidad}}</span>

                {{p_insumo.unidad_de_medida.abreviatura}}</p>

            <div class="btn-group">
                <button class="btn btn-success" @click="edit()">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-danger" @click="delet()">
                    <i class="fa fa-trash"></i>
                </button>
                <button class="btn btn-default" @click="cancelar()">
                    <i class="fa fa-close"></i>
                </button>
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
        p_insumo:{
            required:true
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){

        },
        cancelar(){
            this.$emit('cancelar');
        },
        delet(){
            this.cancelar();
            this.$emit('delet')
        },
        edit(){
            this.cancelar();
            this.$emit('edit',this.p_insumo)
        }
    }
}

</script>