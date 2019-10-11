(function ($) {
	"use strict";


    // skill bar animation 
	  function initSkillBar() {
	    var goScrolling = function(elem) {
	      var docViewTop = $(window).scrollTop();
	      var docViewBottom = docViewTop + $(window).height();
	      var elemTop = elem.offset().top;
	      var elemBottom = elemTop + elem.height();
	      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	    };
	    $('.progress-consul .bar').data('width', $(this).width()).css({
	      width : 0
	    });
	    $(window).scroll(function() {
	      $('.progress-consul .bar').each(function() {
	        if (goScrolling($(this))) {
	          $(this).css({
	            width : $(this).attr('data-value') + '%'
	          });
	        }
	      });
	    });
	  }



	jQuery(document).ready(function($) {
		/*$('.counter').counterUp({
			delay: 10,
			time: 5000
		});*/

		$('.wpcf7-select').niceSelect();

		initSkillBar();

	});

}(jQuery));	