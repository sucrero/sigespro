rifold = '';
sicomold = '';
nombreold = '';
sectorold = '';

function mMunicipiosCon(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomunCon');
    limpiarListaToda(lstMunicipio);
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstParroquia.disabled=true;
    lstComunidad.disabled=true;
    lstSector.disabled=true;
    if(lstEstado.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codEstado",lstEstado.value);
        ajax.setVar("op",'bMunicipios');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaMunCon(lstMunicipio,ajax.response);
                lstMunicipio.disabled=false;
            }else{
                lstEstado.value=-1;
                alert('No existen Municipios para este Estado');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error333333333333333333');}
        ajax.runAJAX();
    }else{
        lstMunicipio.disabled=true;
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaMunCon(objLista,cont){
//    lstMunicipio = document.getElementById('ilstmunicipio');
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
    }
}

function mParroquiasCon(){
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomunCon');
    limpiarListaToda(lstParroquia);
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    lstComunidad.disabled=true;
    lstSector.disabled=true;
    if(lstMunicipio.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codMunicipio",lstMunicipio.value);
        ajax.setVar("op",'bParroquia');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaParCon(lstParroquia,ajax.response);
                lstParroquia.disabled=false;
            }else{
                lstMunicipio.value=-1;
                alert('No existen Parroquias para este Municipio');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error44444444444444444');}
        ajax.runAJAX();
    }else{
        lstParroquia.disabled=true;
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaParCon(objLista,cont){
    lstParroquia = document.getElementById('ilstparroquia');
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
    }
}

function mCuminidadesCon(){
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomunCon');
    limpiarListaToda(lstComunidad);
    limpiarListaToda(lstSector);
    if(lstParroquia.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codParroquia",lstParroquia.value);
        ajax.setVar("op",'bComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaComCon(lstComunidad,ajax.response);
                lstComunidad.disabled=false;
            }else{
                lstParroquia.value=-1;
                alert('No existen Comunidades para esta Parroquia');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error55555555555555555555');}
        ajax.runAJAX();
    }else{
        lstComunidad.disabled=true;
        lstSector.disabled=true;
    }
}

function crearListaComCon(objLista,cont){
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
    }
}

function buscarSectoresCon(){
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSectorComunidad = document.getElementById('ilstsectorcomunCon');
    limpiarListaToda(lstSectorComunidad);
    if(lstComunidad.value!=-1){
        ajax = new sack('../Modelo.php');
        ajax.setVar("codComunidad",lstComunidad.value);
        ajax.setVar("op",'bSectorComunidad');
        ajax.method="POST";
        ajax.onCompletion=function(){
            if(ajax.response != 0){
                crearListaSectorCon(lstSectorComunidad,ajax.response);
                lstSectorComunidad.disabled=false;
            }else{
                lstComunidad.value=-1;
                limpiarListaToda(lstSectorComunidad);
                lstSectorComunidad.disabled=true;
                alert('No existen Sectores para esa comunidad');
            }
        }
        ajax.onError=function(){alert('Ha ocurrido un error');}
        ajax.runAJAX();
    }else{
        limpiarListaToda(lstSectorComunidad);
        lstSectorComunidad.disabled=true;
    }
}

function crearListaSectorCon(objLista,cont){
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

function buscarConsejo(){
    lstSectorComunidad = document.getElementById('ilstsectorcomunCon');
    lstTipo = document.getElementById('ilsttipo');
    ajax = new sack('../Modelo.php');
    ajax.setVar("op",'buscarConsejo');
    ajax.setVar("sector",lstSectorComunidad.value);
    ajax.onCompletion = function(){
        if(ajax.response != 0){
            if(confirm("Existe un Consejo Comunal registrado para este Sector, desea modificarlo?")){
                cargarDatosConsejo(ajax.response);
            }else{
                limpiarConsejo();
            }
        }
        lstTipo.focus(); 
    }
    ajax.onError=function(){alert('Ha ocurrido un error22222');}
    ajax.runAJAX();
}

function cargarDatosConsejo(req){
    datos = eval("("+req+")");
    lstSectorComunidad = document.getElementById('ilstsectorcomunCon');
    campCodigo = document.getElementById('codConsejo');
    lstTipo = document.getElementById('ilsttipo');
    campRif = document.getElementById('itxtrif');
    campSicom = document.getElementById('itxtsicom');
    campNombre = document.getElementById('itxtnombre');
    campFecha = document.getElementById('txtfeceleccion');
    btnGuardar = document.getElementById('btningresarCon');
    btnModificar = document.getElementById('btnmodificarCon');
    btnGuardar.style.display = 'none';
    btnModificar.style.display = 'block';
    sectorold = lstSectorComunidad.value;
    campCodigo.value = datos['idconsejo'];
    lstTipo.value = datos['rifconsejo'].substr(0, 1);
    campRif.value = datos['rifconsejo'].substr(1, 9);
    rifold = datos['rifconsejo'];
    sicomold = campSicom.value = datos['sicomconsejo'];
    nombreold = campNombre.value = html_entity_decode(datos['nomconsejo'],'ENT_QUOTES').toUpperCase();
    campFecha.value = datos['feculteleccion'].substr(8, 2)+'/'+datos['feculteleccion'].substr(5, 2)+'/'+datos['feculteleccion'].substr(0, 4);
}

function guardarConsejo(destino){
    lstTipo = document.getElementById('ilsttipo');
    
    campRif = document.getElementById('itxtrif');
    campSicom = document.getElementById('itxtsicom');
    campNombre = document.getElementById('itxtnombre');
    campFecha = document.getElementById('txtfeceleccion');
    if(campRif.value.length == 9){
        if(!compararFechas(campFecha.value)){
            if(destino == 2){
                lstsector = document.getElementById('ilstsectorcomunCon');
                sector = lstsector.value;
            }else{
                lstsector = document.getElementById('ilstsectorcomunCon');
                sector = lstsector.name;
            }
            
            rif = lstTipo.value+campRif.value;
            ajax = new sack('../Modelo.php');
            ajax.setVar("op",'guardarConsejo');
            ajax.setVar("rif",rif);
            ajax.setVar("sicom",campSicom.value);
            ajax.setVar("nombre",campNombre.value);
            ajax.setVar("fecha",campFecha.value);
            ajax.setVar("sector",sector);
            ajax.method = "POST";
            ajax.onCompletion = function(){
                if(destino == 2){
                    alert('Consejo Comunal ingresado con exito');
                    limpiarConsejo();
                }else{
                    campCon = document.getElementById('txtNomConsejoComun');
                    campCon.value = campNombre.value;
                    closeMessage();
                }
                
            }
            ajax.onError=function(){alert('Ha ocurrido un error77777777777777777');}
            ajax.runAJAX();
        }else{
            alert('La fecha debe ser menor a la actual, verifique');
        }
    }else{
        alert('El numero de R.I.F. debe contener 9 digitos, verifique');
    }
}
function limpiarConsejo(){
    lstEstado = document.getElementById('ilstestado');
    lstMunicipio = document.getElementById('ilstmunicipio');
    lstParroquia = document.getElementById('ilstparroquia');
    lstComunidad = document.getElementById('ilstcomunidad');
    lstSector = document.getElementById('ilstsectorcomunCon');
    lstTipo = document.getElementById('ilsttipo');
    campRif = document.getElementById('itxtrif');
    campSicom = document.getElementById('itxtsicom');
    campNombre = document.getElementById('itxtnombre');
    campFecha = document.getElementById('txtfeceleccion');
    btnGuardar = document.getElementById('btningresarCon');
    btnModificar = document.getElementById('btnmodificarCon');
    
    lstEstado.value = -1;
    lstMunicipio.value = -1;
    lstMunicipio.disabled = true;
    lstParroquia.value = -1;
    lstParroquia.disabled = true;
    lstComunidad.value = -1;
    lstComunidad.disabled = true;
    lstSector.value = -1;
    lstSector.disabled = true;
    lstTipo.value = 'V';
    campRif.value = '';
    campSicom.value = '';
    campNombre.value = '';
    campFecha.value = '';
    btnGuardar.style.display = 'block';
    btnModificar.style.display = 'none';
    lstEstado.focus();

}

function modificarConsejo(destino){
    lstTipo = document.getElementById('ilsttipo');
    lstsector = document.getElementById('ilstsectorcomunCon');
    campRif = document.getElementById('itxtrif');
    campSicom = document.getElementById('itxtsicom');
    campNombre = document.getElementById('itxtnombre');
    campFecha = document.getElementById('txtfeceleccion');
    campCodigo = document.getElementById('codConsejo');
    if(confirm(html_entity_decode("¿Seguro desea modificar este registro?",'ENT_QUOTES'))){
        if(campRif.value.length == 9){
            if(!compararFechas(campFecha.value)){
                rif = lstTipo.value+campRif.value;
                ajax = new sack('../Modelo.php');
                ajax.setVar("op",'modificarConsejo');
                ajax.setVar("rif",rif);
                ajax.setVar("sicom",campSicom.value);
                ajax.setVar("nombre",campNombre.value);
                ajax.setVar("fecha",campFecha.value);
                ajax.setVar("sector",lstsector.value);
                ajax.setVar("rifold",rifold);
                ajax.setVar("sicomold",sicomold);
                ajax.setVar("nombreold",nombreold);
                ajax.setVar("codigo",campCodigo.value);
                ajax.setVar("sectorold",sectorold);
                ajax.method = "POST";
                ajax.onCompletion = function(){
                    alert(ajax.response);
                    if(ajax.response == 1){
                        alert('Consejo Comunal modificado con exito');
                        limpiarConsejo();
                    }else if(ajax.response == 2){
                        alert('El R.I.F. ingresado se encuentra registrado, verifique');
                        lstTipo.value = rifold.substr(0, 1);
                        campRif.value = rifold.substr(1, 9);
                    }else if(ajax.response == 3){
                        alert('El codigo SICOM ingresado se encuentra registrado, verifique');
                        campSicom.value = sicomold;
                    }else if(ajax.response == 4){
                        alert('El nombre ingresado se encuentra registrado, verifique');
                        campNombre.value = nombreold;
                    }else{
                        alert('Exiten un Consejo Comunal registrado para el Sector seleccionado, verifique');
                        lstsector.value = sectorold;
                    }
                }
                ajax.onError=function(){alert('Ha ocurrido un error77777777777777777');}
                ajax.runAJAX();
            }else{
                alert('La fecha debe ser menor a la actual, verifique');
            }
        }else{
            alert('El numero de R.I.F. debe contener 9 digitos, verifique');
        }
    }
}