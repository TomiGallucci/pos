<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClientes">
          
          Agregar clientes

        </button>

      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>DNI</th>
           <th>Email</th>
           <th>Telefono</th>
           <th>Celular</th>
           <th>Direccion</th>
           <th>Fecha nacimiento</th>
           <th>Total compras</th>
           <th>Última compra</th>
           <th>Última arreglo</th>
           <th>Ingreso al sistema</th>      
           <th>Acciones</th>

         </tr> 

        </thead>
        <tbody>

        <?php

        $item = null;

        $valor = null;

        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
             foreach ($clientes as $key => $value) {

            echo "<tr>
                    <td>".$value['id']."</td>
                    <td>".$value['nombre']."</td>
                    <td>".$value['documento']."</td>
                    <td>".$value['email']."</td>
                    <td>".$value['telefono']."</td>
                    <td>".$value['celular']."</td>
                    <td>".$value['direccion']."</td>
                    <td>".$value['fecha_nacimiento']."</td>
                    <td>".$value['compras']."</td>
                    <td>".$value['ultima_compra']."</td>
                    <td>".$value['ultima_reparacion']."</td>
                    <td>".$value['fecha']."</td>
                    <td><div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$value["id"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$value["id"]."'><i class='fa fa-times'></i></button></div></td>
                  </tr>";

        }

        ?>
                 
        </tbody> 
      
       </table>

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
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Clientes</h4>

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

                <input type="text" class="form-control input-lg" name="editCliente" id="editCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editDni" id="editDni" readonly required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="editEmail" id="editEmail" placeholder="Ingresar email" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editTelefono" id="editTelefono" placeholder="(1111) 111-1111 (telefono)" data-inputmask="'mask':'(9999) 999-9999'" data-mask required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="editCelular" id="editCelular" placeholder="(1111) 111-111111 (celular opcional)" data-inputmask="'mask':'(9999) 999-999999'" data-mask >

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editDireccion" id="editDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editFecha" id="editFecha" required>

              </div>

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

          $editarCliente = new ControladorClientes();
          $editarCliente -> ctrEditarCliente();

        ?> 
    </div>

  </div>

</div>



<?php

  $borrarCliente = new ControladorClientes();
  $borrarCliente -> ctrBorrarCliente();

?> 


