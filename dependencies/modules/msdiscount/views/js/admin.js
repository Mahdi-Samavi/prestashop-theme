jQuery(function($){
	$('#tabMenu a').click(function(){
		$(this).parent().addClass('active_tab').siblings().removeClass('active_tab');
		$('#msdiscount_form .panel').removeClass('selected');
		var fieldset_attr = $(this).attr('data-fieldset').split(',');
		$.each(fieldset_attr, function(i, v){
			$('.panel[id^="fieldset_'+v+'"]').each(function(){
				var id = $(this).attr('id').replace('fieldset_', '');
				if (parseInt(id) == v)
					$(this).addClass('selected');
			});
		});
	});
	$('#tabMenu a[data-fieldset="0"]').trigger('click');
})