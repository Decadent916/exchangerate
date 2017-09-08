$(function() {
	$('body').height(window.screen.height);
	var screen_height = $('body').height();
	$('.avr').width($('.avr').height());
	$('.money-text').click(function(){
		$('.money-text').removeClass('select');
		$(this).addClass('select');
	})
	$('.money-text').bind('input propertychange',function(){
		getRate($(this).attr('title'),$(this).val());
	})
	function getRate(countryid, num) {
		var data = {};
		var i;
		data.countryid = countryid;
		data.num = num;
		var jsonStr = JSON.stringify(data);
		$.ajax({
			type: "post",
			url: "php/exchangerate.php",
			async: true,
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'json',
			data: jsonStr,
			success: function(data){
				$.each(data,function(i,item){
					if(i==countryid){
						$('.money-text').eq(i).val(num);
					}else{
						$('.money-text').eq(i).val(item);
					}
				})
			}
		});
	}
})