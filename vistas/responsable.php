<?php
	session_start();
        include_once '../conexion/conexion.php';
        include_once '../clases/Sectorcomunidad.php';
        include_once '../clases/Comunidad.php';

        if(!isset ($_GET['destino']) && !isset ($_GET['comuni'])){
            echo '<SCRIPT LANGUAGE=javascript>location.href="index.php"</SCRIPT>';
        }
        if($_GET['sector']==-1){
            echo '<SCRIPT LANGUAGE=javascript>alert("Debe seleccionar un Sector");location.href="aDiagnostico.php";</SCRIPT>';
        }
?>
<div id="dialog1" class="window">
   
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">
                                    <?php
                                        if($_GET['destino'] == 2){
                                            echo '[ Administrar Integrantes Comunidad ]';
                                        }else{
                                            echo '[ Administrar Responsable ]';
                                        }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos de la Persona</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formIntCom" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
										<tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>ESTADO:</label></td>
                                            <td width="65%" align="left">
                                            <?php
                                                if($_GET['destino'] == 2){
                                                        $objEst = new Estado();
                                                        $consulta = $objEst->mostrar("select * from estado ORDER BY descripestado ASC", $acceso);
                                                        if($acceso)
                                                        {
                                                                if($consulta){
                                                                        if($acceso->registros > 0){
                                                                                echo'<a class="showTip L8"><select id="ilstestado" onChange="mMunicipiosIn();" tabindex="1" style="width: 300px" class="mayuscula tooltip" title="Seleccione un Estado">';
                                                                                echo '<option value="-1">Seleccione...</option>';
                                                                                do{
                                                                                               // $sel = '';
                                                                                                $fila = $acceso->devolver_recordset();
                                                                                               /* if($fila['idestado'] == '19'){
                                                                                                        $sel ='selected';
                                                                                                }*/
                                                                                                echo '<option value="'.$fila['idestado'].'" '.$sel.'>'.strtoupper($fila['descripestado']).'</option>';
                                                                                                $i++;
                                                                                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                                                                echo'</select></a>';
                                                                        }else{
                                                                                echo'<select id="ilstestado" disabled style="width: 205px">';
                                                                                echo '<option value="-1">No se encontraron registros...</option>';
                                                                        }
                                                                }else{
                                                                        echo'<select id="ilstestado" disabled style="width: 205px">';
                                                                        echo '<option value="-1">No se encontraron registros...</option>';
                                                                }
                                                        }
                                                }else{
                                                    echo '<input id="ilstestado" type="text" value="'.strtoupper($_GET['est']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstmunicipio" onChange="mParroquiasIn();" tabindex="2" style="width: 300px" class="mayuscula tooltip" title="Seleccione un municipio" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                                <?php    
                                                    }else{
                                                        echo '<input id="ilstmunicipio" type="text" value="'.strtoupper($_GET['mun']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstparroquia" tabindex="3" onChange="mCuminidadesIn();" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstparroquia" type="text" value="'.strtoupper($_GET['par']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>COMUNIDAD</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstcomunidad" onChange="buscarSectoresIn();" tabindex="4" style="width: 300px" class="mayuscula tooltip" title="Seleccione una Comunidad" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstcomunidad" type="text" value="'.strtoupper($_GET['comuni']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>SECTOR COMUNIDAD:</label></td>
                                            <td align="left" colspan="3">
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstsectorcomun" tabindex="5" style="width: 300px" class="mayuscula tooltip" title="Seleccione un Sector" onChange="mostrarTodoIntCom('','');" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstsectorcomun" type="text" name="'.$_GET['idsector'].'" value="'.strtoupper($_GET['sector']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" align="center" colspan="4"><hr color="#CCCCCC"></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>C&Eacute;DULA:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                    if($_GET['destino'] == 2){
                                                        $deshabilitado = 'disabled'; 
                                                    }else{
                                                        $deshabilitado = ''; 
                                                    }
                                                ?>
                                                <select id="ilstnac" tabindex="10" style="width: 60px" class="mayuscula tooltip" <?php echo $deshabilitado; ?> title="Seleccione una nacionalidad">
                                                    <option value="V" selected>V</option>
                                                    <option value="E">E</option>
                                                </select><input id="itxtcedula" onFocus="javascrip:select();" onKeyPress="return numeros(event);" onKeyUp="busInCo(this,event,<?php echo $_GET['destino']; ?>,'resp');" onBlur="busInCo(this,event,<?php echo $_GET['destino']; ?>,'resp');" type="text" tabindex="6" maxlength="8" style="width:240px" class="tooltip" title="Ingrese su n&uacute;mero de c&eacute;dula" <?php echo $deshabilitado; ?>><br/><span id="fecha">Ingrese una C&eacute;dula y presione ENTER</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td align="left">
                                                <input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="7" maxlength="25" style="width:300px" class="mayuscula tooltip"  title="Ingrese su nombre" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>APELLIDO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="8" maxlength="25" style="width:300px" class="mayuscula tooltip" title="Ingrese su apellido" disabled>
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
                                                <input id="itxttelf" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="10" maxlength="11" style="width:300px" class="mayuscula tooltip" title="Ingrese su n&uacute;mero de tel&eacute;fono" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>DIRECCI&Oacute;N:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtdireccion" onFocus="javascrip:select();" type="text" tabindex="11" maxlength="90" style="width:300px" class="mayuscula tooltip" title="Ingrese una direcci&oacute;n" disabled><input type="hidden" id="ilstcomunidad" value="1" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>CORREO ELECTR&Oacute;NICO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtemail" onFocus="javascrip:select();" type="text" tabindex="12" maxlength="50" style="width:300px" class="mayuscula tooltip" title="Ingrese un correo electr&oacute;nico" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>STATUS:</label></td>
                                            <td width="65%" align="left">
                                                <input name="rdoTipo" id="rdoActivo" type="radio" value="1" <?php if($_GET['destino'] == 2){echo 'checked';}?> style="width:0px;" disabled><label>ACTIVO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoInactivo" type="radio" value="-1" style="width:0px;" disabled><label>INACTIVO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rdoTipo" id="rdoRepresentante" type="radio" value="2" style="width:0px;" disabled <?php if($_GET['destino'] == 1){echo 'checked';}?>><label>REPRESENTANTE</label>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                            <td colspan="2" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td align="center">
                                            		<div id='btningresarIn' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" class="tooltip" onClick="valForm('formIntCom','guardarIntCom('+ <?php echo $_GET['destino']; ?>+')');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificarIn' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" class="tooltip" onClick="valForm('formIntCom','modificarIntCom('+ <?php echo $_GET['destino']; ?>+')');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" class="tooltip" title="<?php if($_GET['destino']==1){echo 'Cancelar';}else{echo 'Limpiar';}?>" onClick="<?php if($_GET['destino']==1){echo 'closeMessage();';}else{echo 'limpiarIn(\'limpiar\',\'\');';}?>">
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Integrantes Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_intcom" class="area" style="display:block; overflow:auto;"  align="center">
                            
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
                                            <tbody id="cont_intcom"></tbody>
                                    </table>
                            
                                    </div>
                            </td>
                      </tr>
                    </table>
</div>
        