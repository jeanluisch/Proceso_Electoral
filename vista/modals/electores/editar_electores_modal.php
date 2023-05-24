
<div class="modal fade editar_electores_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Actualizar registro de Elector</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="editar_electores_form" name="editar_electores_form" data-parsley-validate class="form-horizontal form-label-left">
                
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cédula *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" name="id_1x12" id="id_1x12">
                        <input type="number" id="cedula_electores_edit"  min="2000000" max="30000000" name="cedula_electores" class="form-control col-md-7 col-xs-12 has-feedback-left" required="true"  >
                          <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Elector *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre_electores_edit" name="nombre_electores_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" required="true"  onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio *
                      </label>
                      <div class="col-sm-6">
                      <div class="input-group">
                          <select id="municipio_electores_edit" name="municipio_electores_edit" class="form-control" >
                            <option value="">Seleccione un elemento de la lista</option>
                          </select>
                        <span class="input-group-btn">
                          <button type="button" id="btn-recargar-select" class="btn btn-info" ><i class="fa fa-refresh"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parroquia *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="parroquia_electores_edit" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group" >
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Centro V *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="idCentrov_electores_edit" name="idCentrov_electores_edit" class="form-control" required="true">
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tlf_electores_edit" name="tlf_electores_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" data-inputmask="'mask' : '(9999)999-99-99'">
                          <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Correo *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="correo_electores_edit" name="correo_electores_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>
                                 
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Discapacidad *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="discapacidad_electores_edit" name="discapacidad_electores_edit" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-wheelchair form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group-radio">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Respons. 1x12 * 
                    </label>
                   
                      <div class="input-group" class="col-md-9 col-sm-9 col-xs-12" id="radio-check">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-no" value="NO" checked="">
                          <label class="form-check-label" for="inlineRadio1">NO</label>
                        
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="SI">
                          <label class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>
                  </div>

                  <div class="form-group-radio" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name1">Esperanzador * 
                    </label>
                    
                      <div class="input-group" class="col-md-9 col-sm-9 col-xs-12" id="radio-esp">
                          <input class="form-check-input" type="radio" name="resp_esp" id="resp-no_esp_edit" value="NO" checked=""  >
                          <label class="form-check-label" for="inlineRadio1">NO</label>
                        
                          <input class="form-check-input" type="radio" name="resp_esp" id="resp-si_esp_edit" value="SI" >
                          <label class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cargo *
                      </label>
                      <div class="col-sm-6">
                      <div class="input-group">
                           <select id="idCargo_electores_edit" name="idCargo_electores_edit" class="form-control" required="true" readonly="true" >
                              <option value="">Seleccione un elemento de la lista</option>
                          </select>
                        <span class="input-group-btn">
                          <button type="button" id="btn-recargar-select-cargo" class="btn btn-info" ><i class="fa fa-refresh"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
          </div>
        </div>         
      </div>
          <div class="modal-footer">
            <button type="button" id="btn_cerrar" class="btn btn-default" data-dismiss="modal">Cerrar Ventana</button>
            <button type="submit" id="btn_editar_elector" class="btn btn-primary"> Actualizar Elector</button>
          </div>
        </form>
    </div>
  </div>
</div>