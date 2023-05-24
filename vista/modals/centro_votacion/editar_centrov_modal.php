
<div class="modal fade editar_centrov_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Actualizar Centro de Votación</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="editar_centrov_form" name="registro_centrov_form" data-parsley-validate class="form-horizontal form-label-left">
                
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del C.V *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" id="id_centrov" name="id_centrov">

                        <input type="text" id="nombre_centrov_modificar" name="nombre_centrov_modificar" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return validarSoloLetrasYNum(event)">
                          <span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio *
                      </label>
                      <div class="col-sm-6">
                      <div class="input-group">
                          <select id="municipio_centrov_modificar" name="municipio_centrov_modificar" class="form-control" >
                            <option value="">Seleccione un elemento de la lista</option>
                          </select>
                        <span class="input-group-btn">
                          <button type="button" id="actualizaSelectMun" class="btn btn-info" ><i class="fa fa-refresh"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parroquia *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="parroquia_centrov_modificar" name="parroquia_centrov_modificar" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dirección 
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="direccion_centrov_mod" name="direccion_centrov_mod" class="resizable_textarea form-control" class="form-control col-md-7 col-xs-12" onkeyup="this.value=this.value.toUpperCase()">
                      </textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Cant. De Mesas *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="mesas_centrov_modificar" name="mesas_centrov_modificar" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
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
            <button type="submit" id="btn_editar_centrov" class="btn btn-primary"> Actualizar C. Votacion</button>
          </div>
    </div>
  </div>
</div>