<?php

require_once "conexion.php";

class CentroVotacion extends Conexion{

	public $centrov;
	public $cantidad_mesas;
	public $id_parroquia;
	public $id_centrov;
	public $estatus="ACTIVO";
	public $direccion_centrov;
	#Registrar Centro Votacion.
	#-------------------------------------
	public function registrarCentroVotacion(){

		$stmt = Conexion::conectar()->prepare("INSERT INTO centro_votacion (centrov, direccion_centrov, cantidad_mesas, id_parroquia, estatus) VALUES (:centrov, :direccion_centrov, :cantidad_mesas, :id_parroquia, :estatus)" );	


		$stmt->bindParam(":centrov", $this->centrov, PDO::PARAM_STR);
		$stmt->bindParam(":direccion_centrov", $this->direccion_centrov, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_mesas", $this->cantidad_mesas, PDO::PARAM_STR);
		$stmt->bindParam(":id_parroquia", $this->id_parroquia, PDO::PARAM_STR);
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
	public function actualizarCentroVotacion(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE centro_votacion SET centrov= :centrov, direccion_centrov= :direccion_centrov , cantidad_mesas= :cantidad_mesas, id_parroquia= :id_parroquia WHERE id_centrov=:id_centrov" );	

		$stmt->bindParam(":centrov", $this->centrov, PDO::PARAM_STR);
		$stmt->bindParam(":direccion_centrov", $this->direccion_centrov, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_mesas", $this->cantidad_mesas, PDO::PARAM_STR);
		$stmt->bindParam(":id_parroquia", $this->id_parroquia, PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov", $this->id_centrov, PDO::PARAM_STR);

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
	public function eliminarCentroVotacion(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE centro_votacion SET estatus= :estatus WHERE id_centrov=:id_centrov" );	

		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov", $this->id_centrov, PDO::PARAM_STR);

		if($stmt->execute()){

			return true;
		}
		else{

			return false;
		}
		$stmt->close();//cierra la conexión
	}

	
	//consulta municipio
	public function consultMunicipio(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM municipio");	
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

	#consultar Parroquia Por ID
	#-------------------------------------
	public function consultParroquiaById(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM parroquia WHERE id_municipio = :id_municipio");	
		$stmt->bindParam(":id_municipio", $this->id_parroquia, PDO::PARAM_STR);
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

	#consultar Centro Votacion  Por ID
	#-------------------------------------
	public function consultCentroVById(){
		$sql = "SELECT centro_votacion.id_centrov, centro_votacion.centrov, centro_votacion.direccion_centrov, centro_votacion.cantidad_mesas, centro_votacion.id_parroquia,
		parroquia.parroquia, parroquia.id_municipio,
		municipio.municipio FROM centro_votacion 
		INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia
		INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE centro_votacion.id_centrov = :id_centrov AND centro_votacion.estatus = 'ACTIVO' ";

		$stmt = Conexion::conectar()->prepare($sql);	
		$stmt->bindParam(":id_centrov", $this->id_parroquia, PDO::PARAM_STR);
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

	#consultar Centro Votacion para Datatable
	#-------------------------------------
	public function consultarCentroVotacion(){
		
		$sql = "SELECT centro_votacion.id_centrov, centro_votacion.centrov, centro_votacion.cantidad_mesas, centro_votacion.id_parroquia,
		parroquia.parroquia, parroquia.id_municipio,
		municipio.municipio FROM centro_votacion 
		INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia
		INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio AND centro_votacion.estatus = 'ACTIVO' ";

		$stmt = Conexion::conectar()->prepare($sql);	
		
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_cust="'.$data[$key]['id_centrov'].'" class="btn btn-primary btn-xs btn_editar_centrov" title="Editar"><i class="fa fa-edit"></i></button> 
					<button type="submit" id_cust="'.$data[$key]['id_centrov'].'" class="btn btn-danger btn-xs btn_eliminar_centrov" title="Eliminar"><i class="fa fa-trash"></i></button> ';	
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