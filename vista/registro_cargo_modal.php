
<div class="modal fade modal_registro_cargo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Registro de Cargos.</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="form_cargo_registro" name="form_cargo_registro" data-parsley-validate class="form-horizontal form-label-left">
                
                  <div class="form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Cargo *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre_cargo" name="nombre_cargo" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción 
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="descripcion_cargo" name="descripcion_cargo" class="resizable_textarea form-control" class="form-control col-md-7 col-xs-12" onkeyup="this.value=this.value.toUpperCase()">
                      </textarea>
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
            <button type="submit" id="btn_registrar_cargo" class="btn btn-primary"> Registrar Cargo</button>
          </div>
    </div>
  </div>
</div>