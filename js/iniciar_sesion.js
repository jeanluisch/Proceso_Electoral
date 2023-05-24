$(document).ready( function() {

//***** Script Iniciar Sesion  *****/

$(document).on('click', '.btn-sesion', function(){
  
  event.preventDefault();
  var dataForm = $('#form-sesion').serializeArray();
  var dataJson = codificarJson('ConsultarUsuarioActivo', dataForm);
  console.log(dataJson);
  realizarPeticionAjax( 'controlador/iniciar_sesion.php', 'POST', 'json', dataJson );
});       

function realizarPeticionAjax( url, type, dataType, data )
{
  $.ajax({
    url : "controlador/iniciar_sesion.php",
    type : type,
    dataType : 'json',
    data : { "data" : data, "valor":true},
  })

  .done(function(data){

    switch (data.respuesta) {

    case 'true':
        console.log(data);
     window.location.href = "vista/";

	
    break;
    case 'false':
    /*
    var msg = alertify.error('notifier');//delay(7) son los segundos que dura el mensaje en pantalla.
          msg.delay(5).setContent('Usuario o Contraseña Incorrectos!'); 
      */
      mostrarMsjInformacion( '#info', "Usuario o Contraseña Incorrectos!", 'warning');
       
    break;
    }
  })

  //si falla
  .fail(function( jqXHR, textStatus, errorThrown ) {
       if ( console && console.log ) {
          return console.log( "La solicitud a fallado: " +  textStatus);
       }
  });//.fail
  $('#btn_cerrar').click(function (event){
    
    //reinicia los formularios de los modal
    reiniciarFormulario("#registro_centrov_form");
   
  });
}//end ajax
//***** End Script Registrar Cargo *****/

});//funcion principal ->  document
