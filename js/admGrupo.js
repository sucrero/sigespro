function mostrarTodoEstGrupo(formulario){
    formulario = document.getElementById(formulario);
    lstPeriodo = formulario.ilstperiodo;
    lstTrayecto = formulario.ilsttrayecto;
    lstTrimestre = formulario.ilsttrimestre;
    lstPnf = formulario.ilstPnf;
    ajax = new sack('../Modelo.php');
//    ajax.setVar("periodo",lstPeriodo.value);
//    ajax.setVar("trayecto",lstTrayecto.value);
//    ajax.setVar("trimestre",lstTrimestre.value);
    ajax.setVar("pnf",lstPnf.value);
    ajax.setVar("op",'bEstGrupo');
    ajax.method="POST";
    ajax.onCompletion=function(){
//        alert(ajax.response);
        if(ajax.response != 0){
            crearTablaEstGrupo(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaEstGrupo(req){
    var estilo = "colorCelda";
    item=0;
    var tabla = document.getElementById('cont_estgrupo');
    mD.limpiaTexto(xGetElementById('cont_estgrupo'));
    datos = eval("("+req+")");
//    alert(datos);
    var num=tabla.childNodes.length+1;
    var codrad = 'gru';
//    if (datos[0]['data'].length <= 0){
    if (datos == -1){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 5}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
//        datos = datos[0]['data'];
        for(i=0;i<datos.length;i++){
                item++;
                
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
//                            'title': datos[i]['pin']+" - "+datos[i]['firstnames'].toUpperCase()+'  '+datos[i]['lastnames'].toUpperCase(),
                            'title': datos[i]['cedestudiante']+" - "+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase(),
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
                            'width': '15%'
//                        }, datos[i]['nationality']+'-'+datos[i]['pin']);
                          }, datos[i]['cedestudiante'].substr(0, 1)+'-'+datos[i]['cedestudiante'].substr(1));
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda3',
                            'align': 'left',
                            'width': '65%'
//                    }, datos[i]['firstnames'].toUpperCase()+'  '+datos[i]['lastnames'].toUpperCase());
                      }, datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    var celda4 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                    var  chek =document.createElement('input');
                    chek.setAttribute('type', "checkbox");
//                    chek.setAttribute('title', datos[i]['pin']+" - "+datos[i]['firstnames'].toUpperCase()+'  '+datos[i]['lastnames'].toUpperCase());
                    chek.setAttribute('title', datos[i]['cedestudiante']+" - "+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    chek.setAttribute('name', "chek"+(i+1));
//                    chek.setAttribute('onClick', "verificarCantEstu();");
//                    chek.setAttribute('id', datos[i]['profile_id']+'-'+datos[i]['pin']+'-'+datos[i]['firstnames'].toUpperCase()+'  '+datos[i]['lastnames'].toUpperCase());
                    chek.setAttribute('id', datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    celda4.appendChild(chek);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

function validarGrupo(formulario,ventana){
    lstTrayecto = document.getElementById('ilsttrayecto');
    objForm = document.getElementById('formEstGrupo');
    nroElement = objForm.length;
    var elementos = new Array();
    var cont = 0;
    var j = 0;
    for(i=0;i<nroElement;i++){
        if(objForm.elements[i].type=='checkbox'){
            if(objForm.elements[i].checked){
                if(objForm.elements[i].id!=0){
                    elementos[j++]=objForm.elements[i].id;
                }
                cont++;
            }
        }
    }
    minimo = 1;//minimo de estudiantes por grupo
    maximo = 6;
//    if(lstTrayecto.value == 1 || lstTrayecto.value == 2){
//        maximo = 5;//maximo de estudiantes por grupo cuando el trayecto es 1 o 2
//    }else{
//        maximo = 3;//maximo de estudiantes por grupo cuando el trayecto es 3 o 4
//    }

    if(cont > maximo){
        alert('El grupo debe estar conformado maximo por '+maximo+' estudiantes, verifique');
    }else if(cont < minimo){
        alert('El grupo debe estar conformado minimo por '+minimo+' estudiantes, verifique');
    }else{
        crearTablaGrupo(elementos);
        closeMessage();
    }
    
}

function crearTablaGrupo(req){
    campGrupo = document.getElementById('itxtgrupo');//ALMACENA LOS ESTUDIANTES SELECCIONADOS PARA EL GRUPO ACTUAL
    campGrupo.value = '';
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    datos = eval(req);
    var num=tabla.childNodes.length+1;
    var codrad = 'grup';
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        cant = datos.length;
        for(i=0;i<cant;i++){
                item++;
                var itemS = String(item) ;
                valor=datos[i].split('-');
                if(campGrupo.value == ''){
                    campGrupo.value += valor[0];
                }else{
                    campGrupo.value += '-'+valor[0];
                }
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Estudiantes',
                            'id': valor[1]+i
                });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'center',
                        'width': '15%'
                }, valor[1]);
                var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '60%'
                }, valor[2]);   
                var celda4 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '5%'
                }, '');
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
        }      
    }
}
////////////////////////// DE AQUI ES MODIFICAR GRUPO
function buscarDiagnosticosGru(){
//    campGrupo = document.getElementById('itxtgrupo');//ALMACENA LOS ESTUDIANTES SELECCIONADOS PARA EL GRUPO ACTUAL
//    campGrupo.value = '';
    lstPnf = document.getElementById('ilstPnf');
    if(lstPnf.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("pnf",lstPnf.value);
        ajax.setVar("op",'bdiaggru');
        ajax.method="POST";
        ajax.onCompletion=function(){
            crearTablaDiagGrupo(ajax.response);
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        mD.limpiaTexto(xGetElementById('cont_diaggru'));
    }
}

function crearTablaDiagGrupo(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_diaggru');
    mD.limpiaTexto(xGetElementById('cont_diaggru'));
    datos = eval("("+req+")");
    diagnosticos = datos;
//    estudiantes = datos[1];
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos[0] == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 2}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<diagnosticos.length;i++){
            if(diagnosticos[i]['iddiagnostico'] != 0){
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Click para ver el Diagnostico',
                        'id': diagnosticos[i]['iddiagnostico']
                });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'ritgh',
                        'width': '80%'
                }, html_entity_decode(diagnosticos[i]['descripdiagnostico'],'ENT_QUOTES').toUpperCase());
                fila.setAttribute('onclick',"buscarGrupDiag("+diagnosticos[i]['idgrupo']+")");
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
            }
        }
    }
}

function buscarGrupDiag(idgrupo){
    campCodGrupo = document.getElementById('itxtcodgrupo');
    if(idgrupo != ''){
        campCodGrupo.value = idgrupo;
        ajax = new sack('../Modelo.php');
        ajax.setVar("idgrupo",idgrupo);
        ajax.setVar("op",'bgrupdiag');
        ajax.method="POST";
        ajax.onCompletion=function(){
            crearTablaGrupDiag(ajax.response);
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        mD.limpiaTexto(xGetElementById('cont_diaggru'));
    }
}
function crearTablaGrupDiag(req){
//    alert(req);
    campGrupoTabla = document.getElementById('itxtgrupoTable');//ALMACENA LOS ESTUDIANTES SELECCIONADOS ORIGINALMENTE
    campGrupoTabla.value = '';
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'grupdig';
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        cant = datos.length;
        for(i=0;i<cant;i++){
                item++;
                var itemS = String(item) ;
//                valor=datos[i].split('-');
                if(campGrupoTabla.value == ''){
                    campGrupoTabla.value = datos[i]['idestudiante']+'#'+datos[i]['cedestudiante']+'#'+datos[i]['nomestudiante']+'#'+datos[i]['apeestudiante'];
                }else{
                    campGrupoTabla.value += ':'+datos[i]['idestudiante']+'#'+datos[i]['cedestudiante']+'#'+datos[i]['nomestudiante']+'#'+datos[i]['apeestudiante'];
                }
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
                        'align': 'right',
                        'width': '20%'
                }, datos[i]['cedestudiante'].substr(0, 1)+' - '+datos[i]['cedestudiante'].substr(1));
                var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '75%'
                }, datos[i]['nomestudiante'].toUpperCase()+' '+datos[i]['apeestudiante'].toUpperCase());
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
        }      
    }
}

function abrirGrupoMod(){
    lstPnf = document.getElementById('ilstPnf');
    campGrupoTabla = document.getElementById('itxtgrupoTable');//ALMACENA LOS ESTUDIANTES SELECCIONADOS PARA EL GRUPO ACTUAL
    if(lstPnf.value != -1){
        pnfString = document.getElementById('ilstPnf').options[document.getElementById('ilstPnf').selectedIndex].text;
        if(campGrupoTabla.value != ''){
             displayMessage('grupoMod.php?destino=1&pnf='+pnfString,'mostrarTodoEstGrupoMod()',750,520);
        }else{
            alert('Debe seleccionar un Diagnostico');
        }
    }else{
        alert('Debe seleccionar un PNF');
        lstPnf.focus();
    }
   
}

function mostrarTodoEstGrupoMod(){
    
    lstPnf = document.getElementById('ilstPnf');
    ajax = new sack('../Modelo.php');
    ajax.setVar("pnf",lstPnf.value);
    ajax.setVar("op",'bEstGrupo');
    ajax.method="POST";
    ajax.onCompletion=function(){
        if(ajax.response != 0){
            crearTablaEstGrupoMod(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaEstGrupoMod(req){
    var estilo = "colorCelda";
    item=0;
    var tabla = document.getElementById('cont_estgrupo');
    mD.limpiaTexto(xGetElementById('cont_estgrupo'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'gru';
    if (datos == -1){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 5}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': datos[i]['cedestudiante']+" - "+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase(),
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
                            'width': '15%'
                        }, datos[i]['cedestudiante'].substr(0, 1)+'-'+datos[i]['cedestudiante'].substr(1));
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda3',
                            'align': 'left',
                            'width': '65%'
                    }, datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    var celda4 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                    var  chek =document.createElement('input');
                    chek.setAttribute('type', "checkbox");
                    chek.setAttribute('title', datos[i]['cedestudiante']+" - "+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    chek.setAttribute('name', "chek"+(item));
                    chek.setAttribute('id', datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    celda4.appendChild(chek);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
                    tabla.appendChild(fila);
        }
        campGrupoTabla = document.getElementById('itxtgrupoTable');//ALMACENA LOS ESTUDIANTES SELECCIONADOS PARA EL GRUPO ACTUAL\
        grupoAct = campGrupoTabla.value.split(':');
        for(i=0;i<grupoAct.length;i++){
                estu = grupoAct[i].split('#');
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': estu[1]+" - "+estu[2].toUpperCase()+'  '+estu[3].toUpperCase(),
                            'id': codrad+i+2
                    });
                    var celda1 = mD.insertarCelda(fila, -1, {
                            'id': 'celda1',			
                            'align': 'center',
                            'width': '5%'
                    }, itemS);
                    var celda2 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'right',
                            'width': '15%'
                        }, estu[1].substr(0, 1)+'-'+estu[1].substr(1));
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda3',
                            'align': 'left',
                            'width': '65%'
                    }, estu[2].toUpperCase()+'  '+estu[3].toUpperCase());
                    var celda4 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                    var  chek =document.createElement('input');
                    chek.setAttribute('type', "checkbox");
                    chek.setAttribute('title', estu[1]+" - "+estu[2].toUpperCase()+'  '+estu[3].toUpperCase());
                    chek.setAttribute('name', "chek"+(item));
                    chek.setAttribute('id', estu[0]+'-'+estu[1]+'-'+estu[2].toUpperCase()+'  '+estu[3].toUpperCase());
                    chek.setAttribute('checked', 'checked');
                    celda4.appendChild(chek);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
                    tabla.appendChild(fila);
        }
    }
}

function validarGrupoMod(){
    objForm = document.getElementById('formEstGrupo');
    campGrupoTabla = document.getElementById('itxtgrupoTable');//ALMACENA LOS ESTUDIANTES SELECCIONADOS ORIGINALMENTE
    campGrupoTabla.value = '';
    nroElement = objForm.length;
    var elementos = new Array();
    var cont = 0;
    var j = 0;
    for(i=0;i<nroElement;i++){
        if(objForm.elements[i].type=='checkbox'){
            if(objForm.elements[i].checked){
                if(objForm.elements[i].id!=0){
                    elementos[j++]=objForm.elements[i].id;
                }
                cont++;
            }
        }
    }
    minimo = 1;//minimo de estudiantes por grupo
    maximo = 6;
//    if(lstTrayecto.value == 1 || lstTrayecto.value == 2){
//        maximo = 5;//maximo de estudiantes por grupo cuando el trayecto es 1 o 2
//    }else{
//        maximo = 3;//maximo de estudiantes por grupo cuando el trayecto es 3 o 4
//    }

    if(cont > maximo){
        alert('El grupo debe estar conformado maximo por '+maximo+' estudiantes, verifique');
    }else if(cont < minimo){
        alert('El grupo debe estar conformado minimo por '+minimo+' estudiantes, verifique');
    }else{
        for(i = 0;i < elementos.length;i++){
            estu = elementos[i].split('-');
            nom = estu[2].split('  ');
            if(campGrupoTabla.value == ''){
                campGrupoTabla.value = estu[0]+'#'+estu[1]+'#'+nom[0]+'#'+nom[1];
            }else{
                campGrupoTabla.value += ':'+estu[0]+'#'+estu[1]+'#'+nom[0]+'#'+nom[1];
            }
        }
        
        crearTablaGrupo(elementos);
        closeMessage();
    }
}

function modificarGrup(){
    campGrupo = document.getElementById('itxtgrupo');
    campCodGrupo = document.getElementById('itxtcodgrupo');
    if(campGrupo.value != ''){
        mensaje = html_entity_decode('&iquest;Dese modificar este grupo?', 'ENT_QUOTES');
        if(confirm(mensaje)){
            ajax = new sack('../Modelo.php');
            ajax.setVar("grupo",campGrupo.value);
            ajax.setVar("codgrupo",campCodGrupo.value);
            ajax.setVar("op",'modGrupo');
            ajax.method="POST";
            ajax.onCompletion=function(){
                if(ajax.response != 0){
                    limpiarModGrupo();
                    alert('Grupo modificado exitosamente');
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }
        
    }else{
        alert('Debe seleccionar por lo menos un estudiante para el grupo');
    }
}
function limpiarModGrupo(){
    campGrupo = document.getElementById('itxtgrupo');
    campCodGrupo = document.getElementById('itxtcodgrupo');
    campGrupoTabla = document.getElementById('itxtgrupoTable');
    lstPnf = document.getElementById('ilstPnf');
    campGrupo.value = '';
    campCodGrupo.value = '';
    campGrupoTabla.value = '';
    lstPnf.value = -1;
    mD.limpiaTexto(xGetElementById('cont_diaggru'));
    mD.limpiaTexto(xGetElementById('cont_grupo'));
}