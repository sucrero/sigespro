<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
   
    
     
    $datos[0] = $_GET['status'];
    $datos[1] = $_GET['pnf'];
    $datos[2] = $_GET['periodo'];
    $datos[3] = $_GET['trayecto'];
    $datos[4] = $_GET['trimestre'];
    $datos[5] = $_GET['estado'];
    $datos[6] = $_GET['municipio'];
    $datos[7] = $_GET['parroquia'];
    $datos[8] = $_GET['comunidad'];
    $datos[9] = $_GET['sector'];
    $datos[10] = $_GET['consejo'];
    $datos[11] = $_GET['responable'];
    $datos[12] = $_GET['titulo'];
    $datos[13] = $_GET['problema'];
    $datos[14] = $_GET['docente'];
    $datos[15] = $_GET['tutor'];
    $datos[16] = $_GET['fecha'];
    $datos[17] = $_GET['seccion'];
    $datos[18] = $_GET['observacion'];
    $datos[19] = $_GET['codigo'];
    $datos[20] = $_GET['tipo'];
    $datos[21] = $_GET['serial'];
    $status = $datos[0];
    if($datos[20] == 'diagnostico'){
        $cod = 'iddiagnostico';
        $tipo = 'DIAGN&Oacute;STICO';
    }else if($datos[20] == 'anteproyecto'){
        $cod = 'idantep';
        $tipo = 'ANTEPROYECTO';
    }else{
        $cod = 'idproyecto';
        $tipo = 'PROYECTO';
    }
    $objDiag = new Diagnostico();
    $sql1 = "SELECT * FROM ".$datos[20]." WHERE ".$cod."='".$datos[19]."'";
    if($objDiag->buscar($sql1, $acceso)){
        if($acceso->registros > 0){
            $fila = $acceso->devolver_recordset();
        }else{
            $fila = 0;
        }
    }else{
        $fila = 0;
    }
    
    $sql = "SELECT * FROM estudiante WHERE idgrupo='".$fila['idgrupo']."'";
    if($objDiag->buscar($sql, $acceso)){
        if($acceso->registros > 0){
            $i = 0;
            do{
                $estu[$i] = $acceso->devolver_recordset();
                $i++;
            }while(($acceso->siguiente()) && ($i != $acceso->registros));
        }else{
            $estu = 0;
        }
    }else{
        $estu = 0;
    }
    


    class PDF extends PDF_MC_Table{
        function Header() {
            global $tipo;
            
            //logo
            $size = 150;
            $absx = (210 - $size) / 2;
            $this->Image('../img/MembreteUPTOS.jpg', $absx, 5, $size);
            $this->Ln(10);
            //Movemos a la derecha
            $this->Cell(180);
            //Arial bold 15
            $this->SetFont('Arial', 'B', 5);
            $this->Cell(190,2, 'IMPRESO POR: '.$_SESSION['varEntrante'], 0, 1, 'C');
            //Salto de linea
            $this->Ln(10);
            //Arial bold 10
            $this->SetFont('Arial', '', 10);
            //Titulo
            $this->Cell(0, 10, html_entity_decode('PLANILLA &Uacute;NICA DE '.$tipo), 0, 0, 'C');
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
        
        function titulo($titulo,$serial,$status,$tipo){
            $this->SetFont('Arial', '', 8);
            $this->Code128(160, 20, $serial, 40, 5);
            $this->SetXY(160, 25);
            $this->MultiCell(0, 5,$serial, 0, 'C');
            $this->Ln(15);
            $this->MultiCell(0, 5, strtoupper(utf8_decode($titulo)),0,'C');
            $this->Ln(5);
            $this->SetFont('Arial', 'IB', 8);
            $this->Cell(0, 2, html_entity_decode('Status del  '.$tipo.':  '.$status), 0, 1, 'C');
            $this->Ln(4);
        }
        
        function contenido($datos){
            $this->SetFont('Arial','',7);
            //Movemos a la derecha
//            $this->Cell(180);
            $this->Ln(5);
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,html_entity_decode('PER&Iacute;ODO: '), 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(17, 5,$datos[2], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRAYECTO: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(15, 5,$datos[3], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRIMESTRE: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(17, 5,$datos[4], 0, 1, 'L');
            $this->Ln(5);
           
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'ESTADO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[5]))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'MUNICIPIO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[6]))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'PARROQUIA: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[7]))), 1, 1, 'L');
            
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'COMUNIDAD: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[8]))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'SECTOR: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[9]))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'RESPONSABLE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
//            $detalle = split('-', $datos[8]['responsable']);
//            $nac = substr($detalle[0], 0, 1);
//            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5,  strtoupper(utf8_decode($datos[11])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'CONSEJO COMUNAL: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(utf8_decode($datos[10])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'FECHA DE REGISTRO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,  $datos[16], 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'DOCENTE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
//            $detalle = split('-', $datos[13]['docente']);
//            $nac = substr($detalle[0], 0, 1);
//            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5, strtoupper(utf8_decode($datos[14])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,  html_entity_decode('TUTOR ACAD&Eacute;MICO: '), 1, 0, 'L');
            $this->SetFont('Arial','',7);
//            $detalle = split('-', $datos[14]['tutor']);
//            $nac = substr($detalle[0], 0, 1);
//            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5, strtoupper(utf8_decode($datos[15])), 1, 1, 'L');
            $this->Ln(10);
        }
        function tablaGrupo($cont){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,'INTEGRANTE(S) DEL GRUPO ', 0, 1, 'C');
            //anchura de las columnas
            $w = array(10,25,0);
            //cabeceras de la tabla
            $cabecera = array('Nro.','C&Eacute;DULA','NOMBRES Y APELLIDOS');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 7, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
            $this->SetFont('Arial','',7);
            $this->Ln();
            for($i=0;$i<count($cont);$i++){
                $this->Cell($w[0], 7, $i+1, 1, 0, 'C');
                $nac = substr($cont[$i]['cedestudiante'], 0, 1);
                $ced = substr($cont[$i]['cedestudiante'], 1);
                $this->Cell($w[1], 7, strtoupper($nac).' - '.number_format($ced,'0','','.'), 1, 0, 'R');
                $this->Cell($w[2], 7, strtoupper(utf8_decode($cont[$i]['nomestudiante'].' '.$cont[$i]['apeestudiante'])), 1, 0, 'L');
                $this->Ln();
            }
            $this->Ln(10);
        }
        function tablaProblema($sel){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,'PROBLEMA A DESARROLLAR', 0, 1, 'C');
            $titulo1 = html_entity_decode('DESCRIPCI&Oacute;N:');
            $contenido1 = strtoupper(html_entity_decode(utf8_decode($sel)));
            $this->SetWidths(array(30,160));
            $this->SetAligns(array('L','J'));
            $this->Row(array($titulo1,$contenido1));
//            
//            $titulo2 = html_entity_decode('POSIBLE SOLUCI&Oacute;N:');
//            $contenido2 = strtoupper(html_entity_decode(utf8_decode($sel['posiblesolucion'])));
//            $this->SetWidths(array(30,160));
//            $this->SetAligns(array('L','J'));
//            $this->Row(array($titulo2,$contenido2));           
            $this->Ln(10);
        }
        
        function observaciones($datos){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 7, 'OBSERVACIONES', 0, 1, 'C');
            $this->SetFont('Arial','',7);
            $this->MultiCell(0, 7,strtoupper(html_entity_decode(utf8_decode($datos))), 0, 'J', FALSE);
        }
    }
    
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo($datos[12],$datos[21],$status,$tipo);
    $pdf->contenido($datos);
    $pdf->tablaGrupo($estu);
    $pdf->tablaProblema($datos[13]);
    $pdf->observaciones($datos[18]);

//    $nombre = "Planilla Diagnostico_".$codigoDiagnostico;
    $pdf->Output();
?>