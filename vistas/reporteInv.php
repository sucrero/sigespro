<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Pnf.php';
	include_once '../clases/Periodo.php';
    if(!isset($_SESSION['entrada']) || ($_SESSION['entrada'] != 'admin') && $_SESSION['entrada'] != 'comunidad'){
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
        <script type="text/javascript" src="../js/admReporte.js"></script>
        <script type="text/javascript" src="../js/admSeguimiento.js"></script>
    <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES -->       
        
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
        
        <script type="text/javascript">
            addLoadEvent(foco,'0');
        </script>
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
				position: 'top',
				theme: '.tooltipster-light',
				interactive: 'true'
			});
			
		});
	</script>
	
	<!--[if lt IE 9]>
		<script src="../tooltips/js/html5.js"></script>
	<![endif]-->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS TOOLTIPS -->
    <title>::: SIGESPRO - Reportes :::</title>
    </head>
    <body onLoad="MM_preloadImages('../img/buscar_a.png','../img/vertemas_a.png','../img/imprimir_a.png')">
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Reportes ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos de la B&uacute;squeda</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formRepoerte" method="post">
                                    <table width="100%" border="0" cellpadding="5px" cellspacing="0px" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="4">&nbsp;</td>
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
                                                                 echo '<select id="lstPnf" tabindex="1" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF">';
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
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                         <tr>
                                            <td colspan="4" align="center">
                                            <table border="0" width="93%" cellpadding="1" cellspacing="1">
                                            <tr>
                                           	  <td width="92" align="right"><label>PER&Iacute;ODO:</label></td>
                                                <td width="87" align="left">
                                                <?php
                                                            $objPeriodo = new Periodo();
                                                              $consulta = $objPeriodo->buscar("select * from periodo_academico ORDER BY codperiodo ASC", $acceso);
                                                               if($acceso)
                                                                {
                                                                    if($consulta){
                                                                        if($acceso->registros > 0){
                                                                            echo'<select id="lstperiodo" tabindex="2" style="width: 85px" class="mayuscula tooltip" title="Seleccione un per&iacute;odo">';
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
                                                <td width="171" align="right"><label>TRAYECTO:</label></td>
                                                <td width="96" align="left">
                                                    <select id="lsttrayecto" tabindex="3" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trayecto">
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                    <option value="4">IV</option>
                                                </select></td>
                                                <td width="157" align="right"><label>TRIMESTRE:</label></td>
                                                <td width="116" align="left">
                                                    <select id="lsttrimestre" tabindex="4" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trimestre">
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                </select></td>
                                            </tr>
                                            </table>
                                           </td>
                                        </tr>
                                         <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="left" colspan="4">
                                            <table border="0" width="100%" cellpadding="1" cellspacing="1">
                                            	<tr>
                                                	<td width="27%" align="right">
                                                    	<label>FECHA INICIO:</label>
                                                    </td>
                                                	<td width="27%">
                                                    	<input onChange="" id="idtxtfecini" onFocus="javascrip:select();" type="text" maxlength="8" style="width:100px" readonly disabled>&nbsp;<input type="button" name="btncalendai" id="btncalendai" value="..." tabindex="5" class="tooltip" title="Click para ingresar su fecha de nacimiento" style="width:30px;">
                                                    </td>
                                                    <td width="13%" align="right">
                                                    	<label>FECHA FIN:</label>
                                                    </td>
                                                	<td width="33%">
                                                    	<input onChange="" id="idtxtfecfin" onFocus="javascrip:select();" type="text" maxlength="8" style="width:100px" readonly disabled>&nbsp;<input type="button" name="btncalendaf" id="btncalendaf" value="..." tabindex="6" class="tooltip" title="Click para ingresar su fecha de nacimiento" style="width:30px;">
                                                    </td>
                                                </tr>
                                            </table>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
										<tr>
                                            <td colspan="4" align="center">
                                            <input name="rdoTipo" id="rdoDiag" type="radio" value="diagnostico" class="tooltip" title="Seleccione el tipo de reporte" style="width:0px;" tabindex="7" checked><label>DIAGN&Oacute;STICO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoAnte" type="radio" value="anteproyecto" style="width:0px;" class="tooltip" title="Seleccione el tipo de reporte" tabindex="8"><label>ANTEPROYECTO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoProy" type="radio" value="proyecto" style="width:0px;" class="tooltip" title="Seleccione el tipo de reporte" tabindex="9"><label>PROYECTO</label>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <td align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                            <div id="btnbuscar" style="display:block">
                                                <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('buscar','','../img/buscar_a.png',1)">
                                                    <img src="../img/buscar_i.png" alt="buscar" width="32" height="32" id="buscar" class="tooltip" title="Buscar" onClick="buscarDatos();">
                                                </a>
                                            </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div id="tab_resultados" style="display:none;">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        	<div id="tituloTabla"></div>
                                        </td>
                                    </tr>
                                    </table>
                                    <div id="div_result" class="area" style="display:block; overflow:auto;"  align="center">
                                        <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                            <tr class="tablaCont" onClick="">
                                                        <td align="center" width="5%">
                                                                Item
                                                        </td>
                                                        <td align="center" width="95%">
                                                                T&iacute;tulo
                                                        </td>
                                          </tr>
                                                <tbody id="cont_result"></tbody>
                                        </table>
                                    </div>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center">
                                            <div id="btnimplist" style="display:block">
                                                <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('imprimirlist','','../img/imprimir_a.png',1)">
                                                    <img src="../img/imprimir_i.png" alt="imprimirlista" width="32" height="32" id="imprimirlist" class="tooltip" title="Imprimir lista" onClick="imprimirListaInv();">
                                                </a>
                                            </div>
                                            </td>
                                        </tr>
                                    </table>
                              	</div>
                                <div id="detalle_list" style="display:none;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                    <tr>
                                            <td colspan="4">&nbsp;</td>
                                      </tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        	<div id="tituloDetalle"></div>
                                        </td>
                                    </tr>
                                    </table>
                                	<table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">&nbsp;
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="297" align="right"><label><b>STATUS:</b></label></td>
                                                <td width="431" align="left" colspan="5"><div id="txtstatus" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
										<tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                            	<td width="36" align="left"><label><b>PNF:</b></label></td>
                                                <td width="239" align="left"><div id="txtpnf" class="textoinput"></div></td>
                                           	  	<td width="62" align="right"><label><b>PER&Iacute;ODO:</b></label></td>
                                                <td width="87" align="left"><div id="txtperiodo" class="textoinput"></div></td>
                                                <td width="64" align="right"><label><b>TRAYECTO:</b></label></td>
                                                <td width="74" align="left"><div id="txttrayecto" class="textoinput"></div></td>
                                                <td width="71" align="right"><label><b>TRIMESTRE:</b></label></td>
                                                <td width="59" align="left"><div id="txttrimestre" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="54" align="left"><label><b>ESTADO:</b></label></td>
                                                <td width="176" align="left"><div id="txtestado" class="textoinput"></div></td>
                                                <td width="78" align="right"><label><b>MUNICIPIO:</b></label></td>
                                                <td width="170" align="left"><div id="txtmunicipio" class="textoinput"></div></td>
                                                <td width="75" align="right"><label><b>PARROQUIA:</b></label></td>
                                                <td width="170" align="left"><div id="txtparroquia" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="78" align="left"><label><b>COMUNIDAD:</b></label></td>
                                                <td align="left" colspan="5"><div id="txtcomunidad" class="textoinput"></div></td>
                                                <td width="130" align="left"><label><b>SECTOR COMUNIDAD:</b></label></td>
                                                <td width="233" align="left" colspan="5"><div id="txtsector" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                            	<td width="121" align="left"><label><b>CONSEJO COMUNAL:</b></label></td>
                                                <td align="left" colspan="5"><div id="txtconsejo" class="textoinput"></div></td>
                                           	  <td width="168" align="left"><label><b>RESPONSABLE COMUNIDAD:</b></label></td>
                                                <td width="223" align="left" colspan="5"><div id="txtresponsable" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                         <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="145" align="left"><b><label><div id="tipodetalle"></div></label></b></td>
                                                <td width="583" align="left" colspan="5"><div id="txttitulo" class="textoinput" align="justify"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="167" align="left"><label><b>PROBLEMA SELECCIONADO:</b></label></td>
                                                <td width="561" align="left" colspan="5"><div id="txtproblema" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="63" align="left"><label><b>DOCENTE:</b></label></td>
                                                <td width="284" align="left"><div id="txtdocente" class="textoinput"></div></td>
                                                <td width="125" align="right"><label><b>TUTOR ACAD&Eacute;MICO:</b></label></td>
                                                <td width="244" align="left"><div id="txttutor" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="126" align="left"><label><b>FECHA DE REGISTRO:</b></label></td>
                                                <td width="609" align="left" colspan="5"><div id="txtfecha" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="59" align="left"><label><b>SECCI&Oacute;N:</b></label></td>
                                                <td width="676" align="left" colspan="5"><div id="txtseccion" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                            <table border="0" cellpadding="2" cellspacing="2" width="100%">
                                            <tr>
                                            <td align="center" width="100%" colspan="4"><label><b>GRUPO RESPONSABLE</b></label></td>
                                        </tr>
                                            <tr>
                                                <td width="100%" align="center">
                                                	<div id="div_grupo" class="areaGrupo" style="display:block; overflow:auto;"  align="center">
                                                        <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                                            <tr class="tablaCont" onClick="">
                                                                        <td align="center" width="5%">
                                                                                Item
                                                                        </td>
                                                                        <td align="center" width="20%">
                                                                                C&eacute;dula
                                                                        </td>
                                                                        <td align='center' width="75%">
                                                                            Nombre y Apellido
                                                                        </td>
                                                                </tr>
                                                                <tbody id="cont_grupo"></tbody>
                                                        </table>
                                                        </div>
                                                </td>
                                            </tr>
                                            
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><input type="hidden" id="txtcodigo"><input type="hidden" id="txtserial"><input type="hidden" id="txttipo">&nbsp;</td>
                                        </tr>
                                         <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="104" align="left"><label><b>OBSERVACI&Oacute;N:</b></label></td>
                                                <td width="624" align="left" colspan="5"><div id="txtobservacion" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                  </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                            <div id="btnimpdeta" style="display:block">
                                              <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('imprimirdetalle','','../img/imprimir_a.png',1)"><img src="../img/imprimir_i.png" alt="imprimirdetalle" width="32" height="32" id="imprimirdetalle" class="tooltip" title="Imprimir detalle" onClick="imprimirDetalle();"></a> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                      </tr>
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
    <script type="text/javascript" src="../js/menu.js"></script>
</body>
</html>
<script type="text/javascript">
Calendar.setup({inputField : "idtxtfecini",ifFormat : "%d/%m/%Y",button : "btncalendai"});
Calendar.setup({inputField : "idtxtfecfin",ifFormat : "%d/%m/%Y",button : "btncalendaf"});
</script>