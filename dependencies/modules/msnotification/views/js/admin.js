jQuery(function($){
	$('#nav-bar a').click(function(){
		$(this).parent().addClass('active_tab').siblings().removeClass('active_tab');
		$('#msnotification_form .panel').removeClass('selected');
		var fieldset_attr = $(this).attr('data-fieldset').split(',');
		$.each(fieldset_attr, function(i, v){
			$('.panel[id^="fieldset_'+v+'"]').each(function(){
				var id = $(this).attr('id').replace('fieldset_', '');
				if (parseInt(id) == v)
					$(this).addClass('selected');
			});
		});
	});
	$('#nav-bar a[data-fieldset="0"]').trigger('click');
	var send_message = $('#send_message');
	var id = '';
	$.each(languages, function(i, v){
		if (v.is_default == 1) {
			id = v.id_lang;
			if ($('#title_'+id).val() == '' || $('#body_'+id).val() == '')
				send_message.attr('disabled', 'disabled');
		}
	});
	$('#title_'+id+', #body_'+id).keyup(function(){
		var title = $('#title_'+id).val();
		var body = $('#body_'+id).val();
		if ((title == '' || body == '') && !send_message.is('disabled')) {
			send_message.attr('disabled', 'disabled');
		} else {
			send_message.removeAttr('disabled');
		}
	});
	send_message.click(function(){
		var sending = $(this);
		var btn = sending.html();
		sending.attr('disabled', 'disabled').html('<i class="icon-spinner icon-spin"></i>');
		var data = [];
		var all_langs = $('#all_langs_on').is(':checked');
		$.each(languages, function(i, v){
			var title = $('#title_'+v.id_lang).val();
			var body = $('#body_'+v.id_lang).val();
			if ((title != '' && body != '') || all_langs)
				data.push({
					'id_lang': v.id_lang,
					'is_default': v.is_default,
					'title': title,
					'body': body,
					'url': $('#link_'+v.id_lang).val(),
					'image': $('#img_url_'+v.id_lang).val(),
				});
		});
		$.getJSON(currentIndex+'&configure='+module_name+'&token='+token+'&act=send_message&data='+JSON.stringify(data)+'&all_langs='+all_langs,
			function(j){
				if (j)
					sending.html(btn).removeAttr('disabled');
			}
		);
	});
})