    <?php

$item = null;
$valor = null;
$orden = "id";

$Repuestos = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);

 ?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Repuestos recientemente agregados</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php
    count($Repuestos) < 8 ? $contador = count($Repuestos) : $contador = 8;
    for($i = 0; $i < $contador; $i++){

      echo '<li class="item">

        <div class="product-img">

          <img src="'.$Repuestos[$i]["imagen"].'" alt="Product Image">

        </div>

        <div class="product-info">

          <a href="" class="product-title">

            '.$Repuestos[$i]["descripcion"].'

            <span class="label label-warning pull-right" style="font-size: 18px">$'.$Repuestos[$i]["precio_venta"].'</span>

          </a>
    
       </div>

      </li>';

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="repuestos" class="uppercase">Ver todos los Repuestos</a>
  
  </div>

</div>
