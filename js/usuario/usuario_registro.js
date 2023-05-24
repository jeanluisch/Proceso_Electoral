$(document).ready( function() {

//***** Script Registrar Centro Votacion *****/

$('#btn_registrar_usuario').click(function (event){
  
   event.preventDefault();

   //validando el formulario
  var nombre_usuario_reg  = ValidarCampoVacios( '#nombre_usuario_reg', 'El Nombre Es Requerido');

  var usuario_usuario_reg = ValidarCampoVacios( '#usuario_usuario_reg', 'El Usuario Es Requerido');

  var pass_usuario_reg = ValidarCampoVacios( '#pass_usuario_reg', 'Contraseña Requerida.');  

  var tipousu_usuario = ValidarCampoVacios('#tipousu_usuario', 'Tipo de Usuario Requerido');


  if( nombre_usuario_reg &&  usuario_usuario_reg && pass_usuario_reg && tipousu_usuario ){

      var dataForm = $('#registro_usuario_form').serializeArray();
      var dataJson = codificarJson('registrarUsuario', dataForm);
      console.log(dataForm);
     realizarPeticionAjax( '../controlador/usuario.php', 'POST', 'json', dataJson );
  }

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
        
      reiniciarFormulario("#registro_usuario_form");
      accionModal( '.registro_usuario_modal', 1);
      mostrarMsjInformacion( '#info', "Usuario Registrado con Éxito!", 'sucess');
      listarDataTable(); 
	
    break;
    case 'false':
    
      reiniciarFormulario("#registro_usuario_form");
      accionModal( '.registro_usuario_modal', 1);
      mostrarMsjInformacion( '#info', "[ERROR] ¡El Usuario No Ha Podido Ser Registrado!", 'warning');
       
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
    reiniciarFormulario("#registro_usuario_form");
   
  });
}//end ajax
//***** End Script Registrar Cargo *****/

});//funcion principal ->  document
