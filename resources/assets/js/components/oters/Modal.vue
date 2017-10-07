<template>
    <div id="modal-delet" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div :class="'modal-dialog modal-' + type ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" @click="hide()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel" >
                        <slot name="title"></slot>
                    </h5>
                </div>
                <div  class="modal-body">
                    <slot>
                        Sin Body
                    </slot>
                </div>
                <slot class="modal-footer" name="footer">
                </slot>
            </div>
        </div>
    </div>
</template>

<script>

export default{

    data(){
        return{

        }
    },
    props:{
        type:{
            required:true,
        }
    },
    methods:{
        show () {
            $('#modal-delet').modal('toggle')
        },
        hide () {
            $('#modal-delet').modal('toggle');
        },
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