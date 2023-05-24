$(document).ready( function() {

//***** Script Registrar Centro Votacion *****/

$('#btn_registrar_centrov').click(function (event){
  
  event.preventDefault();

  //validando el formulario

  var nombre_centrov    = ValidarCampoVacios( '#nombre_centrov', 'El Campo:  "Nombre del C.V" al parecer está vacio, por favor verifique');

  var municipio_centrov = ValidarCampoVacios( '#municipio_centrov', 'Seleccione un Munucipio de la lista');

  var parroquia_centrov = ValidarCampoVacios( '#parroquia_centrov', 'La Parroquia Es Requerida, Por Favor, Seleccione Una.');  

  var mesas_centrov = ValidarCampoVacios('#mesas_centrov', 'La Cantidad de Mesas Es Requerida, Por Favor, verifique');


  if( nombre_centrov &&  municipio_centrov && parroquia_centrov && mesas_centrov){

      var dataForm = $('#registro_centrov_form').serializeArray();
      var dataJson = codificarJson('registrarCentrov', dataForm);
      realizarPeticionAjax( 'controlador/centro_votacion.php', 'POST', 'json', dataJson );
  }

});       

function realizarPeticionAjax( url, type, dataType, data )
{
  $.ajax({
    url : "../controlador/centro_votacion.php",
    type : type,
    dataType : 'json',
    data : { "data" : data, "valor":true},
  })

  .done(function(data){

    switch (data.respuesta) {

    case 'true':
        
      reiniciarFormulario("#registro_centrov_form");
      accionModal( '.registro_centrov_modal', 1);
      mostrarMsjInformacion( '#info', "Centro de Votación Registrado con Éxito!", 'sucess');
      listarDataTable(); 
	
    break;
    case 'false':
    
      reiniciarFormulario("#registro_centrov_form");
      accionModal( '.registro_centrov_modal', 1);
      mostrarMsjInformacion( '#info', "[ERROR] no se ha podido Registrar el Centro de Votación!", 'warning');
       
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
