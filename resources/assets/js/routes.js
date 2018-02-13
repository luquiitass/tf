import VueRouter from 'vue-router';

let routes = [
    //menu principal
    {
        path : '/home',
        components :{
            menu : require('./views/Home')
        }
    },
    {
        path : '/usuarios',
        components :{
            menu : require('./views/Usuarios')
        }
    },
    {
        path : '/comedores',
        components :{
            menu : require('./views/Comedores')
        }
    },
    {
        path : '/tiposDeComida',
        components :{
            menu : require('./components/sistema/tiposComida/Index')
        }
    },
    {
        path : '/unidadesDeMedida',
        components :{
            menu : require('./components/sistema/unidades_de_medida/Index')
        }
    },
    {
        path : '/localidades',
        components :{
            menu : require('./components/sistema/localidades/Index')
        }
    },


    //menu de un Comedor
    {
        path : '/',
        components :{
            content_comedor : require('./components/comedor/menu/Inicio')
        }
    },
    {
        path : '/comensales',
        components :{
            content_comedor : require('./components/comedor/menu/comensales/Index')
        },
        children :[
            {
                path : '/',
                component : require('./components/comedor/menu/comensales/List')
            },
            {
                path : ':id',
                component : require('./components/comedor/menu/comensales/Show'),
                props : dynamicPropsFn
            }
        ]
    },
    {
        path : '/anotados',
        components :{
            content_comedor : require('./components/comedor/menu/Anotados')
        },
        children : [
            {
                path : '/',
                components : {
                    submenu: require('./components/comedor/menu/anotados/Index'),
                },
                props : dynamicPropsFn
            }
            ,{
                path : ':id',
                components : {
                    submenu: require('./components/comedor/menu/anotados/Anotados'),
                },
            }
        ]
    },

    {
        path : '/calendario',
        components :{
            content_comedor : require('./components/comedor/menu/calendario/Index.vue'),
        },
        children : [
            {
                path : '/',
                components : {
                    submenu: require('./components/comedor/menu/calendario/Calendario.vue'),
                },
                props : dynamicPropsFn
            }
            ,{
                path : ':id/instancia',
                components : {
                    submenu: require('./components/comedor/menu/calendario/Instancia.vue'),
                },
            }
        ]
    }
    ,
    {
        path : '/anuncios',
        components :{
            content_comedor : require('./components/comedor/menu/anuncios/Index.vue'),
        }
    },

    {
        path : '/tiposComidas',
        components :{
            content_comedor : require('./components/comedor/menu/comidas/Index.vue'),
        }
    },
    {
        path : '/almacen/insumos',
        components :{
            content_comedor : require('./components/comedor/menu/almacen/insumos/Index.vue'),
        }
    },
    {
        path : '/almacen/insumos/:id',
        components :{
            content_comedor : require('./components/comedor/menu/almacen/insumos/Show.vue'),
        }
    },
    {
        path : '/almacen/ingresos',
        components :{
            content_comedor : require('./components/comedor/menu/almacen/insumos/Index.vue'),
        }
    },
    {
        path : '/recetas',
        components :{
            content_comedor : require('./components/comedor/menu/recetas/Index.vue')
        }
    },
    {
        path : '/receta/:id',
        components :{
            content_comedor : require('./components/comedor/menu/recetas/Show.vue')
        }
    },
    {
        path : '/administradores',
        components :{
            content_comedor : require('./components/comedor/menu/Administradores.vue')
        }
    },
    {
        path : '/saludar',
        components :{
            content_comedor : require('./views/Saludar')
        }
    },
    {
        path : '/configuraciones',
        components :{
            content_comedor : require('./components/comedor/menu/configuraciones/Index.vue')
        }
    },
    {
        path : '/parametros/unidadesDeMedida',
        components :{
            content_comedor : require('./components/comedor/menu/parametros/unidades_de_medida/Index.vue')
        }
    },



    //Rutas de un comensal

    {
        path : '/c_inicio',
        components :{
            content_comensal : require('./components/comensal/inicio/Index')
        }
    },
    {
        path : '/c_inscripciones',
        components :{
            content_comensal : require('./components/comensal/inscripciones/Index')
        }
    },
    {
        path : '/c_actividades',
        components :{
            content_comensal : require('./components/comensal/actividades/Index')
        }
    },
    {
        path : '/c_faltas',
        components :{
            content_comensal : require('./components/comensal/faltas/Index')
        }
    },
    {
        path : '/c_anuncios',
        components :{
            content_comensal : require('./components/comensal/anuncios/Index')
        }
    },
    {
        path : '/c_configuraciones',
        components :{
            content_comensal : require('./components/comensal/configuraciones/Index')
        }
    },


];

function dynamicPropsFn (route) {

    return route.query;
}


export  default new VueRouter({

    routes,

    linkActiveClass:'active'
});