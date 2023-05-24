$(document).ready( function() {

//***** Script Registrar Centro Votacion *****/

$('#btn_registrar_elector').click(function (event){
  
   event.preventDefault();

  var cedula_electores_reg    = ValidarCampoVacios( '#cedula_electores_reg', 'El Campo:  "Cédula" al parecer está vacio, por favor verifique');

  var nombre_electores_reg    = ValidarCampoVacios( '#nombre_electores_reg', 'El Nombre Del Elector Es Necesario ');

  var municipio_electores_reg = ValidarCampoVacios( '#municipio_electores_reg', 'El Municipio Es Requerido, Por Favor, Seleccione Uno.');  

  var parroquia_electores_reg = ValidarCampoVacios('#parroquia_electores_reg', 'La Parroquia Es Requerida, Por Favor, Seleccione Una');

  var idCentrov_electores_reg = ValidarCampoVacios('#idCentrov_electores_reg', 'El Centro De Votación Es Requerido, Por Favor, Verifique');

  var cedulaLength = $('#cedula_electores_reg').val();
  cedulaLength = cedulaLength.toString().length;
  
  if (cedulaLength <7 || cedulaLength >8) {
    alertify.alert('[ATENCION]', 'Cedula Incorrecta, Por Favor Verifique');
    cedulaLength = false;
  }

  if( cedula_electores_reg &&  nombre_electores_reg && municipio_electores_reg && parroquia_electores_reg && idCentrov_electores_reg && cedulaLength!=false){

      var dataForm = $('#registro_electores_form').serializeArray();
      var dataJson = codificarJson('registrarElector', dataForm);
      console.log(dataForm);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
  }

});
  //consulta si la cedula ingresada ya existe
  $(document).on('blur', '#cedula_electores_reg', function(){

    var cedulaElector = $(this).val();
    //unicamente consulta la cedula en la BD cuando exista algun valor en el campo cédula
    if ( cedulaElector !="" ){
	    var data = { cedulaElector: cedulaElector };
	    var dataJson = codificarJson('consultarExistenciCI', data);
	    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
	}
  });


//********************************************************
//* ORDENAR AL SERVIDOR LA CONSULTA DE LA CEDULA AL CNE  *
//********************************************************
$('#btn_consult_ci_cne').click(function (event){
  
  //VALIDANDO CAMPO VACIO
  var cedula_electores_reg = ValidarCampoVacios( '#cedula_electores_reg', 'El Campo:  "Cédula" al parecer está vacio, por favor verifique');

  //VALIDAR Q' LA CEDULA SEA CORRECTA!
  var cedulaLength = $('#cedula_electores_reg').val();
  cedulaLength = cedulaLength.toString().length;
  
  if (cedulaLength <7 || cedulaLength >8) {
    alertify.alert('[ATENCION]', 'Cedula Incorrecta, Por Favor Verifique');
    cedulaLength = false;//
  }

  //SI LA VALIDACION ES CORRECTA 
  if(cedula_electores_reg && cedulaLength!=false){

  		$('#mensaje-modal').html('<center><img src="../vista/images/gif-load.gif" />Consultando... por favor, espere. </center>');

      var cedula   = $('#cedula_electores_reg').val();

      var data = { cedulaElector: cedula };
      var dataJson = codificarJson('consultarCiEnCne', data);
      
      console.log(dataJson);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
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
    //cuando el registro sea exitoso
    case 'true':
        
      reiniciarFormulario("#registro_electores_form");

      html = '<option value="" name="" >'+ 'Seleccione un elemento de la lista' +'</option>';
                $('#parroquia_electores_reg').html( html );
      html = '<option value="" name="" >'+ 'Seleccione un elemento de la lista' +'</option>';
                $('#idCentrov_electores_reg').html( html );

      accionModal( '.registro_electores_modal', 1);
      mostrarMsjInformacion( '#info', "Elector Registrado con Éxito!", 'sucess');
      listarDataTable(); 
	
    break;
    case 'false':
    
      reiniciarFormulario("#registro_electores_form");
      accionModal( '.registro_electores_modal', 1);
      mostrarMsjInformacion( '#info', "[ERROR] no se ha podido Registrar el Elector!", 'warning');
       
    break;

    case 'cedulaExiste':
      reiniciarFormulario("#registro_electores_form");
      alertify.alert('[ATENCION]', 'La Cédula Ingresada Se Encuentra Registrada En La Base De Datos. Consulte La Misma En El Módulo "Elector" Para Obtener Más Información ');
       
    break;

    case 'dataCne':
       
    	//sentencias segun sea el estatus de la dataCne
    	switch (data.data.estatus){

    		case 'existeElCentroV':

    			$('#mensaje-modal').html(''); //eliminar el gif "cargando.."
    			console.log("estoy existeElCentroV");


          if (data.data.seleccionadoCne ==""){
              console.log("seleccionadoCne vacio");

              //El Elector no tiene cargo asignado por el Cne, por lo tanto, muestra solamente los datos en el formulario.
              $('#nombre_electores_reg').val(data.data.nombre);

              var html = "";
              html += '<option value="' +"municipio" + '">' +data.data.municipio + '</option>';
              $('#municipio_electores_reg').html( html );

              html = '<option value="' +"parroquia" + '">' +data.data.parroquia + '</option>';
              $('#parroquia_electores_reg').html( html );

              html = '<option value="' + data.data.id_centrov + '" name="idCentrov_electores_reg" >' +data.data.centrov + '</option>';
              $('#idCentrov_electores_reg').html( html );
          }
          else{
            console.log("mostrando htmlCne");
            alertify.confirm('¡Atención!', 'El Elector consultado fue seleccionado para prestar el Servicio Electoral 2018... Haga click en "OK" para ver los detalles de la consulta. Click en "CANCEL" para Salir...', function(){
            //OK
              var htmlCne = data.data.seleccionadoCne;

              $('#ejemplo_cne').html(htmlCne);//muestra el codigo html CNE en el div
              accionModal('.modal_datos_cne', 0);//llamada a la ventana modal donde muestra la vista de _CNE

              //cargando al formulario los datos recibos por la consulta del _CNE
              $('#nombre_electores_reg').val(data.data.nombre);

              var html = "";
                html += '<option value="' +"municipio" + '">' +data.data.municipio + '</option>';
                $('#municipio_electores_reg').html( html );

                html = '<option value="' +"parroquia" + '">' +data.data.parroquia + '</option>';
                $('#parroquia_electores_reg').html( html );

                html = '<option value="' + data.data.id_centrov + '" name="idCentrov_electores_reg" >' +data.data.centrov + '</option>';
                $('#idCentrov_electores_reg').html( html );
            }, 
            //CANCEL
            function(){
           
              console.log("cancelada");
            });
            
          }
        
	    	break;

	    	case 'noExisteCiEnCne':
	    	console.log("noExisteCiEnCne");

	    		$('#mensaje-modal').html('');//eliminando el gift "Cargando..."
	    		alertify.confirm('¡Atención!', 'El número de Cédula ingresado no corresponde a un elector ó la persona ha fallecido... Haga click en "OK" para ver los detalles de la consulta. Click en "CANCEL" para Salir...', function(){
			    //OK
			    	var htmlCne = data.data.html;//código Html de la consulta _CNE 

			      $('#ejemplo_cne').html(htmlCne);
			      accionModal('.modal_datos_cne', 0);
			      reiniciarFormulario("#registro_electores_form");
			    }, 
			    //CANCEL
			    function(){
			     
			      reiniciarFormulario("#registro_electores_form");
			    });
	    	break;

	    	case 'errorConConexionAlCne':

	    	console.log("errorConConexionAlCne");

	    		alertify.alert('[ATENCION]', 'Imposible conectarse al CNE. Por Favor, Verifique su Conexión a Internet...');

	    	break;


	    	case 'noExisteCentroV':

	    	console.log("noExisteCentroV");

	    	//elimina el gif
	    	$('#mensaje-modal').html('');

	    	alertify.confirm('¡Atención!', 'La Cédula consultada en el CNE es correcta, pero, el centro de Votación del Elector no se encuentra en nuestra Base de Datos, Por Favor, Verifique... Haga click en "OK" para ver los detalles de la consulta. Click en "CANCEL" para Salir...', function(){
			    //OK
			    	var htmlCne = data.data.html;

			      $('#ejemplo_cne').html(htmlCne);
			      accionModal('.modal_datos_cne', 0);
			      reiniciarFormulario("#registro_electores_form");
			    }, 
			    //CANCEL
			    function(){
			     
			      reiniciarFormulario("#registro_electores_form");
			    });

	    	break
    	}//end->switch ->data.data.estatus

    break;//data CNE


    }//end->switch ->data.respuesta
  })

  //si falla
  .fail(function( jqXHR, textStatus, errorThrown ) {
       if ( console && console.log ) {
          return console.log( "La solicitud a fallado: " +  textStatus);
       }
  });//.fail

  $('#btn_cerrar').click(function (event){
    
    //reinicia los formularios de los modal
    $('#registro_electores_form')[0].reset();
    
   
  });

}//end ajax
//***** End Script Registrar Cargo *****/

});//funcion principal ->  document
