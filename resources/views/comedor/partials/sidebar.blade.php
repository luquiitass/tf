<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }} </p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif


        <!-- Sidebar menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->


            {{--<router-link tag="li" to="/" exact>--}}
                {{--<a>--}}
                    {{--<i class='fa fa-link'></i>--}}
                    {{--<span>{{trans('string.inicio') }}</span>--}}
                {{--</a>--}}

            {{--</router-link>--}}


            <router-link tag="li" to="/" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.inicio') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/comensales" :claass="{
            active : hasRoute('/comensales')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.comensales') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/anotados" :claass="{
            active : hasRoute('/anotados')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.anotados') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/calendario" :claass="{
                active : hasRoute('/calendario')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.calendario') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/anuncios" :claass="{
                active : hasRoute('/anuncios')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.anuncios') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/tiposComidas" :claass="{
            active : hasRoute('/tiposComida')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.tipos_de_comida') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/recetas" :claass="{
            active : hasRoute('/recetas')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.recetas') }}
                </span>
                </a>
            </router-link>


           {{-- <router-link tag="li" to="/insumos" :claass="{
            active : hasRoute('/insumos')}">
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.insumos') }}
                </span>
                </a>
            </router-link>--}}


            <li :class="{treeview :true , active : hasRoute('/almacen')}">
                <a href="#">
                    <i class='fa fa-link'></i>
                    <span>{{ trans('string.almacen') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <router-link tag="li" to="/almacen/insumos" :claass="{active : hasRoute('/almacen/insumos')}">
                        <a>
                            <i class='fa fa-link'></i>
                            {{ trans('string.insumos') }}
                        </a>
                    </router-link>

                    <router-link tag="li" to="/almacen/ingresos" :claass="{active : hasRoute('/almacen/ingresos')}">
                        <a>
                            <i class='fa fa-link'></i>
                            {{ trans('string.ingresos') }}
                        </a>
                    </router-link>
                </ul>
            </li>



            <li :class="{treeview :true , active : hasRoute('/parametros')}">
                <a href="#">
                    <i class='fa fa-link'></i>
                    <span>{{ trans('string.parametros') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <router-link tag="li" to="/parametros/unidadesDeMedida" :claass="{active : hasRoute('/parametros/unidadesDeMedida')}">
                        <a>
                            <i class='fa fa-link'></i>
                            {{ trans('string.unidades_de_medida') }}
                        </a>
                    </router-link>
                </ul>
            </li>


            <router-link tag="li" to="/administradores" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.administradores') }}
                </span>
                </a>
            </router-link>

            {{--<router-link tag="li" to="/mercaderias" exact>--}}
                {{--<a>--}}
                    {{--<i class='fa fa-link'></i>--}}
                    {{--<span>{{trans('string.mercaderias') }}--}}
                {{--</span>--}}
                {{--</a>--}}
            {{--</router-link>--}}

            {{--<router-link tag="li" to="/recetas" exact>--}}
                {{--<a>--}}
                    {{--<i class='fa fa-link'></i>--}}
                    {{--<span>{{trans('string.recetas') }}</span>--}}
                {{--</a>--}}
            {{--</router-link>--}}


            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class='fa fa-link'></i>--}}
                    {{--<span>{{trans('string.comedores') }}--}}
                    {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
                {{--<a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
                    {{--<li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
