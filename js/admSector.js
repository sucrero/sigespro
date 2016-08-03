function mostrarTodoS(){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosSect');
    ajax.onCompletion = function(){
           crearTablaSector(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaSector(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_sect');
    mD.limpiaTexto(xGetElementById('cont_sect'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Docentes',
                            'id': datos[i]['idsectorcomunidad']
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
                    }, html_entity_decode(datos[i]['descripsector'],'ENT_QUOTES').toUpperCase());
                    
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
                    imgE.setAttribute('onclick',"eliminarSector("+datos[i]['idsectorcomunidad']+")");
                    celda5.appendChild(imgE);
                    var imgM=document.createElement('img');
                    imgM.src="../img/reporte.png";
                    imgM.border="0";
                    imgM.width="16";
                    imgM.height="16";
                    imgM.setAttribute('title',"Modificar");
                    imgM.setAttribute('onclick',"buscarSector("+datos[i]['idsectorcomunidad']+")");
                    celda6.appendChild(imgM);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

function guardarSector(destino)
{
    /*
     *destino=0 : viene del menu
     *destino=1 : viene de diagnostico
     **/
    lstSector = document.getElementById('ilstsectorcomun');
    lstComunidad = document.getElementById('ilstdcomunidad');
    campNombre = document.getElementById('itxtdnombre');
    campDir = document.getElementById('itxtddireccion');
    lstSexo = document.getElementById('ilstsexo');
    campCedResp = document.getElementById('itxtcedula');
    campNombreResp = document.getElementById('itxtnombre');
    campApeResp = document.getElementById('itxtapellido');
    campTelfResp = document.getElementById('itxttelf');
    campDirResp = document.getElementById('itxtdireccion');
    campEmailResp = document.getElementById('itxtemail');
    
   // btnIngSector = document.getElementById('ingresarsector');
    if(destino != 2){
        codComuni = lstComunidad.name;
    }else{
        codComuni = lstComunidad.value;
    }
    if(val_Email('itxtemail')){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'guardarSector');
        ajax.setVar("destino",destino);
        ajax.setVar("comunidad",codComuni);  
        ajax.setVar("nombre",campNombre.value);  
        ajax.setVar("direccion",campDir.value);
        ajax.setVar("cedresp",campCedResp.value);
        ajax.setVar("nomresp",campNombreResp.value);  
        ajax.setVar("aperesp",campApeResp.value); 
        ajax.setVar("sexo",lstSexo.value);
        ajax.setVar("telfresp",campTelfResp.value);
        ajax.setVar("dirresp",campDirResp.value);  
        ajax.setVar("emailresp",campEmailResp.value); 
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response != 0){
                if(destino == 1 || destino == 3){
                    campResponsable = document.getElementById('itxtresponsable');
                    crearListaSect(lstSector,ajax.response)
                    contenido = eval("("+ajax.response+")");
                    codResp = contenido[1];
                    campResponsable.value = campNombreResp.value.toUpperCase()+'  '+campApeResp.value.toUpperCase();
                    campResponsable.name = codResp;
                    closeMessage();
                }else{
                    mostrarTodoS();
                    alert('Sector registrado con éxito');
                    limpiarS();
                    foco(1,0);
                }
            }else{
                alert('No se pudo ingresar el Sector');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert('Email invalido, verifique');
        campEmailResp.value = '';
        campEmailResp.focus();
    }
    
}

function crearListaSect(objLista,cont){
    contenido = eval("("+cont+")");
    ultimo = contenido[0];
//    responsableUltimo = contenido[1];
//    responsables = contenido[2];
    sectores = contenido[3];
//    alert('ultimo: '+ultimo+'    sct: '+sectores);
//    cant = sectores.length;
    limpiarListaToda(objLista);
//    eliminarHijosLista(objLista);
    for(i=0;i<sectores.length;i++){
        if(ultimo==sectores[i]['idsectorcomunidad']){
            listas('ilstsectorcomun',sectores[i]['idsectorcomunidad'],html_entity_decode(sectores[i]['descripsector'],'ENT_QUOTES'), true);
        }else{
            listas('ilstsectorcomun',sectores[i]['idsectorcomunidad'],html_entity_decode(sectores[i]['descripsector'],'ENT_QUOTES'), false);
        }
    }
    
//    limpiarListaToda(objListaResp);
//    for(i=0;i<responsables.length;i++){
//        if(responsableUltimo == responsables[i]['idpersona']){
//            listas('ilstreponsable',responsables[i]['idpersona'],responsables[i]['nompersona']+' '+responsables[i]['apepersona'],true);
//        }else{
//            listas('ilstreponsable',responsables[i]['idpersona'],responsables[i]['nompersona']+' '+responsables[i]['apepersona'],false);
//        }
//    }
}

function limpiarS(){
    lstComunidad = document.getElementById('ilstdcomunidad');
    campNombre = document.getElementById('itxtdnombre');
    campDir = document.getElementById('itxtddireccion');
    lstComunidad.value=-1;
    //limpiarListaToda(lstComunidad);
    campNombre.value='';
    campDir.value='';
}

//function busResponsable(obj,event){
//    if(document.getElementById('btningresar').style.display=='block'){
//        if(obj.value == ''){
//            limpiar('formDocente');
//        }else{
//            if(event.keyCode == 13){
//                if(obj.value != ''){
//                    ajax = new sack('../Modelo.php');
//                    ajax.setVar("op",'buscarDocente');
//                    ajax.setVar("cedula",obj.value);
//                    ajax.method = "POST";
//                    ajax.onCompletion = function(){
//                        if(ajax.response == 1){
//                            alert('Cédula registrada, verifique');
//                            obj.value='';
//                            obj.focus();
//                        }else{                    
//                            destapa();
//                            document.getElementById('itxtnombre').focus();
//                        }
//                    }
//                    ajax.onError=function(){alert('Ha ocurrido un error');}
//                    ajax.runAJAX();
//                }
//            }
//        }
//    }
//}


function buscarResponsables(des){
    lstSector = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    campConsejo = document.getElementById('txtNomConsejoComun');
    estado = lstEstado.options[lstEstado.selectedIndex ].text;
    municipio = lstMunicipio.options[lstMunicipio.selectedIndex].text;
    parroquia = lstParroquia.options[lstParroquia.selectedIndex].text;
    comunidad = lstComunidad.options[lstComunidad.selectedIndex].text;
    sector = lstSector.options[lstSector.selectedIndex].text;
    if(lstSector.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codSector",lstSector.value);
        ajax.setVar("op",'bResponsableSector');
        ajax.method="POST";
        ajax.onCompletion=function(){
            datos = eval("("+ajax.response+")");
            responsable = datos[0];
            consejo = datos[1];
            
            if(responsable != 0){
                campResponsable.value = responsable['nompersona'].toUpperCase()+'  '+responsable['apepersona'].toUpperCase();
                campResponsable.name = responsable['idpersona'];
                if(consejo != 0){
                    campConsejo.value = html_entity_decode(consejo['nomconsejo'],'ENT_QUOTES').toUpperCase();
                    campConsejo.name = consejo['idconsejo'];
                     mostrarTodoPro(3);
                }else{
                    campConsejo.value = '';
                    mensaje = "No existen Consejo Comunal para este Sector, &iquest;Desea ingresar un Consejo Comunal para este Sector?";
                    if(confirm(html_entity_decode(mensaje, 'ENT_QUOTES'))){
                        estado = lstEstado.options[lstEstado.selectedIndex ].text;
                        municipio = lstMunicipio.options[lstMunicipio.selectedIndex ].text;
                        parroquia = lstParroquia.options[lstParroquia.selectedIndex ].text;
                        comunidad = lstComunidad.options[lstComunidad.selectedIndex ].text;
                        sector = lstSector.options[lstSector.selectedIndex ].text;
                        displayMessage('consejo.php?destino=1&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&comunidad='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'',750,520);
                          //displayMessage('responsable.php?destino=1&est='+estado+'&par='+parroquia+'&mun='+municipio+'&comuni='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'mostrarTodoIntCom("'+lstSector.value+'","")',780,630);
                    }else{
                        lstSector.value=-1;
                        campResponsable.value = '';
                    }
                }
            }else{
                campResponsable.value = '';
                mensaje = "No existen Responsables para este Sector, &iquest;Desea ingresar un Responsable para este Sector?";
                if(confirm(html_entity_decode(mensaje, 'ENT_QUOTES'))){
                      displayMessage('responsable.php?destino=1&est='+estado+'&par='+parroquia+'&mun='+municipio+'&comuni='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'mostrarTodoIntCom("'+lstSector.value+'","")',780,630);
                }else{
                    lstSector.value=-1;
                }
            }
//            alert(ajax.response);
//            if(ajax.response != 0){
////                alert(ajax.response);
//                datos = eval("("+ajax.response+")");
//                responsable = datos[0];
//                consejo = datos[1];
//                campResponsable.value = responsable['nompersona'].toUpperCase()+'  '+responsable['apepersona'].toUpperCase();
//                campResponsable.name = responsable['idpersona'];
//                campConsejo.value = consejo['nomconsejo'];
//                campConsejo.name = consejo['idconsejo'];
//                mostrarTodoPro(3);
//            }else{
//                campResponsable.value = '';
//                mensaje = "No existen Responsables para este Sector, &iquest;Desea ingresar un Responsable para este Sector?";
//                if(confirm(html_entity_decode(mensaje, 'ENT_QUOTES'))){
////                    displayMessage('responsable.php?destino=1&comuni='+lstComunidad.value+'&sector='+lstSector.value,'mostrarTodoIntCom("'+lstSector.value+'","")',750,590);
//                      displayMessage('responsable.php?destino=1&est='+estado+'&par='+parroquia+'&mun='+municipio+'&comuni='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'mostrarTodoIntCom("'+lstSector.value+'","")',780,630);
//                }else{
//                    lstSector.value=-1;
//                }
//            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        campResponsable.value = '';
//        limpiarListaToda(lstResponsable);
//        lstResponsable.disabled=true;
    }
}