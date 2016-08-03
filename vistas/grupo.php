<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Sectorcomunidad.php';
    include_once '../clases/Comunidad.php';
    if(!isset ($_GET['destino'])){
        echo '<SCRIPT LANGUAGE=javascript>location.href="aDiagnostico.php"</SCRIPT>';
    }
?>
<div id="dialog1" class="window">
   
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Grupo ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Estudiantes disponibles para <?php echo $_GET['pnf']; ?></td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formEstGrupo" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>                                    
                                        <tr>
                                            <td width="35%" align="right" colspan="2">
                                            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                                
                                </table>
                                <div id="div_estgrupo" class="area3" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" colspan="5">
                                                        Seleccione los estudiantes para formar un grupo (M&iacute;nimo 1 y M&aacute;ximo 6 por grupo)
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
                                            <tbody id="cont_estgrupo"></tbody>
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
                                            		<div id='btningresar' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1);">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="validarGrupo('<?php echo $_GET['f']; ?>');" title="Guardar Grupo" />
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1);">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formSector','guardarSector()');" title="Modificar" />
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1);">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Cancelar" onClick="<?php if($_GET['destino']==1 || $_GET['destino']==3){echo 'closeMessage();';}else{echo 'limpiarG();';}?>" />
                                                    </a>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                </form>
                            </td>
                      </tr>
                    </table>
</div>
        