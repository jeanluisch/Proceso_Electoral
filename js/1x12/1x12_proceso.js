$(document).ready( function() {

//***** Script 1x12 *****/

  //ordena la busqueda de la data del responsable 1 x12
  buscarDataResposable1x12();

//** Al cargar la página, obtiene el id_1x12 del campo oculto en la la vista *****/
//** el valor, es capturado por metodo GET *****/


function  buscarDataResposable1x12(){

   var id_1x12 = $('#id_1x12').val();
   var data = { id_1x12: id_1x12 };
   var dataJson = codificarJson('buscarDataResposable1x12', data);
   realizarPeticionAjax( '../controlador/1x12.php', 'POST', 'json', dataJson );
}

  
  //click sobre el boton Editar en el DataTable
  $(document).on('click', '.btn_add_miembro', function(){
   
    //cargar la data segun el id para el formulario
    var id = $(this).attr("id_add_miembro");
    var data = { id_1x12: id };
    var dataJson = codificarJson('addMiembro1x12', data);
    realizarPeticionAjax( '../controlador/1x12.php', 'POST', 'json', dataJson );
   
  //*******************/
  });

  //click sobre el boton Editar en el DataTable
  $(document).on('click', '.btn_remove_miembro', function(){
   
    //cargar la data segun el id para el formulario
    var id = $(this).attr("id_remove_miembro");
    var data = { id_1x12: id };
    var dataJson = codificarJson('removeMiembro1x12', data);
    realizarPeticionAjax( '../controlador/1x12.php', 'POST', 'json', dataJson );
   
  //*******************/
  });

//PETICION AJAX
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

        case 'dataResposable1x12':

          console.log("dataResposable1x12");
          data.data[0].cedula
          var html = "";
          
          html += '<p align="center"><strong> <h4> Responsable: |   ' + data.data[0].elector + '   |   '+ data.data[0].cedula + '   |   ' + data.data[0].telefono +'</strong> </h4> </p> ';
          $('#datos-responsable').html( html );
          
        break;

        case 'miembro1x12Add':

          console.log("miembro1x12Add");
          listarDataTable();
          listarDataTableMiembros();
          alertify.set('notifier','position', 'top-right');

          var msg = alertify.success('notifier');//delay(7) son los segundos que dura el mensaje en pantalla.
          msg.delay(5).setContent('Miembro Agregado A La Lista.');
          
        break;

        case 'miembro1x12AddFalse':

          console.log("miembro1x12AddFalse");
          
          var msg = alertify.error('notifier');//delay(7) son los segundos que dura el mensaje en pantalla.
          msg.delay(5).setContent('Error, miembro no agregado'); 
          
        break;

          case 'miembro1x12Remove':

          console.log("miembro1x12Remove");
          listarDataTable();
          listarDataTableMiembros();
          alertify.set('notifier','position', 'top-right');

          var msg = alertify.success('notifier');
          msg.delay(5).setContent('Miembro Removido de la Lista.');
          
        break;

        case 'miembro1x12RemoveFalse':

          console.log("miembro1x12RemoveFalse");
          
          var msg = alertify.error('notifier');
          msg.delay(5).setContent('Error, miembro no removido'); 
          
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

  listarDataTable();  
      function listarDataTable(){
        $(document).ready(function() {
      var datatable = $('#datatable').DataTable({
        'method':'POST',
        destroy:true,
        ajax: "../controlador/1x12.php",
        columns: [
       
            {data:"cedula"},
            {data:"elector"},
            {data:"centrov"},
            {data:"municipio"},
            {data:"parroquia"},
            {data:"boton"},
        ],
        language: idioma_espanol

         });
        });
      }
      var idioma_espanol=
        {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }

      listarDataTableMiembros();  
      function listarDataTableMiembros(){
        $(document).ready(function() {
      var datatable = $('#datatable-miembros').DataTable({
        'method':'POST',
        destroy:true,
        ajax: "../controlador/1x12_datatable_m.php",
        columns: [
       
            {data:"cedula"},
            {data:"elector"},
            {data:"centrov"},
            {data:"municipio"},
            {data:"telefono"},
            {data:"discapacidad"},
            {data:"boton"},
        ],
        language: idioma_espanol

         });
        });
      }

});//funcion principal ->  document
