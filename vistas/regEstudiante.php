<?php
	session_start();
        include_once '../conexion/conexion.php';
        include_once '../clases/Estado.php';
       
?>

<div id="dialog1" class="window">
   
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Registro de Estudiantes ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Validar Estudiante</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formComunidad" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>C&Eacute;DULA:</label></td>
                                            <td width="65%" align="left"><input id="itxtcedulareg" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="1" maxlength="9" style="width:300px" />
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>PRIMER NOMBRE</label></td>
                                            <td>
                                                <a class="showTip L17"><input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="2" maxlength="25" style="width:300px" class="mayuscula" /></a></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PRIMER APELLIDO</label></td>
                                            <td>
                                                <a class="showTip L18"><input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="3" maxlength="25" style="width:300px" class="mayuscula" /></a></td>
                                          </tr>
                                          <tr>
                                            <td align="center" colspan="2"><input id="validarEstu" tabindex="4" type="button" value="Buscar" title="Buscar Estudiante"></td>
                                          </tr>
                                          <tr>
                                              <td align="center" colspan="6"><hr color="#CCCCCC"></td>
                                            </tr>
                                            <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>USUARIO:</label></td>
                                            <td width="65%" align="left"><input id="itxtcedulareg" onFocus="javascrip:select();" type="text" tabindex="5" maxlength="9" style="width:300px" disabled />
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>CLAVE</label></td>
                                            <td>
                                                <a class="showTip L17"><input id="itxtnombre" onFocus="javascrip:select();" type="text" tabindex="6" maxlength="25" style="width:300px" disabled /></a></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>REPITA SU CLAVE</label></td>
                                            <td>
                                                <a class="showTip L18"><input id="itxtapellido" onFocus="javascrip:select();" type="text" tabindex="7" maxlength="25" style="width:300px" disabled /></a></td>
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
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Cancelar" onClick="closeMessage();">
                                                    </a>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                </form>
                                
                            </td>
                      </tr>
                    </table>
</div>
        