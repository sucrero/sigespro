<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
    
    $objDiag = new Diagnostico();
    
    $pnf = $_GET['pnf'];
    $pnfLetra = $_GET['pnfDes'];
    $tipo = $_GET['tipo'];
    $fechaI = cambiarFormatoFecha($_GET['fechai'],2);
    $fechaF = cambiarFormatoFecha($_GET['fechaf'],2);
    $sector = $_GET['sector'];
    
    if($tipo == 'diagnostico'){
        $fecha = 'fechadiagnostico';
        $campo1 = 'iddiagnostico';
        $status = 'statusdiagnostico';
        $campo2 = 'descripdiagnostico';
        $campo3 = 'iddiagnostico';
    }else if($tipo == 'anteproyecto'){
        $fecha = 'fechaante';
        $campo1 = 'idantep';
        $status = 'statusante';
        $campo2 = 'nomantep';
        $campo3 = 'iddiagnostico';
    }else{
        $fecha = 'fechaproy';
        $campo1 = 'idproyecto';
        $status = 'statusproy';
        $campo2 = 'nomproyecto';
        $campo3 = 'iddiagnostico';
    }

    $sql = "SELECT ".$campo1.",".$campo2.",".$campo3." FROM ".$tipo." WHERE idpnf='".$pnf."' and ".$status."='INICIADO' and ".$fecha." BETWEEN '".$fechaI."' AND '".$fechaF."' ORDER BY ".$campo2." ASC";
    if($objDiag->buscar($sql, $acceso)){
        if($acceso->registros > 0){
            $i = 0;
            do{
                $fila[$i] = $acceso->devolver_recordset();
                $i++;
            }while(($acceso->siguiente())&&($i!=$acceso->registros));
        }else{
            $fila = 0;
        }
    }else{
        $fila = -1;
    }
    if($fila != 0){
        $sql = "SELECT * FROM diagnostico WHERE idsectorcomunidad='".$sector."'";
        if($objDiag->buscar($sql, $acceso)){
            if($acceso->registros > 0){
                $i = 0;
                do{
                    $fila2[$i] = $acceso->devolver_recordset();
                    $i++;
                }while(($acceso->siguiente())&&($i!=$acceso->registros));
            }else{
                $fila2 = 0;
            }
        }else{
            $fila2 = 0;
        } 
        $k = 0;
        for($i=0;$i<count($fila);$i++){
            for($j=0;$j<count($fila2);$j++){
                if($fila[$i]['iddiagnostico'] == $fila2[$j]['iddiagnostico']){     
                    $fila3[$k++] = $fila[$i];
                }
            }
        }
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
        
        function titulo($tipo,$pnf,$fechaI,$fechaF,$sql){
            $this->SetFont('Arial', '', 8);
            $this->Ln(10);
            $this->MultiCell(0, 5, strtoupper('LISTADO DE '.$tipo.' (S) DEL PNF EN '.$pnf.' REGISTRADOS'),0,'C');
            $this->MultiCell(0, 5, strtoupper('DESDE EL '. cambiarFormatoFecha($fechaI,1).' HASTA EL  '.  cambiarFormatoFecha($fechaF,1)),0,'C');
            $this->Ln(4);
        }
        
        function tablaCont($cont,$campo2){
            $this->SetFont('Arial','IB',7);
            //anchura de las columnas
            $w = array(10,0);
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
                $contenido = strtoupper(html_entity_decode($cont[$i][$campo2]));
                $this->Row(array($item,$contenido));
            }
        }
    }
    
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo($tipo,$pnfLetra,$fechaI,$fechaF,$sql);
//    $pdf->contenido();
    $pdf->tablaCont($fila3,$campo2);
//    $pdf->tablaProblema($fila[17]);
//    $pdf->observaciones($fila[15]);

//    $nombre = "Planilla Diagnostico_".$codigoDiagnostico;
    $pdf->Output();
?>