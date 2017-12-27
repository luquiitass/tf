import Model from './Model';

class TipoComida extends Model{


    static url(){
        return 'tipoComida';
    }

    static model(){
        return 'TipoComida'
    }

}

export default TipoComida;