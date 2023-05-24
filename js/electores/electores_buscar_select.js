$(document).ready( function() {

//***** Script Buscar Data Municipio *****/

//*** Cuando se haga haga un cambio en el select municipio  ***/

 $(document).on('change', '#municipio_electores_reg', function(){
  
    var id_municipio = $('#municipio_electores_reg').val();

    if (id_municipio!="") {
     
      var data = { id_municipio: id_municipio };
      var dataJson = codificarJson('buscarParroquiaById', data);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
      
        $('#municipio_electores_reg').attr('disabled', false);
          
      } else {
         $('#parroquia_electores_reg').attr('disabled', true);
      }
  });
//*** Cuando se haga haga un cambio en el select municipio  ***/


//*** Cuando se haga haga un cambio en el select parroquia  ***/
 $(document).on('change', '#parroquia_electores_reg', function(){
  
    var id_parroquia = $('#parroquia_electores_reg').val();

    if (id_parroquia!="") {
     
      var data = { id_parroquia: id_parroquia };
      var dataJson = codificarJson('buscarCentroVById', data);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
      
        $('#idCentrov_electores_reg').attr('disabled', false);
          
      } else {
         $('#municipio_electores_reg').attr('disabled', true);
      }
  });
//*** Cuando se haga haga un cambio en el select parroquia  ***/


//cuando haga click en el boton new
  $('#nuevo_electores').click(function (event){
    console.log("evento click en modal");
    event.preventDefault();
    var data = { id_municipio: "consultarDataMunicipio" };
    var dataJson = codificarJson('buscarDataMunicipio', data);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
  });

//cuando haga click en el radio "NO"
    $('#resp-no_esp').click(function (event){
    console.log("click en esperanzador no");

    //reiniciar select y ocultar..
    html = '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
    $('#idCargo_electores_reg').html( html );   

    $('#idCargo_electores_reg').attr('readonly', true);
    
  });

    
  //Cuando se haga click en el radio NO de la modal Editar
  $('#resp-no_esp_edit').click(function (event){
    console.log("click en esperanzador no edit");

    html = '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
    $('#idCargo_electores_edit').html( html );   

    $('#idCargo_electores_edit').attr('readonly', true);
    
  });


//cuando haga click en el radio "SI"
    $('#resp-si_esp').click(function (event){
    console.log("click en esperanzador si");

    var data = { id_cargo: "buscarDataCargo" };
    var dataJson = codificarJson('buscarDataCargo', data);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );

  });

//PETICION AJAX
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
      
      case 'dataMunicipio':
      
        dataTemp= data.data;
        idSelect='#municipio_electores_reg'
        var html = "";
        html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
        for (var i in dataTemp){
            html += '<option value="' +dataTemp[i].id_municipio + '">' +dataTemp[i].municipio + '</option>'; 			    
        }
          $(idSelect).html( html );

      break;

      case 'dataParroquia':
          dataTemp= data.data;
          idSelect='#parroquia_electores_reg'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_parroquia + '">' +dataTemp[i].parroquia + '</option>'; 			    
          }
            $(idSelect).html( html );        

      break;

        case 'dataCentroV':
          dataTemp= data.data;
          idSelect='#idCentrov_electores_reg'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_centrov + '">' +dataTemp[i].centrov + '</option>';   
          }
            $(idSelect).html( html );        

        break;

      case 'dataCargo':
        
        dataTemp= data.data;
        idSelect='#idCargo_electores_reg'
        var html = "";
        html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
        for (var i in dataTemp){
            html += '<option value="' +dataTemp[i].id_cargo + '">' +dataTemp[i].nombre + '</option>';          
        }
        $(idSelect).html( html );

        $('#idCargo_electores_reg').attr('readonly', false);

      break;
        
      }//end-> switch
    })
    //si falla
    .fail(function( jqXHR, textStatus, errorThrown ) {
         if ( console && console.log ) {
            return console.log( "La solicitud a fallado: " +  textStatus);
         }
    });//.fail
    
  }//end ajax

});//funcion principal ->  document
