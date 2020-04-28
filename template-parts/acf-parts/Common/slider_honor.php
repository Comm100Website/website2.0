<?php
if( get_row_layout() == 'slider_honor' ) {
wp_enqueue_style('swiper');
wp_enqueue_script('swiper');
	
    echo '<div class="c-content-box c-content-box--bg c-size-xlg promotion rocket-lazyload" style="" data-was-processed="true"><div class="container">';
		echo '<div class="c-center">';
			echo '<h3>'.get_sub_field('title').'</h3><p>'.get_sub_field('subtitle').'</p>';
 		echo '</div>';
                    
        if( have_rows('honor_images') ) {
             
            echo '<div id="certify">';
             
             
                echo '<div class="swiper-container slider_honor hidden-xs"><div class="swiper-wrapper">';
              
              
                while ( have_rows('honor_images') ) { the_row();
                     echo '<div class="swiper-slide"><img class="img-responsive center-block" style="width:300px;" src="' . get_sub_field('image')['url'] . '" /></div>';
                }
                            
                            
                echo '</div></div>';

                echo '<div class="swiper-container slider_honor visible-xs"><div class="swiper-wrapper">';
              
              
                while ( have_rows('honor_images') ) { the_row();
                    echo '<div class="swiper-slide"><img class="img-responsive center-block" style="width:300px;" src="' . get_sub_field('image')['url'] . '" /></div>';
                }
                            
                            
               echo '</div></div>';

               echo '<div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>';
               echo '<div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>';
               echo '</div>';
         }           
                    
                    
                    
                    
                    
                    
                    
                    
                    echo '</div></div>';
                     ?>


<style>
	#certify {
		position: relative;
		width: 100%;
		margin: 0 auto;
	}
	@media screen and (min-width: 767px) {

		#certify .swiper-wrapper {
		    height:unset;
		}

		#certify  .swiper-slide {
			width: 300px !important;
			height: 300px !important;
		}

		
		#certify  .swiper-slide img{
			display:block; 
		   color:#000;

		}

		#certify  .swiper-slide .mask{
		 background: #000;

		}



		#certify  .swiper-slide:not(.swiper-slide-active) img .false{

		-webkit-filter: grayscale(80%);   
		  -moz-filter: grayscale(80%);  
		   -ms-filter: grayscale(80%);   
		  -o-filter: grayscale(80%);     
		     filter: grayscale(80%); 
		  filter: gray;

		    
		}

		#certify  .swiper-slide:not(.swiper-slide-active) .false{


		 filter: blur(1px);
		    
		}
		#certify  .swiper-slide p {
			line-height: 98px;
			padding-top: 0;
			text-align: center;
			color: #636363;
			font-size: 1.1em;
			margin: 0;
		}

		#certify .swiper-pagination {
			width: 100%;
			bottom: 20px;
		}

		#certify .swiper-pagination-bullets .swiper-pagination-bullet {
			margin: 0 5px;
			border: 3px solid #fff;
			background-color: #d5d5d5;
			width: 10px;
			height: 10px;
			opacity: 1;
		}

		#certify .swiper-pagination-bullets .swiper-pagination-bullet-active {
			border: 3px solid #00aadc;
			background-color: #fff;
		}

		#certify .swiper-button-prev {
			left: 50px;
			width: 18px;
			height: 31px;
			background: url(/Images/toggle_arrow.png) no-repeat;
			background-position: 0 0;
			background-size: 100%;
			transform: rotate(180deg) !important;
		    -webkit-transform: rotate(180deg) !important;
		}



		#certify .swiper-button-next {
			right: 50px;
			width: 18px;
			height: 31px;
			background: url(/Images/toggle_arrow.png) no-repeat;
			
			background-size: 100%;

		}
	}

	@media screen and (max-width: 767px) {
		
		#certify .swiper-button-prev {
			
			width: 18px;
			height: 31px;
			background: url(/Images/toggle_arrow.png) no-repeat;
			background-position: 0 0;
			background-size: 100%;
			transform: rotate(180deg) !important;
		    -webkit-transform: rotate(180deg) !important;
		}



		#certify .swiper-button-next {
			
			width: 18px;
			height: 31px;
			background: url(/Images/toggle_arrow.png) no-repeat;
			
			background-size: 100%;

		}
		
	}



</style>

<script>

jQuery.noConflict();
jQuery(document).ready(function($){
	
	
	
	
	certifySwiper = new Swiper('.hidden-xs', {
		
    initialSlide: 49,
	watchSlidesProgress: true,
    slideToClickedSlide: true,
	slidesPerView: 'auto',
	centeredSlides: true,
	loop: true,
	loopedSlides: 100,
	autoplay: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	on: {
		progress: function(progress) {
			for (i = 0; i < this.slides.length; i++) {
				var slide = this.slides.eq(i);
				var slideProgress = this.slides[i].progress;
				modify = 1;
				if (Math.abs(slideProgress) > 1) {
					modify = (Math.abs(slideProgress) - 1) * 0.3 + 1;
				}
				translate = slideProgress * modify * 90 + 'px';
				scale = 1 - Math.abs(slideProgress) / 5;
                if(scale < 0.58){ scale =0;}
				zIndex = 999 - Math.abs(Math.round(10 * slideProgress));
				slide.transform('translateX(' + translate + ') scale(' + scale + ')');
				slide.css('zIndex', zIndex);
				slide.css('opacity', 1);
				if (Math.abs(slideProgress) > 3) {
					slide.css('opacity', 0);
				}
			}
		},
		setTransition: function(transition) {
			for (var i = 0; i < this.slides.length; i++) {
				var slide = this.slides.eq(i)
				slide.transition(transition);
			}

		},
		
	}

})
	
	

	jQuery('#certify .swiper-slide').on('click','',function(){
	    var index = $(this).index();
	    jQuery('.swiper-button-next').click()
	})	
});



</script>
<script>

jQuery.noConflict();
jQuery(document).ready(function($){	
	certifySwiper_phone = new Swiper('#certify1 .visible-xs1', {
    	slidesPerView: 1,
      	spaceBetween: 30,
     	loop: true,     
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	})
});
</script>
 
<!-- Initialize Swiper -->
<script>

jQuery.noConflict();
jQuery(document).ready(function($){
	var swiper = new Swiper('#certify .visible-xs', {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
		},
	});
});
</script>


<?php

                    
}