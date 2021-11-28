import 'bootstrap';
import 'owl.carousel';
jQuery(function($){
	if (typeof swiper_options !== 'undefined' && swiper_options.length)
		$.each(swiper_options, function(i, v){
			var key;
			var options = {};
			for (key in v) {
				if (key == 'id')
					continue;
				options[key] = v[key];
			}
			$('#id_group_'+v.id+' .carousel').owlCarousel(options);
			var effect = getAnimationName(),
				outIndex,
				isDragged = false;
			if (effect !== null) {
				$('#id_group_'+v.id+' .carousel').on('change.owl.carousel', function(e){
					outIndex = e.item.index;
				});
				$('#id_group_'+v.id+' .carousel').on('changed.owl.carousel', function(e){
					var inIndex = e.item.index,
						dir = outIndex <= inIndex ? 'Next' : 'Prev';
					var animation = {
						moveIn: {
							item: $('.item', $('#id_group_'+v.id+' .carousel')).eq(inIndex),
							effect: effect+'In'+dir
						},
						moveOut: {
							item: $('.item', $('#id_group_'+v.id+' .carousel')).eq(outIndex),
							effect: effect+'Out'+dir
						},
						run: function(t){
							var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
								animationObj = this[t],
								inOut = t == 'moveIn' ? 'in' : 'out',
								animationClass = 'animated owl-animated-' + inOut + ' ' + animationObj.effect,
								$nav = $('#id_group_'+v.id+' .carousel').find('.prev, .next, .dot, .stage');
							$nav.css('pointerEvents', 'none');
							animationObj.item.stop().addClass(animationClass).one(animationEndEvent, function () {
								animationObj.item.removeClass(animationClass);
								$nav.css('pointerEvents', 'auto');
							});
						}
					};
					if (!isDragged) {
						animation.run('moveOut');
						animation.run('moveIn');
					}
				});
				$('#id_group_'+v.id+' .carousel').on('drag.owl.carousel', function(e){
					isDragged = true;
				});
				$('#id_group_'+v.id+' .carousel').on('dragged.owl.carousel', function(e){
					isDragged = false;
				});
			}
			function getAnimationName(){
				var re = /ms[a-zA-Z0-9\-_]+/i,
					matches = re.exec($('#id_group_'+v.id+' .carousel').attr('class'));
				return matches !== null ? matches[0] : matches;
			}
		});
});