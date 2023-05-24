$(document).ready( function() {

//***** Script Buscar Data usuario *****/

  //click sobre el boton Editar en el DataTable
  $(document).on('click', '.btn_editar_usuario', function(){
   
    //cargar la data segun el id para el formulario
    var id = $(this).attr("id_cust");
    var data = { id_usuario: id };
    var dataJson = codificarJson('buscarDataUsuario', data);
    realizarPeticionAjax( '../controlador/usuario.php', 'POST', 'json', dataJson );
   
  //*******************/

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
      
        case 'dataUsuario':
          console.log("dataUsuario");
          
          //PASANDO VALORES AL FORMULARIO
          $('#id_usuario').val(data.data[0].id_usuario);
          $('#nombre_usuario_edit').val(data.data[0].nombre);
          $('#usuario_usuario_edit').val(data.data[0].usuario);
          $('#pass_usuario_edit').val(data.data[0].pass);
            
          var html='';
          
          var responsable = data.data[0].responsable

          if( data.data[0].tipo_usuario =="USUARIO" ){
            
            html+= '<select id="tipousu_usuario_edit" name="tipousu_usuario_edit" class="form-control" >';

              html+='<option value="USUARIO">USUARIO</option>';
              html+='<option value="ADMIN">ADMINISTRADOR</option>';
              html+='</select>';
            
            $('#tipousu_usuario_edit').html( html );         
          }
          else{
            
             html+= '<select id="tipousu_usuario_edit" name="tipousu_usuario_edit" class="form-control" >';

              html+='<option value="ADMIN">ADMINISTRADOR</option>';
              html+='<option value="USUARIO">USUARIO</option>';
             
              html+='</select>';
            
            $('#tipousu_usuario_edit').html( html );
          }
          //mostrar ventana modal

           accionModal('.editar_usuario_modal', 0);

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
