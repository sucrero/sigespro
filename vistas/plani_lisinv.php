<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
    
    $objDiag = new Diagnostico();
    $pnf = $_GET['pnf'];
    $per = $_GET['per'];
    $tra = $_GET['tra'];
    $tri = $_GET['tri'];
    $fechai = $_GET['fechai'];
    $fechaf = $_GET['fechaf'];
    $tabla = $_GET['tipo'];
    $pnfTexto = $_GET['pnfTexto'];
    
    if($tabla == 'diagnostico'){
        $campo1 = 'iddiagnostico';
        $campo2 = 'descripdiagnostico';
        $campo3 = 'statusdiagnostico';
        $trayecto = 'trayectodiagnostico';
        $trimestre = 'trimestrediagnostico';
        $fecha = 'fechadiagnostico';
    }else if($tabla == 'anteproyecto'){
        $campo1 = 'idantep';
        $campo2 = 'nomantep';
        $campo3 = 'statusante';
        $trayecto = 'trayectoante';
        $trimestre = 'trimestreante';
        $fecha = 'fechaante';
    }else{
        $campo1 = 'idproyecto';
        $campo2 = 'nomproyecto';
        $campo3 = 'statusproy';
        $trayecto = 'trayectoproy';
        $trimestre = 'trimestreproy';
        $fecha = 'fechaproy';
    }
    $romanos = array("I","II","III","IV");
    $condicion1 = " idpnf='".$pnf."'";
    if($per != -1){
        $objPeriodo = new Periodo();
        if($objPeriodo->buscar("SELECT codperiodo AS periodo FROM periodo_academico WHERE idperiodo='".$per."'", $acceso)){
            if($acceso->registros > 0){
                $row = $acceso->devolver_recordset();
                $periodoT = $row['periodo'];
            }
        }
        $condicion2 = " AND idperiodo='".$per."'";
    }else{
        $periodoT = 'TODOS';
        $condicion2 = '';
    }
    if($tra != -1){
        $trayectoT = $romanos[$tra-1];
        $condicion3 = " AND ".$trayecto."='".$tra."'";
    }else{
        $trayectoT = 'TODOS';
        $condicion3 = '';
    }
    if($tri != -1){
        $trimestreT = $romanos[$tri-1];
        $condicion4 = " AND ".$trimestre."='".$tri."'";
    }else{
        $trimestreT = 'TODOS';
        $condicion4 = '';
    }
    if($fechai != '' && $fechaf != ''){
        $fechaT = 'DESDE  '.$fechai.'  HASTA  '.$fechaf;
        $condicion5 = " AND ".$fecha." BETWEEN '".cambiarFormatoFecha($fechai,0)."' AND '".cambiarFormatoFecha($fechaf,0)."'";
    }else{
        $fechaT = '';
        $condicion5 = '';
    }
    $sql = "SELECT ".$campo1." AS codigo,".$campo2." AS titulo,".$campo3." AS status FROM ".$tabla." WHERE ".$condicion1.$condicion2.$condicion3.$condicion4.$condicion5." ORDER BY ".$campo2;
    if($objDiag->buscar($sql, $acceso)){
        if($acceso->registros > 0){
            $i = 0;
            do{
                $fila[$i] = $acceso->devolver_recordset();
                $i++;
            }while(($acceso->siguiente())&&($i!=$acceso->registros));
        }
    }else{
        $fila[0] = -1;
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
        
        function titulo($tabla,$pnfTexto,$periodoT,$trayectoT,$trimestreT,$fechaT){
            
            $this->SetFont('Arial', 'BI', 9);
            $this->Ln(10);
            $this->Cell(0, 5, strtoupper('REPORTE DE '.$tabla.'(S) DEL PNF EN '.$pnfTexto), 0, 1, 'C');
            $this->Ln(5);
            $this->Cell(35, 5, html_entity_decode('PER&Iacute;ODO:'), 0, 0, 'R');
            $this->SetFont('Arial', '', 9);
            $this->Cell(25, 5, $periodoT, 0, 0, 'L');
            $this->SetFont('Arial', 'BI', 9);
            $this->Cell(35, 5, html_entity_decode('TRAYECTO:'), 0, 0, 'R');
            $this->SetFont('Arial', '', 9);
            $this->Cell(30, 5, $trayectoT, 0, 0, 'L');
            $this->SetFont('Arial', 'BI', 9);
            $this->Cell(35, 5, html_entity_decode('TRIMESTRE:'), 0, 0, 'R');
            $this->SetFont('Arial', '', 9);
            $this->Cell(30, 5, $trimestreT, 0, 1, 'L');
            $this->SetFont('Arial', 'BI', 9);
            $this->Ln(5);
            if($fechaT != ''){
                $this->Cell(0, 5, 'FECHA DE REGISTRO:  '.$fechaT, 0, 1, 'C');
            }
            $this->Ln(4);
        }
        
        function tablaCont($cont){
            $this->SetFont('Arial','IB',7);
            //anchura de las columnas
            $w = array(10,160,20);
            //cabeceras de la tabla
            $cabecera = array('Nro.','T&iacute;tulo','Status');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 7, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
            $this->SetFont('Arial','',7);
            $this->Ln();
            
           $this->SetWidths(array(10,160,20));
           $this->SetAligns(array('C','J','C'));
            for($i=0;$i<count($cont);$i++){
                $item = $i+1;
                $contenido = strtoupper(html_entity_decode(utf8_decode($cont[$i]['titulo'])));
                $status = $cont[$i]['status'];
                $this->Row(array($item,$contenido,$status));
            }
        }
    }
    
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo($tabla,$pnfTexto,$periodoT,$trayectoT,$trimestreT,$fechaT);
    $pdf->tablaCont($fila);

    $nombre = "Reporte_".strtoupper($tabla)."S";
    $pdf->Output($nombre,'I');
?>