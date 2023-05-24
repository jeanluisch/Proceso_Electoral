$(document).ready( function() {

//***** Script Buscar Data Editar Cargo *****/

//*** Cuando se haga click en el boton editar DataTable  ***/
$(document).on('click', '.btn_editar_cargo', function(){

  var id = $(this).attr("id_cust");
  var data = { id_cargo: id };
  var dataJson = codificarJson('buscarDataCargo', data);
  realizarPeticionAjax( '../controlador/cargo.php', 'POST', 'json', dataJson );

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
      
      case 'dataCargoConsultado':
        //mostrar datos en ventana modal modificar.
        accionModal('.modal_editar_cargo', 0);
        
        //pasando valores al formulario
        $('#id_cargo_editar').val(data.data[0].id_cargo);
        $('#nombre_cargo_editar').val(data.data[0].nombre);
        $("#descripcion_cargo").val( "" );
        $('#descripcion_cargo_editar').val(data.data[0].descripcion);
      
      break;

      case 'false':
      
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

//click sobre el boton en el dataTable

});//funcion principal ->  document
