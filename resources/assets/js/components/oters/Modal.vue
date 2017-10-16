<template>
    <div :id="idModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
            idModal : _.random(0, 9999),
            id: ''
        }
    },
    props:{
        type:{
            required:false,
        },
        p_show:{
            required:true
        }
    },
    watch:{
        p_show(value){
            this.toggle();
        }
    },
    methods:{
        toggle(){
            if(this.p_show){
                $(this.id).modal('show');
            }else {
                $(this.id).modal('hide');
            }
        },
        show () {
            $(this.id).modal('toggle')
        },
        hide () {
            $(this.id).modal('toggle');
        },
    },
    mounted : function () {
        this.id = '#' + this.idModal;
        this.toggle();
        var self = this;
        $(this.id).on('hidden.bs.modal', function () {
            console.log('hide modal');
            self.$emit('cancelado')
        })
    }
}
</script>