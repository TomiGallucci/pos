<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear reparacion
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear reparacion</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioReparacion" enctype="multipart/form-data">
 
          <div class="box-body">

          <!--=====================================
            ENTRADA DEL CÓDIGO
            ======================================--> 


              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>

                  <?php

                  $item = null;
                  $valor = null;
                  $orden = "id";

                  $reparacion = ControladorReparaciones::ctrMostrarReparacion($item, $valor,$orden);



                    if(!$reparacion){

                        echo '<input type="text" class="form-control" id="nuevaReparacion" name="nuevaReparacion" value="0001" readonly>';
                  

                    }else{

                      foreach ($reparacion as $key => $value) {
                        
                        
                      
                      }

                      if($value["codigo"] <10){
                        $codigo = '0000'.($value["codigo"]+1);
                      }elseif($value["codigo"] < 100){
                        $codigo = '000'.($value["codigo"]+1);
                      }elseif($value["codigo"] < 1000){
                        $codigo = '00'.($value["codigo"]+1);
                      }elseif($value["codigo"] < 10000){
                        $codigo = '0'.($value["codigo"]+1);
                      }else{
                        $codigo = ($value["codigo"]+1);
                      } 


                      echo '<input type="text" class="form-control" id="nuevaReparacion" name="nuevaReparacion" value="'.$codigo.'" readonly>';
                    }

                  ?>
                  
                  
                </div>
              
              </div>
            <!-- ENTRADA PARA EL CLIENTE -->
            
               <div class="form-group">   

                 <div class="input-group">
                     
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;
        

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarClientes" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
          
              </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clipboard"></i></span> 

                <textarea name="nuevaDescripcion" id="nuevaDescripcion" cols="50" rows="2" style="width: 100%" placeholder="Ingrese problema del dispositivo.."></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar modelo del procucto" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group row">
              
              <div class="col-xs-6">
                 <div class="input-group">
              
                  <span class="input-group-addon"><ion-icon name="md-keypad"></ion-icon></span> 
                  
                  

                  <select class="form-control input-lg" name="nuevoPatron">
                    
                    <option value="">Selecionar tipo de patron</option>

                    <option value="Patron">Patron</option>

                    <option value="Pin">Pin</option>

                    <option value="Contraseña">Contraseña</option>

                  </select>

                </div>

              </div>
              <div class="col-xs-6">
                 <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoDesbloqueo" placeholder="Ingresar desbloqueo" required>

                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group">

              
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado">
                    
                    <option value="">Selecionar estado</option>

                    <option value="Recibido">Recibido</option>

                    <option value="Reparando">Reparando</option>

                    <option value="Terminado">Terminado</option>

                  </select>

                </div>

            </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

              <div class="form-group row nuevoRepuesto"></div>

              <input type="hidden" id="listaRepuesto" name="listaRepuesto">

              <!--=====================================
              BOTÓN PARA AGREGAR PRODUCTO
              ======================================-->

              <button type="button" class="btn btn-default hidden-lg btnAgregarRepuesto">Agregar repuestos</button>

              <hr>
            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 9MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>      
            <div class="row">

              <!--=====================================
              ENTRADA IMPUESTOS Y TOTAL
              ======================================-->
              
              <div class="col-xs-12">
                
                <table class="table">

                  <tbody>
                  
                    <tr>
                      
                      <td style="width: 49%">
                        <div class="bold navbar-text pull-right">Impuesto: </div>
                      </td>
                      <td style="width: 49%">
                        
                        <div class="input-group">
                       
                          <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoReparacion" name="nuevoImpuestoReparacion" placeholder="0">

                           <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuestoReparacion" required>

                           <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNetoReparacion" required>

                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td style="width: 49%">     
                        <div class="bold navbar-text pull-right">Mano de obra: </div>                       
                      </td>
                      <td style="width: 49%">
                          
                        <div class="input-group">
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="nuevoCostodeReparacion" total="" placeholder="00000" required>

                          <input type="hidden" name="nuevoCostodeReparacion" id="nuevoCostoRep">
                          
                    
                        </div>

                      </td>
                    </tr>
                     <tr>

                      <td style="width: 49%"><div class="bold navbar-text pull-right">Total: </div></td>

                      <td style="width: 49%;">
                        
                        <div class="input-group">
                       
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="nuevoTotalReparacion" name="nuevoTotalReparacion" total="" placeholder="00000" readonly required>

                          <input type="hidden" name="totalReparacion" id="totalReparacion">
                          
                    
                        </div>

                      </td>

                    </tr>

                 </tbody>

                </table>

              </div>

            </div>

            <hr>

            <!--=====================================
            ENTRADA MÉTODO DE PAGO
            ======================================-->

            <div class="form-group row">
              
              <div class="col-xs-6" style="padding-right:0px">
                
                 <div class="input-group">
              
                  <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                    <option value="">Seleccione método de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="TC">Tarjeta Crédito</option>
                    <option value="TD">Tarjeta Débito</option>                  
                  </select>    

                </div>

              </div>

              <div class="cajasMetodoPago"></div>

              <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

            </div>

            <br>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar reparacion</button>

            </div>

          </form>

          <?php 
            $guardarReparacion = new ControladorReparaciones();
            $guardarReparacion -> ctrCrearReparacion();
           ?>
          </div>
              
        </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
  
            <table class="table table-bordered dt-responsive tablaRepuestos1">
              
               <thead>

                 <tr>
                   <th style="width:10px">#</th>
                   <th>Imagen</th>
                   <th>Código</th>
                   <th>Descripción</th>
                   <th>Categoría</th>
                   <th>Stock</th>
                   <th>Precio de venta</th>
                   <th>Acciones</th>                                                     
                </tr>
            


              </thead>
              <tbody class="text-uppercase"></tbody>
      
            </table>
                           <span class ="input-group-addon"><button type="button" class="btn btn-default btn-lg pull-left shadown" data-toggle="modal" data-target="#modalAgregarRepuesto" data-dismiss="modal">Agregar Repuesto</button></span>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarClientes" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Clientes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDni" placeholder="Ingresar DNI" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="(1111) 111-1111 (telefono)" data-inputmask="'mask':'(9999) 999-9999'" data-mask required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="(1111) 111-111111 (celular opcional)" data-inputmask="'mask':'(9999) 999-999999'" data-mask >

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFecha" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>
      <?php 
        $crearClientes = new ControladorClientes();
        $crearClientes -> ctrCrearCliente();
      ?>
    </div>

  </div>

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




                    if(!$repuesto){


                       echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoRepuesto" value="1" readonly>';
                    

                    }else{

                      foreach ($repuesto as $key => $value) {
                        
                       
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoRepuesto" value="'.$codigo.'" readonly>';
                  

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

                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompraRepuesto" min="0" precioreal placeholder="Precio de compra" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoPrecioReparacion" id="nuevoPrecioReparacionRepuesto" min="0" placeholder="Precio de venta" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje asd" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="2" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" name="nuevaImagen">

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
