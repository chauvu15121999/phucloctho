(function($){
	$.fn.snow = function(options){
		var $flake 			= $('<div id="flake" />').css({'position': 'absolute', 'top': '-50px', 'z-index': '99999999999'}).html('<img src="images/dao.png"/>'),
		documentHeight 	= $(document).height(),
		documentWidth	= $(document).width(),
		defaults		= {
			minSize		: 10,
			maxSize		: 20,
			newOn		: 200,
			flakeColor	: "#FFFFFF"
		},
		options			= $.extend({}, defaults, options);
		var interval		= setInterval( function(){
			var startPositionLeft 	= Math.random() * documentWidth - 30,
			startOpacity		= 0.5 + Math.random(),
			sizeFlake			= options.minSize + Math.random() * options.maxSize,
			endPositionTop		= documentHeight - 40,
			endPositionLeft		= startPositionLeft - 100 + Math.random() * 200,
			durationFall		= documentHeight * 10 + Math.random() * 5000;
			$flake
			.clone()
			.appendTo('body')
			.css(
			{
				left: startPositionLeft,
				opacity: startOpacity,
				'width': sizeFlake,
				color: options.flakeColor
			}
			)
			.animate(
			{
				top: endPositionTop,
				left: endPositionLeft,
				opacity: 0.2
			},
			durationFall,
			'linear',
			function() {
				$(this).remove()
			}
			);
		}, options.newOn);
	};
})(jQuery);