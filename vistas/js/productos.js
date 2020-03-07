$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
  	"retrieve": true,
  	"processing": true,
  	 "language": {

  			"sProcessing":     "Procesando...",
  			"sLengthMenu":     "Mostrar _MENU_ registros",
  			"sZeroRecords":    "No se encontraron resultados",
  			"sEmptyTable":     "Ningún dato disponible en esta tabla",
  			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
  			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
  			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  			"sInfoPostFix":    "",
  			"sSearch":         "Buscar:",
  			"sUrl":            "",
  			"sInfoThousands":  ",",
  			"sLoadingRecords": "Cargando...",
  			"oPaginate": {
  			"sFirst":    "Primero",
  			"sLast":     "Último",
  			"sNext":     "Siguiente",
  			"sPrevious": "Anterior"
  			},
  			"oAria": {
  				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
  				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
  			}

  	}

} );

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
  	datos.append("idCategoria", idCategoria);

  	$.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


      	if(!respuesta){

      		var nuevoCodigo = idCategoria+"01";
      		$("#nuevoCodigo").val(nuevoCodigo);

      	}else{

      		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
          	$("#nuevoCodigo").val(nuevoCodigo);

      	}
                
      }

  	})

})

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
  var a = document.getElementsByClassName('alert-warning');
  $(a).remove();

  var valorPorcentaje = $(this).val();
  var nuevoPorcentaje = $('.nuevoPorcentaje').val();

  if($(".porcentaje").prop("checked")){



    if($(".dolar").prop("checked")){


      var valorDolar = $(".nuevoDolar").val();

      var dolar = Number((valorPorcentaje*valorDolar));


      var porcentaje = Number((dolar*nuevoPorcentaje/100)+dolar);


      var editarPorcentaje = Number((dolar*nuevoPorcentaje/100))+dolar;


    }else {



      var porcentaje = Number((valorPorcentaje*nuevoPorcentaje/100))+Number($("#nuevoPrecioCompra").val());



      var editarPorcentaje = Number(($("#editarPrecioCompra").val()*nuevoPorcentaje/100))+Number($("#editarPrecioCompra").val());
      

    }


		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}else{

      if($(".dolar").prop("checked")){


      var valorDolar = $(".nuevoDolar").val();

      var dolar = Number((valorPorcentaje*valorDolar));


      var porcentaje = dolar;


      var editarPorcentaje = dolar;


    }

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);
  }

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

  var a = $('.nuevoPorcentaje').val();
  var b = $('.nuevoDolar').val();

	if($(".porcentaje").prop("checked")){
    

    if($(".dolar").prop("checked")){

      var dolar = Number(($("#nuevoPrecioCompra").val()*b));

      var porcentaje = Number((dolar*a/100))+dolar;
      var editarPorcentaje = Number((dolar*a/100))+dolar;

    }else {

      var porcentaje = Number(($("#nuevoPrecioCompra").val()*a/100))+Number($("#nuevoPrecioCompra").val());
      var editarPorcentaje = Number(($("#editarPrecioCompra").val()*a/100))+Number($("#editarPrecioCompra").val());

    }


		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})
/*=============================================
CAMBIO DE DOLAR
=============================================*/
$(".nuevoDolar").change(function(){

  var a = $('.nuevoPorcentaje').val();
  var b = $('.nuevoDolar').val();

  if($(".porcentaje").prop("checked")){
    

    if($(".dolar").prop("checked")){
      
      var valorPorcentaje = $(this).val();
    
      var dolar = Number(($("#nuevoPrecioCompra").val()*b));

      var porcentaje = Number((dolar*a/100))+dolar;
      var editarPorcentaje = Number((dolar*a/100))+dolar;

    }else {

      var valorPorcentaje = $(this).val();
      var porcentaje = Number(($("#nuevoPrecioCompra").val()*a/100))+Number($("#nuevoPrecioCompra").val());
      var editarPorcentaje = Number(($("#editarPrecioCompra").val()*a/100))+Number($("#editarPrecioCompra").val());

    }


    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }

})
$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 5000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 5MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(a){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",a["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
               
                  
                  $("#editarCategoria").val(respuesta["id"]).html(respuesta["categoria"]);

              }

          })
    
           $("#editarCodigo").val(a["codigo"]);

           $("#editarDescripcion").val(a["descripcion"]);

           $("#editarStock").val(a["stock"]);

           $("#editarPrecioCompra").val(a["precio_compra"]);

           $("#editarPrecioVenta").val(a["precio_venta"]);

           if(a["imagen"] != ""){

           	$("#imagenActual").val(a["imagen"]);

           	$(".previsualizar").attr("src",  a["imagen"]);

           }
          let b = JSON.parse(a["colores"]);

          for(i=0; i< b.length; i++){
            $('.color').append(`<a class="btn btn-primary btn-lg nuevoColor" role="button" style="padding: 3px" color="${b[i].color}">${b[i].color} <i class="fa fa-times remove" style="color: red;"></i></a>`);
          }
          listarColores()

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
	
	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result){
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})
/*=============================================
AGARRO LOS COLORES
=============================================*/
var obj = [];
$("#nuevoColor").change(function(){
  var color = $('#nuevoColor').val();

  $('.colors').append(`<a class="btn btn-primary btn-lg nuevoColor" role="button" style="padding: 3px" color="${color}">${color} <i class="fa fa-times remove" style="color: red;"></i></a>`);
  $("#nuevoColor").val('');
  listarColores()
})

$("#editColor").change(function(){
  var color = $('#editColor').val();

  $('.color').append(`<a class="btn btn-primary btn-lg nuevoColor" role="button" style="padding: 3px" color="${color}">${color} <i class="fa fa-times remove" style="color: red;"></i></a>`);
  $("#editColor").val('');
   listarColores()
})

$(document).on('click', '.remove', function() {

  var a = $(this).parent().html();
  value = a.split(" ");


   $(this).parent().remove();
  listarColores()

})
function listarColores(){

  var listaColores = [];

  var colores = $(".nuevoColor");

  for(var i = 0; i < colores.length; i++){


    listaColores.push({ "id" : i, 
                "color" : $(colores[i]).attr("color")
                })


  
  }

   $(".listaColores").val(JSON.stringify(listaColores)); 

}
