id = '';
login = '';
function mostrarTodoUsu()
{
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'busTodoUsu');
    ajax.onCompletion = function(){
//        alert(ajax.response);
           crearTablaUsuario(ajax.response);
        }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function crearTablaUsuario(req)
{
    var estilo = 'colorCelda';
    item=0;
    var tabla = document.getElementById('cont_usu');
    mD.limpiaTexto(xGetElementById('cont_usu'));
    datos = eval("("+req+")");
    var num=tabla.childNodes.length+1;
    var codrad = 'us' + num;
    //alert(datos.length);
    if (datos.length == 1){
        var fila = mD.insertarFila(tabla,-1,{'class':estilo});
        var celda2 = mD.insertarCelda(fila, -1, {'id': 'celda1','align': 'center','colspan': 6}, 'No existen registros para mostrar');
        tabla.appendChild(fila);
    }else{
        for(i=0;i<datos.length;i++){
            if(datos[i]['idusuario'] != 0){
                item++;
                var itemS = String(item) ;
               // var casi = String(idceldas); 
                var fila = mD.insertarFila(tabla, -1, {
                        'class':estilo,
                        'title': 'Usuarios',
                        'id': datos[i]['idusuario']
                });
                var celda1 = mD.insertarCelda(fila, -1, {
                        'id': 'celda1',			
                        'align': 'center',
                        'width': '5%'
                }, itemS);
                var celda2 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda2',
                        'align': 'right',
                        'width': '10%'
                }, datos[i]['cedula']);
                var celda3 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda3',
                        'align': 'left',
                        'width': '45%'
                }, datos[i]['nombre'].toUpperCase());
                var celda4 = mD.insertarCelda(fila, -1, {			
                        'id': 'celda4',
                        'align': 'left',
                        'width': '25%'
                }, datos[i]['login'].toLowerCase());
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
                imgE.setAttribute('onclick',"eliminarUsuario("+datos[i]['idusuario']+")");
                celda5.appendChild(imgE);
                var imgM=document.createElement('img');
                imgM.src="../img/reporte.png";
                imgM.border="0";
                imgM.width="16";
                imgM.height="16";
                imgM.setAttribute('title',"Modificar");
                imgM.setAttribute('onclick',"buscarUsuario("+datos[i]['idusuario']+")");
                celda6.appendChild(imgM);
                mD.anexaEvento(fila,"mouseover",seleccionadotablas, [fila.id, "tablaOver"]);
                mD.anexaEvento(fila,"mouseout",seleccionadotablas, [fila.id, estilo]);
                tabla.appendChild(fila);
            }
        }
    }
}

function buscarUsuario(idusuario)
{
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarUsu');
    ajax.setVar("codigo",idusuario);
    ajax.method="POST",
    ajax.onCompletion = function(){
        id = idusuario;
        cargarUsuMod(ajax.response);
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function cargarUsuMod(req)
{
    lstNac = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campNombre = document.getElementById('itxtnombre');
    campApellido = document.getElementById('itxtapellido');
    campTelf = document.getElementById('itxttelf');
    campEmail = document.getElementById('itxtmail');
    campLogin = document.getElementById('itxtlogin');
    campClave = document.getElementById('itxtclaves');
    campReclave = document.getElementById('itxtreclaves');
    lstPerfil = document.getElementById('ilstperfil');
    btnIngresar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    msj = document.getElementById('mensaje');
    
       
    btnIngresar.style.display = 'none';
    btnModificar.style.display='block';
    msj.style.display = 'none';
    datos = eval("("+req+")");
//    alert(datos[1]['cedula']);
    lstNac.value = datos[1]['cedula'].substr(0, 1);
    campCedula.value = datos[1]['cedula'].substr(1);
    campNombre.value = datos[1]['nombre'].toUpperCase();
    campApellido.value = datos[1]['apellido'].toUpperCase();
    campTelf.value = datos[1]['telefono'];
    campEmail.value = datos[1]['email'].toUpperCase();
    
    login = campLogin.value = datos[0]['login'];
    campClave.value = '*****';
    campReclave.value = '*****';
    lstPerfil.value = datos[0]['perfil'];
    campNombre.disabled = true;
    campApellido.disabled = true;
    campTelf.disabled = true;
    campEmail.disabled = true;
    campCedula.disabled = true;
    lstNac.disabled = true;
    campClave.disabled = true;
    campReclave.disabled = true; 
    
}

function modificarUsuario()
{
    campLogin = document.getElementById('itxtlogin');
    lstPerfil = document.getElementById('ilstperfil');
    btnIngresar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    if(confirm("Seguro que desea modificar el registro?")){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'modUsuario');
        ajax.setVar("codigo",id);
        ajax.setVar("login",campLogin.value);
        ajax.setVar("loginOld",login);
        ajax.setVar("perfil",lstPerfil.value);
        ajax.method="POST",
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                mostrarTodoUsu();
                alert('Usuario modificado con exito');
                limpiarUsuario();
            }else if(ajax.response == 2){
                campLogin.value = '';
                alert('Nombre de Usuario registrado, verifique');
                campLogin.focus();
            }else{
                alert('No se pudo modificar el registro');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}

function eliminarUsuario(idusuario)
{
    if(confirm('Seguro que desea eliminar el registro?')){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'elimiUsu');
        ajax.setVar("codigo",idusuario);
        ajax.method="POST",
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                mostrarTodoUsu();
                alert('Registro eliminado con exito');
                limpiarUsuario();
            }else{
                alert('No se puede eliminar el registro, posee registros asociados');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }
}
function valEntrada(){
    campLogin = document.getElementById('itxtlogine');
    campClave = document.getElementById('itxtclavee');
    clave=hex_sha1(campClave.value);
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'validar_entrada');
    ajax.setVar("login",campLogin.value);
    ajax.setVar("clave",clave);
    ajax.method="POST",
    ajax.onCompletion = function(){
        if(ajax.response == 1){
            ir('vistas/index.php');
        }else{
            campLogin.value = '';
            campClave.value = '';
            alert('Combinación de Usuario y clave, inválida');
            campLogin.focus();
        }
    }
    ajax.onError=function(){alert('Ha ocurrido un error');}
    ajax.runAJAX();
}

function busPer(obj,event){
//    lstPerfil = document.getElementById('ilstperfil');
    lstNac = document.getElementById('ilstnac');
        if(obj.value == ''){
            limpiarUsuario();
        }else{
            if(event.keyCode == 13 || event.keyCode == 9){
                if(obj.value != ''){
                    ced = lstNac.value+obj.value;
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'busUsu');
                    ajax.setVar("cedula",ced);
//                    ajax.setVar("perfil",lstPerfil.value);
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
//                        alert(ajax.response);
                        if(ajax.response != 0){
                            datos = eval("("+ajax.response+")");
                            if(datos[0]['IDUSUARIO'] != 0){
                                alert('La Persona con cedula ' + obj.value + ', posee usuario asociado');
                                limpiarUsuario();
                            }else{
                                cargarDatosUsu(datos);
                            }
                        }else{                    
                            alert('No existe ninguna persona con la cedula ingresada,\ndebe registrarla y luego crearle un usuario');
                            limpiarUsuario();
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }
            }
        }
}

function cargarDatosUsu(datos)
{
    campNombre= document.getElementById('itxtnombre');
    campApellido=document.getElementById('itxtapellido');
    campTelf=document.getElementById('itxttelf');
    campEmail = document.getElementById('itxtmail');
    campLogin = document.getElementById('itxtlogin');
    campClave = document.getElementById('itxtclaves');
    campReclave = document.getElementById('itxtreclaves');
    lstPerfil = document.getElementById('ilstperfil');
    campComuni = document.getElementById('itxtcomunidad');
    campNombre.value = datos[0]['NOMBRE'].toUpperCase();
    campApellido.value = datos[0]['APELLIDO'].toUpperCase();
    campTelf.value = datos[0]['TELEFONO'];
    campEmail.value = datos[0]['EMAIL'].toUpperCase();
    campComuni.value = html_entity_decode(datos[0]['COMUNIDAD'],'ENT_QUOTES').toUpperCase();
    if(datos[0]['TIPO'] == 'COMUNIDAD'){
        lstPerfil.disabled = true;
        lstPerfil.value = 3;
    }else{
        lstPerfil.disabled = false;
    }
    campLogin.disabled = false;
    campClave.disabled = false;
    campReclave.disabled = false;
    campLogin.focus();
}

function limpiarUsuario()
{
    lstNac = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campNombre = document.getElementById('itxtnombre');
    campApellido = document.getElementById('itxtapellido');
    campTelf = document.getElementById('itxttelf');
    campEmail = document.getElementById('itxtmail');
    campLogin = document.getElementById('itxtlogin');
    campClave = document.getElementById('itxtclaves');
    campReclave = document.getElementById('itxtreclaves');
    lstPerfil = document.getElementById('ilstperfil');
    btnIngresar = document.getElementById('btningresar');
    btnModificar = document.getElementById('btnmodificar');
    msj = document.getElementById('mensaje');
    campComuni = document.getElementById('itxtcomunidad');
    lstNac.value = 'V';
    lstNac.disabled = false;
    campCedula.disabled = false;
    campLogin.disabled = true;
    campClave.disabled = true;
    campReclave.disabled = true;
    lstPerfil.disabled = true;
    msj.style.display = 'block';
    btnIngresar.style.display = 'block';
    btnModificar.style.display = 'none';
    campCedula.value = '';
    campNombre.value = '';
    campApellido.value = '';
    campTelf.value = '';
    campEmail.value = '';
    campLogin.value = '';
    campClave.value = '';
    campReclave.value = '';
    campComuni.value = '';
    lstPerfil.value = -1;
    campCedula.focus();
}

function guardarUsuario(){
    lstNac = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campLogin = document.getElementById('itxtlogin');
    campClave = document.getElementById('itxtclaves');
    campReclave = document.getElementById('itxtreclaves');
    lstPerfil = document.getElementById('ilstperfil');
    
    if(campClave.value == campReclave.value){
        ced = lstNac.value+campCedula.value;
        clave = hex_sha1(campClave.value);
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'guardarUsu');
        ajax.setVar("cedula",ced);
        ajax.setVar("login",campLogin.value);
        ajax.setVar("clave",clave);
        ajax.setVar("perfil",lstPerfil.value);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 0){
                mostrarTodoUsu();
                alert('Usuario registrado con éxito');
                limpiarUsuario();
            }else{
                alert('Nombre de Usuario registrado, verifique');
                campLogin.value = '';
                campLogin.focus();
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert('Las claves no coinciden, verifique');
    }
}

function modificarClave()
{
    campClaveActual = document.getElementById('itxtclaveActual');
    campClave = document.getElementById('itxtclave');
    campReClave = document.getElementById('itxtreclave');
    if(campClave.value == campReClave.value){
        if(confirm('¿Seguro desea modificar su clave?')){
            clave = hex_sha1(campClave.value);
            actual = hex_sha1(campClaveActual.value);
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'modificarClave');
            ajax.setVar("clavenueva",clave);
            ajax.setVar("claveactual",actual);
            ajax.method="POST",
            ajax.onCompletion = function(){
                if(ajax.response == 1){
                    alert('Clave modificada con éxito');
                    ir('vistas/index.php');
                }else{
                    alert('Clave inválida');
                    campClaveActual.value='';
                    campClave.value='';
                    campReClave.value='';
                    campClaveActual.focus();
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }
    }else{
        alert('Las claves no coinciden, verifique!');
        campClave.focus();
    }
}

function limpiarCla(){
    document.getElementById('itxtclaveActual').value = '';
    document.getElementById('itxtclave').value = '';
    document.getElementById('itxtreclave').value = '';
    document.getElementById('itxtclaveActual').focus();
}