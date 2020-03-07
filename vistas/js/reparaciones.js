$('.tablaReparaciones').DataTable( {
    "ajax": "ajax/datatable-reparaciones.ajax.php",
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

  	}else if(imagen["size"] > 9000000){

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
BORRAR VENTA
=============================================*/
$(".tablaReparaciones").on("click", ".btnBorrarReparacion", function(){

  var idReparacion = $(this).attr("idReparacion");

  swal({
        title: '¿Está seguro de borrar la reparacion?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar reparacion!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=reparaciones&idReparacion="+idReparacion;
        }

  })

})

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablaReparaciones").on("click", ".btnEditarReparacion", function(){

	var idReparacion = $(this).attr("idReparacion");

	window.location = "index.php?ruta=editar-reparacion&idReparacion="+idReparacion;


})
$(".formularioReparacion").on("change", "input.editarCosto", function(){

	var efectivo = $(this).val();


})

$(".nuevoCosto").number(true,2);
$(".editarCosto").number(true, 2);
/*=============================================
BORRAR VENTA
=============================================*/
$(".tablaReparaciones").on("click", ".btnEliminarReparacion", function(){

  var idReparacion = $(this).attr("idReparacion");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=reparaciones&idReparacion="+idReparacion;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablaReparaciones").on("click", ".btnImprimirFactura", function(){

    var codigoReparacion = $(this).attr("codigoReparacion");

    window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoReparacion, "_blank");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(2, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=reparaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

    var texto = $(this).attr("data-range-key");

    if(texto == "Hoy"){

        var d = new Date();
        
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();

        if(mes < 10){

            var fechaInicial = año+"-0"+mes+"-"+dia;
            var fechaFinal = año+"-0"+mes+"-"+(dia+1);

        }else if(dia < 10){

            var fechaInicial = año+"-"+mes+"-0"+dia;
            var fechaFinal = año+"-"+mes+"-0"+(dia+1);

        }else if(mes < 10 && dia < 10){

            var fechaInicial = año+"-0"+mes+"-0"+dia;
            var fechaFinal = año+"-0"+mes+"-0"+(dia+1);

        }
    }else if (texto == "Ayer"){

        var d = new Date();
        
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();
        var diaAnterior = Number(dia - 1);

        if(mes < 10){

            var fechaInicial = año+"-0"+mes+"-"+diaAnterior;
            console.log("fechaInicial", fechaInicial);
            var fechaFinal = año+"-0"+mes+"-"+dia;

        }else if(dia < 10){

            var fechaInicial = año+"-"+mes+"-0"+diaAnterior;

            var fechaFinal = año+"-"+mes+"-0"+dia;

        }else if(mes < 10 && dia < 10){

            var fechaInicial = año+"-0"+mes+"-0"+diaAnterior;

            var fechaFinal = año+"-0"+mes+"-0"+dia;

        }else{

            var fechaInicial = año+"-"+mes+"-"+diaAnterior;
            var fechaFinal = año+"-"+mes+"-"+dia;

        }   

    }

        localStorage.setItem("capturarRango", texto);

        window.location = "index.php?ruta=reparaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
})

function listarMetodos(){

  var listaMetodos = "";

  if($("#nuevoMetodoPago").val() == "Efectivo"){

    $("#listaMetodoPago").val("Efectivo");

  }else{

    $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

  }

}
/*=============================================

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarReparacion", function(){

    var idReparacion = $(this).attr("idReparacion");

    window.location = "index.php?ruta=editar-venta&idReparacion="+idReparacion;


})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarRepuesto(){

    //Capturamos todos los id de productos que fueron elegidos en la venta
    var idRepuestos = $(".quitarRepuesto");

    //Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTabla = $(".tablaRepuestos1 tbody button.AgregarRepuesto");


    //Recorremos en un ciclo para obtener los diferentes idRepuestos que fueron agregados a la venta
    for(var i = 0; i < idRepuestos.length; i++){

        //Capturamos los Id de los productos agregados a la venta
        var boton = $(idRepuestos[i]).attr("idRepuesto");
        
        //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
        for(var j = 0; j < botonesTabla.length; j ++){

            if($(botonesTabla[j]).attr("idRepuesto") == boton){

                $(botonesTabla[j]).removeClass("btn-primary AgregarRepuesto");
                $(botonesTabla[j]).addClass("btn-default");

            }
        }

    }
    
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaRepuestos1').on( 'draw.dt', function(){

    quitarAgregarRepuesto();

})
/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarRepuestos(){

    var listaRepuestos = [];

    var descripcion = $(".nuevaDescripcionRepuesto");

    var cantidad = $(".nuevaCantidadRepuesto");

    var precio = $(".nuevoPrecioRepuesto");

    for(var i = 0; i < descripcion.length; i++){

        listaRepuestos.push({ "id" : $(descripcion[i]).attr("idRepuesto"), 
                              "descripcion" : $(descripcion[i]).val(),
                              "cantidad" : $(cantidad[i]).val(),
                              "stock" : $(cantidad[i]).attr("nuevoStock"),
                              "precio" : $(precio[i]).attr("precioReal"),
                              "total" : $(precio[i]).val()})

    }

    $("#listaRepuesto").val(JSON.stringify(listaRepuestos)); 

}



/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioReparacion").on("change", "input#nuevoCodigoTransaccion", function(){

    // Listar método en la entrada
     listarMetodos()


})


/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioReparacion").on("change", "input#nuevoValorEfectivo", function(){

    var efectivo = $(this).val();

    var cambio =  Number(efectivo) - Number($('#nuevoTotalReparacion').val());
 

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
  
    nuevoCambioEfectivo.val(cambio);

})

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoReparacion(){

    var impuesto = $("#nuevoImpuestoReparacion").val();
    var precioTotal = $("#nuevoTotalReparacion").attr("total");


    var precioImpuesto = Number(precioTotal * impuesto/100);

    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

    
    $("#nuevoTotalReparacion").val(totalConImpuesto);

    $("#totalReparacion").val(totalConImpuesto);

    $("#nuevoPrecioImpuestoReparacion").val(precioImpuesto);

    $("#nuevoPrecioNetoReparacion").val(precioTotal);
  
}


/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoReparacion").change(function(){

    agregarImpuestoReparacion();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalReparacion").number(true, 2);

/*=============================================
ELIMINAR PRODUCTO
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
/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarRepuesto = [];

localStorage.removeItem("quitarRepuesto");

$(".formularioReparacion").on("click", "button.quitarRepuesto", function(){
  console.log('entro1');
    $(this).parent().parent().parent().parent().remove();

    var idRepuesto = $(this).attr("idRepuesto");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

    if(localStorage.getItem("quitarRepuesto") == null){

        idQuitarRepuesto = [];
    
    }else{

        idQuitarRepuesto.concat(localStorage.getItem("quitarRepuesto"))

    }

    idQuitarRepuesto.push({"idRepuesto":idRepuesto});

    localStorage.setItem("quitarRepuesto", JSON.stringify(idQuitarRepuesto));

    $("button.recuperarBoton[idRepuesto='"+idRepuesto+"']").removeClass('btn-default');

    $("button.recuperarBoton[idRepuesto='"+idRepuesto+"']").addClass('btn-primary AgregarRepuesto');

    if($(".nuevoRepuesto").children().length == 0){
        console.log('entro');
        $("#nuevoImpuestoReparacion").val(0);
        $("#nuevoTotalReparacion").val(0);
        $("#totalReparacion").val(0);
        $("#nuevoCostodeReparacion").val(0);
        $("#nuevoTotalReparacion").attr("total",0);
        $("#editarImpuestoReparacion").val(0);
        $("#editarCostodeReparacion").val(0);
        $("#editarTotalReparacion").val(0);
        $("#totalReparacion").val(0);
        $("#editarTotalReparacion").attr("total",0);

    }else{

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPreciosReparacion()

        // AGREGAR IMPUESTO
            
        agregarImpuestoReparacion()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarRepuestos()

    }

})

var numRepuesto = 0;

$(".formularioReparacion").on("click","button.btnAgregarRepuesto",function(){

    numRepuesto ++;

    var datos = new FormData();
    datos.append("traerRepuesto", "ok");

    $.ajax({

        url:"ajax/repuestos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                
         $(".nuevoRepuesto").append(
                '<div class="row" style="padding:5px 15px">'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+
                  
                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRepuesto" idRepuesto><i class="fa fa-times"></i></button></span>'+

                      '<select class="form-control nuevaDescripcionRepuesto" id="producto'+numRepuesto+'" idRepuesto name="nuevaDescripcionRepuesto" required>'+

                        '<option>Seleccione el producto</option>'+

                      '</select>'+  

                    '</div>'+

                  '</div>'+

                  '<div class="col-xs-3 ingresoCantidad">'+
                    
                     '<input type="number" class="form-control nuevaCantidadRepuesto" name="nuevaCantidadRepuesto" min="1" value="1" stock nuevoStock required>'+

                  '</div>' +

                  '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                         
                      '<input type="number" class="form-control nuevoPrecioRepuesto" precioReal="" min="1" name="nuevoPrecioRepuesto" readonly required>'+
         
                    '</div>'+
                     
                  '</div>'+

                '</div>');


            // AGREGAR LOS PRODUCTOS AL SELECT 

             respuesta.forEach(funcionForEach);

             function funcionForEach(item, index){

                if(item.stock != 0){

                    $("#producto"+numRepuesto).append(

                        '<option idRepuesto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
                    )

                 
                 }

                 

             }

             // SUMAR TOTAL DE PRECIOS

            sumarTotalPreciosReparacion()

            // AGREGAR IMPUESTO
            
            agregarImpuestoReparacion()

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            $(".nuevoPrecioRepuesto").number(true, 2);


        }

    })

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioReparacion").on("change", "select.nuevaDescripcionRepuesto", function(){

    var nombreRepuesto = $(this).val();

    var nuevaDescripcionRepuesto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionRepuesto");

    var nuevoPrecioRepuesto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioRepuesto");

    var nuevaCantidadRepuesto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadRepuesto");

    var datos = new FormData();
    datos.append("nombreRepuesto", nombreRepuesto);


      $.ajax({

        url:"ajax/repuestos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            $(nuevaDescripcionRepuesto).attr("idRepuesto", respuesta["id"]);
            $(nuevaCantidadRepuesto).attr("stock", respuesta["stock"]);
            $(nuevaCantidadRepuesto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoPrecioRepuesto).val(respuesta["precio_venta"]);
            $(nuevoPrecioRepuesto).attr("precioReal", respuesta["precio_venta"]);

          // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarRepuestos()

        }

      })
})


$(".tablaRepuestos1 tbody").on("click", ".AgregarRepuesto", function(){

    var idRepuesto = $(this).attr("idRepuesto");

    $(this).removeClass("btn-primary AgregarRepuesto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idRepuesto", idRepuesto);

     $.ajax({

        url:"ajax/repuestos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            /*=============================================
            EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
            =============================================*/

            if(stock == 0){

                swal({
                  title: "No hay stock disponible",
                  type: "error",
                  confirmButtonText: "¡Cerrar!"
                });

                $("button[idRepuesto='"+idRepuesto+"']").addClass("btn-primary AgregarRepuesto");

                return;

            }

            $(".nuevoRepuesto").append(

            '<div class="row" style="padding:5px 15px">'+

              '<!-- Descripción del producto -->'+
              
              '<div class="col-xs-6" style="padding-right:0px">'+
              
                '<div class="input-group">'+
                  
                  '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRepuesto" idRepuesto="'+idRepuesto+'"><i class="fa fa-times"></i></button></span>'+

                  '<input type="text" class="form-control nuevaDescripcionRepuesto" idRepuesto="'+idRepuesto+'" name="agregarRepuesto" value="'+descripcion+'" readonly required>'+

                '</div>'+

              '</div>'+

              '<!-- Cantidad del producto -->'+

              '<div class="col-xs-3">'+
                
                 '<input type="number" class="form-control nuevaCantidadRepuesto" name="nuevaCantidadRepuesto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

              '</div>' +

              '<!-- Precio del producto -->'+

              '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                '<div class="input-group">'+

                  '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                     
                  '<input type="text" class="form-control nuevoPrecioRepuesto" precioReal="'+precio+'" name="nuevoPrecioRepuesto" value="'+precio+'" readonly required>'+
     
                '</div>'+
                 
              '</div>'+

            '</div>') 

            // SUMAR TOTAL DE PRECIOS

            sumarTotalPreciosReparacion()

            // AGREGAR IMPUESTO

            agregarImpuestoReparacion()

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarRepuestos()

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            $(".nuevoPrecioRepuesto").number(true, 2);


            localStorage.removeItem("quitarRepuesto");

        }

     })

});
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioReparacion").on("change", "input.nuevaCantidadRepuesto", function(){

    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioRepuesto");

    var precioFinal = $(this).val() * precio.attr("precioReal");
    
    precio.val(precioFinal);

    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))){

        /*=============================================
        SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
        =============================================*/

        $(this).val(0);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        var precioFinal = $(this).val() * precio.attr("precioReal");

        precio.val(precioFinal);

        sumarTotalPreciosReparacion();

        swal({
          title: "La cantidad supera el Stock",
          text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

        return;

    }

    // SUMAR TOTAL DE PRECIOS

    sumarTotalPreciosReparacion()

    // AGREGAR IMPUESTO
            
    agregarImpuestoReparacion()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarRepuestos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosReparacion(){

    var precioItem = $(".nuevoPrecioRepuesto");
    var arraySumaPrecio = [];  

    for(var i = 0; i < precioItem.length; i++){

         arraySumaPrecio.push(Number($(precioItem[i]).val()));
        
         
    }

    function sumaArrayPrecios(total, numero){

        return total + numero;

    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    $("#nuevoTotalReparacion").val(sumaTotalPrecio);
    $("#totalReparacion").val(sumaTotalPrecio);
    $("#totalReparacion").val(sumaTotalPrecio);
    $("#nuevoTotalReparacion").attr("total",sumaTotalPrecio); 
  

}

$("#nuevoCostodeReparacion, .nuevoPrecioRepuesto").change(function(){
      var costoReparacion = $("#nuevoCostodeReparacion").val();
      
      var impuesto = $("#nuevoImpuestoReparacion").val();
      
      var totalVentas = $("#nuevoTotalReparacion").attr('total');
      
      ventasConImpuesto = Number(totalVentas*impuesto/100)+Number(totalVentas);
      ventasTotal = Number(ventasConImpuesto)+ Number(costoReparacion);
      $("#nuevoCostoRep").val(costoReparacion);
      $("#nuevoTotalReparacion").val(ventasTotal);
      $("#totalReparacion").val(ventasTotal)
});
$("#editarCostodeReparacion, .nuevoPrecioRepuesto").change(function(){
      var costoReparacion = $("#editarCostodeReparacion").val();
      console.log("costoReparacion", costoReparacion);
      
      var impuesto = $("#editarImpuestoReparacion").val();
      
      var totalVentas = $("#editarTotalReparacion").attr('total');
      
      ventasConImpuesto = Number(totalVentas*impuesto/100)+Number(totalVentas);
      ventasTotal = Number(ventasConImpuesto)+ Number(costoReparacion);
      $("#editarCostodeRep").val(costoReparacion);
      $("#editarCostodeReparacion").val(costoReparacion);
      $("#nuevoTotalReparacion").val(ventasTotal);
      $("#editarTotalReparacion").val(ventasTotal)
      listarRepuestos()
});
$(".tablaReparaciones").on("click", ".btnImprimirRecibo", function(){

  var codigoReparacion = $(this).attr("codigoReparacion");
  console.log("codigoReparacion", codigoReparacion);

 window.open("extensiones/tcpdf/pdf/recibo.php?codigo="+codigoReparacion, "_blank");

})
