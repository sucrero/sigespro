ced = '';
id = '';
mail = '';
function mostrarTodoResp(sector){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosResp');
    ajax.setVar("sector",sector);
    ajax.onCompletion = function(){
           crearTablaResp(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaResp(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_resp');
    mD.limpiaTexto(xGetElementById('cont_resp'));
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
                            'title': 'Docentes',
                            'id': datos[i]['idpersona']
                    });
                    var celda1 = mD.insertarCelda(fila, -1, {
                            'id': 'celda1',			
                            'align': 'center',
                            'width': '5%'
                    }, itemS);
                    var celda2 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '10%'
                    }, datos[i]['cedpersona'].toUpperCase());
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '70%'
                    }, datos[i]['nompersona'].toUpperCase()+' '+datos[i]['apepersona'].toUpperCase());
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
                    imgE.setAttribute('onclick',"eliminarResponsable("+datos[i]['idpersona']+")");
                    celda5.appendChild(imgE);
                    var imgM=document.createElement('img');
                    imgM.src="../img/reporte.png";
                    imgM.border="0";
                    imgM.width="16";
                    imgM.height="16";
                    imgM.setAttribute('title',"Modificar");
                    imgM.setAttribute('onclick',"buscarResponsable("+datos[i]['idpersona']+")");
                    celda6.appendChild(imgM);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}
//function buscarResponsable(codPersona)
//{
//    ajax = new sack('../Modelo.php');
//    ajax.setVar("op",'buscarRepon'); 
//    ajax.setVar("codigo",codPersona);
//    ajax.method = "POST";
//    ajax.onCompletion = function(){
//       if(ajax.response != 0){
//           cargarPersona(ajax.response);
//       }else{
//           alert('No existe la persona, verifique');
//       }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//}
//function crearListaResp(objLista,cont){
//    contenido = eval("("+cont+")");
//    ultimo = contenido[0];
//    responsables = contenido[1];
//    limpiarListaToda(objLista);
//    for(i=0;i<responsables.length;i++){
//        if(ultimo==responsables[i]['idpersona']){
//            listas('ilstreponsable',responsables[i]['idpersona'],html_entity_decode(responsables[i]['nompersona'],'ENT_QUOTES')+' '+html_entity_decode(responsables[i]['apepersona'],'ENT_QUOTES'), true);
//        }else{
//            listas('ilstreponsable',responsables[i]['idpersona'],html_entity_decode(responsables[i]['nompersona'],'ENT_QUOTES')+' '+html_entity_decode(responsables[i]['apepersona'],'ENT_QUOTES'), false);
//        }
//    }
//}
//function cargarPersona(req)
//{
//    btnGuardar = document.getElementById('btningresarResp');
//    btnModificar = document.getElementById('btnmodificarResp');
//    campCedula = document.getElementById('itxtcedula');
//    campNombre = document.getElementById('itxtnombreresp');
//    campApellido = document.getElementById('itxtapellido');
//    campTelefono = document.getElementById('itxttelf');
//    campDireccion = document.getElementById('itxtdireccion');
//    campEmail = document.getElementById('itxtemailresp');
//    datos = eval("("+req+")");
//    id = datos['idpersona']
//    ced = campCedula.value = datos['cedpersona'];
//    campNombre.value = datos['nompersona'];
//    campApellido.value = datos['apepersona'];
//    campTelefono.value = datos['telefpersona'];
//    campDireccion.value = datos['dirpersona'];
//    mail = campEmail.value = datos['emailpersona'];
//    btnGuardar.style.display='none';
//    btnModificar.style.display='block';
//    campCedula.focus();
//}
//
//function modificarResponsable()
//{
//    campCedula = document.getElementById('itxtcedula');
//    campNombre = document.getElementById('itxtnombreresp');
//    campApellido = document.getElementById('itxtapellido');
//    campTelefono = document.getElementById('itxttelf');
//    campDireccion = document.getElementById('itxtdireccion');
//    campEmail = document.getElementById('itxtemailresp');
//    lstResp = document.getElementById('ilstreponsable');
//    campSector = document.getElementById('ilstsectorcomunR');
//    if(confirm("¿Seguro desea modificar este registro?")){
//        ajax = new sack('../Modelo.php');
//        ajax.setVar("op",'modificarPersona');
//        ajax.setVar("id",id);
//        ajax.setVar("cedOld",ced);
//        ajax.setVar("emailOld",mail);
//        ajax.setVar("cedula",campCedula.value);
//        ajax.setVar("nombre",campNombre.value);
//        ajax.setVar("apellido",campApellido.value);
//        ajax.setVar("telefono",campTelefono.value);
//        ajax.setVar("direccion",campDireccion.value);
//        ajax.setVar("email",campEmail.value);
//        ajax.setVar("sector",campSector.name);
//        ajax.method = "POST";
//        ajax.onCompletion = function(){
//            
//            if(ajax.response == 0){
//                alert('No se pudo modificar el Responsable');
//            }else if(ajax.response == 2){
//                alert('El email ingresado se encuentra registrado, verifique');
//                campEmail.value = '';
//                campEmail.focus();
//            }else if(ajax.response == 3){
//                alert('La cedula ingresada se encuentra registrada, verifique');
//                campCedula.value = '';
//                campCedula.focus();
//            }else{
//                    crearListaResp(lstResp,ajax.response)
//                    lstResp.disabled=false;
//                    closeMessage();
//            }
//        }
//        ajax.onError=function(){alert('Ha ocurrido un error');}
//        ajax.runAJAX();
//    }
//}
//
//function busResponsable(obj, event, boton){
//    
//    campCedula = document.getElementById('itxtcedula');
//    //campNombre = document.getElementById('itxtnombreresp');
//    if(document.getElementById(boton).style.display=='block'){
//        if(obj.value == ''){
//            document.getElementById('itxtnombreresp').value = '';
//            document.getElementById('itxtapellido').value = '';
//            document.getElementById('itxttelf').value = '';
//            document.getElementById('itxtdireccion').value = '';
//            document.getElementById('itxtemailresp').value = '';
//            document.getElementById('itxtnombreresp').disabled = true;
//            document.getElementById('itxtapellido').disabled = true;
//            document.getElementById('itxttelf').disabled = true;
//            document.getElementById('itxtdireccion').disabled = true;
//            document.getElementById('itxtemailresp').disabled = true;
//        }else{
//            if(event.keyCode == 13){
////                alert('hola: '+obj.value);
//                if(obj.value != ''){
//                    ajax = new sack('../Modelo.php');
//                    ajax.setVar("op",'buscarReponsable'); 
//                    ajax.setVar("cedula",obj.value);
//                    ajax.method = "POST";
//                    ajax.onCompletion = function(){
////                       alert(ajax.response);
//                       if(ajax.response == 1){
//                          alert('Cedula registrada, verifique');
//                          campCedula.value='';
//                          campCedula.focus();
//                          document.getElementById('itxtnombreresp').value = '';
//                          document.getElementById('itxtapellido').value = '';
//                          document.getElementById('itxttelf').value = '';
//                          document.getElementById('itxtdireccion').value = '';
//                          document.getElementById('itxtemailresp').value = '';
//                          document.getElementById('itxtnombreresp').disabled = true;
//                          document.getElementById('itxtapellido').disabled = true;
//                          document.getElementById('itxttelf').disabled = true;
//                          document.getElementById('itxtdireccion').disabled = true;
//                          document.getElementById('itxtemailresp').disabled = true;
//                       }else{
//                          document.getElementById('itxtnombreresp').disabled = false;
//                          document.getElementById('itxtapellido').disabled = false;
//                          document.getElementById('itxttelf').disabled = false;
//                          document.getElementById('itxtdireccion').disabled = false;
//                          document.getElementById('itxtemailresp').disabled = false;
//                          document.getElementById('itxtnombreresp').focus();
//                       }
//                    }
//                    ajax.onError=function(){alert('Ha ocurrido un error');}
//                    ajax.runAJAX();
//                }
//            }
//        }
//    }
//    
//}
//
//function guardarResponsable(destino){
//    /*
//     *destino=2 : viene del menu
//     *destino=1 : viene de diagnostico
//     **/
//    if(confirm("Si selecciona a esta persona como REPRESENTANTE del sector, \nel representante actual sera reemplazado, desea continuar?")){
//        lstSector = document.getElementById('ilstsectorcomunR');
//        lstResp = document.getElementById('ilstreponsable');
//        campCedula = document.getElementById('itxtcedula');
//        campNombre = document.getElementById('itxtnombreresp');
//        campApellido = document.getElementById('itxtapellido');
//        campTelefono = document.getElementById('itxttelf');
//        campDireccion = document.getElementById('itxtdireccion');
//        campEmail = document.getElementById('itxtemailresp');
//
//        if(destino == 2){
//             codSector = lstSector.value;
//         }else{
//             codSector = lstSector.name;
//         }
//
//        if(valTelf(campTelefono)){
//            ajax = new sack('../Modelo.php');
//             ajax.setVar("op",'guardarReponsable');
//             ajax.setVar("destino",destino);
//             ajax.setVar("sector",codSector);  
//             ajax.setVar("cedula",campCedula.value);
//             ajax.setVar("nombre",campNombre.value);  
//             ajax.setVar("apellido",campApellido.value);  
//             ajax.setVar("telefono",campTelefono.value);
//             ajax.setVar("direccion",campDireccion.value);  
//             ajax.setVar("email",campEmail.value);
//             ajax.method = "POST";
//                ajax.onCompletion = function(){
//                if(ajax.response == 0){
//                    alert('No se pudo ingresar el Responsable');
//                }else if(ajax.response == 2){
//                    alert('El email ingresado se encuentra registrado, verifique');
//                    campEmail.value = '';
//                    campEmail.focus();
//                }else if(ajax.response == 3){
//                    alert('La cedula ingresada se encuentra registrada, verifique');
//                    campCedula.value = '';
//                    campCedula.focus();
//                }else{
//                    if(destino == 1){
//                        crearListaResp(lstResp,ajax.response)
//                        lstResp.disabled=false;
//                        closeMessage();
//                    }else{
//                        mostrarTodoResp();
//                        alert('Responsable registrado con éxito');
//                        limpiarResp(destino);
//                        foco(1);
//                    }
//                }
//            }
//            ajax.onError=function(){alert('Ha ocurrido un error');}
//            ajax.runAJAX();
//        }
//    }    
//}
//
//function limpiarResp(destino){
//    if(destino==1){
//        lstSector = document.getElementById('ilstsectorcomun');
//    }else{
//        lstSector = document.getElementById('ilstsectorcomunR');
//    }
//    lstComunidad = document.getElementById('ilstcomunidad');
//    
//    campCedula = document.getElementById('itxtcedula');
//    campNombre = document.getElementById('itxtnombreresp');
//    campApellido = document.getElementById('itxtapellido');
//    campTelefono = document.getElementById('itxttelf');
//    lstComunidad.value=-1;
//    lstSector.value=-1;
//    limpiarListaToda(lstSector);
//    campCedula.value='';
//    campNombre.value='';
//    campApellido.value='';
//    campTelefono.value='';
//}