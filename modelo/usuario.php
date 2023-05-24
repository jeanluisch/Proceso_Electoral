<?php

require_once "conexion.php";

class Usuario extends Conexion{

	public $nombre;
	public $usuario;
	public $pass;
	public $id_usuario;
	public $tipo_usuario;

	#Registrar Centro Votacion.
	#-------------------------------------
	public function registrarUsuario(){

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuario (nombre, usuario, pass, tipo_usuario) VALUES (:nombre, :usuario, :pass, :tipo_usuario )" );	

		$stmt->bindParam(":nombre", 	 $this->nombre, PDO::PARAM_STR);
		$stmt->bindParam(":usuario", 	 $this->usuario, PDO::PARAM_STR);
		$stmt->bindParam(":pass",  		 $this->pass, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_usuario",$this->tipo_usuario, PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}
		else{
			return false;
		}
		$stmt->close();//cierra la conexión
	}
	
	#acualizar Datos del Elector en tabla 1x12
	#-------------------------------------
	public function actualizarUsuario(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE usuario SET nombre= :nombre, usuario= :usuario, pass= :pass, tipo_usuario= :tipo_usuario WHERE id_usuario=:id_usuario" );	

		$stmt->bindParam(":id_usuario",  $this->id_usuario,	  PDO::PARAM_STR);
		$stmt->bindParam(":nombre", 	 $this->nombre, 	  PDO::PARAM_STR);
		$stmt->bindParam(":usuario", 	 $this->usuario, 	  PDO::PARAM_STR);
		$stmt->bindParam(":pass",  		 $this->pass, 		  PDO::PARAM_STR);
		$stmt->bindParam(":tipo_usuario",$this->tipo_usuario, PDO::PARAM_STR);

		if($stmt->execute()){

			return true;
		}
		else{

			return false;
		}
		$stmt->close();//cierra la conexión
	}

	#acualizar Cargo
	#-------------------------------------
	public function eliminarElector(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE 1x12 SET estatus= :estatus WHERE id_1x12=:id_1x12" );	
		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
		$stmt->bindParam(":id_1x12", $this->id_1x12, PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}
		else{
			return false;
		}
		$stmt->close();//cierra la conexión
	}

	
	public function consultarUsuariosById(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");	
		$stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();	
		
		if($ejecucion){

            $data = array();
            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
               $data[] = $resultado;
            }
            	return $data;
            }
            else {
                return false;
            }

		$stmt->close();	   
	}

	#consultar Electores para Datatable
	#-------------------------------------
	public function consultarUsuarios(){
		
		$sql = "SELECT id_usuario, nombre , usuario, tipo_usuario FROM usuario ";

		$stmt = Conexion::conectar()->prepare($sql);	
		
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_cust="'.$data[$key]['id_usuario'].'" class="btn btn-primary btn-xs btn_editar_usuario" title="Editar"><i class="fa fa-edit"></i></button> 
					<button type="submit" id_cust="'.$data[$key]['id_usuario'].'" class="btn btn-danger btn-xs btn_eliminar_usuario" title="Eliminar"><i class="fa fa-trash"></i></button> ';
			}
			$array_data = array("data"=>$data);

            return $array_data;
        }
        else{
            return false;
        }

		$stmt->close();	   
	}

}
?>