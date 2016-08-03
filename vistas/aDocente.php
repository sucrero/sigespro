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
        <!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MENU -->
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
        <script type="text/javascript" src="../js/admDocente.js"></script>
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
        
        <script type="text/javascript">
        //    addLoadEvent(prepareInputsForHints);
            addLoadEvent(mostrarTodoDoc('doce'));
            //addLoadEvent(MM_preloadImages(+'"../img/aplicar_a.png","../img/cancelar_a.png","../img/home_a.png"'+), "");
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
				position: 'right',
				theme: '.tooltipster-light',
				interactive: 'true'
			});
			
		});
	</script>
       
	<!--[if lt IE 9]>
		<script src="../tooltips/js/html5.js"></script>
	<![endif]-->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS TOOLTIPS -->
    <title>::: SIGESPRO - Docente :::</title>
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
                        	<td width="100%" align="left"><?php include 'banner.html'; ?></td>
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
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Docente ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Docente</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formDocente" method="post">
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
                                                </select><input id="itxtcedula" onFocus="javascrip:select();" onKeyPress="return numeros(event);" onKeyUp="busDoc(this,event);" onBlur="busDoc(this,event);" type="text" tabindex="1" maxlength="8" style="width:240px" class="tooltip" title="Ingrese su N&uacute;mero de C&eacute;dula y presiones ENTER">
                                               
                                                <br/><span id="fecha">Ingrese una C&eacute;dula y presione ENTER</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td align="left"><input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="2" maxlength="25" style="width:300px" class="mayuscula tooltip" disabled title="Ingrese su Nombre">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>APELLIDO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="3" maxlength="25" style="width:300px" class="mayuscula tooltip" disabled title="Ingrese su Apellido">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>SEXO</label></td>
                                            <td>
                                                <select id="ilstsexo" tabindex="4" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione su Sexo">
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                </select></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label>FECHA DE NACIMIENTO</label></td>
                                            <td align="left"><input onChange="" id="dtxtfecnac" onFocus="javascrip:select();" type="text" maxlength="8" style="width:300px" disabled class="tooltip" title="Ingrese su Fecha de Nacimiento">&nbsp;<input type="button" name="btncalendaI" id="btncalenda" value="..." tabindex="5" disabled style="width:30px;" class="tooltip" title="Ingrese su Fecha de Nacimiento">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label>TEL&Eacute;FONO:</label></td>
                                            <td align="left"><input id="txttelf" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="6" maxlength="11" style="width:300px" class="mayuscula tooltip" disabled title="Ingrese su N&uacute;mero de Tel&eacute;fono.<br>Debe contener 11 d&iacute;gitos">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>PNF:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                        $objPnf = new Pnf();
                                                        $consulta = $objPnf->buscar("select * from pnf", $acceso);
                                                           if($acceso)
                                                            {
                                                                if($consulta){
                                                                    if($acceso->registros > 0){
                                                                        echo'<select id="ilstPnf" tabindex="7" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione el PNF">';
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
                                                                echo'<select id="ilstestado" onChange="mMunicipios();" tabindex="8" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione el Estado donde reside">';
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
                                                <select id="ilstmunicipio" onChange="mParroquias();" tabindex="9" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione el Municipio donde reside">
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <select id="ilstparroquia" tabindex="10" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione la Parroquia donde reside">
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>
                                          <!--<tr>
                                            <td align="right"><label><span class="oblig">*</span>COMUNIDAD</label></td>
                                            <td>
                                                <select id="ilstcomunidad" tabindex="11" style="width: 300px" class="mayuscula tooltip" disabled title="Seleccione la Comunidad donde reside.<br>Debe registrar previamente la Comunidad <a href='aComunidad.php'>link</a>">
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                          </tr>-->
                                          <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>GRADO DE INSTRUCCI&Oacute;N:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtgradoinstruccion" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="12" maxlength="54" style="width:300px" class="mayuscula tooltip" title="Ingrese su grado d einstrucci&oacute;n" disabled><input type="hidden" id="ilstcomunidad" value="1" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>PROFESI&Oacute;N:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtprofesion" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="13" maxlength="54" style="width:300px" class="mayuscula tooltip" title="Ingrese su profesi&oacute;n" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>DIRECCI&Oacute;N:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtdireccion" onFocus="javascrip:select();" type="text" tabindex="14" maxlength="90" style="width:300px" class="mayuscula tooltip" title="Ingrese su direcci&oacute;n" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>CORREO ELECTR&Oacute;NICO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtemail" onFocus="javascrip:select();" type="text" tabindex="15" maxlength="50" style="width:300px" class="mayuscula tooltip" title="Ingrese un correo electr&oacute;nico<br><b>Ejem. sucorreo@dominio.com</b>" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td align="right"><label><span class="oblig">*</span>JEFE DEL PNF:</label></td>
                                          <td align="left">
                                          	<input name="rdoJefe" id="rdoSi" type="radio" value="1" style="width:0px;" disabled><label>SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoJefe" id="rdoNo" type="radio" value="2" style="width:0px;" checked disabled><label>NO</label></td>
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
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formDocente','guardarDocente()');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formDocente','modificarDocente()');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Limpiar" onClick="limpiar('formDocente');">
                                                    </a>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Docentes Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_doc" class="area" style="display:block; overflow:auto;"  align="center">
                            
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
                                            <tbody id="cont_doc"></tbody>
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
