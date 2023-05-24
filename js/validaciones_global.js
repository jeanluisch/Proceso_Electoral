
  function validarSoloLetrasYNum(event){

    //* key obtiene el valor ingresado
    var caracter = event.key

    var expresion = /^[a-zA-Z0-9ñ\s]+$/;
    if( !expresion.test(caracter)){

       return false;
    }

}

  function validarSoloNumeros(event){

    //* key obtiene el valor ingresado
    var caracter = event.key

    var expresion = /^[0-9]+$/;
    if( !expresion.test(caracter)){

       return false;
    }

}

function validarSoloLetras(event){

    //* key obtiene el valor ingresado
    var caracter = event.key

    var expresion = /^[a-zA-Z\s]+$/;
    if( !expresion.test(caracter)){

       return false;
    }
}

function validarEmail(event){

    //* key obtiene el valor ingresado
    var caracter = event.key

    var expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
    if( !expresion.test(caracter)){

       return false;
    }
}

function ValidarCampoVacios( id_campo, mensaje ){

    var respuesta = false;

    var valorCampo = $(id_campo ).val();
    if ( valorCampo == "" ){
      $(id_campo ).focus();
      alertify.alert('[ATENCION]', ''+mensaje);

      respuesta = false;

    }else{
      respuesta = true
    }

    return respuesta;
}