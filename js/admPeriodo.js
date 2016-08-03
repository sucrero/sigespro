id = '';
codi = '';
function busPer(){
    campPeriodo = document.getElementById('itxtcodigoper');
    if(campPeriodo.value !=''){
        if(campPeriodo.value.length == 5){
            per = campPeriodo.value.split("-");
            if(per.length == 2){
                if(per[0].length == 2 && per[1].length == 2){
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'buscarPeriodo');
                    ajax.setVar("codigo",campPeriodo.value);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                        if(ajax.response == 1){
                            alert('Codigo de Periodo duplicado, verifique');
                            campPeriodo.value='';
                            campPeriodo.focus();
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }else{
                    alert('El Codigo del Periodo debe tener la forma XX-XX, donde X es numerico');
                    campPeriodo.value='';
                    campPeriodo.focus(); 
                }
            }else{
                alert('El Codigo del Periodo debe tener la forma XX-XX, donde X es numerico');
                campPeriodo.value='';
                campPeriodo.focus();
            }
        }else{
            alert('El Codigo del Periodo debe estar formado por 5 caracteres');
            campPeriodo.value='';
            campPeriodo.focus();
        } 
    }
}

function guardarPeriodo(){
    campPeriodo = document.getElementById('itxtcodigoper');
    fechaInicio = document.getElementById('idtxtfecini');
    fechaFin = document.getElementById('idtxtfecfin');
    btnFechaI = document.getElementById('btncalendaI');
    
    if(compararFechas2(fechaInicio.value, fechaFin.value)){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'guardarPeriodo');
        ajax.setVar("periodo",campPeriodo.value);
        ajax.setVar("inicio",fechaInicio.value);
        ajax.setVar("fin",fechaFin.value);
        ajax.method = "POST";
        ajax.onCompletion = function(){
//            alert(ajax.response);
            if(ajax.response != 2 && ajax.response != 0){
                mostrarTodoP();
                alert('Periodo registrado exitosamente');
                limpiarP();
            }else if(ajax.response == 2){
                alert('El codigo del periodo ingresado ya existe, verifique');
                campPeriodo.value = '';
                campPeriodo.focus();
            }else{
                alert('No se pudo registrar el periodo');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert('La Fecha de inicio debe ser menor a la final');
        fechaInicio.value="";
        fechaFin.value="";
        btnFechaI.focus();
    }
}
 function limpiarP(){
    campPeriodo = document.getElementById('itxtcodigoper');
    fechaInicio = document.getElementById('idtxtfecini');
    fechaFin = document.getElementById('idtxtfecfin');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    campPeriodo.value='';
    fechaInicio.value='';
    fechaFin.value='';
    campPeriodo.focus();
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
 }
 
function mostrarTodoP(){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodosPer');
    ajax.onCompletion = function(){
        //alert(ajax.response);
           crearTablaPeriodo(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaPeriodo(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_per');
    mD.limpiaTexto(xGetElementById('cont_per'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    //alert(datos.length);
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 6}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var fechaI = datos[i]['fechainicio'].split('-');
                var fechaF = datos[i]['fechafinal'].split('-');
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Periodos',
                            'id': datos[i]['idperiodo']
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
                    }, datos[i]['codperiodo']);
                    
                    var celda3 = mD.insertarCelda(fila, -1, {
                            'id': 'celda3',
                            'align': 'center',
                            'width': '32%'
                    }, fechaI[2]+'/'+fechaI[1]+'/'+fechaI[0]);
                    var celda4 = mD.insertarCelda(fila, -1, {
                            'id': 'celda3',
                            'align': 'center',
                            'width': '33%'
                    }, fechaF[2]+'/'+fechaF[1]+'/'+fechaF[0]);
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
                    imgE.setAttribute('onclick',"eliminarPeriodo("+datos[i]['idperiodo']+")");
                    celda5.appendChild(imgE);
                    var imgM=document.createElement('img');
                    imgM.src="../img/reporte.png";
                    imgM.border="0";
                    imgM.width="16";
                    imgM.height="16";
                    imgM.setAttribute('title',"Modificar");
                    imgM.setAttribute('onclick',"buscarPeriodo("+datos[i]['idperiodo']+")");
                    celda6.appendChild(imgM);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
                  //  idceldas++;
                    
            
        }
    }
    
}


function buscarPeriodo(cod){
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarPer');
    ajax.setVar("codigo",cod);
    ajax.method="POST";
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            id=cod;
            cargarPeriodo(ajax.response);
            //alert(ajax.response);
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarPeriodo(req){
    campPeriodo = document.getElementById('itxtcodigoper');
    fechaInicio = document.getElementById('idtxtfecini');
    fechaFin = document.getElementById('idtxtfecfin');
    btnFechaI = document.getElementById('btncalendaI');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    datos = eval("("+req+")");
    codi = campPeriodo.value = datos['codperiodo'];
    var fecha = datos['fechainicio'].split('-');
    fechaInicio.value=fecha[2]+'/'+fecha[1]+'/'+fecha[0];
    fecha = datos['fechafinal'].split('-');
    fechaFin.value=fecha[2]+'/'+fecha[1]+'/'+fecha[0];
    btnGuardar.style.display='none';
    btnModificar.style.display='block';
}

function modificarPeriodo(){
    campPeriodo = document.getElementById('itxtcodigoper');
    fechaInicio = document.getElementById('idtxtfecini');
    fechaFin = document.getElementById('idtxtfecfin');
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    if(confirm("¿Seguro desea modificar este registro?")){
        if(campPeriodo.value !=''){
            if(campPeriodo.value.length == 7){
                per = campPeriodo.value.split("-");
                if(per.length == 2){
                    if(per[0].length == 2 && per[1].length == 4){
                        if(compararFechas2(fechaInicio.value, fechaFin.value)){
                            ajax = new sack('../Modelo.php');
                            ajax.setVar("op",'modificarPeriodo');
                            ajax.setVar("id",id);
                            ajax.setVar("codigo",campPeriodo.value);
                            ajax.setVar("inicio",fechaInicio.value);
                            ajax.setVar("fin",fechaFin.value);
                            ajax.setVar("codOld",codi);
                            ajax.setVar("tipo","modificar");
                            ajax.method = "POST";
                            ajax.onCompletion = function(){
                                if(ajax.response == 2){
                                    mostrarTodoP();
                                    alert('Periodo modificado con éxito');
                                }else if(ajax.response == 4){
                                    alert('No se puedo modificar el periodo porque posee registros asociados');
                                }else if(ajax.response == 3){
                                    alert('El codigo ingresado existe, verifique');
                                }else{
                                    alert('No se pudo modificar el registro');
                                }
                                limpiarP();
                            }
                            ajax.onError=function(){alert('Ha ocurrido un error');}
                            ajax.runAJAX();
                        }else{
                            alert('La Fecha de inicio debe ser menor a la final');
                            fechaInicio.value="";
                            fechaFin.value="";
                            btnFechaI.focus();
                        }
                        
                    }else{
                        alert('El Codigo del Periodo debe tener la forma xx-xxxx, donde x es numerico');
                        campPeriodo.value='';
                        campPeriodo.focus(); 
                    }
                }else{
                    alert('El Codigo del Periodo debe tener la forma xx-xxxx, donde x es numerico');
                    campPeriodo.value='';
                    campPeriodo.focus();
                }
            }else{
                alert('El Codigo del Periodo debe estar formado por 7 digitos');
                campPeriodo.value='';
                campPeriodo.focus();
            } 
        }
        
    }
}

function eliminarPeriodo(cod){
    if(confirm("¿Seguro desea eliminar este registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'modificarPeriodo');
        ajax.setVar("tipo","eliminar");
        ajax.setVar("id",cod);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 2){
                mostrarTodoP();
                alert('Periodo eliminado con éxito');
            }else if(ajax.response == 1){
                alert('No se puedo eliminar el periodo porque posee registros asociados');
            }else{
                alert('No se pudo eliminar el registro');
            }
            limpiarP();
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}