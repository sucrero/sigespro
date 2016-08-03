var diagOld='';
function mostrarTodoAnte(){
    lstPnf = document.getElementById('ilstPnf');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosAnte');
    ajax.setVar("pnf",lstPnf.value);
    ajax.onCompletion = function(){
           crearTablaAnteproyecto(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaAnteproyecto(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_ante');
    mD.limpiaTexto(xGetElementById('cont_ante'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'ant' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            if(datos[i]['idantep'] != 0){
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Anteproyectos',
                        'id': datos[i]['idantep']
                });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'ritgh',
                        'width': '87%'
                }, html_entity_decode(datos[i]['nomantep'],'ENT_QUOTES').toUpperCase());

                var celda5 = mD.insertarCelda(fila,-1,{
                        'id':'celda5',
                        'align':'center',
                        'width':'8%'
                    },'');
                var imgE=document.createElement('img');
                imgE.src="../img/eliminar_a.png";
                imgE.border="0";
                imgE.width="16";
                imgE.height="16";
                imgE.setAttribute('title',"Eliminar");
                imgE.setAttribute('onclick',"eliminarAnteproyecto("+datos[i]['idantep']+","+datos[i]['iddiagnostico']+")");
                celda5.appendChild(imgE);
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
            }
        }
    }
}

function eliminarAnteproyecto(codigo,codDiag){
    if(confirm("Seguro desea eliminar este registro? ")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarAntep');
        ajax.setVar("codigo",codigo);
        ajax.setVar("codDiag",codDiag);
        ajax.method="POST";
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                mostrarTodoAnte();
                mensaje = html_entity_decode('Registro eliminado con &eacute;xito', 'ENT_QUOTES');
                alert(mensaje);
            }else if(ajax.response == 0){
                alert('No se puede eliminar el Anteproyecto, ya que posee un proyecto asociado');
            }else{
                alert('No se pudo elimininar el Anteproyecto');
            }                
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function cargarDatos(cod)
{
    
//    lstDiagnostico = document.getElementById('ilstdiagnostico');
    limpiarAnteproyecto();
//    if(lstDiagnostico.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarDatosDiag');
        ajax.setVar("codigo",cod);
        ajax.onCompletion = function(){
               cargarDatosAnteproyecto(ajax.response);
            }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
//    }
    closeMessage();
}
function cargarDatosAnteproyecto(cont)
{
    campProblema = document.getElementById('itxtproblemasel');
    campComunidad = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResponsable = document.getElementById('itxtresponsable');
    campConsejo = document.getElementById('itxtconsejocomunal');
    campTitulo = document.getElementById('itxttituloanteproyecto');
    campDiag = document.getElementById('ilstdiagnostico');
    datos = eval("("+cont+")");
    diagnostico = datos[0];
    problema = datos[1];
    estudiantes = datos[2];
    sector = datos[3];
    comunidad = datos[4];
    personal = datos[5];
    docentes = datos[6];
    campDiag.value = diagnostico['iddiagnostico'];
    campTitulo.value = html_entity_decode(diagnostico['descripdiagnostico'],'ENT_QUOTES').toUpperCase();
    valida_longitud(campTitulo,'255','cuenta1');
    campProblema.value = html_entity_decode(problema[0]['descripcionproblema'],'ENT_QUOTES').toUpperCase();
    cargarTablaGrupo(estudiantes);
    campComunidad.value = html_entity_decode(comunidad['nomcomuni'],'ENT_QUOTES').toUpperCase();
    campSector.value = html_entity_decode(sector['descripsector'],'ENT_QUOTES').toUpperCase();
    campResponsable.value = personal['nompersona'].toUpperCase() + ' ' + personal['apepersona'].toUpperCase();
    campConsejo.value = html_entity_decode(diagnostico['nomconsejocomunal'],'ENT_QUOTES').toUpperCase();
    crearListaDocentesAnte(diagnostico,docentes);
}

function cargarTablaGrupo(datos)
{
//    alert(datos.length);
    var estilo = 'colorCelda';
        item=0;
        var tabla = document.getElementById('cont_grupo');
        mD.limpiaTexto(xGetElementById('cont_grupo'));
        var num=tabla.childNodes.length+1;
        var codrad = 'gru' + num;
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Integrantes del Grupo',
                        'id': i
            });
            var celda1 = mD.insertarCelda(fila, -1, {
                    'id': 'celda1',			
                    'align': 'center',
                    'width': '5%'
            }, itemS);
            var celda2 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'center',
                    'width': '25%'
            }, datos[i]['cedestudiante']);
            var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '70%'
            }, datos[i]['nomestudiante'].toUpperCase() + ' ' + datos[i]['apeestudiante'].toUpperCase());
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
            tabla.appendChild(fila);
        }
}

function crearListaDocentesAnte(diag,doce)
{
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    lstTutor.disabled = false;
    lstDocente.disabled = false;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
    
    for(i=0;i<doce.length;i++){
        if(diag['iddocente'] == doce[i]['iddocente']){
            listas('ilstdocente',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilstdocente',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), false);
        }
        
        if(diag['doc_iddocente'] == doce[i]['iddocente']){
            listas('ilsttutor',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilsttutor',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), false);
        }
    }
}

function limpiarAnteproyecto()
{
    campProblema = document.getElementById('itxtproblemasel');
    campComunidad = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResponsable = document.getElementById('itxtresponsable');
    campConsejo = document.getElementById('itxtconsejocomunal');
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    campTitulo = document.getElementById('itxttituloanteproyecto');
    capa1 = document.getElementById('cuenta1');
    capa2 = document.getElementById('cuenta2');
    capa3 = document.getElementById('cuenta3');
    valida_longitud(campTitulo,'255','cuenta1');
    capa3.innerHTML = capa2.innerHTML = capa1.innerHTML = 255;
    campTitulo.value = '';
    campProblema.value = '';
    campComunidad.value = '';
    campSector.value = '';
    campResponsable.value = '';
    campConsejo.value = '';
    lstDocente.disabled = true;
    lstTutor.disabled = true;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
    mD.limpiaTexto(xGetElementById('cont_grupo'));
}

function validarAnteProyecto(opcion)
{
    /*
     * 1 = guardar
     * 2 = modificar
     */
    lstPeridodo = document.getElementById('ilstperiodo');
    lstTrayecto = document.getElementById('ilsttrayecto');
    lsttrimestre = document.getElementById('ilsttrimestre');
    lstPnf = document.getElementById('ilstPnf');
    campTituloAnte = document.getElementById('itxttituloanteproyecto');
    campObjGeneral = document.getElementById('itxtobjante');
    lstDiagnostico = document.getElementById('ilstdiagnostico');
    campFecha = document.getElementById('itxtfecha');
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    campObs = document.getElementById('txtobservacion');
    chkImp = document.getElementById('imprimir');
    
    if(lstPeridodo.value != -1){
        if(lstTrayecto.value != -1){
            if(lsttrimestre.value != -1){
                if(campTituloAnte.value != ''){
                    if(campObjGeneral.value != ''){
                        if(lstDiagnostico.value != -1){
                            if(lstDocente.value != -1){
                                if(lstTutor.value != -1){
                                    if(opcion == 1){
                                        op = 'guardarAnteproyecto';
                                    }else{
                                        op = 'modificarAnteproyecto';
                                    }
                                    ajax = new sack('../Modelo.php');
                                    ajax.setVar("op",op);
                                    ajax.setVar("per",lstPeridodo.value);
                                    ajax.setVar("tra",lstTrayecto.value);
                                    ajax.setVar("tri",lsttrimestre.value);
                                    ajax.setVar("tit",campTituloAnte.value);
                                    ajax.setVar("obj",campObjGeneral.value);
                                    ajax.setVar("dia",lstDiagnostico.value);
                                    ajax.setVar("fec",campFecha.value);
                                    ajax.setVar("doc",lstDocente.value);
                                    ajax.setVar("tut",lstTutor.value);
                                    ajax.setVar("obs",campObs.value);
                                    ajax.setVar("pnf",lstPnf.value);
                                    ajax.method="POST";
                                    ajax.onCompletion=function(){
                                        if(ajax.response != 0){
//                                            datos = eval("("+ajax.response+")");
//
                                            if(chkImp.checked){
                                                window.open("plani_anteproyecto.php?per="+lstPeridodo.value+"&tra="+lstTrayecto.value+"&tri="+lsttrimestre.value+
                                                "&tit="+campTituloAnte.value+"&obj="+campObjGeneral.value+"&dia="+lstDiagnostico.value+"&fec="+campFecha.value+
                                                "&doc="+lstDocente.value+"&tut="+lstTutor.value+"&obs="+campObs.value,
                                                "reporteanteproyecto","_blank");
                                            }
//                                            mostrarTodoAnte();
                                            limpiarAnteproyectoAll();
                                        }else{
                                            alert('No se pudo ingresar el registro');
                                        }
                                    }
                                    ajax.onError=function(){alert('Ha ocurrido un error');}
                                    ajax.runAJAX();
                                }else{
                                    alert('Debe seleccionar un Tutor');
                                }
                            }else{
                                alert('Debe seleccionar un Docente');
                            }
                        }else{
                            alert('Debe un Diagnostico');
                        }
                    }else{
                        alert('Debe ingresar el Objetivo General');
                    }
                }else{
                    alert('Debe ingresar el Titulo del Anteproyecto');
                }
            }else{
                alert('Debe seleccionar un trimestre');
            }
        }else{
            alert('Debe seleccionar un trayecto');
        } 
    }else{
        alert('Debe seleccionar un peridodo');
    }
    
}

function limpiarAnteproyectoAll()
{
    lstPeridodo = document.getElementById('ilstperiodo');
    lstTrayecto = document.getElementById('ilsttrayecto');
    lsttrimestre = document.getElementById('ilsttrimestre');
    campProblema = document.getElementById('itxtproblemasel');
    campComunidad = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResponsable = document.getElementById('itxtresponsable');
    campConsejo = document.getElementById('itxtconsejocomunal');
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    campObs = document.getElementById('txtobservacion');
    campTituloAnte = document.getElementById('itxttituloanteproyecto');
    campObjGeneral = document.getElementById('itxtobjante');
    lstDiagnostico = document.getElementById('ilstdiagnostico');
    lstPnf = document.getElementById('ilstPnf');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
    
    campProblema.value = '';
    campComunidad.value = '';
    campSector.value = '';
    campResponsable.value = '';
    campConsejo.value = '';
    campTituloAnte.value = '';
    campObjGeneral.value = '';
    lstDocente.disabled = true;
    lstTutor.disabled = true;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
//    limpiarListaToda(lstDiagnostico);
    lstDiagnostico.value = '';
    lstPeridodo.value = -1;
    lstTrayecto.value = -1;
    lsttrimestre.value = -1;
    lstPnf.value = -1;
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    campObs.value = 'Sin observaciones...';
}

//function cargarDiagnosticos()
//{
//    lstPnf = document.getElementById('ilstPnf');
////    lstDiagnostico = document.getElementById('ilstdiagnostico');
////    campCodigo = document.getElementById('itxtcodant');
////    limpiarListaToda(lstDiagnostico);
//    if(lstPnf.value != -1){  
//        ajax = new sack('../Modelo.php');
//        ajax.setVar("op",'buscarDiag');
//        ajax.setVar("pnf",lstPnf.value);
//        ajax.method="POST";
//        ajax.onCompletion = function(){
//            diags = eval("("+ajax.response+")");
//            if(diags[0] != -1){
//                cargarListaDiag(diags);
//            }else{
//                limpiarAnteproyecto();
////                lstDiagnostico.value = -1;
////                lstDiagnostico.disabled = true;
////                campCodigo.value = "";
//                mD.limpiaTexto(xGetElementById('cont_ante'));
//                alert('No existen Diagnostico para el PNF seleccionado');
//                lstPnf.value = -1;
//                lstPnf.focus();
//            }                
//        }
//        ajax.onError=function(){alert('Ha ocurrido un error');}
//        ajax.runAJAX();
//    }else{
//        limpiarAnteproyecto();
//        lstDiagnostico.value = -1;
//        lstDiagnostico.disabled = true;
//    }
//}
//
//function cargarListaDiag(diags)
//{
//    lstDiagnostico = document.getElementById('ilstdiagnostico');
//    lstDiagnostico.disabled = false;
//    for(i=0;i < diags.length;i++){        
//        listas('ilstdiagnostico',diags[i]['iddiagnostico'],html_entity_decode(diags[i]['descripdiagnostico'],'ENT_QUOTES'), false);
//    }
//}

function abrirDiagnostico(){
    lstPnf = document.getElementById('ilstPnf');
    if(lstPnf.value != -1){
        displayMessage('diagnosticos.php?destino=1&pnf='+lstPnf.value,'mostrarTodo("ante")',770,580);
    }else{
        alert('Debe seleccionar un PNF, verifique');
        lstPnf.focus();
    }
}

//function diagSel(cod){
//    campTituloProyecto = document.getElementById('itxttitproyecto');
//    campObjGeneral = document.getElementById('itxtobjgeneral');
//    campSector = document.getElementById('txtsector');
//    campComision = document.getElementById('itxtcomision');
//    campProyecto = document.getElementById('txtproyecto');
//    lstPeriodo = document.getElementById('ilstperiodo');
//    lsttrayecto = document.getElementById('ilsttrayecto');
//    lstTrimestre = document.getElementById('ilsttrimestre');
//    campComision.value = '';
//    datosSel = datosSelInt = seleccionInt = seleccion = '';
//    mD.limpiaTexto(xGetElementById('cont_comi'));
////    campComision = document.getElementById('itxtcomision');
//    ajax = new sack('../Modelo.php');
//    ajax.setVar("op",'buscarDatosProy');
//    ajax.setVar("codigo",cod);
//    ajax.method="POST";
//    ajax.onCompletion = function(){
//        if(ajax.response!=0){
//            datos = eval("("+ajax.response+")");
//            proyecto = datos[0];
//            estudiantes = datos[1];
//            tutor = datos[2]['iddocente']+'-'+datos[2]['ceddocente']+'-'+datos[2]['nomdocente'].toUpperCase()+'  '+datos[2]['apedocente'].toUpperCase()+'-T';
//            sector = datos[3];
//            campSector.value = sector['idsectorcomunidad'];
//            campTituloProyecto.value = html_entity_decode(proyecto['objproyecto'],'ENT_QUOTES').toUpperCase();
//            campObjGeneral.value = html_entity_decode(proyecto['objproyecto'],'ENT_QUOTES').toUpperCase();
//            campProyecto.value = proyecto['idproyecto'];
//            lstPeriodo.value = proyecto['idperiodo'];
//            lsttrayecto.value = proyecto['trayectoproy'];
//            lstTrimestre.value = proyecto['trimestreproy'];
//            cargarTablaGrupo(estudiantes);
//        }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//    closeMessage();
//}