$(document).ready( function() {

//***** Script Eliminar Cargo *****/

//*** Cuando se haga click en el boton Eliminar en DataTable  ***/

$(document).on('click', '.btn_eliminar_centrov', function(){

  //obtener el id asociado
  var id= $(this).attr("id_cust");
 
  alertify.confirm('¡Alerta!', '¿Está Seguro de realizar esta acción?', function(){
    //si confirma..

      var data  = { id_centrov: id };
      var dataJson = codificarJson('eliminarCentrov', data);
      realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
    }, 
    function(){
     
      alertify.error('Eliminación Cancelada'); 
    });

});
  
  function realizarPeticionAjax( url, type, dataType, data )
  { 
    $.ajax({
      url : url,
      type : type,
      dataType : 'json',
      data : { "data" : data, "valor":true},
    }) 
   .done(function(data){
    
    switch (data.respuesta) {
      
      case 'true':
        mostrarMsjInformacion( '#info', "El Cargo ha sido Eliminado con Éxito!", 'sucess');
        listarDataTable();
      
      break;

      case 'false':
        mostrarMsjInformacion( '#info', "No se ha podido eliminar el Centro de Votación.", 'danger');
      break;
    }
    })
    //si falla
    .fail(function( jqXHR, textStatus, errorThrown ) {
         if ( console && console.log ) {
            return console.log( "La solicitud a fallado: " +  textStatus);
         }
    });//.fail
    
  }//end ajax

});//funcion principal ->  document
