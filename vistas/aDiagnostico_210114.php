<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Comunidad.php';
    include_once '../clases/Periodo.php';
    include_once '../clases/Grupo.php';
    include_once '../clases/Estudiante.php';
    include_once '../clases/Docente.php';
    include_once '../clases/Estado.php';
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
       	<script type="text/javascript" src="../js/admDiagnostico.js"></script>
       	<script type="text/javascript" src="../js/admSector.js"></script>
       	<script type="text/javascript" src="../js/admIntCom.js"></script>
       	<script type="text/javascript" src="../js/admComunidad.js"></script>
       	<script type="text/javascript" src="../js/admConsejo.js"></script>
        <script type="text/javascript" src="../js/admGrupo.js"></script>
        <script type="text/javascript" src="../js/admProblema.js"></script>
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
    <title>::: SIGESPRO - Diagn&oacute;stico :::</title>
    </head>
    <body>
    	
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Diagn&oacute;stico ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Diagn&oacute;stico</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formDiagnostico" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="4"><input id="codDiagnos" type="hidden" value="">&nbsp;</td>
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
                                                                            echo'<select id="ilstperiodo" tabindex="1" style="width: 85px" class="mayuscula tooltip" title="Seleccione un per&iacute;odo">';
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
                                                    <select id="ilsttrayecto" tabindex="2" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trayecto">
                                                    <option value="-1" selected>.......</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                    <option value="4">IV</option>
                                                </select></td>
                                                <td width="21,3%" align="right"><label><span class="oblig">*</span>TRIMESTRE:</label></td>
                                                <td width="12%" align="left">
                                                    <select id="ilsttrimestre" tabindex="3" style="width: 75px" class="mayuscula tooltip" title="Seleccione un trimestre">
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
                                                                        echo'<select id="ilstPnf" tabindex="15" style="width: 300px" class="mayuscula tooltip" title="Seleccione un PNF" onChange="mostrarTodo(\'diag\');">';
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
                                           <input type="hidden" id="itxtcoddia" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="right"><label><span class="oblig">*</span>ESTADO:</label></td>
                                            <td width="70%" align="left">
                                                <?php
                                                    $objEst = new Estado();
                                                    $consulta = $objEst->mostrar("select * from estado ORDER BY descripestado ASC", $acceso);
                                                   if($acceso)
                                                    {
                                                        if($consulta){
                                                            if($acceso->registros > 0){
                                                                echo'<select id="ilstestado" onChange="mMunicipiosDiag();" tabindex="4" style="width: 300px" class="mayuscula tooltip" title="Seleccione un estado">';
                                                                echo '<option value="-1">Seleccione...</option>';
                                                                do{
                                                                   // $sel = '';
                                                                    $fila = $acceso->devolver_recordset();
                                                                    /*if($fila['idestado'] == '19'){
                                                                                    $sel ='selected';
                                                                    }*/
                                                                    echo '<option value="'.$fila['idestado'].'">'.htmlentities(strtoupper($fila['descripestado']),ENT_QUOTES,'UTF-8').'</option>';
                                                                    $i++;
                                                                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                
                                                            }else{
                                                                echo'<select id="ilstestado" disabled style="width: 205px">';
                                                                echo '<option value="-1">No se encontraron registros...</option>';
                                                            }
                                                        }else{
                                                            echo'<select id="ilstestado" disabled style="width: 205px">';
                                                            echo '<option value="-1">No se encontraron registros...</option>';
                                                        }
                                                        echo'</select>';
                                                    }
                                        ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO</label></td>
                                            <td>
                                                <select id="ilstmunicipio" onChange="mParroquias();" tabindex="5" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>
                                                </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <select id="ilstparroquia" onChange="mComunidadesDiag();" tabindex="6" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>
                                        <tr>
                                            <td width="30%" align="right"><label><span class="oblig">*</span>COMUNIDAD:</label></td>
                                            <td width="70%" align="left" colspan="3" >
                                                <select id="ilstcomunidad" tabindex="7" style="width: 300px" class="mayuscula tooltip" title="Seleccione o ingrese una comunidad" onChange="buscarSectoresDiag(1);" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>&nbsp;<input id="ingresarcomunidad" type="button" value="Ingresar" onClick="ventaEmergenteComunidad();" tabindex="8" style="width:70px;"></td>
<!--<input id="ingresarcomunidad" type="button" value="Ingresar" onClick="displayMessage('comunidad.php')" tabindex="5"><span class="hint">Seleccione o Ingrese una Comunidad<span class="hint-pointer">&nbsp;</span></span></td>-->
                                                              <!-- <input id="ingresarcomunidad" type="button" value="Ingresar" onClick="mostrarW();" tabindex="5"><span class="hint">Seleccione o Ingrese una Comunidad<span class="hint-pointer">&nbsp;</span></span></td>-->
                                        </tr>
                                  <tr>
                                            <td align="right"><label><span class="oblig">*</span>SECTOR COMUNIDAD:</label></td>
                                            <td align="left" colspan="3">
                                                <select name="diag" id="ilstsectorcomun" tabindex="9" onChange="buscarResponsables(1);" style="width: 300px" class="mayuscula tooltip" title="Seleccione o ingrese un sector" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>&nbsp;<input id="ingresarsector" type="button" tabindex="10" value="Ingresar" onClick="ventaEmergenteSector();" style="width:70px;"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>RESPONSABLE COMUNIDAD:</label></td>
                                            <td align="left" colspan="3">
                                                <!--<select id="ilstreponsable" tabindex="11" style="width: 300px" class="mayuscula tooltip" title="Seleccione o ingrese un responsable" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>-->
                                                <input type="text" maxlength="254" id="itxtresponsable" tabindex="13" class="mayuscula tooltip" title="Responsable de la Comunidad" disabled>&nbsp;<input id="ingresarresponsable" type="button" tabindex="12" value="Ingresar" onClick="abrirResponsable();" style="width:70px;"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>CONSEJO COMUNAL:</label></td>
                                            <td align="left" colspan="3">
                                                <!--<input type="text" maxlength="254" id="txtNomConsejoComun" tabindex="13" class="mayuscula tooltip" title="Ingrese el nombre del consejo comunal">-->
                                                <textarea id="txtNomConsejoComun" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title=" Nombre del consejo comunal" disabled></textarea>&nbsp;<input id="ingresarconsejo" type="button" tabindex="12" value="Ingresar" onClick="abrirConsejo();" style="width:70px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" align="center" colspan="4"><hr color="#CCCCCC"></td>
                                        </tr>
                                        <tr>
                                            <td width="18%" align="right"><label><span class="oblig">*</span>T&Iacute;TULO DIAGN&Oacute;STICO:</label></td>
                                            <td width="29%" align="left" colspan="3">
                                            <textarea id="itxttitulodiagnostico" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese el t&iacute;tulo del diagn&oacute;stico" onKeyUp="valida_longitud(this,'255','cuenta1')"></textarea><div id="cuenta1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div><!--<input type="text" id="itxttitulodiagnostico" tabindex="14" class="mayuscula">--></td>
                                        </tr>
                                        <tr>
                                            <td width="18%" align="right"><label><span class="oblig">*</span>SECCI&Oacute;N:</label></td>
                                            <td width="29%" align="left" colspan="3">
                                                <input type="text" maxlength="2" id="itxtseccion" tabindex="16" onKeyPress="return numeros(event);" class="tooltip" title="Ingrese la secci&oacute;n, m&aacute;ximo 2 d&iacute;gitos"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>GRUPO:</label></td>
                                            <td align="left" colspan="3">
                                                <table border="0px" cellpadding="0px" cellspacing="0px" width="50%">
                                                    <tr>
                                                        <td  width="25%" align="center">
                                                            <input id="seleccionargrupo" type="button" onClick="abrirGrupo('formDiagnostico');" tabindex="17" value="Ingresar" class="tooltip" title="Presione aqu&iacute; para formar un grupo" style="width:70px;"><input type="hidden" id="itxtgrupo" value="">
                                                                <input type="hidden" id="itxtgrupoMod" value=""><input type="hidden" id="itxtgrupoTable" value="">
                                                        </td>
                                                        <td width="25%" align="center">
                                                        	<input id="limpiartablagrupodiag" type="button" onClick="limpiarTabla('cont_grupo');" tabindex="18" value="Limpiar" style="width:70px;" class="tooltip" title="Presione aqu&iacute; para limpiar el grupo formado">
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
                                            <td align="right"><label><span class="oblig">*</span>PROBLEMA(S):</label></td>
                                            <td align="left" colspan="3"><input type="hidden" id="itxtproblemas" value="">
                                                <input id="ingresarproblema" tabindex="19" type="button" value="Ingresar" onClick="abrirProblemas();" style="width:70px;" class="tooltip" title="Presione aqu&iacute; para agregar problemas"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" width="100%" colspan="4"><br/><label>SELECCIONE UN PROBLEMA</label></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                            <div id="div_problem" class="area2" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="10%">
                                                            Item
                                                    </td>
                                                    <td align='center' width="75%">
                                                        Descripci&oacute;n
                                                    </td>
                                                    <td align='center' width="15%">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_problem"></tbody>
                                    </table>
                            
                                    </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>FECHA:</label></td>
                                            <td align="left" colspan="3">
                                                  <input type="text" id="itxtfecha" style="width:100px" disabled value="<?php echo date("d-m-Y");?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>DOCENTE:</label></td>
                                            <td align="left" colspan="3"><select id="ilstdocente" tabindex="20" style="width: 300px" class="mayuscula tooltip" title="Seleccione un docente" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>
                                                    </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>TUTOR ACAD&Eacute;MICO:</label></td>
                                            <td align="left" colspan="3">
                                                <select id="ilsttutor" tabindex="21" style="width: 300px" class="mayuscula tooltip"  title="Seleccione un tutor" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label>OBSERVACI&Oacute;N:</label></td>
                                            <td align="left" colspan="3">
                                                <textarea id="txtobservacion" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese una observaci&oacute;n" onKeyUp="valida_longitud(this,'255','cuenta')" onFocus="limpText(this)" onBlur="limpText(this)">Sin observaciones...</textarea><div id="cuenta" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div></td>
                                        </tr>
                                        <tr>
                                          <td align="center" colspan="4">
                                              <input id="imprimir" type="checkbox" tabindex="23" value="imprimir" checked style="width:30px;" class="tooltip" title="Marque esta casilla para mostrar la planilla de registro"><label>MOSTRAR PLANILLA</label></td>
                                        </tr>

                                    </table>
                                    <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="3"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                    
                                                    <div id='btningresar' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                        <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" class="tooltip" onClick="valForm('formDiagnostico','validarDiagnostico(1)');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" class="tooltip" onClick="valForm('formDiagnostico','validarDiagnostico(2)');" title="Modificar">
                                                    </a>
                                                    </div>
                                                    
                                                    
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="limpiar" name="limpiar" width="32" height="32" class="tooltip" border="0" title="Limpiar" onClick="limpiarDiagnostico()">
                                                    </a>
                                            </td><!--
                                            <td align="center">
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
                                        Diagn&oacute;sticos Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_diag" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="80%">
                                                            T&iacute;tulo Diagn&oacute;stico
                                                    </td>
                                                     <td align='center' width="15%" colspan="2">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_diag"></tbody>
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