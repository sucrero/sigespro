function cargarDatosDiag(){
//    campPro = document.getElementById('itxtproblema');
    lstDiag = document.getElementById('ilstdiagnostico');
    if(lstDiag.valua != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarDatosDiag');
        ajax.setVar("diag",lstDiag.value);
        ajax.onCompletion = function(){
//                alert(ajax.response);
                if(ajax.response!=0){
                    cargarDatosD(ajax.response);
                }else{
                    limpiarDiag();
                    alert('Debe completar el registro del Diagnostico seleccionado');
                }
                
            }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function cargarDatosD(req){
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    lstResponsable = document.getElementById('ilstreponsable');
    campProblema = document.getElementById('itxtproblemas');
    datos = eval("("+req+")");
    diag = datos[0];
    docente = datos[1];
    responsable = datos[2];
    grupoEstu = datos[3];
    estudiante = datos[4];
    grupos = datos[5];

    for(i=0;i<diag.length;i++){
        
        if(diag[i]['seleccionado']==1){
            campProblema.value = html_entity_decode(diag[i]['descripcionproblema'],'ENT_QUOTES').toUpperCase();
            campProblema.name=diag[i]['idproblema'];
            t = i;
            break;
        }else{
            campProblema.value='';
            campProblema.name='';
        }
    }

    limpiarListaToda(lstDocente);
    for(i=0;i<docente.length;i++){
        if(diag[t]['iddocente']==docente[i]['iddocente']){
            listas('ilstdocente',docente[i]['iddocente'],html_entity_decode(docente[i]['nomdocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilstdocente',docente[i]['iddocente'],html_entity_decode(docente[i]['nomdocente'],'ENT_QUOTES'), false);
        }
    }
    
    
    limpiarListaToda(lstTutor);
    for(i=0;i<docente.length;i++){
        if(diag[t]['doc_iddocente']==docente[i]['iddocente']){
            listas('ilsttutor',docente[i]['iddocente'],html_entity_decode(docente[i]['nomdocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilsttutor',docente[i]['iddocente'],html_entity_decode(docente[i]['nomdocente'],'ENT_QUOTES'), false);
        }
    }
    
    limpiarListaToda(lstResponsable);
    for(i=0;i<responsable.length;i++){
        if(diag[t]['idpersona']==responsable[i]['idpersona']){
            listas('ilstreponsable',responsable[i]['idpersona'],html_entity_decode(responsable[i]['nompersona'],'ENT_QUOTES'), true);
        }else{
            listas('ilstreponsable',responsable[i]['idpersona'],html_entity_decode(responsable[i]['nompersona'],'ENT_QUOTES'), false);
        }
    } 
    
    var gru = new Array();
    for(i=0;i<grupos.length;i++){
        l=0;
        gru[i] = new Array();
        for(j=0;j<grupoEstu.length;j++){
            if(grupos[i]['idgrupo']==grupoEstu[j]['idgrupo']){
                for(k=0;k<estudiante.length;k++){
                    if(grupoEstu[j]['idestudiante']==estudiante[k]['idestudiante']){
                        gru[i][l++]=grupos[i]['idgrupo']+'#'+estudiante[k]['idestudiante']+'#'+estudiante[k]['cedestudiante']+'#'+estudiante[k]['nomestudiante']+'#'+estudiante[k]['apeestudiante'];    
                    }
                }
            }
        }
    }
    crearListaGrupoProy(gru,diag[t]['idgrupo']);
}

function crearListaGrupoProy(cont,idgrupo){
    formulario = document.getElementById('formProyecto');
    lstGrupo=formulario.ilstgrupo;
    dato = eval(cont);
    limpiarListaToda(lstGrupo);
    for(i=0;i<dato.length;i++){
        grupo='';
        for(j=0;j<dato[i].length;j++){
            estu=dato[i][j].split('#');
            if(j!=0){
                grupo+=' # ';
            }
            grupo+=estu[2]+' - '+estu[3]+' '+estu[4];
        }
        if(idgrupo==estu[0]){
            este = grupo;
            listas('ilstgrupo',estu[0],html_entity_decode(grupo,'ENT_QUOTES'), true);
        }else{
            listas('ilstgrupo',estu[0],html_entity_decode(grupo,'ENT_QUOTES'), false);
        }
    }
    crearTablaGrupoProy(este);
}

function crearTablaGrupoProy(req){
//    alert(req);
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
//    datos = eval(req);
    grupo = req.split('#');
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<grupo.length;i++){
                item++;
                var itemS = String(item) ;
                valor=grupo[i].split('-');
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Estudiantes',
                            'id': valor[0]
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
                    }, valor[0]);
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '65%'
                    }, valor[1].toUpperCase());
        }      
    }
    
}

function limpiarDiag(){
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    lstResponsable = document.getElementById('ilstreponsable');
    lstDiag = document.getElementById('ilstdiagnostico');
    lstGrupo = document.getElementById('ilstgrupo');
    campProblema = document.getElementById('itxtproblemas');
    lstDiag.value=-1;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
    limpiarListaToda(lstResponsable);
    limpiarListaToda(lstGrupo);
    campProblema.value='';
}

function validarProy(){
    lstPer = document.getElementById('ilstperiodo');
    lstTra = document.getElementById('ilsttrayecto');
    lstTri = document.getElementById('ilsttrimestre');
    lstPnf = document.getElementById('ilstPnf');
    lstAnteProy = document.getElementById('ilstanteproy');
//    campCodPro = document.getElementById('itxtcodproyecto');
    campTitPro = document.getElementById('itxttituloproyecto');
    campObjPro = document.getElementById('itxtobjproyecto');
    
    campAreCon = document.getElementById('itxtareaconocimiento');
    campPro = document.getElementById('itxtproblemasel').name;
    campComu = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResp = document.getElementById('itxtresponsable').name;
    campConsejo = document.getElementById('itxtconsejocomunal');
    campFec = document.getElementById('itxtfecha');
    campGru = document.getElementById('grupo');
    lstDoc = document.getElementById('ilstdocente');
    lstTut = document.getElementById('ilsttutor');
    campObs = document.getElementById('itxtobservacion');
    chkImp = document.getElementById('imprimir');
    if(lstPer.value!=-1){
        if(lstTra.value!=-1){
            if(lstTri.value!=-1){
                if(lstPnf.value!=-1){
                        if(campTitPro.value!=''){
                            if(campObjPro.value!=''){
                                if(lstAnteProy.value!=-1){
                                    if(campAreCon.value!=''){
                                        if(campPro!=''){
                                            if(campSector.value!=''){
                                                if(campResp!=''){
                                                    if(campConsejo.value!=''){
                                                        if(campFec.value!=''){
                                                            if(lstDoc.value!=''){
                                                                if(lstTut.value!=''){
                                                                        ajax = new sack('../Modelo.php');
                                                                        ajax.setVar("op",'guadarProy');
                                                                        ajax.setVar("per",lstPer.value);
                                                                        ajax.setVar("tra",lstTra.value);
                                                                        ajax.setVar("tri",lstTri.value);
                                                                        ajax.setVar("pnf",lstPnf.value);
//                                                                        ajax.setVar("cod",campCodPro.value);
                                                                        ajax.setVar("tit",campTitPro.value);
                                                                        ajax.setVar("obj",campObjPro.value);
                                                                        ajax.setVar("ant",lstAnteProy.value);
                                                                        ajax.setVar("are",campAreCon.value);
                                                                        ajax.setVar("pro",campPro);
                                                                        ajax.setVar("res",campResp);
                                                                        ajax.setVar("fec",campFec.value);
                                                                        ajax.setVar("doc",lstDoc.value);
                                                                        ajax.setVar("tut",lstTut.value);
                                                                        ajax.setVar("obs",campObs.value);
                                                                        ajax.setVar("gru",campGru.value);
                                                                        ajax.onCompletion = function(){
                                                                              if(ajax.response != 0){
                                                                                    if(chkImp.checked){
                                                                                        window.open("plani_proyecto.php?per="+lstPer.value+"&tra="+lstTra.value+"&tri="+lstTri.value+
                                                                                        "&tit="+campTitPro.value+"&obj="+campObjPro.value+"&ant="+lstAnteProy.value+"&fec="+campFec.value+
                                                                                        "&doc="+lstDoc.value+"&tut="+lstTut.value+"&obs="+campObs.value+"&com="+campComu.name+"&con="+campConsejo.value+
                                                                                        "&pro="+campPro+"&sec="+campSector.name+"&res="+campResp,"reporteproyecto","_blank");
                                                                                    }
//                                                                                    mostrarTodoProy('pro');
                                                                                    limpiarListaToda(lstAnteProy);
                                                                                    limpiarProyecto();
                                                                                    cargarAnteproyectos();
                                                                                }else{
                                                                                    alert('No se pudo ingresar el registro');
                                                                                }
                                                                        }
                                                                        ajax.onError=function(){alert('Ha ocurrido un error');}
                                                                        ajax.runAJAX();
                                                                }else{
                                                                    alert('Debe seleccionar un tutor');
                                                                }
                                                            }else{
                                                                alert('Debe seleccionar un docente');
                                                            }
                                                        }else{
                                                            alert('Debe ingresar la fecha actual');
                                                        }
                                                    }else{
                                                        alert('Debe ingresar un Consejo Comunal');
                                                    }
                                                }else{
                                                    alert('Debe ingresar un Responsable');
                                                }
                                            }else{
                                                alert('Debe ingresar un Sector');
                                            }
                                        }else{
                                            alert('Debe ingresar un problema de proyecto');
                                        }
                                    }else{
                                        alert('Debe ingresar un area de conocimiento');
                                    }
                                }else{
                                    alert('Debe seleccionar un Anteproyecto');
                                }
                            }else{
                                alert('Debe ingresar un objetivo de proyecto');
                            }
                        }else{
                            alert('Debe ingresar un titulo de proyecto');
                        }
                }else{
                    alert('Debe seleccionar un PNF');
                }
            }else{
                alert('Debe seleccionar un trimestre');
            }
        }else{
            alert('Debe seleccionar un trayecto');
        }
    }else{
        alert('Debe seleccionar un periodo');
    }
}

function mostrarTodoProy(op){
    lstPnf = document.getElementById('ilstPnf');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosProy');
    ajax.setVar("pnf",lstPnf.value);
    ajax.onCompletion = function(){
        crearTablaProyecto(ajax.response,op);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
    
}

function crearTablaProyecto(req,op){
    var estilo = 'colorCelda';
    var codPro;
    item=0;
    var tabla = document.getElementById('cont_proy');
    mD.limpiaTexto(xGetElementById('cont_proy'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    //alert(datos.length);
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Proyectos',
                            'id': datos[i]['idproyecto']
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
                    }, html_entity_decode(datos[i]['nomproyecto'],'ENT_QUOTES').toUpperCase());
                    

//                    var celda6 = mD.insertarCelda(fila,-1,{
//                            'id':'celda6',
//                            'align':'center',
//                            'width':'7,5%'
//                        },'');
                    if(op == 'pro'){
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
                        imgE.setAttribute('onclick',"eliminarProyecto("+datos[i]['idproyecto']+","+datos[i]['iddiagnostico']+")");
                        celda5.appendChild(imgE); 
                    }
                    codPro = datos[i]['idproyecto'];
//                    var imgM=document.createElement('img');
//                    imgM.src="../img/reporte.png";
//                    imgM.border="0";
//                    imgM.width="16";
//                    imgM.height="16";
//                    imgM.setAttribute('title',"Modificar");
//                    imgM.setAttribute('onclick',"buscarProyMod("+datos[i]['idproyecto']+")");
//                    celda6.appendChild(imgM);
                    if(op == 'eva'){
                        fila.setAttribute('onclick',"proyeSel("+codPro+")");
                    }
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

function eliminarProyecto(codigo,codDiag){
    if(confirm("Seguro desea eliminar este registro? ")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarProy');
        ajax.setVar("codigo",codigo);
        ajax.setVar("codDiag",codDiag);
        ajax.method="POST";
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                cargarAnteproyectos();
                alert('Registro eliminado con exito');
            }else if(ajax.response == 0){
                alert('No se puede eliminar el Proyecto, ya que posee una evaluacion asociado');
            }else{
                alert('No se pudo elimininar el Proyecto');
            }                
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function cargarAnteproyectos()
{
    
    lstPnf = document.getElementById('ilstPnf');
    lstAteproyecto = document.getElementById('ilstanteproy');
//    campCodigo = document.getElementById('itxtcodproyecto');
    limpiarListaToda(lstAteproyecto);
    if(lstPnf.value != -1){  
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarAnteproy');
        ajax.setVar("pnf",lstPnf.value);
        ajax.method="POST";
        ajax.onCompletion = function(){
//            alert(ajax.response);
            antep = eval("("+ajax.response+")");
            if(antep[0] != -1){
                cargarListaAnte(antep);
            }else{
                limpiarProyecto();
                lstAteproyecto.value = -1;
                lstAteproyecto.disabled = true;
//                campCodigo.value = "";
                alert('No existen Anteproyectos para el PNF seleccionado');
                lstPnf.value = -1;
                lstPnf.focus();
            }                
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
//        mostrarTodoProy('pro');
    }else{
        limpiarProyecto();
        lstAteproyecto.value = -1;
        lstAteproyecto.disabled = true;
    }
}

function cargarListaAnte(antep)
{
    lstAnteproyecto = document.getElementById('ilstanteproy');
    lstAnteproyecto.disabled = false;
    for(i=0;i < antep.length;i++){        
        listas('ilstanteproy',antep[i]['idantep'],html_entity_decode(antep[i]['nomantep'],'ENT_QUOTES'), false);
    }
    mostrarTodoProy('pro');
}

function buscarDatosAntep()
{
    lstAnteproyecto= document.getElementById('ilstanteproy');
    if(lstAnteproyecto.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarDatosAnt');
        ajax.setVar("codigo",lstAnteproyecto.value);
        ajax.onCompletion = function(){
               cargarDatosProyecto(ajax.response);
            }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarProyecto();
    }
}

function cargarDatosProyecto(cont)
{
    campProblema = document.getElementById('itxtproblemasel');
    campComunidad = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResponsable = document.getElementById('itxtresponsable');
    campConsejo = document.getElementById('itxtconsejocomunal');
    campGrupo = document.getElementById('grupo');
    campTituloProy = document.getElementById('itxttituloproyecto');
    campObjetivoProy = document.getElementById('itxtobjproyecto');
    datos = eval("("+cont+")");
    anteproyecto = datos[0];
    problema = datos[1];
    estudiantes = datos[2];
    diagnostico = datos[3];
    docentes = datos[5];
    campTituloProy.value = html_entity_decode(anteproyecto['nomantep'],'ENT_QUOTES').toUpperCase();
    valida_longitud(campTituloProy,'255','cuenta1');
    campObjetivoProy.value = html_entity_decode(anteproyecto['objantep'],'ENT_QUOTES').toUpperCase();
    campGrupo.value = datos[0]['idgrupo'];
    campProblema.value = html_entity_decode(problema[0]['descripcionproblema'],'ENT_QUOTES').toUpperCase();
    campProblema.name = problema[0]['idproblema'];
    cargarTablaGrupo(estudiantes);
    campComunidad.value = html_entity_decode(diagnostico['nomcomuni'],'ENT_QUOTES').toUpperCase();
    campComunidad.name = diagnostico['idcomuni'];
    campSector.value = html_entity_decode(diagnostico['descripsector'],'ENT_QUOTES').toUpperCase();
    campSector.name = problema[0]['idsectorcomunidad'];
    campResponsable.value = diagnostico['nompersona'].toUpperCase() + ' ' + diagnostico['apepersona'].toUpperCase();
    campResponsable.name = diagnostico['idpersona'];
    campConsejo.value = html_entity_decode(diagnostico['nomconsejocomunal'],'ENT_QUOTES').toUpperCase();
    crearListaDocentesProy(anteproyecto,docentes);
}

function cargarTablaGrupo(datos)
{
    var estilo = 'colorCelda';
        item=0;
        var tabla = document.getElementById('cont_grupo');
        mD.limpiaTexto(xGetElementById('cont_grupo'));
        var num=tabla.childNodes.length+1;
        var codrad = 'gr' + num;
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Integrantes del Grupo',
                        'id': codrad+i
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

function crearListaDocentesProy(ante,doce)
{
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    lstTutor.disabled = false;
    lstDocente.disabled = false;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
    
    for(i=0;i<doce.length;i++){
        if(ante['iddocente'] == doce[i]['iddocente']){
            listas('ilstdocente',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilstdocente',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), false);
        }
        
        if(ante['doc_iddocente'] == doce[i]['iddocente']){
            listas('ilsttutor',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilsttutor',doce[i]['iddocente'],html_entity_decode(doce[i]['nomdocente']+' '+doce[i]['apedocente'],'ENT_QUOTES'), false);
        }
    }
}

function limpiarProyecto()
{
    lstPnf = document.getElementById('ilstPnf');
    lstAnteproy = document.getElementById('ilstanteproy');
    campProblema = document.getElementById('itxtproblemasel');
    campComunidad = document.getElementById('itxtcomunidad');
    campSector = document.getElementById('itxtsector');
    campResponsable = document.getElementById('itxtresponsable');
    campConsejo = document.getElementById('itxtconsejocomunal');
    campTituloProy = document.getElementById('itxttituloproyecto');
    lstDocente = document.getElementById('ilstdocente');
    lstTutor = document.getElementById('ilsttutor');
    lstPer = document.getElementById('ilstperiodo');
    lstTra = document.getElementById('ilsttrayecto');
    lstTri = document.getElementById('ilsttrimestre');
    campObjetivoProy = document.getElementById('itxtobjproyecto');
    campObs = document.getElementById('itxtobservacion');
    campArea = document.getElementById('itxtareaconocimiento');
    lstPer.value = -1;
    lstTra.value = -1;
    lstTri.value = -1;
    lstPnf.value = -1;
    limpiarListaToda(lstAnteproy);
    campTituloProy.value = '';
    campObjetivoProy.value = '';
    campProblema.value = '';
    campComunidad.value = '';
    campSector.value = '';
    campResponsable.value = '';
    campConsejo.value = '';
    campArea.value = '';
    lstDocente.disabled = true;
    lstTutor.disabled = true;
    limpiarListaToda(lstDocente);
    limpiarListaToda(lstTutor);
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    campObs.value = 'Sin observaciones...';
}

function buscarProyLe(obj, e){
    lstPnf = document.getElementById('ilstPnf');
    if(e.keyCode==13 || e.keyCode==9)return;
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarProLet');
    ajax.setVar("letras",obj.value);
    ajax.setVar("pnf",lstPnf.value);
    ajax.onCompletion = function(){
           crearTablaProyecto(ajax.response,'eva');
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}