var systemFonts = googleFonts = '';
jQuery(function($){
	// S - CHECK GOOGLE AND SYSTEM FONTS
	if (typeof(system_fonts) != 'undefined' && system_fonts)
		systemFonts = $.parseJSON(system_fonts);
	if (typeof(google_fonts) != 'undefined' && google_fonts)
		googleFonts = $.parseJSON(google_fonts);
	if (systemFonts && googleFonts)
		$('.fontOptions').each(function(){
			if ($(this).val())
				handle_font_style(this);
		});
	// E - CHECK GOOGLE AND SYSTEM FONTS / S - JSON
});
function handle_font_change(i){
	if (!systemFonts || !googleFonts)
		return false;
	var font_name = $(i).val();
	var id = $(i).attr('id').replace('_list', '');
	var font_weight = font_style = 'normal';
	var variant_dom = $('#'+id).empty();
	if (font_name != 0) {
		var cf_key = font_name.replace(/\s/g, '_');
		if (googleFonts.hasOwnProperty(cf_key)) {
			if (!$('#'+id+'_link').size())
				$('head').append('<link id="'+id+'_link" href="" rel="stylesheet" type="text/css">');
			var variant = '';
			var arr_variants = {};
			$.each(googleFonts[cf_key]['variants'], function(i, v){
				arr_variants[v] = v;
			});
			var arr_default = {'700':'700', 'italic':'italic', '700italic':'700italic'};
			$.extend(arr_variants, arr_default);
			$.each(arr_variants, function(i, v){
				var option_dom = $('<option>', {
					value: font_name+':'+(v == 'regular' ? '400' : v),
					text: v
				});
				if (v == 'regular') {
					variant = 'regular';
					option_dom.attr('selected', 'selected');
				}
				variant_dom.append(option_dom);
			});
			if (!variant) {
				variant = googleFonts[cf_key]['variants'][0];
				var font_weight_arr = variant.match(/\d+/g);
				var font_style_arr = variant.match(/[^\d]+/g);
				if (font_weight_arr)
					font_weight = font_weight_arr[0];
				if (font_style_arr)
					font_style = font_style_arr[0];
				if (font_style == 'regular')
					font_style = 'normal';
			}
			$('link#'+id+'_link').attr({href: '//fonts.googleapis.com/css?family='+font_name.replace(/\s/g, '+')+':'+variant});
		} else {
			variant_dom.append($('<option>', {
                value: font_name,
                text: 'Normal'
            })).append($('<option>', {
                value: font_name+':700',
                text: 'Bold'
            })).append($('<option>', {
                value: font_name+':italic',
                text: 'Italic'
            })).append($('<option>', {
                value: font_name+':700italic',
                text: 'Bold & Italic'
            })).append($('<option>', {
                value: font_name+':100',
                text: '100'
            })).append($('<option>', {
                value: font_name+':100italic',
                text: '100 & Italic'
            })).append($('<option>', {
                value: font_name+':300',
                text: '300'
            })).append($('<option>', {
                value: font_name+':300italic',
                text: '300 & Italic'
            })).append($('<option>', {
                value: font_name+':500',
                text: '500'
            })).append($('<option>', {
                value: font_name+':500italic',
                text: '500 & Italic'
            })).append($('<option>', {
                value: font_name+':600',
                text: '600'
            })).append($('<option>', {
                value: font_name+':600italic',
                text: '600 & Italic'
            })).append($('<option>', {
                value: font_name+':800',
                text: '800'
            })).append($('<option>', {
                value: font_name+':800italic',
                text: '800 & Italic'
            })).append($('<option>', {
                value: font_name+':900',
                text: '900'
            })).append($('<option>', {
                value: font_name+':900italic',
                text: '900 & Italic'
            }));
		}
	} else {
		font_name = 'inherit';
		variant_dom.append($('<option>', {
			value: font_name,
			text: 'Normal'
		})).append($('<option>', {
			value: font_name+':700',
			text: 'Bold'
		})).append($('<option>', {
			value: font_name+':italic',
			text: 'Italic'
		})).append($('<option>', {
			value: font_name+':700italic',
			text: 'Bold & Italic'
		}));
	}
	$('#'+id+'_preview').css({'font-family': font_name, 'font-weight': font_weight, 'font-style': font_style});
};
function handle_font_style(i){
	var variant = $(i).val();
	var selected_arr = variant.split(':');
	var id = $(i).attr('id');
	var font_weight = font_style = 'normal';
	if (selected_arr[1]) {
		var font_weight_arr = selected_arr[1].match(/\d+/g);
		var font_style_arr = selected_arr[1].match(/[^\d]+/g);
		if (font_weight_arr)
			font_weight = font_weight_arr[0];
		if (font_style_arr)
			font_style = font_style_arr[0];
		if (font_style == 'regular')
			font_style = 'normal';
	}
	var cf_key = selected_arr[0].replace(/\s/g, '_');
	if (googleFonts.hasOwnProperty(cf_key) && selected_arr[0] != 'inherit') {
		var arr_variants = [];
		$.each(googleFonts[cf_key]['variants'], function(i, v){
			arr_variants.push(v);
		});
		if ($.inArray(selected_arr[1], arr_variants) < 0)
			variant = selected_arr[0];
		if (!$('#'+id+'_link').size())
			$('head').append('<link id="'+id+'_link" href="" rel="stylesheet" type="text/css">');
		$('link#'+id+'_link').attr({href: '//fonts.googleapis.com/css?family='+variant.replace(/\s/g, '+')});
	}
	$('#'+id+'_preview').css({'font-family': selected_arr[0], 'font-weight': font_weight, 'font-style': font_style});
};