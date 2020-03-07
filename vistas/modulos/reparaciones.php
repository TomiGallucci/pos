<?php
if($_SESSION["perfil"] == "Usuario"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar reparaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar reparaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-reparacion">

          <button class="btn btn-primary">
            
            Agregar reparacion

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered dt-responsive text-center tablaReparaciones" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código reparacion</th>
           <th>Imagenes</th>
           <th>Cliente</th>
           <th>N° modelo</th>
           <th>Descripcion</th>
           <th>Tipo clave</th>
           <th>Desbloqueo</th>
           <th>Estado</th>
           <th>Impuesto</th> 
           <th>Costo reparacion</th> 
           <th>Precio Neto</th> 
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody class="text-uppercase"></tbody>

       </table>

      <?php

      $eliminarVenta = new ControladorReparaciones();
      $eliminarVenta -> ctrBorrarReparacion();

      ?> 
       

      </div>

    </div>

  </section>

</div>




