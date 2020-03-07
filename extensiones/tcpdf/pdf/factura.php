<?php 

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACON DE LA VENTA;
$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"],true);
$neto = number_format($respuestaVenta["neto"],2);
$total = number_format($respuestaVenta["total"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);

//TRAEMOS INFORMACION DEL CLIENTE
$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACION DEL VENDEDOR
$itemVendedor= "id";
$valorVendedor = $respuestaVenta["id_vendedor"];
$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF

	<table>
		<br>	<br>
		<tr>
		
			<td style="width: 150px"><img src="images/tcpdf_logo.jpg"></td>

			<td style="background-color:white; width: 140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					NIT: 12338888888
					<br>
					Direccion: calle falsa 123

				</div>
			</td>
			<td style="font-size:8.5px; text-align:right; line-height: 15px">
				<br>
				Teléfono: 555 555 55 55

				<br>
				ventas@novatech.tech
			</td>
			<td style="background-color:white; width:110px; text-align:center;color:red;"><br>Factura N.$valorVenta
			</td>
		</tr>
			<br 
	</table>
EOF;

$pdf->writeHtml($bloque1, false, false, false, false, '');
// -------------------------------------------------------
$bloque2 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color: white; width: 390px;">
				Cliente: $respuestaCliente[nombre]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px;text-align:right;">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color: white; width: 540px">
				Vendedor: $respuestaVendedor[nombre]
			</td>

		</tr>
			<tr><td style="border-bottom: 1px solid #666;width: 540px; background-color: white;"></td></tr>
	</table>

EOF;
$pdf->writeHtml($bloque2, false, false, false, false, '');

// ------------------------------------------------------
$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666;background-color: white; width: 260px; text-align:center">Producto</td>
			<td style="border: 1px solid #666;background-color: white; width: 80px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666;background-color: white; width: 100px; text-align:center">Valor Unit.</td>
			<td style="border: 1px solid #666;background-color: white; width: 100px; text-align:center">Valor Total</td>
		</tr>
	
	</table>
EOF;
$pdf->writeHtml($bloque3, false, false, false, false, '');
// --------------------------------------------------
foreach ($productos as $key => $item) {
$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;


$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto, $orden);


$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$preciototal = number_format($item["total"], 2);
	
$bloque4 = <<<EOF
	
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; color:#333; background-color:white; width: 260px; text-align:center">$item[descripcion]</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width: 80px; text-align:center">$item[cantidad]</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width: 100px; text-align:center">$ $valorUnitario</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width: 100px; text-align:center">$ $preciototal</td>
		</tr>
	</table>

EOF;
$pdf->writeHtml($bloque4, false, false, false, false, '');

}
//-----------------------------------
$bloque5 = <<<EOF
	<table style="font-size:10px; padding: 5px 10px">
		<tr>
			<td style="color:#333; background-color: white; width: 340px; text-align:center;"></td>
			<td style="border-bottom: 1px solid #666;color:#333; background-color: white; width: 100px; text-align:center;"></td>
			<td style="border-bottom: 1px solid #666;color:#333; background-color: white; width: 100px; text-align:center;"></td>
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color: white; width: 340px; text-align:center;"></td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100; text-align:center;">Neto:</td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100px; text-align:center;">$ $neto</td>
			
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color: white; width: 340px; text-align:center;"></td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100; text-align:center;">Impuesto:</td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100px; text-align:center;">$ $impuesto</td>
			
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color: white; width: 340px; text-align:center;"></td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100; text-align:center;">Total:</td>
			<td style="border: 1px solid #666; color:#333; background-color: white; width: 100px; text-align:center;">$ $total</td>
			
		</tr>
	</table>

EOF;
$pdf->writeHtml($bloque5, false, false, false, false, '');

//salida del archivo

$pdf->Output('factura.php');

}

}

$factura = new imprimirFactura();

$factura-> codigo = $_GET["codigo"];

$factura->traerImpresionFactura();

?>