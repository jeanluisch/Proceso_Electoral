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
	public $esperanzador;
	public $id_cargo;

	#Registrar Centro Votacion.
	#-------------------------------------
	public function registrarElectores(){

		$stmt = Conexion::conectar()->prepare("INSERT INTO 1x12 (cedula, elector, id_centrov, telefono, correo, responsable, discapacidad, descripcion, esperanzador, id_cargo , estatus ) VALUES (:cedula, :elector, :id_centrov, :telefono, :correo, :responsable, :discapacidad, :descripcion, :esperanzador, :id_cargo ,  :estatus )" );	

		$stmt->bindParam(":cedula", 	 $this->cedula, PDO::PARAM_STR);
		$stmt->bindParam(":elector", 	 $this->elector, PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov",  $this->id_centrov, PDO::PARAM_STR);
		$stmt->bindParam(":telefono",	 $this->telefono, PDO::PARAM_STR);
		$stmt->bindParam(":correo",		 $this->correo, PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $this->responsable, PDO::PARAM_STR);
		$stmt->bindParam(":discapacidad",$this->discapacidad, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
		$stmt->bindParam(":esperanzador",$this->esperanzador, PDO::PARAM_STR);
		$stmt->bindParam(":id_cargo", 	 $this->id_cargo, PDO::PARAM_STR);
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
		
		$stmt = Conexion::conectar()->prepare("UPDATE 1x12 SET cedula= :cedula, elector= :elector, id_centrov= :id_centrov, telefono= :telefono, correo= :correo, responsable= :responsable, discapacidad= :discapacidad, descripcion= :descripcion, esperanzador= :esperanzador, id_cargo= :id_cargo WHERE id_1x12=:id_1x12" );	

		$stmt->bindParam(":id_1x12", 	 $this->id_1x12, 	  PDO::PARAM_STR);
		$stmt->bindParam(":cedula", 	 $this->cedula, 	  PDO::PARAM_STR);
		$stmt->bindParam(":elector", 	 $this->elector,	  PDO::PARAM_STR);
		$stmt->bindParam(":id_centrov",  $this->id_centrov,   PDO::PARAM_STR);
		$stmt->bindParam(":telefono",	 $this->telefono, 	  PDO::PARAM_STR);
		$stmt->bindParam(":correo",		 $this->correo, 	  PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $this->responsable,  PDO::PARAM_STR);
		$stmt->bindParam(":discapacidad",$this->discapacidad, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->descripcion,  PDO::PARAM_STR);
		$stmt->bindParam(":esperanzador",$this->esperanzador, PDO::PARAM_STR);
		$stmt->bindParam(":id_cargo",	 $this->id_cargo, 	  PDO::PARAM_STR);



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

	#consultar Cargo
	#-------------------------------------
	public function consultCargo(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM cargo where estatus = :estatus ");
		$stmt->bindParam(":estatus", $this->estatus, PDO::PARAM_STR);
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

	public function consultarExistenciaCI(){

		$stmt = Conexion::conectar()->prepare("SELECT cedula FROM 1x12 WHERE cedula = :cedula");	
		$stmt->bindParam(":cedula", $this->cedula, PDO::PARAM_STR);
		$ejecucion = $stmt->execute();	
		
		if($stmt->rowCount()>0){
			return true;
		}
		else{
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

		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.esperanzador, 1x12.id_cargo, 1x12.estatus,
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

            if ( $data[0]['id_cargo']!="" ){
            	$sql = " SELECT nombre FROM cargo WHERE id_cargo =:id_cargo ";
            	$stmt = Conexion::conectar()->prepare($sql);
				$stmt->bindParam(":id_cargo", $data[0]['id_cargo'], PDO::PARAM_STR);
				$ejecucion = $stmt->execute();	
				if($ejecucion){
		            $dataCargo = 0;
		            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {

		                $dataCargo = $resultado;
		            }
		            $data[0]['nombre_cargo'] = $dataCargo[0]['nombre'];
		        }
            }else{
            	$data[0]['nombre_cargo'] = "false";
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
	public function consultarElectores(){
		
		$sql = "SELECT 1x12.id_1x12, 1x12.cedula, 1x12.elector , 1x12.id_centrov, 1x12.telefono, 1x12.correo, 1x12.responsable, 1x12.discapacidad, 1x12.estatus,
			centro_votacion.centrov, centro_votacion.id_parroquia,
			parroquia.parroquia, parroquia.id_municipio,
			municipio.municipio FROM 1x12

			INNER JOIN centro_votacion ON 1x12.id_centrov = centro_votacion.id_centrov

			INNER JOIN parroquia ON centro_votacion.id_parroquia = parroquia.id_parroquia

			INNER JOIN municipio ON parroquia.id_municipio = municipio.id_municipio WHERE 1x12.estatus = 'ACTIVO' ";

		$stmt = Conexion::conectar()->prepare($sql);	
		
		$ejecucion = $stmt->execute();

		if($ejecucion){
            $data = 0;
            
            while ($resultado = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $data = $resultado;
   
            }
			foreach ($data as $key=> $value) {
				
				$data[$key]['boton'] = 
					'<button type="submit" id_cust="'.$data[$key]['id_1x12'].'" class="btn btn-primary btn-xs btn_editar_elector" title="Editar"><i class="fa fa-edit"></i></button> 
					<button type="submit" id_cust="'.$data[$key]['id_1x12'].'" class="btn btn-danger btn-xs btn_eliminar_elector" title="Eliminar"><i class="fa fa-trash"></i></button> ';
			}
			$array_data = array("data"=>$data);

            return $array_data;
        }
        else{
            return false;
        }

		$stmt->close();	   
	}//end  -> consultarElectores

	//****
	//*
	//*Consultar Datos en el CNE

	public function consultarCiEnCne(){
		
		error_reporting(0);
		$datosCne = "";
		$html1="";
		//obtiene el archivo HTML devuelto por la petición
		$html = file_get_contents("http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=V&cedula=".$this->cedula."");
		$html1 = $html;
		//consulta al Cne realizada
		if ($html !=false){
			$htmlDecode = utf8_decode($html);
			//Interactuando con el DOM Html..
			$doc = new DOMDocument();
			$doc->loadHTML($htmlDecode);
				
			//busca en el script html los datos con  etiquetas <td>
			$book = $doc->getElementsByTagName('td') ;
			$dataCne = array();

			//Obteniendo la data en un arreglo. 
			foreach ($book as $key =>$books) {
				$dataCne[] =  $books->nodeValue;
		   	}
		   
		   	//DataCne[8] contiene la info -> "DATOS DEL ELECTOR", siempre Q' la cedula consultada es correcta
		   	//si DataCne[8] es distinto al string "DATOS DEL ELECTOR", entonces la cédula no existe, o la persona ha fallecido. 


		   	//$dataCne[28]-> contiene info -> cargo asignad...
		   	//echo($dataCne[28]);

		   	$datosElector = $dataCne[8];
		   	$estatus = "";//indica la condicion de la data final
			if($datosElector === "DATOS DEL ELECTOR"){

				//obtner los datos del Html Scraping.
				//V- *****   municipio. ***  pq. parroquia
				//de esa forma devuelve los datos el cne, por ende, se usa substr para quitar esos caracteres sobrantes
				$cedula    = substr($dataCne[11], 2);
				$nombre    = $dataCne[13];
				$municipio = substr($dataCne[17], 4);
				$parroquia = substr($dataCne[19], 4);
				$centrov   = $dataCne[21];
				$direccion = $dataCne[23];

				$strSeleccionadoCne='"Usted fue seleccionado para prestar el Servicio Electoral 2018"';
				$seleccionadoCne = "";
				//si el elector es seleccionado..
				if ( trim($dataCne[26]) === $strSeleccionadoCne ){
					$seleccionadoCne = $html1;
				}
				
				//en esta secuencia, ya estaría listo para envíar la data al cliente, pero antes se verifica de que el centro de votación devuelto por el Cne se encuentre registrado en la tabla centro_votación. se aplica esta validacion para Q' el usuario pueda crear el CV, en caso de que no exista, antes de proceder con el registro del elector.  
				//además se captura el id del centro de votación para cargarlo en la vista..


				//convirtiendo el C.V en array para eliminar espacios en blancos sobrantes
				$centroVArray = str_split($centrov);
				$centrovTemp =  $centroVArray;

				foreach ($centroVArray as $key => $value) {
					
					/*Elimina los espacios en blancos restantes del string.
					* compara si la posicion del array actual y la posicion anterior son vacios 
					*en ese caso se elimina la posicion actual en el array Q' contiene el String a evaluar
					*/
					if( $key!=0 && $centroVArray[$key]==" " && $centroVArray[$key-1] == " " ){
						unset( $centrovTemp[$key] );
					}
				}
				$centrov = implode($centrovTemp);
				
				//consultando la existencia del CV devuelto por el CNE, en la tabla centro_votacion
				$stmt = Conexion::conectar()->prepare("SELECT id_centrov, centrov FROM centro_votacion WHERE centrov =:centrov ");	
				$stmt->bindParam(":centrov", $centrov, PDO::PARAM_STR);

				$ejecucion = $stmt->execute();
				
				//si existe el centro de votacion
				if($stmt->rowCount()>0){

		            $dataCentroV = array();
		            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
		               $dataCentroV = $resultado;
		            } 
		            
		            $id_centrov = $dataCentroV['id_centrov'];

					$estatus = "existeElCentroV";
					$datosCne = array('estatus'	=> $estatus,
									'seleccionadoCne' => $seleccionadoCne,
									'cedula' 	=> $cedula,
									'nombre' 	=> $nombre,
									'municipio' => $municipio,
									'parroquia' => $parroquia,
									'centrov'	=> $centrov, 
									'direccion' => $direccion, 
									'id_centrov'=> $id_centrov
								);//end -> arrayDatosCne
				}//if->rowCount

			
				//no existen el centro de votacion, le paso el html de la consulta al cne
				else{
					
					$estatus ="noExisteCentroV";
					$datosCne = array('estatus'	=> $estatus,
									'html' 		=> $html1
								);
				}//end->else;
				
			//no existe el elector registrado en el CNE, o la persona ha fallecido..
			}else{
				$estatus  = "noExisteCiEnCne";
				$datosCne = array('estatus'	=> $estatus, 'html' => $html1);
				
			}//end->Else -> no existe en cne


		}//end->if ($html !=false)
		else{//la conexion no se ha podido establecer con el CNE.
			$estatus  = "errorConConexionAlCne";
			$datosCne = array('estatus'	=> $estatus);
		}

	return $datosCne;
	}//end -> Function consultarCiEnCne;


}//end -> clase
?>