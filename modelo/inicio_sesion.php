<?php

require_once "conexion.php";

class InicioSesion extends Conexion{

	public $usuario;
	public $pass;
	public $tipo_usuario;
	
	#acualizar Datos del Elector en tabla 1x12
	#-------------------------------------
	public function ConsultarUsuarioActivo(){
		
		$stmt = Conexion::conectar()->prepare(" SELECT * from usuario WHERE usuario=:usuario AND pass=:pass " );	

		$stmt->bindParam(":usuario", $this->usuario, PDO::PARAM_STR);
		$stmt->bindParam(":pass",    $this->pass,  PDO::PARAM_STR);
		
		$stmt->execute();
		session_start();

		if($stmt->rowCount()>0){
			
			while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {

                $data = $resultado;
   
            }

			$mystring = $data[0]['nombre'];
			$findme   = ' ';//lo que busco en el string

			//strpos. busca en una cadena el valor deseado y devuelve la posicion en que fue encontrada
			$pos = strpos($mystring, $findme, 0);

			if ($pos === false) {
			    $_SESSION['nombre_usuario'] = $data[0]['nombre'];

			} else {
			   $nombre = substr($mystring, 0, $pos);
			   $_SESSION['nombre_usuario'] = $nombre;
			}
			$_SESSION['usuario']  		 = $data[0]['usuario'];
			$_SESSION['tipo_usuario']    = $data[0]['tipo_usuario'];
			$_SESSION['usuarioActivo']   = "TRUE";
			
			return true;
		}
		else{
			$_SESSION['usuarioActivo'] = "FALSE";
			return false;
		}
		$stmt->close();//cierra la conexión
	}

	
}

?>
