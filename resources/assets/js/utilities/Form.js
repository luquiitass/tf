
import Errors from './Errors';

class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    isEmpty() {
        var obj = this;
        for(var prop in obj) {
            if(obj.hasOwnProperty(prop))
                console.log('formulario vacio')
                return false;
        }
        console.log('formulario con datos')

        return JSON.stringify(obj) === JSON.stringify({});
    }

    getClassForm(valor){
        var retorno = 'form-group';
        if (this.errors.any()) {
            retorno = this.errors.has(valor) ? 'form-group has-error' : 'form-group has-success';
        }
        return retorno;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            if (Array.isArray(this[field])){
                this[field] = [];
            }else {
                this[field] = '';
            }
        }

        this.errors.clear();
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    this.verificarMensajes(response ,resolve);

                    resolve(response.data);
                })
                .catch(error => {
                    if (error.request.status  == 401){
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = error.response.data.token;
                        this.submit(requestType,url);
                    }
                    if (error.request.status == 402 || error.request.status  == 422){
                        this.verificarMensajes(error.response.data, resolve);
                        this.onFail(error.response.data);
                    }

                    reject(error.response.data);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
       // alert(data.message); // temporary

        this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }

    verificarMensajes(response, resolve) {

        var data = response.data;
        if(data.hasOwnProperty('data-mensaje')){

            var retorno = data['data-mensaje'];

            Notificacion.mostrarMensaje(retorno.mensaje)

            resolve(retorno.data);
        }
        if(data.hasOwnProperty('simple-mensaje')){

            var retorno = data['simple-mensaje'];

            Notificacion.mostrarMensaje(retorno.mensaje)

            resolve(retorno.data);
        }
    }
}

export default Form;