
function prepareInputsForHints() {

	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
				this.style.background="#FFFF99";
                               
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
				this.style.background="#FFFFFF";
			}
			if(inputs[i].type!="radio") inputs[i].style.border="1px solid #666666";
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[0]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
				this.style.background="#FFFF99";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
				this.style.background="#FFFFFF";
			}
			selects[k].style.border="1px solid #666666";
		}
	}
        // repeat the same tests as above for selects
	var texarea = document.getElementsByTagName("textarea");
	for (var k=0; k<texarea.length; k++){
		if (texarea[k].parentNode.getElementsByTagName("span")[0]) {
			texarea[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
				this.style.background="#FFFF99";
			}
			texarea[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
				this.style.background="#FFFFFF";
			}
			texarea[k].style.border="1px solid #666666";
		}
	}
}


//addLoadEvent(prepareInputsForHints);

/*
 * Asigna a cada inputs la funcion onFocus y onBlur para poder mostrar los tooltips
 * de ayuda contenidos en los span
 */
/*function prepareInputsForHints() {
	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[1]){
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[1].style.display = "inline";
				this.style.background="#CCCCCC";
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function onblur(){
				this.parentNode.getElementsByTagName("span")[1].style.display = "none";
				this.style.background="#FFFFFF";
			}
			if(inputs[i].type!="radio") inputs[i].style.border="1px solid #666666";
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[1]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[1].style.display = "inline";
				this.style.background="#CCCCCC";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[1].style.display = "none";
				this.style.background="#FFFFFF";
			}
			selects[k].style.border="1px solid #666666";
		}
	}
	// repeat the same tests as above for textarea
	var selects = document.getElementsByTagName("textarea");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[1]){
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[1].style.display = "inline";
				this.style.background="#CCCCCC";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[1].style.display = "none";
				this.style.background="#FFFFFF";
			}
			selects[k].style.border="1px solid #666666";
		}
	}
}*/