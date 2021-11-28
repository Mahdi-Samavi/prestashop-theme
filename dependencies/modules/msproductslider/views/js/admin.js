jQuery(function($){
	$('.owl-carousel').owlCarousel({
		dotsContainer: '#dots-nav-bar',
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 3
			},
			1000: {
				items: 5
			},
			1500: {
				items: 7
			}
		}
	});
	$('#nav-bar a').click(function(){
		$(this).parent().addClass('active_tab').siblings().removeClass('active_tab');
		$('#module_form .panel').removeClass('selected');
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
})