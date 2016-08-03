id='';
function mostrarTodoC(){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosCom');
    ajax.onCompletion = function(){
        //alert(ajax.response);
           crearTablaConmunidad(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function mMunicipiosCom(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    lstMunicipio.disabled=true;
    lstParroquia.disabled=true;
    if(lstEstado.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codEstado",lstEstado.value);
        ajax.setVar("op",'bMunicipios');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaMunCom(lstMunicipio,ajax.response);
                lstMunicipio.disabled=false;
            }else{
                lstEstado.value=-1;
                alert('No existen Municipios para este Estado');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstMunicipio);
        limpiarListaToda(lstParroquia);
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
    }
}

function crearListaMunCom(objLista,cont){
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
        limpiarListaToda(lstParroquia);
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
    }
}

function mParroquiasCom(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    limpiarListaToda(lstParroquia);
    lstParroquia.disabled = true;
    if(lstMunicipio.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codMunicipio",lstMunicipio.value);
        ajax.setVar("op",'bParroquia');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaParCom(lstParroquia,ajax.response);
                lstParroquia.disabled=false;
            }else{
                lstMunicipio.value=-1;
                alert('No existen Parroquias para este Municipio');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstParroquia);
        lstParroquia.disabled = true;
    }
}

function crearListaParCom(objLista,cont){
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
        lstParroquia.disabled = true;
    }
}

function crearTablaConmunidad(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_com');
    mD.limpiaTexto(xGetElementById('cont_com'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    //alert(datos.length);
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Docentes',
                            'id': datos[i]['idcomuni']
                    });
                    var celda1 = mD.insertarCelda(fila, -1, {
                            'id': 'celda1',			
                            'align': 'center',
                            'width': '5%'
                    }, itemS);
                    var celda2 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '80%'
                        }, html_entity_decode(datos[i]['nomcomuni'],'ENT_QUOTES').toUpperCase());
                    
                    var celda5 = mD.insertarCelda(fila,-1,{
                            'id':'celda5',
                            'align':'center',
                            'width':'15%'
                        },'');
//                    var celda6 = mD.insertarCelda(fila,-1,{
//                            'id':'celda6',
//                            'align':'center',
//                            'width':'7,5%'
//                        },'');
                    var imgE=document.createElement('img');
                    imgE.src="../img/eliminar_a.png";
                    imgE.border="0";
                    imgE.width="16";
                    imgE.height="16";
                    imgE.setAttribute('title',"Eliminar");
                    imgE.setAttribute('onclick',"eliminarComunidad("+datos[i]['idcomuni']+")");
                    celda5.appendChild(imgE);
//                    var imgM=document.createElement('img');
//                    imgM.src="../img/reporte.png";
//                    imgM.border="0";
//                    imgM.width="16";
//                    imgM.height="16";
//                    imgM.setAttribute('title',"Modificar");
//                    imgM.setAttribute('onclick',"buscarComunidad("+datos[i]['idcomuni']+")");
//                    celda6.appendChild(imgM);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

//function buscarComunidad(cod){
//    ajax = new sack('../Modelo.php');
//    ajax.setVar("op",'buscarComu');
//    ajax.setVar("codigo",cod);
//    ajax.method="POST";
//    ajax.onCompletion = function(){
//        if(ajax.response != 0){
//            id=cod;
//            cargarComuni(ajax.response);
//        }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//}

//function cargarComuni(req){
//    lstEstado = document.getElementById('ilstestado');
//    lstParroquia = document.getElementById('ilstparroquia');
//    lstMunicipio = document.getElementById('ilstmunicipio');
//    campNombreComuni = document.getElementById('itxtnombrecomuni');
//    campDirComuni = document.getElementById('itxtdireccioncomuni');
//    campCedula = document.getElementById('itxtcedula');
//    campNombre = document.getElementById('itxtnombre');
//    campApellido = document.getElementById('itxtapellido');
//    campTelefono = document.getElementById('itxttelf');
//    btnGuardar = document.getElementById('btningresar');
//    btnModificar = document.getElementById('btnmodificar');
//    
//    limpiarListaToda(lstEstado);
//    limpiarListaToda(lstMunicipio);
//    limpiarListaToda(lstParroquia);
//
//    datos = eval("("+req+")");
//    comunidad = datos[0];
//    municipios = datos[1];
//    parroquias = datos[2];
//    estado = datos[3];
//    cod = comunidad['idparroquia'];
//    
//    if(cod.length == 8){
//        fe=2;
//        fm=5;
//    }else{
//        fe=1;
//        fm=4;
//    }
//    est = cod.substr(0,fe);
//    mun = cod.substr(0,fm);
//    for(i=0;i<estado.length;i++){
//        if(est==estado[i]['idestado']){
//            listas('ilstestado',estado[i]['idestado'],html_entity_decode(estado[i]['descripestado'],'ENT_QUOTES'), true);
//        }else{
//            listas('ilstestado',estado[i]['idestado'],html_entity_decode(estado[i]['descripestado'],'ENT_QUOTES'), false);
//        }
//    }
//    for(i=0;i<municipios.length;i++){
//        if(mun==municipios[i]['idmunicipio']){
//            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), true);
//        }else{
//            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), false);
//        }
//    }
//    
//    for(i=0;i<parroquias.length;i++){
//        if(cod==parroquias[i]['idparroquia']){
//            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), true);
//        }else{
//            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), false);
//        }
//    }
//    campNombreComuni.value=comunidad['nomcomuni'];
//    campDirComuni.value=comunidad['dircomuni'];
//    btnGuardar.style.display='none';
//    btnModificar.style.display='block';
//    lstParroquia.disabled=false;
//    lstMunicipio.disabled=false;
//    lstEstado.focus();
//    
//}
function guardarComunidad(destino){
    /*
     *destino=0 : viene del menu
     *destino=1 : viene de diagnostico
     **/
    lstParroquia = document.getElementById('ilstparroquia');
    campNombreComuni = document.getElementById('itxtnombrecomuni');
    campDirComuni = document.getElementById('itxtdireccioncomuni');
    campNombreSect = document.getElementById('itxtdnombresect');
    campDirSect = document.getElementById('itxtddireccionsect');
    lstNacResp = document.getElementById('ilstnac');
    campCedResp = document.getElementById('itxtcedula');
    campNombreResp = document.getElementById('itxtnombre');
    campApeResp = document.getElementById('itxtapellido');
    lstSexo = document.getElementById('ilstsexo');
    campTelfResp = document.getElementById('itxttelf');
    campDirResp = document.getElementById('itxtdireccion');
    campEmailResp = document.getElementById('itxtemail');
    if(val_Email('itxtemail')){
        ced = lstNacResp.value+campCedResp.value;
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'guardarComunidad');
        ajax.setVar("destino",destino);
        ajax.setVar("parroquia",lstParroquia.value);  
        ajax.setVar("nomcomuni",campNombreComuni.value);  
        ajax.setVar("dircomuni",campDirComuni.value);
        ajax.setVar("nomsect",campNombreSect.value);  
        ajax.setVar("dirsect",campDirSect.value);  
        ajax.setVar("cedresp",ced);
        ajax.setVar("nomresp",campNombreResp.value);  
        ajax.setVar("aperesp",campApeResp.value);  
        ajax.setVar("sexo",lstSexo.value);
        ajax.setVar("telfresp",campTelfResp.value);
        ajax.setVar("dirresp",campDirResp.value);  
        ajax.setVar("emailresp",campEmailResp.value);
        ajax.method = "POST";
        ajax.onCompletion = function(){
           if(ajax.response != 0){
               if(ajax.response == 2){
                   alert('El correo electronico ingresado se encuentra registrado, verifique');
                   campEmailResp.value = '';
                   campEmailResp.focus();
               }else{
                    if(destino == 1){
                        lstComunidad = document.getElementById('ilstcomunidad');
                        lstSector = document.getElementById('ilstsectorcomun');
                        campResponsable = document.getElementById('itxtresponsable');
                        crearListaComCom(lstComunidad,ajax.response);
                        crearListaSectCom(lstSector,ajax.response);
                        lstComunidad.disabled=false;
                        lstSector.disabled=false;
                        contenido = eval("("+ajax.response+")");
                        codResp = contenido[2];
                        campResponsable.value = campNombreResp.value.toUpperCase()+' '+campApeResp.value.toUpperCase();
                        campResponsable.name = codResp;
                        closeMessage();                
                    }else{
                        mostrarTodoC();
                        alert('Comunidad registrada con éxito');
                        limpiarC();
                        foco(1,0);
                    }
               }
           }else{
               alert('No se pudo ingresar la Comunidad');
           }
       }
       ajax.onError=function(){alert('Ha ocurrido un error');}
       ajax.runAJAX();
    }else{
        alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
        campEmailResp.value = '';
        campEmailResp.focus();
    }
     
}

function crearListaComCom(objLista,cont){
    contenido = eval("("+cont+")");
    selComuni = contenido[0];
    todoComuni = contenido [3];
    cant = todoComuni.length;
    limpiarListaToda(objLista);
    for(i=0;i<todoComuni.length;i++){
        if(selComuni == todoComuni[i]['idcomuni']){
            listas('ilstcomunidad',todoComuni[i]['idcomuni'],html_entity_decode(todoComuni[i]['nomcomuni'],'ENT_QUOTES'), true);
        }else{
            listas('ilstcomunidad',todoComuni[i]['idcomuni'],html_entity_decode(todoComuni[i]['nomcomuni'],'ENT_QUOTES'), false);
        }
    }
}

function crearListaSectCom(objLista,cont){
    contenido = eval("("+cont+")");
    selSect = contenido[1];
    todoSect = contenido [4];
    cant = todoSect.length;
//    eliminarHijosLista(objLista);
limpiarListaToda(objLista);
    for(i=0;i<todoSect.length;i++){
        if(selSect==todoSect[i]['idsectorcomunidad']){
            listas('ilstsectorcomun',todoSect[i]['idsectorcomunidad'],html_entity_decode(todoSect[i]['descripsector'],'ENT_QUOTES'), true);
        }else{
            listas('ilstsectorcomun',todoSect[i]['idsectorcomunidad'],html_entity_decode(todoSect[i]['descripsector'],'ENT_QUOTES'), false);
        }
    }
}

function limpiarC(){
    lstestado = document.getElementById('ilstestado');
    lstParroquia = document.getElementById('ilstparroquia');
    lstMunicipio = document.getElementById('ilstmunicipio');
    campNombreComuni = document.getElementById('itxtnombrecomuni');
    campDirComuni = document.getElementById('itxtdireccioncomuni');
    
    campNombreSect = document.getElementById('itxtdnombresect');
    campDirSect = document.getElementById('itxtddireccionsect');
    lstNacResp = document.getElementById('ilstnac');
    campCedResp = document.getElementById('itxtcedula');
    campNombreResp = document.getElementById('itxtnombre');
    campApeResp = document.getElementById('itxtapellido');
    lstSexo = document.getElementById('ilstsexo');
    campTelfResp = document.getElementById('itxttelf');
    campDirResp = document.getElementById('itxtdireccion');
    campEmailResp = document.getElementById('itxtemail');
    
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    lstestado.value = -1;
    lstSexo.value = -1;
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstMunicipio);
    lstParroquia.disabled = true;
    lstMunicipio.disabled = true;
    lstSexo.disabled = true;
    campNombreComuni.value = '';
    campDirComuni.value = '';
    
    campNombreSect.value = '';
    campDirSect.value = '';
    lstNacResp.value = 'V';
    campCedResp.value =  '';
    campNombreResp.value ='';
    campNombreResp.disabled = true;
    campApeResp.value = '';
    campApeResp.disabled = true;
    campTelfResp.value = '';
    campTelfResp.disabled = true;
    campDirResp.value = '';
    campDirResp.disabled = true;
    campEmailResp.value = '';
    campEmailResp.disabled = true;
    
    btnGuardar.style.display = 'block';
    btnModificar.style.display = 'none';
}

//function modificarComunidad(){
//    lstParroquia = document.getElementById('ilstparroquia');
//    campNombreComuni = document.getElementById('itxtnombrecomuni');
//    campDirComuni = document.getElementById('itxtdireccioncomuni');
//     if(confirm("¿Seguro desea modificar este registro?")){
//         ajax = new sack('../Modelo.php');
//        ajax.setVar("op",'modificarComunidad');    
//        ajax.setVar("parroquia",lstParroquia.value);
//        ajax.setVar("nombre",campNombreComuni.value);
//        ajax.setVar("direccion",campDirComuni.value);
//        ajax.setVar("id",id);
//        ajax.method = "POST";
//        ajax.onCompletion = function(){
//            if(ajax.response == 1){
//                mostrarTodoC();
//                alert('Comunidad modificada con éxito');
//                limpiarC();
//                foco(0);
//            }else{
//                alert('No se pudo modificar la Comunidad');
//            }
//        }
//        ajax.onError=function(){alert('Ha ocurrido un error');}
//        ajax.runAJAX();
//     }
//     
//
//}

function eliminarComunidad(cod){
    if(confirm("¿Seguro desea eliminar este registro?")){
         ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarComunidad'); 
        ajax.setVar("id",cod);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 0){
                mostrarTodoC();
                alert('Comunidad eliminada con éxito');
                foco(0);
            }else{
                alert('No se puede eliminar la Comunidad, posee registros asociados');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
     }
}