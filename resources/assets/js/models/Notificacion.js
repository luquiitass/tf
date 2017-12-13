class Notificacion{

    static  mostrarMensaje(mensaje){
        vm.$notify({
            group:'g',
            title:mensaje.titulo,
            text:mensaje.mensaje,
            type:mensaje.tipo,
            duration:9000
        });
    }

}

export default Notificacion;