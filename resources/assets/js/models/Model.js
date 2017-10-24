

class Model {

    static url(){
        return 'falta_indicar_la_ruta_del_modelo'
    }


    static find(id ,then){

        return Conexion.get(PATH + this.url() + '/' + id)

            .then(data=> then(data));

    }

    static consult(url , then){

        return Conexion.get(PATH + this.url())

            .then(data=> then(data));
    }

    static attribure(id,attribute ,then){
        Conexion.get(PATH + this.url() + '/' + id + '/attribute?attribute=' + attribute)
            .then(data => then(data));
    }



    static all(then) {

        return Conexion.get(PATH + this.url())

            .then(comedores => then(comedores))
    }
}

export default Model;