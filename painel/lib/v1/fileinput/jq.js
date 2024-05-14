(function( $ ){

    $.fn.base64img = function( options ){
        var settings = $.extend({
            //list default here
            base: '#ResultImg',
            src: '#SrcImg',
            bg:'#BgImg'
            
        }, options );

        if(typeof(settings.url) == 'undefined'){
            console.error('Url parameter not exist.');
            return;
        }

        var url = URL.createObjectURL( settings.url ),
            canvas = document.createElement('canvas'),
            ctx = canvas.getContext("2d"),
            img = new Image;

        var updateData = function(dataURL){
            $(settings.base).val(dataURL);
        }

        var updateSrc = function(dataURL){
            $(settings.src).attr("src",dataURL);
        }

        var updateBg = function(dataURL){
            $(settings.bg).css("background-image","url("+dataURL+")");
        }

        img.onload = function() {
            canvas.height = img.height;
            canvas.width = img.width;
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL("image/jpeg");
            updateData(dataURL);
            updateSrc(dataURL);
            updateBg(dataURL);
            //return dataURL;
        }

        img.src = url;
        return this;
    }
}( jQuery ));