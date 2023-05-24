

function codificarJson(accion, arrayForm){
    
    var obj = { "accion": accion, "data":arrayForm };
    var jsonCodificado = JSON.stringify( obj );       
    return jsonCodificado 
}//end ObtenerJson



//FUNCION reiniciar formulario
function reiniciarFormulario(id){
  $(id)[0].reset();
}

//FUNCION Mostrar o Ocutar ventana modal
function accionModal( id, opcion ){
//1 = Mostrar   0 = Ocutar
  if(opcion==1){
    $(id).modal('hide');
  }else{
    $(id).modal('show');
  }
}

//FUNCION Mensajes de informacion
function mostrarMsjInformacion( id, msj, tipo ){
  
  if(tipo=='sucess'){
    $(id).html('<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <strong>'+msj+'</strong> </div>');
          $("#info").fadeTo(5000, 500).slideUp(500, function(){
    $("#info").slideUp(500);
});
    }else{
      $(id).html('<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <strong>'+msj+'</strong> </div>');
    }
}


