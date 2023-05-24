$(document).ready( function() {

//***** Script Editar Electores BD *****/

  cedulaElector = "";
//*** Cuando se haga click en el boton actualizar Elector  ***/
$('#btn_editar_elector').click(function (event){
  
    event.preventDefault();

  var cedula_electores_edit    = ValidarCampoVacios( '#cedula_electores_edit', 'El Campo:  "Cédula" al parecer está vacio, por favor verifique');

  var nombre_electores_edit    = ValidarCampoVacios( '#nombre_electores_edit', 'El Nombre Del Elector Es Necesario ');

  var municipio_electores_edit = ValidarCampoVacios( '#municipio_electores_edit', 'El Municipio Es Requerido, Por Favor, Seleccione Uno.');  

  var parroquia_electores_edit = ValidarCampoVacios('#parroquia_electores_edit', 'La Parroquia Es Requerida, Por Favor, Seleccione Una');

  var idCentrov_electores_edit = ValidarCampoVacios('#idCentrov_electores_edit', 'El Centro De Votación Es Requerido, Por Favor, Verifique');

  var cedulaLength = $('#cedula_electores_edit').val();
  cedulaLength = cedulaLength.toString().length;
  
  if (cedulaLength <7 || cedulaLength >8) {
    alertify.alert('[ATENCION]', 'Cedula Incorrecta, Por Favor Verifique');
    cedulaLength = false;
  }

  if( cedula_electores_edit &&  nombre_electores_edit && municipio_electores_edit && parroquia_electores_edit && idCentrov_electores_edit && cedulaLength!=false){

     //Obtener toda la data del formulario
    var dataForm = $('#editar_electores_form').serializeArray();
    //codificar data a Json
    var dataJson = codificarJson('actualizarElector', dataForm);
    //Realiza la peticion por Ajax
    cedulaElector = dataForm[1].value;
    console.log(dataForm);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
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
        reiniciarFormulario("#editar_electores_form");

        //cierra la ventana modal
        accionModal( '.editar_electores_modal', 1 );
        mostrarMsjInformacion( '#info', "Elector Actualizado Con Éxito", 'sucess' );
        listarDataTable(); 

      break;

      case 'false':
        reiniciarFormulario("#editar_electores_modal");
        accionModal( '.editar_electores_modal', 1 );
        mostrarMsjInformacion( '#info', "[ERROR] El Elector no ha podido ser actualizado.", 'warning' );
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
