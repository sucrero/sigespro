<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
    
    $objEva = new Evaluacion();
    $pnf = $_GET['codpnf'];
    $pntexto = $_GET['pnfTexto'];
    $sql = "SELECT P.nomproyecto AS titulo FROM evaluacion_proyecto AS E, proyecto AS P WHERE P.idproyecto = E.idproyecto AND P.idpnf = '".$pnf."'";
    if($objEva->buscar($sql, $acceso)){
        if($acceso->registros > 0){
            $i = 0;
            do{
                $fila[$i] = $acceso->devolver_recordset();
                $i++;
            }while(($acceso->siguiente())&&($i!=$acceso->registros));
        }else{
            $fila = -1;
        }
    }else{
        $fila = -1;
    }
            
    class PDF extends PDF_MC_Table{
        function Header() {
            $size = 150;
            $absx = (210 - $size) / 2;
            $this->Image('../img/MembreteUPTOS.jpg', $absx, 5, $size);
            $this->Ln(10);
            $this->Cell(180);
            $this->SetFont('Arial', 'B', 5);
            $this->Cell(190,2, 'IMPRESO POR: '.$_SESSION['varEntrante'], 0, 1, 'C');
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            $this->Cell(60,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: '.html_entity_decode($_SESSION['varEntrante']), 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        
        function titulo($pntexto){
            
            $this->SetFont('Arial', 'BI', 9);
            $this->Ln(10);
            $this->Cell(0, 5, strtoupper('REPORTE DE EVALUACIONE (S) DEL PNF EN '.$pntexto), 0, 1, 'C');
            $this->Ln(5);
//            $this->Cell(35, 5, html_entity_decode('PER&Iacute;ODO:'), 0, 0, 'R');
//            $this->SetFont('Arial', '', 9);
//            $this->Cell(25, 5, $periodoT, 0, 0, 'L');
//            $this->SetFont('Arial', 'BI', 9);
//            $this->Cell(35, 5, html_entity_decode('TRAYECTO:'), 0, 0, 'R');
//            $this->SetFont('Arial', '', 9);
//            $this->Cell(30, 5, $trayectoT, 0, 0, 'L');
//            $this->SetFont('Arial', 'BI', 9);
//            $this->Cell(35, 5, html_entity_decode('TRIMESTRE:'), 0, 0, 'R');
//            $this->SetFont('Arial', '', 9);
//            $this->Cell(30, 5, $trimestreT, 0, 1, 'L');
//            $this->SetFont('Arial', 'BI', 9);
//            $this->Ln(5);
//            if($fechaT != ''){
//                $this->Cell(0, 5, 'FECHA DE REGISTRO:  '.$fechaT, 0, 1, 'C');
//            }
            $this->Ln(4);
        }
        
        function tablaCont($cont){
            $this->SetFont('Arial','IB',7);
            //anchura de las columnas
            $w = array(10,180);
            //cabeceras de la tabla
            $cabecera = array('Nro.','T&iacute;tulo');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 7, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
            $this->SetFont('Arial','',7);
            $this->Ln();
            
           $this->SetWidths(array(10,180));
           $this->SetAligns(array('C','J'));
            for($i=0;$i<count($cont);$i++){
                $item = $i+1;
                $contenido = strtoupper(html_entity_decode(utf8_decode($cont[$i]['titulo'])));
                $this->Row(array($item,$contenido));
            }
        }
    }
    
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo($pntexto);
    $pdf->tablaCont($fila);

    $nombre = "Reporte_Evaluaciones";
    $pdf->Output($nombre,'I');
?>