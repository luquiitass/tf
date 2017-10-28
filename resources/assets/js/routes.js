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
        path : '/recetas',
        components :{
            menu : require('./views/Recetas')
        }
    },
    {
        path : '/mercaderias',
        components :{
            menu : require('./views/Mercaderias')
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
        path : '/tiposComidas',
        components :{
            content_comedor : require('./components/comedor/menu/comidas/Index.vue'),
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


];

function dynamicPropsFn (route) {

    return route.query;
}


export  default new VueRouter({

    routes,

    linkActiveClass:'active'
});