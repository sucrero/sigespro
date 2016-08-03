<?php
    session_start();
    include_once '../conexion/conexion.php';
   /* include_once '../clases/Sectorcomunidad.php';
    include_once '../clases/Comunidad.php';*/
    if(!isset ($_GET['destino'])){
        echo '<SCRIPT LANGUAGE=javascript>location.href="aDiagnostico.php"</SCRIPT>';
    }
?>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<body onload="MM_preloadImages('../img/listo_a.png')">
<div id="dialog1" class="window">
   
        	<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Modifcar Grupo ]</span></td>
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
                                                    <a onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('listo','','../img/listo_a.png',1)"><img src="../img/listo_i.png" alt="listo" width="32" height="32" id="listo" title="Listo" class="tooltip" onclick="validarGrupoMod();"/></a> </div>
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
        