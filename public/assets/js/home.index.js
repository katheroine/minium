var loop =  {
	
	length : 0,
	
	current : 0,
	
	initialize : function(loop_length) {
		this.length = loop_length;
	},
	
	next : function() {
		this.current = this.current + 1;
		if (this.current === this.length)
		{
			this.current = 0;
		}

		return this.current;
	},
	
	prev : function() {
		this.current = this.current - 1;
		if (this.current < 0)
		{
			this.current = this.length - 1;
		}

		return this.current;
	}
};

var slider = {

	initialize : function() {
		var gallery_slider = $('div#gallery_slider');
		
		gallery_slider.find('img').css('display', 'none');
		gallery_slider.find('img:eq(' + loop.current + ')').css('display', 'block');
	},
	
	forward : function() {
		var gallery_slider = $('div#gallery_slider');
		var current_image = gallery_slider.find('img:eq(' + loop.current + ')');
		var next_image = gallery_slider.find('img:eq(' + loop.next() + ')');
		
		current_image.fadeOut(900, function() { current_image.css('display', 'none'); });
		next_image.fadeIn(900, function() { next_image.css('display', 'block'); });
	},

	backward : function() {
		var gallery_slider = $('div#gallery_slider');
		var current_image = gallery_slider.find('img:eq(' + loop.current + ')');
		var prev_image = gallery_slider.find('img:eq(' + loop.prev() + ')');
		
		current_image.fadeOut(900, function() { current_image.css('display', 'none'); });
		prev_image.fadeIn(900, function() { prev_image.css('display', 'block'); });
	}
};

$(document).ready(function() {
	loop.initialize($('img.slider').size());
	slider.initialize();
	setInterval(function() { slider.forward(); }, 4000);
	
	$('a#next').click(function() {
		slider.forward();
	});
	$('a#prev').click(function() {
		slider.backward();
	});
});