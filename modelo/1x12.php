<?php

require_once "conexion.php";

class UnoPorDoce extends Conexion{

	public $id_1x12;
	public $id_1x12_resp;

	# Buscar Data
	#-------------------------------------
	public function buscarDataResposable1x12(){

		$sql = " SELECT * FROM 1x12 WHERE id_1x12= :id_1x12 ";

		$stmt = Conexion::conectar()->prepare($sql);	
		$stmt->bindParam(":id_1x12", $this->id_1x12, PDO::PARAM_STR);
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
	
	#acualizar Datos del Elector en tabla 1x12
	#-------------------------------------
	public function addMiembro1x12(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE 1x12 SET id_responsable= :id_responsable WHERE 1x12.id_1x12=:id_1x12" );					
		$stmt->bindParam(":id_1x12", 		$this->id_1x12, PDO::PARAM_STR);
		$stmt->bindParam(":id_responsable", $this->id_1x12_resp, PDO::PARAM_STR);	

		if($stmt->execute()){

			return true;
		}
		else{

			return false;
		}
		$stmt->close();//cierra la conexión
	}

		public function removeMiembro1x12(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE 1x12 SET id_responsable= NULL WHERE 1x12.id_1x12=:id_1x12" );

		$stmt->bindParam(":id_1x12", $this->id_1x12, PDO::PARAM_STR);	

		if($stmt->execute()){

			return true;
		}
		else{

			return false;
		}
		$stmt->close();//cierra la conexión
	}
	
	#consultar Electores para Datatable
	#-------------------------------------
	public function consultarElectores(){
		
		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.id_responsable , 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.estatus,
			centro_votacion.centrov, centro_votacion.id_parroquia,
			parroquia.parroquia, parroquia.id_municipio,
			municipio.municipio FROM 1x12

			INNER JOIN centro_votacion ON 1x12.id_centrov = centro_votacion.id_centrov

			INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia

			INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE 1x12.id_responsable IS  NULL AND 1x12.id_1x12 != :id_1x12";

		$stmt = Conexion::conectar()->prepare($sql);	
		$stmt->bindParam(":id_1x12", $this->id_1x12, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_add_miembro="'.$data[$key]['id_1x12'].'" class="btn btn-success btn-xs btn_add_miembro" title="Haga Click Para Añadir Este Elector Como Miembro de 1x12"><i class="fa fa-plus"></i></button> 
					';
			}
			$array_data = array("data"=>$data);

            return $array_data;
        }
        else{
            return false;
        }

		$stmt->close();	   
	}

	public function consultarMiembros1x12(){
		
		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.id_responsable , 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.estatus,
			centro_votacion.centrov, centro_votacion.id_parroquia,
			parroquia.parroquia, parroquia.id_municipio,
			municipio.municipio FROM 1x12

			INNER JOIN centro_votacion ON 1x12.id_centrov = centro_votacion.id_centrov

			INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia

			INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE 1x12.id_responsable = :id_1x12";

		$stmt = Conexion::conectar()->prepare($sql);	
		$stmt->bindParam(":id_1x12", $this->id_1x12, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_remove_miembro="'.$data[$key]['id_1x12'].'" class="btn btn-warning btn-xs btn_remove_miembro" title="Remover Miembro Del Listado 1x12"><i class="fa fa-remove"></i></button> 
					';
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