<?php 


class ControladorReparaciones{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarReparacion($item, $valor,$orden){

		$tabla = "reparaciones";

		$respuesta = ModeloReparaciones::mdlMostrarReparacion($tabla, $item, $valor,$orden);

		return $respuesta;

	}
	static public function ctrCrearReparacion(){

		if(isset($_POST["seleccionarCliente"])){
			
			if(preg_match('/^[0-9]+$/', $_POST["seleccionarCliente"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = "vistas/img/reparaciones/default/anonymous.png";

			   	if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_POST["nuevaFoto"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/reparaciones/".$_POST["seleccionarCliente"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/reparaciones/".$_POST["seleccionarCliente"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/reparaciones/".$_POST["seleccionarCliente"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "reparaciones";  

                        $datos1 = json_decode($_POST["listaRepuesto"],true);
                        echo '<pre>'; print_r($datos1); echo '</pre>';

                        

				$datos = array("codigo" => $_POST["nuevaReparacion"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "idCliente" => $_POST["seleccionarCliente"],
                                             "productos" => $_POST["listaRepuesto"],
							   "modelo" => $_POST["nuevoModelo"],
							   "tipo_clave" => $_POST["nuevoPatron"],
							   "desbloqueo" => $_POST["nuevoDesbloqueo"],
							   "estado" => $_POST["nuevoEstado"],
                                             "impuesto" => $_POST["nuevoPrecioImpuesto"],
                                             "costoRep" => $_POST["nuevoCostodeReparacion"],
                                             "precioNeto" => $_POST["nuevoPrecioNeto"],
							   "total" => $_POST["totalReparacion"],
							   "imagen" => $ruta);
                              


                        $tabla1 = "repuestos";

                        
                        foreach ($datos1 as $key => $value) {
              
                                $a = "id";
                                $b = $value["id"];
                                $c = "id";
                                $d = ModeloRepuestos::mdlMostrarRepuestos($tabla1,$a,$b, $c);
                            
                
                                $item1 = "id";               
                                $value1 = $value["id"];
                                $item2 ="stock";
                                $value2 = $value["stock"];
                            
                              
                                $producto = ModeloRepuestos::mdlActualizarRepuestos($tabla1,$item2,$value2,$item1,$value1);
                                 $item3 = "ventas";
                                 $value3 = $value["cantidad"]+$d["ventas"];

                               $producto1 = ModeloRepuestos::mdlActualizarRepuestos($tabla1,$item3,$value3,$item1,$value1);

                                
                                
                        }		

                        $tablaClientes = "clientes";  
                        date_default_timezone_set('America/Argentina/Buenos_Aires');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        
                        $itema = "id";
                        $valuea= $_POST["seleccionarCliente"];
                        $itemb="ultima_reparacion";
                        $valueb= $fecha.' '.$hora;   

                       $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $itema,  $valuea, $itemb, $valueb);
                        

                       $respuesta = ModeloReparaciones::mdlIngresarReparacion($tabla, $datos);
                      


				if($respuesta == "ok" && $fechaCliente == "ok" && $producto = "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La reparacion ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "reparaciones";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La reparacion no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "reparaciones";

							}
						})

			  	</script>';
			}
		}

	}
		/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrBorrarReparacion(){

		if(isset($_GET["idReparacion"])){

			$tabla = "reparaciones";

			$item = "id";
			$valor = $_GET["idReparacion"];

			$traerVenta = ModeloReparaciones::mdlMostrarReparacion($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloReparaciones::mdlMostrarReparacion($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_reparacion";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_reparacion";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_reparacion";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloReparaciones::mdlBorrarReparaciones($tabla, $_GET["idReparacion"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La reparacion ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparacones";

								}
							})

				</script>';

			}		
		}

	}

	static public function ctrEditarReparacion(){


		if(isset($_POST["seleccionarCliente"])){
			


			if(preg_match('/^[0-9]+$/', $_POST["seleccionarCliente"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				
			if(isset($_FILES["editarFoto"])) {
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/reparaciones/".$_POST["seleccionarCliente"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/reparaciones/".$_POST["seleccionarCliente"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/reparaciones/".$_POST["seleccionarCliente"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
			}else{

				$ruta = $_POST["fotoActual"];

			}

				$tabla = "reparaciones";

                        $datos = array("codigo" => $_POST["editarReparacion"],
                                             "descripcion" => $_POST["editarDescripcion"],
                                             "idCliente" => $_POST["seleccionarCliente"],
                                             "productos" => $_POST["listaRepuestos"],
                                             "modelo" => $_POST["editarModelo"],
                                             "tipo_clave" => $_POST["editarPatron"],
                                             "desbloqueo" => $_POST["editarDesbloqueo"],
                                             "estado" => $_POST["editarEstado"],
                                             "impuesto" => $_POST["editarPrecioImpuesto"],
                                             "costoRep" => $_POST["editarCostodeReparacion"],
                                             "precioNeto" => $_POST["editarPrecioNeto"],
                                             "total" => $_POST["totalReparacion"],
                                             "imagen" => $ruta);
                              
				$respuesta = ModeloReparaciones::mdlEditarReparaciones($tabla, $datos);
 
				$tablaClientes = "clientes";	



				date_default_timezone_set('America/Argentina/Buenos_Aires');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
			      
                        $itema = "id";
                        $valuea= $_POST["seleccionarCliente"];
                        $itemb="ultima_reparacion";
                        $valueb= $fecha.' '.$hora;   

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $itema,  $valuea, $itemb, $valueb);
           
				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La reparacion ha sido modificado correctamemte",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "reparaciones";
															
										}
									})

						</script>';

				}
//

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La reparacion no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "editar-reparacion";

							}
						})

			  	</script>';
			}
		}

	}
      public function ctrSumaTotalVentas(){

   
            $tabla = "reparaciones";

            $respuesta = ModeloReparaciones::mdlMostrarSumaVentas($tabla);

            return $respuesta;

      }



}
