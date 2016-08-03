<?php
    session_start();
	include_once '../conexion/conexion.php';
        include_once '../clases/Usuario.php';
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
        <script type="text/javascript" src="../js/sha1.js"></script>
        <script type="text/javascript" src="../js/x.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS AJAX -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
		<script type="text/javascript" src="../js/principal.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES -->        
                <script type="text/javascript" src="../js/admProblema.js"></script>
                <script type="text/javascript" src="../js/administrarUsuario.js"></script>
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                        
        
        <link rel="stylesheet" type="text/css" href="../tooltips/css/tooltipster.css" />
        <link rel="stylesheet" type="text/css" href="../tooltips/css/themes/tooltipster-light.css" />
	
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
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
        
    <title>::: SIGESPRO - Consultar Problema :::</title>
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
                           setlocale(LC_TIME,"es_ES");
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Consulta de Problemas ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                B&uacute;sque o seleccione el Problema a visualizar</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formMostProy" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr> 
                                        <tr>
                                            <td width="35%" align="right"><label>BUSCAR:</label></td>
                                            <td width="65%" align="left"><input id="txtbusproble" onkeyup="buscarProbleLe(this,event)" type="text" tabindex="1" maxlength="150" style="width:300px" class="mayuscula tooltip" title="Ingrese una palabra"/></td>                                   
                                        <tr>
                                            <td width="35%" align="right" colspan="2">
                                <div id="div_proble" class="area3" style="display:block; overflow:auto;"  align="center">
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                            <td align="center" colspan="5" class="FondoAzulLetrasBlancaTABLAS">
                                                        Problemas encontrados
                                                    </td>
                                            </tr>
                                        <tr class="tablaCont" onClick="">
                                            <td align="center" width="5%" class="FondoAzulLetrasBlancaTABLAS">
                                                            Item
                                                    </td>
                                                    <td align="center" width="95%" class="FondoAzulLetrasBlancaTABLAS">
                                                        Descripci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_proble"></tbody>
                                    </table>
                                    </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div id="detalle_proble" style="display:none;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                    <tr>
                                            <td colspan="4">&nbsp;</td>
                                  </tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        	DETALLES DEL PROBLEMA SELECCIONADO
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
                                           	  <td width="167" align="left"><label><b>DESCRIPCI&Oacute;N PROBLEMA:</b></label></td>
                                                <td width="561" align="left" colspan="5"><div id="txtproblema" class="textoinput"></div></td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            <table border="0" width="100%" cellpadding="2" cellspacing="2">
                                            <tr>
                                           	  <td width="128" align="left"><label><b>POSIBLE SOLUCI&Oacute;N:</b></label></td>
                                                <td width="600" align="left" colspan="5"><div id="txtposiblesol" class="textoinput"></div></td>
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
                                            <td colspan="4">&nbsp;<input type="hidden" id="txtCodProble"></td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <td>&nbsp;</td>
                                      </tr>
                                        <tr>
                                            <td align="center">
                                            <div id="btnimplist" style="display:block">
                                                <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('imprimirlist','','../img/imprimir_a.png',1)">
                                                    <img src="../img/imprimir_i.png" alt="imprimirdetalle" width="32" height="32" id="imprimirdetalle" class="tooltip" title="Imprimir detalle" onClick="imprimirDetalleProble();">
                                                </a>
                                            </div>
                                            </td>
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
<script type="text/javascript">mostrarProblemas();</script>