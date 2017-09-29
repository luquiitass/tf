<template>

    <div id="modal-delet" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{titulo}}</h5>
                    <button type="button" class="close" @click="hide()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{text}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="eliminar()">Eliminar</button>
                    <button type="button" class="btn btn-secondary" @click="hide()" >Cancelar</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default{
    props:{
        titulo : {
            type:String
        },
        text : {
            type:String
        },
        url : {
            type:String
        }
    },
    methods: {
        show () {
            $('#modal-delet').modal('toggle')
        },
        hide () {
            $('#modal-delet').modal('toggle');
        },
        eliminar(){
            axios.delete(PATH + this.url)
                    .then(data=>{
                        if (data.data == true ){
                            this.$emit('eliminado');
                            console.log('eliminado')
                        }else{
                            console.error(data.data);
                            this.$notify({
                                group: 'g',
                                title: 'Error',
                                text: data.data,
                                type: 'error',
                                duration: 20000,
                            });
                        }
                        this.hide();
                    })
                    .catch(data=>{
                        console.error(data);
                        this.hide();
                        this.$notify({
                            group: 'g',
                            title: 'Error',
                            text: data.response.data,
                            type: 'error',
                            duration: 20000,
                        });

                    });
        }
    },
    mounted : function () {
        this.show();
        var self = this;
        $('#modal-delet').on('hidden.bs.modal', function () {
            console.log('hide modal');
            self.$emit('cancelado')
        })
    }

}

</script>