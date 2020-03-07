<?php

require_once "../controladores/reparaciones.controlador.php";
require_once "../modelos/reparaciones.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaRepuestos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRepuestos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$reparaciones = ControladorReparaciones::ctrMostrarReparacion($item, $valor, $orden);
 		
  		if(count($reparaciones) == 0){

  			echo '{"data": []}';

		  	return;
  		}	

   
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($reparaciones); $i++){


           if($reparaciones[$i]["codigo"] < 10){
             $codigo = '000'.$reparaciones[$i]["codigo"];
           }elseif ($reparaciones[$i]["codigo"] < 100){
            $codigo = '00'.$reparaciones[$i]["codigo"];
           }else{
            $codigo = $reparaciones[$i]["codigo"];
           }

            /*=============================================
            TRAEMOS LA CATEGORIA
            =============================================*/ 

            $item = "id";
            $value = $reparaciones[$i]["id_cliente"];

            $clientes = ControladorClientes::ctrMostrarClientes($item,$value);

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$reparaciones[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

                    

            $button =  "<div class='btn-group'><button class='btn btn-info btnImprimirRecibo' codigoReparacion='".$reparaciones[$i]["codigo"]."'><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditarReparacion' idReparacion='".$reparaciones[$i]["id"]."'><i class='fa fa-pencil'></i></button> <button class='btn btn-danger btnEliminarReparacion' idReparacion='".$reparaciones[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
                  "'.$codigo.'",
			      "'.$imagen.'",
                  "'.$clientes["nombre"].'",                  
			      "'.$reparaciones[$i]["modelo"].'",
			      "'.$reparaciones[$i]["descripcion"].'",
                  "'.$reparaciones[$i]["tipo_clave"].'",
                  "'.$reparaciones[$i]["desbloqueo"].'",
                  "'.$reparaciones[$i]["estado"].'",
                  "'.number_format($reparaciones[$i]["impuesto"],2).'",                  
                  "'.number_format($reparaciones[$i]["costoRep"],2).'",                  
                  "'.number_format($reparaciones[$i]["precioNeto"],2).'",                  
                  "'.number_format($reparaciones[$i]["total"],2).'",          
                  "'.$reparaciones[$i]["fecha"].'",
                  "'.$button.'"
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
$activarRepuetosReparacions = new TablaRepuestos();
$activarRepuetosReparacions -> mostrarTablaRepuestos();

