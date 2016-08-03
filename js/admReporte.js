pnf = '';
periodo = '';
trayecto = '';
trimestre = '';
fechaI = '';
fechaF = '';
tipoG = '';

function buscarDatos(){
    lstPnf = document.getElementById('lstPnf');
    lstPer = document.getElementById('lstperiodo');
    lstTra = document.getElementById('lsttrayecto');
    lstTri = document.getElementById('lsttrimestre');
    campFechaI = document.getElementById('idtxtfecini');
    campFechaF = document.getElementById('idtxtfecfin');
    radDiag = document.getElementById('rdoDiag');
    radAnte = document.getElementById('rdoAnte');
    radProy = document.getElementById('rdoProy');
    if(radDiag.checked){
        tipo = radDiag.value;
    }else if(radAnte.checked){
        tipo = radAnte.value;
    }else{
        tipo = radProy.value;
    }
    if((campFechaI.value == '' && campFechaF.value != '') || (campFechaI.value != '' && campFechaF.value == '')){
        alert('Debe seleccionar las 2 fechas o dejar vacia ambas');
    }else{
        if(lstPnf.value != -1){
            pnf = lstPnf.value;
            periodo = lstPer.value;
            trayecto = lstTra.value;
            trimestre = lstTri.value;
            fechaI = campFechaI.value;
            fechaF = campFechaF.value;
            tipoG = tipo;
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'datosReporte');
            ajax.setVar("pnf",lstPnf.value);
            ajax.setVar("per",lstPer.value);
            ajax.setVar("tra",lstTra.value);
            ajax.setVar("tri",lstTri.value);
            ajax.setVar("fechi",campFechaI.value);
            ajax.setVar("fechaf",campFechaF.value);
            ajax.setVar("tipo",tipo);
            ajax.method="POST";
            ajax.onCompletion = function(){
                if(ajax.response != -1){
                    cargarTitulos(ajax.response,tipo);
                }else{
                    mD.limpiaTexto(xGetElementById('cont_result'));
                    campCapaDetalle = document.getElementById('detalle_list');
                    campCapaDetalle.style.display = 'none';
                    capaResult = document.getElementById('tab_resultados');
                    capaResult.style.display = 'none';
                    alert('No se encontraron registros');
                }
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
}
function cargarTitulos(req,tipo){
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
            }, html_entity_decode(datos[i]['titulo'],'ENT_QUOTES').toUpperCase());
            fila.setAttribute('onclick',"mostrarSel("+datos[i]['codigo']+",'"+tipo+"','detalle')");
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
            tabla.appendChild(fila);
        }
    }
}
function imprimirListaInv(){
//    lstPnf = document.getElementById('lstPnf');
//    pnfTexto = lstPnf.options[lstPnf.selectedIndex].text;
//    alert("PNF+ "+pnf+" tipo= "+tipoG+" fechai= "+fechaI+" fechaf= "+fechaF+" per= "+periodo+" tra= "+trayecto+" tri= "+trimestre+" pnfTexto= "+pnfTexto);
    if(pnf != ''){
        lstPnf = document.getElementById('lstPnf');
        pnfTexto = lstPnf.options[lstPnf.selectedIndex].text;      
        window.open("plani_lisinv.php?pnf="+pnf+"&tipo="+tipoG+"&fechai="+fechaI+"&fechaf="+fechaF+"&per="+periodo+"&tra="+trayecto+"&tri="+trimestre+"&pnfTexto="+pnfTexto,"reportedeinvestigaciones","_blank");
    }else{
        alert('Debe seleccionar un PNF');
    }
}

function buscarSeleccion(codigo,tipo,op){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDetalleList');
    ajax.setVar("tipo",tipo);
    ajax.setVar("codigo",codigo);
    ajax.setVar("opcion",op);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            campCodigo = document.getElementById('txtcodigo');
            campCodigo.value = codigo;
            cargarDetalle(ajax.response,codigo,tipo,op);
        }else{
            alert('No se encontraron los detalles del registro seleccionado');
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function imprimirDetalle(){
    campStatus = document.getElementById('txtstatus');
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
    campProblema = document.getElementById('txtproblema');
    campFecha = document.getElementById('txtfecha');
    campDocente = document.getElementById('txtdocente');
    campTutor = document.getElementById('txttutor');
    campCodigo = document.getElementById('txtcodigo');
    campTipo = document.getElementById('txttipo');
    campSerial = document.getElementById('txtserial');
    campObservacion = document.getElementById('txtobservacion');
    window.open("plani_detalle.php?status="+campStatus.innerHTML+"&pnf="+campPnf.innerHTML+"&periodo="+campPeriodo.innerHTML+
                "&trayecto="+campTrayecto.innerHTML+"&trimestre="+campTrimestre.innerHTML+"&estado="+campEstado.innerHTML+
                "&municipio="+campMunicipio.innerHTML+"&parroquia="+campParroquia.innerHTML+"&comunidad="+campComunidad.innerHTML+
                "&sector="+campSector.innerHTML+"&consejo="+campConsejo.innerHTML+"&responable="+campRespon.innerHTML+
                "&titulo="+campTitulo.innerHTML+"&problema="+campProblema.innerHTML+"&docente="+campDocente.innerHTML+
                "&tutor="+campTutor.innerHTML+"&fecha="+campFecha.innerHTML+"&seccion="+campSeccion.innerHTML+"&serial="+campSerial.value+
                "&observacion="+campObservacion.innerHTML+"&codigo="+campCodigo.value+"&tipo="+campTipo.value,"reportedetalle","_blank");
}