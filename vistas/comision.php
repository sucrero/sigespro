<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Docente.php';
    if(!isset ($_GET['destino'])){
        echo '<SCRIPT LANGUAGE=javascript>location.href="aEvaluacion.php"</SCRIPT>';
    }
?>
<div id="dialogProy" class="window">
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Comisi&oacute;n T&eacute;cnica - Docentes ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Seleccione los integrantes para la Comisi&oacute;n T&eacute;cnica</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formComiDoce" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr> 
                                        <tr>
                                            <td width="35%" align="right"><label>BUSCAR:</label></td>
                                            <td width="65%" align="left"><div id="textbdoc" style="display:block;"><input id="itxtcomisiondoc" onkeyup="buscarPerComi(this,event)" type="text" tabindex="1" maxlength="150" style="width:300px" class="mayuscula" /></div><div id="textbint" style="display:none;"><input id="itxtcomisionint" onkeyup="buscarIntComi(this,event,'<?php echo $_GET['sector'] ?>')" type="text" tabindex="1" maxlength="150" style="width:300px" class="mayuscula" /></div></td>                                   
                                        <tr>
                                        <tr>
                                            <td width="100%" colspan="2" align="center">
                                            <input id="ingresarcomisionDoc" type="button" value="Docentes" onClick="mostrarTodoDoc('eva');" tabindex="8" style="width:170px;">&nbsp;&nbsp;&nbsp;<input id="ingresarcomisionPer" type="button" value="Comunidad" onClick="mostrarTodoIntCom('<?php echo $_GET['sector'] ?>','eva');" tabindex="8" style="width:170px;">
                                            </td>                               
                                        <tr>
                                            <td width="35%" align="right" colspan="2">
                                <div id="div_doc" class="area3" style="display:block; overflow:auto;"  align="center">
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" colspan="5">
                                                        Docentes coincidentes
                                                    </td>
                                            </tr>
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="15%">
                                                            C&eacute;dula
                                                    </td>
                                                    <td align="center" width="65%">
                                                            Nombre y Apellido
                                                    </td>
                                                    <td align='center' width="15%" colspan="2">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_doc"></tbody>
                                    </table>
                              
                                    </div>
                                    <div id="div_intcom" class="area3" style="display:none; overflow:auto;"  align="center">
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" colspan="5">
                                                        Personas coincidentes
                                                    </td>
                                            </tr>
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="15%">
                                                            C&eacute;dula
                                                    </td>
                                                    <td align="center" width="65%">
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
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                            <td colspan="2" align="center">&nbsp;</td>
                                        </tr>
                                       
                                        <tr>
                                        	<td align="center">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('listo','','../img/listo_a.png',1);">
                                                            <img src="../img/listo_i.png" alt="listo" name="listo" width="32" height="32" border="0" title="Listo" onClick="validarComision();" />
                                                    </a>
                                            </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1);">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Cancelar" onClick="cerrarComision();" />
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                      </tr>
                    </table>
</div>
        