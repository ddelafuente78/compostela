<?php
require('../../helper/mysql_table.php');
require ('../../helper/conexion.php');
require ('../../helper/validar_usuario.php');

class PDF extends FPDF
{
    Public $nombre;
    Public $direccion;
    Public $codigopostal;
    Public $provincia;
    Public $nropedido;
   
// Cabecera de página
function Header()
{    
}

// Pie de página
function Footer()
{   
}

function imprimirEtiqueta($numero, $total){
    $this->SetFont('Arial','',10);   
    switch($numero){
        case 1:
            $this->Image('logoSancorSalud.jpg',1,1,33);
            $this->ln(30);
            $this->Cell(60);
            $this->Cell(1,1,'Nro: ' . $this->nropedido ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(60);
            $this->Cell(1,1,$this->nombre . " - " . $this->direccion . " - " 
                . $this->codigopostal . " - mi ciudad - " . $this->provincia  
                ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(55);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'1 de ' . $total,1,0,'C',0);
            break;
        case 2:
            $this->Image('logoSancorSalud.jpg',153,1,33);
            $this->ln(-10);
            $this->Cell(210);
            $this->Cell(1,1,'Nro: ' . $this->nropedido ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(210);
            $this->Cell(1,1,$this->nombre . " - " . $this->direccion . " - " 
            . $this->codigopostal . " - mi ciudad - " . $this->provincia  
            ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(205);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'2 de '. $total,1,0,'C',0);
            break;
        case 3:
            $this->Image('logoSancorSalud.jpg',1,101,33);
            $this->ln(100);
            $this->Cell(60);
            $this->Cell(1,1,'Nro: ' . $this->nropedido ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(60);
            $this->Cell(1,1,$this->nombre . " - " . $this->direccion . " - " 
                . $this->codigopostal . " - mi ciudad - " . $this->provincia  
                ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(55);
            $this->Cell(1,1,'Bulto: ',1,0,'C',0);
            $this->Cell(10);
            $this->Cell(1,1,'3 de ' . $total,1,0,'C',0);
            break;
        case 4:
            $this->Image('logoSancorSalud.jpg',153,101,33);
            $this->ln(-10);
            $this->Cell(210);
            $this->Cell(1,1,'Nro: ' . $this->nropedido ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(210);
            $this->Cell(1,1,$this->nombre . " - " . $this->direccion . " - " 
            . $this->codigopostal . " - mi ciudad - " . $this->provincia  
            ,1,0,'C',0);
            $this->ln(5);
            $this->Cell(205);
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
            d.provincia, pc.codigo_asociado
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
$pdf->nropedido = $bultos['codigo_asociado'];
$pdf->direccion = $bultos['direccion'];
$pdf->codigopostal = $bultos['cp'];
$pdf->provincia = $bultos['provincia'];
$pdf->nombre = $bultos['nombre'];

for($valor=1; $valor<=$cantidad; $valor++) {
    $pdf->imprimirEtiqueta($valor,$cantidad);
}


$pdf->Output();

$conexion->close();
?>