<?php

require_once "conexion.php";

class ModeloReparaciones{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarReparacion($tabla, $item, $valor, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	EDITAR REPARACION
	=============================================*/

	static public function mdlEditarReparaciones($tabla, $datos){

	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           imagen = :imagen,
           id_cliente = :id_cliente,
           descripcion = :descripcion,
           productos = :productos,
           modelo = :modelo,           
           tipo_clave = :tipo_clave, 
           desbloqueo = :desbloqueo,
           estado = :estado,
           impuesto = :impuesto,
           costoRep = :costoRep,
           precioNeto = :precioNeto,
           total = :total
           WHERE codigo = :codigo");


        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["idCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_clave", $datos["tipo_clave"], PDO::PARAM_STR);
        $stmt->bindParam(":desbloqueo", $datos["desbloqueo"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
        $stmt->bindParam(":costoRep", $datos["costoRep"], PDO::PARAM_STR);
        $stmt->bindParam(":precioNeto", $datos["precioNeto"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR REPARACION
	=============================================*/

	static public function mdlActualizarReparaciones($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR REPARACION
	=============================================*/

	static public function mdlBorrarReparaciones($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
	/*=============================================
	REGISTRO DE REPARACION
	=============================================*/
	static public function mdlIngresarReparacion($tabla, $datos){
        echo '<pre>'; print_r($datos); echo '</pre>';

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, imagen, id_cliente, descripcion, productos, modelo, tipo_clave, desbloqueo, estado, impuesto, costoRep, precioNeto, total) VALUES (:codigo, :imagen, :id_cliente, :descripcion, :productos, :modelo, :tipo_clave, :desbloqueo, :estado, :impuesto, :costoRep, :precioNeto, :total)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["idCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_clave", $datos["tipo_clave"], PDO::PARAM_STR);
		$stmt->bindParam(":desbloqueo", $datos["desbloqueo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
        $stmt->bindParam(":costoRep", $datos["costoRep"], PDO::PARAM_STR);
        $stmt->bindParam(":precioNeto", $datos["precioNeto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);



		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
    static public function mdlMostrarSumaVentas($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;
    }


}