<?php 


class ControladorRepuestos{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarRepuestos($item, $valor,$orden){

		$tabla = "repuestos";

		$respuesta = ModeloRepuestos::mdlMostrarRepuestos($tabla, $item, $valor,$orden);

		return $respuesta;

	}
	static public function ctrCrearRepuestos(){

		if(isset($_POST["nuevoRepuesto"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoRepuesto"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = "vistas/img/repuestos/default/anonymous.png";

			   	if(isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/repuestos/".$_POST["nuevoRepuesto"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/repuestos/".$_POST["nuevoRepuesto"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/repuestos/".$_POST["nuevoRepuesto"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "repuestos";

				$datos = array("codigo" => $_POST["nuevoRepuesto"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "idCategoria" => $_POST["nuevaCategoria"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precioCompra" => $_POST["nuevoPrecioCompra"],
							   "precioVenta" => $_POST["nuevoPrecioVenta"],
							   "imagen" => $ruta);

				$respuesta = ModeloRepuestos::mdlIngresarRepuestos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El repuesto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "repuestos";

										}
									})

						</script>';

				}else{

                              echo'<script>

                                    swal({
                                            type: "error",
                                            title: "El repuesto no ha popido guardado correctamente",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                                            }).then(function(result){
                                                            if (result.value) {

                                                            window.location = "repuestos";

                                                            }
                                                      })

                                    </script>';

                        }


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La repuesto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "repuestos";

							}
						})

			  	</script>';
			}
		}

	}
	/*=============================================
	ELIMINAR REPUESTO
	=============================================*/

	static public function ctrBorrarRepuestos(){

		if(isset($_GET["idRepuesto"])){

			$tabla = "repuestos";

			$respuesta = ModeloRepuestos::mdlBorrarRepuestos($tabla, $_GET["idRepuesto"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El repuesto ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "repuestos";

								}
							})

				</script>';

			}		
		}

	}

	static public function ctrEditarRepuestos(){


		if(isset($_POST["editarRepuesto"])){
			
                  var_dump($_POST);

			if(preg_match('/^[0-9]+$/', $_POST["editarRepuesto"])){

		   		/*=============================================
	                 		VALIDAR IMAGEN
				=============================================*/

               $ruta = $_POST["actualFoto"];
		

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/repuestos/".$_POST["editarRepuesto"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["actualFoto"]) && $_POST["actualFoto"] != "vistas/img/repuestos/default/anonymous.png"){

						unlink($_POST["actualFoto"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/repuestos/".$_POST["editarRepuesto"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/repuestos/".$_POST["editarRepuesto"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                        $tabla = "repuestos";

                        $datos = array("codigo" => $_POST["editarRepuesto"],
                                             "descripcion" => $_POST["editarDescripcion"],
                                             "idCategoria" => $_POST["editarCategoria"],
                                             "descripcion" => $_POST["editarDescripcion"],
                                             "stock" => $_POST["editarStock"],
                                             "precioCompra" => $_POST["editarPrecioCompra"],
                                             "precioVenta" => $_POST["editarPrecioVenta"],
                                             "imagen" => $ruta);

				$respuesta = ModeloRepuestos::mdlEditarRepuestos($tabla, $datos);
                        echo '<pre>'; print_r($respuesta); echo '</pre>';
				

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El repuesto ha sido modificado correctamemte",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "repuestos";
															
										}
									})

						</script>';

				}else {
                              echo'<script>

                                    swal({
                                            type: "error",
                                            title: "El repuesto no ha sido modificado correctamemte",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                                            }).then(function(result){
                                                            if (result.value) {

                                                            window.location = "repuestos";
                                                                                          
                                                            }
                                                      })

                                    </script>';

                        }

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La repuesto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "repuestos";

							}
						})

			  	</script>';
			}
		}

	}

        static public function ctrMostrarSumaVentas(){

                $tabla = "repuestos";

                $respuesta = ModeloRepuestos::mdlMostrarSumaVentas($tabla);

                return $respuesta;

        }

}
