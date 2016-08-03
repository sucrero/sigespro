function mostrarTodoEstGrupo(formulario){
    formulario = document.getElementById(formulario);
    lstPeriodo = formulario.ilstperiodo;
    lstTrayecto = formulario.ilsttrayecto;
    lstTrimestre = formulario.ilsttrimestre;
    lstPnf = formulario.ilstPnf;
    ajax = new sack('../Modelo.php');
    ajax.setVar("periodo",lstPeriodo.value);
    ajax.setVar("trayecto",lstTrayecto.value);
    ajax.setVar("trimestre",lstTrimestre.value);
    ajax.setVar("pnf",lstPnf.value);
    ajax.setVar("op",'bEstGrupo');
    ajax.method="POST";
    ajax.onCompletion=function(){
        if(ajax.response != 0){
            crearTablaEstGrupo(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaEstGrupo(req){
    if(camGrupoTable.value != ''){
        grupo = camGrupoTable.value;
    }else{
        grupo = campGrupoMod.value;
    }
    integrantes = grupo.split(',');
    cantGrupo = integrantes.length;
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
        datosInt = new Array();
        for(i = 0; i < datos.length; i++){
            w = true;
            for(j = 0; j < cantGrupo; j++){
                datosInt[j] = integrantes[j].split('-');
                if(datos[i]['idestudiante'] == datosInt[j][0]){
                    w = false;
                }
            }
            if(w){
                item++;
                    var itemS = String(item) ;
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
                    }, datos[i]['cedestudiante']);
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
                    chek.setAttribute('name', "chek"+(i+1));
//                    chek.setAttribute('onClick', "verificarCantEstu();");
                    chek.setAttribute('id', datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase());
                    celda4.appendChild(chek);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id,"tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id,estilo]);
                    tabla.appendChild(fila);
            }
        }
    }
}

function validarGrupo(formulario){
    lstTrayecto = document.getElementById('ilsttrayecto');
    objForm = document.getElementById('formEstGrupo');
    nroElement = objForm.length;
    var elementos='';
    var cont = 0;
    var j = 0;
    for(i=0;i<nroElement;i++){
        if(objForm.elements[i].type=='checkbox'){
            if(objForm.elements[i].checked){
                if(objForm.elements[i].id!=0){
//                    elementos[j++]=objForm.elements[i].id;
//                        alert('pos: '+i+'   '+objForm.elements[i].id);
                        if(elementos == ''){
//                            alert('si pos '+i+': '+objForm.elements[i].id);
                            elementos = objForm.elements[i].id;
                        }else{
//                            alert('else pos '+i+': '+objForm.elements[i].id);
                            elementos = elementos+','+objForm.elements[i].id;
                        }
                }
            }
        }
    }
    if(camGrupoTable.value == ''){
        camGrupoTable.value = elementos;
    }else{
        camGrupoTable.value = camGrupoTable.value+','+elementos;
    }
    if(campGrupoMod.value != ''){
        camGrupoTable.value = camGrupoTable.value;
    }
    estu = camGrupoTable.value+','+campGrupoMod.value
    cont = estu.split(',').length;
    minimo = 1;//minimo de estudiantes por grupo
    if(lstTrayecto.value == 1 || lstTrayecto.value == 2){
        maximo = 5;//maximo de estudiantes por grupo cuando el trayecto es 1 o 2
    }else{
        maximo = 3;//maximo de estudiantes por grupo cuando el trayecto es 3 o 4
    }

    if(cont > maximo){
        alert('El grupo debe estar conformado maximo por '+maximo+' estudiantes, verifique');
    }else if(cont < minimo){
        alert('El grupo debe estar conformado minimo por '+minimo+' estudiantes, verifique');
    }else{
        crearTablaGrupo(estu);
        closeMessage();
    }
    
}

function crearTablaGrupo(req){
//    alert('desde crear tabla grupo: '+req);
//    camGrupo.value = '';
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_grupo');
    mD.limpiaTexto(xGetElementById('cont_grupo'));
    var num=tabla.childNodes.length+1;
    var codrad = 'grup';
    if (req == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 3}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
//        separador = ',';
        if(/,/.test(req)){
            datosM = req.split(',');
            cant = datosM.length;
        }else{
            datosM = req;
            cant = 1;
        }
        
        
//        alert('antes del for: '+camGrupo.value);
alert('cantidad de estudiantes listados: '+cant);
cont = 0;
        for(i=0;i<cant;i++){
                item++;
                var itemS = String(item) ;
                valor=datosM[i].split('-');
                if(camGrupo.value == ''){
                    camGrupo.value += valor[0];
                }else{
                    camGrupo.value += '-'+valor[0];
                }
//                alert('pos '+i+': '+camGrupo.value);
                if(valor[0] != ''){
                    ++cont;
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
                            'width': '25%'
                    }, valor[1]);

    //                if(ventana != 'grupo'){
                        var celda3 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '70%'
                        }, valor[2]);   
//                        var celda4 = mD.insertarCelda(fila, -1, {			
//                            'id': 'celda2',
//                            'align': 'left',
//                            'width': '5%'
//                        }, '');
//                        var imgE=document.createElement('img');
//                        imgE.src="../img/equis.png";
//                        imgE.border="0";
//                        imgE.width="14";
//                        imgE.height="14";
//                        imgE.setAttribute('title',"Eliminar del Grupo");
//                        imgE.setAttribute('onclick',"eliminarEstGrupo("+valor[0]+','+cant+")");
//                        celda4.appendChild(imgE);
                        mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                        mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                        tabla.appendChild(fila);
                }
                
        }      
    }
}
//function eliminarEstGrupo(codEstu,cant){
//    if(cant <= 1){
//        alert('No puede eliminar ningun integrante del Grupo, ya que el grupo puede contener 1 integrante minimo');
//    }else{
//        if(confirm("Seguro desea eliminar a este Estudiante del Grupo?")){
//            if(camGrupoTable.value != ''){
//                if(campGrupoMod.value != ''){
//                    estu = camGrupoTable.value+','+campGrupoMod.value; 
//                }else{
//                    estu = camGrupoTable.value; 
//                }
//            }else{
//                estu = campGrupoMod.value; 
//            }
//            grupEst = estu.split(',');
//            num = grupEst.length;
//            aux = new Array();
//            nuevo = new Array();
//            j = 0;
//            for(i = 0; i < num; i++){
//                nuevo[i] = grupEst[i].split('-');
//                if(nuevo[i][0] != codEstu){
//                    aux[j++] = grupEst[i];
//                }
//            }
//            alert('en eliminar: '+aux);
//            crearTablaGrupo(aux);
////            for(i = 0; i<estu.length; i++){
////                    aux[i] = estu[i].split('-');
////                    if(aux[i][0] != codEstu){//QUIERE DECIR QUE ESTA EN LA BDD
////                        nuevo[j++] = estu[i];
////                    }
////                }
////            if(w){
////                ajax = new sack('../Modelo.php');
////                ajax.setVar("idEstu",codEstu);
////                ajax.setVar("op",'ElimEstGrupo');
////                ajax.method="POST";
////                ajax.onCompletion=function(){
////                    if(ajax.response != -3 && ajax.response != -2){
////                        datos = eval("("+ajax.response+")");
//////                        grupEstu = new Array();
////                        campGrupoMod.value = '';
////                        for(i=0;i<datos.length;i++){
//////                            grupEstu[i] = datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase();
////                            if(campGrupoMod.value == ''){
////                                campGrupoMod.value = datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase();
////                            }else{
////                                campGrupoMod.value = campGrupoMod.value+','+datos[i]['idestudiante']+'-'+datos[i]['cedestudiante']+'-'+datos[i]['nomestudiante'].toUpperCase()+'  '+datos[i]['apeestudiante'].toUpperCase();
////                            } 
////                        }
////                        if(camGrupoTable.value != ''){
////                            if (campGrupoMod.value != ''){
////                                nuevo = camGrupoTable.value+','+campGrupoMod.value;
////                            }else{
////                                nuevo = camGrupoTable.value;
////                            }
////                            alert('grupotable!=VACIO : '+nuevo);
////                        }else{
////                            nuevo = campGrupoMod.value;
////                            alert('grupotable==VACIO : '+nuevo);
////                        }
////                        
////                        alert('elimando de la BDD: '+nuevo);
////                        crearTablaGrupo(nuevo);
////                    }else{
////                        alert('No se pudo eliminar el estudiante del grupo');
////                    }
////                }
////                ajax.onError=function(){alert('Ha ocurrido un error');}
////                ajax.runAJAX(); 
////            }else{
////                estu = camGrupoTable.value.split(',');
////                nuevo = new Array();
////                aux = new Array();
////                w = false;
////                j=0;
////                
////                camGrupoTable.value = nuevo;
////                if(campGrupoMod.value != ''){
////                    if(nuevo != ''){
////                        estud = campGrupoMod.value+','+nuevo;
////                    }else{
////                        estud = campGrupoMod.value;
////                    }
////                    
////                }else{
////                    estud = nuevo;
////                }
////                
////                alert('elimando de la tabla: '+estud);
////                crearTablaGrupo(estud);
////            }
//            
//        }
//    }
// }

//function crearListaGrupo(cont){
////    alert(cont);
//    
////    formulario = document.getElementById('formDiagnostico');
////    lstGrupo=formulario.ilstgrupo;
//    lstGrupo = document.getElementById('ilstgrupo');
//   dato = eval(cont);
////   alert(dato[0]);
////    valor=dato.split(',');
////    valor=datos[i].split('-');
//grupo='';
//    for(i=0;i<dato.length;i++){
//        if(i!=0){
//            grupo+=' # ';
//        }
//        estu=dato[i].split('-');
//        grupo+=estu[1]+' - '+estu[2];
//        //alert('nombre: '+estu[1]+' apellido: '+estu[2]);
//    }
//        lstGrupo.options[lstGrupo.length] = new Option(grupo,estu[0]);
//        lstGrupo.options[lstGrupo.length-1].selected="selected";
//}