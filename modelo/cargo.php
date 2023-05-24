<?php

require_once "conexion.php";

class Cargo extends Conexion{

	public $idCargo;
	public $nombre;
	public $descripcion;
	public $estatus="ACTIVO";
	#-------------------------------------
	public function registrarCargo(){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cargo (nombre, descripcion, estatus) VALUES (:nombre, :descripcion, :estatus)" );	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
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
	public function actualizarCargo(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE cargo SET nombre= :nombre, descripcion= :descripcion WHERE id_cargo=:id_cargo" );	

		$stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
		$stmt->bindParam(":id_cargo", $this->idCargo, PDO::PARAM_STR);
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
	public function eliminarCargo(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE cargo SET estatus= :estatus WHERE id_cargo=:id_cargo" );	

		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
		$stmt->bindParam(":id_cargo", $this->idCargo, PDO::PARAM_STR);

		if($stmt->execute()){

			return true;
		}
		else{

			return false;
		}
		$stmt->close();//cierra la conexión
	}

	#consultar cargo
	#-------------------------------------
	public function consultarCargo(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM cargo WHERE estatus = :estatus");	
		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {

                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_cust="'.$data[$key]['id_cargo'].'" class="btn btn-primary btn-xs btn_editar_cargo" title="Editar"><i class="fa fa-edit"></i></button> 
					<button type="submit" id_cust="'.$data[$key]['id_cargo'].'" class="btn btn-danger btn-xs btn_eliminar_cargo" title="Eliminar"><i class="fa fa-trash"></i></button> ';	
			}
			$array_data = array("data"=>$data);

            return $array_data;
        }
        else{
            return false;
        }

		$stmt->close();	   
	}

	public function consultCargoByID(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM cargo WHERE id_cargo =:id_cargo AND  estatus = :estatus");	
		$stmt->bindParam(":id_cargo", $this->idCargo, PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();	

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {

                $data = $resultado;
            }

        	return $data;
        }
        else{
            return false;
        }

		$stmt->close();	   
	}

}
?>