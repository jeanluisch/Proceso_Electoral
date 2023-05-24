
<div class="modal fade registro_electores_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
            <h4 class="modal-title" id="myModalLabel">Registro de Electores</h4>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <br/>
                <form id="registro_electores_form" name="registro_centrov_form" data-parsley-validate class="form-horizontal form-label-left">

                <div id="mensaje-modal">
                  
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cédula *
                    </label>
                    <div class="col-sm-6">
                      <div class="input-group" class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="cedula_electores_reg" name="cedula_electores_reg" class="form-control  has-feedback-left" onkeypress="return validarSoloNumeros(event)" >
                          <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                          <span class="input-group-btn">
                          <button type="button" id="btn_consult_ci_cne" class="btn btn-info" ><i class="fa fa-search" title="Haga Click Para Consultar La Cédula En El CNE"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Elector *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nombre_electores_reg" name="nombre_electores_reg" class="form-control col-md-7 col-xs-12 has-feedback-left" required="true"  onkeyup="this.value=this.value.toUpperCase()" onkeypress="return validarSoloLetras(event)">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="municipio_electores_reg" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parroquia *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="parroquia_electores_reg" class="form-control" >
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group" >
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Centro V *
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="idCentrov_electores_reg" name="idCentrov_electores_reg" class="form-control" required="true">
                          <option value="">Seleccione un elemento de la lista</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono 
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tlf_electores_reg" name="tlf_electores_reg" class="form-control col-md-7 col-xs-12 has-feedback-left" data-inputmask="'mask' : '(9999)999-99-99'">
                          <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Correo 
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="correo_electores_reg" name="correo_electores_reg" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>
                                 
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Discapacidad 
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="discapacidad_electores_reg" name="discapacidad_electores_reg" class="form-control col-md-7 col-xs-12 has-feedback-left" onkeyup="this.value=this.value.toUpperCase()">
                          <span class="fa fa-wheelchair form-control-feedback left" aria-hidden="true"></span>
                      </div>
                  </div>

                  <div class="form-group-radio">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Respons. 1x12 * 
                    </label>
                   
                      <div class="input-group" class="col-md-9 col-sm-9 col-xs-12">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-no" value="NO" checked="">
                          <label class="form-check-label" for="inlineRadio1">NO</label>
                        
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="resp-si" value="SI">
                          <label class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>
                  </div>

                  <div class="form-group-radio" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name1">Esperanzador * 
                    </label>
                    
                      <div class="input-group" class="col-md-9 col-sm-9 col-xs-12" >
                          <input class="form-check-input" type="radio" name="resp_esp" id="resp-no_esp" value="NO" checked=""  >
                          <label class="form-check-label" for="inlineRadio1">NO</label>
                        
                          <input class="form-check-input" type="radio" name="resp_esp" id="resp-si_esp" value="SI" >
                          <label class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>
                  </div>

                  <div class="form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cargo* </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="idCargo_electores_reg" name="idCargo_electores_reg" class="form-control" required="true" readonly="true" >
                            <option value="">Seleccione un elemento de la lista</option>
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
            <button type="submit" id="btn_registrar_elector" class="btn btn-primary"> Registrar Elector</button>
          </div>
    </div>
  </div>
</div>