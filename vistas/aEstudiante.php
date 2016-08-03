<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Pnf.php';
    include_once '../clases/Estado.php';
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
        <script type="text/javascript" src="../js/admEstudiante.js"></script>
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
            addLoadEvent(mostrarTodoE);
            //addLoadEvent(MM_preloadImages(+'"../img/aplicar_a.png","../img/cancelar_a.png","../img/home_a.png"'+), "");
            addLoadEvent(foco,'0');
        </script>
    <title>::: SIGESPRO - Estudiante :::</title>
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Estudiante ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Estudiante</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formEstudiante" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
										
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>C&Eacute;DULA:</label></td>
                                            <td width="65%" align="left">
                                                <select id="ilstnac" tabindex="10" style="width: 60px" class="mayuscula tooltip" title="Seleccione una nacionalidad">
                                                    <option value="V" selected>V</option>
                                                    <option value="E">E</option>
                                                </select><input id="itxtcedula" onFocus="javascrip:select();" onKeyPress="return numeros(event);" onKeyUp="busEst(this,event);" onBlur="busEst(this,event);" type="text" tabindex="1" maxlength="8" style="width:240px" class="tooltip" title="Ingrese su n&uacute;mero de c&eacute;dula"><br/><span id="fecha">Ingrese una C&eacute;dula y presione ENTER</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td align="left">
                                                <input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="2" maxlength="25" style="width:300px" class="mayuscula tooltip"  title="Ingrese su nombre" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>APELLIDO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="3" maxlength="25" style="width:300px" class="mayuscula tooltip" title="Ingrese su apellido" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>SEXO</label></td>
                                            <td>
                                                <select id="ilstsexo" tabindex="4" style="width: 300px" class="mayuscula tooltip" title="Seleccione su sexo" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                </select></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label>FECHA DE NACIMIENTO</label></td>
                                            <td align="left">
                                                <input onChange="" id="dtxtfecnac" onFocus="javascrip:select();" type="text" maxlength="8" style="width:300px" disabled>&nbsp;<input type="button" name="btncalendaI" id="btncalenda" value="..." tabindex="5" class="tooltip" title="Click para ingresar su fecha de nacimiento" disabled style="width:30px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label>TEL&Eacute;FONO:</label></td>
                                            <td align="left">
                                                <input id="txttelf" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="6" maxlength="11" style="width:300px" class="mayuscula tooltip" title="Ingrese su n&uacute;mero de tel&eacute;fono" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>PNF:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                        $objPnf = new Pnf();
                                                        $consulta = $objPnf->buscar("select * from pnf order by descripcionpnf ASC", $acceso);
                                                           if($acceso)
                                                            {
                                                                if($consulta){
                                                                    if($acceso->registros > 0){
                                                                        echo'<select id="ilstPnf" tabindex="7" style="width: 300px" class="mayuscula tooltip" title="Seleccione una PNF" disabled>';
                                                                        echo '<option value="-1">Seleccione...</option>';
                                                                        do{
                                                                                $fila = $acceso->devolver_recordset();
                                                                                echo '<option value="'.$fila['idpnf'].'">'.strtoupper($fila['descripcionpnf']).'</option>';
                                                                                $i++;
                                                                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                        echo'</select>';
                                                                    }else{
                                                                        echo'<select id="ilstPnf" disabled style="width: 205px">';
                                                                        echo '<option value="-1">No se encontraron registros...</option>';
                                                                    }
                                                                }else{
                                                                    echo'<select id="ilstPnf" disabled style="width: 205px">';
                                                                    echo '<option value="-1">No se encontraron registros...</option>';
                                                                }
                                                            }
                                        ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>ESTADO:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                    $objEst = new Estado();
                                                    $consulta = $objEst->mostrar("select * from estado ORDER BY descripestado ASC", $acceso);
                                                   if($acceso)
                                                    {
                                                        if($consulta){
                                                            if($acceso->registros > 0){
                                                                echo'<select id="ilstestado" onChange="mMunicipios();" tabindex="8" style="width: 300px" class="mayuscula tooltip" title="Seleccione un estado" disabled>';
                                                                echo '<option value="-1">Seleccione...</option>';
                                                                do{
                                                                        $fila = $acceso->devolver_recordset();
                                                                        echo '<option value="'.$fila['idestado'].'">'.strtoupper($fila['descripestado']).'</option>';
                                                                        $i++;
                                                                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                echo'</select>';
                                                            }else{
                                                                echo'<select id="ilstestado" disabled style="width: 205px">';
                                                                echo '<option value="-1">No se encontraron registros...</option>';
                                                            }
                                                        }else{
                                                            echo'<select id="ilstestado" disabled style="width: 205px">';
                                                            echo '<option value="-1">No se encontraron registros...</option>';
                                                        }
                                                    }
                                        ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO</label></td>
                                            <td>
                                                <select id="ilstmunicipio" onChange="mParroquias();" tabindex="9" style="width: 300px" class="mayuscula tooltip" title="Seleccione un municipio" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <!--<select id="ilstparroquia" onChange="mCuminidades();" tabindex="10" style="width: 300px" class="mayuscula tooltips" title="Seleccione una parroquia" disabled>-->
                                                <select id="ilstparroquia" tabindex="10" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>
                                         <!-- <tr>
                                            <td align="right"><label><span class="oblig">*</span>COMUNIDAD</label></td>
                                            <td>
                                                <a class="showTip L11"><select id="ilstcomunidad" tabindex="11" style="width: 300px" class="mayuscula" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></a></td>
                                          </tr>-->
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>DIRECCI&Oacute;N:</label></td>
                                            <td width="65%" align="left">
                                            <textarea id="itxtdireccion" rows="4" cols="35" tabindex="12" class="mayuscula tooltip" title="Ingrese una direcci&oacute;n" onKeyUp="valida_longitud(this,'100','cuenta1')" disabled></textarea><div id="cuenta1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">100</div>
                                                <!--<input id="itxtdireccion" onFocus="javascrip:select();" type="text" tabindex="12" maxlength="90" style="width:300px" class="mayuscula tooltips" title="Ingrese una direcci&oacute;n" disabled>--><input type="hidden" id="ilstcomunidad" value="1" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>CORREO ELECTR&Oacute;NICO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtemail" onFocus="javascrip:select();" type="text" tabindex="13" maxlength="50" style="width:300px" class="mayuscula tooltip" title="Ingrese un correo electr&oacute;nico<br><b>Ejem. sucorreo@dominio.com</b>" disabled>
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
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formEstudiante','guardarEstudiante()');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formEstudiante','modificarEstudiante()');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="limpiar" name="limpiar" width="32" height="32" border="0" title="Limpiar" onClick="limpiarEstu('formEstudiante')">
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Estudiantes Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_est" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="10%">
                                                            C&eacute;dula
                                                    </td>
                                                    <td align='center' width="70%">
                                                        Nombre y Apellido
                                                    </td>
                                                    <td align='center' width="15%" colspan="2">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_est"></tbody>
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
Calendar.setup({inputField : "dtxtfecnac",ifFormat : "%d/%m/%Y",button : "btncalenda"});
</script>
