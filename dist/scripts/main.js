/*! =======================================================
                      VERSION  10.6.1              
========================================================= */
"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*! =========================================================
 * bootstrap-slider.js
 *
 * Maintainers:
 *		Kyle Kemp
 *			- Twitter: @seiyria
 *			- Github:  seiyria
 *		Rohit Kalkur
 *			- Twitter: @Rovolutionary
 *			- Github:  rovolution
 *
 * =========================================================
 *
 * bootstrap-slider is released under the MIT License
 * Copyright (c) 2019 Kyle Kemp, Rohit Kalkur, and contributors
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * ========================================================= */

/**
 * Bridget makes jQuery widgets
 * v1.0.1
 * MIT license
 */
var windowIsDefined = (typeof window === "undefined" ? "undefined" : _typeof(window)) === "object";

(function (factory) {
	if (typeof define === "function" && define.amd) {
		define(["jquery"], factory);
	} else if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === "object" && module.exports) {
		var jQuery;
		try {
			jQuery = require("jquery");
		} catch (err) {
			jQuery = null;
		}
		module.exports = factory(jQuery);
	} else if (window) {
		window.Slider = factory(window.jQuery);
	}
})(function ($) {
	// Constants
	var NAMESPACE_MAIN = 'slider';
	var NAMESPACE_ALTERNATE = 'bootstrapSlider';

	// Polyfill console methods
	if (windowIsDefined && !window.console) {
		window.console = {};
	}
	if (windowIsDefined && !window.console.log) {
		window.console.log = function () {};
	}
	if (windowIsDefined && !window.console.warn) {
		window.console.warn = function () {};
	}

	// Reference to Slider constructor
	var Slider;

	(function ($) {

		'use strict';

		// -------------------------- utils -------------------------- //

		var slice = Array.prototype.slice;

		function noop() {}

		// -------------------------- definition -------------------------- //

		function defineBridget($) {

			// bail if no jQuery
			if (!$) {
				return;
			}

			// -------------------------- addOptionMethod -------------------------- //

			/**
    * adds option method -> $().plugin('option', {...})
    * @param {Function} PluginClass - constructor class
    */
			function addOptionMethod(PluginClass) {
				// don't overwrite original option method
				if (PluginClass.prototype.option) {
					return;
				}

				// option setter
				PluginClass.prototype.option = function (opts) {
					// bail out if not an object
					if (!$.isPlainObject(opts)) {
						return;
					}
					this.options = $.extend(true, this.options, opts);
				};
			}

			// -------------------------- plugin bridge -------------------------- //

			// helper function for logging errors
			// $.error breaks jQuery chaining
			var logError = typeof console === 'undefined' ? noop : function (message) {
				console.error(message);
			};

			/**
    * jQuery plugin bridge, access methods like $elem.plugin('method')
    * @param {String} namespace - plugin name
    * @param {Function} PluginClass - constructor class
    */
			function bridge(namespace, PluginClass) {
				// add to jQuery fn namespace
				$.fn[namespace] = function (options) {
					if (typeof options === 'string') {
						// call plugin method when first argument is a string
						// get arguments for method
						var args = slice.call(arguments, 1);

						for (var i = 0, len = this.length; i < len; i++) {
							var elem = this[i];
							var instance = $.data(elem, namespace);
							if (!instance) {
								logError("cannot call methods on " + namespace + " prior to initialization; " + "attempted to call '" + options + "'");
								continue;
							}
							if (!$.isFunction(instance[options]) || options.charAt(0) === '_') {
								logError("no such method '" + options + "' for " + namespace + " instance");
								continue;
							}

							// trigger method with arguments
							var returnValue = instance[options].apply(instance, args);

							// break look and return first value if provided
							if (returnValue !== undefined && returnValue !== instance) {
								return returnValue;
							}
						}
						// return this if no return value
						return this;
					} else {
						var objects = this.map(function () {
							var instance = $.data(this, namespace);
							if (instance) {
								// apply options & init
								instance.option(options);
								instance._init();
							} else {
								// initialize new instance
								instance = new PluginClass(this, options);
								$.data(this, namespace, instance);
							}
							return $(this);
						});

						if (!objects || objects.length > 1) {
							return objects;
						} else {
							return objects[0];
						}
					}
				};
			}

			// -------------------------- bridget -------------------------- //

			/**
    * converts a Prototypical class into a proper jQuery plugin
    *   the class must have a ._init method
    * @param {String} namespace - plugin name, used in $().pluginName
    * @param {Function} PluginClass - constructor class
    */
			$.bridget = function (namespace, PluginClass) {
				addOptionMethod(PluginClass);
				bridge(namespace, PluginClass);
			};

			return $.bridget;
		}

		// get jquery from browser global
		defineBridget($);
	})($);

	/*************************************************
 			BOOTSTRAP-SLIDER SOURCE CODE
 	**************************************************/

	(function ($) {
		var autoRegisterNamespace = void 0;

		var ErrorMsgs = {
			formatInvalidInputErrorMsg: function formatInvalidInputErrorMsg(input) {
				return "Invalid input value '" + input + "' passed in";
			},
			callingContextNotSliderInstance: "Calling context element does not have instance of Slider bound to it. Check your code to make sure the JQuery object returned from the call to the slider() initializer is calling the method"
		};

		var SliderScale = {
			linear: {
				getValue: function getValue(value, options) {
					if (value < options.min) {
						return options.min;
					} else if (value > options.max) {
						return options.max;
					} else {
						return value;
					}
				},
				toValue: function toValue(percentage) {
					var rawValue = percentage / 100 * (this.options.max - this.options.min);
					var shouldAdjustWithBase = true;
					if (this.options.ticks_positions.length > 0) {
						var minv,
						    maxv,
						    minp,
						    maxp = 0;
						for (var i = 1; i < this.options.ticks_positions.length; i++) {
							if (percentage <= this.options.ticks_positions[i]) {
								minv = this.options.ticks[i - 1];
								minp = this.options.ticks_positions[i - 1];
								maxv = this.options.ticks[i];
								maxp = this.options.ticks_positions[i];

								break;
							}
						}
						var partialPercentage = (percentage - minp) / (maxp - minp);
						rawValue = minv + partialPercentage * (maxv - minv);
						shouldAdjustWithBase = false;
					}

					var adjustment = shouldAdjustWithBase ? this.options.min : 0;
					var value = adjustment + Math.round(rawValue / this.options.step) * this.options.step;
					return SliderScale.linear.getValue(value, this.options);
				},
				toPercentage: function toPercentage(value) {
					if (this.options.max === this.options.min) {
						return 0;
					}

					if (this.options.ticks_positions.length > 0) {
						var minv,
						    maxv,
						    minp,
						    maxp = 0;
						for (var i = 0; i < this.options.ticks.length; i++) {
							if (value <= this.options.ticks[i]) {
								minv = i > 0 ? this.options.ticks[i - 1] : 0;
								minp = i > 0 ? this.options.ticks_positions[i - 1] : 0;
								maxv = this.options.ticks[i];
								maxp = this.options.ticks_positions[i];

								break;
							}
						}
						if (i > 0) {
							var partialPercentage = (value - minv) / (maxv - minv);
							return minp + partialPercentage * (maxp - minp);
						}
					}

					return 100 * (value - this.options.min) / (this.options.max - this.options.min);
				}
			},

			logarithmic: {
				/* Based on http://stackoverflow.com/questions/846221/logarithmic-slider */
				toValue: function toValue(percentage) {
					var offset = 1 - this.options.min;
					var min = Math.log(this.options.min + offset);
					var max = Math.log(this.options.max + offset);
					var value = Math.exp(min + (max - min) * percentage / 100) - offset;
					if (Math.round(value) === max) {
						return max;
					}
					value = this.options.min + Math.round((value - this.options.min) / this.options.step) * this.options.step;
					/* Rounding to the nearest step could exceed the min or
      * max, so clip to those values. */
					return SliderScale.linear.getValue(value, this.options);
				},
				toPercentage: function toPercentage(value) {
					if (this.options.max === this.options.min) {
						return 0;
					} else {
						var offset = 1 - this.options.min;
						var max = Math.log(this.options.max + offset);
						var min = Math.log(this.options.min + offset);
						var v = Math.log(value + offset);
						return 100 * (v - min) / (max - min);
					}
				}
			}
		};

		/*************************************************
  						CONSTRUCTOR
  	**************************************************/
		Slider = function Slider(element, options) {
			createNewSlider.call(this, element, options);
			return this;
		};

		function createNewSlider(element, options) {

			/*
   	The internal state object is used to store data about the current 'state' of slider.
   	This includes values such as the `value`, `enabled`, etc...
   */
			this._state = {
				value: null,
				enabled: null,
				offset: null,
				size: null,
				percentage: null,
				inDrag: false,
				over: false,
				tickIndex: null
			};

			// The objects used to store the reference to the tick methods if ticks_tooltip is on
			this.ticksCallbackMap = {};
			this.handleCallbackMap = {};

			if (typeof element === "string") {
				this.element = document.querySelector(element);
			} else if (element instanceof HTMLElement) {
				this.element = element;
			}

			/*************************************************
   					Process Options
   	**************************************************/
			options = options ? options : {};
			var optionTypes = Object.keys(this.defaultOptions);

			var isMinSet = options.hasOwnProperty('min');
			var isMaxSet = options.hasOwnProperty('max');

			for (var i = 0; i < optionTypes.length; i++) {
				var optName = optionTypes[i];

				// First check if an option was passed in via the constructor
				var val = options[optName];
				// If no data attrib, then check data atrributes
				val = typeof val !== 'undefined' ? val : getDataAttrib(this.element, optName);
				// Finally, if nothing was specified, use the defaults
				val = val !== null ? val : this.defaultOptions[optName];

				// Set all options on the instance of the Slider
				if (!this.options) {
					this.options = {};
				}
				this.options[optName] = val;
			}

			this.ticksAreValid = Array.isArray(this.options.ticks) && this.options.ticks.length > 0;

			// Lock to ticks only when ticks[] is defined and set
			if (!this.ticksAreValid) {
				this.options.lock_to_ticks = false;
			}

			// Check options.rtl
			if (this.options.rtl === 'auto') {
				var computedStyle = window.getComputedStyle(this.element);
				if (computedStyle != null) {
					this.options.rtl = computedStyle.direction === 'rtl';
				} else {
					// Fix for Firefox bug in versions less than 62:
					// https://bugzilla.mozilla.org/show_bug.cgi?id=548397
					// https://bugzilla.mozilla.org/show_bug.cgi?id=1467722
					this.options.rtl = this.element.style.direction === 'rtl';
				}
			}

			/*
   	Validate `tooltip_position` against 'orientation`
   	- if `tooltip_position` is incompatible with orientation, swith it to a default compatible with specified `orientation`
   		-- default for "vertical" -> "right", "left" if rtl
   		-- default for "horizontal" -> "top"
   */
			if (this.options.orientation === "vertical" && (this.options.tooltip_position === "top" || this.options.tooltip_position === "bottom")) {
				if (this.options.rtl) {
					this.options.tooltip_position = "left";
				} else {
					this.options.tooltip_position = "right";
				}
			} else if (this.options.orientation === "horizontal" && (this.options.tooltip_position === "left" || this.options.tooltip_position === "right")) {

				this.options.tooltip_position = "top";
			}

			function getDataAttrib(element, optName) {
				var dataName = "data-slider-" + optName.replace(/_/g, '-');
				var dataValString = element.getAttribute(dataName);

				try {
					return JSON.parse(dataValString);
				} catch (err) {
					return dataValString;
				}
			}

			/*************************************************
   					Create Markup
   	**************************************************/

			var origWidth = this.element.style.width;
			var updateSlider = false;
			var parent = this.element.parentNode;
			var sliderTrackSelection;
			var sliderTrackLow, sliderTrackHigh;
			var sliderMinHandle;
			var sliderMaxHandle;

			if (this.sliderElem) {
				updateSlider = true;
			} else {
				/* Create elements needed for slider */
				this.sliderElem = document.createElement("div");
				this.sliderElem.className = "slider";

				/* Create slider track elements */
				var sliderTrack = document.createElement("div");
				sliderTrack.className = "slider-track";

				sliderTrackLow = document.createElement("div");
				sliderTrackLow.className = "slider-track-low";

				sliderTrackSelection = document.createElement("div");
				sliderTrackSelection.className = "slider-selection";

				sliderTrackHigh = document.createElement("div");
				sliderTrackHigh.className = "slider-track-high";

				sliderMinHandle = document.createElement("div");
				sliderMinHandle.className = "slider-handle min-slider-handle";
				sliderMinHandle.setAttribute('role', 'slider');
				sliderMinHandle.setAttribute('aria-valuemin', this.options.min);
				sliderMinHandle.setAttribute('aria-valuemax', this.options.max);

				sliderMaxHandle = document.createElement("div");
				sliderMaxHandle.className = "slider-handle max-slider-handle";
				sliderMaxHandle.setAttribute('role', 'slider');
				sliderMaxHandle.setAttribute('aria-valuemin', this.options.min);
				sliderMaxHandle.setAttribute('aria-valuemax', this.options.max);

				sliderTrack.appendChild(sliderTrackLow);
				sliderTrack.appendChild(sliderTrackSelection);
				sliderTrack.appendChild(sliderTrackHigh);

				/* Create highlight range elements */
				this.rangeHighlightElements = [];
				var rangeHighlightsOpts = this.options.rangeHighlights;
				if (Array.isArray(rangeHighlightsOpts) && rangeHighlightsOpts.length > 0) {
					for (var j = 0; j < rangeHighlightsOpts.length; j++) {
						var rangeHighlightElement = document.createElement("div");
						var customClassString = rangeHighlightsOpts[j].class || "";
						rangeHighlightElement.className = "slider-rangeHighlight slider-selection " + customClassString;
						this.rangeHighlightElements.push(rangeHighlightElement);
						sliderTrack.appendChild(rangeHighlightElement);
					}
				}

				/* Add aria-labelledby to handle's */
				var isLabelledbyArray = Array.isArray(this.options.labelledby);
				if (isLabelledbyArray && this.options.labelledby[0]) {
					sliderMinHandle.setAttribute('aria-labelledby', this.options.labelledby[0]);
				}
				if (isLabelledbyArray && this.options.labelledby[1]) {
					sliderMaxHandle.setAttribute('aria-labelledby', this.options.labelledby[1]);
				}
				if (!isLabelledbyArray && this.options.labelledby) {
					sliderMinHandle.setAttribute('aria-labelledby', this.options.labelledby);
					sliderMaxHandle.setAttribute('aria-labelledby', this.options.labelledby);
				}

				/* Create ticks */
				this.ticks = [];
				if (Array.isArray(this.options.ticks) && this.options.ticks.length > 0) {
					this.ticksContainer = document.createElement('div');
					this.ticksContainer.className = 'slider-tick-container';

					for (i = 0; i < this.options.ticks.length; i++) {
						var tick = document.createElement('div');
						tick.className = 'slider-tick';
						if (this.options.ticks_tooltip) {
							var tickListenerReference = this._addTickListener();
							var enterCallback = tickListenerReference.addMouseEnter(this, tick, i);
							var leaveCallback = tickListenerReference.addMouseLeave(this, tick);

							this.ticksCallbackMap[i] = {
								mouseEnter: enterCallback,
								mouseLeave: leaveCallback
							};
						}
						this.ticks.push(tick);
						this.ticksContainer.appendChild(tick);
					}

					sliderTrackSelection.className += " tick-slider-selection";
				}

				this.tickLabels = [];
				if (Array.isArray(this.options.ticks_labels) && this.options.ticks_labels.length > 0) {
					this.tickLabelContainer = document.createElement('div');
					this.tickLabelContainer.className = 'slider-tick-label-container';

					for (i = 0; i < this.options.ticks_labels.length; i++) {
						var label = document.createElement('div');
						var noTickPositionsSpecified = this.options.ticks_positions.length === 0;
						var tickLabelsIndex = this.options.reversed && noTickPositionsSpecified ? this.options.ticks_labels.length - (i + 1) : i;
						label.className = 'slider-tick-label';
						label.innerHTML = this.options.ticks_labels[tickLabelsIndex];

						this.tickLabels.push(label);
						this.tickLabelContainer.appendChild(label);
					}
				}

				var createAndAppendTooltipSubElements = function createAndAppendTooltipSubElements(tooltipElem) {
					var arrow = document.createElement("div");
					arrow.className = "tooltip-arrow";

					var inner = document.createElement("div");
					inner.className = "tooltip-inner";

					tooltipElem.appendChild(arrow);
					tooltipElem.appendChild(inner);
				};

				/* Create tooltip elements */
				var sliderTooltip = document.createElement("div");
				sliderTooltip.className = "tooltip tooltip-main";
				sliderTooltip.setAttribute('role', 'presentation');
				createAndAppendTooltipSubElements(sliderTooltip);

				var sliderTooltipMin = document.createElement("div");
				sliderTooltipMin.className = "tooltip tooltip-min";
				sliderTooltipMin.setAttribute('role', 'presentation');
				createAndAppendTooltipSubElements(sliderTooltipMin);

				var sliderTooltipMax = document.createElement("div");
				sliderTooltipMax.className = "tooltip tooltip-max";
				sliderTooltipMax.setAttribute('role', 'presentation');
				createAndAppendTooltipSubElements(sliderTooltipMax);

				/* Append components to sliderElem */
				this.sliderElem.appendChild(sliderTrack);
				this.sliderElem.appendChild(sliderTooltip);
				this.sliderElem.appendChild(sliderTooltipMin);
				this.sliderElem.appendChild(sliderTooltipMax);

				if (this.tickLabelContainer) {
					this.sliderElem.appendChild(this.tickLabelContainer);
				}
				if (this.ticksContainer) {
					this.sliderElem.appendChild(this.ticksContainer);
				}

				this.sliderElem.appendChild(sliderMinHandle);
				this.sliderElem.appendChild(sliderMaxHandle);

				/* Append slider element to parent container, right before the original <input> element */
				parent.insertBefore(this.sliderElem, this.element);

				/* Hide original <input> element */
				this.element.style.display = "none";
			}
			/* If JQuery exists, cache JQ references */
			if ($) {
				this.$element = $(this.element);
				this.$sliderElem = $(this.sliderElem);
			}

			/*************************************************
   						Setup
   	**************************************************/
			this.eventToCallbackMap = {};
			this.sliderElem.id = this.options.id;

			this.touchCapable = 'ontouchstart' in window || window.DocumentTouch && document instanceof window.DocumentTouch;

			this.touchX = 0;
			this.touchY = 0;

			this.tooltip = this.sliderElem.querySelector('.tooltip-main');
			this.tooltipInner = this.tooltip.querySelector('.tooltip-inner');

			this.tooltip_min = this.sliderElem.querySelector('.tooltip-min');
			this.tooltipInner_min = this.tooltip_min.querySelector('.tooltip-inner');

			this.tooltip_max = this.sliderElem.querySelector('.tooltip-max');
			this.tooltipInner_max = this.tooltip_max.querySelector('.tooltip-inner');

			if (SliderScale[this.options.scale]) {
				this.options.scale = SliderScale[this.options.scale];
			}

			if (updateSlider === true) {
				// Reset classes
				this._removeClass(this.sliderElem, 'slider-horizontal');
				this._removeClass(this.sliderElem, 'slider-vertical');
				this._removeClass(this.sliderElem, 'slider-rtl');
				this._removeClass(this.tooltip, 'hide');
				this._removeClass(this.tooltip_min, 'hide');
				this._removeClass(this.tooltip_max, 'hide');

				// Undo existing inline styles for track
				["left", "right", "top", "width", "height"].forEach(function (prop) {
					this._removeProperty(this.trackLow, prop);
					this._removeProperty(this.trackSelection, prop);
					this._removeProperty(this.trackHigh, prop);
				}, this);

				// Undo inline styles on handles
				[this.handle1, this.handle2].forEach(function (handle) {
					this._removeProperty(handle, 'left');
					this._removeProperty(handle, 'right');
					this._removeProperty(handle, 'top');
				}, this);

				// Undo inline styles and classes on tooltips
				[this.tooltip, this.tooltip_min, this.tooltip_max].forEach(function (tooltip) {
					this._removeProperty(tooltip, 'left');
					this._removeProperty(tooltip, 'right');
					this._removeProperty(tooltip, 'top');

					this._removeClass(tooltip, 'right');
					this._removeClass(tooltip, 'left');
					this._removeClass(tooltip, 'top');
				}, this);
			}

			if (this.options.orientation === 'vertical') {
				this._addClass(this.sliderElem, 'slider-vertical');
				this.stylePos = 'top';
				this.mousePos = 'pageY';
				this.sizePos = 'offsetHeight';
			} else {
				this._addClass(this.sliderElem, 'slider-horizontal');
				this.sliderElem.style.width = origWidth;
				this.options.orientation = 'horizontal';
				if (this.options.rtl) {
					this.stylePos = 'right';
				} else {
					this.stylePos = 'left';
				}
				this.mousePos = 'clientX';
				this.sizePos = 'offsetWidth';
			}
			// specific rtl class
			if (this.options.rtl) {
				this._addClass(this.sliderElem, 'slider-rtl');
			}
			this._setTooltipPosition();
			/* In case ticks are specified, overwrite the min and max bounds */
			if (Array.isArray(this.options.ticks) && this.options.ticks.length > 0) {
				if (!isMaxSet) {
					this.options.max = Math.max.apply(Math, this.options.ticks);
				}
				if (!isMinSet) {
					this.options.min = Math.min.apply(Math, this.options.ticks);
				}
			}

			if (Array.isArray(this.options.value)) {
				this.options.range = true;
				this._state.value = this.options.value;
			} else if (this.options.range) {
				// User wants a range, but value is not an array
				this._state.value = [this.options.value, this.options.max];
			} else {
				this._state.value = this.options.value;
			}

			this.trackLow = sliderTrackLow || this.trackLow;
			this.trackSelection = sliderTrackSelection || this.trackSelection;
			this.trackHigh = sliderTrackHigh || this.trackHigh;

			if (this.options.selection === 'none') {
				this._addClass(this.trackLow, 'hide');
				this._addClass(this.trackSelection, 'hide');
				this._addClass(this.trackHigh, 'hide');
			} else if (this.options.selection === 'after' || this.options.selection === 'before') {
				this._removeClass(this.trackLow, 'hide');
				this._removeClass(this.trackSelection, 'hide');
				this._removeClass(this.trackHigh, 'hide');
			}

			this.handle1 = sliderMinHandle || this.handle1;
			this.handle2 = sliderMaxHandle || this.handle2;

			if (updateSlider === true) {
				// Reset classes
				this._removeClass(this.handle1, 'round triangle');
				this._removeClass(this.handle2, 'round triangle hide');

				for (i = 0; i < this.ticks.length; i++) {
					this._removeClass(this.ticks[i], 'round triangle hide');
				}
			}

			var availableHandleModifiers = ['round', 'triangle', 'custom'];
			var isValidHandleType = availableHandleModifiers.indexOf(this.options.handle) !== -1;
			if (isValidHandleType) {
				this._addClass(this.handle1, this.options.handle);
				this._addClass(this.handle2, this.options.handle);

				for (i = 0; i < this.ticks.length; i++) {
					this._addClass(this.ticks[i], this.options.handle);
				}
			}

			this._state.offset = this._offset(this.sliderElem);
			this._state.size = this.sliderElem[this.sizePos];
			this.setValue(this._state.value);

			/******************************************
   				Bind Event Listeners
   	******************************************/

			// Bind keyboard handlers
			this.handle1Keydown = this._keydown.bind(this, 0);
			this.handle1.addEventListener("keydown", this.handle1Keydown, false);

			this.handle2Keydown = this._keydown.bind(this, 1);
			this.handle2.addEventListener("keydown", this.handle2Keydown, false);

			this.mousedown = this._mousedown.bind(this);
			this.touchstart = this._touchstart.bind(this);
			this.touchmove = this._touchmove.bind(this);

			if (this.touchCapable) {
				this.sliderElem.addEventListener("touchstart", this.touchstart, false);
				this.sliderElem.addEventListener("touchmove", this.touchmove, false);
			}

			this.sliderElem.addEventListener("mousedown", this.mousedown, false);

			// Bind window handlers
			this.resize = this._resize.bind(this);
			window.addEventListener("resize", this.resize, false);

			// Bind tooltip-related handlers
			if (this.options.tooltip === 'hide') {
				this._addClass(this.tooltip, 'hide');
				this._addClass(this.tooltip_min, 'hide');
				this._addClass(this.tooltip_max, 'hide');
			} else if (this.options.tooltip === 'always') {
				this._showTooltip();
				this._alwaysShowTooltip = true;
			} else {
				this.showTooltip = this._showTooltip.bind(this);
				this.hideTooltip = this._hideTooltip.bind(this);

				if (this.options.ticks_tooltip) {
					var callbackHandle = this._addTickListener();
					//create handle1 listeners and store references in map
					var mouseEnter = callbackHandle.addMouseEnter(this, this.handle1);
					var mouseLeave = callbackHandle.addMouseLeave(this, this.handle1);
					this.handleCallbackMap.handle1 = {
						mouseEnter: mouseEnter,
						mouseLeave: mouseLeave
					};
					//create handle2 listeners and store references in map
					mouseEnter = callbackHandle.addMouseEnter(this, this.handle2);
					mouseLeave = callbackHandle.addMouseLeave(this, this.handle2);
					this.handleCallbackMap.handle2 = {
						mouseEnter: mouseEnter,
						mouseLeave: mouseLeave
					};
				} else {
					this.sliderElem.addEventListener("mouseenter", this.showTooltip, false);
					this.sliderElem.addEventListener("mouseleave", this.hideTooltip, false);

					if (this.touchCapable) {
						this.sliderElem.addEventListener("touchstart", this.showTooltip, false);
						this.sliderElem.addEventListener("touchmove", this.showTooltip, false);
						this.sliderElem.addEventListener("touchend", this.hideTooltip, false);
					}
				}

				this.handle1.addEventListener("focus", this.showTooltip, false);
				this.handle1.addEventListener("blur", this.hideTooltip, false);

				this.handle2.addEventListener("focus", this.showTooltip, false);
				this.handle2.addEventListener("blur", this.hideTooltip, false);

				if (this.touchCapable) {
					this.handle1.addEventListener("touchstart", this.showTooltip, false);
					this.handle1.addEventListener("touchmove", this.showTooltip, false);
					this.handle1.addEventListener("touchend", this.hideTooltip, false);

					this.handle2.addEventListener("touchstart", this.showTooltip, false);
					this.handle2.addEventListener("touchmove", this.showTooltip, false);
					this.handle2.addEventListener("touchend", this.hideTooltip, false);
				}
			}

			if (this.options.enabled) {
				this.enable();
			} else {
				this.disable();
			}
		}

		/*************************************************
  				INSTANCE PROPERTIES/METHODS
  	- Any methods bound to the prototype are considered
  part of the plugin's `public` interface
  	**************************************************/
		Slider.prototype = {
			_init: function _init() {}, // NOTE: Must exist to support bridget

			constructor: Slider,

			defaultOptions: {
				id: "",
				min: 0,
				max: 10,
				step: 1,
				precision: 0,
				orientation: 'horizontal',
				value: 5,
				range: false,
				selection: 'before',
				tooltip: 'show',
				tooltip_split: false,
				lock_to_ticks: false,
				handle: 'round',
				reversed: false,
				rtl: 'auto',
				enabled: true,
				formatter: function formatter(val) {
					if (Array.isArray(val)) {
						return val[0] + " : " + val[1];
					} else {
						return val;
					}
				},
				natural_arrow_keys: false,
				ticks: [],
				ticks_positions: [],
				ticks_labels: [],
				ticks_snap_bounds: 0,
				ticks_tooltip: false,
				scale: 'linear',
				focus: false,
				tooltip_position: null,
				labelledby: null,
				rangeHighlights: []
			},

			getElement: function getElement() {
				return this.sliderElem;
			},

			getValue: function getValue() {
				if (this.options.range) {
					return this._state.value;
				} else {
					return this._state.value[0];
				}
			},

			setValue: function setValue(val, triggerSlideEvent, triggerChangeEvent) {
				if (!val) {
					val = 0;
				}
				var oldValue = this.getValue();
				this._state.value = this._validateInputValue(val);
				var applyPrecision = this._applyPrecision.bind(this);

				if (this.options.range) {
					this._state.value[0] = applyPrecision(this._state.value[0]);
					this._state.value[1] = applyPrecision(this._state.value[1]);

					if (this.ticksAreValid && this.options.lock_to_ticks) {
						this._state.value[0] = this.options.ticks[this._getClosestTickIndex(this._state.value[0])];
						this._state.value[1] = this.options.ticks[this._getClosestTickIndex(this._state.value[1])];
					}

					this._state.value[0] = Math.max(this.options.min, Math.min(this.options.max, this._state.value[0]));
					this._state.value[1] = Math.max(this.options.min, Math.min(this.options.max, this._state.value[1]));
				} else {
					this._state.value = applyPrecision(this._state.value);

					if (this.ticksAreValid && this.options.lock_to_ticks) {
						this._state.value = this.options.ticks[this._getClosestTickIndex(this._state.value)];
					}

					this._state.value = [Math.max(this.options.min, Math.min(this.options.max, this._state.value))];
					this._addClass(this.handle2, 'hide');
					if (this.options.selection === 'after') {
						this._state.value[1] = this.options.max;
					} else {
						this._state.value[1] = this.options.min;
					}
				}

				// Determine which ticks the handle(s) are set at (if applicable)
				this._setTickIndex();

				if (this.options.max > this.options.min) {
					this._state.percentage = [this._toPercentage(this._state.value[0]), this._toPercentage(this._state.value[1]), this.options.step * 100 / (this.options.max - this.options.min)];
				} else {
					this._state.percentage = [0, 0, 100];
				}

				this._layout();
				var newValue = this.options.range ? this._state.value : this._state.value[0];

				this._setDataVal(newValue);
				if (triggerSlideEvent === true) {
					this._trigger('slide', newValue);
				}

				var hasChanged = false;
				if (Array.isArray(newValue)) {
					hasChanged = oldValue[0] !== newValue[0] || oldValue[1] !== newValue[1];
				} else {
					hasChanged = oldValue !== newValue;
				}

				if (hasChanged && triggerChangeEvent === true) {
					this._trigger('change', {
						oldValue: oldValue,
						newValue: newValue
					});
				}

				return this;
			},

			destroy: function destroy() {
				// Remove event handlers on slider elements
				this._removeSliderEventHandlers();

				// Remove the slider from the DOM
				this.sliderElem.parentNode.removeChild(this.sliderElem);
				/* Show original <input> element */
				this.element.style.display = "";

				// Clear out custom event bindings
				this._cleanUpEventCallbacksMap();

				// Remove data values
				this.element.removeAttribute("data");

				// Remove JQuery handlers/data
				if ($) {
					this._unbindJQueryEventHandlers();
					if (autoRegisterNamespace === NAMESPACE_MAIN) {
						this.$element.removeData(autoRegisterNamespace);
					}
					this.$element.removeData(NAMESPACE_ALTERNATE);
				}
			},

			disable: function disable() {
				this._state.enabled = false;
				this.handle1.removeAttribute("tabindex");
				this.handle2.removeAttribute("tabindex");
				this._addClass(this.sliderElem, 'slider-disabled');
				this._trigger('slideDisabled');

				return this;
			},

			enable: function enable() {
				this._state.enabled = true;
				this.handle1.setAttribute("tabindex", 0);
				this.handle2.setAttribute("tabindex", 0);
				this._removeClass(this.sliderElem, 'slider-disabled');
				this._trigger('slideEnabled');

				return this;
			},

			toggle: function toggle() {
				if (this._state.enabled) {
					this.disable();
				} else {
					this.enable();
				}
				return this;
			},

			isEnabled: function isEnabled() {
				return this._state.enabled;
			},

			on: function on(evt, callback) {
				this._bindNonQueryEventHandler(evt, callback);
				return this;
			},

			off: function off(evt, callback) {
				if ($) {
					this.$element.off(evt, callback);
					this.$sliderElem.off(evt, callback);
				} else {
					this._unbindNonQueryEventHandler(evt, callback);
				}
			},

			getAttribute: function getAttribute(attribute) {
				if (attribute) {
					return this.options[attribute];
				} else {
					return this.options;
				}
			},

			setAttribute: function setAttribute(attribute, value) {
				this.options[attribute] = value;
				return this;
			},

			refresh: function refresh(options) {
				var currentValue = this.getValue();
				this._removeSliderEventHandlers();
				createNewSlider.call(this, this.element, this.options);
				// Don't reset slider's value on refresh if `useCurrentValue` is true
				if (options && options.useCurrentValue === true) {
					this.setValue(currentValue);
				}
				if ($) {
					// Bind new instance of slider to the element
					if (autoRegisterNamespace === NAMESPACE_MAIN) {
						$.data(this.element, NAMESPACE_MAIN, this);
						$.data(this.element, NAMESPACE_ALTERNATE, this);
					} else {
						$.data(this.element, NAMESPACE_ALTERNATE, this);
					}
				}
				return this;
			},

			relayout: function relayout() {
				this._resize();
				return this;
			},

			/******************************+
   				HELPERS
   	- Any method that is not part of the public interface.
   - Place it underneath this comment block and write its signature like so:
   		_fnName : function() {...}
   	********************************/
			_removeTooltipListener: function _removeTooltipListener(event, handler) {
				this.handle1.removeEventListener(event, handler, false);
				this.handle2.removeEventListener(event, handler, false);
			},
			_removeSliderEventHandlers: function _removeSliderEventHandlers() {
				// Remove keydown event listeners
				this.handle1.removeEventListener("keydown", this.handle1Keydown, false);
				this.handle2.removeEventListener("keydown", this.handle2Keydown, false);

				//remove the listeners from the ticks and handles if they had their own listeners
				if (this.options.ticks_tooltip) {
					var ticks = this.ticksContainer.getElementsByClassName('slider-tick');
					for (var i = 0; i < ticks.length; i++) {
						ticks[i].removeEventListener('mouseenter', this.ticksCallbackMap[i].mouseEnter, false);
						ticks[i].removeEventListener('mouseleave', this.ticksCallbackMap[i].mouseLeave, false);
					}
					if (this.handleCallbackMap.handle1 && this.handleCallbackMap.handle2) {
						this.handle1.removeEventListener('mouseenter', this.handleCallbackMap.handle1.mouseEnter, false);
						this.handle2.removeEventListener('mouseenter', this.handleCallbackMap.handle2.mouseEnter, false);
						this.handle1.removeEventListener('mouseleave', this.handleCallbackMap.handle1.mouseLeave, false);
						this.handle2.removeEventListener('mouseleave', this.handleCallbackMap.handle2.mouseLeave, false);
					}
				}

				this.handleCallbackMap = null;
				this.ticksCallbackMap = null;

				if (this.showTooltip) {
					this._removeTooltipListener("focus", this.showTooltip);
				}
				if (this.hideTooltip) {
					this._removeTooltipListener("blur", this.hideTooltip);
				}

				// Remove event listeners from sliderElem
				if (this.showTooltip) {
					this.sliderElem.removeEventListener("mouseenter", this.showTooltip, false);
				}
				if (this.hideTooltip) {
					this.sliderElem.removeEventListener("mouseleave", this.hideTooltip, false);
				}

				this.sliderElem.removeEventListener("mousedown", this.mousedown, false);

				if (this.touchCapable) {
					// Remove touch event listeners from handles
					if (this.showTooltip) {
						this.handle1.removeEventListener("touchstart", this.showTooltip, false);
						this.handle1.removeEventListener("touchmove", this.showTooltip, false);
						this.handle2.removeEventListener("touchstart", this.showTooltip, false);
						this.handle2.removeEventListener("touchmove", this.showTooltip, false);
					}
					if (this.hideTooltip) {
						this.handle1.removeEventListener("touchend", this.hideTooltip, false);
						this.handle2.removeEventListener("touchend", this.hideTooltip, false);
					}

					// Remove event listeners from sliderElem
					if (this.showTooltip) {
						this.sliderElem.removeEventListener("touchstart", this.showTooltip, false);
						this.sliderElem.removeEventListener("touchmove", this.showTooltip, false);
					}
					if (this.hideTooltip) {
						this.sliderElem.removeEventListener("touchend", this.hideTooltip, false);
					}

					this.sliderElem.removeEventListener("touchstart", this.touchstart, false);
					this.sliderElem.removeEventListener("touchmove", this.touchmove, false);
				}

				// Remove window event listener
				window.removeEventListener("resize", this.resize, false);
			},
			_bindNonQueryEventHandler: function _bindNonQueryEventHandler(evt, callback) {
				if (this.eventToCallbackMap[evt] === undefined) {
					this.eventToCallbackMap[evt] = [];
				}
				this.eventToCallbackMap[evt].push(callback);
			},
			_unbindNonQueryEventHandler: function _unbindNonQueryEventHandler(evt, callback) {
				var callbacks = this.eventToCallbackMap[evt];
				if (callbacks !== undefined) {
					for (var i = 0; i < callbacks.length; i++) {
						if (callbacks[i] === callback) {
							callbacks.splice(i, 1);
							break;
						}
					}
				}
			},
			_cleanUpEventCallbacksMap: function _cleanUpEventCallbacksMap() {
				var eventNames = Object.keys(this.eventToCallbackMap);
				for (var i = 0; i < eventNames.length; i++) {
					var eventName = eventNames[i];
					delete this.eventToCallbackMap[eventName];
				}
			},
			_showTooltip: function _showTooltip() {
				if (this.options.tooltip_split === false) {
					this._addClass(this.tooltip, 'in');
					this.tooltip_min.style.display = 'none';
					this.tooltip_max.style.display = 'none';
				} else {
					this._addClass(this.tooltip_min, 'in');
					this._addClass(this.tooltip_max, 'in');
					this.tooltip.style.display = 'none';
				}
				this._state.over = true;
			},
			_hideTooltip: function _hideTooltip() {
				if (this._state.inDrag === false && this._alwaysShowTooltip !== true) {
					this._removeClass(this.tooltip, 'in');
					this._removeClass(this.tooltip_min, 'in');
					this._removeClass(this.tooltip_max, 'in');
				}
				this._state.over = false;
			},
			_setToolTipOnMouseOver: function _setToolTipOnMouseOver(tempState) {
				var self = this;
				var formattedTooltipVal = this.options.formatter(!tempState ? this._state.value[0] : tempState.value[0]);
				var positionPercentages = !tempState ? getPositionPercentages(this._state, this.options.reversed) : getPositionPercentages(tempState, this.options.reversed);
				this._setText(this.tooltipInner, formattedTooltipVal);

				this.tooltip.style[this.stylePos] = positionPercentages[0] + "%";

				function getPositionPercentages(state, reversed) {
					if (reversed) {
						return [100 - state.percentage[0], self.options.range ? 100 - state.percentage[1] : state.percentage[1]];
					}
					return [state.percentage[0], state.percentage[1]];
				}
			},
			_copyState: function _copyState() {
				return {
					value: [this._state.value[0], this._state.value[1]],
					enabled: this._state.enabled,
					offset: this._state.offset,
					size: this._state.size,
					percentage: [this._state.percentage[0], this._state.percentage[1], this._state.percentage[2]],
					inDrag: this._state.inDrag,
					over: this._state.over,
					// deleted or null'd keys
					dragged: this._state.dragged,
					keyCtrl: this._state.keyCtrl
				};
			},
			_addTickListener: function _addTickListener() {
				return {
					addMouseEnter: function addMouseEnter(reference, element, index) {
						var enter = function enter() {
							var tempState = reference._copyState();
							// Which handle is being hovered over?
							var val = element === reference.handle1 ? tempState.value[0] : tempState.value[1];
							var per = void 0;

							// Setup value and percentage for tick's 'mouseenter'
							if (index !== undefined) {
								val = reference.options.ticks[index];
								per = reference.options.ticks_positions.length > 0 && reference.options.ticks_positions[index] || reference._toPercentage(reference.options.ticks[index]);
							} else {
								per = reference._toPercentage(val);
							}

							tempState.value[0] = val;
							tempState.percentage[0] = per;
							reference._setToolTipOnMouseOver(tempState);
							reference._showTooltip();
						};
						element.addEventListener("mouseenter", enter, false);
						return enter;
					},
					addMouseLeave: function addMouseLeave(reference, element) {
						var leave = function leave() {
							reference._hideTooltip();
						};
						element.addEventListener("mouseleave", leave, false);
						return leave;
					}
				};
			},
			_layout: function _layout() {
				var positionPercentages;
				var formattedValue;

				if (this.options.reversed) {
					positionPercentages = [100 - this._state.percentage[0], this.options.range ? 100 - this._state.percentage[1] : this._state.percentage[1]];
				} else {
					positionPercentages = [this._state.percentage[0], this._state.percentage[1]];
				}

				this.handle1.style[this.stylePos] = positionPercentages[0] + "%";
				this.handle1.setAttribute('aria-valuenow', this._state.value[0]);
				formattedValue = this.options.formatter(this._state.value[0]);
				if (isNaN(formattedValue)) {
					this.handle1.setAttribute('aria-valuetext', formattedValue);
				} else {
					this.handle1.removeAttribute('aria-valuetext');
				}

				this.handle2.style[this.stylePos] = positionPercentages[1] + "%";
				this.handle2.setAttribute('aria-valuenow', this._state.value[1]);
				formattedValue = this.options.formatter(this._state.value[1]);
				if (isNaN(formattedValue)) {
					this.handle2.setAttribute('aria-valuetext', formattedValue);
				} else {
					this.handle2.removeAttribute('aria-valuetext');
				}

				/* Position highlight range elements */
				if (this.rangeHighlightElements.length > 0 && Array.isArray(this.options.rangeHighlights) && this.options.rangeHighlights.length > 0) {
					for (var _i = 0; _i < this.options.rangeHighlights.length; _i++) {
						var startPercent = this._toPercentage(this.options.rangeHighlights[_i].start);
						var endPercent = this._toPercentage(this.options.rangeHighlights[_i].end);

						if (this.options.reversed) {
							var sp = 100 - endPercent;
							endPercent = 100 - startPercent;
							startPercent = sp;
						}

						var currentRange = this._createHighlightRange(startPercent, endPercent);

						if (currentRange) {
							if (this.options.orientation === 'vertical') {
								this.rangeHighlightElements[_i].style.top = currentRange.start + "%";
								this.rangeHighlightElements[_i].style.height = currentRange.size + "%";
							} else {
								if (this.options.rtl) {
									this.rangeHighlightElements[_i].style.right = currentRange.start + "%";
								} else {
									this.rangeHighlightElements[_i].style.left = currentRange.start + "%";
								}
								this.rangeHighlightElements[_i].style.width = currentRange.size + "%";
							}
						} else {
							this.rangeHighlightElements[_i].style.display = "none";
						}
					}
				}

				/* Position ticks and labels */
				if (Array.isArray(this.options.ticks) && this.options.ticks.length > 0) {

					var styleSize = this.options.orientation === 'vertical' ? 'height' : 'width';
					var styleMargin;
					if (this.options.orientation === 'vertical') {
						styleMargin = 'marginTop';
					} else {
						if (this.options.rtl) {
							styleMargin = 'marginRight';
						} else {
							styleMargin = 'marginLeft';
						}
					}
					var labelSize = this._state.size / (this.options.ticks.length - 1);

					if (this.tickLabelContainer) {
						var extraMargin = 0;
						if (this.options.ticks_positions.length === 0) {
							if (this.options.orientation !== 'vertical') {
								this.tickLabelContainer.style[styleMargin] = -labelSize / 2 + "px";
							}

							extraMargin = this.tickLabelContainer.offsetHeight;
						} else {
							/* Chidren are position absolute, calculate height by finding the max offsetHeight of a child */
							for (i = 0; i < this.tickLabelContainer.childNodes.length; i++) {
								if (this.tickLabelContainer.childNodes[i].offsetHeight > extraMargin) {
									extraMargin = this.tickLabelContainer.childNodes[i].offsetHeight;
								}
							}
						}
						if (this.options.orientation === 'horizontal') {
							this.sliderElem.style.marginBottom = extraMargin + "px";
						}
					}
					for (var i = 0; i < this.options.ticks.length; i++) {

						var percentage = this.options.ticks_positions[i] || this._toPercentage(this.options.ticks[i]);

						if (this.options.reversed) {
							percentage = 100 - percentage;
						}

						this.ticks[i].style[this.stylePos] = percentage + "%";

						/* Set class labels to denote whether ticks are in the selection */
						this._removeClass(this.ticks[i], 'in-selection');
						if (!this.options.range) {
							if (this.options.selection === 'after' && percentage >= positionPercentages[0]) {
								this._addClass(this.ticks[i], 'in-selection');
							} else if (this.options.selection === 'before' && percentage <= positionPercentages[0]) {
								this._addClass(this.ticks[i], 'in-selection');
							}
						} else if (percentage >= positionPercentages[0] && percentage <= positionPercentages[1]) {
							this._addClass(this.ticks[i], 'in-selection');
						}

						if (this.tickLabels[i]) {
							this.tickLabels[i].style[styleSize] = labelSize + "px";

							if (this.options.orientation !== 'vertical' && this.options.ticks_positions[i] !== undefined) {
								this.tickLabels[i].style.position = 'absolute';
								this.tickLabels[i].style[this.stylePos] = percentage + "%";
								this.tickLabels[i].style[styleMargin] = -labelSize / 2 + 'px';
							} else if (this.options.orientation === 'vertical') {
								if (this.options.rtl) {
									this.tickLabels[i].style['marginRight'] = this.sliderElem.offsetWidth + "px";
								} else {
									this.tickLabels[i].style['marginLeft'] = this.sliderElem.offsetWidth + "px";
								}
								this.tickLabelContainer.style[styleMargin] = this.sliderElem.offsetWidth / 2 * -1 + 'px';
							}

							/* Set class labels to indicate tick labels are in the selection or selected */
							this._removeClass(this.tickLabels[i], 'label-in-selection label-is-selection');
							if (!this.options.range) {
								if (this.options.selection === 'after' && percentage >= positionPercentages[0]) {
									this._addClass(this.tickLabels[i], 'label-in-selection');
								} else if (this.options.selection === 'before' && percentage <= positionPercentages[0]) {
									this._addClass(this.tickLabels[i], 'label-in-selection');
								}
								if (percentage === positionPercentages[0]) {
									this._addClass(this.tickLabels[i], 'label-is-selection');
								}
							} else if (percentage >= positionPercentages[0] && percentage <= positionPercentages[1]) {
								this._addClass(this.tickLabels[i], 'label-in-selection');
								if (percentage === positionPercentages[0] || positionPercentages[1]) {
									this._addClass(this.tickLabels[i], 'label-is-selection');
								}
							}
						}
					}
				}

				var formattedTooltipVal;

				if (this.options.range) {
					formattedTooltipVal = this.options.formatter(this._state.value);
					this._setText(this.tooltipInner, formattedTooltipVal);
					this.tooltip.style[this.stylePos] = (positionPercentages[1] + positionPercentages[0]) / 2 + "%";

					var innerTooltipMinText = this.options.formatter(this._state.value[0]);
					this._setText(this.tooltipInner_min, innerTooltipMinText);

					var innerTooltipMaxText = this.options.formatter(this._state.value[1]);
					this._setText(this.tooltipInner_max, innerTooltipMaxText);

					this.tooltip_min.style[this.stylePos] = positionPercentages[0] + "%";

					this.tooltip_max.style[this.stylePos] = positionPercentages[1] + "%";
				} else {
					formattedTooltipVal = this.options.formatter(this._state.value[0]);
					this._setText(this.tooltipInner, formattedTooltipVal);

					this.tooltip.style[this.stylePos] = positionPercentages[0] + "%";
				}

				if (this.options.orientation === 'vertical') {
					this.trackLow.style.top = '0';
					this.trackLow.style.height = Math.min(positionPercentages[0], positionPercentages[1]) + '%';

					this.trackSelection.style.top = Math.min(positionPercentages[0], positionPercentages[1]) + '%';
					this.trackSelection.style.height = Math.abs(positionPercentages[0] - positionPercentages[1]) + '%';

					this.trackHigh.style.bottom = '0';
					this.trackHigh.style.height = 100 - Math.min(positionPercentages[0], positionPercentages[1]) - Math.abs(positionPercentages[0] - positionPercentages[1]) + '%';
				} else {
					if (this.stylePos === 'right') {
						this.trackLow.style.right = '0';
					} else {
						this.trackLow.style.left = '0';
					}
					this.trackLow.style.width = Math.min(positionPercentages[0], positionPercentages[1]) + '%';

					if (this.stylePos === 'right') {
						this.trackSelection.style.right = Math.min(positionPercentages[0], positionPercentages[1]) + '%';
					} else {
						this.trackSelection.style.left = Math.min(positionPercentages[0], positionPercentages[1]) + '%';
					}
					this.trackSelection.style.width = Math.abs(positionPercentages[0] - positionPercentages[1]) + '%';

					if (this.stylePos === 'right') {
						this.trackHigh.style.left = '0';
					} else {
						this.trackHigh.style.right = '0';
					}
					this.trackHigh.style.width = 100 - Math.min(positionPercentages[0], positionPercentages[1]) - Math.abs(positionPercentages[0] - positionPercentages[1]) + '%';

					var offset_min = this.tooltip_min.getBoundingClientRect();
					var offset_max = this.tooltip_max.getBoundingClientRect();

					if (this.options.tooltip_position === 'bottom') {
						if (offset_min.right > offset_max.left) {
							this._removeClass(this.tooltip_max, 'bottom');
							this._addClass(this.tooltip_max, 'top');
							this.tooltip_max.style.top = '';
							this.tooltip_max.style.bottom = 22 + 'px';
						} else {
							this._removeClass(this.tooltip_max, 'top');
							this._addClass(this.tooltip_max, 'bottom');
							this.tooltip_max.style.top = this.tooltip_min.style.top;
							this.tooltip_max.style.bottom = '';
						}
					} else {
						if (offset_min.right > offset_max.left) {
							this._removeClass(this.tooltip_max, 'top');
							this._addClass(this.tooltip_max, 'bottom');
							this.tooltip_max.style.top = 18 + 'px';
						} else {
							this._removeClass(this.tooltip_max, 'bottom');
							this._addClass(this.tooltip_max, 'top');
							this.tooltip_max.style.top = this.tooltip_min.style.top;
						}
					}
				}
			},
			_createHighlightRange: function _createHighlightRange(start, end) {
				if (this._isHighlightRange(start, end)) {
					if (start > end) {
						return { 'start': end, 'size': start - end };
					}
					return { 'start': start, 'size': end - start };
				}
				return null;
			},
			_isHighlightRange: function _isHighlightRange(start, end) {
				if (0 <= start && start <= 100 && 0 <= end && end <= 100) {
					return true;
				} else {
					return false;
				}
			},
			_resize: function _resize(ev) {
				/*jshint unused:false*/
				this._state.offset = this._offset(this.sliderElem);
				this._state.size = this.sliderElem[this.sizePos];
				this._layout();
			},
			_removeProperty: function _removeProperty(element, prop) {
				if (element.style.removeProperty) {
					element.style.removeProperty(prop);
				} else {
					element.style.removeAttribute(prop);
				}
			},
			_mousedown: function _mousedown(ev) {
				if (!this._state.enabled) {
					return false;
				}

				if (ev.preventDefault) {
					ev.preventDefault();
				}

				this._state.offset = this._offset(this.sliderElem);
				this._state.size = this.sliderElem[this.sizePos];

				var percentage = this._getPercentage(ev);

				if (this.options.range) {
					var diff1 = Math.abs(this._state.percentage[0] - percentage);
					var diff2 = Math.abs(this._state.percentage[1] - percentage);
					this._state.dragged = diff1 < diff2 ? 0 : 1;
					this._adjustPercentageForRangeSliders(percentage);
				} else {
					this._state.dragged = 0;
				}

				this._state.percentage[this._state.dragged] = percentage;

				if (this.touchCapable) {
					document.removeEventListener("touchmove", this.mousemove, false);
					document.removeEventListener("touchend", this.mouseup, false);
				}

				if (this.mousemove) {
					document.removeEventListener("mousemove", this.mousemove, false);
				}
				if (this.mouseup) {
					document.removeEventListener("mouseup", this.mouseup, false);
				}

				this.mousemove = this._mousemove.bind(this);
				this.mouseup = this._mouseup.bind(this);

				if (this.touchCapable) {
					// Touch: Bind touch events:
					document.addEventListener("touchmove", this.mousemove, false);
					document.addEventListener("touchend", this.mouseup, false);
				}
				// Bind mouse events:
				document.addEventListener("mousemove", this.mousemove, false);
				document.addEventListener("mouseup", this.mouseup, false);

				this._state.inDrag = true;
				var newValue = this._calculateValue();

				this._trigger('slideStart', newValue);

				this.setValue(newValue, false, true);

				ev.returnValue = false;

				if (this.options.focus) {
					this._triggerFocusOnHandle(this._state.dragged);
				}

				return true;
			},
			_touchstart: function _touchstart(ev) {
				this._mousedown(ev);
			},
			_triggerFocusOnHandle: function _triggerFocusOnHandle(handleIdx) {
				if (handleIdx === 0) {
					this.handle1.focus();
				}
				if (handleIdx === 1) {
					this.handle2.focus();
				}
			},
			_keydown: function _keydown(handleIdx, ev) {
				if (!this._state.enabled) {
					return false;
				}

				var dir;
				switch (ev.keyCode) {
					case 37: // left
					case 40:
						// down
						dir = -1;
						break;
					case 39: // right
					case 38:
						// up
						dir = 1;
						break;
				}
				if (!dir) {
					return;
				}

				// use natural arrow keys instead of from min to max
				if (this.options.natural_arrow_keys) {
					var isHorizontal = this.options.orientation === 'horizontal';
					var isVertical = this.options.orientation === 'vertical';
					var isRTL = this.options.rtl;
					var isReversed = this.options.reversed;

					if (isHorizontal) {
						if (isRTL) {
							if (!isReversed) {
								dir = -dir;
							}
						} else {
							if (isReversed) {
								dir = -dir;
							}
						}
					} else if (isVertical) {
						if (!isReversed) {
							dir = -dir;
						}
					}
				}

				var val;
				if (this.ticksAreValid && this.options.lock_to_ticks) {
					var index = void 0;
					// Find tick index that handle 1/2 is currently on
					index = this.options.ticks.indexOf(this._state.value[handleIdx]);
					if (index === -1) {
						// Set default to first tick
						index = 0;
						window.console.warn('(lock_to_ticks) _keydown: index should not be -1');
					}
					index += dir;
					index = Math.max(0, Math.min(this.options.ticks.length - 1, index));
					val = this.options.ticks[index];
				} else {
					val = this._state.value[handleIdx] + dir * this.options.step;
				}
				var percentage = this._toPercentage(val);
				this._state.keyCtrl = handleIdx;
				if (this.options.range) {
					this._adjustPercentageForRangeSliders(percentage);
					var val1 = !this._state.keyCtrl ? val : this._state.value[0];
					var val2 = this._state.keyCtrl ? val : this._state.value[1];
					// Restrict values within limits
					val = [Math.max(this.options.min, Math.min(this.options.max, val1)), Math.max(this.options.min, Math.min(this.options.max, val2))];
				} else {
					val = Math.max(this.options.min, Math.min(this.options.max, val));
				}

				this._trigger('slideStart', val);

				this.setValue(val, true, true);

				this._trigger('slideStop', val);

				this._pauseEvent(ev);
				delete this._state.keyCtrl;

				return false;
			},
			_pauseEvent: function _pauseEvent(ev) {
				if (ev.stopPropagation) {
					ev.stopPropagation();
				}
				if (ev.preventDefault) {
					ev.preventDefault();
				}
				ev.cancelBubble = true;
				ev.returnValue = false;
			},
			_mousemove: function _mousemove(ev) {
				if (!this._state.enabled) {
					return false;
				}

				var percentage = this._getPercentage(ev);
				this._adjustPercentageForRangeSliders(percentage);
				this._state.percentage[this._state.dragged] = percentage;

				var val = this._calculateValue(true);
				this.setValue(val, true, true);

				return false;
			},
			_touchmove: function _touchmove(ev) {
				if (ev.changedTouches === undefined) {
					return;
				}

				// Prevent page from scrolling and only drag the slider
				if (ev.preventDefault) {
					ev.preventDefault();
				}
			},
			_adjustPercentageForRangeSliders: function _adjustPercentageForRangeSliders(percentage) {
				if (this.options.range) {
					var precision = this._getNumDigitsAfterDecimalPlace(percentage);
					precision = precision ? precision - 1 : 0;
					var percentageWithAdjustedPrecision = this._applyToFixedAndParseFloat(percentage, precision);
					if (this._state.dragged === 0 && this._applyToFixedAndParseFloat(this._state.percentage[1], precision) < percentageWithAdjustedPrecision) {
						this._state.percentage[0] = this._state.percentage[1];
						this._state.dragged = 1;
					} else if (this._state.dragged === 1 && this._applyToFixedAndParseFloat(this._state.percentage[0], precision) > percentageWithAdjustedPrecision) {
						this._state.percentage[1] = this._state.percentage[0];
						this._state.dragged = 0;
					} else if (this._state.keyCtrl === 0 && this._toPercentage(this._state.value[1]) < percentage) {
						this._state.percentage[0] = this._state.percentage[1];
						this._state.keyCtrl = 1;
						this.handle2.focus();
					} else if (this._state.keyCtrl === 1 && this._toPercentage(this._state.value[0]) > percentage) {
						this._state.percentage[1] = this._state.percentage[0];
						this._state.keyCtrl = 0;
						this.handle1.focus();
					}
				}
			},
			_mouseup: function _mouseup(ev) {
				if (!this._state.enabled) {
					return false;
				}

				var percentage = this._getPercentage(ev);
				this._adjustPercentageForRangeSliders(percentage);
				this._state.percentage[this._state.dragged] = percentage;

				if (this.touchCapable) {
					// Touch: Unbind touch event handlers:
					document.removeEventListener("touchmove", this.mousemove, false);
					document.removeEventListener("touchend", this.mouseup, false);
				}
				// Unbind mouse event handlers:
				document.removeEventListener("mousemove", this.mousemove, false);
				document.removeEventListener("mouseup", this.mouseup, false);

				this._state.inDrag = false;
				if (this._state.over === false) {
					this._hideTooltip();
				}
				var val = this._calculateValue(true);

				this.setValue(val, false, true);
				this._trigger('slideStop', val);

				// No longer need 'dragged' after mouse up
				this._state.dragged = null;

				return false;
			},
			_setValues: function _setValues(index, val) {
				var comp = 0 === index ? 0 : 100;
				if (this._state.percentage[index] !== comp) {
					val.data[index] = this._toValue(this._state.percentage[index]);
					val.data[index] = this._applyPrecision(val.data[index]);
				}
			},
			_calculateValue: function _calculateValue(snapToClosestTick) {
				var val = {};
				if (this.options.range) {
					val.data = [this.options.min, this.options.max];
					this._setValues(0, val);
					this._setValues(1, val);
					if (snapToClosestTick) {
						val.data[0] = this._snapToClosestTick(val.data[0]);
						val.data[1] = this._snapToClosestTick(val.data[1]);
					}
				} else {
					val.data = this._toValue(this._state.percentage[0]);
					val.data = parseFloat(val.data);
					val.data = this._applyPrecision(val.data);
					if (snapToClosestTick) {
						val.data = this._snapToClosestTick(val.data);
					}
				}

				return val.data;
			},
			_snapToClosestTick: function _snapToClosestTick(val) {
				var min = [val, Infinity];
				for (var i = 0; i < this.options.ticks.length; i++) {
					var diff = Math.abs(this.options.ticks[i] - val);
					if (diff <= min[1]) {
						min = [this.options.ticks[i], diff];
					}
				}
				if (min[1] <= this.options.ticks_snap_bounds) {
					return min[0];
				}
				return val;
			},

			_applyPrecision: function _applyPrecision(val) {
				var precision = this.options.precision || this._getNumDigitsAfterDecimalPlace(this.options.step);
				return this._applyToFixedAndParseFloat(val, precision);
			},
			_getNumDigitsAfterDecimalPlace: function _getNumDigitsAfterDecimalPlace(num) {
				var match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
				if (!match) {
					return 0;
				}
				return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
			},
			_applyToFixedAndParseFloat: function _applyToFixedAndParseFloat(num, toFixedInput) {
				var truncatedNum = num.toFixed(toFixedInput);
				return parseFloat(truncatedNum);
			},
			/*
   	Credits to Mike Samuel for the following method!
   	Source: http://stackoverflow.com/questions/10454518/javascript-how-to-retrieve-the-number-of-decimals-of-a-string-number
   */
			_getPercentage: function _getPercentage(ev) {
				if (this.touchCapable && (ev.type === 'touchstart' || ev.type === 'touchmove' || ev.type === 'touchend')) {
					ev = ev.changedTouches[0];
				}

				var eventPosition = ev[this.mousePos];
				var sliderOffset = this._state.offset[this.stylePos];
				var distanceToSlide = eventPosition - sliderOffset;
				if (this.stylePos === 'right') {
					distanceToSlide = -distanceToSlide;
				}
				// Calculate what percent of the length the slider handle has slid
				var percentage = distanceToSlide / this._state.size * 100;
				percentage = Math.round(percentage / this._state.percentage[2]) * this._state.percentage[2];
				if (this.options.reversed) {
					percentage = 100 - percentage;
				}

				// Make sure the percent is within the bounds of the slider.
				// 0% corresponds to the 'min' value of the slide
				// 100% corresponds to the 'max' value of the slide
				return Math.max(0, Math.min(100, percentage));
			},
			_validateInputValue: function _validateInputValue(val) {
				if (!isNaN(+val)) {
					return +val;
				} else if (Array.isArray(val)) {
					this._validateArray(val);
					return val;
				} else {
					throw new Error(ErrorMsgs.formatInvalidInputErrorMsg(val));
				}
			},
			_validateArray: function _validateArray(val) {
				for (var i = 0; i < val.length; i++) {
					var input = val[i];
					if (typeof input !== 'number') {
						throw new Error(ErrorMsgs.formatInvalidInputErrorMsg(input));
					}
				}
			},
			_setDataVal: function _setDataVal(val) {
				this.element.setAttribute('data-value', val);
				this.element.setAttribute('value', val);
				this.element.value = val;
			},
			_trigger: function _trigger(evt, val) {
				val = val || val === 0 ? val : undefined;

				var callbackFnArray = this.eventToCallbackMap[evt];
				if (callbackFnArray && callbackFnArray.length) {
					for (var i = 0; i < callbackFnArray.length; i++) {
						var callbackFn = callbackFnArray[i];
						callbackFn(val);
					}
				}

				/* If JQuery exists, trigger JQuery events */
				if ($) {
					this._triggerJQueryEvent(evt, val);
				}
			},
			_triggerJQueryEvent: function _triggerJQueryEvent(evt, val) {
				var eventData = {
					type: evt,
					value: val
				};
				this.$element.trigger(eventData);
				this.$sliderElem.trigger(eventData);
			},
			_unbindJQueryEventHandlers: function _unbindJQueryEventHandlers() {
				this.$element.off();
				this.$sliderElem.off();
			},
			_setText: function _setText(element, text) {
				if (typeof element.textContent !== "undefined") {
					element.textContent = text;
				} else if (typeof element.innerText !== "undefined") {
					element.innerText = text;
				}
			},
			_removeClass: function _removeClass(element, classString) {
				var classes = classString.split(" ");
				var newClasses = element.className;

				for (var i = 0; i < classes.length; i++) {
					var classTag = classes[i];
					var regex = new RegExp("(?:\\s|^)" + classTag + "(?:\\s|$)");
					newClasses = newClasses.replace(regex, " ");
				}

				element.className = newClasses.trim();
			},
			_addClass: function _addClass(element, classString) {
				var classes = classString.split(" ");
				var newClasses = element.className;

				for (var i = 0; i < classes.length; i++) {
					var classTag = classes[i];
					var regex = new RegExp("(?:\\s|^)" + classTag + "(?:\\s|$)");
					var ifClassExists = regex.test(newClasses);

					if (!ifClassExists) {
						newClasses += " " + classTag;
					}
				}

				element.className = newClasses.trim();
			},
			_offsetLeft: function _offsetLeft(obj) {
				return obj.getBoundingClientRect().left;
			},
			_offsetRight: function _offsetRight(obj) {
				return obj.getBoundingClientRect().right;
			},
			_offsetTop: function _offsetTop(obj) {
				var offsetTop = obj.offsetTop;
				while ((obj = obj.offsetParent) && !isNaN(obj.offsetTop)) {
					offsetTop += obj.offsetTop;
					if (obj.tagName !== 'BODY') {
						offsetTop -= obj.scrollTop;
					}
				}
				return offsetTop;
			},
			_offset: function _offset(obj) {
				return {
					left: this._offsetLeft(obj),
					right: this._offsetRight(obj),
					top: this._offsetTop(obj)
				};
			},
			_css: function _css(elementRef, styleName, value) {
				if ($) {
					$.style(elementRef, styleName, value);
				} else {
					var style = styleName.replace(/^-ms-/, "ms-").replace(/-([\da-z])/gi, function (all, letter) {
						return letter.toUpperCase();
					});
					elementRef.style[style] = value;
				}
			},
			_toValue: function _toValue(percentage) {
				return this.options.scale.toValue.apply(this, [percentage]);
			},
			_toPercentage: function _toPercentage(value) {
				return this.options.scale.toPercentage.apply(this, [value]);
			},
			_setTooltipPosition: function _setTooltipPosition() {
				var tooltips = [this.tooltip, this.tooltip_min, this.tooltip_max];
				if (this.options.orientation === 'vertical') {
					var tooltipPos;
					if (this.options.tooltip_position) {
						tooltipPos = this.options.tooltip_position;
					} else {
						if (this.options.rtl) {
							tooltipPos = 'left';
						} else {
							tooltipPos = 'right';
						}
					}
					var oppositeSide = tooltipPos === 'left' ? 'right' : 'left';
					tooltips.forEach(function (tooltip) {
						this._addClass(tooltip, tooltipPos);
						tooltip.style[oppositeSide] = '100%';
					}.bind(this));
				} else if (this.options.tooltip_position === 'bottom') {
					tooltips.forEach(function (tooltip) {
						this._addClass(tooltip, 'bottom');
						tooltip.style.top = 22 + 'px';
					}.bind(this));
				} else {
					tooltips.forEach(function (tooltip) {
						this._addClass(tooltip, 'top');
						tooltip.style.top = -this.tooltip.outerHeight - 14 + 'px';
					}.bind(this));
				}
			},
			_getClosestTickIndex: function _getClosestTickIndex(val) {
				var difference = Math.abs(val - this.options.ticks[0]);
				var index = 0;
				for (var i = 0; i < this.options.ticks.length; ++i) {
					var d = Math.abs(val - this.options.ticks[i]);
					if (d < difference) {
						difference = d;
						index = i;
					}
				}
				return index;
			},
			/**
    * Attempts to find the index in `ticks[]` the slider values are set at.
    * The indexes can be -1 to indicate the slider value is not set at a value in `ticks[]`.
    */
			_setTickIndex: function _setTickIndex() {
				if (this.ticksAreValid) {
					this._state.tickIndex = [this.options.ticks.indexOf(this._state.value[0]), this.options.ticks.indexOf(this._state.value[1])];
				}
			}
		};

		/*********************************
  		Attach to global namespace
  	*********************************/
		if ($ && $.fn) {
			if (!$.fn.slider) {
				$.bridget(NAMESPACE_MAIN, Slider);
				autoRegisterNamespace = NAMESPACE_MAIN;
			} else {
				if (windowIsDefined) {
					window.console.warn("bootstrap-slider.js - WARNING: $.fn.slider namespace is already bound. Use the $.fn.bootstrapSlider namespace instead.");
				}
				autoRegisterNamespace = NAMESPACE_ALTERNATE;
			}
			$.bridget(NAMESPACE_ALTERNATE, Slider);

			// Auto-Register data-provide="slider" Elements
			$(function () {
				$("input[data-provide=slider]")[autoRegisterNamespace]();
			});
		}
	})($);

	return Slider;
});

/*!
 * accounting.js v0.4.1
 * Copyright 2014 Open Exchange Rates
 *
 * Freely distributable under the MIT license.
 * Portions of accounting.js are inspired or borrowed from underscore.js
 *
 * Full details and documentation:
 * http://openexchangerates.github.io/accounting.js/
 */

(function(root, undefined) {

	/* --- Setup --- */

	// Create the local library object, to be exported or referenced globally later
	var lib = {};

	// Current version
	lib.version = '0.4.1';


	/* --- Exposed settings --- */

	// The library's settings configuration object. Contains default parameters for
	// currency and number formatting
	lib.settings = {
		currency: {
			symbol : "$",		// default currency symbol is '$'
			format : "%s%v",	// controls output: %s = symbol, %v = value (can be object, see docs)
			decimal : ".",		// decimal point separator
			thousand : ",",		// thousands separator
			precision : 2,		// decimal places
			grouping : 3		// digit grouping (not implemented yet)
		},
		number: {
			precision : 0,		// default precision on numbers is 0
			grouping : 3,		// digit grouping (not implemented yet)
			thousand : ",",
			decimal : "."
		}
	};


	/* --- Internal Helper Methods --- */

	// Store reference to possibly-available ECMAScript 5 methods for later
	var nativeMap = Array.prototype.map,
		nativeIsArray = Array.isArray,
		toString = Object.prototype.toString;

	/**
	 * Tests whether supplied parameter is a string
	 * from underscore.js
	 */
	function isString(obj) {
		return !!(obj === '' || (obj && obj.charCodeAt && obj.substr));
	}

	/**
	 * Tests whether supplied parameter is a string
	 * from underscore.js, delegates to ECMA5's native Array.isArray
	 */
	function isArray(obj) {
		return nativeIsArray ? nativeIsArray(obj) : toString.call(obj) === '[object Array]';
	}

	/**
	 * Tests whether supplied parameter is a true object
	 */
	function isObject(obj) {
		return obj && toString.call(obj) === '[object Object]';
	}

	/**
	 * Extends an object with a defaults object, similar to underscore's _.defaults
	 *
	 * Used for abstracting parameter handling from API methods
	 */
	function defaults(object, defs) {
		var key;
		object = object || {};
		defs = defs || {};
		// Iterate over object non-prototype properties:
		for (key in defs) {
			if (defs.hasOwnProperty(key)) {
				// Replace values with defaults only if undefined (allow empty/zero values):
				if (object[key] == null) object[key] = defs[key];
			}
		}
		return object;
	}

	/**
	 * Implementation of `Array.map()` for iteration loops
	 *
	 * Returns a new Array as a result of calling `iterator` on each array value.
	 * Defers to native Array.map if available
	 */
	function map(obj, iterator, context) {
		var results = [], i, j;

		if (!obj) return results;

		// Use native .map method if it exists:
		if (nativeMap && obj.map === nativeMap) return obj.map(iterator, context);

		// Fallback for native .map:
		for (i = 0, j = obj.length; i < j; i++ ) {
			results[i] = iterator.call(context, obj[i], i, obj);
		}
		return results;
	}

	/**
	 * Check and normalise the value of precision (must be positive integer)
	 */
	function checkPrecision(val, base) {
		val = Math.round(Math.abs(val));
		return isNaN(val)? base : val;
	}


	/**
	 * Parses a format string or object and returns format obj for use in rendering
	 *
	 * `format` is either a string with the default (positive) format, or object
	 * containing `pos` (required), `neg` and `zero` values (or a function returning
	 * either a string or object)
	 *
	 * Either string or format.pos must contain "%v" (value) to be valid
	 */
	function checkCurrencyFormat(format) {
		var defaults = lib.settings.currency.format;

		// Allow function as format parameter (should return string or object):
		if ( typeof format === "function" ) format = format();

		// Format can be a string, in which case `value` ("%v") must be present:
		if ( isString( format ) && format.match("%v") ) {

			// Create and return positive, negative and zero formats:
			return {
				pos : format,
				neg : format.replace("-", "").replace("%v", "-%v"),
				zero : format
			};

		// If no format, or object is missing valid positive value, use defaults:
		} else if ( !format || !format.pos || !format.pos.match("%v") ) {

			// If defaults is a string, casts it to an object for faster checking next time:
			return ( !isString( defaults ) ) ? defaults : lib.settings.currency.format = {
				pos : defaults,
				neg : defaults.replace("%v", "-%v"),
				zero : defaults
			};

		}
		// Otherwise, assume format was fine:
		return format;
	}


	/* --- API Methods --- */

	/**
	 * Takes a string/array of strings, removes all formatting/cruft and returns the raw float value
	 * Alias: `accounting.parse(string)`
	 *
	 * Decimal must be included in the regular expression to match floats (defaults to
	 * accounting.settings.number.decimal), so if the number uses a non-standard decimal 
	 * separator, provide it as the second argument.
	 *
	 * Also matches bracketed negatives (eg. "$ (1.99)" => -1.99)
	 *
	 * Doesn't throw any errors (`NaN`s become 0) but this may change in future
	 */
	var unformat = lib.unformat = lib.parse = function(value, decimal) {
		// Recursively unformat arrays:
		if (isArray(value)) {
			return map(value, function(val) {
				return unformat(val, decimal);
			});
		}

		// Fails silently (need decent errors):
		value = value || 0;

		// Return the value as-is if it's already a number:
		if (typeof value === "number") return value;

		// Default decimal point comes from settings, but could be set to eg. "," in opts:
		decimal = decimal || lib.settings.number.decimal;

		 // Build regex to strip out everything except digits, decimal point and minus sign:
		var regex = new RegExp("[^0-9-" + decimal + "]", ["g"]),
			unformatted = parseFloat(
				("" + value)
				.replace(/\((.*)\)/, "-$1") // replace bracketed values with negatives
				.replace(regex, '')         // strip out any cruft
				.replace(decimal, '.')      // make sure decimal point is standard
			);

		// This will fail silently which may cause trouble, let's wait and see:
		return !isNaN(unformatted) ? unformatted : 0;
	};


	/**
	 * Implementation of toFixed() that treats floats more like decimals
	 *
	 * Fixes binary rounding issues (eg. (0.615).toFixed(2) === "0.61") that present
	 * problems for accounting- and finance-related software.
	 */
	var toFixed = lib.toFixed = function(value, precision) {
		precision = checkPrecision(precision, lib.settings.number.precision);
		var power = Math.pow(10, precision);

		// Multiply up by precision, round accurately, then divide and use native toFixed():
		return (Math.round(lib.unformat(value) * power) / power).toFixed(precision);
	};


	/**
	 * Format a number, with comma-separated thousands and custom precision/decimal places
	 * Alias: `accounting.format()`
	 *
	 * Localise by overriding the precision and thousand / decimal separators
	 * 2nd parameter `precision` can be an object matching `settings.number`
	 */
	var formatNumber = lib.formatNumber = lib.format = function(number, precision, thousand, decimal) {
		// Resursively format arrays:
		if (isArray(number)) {
			return map(number, function(val) {
				return formatNumber(val, precision, thousand, decimal);
			});
		}

		// Clean up number:
		number = unformat(number);

		// Build options object from second param (if object) or all params, extending defaults:
		var opts = defaults(
				(isObject(precision) ? precision : {
					precision : precision,
					thousand : thousand,
					decimal : decimal
				}),
				lib.settings.number
			),

			// Clean up precision
			usePrecision = checkPrecision(opts.precision),

			// Do some calc:
			negative = number < 0 ? "-" : "",
			base = parseInt(toFixed(Math.abs(number || 0), usePrecision), 10) + "",
			mod = base.length > 3 ? base.length % 3 : 0;

		// Format the number:
		return negative + (mod ? base.substr(0, mod) + opts.thousand : "") + base.substr(mod).replace(/(\d{3})(?=\d)/g, "$1" + opts.thousand) + (usePrecision ? opts.decimal + toFixed(Math.abs(number), usePrecision).split('.')[1] : "");
	};


	/**
	 * Format a number into currency
	 *
	 * Usage: accounting.formatMoney(number, symbol, precision, thousandsSep, decimalSep, format)
	 * defaults: (0, "$", 2, ",", ".", "%s%v")
	 *
	 * Localise by overriding the symbol, precision, thousand / decimal separators and format
	 * Second param can be an object matching `settings.currency` which is the easiest way.
	 *
	 * To do: tidy up the parameters
	 */
	var formatMoney = lib.formatMoney = function(number, symbol, precision, thousand, decimal, format) {
		// Resursively format arrays:
		if (isArray(number)) {
			return map(number, function(val){
				return formatMoney(val, symbol, precision, thousand, decimal, format);
			});
		}

		// Clean up number:
		number = unformat(number);

		// Build options object from second param (if object) or all params, extending defaults:
		var opts = defaults(
				(isObject(symbol) ? symbol : {
					symbol : symbol,
					precision : precision,
					thousand : thousand,
					decimal : decimal,
					format : format
				}),
				lib.settings.currency
			),

			// Check format (returns object with pos, neg and zero):
			formats = checkCurrencyFormat(opts.format),

			// Choose which format to use for this value:
			useFormat = number > 0 ? formats.pos : number < 0 ? formats.neg : formats.zero;

		// Return with currency symbol added:
		return useFormat.replace('%s', opts.symbol).replace('%v', formatNumber(Math.abs(number), checkPrecision(opts.precision), opts.thousand, opts.decimal));
	};


	/**
	 * Format a list of numbers into an accounting column, padding with whitespace
	 * to line up currency symbols, thousand separators and decimals places
	 *
	 * List should be an array of numbers
	 * Second parameter can be an object containing keys that match the params
	 *
	 * Returns array of accouting-formatted number strings of same length
	 *
	 * NB: `white-space:pre` CSS rule is required on the list container to prevent
	 * browsers from collapsing the whitespace in the output strings.
	 */
	lib.formatColumn = function(list, symbol, precision, thousand, decimal, format) {
		if (!list) return [];

		// Build options object from second param (if object) or all params, extending defaults:
		var opts = defaults(
				(isObject(symbol) ? symbol : {
					symbol : symbol,
					precision : precision,
					thousand : thousand,
					decimal : decimal,
					format : format
				}),
				lib.settings.currency
			),

			// Check format (returns object with pos, neg and zero), only need pos for now:
			formats = checkCurrencyFormat(opts.format),

			// Whether to pad at start of string or after currency symbol:
			padAfterSymbol = formats.pos.indexOf("%s") < formats.pos.indexOf("%v") ? true : false,

			// Store value for the length of the longest string in the column:
			maxLength = 0,

			// Format the list according to options, store the length of the longest string:
			formatted = map(list, function(val, i) {
				if (isArray(val)) {
					// Recursively format columns if list is a multi-dimensional array:
					return lib.formatColumn(val, opts);
				} else {
					// Clean up the value
					val = unformat(val);

					// Choose which format to use for this value (pos, neg or zero):
					var useFormat = val > 0 ? formats.pos : val < 0 ? formats.neg : formats.zero,

						// Format this value, push into formatted list and save the length:
						fVal = useFormat.replace('%s', opts.symbol).replace('%v', formatNumber(Math.abs(val), checkPrecision(opts.precision), opts.thousand, opts.decimal));

					if (fVal.length > maxLength) maxLength = fVal.length;
					return fVal;
				}
			});

		// Pad each number in the list and send back the column of numbers:
		return map(formatted, function(val, i) {
			// Only if this is a string (not a nested array, which would have already been padded):
			if (isString(val) && val.length < maxLength) {
				// Depending on symbol position, pad after symbol or at index 0:
				return padAfterSymbol ? val.replace(opts.symbol, opts.symbol+(new Array(maxLength - val.length + 1).join(" "))) : (new Array(maxLength - val.length + 1).join(" ")) + val;
			}
			return val;
		});
	};


	/* --- Module Definition --- */

	// Export accounting for CommonJS. If being loaded as an AMD module, define it as such.
	// Otherwise, just add `accounting` to the global object
	if (typeof exports !== 'undefined') {
		if (typeof module !== 'undefined' && module.exports) {
			exports = module.exports = lib;
		}
		exports.accounting = lib;
	} else if (typeof define === 'function' && define.amd) {
		// Return the library as an AMD module:
		define([], function() {
			return lib;
		});
	} else {
		// Use accounting.noConflict to restore `accounting` back to its original value.
		// Returns a reference to the library's `accounting` object;
		// e.g. `var numbers = accounting.noConflict();`
		lib.noConflict = (function(oldAccounting) {
			return function() {
				// Reset the value of the root's `accounting` variable:
				root.accounting = oldAccounting;
				// Delete the noConflict method:
				lib.noConflict = undefined;
				// Return reference to the library to re-assign it:
				return lib;
			};
		})(root.accounting);

		// Declare `fx` on the root (global/window) object:
		root['accounting'] = lib;
	}

	// Root will be `window` in browser or `global` on the server:
}(this));

/* jshint ignore:start */
function setCookies(h, g, f) {
	var e = new Date();
	e.setDate(e.getDate() + f);
	document.cookie = h + "=" + escape(g) + ((f == null) ? "" : ";expires=" + e.toGMTString()) + ";path=/";
}

function getCookies(a) {
    var c_start;
	return document.cookie.length > 0 && (c_start = document.cookie.indexOf(a + "="), -1 != c_start) ? (c_start = c_start + a.length + 1, c_end = document.cookie.indexOf(";", c_start), -1 == c_end && (c_end = document.cookie.length), unescape(document.cookie.substring(c_start, c_end))) : "";
}

function getRequest() {
	var e = location.search;
    var f = new Object();
	if (e.indexOf("?") != -1) {
		var g = e.substr(1);
		var strs = g.split("&");
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
		var wow = new WOW({
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
	var mainBarOffsetTop = jQuery('.c-mainbar').length > 0 ? jQuery('.c-mainbar').offset().top : 0;
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

function offset(el) {
    var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}


var stickyScroll = function() {
	return {
		init: function() {
			var mainNavLinks = document.querySelectorAll(".nav--sticky ul li a");
			// var mainSections = document.querySelectorAll(".content--sticky > article");

			window.addEventListener("scroll", function(event) {
				var fromTop = window.scrollY;

				mainNavLinks.forEach(function(link) {
					var section = document.querySelector(link.hash);
                    var menuOffset = 132;

					if (fromTop >= (parseInt(offset(section).top) - menuOffset) && fromTop < (parseInt(offset(section).top + section.offsetHeight) - menuOffset)) {
						link.classList.add("active");
					} else {
						link.classList.remove("active");
					}
				});
			});
		}
	};
}();

var Demandbase_Target_Account = 0;
var Demandbase_CompanyName = '';
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
	stickyScroll.init();
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
		window.location.href = commGlobal.site_url + "/requestdemo/success/?requesttype=general";
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

  	(function getDemandbaseInfo() {
		var transferData ={};
		transferData.action = 'getDemandbaseInfo_action';
		jQuery.ajax({
			type: 'POST',
			url: commGlobal.ajax_url,
			data: transferData,
			success: function(msg) {
				if (msg) {
					var demandbaseInfo = JSON.parse(msg);
					Demandbase_CompanyName = demandbaseInfo.marketing_alias || demandbaseInfo.company_name || '';
					Comm100API.onReady = function () {
						var divId = 'comm100-container';
						var divObj = document.getElementById(divId);
						Comm100API.on && Comm100API.on('livechat.invitation.display', function () {

							var iframe = divObj.getElementsByTagName("iframe");
							if (iframe != null) {
								// var all = iframe[0].contentWindow.document.getElementsByTagName("div");
								// for (var i = 0; i < all.length; i++) {
								// 	if (all[i].className === "invitation__message") {
								// 		all[i].innerHTML = all[i].innerHTML.replace("{company name}", Demandbase_CompanyName);
								// 		break;
								// 	}
								// }
								var invitation = iframe[0].contentWindow.document.querySelector('.invitation__message');
								invitation.innerHTML = invitation.innerHTML.replace("{company name}", Demandbase_CompanyName);
							}

						});
					}


					var demandDomains = [
						'gartner.com',
						'forrester.com',
						'ovum.informa.com',
						'juniperresearch.com',
						'ventanaresearch.com',
						'aberdeen.com',
						// 'comm100.com',
					];
					// Demandbase_Target_Account
					// var demandbaseTargetAccount = '';
					setTimeout(function() {
						if (demandbaseInfo.web_site && demandDomains.indexOf(demandbaseInfo.web_site.toLowerCase())) {
							Demandbase_Target_Account = 1;
						} else {
							var demandBaseRevenueRange = demandbaseInfo.revenue_range;
							if (demandBaseRevenueRange) {
								var regex = /\$[0-9]*(M|B)(( - \$[0-9]*(M|B))?)/gi;
								demandBaseRevenueRange = demandBaseRevenueRange.replace(/(^\s+)|(\s+$)|\s+/g, '')  //remove blank space
																			.replace(/\$/gi, '')
																			.replace(/M/gi, '000000')
																			.replace(/B/gi, '000000000');
								var demandBaseRevenueRangeArray = demandBaseRevenueRange.split('-');
								if (demandBaseRevenueRangeArray.length > 1 &&
									demandBaseRevenueRangeArray[0] >= 100000000 &&
									demandBaseRevenueRangeArray[1] <= 5000000000) {
										Demandbase_Target_Account = 1;
								} else if (demandBaseRevenueRangeArray[0] >= 100000000 &&
									demandBaseRevenueRangeArray[0] <= 5000000000) {
										Demandbase_Target_Account = 1;
								}
							}
						}
					}, 3000);



					// Demandbase_Target_Account = 1; // test
					// var campaignIds = Comm100API && Comm100API.get('livechat.campaignIds');
					// if (campaignIds) {

				}
			}
		});
	})();


  function showVisitorIP() {
    var ajaxData = {
        'action': 'getVisitorIP_action'
    };

    jQuery.ajax({
        type: 'GET',
        url: commGlobal.theme_url + '/ajax/get_user_ip.php', //commGlobal.ajax_url. Changed to simple PHP script so we don't have to fully load the theme to call the admin ajax method.
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
				window.location.href = commGlobal.site_url + "/requestdemo/success/?type=dedicated";
			}
		});
		return false;
	});
	jQuery(document).on("click", ".download-link, .download-link2", function(e) {
		window.location.href = commGlobal.site_url + "/resources/thankyou/?whitepapertype=" + jQuery(this).data("source");
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
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/chat-to-visit-report/">Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/live-chat-buyers-guide.aspx">How to Choose the Best Live Chat Software: A Buyer\'s Guide</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/top-ten-ways-increase-sales.aspx">The Top Ten Ways That Live Chat Can Increase Sales</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/dealing-with-difficult-customers-over-live-chat/">How to Deal with Difficult Customers over Live Chat</a></li>');
				jQuery("#fetchmore").html("You can also drop by <a href=\"" + commGlobal.site_url + "/blog/?c_cid=whitepaper_2017benchmarkreport\">Comm100 blog</a> to fetch more fresh content on customer service topics including agent skill training, customer retention, website optimization, etc.");
				break;
			case "50activities":
				jQuery("#thankyoufordownload-title").html("50 Customer Service Training Activities for Live Chat and Telephone Teams");
				jQuery("#whitepaperdownloadlink").attr("href", commGlobal.site_url + "/doc/comm100-50-customer-service-training-activities.pdf");
				jQuery("#whitepaperdownload-img").attr("src", commGlobal.site_url + "/wp-content/uploads/images/whitepaper-50-activities-landing.png");
				jQuery("#whitepaperlike").html(
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/live-chat-benchmark-report-2017/">Live Chat Benchmark Report 2017</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/live-chat-support-scripts.aspx">120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/top-performing-chat-operator/">The Guide to Becoming a Top Performing Live Chat Agent</a></li>'+
					'<li><a href="' + commGlobal.site_url + '/livechat/resources/dealing-with-difficult-customers-over-live-chat/">How to Deal with Difficult Customers over Live Chat</a></li>');
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


var scrolling = false;
function disableMouseWheel () {
    scrolling = true;
}
function enableMouseWheel() {
    scrolling = false;
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

jQuery(function() {
	(function(){
		var isMobile = window.mobilecheck();
		if (!isMobile) {
			var headerHeight = jQuery('.c-layout-header').outerHeight() - jQuery('.c-layout-header .c-topbar.c-navbar').outerHeight();
			var tabIndexWrap = document.querySelector('.threeTab__Index--Wrap');
			var isTabHasDataWheel = tabIndexWrap && tabIndexWrap.getAttribute('data-wheel') === 'true';
			if (isTabHasDataWheel) {
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
			}

			function selectTab(index){
				jQuery('.threeTab__Index').removeClass('selected').eq(index).addClass('selected');
				jQuery('.threeTab__Detail').hide();
				jQuery('.threeTab__Detail').eq(index).show();
				switch(index){
					case 0:jQuery('head').append("<style>.pricing .threeTab__Index--Wrap:after{ border-bottom: solid  #0094d4 6px; }</style>");jQuery('.threeTab__Detail--bottomLink a').attr('href','/platform/featurelist/#lc');break;
					case 1:jQuery('head').append("<style>.pricing .threeTab__Index--Wrap:after{ border-bottom: solid  #3dc4ff 6px; }</style>");jQuery('.threeTab__Detail--bottomLink a').attr('href','/platform/featurelist/#oc');break;
					case 2:jQuery('head').append("<style>.pricing .threeTab__Index--Wrap:after{ border-bottom: solid  #9fdd09 6px; }</style>");jQuery('.threeTab__Detail--bottomLink a').attr('href','/platform/featurelist/#ai');break;
					default:break
				}
				// feature list
				jQuery('.featurelist-wrap').hide();
				jQuery('.featurelist-wrap').eq(index).show()
			}

			var tabIndexItems = document.querySelectorAll('.threeTab__Index');
			var tabIndexItemsArray = Array.prototype.slice.call(tabIndexItems);
			tabIndexItemsArray.forEach(function(item, index) {
				item.addEventListener('click', function() {
					isTabHasDataWheel && tabIndexSlideUpOrDown(true);
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
					case '#oc': selectTab(1); break;
					case '#ai': selectTab(2); break;
					default: selectTab(0); break;
				}
			}
			if (tabIndexWrap && isTabHasDataWheel) {
				setTimeout(function() {
					if (Math.ceil(jQuery('.threeTab__Index--Wrap').offset().top) - jQuery(window).scrollTop() === jQuery('.c-layout-header').outerHeight()) {
						tabIndexSlideUpOrDown(true);
					}
				}, 100);
			}
		} else {
			jQuery('.threeTab__Index--Wrap').hide();
			jQuery('.threeTab__Index--mobile').show();
		}

        jQuery('.panel-collapse').on('shown.bs.collapse', function (e) {
            var panel = jQuery(this).closest('.panel');

            jQuery('html,body').animate({
                scrollTop: jQuery(panel).offset().top - 100
            }, 400);
        });

		jQuery('.question-item__title').on('click', function() {
			jQuery(this).parent().toggleClass('selected');
			jQuery(this).siblings().slideToggle(200, function() {
			});
		});

		jQuery('.featurelist-title').on('click', function () {
            jQuery(this).toggleClass('featurelist-title--close');
            jQuery(this).next('.featurelist-content').slideToggle(200);
		});

		jQuery('.collapse__title').on('click', function () {
            jQuery(this).toggleClass('collapse__title--open');
            jQuery(this).next('.collapse__content').slideToggle(200);
        });

		if (!window.mobilecheck()) {
			Pager.init(jQuery('.resource-list'), 12);
		}
	}());
});

function calculate_chatbot_roi($) {
    var roiPDFUrl = commGlobal.site_url + '/pdfgen/chatbot-roi/?';
    var regex = new RegExp(',', 'g');

    var activeAgents = parseInt($('#active_agents').val().replace(regex, ''));
    roiPDFUrl += 'num_agents=' + activeAgents + '&';

    var callCenterHoursDay = parseInt($('#call_center_hours_day').val().replace(regex, ''));

    if (callCenterHoursDay > 24) {
        callCenterHoursDay = 24;
        $('#call_center_hours_day').val(24);
    } else if (callCenterHoursDay <= 0) {
        callCenterHoursDay = 1;
        $('#call_center_hours_day').val(1);
    }

    roiPDFUrl += 'hours=' + callCenterHoursDay + '&';

    var callCenterDaysWeek = parseInt($('#call_center_days_week').val().replace(regex, ''));

    if (callCenterDaysWeek > 7) {
        callCenterDaysWeek = 7;
        $('#call_center_days_week').val(7);
    } else if (callCenterDaysWeek <= 0) {
        callCenterDaysWeek = 1;
        $('#call_center_days_week').val(1);
    }

    roiPDFUrl += 'days=' + callCenterDaysWeek + '&';

    var callCenterWeeksYear = parseInt($('#call_center_weeks_year').val().replace(regex, ''));

    if (callCenterWeeksYear > 52) {
        callCenterWeeksYear = 52;
        $('#call_center_weeks_year').val(52);
    } else if (callCenterWeeksYear <= 0) {
        callCenterWeeksYear = 1;
        $('#call_center_weeks_year').val(1);
    }

    roiPDFUrl += 'weeks=' + callCenterWeeksYear + '&';

    var agentCompensation = parseInt($('#agent_compensation').val().replace(regex, ''));
    roiPDFUrl += 'compensation=' + accounting.formatNumber(agentCompensation, 0) + '&';
    roiPDFUrl += 'total_compensation=' + accounting.formatNumber(activeAgents * agentCompensation, 0) + '&';

    var chatLength = parseInt($('#chat_length').val().replace(regex, ''));
    roiPDFUrl += 'chat_length=' + chatLength + '&';

    var concurrentChats = parseInt($('#concurrent_chats').val().replace(regex, ''));
    roiPDFUrl += 'chats_per_agent=' + concurrentChats + '&';

    var chatVolumeGrowth = parseInt($('#chat_volume_growth').val().replace(regex, ''));
    roiPDFUrl += 'chat_volume_growth=' + chatVolumeGrowth + '&';

    accounting.settings.currency.format = "%v";

    // $percentRedirectionResult.html(accounting.formatNumber(totalDeflectedCalls, 0));

    var callCenterDaysYear = callCenterDaysWeek * callCenterWeeksYear;
    var chatHour = (60 / chatLength) * concurrentChats;

    var workCapacity = callCenterDaysYear * callCenterHoursDay;
    var chatsYear = workCapacity * activeAgents * chatHour;

    $('#current_chat_capacity').html(accounting.formatNumber(chatsYear, 0));
    roiPDFUrl += 'current_chat_capacity=' + accounting.formatNumber(chatsYear, 0) + '&';

    var futureChatsYear = chatsYear;
    var chatVolumeGrowthMultiplier = 0;
    var chatVolumeGrowthPercent = 0;

    if (chatVolumeGrowth > 0) {
        chatVolumeGrowthPercent = (chatVolumeGrowth / 100);
        chatVolumeGrowthMultiplier = chatVolumeGrowthPercent + 1;
        // console.log(chatVolumeGrowthPercet + 1);
        futureChatsYear = futureChatsYear * chatVolumeGrowthMultiplier;
    }

    $('#future_chat_capacity').html(accounting.formatNumber(futureChatsYear, 0));
    roiPDFUrl += 'future_chat_capacity=' + accounting.formatNumber(futureChatsYear, 0) + '&';

    var additionalChats = futureChatsYear - chatsYear;
    roiPDFUrl += 'additional_chat_capacity=' + accounting.formatNumber(additionalChats, 0) + '&';


    var futureTeamAdditions = 0;
    var futureTeamTotal = activeAgents;
    var futureTeamBots = 0;

    if (additionalChats > 0) {
        var additionalHours = workCapacity * chatVolumeGrowthPercent;
        futureTeamAdditions = Math.ceil(chatVolumeGrowthPercent * activeAgents);
        futureTeamTotal += futureTeamAdditions;

        futureTeamBots = Math.ceil(additionalChats / 4680000);
    }

    $('#future_agent_total').html(accounting.formatNumber(futureTeamTotal, 0));
    roiPDFUrl += 'future_agent_total=' + futureTeamTotal + '&';

    $('.future_additional_agents').html(accounting.formatNumber(futureTeamAdditions, 0));
    roiPDFUrl += 'future_additional_agents=' + futureTeamAdditions + '&';

    $('#future_team_bots').html(accounting.formatNumber(futureTeamBots, 0));
    roiPDFUrl += 'future_team_bots=' + futureTeamBots + '&';

    var barScaleMultiplier = 0.00005;

    var currentTotalCosts = (activeAgents * agentCompensation) + (activeAgents * 1308);
    roiPDFUrl += 'current_total_costs=' + accounting.formatNumber(currentTotalCosts, 0) + '&';

    var liveChatLabourCostBar = futureTeamTotal * agentCompensation;
    var liveChatSystemCostBar = futureTeamTotal * 1308;
    var totalLivechatCosts = liveChatLabourCostBar + liveChatSystemCostBar;
    additionalChats = additionalChats * 15;

    var chatbotRate = 0.014;

    if (additionalChats >= 5000000) {
        chatbotRate = 0.006;
    } else if (additionalChats >= 2000000) {
        chatbotRate = 0.007;
    } else if (additionalChats >= 1000000) {
        chatbotRate = 0.008;
    } else if (additionalChats >= 500000) {
        chatbotRate = 0.009;
    } else if (additionalChats >= 200000) {
        chatbotRate = 0.01;
    } else if (additionalChats >= 100000) {
        chatbotRate = 0.011;
    } else if (additionalChats >= 50000) {
        chatbotRate = 0.012;
    }

    var aiChatbotCost = 50000;
    var chatbotCostBar = aiChatbotCost + (additionalChats * chatbotRate);
    var chatbotLivechatLabourCostBar = activeAgents * agentCompensation;
    var chatbotLivechatSystemCostBar = activeAgents * 1308;

    var totalLiveChatbotCosts = chatbotCostBar + chatbotLivechatLabourCostBar + chatbotLivechatSystemCostBar;

    if (totalLivechatCosts < 30000) {
        barScaleMultiplier = 0.003;
    } else if (totalLivechatCosts < 150000) {
        barScaleMultiplier = 0.0014;
    } else if (totalLivechatCosts < 250000) {
        barScaleMultiplier = 0.0009;
    } else if (totalLivechatCosts < 450000) {
        barScaleMultiplier = 0.0006;
    } else if (totalLivechatCosts < 650000) {
        barScaleMultiplier = 0.0005;
    } else if (totalLivechatCosts < 80000) {
        barScaleMultiplier = 0.0004;
    } else if (totalLivechatCosts < 1750000) {
        barScaleMultiplier = 0.0002;
    } else if (totalLivechatCosts < 7000000) {
        barScaleMultiplier = 0.0001;
    }

    $('#live_chat_labour_cost_bar').find('.segment_value').html(accounting.formatNumber(liveChatLabourCostBar, 0));
    $('#live_chat_labour_cost_bar').height(liveChatLabourCostBar * barScaleMultiplier);
    roiPDFUrl += 'live_chat_labour_cost=' + accounting.formatNumber(liveChatLabourCostBar, 0) + '&';


    $('#live_chat_system_cost_bar').find('.segment_value').html(accounting.formatNumber(liveChatSystemCostBar, 0));
    $('#live_chat_system_cost_bar').height(liveChatSystemCostBar * barScaleMultiplier);
    roiPDFUrl += 'live_chat_system_cost=' + accounting.formatNumber(liveChatSystemCostBar, 0) + '&';


    $('#total_livechat_costs .value').html(accounting.formatNumber(totalLivechatCosts, 0));
    roiPDFUrl += 'total_livechat_costs=' + accounting.formatNumber(totalLivechatCosts, 0) + '&';


    $('#chatbot_cost_bar').find('.segment_value').html(accounting.formatNumber(chatbotCostBar, 0));
    $('#chatbot_cost_bar').height(chatbotCostBar * barScaleMultiplier);
    roiPDFUrl += 'chatbot_cost=' + accounting.formatNumber(chatbotCostBar, 0) + '&';

    $('#chatbot_livechat_labour_cost_bar').find('.segment_value').html(accounting.formatNumber(chatbotLivechatLabourCostBar, 0));
    $('#chatbot_livechat_labour_cost_bar').height(chatbotLivechatLabourCostBar * barScaleMultiplier);
    roiPDFUrl += 'chatbot_livechat_labour_cost=' + accounting.formatNumber(chatbotLivechatLabourCostBar, 0) + '&';

    $('#chatbot_livechat_system_cost_bar').find('.segment_value').html(accounting.formatNumber(chatbotLivechatSystemCostBar, 0));
    $('#chatbot_livechat_system_cost_bar').height(chatbotLivechatSystemCostBar * barScaleMultiplier);
    roiPDFUrl += 'chatbot_livechat_system_cost=' + accounting.formatNumber(chatbotLivechatSystemCostBar, 0) + '&';

    $('#total_live_chatbot_costs .value').html(accounting.formatNumber(totalLiveChatbotCosts, 0));
    roiPDFUrl += 'total_live_chatbot_costs=' + accounting.formatNumber(totalLiveChatbotCosts, 0) + '&';

    var aiSavings = (totalLivechatCosts - totalLiveChatbotCosts);
    $('#adding_ai_savings').html(accounting.formatNumber(aiSavings, 0));
    roiPDFUrl += 'adding_ai_savings=' + accounting.formatNumber(aiSavings, 0) + '&';

    var totalROI = ((aiSavings - chatbotCostBar) / chatbotCostBar) * 100;

    $('#one_year_roi .value').html(accounting.formatNumber(totalROI, 1));
    roiPDFUrl += 'roi_year=' + accounting.formatNumber(totalROI, 1) + '&';

    var paybackPeriod = (chatbotCostBar / aiSavings) * 365;
    $('#payback_period .value').html(accounting.formatNumber(paybackPeriod, 1));
    roiPDFUrl += 'payback=' + accounting.formatNumber(paybackPeriod, 1) + '&';

    roiPDFUrl += 'c=' + encodeURIComponent($("input[name='Company']").val());

    $("input[name='DynamicalURL']").val(roiPDFUrl);

    console.log(roiPDFUrl);
}

function calculate_roi($) {
    var roiPDFUrl = commGlobal.site_url + '/pdfgen/roi/?';
    var regex = new RegExp(',', 'g');

    var activeAgents = parseInt($('#active_agents').val().replace(regex, ''));
    roiPDFUrl += 'num_agents=' + activeAgents + '&';

    var callCenterHoursDay = parseInt($('#call_center_hours_day').val().replace(regex, ''));

    if (callCenterHoursDay > 24) {
        callCenterHoursDay = 24;
        $('#call_center_hours_day').val(24);
    } else if (callCenterHoursDay <= 0) {
        callCenterHoursDay = 1;
        $('#call_center_hours_day').val(1);
    }

    roiPDFUrl += 'hours=' + callCenterHoursDay + '&';

    var callCenterDaysWeek = parseInt($('#call_center_days_week').val().replace(regex, ''));

    if (callCenterDaysWeek > 7) {
        callCenterDaysWeek = 7;
        $('#call_center_days_week').val(7);
    } else if (callCenterDaysWeek <= 0) {
        callCenterDaysWeek = 1;
        $('#call_center_days_week').val(1);
    }

    roiPDFUrl += 'days=' + callCenterDaysWeek + '&';

    var agentCompensation = parseInt($('#agent_compensation').val().replace(regex, ''));
    roiPDFUrl += 'compensation=' + agentCompensation + '&';

    var callLength = parseInt($('#call_length').val().replace(regex, ''));
    roiPDFUrl += 'call_length=' + callLength + '&';

    var callCost = parseFloat($('#call_cost').val().replace(regex, ''));
    roiPDFUrl += 'call_cost=' + callCost + '&';

    var chatLength = parseInt($('#chat_length').val().replace(regex, ''));
    roiPDFUrl += 'chat_length=' + chatLength + '&';

    var concurrentChats = parseInt($('#concurrent_chats').val().replace(regex, ''));
    roiPDFUrl += 'chats_per_agent=' + concurrentChats + '&';

    var chatPackage = $("input[name='chatPackage']:checked").val();
    roiPDFUrl += 'package=' + chatPackage + '&';

    var chatPackageRate = $("input[name='chatPackage']:checked").data('rate');
    roiPDFUrl += 'chat_rate=' + chatPackageRate + '&';

    var totalDeflectedCalls = parseInt($('#percent_calls_to_chat').val().replace(regex, ''));
    roiPDFUrl += 'deflected_calls=' + totalDeflectedCalls + '&';

    var $callsYearBar = $('#calls_year_bar');
    var $chatsYearBar = $('#chats_year_bar');
    var $oneYearROI = $('#one_year_roi');
    var $paybackPeriod = $('#payback_period');

    var $percentRedirectionResult = $('#percent_redirection_result');
    var $handleCallsResult = $('#handle_calls_result');
    var $handleChatsResult = $('#handle_chats_result');
    var $handleTotalResult = $('#handle_total_result');
    var $agentsPhoneResult = $('#agents_phone_result');
    var $agentsChatResult = $('#agents_chat_result');
    var $agentsTotalResult = $('#agents_total_result');

    var $labourCostPhoneBar = $('#labour_cost_phone_bar');
    var $systemCostPhoneBar = $('#system_cost_phone_bar');
    var $totalCostPhoneResult = $('#total_cost_phone_result');

    var $deflectedLabourCostChatBar = $('#deflected_labour_cost_chat_bar');
    var $deflectedSystemCostChatBar = $('#deflected_system_cost_chat_bar');
    var $deflectedSystemCostPhoneBar = $('#deflected_system_cost_phone_bar');
    var $deflectedLabourCostPhoneBar = $('#deflected_labour_cost_phone_bar');
    var $deflectedChatPercentResult = $('#deflected_chat_percent_result');
    var $deflectedPhonePercentResult = $('#deflected_phone_percent_result');
    var $totalDeflectedCostResult = $('#total_deflected_cost_result');

    var $deflectedChatPercentResultComparison = $('#deflected_chat_percent_result_comparison');
    var $deflectedChatSavings = $('#deflected_chat_savings');

    accounting.settings.currency.format = "%v";

    $percentRedirectionResult.html(accounting.formatNumber(totalDeflectedCalls, 0));

    var callCenterDaysYear = callCenterDaysWeek * 52;
    var callsHour = 60 / callLength;
    var chatHour = (60 / chatLength) * concurrentChats;

    var workCapacity = callCenterDaysYear * callCenterHoursDay;
    var callsYear = workCapacity * activeAgents * callsHour;
    roiPDFUrl += 'calls_year=' + accounting.formatNumber(callsYear, 0) + '&';

    var chatsYear = workCapacity * activeAgents * chatHour;

    var deflectedCallsPercent = totalDeflectedCalls / 100;
    var deflectedCallsYear = (1 - deflectedCallsPercent) * callsYear;
    var deflectedChatsYear = deflectedCallsPercent * callsYear;

    roiPDFUrl += 'deflected_calls_year=' + accounting.formatNumber(deflectedCallsYear, 0) + '&';
    roiPDFUrl += 'deflected_chats_year=' + accounting.formatNumber(deflectedChatsYear, 0) + '&';
    roiPDFUrl += 'deflected_queries_year=' + accounting.formatNumber(deflectedCallsYear + deflectedChatsYear, 0) + '&';

    $handleCallsResult.html(accounting.formatNumber(deflectedCallsYear, 0));
    $handleChatsResult.html(accounting.formatNumber(deflectedChatsYear, 0));
    $handleTotalResult.html(accounting.formatNumber(callsYear, 0));

    var phoneAgentsNeeded = Math.ceil(deflectedCallsYear / (callsHour * workCapacity));
    var chatAgentsNeeded = Math.ceil(deflectedChatsYear / (chatHour * workCapacity));
    var totalAgentsNeeded = phoneAgentsNeeded + chatAgentsNeeded;

    roiPDFUrl += 'deflected_chat_agents=' + chatAgentsNeeded + '&';
    roiPDFUrl += 'deflected_call_agents=' + phoneAgentsNeeded + '&';
    roiPDFUrl += 'deflected_num_agents=' + totalAgentsNeeded + '&';

    $agentsPhoneResult.html(accounting.formatNumber(phoneAgentsNeeded, 0));
    $agentsChatResult.html(accounting.formatNumber(chatAgentsNeeded, 0));
    $agentsTotalResult.html(accounting.formatNumber(totalAgentsNeeded, 0));

    $deflectedChatPercentResult.html(totalDeflectedCalls);
    $deflectedChatPercentResultComparison.html(totalDeflectedCalls);
    $deflectedPhonePercentResult.html(100-totalDeflectedCalls);

    var callAgentCosts = agentCompensation * activeAgents;
    roiPDFUrl += 'annual_compensation=' + accounting.formatNumber(callAgentCosts, 2) + '&';

    var callSystemCosts = callsYear * callCost;
    var totalCallCosts = callAgentCosts + callSystemCosts;
    var perCallAgentCost = callAgentCosts / callsYear;
    var costPerCall = perCallAgentCost + callCost;

    var deflectedCallAgentCosts = agentCompensation * phoneAgentsNeeded;
    var deflectedCallSystemCosts = deflectedCallsYear * callCost;
    var deflectedCallTotalCosts = deflectedCallAgentCosts * deflectedCallSystemCosts;
    var deflectedChatAgentCosts = agentCompensation * chatAgentsNeeded;
    var deflectedChatSystemCosts = chatAgentsNeeded * chatPackageRate;
    var deflectedTotalCallCosts = deflectedCallAgentCosts + deflectedCallSystemCosts + deflectedChatAgentCosts + deflectedChatSystemCosts;

    var barScaleMultiplier = 0.0001;

    if (deflectedTotalCallCosts < 150000) {
        barScaleMultiplier = 0.0014;
    } else if (deflectedTotalCallCosts < 250000) {
        barScaleMultiplier = 0.0009;
    } else if (deflectedTotalCallCosts < 450000) {
        barScaleMultiplier = 0.0006;
    } else if (deflectedTotalCallCosts < 650000) {
        barScaleMultiplier = 0.0003;
    } else if (deflectedTotalCallCosts < 1750000) {
        barScaleMultiplier = 0.0002;
    }

    roiPDFUrl += 'call_labour_cost=' + accounting.formatNumber(perCallAgentCost, 2) + '&';
    roiPDFUrl += 'cost_per_call=' + accounting.formatNumber(costPerCall, 2) + '&';

    $labourCostPhoneBar.find('.segment_value').html(accounting.formatNumber(callAgentCosts, 0));
    $labourCostPhoneBar.height(callAgentCosts * barScaleMultiplier);

    $systemCostPhoneBar.find('.segment_value').html(accounting.formatNumber(callSystemCosts, 0));
    $systemCostPhoneBar.height(callSystemCosts * barScaleMultiplier);

    $totalCostPhoneResult.find('.value').html(accounting.formatNumber(totalCallCosts, 0));

    $deflectedLabourCostChatBar.find('.segment_value').html(accounting.formatNumber(deflectedChatAgentCosts, 0));
    $deflectedLabourCostChatBar.height(deflectedChatAgentCosts * barScaleMultiplier);

    $deflectedSystemCostChatBar.find('.segment_value').html(accounting.formatNumber(deflectedChatSystemCosts, 0));
    $deflectedSystemCostChatBar.height(deflectedChatSystemCosts * barScaleMultiplier);

    if (totalDeflectedCalls == 100) {
        $deflectedSystemCostPhoneBar.hide();
        $deflectedLabourCostPhoneBar.hide();
    } else {
        $deflectedSystemCostPhoneBar.show();
        $deflectedLabourCostPhoneBar.show();
    }

    $deflectedSystemCostPhoneBar.find('.segment_value').html(accounting.formatNumber(deflectedCallSystemCosts, 0));
    $deflectedSystemCostPhoneBar.height(deflectedCallSystemCosts * barScaleMultiplier);

    $deflectedLabourCostPhoneBar.find('.segment_value').html(accounting.formatNumber(deflectedCallAgentCosts, 0));
    $deflectedLabourCostPhoneBar.height(deflectedCallAgentCosts * barScaleMultiplier);

    $totalDeflectedCostResult.find('.value').html(accounting.formatNumber(deflectedTotalCallCosts, 0));

    var chatSavings = totalCallCosts - deflectedTotalCallCosts;
    $deflectedChatSavings.html(accounting.formatNumber(chatSavings, 0));

    roiPDFUrl += 'chats_hour=' + accounting.formatNumber(chatHour, 0) + '&';
    roiPDFUrl += 'chats_year=' + accounting.formatNumber(chatHour * workCapacity, 0) + '&';

    roiPDFUrl += 'chat_savings=' + accounting.formatNumber(chatSavings, 0) + '&';

    roiPDFUrl += 'deflected_call_labour_cost=' + accounting.formatNumber((deflectedCallAgentCosts / deflectedCallsYear), 2) + '&';
    roiPDFUrl += 'deflected_call_total_cost=' + accounting.formatNumber((deflectedCallAgentCosts / deflectedCallsYear) + callCost, 2) + '&';

    var deflectedChatCost = deflectedChatSystemCosts / deflectedChatsYear;
    roiPDFUrl += 'deflected_chat_cost=' + accounting.formatNumber(deflectedChatCost, 2) + '&';

    var deflectedChatLabourCost = deflectedChatAgentCosts / deflectedChatsYear;
    roiPDFUrl += 'deflected_chat_labour_cost=' + accounting.formatNumber(deflectedChatLabourCost, 2) + '&';

    var costPerChat = parseFloat(accounting.formatNumber(deflectedChatCost, 2)) + parseFloat(accounting.formatNumber(deflectedChatLabourCost, 2));
    // console.log('Cost Per Chat', costPerChat);
    roiPDFUrl += 'deflected_chat_total_cost=' + accounting.formatNumber(costPerChat, 2) + '&';

    roiPDFUrl += 'annual_call_labour_cost=' + accounting.formatNumber(callAgentCosts, 2) + '&';
    roiPDFUrl += 'annual_call_system_cost=' + accounting.formatNumber(callSystemCosts, 2) + '&';
    roiPDFUrl += 'annual_call_total_cost=' + accounting.formatNumber(totalCallCosts, 2) + '&';

    roiPDFUrl += 'annual_deflected_labour_cost=' + accounting.formatNumber(deflectedCallAgentCosts + deflectedChatAgentCosts, 2) + '&';
    roiPDFUrl += 'annual_deflected_system_cost=' + accounting.formatNumber(deflectedCallSystemCosts + deflectedChatSystemCosts, 2) + '&';
    roiPDFUrl += 'annual_deflected_total_cost=' + accounting.formatNumber(deflectedTotalCallCosts, 2) + '&';

    var totalROI = ((chatSavings - deflectedChatSystemCosts) / deflectedChatSystemCosts) * 100;
    var costRatio = ((deflectedChatAgentCosts + deflectedChatSystemCosts) / deflectedChatsYear) / ((deflectedCallAgentCosts + deflectedCallSystemCosts) / deflectedCallsYear) * 100;

    // console.log(totalROI);
    $oneYearROI.find('.value').html(accounting.formatNumber(totalROI, 0));

    var paybackPeriod = (deflectedChatSystemCosts / chatSavings) * 365;

    $paybackPeriod.find('.value').html(accounting.formatNumber(paybackPeriod, 1));

    roiPDFUrl += 'cost_ratio=' + accounting.formatNumber(costRatio, 0) + '&';
    roiPDFUrl += 'roi_year=' + accounting.formatNumber(totalROI, 1) + '&';
    roiPDFUrl += 'payback=' + accounting.formatNumber(paybackPeriod, 1) + '&';

    roiPDFUrl += 'c=' + encodeURIComponent($("input[name='Company']").val());

    $("input[name='DynamicalURL']").val(roiPDFUrl);

    // console.log(roiPDFUrl);
}

function calculate_agent_assist_roi($) {
    var roiPDFUrl = commGlobal.site_url + '/pdfgen/agent-assist-roi/?';
    var regex = new RegExp(',', 'g');

    var activeAgents = parseInt($('#active_agents').val().replace(regex, ''));
    roiPDFUrl += 'num_agents=' + activeAgents + '&';

    var callCenterHoursDay = parseInt($('#call_center_hours_day').val().replace(regex, ''));

    if (callCenterHoursDay > 24) {
        callCenterHoursDay = 24;
        $('#call_center_hours_day').val(24);
    } else if (callCenterHoursDay <= 0) {
        callCenterHoursDay = 1;
        $('#call_center_hours_day').val(1);
    }

    roiPDFUrl += 'hours=' + callCenterHoursDay + '&';

    var callCenterDaysWeek = parseInt($('#call_center_days_week').val().replace(regex, ''));

    if (callCenterDaysWeek > 7) {
        callCenterDaysWeek = 7;
        $('#call_center_days_week').val(7);
    } else if (callCenterDaysWeek <= 0) {
        callCenterDaysWeek = 1;
        $('#call_center_days_week').val(1);
    }

    roiPDFUrl += 'days=' + callCenterDaysWeek + '&';

    var callCenterWeeksYear = parseInt($('#call_center_weeks_year').val().replace(regex, ''));

    if (callCenterWeeksYear > 52) {
        callCenterWeeksYear = 52;
        $('#call_center_weeks_year').val(52);
    } else if (callCenterWeeksYear <= 0) {
        callCenterWeeksYear = 1;
        $('#call_center_weeks_year').val(1);
    }

    roiPDFUrl += 'weeks=' + callCenterWeeksYear + '&';

    var agentCompensation = parseInt($('#agent_compensation').val().replace(regex, ''));
    roiPDFUrl += 'compensation=' + accounting.formatNumber(agentCompensation) + '&';
    roiPDFUrl += 'annual_compensation=' + accounting.formatNumber(agentCompensation * activeAgents) + '&';

    var percentDaySpentChatting = parseInt($('#percent_of_day_spent_chatting').val().replace(regex, ''));
    roiPDFUrl += 'percent_of_day_spent_chatting=' + percentDaySpentChatting + '&';

    var chatLength = parseInt($('#chat_length').val().replace(regex, ''));
    roiPDFUrl += 'chat_length=' + chatLength + '&';

    var concurrentChats = parseInt($('#concurrent_chats').val().replace(regex, ''));
    roiPDFUrl += 'chats_per_agent=' + concurrentChats + '&';

    var timeSpentLooking = parseInt($('#time_spent_looking_for_answers').val().replace(regex, ''));
    roiPDFUrl += 'time_spent_looking_for_answers=' + timeSpentLooking + '&';

    var chatPackage = $("input[name='chatPackage']:checked").val();
    roiPDFUrl += 'package=' + chatPackage + '&';

    var chatPackageRate = $("input[name='chatPackage']:checked").data('rate');
    roiPDFUrl += 'chat_rate=' + chatPackageRate + '&';

    var agentAssistOption = $("input[name='agentAssistOption']:checked").val();
    var agentAssistRate = $("input[name='agentAssistOption']:checked").data('rate');
    roiPDFUrl += 'agent_assist_option=' + agentAssistOption + '&';
    roiPDFUrl += 'agent_assist_rate=' + agentAssistRate + '&';

    accounting.settings.currency.format = "%v";

    var callCenterDaysYear = callCenterDaysWeek * callCenterWeeksYear;
    var chatHour = (60 / chatLength) * concurrentChats;
    roiPDFUrl += 'chats_hour=' + accounting.formatNumber(chatHour) + '&';

    var percentTimeSpentSearching = timeSpentLooking / 60 / chatLength * 100;
    $('#percent_time_spent_searching').html(accounting.formatNumber(percentTimeSpentSearching, 1));
    roiPDFUrl += 'percent_time_spent_searching=' + accounting.formatNumber(percentTimeSpentSearching, 0) + '&';

    var newChatLength = chatLength - (timeSpentLooking / 60);
    $('#new_chat_length').html(accounting.formatNumber(newChatLength, 0));
    roiPDFUrl += 'new_chat_length=' + accounting.formatNumber(newChatLength, 0) + '&';

    var agentAvailableHoursDay = callCenterHoursDay * (percentDaySpentChatting / 100);
    roiPDFUrl += 'agent_available_hours_day=' + accounting.formatNumber(agentAvailableHoursDay, 1) + '&';
    var agentDailyChatCapacity = Math.ceil(agentAvailableHoursDay * ((60/chatLength) * concurrentChats));
    var chatsYear = agentDailyChatCapacity * callCenterDaysYear * activeAgents;
    $('#current_chat_capacity').html(accounting.formatNumber(chatsYear, 0));
    roiPDFUrl += 'current_chat_capacity=' + accounting.formatNumber(chatsYear, 0) + '&';
    roiPDFUrl += 'agent_daily_chat_capacity=' + accounting.formatNumber(agentDailyChatCapacity, 0) + '&';
    roiPDFUrl += 'agent_annual_chat_capacity=' + accounting.formatNumber(agentDailyChatCapacity * callCenterDaysYear, 0) + '&';

    roiPDFUrl += 'minutes_spent_looking_day=' + accounting.formatNumber((timeSpentLooking / 60) * agentDailyChatCapacity, 0) + '&';
    roiPDFUrl += 'minutes_spent_chatting_day=' + accounting.formatNumber((chatLength - (timeSpentLooking / 60)) * agentDailyChatCapacity, 0) + '&';

    var dailyCostPerAgent = agentCompensation / callCenterDaysYear;
    var searchTimeCostAgentDay = dailyCostPerAgent * (percentTimeSpentSearching / 100);
    var chatCostAgentDay = dailyCostPerAgent * (1 - (percentTimeSpentSearching / 100));
    roiPDFUrl += 'cost_looking_day=' + accounting.formatNumber(searchTimeCostAgentDay * callCenterDaysYear * activeAgents, 0) + '&';
    roiPDFUrl += 'cost_chatting_day=' + accounting.formatNumber(chatCostAgentDay * callCenterDaysYear * activeAgents, 0) + '&';

    var newChatHour = (60 / newChatLength) * concurrentChats;
    var newChatsDay = Math.ceil(agentAvailableHoursDay * newChatHour);
    var newChatsYear = newChatsDay * callCenterDaysYear * activeAgents;
    $('.new_chat_capacity').html(accounting.formatNumber(newChatsYear, 0));
    roiPDFUrl += 'new_chat_capacity=' + accounting.formatNumber(newChatsYear, 0) + '&';
    roiPDFUrl += 'new_chat_capacity_per_agent=' + accounting.formatNumber(newChatsYear / activeAgents, 0) + '&';

    roiPDFUrl += 'new_chat_capacity_day=' + accounting.formatNumber(newChatsDay, 0) + '&';
    roiPDFUrl += 'new_chat_capacity_agent_day=' + accounting.formatNumber(newChatsDay / activeAgents, 0) + '&';

    roiPDFUrl += 'new_chats_per_hour_per_agent=' + accounting.formatNumber(newChatHour, 0) + '&';

    roiPDFUrl += 'chat_capacity_increase=' + accounting.formatNumber((newChatsYear / chatsYear * 100) - 100, 1) + '&';

    // var costPerChat = parseFloat(accounting.formatNumber(deflectedChatCost, 2)) + parseFloat(accounting.formatNumber(deflectedChatLabourCost, 2));
    var costPerDay = agentCompensation / callCenterDaysYear;
    var costPerChat = costPerDay / agentDailyChatCapacity;
    var newCostPerChat = costPerDay / newChatsDay;
    var reducedLaborCostPercent = (newCostPerChat - costPerChat) / costPerChat * 100 * -1;
    $('#reduced_labor_cost_percent').html(accounting.formatNumber(reducedLaborCostPercent, 0));
    roiPDFUrl += 'cost_per_chat=' + accounting.formatNumber(costPerChat, 2) + '&';
    roiPDFUrl += 'new_cost_per_chat=' + accounting.formatNumber(newCostPerChat, 2) + '&';

    var costPerChatDifference = accounting.toFixed(costPerChat, 2) - accounting.toFixed(newCostPerChat, 2);
    // console.log(costPerChatDifference);
    var costReductionPercent = costPerChatDifference / accounting.toFixed(costPerChat, 2);

    roiPDFUrl += 'cost_per_chat_decrease=' + accounting.toFixed(Math.abs(costReductionPercent * 100), 1) + '&';
    roiPDFUrl += 'reduced_labor_cost_percent=' + accounting.formatNumber(newChatsYear, 0) + '&';

    var extendChatCapacityPercent = (newChatsYear/chatsYear*100) - 100;
    $('#extend_chat_capacity_percent').html(accounting.formatNumber(extendChatCapacityPercent, 1));
    roiPDFUrl += 'extend_chat_capacity_percent=' + accounting.formatNumber(extendChatCapacityPercent, 1) + '&';

    var extendChatCapacity = newChatsYear - chatsYear;
    $('#extend_chat_capacity').html(accounting.formatNumber(extendChatCapacity, 0));
    roiPDFUrl += 'extend_chat_capacity=' + accounting.formatNumber(extendChatCapacity, 0) + '&';

    var agentsNewCapacity = Math.ceil(extendChatCapacity / (newChatsDay * callCenterDaysYear));
    roiPDFUrl += 'agent_assist_agents_equivalent=' + accounting.formatNumber(agentsNewCapacity, 0) + '&';
    $('#agents_new_capacity').html(accounting.formatNumber(agentsNewCapacity + activeAgents, 0));
    var agentsNewCapacityWithAssist = Math.floor(chatsYear / (newChatsDay * callCenterDaysYear));
    $('.agents_new_capacity_with_assist').html(accounting.formatNumber(agentsNewCapacityWithAssist, 0));
    roiPDFUrl += 'agents_new_capacity_with_assist=' + accounting.formatNumber(agentsNewCapacityWithAssist, 0) + '&';

    var barScaleMultiplier = 0.0001;

    var currentTeamCompensation = activeAgents * agentCompensation;
    var currentTeamSubscription = activeAgents * chatPackageRate;
    var currentTeamCosts = currentTeamSubscription + currentTeamCompensation;

    if (currentTeamCosts < 150000) {
        barScaleMultiplier = 0.0014;
    } else if (currentTeamCosts < 250000) {
        barScaleMultiplier = 0.0009;
    } else if (currentTeamCosts < 450000) {
        barScaleMultiplier = 0.0006;
    } else if (currentTeamCosts < 650000) {
        barScaleMultiplier = 0.0003;
    } else if (currentTeamCosts < 1750000) {
        barScaleMultiplier = 0.0002;
    }

    var $currentTeamSubscriptionBar = $('#current_team_subscription_cost_bar');
    $currentTeamSubscriptionBar.find('.segment_value').html(accounting.formatNumber(currentTeamSubscription, 0));
    $currentTeamSubscriptionBar.height(currentTeamSubscription * barScaleMultiplier);

    var $currentTeamCompensationBar = $('#current_team_compensation_cost_bar');
    $currentTeamCompensationBar.find('.segment_value').html(accounting.formatNumber(currentTeamCompensation, 0));
    $currentTeamCompensationBar.height(currentTeamCompensation * barScaleMultiplier);

    $('#current_team_cost .value').html(accounting.formatNumber(currentTeamCosts, 0));

    var newTeamAgentAssistCost = agentAssistRate * 12 * agentsNewCapacityWithAssist;
    var newTeamCompensation = agentsNewCapacityWithAssist * agentCompensation;
    var newTeamSubscription = (agentsNewCapacityWithAssist * chatPackageRate) + newTeamAgentAssistCost;
    var newTeamCosts = newTeamSubscription + newTeamCompensation;

    roiPDFUrl += 'incremental_new_chat_capacity=' + accounting.formatNumber(agentAssistRate * 12 * activeAgents, 0) + '&';

    var $newTeamSubscriptionBar = $('#new_team_subscription_cost_bar');
    $newTeamSubscriptionBar.find('.segment_value').html(accounting.formatNumber(newTeamSubscription, 0));
    $newTeamSubscriptionBar.height(newTeamSubscription * barScaleMultiplier);

    var $newTeamCompensationBar = $('#new_team_compensation_cost_bar');
    $newTeamCompensationBar.find('.segment_value').html(accounting.formatNumber(newTeamCompensation, 0));
    $newTeamCompensationBar.height(newTeamCompensation * barScaleMultiplier);

    $('#new_team_cost .value').html(accounting.formatNumber(newTeamCosts, 0));

    var assistSavings = currentTeamCosts - newTeamCosts;
    $('#adding_assist_savings').html(accounting.formatNumber(assistSavings, 0));
    roiPDFUrl += 'agent_assist_savings=' + accounting.formatNumber(assistSavings, 0) + '&';

    var totalROI = ((assistSavings - newTeamAgentAssistCost) / newTeamAgentAssistCost) * 100;
    roiPDFUrl += 'roi_year=' + accounting.formatNumber(totalROI, 1) + '&';
    $('#one_year_roi .value').html(accounting.formatNumber(totalROI, 1));

    var paybackPeriod = (newTeamAgentAssistCost / assistSavings) * 365;
    $('#payback_period .value').html(Math.ceil(paybackPeriod));
    roiPDFUrl += 'payback=' + Math.ceil(paybackPeriod) + '&';

    roiPDFUrl += 'c=' + encodeURIComponent($("input[name='Company']").val());

    $("input[name='DynamicalURL']").val(roiPDFUrl);

    // console.log(roiPDFUrl);
}

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

            $("[data-lightbox='fancybox']").fancybox();

            Comm100API.onReady = function () {
                $('a[href="#chat"]').click(function(e) {
                    e.preventDefault();
                    Comm100API.do('livechat.button.click');
                });
            }

            $('a.scroll-to-anchor').click(function(e) {
                e.preventDefault();

                var dest = $(this).attr('href');
                $('html,body').animate({scrollTop: $(dest).offset().top - 100},'slow');
            });

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

            $('body').on('change', '#Email_Opt_In_for_Marketing_Team__c, #Email_Opt_In_for_Product__c, #Email_Opt_In_for_Sales__c', function() {
                // console.log('Non-Unsubscribe Change');
                // console.log($(this));
                // console.log($(this).prop('checked'));
                if ($(this).prop('checked')) {
                    $('#Unsubscribed').prop('checked', false);
                }
            });

            $('body').on('change', '#Unsubscribed', function() {
                // console.log('Unsubscribe Change');
                // console.log($(this).prop('checked'));
                if ($(this).prop('checked')) {
                    $('#Email_Opt_In_for_Marketing_Team__c, #Email_Opt_In_for_Product__c, #Email_Opt_In_for_Sales__c').prop('checked', false);
                }
            });

            if ($('.section-chatbot_roi_calculator').length) {
                $('input[type="text"], input[type="number"]').change(function() {
                    calculate_chatbot_roi($);
                });

                $('input[type="radio"]').click(function() {
                    calculate_chatbot_roi($);
                });

                calculate_chatbot_roi($);

                MktoForms2.whenReady(function (form){
                    form.onSubmit(function(){
                        calculate_chatbot_roi($);
                    }),
                    form.onSuccess(function(values, followUpUrl) {
                        // console.log(followUpUrl + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val()));
                        location.href = followUpUrl.replace('?confirmation_link=', '') + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val());
                        // Return false to prevent the submission handler continuing with its own processing
                        return false;
                    });
                });
            }

            if ($('.section-agent_assist_roi_calculator').length) {
                $('#time_spent_looking_for_answers').bootstrapSlider({
                    formatter: function(value) {
                        if (value == 30) {
                            return value + ' sec';
                        }

                        return (value / 60) + ' min';
                    }
                });

                $('input[type="text"], input[type="number"]').change(function() {
                    calculate_agent_assist_roi($);
                });

                $('input[type="radio"]').click(function() {
                    calculate_agent_assist_roi($);
                });

                calculate_agent_assist_roi($);

                MktoForms2.whenReady(function (form){
                    form.onSubmit(function(){
                        calculate_agent_assist_roi($);
                    }),
                    form.onSuccess(function(values, followUpUrl) {
                        // console.log(followUpUrl + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val()));
                        location.href = followUpUrl.replace('?confirmation_link=', '') + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val());
                        // Return false to prevent the submission handler continuing with its own processing
                        return false;
                    });
                });
            }

            if ($('.section-roi_calculator').length) {
                $('input[type="text"], input[type="number"]').change(function() {
                    calculate_roi($);
                });

                $('input[type="radio"]').click(function() {
                    calculate_roi($);
                });

                calculate_roi($);

                MktoForms2.whenReady(function (form){
                    form.onSubmit(function(){
                        calculate_roi($);
                    }),
                    form.onSuccess(function(values, followUpUrl) {
                        // console.log(followUpUrl + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val()));
                        location.href = followUpUrl.replace('?confirmation_link=', '') + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val());
                        // Return false to prevent the submission handler continuing with its own processing
                        return false;
                    });
                });
            }

            if ($('.section-live_chat_stats').length) {
                var statsPDFLink = '';

                $('#stats-form').submit(function(e) {
                    var stats = [
                        {
                            "industry" : "Banking and Financial Services",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "3.74", "avg_satisfaction" : "73.23", "chats_month" : 889, "mobile_chats" : "44.45", "avg_wait_time" : "1 min<br/>4 sec", "avg_chat_length" : "14 min<br/>51 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.60", "avg_satisfaction" : "92.44", "chats_month" : 585, "mobile_chats" : "43.70", "avg_wait_time" : "16 sec", "avg_chat_length" : "10 min<br/>27 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.18", "avg_satisfaction" : "82.99", "chats_month" : "8,316", "mobile_chats" : "33.63", "avg_wait_time" : "1 min<br/>13 sec", "avg_chat_length" : "13 min<br/>13 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.43", "avg_satisfaction" : "85.71", "chats_month" : "12,077", "mobile_chats" : "75.40", "avg_wait_time" : "59 sec", "avg_chat_length" : "9 min<br/>16 sec" }
                            ]
                        },
                        {
                            "industry" : "Healthcare",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "4.61", "avg_satisfaction" : "94.28", "chats_month" : 47, "mobile_chats" : "49.51", "avg_wait_time" : "36 sec", "avg_chat_length" : "11 min<br/>20 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.47", "avg_satisfaction" : "90.51", "chats_month" : "1,029", "mobile_chats" : "60.29", "avg_wait_time" : "69 sec", "avg_chat_length" : "11 min<br/>3 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.34", "avg_satisfaction" : "85.46", "chats_month" : "257", "mobile_chats" : "31.02", "avg_wait_time" : "2 min<br/>54 sec", "avg_chat_length" : "12 min<br/>4 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.39", "avg_satisfaction" : "85.48", "chats_month" : "1,006", "mobile_chats" : "50.68", "avg_wait_time" : "19 sec", "avg_chat_length" : "8 min<br/>4 sec" }
                            ]
                        },
                        {
                            "industry" : "Government",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "4.70", "avg_satisfaction" : "95.38", "chats_month" : 713, "mobile_chats" : "44.02", "avg_wait_time" : "48 sec", "avg_chat_length" : "15 min<br/>22 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.17", "avg_satisfaction" : "87.83", "chats_month" : 343, "mobile_chats" : "35.72", "avg_wait_time" : "17 sec", "avg_chat_length" : "12 min<br/>47 sec" },
                                { "min" : 11, "max" : 99999999999999, "avg_rating" : "4.58", "avg_satisfaction" : "95.79", "chats_month" : 571, "mobile_chats" : "25.63", "avg_wait_time" : "13 sec", "avg_chat_length" : "12 min<br/>13 sec" }
                            ]
                        },
                        {
                            "industry" : "eCommerce",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "4.17", "avg_satisfaction" : "82.55", "chats_month" : 265, "mobile_chats" : "38.41", "avg_wait_time" : "1 min<br/>51 sec", "avg_chat_length" : "15 min<br/>20 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.46", "avg_satisfaction" : "90.75", "chats_month" : 690, "mobile_chats" : "33.97", "avg_wait_time" : "1 min<br/>6 sec", "avg_chat_length" : "12 min<br/>22 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.03", "avg_satisfaction" : "78.65", "chats_month" : "4,873", "mobile_chats" : "31.50", "avg_wait_time" : "2 min<br/>17 sec", "avg_chat_length" : "15 min<br/>46 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.27", "avg_satisfaction" : "85.14", "chats_month" : "36,225", "mobile_chats" : "50.24", "avg_wait_time" : "46 sec", "avg_chat_length" : "15 min<br/>46 sec" }
                            ]
                        },
                        {
                            "industry" : "Manufacturing",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "4.55", "avg_satisfaction" : "91.03", "chats_month" : 51, "mobile_chats" : "26.16", "avg_wait_time" : "52 sec", "avg_chat_length" : "20 min<br/>42 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.52", "avg_satisfaction" : "89.95", "chats_month" : 287, "mobile_chats" : "22.11", "avg_wait_time" : "32 sec", "avg_chat_length" : "17 min<br/>5 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.32", "avg_satisfaction" : "87.04", "chats_month" : 449, "mobile_chats" : "49.42", "avg_wait_time" : "57 sec", "avg_chat_length" : "8 min<br/>39 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.56", "avg_satisfaction" : "92.99", "chats_month" : 262, "mobile_chats" : "0.35", "avg_wait_time" : "1 min", "avg_chat_length" : "8 min<br/>51 sec" }
                            ]
                        },
                        {
                            "industry" : "Technology",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "3.59", "avg_satisfaction" : "72.06", "chats_month" : 483, "mobile_chats" : "28.35", "avg_wait_time" : "57 sec", "avg_chat_length" : "14 min<br/>59 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.31", "avg_satisfaction" : "86.82", "chats_month" : 401, "mobile_chats" : "13.30", "avg_wait_time" : "36 sec", "avg_chat_length" : "15 min<br/>21 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.58", "avg_satisfaction" : "92.54", "chats_month" : "5,325", "mobile_chats" : "19.07", "avg_wait_time" : "1 min<br/>42 sec", "avg_chat_length" : "16 min<br/>37 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.33", "avg_satisfaction" : "87.26", "chats_month" : "26,050", "mobile_chats" : "24.15", "avg_wait_time" : "36 sec", "avg_chat_length" : "19 min<br/>2 sec" }
                            ]
                        },
                        {
                            "industry" : "Recreation",
                            "ranges" : [
                                { "min" : 1, "max" : 3, "avg_rating" : "4.16", "avg_satisfaction" : "81.63", "chats_month" : "1,312", "mobile_chats" : "74.07", "avg_wait_time" : "16 sec", "avg_chat_length" : "8 min<br/>49 sec" },
                                { "min" : 4, "max" : 10, "avg_rating" : "4.20", "avg_satisfaction" : "81.68", "chats_month" : "4,053", "mobile_chats" : "72.13", "avg_wait_time" : "14 sec", "avg_chat_length" : "7 min<br/>28 sec" },
                                { "min" : 11, "max" : 50, "avg_rating" : "4.10", "avg_satisfaction" : "79.56", "chats_month" : "25,793", "mobile_chats" : "66.41", "avg_wait_time" : "17 sec", "avg_chat_length" : "6 min<br/>56 sec" },
                                { "min" : 51, "max" : 99999999999999, "avg_rating" : "4.12", "avg_satisfaction" : "80.52", "chats_month" : "143,589", "mobile_chats" : "48.47", "avg_wait_time" : "30 sec", "avg_chat_length" : "7 min<br/>14 sec" }
                            ]
                        }
                    ];

                    var industry = $('#industry').val();
                    var numAgents = parseInt($('#num_agents').val());
                    console.log(numAgents);

                    for (var i = 0; i < stats.length; i++) {
                        if (industry == stats[i].industry) {
                            for (var x = 0; x < stats[i].ranges.length; x++) {
                                if (numAgents >= stats[i].ranges[x].min && numAgents <= stats[i].ranges[x].max) {
                                    // console.log(stats[i].ranges[x]);
                                    $('#avg-rating .value').html(stats[i].ranges[x].avg_rating);
                                    $('#avg-satisfaction .value').html(stats[i].ranges[x].avg_satisfaction);
                                    $('#avg-chats-month .value').html(stats[i].ranges[x].chats_month);
                                    $('#mobile-chats .value').html(stats[i].ranges[x].mobile_chats);
                                    $('#avg-wait-time .value').html(stats[i].ranges[x].avg_wait_time);
                                    $('#avg-chat-length .value').html(stats[i].ranges[x].avg_chat_length);
                                    $("input[name='DynamicalURL']").val(commGlobal.site_url + '/pdfgen/live-chat/?industry=' + industry + '&avg-rating=' + stats[i].ranges[x].avg_rating + '&avg-satisfaction=' + stats[i].ranges[x].avg_satisfaction + '&avg-chats-month=' + stats[i].ranges[x].chats_month + '&mobile-chats=' + stats[i].ranges[x].mobile_chats + '&avg-wait-time=' + stats[i].ranges[x].avg_wait_time + '&avg-chat-length=' + stats[i].ranges[x].avg_chat_length);
                                }
                            }
                        }
                    }

                    e.preventDefault();
                });

                MktoForms2.whenReady(function (form){
                    $("input[name='DynamicalURL']").val(commGlobal.site_url + '/pdfgen/live-chat/?industry=All Industries&avg-rating=' + $('#avg-rating .value').html() + '&avg-satisfaction=' + $('#avg-satisfaction .value').html() + '&avg-chats-month=' + $('#avg-chats-month .value').html() + '&mobile-chats=' + $('#mobile-chats .value').html() + '&avg-wait-time=' + $('#avg-wait-time .value').html() + '&avg-chat-length=' + $('#avg-chat-length .value').html());

                    form.onSuccess(function(values, followUpUrl) {
                        location.href = followUpUrl.replace('?confirmation_link=', '') + '?confirmation_link=' + encodeURIComponent($("input[name='DynamicalURL']").val());
                        // Return false to prevent the submission handler continuing with its own processing
                        return false;
                    });
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
//# sourceMappingURL=main.js.map
