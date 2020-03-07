<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered  dt-responsive tablaProductos" width="100%">
         
        <thead>
         
          <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Colores</th>
           <th>Precio de compra (USD)</th>
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
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  
                <select class="form-control input-lg text-uppercase" 
                id="nuevaCategoria" 
                name="nuevaCategoria" 
                                required
                >
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                  echo '<pre>'; print_r($categorias); echo '</pre>';

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option class="text-uppercase" value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>
              </div>

               
            </div>   

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

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

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                   
                  </div>
                   <div class="alert alert-warning">Ingrese valor en pesos</div>
                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>
               </div>

              </div>
                              <!-- CHECKBOX PARA PORCENTAJE -->
              <div class="form-group row" style="width: 100%">
                    

                        <div class="col-xs-12 col-sm-6">
                           <label>
                              
                              <input type="checkbox" class="minimal porcentaje" checked>
                              Ganancia en porcentaje
                            </label>
                          
                          <div class="input-group">
                            
                            <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                            <span class="input-group-addon" style="width: 38px"><i class="fa fa-percent"></i></span>

                          </div>

                        </div>
                          
                        <div class="col-xs-12 col-sm-6">
                            
                            <label>
                              <input type="checkbox" class="minimal dolar" checked>
                              Valor del dolar
                            </label>
                        
                          <div class="input-group">
                            
                            <input type="number" class="form-control input-lg nuevoDolar" min="0"step="0.01" value="83.50" required>

                            <span class="input-group-addon" style="width: 38px"><i class="fa fa-usd" ></i></span>

                          </div>

                        </div>

              

              </div>

             <!-- ENTRADA PARA EL COLOR -->
             
              <div class="form-group row">
                 <div class="col-xs-12 col-sm-6">
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-tint"></i></span> 

                      <input type="text" class="form-control input-lg" id="nuevoColor" name="nuevoColor" placeholder="Ingresar colores">
                    
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">

                        <div class="form-group">  

                          <div class="input-group row">

                                 <div class="col-xs-12 colors">     
                                 </div>           
                                 <input type="hidden" name="colores" class="listaColores">
                             

                            </div>

                  
                        </div>
                      

                    </div>      
                  </div>  
                   <!-- ENTRADA PARA SUBIR FOTO -->

               <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 5MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>          
            </div>
            
           

          </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg text-uppercase"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>
                         <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                   
                  </div>
                   <div class="alert alert-warning">Ingrese valor en pesos</div>
                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>
               </div>

              </div>
                              <!-- PARA PORCENTAJE -->
              <div class="form-group row" style="width: 100%">
                    

                        <div class="col-xs-12 col-sm-6">
                           <label>
                              
                              <input type="checkbox" class="minimal porcentaje" checked>
                              Ganancia en porcentaje
                            </label>
                          
                          <div class="input-group">
                            
                            <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                            <span class="input-group-addon" style="width: 38px"><i class="fa fa-percent"></i></span>

                          </div>

                        </div>
                          
                        <div class="col-xs-12 col-sm-6">
                            
                            <label>
                              <input type="checkbox" class="minimal dolar" checked>
                              Valor del dolar
                            </label>
                        
                          <div class="input-group">
                            
                            <input type="number" class="form-control input-lg nuevoDolar" min="0"step="0.01" value="83.50" required>

                            <span class="input-group-addon" style="width: 38px"><i class="fa fa-usd" ></i></span>

                          </div>

                        </div>

              

              </div>

             <!-- ENTRADA PARA EL COLOR -->
             
              <div class="form-group row">
                 <div class="col-xs-12 col-sm-6">
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-tint"></i></span> 

                      <input type="text" class="form-control input-lg" id="editColor" name="editColor">
                    
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">

                        <div class="form-group">  

                          <div class="input-group row">

                                 <div class="col-xs-12 color">     
                                 </div>           
                                 <input type="hidden" name="colores" class="listaColores">
                                    

                            </div>

                  
                        </div>
                      

                    </div>      
                  </div>  



            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 5MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

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

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      



