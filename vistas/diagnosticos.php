<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Diagnostico.php';
    if(!isset ($_GET['destino'])){
        echo '<SCRIPT LANGUAGE=javascript>location.href="aAnteproyecto.php"</SCRIPT>';
    }
?>
<div id="dialogDiag" class="window">
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Cat&aacute;logo de Diagn&oacute;sticos ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                B&uacute;sque o seleccione el t&iacute;tulo del Diagn&oacute;stico</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formMostDiag" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr> 
                                        <tr>
                                            <td width="35%" align="right"><label>BUSCAR:</label></td>
                                            <td width="65%" align="left"><input id="txtbusdiag" onkeyup="buscarDiagLe(this,event)" type="text" tabindex="1" maxlength="150" style="width:300px" class="mayuscula" /><input type="hidden" id="txtpnf" value="<?php echo $_GET['pnf']; ?>"></td>
                                        <tr>
                                            <td width="35%" align="right" colspan="2">
                                <div id="div_diag" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="95%">
                                                            T&iacute;tulo Diagn&oacute;stico
                                                    </td>
                                            </tr>
                                            <tbody id="cont_diag"></tbody>
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
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1);">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Cancelar" onClick="closeMessage();" />
                                                    </a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                      </tr>
                    </table>
</div>
        