/*

		Template Name : Ouppss - Responsive 3 in 1 Newsletter/Error Page/Countdown Page Template
		Author : CRTVMax / Taner Özdemir and Türkay Özdemir  
		Support : support@crtvmax.com
		Web : www.crtvmax.com

		//////////// Javascripts Index   ////////////

		A - Countdown Settings 					on line 18
		B - Mobile Menu Settings 				on line 52
		C - Resize Control For Footer  			on line 64
		D - Newsletter Mailchimp Settings		on line 88

		Please backup first after to changing. Do not remove any script. If you have a problem? Contact me support@crtvmax.com. Thank you for purchasing.

*/
/* Start Countdown Settings */

if($('body').attr('class') == 'countdown') {

$.noRequestAnimationFrame = true;
$(function () {
	var targetDate = new Date("09/22/2014"); 
	$('#countdown').countdown({
		until: targetDate, 
		format: "dHMS",
		layout: '{d<}<div class="clock"><div class="timer day"></div><span id="days">{dn}</span><div class="label">days</div></div>{d>}{h<}<div class="clock"><div class="timer hour"></div><span id="hours">{hnn}</span><div class="label">hours</div></div>{h>}{m<}<div class="clock"><div class="timer minute"></div><span id="minutes">{mnn}</span><div class="label">minutes</div></div>{m>}{s<}<div class="clock"><div class="timer second"></div><span id="seconds">{snn}</span><div class="label">seconds</div><div class="clear"></div></div>{s>}',
		onTick: everySec,
	});
});

function everySec(periods) {
	drawSecond(periods[6] * 100 / 60);
	drawMinute(periods[5] * 100 / 60);
	drawHour(periods[4] * 100 / 24);
	drawDay(periods[3] * 100 / 365);
};

function drawSecond(percent){$('div.second').html('<div class="percent"></div><div id="slice"'+(percent > 50?' class="gt50"':'')+'><div class="pie"></div>'+(percent > 50?'<div class="pie fill"></div>':'')+'</div>');var deg = 360/100*percent;$('.second #slice .pie').css({'-moz-transform':'rotate('+deg+'deg)','-ms-transform':'rotate('+deg+'deg)','-webkit-transform':'rotate('+deg+'deg)','-o-transform':'rotate('+deg+'deg)','transform':'rotate('+deg+'deg)'});}

function drawMinute(percent2){$('div.minute').html('<div class="percent"></div><div id="slice"'+(percent2 > 50?' class="gt50"':'')+'><div class="pie"></div>'+(percent2 > 50?'<div class="pie fill"></div>':'')+'</div>');var deg = 360/100*percent2;$('.minute #slice .pie').css({'-moz-transform':'rotate('+deg+'deg)','-ms-transform':'rotate('+deg+'deg)','-webkit-transform':'rotate('+deg+'deg)','-o-transform':'rotate('+deg+'deg)','transform':'rotate('+deg+'deg)'});}

function drawHour(percent){$('div.hour').html('<div class="percent"></div><div id="slice"'+(percent > 50?' class="gt50"':'')+'><div class="pie"></div>'+(percent > 50?'<div class="pie fill"></div>':'')+'</div>');var deg = 360/100*percent;$('.hour #slice .pie').css({'-moz-transform':'rotate('+deg+'deg)','-ms-transform':'rotate('+deg+'deg)','-webkit-transform':'rotate('+deg+'deg)','-o-transform':'rotate('+deg+'deg)','transform':'rotate('+deg+'deg)'});}

function drawDay(percent){$('div.day').html('<div class="percent"></div><div id="slice"'+(percent > 50?' class="gt50"':'')+'><div class="pie"></div>'+(percent > 50?'<div class="pie fill"></div>':'')+'</div>');var deg = 360/100*percent;$('.day #slice .pie').css({'-moz-transform':'rotate('+deg+'deg)','-ms-transform':'rotate('+deg+'deg)','-webkit-transform':'rotate('+deg+'deg)','-o-transform':'rotate('+deg+'deg)','transform':'rotate('+deg+'deg)'});}

}

/* End Countdown Settings */

/* Mobile Menu Settings */

$('#mobile').live('click', function() {

	$('#mobile_menu').toggleClass('on').toggleClass('off');
	$(this).toggleClass('open').toggleClass('close');
	$('footer').toggleClass('normal').toggleClass('mobile');

});

/* End Of Mobile Menu Settings */

/* Resize Control For Footer */

$(document).ready(function() {

	if($('body').height() < 480) {
		$('footer').css({'position':'relative','bottom':'0px'});
	} else {
		$('footer').css({'position':'fixed','bottom':'0px'});
	}

});

$(window).resize(function() {

	if($('body').height() < 480) {
		$('footer').css({'position':'relative','bottom':'0px'});
	} else {
		$('footer').css({'position':'fixed','bottom':'0px'});
	}

});

/* End Of Resize Control For Footer */

/* Newsletter Mailchimp Settings */

$('#subscribe input[type="button"]').live('click', function() {
	
	$("#subscribe form").validate({
		rules: {
			subscribe_mail: 		{ required:true, email: true }
		},
		messages: {
			subscribe_mail: 		"Required"
		},
		errorElement: "span",
		errorPlacement: function(error, element) {
			element.attr('placeholder',"Required");
			element.css('border','1px solid #F00');
			element.css('background-color','#F00');
		} 
	});
	
	if($("#subscribe form").valid()) {
	 
		$.ajax({  
			url: "subscribe.php",
			type: 'POST',
			data: {
				email: $('#subscribe_mail').attr('value')
			}, 
		  	success: function(data) {
		  	    $('#subscribe p').remove();
				$('#subscribe form').html("<div id='success'><h2>Subscribed !</h2><p>"+data+"</p></div>")  
				.hide()  
				.fadeIn(1500, function() {  
				  $('#subscribe form').append("");  
				});  
		  	},
		  	error: function() {
				$('#subscribe form').html("<div id='error'><h2>Sorry, an error occurred.</h2></div>").css('color', 'red');
			}  
		});  
		
		return false;  

	}
	
});

/* End Of Newsletter Mailchimp Settings */