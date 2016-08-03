function valCedula(event){
    lstNacionalidad = document.getElementById('ilstnac');
    campCedula = document.getElementById('itxtcedula');
    campNombre = document.getElementById('itxtnombre');
    formu = document.getElementById('formUsuJefPnf');
    if(event.keyCode == 13){
        if(campCedula.value != ''){
            cedula = lstNacionalidad.value+campCedula.value
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'buscarDoce');
            ajax.setVar("cedula",cedula);
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(ajax.response == 1){


                }else{
                    cant = formu.length;
                    for(i=1;i<cant;i++){
                        if(!formu.elements[i].readOnly){
                            formu.elements[i].disabled = false;
                        }
                    }
                    campNombre.focus();
                }
            }
            ajax.onError=function(){alert('Ha ocurrido un error');}
            ajax.runAJAX();
        }else{
            alert('Debe ingresar una Cedula valida');
        }
    }
    
}

function guardarUsuJefPnf(){
    formu = document.getElementById('formUsuJefPnf');
    campClave = document.getElementById('itxtclave');
    campFechNac = document.getElementById('idtxtfechaN');
    btnCalendaFn = document.getElementById('btncalenda');
    campTelf = document.getElementById('itxttelf');
    campFechIni = document.getElementById('idtxtfechaIni');
    campFechFin = document.getElementById('idtxtfechaFin');
    campMail = document.getElementById('itxtemail');
    clave = hex_sha1(campClave.value);
    nroElement = formu.length;
    if(calcular_edad(campFechNac.value)){
        if(valTelf(campTelf)){
            if(val_Email('itxtemail')){
                if(compararFechas2(campFechIni.value, campFechFin.value)){
                    ajax = new sack('../Modelo.php');
                    ajax.setVar("op",'guardarJefeUsu');
                    ajax.setVar("clave",clave);
                    for(i=0; i < nroElement;i++){
                        if(formu.elements[i].type=='text' || formu.elements[i].type=='select-one'){
                            ajax.setVar(i,objForm.elements[i].value);
                        }
                    }
                    ajax.method = "POST";
                    ajax.onCompletion = function(){
                        if(ajax.response == 1){
                            ir('vistas/index.php');
                        }else{
                            alert(ajax.response);
    //                        for(i=1;i<nroElement;i++){
    //                            if(!formu.elements[i].readOnly){
    //                                formu.elements[i].disabled = false;
    //                            }
    //                        }
    //                        campNombre.focus();
                        }
                    }
                    ajax.onError=function(){alert('Ha ocurrido un error');}
                    ajax.runAJAX();
                }else{
                    alert('La fecha de inicio debe ser menor a la final');
                }
            }
        }else{
            alert('El correo electronico ingresado es invalido,\nverifique que posea el siguiente formato\nEjem. sucorreo@dominio.com');
            campMail.value = '';
            campMail.focus();
        }
    }else{
        alert('El Usuario debe ser mayor de 18 años');
        campFechNac.value='';
        btnCalendaFn.focus();
    }
    
}
function limpiar(){
    formu = document.getElementById('formUsuJefPnf');
    nroElement = formu.length;
    for(i=0;i<cant;i++){
        if(!formu.elements[i].readOnly && i !=0 && i !=1){
            formu.elements[i].disabled = true;
        }
        if(formu.elements[i].type=='text' || formu.elements[i].type=='password'){
            formu.elements[i].value='';
        }else if(formu.elements[i].type=='select-one'){
            formu.elements[i].value = -1;
        }
    }
    formu.elements[0].focus();
}
function valLogin(){
    campLogin = document.getElementById('itxtlogin');
    if(campLogin.value != ''){
        ajax = new sack('../Modelo.php');
        ajax.setVar("op",'buscarLogin');
        ajax.setVar("login",campLogin.value);
        ajax.method = "POST";
        ajax.onCompletion = function(){
            if(ajax.response == 1){
                alert('Login registrado, verifique');
                campLogin.value='';
                campLogin.focus();
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        alert('Debe ingresar un login');
        campLogin.focus();
    }
}
//noooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
function activarCampo(){
    campClave = document.getElementById('itxtclave');
    campReclave = document.getElementById('itxtreclave');
    if (campClave.value != ''){
            campReclave.disabled=false;
    }else{
            campReclave.value='';
            campReclave.disabled=true;
    }
}

//function guardarUsuario(){
//    campCedula= document.getElementById('itxtcedula');
//    campNombre=document.getElementById('itxtnombre');
//    campApellido=document.getElementById('itxtapellido');
//    campLogin=document.getElementById('itxtlogin');
//    campClave = document.getElementById('itxtclave');
//    campReclave = document.getElementById('itxtreclave');
//    campNivel=document.getElementById('itxtnivel');
//    
//    if(campClave.value == campReclave.value){
//        clave = hex_sha1(campClave.value);
//        ajax = new sack('../Operaciones.php');
//        ajax.setVar("opcion",'guardar_usuario');
//        ajax.setVar("cedula",campCedula.value);
//        ajax.setVar("nombre",campNombre.value);
//        ajax.setVar("apellido",campApellido.value);
//        ajax.setVar("login",campLogin.value);
//        ajax.setVar("clave",clave);
//        ajax.setVar("nivel",campNivel.value);
//        ajax.method = "POST";
//        ajax.onCompletion = function(){
//            if(ajax.response == 1){
//                alert('Registro ingresado con éxito');
//                ir('index');
//            }else{
//                alert('No se pudo ingresar el registros');
//            }
//        }
//        ajax.onError=function(){alert('Ha ocurrido un error');}
//        ajax.runAJAX();
//    }else{
//        alert('Las claves no coinciden, verifique');
//    }
//}
//
//function valEntrada(){
//    campLogin=document.getElementById('itxtlogine');
//    campClave=document.getElementById('itxtclavee');
//    clave=hex_sha1(campClave.value);
//    ajax = new sack('../Operaciones.php');
//    ajax.setVar("opcion",'validar_entrada');
//    ajax.setVar("login",campLogin.value);
//    ajax.setVar("clave",clave);
//    ajax.method="POST",
//    ajax.onCompletion = function(){
//        if(ajax.response == 1){
//            ir('index');
//        }else{
//            alert('Combinación de Usuario y contraseña inválida');
//        }
//    }
//    ajax.onError=function(){alert('Ha ocurrido un error');}
//    ajax.runAJAX();
//}

//function modificarClave()
//{
//    campClaveActual = document.getElementById('itxtclaveActual');
//    campClave = document.getElementById('itxtclave');
//    campReClave = document.getElementById('itxtreclave');
//    if(campClave.value == campReClave.value){
//        if(confirm('¿Seguro desea modificar su clave?')){
//            clave = hex_sha1(campClave.value);
//            actual = hex_sha1(campClaveActual.value);
//            alert(actual);
//            ajax = new sack('../Operaciones.php');
//            ajax.setVar("opcion",'modificar_clave');
//            ajax.setVar("clavenueva",clave);
//            ajax.setVar("claveactual",actual);
//            ajax.method="POST",
//            ajax.onCompletion = function(){
//                if(ajax.response == 1){
//                    alert('Clave modificada con éxito');
//                    ir('index');
//                }else{
//                    alert('Clave inválida');
//                    campClaveActual.value='';
//                    campClave.value='';
//                    campReClave.value='';
//                    campClaveActual.focus();
//                }
//            }
//            ajax.onError=function(){alert('Ha ocurrido un error');}
//            ajax.runAJAX();
//        }
//    }else{
//        alert('Las claves no coinciden, verifique!');
//        campClave.focus();
//    }
//}