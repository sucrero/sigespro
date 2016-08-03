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
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
        <script type="text/javascript" src="../js/principal.js"></script>
        <script type="text/javascript" src="../js/admReporteEva.js"></script>
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
    <title>::: SIGESPRO - Reporte Evaluaci&oacute; :::</title>
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Reportes de Evaluaciones ]</span></td>
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
                                                                 echo '<select id="lstPnf" tabindex="1" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF" onChange="buscarDatos();">';
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
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <td align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                            
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div id="tab_resultados" style="display:none;">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        	Evaluaciones Encontradas
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
                                                    <img src="../img/imprimir_i.png" alt="imprimirlista" width="32" height="32" id="imprimirlist" class="tooltip" title="Imprimir lista" onClick="imprimirListaEva();">
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
                                        	DETALLE DE LA EVALUACI&Oacute;N
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
                                           	  <td width="297" align="right"><label><b>NOTA DESCRIPTIVA:</b></label></td>
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
                                           	  <td width="151" align="left"><b><label>T&Iacute;TULO DEL PROYECTO:</label></b></td>
                                                <td width="577" align="left" colspan="5"><div id="txttitulo" class="textoinput" align="justify"></div></td>
                                            </tr>
                                            </table>
                                            
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="167" align="left"><label><b>PROBLEMA SELECCIONADO:</b></label></td>
                                                <td width="561" align="left" colspan="5"><div id="txtproblema" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>-->
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
                                            <td colspan="4"><input type="hidden" id="txtcodigo">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                            <table border="0" cellpadding="2" cellspacing="2" width="100%">
                                            <tr>
                                            <td align="center" width="100%" colspan="4"><label><b>COMISI&Oacute;N T&Eacute;CNICA</b></label></td>
                                        </tr>
                                            <tr>
                                                <td width="100%" align="center">
                                                	<div id="div_comi" class="areaGrupo" style="display:block; overflow:auto; height:75px"  align="center">
                                                        <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                                            <tr class="tablaCont" onClick="">
                                                                        <td align="center" width="5%">
                                                                                Item
                                                                        </td>
                                                                        <td align="center" width="15%">
                                                                                C&eacute;dula
                                                                        </td>
                                                                        <td align='center' width="80%">
                                                                            Nombre y Apellido
                                                                        </td>
                                                                </tr>
                                                                <tbody id="cont_comi"></tbody>
                                                        </table>
                                                        </div>
                                                </td>
                                            </tr>
                                            
                                            </table>
                                            </td>
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