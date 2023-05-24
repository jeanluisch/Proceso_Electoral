$(document).ready( function() {


//*** Cuando se haga click en el boton actualizar Usuario  ***/
$('#btn_actualizar_usuario').click(function (event){

      event.preventDefault();

   //validando el formulario
   //** ValidarCampoVacios (id_campo, mensaje)

  var nombre_usuario_edit   = ValidarCampoVacios( '#nombre_usuario_edit', 'El Nombre Es Requerido');

  var usuario_usuario_edit   = ValidarCampoVacios( '#usuario_usuario_edit', 'El Usuario Es Requerido');

  var pass_usuario_edit = ValidarCampoVacios( '#pass_usuario_edit', 'Contraseña Requerida.');  

  var tipousu_usuario_edit = ValidarCampoVacios('#tipousu_usuario_edit', 'Tipo de Usuario Requerido');


  if( nombre_usuario_edit &&  usuario_usuario_edit && pass_usuario_edit && tipousu_usuario_edit){

    //Obtener toda la data del formulario
    var dataForm = $('#editar_usuario_form').serializeArray();
    //codificar data a Json
    var dataJson = codificarJson('actualizarUsuario', dataForm);
    //Realiza la peticion por Ajax
    
    realizarPeticionAjax( '../controlador/usuario.php', 'POST', 'json', dataJson );
  }

});       
  
  function realizarPeticionAjax( url, type, dataType, data )
  { 
    $.ajax({
      url      : url,
      type     : type,
      dataType : 'json',
      data     : { "data" : data, "valor":true},
    }) 
   .done(function(data){
   

    switch (data.respuesta) {
  
      case 'true':
        //reinicia el formulario
        reiniciarFormulario("#editar_usuario_form");

        //cierra la ventana modal
        accionModal( '.editar_usuario_modal', 1 );
        mostrarMsjInformacion( '#info', "Usuario Actualizado Con Éxito", 'sucess' );
        listarDataTable(); 

      break;

      case 'false':
        reiniciarFormulario("#editar_centrov_form");
        accionModal( '.editar_usuario_modal', 1 );
        mostrarMsjInformacion( '#info', "[ERROR] El Usuario no ha podido ser Actualizado.", 'warning' );
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
