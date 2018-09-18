/**
 Core layout handlers and component wrappers
 **/
function setCookies(cookie_name, cookie_value, cookie_expiredays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + cookie_expiredays);
	document.cookie = cookie_name + "=" + escape(cookie_value) + ((cookie_expiredays == null) ? "" : ";expires=" + exdate.toGMTString()) + ";path=/";
}
function getCookies(a) {
	return document.cookie.length > 0 && (c_start = document.cookie.indexOf(a + "="), -1 != c_start) ? (c_start = c_start + a.length + 1, c_end = document.cookie.indexOf(";", c_start), -1 == c_end && (c_end = document.cookie.length), unescape(document.cookie.substring(c_start, c_end))) : ""
}
function getRequest() {
    var url = location.search;
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
}
// BEGIN: Layout Brand
var LayoutBrand = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('body').on('click', '.c-hor-nav-toggler', function () {
				var target = $(this).data('target');
				if($(target).hasClass("c-shown")){
					$(target).removeClass("c-shown");
				}
				else{
					$(".c-mega-menu.c-shown").removeClass("c-shown");
					$(target).addClass("c-shown");
				}
				
			});
		}

	};
}();
// END

// BEGIN: Layout Brand
var LayoutHeaderCart = function () {

	return {
		//main function to initiate the module
		init: function () {
			var cart = $('.c-cart-menu');

			if (cart.size() === 0) {
				return;
			}

			if (App.getViewPort().width < App.getBreakpoint('md')) { // mpbile mode
				$('body').on('click', '.c-cart-toggler', function (e) {
					e.preventDefault();
					e.stopPropagation();
					$('body').toggleClass("c-header-cart-shown");
				});

				$('body').on('click', function (e) {
					if (!cart.is(e.target) && cart.has(e.target).length === 0) {
						$('body').removeClass('c-header-cart-shown');
					}
				});
			} else { // desktop
				$('body').on('hover', '.c-cart-toggler, .c-cart-menu', function (e) {
					$('body').addClass("c-header-cart-shown");
				});

				$('body').on('hover', '.c-mega-menu > .navbar-nav > li:not(.c-cart-toggler-wrapper)', function (e) {
					$('body').removeClass("c-header-cart-shown");
				});

				$('body').on('mouseleave', '.c-cart-menu', function (e) {
					$('body').removeClass("c-header-cart-shown");
				});
			}
		}
	};
}();
// END

// BEGIN: Layout Header
var LayoutHeader = function () {
	var offset = parseInt($('.c-layout-header').attr('data-minimize-offset') > 0 ? parseInt($('.c-layout-header').attr('data-minimize-offset')) : 0);
	var _handleHeaderOnScroll = function () {
		if ($(window).scrollTop() > offset) {
			$("body").addClass("c-page-on-scroll");
		} else {
			$("body").removeClass("c-page-on-scroll");
		}
	}

	var _handleTopbarCollapse = function () {
		$('.c-layout-header .c-topbar-toggler').on('click', function (e) {
			$('.c-layout-header-topbar-collapse').toggleClass("c-topbar-expanded");
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			if ($('body').hasClass('c-layout-header-fixed-non-minimized')) {
				return;
			}

			_handleHeaderOnScroll();
			_handleTopbarCollapse();

			$(window).scroll(function () {
				_handleHeaderOnScroll();
			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutMegaMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			// $('.c-mega-menu').on('click', '.c-toggler', function (e) {
			// 	if (App.getViewPort().width < App.getBreakpoint('md')) {
			// 		e.preventDefault();
			// 		$(this).closest("li").toggleClass("c-open");
			// 	}
			// });

			$('.c-layout-header .c-hor-nav-toggler:not(.c-quick-sidebar-toggler)').on('click', function () {
				$('.c-layout-header').toggleClass('c-mega-menu-shown');

				if ($('body').hasClass('c-layout-header-mobile-fixed')) {
					var height = App.getViewPort().height - $('.c-layout-header').outerHeight(true) - 60;
					$('.c-mega-menu').css('max-height', height);
				}
			});

            if(App.getViewPort().width < App.getBreakpoint('md')){
			    $('.menu-item-has-children > a.c-link.dropdown-toggle').click(function () {
				    var parent = $(this).parent();
				    if (parent.hasClass('c-open')) {
					    parent.removeClass('c-open');
				    } else {
					    parent.addClass('c-open');
				    }
                    return false;
			    });
            }
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutSidebarMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-layout-sidebar-menu > .c-sidebar-menu .c-toggler').on('click', function (e) {
				e.preventDefault();
				$(this).closest('.c-dropdown').toggleClass('c-open');
			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutQuickSearch = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('click', '.c-top-menu .c-search-toggler', function (e) {
				e.preventDefault();

				$('body').addClass('c-layout-quick-search-shown');

				if (App.isIE() === false) {
					$('.c-quick-search > .form-control').focus();
				}
			});

			// mobile mode
			$('.c-layout-header').on('click', '.c-brand .c-search-toggler', function (e) {
				e.preventDefault();

				$('body').addClass('c-layout-quick-search-shown');

				if (App.isIE() === false) {
					$('.c-quick-search > .form-control').focus();
				}
			});

			// handle close icon for mobile and desktop
			$('.c-quick-search').on('click', '> span', function (e) {
				e.preventDefault();
				$('body').removeClass('c-layout-quick-search-shown');
			});
		}
	};
}();
// END

var LayoutCartMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('mouseenter', '.c-mega-menu .c-cart-toggler-wrapper', function (e) {
				e.preventDefault();

				$('.c-cart-menu').addClass('c-layout-cart-menu-shown');

			});

			$('.c-cart-menu, .c-layout-header').on('mouseleave', function (e) {
				e.preventDefault();

				$('.c-cart-menu').removeClass('c-layout-cart-menu-shown');

			});

			// mobile mode
			$('.c-layout-header').on('click', '.c-brand .c-cart-toggler', function (e) {
				e.preventDefault();

				$('.c-cart-menu').toggleClass('c-layout-cart-menu-shown');

			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutQuickSidebar = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('click', '.c-quick-sidebar-toggler', function (e) {
				e.preventDefault();
				e.stopPropagation();

				if ($('body').hasClass("c-layout-quick-sidebar-shown")) {
					$('body').removeClass("c-layout-quick-sidebar-shown");
				} else {
					$('body').addClass("c-layout-quick-sidebar-shown");
				}
			});

			$('.c-layout-quick-sidebar').on('click', '.c-close', function (e) {
				e.preventDefault();

				$('body').removeClass("c-layout-quick-sidebar-shown");
			});

			$('.c-layout-quick-sidebar').on('click', function (e) {
				e.stopPropagation();
			});

			$(document).on('click', '.c-layout-quick-sidebar-shown', function (e) {
				$(this).removeClass("c-layout-quick-sidebar-shown");
			});
		}
	};
}();
// END

// BEGIN: Layout Go To Top
var LayoutGo2Top = function () {

	var handle = function () {
		var currentWindowPosition = $(window).scrollTop(); // current vertical position
		if (currentWindowPosition > 300) {
			$(".c-layout-go2top").show();
		} else {
			$(".c-layout-go2top").hide();
		}
	};

	return {

		//main function to initiate the module
		init: function () {

			handle(); // call headerFix() when the page was loaded

			if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
				$(window).bind("touchend touchcancel touchleave", function (e) {
					handle();
				});
			} else {
				$(window).scroll(function () {
					handle();
				});
			}

			$(".c-layout-go2top").on('click', function (e) {
				e.preventDefault();
				$("html, body").animate({
					scrollTop: 0
				}, 600);
			});
		}

	};
}();
// END: Layout Go To Top

// BEGIN: Onepage Nav
var LayoutOnepageNav = function () {

	var handle = function () {
		var offset;
		var scrollspy;
		var speed;
		var nav;

		$('body').addClass('c-page-on-scroll');
		offset = $('.c-layout-header-onepage').outerHeight(true);
		$('body').removeClass('c-page-on-scroll');

		if ($('.c-mega-menu-onepage-dots').size() > 0) {
			if ($('.c-onepage-dots-nav').size() > 0) {
				$('.c-onepage-dots-nav').css('margin-top', -($('.c-onepage-dots-nav').outerHeight(true) / 2));
			}
			scrollspy = $('body').scrollspy({
				target: '.c-mega-menu-onepage-dots',
				offset: offset
			});
			speed = parseInt($('.c-mega-menu-onepage-dots').attr('data-onepage-animation-speed'));
		} else {
			scrollspy = $('body').scrollspy({
				target: '.c-mega-menu-onepage',
				offset: offset
			});
			speed = parseInt($('.c-mega-menu-onepage').attr('data-onepage-animation-speed'));
		}

		scrollspy.on('activate.bs.scrollspy', function () {
			$(this).find('.c-onepage-link.c-active').removeClass('c-active');
			$(this).find('.c-onepage-link.active').addClass('c-active');
		});

		$('.c-onepage-link > a').on('click', function (e) {
			var section = $(this).attr('href');
			var top = 0;

			if (section !== "#home") {
				top = $(section).offset().top - offset;
			}

			$('html, body').stop().animate({
				scrollTop: top,
			}, speed, 'easeInExpo');

			e.preventDefault();

			if (App.getViewPort().width < App.getBreakpoint('md')) {
				$('.c-hor-nav-toggler').click();
			}
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			handle(); // call headerFix() when the page was loaded
		}

	};
}();
// END: Onepage Nav

// Begin simple onepage nav
var LayoutSimpleOnepageNav = function () {

	var handle = function () {
		var offset = $('.c-layout-header .c-navbar:not(".c-topbar")').outerHeight(true);
		var speed = 700;
		$('.c-navbar-onepage a[href^="#"]').on('click', function (e) {
			var section = $(this).attr('href');
			var top = 0;

			if (section !== "#top") {
				top = $(section).offset().top - offset;
			}

			$(".c-navbar-onepage .c-active").removeClass("c-active");
			$(this).parent().addClass("c-active");	

			$('html, body').stop().animate({
				scrollTop: top,
			}, speed, 'easeInExpo');

			e.preventDefault();

			if (App.getViewPort().width < App.getBreakpoint('md')) {
				//$('.c-hor-nav-toggler').click();
			}
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			handle(); // call headerFix() when the page was loaded
		}

	};
}();
// End simple onepage nav

// BEGIN: Handle Theme Settings
var LayoutThemeSettings = function () {

	var handle = function () {

		$('.c-settings .c-color').on('click', function () {
			var val = $(this).attr('data-color');
			$('#style_theme').attr('href', 'assets/base/css/themes/' + val + '.css');

			$('.c-settings .c-color').removeClass('c-active');
			$(this).addClass('c-active');
		});

		$('.c-setting_header-type').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'fluid') {
				$('.c-layout-header .c-topbar > .container').removeClass('container').addClass('container-fluid');
				$('.c-layout-header .c-navbar > .container').removeClass('container').addClass('container-fluid');
			} else {
				$('.c-layout-header .c-topbar > .container-fluid').removeClass('container-fluid').addClass('container');
				$('.c-layout-header .c-navbar > .container-fluid').removeClass('container-fluid').addClass('container');
			}
			$('.c-setting_header-type').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_header-mode').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'static') {
				$('body').removeClass('c-layout-header-fixed').addClass('c-layout-header-static');
			} else {
				$('body').removeClass('c-layout-header-static').addClass('c-layout-header-fixed');
			}
			$('.c-setting_header-mode').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_font-style').on('click', function () {
			var val = $(this).attr('data-value');

			if (val == 'light') {
				$('.c-font-uppercase').addClass('c-font-uppercase-reset').removeClass('c-font-uppercase');
				$('.c-font-bold').addClass('c-font-bold-reset').removeClass('c-font-bold');

				$('.c-fonts-uppercase').addClass('c-fonts-uppercase-reset').removeClass('c-fonts-uppercase');
				$('.c-fonts-bold').addClass('c-fonts-bold-reset').removeClass('c-fonts-bold');
			} else {
				$('.c-font-uppercase-reset').addClass('c-font-uppercase').removeClass('c-font-uppercase-reset');
				$('.c-font-bold-reset').addClass('c-font-bold').removeClass('c-font-bold-reset');

				$('.c-fonts-uppercase-reset').addClass('c-fonts-uppercase').removeClass('c-fonts-uppercase-reset');
				$('.c-fonts-bold-reset').addClass('c-fonts-bold').removeClass('c-fonts-bold-reset');
			}

			$('.c-setting_font-style').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_megamenu-style').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'dark') {
				$('.c-mega-menu').removeClass('c-mega-menu-light').addClass('c-mega-menu-dark');
			} else {
				$('.c-mega-menu').removeClass('c-mega-menu-dark').addClass('c-mega-menu-light');
			}
			$('.c-setting_megamenu-style').removeClass('active');
			$(this).addClass('active');
		});

	};

	return {

		//main function to initiate the module
		init: function () {

			handle();
		}

	};
}();
// END: Handle Theme Settings

// BEGIN: OwlCarousel
var ContentOwlcarousel = function () {

	var _initInstances = function () {
		$("[data-slider='owl'] .owl-carousel").each(function () {
			var parent = $(this).parent();

			var items;
			var itemsDesktop;
			var itemsDesktopSmall;
			var itemsTablet;
			var itemsTabletSmall;
			var itemsMobile;

			if (parent.data("single-item") == "true") {
				items = 1;
				itemsDesktop = 1;
				itemsDesktopSmall = 1;
				itemsTablet = 1;
				itemsTabletSmall = 1;
				itemsMobile = 1;
			} else {
				items = parent.data('items');
				itemsDesktop = [1199, parent.data('desktop-items') ? parent.data('desktop-items') : items];
				itemsDesktopSmall = [979, parent.data('desktop-small-items') ? parent.data('desktop-small-items') : 3];
				itemsTablet = [768, parent.data('tablet-items') ? parent.data('tablet-items') : 2];
				itemsMobile = [479, parent.data('mobile-items') ? parent.data('mobile-items') : 1];
			}

			$(this).owlCarousel({

				items: items,
				itemsDesktop: itemsDesktop,
				itemsDesktopSmall: itemsDesktopSmall,
				itemsTablet: itemsTablet,
				itemsTabletSmall: itemsTablet,
				itemsMobile: itemsMobile,

				navigation: parent.data("navigation") ? true : false,
				navigationText: false,
				slideSpeed: parent.data('slide-speed'),
				paginationSpeed: parent.data('pagination-speed'),
				singleItem: parent.data("single-item") ? true : false,
				autoPlay: parent.data("auto-play")
			});
		});
	};

	return {

		//main function to initiate the module
		init: function () {

			_initInstances();
		}

	};
}();
// END: OwlCarousel

// BEGIN: ContentCubeLatestPortfolio
var ContentCubeLatestPortfolio = function () {

	var _initInstances = function () {

		// init cubeportfolio
		$('.c-content-latest-works').cubeportfolio({
			filters: '#filters-container',
			loadMore: '#loadMore-container',
			loadMoreAction: 'click',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'quicksand',
			gapHorizontal: 20,
			gapVertical: 23,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1100,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 500,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'zoom',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

			// singlePage popup
			singlePageDelegate: '.cbp-singlePage',
			singlePageDeeplinking: true,
			singlePageStickyNavigation: true,
			singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
			singlePageCallback: function (url, element) {
				// to update singlePage content use the following method: this.updateSinglePage(yourContent)
				var t = this;

				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'html',
					timeout: 5000
				})
					.done(function (result) {
						t.updateSinglePage(result);
					})
					.fail(function () {
						t.updateSinglePage("Error! Please refresh the page!");
					});
			},
		});

		$('#grid-container').cubeportfolio({
			filters: '#filters-container',
			loadMore: '#loadMore-container',
			loadMoreAction: 'click',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'quicksand',
			gapHorizontal: 10,
			gapVertical: 23,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1100,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 500,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: '',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

			// singlePage popup
			singlePageDelegate: '.cbp-singlePage',
			singlePageDeeplinking: true,
			singlePageStickyNavigation: true,
			singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
			singlePageCallback: function (url, element) {
				// to update singlePage content use the following method: this.updateSinglePage(yourContent)
				var t = this;

				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'html',
					timeout: 5000
				})
					.done(function (result) {
						t.updateSinglePage(result);
					})
					.fail(function () {
						t.updateSinglePage("Error! Please refresh the page!");
					});
			},
		});

		$('.c-content-latest-works-fullwidth').cubeportfolio({
			loadMoreAction: 'auto',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'fadeOutTop',
			gapHorizontal: 0,
			gapVertical: 0,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1600,
				cols: 5
			}, {
				width: 1200,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 500,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'zoom',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
		});

	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: ContentCubeLatestPortfolio

// BEGIN: CounterUp
// var ContentCounterUp = function () {

// 	var _initInstances = function () {

// 		// init counter up
// 		$("[data-counter='counterup']").counterUp({
// 			delay: 10,
// 			time: 1000
// 		});
// 	};

// 	return {

// 		//main function to initiate the module
// 		init: function () {
// 			_initInstances();
// 		}

// 	};
// }();
// END: CounterUp

// BEGIN: Fancybox
var ContentFancybox = function () {

	var _initInstances = function () {
		// init fancybox
		$("[data-lightbox='fancybox']").fancybox();
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: Fancybox

// BEGIN: Twitter
var ContentTwitter = function () {

	var _initInstances = function () {
		// init twitter
		if ($(".twitter-timeline")[0]) {
			!function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
				if (!d.getElementById(id)) {
					js = d.createElement(s);
					js.id = id;
					js.src = p + "://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
				}
			}(document, "script", "twitter-wjs");
		}
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: Twitter

//begin featurelist scroll
var featurelistscroll = function(){
	return {
		init: function(){
			var $featurelistsbottom = $(".featurelist-bottom");
			if($featurelistsbottom.length>0){
				var $featurelist_header_administration = $("#featurelist-header-administration");
	            var $featurelist_header_management = $("#featurelist-header-management");
	            var $featurelist_header_operator = $("#featurelist-header-operator");
	            var $featurelist_header_visitor = $("#featurelist-header-visitor");
	            var $featurelist_header_support = $("#featurelist-header-support");

	            var $featurelist_header_administration_offsettop = $featurelist_header_administration.offset().top;
	            var $featurelist_header_management_offsettop = $featurelist_header_management.offset().top;
	            var $featurelist_header_operator_offsettop = $featurelist_header_operator.offset().top;
	            var $featurelist_header_visitor_offsettop = $featurelist_header_visitor.offset().top;
	            var $featurelist_header_support_offsettop = $featurelist_header_support.offset().top;

	            $(window).scroll(function () {
	                $windowscrolltop = $(this).scrollTop();
	                if ($windowscrolltop >= $featurelist_header_administration_offsettop - 81 && $windowscrolltop < $featurelist_header_management_offsettop - 81) {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                    $featurelist_header_administration.addClass("scrolled");
	                }
	                else if ($windowscrolltop >= $featurelist_header_management_offsettop - 81 && $windowscrolltop < $featurelist_header_operator_offsettop - 81) {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                    $featurelist_header_management.addClass("scrolled");
	                }
	                else if ($windowscrolltop >= $featurelist_header_operator_offsettop - 81 && $windowscrolltop < $featurelist_header_visitor_offsettop - 81) {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                    $featurelist_header_operator.addClass("scrolled");
	                }
	                else if ($windowscrolltop >= $featurelist_header_visitor_offsettop - 81 && $windowscrolltop < $featurelist_header_support_offsettop - 81) {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                    $featurelist_header_visitor.addClass("scrolled");
	                }
	                else if ($windowscrolltop >= $featurelist_header_support_offsettop - 81 && $windowscrolltop < $featurelistsbottom.offset().top-121) {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                    $featurelist_header_support.addClass("scrolled");
	                }
	                else {
	                    $(".featurelist-header-container.scrolled").removeClass("scrolled");
	                }
	            });
			}
            
		}
	}
}();
//end featurelist scroll

//begin feature tour scroll
var tourscroll = function(){
	return{
		init: function(){

			var $navbar = $(".nav-bar");
			if($navbar.length>0){

				$(".nav-bar li").on("click", function () {
	                var tabid = $(this).attr("id");
	                var $target = $("." + tabid);
	                var $targetoffsetTop = 0;
	                $targetoffsetTop = $target.offset().top - 110;
	                $("html, body").animate({ scrollTop: $targetoffsetTop }, 0);
            	});

			
	            var $navbar_offsetTop = $navbar.offset().top;
	            var $calltoaction_offsetTop = $(".content-i:last").offset().top;
	            var $navbar_administration_offsetTop = $("#administration").offset().top;
	            var $navbar_management_offsetTop = $("#management").offset().top;
	            var $navbar_operator_offsetTop = $("#operator").offset().top;
	            var $navbar_visitor_offsetTop = $("#visitor").offset().top;
	            $(window).scroll(function () {
	                if ($(this).scrollTop() >= ($navbar_offsetTop - 95) && $(this).scrollTop() <= $calltoaction_offsetTop) {
	                    $navbar.addClass("navbar-fixed");
	                }
	                else {
	                    $navbar.removeClass("navbar-fixed");
	                }

	                if ($(this).scrollTop() <= $navbar_administration_offsetTop || ($(this).scrollTop() > $navbar_administration_offsetTop && $(this).scrollTop() < ($navbar_management_offsetTop - 200))) {
	                    $(".active").removeClass("active");
	                    $("#nav-bar-administration").addClass("active");
	                }
	                else if ($(this).scrollTop() >= ($navbar_administration_offsetTop - 200) && $(this).scrollTop() < ($navbar_operator_offsetTop - 200)) {
	                    $(".active").removeClass("active");
	                    $("#nav-bar-management").addClass("active");
	                }
	                else if ($(this).scrollTop() >= ($navbar_operator_offsetTop - 200) && $(this).scrollTop() < ($navbar_visitor_offsetTop - 200)) {
	                    $(".active").removeClass("active");
	                    $("#nav-bar-operator").addClass("active");
	                }
	                else {
	                    $(".active").removeClass("active");
	                    $("#nav-bar-visitor").addClass("active");
	                }
	            });
			}
			
			
			
		}
	}
}();
//end feature tour scroll

// Main theme initialization
$(document).ready(function () {
	var slider = $('.c-layout-revo-slider .tp-banner');
    var cont = $('.c-layout-revo-slider .tp-banner-container');
    var api = slider.show().revolution(
        {
            delay: 15000,
            startwidth: 1170,
            startheight: App.getViewPort().height,
            navigationType: "hide",
            navigationArrows: "solo",
            touchenabled: "off",
            onHoverStop: "on",
            keyboardNavigation: "off",
            navigationStyle: "circle",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            spinner: "spinner2",
            fullScreen: 'on',
            fullScreenAlignForce: "on",
            fullScreenOffsetContainer: '',
            shadow: 0,
            fullWidth: "off",
            forceFullWidth: "on",
            hideTimerBar: "off",
            hideThumbsOnMobile: "on",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResolution: 0
        });
	

	var sliderfixheight = $('.c-layout-revo-slider .fixheight-banner');
    //var cont = $('.c-layout-revo-slider .tp-banner-container');
    var fixheight = (App.getViewPort().width < App.getBreakpoint('md') ? 1024 : 620);
    var api = sliderfixheight.show().revolution(
    {
        delay: 15000,
        startwidth: 1170,
        startheight: fixheight,
        navigationType: "hide",
        navigationArrows: "solo",
        touchenabled: "on",
        onHoverStop: "on",
        keyboardNavigation: "off",
        navigationStyle: "circle",
        navigationHAlign: "center",
        navigationVAlign: "center",
        fullScreenAlignForce: "off",
        shadow: 0,
        fullWidth: "on",
        fullScreen: "off",
        spinner: "spinner2",
        forceFullWidth: "on",
        hideTimerBar: "on",
        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0,
        videoJsPath: "rs-plugin/videojs/"
    });
	// init layout handlers
	LayoutBrand.init();
	LayoutHeader.init();
	LayoutHeaderCart.init();
	LayoutMegaMenu.init();
	LayoutSidebarMenu.init();
	LayoutQuickSearch.init();
	LayoutCartMenu.init();
	LayoutQuickSidebar.init();
	LayoutGo2Top.init();
	LayoutOnepageNav.init();
	LayoutSimpleOnepageNav.init();
	LayoutThemeSettings.init();

	// init plugin wrappers
	ContentOwlcarousel.init();
	ContentCubeLatestPortfolio.init();
	//ContentCounterUp.init();
	ContentFancybox.init();
	ContentTwitter.init();
	if(App.getViewPort().width >= App.getBreakpoint('sm')){
		
		featurelistscroll.init();
		
		window.setTimeout(function(){
			tourscroll.init();
		}, 3000);
	}
	
	//chat
    $(".achat").click(function() {
        var top = 110;
        if (screen.height < 800) {
            top = 50;
        }
        window.open("https://chatserver.comm100.com/ChatWindow.aspx?planId=1428&visitType=1&byHref=1&partnerId=-1&siteid=10000", "", "height = 570, width = 540, left = 200, top = " + top + ", status = yes, toolbar = no, menubar = no, resizable = yes, location = no, titlebar = no");
    });
    //chat button request callback
    $("#a-requestcallback").click(function () {
        window.location.href = "/livechat/requestcallback.aspx?requesttype=general";
        return false;
    });

    if($("#downloadwhitepaper_username").length){
    	$("#downloadwhitepaper_username").val(getCookies("whitepaper_name"));
    	$("#downloadwhitepaper_email").val(getCookies("whitepaper_email"));
    	$("#downloadwhitepaper_tel").val(getCookies("whitepaper_tel"));
    	$("#downloadwhitepaper_website").val(getCookies("whitepaper_website"));
    }


    $("#formwhitepaper").submit(function(){
     	var data = {};
     	data.whitepaperid = $('#whitepaperid').val();
     	data.whitepaper_username = $('#downloadwhitepaper_username').val();
     	data.whitepaper_email = $('#downloadwhitepaper_email').val();
     	data.whitepaper_tel = $('#downloadwhitepaper_tel').val();
     	data.whitepaper_website = $('#downloadwhitepaper_website').val();
	    data.action = "mail_action";
        $.post('https://www.comm100.com/wp-admin/admin-ajax.php',data, onSuccess);

        var customerdata = {};
        customerdata.whitepaperid = $('#whitepaperid').val();
        customerdata.whitepaper_username = $('#downloadwhitepaper_username').val();
        customerdata.email = $('#downloadwhitepaper_email').val();
	    customerdata.action = "sendemailtocustomer";
        $.ajax({
            url: "https://www.comm100.com/wp-admin/admin-ajax.php",
            data: customerdata,
            type: "POST",
            beforeSend: function () {
                setCookies("whitepaper_name", $('#downloadwhitepaper_username').val(), 365);
                setCookies("whitepaper_email", $('#downloadwhitepaper_email').val(), 365);
                setCookies("whitepaper_tel", $('#downloadwhitepaper_tel').val(), 365);
                setCookies("whitepaper_website", $('#downloadwhitepaper_website').val(), 365);
                document.getElementById("downloadlink").click();
                window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype=" + $('#thankyoupage').val();
            },
            error: function (request) {
            },
            success: function (data) {
            }
        });
        return false;
     //    var customerdata = {};
	    // customerdata.customerEmail = "";
	    // customerdata.action = "sendemailtocustomer";
     //    $.post('https://www.comm100.com/wp-admin/admin-ajax.php',customerdata, onSuccess);
    });
    function onSuccess(results)
    {
        
    }

    //request callback
    var requesttype = getRequest()["requesttype"] == undefined ? "" : getRequest()["requesttype"];
    if($("#requestcallback-desc").length){
    	switch (requesttype) {
            case "selfhosted":
                {
                    $("#requestcallback-desc").html("For On-Premises Comm100 Live Chat");
                    break;
                }
            case "general":
                {
                    $("#requestcallback-desc").html("");
                    break;
                }
            default: break;
        }
    }
    if($("#requestcallback_name").length){
    	$("#requestcallback_name").val(getCookies("whitepaper_name"));
    	$("#requestcallback_email").val(getCookies("whitepaper_email"));
    	$("#requestcallback_tel").val(getCookies("whitepaper_tel"));
    }
    $("#formrequestcallback").submit(function(){
    	var requestcallbackdata = {};
    	requestcallbackdata.requesttype = requesttype;
        requestcallbackdata.requestpage = document.referrer;
        requestcallbackdata.requestcallback_name = $('#requestcallback_name').val();
        requestcallbackdata.requestcallback_email = $('#requestcallback_email').val();
	    requestcallbackdata.requestcallback_tel = $('#requestcallback_tel').val();
	    requestcallbackdata.requestcallback_company = $('#requestcallback_company').val();
	    requestcallbackdata.requestcallback_title = $('#requestcallback_title').val();
	    requestcallbackdata.requestcallback_operators = $('#requestcallback_operators').val();
	    requestcallbackdata.requestcallback_comments = $('#requestcallback_comments').val();
	    requestcallbackdata.action = "requestcallback_action";
        $.ajax({
            url: "https://www.comm100.com/wp-admin/admin-ajax.php",
            data: requestcallbackdata,
            type: "POST",
            beforeSend: function () {
            	$("#btnsubmit").val("Submitting").addClass("submitting").attr("disabled", "disabled");
            },
            error: function (request) {
            	$("#btnsubmit").val("Submit").removeClass("submitting").attr("disabled", "");
            },
            success: function (data) {
            	window.location.href = "/livechat/thankyouforcallback.aspx?type=" + requesttype;
            }
        });
        return false;
    });
    //enterprise request callback
    var frompricing = getRequest()["frompricing"] == undefined ? "" : getRequest()["frompricing"];
    if($("#h1-enterpriserequestcallback").length){
    	switch (frompricing) {
            case "quote":
                {
                    $("#h1-enterpriserequestcallback").html("Request a Quote");
                    break;
                }
            default: break;
        }
    }
    $("#formenterpriserequestdemo").submit(function(){
    	var requestcallbackdata = {};
    	requestcallbackdata.frompricing = getRequest()["frompricing"] == undefined ? "" : getRequest()["frompricing"];;
        requestcallbackdata.requestpage = document.referrer;
        requestcallbackdata.requestcallback_name = $('#requestcallback_name').val();
        requestcallbackdata.requestcallback_email = $('#requestcallback_email').val();
	    requestcallbackdata.requestcallback_tel = $('#requestcallback_tel').val();
	    requestcallbackdata.requestcallback_company = $('#requestcallback_company').val();
	    requestcallbackdata.requestcallback_title = $('#requestcallback_title').val();
	    requestcallbackdata.requestcallback_operators = $('#requestcallback_operators').val();
	    requestcallbackdata.requestcallback_comments = $('#requestcallback_comments').val();
	    requestcallbackdata.action = "enterpriserequestdemo_action";
        $.ajax({
            url: "https://www.comm100.com/wp-admin/admin-ajax.php",
            data: requestcallbackdata,
            type: "POST",
            beforeSend: function () {
            	$("#btnsubmit").val("Submitting").addClass("submitting").attr("disabled", "disabled");
            },
            error: function (request) {
            	$("#btnsubmit").val("Submit").removeClass("submitting").attr("disabled", "");
            },
            success: function (data) {
            	window.location.href = "/livechat/thankyouforcallback.aspx?type=enterprise";
            }
        });
        return false;
    });
    $("#formdedicatedrequestcallback").submit(function(){
    	var requestcallbackdata = {};
        requestcallbackdata.requestpage = document.referrer;
        requestcallbackdata.requestcallback_name = $('#requestcallback_name').val();
        requestcallbackdata.requestcallback_email = $('#requestcallback_email').val();
	    requestcallbackdata.requestcallback_tel = $('#requestcallback_tel').val();
	    requestcallbackdata.requestcallback_company = $('#requestcallback_company').val();
	    requestcallbackdata.requestcallback_title = $('#requestcallback_title').val();
	    requestcallbackdata.requestcallback_operators = $('#requestcallback_operators').val();
	    requestcallbackdata.requestcallback_comments = $('#requestcallback_comments').val();
	    requestcallbackdata.action = "dedicatedrequestcallback_action";
        $.ajax({
            url: "https://www.comm100.com/wp-admin/admin-ajax.php",
            data: requestcallbackdata,
            type: "POST",
            beforeSend: function () {
            	$("#btnsubmit").val("Submitting").addClass("submitting").attr("disabled", "disabled");
            },
            error: function (request) {
            	$("#btnsubmit").val("Submit").removeClass("submitting").attr("disabled", "");
            },
            success: function (data) {
            	window.location.href = "/livechat/thankyouforcallback.aspx?type=dedicated";
            }
        });
        return false;
    });

    $(document).on("click",".download-link",function(){
	    window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype="+$(this).data("source");	
	});
	$(document).on("click",".download-link2",function(){
	    window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype="+$(this).data("source");	
	});

    var whitepapertype = getRequest()["whitepapertype"] == undefined ? "" : getRequest()["whitepapertype"];	
    if(whitepapertype!="" && $("#thankyoufordownload-title").length){
    	switch(whitepapertype){
    		case "buyersguide":{
    			$("#thankyoufordownload-title").html("How to Choose the Best Live Chat Software: A Buyer's Guide");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/how-to-choose-the-best-live-chat-software-a-buyers-guide.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-buyersguide.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-increase-sales.aspx\">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-strategy.aspx\">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-scripts.aspx\">Free Download: Live Chat Scripts to Make Stellar Agents</a></li>");
    			break;
    		}
    		case "chatyourwaytohigherrevenue":{
    			$("#thankyoufordownload-title").html("White Paper: The Top Ten Ways That Live Chat Can Increase Sales");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/comm100-chat-your-way-to-higher-revenue.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-chatyourwaytohigherrevenue.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-scripts.aspx\">Live Chat Scripts to Make Stellar Agents</a></li>"+
                        				  "<li><a href=\"/livechat/resources/structure-website-conversion.aspx\">White Paper: How to Structure Your Website for Better Conversion</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-strategy.aspx\">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>");
    			break;
    		}
    		case "maximumon":{
    			$("#thankyoufordownload-title").html("White Paper: Introducing the Comm100 Live Chat Patent Pending MaximumOn&#8482; Technology");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/Comm100-MaximumOn-Whitepaper.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-maximumon.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-scripts.aspx\">Live Chat Scripts to Make Stellar Agents</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-increase-sales.aspx\">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-strategy.aspx\">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>");
    			break;
    		}
    		case "dynamiclivechatstrategy":{
    			$("#thankyoufordownload-title").html("White Paper: How to Create a Dynamic Live Chat Strategy");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/comm100-how-to-create-a-dynamic-live-chat-strategy.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-dynamiclivechatstrategy.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-increase-sales.aspx\">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-scripts.aspx\">Live Chat Scripts to Make Stellar Agents</a></li>"+
                        				  "<li><a href=\"/blog/live-chat-software-rfp-template.html\">[Free Template] Live Chat Software RFP Questions</a></li>");
    			break;
    		}
    		case "betterconversion":{
    			$("#thankyoufordownload-title").html("White Paper: How to Structure Your Website for Better Conversion");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/comm100-how-to-structure-your-website-for-better-conversion.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-betterconversion.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-scripts.aspx\">Live Chat Scripts to Make Stellar Agents</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-increase-sales.aspx\">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-strategy.aspx\">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>");
    			break;
    		}
    		case "livechatscripts":{
    			$("#thankyoufordownload-title").html("Live Chat Scripts to Make Stellar Agents");
    			$("#whitepaperdownloadlink").attr("href","https://www.comm100.com/doc/comm100-live-chat-scripts-to-make-stellar-agents.pdf");
    			$("#whitepaperdownload-img").attr("src", "https://www.comm100.com/wp-content/uploads/images/thankyou-livechatscripts.png");
    			$("#whitepaperlike").html("<li><a href=\"/livechat/resources/live-chat-increase-sales.aspx\">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>"+
                        				  "<li><a href=\"/livechat/resources/live-chat-strategy.aspx\">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>"+
                        				  "<li><a href=\"/livechat/resources/structure-website-conversion.aspx\">White Paper: How to Structure Your Website for Better Conversion</a></li>");
    			break;
    		}
    		default: break;
    	}
    }

});

