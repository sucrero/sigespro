tutor = '';
function proyeSel(cod){
    campTituloProyecto = document.getElementById('itxttitproyecto');
    campObjGeneral = document.getElementById('itxtobjgeneral');
    campSector = document.getElementById('txtsector');
    campComision = document.getElementById('itxtcomision');
    campProyecto = document.getElementById('txtproyecto');
    lstPeriodo = document.getElementById('ilstperiodo');
    lsttrayecto = document.getElementById('ilsttrayecto');
    lstTrimestre = document.getElementById('ilsttrimestre');
    campComision.value = '';
    datosSel = datosSelInt = seleccionInt = seleccion = '';
    mD.limpiaTexto(xGetElementById('cont_comi'));
//    campComision = document.getElementById('itxtcomision');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDatosProy');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response!=0){
            datos = eval("("+ajax.response+")");
            proyecto = datos[0];
            estudiantes = datos[1];
            tutor = datos[2]['iddocente']+'-'+datos[2]['ceddocente']+'-'+datos[2]['nomdocente'].toUpperCase()+'  '+datos[2]['apedocente'].toUpperCase()+'-T';
            sector = datos[3];
            campSector.value = sector['idsectorcomunidad'];
            campTituloProyecto.value = html_entity_decode(proyecto['objproyecto'],'ENT_QUOTES').toUpperCase();
            campObjGeneral.value = html_entity_decode(proyecto['objproyecto'],'ENT_QUOTES').toUpperCase();
            campProyecto.value = proyecto['idproyecto'];
            lstPeriodo.value = proyecto['idperiodo'];
            lsttrayecto.value = proyecto['trayectoproy'];
            lstTrimestre.value = proyecto['trimestreproy'];
            cargarTablaGrupo(estudiantes);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
    closeMessage();
}

function validarComision(){
    campComision = document.getElementById('itxtcomision');
    campComision.value = '';
    campComision.value = tutor;
    if(seleccion != '' && seleccionInt != ''){
        w = true;
        campComision.value = campComision.value+','+datosSel+','+datosSelInt;
    }else{
        if(seleccion == ''){
            alert('Debe seleccionar un Docente para formar la comision');
        }else{
            alert('Debe seleccionar un Integrante de la Comunidad para formar la comision');
        }
        w = false;
    }
    if(w){
        cargarTablaComision(campComision.value);
        closeMessage();
    }
}

function abrirComision(){
    sector = document.getElementById('txtsector');
    if (sector.value != '') {
        displayMessage('comision.php?destino=1&sector='+sector.value,'mostrarTodoDoc("eva")',770,580);
    }else{
        alert('Debe seleccion un Proyecto');
    }
}


function cerrarComision() {
    seleccionInt = seleccion = '';
    closeMessage();
}
function cargarTablaComision(datos)
{
    campComision = document.getElementById('itxtcomision');
    datos = campComision.value.split(',');
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_comi');
    mD.limpiaTexto(xGetElementById('cont_comi'));
    var num=tabla.childNodes.length+1;
    var codrad = 'comi' + num;
    for(i=0;i<datos.length;i++){
        item++;
        registros = datos[i].split('-');
        var itemS = String(item) ;
        var fila = mD.insertarFila(tabla, -1, {
                    'class':estilo,
                    'title': 'Integrantes de la Comision',
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
        }, registros[1]);
        var celda3 = mD.insertarCelda(fila, -1, {			
                'id': 'celda2',
                'align': 'left',
                'width': '70%'
        }, registros[2].toUpperCase());
        mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
        mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
        tabla.appendChild(fila);
    }
}

function guardarEvaluacion(){
    lstPeriodo = document.getElementById('ilstperiodo');
    lstTrayecto = document.getElementById('ilsttrayecto');
    lsttrimestre = document.getElementById('ilsttrimestre');
    campTituloProy = document.getElementById('itxttitproyecto');
    campObjProy = document.getElementById('itxtobjgeneral');
    campComision = document.getElementById('itxtcomision');
    campProyecto = document.getElementById('txtproyecto');
    radioNotaA = document.getElementById('radioA');
    radioNotaR = document.getElementById('radioR');
    campObservacion = document.getElementById('observacionEva');
    chkImp = document.getElementById('imprimir');
    w = true;
    if(radioNotaA.checked){
        nota = radioNotaA.value;
    }else if(radioNotaR.checked){
        nota = radioNotaR.value;
    }else{
        alert('Debe seleccionar una Nota descriptiva');
        radioNotaA.focus();
        w = false;
    }
//    alert(campComision.value);
    if(w){
        if(campComision.value != ''){
            ajax = new sack('../Modelo.php');
            ajax.setVar("periodo",lstPeriodo.value);
            ajax.setVar("trayecto",lstTrayecto.value);
            ajax.setVar("comision",campComision.value);
            ajax.setVar("nota",nota);
            ajax.setVar("observacion",campObservacion.value);
            ajax.setVar("proyecto",campProyecto.value);
            ajax.setVar("op",'guardarEva');
            ajax.method="POST";
            ajax.onCompletion = function(){
               if(ajax.response == 1){
                   if(chkImp.checked){
                        window.open("plani_evaluacion.php?per="+lstPeriodo.value+"&tra="+lstTrayecto.value+"&tri="+lsttrimestre.value+
                        "&tit="+campTituloProy.value+"&obj="+campObjProy.value+"&codpro="+campProyecto.value+
                        "&com="+campComision.value+"&obs="+campObservacion.value+"&nota="+nota,
                        "reporteevaluacion","_blank");
                    }
                   limpiarEvaluacion();
                   alert('Evaluacion registrada con exito');
               }else{
                   alert('No se pudo registrar la evaluacion, verifique');
               }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }else{
            alert('Debe seleccionar una Comision Tecnica');
        }
        
    }
}

function abrirProyEva(){
    lstPnf = document.getElementById('ilstPnf');
    if(lstPnf.value != -1){
        displayMessage('proyectos.php?destino=1&pnf='+lstPnf.value,'mostrarTodoProy("eva")',770,580);
    }else{
        alert('Debe seleccionar un PNF, verifique');
        lstPnf.focus();
    }
}

function limpiarEvaluacion(){
    campTituloProyecto = document.getElementById('itxttitproyecto');
    campObjGeneral = document.getElementById('itxtobjgeneral');
    campSector = document.getElementById('txtsector');
    campComision = document.getElementById('itxtcomision');
    campProyecto = document.getElementById('txtproyecto');
    campObservacion = document.getElementById('observacionEva');
    lstPeriodo = document.getElementById('ilstperiodo');
    lsttrayecto = document.getElementById('ilsttrayecto');
    lstTrimestre = document.getElementById('ilsttrimestre');
    lstPnf = document.getElementById('ilstPnf');
    radioNotaA = document.getElementById('radioA');
    radioNotaR = document.getElementById('radioR');
    datosSel = datosSelInt = seleccionInt = seleccion = '';
    lstPeriodo.value = -1;
    lsttrayecto.value = -1;
    lstTrimestre.value = -1;
    lstPnf.value = -1;
    campTituloProyecto.value = '';
    campObjGeneral.value = '';
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    mD.limpiaTexto(xGetElementById('cont_comi'));
    campSector.value = '';
    campProyecto.vakue = '';
    campComision.value = '';
    radioNotaA.checked = false;
    radioNotaR.checked = false;
    campObservacion.value = '';
    capa1 = document.getElementById('cuenta');
    capa1.innerHTML = 255;
    lstPnf.focus();
}

function mostrarEva(){
    lstPnf = document.getElementById('ilstPnf');
    if (lstPnf.value != -1) {
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscaTEva');
        ajax.setVar("pnf",lstPnf.value);
        ajax.method="POST";
        ajax.onCompletion = function(){
            datos = eval("("+ajax.response+")");
            crearTablaEva(datos);
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarEvaluacion();
    }
}

function crearTablaEva(datos){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_eva');
    mD.limpiaTexto(xGetElementById('cont_eva'));
    var num=tabla.childNodes.length+1;
    var codrad = 'eval' + num;
    
     if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            item++;
            var itemS = String(item) ;
            if(datos[i]['notadescriptiva'] == 'A'){
                color = '#00FF00';
                title = 'APROBADO';
            }else{
                color = '#FF0000';
                title = 'REPROBADO';
            }
            var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Proyecto '+title,
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
                    'width': '93%'
            }, html_entity_decode(datos[i]['nomproyecto'],'ENT_QUOTES').toUpperCase());
            var celda3 = mD.insertarCelda(fila, -1, {			
                    'id': 'celda3',
                    'align': 'center',
                    'width': '2%',
                    'bgcolor': color
            },'');
//            var celda4 = mD.insertarCelda(fila, -1, {			
//                    'id': 'celda4',
//                    'align': 'center',
//                    'width': '3,5%'
//            },'');
//            var imgE=document.createElement('img');
//            imgE.src="../img/eliminar_a.png";
//            imgE.border="0";
//            imgE.width="16";
//            imgE.height="16";
//            imgE.setAttribute('title',"Eliminar");
//            imgE.setAttribute('onclick',"eliminarEva("+datos[i]['idevaluacion']+")");
//            celda4.appendChild(imgE); 
            mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
            mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
            tabla.appendChild(fila);
        }
    }
}