/* IMAGEN DE SUSTITUCION */

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr;for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document;if(d.images){if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments;for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){d.MM_p[j]=new Image;d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;if(!d) d=document;if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document;n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n];for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n);return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments;document.MM_sr=new Array;for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x;if(!x.oSrc) x.oSrc=x.src;x.src=a[i+2];}
}

/* FIN DE IMAGEN DE SUSTITUCION */


function addLoadEvent(func,pos) {
   var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    }else{ 
        window.onload = function() {
          oldonload();
          if(pos != ''){
              func(pos);
          }else{
              func();
          }
        }
    }
}
function letras(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==0)
    {
	return true;
    }
    patron =/[A-Za-zñÑ\s]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function numeros(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==0)
    {
            return true;
    }
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function periodo(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==0)
    {
            return true;
    }
    patron = /[0-9\\-]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function numerosFloat(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==0)
	{
		return true;
	}
   	patron = /[.\d]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function letrasnumeros(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==0)
	{
		return true;
	}
   	patron = /[() \w]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function mayus(cad)
{
	return cad.toUpperCase();
}

function ir(pagina)
{
    location.href='../'+pagina;
}

function valForm(formulario,funcion){
	
    objForm = document.getElementById(formulario);
    nroElement = objForm.length;
    w = false;
    for(i=0;i<nroElement;i++){
        if(objForm.elements[i].id.charAt(0)=='i'){
            
            if(objForm.elements[i].type=='text' || objForm.elements[i].type=='textarea' || objForm.elements[i].type=='password'){
                if(objForm.elements[i].value==''){
                    w=true;
                }else{
                    w=false;
                }
            }else if(objForm.elements[i].type=='select-one'){
                if(objForm.elements[i].value == -1){
                    w=true;
                }else{
                    w=false;
                }
            }
        }
    }
    if(w){
        alert('Debe ingresar los campos obligatorios, verifique');
        objForm.elements[0].focus();
    }else{
        eval(funcion);
        
    }
}

function foco(formu){
    //document.forms[2].elements[el].focus();
    if(document.forms.length > 0) {
      for(var i=0; i < document.forms[0].elements.length; i++) {
        var campo = document.forms[0].elements[i];
        if(campo.type != "hidden") {
          campo.focus();
          break;
        }
      }
    }
}



//recibe la fecha en formato dd/mm/aaaa
function calcular_edad(fecha){

    //calculo la fecha de hoy
    hoy=new Date();

    //calculo la fecha que recibo
    //La descompongo en un array
    var array_fecha = fecha.split("/");
    //si el array no tiene tres partes, la fecha es incorrecta
    if (array_fecha.length!=3)
       return false;

    //compruebo que los ano, mes, dia son correctos
    var anio;
    anio = parseInt(array_fecha[2]);
    var mes;
    mes = array_fecha[1];
    var dia;
    dia = parseInt(array_fecha[0]);
    var anioHoy;
    var mesHoy;
    var diaHoy;
    diaHoy = hoy.getDate();
    mesHoy = parseInt(hoy.getMonth()) + 1;
    anioHoy = hoy.getFullYear();

    if (isNaN(anio))
       return false;

    if (isNaN(mes))
       return false;

    if (isNaN(dia))
       return false;

    var edad = anioHoy - parseInt(anio);
    if (edad > 17){
        if(mesHoy < parseFloat(mes)){
            edad = edad - 1;
        }else if(mesHoy == parseFloat(mes)){
            if(diaHoy < parseInt(dia)){
                edad = edad - 1;
            }
        }
    }else{
        edad = 0;
    }
    return edad;
}

function fechaActual()
{
	var fecha = new Date();
	dia = fecha.getDate();
	mes = (fecha.getMonth() + 1);
	anio = fecha.getFullYear();
	if (dia < 10)
	{
		dia = '0'+fecha.getDate();
	}
	if (mes < 10)
	{
		mes = '0'+(fecha.getMonth()+1);
	}
	hoy = dia+'/'+mes+'/'+anio;
	return hoy;
}

function compararFechas(f1)
{
    f2 = fechaActual();
    dia1=f1.substr(0,2);
    mes1=f1.substr(3,2);
    anio1=f1.substr(6,4);
    dia2=f2.substr(0,2);
    mes2=f2.substr(3,2);
    anio2=f2.substr(6,4);
    if (anio2 == anio1)
    {
        if (mes2 == mes1)
        {
            if (dia2 < dia1)
            {
                return true;
            }else{
                return false;
            }
        }else if (mes2 < mes1){
            return true;
        }else{
            return false;
        }
    }else if (anio2 < anio1){
            return true;
    }else{
            return false;
    }
}

function compararFechas2(f1,f2)
{
    dia1=f1.substr(0,2);
    mes1=f1.substr(3,2);
    anio1=f1.substr(6,4);
    dia2=f2.substr(0,2);
    mes2=f2.substr(3,2);
    anio2=f2.substr(6,4);
    if (anio2 == anio1)
    {
        if (mes2 == mes1)
        {
            if (dia2 >= dia1)
            {
                    return true;
            }else{
                    return false;
            }
        }else if (mes2 > mes1){
                return true;
        }else{
                return false;
        }
    }else if (anio2 > anio1){
            return true;
    }else{
            return false;
    }
}

function val_Email(obj){
    var valor=document.getElementById(obj).value;
    if (valor) {
        if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)) == false) {
               // alert('La dirección email es incorrecta.');
                //valor.focus();
               return false;
                //setTimeout("document.getElementById('"+obj+"').focus()",150);
        }else{
            return true;
        }
     }
}

function valCantidad(obj){
    campCant = document.getElementById(obj);
    var array_cant = campCant.value.split(".");
    if (array_cant.length != 2){
        alert('Debe ingresar 2 decimales');
        campCant.focus();
    }else{
        if(array_cant[1].length != 2){
            alert('Debe ingresar 2 decimales');
            campCant.focus();
        }else{
            return true;
        }
    }
}

function valTelf(objTelf){
    if(objTelf.value != ''){
        if(objTelf.value.length == 11){
            return true;
        }else{
            alert('El Teléfono debe contener 11 dígitos, verifique');
            objTelf.focus();
            objTelf.value='';
            return false;
        }
     }else{
         return true;
     }
}
function seleccionadotablas(id,clase)
{
    if(document.getElementById(id).className!='tabblaClick')
        document.getElementById(id).setAttribute("class", clase);		
} 

function limpiarListaToda(objLista){
//    alert('hola');
    eliminarHijosLista(objLista);
    objLista.options[0] = new Option ('SELECCIONE...','-1',"defaultSelected");
}

function eliminarHijosLista(nodo){
    while(nodo.firstChild)
    {
        nodo.removeChild(nodo.firstChild);
    }
}

function listas(id,codigo,valor,selec)
{
   var nodo = document.createElement('option');
       nodo.setAttribute("value",codigo);
   var nodotxt=document.createTextNode(valor);
        nodo.appendChild(nodotxt); 
        if(selec)
        {
            nodo.setAttribute("selected","selected");            
        }
        nodoexis=document.getElementById(id);
        nodoexis.appendChild(nodo);	
}

    function html_entity_decode( string, quote_style ) {  
        // Convert all HTML entities to their applicable characters    
        //   
        // version: 901.714  
        // discuss at: http://phpjs.org/functions/html_entity_decode  
        // +   original by: john (http://www.jd-tech.net)  
        // +      input by: ger  
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
        // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
        // +   bugfixed by: Onno Marsman  
        // +   improved by: marc andreu  
        // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
        // -    depends on: get_html_translation_table  
        // *     example 1: html_entity_decode('Kevin &amp; van Zonneveld');  
        // *     returns 1: 'Kevin & van Zonneveld'  
        // *     example 2: html_entity_decode('&amp;lt;');  
        // *     returns 2: '&lt;'  
        var histogram = {}, symbol = '', tmp_str = '', entity = '';  
        tmp_str = string.toString();  
          
        if (false === (histogram = get_html_translation_table('HTML_ENTITIES', quote_style))) {  
            return false;  
        }  
      
        // &amp; must be the last character when decoding!  
        delete(histogram['&']);  
        histogram['&'] = '&amp;';  
      
        for (symbol in histogram) {  
            entity = histogram[symbol];  
            tmp_str = tmp_str.split(entity).join(symbol);  
        }  
          
        return tmp_str;  
    }  
    function get_html_translation_table(table, quote_style) {  
        // Returns the internal translation table used by htmlspecialchars and htmlentities    
        //   
        // version: 902.2516  
        // discuss at: http://phpjs.org/functions/get_html_translation_table  
        // +   original by: Philip Peterson  
        // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
        // +   bugfixed by: noname  
        // +   bugfixed by: Alex  
        // +   bugfixed by: Marco  
        // %          note: It has been decided that we're not going to add global  
        // %          note: dependencies to php.js. Meaning the constants are not  
        // %          note: real constants, but strings instead. integers are also supported if someone  
        // %          note: chooses to create the constants themselves.  
        // %          note: Table from http://www.the-art-of-web.com/html/character-codes/  
        // *     example 1: get_html_translation_table('HTML_SPECIALCHARS');  
        // *     returns 1: {'"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;'}  
          
        var entities = {}, histogram = {}, decimal = 0, symbol = '';  
        var constMappingTable = {}, constMappingQuoteStyle = {};  
        var useTable = {}, useQuoteStyle = {};  
          
        useTable      = (table ? table.toUpperCase() : 'HTML_SPECIALCHARS');  
        useQuoteStyle = (quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT');  
          
        // Translate arguments  
        constMappingTable[0]      = 'HTML_SPECIALCHARS';  
        constMappingTable[1]      = 'HTML_ENTITIES';  
        constMappingQuoteStyle[0] = 'ENT_NOQUOTES';  
        constMappingQuoteStyle[2] = 'ENT_COMPAT';  
        constMappingQuoteStyle[3] = 'ENT_QUOTES';  
          
        // Map numbers to strings for compatibilty with PHP constants  
        if (!isNaN(useTable)) {  
            useTable = constMappingTable[useTable];  
        }  
        if (!isNaN(useQuoteStyle)) {  
            useQuoteStyle = constMappingQuoteStyle[useQuoteStyle];  
        }  
          
        if (useQuoteStyle != 'ENT_NOQUOTES') {  
            entities['34'] = '&quot;';  
        }  
      
        if (useQuoteStyle == 'ENT_QUOTES') {  
            entities['39'] = '&#039;';  
        }  
      
        if (useTable == 'HTML_SPECIALCHARS') {  
            // ascii decimals for better compatibility  
            entities['38'] = '&amp;';  
            entities['60'] = '&lt;';  
            entities['62'] = '&gt;';  
        } else if (useTable == 'HTML_ENTITIES') {  
            // ascii decimals for better compatibility  
            entities['38']  = '&amp;';  
            entities['60']  = '&lt;';  
            entities['62']  = '&gt;';  
            entities['160'] = '&nbsp;';  
            entities['161'] = '&iexcl;';  
            entities['162'] = '&cent;';  
            entities['163'] = '&pound;';  
            entities['164'] = '&curren;';  
            entities['165'] = '&yen;';  
            entities['166'] = '&brvbar;';  
            entities['167'] = '&sect;';  
            entities['168'] = '&uml;';  
            entities['169'] = '&copy;';  
            entities['170'] = '&ordf;';  
            entities['171'] = '&laquo;';  
            entities['172'] = '&not;';  
            entities['173'] = '&shy;';  
            entities['174'] = '&reg;';  
            entities['175'] = '&macr;';  
            entities['176'] = '&deg;';  
            entities['177'] = '&plusmn;';  
            entities['178'] = '&sup2;';  
            entities['179'] = '&sup3;';  
            entities['180'] = '&acute;';  
            entities['181'] = '&micro;';  
            entities['182'] = '&para;';  
            entities['183'] = '&middot;';  
            entities['184'] = '&cedil;';  
            entities['185'] = '&sup1;';  
            entities['186'] = '&ordm;';  
            entities['187'] = '&raquo;';  
            entities['188'] = '&frac14;';  
            entities['189'] = '&frac12;';  
            entities['190'] = '&frac34;';  
            entities['191'] = '&iquest;';  
            entities['192'] = '&Agrave;';  
            entities['193'] = '&Aacute;';  
            entities['194'] = '&Acirc;';  
            entities['195'] = '&Atilde;';  
            entities['196'] = '&Auml;';  
            entities['197'] = '&Aring;';  
            entities['198'] = '&AElig;';  
            entities['199'] = '&Ccedil;';  
            entities['200'] = '&Egrave;';  
            entities['201'] = '&Eacute;';  
            entities['202'] = '&Ecirc;';  
            entities['203'] = '&Euml;';  
            entities['204'] = '&Igrave;';  
            entities['205'] = '&Iacute;';  
            entities['206'] = '&Icirc;';  
            entities['207'] = '&Iuml;';  
            entities['208'] = '&ETH;';  
            entities['209'] = '&Ntilde;';  
            entities['210'] = '&Ograve;';  
            entities['211'] = '&Oacute;';  
            entities['212'] = '&Ocirc;';  
            entities['213'] = '&Otilde;';  
            entities['214'] = '&Ouml;';  
            entities['215'] = '&times;';  
            entities['216'] = '&Oslash;';  
            entities['217'] = '&Ugrave;';  
            entities['218'] = '&Uacute;';  
            entities['219'] = '&Ucirc;';  
            entities['220'] = '&Uuml;';  
            entities['221'] = '&Yacute;';  
            entities['222'] = '&THORN;';  
            entities['223'] = '&szlig;';  
            entities['224'] = '&agrave;';  
            entities['225'] = '&aacute;';  
            entities['226'] = '&acirc;';  
            entities['227'] = '&atilde;';  
            entities['228'] = '&auml;';  
            entities['229'] = '&aring;';  
            entities['230'] = '&aelig;';  
            entities['231'] = '&ccedil;';  
            entities['232'] = '&egrave;';  
            entities['233'] = '&eacute;';  
            entities['234'] = '&ecirc;';  
            entities['235'] = '&euml;';  
            entities['236'] = '&igrave;';  
            entities['237'] = '&iacute;';  
            entities['238'] = '&icirc;';  
            entities['239'] = '&iuml;';  
            entities['240'] = '&eth;';  
            entities['241'] = '&ntilde;';  
            entities['242'] = '&ograve;';  
            entities['243'] = '&oacute;';  
            entities['244'] = '&ocirc;';  
            entities['245'] = '&otilde;';  
            entities['246'] = '&ouml;';  
            entities['247'] = '&divide;';  
            entities['248'] = '&oslash;';  
            entities['249'] = '&ugrave;';  
            entities['250'] = '&uacute;';  
            entities['251'] = '&ucirc;';  
            entities['252'] = '&uuml;';  
            entities['253'] = '&yacute;';  
            entities['254'] = '&thorn;';  
            entities['255'] = '&yuml;';  
        } else {  
            throw Error("Table: "+useTable+' not supported');  
            return false;  
        }  
          
        // ascii decimals to real symbols  
        for (decimal in entities) {  
            symbol = String.fromCharCode(decimal);  
            histogram[symbol] = entities[decimal];  
        }  
          
        return histogram;  
    }

function limpiarTabla(contenedor)
{
    mD.limpiaTexto(xGetElementById(contenedor));
}


/*VALIDAR TEXAREA*/

contenido_textarea = "";
//num_caracteres_permitidos = 140;

function valida_longitud(obj, maximo, capa){
    minimo = 1;
    num_caracteres = obj.value.length;
    resto = maximo - num_caracteres;
//    alert('num_carac: '+num_caracteres+'  resto: '+resto);
    if (resto >= minimo){
        contenido_textarea = obj.value;
    }else{
        obj.value = contenido_textarea;
    }
    if (resto <= 10){
        //document.forms[0].caracteres.style.color="#ff0000";
        document.getElementById(capa).style.color="#ff0000";
    }else{
        //document.forms[0].caracteres.style.color="#000000";
        document.getElementById(capa).style.color="#000000";
    }
    cuenta(obj,resto,capa);
}
function cuenta(obj,resto,capa){
    //document.forms[0].caracteres.value=document.forms[0].texto.value.length;
    document.getElementById(capa).innerHTML = resto;
}

/*FIN VALIDAR TEXAREA*/

function limpText(obj){
    if(obj.value == 'Sin observaciones...'){
        obj.value = '';
    }else if(obj.value == ''){
        obj.value = 'Sin observaciones...';
    }
}

function chequearEnter(event){
    if(event.keyCode == 13){
        valForm('login', 'valEntrada()');
    }
}