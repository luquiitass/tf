<template>
    <div :class="classContenedor()">

        <div v-if="showModal()">
            <div id="modal-delet" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="false" class="modal fade bd-example-modal-sm in" style="display: block;">
                <div :class="'modal-dialog modal-' + type ">
                    <div class="modal-content">
                        <div  class="modal-body">
                            <slot>
                                <p>{{sizeScreen}}</p>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="modal-content">
                <div  class="modal-body">
                    <slot>
                        <p>{{sizeScreen}}</p>
                    </slot>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default{

    data(){
        return{
            sizeScreen:window.innerWidth,
        }
    },
    props:{
        type:{
            required:true,
            default:'lg'
        },
        col:{
            required:true,
            default:'12'
        }
    },
    methods:{
        show () {
            $('#modal-delet').modal('show')
        },
        hide () {
            $('#modal-delet').modal('toggle');
        },
        showModal(){
            return this.sizeScreen < 1200;
        },
        classContenedor(){
            return 'col-xs-0 col-lg-'+ this.col;
        }
    },
    mounted : function () {
        var _this = this;
        this.show();
        var self = this;
        $('#modal-delet').on('hidden.bs.modal', function () {
            console.log('hide modal');
            self.$emit('cancelado')
        })
        $(window).resize(function(){
            _this.sizeScreen = window.innerWidth;
        });
    }
}
</script>