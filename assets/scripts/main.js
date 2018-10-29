/* jshint ignore:start */

function setCookies(h, g, f) {
	var e = new Date();
	e.setDate(e.getDate() + f);
	document.cookie = h + "=" + escape(g) + ((f == null) ? "" : ";expires=" + e.toGMTString()) + ";path=/";
}

function getCookies(a) {
	return document.cookie.length > 0 && (c_start = document.cookie.indexOf(a + "="), -1 != c_start) ? (c_start = c_start + a.length + 1, c_end = document.cookie.indexOf(";", c_start), -1 == c_end && (c_end = document.cookie.length), unescape(document.cookie.substring(c_start, c_end))) : "";
}

function getRequest() {
	var e = location.search;
	var f = new Object();
	if (e.indexOf("?") != -1) {
		var g = e.substr(1);
		strs = g.split("&");
		for (var h = 0; h < strs.length; h++) {
			f[strs[h].split("=")[0]] = unescape(strs[h].split("=")[1]);
		}
	}
	return f;
}
var App = function() {
	var J = false;
	var D = false;
	var F = false;
	var B = false;
	var x = [];
	var K = function() {
		D = !!navigator.userAgent.match(/MSIE 9.0/);
		F = !!navigator.userAgent.match(/MSIE 10.0/);
		B = navigator.userAgent.indexOf("MSIE ") > -1 || navigator.userAgent.indexOf("Trident/") > -1;
		if (F) {
			jQuery("html").addClass("ie10");
		}
		if (D) {
			jQuery("html").addClass("ie9");
		}
		if (B) {
			jQuery("html").addClass("ie");
		}
	};
	var E = function() {
		for (var b = 0; b < x.length; b++) {
			var a = x[b];
			a.call();
		}
	};
	var C = function() {
		jQuery("[data-auto-height]").each(function() {
			var b = jQuery(this);
			var c = jQuery("[data-height]", b);
			var d = 0;
			var e = b.attr("data-mode");
			var a = parseInt(b.attr("data-offset") ? b.attr("data-offset") : 0);
			c.each(function() {
				if (jQuery(this).attr("data-height") == "height") {
					jQuery(this).css("height", "");
				} else {
					jQuery(this).css("min-height", "");
				}
				var f = (e == "base-height" ? jQuery(this).outerHeight() : jQuery(this).outerHeight(true));
				if (f > d) {
					d = f;
				}
			});
			d = d + a;
			c.each(function() {
				if (jQuery(this).attr("data-height") == "height") {
					jQuery(this).css("height", d);
				} else {
					jQuery(this).css("min-height", d);
				}
			});
			if (b.attr("data-related")) {
				jQuery(b.attr("data-related")).css("height", b.height());
			}
		});
	};
	var u = function() {
		var a;
		jQuery(window).resize(function() {
			if (a) {
				clearTimeout(a);
			}
			a = setTimeout(function() {
				E();
			}, 50);
		});
	};
	var y = function() {
		jQuery("body").on("click", ".c-checkbox > label, .c-radio > label", function() {
			var a = jQuery(this);
			var b = jQuery(this).children("span:first-child");
			b.addClass("inc");
			var c = b.clone(true);
			b.before(c);
			jQuery("." + b.attr("class") + ":last", a).remove();
		});
	};
	var L = function() {
		jQuery("body").on("shown.bs.collapse", ".accordion.scrollable", function(a) {
			Jango.scrollTo(jQuery(a.target));
		});
	};
	var H = function() {
		if (location.hash) {
			var a = encodeURI(location.hash.substr(1));
			jQuery('a[href="#' + a + '"]').parents(".tab-pane:hidden").each(function() {
				var b = jQuery(this).attr("id");
				jQuery('a[href="#' + b + '"]').click();
			});
			jQuery('a[href="#' + a + '"]').click();
		}
	};
	var w = function() {
		jQuery("body").on("hide.bs.modal", function() {
			if (jQuery(".modal:visible").size() > 1 && jQuery("html").hasClass("modal-open") === false) {
				jQuery("html").addClass("modal-open");
			} else {
				if (jQuery(".modal:visible").size() <= 1) {
					jQuery("html").removeClass("modal-open");
				}
			}
		});
		jQuery("body").on("show.bs.modal", ".modal", function() {
			if (jQuery(this).hasClass("modal-scroll")) {
				jQuery("body").addClass("modal-open-noscroll");
			}
		});
		jQuery("body").on("hide.bs.modal", ".modal", function() {
			jQuery("body").removeClass("modal-open-noscroll");
		});
		jQuery("body").on("hidden.bs.modal", ".modal:not(.modal-cached)", function() {
			jQuery(this).removeData("bs.modal");
		});
	};
	var G = function() {
		jQuery(".tooltips").tooltip();
	};
	var v = function() {
		jQuery("body").on("click", ".dropdown-menu.hold-on-click", function(a) {
			a.stopPropagation();
		});
	};
	var z = function() {
		jQuery("body").on("click", '[data-close="alert"]', function(a) {
			jQuery(this).parent(".alert").hide();
			jQuery(this).closest(".note").hide();
			a.preventDefault();
		});
		jQuery("body").on("click", '[data-close="note"]', function(a) {
			jQuery(this).closest(".note").hide();
			a.preventDefault();
		});
		jQuery("body").on("click", '[data-remove="note"]', function(a) {
			jQuery(this).closest(".note").remove();
			a.preventDefault();
		});
	};
	var N = function() {
		jQuery('[data-hover="dropdown"]').not(".hover-initialized").each(function() {
			jQuery(this).dropdownHover();
			jQuery(this).addClass("hover-initialized");
		});
	};
	var I;
	var A = function() {
		jQuery(".popovers").popover();
		jQuery(document).on("click.bs.popover.data-api", function(a) {
			if (I) {
				I.popover("hide");
			}
		});
	};
	var M = function() {
		if (D || F) {
			jQuery("input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)").each(function() {
				var a = jQuery(this);
				if (a.val() === "" && a.attr("placeholder") !== "") {
					a.addClass("placeholder").val(a.attr("placeholder"));
				}
				a.focus(function() {
					if (a.val() == a.attr("placeholder")) {
						a.val("");
					}
				});
				a.blur(function() {
					if (a.val() === "" || a.val() == a.attr("placeholder")) {
						a.val(a.attr("placeholder"));
					}
				});
			});
		}
	};
	return {
		init: function() {
			C();
			this.addResizeHandler(C);
			K();
			u();
			y();
			z();
			v();
			H();
			G();
			A();
			L();
			w();
			M();
		},
		changeLogo: function(b) {
			var a = "../assets/jango/img/layout/logos/" + b + ".png";
			jQuery(".c-brand img.c-desktop-logo").attr("src", a);
		},
		setLastPopedPopover: function(a) {
			I = a;
		},
		addResizeHandler: function(a) {
			x.push(a);
		},
		runResizeHandlers: function() {
			E();
		},
		scrollTo: function(b, c) {
			var a = (b && b.size() > 0) ? b.offset().top : 0;
			if (b) {
				if (jQuery("body").hasClass("page-header-fixed")) {
					a = a - jQuery(".page-header").height();
				}
				a = a + (c ? c : -1 * b.height());
			}
			jQuery("html,body").animate({
				scrollTop: a
			}, "slow");
		},
		scrollTop: function() {
			Jango.scrollTo();
		},
		initFancybox: function() {
			handleFancybox();
		},
		getActualVal: function(a) {
			a = jQuery(a);
			if (a.val() === a.attr("placeholder")) {
				return "";
			}
			return a.val();
		},
		getURLParameter: function(b) {
			var d = window.location.search.substring(1),
				c, e, a = d.split("&");
			for (c = 0; c < a.length; c++) {
				e = a[c].split("=");
				if (e[0] == b) {
					return unescape(e[1]);
				}
			}
			return null;
		},
		isTouchDevice: function() {
			try {
				document.createEvent("TouchEvent");
				return true;
			} catch (a) {
				return false;
			}
		},
		getViewPort: function() {
			var a = window,
				b = "inner";
			if (!("innerWidth" in window)) {
				b = "client";
				a = document.documentElement || document.body;
			}
			return {
				width: a[b + "Width"],
				height: a[b + "Height"]
			};
		},
		getUniqueID: function(a) {
			return "prefix_" + Math.floor(Math.random() * (new Date()).getTime());
		},
		isIE: function() {
			return B;
		},
		isIE9: function() {
			return D;
		},
		isIE10: function() {
			return F;
		},
		getBreakpoint: function(b) {
			var a = {
				xs: 480,
				sm: 768,
				md: 992,
				lg: 1200
			};
			return a[b] ? a[b] : 0;
		}
	};
}();
var revealAnimate = function() {
	var b = function() {
		wow = new WOW({
			animateClass: "animated",
			offset: 100,
			live: true,
			mobile: false
		});
	};
	return {
		init: function() {
			b();
		}
	};
}();
var LayoutBrand = function() {
	return {
		init: function() {
			    jQuery("body").on("click", ".c-hor-nav-toggler", function() {
                    jQuery(this).toggleClass('c-hor-nav-toggler--opened');
				var b = jQuery(this).data("target");
				if (jQuery(b).hasClass("c-shown")) {
					jQuery(b).removeClass("c-shown");
				} else {
					jQuery(".c-mega-menu.c-shown").removeClass("c-shown");
					jQuery(b).addClass("c-shown");
				}
			});
		}
	};
}();
var LayoutHeaderCart = function() {
	return {
		init: function() {
			var b = jQuery(".c-cart-menu");
			if (b.size() === 0) {
				return;
			}
			if (App.getViewPort().width < App.getBreakpoint("md")) {
				jQuery("body").on("click", ".c-cart-toggler", function(a) {
					a.preventDefault();
					a.stopPropagation();
					jQuery("body").toggleClass("c-header-cart-shown");
				});
				jQuery("body").on("click", function(a) {
					if (!b.is(a.target) && b.has(a.target).length === 0) {
						jQuery("body").removeClass("c-header-cart-shown");
					}
				});
			} else {
				jQuery("body").on("hover", ".c-cart-toggler, .c-cart-menu", function(a) {
					jQuery("body").addClass("c-header-cart-shown");
				});
				jQuery("body").on("hover", ".c-mega-menu > .navbar-nav > li:not(.c-cart-toggler-wrapper)", function(a) {
					jQuery("body").removeClass("c-header-cart-shown");
				});
                jQuery("body").on("mouseleave", ".c-cart-menu", function(a) {
					jQuery("body").removeClass("c-header-cart-shown");
				});
			}
		}
	};
}();
var LayoutHeader = function() {
	var f = parseInt(jQuery(".c-layout-header").attr("data-minimize-offset") > 0 ? parseInt(jQuery(".c-layout-header").attr("data-minimize-offset")) : 0);
	var prevScrollTop = 0;
	var currentScrollTop = 0;
	var mainBarOffsetTop = jQuery('.c-mainbar').offset().top;
	var d = function() {
		currentScrollTop = jQuery(window).scrollTop();

		if (currentScrollTop > mainBarOffsetTop) {
			jQuery("body").addClass("c-page-on-scroll");
		} else {
			jQuery("body").removeClass("c-page-on-scroll");
		}

		if(prevScrollTop < currentScrollTop && currentScrollTop > f) {
			jQuery("body").addClass("c-page-scrollUp");
		} else if (prevScrollTop > currentScrollTop && currentScrollTop > f) {
			jQuery("body").removeClass("c-page-scrollUp");
		}
		prevScrollTop = currentScrollTop;
	};
	var e = function() {
		jQuery(".c-layout-header .c-topbar-toggler").on("click", function(a) {
			jQuery(".c-layout-header-topbar-collapse").toggleClass("c-topbar-expanded");
		});
	};
	return {
		init: function() {
			if (jQuery("body").hasClass("c-layout-header-fixed-non-minimized")) {
				return;
			}
			d();
			e();
			jQuery(window).scroll(function() {
				d();
			});
		}
	};
}();
var LayoutMegaMenu = function() {
	return {
		init: function() {
			jQuery(".c-layout-header .c-hor-nav-toggler:not(.c-quick-sidebar-toggler)").on("click", function() {
				jQuery(".c-layout-header").toggleClass("c-mega-menu-shown");
				if (jQuery("body").hasClass("c-layout-header-mobile-fixed")) {
					var b = App.getViewPort().height - jQuery(".c-layout-header").outerHeight(true) - 60;
					jQuery(".c-mega-menu").css("max-height", b);
				}
			});
			if (App.getViewPort().width < App.getBreakpoint("md")) {
				jQuery(".menu-item-has-children > a.c-link.dropdown-toggle").click(function() {
					var b = jQuery(this).parent();
					if (b.hasClass("c-open")) {
						b.removeClass("c-open");
					} else {
						b.addClass("c-open");
					}
					return false;
				});
			}
		}
	};
}();
var LayoutSidebarMenu = function() {
	return {
		init: function() {
			jQuery(".c-layout-sidebar-menu > .c-sidebar-menu .c-toggler").on("click", function(b) {
				b.preventDefault();
				jQuery(this).closest(".c-dropdown").toggleClass("c-open");
			});
		}
	};
}();
var LayoutQuickSearch = function() {
	return {
		init: function() {
			jQuery(".c-layout-header").on("click", ".c-top-menu .c-search-toggler", function(b) {
				b.preventDefault();
				jQuery("body").addClass("c-layout-quick-search-shown");
				if (App.isIE() === false) {
					jQuery(".c-quick-search > .form-control").focus();
				}
			});
			jQuery(".c-layout-header").on("click", ".c-brand .c-search-toggler", function(b) {
				b.preventDefault();
				jQuery("body").addClass("c-layout-quick-search-shown");
				if (App.isIE() === false) {
					jQuery(".c-quick-search > .form-control").focus();
				}
			});
			jQuery(".c-quick-search").on("click", "> span", function(b) {
				b.preventDefault();
				jQuery("body").removeClass("c-layout-quick-search-shown");
			});
		}
	};
}();
var LayoutCartMenu = function() {
	return {
		init: function() {
			jQuery(".c-layout-header").on("mouseenter", ".c-mega-menu .c-cart-toggler-wrapper", function(b) {
				b.preventDefault();
				jQuery(".c-cart-menu").addClass("c-layout-cart-menu-shown");
			});
			jQuery(".c-cart-menu, .c-layout-header").on("mouseleave", function(b) {
				b.preventDefault();
				jQuery(".c-cart-menu").removeClass("c-layout-cart-menu-shown");
			});
			jQuery(".c-layout-header").on("click", ".c-brand .c-cart-toggler", function(b) {
				b.preventDefault();
				jQuery(".c-cart-menu").toggleClass("c-layout-cart-menu-shown");
			});
		}
	};
}();
var LayoutQuickSidebar = function() {
	return {
		init: function() {
			jQuery(".c-layout-header").on("click", ".c-quick-sidebar-toggler", function(b) {
				b.preventDefault();
				b.stopPropagation();
				if (jQuery("body").hasClass("c-layout-quick-sidebar-shown")) {
					jQuery("body").removeClass("c-layout-quick-sidebar-shown");
				} else {
					jQuery("body").addClass("c-layout-quick-sidebar-shown");
				}
			});
			jQuery(".c-layout-quick-sidebar").on("click", ".c-close", function(b) {
				b.preventDefault();
				jQuery("body").removeClass("c-layout-quick-sidebar-shown");
			});
			jQuery(".c-layout-quick-sidebar").on("click", function(b) {
				b.stopPropagation();
			});
			jQuery(document).on("click", ".c-layout-quick-sidebar-shown", function(b) {
				jQuery(this).removeClass("c-layout-quick-sidebar-shown");
			});
		}
	};
}();
var LayoutGo2Top = function() {
	var b = function() {
		var a = jQuery(window).scrollTop();
		if (a > 300) {
			jQuery(".c-layout-go2top").show();
		} else {
			jQuery(".c-layout-go2top").hide();
		}
	};
	return {
		init: function() {
			b();
			if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
				jQuery(window).bind("touchend touchcancel touchleave", function(a) {
					b();
				});
			} else {
				jQuery(window).scroll(function() {
					b();
				});
			}
			jQuery(".c-layout-go2top").on("click", function(a) {
				a.preventDefault();
				jQuery("html, body").animate({
					scrollTop: 0
				}, 600);
			});
		}
	};
}();
var LayoutOnepageNav = function() {
	var b = function() {
		var f;
		var g;
		var a;
		var h;
		jQuery("body").addClass("c-page-on-scroll");
		f = jQuery(".c-layout-header-onepage").outerHeight(true);
		jQuery("body").removeClass("c-page-on-scroll");
		if (jQuery(".c-mega-menu-onepage-dots").size() > 0) {
			if (jQuery(".c-onepage-dots-nav").size() > 0) {
				jQuery(".c-onepage-dots-nav").css("margin-top", -(jQuery(".c-onepage-dots-nav").outerHeight(true) / 2));
			}
			g = jQuery("body").scrollspy({
				target: ".c-mega-menu-onepage-dots",
				offset: f
			});
			a = parseInt(jQuery(".c-mega-menu-onepage-dots").attr("data-onepage-animation-speed"));
		} else {
			g = jQuery("body").scrollspy({
				target: ".c-mega-menu-onepage",
				offset: f
			});
			a = parseInt(jQuery(".c-mega-menu-onepage").attr("data-onepage-animation-speed"));
		}
		g.on("activate.bs.scrollspy", function() {
			jQuery(this).find(".c-onepage-link.c-active").removeClass("c-active");
			jQuery(this).find(".c-onepage-link.active").addClass("c-active");
		});
		jQuery(".c-onepage-link > a").on("click", function(c) {
			var d = jQuery(this).attr("href");
			var e = 0;
			if (d !== "#home") {
				e = jQuery(d).offset().top - f;
			}
			jQuery("html, body").stop().animate({
				scrollTop: e,
			}, a, "easeInExpo");
			c.preventDefault();
			if (App.getViewPort().width < App.getBreakpoint("md")) {
				jQuery(".c-hor-nav-toggler").click();
			}
		});
	};
	return {
		init: function() {
			b();
		}
	};
}();
var LayoutSimpleOnepageNav = function() {
	var b = function() {
		var d = jQuery('.c-layout-header .c-navbar:not(".c-topbar")').outerHeight(true);
		var a = 700;
		jQuery('.c-navbar-onepage a[href^="#"]').on("click", function(c) {
			var e = jQuery(this).attr("href");
			var h = 0;
			if (e !== "#top") {
				h = jQuery(e).offset().top - d;
			}
			jQuery(".c-navbar-onepage .c-active").removeClass("c-active");
			jQuery(this).parent().addClass("c-active");
			jQuery("html, body").stop().animate({
				scrollTop: h,
			}, a, "easeInExpo");
			c.preventDefault();
			if (App.getViewPort().width < App.getBreakpoint("md")) {}
		});
	};
	return {
		init: function() {
			b();
		}
	};
}();
var ContentOwlcarousel = function() {
	var b = function() {
		jQuery("[data-slider='owl'] .owl-carousel").each(function() {
			var k = jQuery(this).parent();
			var l;
			var m;
			var i;
			var n;
			var j;
			var a;
			if (k.data("single-item") == "true") {
				l = 1;
				m = 1;
				i = 1;
				n = 1;
				j = 1;
				a = 1;
			} else {
				l = k.data("items");
				m = [1199, k.data("desktop-items") ? k.data("desktop-items") : l];
				i = [979, k.data("desktop-small-items") ? k.data("desktop-small-items") : 3];
				n = [768, k.data("tablet-items") ? k.data("tablet-items") : 2];
				a = [479, k.data("mobile-items") ? k.data("mobile-items") : 1];
			}
			jQuery(this).owlCarousel({
				items: l,
				itemsDesktop: m,
				itemsDesktopSmall: i,
				itemsTablet: n,
				itemsTabletSmall: n,
				itemsMobile: a,
				navigation: k.data("navigation") ? true : false,
				navigationText: false,
				slideSpeed: k.data("slide-speed"),
				paginationSpeed: k.data("pagination-speed"),
				singleItem: k.data("single-item") ? true : false,
				autoPlay: k.data("auto-play")
			});
		});
	};
	return {
		init: function() {
			b();
		}
	};
}();
var ContentCubeLatestPortfolio = function() {
	var b = function() {
		jQuery(".c-content-latest-works").cubeportfolio({
			filters: "#filters-container",
			loadMore: "#loadMore-container",
			loadMoreAction: "click",
			layoutMode: "grid",
			defaultFilter: "*",
			animationType: "quicksand",
			gapHorizontal: 20,
			gapVertical: 23,
			gridAdjustment: "responsive",
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
			caption: "zoom",
			displayType: "lazyLoading",
			displayTypeSpeed: 100,
			lightboxDelegate: ".cbp-lightbox",
			lightboxGallery: true,
			lightboxTitleSrc: "data-title",
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
			singlePageDelegate: ".cbp-singlePage",
			singlePageDeeplinking: true,
			singlePageStickyNavigation: true,
			singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
			singlePageCallback: function(a, e) {
				var f = this;
				jQuery.ajax({
					url: a,
					type: "GET",
					dataType: "html",
					timeout: 5000
				}).done(function(c) {
					f.updateSinglePage(c);
				}).fail(function() {
					f.updateSinglePage("Error! Please refresh the page!");
				});
			},
		});
		jQuery("#grid-container").cubeportfolio({
			filters: "#filters-container",
			loadMore: "#loadMore-container",
			loadMoreAction: "click",
			layoutMode: "grid",
			defaultFilter: "*",
			animationType: "quicksand",
			gapHorizontal: 10,
			gapVertical: 23,
			gridAdjustment: "responsive",
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
			caption: "",
			displayType: "lazyLoading",
			displayTypeSpeed: 100,
			lightboxDelegate: ".cbp-lightbox",
			lightboxGallery: true,
			lightboxTitleSrc: "data-title",
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
			singlePageDelegate: ".cbp-singlePage",
			singlePageDeeplinking: true,
			singlePageStickyNavigation: true,
			singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
			singlePageCallback: function(a, e) {
				var f = this;
				jQuery.ajax({
					url: a,
					type: "GET",
					dataType: "html",
					timeout: 5000
				}).done(function(c) {
					f.updateSinglePage(c);
				}).fail(function() {
					f.updateSinglePage("Error! Please refresh the page!");
				});
			},
		});
		jQuery(".c-content-latest-works-fullwidth").cubeportfolio({
			loadMoreAction: "auto",
			layoutMode: "grid",
			defaultFilter: "*",
			animationType: "fadeOutTop",
			gapHorizontal: 0,
			gapVertical: 0,
			gridAdjustment: "responsive",
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
			caption: "zoom",
			displayType: "lazyLoading",
			displayTypeSpeed: 100,
			lightboxDelegate: ".cbp-lightbox",
			lightboxGallery: true,
			lightboxTitleSrc: "data-title",
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
		});
	};
	return {
		init: function() {
			b();
		}
	};
}();
var ContentFancybox = function() {
	var b = function() {
		jQuery("[data-lightbox='fancybox']").fancybox();
	};
	return {
		init: function() {
			b();
		}
	};
}();
var ContentTwitter = function() {
	var b = function() {
		if (jQuery(".twitter-timeline")[0]) {
			! function(i, a, d) {
				var j, l = i.getElementsByTagName(a)[0],
					k = /^http:/.test(i.location) ? "http" : "https";
				if (!i.getElementById(d)) {
					j = i.createElement(a);
					j.id = d;
					j.src = k + "://platform.twitter.com/widgets.js";
					l.parentNode.insertBefore(j, l);
				}
			}(document, "script", "twitter-wjs");
		}
	};
	return {
		init: function() {
			b();
		}
	};
}();
var featurelistscroll = function() {
	return {
		init: function() {
			var s = jQuery(".featurelist-bottom");
			if (s.length > 0) {
				var t = jQuery("#featurelist-header-administration");
				var l = jQuery("#featurelist-header-management");
				var r = jQuery("#featurelist-header-operator");
				var p = jQuery("#featurelist-header-visitor");
				var m = jQuery("#featurelist-header-support");
				var v = t.offset().top;
				var u = l.offset().top;
				var n = r.offset().top;
				var q = p.offset().top;
				var o = m.offset().top;
				jQuery(window).scroll(function() {
					var windowscrolltop = jQuery(this).scrollTop();
					if (windowscrolltop >= v - 81 && windowscrolltop < u - 81) {
						jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
						t.addClass("scrolled");
					} else {
						if (windowscrolltop >= u - 81 && windowscrolltop < n - 81) {
							jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
							l.addClass("scrolled");
						} else {
							if (windowscrolltop >= n - 81 && windowscrolltop < q - 81) {
								jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
								r.addClass("scrolled");
							} else {
								if (windowscrolltop >= q - 81 && windowscrolltop < o - 81) {
									jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
									p.addClass("scrolled");
								} else {
									if (windowscrolltop >= o - 81 && windowscrolltop < s.offset().top - 121) {
										jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
										m.addClass("scrolled");
									} else {
										jQuery(".featurelist-header-container.scrolled").removeClass("scrolled");
									}
								}
							}
						}
					}
				});
			}
		}
	};
}();
var tourscroll = function() {
	return {
		init: function() {
			var k = jQuery(".nav-bar");
			if (k.length > 0) {
				jQuery(".nav-bar li").on("click", function() {
					var b = jQuery(this).attr("id");
					var c = jQuery("." + b);
					var a = 0;
					a = c.offset().top - 110;
					jQuery("html, body").animate({
						scrollTop: a
					}, 0);
				});
				var i = k.offset().top;
				var h = jQuery(".content-i:last").offset().top;
				var channelsContentTop = jQuery("#channels").offset().top;
				var l = jQuery("#administration").offset().top;
				var n = jQuery("#management").offset().top;
				var m = jQuery("#operator").offset().top;
				var j = jQuery("#visitor").offset().top;
				jQuery(window).scroll(function() {
					if (jQuery(this).scrollTop() >= (i - 95) && jQuery(this).scrollTop() <= h) {
						k.addClass("navbar-fixed");
					} else {
						k.removeClass("navbar-fixed");
					}
					if (jQuery(this).scrollTop() <= channelsContentTop || (jQuery(this).scrollTop() > channelsContentTop && jQuery(this).scrollTop() < (l - 200))) {
						jQuery(".tab-sidebar .active").removeClass("active");
						jQuery("#nav-bar-channels").addClass("active");
					} else if (jQuery(this).scrollTop() >= (channelsContentTop - 200) && jQuery(this).scrollTop() < (n - 200)) {
						jQuery(".tab-sidebar .active").removeClass("active");
						jQuery("#nav-bar-administration").addClass("active");
					} else {
						if (jQuery(this).scrollTop() >= (l - 200) && jQuery(this).scrollTop() < (m - 200)) {
							jQuery(".tab-sidebar .active").removeClass("active");
							jQuery("#nav-bar-management").addClass("active");
						} else {
							if (jQuery(this).scrollTop() >= (m - 200) && jQuery(this).scrollTop() < (j - 200)) {
								jQuery(".tab-sidebar .active").removeClass("active");
								jQuery("#nav-bar-operator").addClass("active");
							} else {
								jQuery(".tab-sidebar .active").removeClass("active");
								jQuery("#nav-bar-visitor").addClass("active");
							}
						}
					}
				});
			}
		}
	};
}();

jQuery(document).ready(function() {
	revealAnimate.init();
	new WOW({
		mobile: false
	}).init();
	var r = jQuery(".c-layout-revo-slider-1 .tp-banner");
	var j = jQuery(".c-layout-revo-slider-1 .tp-banner-container");
	var n = r.show().revolution({
		delay: 15,
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
		fullScreen: "on",
		fullScreenAlignForce: "on",
		fullScreenOffsetContainer: "",
		shadow: 0,
		fullWidth: "off",
		forceFullWidth: "off",
		hideTimerBar: "off",
		hideThumbsOnMobile: "on",
		hideNavDelayOnMobile: 1500,
		hideBulletsOnMobile: "on",
		hideArrowsOnMobile: "on",
		hideThumbsUnderResolution: 0
	});
	var k = jQuery(".c-layout-revo-slider-4 .fixheight-banner");
	var p = (App.getViewPort().width < App.getBreakpoint("md") ? 250 : 620);
	var n = k.show().revolution({
		delay: 8000,
		startwidth: 1170,
		startheight: p,
		navigationType: "bullet",
		navigationArrows: "solo",
		touchenabled: "off",
		onHoverStop: "on",
		keyboardNavigation: "off",
		navigationStyle: "round c-tparrows-hide c-theme",
		navigationHAlign: "center",
		navigationVAlign: "bottom",
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
	ContentOwlcarousel.init();
	ContentCubeLatestPortfolio.init();
	ContentFancybox.init();
	ContentTwitter.init();
	if (App.getViewPort().width >= App.getBreakpoint("sm")) {
		featurelistscroll.init();
		window.setTimeout(function() {
			tourscroll.init();
		}, 3000);
	}
	if(getCookies('ifshownotify') === null || getCookies('ifshownotify') !== '0'){
		jQuery('.notify').show();
		// jQuery('.c-layout-header-fixed .c-layout-header').css('top', '50px');
	}
	jQuery(".notify .close").on('click', function(){
		jQuery('.notify').hide();
		// jQuery('.c-layout-header-fixed .c-layout-header').css('top', '0');
		setCookies("ifshownotify", 0, 30);
	});
	jQuery(".achat").click(function() {
		var a = 110;
		if (screen.height < 800) {
			a = 50;
		}
		window.open("https://chatserver.comm100.com/ChatWindow.aspx?planId=1428&visitType=1&byHref=1&partnerId=-1&siteid=10000", "", "height = 570, width = 540, left = 200, top = " + a + ", status = yes, toolbar = no, menubar = no, resizable = yes, location = no, titlebar = no");
	});
	jQuery("#a-requestcallback").click(function() {
		window.location.href = "/livechat/requestcallback.aspx?requesttype=general";
		return false;
	});

	if (jQuery("#first_name").length) {
		jQuery("#first_name").val(getCookies("whitepaper_firstname"));
		jQuery("#last_name").val(getCookies("whitepaper_lastname"));
		jQuery("#email").val(getCookies("whitepaper_email"));
		jQuery("#phone").val(getCookies("whitepaper_tel"));
		jQuery("#URL").val(getCookies("whitepaper_website"));
		jQuery("#company").val(getCookies("whitepaper_company"));
	}
	if(jQuery("#oid").length){
		jQuery("#00Nj0000002K3xZ").val(getCookies('C_cId'));
		jQuery("#00Nj0000002K3xU").val(getCookies('R_url'));
		jQuery("#00Nj0000002K2rv").val(getCookies('landingUrl1'));
		jQuery("#00Nj000000Bz2Xp").val('');
		jQuery("#00Nj000000Bz2Xu").val(document.referrer);
	}

	function showLocation() {
		var positionData ={};
    positionData.action = 'getPosition_action';
    jQuery.ajax({
        type: 'POST',
        url: commGlobal.ajax_url,
        data: positionData,
        success: function(msg) {
            if (msg) {
                jQuery("#00Nj000000Bz2Xp").val(msg.substr(0, msg.length-1));
            } else {
                jQuery("#00Nj000000Bz2Xp").val('');
            }
        }
    });
  }

  function showVisitorIP() {
    var ajaxData = {
        'action': 'getVisitorIP_action'
    };

    jQuery.ajax({
        type: 'GET',
        url: commGlobal.theme_url + '/get_user_ip.php', //commGlobal.ajax_url. Changed to simple PHP script so we don't have to fully load the theme to call the admin ajax method.
//        data: ajaxData,
        success: function(response) {
            Comm100_Variable_IP = response || 'unknown';
            //response.substr(0, response.length-1) || 'unknown';
        }
    });
  }

  showVisitorIP();

  if(jQuery("#00Nj000000Bz2Xp").length){
  	showLocation();
  }

	jQuery("#submitWhitePaper").on('click', function() {
		if (jQuery("#first_name").val()==='') {
			jQuery("#first_name").focus();
			return;
		}
		if (jQuery("#last_name").val()==='') {
			jQuery("#last_name").focus();
			return;
		}
		if (jQuery("#email").val()==='') {
			jQuery("#email").focus();
			return;
		}
		if (jQuery("#phone").val()==='') {
			jQuery("#phone").focus();
			return;
		}
		if (jQuery("#company").val()==='') {
			jQuery("#company").focus();
			return;
		}
		jQuery("#formwhitepaper").submit();

		var b = {};
		b.whitepaperid = jQuery("#whitepaperid").val();
		b.whitepaper_username = jQuery("#last_name").val() + ', ' + jQuery("#first_name").val();
		b.whitepaper_email = jQuery("#email").val();
		b.whitepaper_tel = jQuery("#phone").val();
		// b.whitepaper_website = jQuery("#downloadwhitepaper_website").val();
		b.whitepaper_company = jQuery("#company").val();
		b.action = "mail_action";
		jQuery.post(commGlobal.ajax_url, b, l);
		var a = {};
		a.whitepaperid = jQuery("#whitepaperid").val();
		a.whitepaper_username = jQuery("#first_name").val();
		a.whitepaper_email = jQuery("#email").val();
		a.action = "sendemailtocustomer";
		jQuery.ajax({
			url: commGlobal.ajax_url,
			data: a,
			type: "POST",
			beforeSend: function() {
				setCookies("whitepaper_firstname", jQuery("#first_name").val(), 365);
				setCookies("whitepaper_lastname", jQuery("#last_name").val(), 365);
				setCookies("whitepaper_email", jQuery("#email").val(), 365);
				setCookies("whitepaper_tel", jQuery("#phone").val(), 365);
				// setCookies("whitepaper_website", jQuery("#downloadwhitepaper_website").val(), 365);
				setCookies("whitepaper_company", jQuery("#company").val(), 365);
				document.getElementById("downloadlink").click();
				// window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype=" + jQuery("#thankyoupage").val();
			},
			error: function(c) {},
			success: function(c) {}
		});
		return true;
	});

	function l(a) {}
	var q = getRequest()["requesttype"] == undefined ? "" : getRequest()["requesttype"];
	if (jQuery("#requestcallback-desc").length) {
		switch (q) {
			case "selfhosted":
				jQuery("#requestcallback-desc").html("For On-Premises Comm100 Live Chat");
				break;
			case "general":
				jQuery("#requestcallback-desc").html("");
				break;
			default:
				break;
		}
	}
	if (jQuery("#requestcallback_name").length) {
		jQuery("#requestcallback_name").val(getCookies("whitepaper_name"));
		jQuery("#requestcallback_email").val(getCookies("whitepaper_email"));
		jQuery("#requestcallback_tel").val(getCookies("whitepaper_tel"));
	}
	jQuery("#btnsubmitRequstCallback").on('click', function() {
		if (jQuery("#first_name").val()==='') {
			jQuery("#first_name").focus();
			return;
		}
		if (jQuery("#email").val()==='') {
			jQuery("#email").focus();
			return;
		}
		if (jQuery("#phone").val()==='') {
			jQuery("#phone").focus();
			return;
		}
		if (jQuery("#company").val()==='') {
			jQuery("#company").focus();
			return;
		}
		if (jQuery("#00Nj0000009iXhE").val()==='') {
			jQuery("#00Nj0000009iXhE").focus();
			return;
		}
		jQuery("#formrequestcallback").submit();
		var a = {};
		a.requesttype = q;
		a.requestpage = document.referrer;
		a.requestcallback_name = jQuery("#first_name").val();
		a.requestcallback_email = jQuery("#email").val();
		a.requestcallback_tel = jQuery("#phone").val();
		a.requestcallback_company = jQuery("#company").val();
		// a.requestcallback_title = jQuery("#requestcallback_title").val();
		a.requestcallback_operators = jQuery("#00Nj0000009iXhE").val();
		a.requestcallback_comments = jQuery("#00Nj000000Bz7FE").val();
		a.action = "requestcallback_action";
		jQuery.ajax({
			url: commGlobal.ajax_url,
			data: a,
			type: "POST",
			beforeSend: function() {
				jQuery("#btnsubmitRequstCallback").val("Submitting").addClass("submitting").attr("disabled", "disabled");
			},
			error: function(b) {
				jQuery("#btnsubmitRequstCallback").val("Submit").removeClass("submitting").attr("disabled", "");
			},
			success: function(b) {
				// window.location.href = "/livechat/thankyouforcallback.aspx?type=" + q;
			}
		});
		return true;
	});
	var m = getRequest()["frompricing"] == undefined ? "" : getRequest()["frompricing"];
	if (jQuery("#h1-callback").length) {
		switch (m) {
			case "quote":
				jQuery("#h1-callback").html("Request a Quote");
				break;
			default:
				break;
		}
	}
	jQuery("#formenterpriserequestdemo").submit(function() {
		var a = {};
		a.frompricing = getRequest()["frompricing"] == undefined ? "" : getRequest()["frompricing"];
		a.requestpage = document.referrer;
		a.requestcallback_name = jQuery("#requestcallback_name").val();
		a.requestcallback_email = jQuery("#requestcallback_email").val();
		a.requestcallback_tel = jQuery("#requestcallback_tel").val();
		a.requestcallback_company = jQuery("#requestcallback_company").val();
		a.requestcallback_title = jQuery("#requestcallback_title").val();
		a.requestcallback_operators = jQuery("#requestcallback_operators").val();
		a.requestcallback_comments = jQuery("#requestcallback_comments").val();
		a.action = "enterpriserequestdemo_action";
		jQuery.ajax({
			url: commGlobal.ajax_url,
			data: a,
			type: "POST",
			beforeSend: function() {
				jQuery("#btnsubmit").val("Submitting").addClass("submitting").attr("disabled", "disabled");
			},
			error: function(b) {
				jQuery("#btnsubmit").val("Submit").removeClass("submitting").attr("disabled", "");
			},
			success: function(b) {
				window.location.href = "/livechat/thankyouforcallback.aspx?type=enterprise";
			}
		});
		return false;
	});
	jQuery("#formdedicatedrequestcallback").submit(function() {
		var a = {};
		a.requestpage = document.referrer;
		a.requestcallback_name = jQuery("#requestcallback_name").val();
		a.requestcallback_email = jQuery("#requestcallback_email").val();
		a.requestcallback_tel = jQuery("#requestcallback_tel").val();
		a.requestcallback_company = jQuery("#requestcallback_company").val();
		a.requestcallback_title = jQuery("#requestcallback_title").val();
		a.requestcallback_operators = jQuery("#requestcallback_operators").val();
		a.requestcallback_comments = jQuery("#requestcallback_comments").val();
		a.action = "dedicatedrequestcallback_action";
		jQuery.ajax({
			url: commGlobal.ajax_url,
			data: a,
			type: "POST",
			beforeSend: function() {
				jQuery("#btnsubmit").val("Submitting").addClass("submitting").attr("disabled", "disabled");
			},
			error: function(b) {
				jQuery("#btnsubmit").val("Submit").removeClass("submitting").attr("disabled", "");
			},
			success: function(b) {
				window.location.href = "/livechat/thankyouforcallback.aspx?type=dedicated";
			}
		});
		return false;
	});
	jQuery(document).on("click", ".download-link", function() {
		window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype=" + jQuery(this).data("source");
	});
	jQuery(document).on("click", ".download-link2", function() {
		window.location.href = "/livechat/thankyoufordownload.aspx?whitepapertype=" + jQuery(this).data("source");
	});
	var o = getRequest()["whitepapertype"] == undefined ? "" : getRequest()["whitepapertype"];
	if (o != "" && jQuery("#thankyoufordownload-title").length) {
		switch (o) {
			case "buyersguide":
				jQuery("#thankyoufordownload-title").html("How to Choose the Best Live Chat Software: A Buyer's Guide");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/how-to-choose-the-best-live-chat-software-a-buyers-guide.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-buyersguide.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li><li><a href="/livechat/resources/live-chat-scripts.aspx">Free Download: 120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_buyersguide\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "chatyourwaytohigherrevenue":
				jQuery("#thankyoufordownload-title").html("White Paper: The Top Ten Ways That Live Chat Can Increase Sales");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-chat-your-way-to-higher-revenue.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-chatyourwaytohigherrevenue.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li><li><a href="/livechat/resources/structure-website-conversion.aspx">White Paper: How to Structure Your Website for Better Conversion</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_chatyourwaytohigherrevenue\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "maximumon":
				jQuery("#thankyoufordownload-title").html("White Paper: Introducing the Comm100 Live Chat Patent Pending MaximumOn&#8482; Technology");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/Comm100-MaximumOn-Whitepaper.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-maximumon.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li><li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_maximumon\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "dynamiclivechatstrategy":
				jQuery("#thankyoufordownload-title").html("White Paper: How to Create a Dynamic Live Chat Strategy");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-how-to-create-a-dynamic-live-chat-strategy.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-dynamiclivechatstrategy.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li><li><a href="/blog/live-chat-software-rfp-template.html">[Free Template] Live Chat Software RFP Questions</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_dynamiclivechatstrategy\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "betterconversion":
				jQuery("#thankyoufordownload-title").html("White Paper: How to Structure Your Website for Better Conversion");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-how-to-structure-your-website-for-better-conversion.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-betterconversion.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li><li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_betterconversion\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "livechatscripts":
				jQuery("#thankyoufordownload-title").html("120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-live-chat-scripts-to-make-stellar-agents.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-livechatscripts.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li><li><a href="/livechat/resources/structure-website-conversion.aspx">White Paper: How to Structure Your Website for Better Conversion</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_livechatscripts\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "difficultcustomer":
				jQuery("#thankyoufordownload-title").html("How to Deal with Difficult Customers over Live Chat");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/how-to-deal-with-difficult-customers-over-live-chat.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-difficult-customer.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-support-scripts.aspx">White Paper: Live Chat Scripts to Make Stella Agents</a></li><li><a href="/livechat/resources/top-ten-ways-increase-sales.aspx">The Top Ten Ways That Live Chat Can Increase Sales</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_difficultcustomer\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "rfptemplate":
				jQuery("#thankyoufordownload-title").html("Live Chat Software RFP Template");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/Comm100-Live-Chat-Software-RFP-Questions-Template.xlsx");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-rfp-template.png");
				jQuery("#whitepaperlike").html('<li><a href="/blog/live-chat-software-review-questions.html">Live Chat Software Review: Top 8 Questions to Ask</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li><li><a href="/livechat/resources/live-chat-increase-sales.aspx">White Paper: The Top Ten Ways That Live Chat Can Increase Sales</a></li>');
				jQuery("#aclickhere").click();
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_rfptemplate\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "topperformer":
				jQuery("#thankyoufordownload-title").html("The Guide to Becoming a Top Performing Live Chat Agent");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-the-guide-to-becoming-a-top-performing-live-chat-operator.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-top-performer.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/live-chat-support-scripts.aspx">White Paper: Live Chat Scripts to Make Stella Agents</a></li><li><a href="/livechat/resources/dealing-with-difficult-customers-over-live-chat/">White Paper: How to Deal with Difficult Customers over Live Chat</a></li><li><a href="/livechat/resources/live-chat-strategy.aspx">White Paper: How to Create a Dynamic Live Chat Strategy</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_topperformer\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "report":
				jQuery("#thankyoufordownload-title").html("Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-chat-to-visit-ratio-report.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-report.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/top-performing-chat-operator/">White Paper: The Guide to Becoming a Top Performing Live Chat Agent</a></li><li><a href="/livechat/resources/dealing-with-difficult-customers-over-live-chat/">White Paper: How to Deal with Difficult Customers over Live Chat</a></li><li><a href="/livechat/resources/live-chat-buyers-guide.aspx">White Paper: How to Choose the Best Live Chat Software: A Buyer\'s Guide</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_report\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "benchmark":
				jQuery("#thankyoufordownload-title").html("2016 Live Chat Benchmark Report: Help Measure Your Live Chat Success");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-2016-live-chat-benchmark-report.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-benchmark.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/top-performing-chat-operator/">White Paper: The Guide to Becoming a Top Performing Live Chat Agent</a></li><li><a href="/livechat/resources/dealing-with-difficult-customers-over-live-chat/">White Paper: How to Deal with Difficult Customers over Live Chat</a></li><li><a href="/livechat/resources/chat-to-visit-report/">Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_benchmark\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "salesforceintegration":
				jQuery("#thankyoufordownload-title").html("A User Guide to Comm100 Live Chat Salesforce Integration");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-live-chat-salesforce-integration.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/thankyou-salesforce-integration.png");
				jQuery("#whitepaperlike").html('<li><a href="/livechat/resources/chat-to-visit-report/">Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume</a></li><li><a href="/livechat/resources/high-availability-maximumon.aspx">White Paper: Introducing the Comm100 Live Chat Patent Pending MaximumOn&#8482; Technology</a></li><li><a href="/livechat/resources/dealing-with-difficult-customers-over-live-chat/">White Paper: How to Deal with Difficult Customers over Live Chat</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_salesforceintegration\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "2017benchmarkreport":
				jQuery("#thankyoufordownload-title").html("Live Chat Benchmark Report 2017");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-live-chat-benchmark-report-2017.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/report-benchmark-2017-landing.png");
				jQuery("#whitepaperlike").html(
					'<li><a href=commGlobal.site_url + "/livechat/resources/chat-to-visit-report/">Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/live-chat-buyers-guide.aspx">How to Choose the Best Live Chat Software: A Buyer\'s Guide</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/top-ten-ways-increase-sales.aspx">The Top Ten Ways That Live Chat Can Increase Sales</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/dealing-with-difficult-customers-over-live-chat/">How to Deal with Difficult Customers over Live Chat</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_2017benchmarkreport\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "50activities":
				jQuery("#thankyoufordownload-title").html("50 Customer Service Training Activities for Live Chat and Telephone Teams");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-50-customer-service-training-activities.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/whitepaper-50-activities-landing.png");
				jQuery("#whitepaperlike").html(
					'<li><a href=commGlobal.site_url + "/livechat/resources/live-chat-benchmark-report-2017/">Live Chat Benchmark Report 2017</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/live-chat-support-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/top-performing-chat-operator/">The Guide to Becoming a Top Performing Live Chat Agent</a></li>'+
					'<li><a href=commGlobal.site_url + "/livechat/resources/dealing-with-difficult-customers-over-live-chat/">How to Deal with Difficult Customers over Live Chat</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_50activities\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			default:
				break;
		}
	}

	function callPlayer(frame_id, func, args) {
	    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
	    var iframe = document.getElementById(frame_id);
	    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
	        iframe = iframe.getElementsByTagName('iframe')[0];
	    }
	    if (iframe) {
	        // Frame exists,
	        iframe.contentWindow.postMessage(JSON.stringify({
	            "event": "command",
	            "func": func,
	            "args": args || [],
	            "id": frame_id
	        }), "*");
	    }
	}
	jQuery(".c-layout-revo-slider .btn-video").on("click", function(){
		//jQuery(".video-container").fadeIn('fast');
		//playVideo();
		jQuery("#videomodal").modal({
			"backdrop": "static",
			"show"    : "true"
		});
		callPlayer('videoContainer','playVideo');
	});

	jQuery(".videomodal .btn-video-close").on("click", function(){
		//jQuery(".video-container").hide();
		//stopVideo();
		jQuery("#videomodal").modal("hide");
		callPlayer('videoContainer','stopVideo');
	});


});

window.mobilecheck = function() {
	var check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
};

var Pager = (function() {
	var container;
	var totalNum = 0;
	var currentPage = 1;
	var pageSize = 12;
	var totalPages = 1;

	var _ifScrollToPagerFirstItem = false;
	function init(list, pagerSize) {
		container = jQuery(list);
		pageSize = pagerSize || 12;
		totalNum = container.children().length;
		totalPages = Math.ceil(totalNum / pageSize);

		// if (totalPages > 1) {
		// 	renderPager();
		// }

		// bindEvents();
		// setCurrentPage();
	}

	function setCurrentPage() {
		if (currentPage === 1) {
			jQuery('.first_page').addClass('disabled');
			jQuery('.prev_page').addClass('disabled');
			jQuery('.next_page').removeClass('disabled');
			jQuery('.last_page').removeClass('disabled');
		} else if (currentPage === totalPages) {
			jQuery('.first_page').removeClass('disabled');
			jQuery('.prev_page').removeClass('disabled');
			jQuery('.next_page').addClass('disabled');
			jQuery('.last_page').addClass('disabled');
		} else {
			jQuery('.first_page').removeClass('disabled');
			jQuery('.prev_page').removeClass('disabled');
			jQuery('.next_page').removeClass('disabled');
			jQuery('.last_page').removeClass('disabled');
		}
		jQuery('.pager .page_index').removeClass('current');
		jQuery('.pager .page_index').eq(currentPage - 1).addClass('current');
		showItems();
	}

	function renderPager() {
		var pagerWrap = document.createElement('div');
		pagerWrap.className = 'pager';
		// var $pagerWrap = jQuery(pagerWrap);
		jQuery(pagerWrap).append('<span class="first_page"><i class="fa fa-angle-double-left"></i></span>');
		jQuery(pagerWrap).append('<span class="prev_page"><i class="fa fa-angle-left"></i></span>');

		for(var i=1; i<=totalPages; ++i) {
			jQuery(pagerWrap).append('<span class="page_index">' + i + '</span>');
		}

		jQuery(pagerWrap).append('<span class="next_page"><i class="fa fa-angle-right"></i></span>');
		jQuery(pagerWrap).append('<span class="last_page"><i class="fa fa-angle-double-right"></i></span>');
		document.querySelector('.resource-list').parentNode.insertBefore(pagerWrap, document.querySelector('.resource-list').nextSibling)
	}

	function bindEvents() {
		jQuery('.first_page').on('click', function() {
			if (currentPage === 1) return;
			currentPage = 1;
			ifScrollToPagerFirstItem();
			setCurrentPage();
		});
		jQuery('.prev_page').on('click', function() {
			if (currentPage === 1) return;
			currentPage--;
			ifScrollToPagerFirstItem();
			setCurrentPage();
		});
		jQuery('.next_page').on('click', function() {
			if (currentPage === totalPages) return;
			currentPage++;
			ifScrollToPagerFirstItem();
			setCurrentPage();
		});
		jQuery('.last_page').on('click', function() {
			if (currentPage === totalPages) return;
			currentPage = totalPages;
			ifScrollToPagerFirstItem();
			setCurrentPage();
		});
		jQuery('.page_index').on('click', function() {
			var clickIndex = jQuery(this).index() - 1;
			if (currentPage === clickIndex) return;
			currentPage = clickIndex;
			ifScrollToPagerFirstItem();
			setCurrentPage();
		})
	}

	function ifScrollToPagerFirstItem() {
		_ifScrollToPagerFirstItem = true;
	}

	function showItems () {
		for (var i=0; i<totalNum; i++) {
			if (i >= (currentPage - 1) * pageSize && i < currentPage * pageSize) {
				jQuery(container).children().eq(i).show();
			} else {
				jQuery(container).children().eq(i).hide();
			}
		}
		_ifScrollToPagerFirstItem &&
			jQuery('html, body').animate({
				scrollTop: jQuery('.resource-list')[0].offsetTop,
			}, 10);
	}

	return {
		'init': init
	}
})();

window.onload = function() {
	(function(){
		var cardItems = Array.prototype.slice.call(document.querySelectorAll('.card-item'));
		cardItems.forEach(function(item) {
			item.addEventListener('mouseover', function() {
				this.classList.add('card-item--hover');
			});
			item.addEventListener('mouseout', function() {
				this.classList.remove('card-item--hover');
			})
			item.addEventListener('click', function() {
				window.location.href = this.getAttribute('data-link');
			})
		})
		var imgTextCardItems = document.querySelectorAll('.img-text-card');
		imgTextCardItems = Array.prototype.slice.call(imgTextCardItems);
		imgTextCardItems.forEach(function(item) {
			item.addEventListener('mouseover', function() {
				this.classList.add('card-item--hover');
			});
			item.addEventListener('mouseout', function() {
				this.classList.remove('card-item--hover');
			})
			item.addEventListener('click', function() {
				window.location.href = this.getAttribute('data-link');
			})
		})
	}());

	
};

jQuery(function() {
	(function(){
		var isMobile = window.mobilecheck();
		if (!isMobile) {
			var headerHeight = jQuery('.c-layout-header').outerHeight() - jQuery('.c-layout-header .c-topbar.c-navbar').outerHeight();
			var tabIndexWrap = document.querySelector('.threeTab__Index--Wrap');
			var isTabHasDataWheel = tabIndexWrap && tabIndexWrap.getAttribute('data-wheel') === 'true';
			if (isTabHasDataWheel) {
				var scrolling = false;
				function disableMouseWheel () {
					scrolling = true;
				}
				function enableMouseWheel() {
					scrolling = false;
				}

				function handle(delta) {
					var tabOffsetHeader = Math.ceil(jQuery('.threeTab__Index--Wrap').offset().top) - headerHeight;
					if (delta < 0) {
						if (jQuery(window).scrollTop() < tabOffsetHeader) {
							disableMouseWheel();
							jQuery('html, body').animate({
								scrollTop: tabOffsetHeader
							}, 400, function() {
								tabIndexSlideUpOrDown(true);
							});
						}
					} else {
						if (jQuery(window).scrollTop() < tabOffsetHeader) {
							tabIndexSlideUpOrDown(false);
						}
					}
				}

				function wheelEvent(event) {
					if(scrolling) return;
					var delta = 0;
					event = event || window.event;
					// if (event.wheelDelta) {
					// 	delta = event.wheelDelta/120;
					// } else if (event.detail) {
					// 	delta = -event.detail/3;
					// }
					delta = event.wheelDelta ? event.wheelDelta/120 : -(event.detail || 0)/3;
					delta && handle(delta);
				}

				window.addEventListener('mousewheel', wheelEvent, false);

				var isFirefox = typeof InstallTrigger !== 'undefined';
				if (isFirefox) {
					window.addEventListener('DOMMouseScroll', wheelEvent, false);
				}

				function tabIndexSlideUpOrDown(isUp) {
					if (isUp) {
						jQuery('.threeTab__Index--Wrap .threeTab__Index--desc').slideUp(400, function() {
							enableMouseWheel();
						});
						return;
					}
					jQuery('.threeTab__Index--Wrap .threeTab__Index--desc').slideDown(400, function() {
							enableMouseWheel();
					});
				}
			}

			function selectTab(index) {
				jQuery('.threeTab__Index').removeClass('selected').eq(index).addClass('selected');
				jQuery('.threeTab__Detail').hide();
				jQuery('.threeTab__Detail').eq(index).show();
				switch (index) {
					case 0: jQuery('.threeTab__Detail--bottomLink a').attr('href', 'https://www.comm100.com/platform/livechat-featurelist/#lc'); break;
					case 1: jQuery('.threeTab__Detail--bottomLink a').attr('href', 'https://www.comm100.com/platform/livechat-featurelist/#mc'); break;
					case 2: jQuery('.threeTab__Detail--bottomLink a').attr('href', 'https://www.comm100.com/platform/livechat-featurelist/#ai'); break;
					default: break;
				}

				// feature list
				jQuery('.featurelist-wrap').hide();
				jQuery('.featurelist-wrap').eq(index).show();

			}

			var tabIndexItems = document.querySelectorAll('.threeTab__Index');
			var tabIndexItemsArray = Array.prototype.slice.call(tabIndexItems);
			tabIndexItemsArray.forEach(function(item, index) {
				item.addEventListener('click', function() {
					isTabHasDataWheel && tabIndexSlideUpOrDown && tabIndexSlideUpOrDown(true);
					selectTab(index);
					jQuery('html, body').animate({
						scrollTop: Math.ceil(jQuery('.threeTab__Index--Wrap').offset().top) - headerHeight
					}, 400);
				});
			});
			selectTab(0);
			if (window.location.hash) {
				switch (window.location.hash) {
					case '#lc': selectTab(0); break;
					case '#mc': selectTab(1); break;
					case '#ai': selectTab(2); break;
					default: selectTab(0); break;
				}	 	
			}
			if (tabIndexWrap && isTabHasDataWheel) {
				setTimeout(function() {
					if (Math.ceil(jQuery('.threeTab__Index--Wrap').offset().top) - jQuery(window).scrollTop() === jQuery('.c-layout-header').outerHeight()) {
						tabIndexSlideUpOrDown && tabIndexSlideUpOrDown(true);
					}
				}, 100);
			}
		} else {
			jQuery('.threeTab__Index--Wrap').hide();
			jQuery('.threeTab__Index--mobile').show();
		}

		jQuery('.question-item__title').on('click', function() {
			jQuery(this).parent().toggleClass('selected');
			jQuery(this).siblings().slideToggle(200, function() {
			});
		});

		jQuery('.featurelist-title').on('click', function () {
            jQuery(this).toggleClass('featurelist-title--close');
            jQuery(this).next('.featurelist-content').slideToggle(200);
        });

		if (!window.mobilecheck()) {
			Pager.init(jQuery('.resource-list'), 12);
		}
	}());
});

/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
        init: function() {
            App.init(); //Now that jQuery is loaded we can initialize the app above on all pages.

            // Create the dropdown based nav for mobile devices on the resources and blog sections.
            if ($('.post-nav').length) {
                $("<select class='visible-xs form-control' />").appendTo(".post-nav");

                // Populate dropdown with menu items
                $(".post-nav a").each(function() {
                    var $el = $(this);
                    $("<option />", {
                        "value"   : $el.attr("href"),
                        "text"    : $el.text(),
                        "selected": $el.parent().hasClass('active')
                    }).appendTo(".post-nav select");
                });

                $(".post-nav select").change(function() {
                    window.location = $(this).find("option:selected").val();
                });
            }
        },
        finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        }
    }
};

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.