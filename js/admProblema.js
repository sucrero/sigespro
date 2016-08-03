id='';
function mostrarTodoPro(opcion){//REVISADA 13092012
    if(opcion == 1 || opcion == 2 || opcion == 3){
        campSector = document.getElementById('ilstsectorcomun');
        sector = campSector.value;
    }else if(opcion == 4){
        sector = document.getElementById('ilstsector').name;
    }
    if(sector != -1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarTodosPro');
        ajax.setVar("destino",opcion);
        ajax.setVar("comuni",sector);
        ajax.onCompletion = function(){
//            alert(ajax.response);
//                if(ajax.response != 0){
                    if(opcion == 1 || opcion == 4){
                        crearTablaProblema(ajax.response,opcion);
                    }else{
//                        alert(ajax.response);
                        crearTablaProblemaDiag(ajax.response);
                        if(opcion == 2){
                            closeMessage();
                        }
                    }
//                }
            }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert('Debe seleccionar un Sector, verifique');
        campSector.focus();
    }
}
function crearTablaProblema(req,opcion){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_prob');    
    mD.limpiaTexto(xGetElementById('cont_prob'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        if(opcion == 4){
            col = 3;
        }else{
            col = 4;
        }
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': col}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Problemas',
                            'id': datos[i]['idproblema']
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
                    }, html_entity_decode(datos[i]['descripcionproblema'],'ENT_QUOTES').toUpperCase());
                    if(opcion != 4){
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
                        imgE.setAttribute('onclick',"eliminarProblema("+datos[i]['idproblema']+")");
                        celda5.appendChild(imgE);
                        var imgM=document.createElement('img');
                        imgM.src="../img/reporte.png";
                        imgM.border="0";
                        imgM.width="16";
                        imgM.height="16";
                        imgM.setAttribute('title',"Modificar");
                        imgM.setAttribute('onclick',"buscarProblema("+datos[i]['idproblema']+")");
                        celda6.appendChild(imgM);
                    }
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

function buscarProblema(cod){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarProbMod');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
            cargarProblema(ajax.response);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarProblema(req){
    campDesc = document.getElementById('itxtdescripcion');
    campSol = document.getElementById('itxtsolucion');
    btnGuardar = document.getElementById('btningresarProblem');
    btnModificar = document.getElementById('btnmodificarProblem');
    btnGuardar.style.display = 'none';
    btnModificar.style.display = 'block';
    problema = eval("("+req+")");
    campDesc.value = html_entity_decode(problema['descripcionproblema'],'ENT_QUOTES').toUpperCase();
    campSol.value = html_entity_decode(problema['posiblesolucion'],'ENT_QUOTES').toUpperCase();
    id = problema['idproblema'];
}

function modificarProblema(){
    campDesc = document.getElementById('itxtdescripcion');
    campSol = document.getElementById('itxtsolucion');
    campSector = document.getElementById('ilstsector').name;
    if(confirm("¿Seguro desea modificar este registro?")){
        if(campDesc.value.length <= 500){
            if(campSol.value.length <= 1000){
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'modificarProblem');
                ajax.setVar("codigo",id);
                ajax.setVar("desc",campDesc.value); 
                ajax.setVar("solucion",campSol.value);
                ajax.setVar("sector",campSector);
                ajax.method = "POST";
                ajax.onCompletion = function(){
                    if(ajax.response == 1){
                        mostrarTodoP(1);
                        limpiarPro();
                        mensaje = html_entity_decode('Problema modificado con &eacute;xito', 'ENT_QUOTES');
                        alert(mensaje);
                    }else{
                        alert('No se pudo modificar el registro');
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error');}
                ajax.runAJAX();
            }else{
                mensaje = html_entity_decode('La posible soluci&oacuute;n no puede contener mas de 1000 caracteres, verifique', 'ENT_QUOTES');
                alert(mensaje);
                campSol.focus();
            }
        }else{
            mensaje = html_entity_decode('La descripci&oacute;n no puede contener mas de 500 caracteres, verifique', 'ENT_QUOTES');
            alert(mensaje);
            campDesc.focus();
        }
    }
}

function guardarProblema(destino)
{
    /*
     *destino=0 : viene del menu ojo
     *destino=1 : viene de diagnostico
     *destino=2 : viene de proyecto
     *destino=3 : viene de sector
     *destino=4 : viene del menu
     **/
    campDesc = document.getElementById('itxtdescripcion');
    campSol = document.getElementById('itxtsolucion');
    campSector = document.getElementById('ilstsector');
    
    if(campDesc.value.length <= 500){
        if(campSol.value.length <= 1000){
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'guardarProblema');
            ajax.setVar("destino",destino);  
            ajax.setVar("desc",campDesc.value); 
            ajax.setVar("solucion",campSol.value);
            ajax.setVar("sector",campSector.name);
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(ajax.response != 0){
//                    if(destino == 1 || destino == 2){
//                        datos = eval("("+ajax.response+")");
//                        cod = datos[0];
//                        todPro = datos[1];
//                        campProblem = document.getElementById('itxtproblemas');//PARA GUARDAR LOS PROBLEMAS EN DIAGNOSTICO
//                        if(destino == 1){
//                            if(campProblem.value != ''){
//                                campProblem.value=campProblem.value+'='+campDesc.value+'@'+cod;
//                            }else{
//                                campProblem.value=campDesc.value+'@'+cod;
//                            }
//                            crearTablaProblemaDiag(campProblem);    
//                        }
//                        else if(destino == 2){
//                            for(i=0;i<todPro.length;i++){
//                                if(cod == todPro[i]['idproblema']){
//                                    campProblem.value = todPro[i]['descripcionproblema'];
//                                    campProblem.name = todPro[i]['idproblema'];
//                                    i=todPro;
//                                }
//                            }
//                        }
//                        closeMessage();
//                    }else{
//                        mostrarTodoP();
//                        alert('Registro ingresado con éxito');
//                        limpiarP();
//                        foco(1,0);
//                    }
//                    if(destino == 1){                       
                        mostrarTodoPro(destino);
                        limpiarPro();
                        mensaje = html_entity_decode('Registro ingresado con &eacute;xito', 'ENT_QUOTES');
                        alert(mensaje);
                        campDesc.focus();
//                    }
                }else{
                    alert('No se pudo ingresar el registro');
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }else{
            mensaje = html_entity_decode('La posible soluci&oacute;n no puede contener mas de 1000 caracteres, verifique',  'ENT_QUOTES');
            alert(mensaje);
            campSol.focus();
        }    
    }else{
        mensaje = html_entity_decode('La descripci&oacute;n no puede contener mas de 500 caracteres, verifique',  'ENT_QUOTES');
        alert(mensaje);
        campDesc.focus();
    }
    

}
//function guardarProblema(destino){
//    /*
//     *destino=0 : viene del menu
//     *destino=1 : viene de diagnostico
//     *destino=2 : viene de proyecto
//     **/
//    campDesc = document.getElementById('itxtdescripcion');
//     ajax = new sack('../Modelo.php');
//     ajax.setVar("op",'guardarProblema');
//     ajax.setVar("destino",destino);  
//     ajax.setVar("desc",campDesc.value);  
//     ajax.method = "POST";
//    ajax.onCompletion = function(){
//        if(ajax.response != 0){
//            if(destino == 1 || destino == 2){
//                datos = eval("("+ajax.response+")");
////                alert(destino);
//                cod = datos[0];
//                todPro = datos[1];
//                campProblem = document.getElementById('itxtproblemas');
//                if(destino == 1){
//                    if(campProblem.value != ''){
//                        campProblem.value=campProblem.value+'='+campDesc.value+'@'+cod;
//                    }else{
//                        campProblem.value=campDesc.value+'@'+cod;
//                    }
//                    crearTablaProblemaDiag(campProblem);    
//                }else if(destino == 2){
//                    for(i=0;i<todPro.length;i++){
//                        if(cod == todPro[i]['idproblema']){
//                            campProblem.value = todPro[i]['descripcionproblema'];
//                            campProblem.name = todPro[i]['idproblema'];
//                            i=todPro;
//                        }
//                    }
//                }
//                
//                closeMessage();
//            }else{
//                mostrarTodoP();
//                alert('Registro ingresado con éxito');
//                limpiarP();
//                foco(1,0);
//            }
//            
//        }else{
//            alert('No se pudo ingresar el registro');
//        }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//}


function crearTablaProblemaDiag(req)
{
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_problem');    
    mD.limpiaTexto(xGetElementById('cont_problem'));
    datos = eval("("+req+")");
//    alert('datos: '+datos);
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
               
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Problemas',
                            'id': datos[i]['idproblema']
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
                    }, html_entity_decode(datos[i]['descripcionproblema'],'ENT_QUOTES').toUpperCase());
                    var celda3 = mD.insertarCelda(fila,-1,{
                            'id':'celda4',
                            'align':'center',
                            'width':'15%'
                        },'');
                    var  chek =document.createElement('input');
                    chek.setAttribute('type', "radio");
                    chek.setAttribute('title', "T&iacute;lde el problema a seleccionar");
                    chek.setAttribute('name', "grupo1");
                    chek.setAttribute('id', datos[i]['idproblema']);
                    celda3.appendChild(chek);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
    
}

function limpiarPro(){
    campDesc = document.getElementById('itxtdescripcion');
    campSol = document.getElementById('itxtsolucion');
    btnGuardar = document.getElementById('btningresarProblem');
    btnModificar = document.getElementById('btnmodificarProblem')
    campDesc.value = '';
    campSol.value = '';
    btnGuardar.style.display = 'block';
    btnModificar.style.display = 'none';
    campDesc.focus();
}
function buscarProbleLe(obj, e){
    if(e.keyCode==13 || e.keyCode==9)return;
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarProbleLet');
    ajax.setVar("letras",obj.value);
    ajax.onCompletion = function(){
           crearTablaProbleLet(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}
function mostrarProblemas(){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosProble');
    ajax.onCompletion = function(){
        crearTablaProbleLet(ajax.response);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}
function crearTablaProbleLet(req){
    var estilo = 'colorCelda';
    var codPro;
    item=0;
    var tabla = document.getElementById('cont_proble');
    mD.limpiaTexto(xGetElementById('cont_proble'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'proble' + num;
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 2}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Problema disponible',
                            'id': datos[i]['idproblema']
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
                    }, html_entity_decode(datos[i]['descripcionproblema'],'ENT_QUOTES').toUpperCase());
                    codProble = datos[i]['idproblema'];
                    
                    fila.setAttribute('onclick',"probleSel("+codProble+")");
                  
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
        }
    }
}

function probleSel(codigo){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarDatosProble');
    ajax.setVar("codigo",codigo);
    ajax.method="POST";
    ajax.onCompletion = function(){
        cargarDetalleProble(ajax.response,codigo);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarDetalleProble(req,codigo){
    campStatus = document.getElementById('txtstatus');
    campCapaDetalle = document.getElementById('detalle_proble');
    campEstado = document.getElementById('txtestado');
    campMunicipio = document.getElementById('txtmunicipio');
    campParroquia= document.getElementById('txtparroquia');
    campComunidad = document.getElementById('txtcomunidad');
    campSector = document.getElementById('txtsector');
    campRespon = document.getElementById('txtresponsable');
    campConsejo = document.getElementById('txtconsejo');
    campProblema = document.getElementById('txtproblema');
    campPosible = document.getElementById('txtposiblesol');
    campCodigo = document.getElementById('txtCodProble');
    campCodigo.value = codigo;
    datos = eval("("+req+")");
    general = datos;
    campProblema.innerHTML = html_entity_decode(general['descripcionproblema'],'ENT_QUOTES').toUpperCase();
    campPosible.innerHTML = html_entity_decode(general['posiblesolucion'],'ENT_QUOTES').toUpperCase();
    if(general['seleccionado'] == '0'){
        color = '#0000FF';
    }else{
        color = '#FF0000';
    }
    campStatus.style.fontFamily = "Arial";
    campStatus.style.fontWeight = "bold";
    campStatus.style.fontSize = "17";
    campStatus.style.color = color;
    campStatus.innerHTML = 'DISPONIBLE';
    campEstado.innerHTML = general['descripestado'].toUpperCase();
    campMunicipio.innerHTML = general['descripmunicipio'].toUpperCase();
    campParroquia.innerHTML = general['descripparroquia'].toUpperCase();
    campComunidad.innerHTML = html_entity_decode(general['nomcomuni'],'ENT_QUOTES').toUpperCase();
    campSector.innerHTML = html_entity_decode(general['descripsector'],'ENT_QUOTES').toUpperCase();
    campRespon.innerHTML = general['nompersona'].toUpperCase()+'  '+general['apepersona'].toUpperCase();
    campConsejo.innerHTML = html_entity_decode(general['nomconsejo'],'ENT_QUOTES').toUpperCase();
    campCapaDetalle.style.display = 'block';
}

function imprimirDetalleProble(){
    campCodigo = document.getElementById('txtCodProble');
    campEstado = document.getElementById('txtestado');
    campMunicipio = document.getElementById('txtmunicipio');
    campParroquia= document.getElementById('txtparroquia');
    campComunidad = document.getElementById('txtcomunidad');
    campSector = document.getElementById('txtsector');
    campRespon = document.getElementById('txtresponsable');
    campConsejo = document.getElementById('txtconsejo');
    campProblema = document.getElementById('txtproblema');
    campPosible = document.getElementById('txtposiblesol');
    if(campCodigo.value != ''){
        estado = campEstado.innerHTML;
        municipio = campMunicipio.innerHTML;
        parroquia = campParroquia.innerHTML;
        comunidad = campComunidad.innerHTML;
        sector = campSector.innerHTML;
        responsable = campRespon.innerHTML;
        consejo = campConsejo.innerHTML;
        problema = campProblema.innerHTML;
        solucion = campPosible.innerHTML;
        window.open("plani_dettalleproblema.php?cod="+campCodigo.value+"&estado="+estado+
                    "&municipio="+municipio+"&parroquia="+parroquia+"&comunidad="+comunidad+"&sector="+sector+
                    "&responsable="+responsable+"&consejo="+consejo+"&problema="+problema+"&solucion="+solucion,
                    "detalleproblema","_blank");
    }else{
        alert('Debe seleccionar un problema');
    }
}