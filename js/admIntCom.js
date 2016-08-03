ced = '';
mail = '';
sta = '';
w = false;
id = '';
seleccionInt = '';
datosSelInt = '';
function busInCo(obj,event,destino,ventana){
//    alert(destino);
    /*
     * ventana 
     * sect = sector;
     * resp = responsable
     * comu = comunidad
     * 
     * destino
     * 1 = otras ventanas
     * 2 = menu
     */
//    alert(destino);
    lstEstado = document.getElementById('ilstestado');
//    if(document.getElementById('btningresarIn').style.display=='block'){
        if(obj.value == ''){
            limpiarIn('modificar',ventana);
        }else{
            if(event.keyCode == 13){
                if(obj.value != ''){
                    lstNac = document.getElementById('ilstnac');
                    cedu = lstNac.value+obj.value;
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'buscarIntegranteCom');
                    ajax.setVar("cedula",cedu);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                        if(ajax.response == 1){
                            limpiarIn('modificar',ventana);
                            obj.value='';
                            mensaje = 'C&eacute;dula registrada, verifique';
                            alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                            obj.focus();
                        }else{            
                            destapaIn(destino,ventana);
                            if(destino == 1){
                                radioR = document.getElementById('rdoRepresentante');
                                radioR.checked = true;
                            }
                            document.getElementById('itxtnombre').focus();
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }
            }
        }
//    }
}

function destapaIn(destino,ventana){
//    lstSector = document.getElementById('ilstsectorcomun');
    lstNac = document.getElementById('ilstnac');
    campCed = document.getElementById('itxtcedula');
    campNom = document.getElementById('itxtnombre');
    campApe = document.getElementById('itxtapellido');
    lstSex = document.getElementById('ilstsexo');
    campTel = document.getElementById('itxttelf');
    campDir = document.getElementById('itxtdireccion');
    campMail = document.getElementById('itxtemail');
    
    lstNac.disabled = false;
    campCed.disabled = false;
    campNom.disabled = false;
    campApe.disabled = false;
    lstSex.disabled = false;
    campTel.disabled = false;
    campDir.disabled = false;
    campMail.disabled = false;
    
    if(destino == 2){
        if(ventana != 'comu' && ventana != 'sect'){
            radioR = document.getElementById('rdoRepresentante');
            radioA = document.getElementById('rdoActivo');
            radioI = document.getElementById('rdoInactivo');
            radioR.disabled = false;
            radioA.disabled = false;
            radioI.disabled = false;
        }
    }
}

function mMunicipiosIn(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstParroquia.disabled=true;
    lstComunidad.disabled=true;
    lstSector.disabled=true;
    if(lstEstado.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codEstado",lstEstado.value);
        ajax.setVar("op",'bMunicipios');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaMunIn(lstMunicipio,ajax.response);
                lstMunicipio.disabled=false;
            }else{
                lstEstado.value=-1;
                alert('No existen Municipios para este Estado');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaMunIn(objLista,cont){
    lstMunicipio = document.getElementById('ilstmunicipio');
    contenido = eval("("+cont+")");
    cant = contenido.length;
    eliminarHijosLista(objLista);
    if(cant > 0){
        num='';
        objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
        y=0;
        for(var i=1; i<=cant; i++){
            objLista.options[i] = new Option(html_entity_decode(contenido[y]['DESCRIP'],'ENT_QUOTES').toUpperCase(),contenido[y]['ID']);
            y++;
        }
    }else{
        alert('No existen Municipios para este Estado');
        limpiarListaToda(lstMunicipio);
    }
}

function mParroquiasIn(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstComunidad.disabled=true;
    lstSector.disabled=true;
    if(lstMunicipio.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codMunicipio",lstMunicipio.value);
        ajax.setVar("op",'bParroquia');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaParIn(lstParroquia,ajax.response);
                lstParroquia.disabled=false;
            }else{
                lstMunicipio.value=-1;
                alert('No existen Parroquias para este Municipio');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaParIn(objLista,cont){
    lstParroquia = document.getElementById('ilstparroquia');
    contenido = eval("("+cont+")");
    cant = contenido.length;
    eliminarHijosLista(objLista);
    if(cant > 0){
        num='';
        objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
        y=0;
        for(var i=1; i<=cant; i++){
            objLista.options[i] = new Option(html_entity_decode(contenido[y]['DESCRIP'],'ENT_QUOTES').toUpperCase(),contenido[y]['ID']);
            y++;
        }
    }else{
        alert('No existen Parroquias para este Municipio');
        limpiarListaToda(lstParroquia);
    }
}

function mCuminidadesIn(){
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    mD.limpiaTexto(xGetElementById('cont_intcom'));
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    if(lstParroquia.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codParroquia",lstParroquia.value);
        ajax.setVar("op",'bComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaComIn(lstComunidad,ajax.response);
                lstComunidad.disabled=false;
            }else{
                lstParroquia.value=-1;
                alert('No existen Comunidades para esta Parroquia');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaComIn(objLista,cont){
    lstComunidad = document.getElementById('ilstcomunidad');
    contenido = eval("("+cont+")");
    cant = contenido.length;
    eliminarHijosLista(objLista);
    if(cant > 0){
        num='';
        objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
        y=0;
        for(var i=1; i<=cant; i++){
            objLista.options[i] = new Option(html_entity_decode(contenido[y]['DESCRIP'],'ENT_QUOTES').toUpperCase(),contenido[y]['ID']);
            y++;
        }
    }else{
        alert('No existen Comunidades para esta Parroquia');
        limpiarListaToda(lstComunidad);
    }
}

function buscarSectoresIn(){
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSectorComunidad = document.getElementById('ilstsectorcomun');
    mD.limpiaTexto(xGetElementById('cont_intcom'));
    limpiarListaToda(lstSectorComunidad);
    if(lstComunidad.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codComunidad",lstComunidad.value);
        ajax.setVar("op",'bSectorComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaSectorIn(lstSectorComunidad,ajax.response);
                lstSectorComunidad.disabled=false;
            }else{
                lstComunidad.value=-1;
                limpiarListaToda(lstSectorComunidad);
                lstSectorComunidad.disabled=true;
                alert('No existen Sectores para esa comunidad');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstSectorComunidad);
        lstSectorComunidad.disabled=true;
    }
}

function crearListaSectorIn(objLista,cont){
    contenido = eval("("+cont+")");
    cant = contenido.length;
    eliminarHijosLista(objLista);
    if(cant > 0){
        num='';
        objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
        y=0;
        for(var i=1; i<=cant; i++){
            objLista.options[i] = new Option(html_entity_decode(contenido[y]['DESCRIP'],'ENT_QUOTES').toUpperCase(),contenido[y]['ID']);
            y++;
        }
    }else{
        alert('No existen Sectores para esta Comunidad');
        limpiarListaToda(objLista);
    }
}

function guardarIntCom(destino){
    lstSector = document.getElementById('ilstsectorcomun');
    lstNac = document.getElementById('ilstnac');
    campCed = document.getElementById('itxtcedula');
    campNom = document.getElementById('itxtnombre');
    campApe = document.getElementById('itxtapellido');
    lstSex = document.getElementById('ilstsexo');
    campTel = document.getElementById('itxttelf');
    campDir = document.getElementById('itxtdireccion');
    campMail = document.getElementById('itxtemail');
    radioR = document.getElementById('rdoRepresentante');
    radioA = document.getElementById('rdoActivo');
    radioI = document.getElementById('rdoInactivo');
    resp = true;
    
    if(radioR.checked){
        resp = confirm("Si selecciona a esta persona como REPRESENTANTE del sector, \nel representante actual sera reemplazado, desea continuar?")
    }
    if(resp){
        if(val_Email('itxtemail')){
            if(radioR.checked){
                radio = radioR.value;
            }else if(radioA.checked){
                radio = radioA.value;
            }else{
                radio = radioI.value;
            }
            cedu = lstNac.value+campCed.value;
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'guardarPersona');
            ajax.setVar("sector",lstSector.value);
            ajax.setVar("cedula",cedu);
            ajax.setVar("nombre",campNom.value);
            ajax.setVar("apellido",campApe.value);
            ajax.setVar("sexo",lstSex.value);
            ajax.setVar("telefono",campTel.value);
            ajax.setVar("direccion",campDir.value);
            ajax.setVar("mail",campMail.value);
            ajax.setVar("status",radio);
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(ajax.response != 0 && ajax.response != 2 && ajax.response != 3){
                    if(destino == 2){
                        mostrarTodoIntCom('','');
                        mensaje = 'Persona registrada con &eacute;xito';
                        alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                        limpiarIn('guardar','');
                    }else{
                        
                        repon = eval("("+ajax.response+")");
                        campResponsable = document.getElementById('itxtresponsable');
                        campResponsable.name = repon['idpersona'];
                        campResponsable.value = repon['nompersona'].toUpperCase()+'  '+repon['apepersona'].toUpperCase();
                        
                        closeMessage();
                    }
                }else if(ajax.response == 2){
                    alert('El email ingresado se encuentra registrado, verifique');
                    campMail.value = '';
                    campMail.focus();
                }else if(ajax.response == 3){
                    mensaje = 'La c&eacute;dula ingresada se encuentra registrada, verifique';
                    alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                    campCed.value = '';
                    campCed.focus();
                }else{
                    alert('No se pudo ingresar la persona');
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }else{
            mensaje = 'El correo electr&oacute;nico ingresado es inv&aacute;lido, verifique';
            alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
            campMail.value = '';
            campMail.focus();
        }
    }
}

function limpiarIn(destino,ventana){
//    alert(ventana);
    
//    objForm = document.getElementById('formIntCom');
//    
//    nroElement = objForm.length;
//    for(i=0; i < nroElement;i++){
//        alert('tipo: '+objForm.elements[i].type+'   id: '+objForm.elements[i].id);
//    }
    
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    lstNac = document.getElementById('ilstnac');
    campCed = document.getElementById('itxtcedula');
    campNom = document.getElementById('itxtnombre');
    campApe = document.getElementById('itxtapellido');
    lstSex = document.getElementById('ilstsexo');
    campTel = document.getElementById('itxttelf');
    campDir = document.getElementById('itxtdireccion');
    campMail = document.getElementById('itxtemail');
    radioR = document.getElementById('rdoRepresentante');
    radioA = document.getElementById('rdoActivo');
    radioI = document.getElementById('rdoInactivo');
    if(ventana != 'comu' && ventana != 'sect'){
        btnGuardar = document.getElementById('btningresarIn');
        btnModificar = document.getElementById('btnmodificarIn');
        btnGuardar.style.display = 'block';
        btnModificar.style.display = 'none';
        radioA.checked = true;
    }
    if(destino == 'limpiar'){
        lstEstado.value = -1;
        lstMunicipio.value = -1;
        lstMunicipio.disabled = true;
        lstParroquia.value = -1;
        lstParroquia.disabled = true;
        lstComunidad.value = -1;
        lstSector.value = -1;
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        lstNac.disabled = true;
        campCed.disabled = true;
        mD.limpiaTexto(xGetElementById('cont_intcom'));
    }else{
        lstNac.disabled = false;
        campCed.disabled = false;
    }
    lstNac.value = 'V';
    campCed.value = '';
    campNom.value = '';
    campApe.value = '';
    lstSex.value = -1;
    campTel.value = '';
    campDir.value = '';
    campMail.value = '';
    
    
    campNom.disabled = true;
    campApe.disabled = true;
    lstSex.disabled = true;
    campTel.disabled = true;
    campDir.disabled = true;
    campMail.disabled = true;
    radioA.disabled = true;
    radioR.disabled = true;
    radioI.disabled = true;
    
    
    if(destino == 'guardar' || destino == 'modificar'){
        campCed.focus();
    }else if(destino == 'limpiar'){
        lstEstado.focus();
    }
}

function mostrarTodoIntCom(sector,op){
//    alert('sector mostrar todo: '+sector);
    if (op == 'eva') {
        document.getElementById('itxtcomisionint').value ='';
        capaDoc = document.getElementById('div_doc');
        capaInt = document.getElementById('div_intcom');
        capatextDoc = document.getElementById('textbdoc');
        capatextInt = document.getElementById('textbint');
        capaDoc.style.display = "none";
        capaInt.style.display = "block";
        capatextDoc.style.display = "none";
        capatextInt.style.display = "block";
    }else{
        lstNac = document.getElementById('ilstnac');
        lstNac.disabled = false;
        campCedula = document.getElementById('itxtcedula');
        campCedula.disabled = false;
    }
    
    if(sector != ''){
        sect = sector;
    }else{
        lstSectorComunidad = document.getElementById('ilstsectorcomun');
        sect = lstSectorComunidad.value;
    }
    
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosInCo');
    ajax.setVar("sector",sect);
    ajax.onCompletion = function(){
        crearTablaIntegrante(ajax.response,op);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaIntegrante(req,op){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_intcom');
    mD.limpiaTexto(xGetElementById('cont_intcom'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'int' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 5}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                if(datos[i]['statuspersona'] == 2){
                    repre = '(R)';
                }else{
                    repre = '';
                }
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Integrantes',
                            'id': codrad+i
                    });
                    var celda1 = mD.insertarCelda(fila, -1, {
                            'id': 'celda1',			
                            'align': 'center',
                            'width': '5%'
                    }, itemS);
                    var celda2 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'right',
                            'width': '10%'
                    }, datos[i]['cedpersona']);
                    
                    var celda3 = mD.insertarCelda(fila, -1, {
                            'id': 'celda3',
                            'align': 'left',
                            'width': '70%'
                    }, datos[i]['nompersona'].toUpperCase()+'  '+datos[i]['apepersona'].toUpperCase()+'  '+repre);
                    
                    
                    if(op == 'eva'){
                        var celda4 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                        name = "chek3"+(i+1);
                        var  chek =document.createElement('input');
                        chek.setAttribute('type', "checkbox");
                        chek.setAttribute('title', datos[i]['cedpersona']+" - "+datos[i]['nompersona'].toUpperCase()+'  '+datos[i]['apepersona'].toUpperCase());
                        chek.setAttribute('name', name);
                        chek.setAttribute('id', datos[i]['idpersona']+'-'+datos[i]['cedpersona']+'-'+datos[i]['nompersona'].toUpperCase()+'  '+datos[i]['apepersona'].toUpperCase()+'-I');
                        chek.setAttribute('onChange', "cargarSeleccionInt("+datos[i]['idpersona']+",'"+name+"')");
                        if(seleccionInt != ''){
                            seleccionInt = seleccionInt.toString();
                            codigos = seleccionInt.split('-');
                            for(j=0;j <= codigos.length;j++){
                                if(codigos[j] == datos[i]['idpersona']){
                                    chek.setAttribute('checked', true);
                                }
                            }
                        }
                        celda4.appendChild(chek);
                    }else{
                        var celda5 = mD.insertarCelda(fila,-1,{
                            'id':'celda5',
                            'align':'center',
                            'width':'7,5%'
                        },'');
                        var celda6 = mD.insertarCelda(fila,-1,{
                                'id':'celda6',
                                'align':'center',
                                'width':'7,5%'
                            },'');
                        var imgE=document.createElement('img');
                        imgE.src="../img/eliminar_a.png";
                        imgE.border="0";
                        imgE.width="16";
                        imgE.height="16";
                        imgE.setAttribute('title',"Eliminar");
                        imgE.setAttribute('onclick',"eliminarPersona("+datos[i]['idpersona']+")");
                        celda5.appendChild(imgE);
                        var imgM=document.createElement('img');
                        imgM.src="../img/reporte.png";
                        imgM.border="0";
                        imgM.width="16";
                        imgM.height="16";
                        imgM.setAttribute('title',"Modificar");
                        imgM.setAttribute('onclick',"buscarPersona("+datos[i]['idpersona']+")");
                        celda6.appendChild(imgM);
                    }
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
                  //  idceldas++;
        }
    }
    
}
function cargarSeleccionInt(id,name){
    check = document.getElementsByName(name).item(0);
    if (check.checked) {
        if(seleccionInt == ''){
            seleccionInt = id;
            datosSelInt = check.id;
        }else{
            alert('Solo puede seleccionar una persona');
            check.checked = false;
        }
    }else{
        seleccionInt = '';
        datosSelInt = '';
    }
}
function buscarPersona(cod){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarInCo');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            id=cod;
            cargarPersona(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarPersona(req){
    lstNac = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campNombre = document.getElementById('itxtnombre');
    campApellido = document.getElementById('itxtapellido');
    lstSexo = document.getElementById('ilstsexo');
    campTelefono = document.getElementById('itxttelf');
    campDireccion = document.getElementById('itxtdireccion');
    campEmail = document.getElementById('itxtemail');
    rdioActivo = document.getElementById('rdoActivo');
    rdioInactivo = document.getElementById('rdoInactivo');
    rdioRepre = document.getElementById('rdoRepresentante');
    btnGuardar = document.getElementById('btningresarIn');
    btnModificar = document.getElementById('btnmodificarIn');
    
    datos = eval("("+req+")");
    personas = datos[0];    
    lstNac.value = personas['cedpersona'].substr(0, 1);
    campCedula.value = personas['cedpersona'].substr(1);
    ced = personas['cedpersona'];
    campNombre.value = html_entity_decode(personas['nompersona'],'ENT_QUOTES');
    campApellido.value = html_entity_decode(personas['apepersona'],'ENT_QUOTES');
    lstSexo.value = personas['sexopersona'];
    campTelefono.value = personas['telefpersona'];
    campDireccion.value = html_entity_decode(personas['dirpersona'],'ENT_QUOTES').toUpperCase();
    mail = campEmail.value = personas['emailpersona'];
    sta = personas['statuspersona'];
    if(personas['statuspersona'] == 1){
        rdioActivo.checked = true;
    }else if(personas['statuspersona'] == -1){
        rdioInactivo.checked = true;
    }else{
        rdioRepre.checked = true;
    }
    btnGuardar.style.display='none';
    btnModificar.style.display='block';
    destapaIn(2);
    campCedula.focus();
}

function modificarIntCom(destino){
    lstSector = document.getElementById('ilstsectorcomun');
    lstNac = document.getElementById('ilstnac');
    campCed = document.getElementById('itxtcedula');
    campNom = document.getElementById('itxtnombre');
    campApe = document.getElementById('itxtapellido');
    lstSex = document.getElementById('ilstsexo');
    campTel = document.getElementById('itxttelf');
    campDir = document.getElementById('itxtdireccion');
    campMail = document.getElementById('itxtemail');
    radioR = document.getElementById('rdoRepresentante');
    radioA = document.getElementById('rdoActivo');
    radioI = document.getElementById('rdoInactivo');
    
    w = true;
    if(sta == 2){
        if(radioR.checked){
            w = true;
        }else{
            w = false;
        }
    }else{
        if(radioR.checked){
            mensaje = "Esta acci&oacute;n reemplazar&aacute; al Representante actual, desea continuar?"
            w = confirm(html_entity_decode(mensaje, 'ENT_QUOTES'));
        }else{
            w = true;
        }
    }
        
    if(w){
        if(val_Email('itxtemail')){
            if(confirm("Seguro desea modificar este registro?")){
                                
                if(radioR.checked){
                    radio = radioR.value;
                }else if(radioA.checked){
                    radio = radioA.value;
                }else{
                    radio = radioI.value;
                }
                cedu = lstNac.value+campCed.value;
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'modificarPersonaIn');    
                ajax.setVar("sector",lstSector.value);
                ajax.setVar("cedula",cedu);
                ajax.setVar("nombre",campNom.value);
                ajax.setVar("apellido",campApe.value);
                ajax.setVar("sexo",lstSex.value);
                ajax.setVar("telefono",campTel.value);
                ajax.setVar("direccion",campDir.value);
                ajax.setVar("mail",campMail.value);
                ajax.setVar("status",radio);
                ajax.setVar("id",id);
                ajax.setVar("cedOld",ced);
                ajax.setVar("mailOld",mail);
                ajax.method = "POST";
                ajax.onCompletion = function(){
                    if(ajax.response != 2 && ajax.response != 3 && ajax.response != 0){
                        if(destino == 2){
                            mensaje = 'Persona modificada con &eacute;xito';
                            alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                            mostrarTodoIntCom('','');
                            limpiarIn('modificar');
                        }else{
                            repon = eval("("+ajax.response+")");
                            campResponsable = document.getElementById('itxtresponsable');
                            campResponsable.value = repon['nompersona'].toUpperCase()+'  '+repon['apepersona'].toUpperCase();
                            closeMessage();
                        }
                        
                    }else if(ajax.response == 2){
                        mensaje = 'La C&eacute;dula modificada existe, verifique';
                        alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                        campCedula.value = ced;
                        campCedula.focus();
                    }else if(ajax.response == 3){
                        mensaje = 'El correo electr&oacute;nico existe, verifique';
                        alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
                        document.getElementById('itxtemail').value = mail;
                        document.getElementById('itxtemail').focus();
                    }else{
                        alert('No se pudo modificar el registro');
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error');}
                ajax.runAJAX();
            }
        }else{
            mensaje = 'El correo electr&oacute;nico ingresado es inv&aacute;lido, verifique';
            alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
            campMail.value = '';
            campMail.focus();
        }
    }else{
        rdioRepre.checked = true;
        alert('No puede modificar el valor del STATUS de esta persona!. Pimero debe ingresar un nuevo REPRESENTANTE');
        
    }
    status = '';
}

function eliminarPersona(cod){
    if(confirm("¿Seguro desea eliminar este registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarPersonaIn');
        ajax.setVar("id",cod);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                alert('La Persona no puede ser eliminada porque posee registros asociados');
            }else if(ajax.response == 3){
                mostrarTodoIntCom('','');
                mensaje = 'Persona eliminada con &eacute;xito';
                alert(html_entity_decode(mensaje, 'ENT_QUOTES'));
            }else{
                alert('No puede eliminar el Representante actual, \nregistre un sustituto y luego proceda a eliminar el registro');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}
function buscarIntComi(obj,e,sector){
//    alert('sector buscar: '+sector);
    if(e.keyCode==13 || e.keyCode==9)return;
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarIntComi');
    ajax.setVar("letras",obj.value);
    ajax.setVar("sector",sector);
    ajax.onCompletion = function(){
        crearTablaIntegrante(ajax.response,'eva');
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}