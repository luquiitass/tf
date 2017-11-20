

class Model {

    static url(){
        return 'falta_indicar_la_ruta_del_modelo'
    }


    static find(id ,then){

        return Conexion.get(PATH + this.url() + '/' + id)

            .then(data=> {
                then(data);
                vm.$forceUpdate();
            });

    }

    static consult(url , then){

        return Conexion.get(PATH + this.url())

            .then(data=> {
                then(data);
                vm.$forceUpdate();
            });
    }

    static attribure(id,attribute ,then){
        Conexion.get(PATH + this.url() + '/' + id + '/attribute?attribute=' + attribute)
            .then(data => {
                then(data);
                vm.$forceUpdate();
            });
    }



    static all(then) {

        return Conexion.get(PATH + this.url())

            .then(data => {
                then(data);
                vm.$forceUpdate();
            })
    }

    containId(object){
        if(object[0].id){
            return true;
        }
        return false;
    }

    static indexById(){
        return _.indexBy(list, 'id');
    }
}

export default Model;