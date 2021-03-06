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

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

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


            <router-link tag="li" to="/usuarios" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.usuarios') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/comedores" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.comedores') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/tiposDeComida" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.tipos_de_comida') }}
                </span>
                </a>
            </router-link>


            <router-link tag="li" to="/localidades" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.localidades') }}
                </span>
                </a>
            </router-link>

            <router-link tag="li" to="/unidadesDeMedida" exact>
                <a>
                    <i class='fa fa-link'></i>
                    <span>{{trans('string.unidades_de_medida') }}
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
                    {{--<span>{{trans('string.comedorescomedor
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
