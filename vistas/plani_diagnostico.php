<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
    
    $romanos = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
    $objDiag = new Diagnostico();
    $objDoc = new Docente();
    $objResp = new Personalsector();
    $objGru = new Grupo();
    $objEst = new Estudiante();
    $objPer = new Periodo();
    
    $periodo = $_GET['per']; //codigo del periodo
    $trayecto=$_GET['tra'];//nro d etrayecto
    $trimestre=$_GET['tri'];//nro d etrimestre
    $sector=$_GET['sec'];//codigo del sector de la comunidad
    $responsable=$_GET['res'];//codigo del responsable del sector
    $consejo=$_GET['con'];//nombre consejo comunal
    $titulo=$_GET['tit'];//titulo del diagnostico
    $grupo=$_GET['gru'];//codigo del grupo
    $problemasel=$_GET['prosel'];//codigo del problema seleccionado
    $fecha=$_GET['fec'];//fecha de ingreso
    $docente=$_GET['doc'];//codigo del docente
    $tutor=$_GET['tut'];//codigo del tutor
    $observacion=$_GET['obs'];//observaciones
    $pnf = $_GET['pnf'];
   
    
    $w=true;
    $sql="SELECT codperiodo from periodo_academico where idperiodo='".$periodo."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[0] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $fila[1]=$romanos[$trayecto-1];
    $fila[2]=$romanos[$trimestre-1];
    
    $sql="SELECT * from sector_comunidad WHERE idsectorcomunidad='".$sector."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[3] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql = "SELECT * from comunidad WHERE idcomuni='".$fila[3]['idcomuni']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[4] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql = "SELECT * from parroquia WHERE idparroquia='".$fila[4]['idparroquia']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[5] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql = "SELECT * from municipio WHERE idmunicipio='".$fila[5]['idmunicipio']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[6] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql = "SELECT * from estado WHERE idestado='".$fila[6]['idestado']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[7] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
      
    $sql="select (cedpersona || '-' || nompersona || ' ' || apepersona) as responsable from personal_sector_comunidad where idpersona='".$responsable."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[8] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }

    $fila[9] = $consejo;
    
    $sql="select cedestudiante, (nomestudiante || ' ' || apeestudiante) as estudiante from estudiante where idgrupo='".$grupo."'";
    if($objEst->buscar($sql, $acceso)){
        $i=0;
        do{
            $fila[10][$i]=$acceso->devolver_recordset();
            $i++;
        }while(($acceso->siguiente())&&($i!=$acceso->registros));
    }
    
    
    $sql = "SELECT * from problema WHERE idproblema='".$problemasel."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[11] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
   
    $fila[12] = $fecha;

    $sql="select (ceddocente || '-'|| nomdocente || ' ' || apedocente) as docente from docente where iddocente='".$docente."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[13] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql="select (ceddocente || '-'|| nomdocente || ' ' || apedocente) as tutor from docente where iddocente='".$tutor."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[14] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $fila[15] = $observacion;

    $sql = "SELECT * from problema where idproblema='".$problemasel."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[17] = $acceso->devolver_recordset();
    }else{
        $w = false;
    }
    
    $sql = "SELECT coddiag FROM diagnostico WHERE iddiagnostico='".$_GET['cod']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[18] = $acceso->devolver_recordset();
    }else{
        $w = false;
    }
    $codigoDiagnostico = $fila[18]['coddiag'];
//    $relleno = '00000';
//    $codFormado = $fila[16]['abrevpnf']."DIT".$fila[1].substr($relleno, count($codigoDiagnostico)).$codigoDiagnostico;
    
//    class PDF extends FPDF{
    class PDF extends PDF_MC_Table{
        function Header() {
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
            $this->Cell(0, 10, html_entity_decode('PLANILLA &Uacute;NICA DE DIAGN&Oacute;STICO'), 0, 0, 'C');
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //Posicion a 1,5 cm del final
            $this->SetY(-15);
            //Arial italic 8
             $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            //Numero de pagina
            $this->Cell(60,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: '.html_entity_decode($_SESSION['varEntrante']), 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        
        function titulo($titulo,$codFormado){
            $this->SetFont('Arial', '', 8);
            $this->Code128(160, 20, $codFormado, 40, 5);
            $this->SetXY(160, 25);
            $this->MultiCell(0, 5,$codFormado, 0, 'C');
            $this->Ln(15);
            $this->MultiCell(0, 5, strtoupper(utf8_decode($titulo)),0,'C');
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
            $this->Cell(17, 5,$datos[0]['codperiodo'], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRAYECTO: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(15, 5,$datos[1], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRIMESTRE: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(17, 5,$datos[2], 0, 1, 'L');
            $this->Ln(5);
           
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'ESTADO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[7]['descripestado']))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'MUNICIPIO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[6]['descripmunicipio']))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'PARROQUIA: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[5]['descripparroquia']))), 1, 1, 'L');
            
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'COMUNIDAD: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[4]['nomcomuni']))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'SECTOR: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[3]['descripsector']))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'RESPONSABLE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $detalle = split('-', $datos[8]['responsable']);
            $nac = substr($detalle[0], 0, 1);
            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5,  strtoupper($nac).' - '.number_format($ced,'0','','.').'  '.strtoupper(utf8_decode($detalle[1])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'CONSEJO COMUNAL: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(utf8_decode($datos[9])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'FECHA DE REGISTRO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,  $datos[12], 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'DOCENTE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $detalle = split('-', $datos[13]['docente']);
            $nac = substr($detalle[0], 0, 1);
            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5, strtoupper($nac).' - '.number_format($ced,'0','','.').'  '.strtoupper(utf8_decode($detalle[1])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'TUTOR: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $detalle = split('-', $datos[14]['tutor']);
            $nac = substr($detalle[0], 0, 1);
            $ced = substr($detalle[0], 1);
            $this->Cell(0, 5, strtoupper($nac).' - '.number_format($ced,'0','','.').'  '.strtoupper(utf8_decode($detalle[1])), 1, 1, 'L');
            $this->Ln(15);
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
                $this->Cell($w[2], 7, strtoupper(utf8_decode($cont[$i]['estudiante'])), 1, 0, 'L');
                $this->Ln();
            }
            $this->Ln(15);
        }
        
        function tablaProblema($sel){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,'PROBLEMA A DESARROLLAR', 0, 1, 'C');
            $titulo1 = html_entity_decode('DESCRIPCI&Oacute;N:');
            $contenido1 = strtoupper(html_entity_decode(utf8_decode($sel['descripcionproblema'])));
            $this->SetWidths(array(30,160));
            $this->SetAligns(array('L','J'));
            $this->Row(array($titulo1,$contenido1));
            
            $titulo2 = html_entity_decode('POSIBLE SOLUCI&Oacute;N:');
            $contenido2 = strtoupper(html_entity_decode(utf8_decode($sel['posiblesolucion'])));
            $this->SetWidths(array(30,160));
            $this->SetAligns(array('L','J'));
            $this->Row(array($titulo2,$contenido2));
            $this->Ln(15);
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
    
    $pdf->titulo($titulo,$codigoDiagnostico);
    $pdf->contenido($fila);
    $pdf->tablaGrupo($fila[10]);
    $pdf->tablaProblema($fila[17]);
    $pdf->observaciones($fila[15]);

    $nombre = "Planilla Diagnostico_".$codigoDiagnostico;
    $pdf->Output($nombre,"I");
?>