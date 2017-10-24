class Conexion{

    static get(url){
        return new Promise((resolve, reject) => {
            axios.get(url)
                .then(response => {
                    //this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    //this.onFail(error.response.data);
                    reject(error.response.data);
                });
        });

    }

}

export default Conexion;