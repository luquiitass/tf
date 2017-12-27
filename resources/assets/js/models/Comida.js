import Model from './Model';

class Comida extends Model{


    static url(){
        return 'comida';
    }

    static model(){
        return 'Comensal'
    }


}

export default Comida;