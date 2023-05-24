<?php


 
 $db_host = "127.0.0.1"; //Host del Servidor MySQL
 $db_name = "espxelcambio"; //Nombre de la Base de datos
 $db_user = "root"; //Usuario de MySQL
 $db_pass = ""; //Password de Usuario MySQL
 
 $fecha = date("d-m-Y_His"); //Obtenemos la fecha y hora para identificar el respaldo
 
 // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
 $salida_sql = $db_name.'_'.$fecha.'.sql'; 

 //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
 system('C:\xampp\mysql\bin\mysqldump'." -h$db_host -u$db_user -p$db_pass $db_name > "."$salida_sql", $sal);
 
 $zip = new ZipArchive(); //Objeto de Libreria ZipArchive
 
 //Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
 $salida_zip = $db_name.'_'.$fecha.'.zip';
 
 if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
  $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
  $zip->close(); //Cerramos el ZIP
  unlink($salida_sql); //Eliminamos el archivo temporal SQL
  header ("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
  } else {
  echo 'Error'; //Enviamos el mensaje de error
 }
﻿

?>

	//Iniciar sesión y guardar cookies
	$cedula = '20242907';
	$handler = curl_init("http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=V&cedula=".$cedula."");  
	$response = curl_exec ($handler);  
	curl_close($handler);  
	echo $response;  
	