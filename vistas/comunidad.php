<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Estado.php';
    include_once '../clases/Municipio.php';
    include_once '../clases/Parroquia.php';
    if(!isset ($_GET['destino'])){
        echo '<SCRIPT LANGUAGE=javascript>location.href="aDiagnostico.php"</SCRIPT>';
    }
?>

<div id="dialog1" class="window">
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Comunidad ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos de la Comunidad</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formComunidad" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>ESTADO:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                    if($_GET['destino'] == 1){
                                                        $objEst = new Estado();
                                                        $sql = "select * from estado where idestado='".$_GET['estado']."'";
                                                        $objEst->buscar($sql, $acceso);
                                                        $fila = $acceso->devolver_recordset();
                                                        echo '<input id="itxtestado" type="text" tabindex="1" maxlength="90" style="width:300px" class="mayuscula tooltip" value="'.$fila['descripestado'].'" title="Estado" readonly />';
                                                    }else{
                                                        $objEst = new Estado();
                                                    	$consulta = $objEst->mostrar("select * from estado ORDER BY descripestado ASC", $acceso);
                                                        if($acceso){
                                                            if($consulta){
                                                                if($acceso->registros > 0){
                                                                    echo'<select id="ilstestado" onChange="mMunicipiosCom();" tabindex="20" style="width: 300px" class="mayuscula tooltip" title="Seleccione un estado">';
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
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 1){
                                                        $objMun = new Municipio();
                                                        $sql = "select * from municipio where idmunicipio='".$_GET['municipio']."'";
                                                        $objMun->buscar($sql, $acceso);
                                                        $fila = $acceso->devolver_recordset();
                                                        echo '<input id="itxtmunicipio" type="text" tabindex="1" maxlength="90" style="width:300px" class="mayuscula tooltip" value="'.$fila['descripmunicipio'].'" title="Municipio" readonly/>';
                                                    }else{
                                                        echo '<select id="ilstmunicipio" onChange="mParroquiasCom();" tabindex="21" style="width: 300px" class="mayuscula tooltip" title="Seleccione un municipio" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>';
                                                    }
                                                ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 1){
                                                        $objPar = new Parroquia();
                                                        $sql = "select * from parroquia where idparroquia='".$_GET['parroquia']."'";
                                                        $objPar->buscar($sql, $acceso);
                                                        $fila = $acceso->devolver_recordset();
                                                        echo '<input id="itxtparroquia" type="text" tabindex="1" maxlength="90" style="width:300px" class="mayuscula tooltip" title="Parroquia" value="'.$fila['descripparroquia'].'" readonly/>';
                                                    }else{
                                                        echo '<select id="ilstparroquia" onChange="javascript:itxtnombrecomuni.focus();" tabindex="22" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select>';
                                                    }
                                                ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>NOMBRE DE LA COMUNIDAD:</label></td>
                                            <td width="65%" align="left">
                                            	<input id="itxtnombrecomuni" onFocus="javascrip:select();" type="text" tabindex="23" maxlength="150" style="width:300px" class="mayuscula tooltip" title="Ingrese el nombre de la comunidad" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>DIRECCI&Oacute;N DE LA COMUNIDAD:</label></td>
                                            <td align="left">
                                            	<input id="itxtdireccioncomuni" onFocus="javascrip:select();" type="text" tabindex="24" maxlength="90" style="width:300px" class="mayuscula tooltip" title="Ingrese la direcci&oacute;n de la comunidad" />
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                            Datos del Sector</td>
                                    </tr>
                                    <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>NOMBRE DEL SECTOR:</label></td>
                                            <td width="65%" align="left">
                                                    <input id="itxtdnombresect" onFocus="javascrip:select();" type="text" tabindex="26" maxlength="150" style="width:300px" class="mayuscula tooltip" title="Ingrese el nombre del sector" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>PUNTO DE REFERENCIA:</label></td>
                                            <td align="left">
                                            	<input id="itxtddireccionsect" onFocus="javascrip:select();" type="text" tabindex="27" maxlength="90" style="width:300px" class="mayuscula tooltip" title="Ingrse un punto de referencia" />
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                            Datos del Responsable del Sector</td>
                                    </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>C&Eacute;DULA:</label></td>
                                            <td width="65%" align="left">
                                            <select id="ilstnac" tabindex="10" style="width: 60px" class="mayuscula tooltip" title="Seleccione una nacionalidad">
                                                    <option value="V" selected>V</option>
                                                    <option value="E">E</option>
                                                </select><input id="itxtcedula" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="30" maxlength="8" class="tooltip" style="width:240px" onKeyUp="busInCo(this,event,<?php echo $_GET['destino']; ?>,'comu');" onblur="busInCo(this,event,<?php echo $_GET['destino']; ?>,'comu');" title="Ingrese un n&uacute;mero de c&eacute;dula y presione ENTER"><br/><span id="fecha">Ingrese una C&eacute;dula y presione ENTER</span>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td width="65%" align="left">
                                                    <input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="31" maxlength="25" style="width:300px" class="mayuscula tooltip" title="Ingrese un nombre" disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>APELLIDO:</label></td>
                                            <td align="left">
                                                    <input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="32" maxlength="25" style="width:300px" class="mayuscula tooltip" title="Ingrese un apellido" disabled/>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td align="right"><label><span class="oblig">*</span>SEXO</label></td>
                                            <td>
                                                <select id="ilstsexo" tabindex="9" style="width: 300px" class="mayuscula tooltip" title="Seleccione su sexo" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                </select></td>
                                          </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>TEL&Eacute;FONO:</label></td>
                                            <td align="left">
                                                    <input id="itxttelf" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="33" maxlength="11" style="width:300px" class="mayuscula tooltip" title="Ingrese un n&uacute;mero de tel&eacute;fono" disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>DIRECCI&Oacute;N:</label></td>
                                            <td align="left">
                                                    <input id="itxtdireccion" onFocus="javascrip:select();" type="text" tabindex="34" maxlength="100" style="width:300px" class="mayuscula tooltip" title="Ingrese una direcc&oacute;n" disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>CORREO ELECTR&Oacute;NICO:</label></td>
                                            <td align="left">
                                                    <input id="itxtemail" onFocus="javascrip:select();" type="text" tabindex="35" maxlength="50" style="width:300px" class="mayuscula tooltip" title="Ingrese un correo electr&oacute;nico<br><b>Ejem. sucorreo@dominio.com</b>" disabled/>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>STATUS:</label></td>
                                            <td width="65%" align="left">
                                                <input name="rdoTipo" id="rdoActivo" type="radio" value="1" style="width:0px;" disabled><label>ACTIVO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoInactivo" type="radio" value="-1" style="width:0px;" disabled><label>INACTIVO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoRepresentante" type="radio" value="2" style="width:0px;" disabled checked><label>REPRESENTANTE</label>
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
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1);">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formComunidad','guardarComunidad('+ <?php echo $_GET['destino']; ?>+')');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1);">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formComunidad','modificarComunidad()');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1);">
                                                            <img src="../img/cancelar_i.png" alt="<?php if($_GET['destino']==1){echo 'Cerrar';}else{echo 'Limpiar';}?>" name="cancelar" width="32" height="32" border="0" title="<?php if($_GET['destino']==1){echo 'Cerrar';}else{echo 'Limpiar';}?>" onClick="<?php if($_GET['destino']==1){echo 'closeMessage();';}else{echo 'limpiarC();';}?>">
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                                    if($_GET['destino'] != 1){
                                        echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                                        Comunidades Registradas</td>
                                        </tr>
                                        </table>
                                        <div id="div_com" class="area" style="display:block; overflow:auto;"  align="center">
                                            <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                                <tr class="tablaCont" onClick="">
                                                            <td align="center" width="5%">
                                                                    Item
                                                            </td>
                                                            <td align="center" width="80%">
                                                                    Nombre
                                                            </td>
                                                            <td align="center" width="15%" colspan="2">
                                                                Acci&oacute;n
                                                            </td>
                                                    </tr>
                                                    <tbody id="cont_com"></tbody>
                                            </table>
                                        </div>';
                                }
                                ?>
                            </td>
                      </tr>
                    </table>
</div>