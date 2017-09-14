$(function() {
	$('body').height(window.screen.height);
	var screen_height = $('body').height();
	$('.avr').width($('.avr').height());
	$('#submit').height($('#submit').width()/2);
	$('#submit').css('border-radius',$('#submit').height()/2);
	$('.money-text').click(function(){
		$('.money-text').removeClass('select');
		$(this).addClass('select');
	})
	$('#submit').click(function(){
		var data = {};
		var i;
		data.rate1 = $('.money-text').eq(0).val();
		data.rate2 = $('.money-text').eq(1).val();
		data.rate3 = $('.money-text').eq(2).val();
		var jsonStr = JSON.stringify(data);
		$.ajax({
			type: "post",
			url: "php/changerate.php",
			async: true,
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'json',
			data: jsonStr,
			success: function(data){
				alert('修改成功');
				console.log(data);
			},
			error:function(){
				console.log('修改失败');
			}
		});
	});
})