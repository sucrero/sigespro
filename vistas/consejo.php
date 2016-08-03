<?php
	session_start();
        include_once '../conexion/conexion.php';
        include_once '../clases/Sectorcomunidad.php';
        include_once '../clases/Comunidad.php';

        if(!isset ($_GET['destino'])){
            echo '<SCRIPT LANGUAGE=javascript>location.href="index.php"</SCRIPT>';
        }
?>
<div id="dialog1" class="window">
   
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">
                                    [ Administrar Consejo Comunal ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Consejo Comunal</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formConsejo" method="post">
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
                                                                                echo'<select id="ilstestado" onChange="mMunicipiosCon();" tabindex="1" style="width: 300px" class="mayuscula tooltip" title="Seleccione un Estado">';
                                                                                echo '<option value="-1">Seleccione...</option>';
                                                                                do{
                                                                                               // $sel = '';
                                                                                                $fila = $acceso->devolver_recordset();
                                                                                               /* if($fila['idestado'] == '19'){
                                                                                                        $sel ='selected';
                                                                                                }*/
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
                                                }else{
                                                    echo '<input id="ilstestado" type="text" value="'.strtoupper($_GET['estado']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstmunicipio" onChange="mParroquiasCon();" tabindex="2" style="width: 300px" class="mayuscula tooltip" title="Seleccione un municipio" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                </select></td>
                                                <?php    
                                                    }else{
                                                        echo '<input id="ilstmunicipio" type="text" value="'.strtoupper($_GET['municipio']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstparroquia" tabindex="3" onChange="mCuminidadesCon();" style="width: 300px" class="mayuscula tooltip" title="Seleccione una parroquia" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstparroquia" type="text" value="'.strtoupper($_GET['parroquia']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>COMUNIDAD</label></td>
                                            <td>
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstcomunidad" onChange="buscarSectoresCon();" tabindex="4" style="width: 300px" class="mayuscula tooltip" title="Seleccione una Comunidad" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstcomunidad" type="text" value="'.strtoupper($_GET['comunidad']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>SECTOR COMUNIDAD:</label></td>
                                            <td align="left" colspan="3">
                                                <?php
                                                    if($_GET['destino'] == 2){?>
                                                        <select id="ilstsectorcomunCon" tabindex="5" style="width: 300px" class="mayuscula tooltip" title="Seleccione un Sector" onChange="buscarConsejo();" disabled>
                                                            <option value="-1" selected>SELECCIONE...</option>
                                                        </select>
                                                <?php
                                                    }else{
                                                        echo '<input id="ilstsectorcomunCon" type="text" name="'.$_GET['idsector'].'" value="'.strtoupper($_GET['sector']).'" tabindex="26" maxlength="25"  style="width:300px" class="mayuscula" disabled />';
                                                    }
                                                ?>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" align="center" colspan="4"><hr color="#CCCCCC"></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>R.I.F.:</label></td>
                                            <td width="65%" align="left">
                                                <?php
                                                    if($_GET['destino'] == 2){
                                                        $deshabilitado = ''; 
                                                    }else{
                                                        $deshabilitado = ''; 
                                                    }
                                                ?>
                                                <select id="ilsttipo" tabindex="10" style="width: 60px" class="mayuscula">
                                                    <option value="J" selected>J</option>
                                                    <option value="G">G</option>
                                                </select><input id="itxtrif" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="6" maxlength="9" style="width:240px" class="tooltip" title="Ingrese el n&uacute;mero de R.I.F. del consejo comunal" <?php echo $deshabilitado; ?>><input type="hidden" id="codConsejo" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>C&Oacute;DIGO SICOM:</label></td>
                                            <td align="left">
                                                <input id="itxtsicom" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="7" maxlength="6" style="width:300px" class="mayuscula tooltip"  title="Ingrese el c&oacute;dico SICOM del consejo comunal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td align="left">
                                                <!--<input id="itxtnombre" onFocus="javascrip:select();" type="text" tabindex="2" maxlength="255" style="width:300px" class="mayuscula tooltip"  title="Ingrese su nombre">-->
                                                <textarea id="itxtnombre" rows="4" cols="35" tabindex="22" class="mayuscula tooltip" title="Ingrese el nombre del Consejo Comunal" onKeyUp="valida_longitud(this,'255','cuenta1')"></textarea><div id="cuenta1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">255</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label>&Uacute;LTIMA FECHA DE ELECCI&Oacute;N:</label></td>
                                            <td align="left">
                                                <input id="txtfeceleccion" onFocus="javascrip:select();" type="text" maxlength="8" style="width:300px" disabled>&nbsp;<input type="button" name="btncalendaI" id="btncalenda" value="..." tabindex="5" class="tooltip" title="Click para ingresar la fecha de la &uacute;ltima elecci&oacute;n" style="width:30px;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                            <td colspan="2" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                            		<div id='btningresarCon' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" class="tooltip" height="32" border="0" onClick="valForm('formConsejo','guardarConsejo('+ <?php echo $_GET['destino']; ?>+')');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificarCon' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" class="tooltip"  height="32" border="0" onClick="valForm('formConsejo','modificarConsejo('+ <?php echo $_GET['destino']; ?>+')');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" class="tooltip" border="0" title="<?php if($_GET['destino']==1){echo 'Cancelar';}else{echo 'Limpiar';}?>" onClick="<?php if($_GET['destino']==1){echo 'closeMessage();';}else{echo 'limpiarConsejo();';}?>">
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                      </tr>
                    </table>
</div>
<script>
Calendar.setup({inputField : "txtfeceleccion",ifFormat : "%d/%m/%Y",button : "btncalenda"});
</script>