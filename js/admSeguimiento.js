tipoR = '';
pnfR = '';
fechaiR = '';
fechafR = '';
function validarBusqueda(){
    limpiarDetalle('');
    campSector = document.getElementById('ilstsectorcomun');
    lstPnf = document.getElementById('ilstPnf');
    radDiag = document.getElementById('rdoDiag');
    radAnte = document.getElementById('rdoAnte');
    radProy = document.getElementById('rdoProy');
    campFechaI = document.getElementById('idtxtfecini');
    campFechaF = document.getElementById('idtxtfecfin');
    btnFechaI = document.getElementById('btncalendai');
    btnFechaF = document.getElementById('btncalendaf');
    capaResult = document.getElementById('tab_resultados');
    if(radDiag.checked){
        tipo = radDiag.value;
    }else if(radAnte.checked){
        tipo = radAnte.value;
    }else{
        tipo = radProy.value;
    }
    if(lstPnf.value != -1){
        if(campFechaI.value != ''){
            if(campFechaF.value != ''){
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'buscarRepor');
                ajax.setVar("tipo",tipo);
                ajax.setVar("pnf",lstPnf.value);
                ajax.setVar("fechai",campFechaI.value);
                ajax.setVar("fechaf",campFechaF.value);
                ajax.setVar("sector",campSector.value);
                ajax.method="POST";
                ajax.onCompletion = function(){
//                    alert('contenido: '+ajax.response);
                    if(ajax.response != 0){
                        tipoR = tipo;
                        pnfR = lstPnf.value;
                        fechaiR = campFechaI.value;
                        fechafR = campFechaF.value;
                        cargarTablaResul(ajax.response,tipo);
                    }else{
                        capaResult.style.display = 'none';
                        alert('No existen registros que cumplan con los criterios de busqueda');
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error');}
                ajax.runAJAX();
            }else{
                alert('Debe seleccionar una fecha de fin, verifique');
                btnFechaF.focus();
            }
        }else{
            alert('Debe seleccionar una fecha de inicio, verifique');
            btnFechaI.focus();
        }
    }else{
        alert('Debe seleccionar un PNF, verfique');
        lstPnf.focus();
    }
}

function cargarTablaResul(req,tipo){
    capaTituloTabl = document.getElementById('tituloTabla');
    capaResult = document.getElementById('tab_resultados');
    capaTituloTabl.innerHTML = tipo.toUpperCase()+' ENCONTRADOS';
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_result');
    mD.limpiaTexto(xGetElementById('cont_result'));
    
    datos = eval("("+req+")");
//    alert(datos);
    var num = tabla.childNodes.length+1;
    var codrad = 'int' + num;
    if (datos == null){
        capaResult.style.display = 'none';
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        capaResult.style.display = 'block';
        for(i=0;i<datos.length;i++){
            if(tipo == 'diagnostico'){
                titulo = html_entity_decode(datos[i]['descripdiagnostico'],'ENT_QUOTES').toUpperCase();
                codigo = datos[i]['iddiagnostico'];
            }else if(tipo == 'anteproyecto'){
                titulo = html_entity_decode(datos[i]['nomantep'],'ENT_QUOTES').toUpperCase();
                codigo = datos[i]['idantep'];
            }else{
                titulo = html_entity_decode(datos[i]['nomproyecto'],'ENT_QUOTES').toUpperCase();
                codigo = datos[i]['idproyecto'];
            }
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Click para ver sus datos',
                        'id': codrad+i
                });
            var celda1 = mD.insertarCelda(fila, -1, {
                    'id': 'celda1',			
                    'align': 'center',
                    'width': '5%'
            }, itemS);
            var celda2 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda2',
                    'align': 'left',
                    'width': '95%'
            }, titulo.toUpperCase());
            fila.setAttribute('onclick',"mostrarSel("+codigo+",'"+tipo+"','seguimiento')");
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }
}

function imprimirLista(){
    if(pnfR != ''){
        lstPnf = document.getElementById('ilstPnf');
        pnf = lstPnf.options[lstPnf.selectedIndex].text;
        campSector = document.getElementById('ilstsectorcomun');
        if(tipoR != ''){
            if(fechaiR != ''){
                if(fechafR != ''){
                    window.open("plani_lisresult.php?pnf="+pnfR+"&tipo="+tipoR+"&fechai="+fechaiR+"&fechaf="+fechafR+"&pnfDes="+pnf+"&sector="+campSector.value,"reportelistabusqueda","_blank");
                }else{
                    alert('Debe ingresar una fecha final');
                }
            }else{
                alert('Debe ingresar una fecha de inicio');
            }
        }else{
            alert('Debe seleccionar un tipo a buscar');
        }
    }else{
        alert('Debe seleccionar un PNF');
    }
}

function mostrarSel(codigo,tipo,op){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDetalleList');
    ajax.setVar("tipo",tipo);
    ajax.setVar("codigo",codigo);
    ajax.setVar("opcion",op);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            cargarDetalle(ajax.response,codigo,tipo,op);
        }else{
            alert('No se encontraron los detalles del registro seleccionado');
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarDetalle(req,codigo,tipo,op){
    tra = new Array('I', 'II', 'III','IV');
    tri = new Array('I','II','III');
    campStatus = document.getElementById('txtstatus');
    campCapaDetalle = document.getElementById('detalle_list');
    campTituloDetalle = document.getElementById('tituloDetalle');
    campTipoDetalle = document.getElementById('tipodetalle');
    campPeriodo = document.getElementById('txtperiodo');
    campTrayecto = document.getElementById('txttrayecto');
    campTrimestre = document.getElementById('txttrimestre');
    campPnf = document.getElementById('txtpnf');
    campEstado = document.getElementById('txtestado');
    campMunicipio = document.getElementById('txtmunicipio');
    campParroquia= document.getElementById('txtparroquia');
    campComunidad = document.getElementById('txtcomunidad');
    campSector = document.getElementById('txtsector');
    campRespon = document.getElementById('txtresponsable');
    campConsejo = document.getElementById('txtconsejo');
    campTitulo= document.getElementById('txttitulo');
    campSeccion = document.getElementById('txtseccion');
    campGrupo1 = document.getElementById('txtgrup1');
    campGrupo2 = document.getElementById('txtgrup2');
    campGrupo3 = document.getElementById('txtgrup3');
    campGrupo4 = document.getElementById('txtgrup4');
    campGrupo5 = document.getElementById('txtgrup5');
    campGrupo6 = document.getElementById('txtgrup6');
    campProblema = document.getElementById('txtproblema');
    campFecha = document.getElementById('txtfecha');
    campDocente = document.getElementById('txtdocente');
    campTutor = document.getElementById('txttutor');
    campCodigo = document.getElementById('txtcodigo');
    campSerial = document.getElementById('txtserial');
    campTipo = document.getElementById('txttipo');
    
    campCodigo.value = codigo;
    
    datos = eval("("+req+")");
    generalS = datos[0];
    personal = datos[1];
    docente = datos[2];
    tutor = datos[3];
    sector = datos[4];
    grupo = datos[5];
    periodoS = datos[6];
    pnfS = datos[7];
    comunidad = datos[8];
    parroquia = datos[9];
    municipio = datos [10];
    estado = datos[11];
    seccion = datos[12];
    problema = datos[15];
    campTipo.value = tipo;
    campSerial.value = generalS['codigo'];
    if(generalS['estado'] == 'INICIADO'){
        color = '#0000FF';
    }else if(generalS['estado'] == 'PROCESADO'){
        color = '#00FF00';
    }else{
        color = '#FF0000';
    }
    campProblema.innerHTML = html_entity_decode(problema['descripcionproblema'],'ENT_QUOTES').toUpperCase();
    campStatus.style.fontFamily = "Arial";
    campStatus.style.fontWeight = "bold";
    campStatus.style.fontSize = "17";
    campStatus.style.color = color;
    campStatus.innerHTML = generalS['estado'];
    campPnf.innerHTML = html_entity_decode(pnfS['descripcionpnf'],'ENT_QUOTES').toUpperCase();
    campEstado.innerHTML = html_entity_decode(estado['descripestado'],'ENT_QUOTES').toUpperCase();
    campMunicipio.innerHTML = html_entity_decode(municipio['descripmunicipio'],'ENT_QUOTES').toUpperCase();
    campParroquia.innerHTML = html_entity_decode(parroquia['descripparroquia'],'ENT_QUOTES').toUpperCase();
    campComunidad.innerHTML = html_entity_decode(comunidad['nomcomuni'],'ENT_QUOTES').toUpperCase();
    campSector.innerHTML = html_entity_decode(sector['descripsector'],'ENT_QUOTES').toUpperCase();
    campRespon.innerHTML = personal['nompersona'].toUpperCase()+'  '+personal['apepersona'].toUpperCase();
    campConsejo.innerHTML = html_entity_decode(generalS['nomconsejocomunal'],'ENT_QUOTES').toUpperCase();
    campTitulo.innerHTML = html_entity_decode(generalS['titulo'],'ENT_QUOTES').toUpperCase();
    campSeccion.innerHTML = seccion['seccion'];
    fecha = generalS['fecha'].split("-");
    campFecha.innerHTML = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
    campDocente.innerHTML = docente['nomdocente'].toUpperCase()+'  '+docente['apedocente'].toUpperCase();
    campTutor.innerHTML = tutor['nomdocente'].toUpperCase()+'  '+tutor['apedocente'].toUpperCase();
    campPeriodo.innerHTML = periodoS['codperiodo'];
    campTrayecto.innerHTML = tra[generalS['trayecto']-1];
    campTrimestre.innerHTML = tri[generalS['trimestre']-1];
    if(tipo == 'diagnostico'){
        tipo = 'DIAGNÓSTICO';
    }
    campTipoDetalle.innerHTML = 'TÍTULO '+tipo.toUpperCase()+':';
    campTituloDetalle.innerHTML = 'DETALLE DEL '+tipo.toUpperCase()+' SELECCIONADO';
    
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));

    var num = tabla.childNodes.length+1;
    var codrad = 'int' + num;
    if (grupo == 0){
        capaResult.style.display = 'none';
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<grupo.length;i++){
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Estudiantes',
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
                    'width': '20%'
            }, grupo[i]['cedestudiante'].substr(0, 1)+'-'+grupo[i]['cedestudiante'].substr(1));
            var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda3',
                    'align': 'left',
                    'width': '75%'
            }, grupo[i]['nomestudiante'].toUpperCase()+'  '+grupo[i]['apeestudiante'].toUpperCase());
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }
    if(op == 'reporte'){
        campDescrip = document.getElementById('txtdescripreporte');
        campNomRespon = document.getElementById('txtnomrespon');
        campTelfRespon = document.getElementById('txttelfrespon');
        campEmailRespon = document.getElementById('txtemailrespon');
        denuncia = datos[13];
        responsable = datos[14];
        campDescrip.innerHTML = html_entity_decode(denuncia['descripdenuncia'],'ENT_QUOTES').toUpperCase();
        campNomRespon.innerHTML = responsable['cedula'].substr(0, 1)+'-'+responsable['cedula'].substr(1)+'  '+html_entity_decode(responsable['nombre'].toUpperCase()+' '+responsable['apellido'].toUpperCase(),'ENT_QUOTES');
        campTelfRespon.innerHTML = responsable['telefono'];
        campEmailRespon.innerHTML = responsable['email'].toUpperCase();
    }
    if(op == 'detalle'){
        campObservacion = document.getElementById('txtobservacion');
        campObservacion.innerHTML = html_entity_decode(generalS['observacion'],'ENT_QUOTES').toUpperCase();
    }
    campCapaDetalle.style.display = 'block';
}

function limpiarDetalle(op){
    campCapaDetalle = document.getElementById('detalle_list');
    campTituloDetalle = document.getElementById('tituloDetalle');
    campTipoDetalle = document.getElementById('tipodetalle');
    campPeriodo = document.getElementById('txtperiodo');
    campTrayecto = document.getElementById('txttrayecto');
    campTrimestre = document.getElementById('txttrimestre');
    campPnf = document.getElementById('txtpnf');
    campEstado = document.getElementById('txtestado');
    campMunicipio = document.getElementById('txtmunicipio');
    campParroquia= document.getElementById('txtparroquia');
    campComunidad = document.getElementById('txtcomunidad');
    campSector = document.getElementById('txtsector');
    campRespon = document.getElementById('txtresponsable');
    campConsejo = document.getElementById('txtconsejo');
    campTitulo= document.getElementById('txttitulo');
    campSeccion = document.getElementById('txtseccion');
    campGrupo1 = document.getElementById('txtgrup1');
    campGrupo2 = document.getElementById('txtgrup2');
    campGrupo3 = document.getElementById('txtgrup3');
    campGrupo4 = document.getElementById('txtgrup4');
    campGrupo5 = document.getElementById('txtgrup5');
    campGrupo6 = document.getElementById('txtgrup6');
    campProblema = document.getElementById('txtproblema');
    campFecha = document.getElementById('txtfecha');
    campDocente = document.getElementById('txtdocente');
    campTutor = document.getElementById('txttutor');
    capaResult = document.getElementById('tab_resultados');
    
    
    campPnf.innerHTML = '';
    campEstado.innerHTML = '';
    campMunicipio.innerHTML = '';
    campParroquia.innerHTML = '';
    campComunidad.innerHTML = '';
    campSector.innerHTML = '';
    campRespon.innerHTML = '';
    campConsejo.innerHTML = '';
    campTitulo.innerHTML = '';
    campSeccion.innerHTML = '';
    campFecha.innerHTML = '';
    campDocente.innerHTML = '';
    campTutor.innerHTML = '';
    campPeriodo.innerHTML = '';
    campTrayecto.innerHTML = '';
    campTrimestre.innerHTML = '';
    campTipoDetalle.innerHTML = '';
    campTituloDetalle.innerHTML = '';
    
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    campCapaDetalle.style.display = 'none';
    if(op != 'reporte'){
        campObservacion = document.getElementById('txtobservacion');
        campObservacion.value = '';
        capaResult.style.display = 'none';
    }
}

function mMunicipiosSeg(op){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    if(op != 'reporte'){
        lstComunidad = document.getElementById('ilstcomunidad');
        lstSector = document.getElementById('ilstsectorcomun');
        campConsejo = document.getElementById('txtNomConsejoComun');
        campNomRespon = document.getElementById('txtnomrespon');
        campTelfRespon = document.getElementById('txttelfrespon');
        campEmailRespon = document.getElementById('txtemailrespon');
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstComunidad.disabled=true;
        lstSector.disabled=true;
        campConsejo.value = '';
        campNomRespon.innerHTML = '';
        campTelfRespon.innerHTML = '';
        campEmailRespon.innerHTML = '';
    }
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
                crearListaMunSeg(lstMunicipio,ajax.response);
                lstMunicipio.disabled=false;
            }else{
                lstEstado.value=-1;
                alert('No existen Municipios para este Estado');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        if(op != 'reporte'){
            limpiarListaToda(lstComunidad);
            limpiarListaToda(lstSector);
            lstComunidad.disabled=true;
            lstSector.disabled=true;
            campConsejo.value = '';
            campNomRespon.innerHTML = '';
            campTelfRespon.innerHTML = '';
            campEmailRespon.innerHTML = '';
        }
        limpiarListaToda(lstMunicipio);
        limpiarListaToda(lstParroquia);
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
    }
}
function crearListaMunSeg(objLista,cont){
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
    }else{
        alert('No existen Municipios para este Estado');
        limpiarListaToda(lstMunicipio);
        lstMunicipio.disabled=true;
    }
}
function mParroquiasSeg(op){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    if(op != 'reporte'){
        lstComunidad = document.getElementById('ilstcomunidad');
        lstSector = document.getElementById('ilstsectorcomun');
        campConsejo = document.getElementById('txtNomConsejoComun');
        campNomRespon = document.getElementById('txtnomrespon');
        campTelfRespon = document.getElementById('txttelfrespon');
        campEmailRespon = document.getElementById('txtemailrespon');
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        campConsejo.value = '';
        campNomRespon.innerHTML = '';
        campTelfRespon.innerHTML = '';
        campEmailRespon.innerHTML = '';
    }
    limpiarListaToda(lstParroquia);
    lstParroquia.disabled = true;
    
    if(lstMunicipio.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codMunicipio",lstMunicipio.value);
        ajax.setVar("op",'bParroquia');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaParSeg(lstParroquia,ajax.response);
                lstParroquia.disabled=false;
            }else{
                alert('No existen Parroquias para este Municipio');
                limpiarListaToda(lstMunicipio);
                lstMunicipio.disabled = true;
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        if(op != 'reporte'){
            limpiarListaToda(lstComunidad);
            limpiarListaToda(lstSector);
            lstComunidad.disabled = true;
            lstSector.disabled = true;
            campConsejo.value = '';
            campNomRespon.innerHTML = '';
            campTelfRespon.innerHTML = '';
            campEmailRespon.innerHTML = '';
        }
        limpiarListaToda(lstParroquia);
        lstParroquia.disabled = true;
    }
}
function crearListaParSeg(objLista,cont){
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
        lstParroquia.disabled = true;
    }
}
function mComunidadesSeg(){
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomun');
    campConsejo = document.getElementById('txtNomConsejoComun');
    campNomRespon = document.getElementById('txtnomrespon');
    campTelfRespon = document.getElementById('txttelfrespon');
    campEmailRespon = document.getElementById('txtemailrespon');
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstComunidad.disabled = true;
    lstSector.disabled = true;
    campConsejo.value = '';
    campNomRespon.innerHTML = '';
    campTelfRespon.innerHTML = '';
    campEmailRespon.innerHTML = '';
    if(lstParroquia.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codParroquia",lstParroquia.value);
        ajax.setVar("op",'bComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaComSeg(lstComunidad,ajax.response);
                lstComunidad.disabled=false;
            }else{
                limpiarListaToda(lstComunidad);
                lstComunidad.disabled = true;
                lstParroquia.value = -1;
                alert('No existen Comunidades para esta Parroquia');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstComunidad);
        limpiarListaToda(lstSector);
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        campConsejo.value = '';
        campNomRespon.innerHTML = '';
        campTelfRespon.innerHTML = '';
        campEmailRespon.innerHTML = '';
    }
}
function crearListaComSeg(objLista,cont){
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
        lstComunidad.disabled = true;
    }
}

function buscarSectoresSeg(){
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSectorComunidad = document.getElementById('ilstsectorcomun');
    campConsejo = document.getElementById('txtNomConsejoComun');
    campNomRespon = document.getElementById('txtnomrespon');
    campTelfRespon = document.getElementById('txttelfrespon');
    campEmailRespon = document.getElementById('txtemailrespon');
    limpiarListaToda(lstSectorComunidad);
    lstSectorComunidad.disabled = true;
    campConsejo.value = '';
    campNomRespon.innerHTML = '';
    campTelfRespon.innerHTML = '';
    campEmailRespon.innerHTML = '';
    if(lstComunidad.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codComunidad",lstComunidad.value);
        ajax.setVar("op",'bSectorComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaSectorSeg(lstSectorComunidad,ajax.response);
                lstSectorComunidad.disabled=false;
            }else{
                lstComunidad.value = -1;
                limpiarListaToda(lstSectorComunidad);
                lstSectorComunidad.disabled = true;
                alert('No existen Sectores para esta Comunidad');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstSectorComunidad);
        lstSectorComunidad.disabled=true;
        lstComunidad.disabled = true;
        lstSector.disabled = true;
        campConsejo.value = '';
        campNomRespon.innerHTML = '';
        campTelfRespon.innerHTML = '';
        campEmailRespon.innerHTML = '';
    }
}
function crearListaSectorSeg(objLista,cont){
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

function buscarDatosRespon(){
    campConsejo = document.getElementById('txtNomConsejoComun');
    campNomRespon = document.getElementById('txtnomrespon');
    campTelfRespon = document.getElementById('txttelfrespon');
    campEmailRespon = document.getElementById('txtemailrespon');
    lstSectorComunidad = document.getElementById('ilstsectorcomun');
    campConsejo.value = '';
    campNomRespon.innerHTML = '';
    campTelfRespon.innerHTML = '';
    campEmailRespon.innerHTML = '';
    if(lstComunidad.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codSector",lstSectorComunidad.value);
        ajax.setVar("op",'bResponsableSector');
        ajax.method="POST";
        ajax.onCompletion=function(){
            datos = eval("("+ajax.response+")");
            responsable = datos[0];
            consejo = datos[1];
            if(responsable != 0){
                campNomRespon.innerHTML = responsable['cedpersona'].substr(0, 1)+'-'+responsable['cedpersona'].substr(1)+'  '+html_entity_decode(responsable['nompersona']+' '+responsable['apepersona'],'ENT_QUOTES');
                campTelfRespon.innerHTML = responsable['telefpersona'];
                campEmailRespon.innerHTML = responsable['emailpersona'];
            }else{
                campNomRespon.innerHTML = '';
                campTelfRespon.innerHTML = '';
                campEmailRespon.innerHTML = '';
                alert('No existe un Responsable asignado al Sector');
            }
            if(consejo != 0){
                campConsejo.value = consejo['nomconsejo'];
            }else{
                campConsejo.value = '';
                alert('No existe un Consejo Comunal asignado al Sector');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        campConsejo.value = '';
        campNomRespon.innerHTML = '';
        campTelfRespon.innerHTML = '';
        campEmailRespon.innerHTML = '';
    }
}

function reportarInv(){
    campCodigo = document.getElementById('txtcodigo');
    campSerial = document.getElementById('txtserial');
    campTipo = document.getElementById('txttipo');
    campObservacion = document.getElementById('txtobservacion');
    chkImp = document.getElementById('imprimir');
    mensaje = html_entity_decode("&iquest;Seguro quiere REPORTAR esta investigaci&oacute;n?", 'ENT_QUOTES');
    if(confirm(mensaje)){
        if(campObservacion.value != ''){
            if(campCodigo.value != ''){
                if(campSerial.value != ''){
                    if(campTipo.value != ''){
                        ajax = new sack('../Modelo.php');
                        ajax.setVar("op",'guardarReportar');
                        ajax.setVar("codigo",campCodigo.value);
                        ajax.setVar("codtipo",campSerial.value);
                        ajax.setVar("tipo",campTipo.value);
                        ajax.setVar("descripcion",campObservacion.value);
                        ajax.method="POST";
                        ajax.onCompletion=function(){
                            if(ajax.response == 1){
                                if(chkImp.checked){
                                    window.open("plani_reporte.php?codigo="+campCodigo.value+"&motivo="+campObservacion.value+"&tipo="+campTipo.value,"reportereporte","_blank");
                                }
                                limpiarDetalle('');
                                alert('El reporte fue realizado exitosamente');
                            }else{
                                alert('No se pudo realizar el reporte');
                            }
                        }
                        ajax.onError=function(){alert('Ha ocurrido un error');}
                        ajax.runAJAX();
                    }else{
                        alert('No se encontro el tipo');
                    }
                }else{
                    alert('No se encontro el serial');
                }
            }else{
                mensaje = html_entity_decode('No se encontro el c&oacutedigo', 'ENT_QUOTES');
                alert(mensaje);
            } 
        }else{
            mensaje = html_entity_decode('Debe ingresar una observaci&oacute;n', 'ENT_QUOTES');
            alert(mensaje);
            campObservacion.focus();
        }
    }
}

function buscarTemas(){
    limpiarDetalle('reporte');
    lstPnf = document.getElementById('ilstPnf');
    if(lstPnf.value != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarTemas');
        ajax.setVar("pnf",lstPnf.value);
        ajax.method="POST";
        ajax.onCompletion=function(){
            datos = eval("("+ajax.response+")");    
            diag = datos[1];
            ante = datos[2];
            proy = datos[3];
            if(diag[0] == -1 && ante[0] == -1 && proy[0] == -1){
                cargarTemas('');
            }else{
                var temas = new Array();
                j = 0;
                if(diag[0] != -1){
                    for(i = 0;i < diag.length;i++){
                        temas[j++] = diag[i];
                    }
                }
                temas[j++] = '@';
                if(ante[0] != -1){
                    for(i = 0;i < ante.length;i++){
                        temas[j++] = ante[i];
                    }
                }
                temas[j++] = '@';
                if(proy[0] != -1){
                    for(i = 0;i < proy.length;i++){
                        temas[j++] = proy[i];
                    }
                }
                cargarTemas(temas);
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        capaTituloTabl = document.getElementById('tituloTabla');
        capaTituloTabl.innerHTML = html_entity_decode('TEMAS DE INVESTIGACI&Oacute;N ENCONTRADOS', 'ENT_QUOTES');
        mD.limpiaTexto(xGetElementById('cont_resultTemas'));
    }   
}

function cargarTemas(temas){
    capaTituloTabl = document.getElementById('tituloTabla');
    capaResult = document.getElementById('tab_resultados');
    lstPnf = document.getElementById('ilstPnf');
    capaTituloTabl.innerHTML = 'TEMAS DE INVESTIGACION ENCONTRADOS EN '+lstPnf.options[lstPnf.selectedIndex ].text;
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_resultTemas');
    mD.limpiaTexto(xGetElementById('cont_resultTemas'));
    var num = tabla.childNodes.length+1;
    var codrad = 'tem' + num;
    if (temas == ''){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 2}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        w = 0;
        for(i=0;i<temas.length;i++){
            
            if(temas[i] == '@'){
                w++;
            }else{
                item++;
                if(w == 0){
                    tipo = 'diagnostico';
                }else if(w == 1){
                    tipo = 'anteproyecto';
                }else{
                    tipo = 'proyecto';
                }
                var itemS = String(item) ;
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Click para ver sus datos',
                            'id': codrad+i
                    });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'left',
                        'width': '95%'
                }, html_entity_decode(temas[i]['titulo'],'ENT_QUOTES').toUpperCase());
                fila.setAttribute('onclick',"mostrarSel("+temas[i]['codigo']+",'"+tipo+"','reporte')");
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
            }
            
        }
    }
}

function liberraReporte(){
    campCodigo = document.getElementById('txtcodigo');
    campSerial = document.getElementById('txtserial');
    campTipo = document.getElementById('txttipo');
    mensaje = html_entity_decode("&iquest;Seguro quiere quitar el estado de REPORTADO a esta investigaci&oacute;n?", 'ENT_QUOTES');
    if(confirm(mensaje)){
        if(campCodigo.value != ''){
            if(campSerial.value != ''){
                if(campTipo.value != ''){
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'liberarReporte');
                    ajax.setVar("codigo",campCodigo.value);
                    ajax.setVar("codtipo",campSerial.value);
                    ajax.setVar("tipo",campTipo.value);
                    ajax.method="POST";
                    ajax.onCompletion=function(){
                        if(ajax.response == 1){
                            buscarTemas();
                            alert('El REPORTE fue liberado');
                        }else{
                            alert('No se pudo liberar el REPORTE');
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }else{
                    alert('Datos del tipo no encontrados para liberar el reporte');
                } 
            }else{
                alert('Datos del serial no encontrados para liberar el reporte');
            }
        }else{
            mensaje = html_entity_decode('Datos del c&oacute;digo no encontrados para liberar el reporte', 'ENT_QUOTES');
            alert(mensaje);
        }
    }
}