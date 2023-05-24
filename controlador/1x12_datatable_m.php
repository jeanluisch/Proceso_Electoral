<?php
include('../modelo/1x12.php');

$obj1x12= new UnoPorDoce();
$dataRespuestaAjax= "";

//consulta del DataTable
if (isset($_GET['_'])){
	session_start();
	
	$obj1x12->id_1x12 = $_SESSION['id_1x12_resp'];

	//ejecuta el metodo de consulta
    $dataRespuestaAjax = $obj1x12 ->consultarMiembros1x12();
    $dataRespuestaAjax = ProcesarJson($dataRespuestaAjax, 1);
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