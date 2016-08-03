<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Pnf.php';
    if(!isset($_SESSION['entrada']) || $_SESSION['entrada'] != 'admin'){
        $_SESSION['denegado'] = TRUE;
        echo '<SCRIPT LANGUAGE=javascript>location.href="index.php"</SCRIPT>';
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ES">
    <head>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MENU -->
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <link rel="stylesheet" type="text/css" href="../css/loading.css" />
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MENU -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS CALENDARIO -->
        <script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
        <script type="text/javascript" src="../js/jscalendar/lang/calendar-es.js"></script>
        <script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-blue.css" />
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS CALENDARIO -->
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS AJAX -->
        <script type="text/javascript" src="../js/manipularDom.js"></script>
        <script type="text/javascript" src="../js/x.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS AJAX -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
		<script type="text/javascript" src="../js/principal.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES --> 
        <script type="text/javascript" src="../js/admGrupo.js"></script>
	<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
        <script type="text/javascript">
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
        <!--<script type='text/javascript'>
			window.onload = detectarCarga;
			function detectarCarga(){
			document.getElementById("imgLOAD").style.display="none";
			}
		</script>-->
    <title>::: SIGESPRO - Modificar Grupo :::</title>
    </head>
    <body onLoad="MM_preloadImages('../img/editar_a.png')">
    	
<!--        <div id="cargando"><img src="../img/loader.gif"></div>-->
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
                        	<td align="center">&nbsp;</td>
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
                            <td align="left" width="6%" ></td>
                            <td align="right" width="82%">
                            <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','../img/home_a.png',1)"><img src="../img/home_i.png" alt="inicio" name="home" width="32" height="32" border="0" onClick="ir('vistas/index.php')" title="Inicio"></a></td>
                        </tr>
                    </table>
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Modificar Grupo ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos de la B&uacute;squeda</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formDiagnostico" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
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
                                                                        echo'<select id="ilstPnf" tabindex="15" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF" onChange="buscarDiagnosticosGru();">';
                                                                        echo '<option value="-1">Seleccione...</option>';
																		$i = 0;
                                                                        do{
                                                                                $fila = $acceso->devolver_recordset();
                                                                                echo '<option value="'.$fila['idpnf'].'">'.htmlentities(strtoupper($fila['descripcionpnf']),ENT_QUOTES,'UTF-8').'</option>';
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
                                            <td align="center" colspan="4">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Diagn&oacute;sticos Encontrados</td>
        
                                </tr>
                                </table>
                                <div id="div_diaggru" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="95%">
                                                            T&iacute;tulo Diagn&oacute;stico
                                                    </td>
                                            </tr>
                                            <tbody id="cont_diaggru"></tbody>
                                    </table>
                            
                                    </div>
                                            </td>
                                          </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                                <table border="0px" cellpadding="0px" cellspacing="0px" width="38%">
                                                    <tr>
                                                        <td  width="25%" align="right">
                                                            <input type="hidden" id="itxtgrupo" value="">
                                                                <input type="hidden" id="itxtcodgrupo" value=""><input type="hidden" id="itxtgrupoTable" value=""><label><span class="oblig">*</span>GRUPO:</label>
                                                        </td>
                                                        <td width="25%" align="center">
                                                        <input id="seleccionargrupo" type="button" onClick="abrirGrupoMod();" tabindex="17" value="Modificar" class="tooltip" title="Presione aqu&iacute; modiifcar el Grupo" style="width:70px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" colspan="2">
                                                            <span id="inform" style="display: none; font-size: 9px; font-weight: bold" >Para modificar el Grupo, vaya al menu principal</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
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
                                    <table width="172" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="172" colspan="3" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                    
                                                    <div id='btnmodificar' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('modgrupo','','../img/editar_a.png',1)"><img src="../img/editar_i.png" alt="modgrupo" width="32" height="32" id="modgrupo" class="tooltip" title="Modificar grupo" onClick="modificarGrup()"></a> </div>
                                          </td>
                                        </tr>
                                    </table>
                                </form>
                                
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
		if(func != ''){
        	setTimeout(func, 1000); 
		}
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