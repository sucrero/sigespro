pnfG = '';
codG = '';
function buscarDatos(){
    lstPnf = document.getElementById('lstPnf');
    if(lstPnf.value != -1){
        pnfG = lstPnf.value;
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'datosReporteEva');
        ajax.setVar("pnf",lstPnf.value);
        ajax.method="POST";
        ajax.onCompletion = function(){
            cargarTitulos(ajax.response);
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        mD.limpiaTexto(xGetElementById('cont_result'));
        campCapaDetalle = document.getElementById('detalle_list');
        campCapaDetalle.style.display = 'none';
        capaResult = document.getElementById('tab_resultados');
        capaResult.style.display = 'none';
        alert('Debe seleccionar un PNF');
    }
}
function cargarTitulos(req){
    capaResult = document.getElementById('tab_resultados');
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_result');
    mD.limpiaTexto(xGetElementById('cont_result'));
    datos = eval("("+req+")");
    var num = tabla.childNodes.length+1;
    var codrad = 'int' + num;
    if (datos == -1){
        capaResult.style.display = 'none';
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 2}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        capaResult.style.display = 'block';
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Click para ver el detalle',
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
            }, datos[i]['codigo']+'-'+html_entity_decode(datos[i]['titulo'],'ENT_QUOTES').toUpperCase());
            fila.setAttribute('onclick',"mostrarSelEva("+datos[i]['codigo']+")");
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }
}
function mostrarSelEva(codigo){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDetalleListEva');
    ajax.setVar("codigo",codigo);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            codG = codigo;
            cargarDetalleEva(ajax.response,codigo);
        }else{
            alert('No se encontraron los detalles del registro seleccionado');
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}
function cargarDetalleEva(req,codigo){
    romanos= new Array('I', 'II', 'III','IV');
    campStatus = document.getElementById('txtstatus');
    campCapaDetalle = document.getElementById('detalle_list');
//    campTituloDetalle = document.getElementById('tituloDetalle');
//    campTipoDetalle = document.getElementById('tipodetalle');
    campPnf = document.getElementById('txtpnf');
    campPeriodo = document.getElementById('txtperiodo');
    campTrayecto = document.getElementById('txttrayecto');
    campTrimestre = document.getElementById('txttrimestre');
    
    campEstado = document.getElementById('txtestado');
    campMunicipio = document.getElementById('txtmunicipio');
    campParroquia= document.getElementById('txtparroquia');
    
    campComunidad = document.getElementById('txtcomunidad');
    campSector = document.getElementById('txtsector');
    
    campConsejo = document.getElementById('txtconsejo');
    campRespon = document.getElementById('txtresponsable');
    
    campDocente = document.getElementById('txtdocente');
    campTutor = document.getElementById('txttutor');
    campFecha = document.getElementById('txtfecha');
    
    campSeccion = document.getElementById('txtseccion');
    campTitulo= document.getElementById('txttitulo');
    
//    campProblema = document.getElementById('txtproblema');
    
    
    campCodigo = document.getElementById('txtcodigo');
    campSerial = document.getElementById('txtserial');
//    campTipo = document.getElementById('txttipo');

    campObservacion = document.getElementById('txtobservacion');
    
    
    
    datos = eval("("+req+")");
    evaluacion = datos[0];
    grupo = datos[1];
    codcomision = datos[2];
    comision = datos[3];
    docente = datos[4];
    tutor = datos[5];
    personal = datos[6];
    proyecto = datos[7];
    consejo = datos[8];
    sector = datos[9];
    comunidad = datos [10];
    parroquia = datos[11];
    municipio = datos[12];
    estado = datos[13];
    seccion = datos[14];
    pnf = datos[15];
    periodo = datos[16];
    
    campCodigo.value = codigo;
    campStatus.style.fontFamily = "Arial";
    campStatus.style.fontWeight = "bold";
    campStatus.style.fontSize = "17";
    if(evaluacion['notadescriptiva'].toUpperCase() == 'A'){
        nota = 'APROBADO';
    }else{
        nota = 'REPROBADO';
    }
    campStatus.innerHTML = nota;
    
    campPnf.innerHTML = html_entity_decode(pnf['descripcionpnf'],'ENT_QUOTES').toUpperCase();
    campEstado.innerHTML = html_entity_decode(estado['descripestado'],'ENT_QUOTES').toUpperCase();
    campMunicipio.innerHTML = html_entity_decode(municipio['descripmunicipio'],'ENT_QUOTES').toUpperCase();
    campParroquia.innerHTML = html_entity_decode(parroquia['descripparroquia'],'ENT_QUOTES').toUpperCase();
    campComunidad.innerHTML = html_entity_decode(comunidad['nomcomuni'],'ENT_QUOTES').toUpperCase();
    campSector.innerHTML = html_entity_decode(sector['descripsector'],'ENT_QUOTES').toUpperCase();
    campRespon.innerHTML = personal['nompersona'].toUpperCase()+'  '+personal['apepersona'].toUpperCase();
    campConsejo.innerHTML = html_entity_decode(consejo['nomconsejo'],'ENT_QUOTES').toUpperCase();
    campTitulo.innerHTML = html_entity_decode(proyecto['nomproyecto'],'ENT_QUOTES').toUpperCase();
    campSeccion.innerHTML = seccion['seccion'];
    fecha = proyecto['fechaproy'].split("-");
    campFecha.innerHTML = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
    campDocente.innerHTML = docente['nomdocente'].toUpperCase()+'  '+docente['apedocente'].toUpperCase();
    campTutor.innerHTML = tutor['nomdocente'].toUpperCase()+'  '+tutor['apedocente'].toUpperCase();
    campPeriodo.innerHTML = periodo['codperiodo'];
    campTrayecto.innerHTML = romanos[proyecto['trayectoproy']-1];
    campTrimestre.innerHTML = romanos[proyecto['trimestreproy']-1];
//    if(tipo == 'diagnostico'){
//        tipo = 'DIAGNÓSTICO';
//    }
//    campTipoDetalle.innerHTML = 'TÍTULO '+tipo.toUpperCase()+':';
//    campTituloDetalle.innerHTML = 'DETALLE DEL '+tipo.toUpperCase()+' SELECCIONADO';
    
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
    /////////COMISION
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_comi');
    mD.limpiaTexto(xGetElementById('cont_comi'));

    var num = tabla.childNodes.length+1;
    var codrad = 'intcomi' + num;
    if (comision == 0){
        capaResult.style.display = 'none';
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<comision.length;i++){
//            if(codcomision[i]['identificador'] == 'D'){
//                identificador = 'DOCENTE';
//            }else{
//                identificador = 'INTEGRANTE';
//            }
            item++;
            var itemS = String(item) ;
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Comisi&oacute;n T&eacute;cnica',
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
            }, comision[i]['cedula'].substr(0, 1)+'-'+comision[i]['cedula'].substr(1));
            var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda3',
                    'align': 'left',
                    'width': '80%'
            }, comision[i]['nombre'].toUpperCase()+'  '+comision[i]['apellido'].toUpperCase());
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }

    campObservacion.innerHTML = html_entity_decode(evaluacion['obserevaluacion'],'ENT_QUOTES').toUpperCase();
    
    campCapaDetalle.style.display = 'block';
}
function imprimirListaEva(){
    if(pnfG != ''){
        lstPnf = document.getElementById('lstPnf');
        pnfTexto = lstPnf.options[lstPnf.selectedIndex].text;      
        window.open("plani_liseva.php?codpnf="+pnfG+"&pnfTexto="+pnfTexto,"reportedeevaluaciones","_blank");
    }else{
        alert('Debe seleccionar un PNF');
    }
}

//function buscarSeleccion(codigo,tipo,op){
//    ajax = new sack('../Modelo.php');
//    ajax.setVar("op",'buscarDetalleList');
//    ajax.setVar("tipo",tipo);
//    ajax.setVar("codigo",codigo);
//    ajax.setVar("opcion",op);
//    ajax.method="POST";
//    ajax.onCompletion = function(){
//        if(ajax.response != 0){
//            campCodigo = document.getElementById('txtcodigo');
//            campCodigo.value = codigo;
//            cargarDetalle(ajax.response,codigo,tipo,op);
//        }else{
//            alert('No se encontraron los detalles del registro seleccionado');
//        }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//}

function imprimirDetalle(){
    lstPnf = document.getElementById('lstPnf');
//    alert(codG);
    if(lstPnf.value != -1){
        window.open("plani_detalleEva.php?codigo="+codG,"reportedetalleEva","_blank");
    }else{
        alert('Debe seleccionar una PNF');
    }
    
}