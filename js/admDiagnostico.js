var problema = '';
var grupo = ''; // NUEVO EL 22012014

function mMunicipiosDiag(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstMunicipio.disabled=true;
    lstParroquia.disabled=true;
    lstComunidad.disabled=true;
    lstSector.disabled=true;
    mD.limpiaTexto(xGetElementById('cont_problem'));
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
        limpiarListaToda(lstMunicipio);
        limpiarListaToda(lstParroquia);
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}
function crearListaMun(objLista,cont){
    capaLoad = document.getElementById('cargando');
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
//        lstMunicipio.value = '19014';
//        mParroquias();
    }else{
        alert('No existen Municipios para este Estado');
        limpiarListaToda(lstMunicipio);
        limpiarListaToda(lstParroquia);
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        limpiarListaToda(lstResponsable);
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
        lstResponsable.disabled=true;
    }
    
}
function mParroquias(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstParroquia.disabled = true;
    lstComunidad.disabled = true;
    lstSector.disabled = true;
    campResponsable.value = '';
    mD.limpiaTexto(xGetElementById('cont_problem'));
    if(lstMunicipio.value != -1){
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
        limpiarListaToda(lstParroquia);
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstParroquia.disabled = true;
        lstComunidad.disabled = true;
        lstSector.disabled = true;
    }
}
function crearListaPar(objLista,cont){
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
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
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstParroquia.disabled = true;
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        campResponsable.value = '';
    }
}
function mostrarTodo(op){
    lstPnf = document.getElementById('ilstPnf');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosDiag');
    ajax.setVar("pnf",lstPnf.value);
    ajax.onCompletion = function(){
//        alert(ajax.response);
        crearTablaDiagnostico(ajax.response,op);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}
function crearTablaDiagnostico(req,op){
//  alert(req);
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_diag');
    mD.limpiaTexto(xGetElementById('cont_diag'));
    datos = eval("("+req+")");
//    alert(datos);
    var num = tabla.childNodes.length + 1;
    var codrad = 'diag' + num;
    if (datos[0] == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            if(datos[i]['iddiagnostico'] != 0){
                item++;
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Diagnosticos',
                        'id': codrad+i
                });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                
                if(op == 'diag'){
                    var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'ritgh',
                        'width': '80%'
                    }, html_entity_decode(datos[i]['descripdiagnostico'],'ENT_QUOTES').toUpperCase());
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
                    imgE.setAttribute('onclick',"eliminarDiagnostico("+datos[i]['iddiagnostico']+")");
                    celda5.appendChild(imgE);
                    var imgM=document.createElement('img');
                    imgM.src="../img/reporte.png";
                    imgM.border="0";
                    imgM.width="16";
                    imgM.height="16";
                    imgM.setAttribute('title',"Modificar");
                    imgM.setAttribute('onclick',"buscarDiagnostico("+datos[i]['iddiagnostico']+")");
                    celda6.appendChild(imgM);
                }else{
                    var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'ritgh',
                        'width': '95%'
                    }, html_entity_decode(datos[i]['descripdiagnostico'],'ENT_QUOTES').toUpperCase());
                }
                if(op == 'ante'){
                    fila.setAttribute('onclick',"cargarDatos("+datos[i]['iddiagnostico']+")");
                }
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
            }
        }
    }
//    if(op == 'diag'){
//        buscarProfesores();
//    }
}
function buscarDiagnostico(codDiag){
    document.getElementById('codDiagnos').value=codDiag;
    ajax = new sack('../Modelo.php');
    ajax.setVar("cod",codDiag);
    ajax.setVar("op",'busDiag');
    ajax.method="POST";
    ajax.onCompletion=function(){
        if(ajax.response == -1){
            alert('El registro no se puede modificar, ya que posee un anteproyecto asociado');
        }else if(ajax.response == -2){
            alert('El registro no se puede modificar, ya que posee un proyecto asociado');
        }else if(ajax.response ==0){
            alert('No pudieron cargarse algunos registros');
        }else{
            cargarDatosDiagnostico(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}
function cargarDatosDiagnostico(req){
    romanos = new Array('I', 'II', 'III','IV');
    campCod = document.getElementById('itxtcoddia');
    lstPer = document.getElementById('ilstperiodo');
    lstTra = document.getElementById('ilsttrayecto');
    lstTri = document.getElementById('ilsttrimestre');
    lstPnf = document.getElementById('ilstPnf');
    lstEst = document.getElementById('ilstestado');
    lstMun = document.getElementById('ilstmunicipio');
    lstPar = document.getElementById('ilstparroquia');
    lstCom = document.getElementById('ilstcomunidad');
    lstSec = document.getElementById('ilstsectorcomun');
    camResponsable = document.getElementById('itxtresponsable');
    camCon = document.getElementById('txtNomConsejoComun');
    camTit = document.getElementById('itxttitulodiagnostico');
    camPro = document.getElementById('itxtproblemas');
    optPro = document.getElementsByName('grupo1');
    camFec = document.getElementById('itxtfecha');
    lstDoc = document.getElementById('ilstdocente');
    lstTut = document.getElementById('ilsttutor');
    camObs = document.getElementById('txtobservacion');
    chkImp = document.getElementById('imprimir');
    btnGuardar = document.getElementById('btningresar');
    btnLimpiarGru = document.getElementById('limpiartablagrupodiag');
    btnIngresarGru = document.getElementById('seleccionargrupo');
    btnModificar = document.getElementById('btnmodificar');
    campSeccion = document.getElementById('itxtseccion');
    campInformacion = document.getElementById('inform');
    btnGuardar.style.display='none';
    btnModificar.style.display='block';
    btnLimpiarGru.style.display='none';
    btnIngresarGru.style.display='none';
    campInformacion.style.display='block';
    datos = eval("("+req+")");
    
    diag = datos[0];
    doc = datos[1];
    comuni = datos[2];
    sector = datos[3];
    resp = datos[4];
    grupos = datos[5];
    problemas = datos[7];
    estudiante = datos[8];
    pnf = datos[9];
    estado = datos[10]; //codigo del estado
    codComunidad = datos[11];//codigo comunidad
    municipios = datos[12];//municipios
    parroquias = datos[13];//parroquias
//    estados = datos[14];//estados
    comunidadesParr = datos[15];//comunidades d ela parroquia
    codmunicipio = datos[16];//codigo municipio
    campSeccion.name = diag['idgrupo'];
    campCod.value = diag['iddiagnostico'];
//    alert('grupo sel: '+campSeccion.name);
    lstPer.value = diag['idperiodo'];
    lstTra.value = diag['trayectodiagnostico'];
    lstTri.value = diag['trimestrediagnostico'];
    lstEst.value = estado;
//  listamos los municipios
    limpiarListaToda(lstMun);
    lstMun.disabled = false;
    for(i=0;i<municipios.length;i++){
        if(codmunicipio == municipios[i]['idmunicipio']){
            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), true);
        }else{
            listas('ilstmunicipio',municipios[i]['idmunicipio'],html_entity_decode(municipios[i]['descripmunicipio'],'ENT_QUOTES'), false);
        }
    }
//    listamos las parroquias
    limpiarListaToda(lstPar);
    lstPar.disabled = false;
    for(i=0;i<parroquias.length;i++){
        if(codComunidad['idparroquia'] == parroquias[i]['idparroquia']){
            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), true);
        }else{
            listas('ilstparroquia',parroquias[i]['idparroquia'],html_entity_decode(parroquias[i]['descripparroquia'],'ENT_QUOTES'), false);
        }
    }
    limpiarListaToda(lstCom);
    lstCom.disabled = false;
    for(i=0;i<comuni.length;i++){
        if(sector[0]['idcomuni']==comuni[i]['idcomuni']){
            listas('ilstcomunidad',comuni[i]['idcomuni'],html_entity_decode(comuni[i]['nomcomuni'],'ENT_QUOTES'), true);
        }else{
            listas('ilstcomunidad',comuni[i]['idcomuni'],html_entity_decode(comuni[i]['nomcomuni'],'ENT_QUOTES'), false);
        }
    }
    lstSec.disabled=false;
    limpiarListaToda(lstSec);
    for(i=0;i<sector.length;i++){
        if(diag['idsectorcomunidad']==sector[i]['idsectorcomunidad']){
            listas('ilstsectorcomun',sector[i]['idsectorcomunidad'],html_entity_decode(sector[i]['descripsector'],'ENT_QUOTES'), true);
        }else{
            listas('ilstsectorcomun',sector[i]['idsectorcomunidad'],html_entity_decode(sector[i]['descripsector'],'ENT_QUOTES'), false);
        }
    }
    camResponsable.value = html_entity_decode(resp[0]['nompersona']+' '+resp[0]['apepersona'],'ENT_QUOTES');
    camResponsable.name = resp[0]['idpersona'];
    camCon.value = html_entity_decode(diag['nomconsejocomunal'],'ENT_QUOTES').toUpperCase();
    camTit.value = html_entity_decode(diag['descripdiagnostico'],'ENT_QUOTES').toUpperCase();
    limpiarListaToda(lstDoc);
    lstDoc.disabled = false;
    for(i=0;i<doc.length;i++){
        if(diag['iddocente']==doc[i]['iddocente']){
            listas('ilstdocente',doc[i]['iddocente'],html_entity_decode(doc[i]['nomdocente']+' '+doc[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilstdocente',doc[i]['iddocente'],html_entity_decode(doc[i]['nomdocente']+' '+doc[i]['apedocente'],'ENT_QUOTES'), false);
        }
    }
    limpiarListaToda(lstTut);
    lstTut.disabled = false;
    for(i=0;i<doc.length;i++){
        if(diag['doc_iddocente']==doc[i]['iddocente']){
            listas('ilsttutor',doc[i]['iddocente'],html_entity_decode(doc[i]['nomdocente']+' '+doc[i]['apedocente'],'ENT_QUOTES'), true);
        }else{
            listas('ilsttutor',doc[i]['iddocente'],html_entity_decode(doc[i]['nomdocente']+' '+doc[i]['apedocente'],'ENT_QUOTES'), false);
        }
    }
    camObs.value = html_entity_decode(diag['observaciondiagnostico'],'ENT_QUOTES').toUpperCase();
    for(i=0;i<grupos.length;i++){
        if(diag['idgrupo'] == grupos[i]['idgrupo']){
            campSeccion.value = grupos[i]['seccion'];
        }
    }

    campGrupoMod = document.getElementById('itxtgrupoMod');
    campGrupoMod.value = '';
    estu = new Array();
    for(i=0;i<estudiante.length;i++){
        if(campGrupoMod.value == ''){
            estu[i] = estudiante[i]['idestudiante']+'-'+estudiante[i]['cedestudiante']+'-'+estudiante[i]['nomestudiante'].toUpperCase()+'  '+estudiante[i]['apeestudiante'].toUpperCase();
        }else{
            estu[i] = estu[i]+','+estudiante[i]['idestudiante']+'-'+estudiante[i]['cedestudiante']+'-'+estudiante[i]['nomestudiante'].toUpperCase()+'  '+estudiante[i]['apeestudiante'].toUpperCase();
        }     
    }
    crearTablaGrupo(estu);
    
    campProblem = document.getElementById('itxtproblemas');  
    campProblem.value='';
    for(i=0;i<problemas.length;i++){
        
        if(problemas[i]['seleccionado'] == 1){
            if(problemas[i]['iddiagnostico'] == diag['iddiagnostico']){
                if(campProblem.value != ''){
                    campProblem.value=campProblem.value+'='+problemas[i]['descripcionproblema']+'@'+problemas[i]['idproblema'];
                }else{
                    campProblem.value=problemas[i]['descripcionproblema']+'@'+problemas[i]['idproblema'];
                }
                sel=problemas[i]['idproblema'];
                problema = problemas[i]['idproblema'];
            }
        }
        if(problemas[i]['seleccionado'] == 0){
            if(campProblem.value != ''){
                campProblem.value=campProblem.value+'='+problemas[i]['descripcionproblema']+'@'+problemas[i]['idproblema'];
            }else{
                campProblem.value=problemas[i]['descripcionproblema']+'@'+problemas[i]['idproblema'];
            }
        }
        
    }
    
    crearTablaProblemaDiagnostico(campProblem,sel);   

    limpiarListaToda(lstPnf);
    lstPnf.disabled = false;
    for(i=0;i<pnf.length;i++){
        if(diag['idpnf'] == pnf[i]['idpnf']){
            listas('ilstPnf',pnf[i]['idpnf'],html_entity_decode(pnf[i]['descripcionpnf'],'ENT_QUOTES'), true);
        }else{
            listas('ilstPnf',pnf[i]['idpnf'],html_entity_decode(pnf[i]['descripcionpnf'],'ENT_QUOTES'), false);
        }
    }
        
}
function ventaEmergenteComunidad(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    if(lstEstado.value != -1){
        if(lstMunicipio.value != -1){
            if(lstParroquia.value != -1){
                displayMessage('comunidad.php?destino=1&estado='+lstEstado.value+'&municipio='+lstMunicipio.value+'&parroquia='+lstParroquia.value,'',770,648);
            }else{
                alert('Debe seleccionar una Parroquia, verifique');
                lstParroquia.focus();
            }
        }else{
            alert('Debe seleccionar un Municipio, verifique');
            lstMunicipio.focus();
        }
    }else{
        alert('Debe seleccionar un Estado, verifique');
        lstEstado.focus();
    }
}
function mComunidadesDiag(){
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    campResponsable.value = '';
    lstComunidad.disabled = true;
    lstSector.disabled = true;
    mD.limpiaTexto(xGetElementById('cont_problem'));
    if(lstParroquia.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codParroquia",lstParroquia.value);
        ajax.setVar("op",'bComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaComDiag(lstComunidad,ajax.response);
                lstComunidad.disabled=false;
            }else{
                if(confirm("No existen Comunidades para esta Parroquia, ¿Desea ingresar un Comunidad para esta Parroquia?")){
                    ventaEmergenteComunidad();
                }else{
                    lstParroquia.value=-1;
                }
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstComunidad.disabled = true;
        lstSector.disabled = true;
    }
}
function crearListaComDiag(objLista,cont){
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
        limpiarListaToda(lstSector);
        limpiarListaToda(lstResponsable);
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        lstResponsable.disabled = true;
    }
}
function crearTablaProblemaDiagnostico(obj,sel){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_problem');    
    mD.limpiaTexto(xGetElementById('cont_problem'));
    datos = obj.value.split('=');
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            subdatos = datos[i].split('@');
                var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Problemas',
                        'id': subdatos[1]
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
                }, html_entity_decode(subdatos[0],'ENT_QUOTES').toUpperCase());
                var celda3 = mD.insertarCelda(fila,-1,{
                        'id':'celda4',
                        'align':'center',
                        'width':'15%'
                    },'');
                var  chek =document.createElement('input');
                chek.setAttribute('type', "radio");
                chek.setAttribute('title', "Tilde el problema a seleccionar");
                chek.setAttribute('name', "grupo1");
                if(sel == subdatos[1]){
                    chek.setAttribute('checked', "checked");
                }
                chek.setAttribute('id', subdatos[1]);
                celda3.appendChild(chek);
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
        }
    }
    
}
function crearTablaGrupoProy(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
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
                            'width': '15%'
                    }, valor[0]);
                    var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '65%'
                    }, valor[1].toUpperCase());
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }      
    }
    
}
function eliminarDiagnostico(codDiag){
    if(confirm("Seguro que desea eliminar este registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("cod",codDiag);
        ajax.setVar("op",'eliDiag');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response == 0){
                alert("No se pudo eliminar el registro");
            }else if(ajax.response == 1){
                mostrarTodo('diag');
                alert("Registro eliminado exitosamente");
            }else if(ajax.response == 2){
                alert("No se puede eliminar el registro, El Diagnostico posee registros asociados en Anteproyecto");
            }else if(ajax.response == 3){
                alert("No se puede eliminar el registro, El Diagnostico posee registros asociados en Proyecto");
            }else{
                alert("ERROR INESPERADO");
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}
function buscarSectoresDiag(des){
//	1 = de diagnostico
//	3 = de responsable
    lstComunidad = document.getElementById('ilstcomunidad');
    if (des==1){
        lstSectorComunidad = document.getElementById('ilstsectorcomun');
        campResponsable = document.getElementById('itxtresponsable');
        campResponsable.value = '';
        campConsejo = document.getElementById('txtNomConsejoComun');
        campConsejo.value = '';
        mD.limpiaTexto(xGetElementById('cont_problem'));
    }else{
        lstSectorComunidad = document.getElementById('ilstsectorcomunR');
    }
    limpiarListaToda(lstSectorComunidad);
    if(lstComunidad.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codComunidad",lstComunidad.value);
        ajax.setVar("op",'bSectorComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaSector(lstSectorComunidad,ajax.response);
                lstSectorComunidad.disabled=false;
            }else{
                if(confirm("No existen Sectores para esta Comunidad, ¿Desea ingresar un Sector para esta Comunidad?")){
                    ventaEmergenteSector();
                }else{
                    lstComunidad.value=-1;
                    limpiarListaToda(lstSectorComunidad);
                    campResponsable.value = '';
                    lstSectorComunidad.disabled=true;
                }
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstSectorComunidad);
        campResponsable.value = '';
        lstSectorComunidad.disabled=true;
    }
}
function crearListaSector(objLista,cont){
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
function ventaEmergenteSector(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    campComunidad = document.getElementById('ilstcomunidad');
    if(lstEstado.value != -1){
        if(lstMunicipio.value != -1){
            if(lstParroquia.value != -1){
                if (campComunidad.value != -1){
                    displayMessage('sector.php?destino=1&comuni='+campComunidad.value+'&estado='+lstEstado.value+'&municipio='+lstMunicipio.value+'&parroquia='+lstParroquia.value,'',765,600);
                }else{
                    alert('Debe seleccionar una Comunidad, verifique');
                    campComunidad.focus();
                }
            }else{
                alert('Debe seleccionar una Parroquia, verifique');
                lstParroquia.focus();
            }
        }else{
            alert('Debe seleccionar un Municipio, verifique');
            lstMunicipio.focus();
        }
    }else{
        alert('Debe seleccionar un Estado, verifique');
        lstEstado.focus();
    }
}
function abrirResponsable(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    estado = lstEstado.options[lstEstado.selectedIndex ].text;
    municipio = lstMunicipio.options[lstMunicipio.selectedIndex].text;
    parroquia = lstParroquia.options[lstParroquia.selectedIndex].text;
    comunidad = lstComunidad.options[lstComunidad.selectedIndex].text;
    sector = lstSector.options[lstSector.selectedIndex].text;
    if (lstComunidad.value != -1){
        if (lstSector.value != -1){
            displayMessage('responsable.php?destino=1&est='+estado+'&par='+parroquia+'&mun='+municipio+'&comuni='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'mostrarTodoIntCom("'+lstSector.value+'","")',765,620);
        }else{
            alert('Debe seleccionar un Sector, verifique');
            lstSector.focus();
        }
    }else{
        alert('Debe seleccionar una Comunidad, verifique');
        lstComunidad.focus();
    }
}
function abrirGrupo(form){
    lstPeriodo = document.getElementById('ilstperiodo');
    lstTrayecto = document.getElementById('ilsttrayecto');
    lstTrimestre = document.getElementById('ilsttrimestre');
    lstPnf = document.getElementById('ilstPnf');
    pnfString = document.getElementById('ilstPnf').options[document.getElementById('ilstPnf').selectedIndex].text;
    
//    if(lstPeriodo.value != -1){
//       if(lstTrayecto.value != -1){
//           if(lstTrimestre.value != -1){
                if(lstPnf.value != -1){
                    displayMessage('grupo.php?destino=1&f='+form+'&pnf='+pnfString,'mostrarTodoEstGrupo("'+form+'")',750,520);
                }else{
                    alert('Debe seleccionar un PNF, verifique');
                    lstPnf.focus();
                }
//            }else{
//                alert('Debe seleccionar un Trimestre, verifique');
//                lstTrimestre.focus();
//            }
//        }else{
//            alert('Debe seleccionar un Trayecto, verifique');
//            lstTrayecto.focus();
//        } 
//    }else{
//        alert('Debe seleccionar un periodo academico, verifique');
//        lstPeriodo.focus();
//    }
}
function abrirProblemas(form){
     lstEstado = document.getElementById('ilstestado');
     lstMunicipio = document.getElementById('ilstmunicipio');
     lstParroquia = document.getElementById('ilstparroquia');
     lstComunidad = document.getElementById('ilstcomunidad');
     lstSector = document.getElementById('ilstsectorcomun');
     if(lstEstado.value != -1){
        if(lstMunicipio.value != -1){
            if(lstParroquia.value != -1){
                if(lstComunidad.value != -1){
                    if(lstSector.value != -1){
                        displayMessage('problema.php?destino=1&comuni='+lstComunidad.value+'&estado='+lstEstado.value+'&municipio='+lstMunicipio.value+'&parroquia='+lstParroquia.value+'&sector='+lstSector.value,'mostrarTodoPro(1)',770,680);
                    }else{
                        alert('Debe seleccionar un Sector, verifique');
                        lstSector.focus();
                    }
                }else{
                    alert('Debe seleccionar una Comunidad, verifique');
                    lstComunidad.focus();
                }
            }else{
                alert('Debe seleccionar una Parroquia, verifique');
                lstParroquia.focus();
            }
        }else{
            alert('Debe seleccionar un Municipio, verifique');
            lstMunicipio.focus();
        }
     }else{
         alert('Debe seleccionar un Estado, verifique');
         lstEstado.focus();
     }
 }
function validarDiagnostico(op){
    /*op=1 GUARDAR
     *op=2 MODIFICAR
     **/
    
    campCod = document.getElementById('itxtcoddia');
    lstPer = document.getElementById('ilstperiodo');
    lstTra = document.getElementById('ilsttrayecto');
    lstTri = document.getElementById('ilsttrimestre');
    
    lstSec = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
    camCon = document.getElementById('txtNomConsejoComun');
    camTit = document.getElementById('itxttitulodiagnostico');
    lstPnf = document.getElementById('ilstPnf');
    camSeccion = document.getElementById('itxtseccion');
    camGrupo = document.getElementById('itxtgrupo');
    optPro = document.getElementsByName('grupo1');
    camFec = document.getElementById('itxtfecha');
    lstDoc = document.getElementById('ilstdocente');
    lstTut = document.getElementById('ilsttutor');
    camObs = document.getElementById('txtobservacion');
    chkImp = document.getElementById('imprimir');
    w=false;
    for(i=0;i<optPro.length;i++){
        if(optPro[i].checked){
            w=true;
            selPro=optPro[i].id;
        }
    }
    if(lstPer.value != -1){
        if(lstTra.value != -1){
            if(lstTri.value != -1){
                if(camSeccion.value != ''){
                    if(lstSec.value != -1){
                        if(campResponsable.value != ''){
                            if(camCon.value != ''){
                                if(camTit.value!=''){
                                    if(camGrupo.value != ''){
//                                        if(camPro.value != ''){
                                            if(w){
                                                if(camFec.value!=''){
                                                    if(lstDoc.value!=-1){
                                                        if(lstTut.value!=-1){
                                                            if(op==1){
                                                                dest='gdiagnostico';
                                                            }else{
                                                                dest='mdiagnostico';
                                                            }
                                                            ajax = new sack('../Modelo.php');
                                                            ajax.setVar("op",dest);
                                                            ajax.setVar("per",lstPer.value);
                                                            ajax.setVar("tra",lstTra.value);
                                                            ajax.setVar("tri",lstTri.value);
                                                            ajax.setVar("sec",lstSec.value);
                                                            ajax.setVar("res",campResponsable.name);
                                                            ajax.setVar("con",camCon.value);
                                                            ajax.setVar("tit",camTit.value);
                                                            ajax.setVar("pnf",lstPnf.value);
                                                            ajax.setVar("seccion",camSeccion.value);
                                                            ajax.setVar("idGrupo",camSeccion.name);
                                                            ajax.setVar("gru",camGrupo.value);
                                                            ajax.setVar("codigo",campCod.value);
                                                            ajax.setVar("prosel",selPro);
                                                            ajax.setVar("proold",problema);
                                                            ajax.setVar("fec",camFec.value);
                                                            ajax.setVar("doc",lstDoc.value);
                                                            ajax.setVar("tut",lstTut.value);
                                                            ajax.setVar("obs",camObs.value);
                                                            ajax.method="POST";
                                                            ajax.onCompletion=function(){
                                                                if(ajax.response != 0){
                                                                    datos = eval("("+ajax.response+")");
                                                                    if(chkImp.checked){
                                                                        if(op==1){//GUARDAR
                                                                            grupo = datos[1];
                                                                            diagn = datos[0];
                                                                        }else{
                                                                            grupo = camSeccion.name;
                                                                            diagn = campCod.value;
                                                                        }
                                                                        window.open("plani_diagnostico.php?per="+lstPer.value+"&tra="+lstTra.value+"&tri="+lstTri.value+
                                                                        "&sec="+lstSec.value+"&res="+campResponsable.name+"&con="+camCon.value+"&tit="+camTit.value+
                                                                        "&pnf="+lstPnf.value+"&seccion="+camSeccion.value+"&gru="+grupo+"&prosel="+selPro+
                                                                        "&fec="+camFec.value+"&doc="+lstDoc.value+"&tut="+lstTut.value+"&obs="+camObs.value+"&cod="+diagn,
                                                                        "reportediagnostico","_blank");
                                                                    }
                                                                    limpiarDiagnostico();//OJO
//                                                                    mostrarTodo();
                                                                }else{
                                                                    alert('No se pudo ingresar el registro');
                                                                }
                                                            }
                                                            ajax.onError=function(){alert('Ha ocurrido un error');}
                                                            ajax.runAJAX();
                                                        }else{
                                                            alert('Debe seleccionar el tutor');
                                                        }
                                                    }else{
                                                        alert('Debe seleccionar el docente');
                                                    }
                                                }else{
                                                    alert('Debe ingresar la fecha actual');
                                                }
                                            }else{
                                                alert('Debe seleccionar un problema');
                                            } 
//                                        }else{
//                                            alert('Debe ingresar por lo menos un problema');
//                                        }
                                    }else{
                                        alert('Debe seleccionar o ingresar el grupo');
                                    }
                                }else{
                                    alert('Debe ingresar el titulo del diagnostico');
                                }
                            }else{
                                alert('Debe ingresar el nombre del consejo comunal');
                            }
                        }else{
                            alert('Debe seleccionar un responsable del sector');
                        }
                    }else{
                        alert('Debe seleccionar un sector de lacomunidad');
                    }
                }else{
                    alert('Debe ingresar una seccion');
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

function buscarProfesores(obj){
//    lstPnf = document.getElementById('ilstPnf');
//    lstDocente = document.getElementById('ilstdocente');
//    lstTutor = document.getElementById('ilsttutor');
//    lstTutor.disabled = true;
//    lstDocente.disabled = true;
    campCodigo = document.getElementById('itxtcoddia');
//    limpiarListaToda(ilstdocente);
//    limpiarListaToda(ilsttutor);
//    if(lstPnf.value != -1){
    alert(obj.value);
//        ajax = new sack('../Modelo.php');
////        ajax.setVar("pnf",lstPnf.value);
//        ajax.setVar("op",'buscarProfesores');
//        ajax.method="POST";
//        ajax.onCompletion=function(){
//            if(ajax.response != 0){
//                crearListaProfesores(ajax.response);
//            }else{
//                lstPnf.value = -1;
//                campCodigo.value = "";
//                mD.limpiaTexto(xGetElementById('cont_diag'));
//                alert('No existen Docentes para este PNF, verifique');
//            }
//        }
//        ajax.onError=function(){alert('Ha ocurrido un error');}
//        ajax.runAJAX();
//    }
}

//function crearListaProfesores(req)
//{
//    lstDocente = document.getElementById('ilstdocente');
//    lstTutor = document.getElementById('ilsttutor');
//    lstTutor.disabled = false;
//    lstDocente.disabled = false;
//    datos = eval("("+req+")");
//    limpiarListaToda(lstDocente);
//    limpiarListaToda(lstTutor);
//    for(i=0;i<datos.length;i++){
//        listas('ilstdocente',datos[i]['iddocente'],html_entity_decode(datos[i]['nomdocente']+' '+datos[i]['apedocente'],'ENT_QUOTES'), false);
//        listas('ilsttutor',datos[i]['iddocente'],html_entity_decode(datos[i]['nomdocente']+' '+datos[i]['apedocente'],'ENT_QUOTES'), false);
//    }
//}

function limpiarDiagnostico()
{
    lstPer = document.getElementById('ilstperiodo');
    lstTra = document.getElementById('ilsttrayecto');
    lstTri = document.getElementById('ilsttrimestre');
    lstEst = document.getElementById('ilstestado');
    lstMun = document.getElementById('ilstmunicipio');
    lstPar = document.getElementById('ilstparroquia');
    lstCom = document.getElementById('ilstcomunidad');
    lstSec = document.getElementById('ilstsectorcomun');
    campResponsable = document.getElementById('itxtresponsable');
    lstPnf = document.getElementById('ilstPnf');
    lstDoc = document.getElementById('ilstdocente');
    lstTut = document.getElementById('ilsttutor');
    btnGuardar = document.getElementById('btningresar');
    btnLimpiarGru = document.getElementById('limpiartablagrupodiag');
    btnIngresarGru = document.getElementById('seleccionargrupo');
    btnModificar = document.getElementById('btnmodificar');
    campInformacion = document.getElementById('inform');
    capa1 = document.getElementById('cuenta');
    capa2 = document.getElementById('cuenta1');
    capa2.innerHTML = capa1.innerHTML = 255;
    campInformacion.style.display='none';
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
    btnLimpiarGru.style.display='block';
    btnIngresarGru.style.display='block';
    mD.limpiaTexto(xGetElementById('cont_diag'));
    lstPer.value = -1;
    lstTra.value = -1;
    lstTri.value = -1;
    lstPnf.value = -1;
    lstPar.valu = -1;
    lstCom.disabled = true;
    limpiarListaToda(lstCom);
    lstSec.disabled = true;
    limpiarListaToda(lstSec);
    campResponsable.value = '';
    lstDoc.disabled = true;
    limpiarListaToda(lstDoc);
    lstTut.disabled = true;
    limpiarListaToda(lstTut);

    objForm = document.getElementById('formDiagnostico');
    nroElement = objForm.length;
    for(i=0; i < nroElement;i++){
        if(objForm.elements[i].type == 'text'){
            if(objForm.elements[i].id != 'itxtfecha'){
                objForm.elements[i].value = '';
            }
        }else if(objForm.elements[i].type == 'select-one'){
            objForm.elements[i].value=-1;
        }else if(objForm.elements[i].type == 'textarea'){
            if(objForm.elements[i].id == 'txtobservacion'){
                objForm.elements[i].value = 'Sin observaciones...'
            }else{
                objForm.elements[i].value = '';
            }
        }else if(objForm.elements[i].type == 'checkbox'){
            objForm.elements[i] = 'checked';
        }
    }
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    mD.limpiaTexto(xGetElementById('cont_problem'));
    lstPer.focus();
}

function abrirConsejo(){   
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    if(lstEstado.value != -1){
        if(lstMunicipio.value != -1){
            if(lstParroquia.value != -1){
                if(lstComunidad.value != -1){
                    if(lstSector.value != -1){
                        estado = lstEstado.options[lstEstado.selectedIndex ].text;
                        municipio = lstMunicipio.options[lstMunicipio.selectedIndex ].text;
                        parroquia = lstParroquia.options[lstParroquia.selectedIndex ].text;
                        comunidad = lstComunidad.options[lstComunidad.selectedIndex ].text;
                        sector = lstSector.options[lstSector.selectedIndex ].text;
                        displayMessage('consejo.php?destino=1&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&comunidad='+comunidad+'&sector='+sector+'&idsector='+lstSector.value,'',750,520);
                    }else{
                        alert('Debe seleccionar un sector');
                    } 
                }else{
                    alert('Debe seleccionar una comunidad');
                } 
            }else{
                alert('Debe seleccionar una parroquia');
            } 
        }else{
            alert('Debe seleccionar un municipio');
        }
    }else{
        alert('Debe seleccionar un estado');
    }
}

function buscarDiagLe(obj, e){
    lstPnf = document.getElementById('ilstPnf');
    if(e.keyCode==13 || e.keyCode==9)return;
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDiagLet');
    ajax.setVar("letras",obj.value);
    ajax.setVar("pnf",lstPnf.value);
    ajax.onCompletion = function(){
           crearTablaDiagnostico(ajax.response,'ante');
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

//############### NUEVAS AL 22/01/2013


function buscarAgreEstu(){
    cedEstu = document.getElementById('itxtcedEstGru');
    
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarAgreEstu');
    ajax.setVar("ced",cedEstu.value);
    ajax.onCompletion = function(){
        datos = eval("("+ajax.response+")");
//        alert('datos: '+datos.length);
//           if(ajax.response != 0){
            if(datos){
               if(grupo == ''){
                   grupo = datos['idInterno']+'-'+datos['nationality']+'-'+datos['pin']+'-'+datos['firstnames'].toUpperCase()+'  '+datos['lastnames'].toUpperCase();
               }else{
                   estu = grupo.split('/');
                   band = 0;
                   for(i = 0; i < estu.length ; i++){
                       estDet = estu[i].split('-');
                       if(datos['pin'] == estDet[2]){
                           band = 1;
                       }
                   }
                   if(band == 0){
                       grupo = grupo + '/' + datos['idInterno']+'-'+datos['nationality']+'-'+datos['pin']+'-'+datos['firstnames'].toUpperCase()+'  '+datos['lastnames'].toUpperCase();
                   }else{
                       alert('No puede ingresar al mismo estudiante al mismo grupo');
                   }
                   
               }
               cedEstu.value = '';
               crearTablaGru(grupo);
               cedEstu.focus();
           }else{
               alert("No existe Estudiante con la Cedula ingresada");
           }
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
    
}

function crearTablaGru(req){
    campGrupo = document.getElementById('itxtgrupo');//ALMACENA LOS ESTUDIANTES SELECCIONADOS PARA EL GRUPO ACTUAL
    campGrupo.value = '';
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    datos = req;
    var num=tabla.childNodes.length+1;
    var codrad = 'grup';
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        estu = datos.split('/');
        cant = estu.length;
        for(i=0;i<cant;i++){
                item++;
                var itemS = String(item) ;
                valor = estu[i].split('-');
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
                }, valor[1]+'-'+valor[2]);
                var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '60%'
                }, valor[3]);   
                var celda4 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'center',
                    'title': 'Quitar',
                    'width': '5%'
                }, '');
                var imgE = document.createElement('img');
                imgE.src = "../img/reportar_a.png";
                imgE.border="0";
                imgE.width="16";
                imgE.height="16";
                imgE.setAttribute('title',"Quitar");
                imgE.setAttribute('onclick',"quitarEstuGru('"+valor[2]+"')");
                celda4.appendChild(imgE);
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
        }      
    }
}

function quitarEstuGru(ced){
    estudiante = grupo.split('/');
    grupo = '';
    for (i = 0; i < estudiante.length; i++){
        detalle = estudiante[i].split('-');

        if(ced != detalle[2] ){
            if(grupo == ''){
                grupo = estudiante[i];
            }else{
                grupo = grupo+'/'+estudiante[i];
            }
        }
    }
    crearTablaGru(grupo);
}

function buscarDocente(op){
    
    if(op == 'D'){
        cod = document.getElementById('ilstdocente');
        ced = document.getElementById('ceddocente');
        nom = document.getElementById('nomdocente');
    }else{
        cod = document.getElementById('ilsttutor');
        ced = document.getElementById('cedtutor');
        nom = document.getElementById('nomtutor');
    }
    if(ced.value != ''){
        ajax = new sack('../Modelo.php');
        ajax.setVar("ced",ced.value);
        ajax.setVar("op",'buscarProfesores');
        ajax.method="POST";
        ajax.onCompletion=function(){
//            alert('hola: '+ajax.response);
            if(ajax.response != 0){
                datos = eval("("+ajax.response+")");
                nom.value = datos['fullname'];
                cod.value = datos['idInterno'];
            }else{
                alert('La cedula ingresada no existe, verifique');
                nom.value = '';
                cod.value = '';
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert("Debe ingresar una cedula para buscar");
    }
    
    
}