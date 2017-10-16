import VueRouter from 'vue-router';

let routes = [
    //menu principal
    {
        path : '/',
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
        path : '/inicio',
        components :{
            content_comedor : require('./components/comedor/menu/Inicio')
        }
    },
    {
        path : '/comensales',
        components :{
            content_comedor : require('./components/comedor/menu/Comensales')
        }
    },
    {
        path : '/anotados',
        components :{
            content_comedor : require('./components/comedor/menu/Anotados')
        }
    },
    {
        path : '/tiposDeComida',
        components :{
            content_comedor : require('./components/comedor/menu/TiposDeComida.vue')
        }
    },
    {
        path : '/administradores',
        components :{
            content_comedor : require('./components/comedor/menu/Administradores.vue')
        }
    },


];


export  default new VueRouter({

    routes,

    linkActiveClass:'active'
});