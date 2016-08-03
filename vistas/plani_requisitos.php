<?php
    header("Content-type: application/pdf; charset=utf-8");
    require '../clases/PDF_MC_Table.php';
    
    
    class PDF extends PDF_MC_Table{
        function Header() {
            $size = 150;
            $absx = (210 - $size) / 2;
            $this->Image('../img/MembreteUPTOS.jpg', $absx, 5, $size);
            $this->Ln(20);
            $this->SetFont('Arial', 'IB', 10);
            $this->Cell(180, 10, utf8_decode('REQUISITOS PARA EL REGISTRO DE CONSEJOS COMUNALES'),0, 0, 'C');
            $this->Ln(15);
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->SetY(-15);
           $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            $this->Cell(60,4,  utf8_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: LA COMUNIDAD', 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        function contenido(){
            $this->SetFont('Arial','I',10);
            $this->MultiCell(0, 5, utf8_decode('A continuación presentan los requistos indispensables para el registro del Consejo Comunal para obtener acceso al Sistema de Gestion de Proyectos (SIGESPRO). Los mismos deben ser incluidos en la solicitud de acceso a SIGESPRO dirigida al Departamento de Informática de la UPTOS "Clodosbaldo Russián"'),0,'C');
//            $this->Cell(0, 5, html_entity_decode('A continuaci&oacute;n se presentan los requistos indispensables para el registro del Consejo Comunal para obtener acceso al Sistema de Gestion de Proyectos (SIGESPRO)'), 0, 'j');
            
            $this->Ln(8);
             $this->SetFont('Arial','B',12);
            // Color de fondo
            $this->SetFillColor(200,220,255);
            // Título
            $this->Cell(0,6,"DATOS DE LA COMUNIDAD",0,1,'C',true);
            // Salto de línea
            $this->Ln(4);
            $this->SetFont('Arial','',12);
            $this->Cell(9, 10,'1.-', 0, 0, 'L');
            $this->Cell(0, 10,'Estado', 0, 1, 'L');
            $this->Cell(9, 10,'2.-', 0, 0, 'L');
            $this->Cell(0, 10,'Municipio', 0, 1, 'L');
            $this->Cell(9, 10,'3.-', 0, 0, 'L');
            $this->Cell(0, 10,'Parroquia', 0, 1, 'L');
            $this->Cell(9, 10,'4.-', 0, 0, 'L');
            $this->Cell(0, 10,'Nombre de la Comunidad', 0, 1, 'L');
            $this->Cell(9, 10,'5.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Dirección de la Comunidad'), 0, 1, 'L');
            $this->Cell(9, 10,'6.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Nombre del Sector de la Comunidad'), 0, 1, 'L');
            $this->Cell(9, 10,'7.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Punto de referencia'), 0, 1, 'L');
            $this->Ln(5);
             $this->SetFont('Arial','B',12);
            // Color de fondo
            $this->SetFillColor(200,220,255);
            // Título
            $this->Cell(0,6,"DATOS DEL RESPONSABLE DEL CONSEJO COMUNAL",0,1,'C',true);
            // Salto de línea
            $this->Ln(4);
            $this->SetFont('Arial','',12);
            $this->Cell(9, 10,'8.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Número de Cédula de Identidad'), 0, 1, 'L');
            $this->Cell(9, 10,'9.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Nombre y Apellido'), 0, 1, 'L');
            $this->Cell(9, 10,'10.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Sexo'), 0, 1, 'L');
            $this->Cell(9, 10,'11.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Número de Teléfono (Incluyendo código de área)'), 0, 1, 'L');
            $this->Cell(9, 10,'12.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Correo Electrónico'), 0, 1, 'L');
            $this->Ln(5);
             $this->SetFont('Arial','B',12);
            // Color de fondo
            $this->SetFillColor(200,220,255);
            // Título
            $this->Cell(0,6,"DATOS DEL CONSEJO COMUNAL",0,1,'C',true);
            // Salto de línea
            $this->Ln(4);
            $this->SetFont('Arial','',12);
            $this->Cell(9, 10,'13.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Nombre del Consejo Comunal'), 0, 1, 'L');
            $this->Cell(9, 10,'14.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('R.I.F. del Consejo Comunal'), 0, 1, 'L');
            $this->Cell(9, 10,'15.-', 0, 0, 'L');
            $this->Cell(0, 10,  utf8_decode('Código SICOM'), 0, 1, 'L');
            $this->Cell(9, 10,'16.-', 0, 0, 'L');
            $this->Cell(0, 10, utf8_decode('Última fecha de elecciones'), 0, 1, 'L');
            $this->Ln(15);
        }
        
        
    }
    $pdf = new PDF();
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    
//    $pdf->titulo($titulo,$codFormado);
    $pdf->contenido();
    $nombre = "REQUISITOS";
    $pdf->Output($nombre,"I");
?>