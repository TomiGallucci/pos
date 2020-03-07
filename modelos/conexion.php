<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=31.220.52.244;dbname=db_novatech",
			            "testing",
			            "Testing123");

		$link->exec("set names utf8");

		return $link;

	}

}
