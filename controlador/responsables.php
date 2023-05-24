<?php
include('../modelo/responsables.php');

$objResponsables= new Electores();
$dataRespuestaAjax= "";

//consulta del DataTable
if (isset($_GET['_'])){
	
	//ejecuta el metodo de consulta
    $dataRespuestaAjax = $objResponsables ->consultarResponsables();
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
}
	//si la variable $_POST['data'] contiene algun valor..
	if ( isset($_POST['data']) ){

		//convierte en Json la Data Proveniente del Cliente
		$data = ProcesarJson($_POST['data'], 0);
		
		//Realiza segun sea la accion
		switch ($data->accion) {

			//Carga la data de los municipios para el select en la vista

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

			
		}
	}//end if $_POSt

	if ( isset($_GET['id_1x12']) ){
		//enviar los datos de la persona

		$valor = "BIENVENIDO"; 
		include ("../vista/1x12.php");
		
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