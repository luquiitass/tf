import Model from './Model';

class Direccion extends Model{


    static url(){
        return 'direccion';
    }

    constructor(){
        super();
        this.calle = '';
        this.altura = '';
        this.piso = '';
        this.dpto = '';
        this.localidad_id = '';
    }

    static model(){
        return 'Comensal'
    }


}

export default Direccion;