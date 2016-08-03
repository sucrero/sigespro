<?php
header("Content-type: application/pdf; charset=utf-8");    
require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
    
    $objProblema = new Problema();
    
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $parroquia = $_GET['parroquia'];
    $comunidad = $_GET['comunidad'];
    $sector = $_GET['sector'];
    $responsable = $_GET['responsable'];
    $consejo = $_GET['consejo'];
    $problema = $_GET['problema'];
    $solucion = $_GET['solucion'];
        
    class PDF extends PDF_MC_Table{
        function Header() {
            $size = 150;
            $absx = (210 - $size) / 2;
            $this->Image('../img/MembreteUPTOS.jpg', $absx, 5, $size);
            $this->Ln(10);
            $this->Cell(180);
            $this->SetFont('Arial', 'B', 5);
            $this->Cell(190,2, 'IMPRESO POR: ESTUDIANTE', 0, 1, 'C');
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            $this->Cell(60,4, utf8_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: ESTUDIANTE', 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        
        function titulo(){
            $this->SetFont('Arial', 'B', 13);
            $this->Ln(10);
            $this->MultiCell(0, 5, utf8_decode('PLANILLA DE DESCRIPCIÓN DEL PROBLEMA'),0,'C');
            $this->Ln(8);
        }
        
        function tablaCont($estado,$municipio,$parroquia,$comunidad,$sector,$responsable,$consejo,$problema,$solucion){
            $this->SetFont('Arial','IB',8);
            $this->Cell(0, 8, utf8_decode('Datos de Ubicación del sector'), 0, 1, 'C');
            $this->Ln(2);
            $this->SetFont('Arial','IB',8);
            $this->Cell(15, 8, utf8_decode('ESTADO:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(50, 8, utf8_decode($estado), 0, 0, 'L');
            $this->SetFont('Arial','IB',8);
            $this->Cell(19, 8, utf8_decode('MUNICIPIO:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(50, 8, utf8_decode(html_entity_decode($municipio)), 0, 0, 'L');
            $this->SetFont('Arial','IB',8);
            $this->Cell(20, 8, utf8_decode('PARROQUIA:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(40, 8, utf8_decode(html_entity_decode($parroquia)), 0, 1, 'L');
            $this->Ln(5);
            $this->SetFont('Arial','IB',8);
            $this->Cell(20, 8, utf8_decode('COMUNIDAD:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(0, 8, utf8_decode(html_entity_decode($comunidad)), 0, 1, 'L');
            $this->SetFont('Arial','IB',8);
            $this->Cell(15, 8, utf8_decode('SECTOR:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(0, 8, utf8_decode(html_entity_decode($sector)), 0, 1, 'L');
            $this->SetFont('Arial','IB',8);
            $this->Cell(33, 8, utf8_decode('CONSEJO COMUNAL:'), 0,0, 'L');
            $this->SetFont('Arial','',8);
            $this->Cell(0, 8, utf8_decode(html_entity_decode($consejo)), 0, 1, 'L');
            $this->Ln(15);
            $this->SetFont('Arial','IB',8);
            $this->Cell(0, 8, utf8_decode('DESCRIPCIÓN DEL PROBLEMA'), 0,1, 'C');
            $this->SetFont('Arial','',8);
            $this->MultiCell(0, 4, utf8_decode(html_entity_decode($problema)), 0, 'C');
            $this->Ln(15);
            $this->SetFont('Arial','IB',8);
            $this->Cell(0, 4, utf8_decode('POSIBLE SOLUCIÓN DEL PROBLEMA'), 0,1, 'C');
            $this->SetFont('Arial','',8);
            $this->MultiCell(0, 8, utf8_decode(html_entity_decode($solucion)), 0, 'C');
            
        }
    }
    
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo();
//    $pdf->contenido();
    $pdf->tablaCont($estado,$municipio,$parroquia,$comunidad,$sector,$responsable,$consejo,$problema,$solucion);
//    $pdf->tablaProblema($fila[17]);
//    $pdf->observaciones($fila[15]);

    $nombre = "SIGESPRO-PlanillaDetalleProblema";
    $pdf->Output($nombre,'I');
?>