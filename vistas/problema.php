<?php
	session_start();
        include_once '../conexion/conexion.php';
        include_once '../clases/Comunidad.php';
        
        if(!isset ($_GET['destino'])){
            echo '<SCRIPT LANGUAGE=javascript>location.href="aDiagnostico.php"</SCRIPT>';
        }else{
            $destino = $_GET['destino'];
//            echo 'dest: '.$destino;
            $objCom = new Comunidad();
            if($destino == 1){
                $sql = "SELECT 
                        A.descripsector AS SECTOR,
                        A.idsectorcomunidad AS CODSECTOR,
                        B.nomcomuni AS COMUNIDAD, 
                        C.descripparroquia AS PARROQUIA, 
                        D.descripmunicipio AS MUNICIPIO, 
                        E.descripestado AS ESTADO
                      FROM 
                        public.sector_comunidad AS A, 
                        public.comunidad AS B, 
                        public.parroquia AS C, 
                        public.municipio AS D, 
                        public.estado AS E
                      WHERE 
                        A.idcomuni = B.idcomuni AND
                        B.idparroquia = C.idparroquia AND
                        C.idmunicipio = D.idmunicipio AND
                        D.idestado = E.idestado AND
                        A.idsectorcomunidad = '".$_GET['sector']."'";
                
            }else if($destino == 3 || $destino == 4){
                $sql = "SELECT 
                            S.descripsector AS SECTOR,
                            S.idsectorcomunidad AS CODSECTOR,
                            C.nomcomuni AS COMUNIDAD, 
                            A.descripparroquia AS PARROQUIA, 
                            M.descripmunicipio AS MUNICIPIO, 
                            E.descripestado AS ESTADO
                          FROM 
                            public.personal_sector_comunidad AS P, 
                            public.comunidad AS C, 
                            public.sector_comunidad AS S, 
                            public.parroquia AS A, 
                            public.municipio AS M, 
                            public.estado AS E
                          WHERE 
                            P.idsectorcomunidad = S.idsectorcomunidad AND
                            C.idparroquia = A.idparroquia AND
                            S.idcomuni = C.idcomuni AND
                            A.idmunicipio = M.idmunicipio AND
                            M.idestado = E.idestado AND
                            P.idusuario = '".$_SESSION['codUsu']."'";
            }
            if($objCom->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $fila = $acceso->devolver_recordset();
                    $estado = $fila['estado'];
                    $municipio = $fila['municipio'];
                    $parroquia = $fila['parroquia'];
                    $sector = $fila['sector'];
                    $comunidad = $fila['comunidad'];
                    $codigoSector = $fila['codsector'];
					echo '<input id="ilstsector" type="hidden" name="'.$codigoSector.'" />';
                }
            }
        }
?>

<div id="dialog1" class="window" >
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Problema ]</span></td>
                        </tr>
                        <tr>
                        <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                            Datos del Problema</td>
                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formProblema" method="post">
                                    <table width="100%" border="0" align="center" cellpadding="5px" cellspacing="0px" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>ESTADO:</label></td>
                                            <td width="65%" align="left">
                                                <span class="textoinput" id="txtestado">
                                                    <?php
                                                        echo strtoupper($estado);
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>MUNICIPIO:</label></td>
                                            <td>
                                                <span class="textoinput" id="txtmunicipio">
                                                    <?php
                                                        echo strtoupper($municipio);
                                                    ?>
                                                </span>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>PARROQUIA:</label></td>
                                            <td>
                                                <span class="textoinput" id="txtparroquia">
                                                    <?php
                                                        echo strtoupper($parroquia);
                                                    ?>
                                                </span>
                                            </td>
                                          </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>COMUNIDAD:</label></td>
                                            <td width="65%" align="left">
                                                <span class="textoinput" id="txtcomunidad">
                                                    <?php
                                                        echo strtoupper($comunidad);
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>SECTOR:</label></td>
                                            <td width="65%" align="left">
                                                <span class="textoinput" id="txtsector">
                                                    <?php
                                                        echo strtoupper($sector);
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="35%"><label><span class="oblig">*</span>DESCRIPCI&Oacute;N:</label></td>
                                            <td align="left" width="65%">
                                                <textarea id="itxtdescripcion" rows="3" cols="40" tabindex="18" class="mayuscula tooltip" onKeyUp="valida_longitud(this,'500','cuenta')" title="Ingrese una breve descripci&oacute;n del problema"></textarea><div id="cuenta" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">500</div>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td align="right" width="35%"><label><span class="oblig">*</span>POSIBLE SOLUCI&Oacute;N:</label></td>
                                            <td align="left" width="65%">
                                                <textarea id="itxtsolucion" rows="3" cols="40" tabindex="18" class="mayuscula tooltip" onKeyUp="valida_longitud(this,'1000','cuenta')" title="Ingrese una posible soluci&oacute;n al problema"></textarea><div id="cuenta" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">1000</div>
                                            </td>
                                        </tr>
                                         
                                    </table>
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tr>
                                            <td colspan="4" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <div id='btningresarProblem' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1);">
                                                        <img src="../img/aplicar_i.png" alt="guardar" name="guardar" class="tooltip" width="32" height="32" border="0" onClick="valForm('formProblema','guardarProblema('+ <?php echo $_GET['destino']; ?>+')');" title="Guardar">
                                                    </a>
                                                </div>
                                                <div id='btnmodificarProblem' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1);">
                                                        <img src="../img/editar_i.png" alt="editar" class="tooltip" name="editar" width="32" height="32" border="0" onClick="valForm('formProblema','modificarProblema()');" title="Modificar">
                                                    </a>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1);">
                                                    <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" class="tooltip" height="32" border="0" title="<?php if($_GET['destino']==1 || $_GET['destino']==2){echo 'Cancelar';}else{echo 'Limpiar';}?>" onClick="<?php if($_GET['destino']==1 || $_GET['destino']==2){echo 'closeMessage();';}else{echo 'limpiarPro();';}?>">
                                                </a>
                                            </td>
                                            <?php
                                            if($destino != 4){
                                                echo '<td align="center">
                                                    <a onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage(\'listo\',\'\',\'../img/listo_a.png\',1);">
                                                        <img src="../img/listo_i.png" class="tooltip" alt="listo" name="listo" width="32" height="32" border="0" title="Listo" 
                                                        onClick="';
                                                            if($_GET['destino']==1 || $_GET['destino']==2){echo 'mostrarTodoPro(2);';} else {echo 'limpiarProblema();';}
                                                            echo '">
                                                    </a>
                                                </td>';
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Problemas Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_prob" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="80%">
                                                            Descripci&oacute;n
                                                    </td>
                                                    <?php
                                                        if($destino != 4){
                                                            echo '<td align=\'center\' width="15%" colspan="2">
                                                                Acci&oacute;n
                                                            </td>';
                                                        }
                                                    ?>
                                            </tr>
                                            <tbody id="cont_prob"></tbody>
                                    </table>
                            
                                    </div>
                            </td>
                      </tr>
                    </table>
</div>
<script type="text/javascript">
            addLoadEvent(mostrarTodoPro('4'));
            addLoadEvent(foco,'0');
        </script>
<?php echo "<SCRIPT LANGUAGE=javascript>document.getElementById('itxtdescripcion').focus();</SCRIPT>"; ?>     