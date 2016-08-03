<?php
    session_start();
    include_once '../conexion/conexion.php';
    include_once '../clases/Noticia.php';
    include_once '../Modelo.php';
    $objNoticia = new Noticia();		
    $cod = $_GET['id'];
    $objNoticia->buscar("SELECT * FROM noticia WHERE idnoticia='".$cod."'", $acceso);
    $fila = $acceso->devolver_recordset();
    $titular = utf8_decode($fila['titularnoticia']);
    $descripcion = utf8_decode($fila['descripnoticia']);
    $fecha = cambiarFormatoFecha($fila['fechapubli'], '1');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ES">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="../css/noticia.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript1.1">
    function cerrarPagina(a){
        if(a == ''){
                window.history.go(-1);
        }
    }
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="cerrarPagina('<?php echo $_GET['id'];?>');">

  <table width="863" height="" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="100%" align="left"><?php require 'banner.html'; ?></td>
                        </tr>
                    </table></td>
    </tr>
    <tr> 
      <td></td>
    </tr>
    
    <tr> 
      <td></td>
    </tr>
    <tr> 
      <td></td>
    </tr>
    <tr> 
      <td>
		<table width="863" height="30" border="0" align="center">
			  <tr>
				<td colspan="4" align="center">
				<table width="100%" border="0">
					  <tr>
						<td width="800" align="right" class="textoNoticia">						
                                                    						</td>
					  </tr>
				  </table>
				<table width="750" border="0">
					  <tr>
						<td align="center" class="textoNoticia">
						<b><font color="#000066" face="Verdana, Arial, Helvetica, sans-serif" size="4"><?php echo $titular.'<br><br>';?></font></b>
						</td>
					  </tr>
				  </table>
				</td>
			  </tr>
			  <tr>
				<td width="50">&nbsp;</td>
				<td>&nbsp;</td>
				<td align="justify">				</td>
				<td>
					<table width="750" border="0">
					  <tr>
						<td align="justify" class="textoNoticia"><?php 
							$t = 0;
							$l = strlen($descripcion);
							for ($i=0; $i<$l;$i++){
								if ($descripcion[$i] == "\n"){	
									echo'<br>';
								}
								echo strtoupper($descripcion[$i]);
							}
						?></td>
					  </tr>
					</table>				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
				<table width="750" border="0">
					  <tr>
						<td align="justify" class="textoNoticia">
							<table border="0" align="right" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
								<td><img onClick="window.print();" style="cursor:pointer;" src="../img/impresora_imprimir.png" width="50" height="58" alt="Imprimir Noticia"></td>
                                <td width="250px" align="right"><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-weight: bold;font-style: italic"><?php echo 'Fecha de Publicaci&oacuten: '.$fecha.'<br><br>';?></font></td>
							  </tr>
							</table>
						</td>
					  </tr>
					</table>
				</td>
			  </tr>
		</table>
	  </td>
    </tr>
    <tr> 
      <td height="1"></td>
    </tr>
	 <tr>
        <td colspan=3 height="26" align="center">			
		</td>
    </tr>
  </table>
</body>
</html>