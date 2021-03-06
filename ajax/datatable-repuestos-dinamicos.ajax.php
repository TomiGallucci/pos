<?php

require_once "../controladores/repuestos.controlador.php";
require_once "../modelos/repuestos.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaRepuestos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRepuestos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$repuestos = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);
 		
  		if(count($repuestos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($repuestos); $i++){

            /*=============================================
            TRAEMOS LA CATEGORIA
            =============================================*/ 

            $item = "id";
            $value = $repuestos[$i]["id_categoria"];

            $categoria = ControladorCategorias::ctrMostrarCategorias($item,$value);

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$repuestos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($repuestos[$i]["stock"] <= 3){

  				$stock = "<button class='btn btn-danger'>".$repuestos[$i]["stock"]."</button>";

  			}else if($repuestos[$i]["stock"] > 3 && $repuestos[$i]["stock"] <= 5){

  				$stock = "<button class='btn btn-warning'>".$repuestos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$repuestos[$i]["stock"]."</button>";

  			}
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
           $botones =  "<div class='btn-group'><button class='btn btn-primary AgregarRepuesto recuperarBoton' idRepuesto='".$repuestos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$repuestos[$i]["codigo"].'",
			      "'.$repuestos[$i]["descripcion"].'",
                  "'.$categoria["categoria"].'",
			      "'.$stock.'",
                  "'.$repuestos[$i]["precio_venta"].'",
                  "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarRepuetosVentas = new TablaRepuestos();
$activarRepuetosVentas -> mostrarTablaRepuestos();

