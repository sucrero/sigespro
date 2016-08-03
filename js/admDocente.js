ced='';
mail='';
w=false;
id='';
seleccion = '';
datosSel = '';

function busDoc(obj,event){
    if(document.getElementById('btningresar').style.display=='block'){
        if(obj.value == ''){
            limpiar('formDocente');
        }else{
            if(event.keyCode == 13){
                if(obj.value != ''){
                    lstNac = document.getElementById('ilstnac');
                    cedula = lstNac.value+obj.value;
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'buscarDocente');
                    ajax.setVar("cedula",cedula);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                        if(ajax.response == 1){
                            alert('Cédula registrada, verifique');
                            obj.value='';
                            obj.focus();
                        }else{                    
                            destapa();
                            document.getElementById('itxtnombre').focus();
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }
            }
        }
    }
}

function destapa(){
    objForm = document.getElementById('formDocente');
    nroElement = objForm.length;
    for(i=0; i < nroElement;i++){
        if(objForm.elements[i].id != 'dtxtfecnac'){
            if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one' || objForm.elements[i].type=='button' || objForm.elements[i].type=='radio'){
                if(i!=0){
                    objForm.elements[i].disabled=false;
                }
            }   
        }
    }
}

function mMunicipios(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    lstParroquia.disabled=true;
    if(lstEstado.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codEstado",lstEstado.value);
        ajax.setVar("op",'bMunicipios');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaMun(lstMunicipio,ajax.response);
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
    }
}

function crearListaMun(objLista,cont){
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

function mParroquias(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    limpiarListaToda(lstParroquia);
    if(lstMunicipio.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codMunicipio",lstMunicipio.value);
        ajax.setVar("op",'bParroquia');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaPar(lstParroquia,ajax.response);
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
    }
}

function crearListaPar(objLista,cont){
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

function crearListaCom(objLista,cont){
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
    }
}

function guardarDocente(){
    objForm = document.getElementById('formDocente');
    objFechaNac = document.getElementById('dtxtfecnac');
    objMail = document.getElementById('itxtemail');
    objCedula = document.getElementById('itxtcedula');
    objBtnCalen = document.getElementById('btncalenda');
    radioS = document.getElementById('rdoSi');
    radioN = document.getElementById('rdoNo');
    nroElement = objForm.length;
    if(objFechaNac.value != ''){
        if(calcular_edad(objFechaNac.value) >=18){
            w = true;
        }else{
            w = false;
            alert('El docente debe poseer 18 años de edad o más');
            objFechaNac.value='';
            objBtnCalen.focus();
        }
    }else{
        w = true;
    }
    if(radioS.checked){
        w = confirm("Si selecciona a esta persona como JEFE DE PNF, \nel Jefe del PNF actual sera reemplazado, desea continuar?")
    }
    if(w){
        if(val_Email('itxtemail')){
            if(radioS.checked){
                radio = radioS.value;
            }else{
                radio = radioN.value;
            }
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'guardarDocente');    
            for(i=0; i < nroElement;i++){
                if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one'){
                    ajax.setVar(i,objForm.elements[i].value);
                }
            }
            ajax.setVar("jefe",radio);
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(ajax.response == 1){
                    mostrarTodoDoc('doce');
                    alert('Docente registrado con éxito');
                    limpiar('formDocente');
                    foco(1,0);
                }else if(ajax.response == 2){
                    alert('La cedula ingresada se encuentra registrada, verifique');
                    objCedula.value = '';
                    limpiar('formDocente');
                    objCedula.focus();
                    
                }else if(ajax.response == 3){
                    alert('El email ingresao se encuentra registrado, verifique');
                    objMail.value = '';
                    objMail.focus();
                }else{
                    alert('No se pudo ingresar el docente');
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }else{
            alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
            objMail.value = '';
            objMail.focus();
        }
    }
}

function limpiar(formu){
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    objForm = document.getElementById(formu);
    nroElement = objForm.length;
    radioN = document.getElementById('rdoNo');
    for(i=0; i < nroElement;i++){
        if(objForm.elements[i].type=='text'){
            objForm.elements[i].value = '';
        }else if(objForm.elements[i].type=='select-one'){
            if(objForm.elements[i].id == 'ilstnac'){
                objForm.elements[i].value = 'V';
            }else{
                objForm.elements[i].value = -1;
            }
        }
        if(i!=0 && i!=1){
            objForm.elements[i].disabled=true;
        }
    }
    radioN.checked = true;
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
    objForm.elements[0].focus();
}

function mostrarTodoDoc(op){
    if (op == 'eva') {
        capaDoc = document.getElementById('div_doc');
        capaInt = document.getElementById('div_intcom');
        capatextDoc = document.getElementById('textbdoc');
        capatextInt = document.getElementById('textbint');
        document.getElementById('itxtcomisiondoc').value ='';
        capaDoc.style.display = "block";
        capaInt.style.display = "none";
        capatextDoc.style.display = "block";
        capatextInt.style.display = "none";
    }
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosDoc');
    ajax.onCompletion = function(){
           crearTablaDocente(ajax.response,op);
        }
    ajax.onError = function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaDocente(req,op){
    var estilocel = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_doc');
    mD.limpiaTexto(xGetElementById('cont_doc'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'doce' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilocel});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 5}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilocel,
                            'title': 'Docentes',
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
                    }, datos[i]['ceddocente']);
                    var celda3 = mD.insertarCelda(fila, -1, {
                            'id': 'celda3',
                            'align': 'left',
                            'width': '70%'
                    }, datos[i]['nomdocente'].toUpperCase()+'  '+datos[i]['apedocente'].toUpperCase());
                    if(op == 'doce'){
                         var celda5 = mD.insertarCelda(fila,-1,{
                            'id':'celda5',
                            'align':'center',
                            'width':'7,5%'
                        },'');
                        var imgE=document.createElement('img');
                        imgE.src="../img/eliminar_a.png";
                        imgE.border="0";
                        imgE.width="16";
                        imgE.height="16";
                        imgE.setAttribute('title',"Eliminar");
                        imgE.setAttribute('onclick',"eliminarDocente("+datos[i]['iddocente']+")");
                        celda5.appendChild(imgE);
                        var celda6 = mD.insertarCelda(fila,-1,{
                                'id':'celda6',
                                'align':'center',
                                'width':'7,5%'
                            },'');
                        var imgM=document.createElement('img');
                        imgM.src="../img/reporte.png";
                        imgM.border="0";
                        imgM.width="16";
                        imgM.height="16";
                        imgM.setAttribute('title',"Modificar");
                        imgM.setAttribute('onclick',"buscarDocente("+datos[i]['iddocente']+")");
                        celda6.appendChild(imgM);
                    }
                    if(op == 'eva'){
                        var celda4 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                        name = "chek"+(i+1);
                        var  chek =document.createElement('input');
                        chek.setAttribute('type', "checkbox");
                        chek.setAttribute('title', datos[i]['ceddocente']+" - "+datos[i]['nomdocente'].toUpperCase()+'  '+datos[i]['apedocente'].toUpperCase());
                        chek.setAttribute('name', name);
                        chek.setAttribute('id', datos[i]['iddocente']+'-'+datos[i]['ceddocente']+'-'+datos[i]['nomdocente'].toUpperCase()+'  '+datos[i]['apedocente'].toUpperCase()+'-D');
                        chek.setAttribute('onChange', "cargarSeleccion("+datos[i]['iddocente']+",'"+name+"')");
                        if(seleccion != ''){
                            seleccion = seleccion.toString();
                            codigos = seleccion.split('-');
                            for(j=0;j <= codigos.length;j++){
                                if(codigos[j] == datos[i]['iddocente']){
                                    chek.setAttribute('checked', true);
                                }
                            }
                        }
                        celda4.appendChild(chek);
                    }
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilocel]);
                    tabla.appendChild(fila);
        }
    }
}

function cargarSeleccion(id,name){
    check = document.getElementsByName(name).item(0);
    if (check.checked) {
        if(seleccion == ''){
            seleccion = id;
            datosSel = check.id;
        }else{
            alert('Solo puede seleccionar un docente');
            check.checked = false;
        }
    }else{
        seleccion = '';
        datosSel = '';
    }
}

function buscarDocente(cod){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDoc');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            id=cod;
            cargarDocente(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarDocente(req){
    lstNac = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campNombre = document.getElementById('itxtnombre');
    campApellido = document.getElementById('itxtapellido');
    lstSexo = document.getElementById('ilstsexo');
    campFechaNac = document.getElementById('dtxtfecnac');
    btnFechaNac = document.getElementById('btncalenda');
    campTelefono = document.getElementById('txttelf');
    lstPnf = document.getElementById('ilstPnf');
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    campGradoInstruc = document.getElementById('itxtgradoinstruccion');
    campProfesion = document.getElementById('itxtprofesion');
    campDireccion = document.getElementById('itxtdireccion');
    campEmail = document.getElementById('itxtemail');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    radioS = document.getElementById('rdoSi');
    radioN = document.getElementById('rdoNo');
    
    limpiarListaToda(lstEstado);
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    datos = eval("("+req+")");
    docente = datos[0];
    estados = datos[4];
    municipios = datos[2];
    parroquias = datos[3];
    comunidades = datos[5];
    jefeDoc = datos[6];
    cod = datos[1]['idparroquia'];
    if(cod.length == 8){
        fe=2;
        fm=5;
    }else{
        fe=1;
        fm=4;
    }
    est = cod.substr(0,fe);
    mun = cod.substr(0,fm);
    
    ced = docente['ceddocente']; 
    lstNac.value = ced.substr(0, 1);
    campCedula.value = ced.substr(1,ced.length);
    
    campNombre.value = html_entity_decode(docente['nomdocente'],'ENT_QUOTES');
    campApellido.value = html_entity_decode(docente['apedocente'],'ENT_QUOTES');
    lstSexo.value = docente['sexdocente'];
    if(docente['fnacimiento'] != '1900-01-01'){
        var fecha = docente['fnacimiento'].split('-');
        campFechaNac.value = fecha[2]+'/'+fecha[1]+'/'+fecha[0];
    }else{
        campFechaNac.value = '';
    }
    
    campTelefono.value = docente['telefdocente'];
    lstPnf.value = docente['idpnf'];
    campGradoInstruc.value = html_entity_decode(docente['gradoinstruccion'],'ENT_QUOTES');
    campProfesion.value = html_entity_decode(docente['profesion'],'ENT_QUOTES');
    campDireccion.value = html_entity_decode(docente['direccdocente'],'ENT_QUOTES');
    mail = campEmail.value = docente['maildocente'];
    
    
    for(i=0;i<estados.length;i++){
        if(est==estados[i]['idestado']){
            listas('ilstestado',estados[i]['idestado'],html_entity_decode(estados[i]['descripestado'],'ENT_QUOTES'), true);
        }else{
            listas('ilstestado',estados[i]['idestado'],html_entity_decode(estados[i]['descripestado'],'ENT_QUOTES'), false);
        }
    }
    
    for(i=0;i<municipios.length;i++){
        if(mun==municipios[i]['idmunicipio']){
            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), true);
        }else{
            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), false);
        }
    }
    
    for(i=0;i<parroquias.length;i++){
        if(cod==parroquias[i]['idparroquia']){
            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), true);
        }else{
            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), false);
        }
    }
    
    if(jefeDoc != ''){
        if(jefeDoc['statusjefe'] == 1){
            radioS.checked = true;
            radioN.checked = false;
        }else{
            radioN.checked = true;
            radioS.checked = false;
        }
    }else{
        radioN.checked = true;
        radioS.checked = false;
    }
    btnGuardar.style.display='none';
    btnModificar.style.display='block';
    destapa();
    campCedula.focus();
}

function modificarDocente(){
    campCedula = document.getElementById('itxtcedula');
    campEmail = document.getElementById('itxtemail');
    campFechaNac = document.getElementById('dtxtfecnac');
    btnFechaNac = document.getElementById('btncalenda');
    radioS = document.getElementById('rdoSi');
    radioN = document.getElementById('rdoNo');
        if(campFechaNac.value != ''){
            if(calcular_edad(campFechaNac.value) >= 18){
                w = true;
            }else{
                w = false;
                alert('El docente debe poseer 18 años de edad o más');
                campFechaNac.value='';
                btnFechaNac.focus();
            }
        }else{
            w = true;
        }
        if(radioS.checked){
            w = confirm("Si selecciona a esta persona como JEFE DE PNF, \nel Jefe del PNF actual sera reemplazado, desea continuar?")
        }
        if(w){
            if(val_Email('itxtemail')){
                if(radioS.checked){
                    radio = radioS.value;
                }else{
                    radio = radioN.value;
                }
                if(confirm("¿Seguro desea modificar este registro?")){
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'modificarDocente');    
                    for(i=0; i < nroElement;i++){
                        if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one'){
                            ajax.setVar(i,objForm.elements[i].value);
                        }
                    }
                    ajax.setVar("jefe",radio);
                    ajax.setVar("id",id);
                    ajax.setVar("cedOld",ced);
                    ajax.setVar("mailOld",mail);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                        if(ajax.response == 1){
                            mostrarTodoDoc('doce');
                            alert('Docente modificado con éxito');
                            limpiar('formDocente');
                            foco(1,0);
                        }else if(ajax.response == 2){
                            alert('La Cédula modificada existe, verifique');
                            campCedula.value = ced;
                            campCedula.focus();
                        }else if(ajax.response == 3){
                            alert('El Correo electronico modificado existe, verifique');
                            campEmail.value = mail;
                            campEmail.focus();
                        }else{
                            alert('No se pudo modificar el docente');
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }
            }else{
                alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
                campEmail.value = '';
                campEmail.focus();
            }
        }
}

function eliminarDocente(cod){
    if(confirm("¿Seguro desea eliminar este registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarDocente');
        ajax.setVar("id",cod);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 2){
                alert('El docente no puede ser eliminado porque posee registros asociados');
            }else{
                alert('Docente eliminado con exito');
                mostrarTodoDoc('doce');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function buscarPerComi(obj,e){
    if(e.keyCode==13 || e.keyCode==9)return;
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarPerComi');
    ajax.setVar("letras",obj.value);
    ajax.onCompletion = function(){
        crearTablaDocente(ajax.response,'eva');
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}