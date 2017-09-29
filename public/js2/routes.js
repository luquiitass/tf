import VueRouter from 'vue-router';

let routes = [
    //Menu principal
    {
        path : '/',
        components :{
            menu : require('./views/Home')
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
];


export  default new VueRouter({

    routes,


});