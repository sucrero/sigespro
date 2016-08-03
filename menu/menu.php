<?php
    include_once '../clases/Usuario.php';
	if(isset ($_SESSION['varNivel'])){
		echo'<table border="0" class="bordeyfondogris" width="100%">
			<tr>
				<td class="FondoNaranjaLetrasBlancaTABLAS" align="center">
					Sesi&oacute;n activa
				</td>
			</tr>
			<tr>
				<td class="titulospequenosAzulesFondoGris" height="50px">
					<table border="0" width="100%">
						<tr>
							<td class="titulospequenosAzulesFondoGris">'.$_SESSION['varEntrante'].'</td>
						</tr>
						<tr>
							<td align="right" class="Estilo7sinlink">
								<a href="logout.php">Cerrar sesi&oacute;n</a>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>';
	}else{
		$objUsuario = new Usuario();
		$result = $objUsuario->buscar("select * from usuario",$acceso);
		if ($result > 0)
		{
			echo'<table border="0" class="bordeyfondogris" width="100%">
				<tr>
					<td class="FondoNaranjaLetrasBlancaTABLAS" align="center">
						Iniciar sesi&oacute;n
					</td>
				</tr>
				<tr>
					<td class="titulospequenosAzulesFondoGris" height="50px">
						<form id="login" method="POST">
							<table border="0" width="100%">
								<tr>
									<td align="right" width="35%"><label>Login:</label></td>
									<td align="left" width="65%"><input id="itxtlogine" maxlength="30" style="font-size: 10px; width:130px" size="25"  onkeypress="chequearEnter(event)"> </td>
								</tr>
								<tr>
									<td align="right"><label>Clave:</label></td>
									<td align="left"><input type="password" id="itxtclavee" maxlength="30" style="font-size: 10px; width:130px" size="25" onkeypress="chequearEnter(event)"></td>
								</tr>
								<tr align="center">
									<td colspan="2">
										<input type="button" id="entrar" value="Entrar" style="font-size: 10px; width:50px" onclick="valForm(\'login\', \'valEntrada()\');"/>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>';
			echo '<br><table border="0" width="100%">
						<tr class="Estilo8sinlinkColorAzulparaMTTO">
							<td align="center" width="35%"><a onClick="ir(\'vistas/consultarProblema.php\')">Estudiante, consulta aqu&iacute; problemas para tu tema de Proyecto, click aqu&iacute;</a></td>
						</tr>
						<tr>
							<td align="center" width="35%"></td>
						</tr>
						<tr>
							<td align="center" width="35%">&nbsp;</td>
						</tr>
						<tr class="Estilo8sinlinkColorAzulparaMTTO">
							<td align="center"><a onClick="ir(\'vistas/plani_requisitos.php\')">&iquest;Eres un Consejo Comunal y quieres usar el sistema?, click aqu&iacute;</a></td>
						</tr>
					</table>';
		}
	}
?>
                    
<!--<br><div align="right" class="titulosmedianosAzules"><a><b>PRUEBA</b></a></div>-->
<?php
	if(isset ($_SESSION['varNivel'])){
		/*<!-- INICIO MENU -->*/
		echo'<br>
		<div class="medianosAzules" align="center">
			MEN&Uacute;
		</div>';
                echo '<div  id="menuzz" class="navbar">
			<div class="mainDiv">
				<div class="topItem">Administrar</div>
				<div class="dropMenu">
					<div class="subMenu" style="display:none;">';
            if($_SESSION['varNivel'] == 1){//OPCIONES DEL ADMINISTRADOR
		echo '
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aPeriodo.php?destino=2\')">Periodo</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aDocente.php\')">Docente</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aEstudiante.php?destino=2\')">Estudiante</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aComunidad.php?destino=2\')">Comunidad</a>
                    </div>
					<div class="subItem">
                            <a onClick="ir(\'vistas/aConsejo.php?destino=2\')">Consejo Comunal</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aIntegrantesConsejo.php?destino=2\')">Integrantes Comunidad</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aDiagnostico.php\')">Diagn&oacute;stico</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aAnteproyecto.php\')">Anteproyecto</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aProyecto.php\')">Proyecto</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aEvaluacion.php\')">Evaluaci&oacute;n</a>
                    </div>
					<div class="subItem">
                            <a onClick="ir(\'vistas/modificarGrupo.php\')">Modificar Grupo</a>
                    </div>
                    <div class="subItem">
                            <a onClick="ir(\'vistas/aNoticia.php\')">Noticia</a>
                    </div>';
                        
            }
            if($_SESSION['varNivel'] == 3){//OPCIONES DE LA COMUNIDAD
                echo '<div class="subItem">
                            <a onClick="ir(\'vistas/aProblema.php?destino=4\')">Registrar Problema</a>
                    </div>';
            }
            echo '<div class="subItem">
                            <a onClick="ir(\'vistas/seguimiento.php\')">Seguimiento</a>
                    </div>
					</div>
				</div>
			</div>
		</div>';
		if($_SESSION['varNivel'] == 1){
		echo '<div  id="menuzz" class="navbar">
                    <div class="mainDiv">
                            <div class="topItem">Reportes</div>
                            <div class="dropMenu">
                                    <div class="subMenu" style="display:none;">
                <div class="subItem">
                            <a onClick="ir(\'vistas/reporteInv.php\')">General</a>
                    </div>
            <div class="subItem">
                    <a onClick="ir(\'vistas/reporteEva.php\')">Evaluaci&oacute;n</a>
                    </div>
                            </div>
                        </div>
                    </div>
            </div>';
		}
            echo '<div  id="menuzz" class="navbar">
                    <div class="mainDiv">
                            <div class="topItem">Usuario</div>
                            <div class="dropMenu">
                                    <div class="subMenu" style="display:none;">';
            if($_SESSION['varNivel'] == 1){
                echo '<div class="subItem">
                            <a onClick="ir(\'vistas/aUsuario.php\')">Registrar Usuario</a>
                    </div>';
            }
            echo '<div class="subItem">
                    <a onClick="ir(\'vistas/modClave.php\')">Modificar contrase&ntilde;a</a>
                    </div>
                            </div>
                        </div>
                    </div>
            </div>';
	}
?>