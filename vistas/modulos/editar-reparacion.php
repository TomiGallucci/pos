
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar venta</li>
    
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

          <form role="form" method="post" class="formularioReparacion">

            <div class="box-body">
  
          <!--=====================================
            ENTRADA DEL CÓDIGO
            ======================================--> 


              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <?php

                  $item = "id";
                  $valor = $_GET["idReparacion"];
                  $orden = "id";

                  $reparacion = ControladorReparaciones::ctrMostrarReparacion($item, $valor, $orden);
                  $impuesto = number_format($reparacion["impuesto"] * 100/$reparacion["precioNeto"]);
                     $item = "id";
                      $valor = $reparacion["id_cliente"];

                      $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                  ?>
                  <input type="text" class="form-control" id="editarReparacion" name="editarReparacion" value="<?php echo $reparacion["codigo"]; ?>" readonly>
                  
                </div>
              
              </div>
            <!-- ENTRADA PARA EL CLIENTE -->
            
               <div class="form-group">   

                 <div class="input-group">
                     
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

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

                <textarea name="editarDescripcion" id="editarDescripcion" cols="110" rows="2"><?php echo $reparacion["descripcion"]; ?></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo" value="<?php echo $reparacion["modelo"] ?>" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group row">
              
              <div class="col-xs-6">
                 <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  
                  

                  <select class="form-control input-lg" name="editarPatron">
                    
                    <option value="<?php echo $reparacion["tipo_clave"]; ?>"><?php echo $reparacion["tipo_clave"]; ?></option>

                    <option value="Patron">Patron</option>

                    <option value="Pin">Pin</option>

                    <option value="Contraseña">Contraseña</option>

                  </select>

                </div>

              </div>
              <div class="col-xs-6">
                 <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                  <input type="text" class="form-control input-lg" name="editarDesbloqueo" value="<?php echo $reparacion["desbloqueo"]; ?>" required>

                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group">

              
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 

                  <select class="form-control input-lg" name="editarEstado">
                    
                    <option value="<?php echo $reparacion["estado"]; ?>"><?php echo $reparacion["estado"]; ?></option>

                    <option value="Recibido">Recibido</option>

                    <option value="Reparando">Reparando</option>

                    <option value="Terminado">Terminado</option>

                  </select>

                </div>
            </div>
                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoRepuesto">

                <?php

                $listaRepuesto = json_decode($reparacion["productos"], true);

                foreach ($listaRepuesto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor, $orden);
                  

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-xs-6" style="padding-right:0px">
            
                          <div class="input-group">
                
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRepuesto" idRepuesto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionRepuesto" idRepuesto="'.$value["id"].'" name="agregarRepuesto" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>

                        <div class="col-xs-3">
              
                          <input type="number" class="form-control nuevaCantidadRepuesto" name="nuevaCantidadRepuesto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                        </div>

                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioRepuesto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioRepuesto" value="'.$value["total"].'" readonly required>
   
                          </div>
               
                        </div>

                      </div>';
                }


                ?>

                </div>

                <input type="hidden" id="listaRepuesto" name="listaRepuestos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarRepuesto">Agregar producto</button>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
                 
                 <div class="panel">SUBIR FOTO</div>

                 <input type="file" class="nuevaFoto" name="nuevaFoto">

                 <p class="help-block">Peso máximo de la foto 9MB</p>

                 <img src="<?php echo $reparacion["imagen"] ?>" class="img-thumbnail previsualizar" width="100px">
                 <input type="hidden" name="fotoActual" value="<?php echo $reparacion["imagen"] ?>">

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
                       
                          <input type="number" class="form-control input-lg" min="0"  id="editarImpuestoReparacion" name="editarImpuestoReparacion" value="<?php echo $impuesto ?>">

                           <input type="hidden" name="editarPrecioImpuesto" value="<?php echo $reparacion["impuesto"] ?>" required>

                           <input type="hidden" name="editarPrecioNeto" value="<?php echo $reparacion["precioNeto"] ?>" required>

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

                          <input type="text" class="form-control input-lg" id="editarCostodeReparacion" value="<?php echo $reparacion["costoRep"] ?>" required>

                          <input type="hidden" name="editarCostodeReparacion" id="editarCostodeRep" value="<?php echo $reparacion["costoRep"] ?>">
                          
                    
                        </div>

                      </td>
                    </tr>
                     <tr>

                      <td style="width: 49%"><div class="bold navbar-text pull-right">Total: </div></td>

                      <td style="width: 49%;">
                        
                        <div class="input-group">
                       
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="editarTotalReparacion" value="<?php echo $reparacion["total"] ?>" name="editarTotalReparacion" total="<?php echo $reparacion["precioNeto"] ?>"  readonly required>

                          <input type="hidden" name="totalReparacion" id="nuevoTotalReparacion" value="<?php echo $reparacion["total"] ?>">
                          
                    
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
            $guardarReparacion -> ctrEditarReparacion();

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
            
            <table class="table table-bordered table-striped dt-responsive tablaRepuestos1">
              
               <thead>

                 <tr>
                   <th style="width: 10px">#</th>
                   <th>Imagen</th>
                   <th>Código</th>
                   <th>Descripción</th>
                   <th>Categoría</th>
                   <th>Stock</th>
                   <th>Precio de venta</th>
                   <th>Acciones</th>        
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

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

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

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

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
