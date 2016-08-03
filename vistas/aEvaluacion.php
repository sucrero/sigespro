<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Periodo.php';
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
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
		<script type="text/javascript" src="../js/principal.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES -->        
        <script type="text/javascript" src="../js/admEvaluacion.js"></script>
        <script type="text/javascript" src="../js/admProyecto.js"></script>
        <script type="text/javascript" src="../js/admDocente.js"></script>
        <script type="text/javascript" src="../js/admIntCom.js"></script>
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS TOOLTIPS -->
       <link rel="stylesheet" href="../css/modal-message.css" type="text/css">
        <script type="text/javascript" src="../js/modal-message.js"></script>
        <script type="text/javascript" src="../js/ajax-dynamic-content.js"></script>  
        <script type="text/javascript" src="../js/ajax.js"></script>
        
       
        <script type="text/javascript">
            addLoadEvent(foco,'0');
        </script>
        
    <title>::: SIGESPRO - Evaluaci&oacute;n :::</title>
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Evaluaci&oacute;n ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos de la Evaluaci&oacute;n</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formEvaluacion" method="post">
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
                                                            $consulta = $objPeriodo->buscar("select * from periodo_academico ORDER BY codperiodo ASC", $acceso);
                                                               if($acceso){
                                                                    if($consulta){
                                                                        if($acceso->registros > 0){
                                                                            echo'<select id="ilstperiodo" tabindex="1" style="width: 85px" class="mayuscula tooltip" title="Per&iacute;odo" disabled>';
                                                                            echo '<option value="-1">.......</option>';
                                                                            $i=0;
                                                                            do{
                                                                                    $fila = $acceso->devolver_recordset();
                                                                                    echo '<option value="'.$fila['idperiodo'].'">'.$fila['codperiodo'].'</option>';
                                                                                    $i++;
                                                                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                            echo'</select>';
                                                                        }else{
                                                                            echo'<select id="ilstperiodo" disabled style="width: 75px">';
                                                                            echo '<option value="-1">No se encontraron registros...</option>';
                                                                        }
                                                                    }else{
                                                                        echo'<select id="ilstperiodo" disabled style="width: 75px">';
                                                                        echo '<option value="-1">No se encontraron registros...</option>';
                                                                    }
                                                                }
                                                    ?>
                                                </td>
                                                <td width="21,3%" align="right"><label><span class="oblig">*</span>TRAYECTO:</label></td>
                                                <td width="12%" align="left">
                                                    <select id="ilsttrayecto" tabindex="2" style="width: 75px" class="mayuscula tooltip" title="Trayecto" disabled>
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                    <option value="4">IV</option>
                                                </select></td>
                                                <td width="21,3%" align="right"><label><span class="oblig">*</span>TRIMESTRE:</label></td>
                                                <td width="12%" align="left">
                                                    <select id="ilsttrimestre" tabindex="3" style="width: 75px" class="mayuscula tooltip" title="Trimestre" disabled>
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
                                                                 echo '<select id="ilstPnf" tabindex="4" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF" onChange="mostrarEva();">';
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
                                            <td align="right" width="30%"><label><span class="oblig">*</span>T&Iacute;TULO PROYECTO:</label></td>
                                            <td align="left" colspan="3" width="70%">
                                              <input id="buscarproyecto" type="button" value="Buscar Proyecto" onClick="abrirProyEva();" tabindex="8" style="width:300px;"></br><textarea id="itxttitproyecto" rows="4" cols="35" tabindex="3" class="mayuscula tooltip" title="T&iacute;tulo del Proyecto" disabled \></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="30%"><label><span class="oblig">*</span>OBJETIVO GENERAL:</label></td>
                                            <td align="left" colspan="3" width="70%">
                                              <textarea id="itxtobjgeneral" rows="4" cols="35" tabindex="3" class="mayuscula tooltip" title="Objetivo General del Proyecto" disabled \></textarea><input type="hidden" id="txtsector" value=""><input type="hidden" id="txtproyecto" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4"><hr color="#CCCCCC"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4"><br/><label>GRUPO RESPONSABLE</label></td>
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
                                            <td align="right" width="30%"><label><span class="oblig">*</span>COMISI&Oacute;N T&Eacute;CNICA:</label></td>
                                            <td align="left" colspan="3" width="70%"><input id="ingresarcomision" type="button" value="Cargar comision" onClick="abrirComision();" tabindex="8" style="width:140px;">
                                            <input type="hidden" id="itxtcomision" value=""></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                            <div id="div_comi" class="area2" style="display:block; overflow:auto;"  align="center">
                            
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
                                            <tbody id="cont_comi"></tbody>
                                    </table>
                            
                                    </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>FECHA:</label></td>
                                            <td align="left" colspan="3">
                                              <input type="text" name="itxtfecha" style="width:100px" disabled value="<?php echo date("d-m-Y");?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>EVALUACI&Oacute;N:</label></td>
                                            <td align="left" colspan="3">
                                              <input type="radio" name="radio" id="radioA" value="A" tabindex="9" style="width:25px;"><label>Aprobado</label>&nbsp;&nbsp;<input type="radio" name="radio" id="radioR" value="R" tabindex="10" style="width:25px;"><label>Reprobado</label></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label>OBSERVACI&Oacute;N:</label></td>
                                            <td align="left" colspan="3">
                                            <textarea id="observacionEva" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese una Observaci&oacute;n para la evaluaci&oacute;n" onKeyUp="valida_longitud(this,'255','cuenta')" onFocus="limpText(this)" onBlur="limpText(this)">Sin observaciones...</textarea><div id="cuenta" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div></td>
                                        </tr>
                                        <tr>
                                          <td align="center" colspan="4"><input id="imprimir" type="checkbox" tabindex="18" value="imprimir" class="tooltip" title="Marque esta casilla para mostrar la planilla de evaluaci&oacute;n" checked style="width:30px;"><label>MOSTRAR PLANILLA</label></td>
                                        </tr>
                                        

                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
                                            <td colspan="3"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formEvaluacion','guardarEvaluacion()');" title="Guardar">
                                                    </a>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Limpiar" onClick="limpiarEvaluacion();">
                                                    </a>
                                            </td><!--
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('imprimir','','../img/impresora_a.png',1)">
                                                            <img src="../img/impresora_i.png" alt="imprimir" name="imprimir" width="32" height="32" border="0" title="Imprimir" onClick="ir('index');">
                                                    </a>
                                            </td>
-->
                                        </tr>
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Evaluaciones Registradas
                                        </td>
                                </tr>
                                </table>
                                <div id="div_eva" class="area" style="display:block; overflow:auto;"  align="center">
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="95%" colspan="2">
                                                            Descripci&oacute;n
                                                    </td>
                                                     <!--<td align='center' width="7%">
                                                        Acci&oacute;n
                                                    </td>-->
                                            </tr>
                                            <tbody id="cont_eva"></tbody>
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
                </td><script type="text/javascript">
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
            </tr>
        </table>
        
    <script type="text/javascript" src="../js/menu.js"></script>
</body>
</html>
