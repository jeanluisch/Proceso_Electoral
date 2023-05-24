<?php

require_once "conexion.php";

class Electores extends Conexion{

	public $id_1x12;
	public $cedula;
	public $elector;
	public $id_centrov;
	public $telefono;
	public $correo;
	public $responsable;
	public $discapacidad;
	public $descripcion;
	public $estatus="ACTIVO";
	public $id_municipio;
	public $id_parroquia;

	#Registrar Centro Votacion.
	#-------------------------------------
	public function registrarElectores(){

		$stmt = Conexion::conectar()->prepare("INSERT INTO 1x12 (cedula, elector, id_centrov, telefono, correo, responsable, discapacidad, descripcion, estatus ) VALUES (:cedula, :elector, :id_centrov, :telefono, :correo, :responsable, :discapacidad, :descripcion, :estatus )" );	

		$stmt->bindParam(":cedula", 	 $this->cedula, PDO::PARAM_STR);
		$stmt->bindParam(":elector", 	 $this->elector, PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov",  $this->id_centrov, PDO::PARAM_STR);
		$stmt->bindParam(":telefono",	 $this->telefono, PDO::PARAM_STR);
		$stmt->bindParam(":correo",		 $this->correo, PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $this->responsable, PDO::PARAM_STR);
		$stmt->bindParam(":discapacidad",$this->discapacidad, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
		$stmt->bindParam(":estatus", 	 $this->estatus, PDO::PARAM_STR);

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
	public function actualizarElector(){
		
		$stmt = Conexion::conectar()->prepare("UPDATE 1x12 SET cedula= :cedula, elector= :elector, id_centrov= :id_centrov, telefono= :telefono, correo= :correo, responsable= :responsable, discapacidad= :discapacidad, descripcion= :descripcion WHERE id_1x12=:id_1x12" );	

		$stmt->bindParam(":id_1x12", 	 $this->id_1x12, 	  PDO::PARAM_STR);
		$stmt->bindParam(":cedula", 	 $this->cedula, 	  PDO::PARAM_STR);
		$stmt->bindParam(":elector", 	 $this->elector,	  PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov",  $this->id_centrov,   PDO::PARAM_STR);
		$stmt->bindParam(":telefono",	 $this->telefono, 	  PDO::PARAM_STR);
		$stmt->bindParam(":correo",		 $this->correo, 	  PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $this->responsable,  PDO::PARAM_STR);
		$stmt->bindParam(":discapacidad",$this->discapacidad, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion,  PDO::PARAM_STR);

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
		$stmt->bindParam(":id_municipio", $this->id_municipio, PDO::PARAM_STR);
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
	public function consultCentroVById(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM centro_votacion WHERE id_parroquia = :id_parroquia");	
		$stmt->bindParam(":id_parroquia", $this->id_parroquia, PDO::PARAM_STR);
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

	#consultar la tabla 1x12 segun el  ID 
	#-------------------------------------
	public function buscarDataElectorById(){

		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.estatus,
			centro_votacion.centrov, centro_votacion.id_parroquia,
			parroquia.parroquia, parroquia.id_municipio,
			municipio.municipio FROM 1x12

			INNER JOIN centro_votacion ON 1x12.id_centrov = centro_votacion.id_centrov

			INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia

			INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE 1x12.id_1x12 =:id_1x12 ";

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


	#consultar Electores para Datatable
	#-------------------------------------
	public function consultarResponsables(){
		
		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.estatus,
			centro_votacion.centrov, centro_votacion.id_parroquia,
			parroquia.parroquia, parroquia.id_municipio,
			municipio.municipio FROM 1x12

			INNER JOIN centro_votacion ON 1x12.id_centrov = centro_votacion.id_centrov

			INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia

			INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE 1x12.responsable = 'SI' AND 1X12.estatus='ACTIVO' ";

		$stmt = Conexion::conectar()->prepare($sql);	
		
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				 
				$data[$key]['boton'] = 
				'<button type="submit" id_1x12="'.$data[$key]['id_1x12'].'" class="btn btn-primary btn-xs btn_id_1x12" title="Haga Click Para Ver El Listado, Agregar, o Retirar Miembros de 1x12 del Responsable Seleccionado"><i class="fa fa-plus-square"></i></button> ';
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
