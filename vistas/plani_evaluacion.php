<?php
    require '../clases/PDF_MC_Table.php';
    require_once '../Modelo.php';
    $romanos = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
    $objPer = new Periodo();
    $periodo = $_GET['per']; //codigo del periodo
    $trayecto = $_GET['tra'];//nro de trayecto
    $trimestre = $_GET['tri'];//nro de trimestre
    $tituloproy = $_GET['tit'];//titulo del proyecto
    $codproyecto = $_GET['codpro'];//codigo del anteproyecto
    $comision=$_GET['com'];//codigo del docente
    $observacion=$_GET['obs'];//observaciones
    $nota = $_GET['nota'];
    
    $w=true;
    $sql="SELECT codperiodo from periodo_academico where idperiodo='".$periodo."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[0] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $fila[1]=$romanos[$trayecto-1];
    $fila[2]=$romanos[$trimestre-1];
    
    
//    $sql = "SELECT * from proyecto WHERE idproyecto='".$codproyecto."'";
    $sql = "SELECT * FROM diagnostico AS D INNER JOIN proyecto AS P ON D.iddiagnostico = P.iddiagnostico WHERE P.idproyecto = '".$codproyecto."'";
    if($objPer->buscar($sql, $acceso)){
        $proy = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
        
//    $fila[3] = $sector;
    $sql="SELECT * from sector_comunidad WHERE idsectorcomunidad='".$proy['idsectorcomunidad']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[3] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
//    $fila[4] = $comunidad;
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
      
    $sql="select (cedpersona || '-' || nompersona || ' ' || apepersona) as responsable from personal_sector_comunidad where idsectorcomunidad='".$proy['idsectorcomunidad']."'
        AND statuspersona='2'";
    if($objPer->buscar($sql, $acceso)){
        $fila[8] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }

    $fila[9] = $proy['nomconsejocomunal'];
    
    $sql="select cedestudiante, (nomestudiante || ' ' || apeestudiante) as estudiante from estudiante where idgrupo='".$proy['idgrupo']."'";
    if($objPer->buscar($sql, $acceso)){
        $i=0;
        do{
            $fila[10][$i]=$acceso->devolver_recordset();
            $i++;
        }while(($acceso->siguiente())&&($i!=$acceso->registros));
    }

    $fila[12] = date('d-m-Y');
    $sql="select (ceddocente || '-'|| nomdocente || ' ' || apedocente) as docente from docente where iddocente='".$proy['iddocente']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[13] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $sql="select (ceddocente || '-'|| nomdocente || ' ' || apedocente) as tutor from docente where iddocente='".$proy['doc_iddocente']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[14] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
    
    $fila[15] = $observacion;
    $sql = "SELECT * from pnf WHERE idpnf='".$proy['idpnf']."'";
    if($objPer->buscar($sql, $acceso)){
        $fila[16] = $acceso->devolver_recordset();
    }else{
        $w=false;
    }
 
    
    $sql = "SELECT max(idproyecto) as maximo from proyecto";
    if($objPer->buscar($sql, $acceso)){
        $ante = $acceso->devolver_recordset();
    }else{
        $w = false;
    }
    
    $relleno = '00000';
    $codFormado = $fila[16]['abrevpnf']."EVA".$fila[1].substr($relleno, count($ante['maximo'])).$ante['maximo'];
    
    $sql = "SELECT * FROM jefe_pnf WHERE statusjefe='1'";
    if($objPer->buscar($sql, $acceso)){
        $codjefe = $acceso->devolver_recordset();
    }else{
        $w = false;
    }
    
    $sql = "SELECT * FROM docente WHERE iddocente='".$codjefe['iddocente']."'";
    if($objPer->buscar($sql, $acceso)){
        $jefe = $acceso->devolver_recordset();
    }else{
        $w = false;
    }
    

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
            $this->Cell(0, 10, html_entity_decode('PLANILLA &Uacute;NICA DE EVALUACI&Oacute;N'), 0, 0, 'C');
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //Posicion a 1,5 cm del final DEL EJE Y
            $this->SetY(-15);
            //Arial italic 8
            $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            //Numero de pagina
            $this->Cell(60,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: '.html_entity_decode($_SESSION['varEntrante']), 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        
        function titulo($titulo,$codFormado,$nota){
//            $this->Cell(180);
            $this->SetFont('Arial', '', 8);
            $this->Code128(160, 20, $codFormado, 40, 5);
            $this->SetXY(160, 25);
            $this->MultiCell(0, 5,$codFormado, 0, 'C');
            $this->Ln(15);
            
            $this->MultiCell(0, 5, utf8_decode($titulo),0,'C');
            $this->Ln(2);
            $this->SetFont('Arial','B',12);
            $this->MultiCell(0, 5,$nota, 0, 'C');
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
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[9]))), 1, 1, 'L');
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
            $this->Ln(5);
        }
        
        function tablaGrupo($cont){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,'INTEGRANTE(S) DEL GRUPO ', 0, 1, 'C');
            //anchura de las columnas
            $w = array(6,20,0);
            $this->SetFont('Arial','B',7);
            //cabeceras de la tabla
            $cabecera = array('Nro.','C&Eacute;DULA','NOMBRES Y APELLIDOS');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 5, html_entity_decode($cabecera[$i]), 1, 0, 'C');
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
            $this->Ln(5);
        }
        
        function tablaComision($sel){
            $integrantes = split(',', $sel);
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,html_entity_decode('INTEGRANTES DE LA COMISI&Oacute;N DE EVALUACI&Oacute;N'), 0, 1, 'C');
            $this->SetFont('Arial','B',7);
            $w = array(6,20,0);
            $cabecera = array('Nro.','C&Eacute;DULA','NOMBRES Y APELLIDOS');
            for($i = 0;$i < count($cabecera);$i++){
                $this->Cell($w[$i], 5, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
             $this->SetFont('Arial','',7);
            $this->Ln();
            for($i=0;$i<count($integrantes);$i++){
                $per = split('-', $integrantes[$i]);
                $this->Cell($w[0], 7, $i+1, 1, 0, 'C');
                $nac = substr($per[1], 0, 1);
                $ced = substr($per[1], 1);
                $this->Cell($w[1], 7,$nac.' - '.number_format($ced,'0','','.'), 1, 0, 'R');
                $this->Cell($w[2], 7, strtoupper(utf8_decode($per[2])), 1, 0, 'L');
                $this->Ln();
            }
            $this->Ln(8);
        }
        
        function observaciones($datos,$comision,$jefe){
            $integrantes = split(',', $comision);
            for($i=0;$i<count($integrantes);$i++){
                $detalles[$i] = split('-', $integrantes[$i]);
                if($detalles[$i][3] == 'T'){
                    $nomTutor = $detalles[$i][2];
                    $nac = substr($detalles[$i][1], 0, 1);
                    $ced = substr($detalles[$i][1], 1);
                    $cedTutor = $nac.' - '.number_format($ced,'0','','.');
                }else if($detalles[$i][3] == 'D'){
                    $nomDocente = $detalles[$i][2];
                    $nac = substr($detalles[$i][1], 0, 1);
                    $ced = substr($detalles[$i][1], 1);
                    $cedDocente = $nac.' - '.number_format($ced,'0','','.');
                }else{
                    $nomResponsable = $detalles[$i][2];
                    $nac = substr($detalles[$i][1], 0, 1);
                    $ced = substr($detalles[$i][1], 1);
                    $cedResponsable = $nac.' - '.number_format($ced,'0','','.');
                }
            }
            $nomJefe = $jefe['nomdocente'].' '.$jefe['apedocente'];
            $nac = substr($jefe['ceddocente'], 0, 1);
            $ced = substr($jefe['ceddocente'], 1);
            $cedJefe = $nac.' - '.number_format($ced,'0','','.');
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 7, 'OBSERVACIONES', 0, 1, 'C');
            $this->SetFont('Arial','',7);
            $this->MultiCell(0, 7,  strtoupper(utf8_decode($datos)), 0, 'J', FALSE);
            $this->Ln(15);
            $this->SetFont('Arial','B',7);
            $this->Cell(70, 3, '____________________________________________', 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, '____________________________________________', 0, 1, 'C');
            $this->Cell(70, 3, $nomDocente, 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, $nomResponsable, 0, 1, 'C');
            $this->Cell(70, 3, 'C.I. '.$cedTutor, 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, 'C.I. '.$cedResponsable, 0, 1, 'C');
            $this->Cell(70, 3, html_entity_decode('JURADO'), 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, 'TUTOR COMUNITARIO', 0, 1, 'C');
            $this->Ln(15);
            $this->Cell(70, 3, '____________________________________________', 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, '____________________________________________', 0, 1, 'C');
            $this->Cell(70, 3, $nomTutor, 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, $nomJefe, 0, 1, 'C');
            $this->Cell(70, 3, 'C.I. '.$cedDocente, 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, 'C.I. '.$cedJefe, 0, 1, 'C');
            $this->Cell(70, 3, 'DOCENTE DE PROYECTO', 0, 0, 'C');
            $this->Cell(40, 3, '', 0, 0, 'C');
            $this->Cell(70, 3, html_entity_decode('COORD. PROYECTO'), 0, 1, 'C');
        }
    }
    if($nota == 'A'){
        $nota = 'APROBADO';
    }else{
        $nota = 'REPROBADO';
    }

//    $pdf = new PDF();
    $pdf = new PDF();
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    
    $pdf->titulo($tituloproy,$codFormado,$nota);
    $pdf->contenido($fila);
    $pdf->tablaGrupo($fila[10]);
    $pdf->tablaComision($comision);
    $pdf->observaciones($fila[15],$comision,$jefe);
    $nombre = "Planilla Proyecto_".$codFormado;
    $pdf->Output($nombre,"I");
?>