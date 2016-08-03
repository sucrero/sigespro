<?php
	/*session_start();
	if (!session_is_registered('admin'))
	{
		session_register('denegado');
		echo '<SCRIPT LANGUAGE=javascript>location.href="index.php"</SCRIPT>';
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MENU -->
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MENU -->
   		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS AJAX -->
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/manipularDom.js"></script>
        <script type="text/javascript" src="../js/x.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS AJAX -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS CALENDARIO -->
        <script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
        <script type="text/javascript" src="../js/jscalendar/lang/calendar-es.js"></script>
        <script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-blue.css" />
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS CALENDARIO -->
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS MAESTROS -->
        <link rel="stylesheet" type="text/css" href="../css/principal.css" />
		<script type="text/javascript" src="../js/principal.js"></script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS MAESTROS -->        
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS VARIANTES -->        
        <script type="text/javascript" src="../js/admDocente.js"></script>
		<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS VARIANTES -->                
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ARCHIVOS TOOLTIPS -->
        <script type="text/javascript" src="../js/tooltips.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tooltips.css" />
        <script type="text/javascript">
            addLoadEvent(prepareInputsForHints);
            addLoadEvent(mostrarTodo);
            //addLoadEvent(MM_preloadImages(+'"../img/aplicar_a.png","../img/cancelar_a.png","../img/home_a.png"'+), "");
            addLoadEvent(foco,'0');
        </script>
        <!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIN ARCHIVOS TOOLTIPS -->
        
        <link rel="stylesheet" href="chosen/chosen.css" />
    <title>::: SIGESPRO - Docente :::</title>
    </head>
    <body>
<div align="center">
            <table align="center" width="100%" height="53" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td  width="674" height="50"><img src="../img/topbandera_final.jpg" alt="bandera"></td>
                    <td width="86" height="50"></td>
                </tr>
                <tr>
                    <td colspan="2" height="5" bgcolor="#ed1427"></td>
                </tr>
            </table>
    </div>
        <table border="0" width="100%">
            <tr>
                <td colspan="2" height="100px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="100%" align="left"><?php require 'banner.html'; ?></td>
                        </tr>
                        <tr>
                        	<td colspan="1" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="400px" width="20%" valign="top">
                    <div id="fecha" align="center">
                        <?php
                           setlocale(LC_TIME, "es_ES");
                           echo "<b>Cuman&aacute;&sbquo; ".strftime("%d de %B de %Y")."</b>";
                           
                        ?>
                    </div>
                    <?php include '../menu/menu.php'; ?>
                </td>
                <td width="80%" style="vertical-align:top">
                <!-- CUERPO -->
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="left" width="6%" >
                               
                            </td>
                            <td align="left" width="6%" >
                          </td>
                            <td align="left" width="6%" >
                            </td>
                            <td align="right" width="82%">
                            <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','../img/home_a.png',1)"><img src="../img/home_i.png" alt="inicio" name="home" width="32" height="32" border="0" onClick="ir('index')" title="Inicio"></a></td>
                        </tr>
                    </table>
                    <table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" class="bordeyfondogris">                        
                        <tr>
                            <td width="48"px>&nbsp;&nbsp;<img src="../img/agregar_a.png" alt="nuevo" width="32" height="32"></td>
                            <td width="700px"><span class="titulosgrandesAzules">[ Administrar Docente ]</span></td>
                        </tr>
                        <tr>
                            <td class="FondoAzulLetrasBlancaTABLAS" align="center" colspan="2">
                                Datos del Docente</td>

                        </tr>
                        <tr>
                            <td height="33" colspan="2">
                                <form id="formDocente" method="post">
                                    <table width="100%" border="0" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif">
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
										
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>C&Eacute;DULA:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtcedula" onFocus="javascrip:select();" onKeyPress="return numeros(event);" onKeyUp="busDoc(this,event);" type="text" tabindex="1" maxlength="9" size="30"><span class="hint">Ingrese su n&uacute;mero de c&eacute;dula y presione ENTER<span class="hint-pointer">&nbsp;</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>NOMBRE:</label></td>
                                            <td align="left"><input id="itxtnombre" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="2" maxlength="25" size="30" class="mayuscula" disabled><span class="hint">Ingrese su nombre<span class="hint-pointer">&nbsp;</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>APELLIDO:</label></td>
                                            <td width="65%" align="left">
                                                <input id="itxtapellido" onFocus="javascrip:select();" onKeyPress="return letras(event);" type="text" tabindex="3" maxlength="25" size="30" class="mayuscula" disabled><span class="hint">Ingrese su apellido<span class="hint-pointer">&nbsp;</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>SEXO</label></td>
                                            <td>
                                                <select id="ilstsexo" tabindex="4" style="width: 205px" class="mayuscula" disabled>
                                                    <option value="-1" selected>SELECCIONE...</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                </select><span class="hint">Seleccione su sexo<span class="hint-pointer">&nbsp;</span></span></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><label><span class="oblig">*</span>FECHA DE NACIMIENTO</label></td>
                                            <td align="left"><input onChange="" id="idtxtfecnac" onFocus="javascrip:select();" type="text" maxlength="8" size="24" readonly disabled>&nbsp;<input type="button" name="btncalendaI" id="btncalenda" value="..." tabindex="5" disabled><span class="hint">Ingrese su fecha de nacimiento<span class="hint-pointer">&nbsp;</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label><span class="oblig">*</span>TEL&Eacute;FONO:</label></td>
                                            <td align="left"><input id="itxttelf" onFocus="javascrip:select();" onKeyPress="return numeros(event);" type="text" tabindex="6" maxlength="11" size="30" class="mayuscula" disabled><span class="hint">Ingrese su n&uacute;mero de tel&eacute;fono<span class="hint-pointer">&nbsp;</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right"><label><span class="oblig">*</span>DEPARTAMENTO:</label></td>
                                            <td width="65%" align="left">
                                            <div>   
        <select title="Choose a Country..." class="chzn-select" style="width:350px;" tabindex="2" disabled="disabled">
          <option value=""></option> 
          <option value="United States">United States</option> 
          <option value="United Kingdom">United Kingdom</option> 
          <option value="Afghanistan">Afghanistan</option> 
          <option value="Albania">Albania</option> 
          <option value="Algeria">Algeria</option> 
          <option value="American Samoa">American Samoa</option> 
          <option value="Andorra">Andorra</option> 
          <option value="Angola">Angola</option> 
          <option value="Anguilla">Anguilla</option> 
          <option value="Antarctica">Antarctica</option> 
          <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
          <option value="Argentina">Argentina</option> 
          <option value="Armenia">Armenia</option> 
          <option value="Aruba">Aruba</option> 
          <option value="Australia">Australia</option> 
          <option value="Austria">Austria</option> 
          <option value="Azerbaijan">Azerbaijan</option> 
          <option value="Bahamas">Bahamas</option> 
          <option value="Bahrain">Bahrain</option> 
          <option value="Bangladesh">Bangladesh</option> 
          <option value="Barbados">Barbados</option> 
          <option value="Belarus">Belarus</option> 
          <option value="Belgium">Belgium</option> 
          <option value="Belize">Belize</option> 
          <option value="Benin">Benin</option> 
          <option value="Bermuda">Bermuda</option> 
          <option value="Bhutan">Bhutan</option> 
          <option value="Bolivia">Bolivia</option> 
          <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
          <option value="Botswana">Botswana</option> 
          <option value="Bouvet Island">Bouvet Island</option> 
          <option value="Brazil">Brazil</option> 
          <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
          <option value="Brunei Darussalam">Brunei Darussalam</option> 
          <option value="Bulgaria">Bulgaria</option> 
          <option value="Burkina Faso">Burkina Faso</option> 
          <option value="Burundi">Burundi</option> 
          <option value="Cambodia">Cambodia</option> 
          <option value="Cameroon">Cameroon</option> 
          <option value="Canada">Canada</option> 
          <option value="Cape Verde">Cape Verde</option> 
          <option value="Cayman Islands">Cayman Islands</option> 
          <option value="Central African Republic">Central African Republic</option> 
          <option value="Chad">Chad</option> 
          <option value="Chile">Chile</option> 
          <option value="China">China</option> 
          <option value="Christmas Island">Christmas Island</option> 
          <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
          <option value="Colombia">Colombia</option> 
          <option value="Comoros">Comoros</option> 
          <option value="Congo">Congo</option> 
          <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
          <option value="Cook Islands">Cook Islands</option> 
          <option value="Costa Rica">Costa Rica</option> 
          <option value="Cote D'ivoire">Cote D'ivoire</option> 
          <option value="Croatia">Croatia</option> 
          <option value="Cuba">Cuba</option> 
          <option value="Cyprus">Cyprus</option> 
          <option value="Czech Republic">Czech Republic</option> 
          <option value="Denmark">Denmark</option> 
          <option value="Djibouti">Djibouti</option> 
          <option value="Dominica">Dominica</option> 
          <option value="Dominican Republic">Dominican Republic</option> 
          <option value="Ecuador">Ecuador</option> 
          <option value="Egypt">Egypt</option> 
          <option value="El Salvador">El Salvador</option> 
          <option value="Equatorial Guinea">Equatorial Guinea</option> 
          <option value="Eritrea">Eritrea</option> 
          <option value="Estonia">Estonia</option> 
          <option value="Ethiopia">Ethiopia</option> 
          <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
          <option value="Faroe Islands">Faroe Islands</option> 
          <option value="Fiji">Fiji</option> 
          <option value="Finland">Finland</option> 
          <option value="France">France</option> 
          <option value="French Guiana">French Guiana</option> 
          <option value="French Polynesia">French Polynesia</option> 
          <option value="French Southern Territories">French Southern Territories</option> 
          <option value="Gabon">Gabon</option> 
          <option value="Gambia">Gambia</option> 
          <option value="Georgia">Georgia</option> 
          <option value="Germany">Germany</option> 
          <option value="Ghana">Ghana</option> 
          <option value="Gibraltar">Gibraltar</option> 
          <option value="Greece">Greece</option> 
          <option value="Greenland">Greenland</option> 
          <option value="Grenada">Grenada</option> 
          <option value="Guadeloupe">Guadeloupe</option> 
          <option value="Guam">Guam</option> 
          <option value="Guatemala">Guatemala</option> 
          <option value="Guinea">Guinea</option> 
          <option value="Guinea-bissau">Guinea-bissau</option> 
          <option value="Guyana">Guyana</option> 
          <option value="Haiti">Haiti</option> 
          <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
          <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
          <option value="Honduras">Honduras</option> 
          <option value="Hong Kong">Hong Kong</option> 
          <option value="Hungary">Hungary</option> 
          <option value="Iceland">Iceland</option> 
          <option value="India">India</option> 
          <option value="Indonesia">Indonesia</option> 
          <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
          <option value="Iraq">Iraq</option> 
          <option value="Ireland">Ireland</option> 
          <option value="Israel">Israel</option> 
          <option value="Italy">Italy</option> 
          <option value="Jamaica">Jamaica</option> 
          <option value="Japan">Japan</option> 
          <option value="Jordan">Jordan</option> 
          <option value="Kazakhstan">Kazakhstan</option> 
          <option value="Kenya">Kenya</option> 
          <option value="Kiribati">Kiribati</option> 
          <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
          <option value="Korea, Republic of">Korea, Republic of</option> 
          <option value="Kuwait">Kuwait</option> 
          <option value="Kyrgyzstan">Kyrgyzstan</option> 
          <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
          <option value="Latvia">Latvia</option> 
          <option value="Lebanon">Lebanon</option> 
          <option value="Lesotho">Lesotho</option> 
          <option value="Liberia">Liberia</option> 
          <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
          <option value="Liechtenstein">Liechtenstein</option> 
          <option value="Lithuania">Lithuania</option> 
          <option value="Luxembourg">Luxembourg</option> 
          <option value="Macao">Macao</option> 
          <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
          <option value="Madagascar">Madagascar</option> 
          <option value="Malawi">Malawi</option> 
          <option value="Malaysia">Malaysia</option> 
          <option value="Maldives">Maldives</option> 
          <option value="Mali">Mali</option> 

          <option value="Malta">Malta</option> 
          <option value="Marshall Islands">Marshall Islands</option> 
          <option value="Martinique">Martinique</option> 
          <option value="Mauritania">Mauritania</option> 
          <option value="Mauritius">Mauritius</option> 
          <option value="Mayotte">Mayotte</option> 
          <option value="Mexico">Mexico</option> 
          <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
          <option value="Moldova, Republic of">Moldova, Republic of</option> 
          <option value="Monaco">Monaco</option> 
          <option value="Mongolia">Mongolia</option> 
          <option value="Montenegro">Montenegro</option>
          <option value="Montserrat">Montserrat</option> 
          <option value="Morocco">Morocco</option> 
          <option value="Mozambique">Mozambique</option> 
          <option value="Myanmar">Myanmar</option> 
          <option value="Namibia">Namibia</option> 
          <option value="Nauru">Nauru</option> 
          <option value="Nepal">Nepal</option> 
          <option value="Netherlands">Netherlands</option> 
          <option value="Netherlands Antilles">Netherlands Antilles</option> 
          <option value="New Caledonia">New Caledonia</option> 
          <option value="New Zealand">New Zealand</option> 
          <option value="Nicaragua">Nicaragua</option> 
          <option value="Niger">Niger</option> 
          <option value="Nigeria">Nigeria</option> 
          <option value="Niue">Niue</option> 
          <option value="Norfolk Island">Norfolk Island</option> 
          <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
          <option value="Norway">Norway</option> 
          <option value="Oman">Oman</option> 
          <option value="Pakistan">Pakistan</option> 
          <option value="Palau">Palau</option> 
          <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
          <option value="Panama">Panama</option> 
          <option value="Papua New Guinea">Papua New Guinea</option> 
          <option value="Paraguay">Paraguay</option> 
          <option value="Peru">Peru</option> 
          <option value="Philippines">Philippines</option> 
          <option value="Pitcairn">Pitcairn</option> 
          <option value="Poland">Poland</option> 
          <option value="Portugal">Portugal</option> 
          <option value="Puerto Rico">Puerto Rico</option> 
          <option value="Qatar">Qatar</option> 
          <option value="Reunion">Reunion</option> 
          <option value="Romania">Romania</option> 
          <option value="Russian Federation">Russian Federation</option> 
          <option value="Rwanda">Rwanda</option> 
          <option value="Saint Helena">Saint Helena</option> 
          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
          <option value="Saint Lucia">Saint Lucia</option> 
          <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
          <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
          <option value="Samoa">Samoa</option> 
          <option value="San Marino">San Marino</option> 
          <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
          <option value="Saudi Arabia">Saudi Arabia</option> 
          <option value="Senegal">Senegal</option> 
          <option value="Serbia">Serbia</option> 
          <option value="Seychelles">Seychelles</option> 
          <option value="Sierra Leone">Sierra Leone</option> 
          <option value="Singapore">Singapore</option> 
          <option value="Slovakia">Slovakia</option> 
          <option value="Slovenia">Slovenia</option> 
          <option value="Solomon Islands">Solomon Islands</option> 
          <option value="Somalia">Somalia</option> 
          <option value="South Africa">South Africa</option> 
          <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
          <option value="South Sudan">South Sudan</option> 
          <option value="Spain">Spain</option> 
          <option value="Sri Lanka">Sri Lanka</option> 
          <option value="Sudan">Sudan</option> 
          <option value="Suriname">Suriname</option> 
          <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
          <option value="Swaziland">Swaziland</option> 
          <option value="Sweden">Sweden</option> 
          <option value="Switzerland">Switzerland</option> 
          <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
          <option value="Taiwan, Republic of China">Taiwan, Republic of China</option> 
          <option value="Tajikistan">Tajikistan</option> 
          <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
          <option value="Thailand">Thailand</option> 
          <option value="Timor-leste">Timor-leste</option> 
          <option value="Togo">Togo</option> 
          <option value="Tokelau">Tokelau</option> 
          <option value="Tonga">Tonga</option> 
          <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
          <option value="Tunisia">Tunisia</option> 
          <option value="Turkey">Turkey</option> 
          <option value="Turkmenistan">Turkmenistan</option> 
          <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
          <option value="Tuvalu">Tuvalu</option> 
          <option value="Uganda">Uganda</option> 
          <option value="Ukraine">Ukraine</option> 
          <option value="United Arab Emirates">United Arab Emirates</option> 
          <option value="United Kingdom">United Kingdom</option> 
          <option value="United States">United States</option> 
          <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
          <option value="Uruguay">Uruguay</option> 
          <option value="Uzbekistan">Uzbekistan</option> 
          <option value="Vanuatu">Vanuatu</option> 
          <option value="Venezuela">Venezuela</option> 
          <option value="Viet Nam">Viet Nam</option> 
          <option value="Virgin Islands, British">Virgin Islands, British</option> 
          <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
          <option value="Wallis and Futuna">Wallis and Futuna</option> 
          <option value="Western Sahara">Western Sahara</option> 
          <option value="Yemen">Yemen</option> 
          <option value="Zambia">Zambia</option> 
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="230" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                            <td colspan="2" align="center"><span class="oblig">* Campos requeridos</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td align="center">
                                            		<div id='btningresar' style="display:block;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../img/aplicar_a.png',1)">
                                                            <img src="../img/aplicar_i.png" alt="guardar" name="guardar" width="32" height="32" border="0" onClick="valForm('formDocente','guardarDocente()');" title="Guardar">
                                                    </a>
                                                    </div>
                                                    <div id='btnmodificar' style="display:none;">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editar','','../img/editar_a.png',1)">
                                                            <img src="../img/editar_i.png" alt="editar" name="editar" width="32" height="32" border="0" onClick="valForm('formDocente','modificarDocente()');" title="Modificar">
                                                    </a>
                                                    </div>
                                          </td>
                                            <td align="center">
                                                    <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../img/cancelar_a.png',1)">
                                                            <img src="../img/cancelar_i.png" alt="cancelar" name="cancelar" width="32" height="32" border="0" title="Cancelar" onClick="limpiar('formDocente');">
                                                    </a>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                </form>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="FondoAzulLetrasBlancaTABLAS" align="center">
                                        Docentes Registrados</td>
        
                                </tr>
                                </table>
                                <div id="div_doc" class="area" style="display:block; overflow:auto;"  align="center">
                            
                                    <table width="100%" cellpadding="1" border="0" cellspacing="1">
                                        
                                        <tr class="tablaCont" onClick="">
                                                    <td align="center" width="5%">
                                                            Item
                                                    </td>
                                                    <td align="center" width="10%">
                                                            C&eacute;dula
                                                    </td>
                                                    <td align='center' width="35%">
                                                        Nombre
                                                    </td>
                                                    <td align='center' width="35%">
                                                        Departamento
                                                    </td>
                                                    <td align='center' width="15%" colspan="2">
                                                        Acci&oacute;n
                                                    </td>
                                            </tr>
                                            <tbody id="cont_doc"></tbody>
                                    </table>
                            
                                    </div>
                            </td>
                      </tr>
                    </table>
                <!-- FIN CUERPO -->
                </td>
            </tr>
            <tr>
                <td width="85%" height="150px" align="center">
                    <?php include 'pie.html'; ?>
                </td>
            </tr>
        </table>
    <script type="text/javascript" src="../js/menu.js"></script>
        <script src="prototype.js" type="text/javascript"></script>
  <script src="chosen/chosen.proto.js" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript">
Calendar.setup({inputField : "idtxtfecnac",ifFormat : "%d/%m/%Y",button : "btncalenda"});
</script>
