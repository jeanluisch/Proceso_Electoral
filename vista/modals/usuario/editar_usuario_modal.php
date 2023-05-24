
<div class="modal fade editar_usuario_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Actualizar datos del Usuario</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="editar_usuario_form" name="editar_usuario_form" data-parsley-validate class="form-horizontal form-label-left">
                   <input type="hidden" id="id_usuario" name="id_usuario">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre_usuario_edit" name="nombre_usuario_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeypress="return validarSoloLetras(event)" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario*
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="usuario_usuario_edit" name="usuario_usuario_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" required="true" onkeypress="return validarSoloLetrasYNum(event)">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña* 
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="pass_usuario_edit" name="pass_usuario_edit" class="form-control col-md-7 col-xs-12 has-feedback-left">
                          <span class="fa fa-ellipsis-h form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>
                
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo De Usuario *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="tipousu_usuario_edit" name="tipousu_usuario_edit" class="form-control" >
                          <option value="USUARIO">USUARIO</option>
                          <option value="ADMIN">ADMINISTRADOR</option>
                        </select>
                      </div>
                  </div>     
                  </form>
                </div>
            </div>
          </div>
        </div>         
      </div>
          <div class="modal-footer">
            <button type="button" id="btn_cerrar" class="btn btn-default" data-dismiss="modal">Cerrar Ventana</button>
            <button type="submit" id="btn_actualizar_usuario" class="btn btn-primary"> Actualizar Usuario</button>
          </div>
    </div>
  </div>
</div>