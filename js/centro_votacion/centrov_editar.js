$(document).ready( function() {

//***** Script Buscar Data Municipio *****/

  //click sobre el boton en el DataTable
  $(document).on('click', '.btn_editar_centrov', function(){
    
    //cargar la data segun el id para el formulario
    var id = $(this).attr("id_cust");
    var data = { id_centrov: id };
    var dataJson = codificarJson('buscarDataCentroVById', data);
    realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
  //*******************/

});

//Cuando se haga click en el boton para cargar los municipios
$(document).on('click', '#actualizaSelectMun', function(){

  //cargar la data de los municipios
    event.preventDefault();
    var data = { id_municipio: "consultarDataMunicipio" };
    var dataJson = codificarJson('buscarDataMunicipio', data);
    realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
     //bloquear selects
     $('#municipio_centrov_modificar').attr('readonly', false);
     $('#parroquia_centrov_modificar').attr('readonly', false);

  //*******************/

});

//*** Cuando se haga haga un cambio en el select municipio  ***/

 $(document).on('change', '#municipio_centrov_modificar', function(){
    console.log("cambio");
    var id_municipio = $('#municipio_centrov_modificar').val();

    if (id_municipio!="") {
     
      var data = { id_municipio: id_municipio };
      var dataJson = codificarJson('buscarParroquiaById', data);
      realizarPeticionAjax( '../controlador/centro_votacion.php', 'POST', 'json', dataJson );
      
          $('#municipio_centrov_modificar').attr('disabled', false);
      } else {
        
         $('#municipio_centrov_modificar').attr('disabled', true);
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
      console.log("dataMunicipio ");
        dataTemp= data.data;
        idSelect='#municipio_centrov_modificar';
        var html = "";
         	
        for (var i in dataTemp){
            html += '<option value="' +dataTemp[i].id_municipio + '">' +dataTemp[i].municipio + '</option>'; 			    
        }
          $(idSelect).html( html );

        break;

        case 'dataParroquia':
          dataTemp= data.data;
          idSelect='#parroquia_centrov_modificar'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_parroquia + '">' +dataTemp[i].parroquia + '</option>'; 			    
          }
            $(idSelect).html( html );        

        break;

        case 'dataCentroVotacion':
       
          //bloquear selects
          $('#municipio_centrov_modificar').attr('readonly', true);
          $('#parroquia_centrov_modificar').attr('readonly', true);
          
          //mostrar ventana modal
          accionModal('.editar_centrov_modal', 0);

          //PASANDO VALORES AL FORMULARIO
          $('#id_centrov').val(data.data[0].id_centrov);
          $('#nombre_centrov_modificar').val(data.data[0].centrov);
          $('#mesas_centrov_modificar').val(data.data[0].cantidad_mesas);
          $('#direccion_centrov_mod').val(data.data[0].direccion_centrov);
            console.log(data);
          var html = "";
          html = '<option value="' +data.data[0].id_municipio + '">' + data.data[0].municipio + '</option>';
          $('#municipio_centrov_modificar').html( html );

          html = '<option value="' +data.data[0].id_parroquia + '">' + data.data[0].parroquia + '</option>'; 	
          $('#parroquia_centrov_modificar').html( html ); 
          
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
