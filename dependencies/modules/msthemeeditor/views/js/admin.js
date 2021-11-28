jQuery(function($){
	var url = currentIndex+'&configure='+module_name+'&token='+token;
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
	$('#id_tab_index').parents('.form-group').addClass('hide');
	$('.color[id^="c_"]').each(function(){
		var b = $(this).css('background-color');
		var i = $(this).val();
		if (!i) i = 'rgb(0, 0, 0)';
		$(this).css({backgroundColor: i, color: $.fn.mColorPicker.textColor(b)});
	});
	$('#nav-bar a').click(function(){
		$(this).parent().addClass('active_tab').siblings().removeClass('active_tab');
		$('#module_form .panel').removeClass('selected');
		var fieldset_attr = $(this).attr('data-fieldset').split(',');
		$.each(fieldset_attr, function(i, v){
			$('.panel[id^="fieldset_'+v+'"]').each(function(){
				var id = $(this).attr('id').replace('fieldset_', '');
				if (parseInt(id) == v) {
					$(this).addClass('selected');
					$('#id_tab_index').val(v);
				}
			});
		});
	});
	if (typeof(id_tab_index) == 'undefined' || !id_tab_index)
		$('#nav-bar a:first').trigger('click');
	else {
		if ($('#nav-bar a[data-fieldset="'+id_tab_index+'"]').length > 0) {
			$('#nav-bar a[data-fieldset="'+id_tab_index+'"]').trigger('click');
		} else if ($('#nav-bar a[data-fieldset$=",'+id_tab_index+'"]').length) {
			$('#nav-bar a[data-fieldset$=",'+id_tab_index+'"]').trigger('click');
		} else if ($('#nav-bar a[data-fieldset*=",'+id_tab_index+',"]').length) {
			$('#nav-bar a[data-fieldset*=",'+id_tab_index+',"]').trigger('click');
		}
	}
	// S - CREATE CUSTOM(CC)
	var CC = 'input[type="radio"][id^="CC_"]';
	$(CC).each(function(){
		if ($(this).is(':checked'))
			dis_cc(this, false);
		else
			dis_cc(this, true);
	});
	$(CC).parents('.radio').siblings().find('input[type="radio"]').click(function(){
		dis_cc(this, true);
	});
	$(CC).click(function(){
		dis_cc(this, false);
	});
	function dis_cc(i, disabled){
		if (disabled)
			$(i).parents('.form-group').next().find('input[id^="CC_"]').attr('disabled', 'disabled');
		else
			$(i).parents('.form-group').next().find('input[id^="CC_"]').removeAttr('disabled');
	}
	// E - CREATE CUSTOM(CC) / S - FILTER
	var filters = 'select[id$="_filter_mode"]';
	$(filters).each(function(){
		sel_filter(this);
	});
	$(filters).change(function(){
		sel_filter(this);
	});
	// E - FILTER
	$('.form-group label[for^="cin_"][for$="_on"]').click(function(){
		$(this).parents('.form-group').prev().hide();
		$(this).parents('.form-group').next().show();
	});
	$('.form-group label[for^="cin_"][for$="_off"]').click(function(){
		$(this).parents('.form-group').prev().show();
		$(this).parents('.form-group').next().hide();
	});
	$.each(CIN, function(i, v){
		if (typeof(i) == 'undefined' || !v)
			$('input[name="'+i+'"]').parents('.form-group').next().hide();
		else
			$('input[name="'+i+'"]').parents('.form-group').prev().hide();
	});
	$.each(IIE, function(i, v){
		if (v == 1)
			$('input[name="'+i+'"]').parents('.form-group').next().hide();
		else
			$('input[name="'+i+'"]').parents('.form-group').next().show();
	});
	$('.form-group label[for^="iie_"][for$="_on"]').click(function(){
		$(this).parents('.form-group').next().hide();
	});
	$('.form-group label[for^="iie_"][for$="_off"]').click(function(){
		$(this).parents('.form-group').next().show();
		$(this).parents('.form-group').next().next().find('label[for^="iie_cin_"][for$="_on"]').trigger('click');
	});
	$('.form-group label[for^="iie_cin_"][for$="_off"]').click(function(){
		$(this).parents('.form-group').prev().prev().find('label[for^="iie_"][for$="_on"]').trigger('click');
	});
	// S - JSON
	$('.del_img').click(function(){
		var self = $(this);
		var field = self.data('field');
		if (!confirm('آیا مطمئن هستید؟')) {
			$('#sel_pattern').val(0);
			return false;
		}
		$.getJSON(url+'&act=del_img&field='+field,
			function(json){
				if (json.r) {
					self.closest('.form-group').remove();
				} else {
					alert('Error');
				}
			}
		);
		return false;
	});
	$('#del_fonts_imported').click(function(){
		var self = $(this);
		if (!confirm('آیا مطمئن هستید؟')) {
			return false;
		}
		$.getJSON(url+'&act=del_fonts_imported',
			function(json){
				if (json.r) {
					$('select[name$="_font_list"] optgroup[label="Imported Fonts"]').remove();
					self.parent().remove();
				} else {
					alert('Error');
				}
			}
		);
	});
	// E - JSON
});
function sel_filter(i){
	var id = parseInt($(i).val());
	if (id !== 0) {
		$(i).parents('.form-group').find('.row:eq('+id+')').removeClass('hide').siblings('.new').addClass('hide');
	} else
		$(i).parents('.form-group').find('.filter_val').parents('.row').addClass('hide');
};