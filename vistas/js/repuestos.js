
$('.tablaRepuestos1').DataTable( {
    "ajax": "ajax/datatable-repuestos-dinamicos.ajax.php",
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

});

$('.tablaRepuestos').DataTable( {
    "ajax": "ajax/datatable-repuestos.ajax.php",
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

});
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
$("#nuevoPrecioCompraRepuesto, #editarPrecioCompraRepuesto").change(function(){

   var nuevoCosto = $("#nuevoPrecioCompraRepuesto").val()
   var editarCosto = $("#editarPrecioCompraRepuesto").val()
   var nuevoPorcentaje = $('#nuevoPorcentajeRepuesto').val();
   console.log("nuevoPorcentaje", nuevoPorcentaje);
   var editarPorcentaje = $('#editarPorcentajeRepuesto').val();
   console.log("editarPorcentaje", editarPorcentaje);


   if($(".porcentajeRepuesto").prop("checked")){
         
         
     var nuevoValorConPorcentaje = Number((nuevoCosto*nuevoPorcentaje/100))+Number(nuevoCosto);
     
     var editarValorConPorcentaje = Number((editarCosto*editarPorcentaje/100))+Number(editarCosto);
     
     
     $("#nuevoPrecioVentaRepuesto").val(nuevoValorConPorcentaje);
     $("#nuevoPrecioVentaRepuesto").prop("readonly",true);
     
     $("#editarPrecioVentaRepuesto").val(editarValorConPorcentaje);
     $("#editarPrecioVentaRepuesto").prop("readonly",true);

     }else{


        var nuevoCosto = $("#nuevoPrecioCompraRepuesto").val()
        var editarCosto = $("#editarPrecioCompraRepuesto").val()

        $("#nuevoPrecioCompraRepuesto").val(nuevoCosto);
        $("#nuevoPrecioCompraRepuesto").prop("readonly",true);

        $("#editarPrecioCompraRepuesto").val(editarCosto);
        $("#editarPrecioCompraRepuesto").prop("readonly",true);
  }

 })

 /*=============================================
 CAMBIO DE PORCENTAJE
=============================================*/
$("#nuevoPorcentajeRepuesto, #editarPorcentajeRepuesto").change(function(){

    var nuevoPorcentaje = $('#nuevoPorcentajeRepuesto').val();
    var editarPorcentaje = $('#editarPorcentajeRepuesto').val();
    var nuevoCosto = $("#nuevoPrecioCompraRepuesto").val()
    var editarCosto = $("#editarPrecioCompraRepuesto").val()
        
    if($(".porcentajeRepuesto").prop("checked")){
        
        var nuevoValorConPorcentaje = Number(nuevoCosto*nuevoPorcentaje/100)+Number(nuevoCosto);
        
        var editarValorConPorcentaje = Number(editarCosto*editarPorcentaje/100)+Number(editarCosto);
        
        $("#nuevoPrecioVentaRepuesto").val(nuevoValorConPorcentaje);
        $("#nuevoPrecioVentaRepuesto").prop("readonly",true);
        
        $("#editarPrecioVentaRepuesto").val(editarValorConPorcentaje);
        $("#editarPrecioVentaRepuesto").prop("readonly",true);
        
    }
        
})
    
$('.tablaRepuestos tbody').on('click', "button.btnEditarRepuesto", function(){

    idRepuesto = $(this).attr('idRepuesto')

    var datos = new FormData();
        datos.append('idRepuesto',idRepuesto);

    $.ajax({
        url: "ajax/repuestos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            a = respuesta["id_categoria"];

            var datos1 = new FormData();
                datos1.append('idCategoria', a);
              $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "POST",
                data: datos1,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                    success:function(respuesta1){ 
          
                   $("#editarCodigo").val(respuesta["codigo"]);
                   $("#editarDescripcion").val(respuesta["descripcion"]);
                   $("#editarCategoria").val(respuesta1["id"]).html(respuesta1["categoria"]);
                   $("#editarStock").val(respuesta["stock"]);
                   $("#editarPrecioCompraRepuesto").val(respuesta["precio_compra"]);
                   $("#editarPrecioVentaRepuesto").val(respuesta["precio_venta"]);
                   $('.previsualizar').attr('src', respuesta["imagen"]);
                   $('#actualFoto').val(respuesta["imagen"]);


                   }
               })
        }

    })

})
/*=============================================
ELIMINAR REPUESTO
=============================================*/

$(".tablaRepuestos tbody").on("click", "button.btnEliminarRepuesto", function(){

    var idRepuesto = $(this).attr("idRepuesto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    
    swal({

        title: '¿Está seguro de borrar el repuesto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=repuestos&idRepuesto="+idRepuesto+"&imagen="+imagen+"&codigo="+codigo;

        }


    })

})