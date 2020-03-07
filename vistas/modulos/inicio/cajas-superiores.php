<?php

$item = null;
$valor = null;
$orden = "id";

$ventas = ControladorVentas::ctrSumaTotalVentas();
$totalReparaciones = ControladorReparaciones::ctrSumaTotalVentas();



$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$repuestos = ControladorRepuestos::ctrMostrarRepuestos($item,$valor,$orden);
$reparaciones = ControladorReparaciones::ctrMostrarReparacion($item,$valor,$orden);

$totalCategorias = count($categorias) + count($repuestos);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos) + count($repuestos);
$reparacion = count($reparaciones);
?>



<div class="col-md-2 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($ventas["total"],2); ?></h3>

      <p>Ventas en productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-md-2 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="categorias" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-md-2 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-md-2 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
<div class="col-md-2 col-xs-6">

  <div class="small-box bg-blue">
  
    <div class="inner">
    
      <h3>$<?php echo number_format($totalReparaciones["total"],2); ?></h3>

      <p>Ganancias en reparaciones</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="reparaciones" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
<div class="col-md-2 col-xs-6">

  <div class="small-box bg-gray">
    
    <div class="inner">
      
      <h3><?php echo number_format($reparacion); ?></h3>

      <p>Reparaciones</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-mobile"></i>
    
    </div>
    
    <a href="reparaciones" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>