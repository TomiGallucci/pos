<?php

require_once "../controladores/repuestos.controlador.php";
require_once "../modelos/repuestos.modelo.php";

class AjaxRepuestos{




  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idRepuesto;
  public $traerRepuestos;
  public $nombreRepuesto;

  public function ajaxEditarRepuesto(){

      if($this->traerRepuestos == "ok"){

          $item = null;
          $valor = null;
          $orden = "id";

          $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);
          echo json_encode($respuesta);
      }elseif($this->nombreRepuesto != ""){

      $item = "descripcion";
      $valor = $this->nombreRepuesto;
      $orden = "id";

          $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);

      echo json_encode($respuesta);
      }else{
        
      $item = "id";
      $valor = $this->idRepuesto;
      $orden = "id";

      $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);

      echo json_encode($respuesta);

      }
  }
}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idRepuesto"])){

  $editarRepuesto = new AjaxRepuestos();
  $editarRepuesto -> idRepuesto = $_POST["idRepuesto"];
  $editarRepuesto -> ajaxEditarRepuesto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerRepuesto"])){

  $traerRepuestos = new AjaxRepuestos();
  $traerRepuestos -> traerRepuestos = $_POST["traerRepuesto"];
  $traerRepuestos -> ajaxEditarRepuesto();

}
/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreRepuesto"])){

  $nombreRepuesto = new AjaxRepuestos();
  $nombreRepuesto -> nombreRepuesto = $_POST["nombreRepuesto"];
  $nombreRepuesto -> ajaxEditarRepuesto();

}