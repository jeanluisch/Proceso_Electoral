$(document).ready( function() {

//***** Envia por metodo get el id del responsable seleccionado *****/

  $(document).on('click', '.btn_id_1x12', function(e){

    var id_1x12 = $(this).attr("id_1x12");
    document.location.href = "../vista/1x12.php?id_1x12=" + id_1x12 ;
  });   
});//funcion principal ->  document
