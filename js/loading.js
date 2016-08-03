
function loadingImg () {
	
        var div = $('<div>',{
            id: 'dialogo2'
        });

        $(div).appendTo('body');
        
        $.fx.speeds._default = 300;
        
       $("#dialogo2").html('<div style="text-align:center"><p><img id="load" src="js/loading/clock.png" /></p> <p><img id="load2" src="js/loading/ajax-loader.gif" /></p> <p style="font-size:13px; color:#4169E1; padding-top:3px;"> Espere un momento. <br/>Esta operación puede tardar unos minutos.</p></div>').dialog({
            modal: true,
            autoOpen: true,
            show: "blind",
            hide: "fade",
            width: 300,
            height: 'auto',
            position:'center',
            title: 'Cargando...',
            draggable: false,
            resizable: false,
            open: function(event, ui) {
            //hide close button.
            $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
            }

        });

        

}


function loadingImgDestroy() {

    $('#dialogo2').dialog("close");
    

}