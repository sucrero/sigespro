<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Periodo.php';
    include_once '../clases/Proyecto.php';
    include_once '../clases/Pnf.php';
    if(!isset($_SESSION['entrada']) || $_SESSION['entrada'] != 'admin'){
        $_SESSION['denegado'] = TRUE;
        echo '<SCRIPT LANGUAGE=javascript>location.href="index.php"</SCRIPT>';
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MENU -->
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MENU -->
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS AJAX -->
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/manipularDom.js"></script>
        <script type="text/javascript" src="../js/x.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS AJAX -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS CALENDARIO -->
        <script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
        <script type="text/javascript" src="../js/jscalendar/lang/calendar-es.js"></script>
        <script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-blue.css" />
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS CALENDARIO -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
		<script type="text/javascript" src="../js/principal.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES -->        
        <script type="text/javascript" src="../js/admProyecto.js"></script>
        <script type="text/javascript" src="../js/admGrupo.js"></script>    
        <script type="text/javascript" src="../js/admDiagnostico.js"></script>
        <script type="text/javascript" src="../js/admProblema.js"></script>             
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                        
        <script type="text/javascript">
           // addLoadEvent(prepareInputsForHints);
            //addLoadEvent(mostrarTodoProy('pro'));
            //addLoadEvent(MM_preloadImages(+'"../img/aplicar_a.png","../img/cancelar_a.png","../img/home_a.png"'+), "");
            addLoadEvent(foco,'0');
        </script>
        <link rel="stylesheet" href="../css/modal-message.css" type="text/css">
        <script type="text/javascript" src="../js/modal-message.js"></script>
        <script type="text/javascript" src="../js/ajax-dynamic-content.js"></script>  
        <script type="text/javascript" src="../js/ajax.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS TOOLTIPS -->
        <link rel="stylesheet" type="text/css" href="../tooltips/css/tooltipster.css" />
        <link rel="stylesheet" type="text/css" href="../tooltips/css/themes/tooltipster-light.css" />
        <link rel="stylesheet" type="text/css" href="../tooltips/css/themes/tooltipster-noir.css" />
        <link rel="stylesheet" type="text/css" href="../tooltips/css/themes/tooltipster-punk.css" />
        <link rel="stylesheet" type="text/css" href="../tooltips/css/themes/tooltipster-shadow.css" />
        <script type="text/javascript" src="../tooltips/js/jquery.min.js"></script>
        <script type="text/javascript" src="../tooltips/js/jquery.tooltipster.js"></script>
        <script type="text/javascript" src="../tooltips/js/jquery.masonry.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#container').masonry({
			    itemSelector: '.item',
			    columnWidth: 240
			 });
			  			
			$('.tooltip').tooltipster({
				position: 'right',
				theme: '.tooltipster-light',
				interactive: 'true'
			});
			
		});
	</script>
	<!--[if lt IE 9]>
		<script src="../tooltips/js/html5.js"></script>
	<![endif]-->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS TOOLTIPS -->       
    <title>::: SIGESPRO - Proyecto :::</title>
    </head>
    <body>
<div align="center">
            <table align="center" width="100%" height="53" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td  width="68%" height="50"><!--<img src="../img/topbandera_final.jpg" alt="bandera">--><img src="../img/MembreteUPTOS_mod.png" alt="cintillo"></td>
                    <td width="22%" height="50" align="right"><img src="../img/logo_rigth.jpg" alt="corazon"></td>
                </tr>
                <tr>
                    <td colspan="2" height="5" bgcolor="#ed1427"></td>
                </tr>
            </table>
    </div>
        <table border="0" width="100%">
            <tr>
                <td colspan="2" height="100px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="100%" align="left"><?php require 'banner.html'; ?></td>
                        </tr>
                        <tr>
                        	<td colspan="1" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="400px" width="15%" valign="top">
                    <div id="fecha" align="center">
                        <?php
                           setlocale(LC_TIME, "es_ES");
                           echo "<b>Cuman&aacute;&sbquo; ".strftime("%d de %B de %Y")."</b>";
                           
                        ?>
                    </div>
                    <?php include '../menu/menu.php'; ?>
                </td>
                <td width="85%" style="vertical-align:top">
                <!-- CUERPO -->
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="left" width="6%" >&nbsp;</td>
                            <td align="left" width="6%" >&nbsp;</td>
                            <td align="left" width="6%" >&nbsp;</td>
                            <td align="right" width="82%">
                            <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','../img/home_a.png',1)"><img src="../img/home_i.png" alt="inicio" name="home" width="32" height="32" border="0" onClick="ir('vistas/index.php')" title="Inicio"></a></td>
                        </tr>
                    </table>
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Proyecto ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Proyecto</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formProyecto" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
										<tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="1" cellspacing="1">
                                            <tr>
                                           	  <td width="21,3%" align="right"><label><span class="oblig">*</span>PER&Iacute;ODO:</label></td>
                                                <td width="12%" align="left">
                                                    <?php
                                                        $objPeriodo = new Periodo();
                                                        $consulta = $objPeriodo->buscar("select * from periodo_academico", $acceso);
                                                         if($acceso)
                                                          {
                                                              if($consulta){
                                                                  if($acceso->registros > 0){
                                                                      //echo'<a class="showTip L4">';
                                                                      echo'<select id="ilstperiodo" onChange="" tabindex="1" style="width: 85px" class="mayuscula tooltip" title="Seleccione un per&iacute;odo">';
                                                                      echo '<option value="-1">.......</option>';
                                                                      $i=0;
                                                                      do{
                                                                              $fila = $acceso->devolver_recordset();
                                                                              echo '<option value="'.$fila['idperiodo'].'">'.$fila['codperiodo'].'</option>';
                                                                              $i++;
                                                                      }while(($acceso->siguiente())&&($i!=$acceso->registros));

                                                                  }else{
                                                                      echo'<select id="ilstperiodo" disabled style="width: 75px">';
                                                                      echo '<option value="-1">No se encontraron registros...</option>';
                                                                  }
                                                              }else{
                                                                  echo'<select id="ilstperiodo" disabled style="width: 75px">';
                                                                  echo '<option value="-1">No se encontraron registros...</option>';
                                                              }
                                                              echo'</select>';
                                                          }
                                                        ?>
                                                </td>
                                                <td width="21,3%" align="right"><label><span class="oblig">*</span>TRAYECTO:</label></td>
                                                <td width="12%" align="left"><select id="ilsttrayecto" tabindex="2" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trayecto">
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                    <option value="4">IV</option>
                                                </select></td>
                                                <td width="21,3%" align="right"><label><span class="oblig">*</span>TRIMESTRE:</label></td>
                                                <td width="12%" align="left"><select id="ilsttrimestre" tabindex="3" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trimestre">
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                </select></td>
                                            </tr>
                                            
                                            <tr>
                                              <td align="center" colspan="6"><hr color="#CCCCCC"></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="right"><label><span class="oblig">*</span>PNF:</label></td>
                                            <td width="70%" align="left">
                                                <?php
                                                        $objPnf = new Pnf();
                                                        $consulta = $objPnf->buscar("select * from pnf order by descripcionpnf ASC", $acceso);
                                                        if($acceso)
                                                         {
                                                             if($consulta){
                                                                 if($acceso->registros > 0){
                                                                     echo'<select id="ilstPnf" tabindex="15" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF" onChange="cargarAnteproyectos();">';
                                                                     echo '<option value="-1">Seleccione...</option>';
                                                                                                                                             $i = 0;
                                                                     do{
                                                                             $fila = $acceso->devolver_recordset();
                                                                             echo '<option value="'.$fila['idpnf'].'">'.strtoupper($fila['descripcionpnf']).'</option>';
                                                                             $i++;
                                                                     }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                 }else{
                                                                     echo'<select id="ilstPnf" disabled style="width: 205px">';
                                                                     echo '<option value="-1">No se encontraron registros...</option>';
                                                                 }
                                                             }else{
                                                                 echo'<select id="ilstPnf" disabled style="width: 205px">';
                                                                 echo '<option value="-1">No se encontraron registros...</option>';
                                                             }
                                                             echo'</select>';
                                                         }
                                                ?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td width="18%" align="right"><label><span class="oblig">*</span>T&Iacute;TULO ANTEPROYECTO:</label></td>
                                            <td width="29%" align="left" colspan="3">
                                                <select id="ilstanteproy" onChange="buscarDatosAntep();" tabindex="1" style="width: 300px" class="mayuscula tooltip" title="Seleccione un anteproyecto" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td align="right" width="30%"><label><span class="oblig">*</span>C&Oacute;DIGO PROYECTO:</label></td>
                                            <td align="left" colspan="3" width="70%">
                                              <a class="showTip L4">
                                              <input type="text" id="itxtcodproyecto" value="" tabindex="4" style="width:300px" readonly>
                                              </a>
                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td align="right" width="30%"><label><span class="oblig">*</span>T&Iacute;TULO PROYECTO:</label></td>
                                            <td align="left" colspan="3" width="70%">
                                              <!--<input type="text" id="itxttituloproyecto" tabindex="5" style="width:300px" class="mayuscula">--><textarea id="itxttituloproyecto" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese el t&iacute;tulo del proyecto" onKeyUp="valida_longitud(this,'255','cuenta1')" onKeyDown="valida_longitud(this,'255','cuenta1')"></textarea><div id="cuenta1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>OBJETIVO PROYECTO:</label></td>
                                            <td align="left" colspan="3">
                                              <!--<input type="text" id="itxtobjproyecto" tabindex="6" style="width:300px" class="mayuscula">--><textarea id="itxtobjproyecto" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese el objetivo general del proyecto" onKeyUp="valida_longitud(this,'255','cuenta2')" onKeyDown="valida_longitud(this,'255','cuenta2')"></textarea><div id="cuenta2" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" align="center" colspan="4"><hr color="#CCCCCC"></td>
                                        </tr>
                                        
                                       
                                        
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>&Aacute;REA DE CONOCIMIENTO:</label></td>
                                            <td align="left" colspan="3"><input type="text" id="itxtareaconocimiento" tabindex="11" style="width:300px" class="mayuscula tooltip" title="Ingrese un &aacute;rea del conocimiento">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="30%"><label><span class="oblig">*</span>PROBLEMA SELECCIONADO:</label></td>
                                            <td align="left" colspan="3" width="70%">
                                              <!--<input type="text" id="itxtproblemasel" name="" tabindex="10" disabled>-->
                                              <textarea id="itxtproblemasel" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" disabled></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" width="100%" colspan="4"><input id="grupo" type="hidden" value=""><br/><label>GRUPO RESPONSABLE</label></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                            <div id="div_grupo" class="areaGrupo" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                        			<td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="25%">
                                                            C&eacute;dula
                                                    </td>
                                                    <td align='center' width="70%">
                                                        Nombre y Apellido
                                                    </td>
                                            </tr>
                                            <tbody id="cont_grupo"></tbody>
                                    </table>
                            
                                    </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="right"><label><span class="oblig">*</span>COMUNIDAD:</label></td>
                                            <td width="70%" align="left" colspan="3" >
                                                <!--<input type="text" id="itxtcomunidad" tabindex="13" class="mayuscula" disabled>-->
                                                <textarea id="itxtcomunidad" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" disabled></textarea>
                                            </td>
                                        </tr>
                                  <tr>
                                            <td align="right"><label><span class="oblig">*</span>SECTOR COMUNIDAD:</label></td>
                                            <td width="70%" align="left" colspan="3" >
                                                <input type="text" id="itxtsector" tabindex="13" class="mayuscula" disabled></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>RESPONSABLE COMUNIDAD:</label></td>
                                            <td width="70%" align="left" colspan="3" >
                                                <input type="text" name="" id="itxtresponsable" tabindex="13" class="mayuscula" disabled></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>CONSEJO COMUNAL:</label></td>
                                            <td align="left" colspan="3">
                                              <input type="text" id="itxtconsejocomunal" tabindex="13" class="mayuscula" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>FECHA:</label></td>
                                            <td align="left" colspan="3">
                                              <input type="text" id="itxtfecha" style="width:100px" readonly value="<?php echo date("d-m-Y");?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>DOCENTE:</label></td>
                                            <td align="left" colspan="3">
                                                <select id="ilstdocente" tabindex="15" style="width: 305px" class="mayuscula tooltip" title="Seleccione un docente" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>TUTOR ACAD&Eacute;MICO:</label></td>
                                            <td align="left" colspan="3">
                                                <select id="ilsttutor" tabindex="16" style="width: 305px" class="mayuscula tooltip" title="Seleccione un tutor" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>OBSERVACI&Oacute;N:</label></td>
                                            <td align="left" colspan="3">
                                            <!--<textarea id="itxtobservacion" rows="3" cols="35" tabindex="18" class="mayuscula"></textarea>--><textarea id="itxtobservacion" rows="3" cols="35" tabindex="17" class="mayuscula tooltip" title="Ingrese una observaci&oacute;n" onKeyUp="valida_longitud(this,'255','cuenta3')" onFocus="limpText(this)" onBlur="limpText(this)">Sin observaciones...</textarea><div id="cuenta3" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div></td>
                                        </tr>
                                        <tr>
                                          <td align="center" colspan="4">
                                              <input id="imprimir" type="checkbox" tabindex="19" value="imprimir" class="tooltip" title="Marque esta casilla para mostrar la planilla de registro" checked style="width:30px;"><label>MOSTRAR PLANILLA</label></td>
                                        </tr>

                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
                                            <td colspan="3"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formProyecto','validarProy()');" class="tooltip" title="Guardar">
                                                    </a>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" class="tooltip" title="Limpiar" onClick="limpiarProyecto();">
                                                    </a>
                                            </td>
                                           <!-- <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('imprimir','','../img/impresora_a.png',1)">
                                                            <img src="../img/impresora_i.png" alt="imprimir" name="imprimir" width="32" height="32" border="0" title="Imprimir" onClick="ir('index');">
                                                    </a>
                                            </td>-->

                                        </tr>
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Proyectos Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_proy" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="80%">
                                                            T&iacute;tulo Proyecto
                                                    </td>
                                                     <td align='center' width="15%">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_proy"></tbody>
                                    </table>
                            
                                    </div>
                            </td>
                      </tr>
                    </table>
                <!-- FIN CUERPO -->
                </td>
            </tr>
            <tr>
                 <td width="15%" height="150px" align="center">
                </td>
                <td width="85%" height="150px" align="center">
                    <?php include 'pie.html'; ?>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
    messageObj = new DHTML_modalMessage();	// We only create one object of this class
    messageObj.setShadowOffset(5);	// Large shadow

    function displayMessage(url,func,ancho,largo)
    {      
        messageObj.setSource(url);
        setTimeout(func, 1000); 
        messageObj.setCssClassMessageBox(false);
        /*messageObj.setSize(750,520);*/
		messageObj.setSize(ancho,largo);
        messageObj.setShadowDivVisible(true);	// Enable shadow for these boxes
        messageObj.display();
    }

    function closeMessage()
    {
        messageObj.close();
    }


</script>
    <script type="text/javascript" src="../js/menu.js"></script>
</body>
</html>
