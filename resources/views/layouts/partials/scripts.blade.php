<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

{{--Vue--}}
<script src="https://unpkg.com/adminlte-vue/dist/acacha-adminlte-vue.min.js"></script>
<script src="https://unpkg.com/vue"></script>

<script type="text/javascript">

   window.App = new Vue({
        el:'#app',

        data:{
            user : {!! Auth::user() !!},
            email : ''
        },

       methods:{
            is :function (val) {
                return val?true:false;
            },
            emailc :function () {
                return this.user.email = this.email;
            }
       }
    });


</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->