<?php
include('../modelo/usuario.php');

$objUsuario= new Usuario();
$dataRespuestaAjax= "";

//consulta del DataTable
if (isset($_GET['_'])){
	
	//ejecuta el metodo de consulta
    $dataRespuestaAjax = $objUsuario ->consultarUsuarios();
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
}
	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json la Data Proveniente del Cliente
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			//Carga la data de los municipios para el select en la vista

			case 'registrarUsuario':
			
				//pasando valores a los atributos de la clase
				$objUsuario->nombre 	  = $data->data[0]->value;
				$objUsuario->usuario 	  = $data->data[1]->value;
				$objUsuario->pass 		  = $data->data[2]->value;
				$objUsuario->tipo_usuario = $data->data[3]->value;
				
				//ejecuanto el metodo de registro de la clase centro de votacion
				$result = $objUsuario->registrarUsuario();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			case 'actualizarUsuario':
				//pasando valores a los atributos de la clase

				$objUsuario->id_usuario		= $data->data[0]->value;
				$objUsuario->nombre 		= $data->data[1]->value;
				$objUsuario->usuario 		= $data->data[2]->value;
				$objUsuario->pass 			= $data->data[3]->value;
				$objUsuario->tipo_usuario   = $data->data[4]->value;
				
				
				$result =$objUsuario->actualizarUsuario();
				
				//si el registro fue con exito, crea la data de respuesta a la peticion ajax
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;

			//##Elminar Elector
			case 'eliminarUsuario':
			
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

			case 'buscarDataUsuario':
			
				$objUsuario->id_usuario = $data->data->id_usuario; 
				$result = $objUsuario->consultarUsuariosById();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaConsult("dataUsuario", $result);
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('cedulaNoExiste');
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