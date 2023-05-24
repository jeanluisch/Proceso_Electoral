
<div class="modal fade registro_centrov_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Registro de Centro de Votación</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="registro_centrov_form" name="registro_centrov_form" data-parsley-validate class="form-horizontal form-label-left">
                
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del C.V *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre_centrov" name="nombre_centrov" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()" onkeypress="return validarSoloLetrasYNum(event)">
                          <span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="municipio_centrov" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parroquia *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="parroquia_centrov" name="parroquia_centrov" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dirección 
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="direccion_centrov" name="descripcion_centrov" class="resizable_textarea form-control" class="form-control col-md-7 col-xs-12" onkeyup="this.value=this.value.toUpperCase()">
                      </textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Cant. De Mesas *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="mesas_centrov" name="mesas_centrov" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
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
            <button type="submit" id="btn_registrar_centrov" class="btn btn-primary"> Registrar C. Votacion</button>
          </div>
    </div>
  </div>
</div>