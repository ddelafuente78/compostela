<?php
require('../../helper/mysql_table.php');
require ('../../helper/conexion.php');
require ('../../helper/validar_usuario.php');

class PDF extends PDF_MySQL_Table
{
    public $codigo;
    public $codigo_asociado;
    public $fecha_pedido;
    public $destinatario;
    public $direccion;
    Public $localidad;
    Public $provincia;
    Public $telefono;
    Public $cp;
    Public $prioridad;
    Public $usuario;
    Public $fecha_entrega;
    Public $bulto_cantidad;
    Public $bulto_peso;
    Public $bulto_tamanio;

    // Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.jpg',5,1,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(65,10,'Solicitud de pedido.',0,0,'C');
    //Fecha
    $this->SetFont('Arial','',12);
    $this->Cell(75,10,$this->fecha_pedido,0,1,'C');
    //Nro pedido
    $this->SetFont('Arial','',10);
    $this->Cell(150);
    $this->Cell(330,1,'Nro pedido: ' . $this->codigo,0,1,'L');
    $this->Cell(150);
    $this->Cell(330,10,'Nro asociado: '. $this->codigo_asociado,0,1,'L');
    $this->Cell(20);
    $this->Cell(1,1,'Usuario: '. $this->usuario,0,1,'L');
    $this->Cell(20);
    $this->Cell(1,10,'Prioridad: ' . $this->prioridad ,0,0,'L');
    $this->Cell(40);
    $this->Cell(1,10,'Fecha entrega: ' . $this->fecha_entrega ,0,0,'L');
    // Salto de línea
    $this->Ln(1);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

function body($detalle){

    $this->Ln(10);

    $this->SetFont('Times','B',12);
    $this->Cell(50,10,'nombre',1,0,'C',0);
    $this->Cell(120,10,'descripcion',1,0,'C',0);
    $this->Cell(20,10,'cantidad',1,1,'C',0);
    
    $this->SetFont('Arial','',12);
    
    while($fila = $detalle->fetch_assoc()){
        $this->Cell(50,10,$fila['nombre'],1,0,'C',0);
        $this->Cell(120,10,$fila['descripcion'],1,0,'C',0);
        $this->Cell(20,10,$fila['cantidad'],1,1,'C',0);
    }   

    $this->Ln(10);
    $this->SetFont('Times','B',18);    
    $this->Cell(25,1,'Destinatario:',0,0,'C',0);
    $this->Ln(7);
    $this->SetFont('Arial','',12);
    $this->Cell(1,10,'* Nombre: ' . $this->destinatario ,0,1,'L',0);
    $this->Cell(1,1,'* Telefono: ' . $this->telefono ,0,1,'L',0);
    $this->Cell(1,10,'* Direccion: ' . $this->direccion ,0,1,'L',0);
    $this->Cell(1,1,'* Codigo postal: ' . $this->cp ,0,1,'L',0);
    $this->Cell(1,10,'* Localidad: ' . $this->localidad ,0,1,'L',0);
    $this->Cell(1,1,'* Provincia: ' . $this->provincia ,0,1,'L',0);
    $this->Ln(10);
    $this->SetFont('Times','B',18);    
    $this->Cell(8,1,'Bultos:',0,0,'C',0);
    $this->Ln(7);
    $this->SetFont('Arial','',12);
    $this->Cell(1,10,'* Cantidad: ' . $this->bulto_cantidad ,0,1,'L',0);
    $this->Cell(1,1,'* Peso: ' . $this->bulto_peso ,0,1,'L',0);
    $this->Cell(1,10,'* Tamaño: ' . $this->bulto_tamanio ,0,1,'L',0);
}
}

if($_GET) {
    $codigo = $_GET['codigo'];
} else {
    $codigo = '0';
} 

//Obtenemos los datos de la BBDD

$qrySel = "SELECT pc.id, pc.fecha_creacion, pc.codigo_asociado,
            if(prioridad_urgente,'Urgente', 'Normal') as prioridad,
                u.nombre, pc.fecha_entrega, d.razon_social, d.direccion,
                d.numero_telefono, d.codigo_postal, d.provincia,
                coalesce(b.cantidad,0) as cantidad, 
                coalesce(p.descripcion, 'Sin especificar') as peso,
                coalesce(t.descripcion, 'Sin especificar') as tamanio
            FROM pedidoscab pc
                JOIN destinatarios d
                    on pc.destinatario_id = d.id
                JOIN usuarios u
                    on pc.usuario_id = u.id
                LEFT JOIN bultos b
                    on b.idpedido = pc.id
                LEFT JOIN pesos p 
                    on p.id = b.idpeso
                LEFT JOIN tamanios t
                    on t.id = b.idtamanio
            WHERE codigo = '". $codigo ."';";

$rspedidocab = $conexion->query($qrySel);
$pedidoscab = $rspedidocab->fetch_assoc();

$qrySel = "SELECT nombre, descripcion, cantidad 
    FROM pedidosdet pd 
        JOIN articulos a on pd.articulo_id = a.id   
    WHERE pd.pedidoscab_codigo = '". $codigo ."';";
$pedidosDet = $conexion->query($qrySel);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->codigo=$pedidoscab['id'];
$pdf->fecha_pedido = date_format(date_create($pedidoscab['fecha_creacion']),"d/m/Y");
$pdf->codigo_asociado = $pedidoscab['codigo_asociado'];
$pdf->prioridad = $pedidoscab['prioridad'];
$pdf->usuario = $pedidoscab['nombre'];
$pdf->fecha_entrega = $pedidoscab['fecha_entrega'];
$pdf->destinatario = $pedidoscab['razon_social'];
$pdf->direccion = $pedidoscab['direccion'];
$pdf->localidad= "como la sacamos ;)";
$pdf->telefono = $pedidoscab['numero_telefono'];
$pdf->cp = $pedidoscab['codigo_postal'];
$pdf->provincia = $pedidoscab['provincia'];
$pdf->bulto_cantidad = $pedidoscab['cantidad'];
$pdf->bulto_peso = $pedidoscab['peso'];
$pdf->bulto_tamanio = $pedidoscab['tamanio'];

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->line(1,40,500,40);
$pdf->SetFont('Times','',12);

$pdf->body($pedidosDet);

$pdf->Output();

$conexion->close();
?>