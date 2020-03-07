<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){
			echo '<script> console.log("entro") </script>';

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDni"])){
			echo '<script> console.log("entro") </script>';
				
					if($_POST["nuevoCelular"] != null){
						$celular = $_POST["nuevoCelular"];
					}else {
						$celular = "";
					}
			echo '<script> console.log("entro") </script>';

        	$tabla = "clientes";
				$datos = array("nombre" => $_POST["nuevoCliente"],
							   "documento" =>$_POST["nuevoDni"],
							   "email" => $_POST["nuevoEmail"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "celular" => $celular,
							   "direccion" => $_POST["nuevaDireccion"],
							   "fecha_nacimiento" =>$_POST["nuevaFecha"]);

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla,$datos);
				
					if($respuesta == "ok"){
			echo '<script> console.log("entro") </script>';

						echo'<script>

							swal({
								  type: "success",
								  title: "El cliente ha sido guardado correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
											if (result.value) {

											window.location = "clientes";

											}
										})

							</script>';

					}else{
			echo '<script> console.log("entro") </script>';

					echo'<script>

						swal({
							  type: "error",
							  title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				  	</script>';
				}		
			}


		}

	}

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrEditarCliente(){


		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCliente"])){
				
				if($_POST["editCelular"] != null){

					$celular = $_POST["editCelular"];

				}else {

					$celular = "";

				}

			$tabla = "clientes";
			$datos = array("nombre" => $_POST["editCliente"],
						   "documento" =>$_POST["editDni"],
						   "email" => $_POST["editEmail"],
						   "telefono" => $_POST["editTelefono"],
						   "celular" => $celular,
						   "direccion" => $_POST["editDireccion"],
						   "fecha_nacimiento" =>$_POST["editFecha"]);

			$respuesta = ModeloClientes::mdlEditarCliente($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido editado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}
		}	
	}


	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}
}