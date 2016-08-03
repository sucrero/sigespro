ced = '';
mail = '';
w = false;
id = '';

function busEst(obj,event){
    if(document.getElementById('btningresar').style.display=='block'){
        if(obj.value == ''){
            limpiarEstu('formEstudiante');
        }else{
            if(event.keyCode == 13){
                if(obj.value != ''){
                    lstNac = document.getElementById('ilstnac');
                    cedula = lstNac.value+obj.value;
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'buscarEstudiante');
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
                    ajax.onError=function(){alert('Ha ocurrido un error11111111111111111');}
                    ajax.runAJAX();
                }
            }
        }
    }
}

function destapa(){
    objForm = document.getElementById('formEstudiante');
    nroElement = objForm.length;
    for(i=0; i < nroElement;i++){
        if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one' || objForm.elements[i].type=='button' || objForm.elements[i].type=='textarea'){
            if(i!=0){
                if(objForm.elements[i].id != 'dtxtfecnac'){
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
//    lstComunidad = document.getElementById('ilstcomunidad');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
//    limpiarListaToda(lstComunidad);
    lstParroquia.disabled=true;
//    lstComunidad.disabled=true;
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
        ajax.onError=function(){alert('Ha ocurrido un error333333333333333333');}
        ajax.runAJAX();
    }else{
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
//        lstComunidad.disabled=true;
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

//mParroquias

function mParroquias(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
//    lstComunidad = document.getElementById('ilstcomunidad');
    limpiarListaToda(lstParroquia);
//    limpiarListaToda(lstComunidad);
//    lstComunidad.disabled=true;
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
        ajax.onError=function(){alert('Ha ocurrido un error44444444444444444');}
        ajax.runAJAX();
    }else{
        lstParroquia.disabled=true;
//        lstComunidad.disabled=true;
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


function mCuminidades(){
    lstParroquia = document.getElementById('ilstparroquia');
//    lstComunidad = document.getElementById('ilstcomunidad');
//    limpiarListaToda(lstComunidad);
    if(lstParroquia.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codParroquia",lstParroquia.value);
        ajax.setVar("op",'bComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
//                crearListaCom(lstComunidad,ajax.response);
//                lstComunidad.disabled=false;
            }else{
                lstParroquia.value=-1;
                alert('No existen Comunidades para esta Parroquia');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error55555555555555555555');}
        ajax.runAJAX();
    }else{
//        lstComunidad.disabled=true;
    }
}

function crearListaCom(objLista,cont){
    lstComunidad = document.getElementById('ilstcomunidad');
    contenido = eval("("+cont+")");
    cant = contenido.length;
    eliminarHijosLista(objLista);
    if(cant > 0){
        num='';
        objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
        y=0;
        for(var i=1; i<=cant; i++){
            objLista.options[i] = new Option(html_entity_decode(contenido[y]['DESCRIP'].toUpperCase(),'ENT_QUOTES'),contenido[y]['ID']);
            y++;
        }
    }else{
        alert('No existen Comunidades para esta Parroquia');
        limpiarListaToda(lstComunidad);
    }
}

function guardarEstudiante(){
    objForm = document.getElementById('formEstudiante');
    objFechaNac = document.getElementById('dtxtfecnac');
    objBtnCalen = document.getElementById('btncalenda');
    nroElement = objForm.length;
    if(val_Email('itxtemail')){
//        if(calcular_edad(objFechaNac.value) >=18){
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'guardarEstudiante');    
            for(i=0; i < nroElement;i++){
                if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one' || objForm.elements[i].type=='textarea'){
                    ajax.setVar(i,objForm.elements[i].value);
                }
            }
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(ajax.response == 1){
                    mostrarTodoE();
                    alert('Estudiante registrado con éxito');
                    limpiarEstu('formEstudiante');
                    foco(1,0);
                }else{
                    alert('No se pudo ingresar el estudiante');
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error77777777777777777');}
            ajax.runAJAX();
//        }else{
//            alert('El estudiante debe poseer 18 años de edad o más');
//            objFechaNac.value='';
//            objBtnCalen.focus();
//        }
    }else{
        alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
        document.getElementById('itxtemail').value = '';
        document.getElementById('itxtemail').focus();
    }
}

function limpiarEstu(formu){
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    objForm = document.getElementById(formu);
    nroElement = objForm.length;
    for(i=0; i < nroElement;i++){
        if(objForm.elements[i].type=='text'  || objForm.elements[i].type=='textarea'){
            objForm.elements[i].value = '';
        }else if(objForm.elements[i].type=='select-one'){
            if(objForm.elements[i].id == 'ilstnac'){
                objForm.elements[i].value = 'V';
            }else{
                objForm.elements[i].value=-1;
            }
        }
        if(i!=0 && i!=1){
            objForm.elements[i].disabled=true;
        }
    }
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
    objForm.elements[0].focus();
}

function mostrarTodoE(){
    lstPnf = document.getElementById('ilstPnf');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosEst');
    ajax.onCompletion = function(){
           crearTablaEstudiante(ajax.response);
    }
    ajax.onError=function(){alert('Ha ocurrido un error22222');}
    ajax.runAJAX();
}

function crearTablaEstudiante(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_est');
    mD.limpiaTexto(xGetElementById('cont_est'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 5}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Estudiantes',
                        'id': datos[i]['idestudiante']
            });
            var celda1 = mD.insertarCelda(fila, -1, {
                    'id': 'celda1',			
                    'align': 'center',
                    'width': '5%'
            }, itemS);
            var celda2 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'center',
                    'width': '10%'
            }, datos[i]['cedestudiante']);

            var celda3 = mD.insertarCelda(fila, -1, {
                    'id': 'celda3',
                    'align': 'left',
                    'width': '70%'
            }, datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
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
            imgE.setAttribute('onclick',"eliminarEstudiante("+datos[i]['idestudiante']+")");
            celda5.appendChild(imgE);
            var imgM=document.createElement('img');
            imgM.src="../img/reporte.png";
            imgM.border="0";
            imgM.width="16";
            imgM.height="16";
            imgM.setAttribute('title',"Modificar");
            imgM.setAttribute('onclick',"buscarEstudiante("+datos[i]['idestudiante']+")");
            celda6.appendChild(imgM);
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }
    
}

function buscarEstudiante(cod){
//    campCedula = document.getElementById('itxtcedula');
//    campNombre = document.getElementById('itxtnombre');
//    campApellido = document.getElementById('itxtapellido');
//    lstSexo = document.getElementById('ilstsexo');
//    campFechaNac = document.getElementById('dtxtfecnac');
//    btnFechaNac = document.getElementById('btncalenda');
//    campTelefono = document.getElementById('txttelf');
//    lstPnf = document.getElementById('ilstPnf');
//    lstEstado = document.getElementById('ilstestado');
//    lstMunicipio = document.getElementById('ilstmunicipio');
//    lstParroquia = document.getElementById('ilstparroquia');
////    lstComunidad = document.getElementById('ilstcomunidad');
//    campDireccion = document.getElementById('itxtdireccion');
//    campEmail = document.getElementById('itxtemail');
//    btnGuardar = document.getElementById('btningresar');
//    btnModificar = document.getElementById('btnmodificar');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarEst');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            id=cod;
            cargarEstudiante(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error8888888888888888888');}
    ajax.runAJAX();
}

function cargarEstudiante(req){
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
//    lstComunidad = document.getElementById('ilstcomunidad');
    campDireccion = document.getElementById('itxtdireccion');
    campEmail = document.getElementById('itxtemail');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    
    limpiarListaToda(lstEstado);
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
//    limpiarListaToda(lstComunidad);
    datos = eval("("+req+")");
    estudiante = datos[0];
    estados = datos[4];
    municipios = datos[2];
    parroquias = datos[3];
    comunidades = datos[5];
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
    ced = estudiante['cedestudiante'];
    lstNac.value = ced.substr(0, 1);
    campCedula.value = ced.substr(1,ced.length);
    
    campNombre.value = html_entity_decode(estudiante['nomestudiante'],'ENT_QUOTES');
    campApellido.value = html_entity_decode(estudiante['apeestudiante'],'ENT_QUOTES');
    lstSexo.value = estudiante['sexestudiante'];
    
    if(estudiante['fnacimientoest'] != '1900-01-01'){
        var fecha = estudiante['fnacimientoest'].split('-');
        campFechaNac.value = fecha[2]+'/'+fecha[1]+'/'+fecha[0];
    }else{
        campFechaNac.value = '';
    }
    
    campTelefono.value = estudiante['telefestudiante'];
    lstPnf.value = estudiante['idpnf'];
    campDireccion.value = html_entity_decode(estudiante['direstudiante'],'ENT_QUOTES');
    mail = campEmail.value = estudiante['mailestudiante'];
    
    
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
    
//    for(i=0;i<comunidades.length;i++){
//        if(estudiante['idcomuni']==comunidades[i]['idcomuni']){
//            listas('ilstcomunidad',comunidades[i]['idcomuni'],html_entity_decode(comunidades[i]['nomcomuni'],'ENT_QUOTES'), true);
//        }else{
//            listas('ilstcomunidad',comunidades[i]['idcomuni'],html_entity_decode(comunidades[i]['nomcomuni'],'ENT_QUOTES'), false);
//        }
//    }
    btnGuardar.style.display='none';
    btnModificar.style.display='block';
    destapa();
    campCedula.focus();
}

function modificarEstudiante(){
    campCedula = document.getElementById('itxtcedula');
    campFechaNac = document.getElementById('dtxtfecnac');
    btnFechaNac = document.getElementById('btncalenda');
    if(val_Email('itxtemail')){
//        if(calcular_edad(campFechaNac.value) >= 18){
            if(confirm("¿Seguro desea modificar este registro?")){
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'modificarEstudiante');    
                for(i=0; i < nroElement;i++){
                    if(objForm.elements[i].type=='text' || objForm.elements[i].type=='select-one' || objForm.elements[i].type=='textarea'){
                        ajax.setVar(i,objForm.elements[i].value);
                    }
                }
                ajax.setVar("id",id);
                ajax.setVar("cedOld",ced);
                ajax.setVar("mailOld",mail);
                ajax.method = "POST";
                ajax.onCompletion = function(){
                    if(ajax.response == 1){
                        mostrarTodoE();
                        alert('Estudiante modificado con éxito');
                        limpiarEstu('formEstudiante');
                        foco(1,0);
                    }else if(ajax.response == 2){
                        alert('La Cédula modificada existe, verifique');
                        campCedula.value = ced;
                        campCedula.focus();
                    }else if(ajax.response == 3){
                        alert('El correo electronico ingresado existe, verifique');
                        document.getElementById('itxtemail').value = mail;
                        document.getElementById('itxtemail').focus();
                    }else{
                        alert('No se pudo modificar el estudiante');
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error9999999');}
                ajax.runAJAX();
            }
//        }else{
//            alert('El estudiante debe poseer 18 años de edad o más');
//            campFechaNac.value='';
//            btnFechaNac.focus();
//        }
    }else{
        alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
        document.getElementById('itxtemail').value = '';
        document.getElementById('itxtemail').focus();
    }
        
    
}

function eliminarEstudiante(cod){
    if(confirm("¿Seguro desea eliminar este registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarEstudiante');
        ajax.setVar("id",cod);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                alert('El estudiante no puede ser eliminado porque posee registros asociados');
            }else{
                alert('Estudiante eliminado con exito');
                mostrarTodoE();
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error111111000000');}
        ajax.runAJAX();
    }
}