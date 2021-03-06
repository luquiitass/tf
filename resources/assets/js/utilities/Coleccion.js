class Coleccion {
    /**
     * Create a new Errors instance.
     */
    constructor(list) {
        this.datos = _.indexBy(list, 'id');
    }


    /**
     * Determine if an datos exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        return this.datos.hasOwnProperty(field);
    }


    /**
     * Determine if we have any datos.
     */
    any() {
        return Object.keys(this.datos).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {Object} field
     */
    get(field) {
        if (this.datos[field]) {
            return this.datos[field];
        }
        return null;
    }

    addOrReplace(item){
        this.datos[item.id] = item;

    }

    remove(item){
        if(this.datos[item]){
            delete this.datos[item];
            console.log('remove for id')
            return true;
        }else{
            if(this.datos[item.id]) {
                delete this.datos[item.id];
                console.log('remove for id of object')
                return true;
            }
        }
        return false;
    }

    all(){
        return _.values(this.datos);
    }

    first(){
        var item = _.first(this.all());
        return item? item : {id:-1}
    }

    last(){
        return _.last(this.all());
    }

    map(callback){
        return _.map(this.datos, callback);
    }

    each(callback){
        _.each(this.datos, callback);
    }

    count(){
        return this.datos.length;
    }



    /**
     * Record the new datos.
     *
     * @param {object} datos
     */
    record(datos) {
        this.datos = _.indexBy(datos, 'id');
    }

    update(){
        this.record(this.all());
    }

    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.datos[field];
            return;
        }
        this.datos = {};
    }
}
export default Coleccion;