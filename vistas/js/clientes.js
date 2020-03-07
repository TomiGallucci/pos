
/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){

  var idCliente = $(this).attr("idCliente");
  console.log("idCliente", idCliente);
  
  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({

    url:"ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      
      $("#editCliente").val(respuesta["nombre"]);
      $("#editEmail").val(respuesta["email"]);
      $("#editDni").val(respuesta["documento"]);
      $("#editTelefono").val(respuesta["telefono"]);
      $("#editCelular").val(respuesta["celular"]);
      $("#editDireccion").val(respuesta["direccion"]);
      $("#editFecha").val(respuesta["fecha_nacimiento"]);
    }

  });

})
/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

  var idCliente = $(this).attr("idCliente");
  console.log("idCliente", idCliente);

  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=clientes&idCliente="+idCliente;

    }

  })

})