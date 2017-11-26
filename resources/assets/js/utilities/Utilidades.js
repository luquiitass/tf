class Utilidades{


    static getHeightById(el){
        var x = document.getElementById(el);
        if (x){
            return x.offsetHeight;
        }
        console.log('No existe elemento con id: ' + el);
        return 0;
    }

    static changeObjectListById(list,id,newObject){
        var result = "no existe el id";
        for (var i in list) {
            if(!list[i].id){
                console.error('No existe id en los objetos de la coleccion');
                return;
            }

            if (list[i].id == id) {
                list[i] = newObject;
                result="modificado"
                break
            }
        }
        var x = list.pop();
        list.push(x);
        console.log('changed =>' +result);
    }

    static changeObjectListBykeyAndValue(list,key,value,newObject){
        var result = "no existe el id";
        try {
            list.every(function (item, index) {
                console.log(item);
                if (!item[key]) {
                    throw 'No existe id  '+ key +'  en los objetos de la coleccion';
                }
                if (item[key] == value) {
                    list[index] = newObject;
                    throw "modificado";
                }

            });
            throw 'No se encontro un objeto con el valor ' +value;
        }catch(excep){
            console.log(excep);
        }
        var x = list.pop();
        list.push(x);
    }

    static deleteObjectList(list,id){
        for (var i in list) {
            if(!list[i].id){
                console.error('No existe id en los objetos de la coleccion');
                return;
            }

            if (list[i].id == id) {
                list.splice(i,1);
                return true;
                //Stop this loop, we found it!
            }
        }
        return false;
    }

    elLoading(id) {
    var div ='<div id="loading" style="background-color: #f9f9f9;padding: 10px;display: block;align-items: center">' +
        '<p class="text-center" >' +
        '<img style="padding: 20px;" src="'+PATH+'img/loading.gif" alt="">'+
    '</p>' +
    '<p class="text-center">cargando</p>'+
    '</div>';
    return div;
}

    elRecargar(mensaje) {
    var div = $('<div id="msj_recarga_" class="alert alert-warning"><div>');
    var p = $('<h3 class="text-center">Error al cargar los datos.</h3>');
    var p2 = $('<p class="text-center">Mensaje:</p>');
    var p3 = $('<p class="text-center">'+mensaje+'</p>');
    var boton = $('<button class="btn btn-success center-block recargar" >reintentar</button>');
    div.append(p);
    div.append(p2);
    div.append(p3);
    div.append(boton);
    return div;
}

    elMensajeError(mensaje) {
    var div = $('<div class="alert alert-danger" ><div>');
    var p1 = $('<p class="text-center">Erroral cargar:</p>');
    var p = $('<p class="text-center">'+mensaje+'</p>');
    div.append(p1);
    div.append(p);
    return div;
}


    el(id) {
    return $('#' + id);
}

    isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

    GET(dataLink,idContenedor,callback) {
    var self = this;
    var idOtro = "otro_"+idContenedor;
    $('#'+idContenedor).append('<div id="'+idOtro+'"></div>');
    idOtro = '#' + idOtro;
    $.ajax({
        async: true,
        type: 'get',
        url: dataLink,
        beforeSend:function () {
            $(idOtro).html(elLoading(idContenedor));
            //$('#' + idContenedor).before("cargando");
        },
        success: function (data) {
            switch (data.estado){
                case 'success':
                    $(idOtro).html("");
                    callback(data);
                    break;
                case 'error':
                    //$('#' + idContenedor).find('#loading').remove();
                    $(idOtro).html("");
                    if (data.mensaje){
                        var mensaje =(data.mensaje);
                        //$('#' + idContenedor).append(elMensajeError(mensaje));
                        $(idOtro).html(elRecargar(idContenedor));
                        $(idOtro).find('.recargar').on('click',function () {
                            GET(dataLink,idContenedor,callback);
                        });
                    }
                    break;
            }
        }
    });
    }

    static getJson(url, idContenedor , callback){
        var self = new Utilidades();

        var idOtro = "otro_"+idContenedor;
        var otroContenedor = $('<div id="'+idOtro+'"></div>');
        var contenedor = $('#' + idContenedor);

        otroContenedor.insertBefore(contenedor); //insetamos un div con un id al elemento contenedor

        otroContenedor.html(self.elLoading(idContenedor));

        contenedor.hide();

        axios.get(url).then(data=>{
            callback(data);
            contenedor.show();
            otroContenedor.replaceWith('');
        }).catch(data => {
           console.error(data);
            otroContenedor.html(self.elRecargar(data.message))
            otroContenedor.find('.recargar').on('click',function () {
                otroContenedor.replaceWith('');
                Utilidades.getJson(url,idContenedor,callback);
            });
        });

        // $.ajax({
        //     async: true,
        //     type: 'get',
        //     url: dataLink,
        //     beforeSend:function () {
        //         $(idOtro).html(elLoading(idContenedor));
        //         //$('#' + idContenedor).before("cargando");
        //     },
        //     success: function (data) {
        //         switch (data.estado){
        //             case 'success':
        //                 $(idOtro).html("");
        //                 callback(data);
        //                 break;
        //             case 'error':
        //                 //$('#' + idContenedor).find('#loading').remove();
        //                 $(idOtro).html("");
        //                 if (data.mensaje){
        //                     var mensaje =(data.mensaje);
        //                     //$('#' + idContenedor).append(elMensajeError(mensaje));
        //                     $(idOtro).html(elRecargar(idContenedor));
        //                     $(idOtro).find('.recargar').on('click',function () {
        //                         GET(dataLink,idContenedor,callback);
        //                     });
        //                 }
        //                 break;
        //         }
        //     }
        // });
    }


    static random4(){

        return _.random(0, 9999);
    }


}

export default Utilidades;