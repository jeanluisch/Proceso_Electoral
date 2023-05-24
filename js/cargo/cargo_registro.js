$(document).ready( function() {

//***** Script Registrar Cargo *****/

varGlobal = 0;
$('#btn_registrar_cargo').click(function (event){
  
  event.preventDefault();
  var dataForm = $('#form_cargo_registro').serializeArray();
  var dataJson = codificarJson('registrarCargo', dataForm);
  realizarPeticionAjax( 'controlador/cargo.php', 'POST', 'json', dataJson );
});       

function realizarPeticionAjax( url, type, dataType, data )
{
  $.ajax({
    url : "../controlador/cargo.php",
    type : type,
    dataType : 'json',
    data : { "data" : data, "valor":true},
  })

  .done(function(data){
    varGlobal = data;
    switch (data.respuesta) {

    case 'true':
        
        reiniciarFormulario("#form_cargo_registro");
        accionModal( '.modal_registro_cargo', 1);
        mostrarMsjInformacion( '#info', "El Cargo ha sido registrado con Éxito!", 'sucess');
        listarDataTable(); 
	
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
//***** End Script Registrar Cargo *****/

});//funcion principal ->  document
