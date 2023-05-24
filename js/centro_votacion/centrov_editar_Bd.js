$(document).ready( function() {

//***** Script Editar Centro Votacion BD *****/

//*** Cuando se haga click en el boton actualizar cargo  ***/
$('#btn_editar_centrov').click(function (event){

   event.preventDefault();

  var nombre_centrov    = ValidarCampoVacios( '#nombre_centrov_modificar', 'El Campo:  "Nombre del C.V" al parecer está vacio, por favor verifique');

  var municipio_centrov = ValidarCampoVacios( '#municipio_centrov_modificar', 'Seleccione un Munucipio de la lista');

  var parroquia_centrov = ValidarCampoVacios( '#parroquia_centrov_modificar', 'La Parroquia Es Requerida, Por Favor, Seleccione Una.');  

  var mesas_centrov = ValidarCampoVacios('#mesas_centrov_modificar', 'La Cantidad de Mesas Es Requerida, Por Favor, verifique');


  if( nombre_centrov &&  municipio_centrov && parroquia_centrov && mesas_centrov){

    //Obtener toda la data del formulario
    var dataForm = $('#editar_centrov_form').serializeArray();
    //codificar data a Json
    var dataJson = codificarJson('actualizarCentroV', dataForm);
    //Realiza la peticion por Ajax
    console.log(dataForm);
    realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
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
        reiniciarFormulario("#editar_centrov_form");

        //cierra la ventana modal
        accionModal( '.editar_centrov_modal', 1 );
        mostrarMsjInformacion( '#info', "Centro de Votación Actualizado Con Éxito", 'sucess' );
        listarDataTable(); 

      break;

      case 'false':
        reiniciarFormulario("#editar_centrov_form");
        accionModal( '.editar_centrov_modal', 1 );
        mostrarMsjInformacion( '#info', "[ERROR] El Centro de Votación no ha podido ser actualizado.", 'warning' );
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
