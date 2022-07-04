(function($) {
	'use strict';

	$(document).ready(function() {
    
		let colorBg = document.querySelector('.color_background input');
		let colorFg = document.querySelector('.color_foreground input');
		const colorBgBox = document.querySelector('.color_background .color_box');
		const colorFgBox = document.querySelector('.color_foreground .color_box'); 
    

    // Range Slider
		var selector = '[data-rangeslider]';
		var $element = $(selector);        
		var textContent = ('textContent' in document) ? 'textContent' : 'innerText';

		function valueOutput(element) {
			var value = element.value;
			var output = element.parentNode.getElementsByClassName('output_value')[0] || element.parentNode.parentNode.getElementsByClassName('output_value')[0];                
      output.value = value;
			
		}

		$(document).on('input', 'input[type="range"], ' + selector, function(e) {
			valueOutput(e.target);
		});

		
		$(document).on('input', 'input[data-rangeslider]', function(e) {
			$(selector, e.target.parentNode).rangeslider({
				polyfill: false
			});
		});



		// Basic rangeslider initialization
		$element.rangeslider({			
			polyfill: false,	
			onInit: function() {
				valueOutput(this.$element[0]);
			}
		});

    // Color picker for background color
		const pickr = Pickr.create({
			el: '.color-picker-bg',
			theme: 'nano', // or 'monolith', or 'nano'                   
			defaultRepresentation: 'HEX',
			components: {
				preview: true,
				hue: true,
				interaction: {					
					input: true,					
					save: true
				}
			}
		}).on('save', instance => {      
      colorBg.value = pickr.getColor().toHEXA().toString();  
      colorBgBox.style.backgroundColor = pickr.getColor().toHEXA().toString();      
      pickr.hide();
    });

    // Color picker for forground color
		const pickr1 = Pickr.create({
			el: '.color-picker-fg',
			theme: 'nano', // or 'monolith', or 'nano'                   
			defaultRepresentation: 'HEX',
			components: {
				preview: true,
				hue: true,
				interaction: {
					input: true,
					save: true
				}
			}
		}).on('save', instance => {      
      colorFg.value = pickr.getColor().toHEXA().toString(); 
      colorFgBox.style.backgroundColor = pickr.getColor().toHEXA().toString();     
      pickr.hide();
    });
	}); 

})(jQuery);