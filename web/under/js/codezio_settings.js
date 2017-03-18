
/* Changer Settings */
   
	$(document).ready( function() {
		
		$('#style_selector').width($(window).width());
		$('#style_selector').height($(window).height());
	});

	$.cssHooks.backgroundColor = {
	    get: function(elem) {
	        if (elem.currentStyle)
	            var bg = elem.currentStyle["backgroundColor"];
	        else if (window.getComputedStyle)
	            var bg = document.defaultView.getComputedStyle(elem,
	                null).getPropertyValue("background-color");
	        if (bg.search("rgb") == -1)
	            return bg;
	        else {
	            bg = bg.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	            function hex(x) {
	                return ("0" + parseInt(x).toString(16)).slice(-2);
	            }
	            return "#" + hex(bg[1]) + hex(bg[2]) + hex(bg[3]);
	        }
	    }
	}

	$(document).ready( function() {

		$('#colorSelector').ColorPicker({
			color: $("body").css("background-color"),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onSubmit: function(hsb, hex, rgb, el) {
				$('#colorSelector div').css('backgroundColor', '#' + hex);
				$('body').append('<style type="text/css">body {background-color: #'+hex+';}section #search form input[type="text"]:hover {color: #'+hex+' ;}section #search form input[type="text"]:active {border: 1px solid #'+hex+';}section #search form input[type="button"]:hover {color: #'+hex+' ;}section #search form input[type="button"]:active {border: 1px solid #'+hex+';}section #subscribe form input[type="text"]:hover {color: #'+hex+' ;}section #subscribe form input[type="text"]:active {border: 1px solid #'+hex+';}section #subscribe form input[type="button"]:hover {color: #'+hex+' ;}section #subscribe form input[type="button"]:active {border: 1px solid #'+hex+';}footer ul li a:hover {color: #'+hex+' ;}footer #copyright {color: #'+hex+';}input:hover::-webkit-input-placeholder {color: #'+hex+' ;}input:hover:-moz-placeholder {color: #'+hex+';}input:hover:-ms-input-placeholder {color: #'+hex+';}input:focus::-webkit-input-placeholder, input:focus:hover::-webkit-input-placeholder {color: #FFF !important;}input:focus:-moz-placeholder, input:focus:hover:-moz-placeholder {color: #FFF !important;}input:focus:-ms-input-placeholder, input:focus:hover:-ms-input-placeholder {color: #FFF !important;}</style>');
				$(el).ColorPickerHide();
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector div').css('backgroundColor', '#' + hex);
				$('body').append('<style type="text/css">body {background-color: #'+hex+';}section #search form input[type="text"]:hover {color: #'+hex+' ;}section #search form input[type="text"]:active {border: 1px solid #'+hex+';}section #search form input[type="button"]:hover {color: #'+hex+' ;}section #search form input[type="button"]:active {border: 1px solid #'+hex+';}section #subscribe form input[type="text"]:hover {color: #'+hex+' ;}section #subscribe form input[type="text"]:active {border: 1px solid #'+hex+';}section #subscribe form input[type="button"]:hover {color: #'+hex+' ;}section #subscribe form input[type="button"]:active {border: 1px solid #'+hex+';}footer ul li a:hover {color: #'+hex+' ;}footer #copyright {color: #'+hex+';}input:hover::-webkit-input-placeholder {color: #'+hex+' ;}input:hover:-moz-placeholder {color: #'+hex+';}input:hover:-ms-input-placeholder {color: #'+hex+';}input:focus::-webkit-input-placeholder, input:focus:hover::-webkit-input-placeholder {color: #FFF !important;}input:focus:-moz-placeholder, input:focus:hover:-moz-placeholder {color: #FFF !important;}input:focus:-ms-input-placeholder, input:focus:hover:-ms-input-placeholder {color: #FFF !important;}</style>');
			}
		});
		
	});