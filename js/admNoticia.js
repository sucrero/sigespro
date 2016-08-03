id = '';
function mostrarTodoNot()
{
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarTodasNot');
    ajax.onCompletion = function(){
           crearTablaNoticia(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaNoticia(req){
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_not');
    mD.limpiaTexto(xGetElementById('cont_not'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'da' + num;
    //alert(datos.length);
    if (datos == 0){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 4}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
                item++;
                var fecha = datos[i]['fechapubli'].split('-');
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                            'class':estilo,
                            'title': 'Noticias',
                            'id': datos[i]['idnoticia']
                    });
                    var celda1 = mD.insertarCelda(fila, -1, {
                            'id': 'celda1',			
                            'align': 'center',
                            'width': '5%'
                    }, itemS);
                    var celda2 = mD.insertarCelda(fila, -1, {			
                            'id': 'celda2',
                            'align': 'left',
                            'width': '15%'
                    }, html_entity_decode(datos[i]['titularnoticia'],'ENT_QUOTES').toUpperCase());
                    
                    
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
                    imgE.setAttribute('onclick',"eliminarNoticia("+datos[i]['idnoticia']+")");
                    celda5.appendChild(imgE);
                    var imgM=document.createElement('img');
                    imgM.src="../img/reporte.png";
                    imgM.border="0";
                    imgM.width="16";
                    imgM.height="16";
                    imgM.setAttribute('title',"Modificar");
                    imgM.setAttribute('onclick',"buscarNoticia("+datos[i]['idnoticia']+")");
                    celda6.appendChild(imgM);
                    mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                    mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                    tabla.appendChild(fila);
                  //  idceldas++;
                    
            
        }
    }
    
}

function guardarNoticia()
{
    campTitular = document.getElementById('itxttitular');
    campDescrip = document.getElementById('itxtdescripcion');
    if(campTitular != ''){
        if(campDescrip != ''){
            if (campDescrip.value.length <= 1000){
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'guardarNoticia');
                ajax.setVar("titu",campTitular.value);
                ajax.setVar("descrip",campDescrip.value);
                ajax.method = "POST";
                ajax.onCompletion = function(){
                   if(ajax.response !=0){
                        mostrarTodoNot();
                        alert('Noticia registrada exitosamente');
                        limpiarNot();
                    }else{
                        alert('No se pudo registrar la noticia');
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error');}
                ajax.runAJAX();
            }else{
                alert ('La descripcion de la Noticia debe contener menos de 1000 caracteres');
                campDescrip.focus();
            }
        }else{
            alert('Debe ingresar una descripcion');
            campDescrip.focus();
        }
    }else{
        alert('Debe ingresar un Titular');
        campTitular.focus();
    }
}

function limpiarNot(){
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    document.getElementById('itxttitular').value='';
    document.getElementById('itxtdescripcion').value='';
    document.getElementById('itxttitular').focus();
    btnGuardar.style.display='block';
    btnModificar.style.display='none';
}

function eliminarNoticia(v)
{
    if(window.confirm("Esta seguro en Eliminar esta Noticia?"))
    {
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'eliminarNoticia');
        ajax.setVar("id",v);
        ajax.method = "POST";
        ajax.onCompletion = function(){
           if(ajax.response == 1){
               mostrarTodoNot();
                alert('Noticia eliminada exitosamente');
            }else{
                alert('No se pudo eliminar la noticia');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function buscarNoticia(v){
    btnGuardar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarNoticia');
    ajax.setVar("id",v);
    ajax.method = "POST";
    ajax.onCompletion = function(){
       if(ajax.response != 0){
            datos = eval("("+ajax.response+")");
            id = datos['idnoticia'];
            document.getElementById('itxttitular').value = html_entity_decode(datos['titularnoticia'],'ENT_QUOTES').toUpperCase();
            document.getElementById('itxtdescripcion').value = html_entity_decode(datos['descripnoticia'],'ENT_QUOTES').toUpperCase();
            btnGuardar.style.display='none';
            btnModificar.style.display='block';
        }else{
            alert('No se pudo mostrar la noticia');
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function modificarNoticia()
{
    if(window.confirm("Esta seguro en Modficar esta Noticia?")){
        campTitular = document.getElementById('itxttitular');
        campDescrip = document.getElementById('itxtdescripcion');
        if(campTitular != ''){
            if(campDescrip != ''){
                if (campDescrip.value.length <= 1000){
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'modificarNoticia');
                    ajax.setVar("titu",campTitular.value);
                    ajax.setVar("descrip",campDescrip.value);
                    ajax.setVar("codigo",id);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                       if(ajax.response !=0){
                            mostrarTodoNot();
                            alert('Noticia modificada exitosamente');
                            limpiarNot();
                        }else{
                            alert('No se pudo modificar la noticia');
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }else{
                    alert ('La descripcion de la Noticia debe contener menos de 1000 caracteres');
                    campDescrip.focus();
                }
            }else{
                alert('Debe ingresar una descripcion');
                campDescrip.focus();
            }
        }else{
            alert('Debe ingresar un Titular');
            campTitular.focus();
        }
    }
}