$(document).ready( function() {

//***** Script Buscar Data Municipio *****/

//*** Cuando se haga haga un cambio en el select municipio  ***/

 $(document).on('change', '#municipio_centrov', function(){
  
    var id_municipio = $('#municipio_centrov').val();

    if (id_municipio!="") {
     
      var data = { id_municipio: id_municipio };
      var dataJson = codificarJson('buscarParroquiaById', data);
      realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
      
          $('#municipio_centrov').attr('disabled', false);
          $('#parroquia_centrov').attr('disabled', false);
          
      } else {
        
         $('#parroquia_centrov').attr('disabled', true);
      }
  });
//*** Cuando se haga haga un cambio en el select municipio  ***/


//cuando haga click en el boton de ventana modal...
  $('#nuevo_centrov').click(function (event){
    
    event.preventDefault();
    
    var data = { id_municipio: "consultarDataMunicipio" };
    var dataJson = codificarJson('buscarDataMunicipio', data);
    realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
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
        idSelect='#municipio_centrov'
        var html = "";
        html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
        for (var i in dataTemp){
            html += '<option value="' +dataTemp[i].id_municipio + '">' +dataTemp[i].municipio + '</option>'; 			    
        }
          $(idSelect).html( html );

        break;

        case 'dataParroquia':
          dataTemp= data.data;
          idSelect='#parroquia_centrov'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_parroquia + '">' +dataTemp[i].parroquia + '</option>'; 			    
          }
            $(idSelect).html( html );        

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
