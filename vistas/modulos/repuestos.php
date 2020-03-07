<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar repuestos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar repuestos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRepuesto">
          
          Agregar repuesto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered  dt-responsive tablaRepuestos">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>
           <th>Agregado</th>
           <th>Acciones</th>

         </tr> 

        </thead>
        <tbody class="text-uppercase"></tbody>

      </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR REPUESTO
======================================-->

<div id="modalAgregarRepuesto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar repuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                  <?php

                  $item = null;
                  $valor = null;
                  $orden = "id";

                  $repuesto = ControladorRepuestos::ctrMostrarRepuestos($item, $valor,$orden);

                  if($repuesto){

                      foreach ($repuesto as $key => $value) {
                        
                       
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoRepuesto" value="'.$codigo.'" readonly>';
                  

                    }else{
                           

                        echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoRepuesto" value="1" readonly>';
                    

                    }


                  ?>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar nombre de repuesto" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-l text-uppercase" name="nuevaCategoria">
                  
                  <option value="">Selecionar repuesto de ..</option>

       
                    <?php

                      $item = null;
                      $valor = null;
        

                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                       }

                    ?>

                </select>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompraRepuesto" min="0" step="0.01" precioreal placeholder="Precio de compra" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" id="nuevoPrecioVentaRepuesto" min="0" step="0.01" placeholder="Precio de venta" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentajeRepuesto" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg" id="nuevoPorcentajeRepuesto" min="0" value="2" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 5MB</p>

              <img src="vistas/img/repuestos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar repuesto</button>

        </div>

      </form>

      <?php 

        $crearRepuesto = new ControladorRepuestos();
        $crearRepuesto-> ctrCrearRepuestos();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR REPUESTO
======================================-->

<div id="modalEditarRepuesto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar repuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control" id="editarCodigo" name="editarRepuesto" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-l text-uppercase" name="editarCategoria" >
                  
                  <option id="editarCategoria">Selecionar repuesto de ..</option>

       
                    <?php

                      $item = null;
                      $valor = null;
        

                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                       }

                    ?>

                </select>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock"  min="0" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarPrecioCompra" id="editarPrecioCompraRepuesto" step="0.01" min="0" precioreal required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarPrecioVenta" id="editarPrecioVentaRepuesto" min="0" step="0.01" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentajeRepuesto" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg" id="editarPorcentajeRepuesto" min="0" value="2" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="editarImagen" name="editarImagen" class="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 5MB</p>

              <img src="vistas/img/repuestos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" id="actualFoto" name="actualFoto">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php 

        $editarRepuesto = new ControladorRepuestos();
        $editarRepuesto-> ctrEditarRepuestos();

      ?>

    </div>

  </div>

</div>

<?php 

  $borrarRepuesto = new ControladorRepuestos();
  $borrarRepuesto-> ctrBorrarRepuestos();

 ?>
