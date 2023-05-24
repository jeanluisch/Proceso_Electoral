<?php
include('../modelo/electores.php');

$objElectores= new Electores();
$dataRespuestaAjax= "";

//consulta del DataTable
if (isset($_GET['_'])){
	
	//ejecuta el metodo de consulta
    $dataRespuestaAjax = $objElectores ->consultarElectores();
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
}
	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json la Data Proveniente del Cliente
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			//Carga la data de los municipios para el select en la vista

			case 'buscarDataMunicipio':
			
				//ejecuanto el metodo consultar municipio
				$result = $objElectores->consultMunicipio();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataMunicipio", $result);
					
				}else{
					
					$dataRespuestaAjax = crearDataRespuestaAjax('dataMunicipioFalse');
				}

			break;
				
			case 'buscarParroquiaById':
			
				$objElectores->id_municipio = $data->data->id_municipio; 
				$result = $objElectores->consultParroquiaById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataParroquia", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataParroquiaFalse');
				}
			
			break;

			//al seleccionar la parroquia, busca todos los centros de votacion q pertenezcan a esa parroquia
			case 'buscarCentroVById':
			
				$objElectores->id_parroquia = $data->data->id_parroquia; 
				$result = $objElectores->consultCentroVById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataCentroV", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataCentroVFalse');
				}
			
			break;

			//Buscar la Data del elector segun el id obtenido del Boton en el DataTable
			case 'buscarDataElectorById':
			
				$objElectores->id_1x12 = $data->data->id_1x12; 
				$result = $objElectores->buscarDataElectorById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataElector", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataElectorFalse');
				}

			break;	

			case 'buscarDataCargo':
			
				//ejecuanto el metodo consultar municipio
				$result = $objElectores->consultCargo();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataCargo", $result);
					
				}else{
					
					$dataRespuestaAjax = crearDataRespuestaAjax('dataCargoFalse');
				}
			break;

			case 'registrarElector':
			
				//pasando valores a los atributos de la clase
				$objElectores->cedula 		= $data->data[0]->value;
				$objElectores->elector 		= $data->data[1]->value;
				$objElectores->id_centrov 	= $data->data[2]->value;
				$objElectores->telefono 	= $data->data[3]->value;
				$objElectores->correo 		= $data->data[4]->value;
				$objElectores->discapacidad = $data->data[5]->value;
				$objElectores->responsable 	= $data->data[6]->value;
				$objElectores->esperanzador	= $data->data[7]->value;
				$objElectores->id_cargo 	= $data->data[8]->value;
				
				//ejecuanto el metodo de registro de la clase centro de votacion
				$result = $objElectores->registrarElectores();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'actualizarElector':
				//pasando valores a los atributos de la clase

				$objElectores->id_1x12 		= $data->data[0]->value;
				$objElectores->cedula 		= $data->data[1]->value;
				$objElectores->elector 		= $data->data[2]->value;
				$objElectores->id_centrov 	= $data->data[4]->value;
				$objElectores->telefono 	= $data->data[5]->value;
				$objElectores->correo 		= $data->data[6]->value;
				$objElectores->discapacidad = $data->data[7]->value;
				$objElectores->responsable 	= $data->data[8]->value;
				$objElectores->esperanzador	= $data->data[9]->value;
				$objElectores->id_cargo		= $data->data[10]->value;
				$objElectores->descripcion 	= "";

				//ejecuanto el metodo de registro de la clase centro de votacion
				$result =$objElectores->actualizarElector();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			//##Elminar Elector
			case 'eliminarElector':
			
				//pasando valores a los atributos de la clase
				
				$objElectores->estatus = "INACTIVO";
				$objElectores->id_1x12= $data->data->id_1x12;
				
				//ejecuanto el metodo de registro de la clase centro de votacion
				$result = $objElectores->eliminarElector();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'consultarExistenciCI':
			
				$objElectores->cedula = $data->data->cedulaElector; 
				$result = $objElectores->consultarExistenciaCI();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax("cedulaExiste");
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('cedulaNoExiste');
				}

			break;	

			case 'consultarCiEnCne':
			
				$objElectores->cedula = $data->data->cedulaElector; 
				$result = $objElectores->consultarCiEnCne();
				
				
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataCne", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataCneError');
				}
				
			break;	
			
		}
	}//end if $_POSt

//convierte o decodifica el formato Json
function ProcesarJson($data, $opc){
   if ($opc==1){
     return json_encode($data);

   }else{
    return json_decode($data);
   }
}

//procesa el Json para la respuesta de Ajax.
function crearDataRespuestaConsult($respuesta, $data){
	
		$data = array( "respuesta" => $respuesta, "data"=> $data );
		$dataJson =  ProcesarJson($data, 1);
		
	return $dataJson;
}

//procesa el Json para la respuesta de Ajax.
function crearDataRespuestaAjax($respuesta){

	$data = array( "respuesta" => $respuesta );
    $dataJson =  ProcesarJson($data, 1);
    
    return $dataJson;
}

header('Content-type: application/json');
echo $dataRespuestaAjax;

?>