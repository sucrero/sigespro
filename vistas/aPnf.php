<?php
    session_start();
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
<!--   		 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MENU -->
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
        <script type="text/javascript" src="../js/admPnf.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
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
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS TOOLTIPS -->


        <script type="text/javascript">
            addLoadEvent(mostrarTodoPnf);
            //addLoadEvent(MM_preloadImages(+'"../img/aplicar_a.png","../img/cancelar_a.png","../img/home_a.png"'+), "");
            addLoadEvent(foco,'0');
        </script>      
    <title>::: SIGESPRO - PNF :::</title>
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
                            <td align="left" width="6%" >
                            </td>
                            <td align="left" width="6%" >
                          </td>
                            <td align="left" width="6%" >
                            </td>
                            <td align="right" width="82%">
                            <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','../img/home_a.png',1)"><img src="../img/home_i.png" alt="inicio" name="home" width="32" height="32" border="0" onClick="ir('vistas/index.php')" title="Inicio"></a></td>
                        </tr>
                    </table>
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar PNF ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del PNF</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formPnf" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtnompnf" onFocus="javascrip:select();" type="text" tabindex="1" class="mayuscula tooltips" maxlength="50" title="Ingrese el nombre del PNF">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>ABREVIADO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtabrevpnf" onFocus="javascrip:select();" type="text" tabindex="2" maxlength="5" class="mayuscula tooltips" title="Ingrese un abreviado para el PNF">
                                            </td>
                                        </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>FECHA DE INICIO</label></td>
                                            <td align="left"><input onChange="" id="itxtfecinipnf" onFocus="javascrip:select();" type="text" maxlength="8" readonly disabled>&nbsp;<input type="button" name="btncalendaI" id="btncalendaI" value="..." tabindex="2" style="width:30px;">
                                            </td>
                                        </tr>                                       
                                    </table>
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                            <td colspan="2" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td align="center">
                                                <div id='btningresar' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                        <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formPnf','guardarPnf()');" title="Guardar">
                                                    </a>
                                                </div>
                                                <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                        <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formPnf','modificarPnf()');" title="Modificar">
                                                    </a>
                                                </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                        <img src="../img/cancelar_i.png" alt="limpiar" name="limpiar" width="32" height="32" border="0" title="Limpiar" onClick="limpiarPnf();">
                                                    </a>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        PNF Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_per" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="57%">
                                                            Nombre
                                                    </td>
                                                    <td align='center' width="12%">
                                                        Abreviado
                                                    </td>
                                                    <td align='center' width="12%">
                                                        Fecha Inicio
                                                    </td>
                                                    <td align='center' width="14%" colspan="2">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_pnf"></tbody>
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
Calendar.setup({inputField : "itxtfecinipnf",ifFormat : "%d/%m/%Y",button : "btncalendaI"});
</script>
