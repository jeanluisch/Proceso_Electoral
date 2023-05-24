<?php
include('../modelo/cargo.php');

$objCargo = new Cargo();
$dataRespuestaAjax= "";

if (isset($_GET['_'])){
    
    $dataRespuestaAjax = $objCargo ->consultarCargo();
    
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
}
	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			case 'registrarCargo':
				
				//pasando valores a los atributos de la clase
				$objCargo->nombre = $data->data[0]->value;
				$objCargo->descripcion = $data->data[1]->value;

				//ejecuanto el metodo de registro de la clase cargo
				$result = $objCargo->registrarCargo();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'buscarDataCargo':
				$idCargo =  $data->data->id_cargo;
				$objCargo ->idCargo = $idCargo;
				$result = $objCargo->consultCargoByID();

				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataCargoConsultado", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}
			
			break;

			case 'actualizarCargo':
			
				//pasando valores a los atributos de la clase
				$objCargo->idCargo = $data->data[0]->value;
				$objCargo->nombre = $data->data[1]->value;
				$objCargo->descripcion = $data->data[2]->value;

				//ejecuanto el metodo de registro de la clase cargo
				$result = $objCargo->actualizarCargo();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'eliminarCargo':
			
				//pasando valores a los atributos de la clase
				$objCargo->idCargo = $data->data->id_cargo;
				$objCargo->estatus = "INACTIVO";
				
				//ejecuanto el metodo de registro de la clase cargo
				$result = $objCargo->eliminarCargo();
				
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