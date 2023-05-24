<?php
include('../modelo/inicio_sesion.php');

$objInicioSesion= new InicioSesion();
$dataRespuestaAjax= "";

	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json la Data Proveniente del Cliente
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			//Carga la data de los municipios para el select en la vista

			//Buscar la Data del elector segun el id obtenido del Boton en el DataTable
			case 'ConsultarUsuarioActivo':
			
				$objInicioSesion->usuario = $data->data[0]->value; 
				$objInicioSesion->pass = $data->data[1]->value; 
				$result = $objInicioSesion->ConsultarUsuarioActivo();
				
				if($result){
					$dataRespuestaAjax = crearDataRespuestaAjax('true');
				}else{
					$dataRespuestaAjax = crearDataRespuestaAjax('false');
				}

			break;	

			
		}
	}//end if $_POSt

	if ( isset($_GET['session'])=='destroy' ){
		
		session_start();
		session_destroy();
		header('Location: ../index.php');
		
	}

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