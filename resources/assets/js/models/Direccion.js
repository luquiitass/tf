import Model from './Model';

class Direccion extends Model{


    static url(){
        return 'direccion';
    }

    static new(){
        var direccion = new Direccion();
        direccion['calle'] = '';
        direccion['altura'] = '';
        direccion['piso'] = '';
        direccion['dpto'] = '';
        direccion['localidad_id'] = '';
        return direccion;
    }


}

export default Direccion;