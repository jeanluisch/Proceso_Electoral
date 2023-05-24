<?php

class Conexion{

	public function conectar(){
	try {
    $mbd = new PDO('mysql:host=127.0.0.1;dbname=espxelcambio', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    
    	return $mbd;
	} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();

	}
}
}
?>