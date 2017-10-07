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
        path : '/comedor',
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


];


export  default new VueRouter({

    routes,

    linkActiveClass:'active'
});