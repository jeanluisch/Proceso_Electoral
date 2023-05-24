$(document).ready( function() {

//***** Script Buscar Data Municipio *****/

  //click sobre el boton Editar en el DataTable
  $(document).on('click', '.btn_editar_elector', function(){
   
    //cargar la data segun el id para el formulario
    var id = $(this).attr("id_cust");
    var data = { id_1x12: id };
    var dataJson = codificarJson('buscarDataElectorById', data);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
   
  //*******************/

});

//Cuando se haga click en el boton #btn-recargar-select, recarga el select 
$(document).on('click', '#btn-recargar-select', function(){

  //cargar la data de los municipios
    var data = { id_municipio: "consultarDataMunicipio" };
    var dataJson = codificarJson('buscarDataMunicipio', data);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
     //bloquear selects

     $('#municipio_electores_edit').attr('readonly', false);
     $('#parroquia_electores_edit').attr('readonly', false);
     $('#idCentrov_electores_edit').attr('readonly', false);

  //*******************/

});

//Cuando se haga click en el boton #btn-recargar-select-cargo, recarga el select 
$(document).on('click', '#btn-recargar-select-cargo', function(){

  //cargar la data de lo los cargos
    var data = { cargo: "consultarDataCargo" };
    var dataJson = codificarJson('buscarDataCargo', data);
    realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );

  //*******************/

});
 

//*** Cuando se haga haga un cambio en el select municipio  ***/

 $(document).on('change', '#municipio_electores_edit', function(){
    console.log("cambio");
    var id_municipio = $('#municipio_electores_edit').val();

    if (id_municipio!="") {
     
      var data = { id_municipio: id_municipio };
      var dataJson = codificarJson('buscarParroquiaById', data);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
          
          //deshabilita el select de parroquia
          $('#parroquia_electores_edit').attr('readonly', false);
      } else {
        
         $('#parroquia_electores_edit').attr('readonly', true);
      }
  });
  //*******************/


//*** Cuando se haga haga un cambio en el select parroquia  ***/

 $(document).on('change', '#parroquia_electores_edit', function(){
    console.log("cambio parroquia");
    var id_parroquia = $('#parroquia_electores_edit').val();

    if (id_parroquia!="") {
     
      var data = { id_parroquia: id_parroquia };
      var dataJson = codificarJson('buscarCentroVById', data);
      realizarPeticionAjax( '../controlador/electores.php', 'POST', 'json', dataJson );
          
          //deshabilita el select de parroquia
          $('#idCentrov_electores_edit').attr('readonly', false);
      } else {
        
         $('#idCentrov_electores_edit').attr('readonly', true);
      }
  });
  //*******************/


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
        idSelect='#municipio_electores_edit';
        var html = "";
         	
        for (var i in dataTemp){
            html += '<option value="' +dataTemp[i].id_municipio + '">' +dataTemp[i].municipio + '</option>'; 			    
        }
          $(idSelect).html( html );

      break;

        case 'dataParroquia':
          dataTemp= data.data;
          idSelect='#parroquia_electores_edit'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>'; 	
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_parroquia + '">' +dataTemp[i].parroquia + '</option>'; 			    
          }
            $(idSelect).html( html );        

        break;

        case 'dataCargo':
          dataTemp= data.data;
          idSelect='#idCargo_electores_edit';
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_cargo + '">' +dataTemp[i].nombre + '</option>';          
          }
            $(idSelect).html( html );

          //desbloque el select
         $('#idCargo_electores_edit').attr('readonly', false);     

        break;

        case 'dataCentroV':
          console.log("dataCentroV")
          dataTemp= data.data;
          idSelect='#idCentrov_electores_edit'
          var html = "";
          html += '<option value="">' +'Seleccione un elemento de la lista'+ '</option>';   
          for (var i in dataTemp){
              html += '<option value="' +dataTemp[i].id_centrov + '">' +dataTemp[i].centrov + '</option>';          
          }
            $(idSelect).html( html );        

        break;

        case 'dataElector':
          console.log("dataElector");
          //bloquear selects
          $('#parroquia_electores_edit').attr('readonly', true);
          $('#municipio_electores_edit').attr('readonly', true);
          $('#idCentrov_electores_edit').attr('readonly', true);

          //PASANDO VALORES AL FORMULARIO
          $('#id_1x12').val(data.data[0].id_1x12);
          $('#cedula_electores_edit').val(data.data[0].cedula);
          $('#nombre_electores_edit').val(data.data[0].elector);
          $('#tlf_electores_edit').val(data.data[0].telefono);
          $('#correo_electores_edit').val(data.data[0].correo);
          $('#discapacidad_electores_edit').val(data.data[0].discapacidad);
          
          var html = "";
          html = '<option value="' +data.data[0].id_municipio + '">' + data.data[0].municipio + '</option>';
          $('#municipio_electores_edit').html( html );

          html = '<option value="' +data.data[0].id_parroquia + '">' + data.data[0].parroquia + '</option>'; 	
          $('#parroquia_electores_edit').html( html ); 

          html = '<option value="' +data.data[0].id_centrov + '">' + data.data[0].centrov + '</option>';  
          $('#idCentrov_electores_edit').html( html ); 

          html='';
          //Condicionando para el 'Radio' en la vista.
          //##permite marcar el Radio segun la condicion a SI o NO
          responsable = data.data[0].responsable;
          if( data.data[0].responsable =="SI" ){
            console.log("responsable: "+responsable);

            html+= ' <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="NO" >'+
                    '<label class="form-check-label" for="inlineRadio1" >NO</label>    ';

            html+= ' <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="SI" checked="true">'+
                    '<label class="form-check-label" for="inlineRadio1" >SI</label> ';
            $('#radio-check').html( html );         
          }
          else{
             console.log("responsable: "+responsable);
            html='';
            html+= ' <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="NO" checked="true">'+
                    '<label class="form-check-label" for="inlineRadio1" >NO</label>    ';

            html+= ' <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="SI" >'+
                    '<label class="form-check-label" for="inlineRadio1" >SI</label> ';
            $('#radio-check').html( html );   
          }

            //Cargo...
            console.log(data.data[0].esperanzador);
           if( data.data[0].esperanzador =="SI" ){//tiene cargo asociado, por lo tanto modfica el html.
            console.log("pasando por esperanzador SI");
              html='';
              html+= ' <input class="form-check-input" type="radio" name="resp_esp" id="resp-no_esp" value="NO" >'+
                      '<label class="form-check-label" for="inlineRadio1" >NO</label>    ';

              html+= ' <input class="form-check-input" type="radio" name="resp_esp" id="resp-si_esp" value="SI" checked="true">'+
                      '<label class="form-check-label" for="inlineRadio1" >SI</label> ';
              $('#radio-esp').html( html );

              html = '<option value="' +data.data[0].id_cargo + '">' + data.data[0].nombre_cargo + '</option>';
              $('#idCargo_electores_edit').html( html );
           }else{
              html='';
              html+= ' <input class="form-check-input" type="radio" name="resp_esp" id="resp-no_esp" value="NO" checked="true">'+
                      '<label class="form-check-label" for="inlineRadio1" >NO</label>    ';

              html+= ' <input class="form-check-input" type="radio" name="resp_esp" id="resp-si_esp" value="SI">'+
                      '<label class="form-check-label" for="inlineRadio1" >SI</label> ';
              $('#radio-esp').html( html );

              html = '<option value="" >' + 'Seleccione un elemento de la lista' + '</option>';
              $('#idCargo_electores_edit').html( html );

           }

          //mostrar ventana modal
          accionModal('.editar_electores_modal', 0);

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
