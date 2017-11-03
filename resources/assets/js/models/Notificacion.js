class Notificaion{

    static  mostrarMensaje(mensaje){
        vm.$notify({
            group:'g',
            title:mensaje.titulo,
            text:mensaje.mensaje,
            type:mensaje.tipo,
            duration:2000
        });
    }

}

export default Notificaion;