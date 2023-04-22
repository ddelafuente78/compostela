<?php
require('../../helper/mysql_table.php');
require ('../../helper/conexion.php');
require ('../../helper/validar_usuario.php');

class PDF extends FPDF
{
    Public $nombre;
    Public $direccion;
    Public $codigopostal;
    Public $provincia
   
// Cabecera de página
function Header()
{    
}

// Pie de página
function Footer()
{   
}

function imprimirEtiqueta($numero, $total){
    $this->SetFont('Arial','',12);   
    switch($numero){
        case 1:
            $this->ln(30);
            $this->Cell(60);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'1 de ' . $total ,1,0,'C',0);
            break;
        case 2:
            $this->Cell(133);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'2 de '. $total,1,0,'C',0);
            break;
        case 3:
            $this->ln(100);
            $this->Cell(60);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'3 de ' . $total,1,0,'C',0);
            break;
        case 4:
            $this->Cell(133);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'4 de ' . $total,1,0,'C',0);
            break;
        default:
            echo ("dato erroneo");
    }

}
}

if($_GET) {
    $codigo = $_GET['codigo'];
} else {
    $codigo = '0';
} 

//Obtenemos los datos de la BBDD
$qrySel = "SELECT b.cantidad cantidad,
            d.razon_social nombre, d.direccion,
            d.direccion, d.codigo_postal cp, 
            d.provincia
        FROM pedidoscab pc
        JOIN bultos b
            on pc.id = b.idpedido
        JOIN destinatarios d
            on pc.destinatario_id = d.id
        WHERE pc.codigo='". $codigo ."';";

$rsbulto = $conexion->query($qrySel);
$bultos = $rsbulto->fetch_assoc();

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("L");
$pdf->line(1,100,500,100);
$pdf->line(150,1,150,500);
$pdf->SetFont('Times','',12);

$cantidad = $bultos['cantidad'];

for($valor=1; $valor<=$cantidad; $valor++) {
    $pdf->imprimirEtiqueta($valor,$cantidad);
}


$pdf->Output();

$conexion->close();
?>