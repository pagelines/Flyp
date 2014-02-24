/* =======================================================
 * Flipping Cards 3D
 * By David Blanco
 *
 * Contact: http://codecanyon.net/user/davidbo90
 *
 * Created: January 2013
 *
 * Copyright (c) 2013, David Blanco. All rights reserved.
 * Released under CodeCanyon License http://codecanyon.net/
 *
 * ======================================================= */


// replace all: fc_ with flyp_

(function($){
	$(document).ready(function(){

		var fallback = false;

		//CHECKS FOR FALLBACK ----------------------->
		function getInternetExplorerVersion()
		// Returns the version of Windows Internet Explorer or a -1
		// (indicating the use of another browser).
		{
		   var rv = -1; // Return value assumes failure.
		   if (navigator.appName == 'Microsoft Internet Explorer')
		   {
		      var ua = navigator.userAgent;
		      var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		      if (re.exec(ua) != null)
		         rv = parseFloat( RegExp.$1 );
		   }

		   var isAtLeastIE11 = !!(navigator.userAgent.match(/Trident/) && !navigator.userAgent.match(/MSIE/));
		   if(isAtLeastIE11){
		   		rv = 11; //if it is IE 11
		   }

		   return rv;
		}

		if( getInternetExplorerVersion() != -1 ){ //IF IS IE
			fallback = true;
		}

		var supports = (function() {
			var   div = document.createElement('div'),
			  vendors = 'Khtml Ms O Moz Webkit'.split(' '),
			      len = vendors.length;

			return function(prop) {
			  if ( prop in div.style ) return true;

			  prop = prop.replace(/^[a-z]/, function(val) {
			     return val.toUpperCase();
			  });

			  while(len--) {
			     if ( vendors[len] + prop in div.style ) {
			        // browser supports box-shadow. Do what you need.
			        // Or use a bang (!) to test if the browser doesn't.
			        return true;
			     }
			  }
			  return false;
			};
		})();

		if ( !supports('backfaceVisibility') ) { //IF IT DOES NOT SUPPORT BACKFACE VISIBILITY
		    fallback = true;
		}

		function supports3d() {
			var div = document.createElement('div'),
				ret = false,
				properties = ['perspectiveProperty', 'WebkitPerspective'];
			for (var i = properties.length - 1; i >= 0; i--){
				ret = ret ? ret : div.style[properties[i]] != undefined;
			};
	        if (ret){
	            var st = document.createElement('style');
	            st.textContent = '@media (-webkit-transform-3d){#test3d{height:3px}}';
	            document.getElementsByTagName('head')[0].appendChild(st);
	            div.id = 'test3d';
	            document.body.appendChild(div);
	            ret = div.offsetHeight === 3;
	            st.parentNode.removeChild(st);
	            div.parentNode.removeChild(div);
	        }
	        return ret;
		}

		is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1 && !!window.chrome;
		is_safari =  navigator.userAgent.toLowerCase().indexOf('safari') > -1 && !window.chrome;

		if(is_chrome || is_safari){ // IF IS CHROME AND DOES NOT SUPPORT 3D
			if( !supports3d() ){
				fallback = true;
			}
		}

		//------------------------------------------------->

		if( fallback ){
			jQuery('div.flyp_card-container').addClass('noCSS3Container');

			jQuery('.flyp_card').addClass('noCSS3Card');

			jQuery('.flyp_card').children('div').addClass('noCSS3Sides');

			jQuery('.flyp_back').hide();
		}


		$('.flyp_over').parents('.flyp_card-container').on('mouseenter',function(){
			$this = $(this);

			if(!$this.hasClass('mouseenter')){
				$this.addClass('mouseenter');
			}

			direction($this.find('.flyp_over'));

		});

		$('.flyp_over').parents('.flyp_card-container').on('mouseleave',function(){
			$this = $(this);

			if($this.hasClass('mouseenter')){
				direction($this.find('.flyp_over'));
			}

		});

		$('.flyp_click').on('click', function(){
			$this = $(this);

			direction($this);

		});

		$('.flyp_card').on('click', '.fcbutton', function(e){
			e.preventDefault();
			$this = $(this);

			direction($this.parents('.flyp_card'));
		});

		var intervals = Array();

		function direction($this, index){

			$this.stop(true, true);
			if($this.data('autoflip') != undefined){
				 intervals[index] = setTimeout(function(){
										direction($this, index);
									}, $this.data('autoflip'));
			}

			//In auto flip feature if it has a mouseover
			if($this.data('mouse') == 'true'){
				return;
			}


			if( fallback ){
				$this.children('div').fadeToggle();
				return;
			}

			if($this.data('direction') === 'right'){

				$this.toggleClass('flyp_flipping-right');

			}else if($this.data('direction') === 'left'){

				$this.toggleClass('flyp_flipping-left');

			}else if($this.data('direction') === 'top'){

				$this.toggleClass('flyp_flipping-top');

			}else if($this.data('direction') === 'bottom'){

				$this.toggleClass('flyp_flipping-bottom');

			}

		}



		//AUTO FLIP FEATURE ----------------------->

		var card = $('.flyp_card[data-autoflip]');

		function start(){

			card.each(function(index){
				$this = $(this);

				(function(c){

						var autoStart = c.data('start');

						if(autoStart == undefined){
							autoStart = c.data('autoflip');
						}

						intervals[index] = setTimeout(function(){
												direction(c, index);
											}, autoStart);

					})($this);

			});
		}

		start();

		var restart = function() {
		    //clear all intervals an start again
		    for(var i=0; i<intervals.length; i++){
		    	clearTimeout(intervals[i]);
		    }

		    card.removeClass('flyp_flipping-right');
		    card.removeClass('flyp_flipping-left');
		    card.removeClass('flyp_flipping-top');
		    card.removeClass('flyp_flipping-bottom');

		    start();
		}

		if (window.addEventListener){
		  window.addEventListener('focus', restart, false);
		} else if (window.attachEvent){
		  window.attachEvent('onfocus', restart);
		}

		card.on('mouseenter', function(){
			$(this).data('mouse', 'true');
		});

		card.on('mouseleave', function(){
			$(this).data('mouse', 'false');
		});



	});
})(jQuery);