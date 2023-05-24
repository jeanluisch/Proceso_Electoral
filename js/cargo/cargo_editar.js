$(document).ready( function() {
//***** Script Editar Cargo *****/

//*** Cuando se haga click en el boton actualizar cargo  ***/
$('#btn_actualizar_cargo').click(function (event){
  
    event.preventDefault();
    //Obtener toda la data del formulario
    var dataForm = $('#form_editar_registro').serializeArray();
    //codificar data a Json
    var dataJson = codificarJson('actualizarCargo', dataForm);
    //Realiza la peticion por Ajax
    console.log(dataForm);
    realizarPeticionAjax( '../controlador/cargo.php', 'POST', 'json', dataJson );
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
        //reinicia el formulario
        reiniciarFormulario("#form_editar_registro");

        //cierra la ventana modal
        accionModal( '.modal_editar_cargo', 1 );
        mostrarMsjInformacion( '#info', "Cargo Actualizado Con Éxito", 'sucess' );
        listarDataTable(); 

      break;

      case 'false':
        reiniciarFormulario("#form_editar_registro");
        accionModal( '.modal_editar_cargo', 1 );
        mostrarMsjInformacion( '#info', "No se ha podido actualizar el cargo.", 'warning' );
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
