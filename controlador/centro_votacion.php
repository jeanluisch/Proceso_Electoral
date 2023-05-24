<?php
include('../modelo/centro_votacion.php');

$objCentroV= new CentroVotacion();
$dataRespuestaAjax= "";

if (isset($_GET['_'])){
	
	//ejecuta el metodo de consulta
    $dataRespuestaAjax = $objCentroV ->consultarCentroVotacion();
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
}
	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			case 'buscarDataMunicipio':
			
				//ejecuanto el metodo consultar municipio
				$result = $objCentroV->consultMunicipio();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataMunicipio", $result);
					
				}else{
					
					$dataRespuestaAjax = crearDataRespuestaAjax('dataMunicipioFalse');
				}

			break;
				
			case 'buscarParroquiaById':
			
				$objCentroV->id_parroquia = $data->data->id_municipio; 
				$result = $objCentroV->consultParroquiaById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataParroquia", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataParroquiaFalse');
				}
			
			break;

			case 'actualizarCentroV':
			
				//pasando valores a los atributos de la clase
				
				$objCentroV->id_centrov= $data->data[0]->value;
				$objCentroV->centrov = $data->data[1]->value;
	
				$objCentroV->id_parroquia = $data->data[3]->value;
				$objCentroV->direccion_centrov = $data->data[4]->value;
				$objCentroV->cantidad_mesas = $data->data[5]->value;
				

				$result = $objCentroV->actualizarCentroVotacion();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'registrarCentrov':
			
				//pasando valores a los atributos de la clase
				
				$objCentroV->centrov = $data->data[0]->value;
				$objCentroV->id_parroquia = $data->data[1]->value;
				$objCentroV->direccion_centrov = $data->data[2]->value;
				$objCentroV->cantidad_mesas = $data->data[3]->value;
				
				//ejecuanto el metodo de registro de la clase centro de votacion
				$result = $objCentroV->registrarCentroVotacion();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'buscarDataCentroVById':
			
				$objCentroV->id_parroquia = $data->data->id_centrov; 
				$result = $objCentroV->consultCentroVById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataCentroVotacion", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('dataParroquiaFalse');
				}

			break;
			case 'eliminarCentrov':
			
				//pasando valores a los atributos de la clase
				
				$objCentroV->estatus = "INACTIVO";
				$objCentroV->id_centrov = $data->data->id_centrov;
				
				//ejecuanto el metodo de registro de la clase centro de votacion
				$result = $objCentroV->eliminarCentroVotacion();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
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