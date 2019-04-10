!function(t){"function"==typeof define&&define.amd?define(["shoestring"],t):"object"==typeof module&&module.exports?module.exports=t():t()}(function(){var i="undefined"!=typeof window?window:this,l=i.document;function c(t,e){var n,a=typeof t;if(!t)return new r([]);if(t.call)return c.ready(t);if(t.constructor===r&&!e)return t;if("string"!=a||0!==t.indexOf("<"))return"string"==a?e?c(e).find(t):(n=l.querySelectorAll(t),new r(n,t)):"[object Array]"===Object.prototype.toString.call(a)||i.NodeList&&t instanceof i.NodeList?new r(t,t):t.constructor===Array?new r(t,t):new r([t],t);var s=l.createElement("div");return s.innerHTML=t,c(s).children().each(function(){s.removeChild(this)})}var r=function(t,e){this.length=0,this.selector=e,c.merge(this,t)};r.prototype.reverse=[].reverse,c.fn=r.prototype,c.Shoestring=r,c.extend=function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n]);return t},c.merge=function(t,e){var n,a,s;for(n=+e.length,a=0,s=t.length;a<n;a++)t[s++]=e[a];return t.length=s,t},(i.shoestring=c).fn.each=function(t){return c.each(this,t)},c.each=function(t,e){for(var n=0,a=t.length;n<a&&!1!==e.call(t[n],n,t[n]);n++);return t},c.inArray=function(t,e){for(var n=-1,a=0,s=e.length;a<s;a++)e.hasOwnProperty(a)&&e[a]===t&&(n=a);return n},c.ready=function(t){return e&&t?t.call(l):t?n.push(t):a(),[l]};var o,e=!(c.fn.ready=function(t){return c.ready(t),this}),n=[],a=function(){if(!e){for(;n.length;)n.shift().call(l);e=!0}};function h(t,e){var n=!1;return t.each(function(){for(var t=0;t<e.length;)this===e[t]&&(n=!0),t++}),n}(l.attachEvent?"complete"===l.readyState:"loading"!==l.readyState)?a():(l.addEventListener("DOMContentLoaded",a,!1),l.addEventListener("readystatechange",a,!1),i.addEventListener("load",a,!1)),c.fn.is=function(a){var t,s=!1,i=this;return"string"!=typeof a?h(this,a.length&&a[0]?a:[a]):((t=this.parent()).length||(t=c(l)),t.each(function(t,e){var n;n=e.querySelectorAll(a),s=h(i,n)}),s)},c.fn.data=function(t,e){return void 0===t?this[0]?this[0].shoestringData||{}:void 0:void 0!==e?this.each(function(){this.shoestringData||(this.shoestringData={}),this.shoestringData[t]=e}):this[0]&&this[0].shoestringData?this[0].shoestringData[t]:void 0},c.fn.removeData=function(t){return this.each(function(){void 0!==t&&this.shoestringData?(this.shoestringData[t]=void 0,delete this.shoestringData[t]):this[0].shoestringData={}})},(i.$=c).fn.addClass=function(t){var n=t.replace(/^\s+|\s+$/g,"").split(" ");return this.each(function(){for(var t=0,e=n.length;t<e;t++)void 0===this.className||""!==this.className&&this.className.match(new RegExp("(^|\\s)"+n[t]+"($|\\s)"))||(this.className+=" "+n[t])})},c.fn.add=function(t){var e=[];return this.each(function(){e.push(this)}),c(t).each(function(){e.push(this)}),c(e)},c.fn.append=function(a){return"string"!=typeof a&&void 0===a.nodeType||(a=c(a)),this.each(function(t){for(var e=0,n=a.length;e<n;e++)this.appendChild(0<t?a[e].cloneNode(!0):a[e])})},c.fn.appendTo=function(t){return this.each(function(){c(t).append(this)})},c.fn.attr=function(e,n){var a="string"==typeof e;return void 0===n&&a?this[0]?this[0].getAttribute(e):void 0:this.each(function(){if(a)this.setAttribute(e,n);else for(var t in e)e.hasOwnProperty(t)&&this.setAttribute(t,e[t])})},c.fn.before=function(a){return"string"!=typeof a&&void 0===a.nodeType||(a=c(a)),this.each(function(t){for(var e=0,n=a.length;e<n;e++)this.parentNode.insertBefore(0<t?a[e].cloneNode(!0):a[e],this)})},c.fn.children=function(){var t,e,n=[];return this.each(function(){for(t=this.children,e=-1;e++<t.length-1;)-1===c.inArray(t[e],n)&&n.push(t[e])}),c(n)},c.fn.closest=function(e){var n=[];return e&&this.each(function(){var t;if(c(t=this).is(e))n.push(this);else for(;t.parentElement;){if(c(t.parentElement).is(e)){n.push(t.parentElement);break}t=t.parentElement}}),c(n)},c.cssExceptions={float:["cssFloat"]},function(){var r=c.cssExceptions;function o(t,e){return i.getComputedStyle(t,null).getPropertyValue(e)}var l=["","-webkit-","-ms-","-moz-","-o-","-khtml-"];c._getStyle=function(t,e){var n,a,s,i;if(r[e])for(s=0,i=r[e].length;s<i;s++)if(a=o(t,r[e][s]))return a;for(s=0,i=l.length;s<i;s++)if(a=o(t,n=(l[s]+e).replace(/\-([A-Za-z])/g,function(t,e){return e.toUpperCase()})),n!==e&&(a=a||o(t,e)),l[s]&&(a=a||o(t,l[s]+e)),a)return a}}(),o=c.cssExceptions,c._setStyle=function(t,e,n){var a=function(t){return t.replace(/\-([A-Za-z])/g,function(t,e){return e.toUpperCase()})}(e);if(t.style[e]=n,a!==e&&(t.style[a]=n),o[e])for(var s=0,i=o[e].length;s<i;s++)t.style[o[e][s]]=n},c.fn.css=function(e,t){if(this[0])return"object"==typeof e?this.each(function(){for(var t in e)e.hasOwnProperty(t)&&c._setStyle(this,t,e[t])}):void 0!==t?this.each(function(){c._setStyle(this,e,t)}):c._getStyle(this[0],e)},c.fn.eq=function(t){return this[t]?c(this[t]):c([])},c.fn.filter=function(a){var s=[];return this.each(function(t){var e;if("function"==typeof a)!1!==a.call(this,t)&&s.push(this);else{if(this.parentNode)e=c(a,this.parentNode);else{var n=c(l.createDocumentFragment());n[0].appendChild(this),e=c(a,n)}-1<c.inArray(this,e)&&s.push(this)}}),c(s)},c.fn.find=function(n){var a,s=[];return this.each(function(){for(var t=0,e=(a=this.querySelectorAll(n)).length;t<e;t++)s=s.concat(a[t])}),c(s)},c.fn.first=function(){return this.eq(0)},c.fn.get=function(t){if(void 0!==t)return this[t];for(var e=[],n=0;n<this.length;n++)e.push(this[n]);return e};c.fn.html=function(t){if(void 0!==t)return function(t){if("string"==typeof t||"number"==typeof t)return this.each(function(){this.innerHTML=""+t});var e="";if(void 0!==t.length)for(var n=0,a=t.length;n<a;n++)e+=t[n].outerHTML;else e=t.outerHTML;return this.each(function(){this.innerHTML=e})}.call(this,t);var e="";return this.each(function(){e+=this.innerHTML}),e},function(){function t(t,e){var n,a,s;for(n=a=0;n<t.length;n++){if(e(s=t.item?t.item(n):t[n]))return a;1===s.nodeType&&a++}return-1}c.fn.index=function(e){var n;return n=this,void 0===e?t((this[0]&&this[0].parentNode||l.documentElement).childNodes,function(t){return n[0]===t}):t(n,function(t){return t===c(e,t.parentNode)[0]})}}(),c.fn.insertBefore=function(t){return this.each(function(){c(t).before(this)})},c.fn.last=function(){return this.eq(this.length-1)},c.fn.next=function(){var s=[];return this.each(function(){var t,e,n;t=c(this.parentNode)[0].childNodes;for(var a=0;a<t.length;a++){if(e=t.item(a),n&&1===e.nodeType){s.push(e);break}e===this&&(n=!0)}}),c(s)},c.fn.not=function(e){var n=[];return this.each(function(){var t=c(e,this.parentNode);-1===c.inArray(this,t)&&n.push(this)}),c(n)},c.fn.parent=function(){var t,e=[];return this.each(function(){(t=this===l.documentElement?l:this.parentNode)&&11!==t.nodeType&&e.push(t)}),c(e)},c.fn.prepend=function(s){return"string"!=typeof s&&void 0===s.nodeType||(s=c(s)),this.each(function(t){for(var e=0,n=s.length;e<n;e++){var a=0<t?s[e].cloneNode(!0):s[e];this.firstChild?this.insertBefore(a,this.firstChild):this.appendChild(a)}})},c.fn.prev=function(){var s=[];return this.each(function(){for(var t,e,n,a=(t=c(this.parentNode)[0].childNodes).length-1;0<=a;a--){if(e=t.item(a),n&&1===e.nodeType){s.push(e);break}e===this&&(n=!0)}}),c(s)},c.fn.prevAll=function(){var e=[];return this.each(function(){for(var t=c(this).prev();t.length;)e.push(t[0]),t=t.prev()}),c(e)},c.fn.removeAttr=function(t){return this.each(function(){this.removeAttribute(t)})},c.fn.removeClass=function(t){var s=t.replace(/^\s+|\s+$/g,"").split(" ");return this.each(function(){for(var t,e,n=0,a=s.length;n<a;n++)void 0!==this.className&&(e=new RegExp("(^|\\s)"+s[n]+"($|\\s)","gmi"),t=this.className.replace(e," "),this.className=t.replace(/^\s+|\s+$/g,""))})},c.fn.remove=function(){return this.each(function(){this.parentNode&&this.parentNode.removeChild(this)})},c.fn.replaceWith=function(i){"string"==typeof i&&(i=c(i));var r=[];return 1<i.length&&(i=i.reverse()),this.each(function(t){var e,n=this.cloneNode(!0);if(r.push(n),this.parentNode)if(1===i.length)e=0<t?i[0].cloneNode(!0):i[0],this.parentNode.replaceChild(e,this);else{for(var a=0,s=i.length;a<s;a++)e=0<t?i[a].cloneNode(!0):i[a],this.parentNode.insertBefore(e,this.nextSibling);this.parentNode.removeChild(this)}}),c(r)},c.fn.siblings=function(){if(!this.length)return c([]);for(var t=[],e=this[0].parentNode.firstChild;1===e.nodeType&&e!==this[0]&&t.push(e),e=e.nextSibling;);return c(t)};var u=function(t){var e,n="",a=0,s=t.nodeType;if(s){if(1===s||9===s||11===s){if("string"==typeof t.textContent)return t.textContent;for(t=t.firstChild;t;t=t.nextSibling)n+=u(t)}else if(3===s||4===s)return t.nodeValue}else for(;e=t[a++];)n+=u(e);return n};function d(t,e,n){var a=this.shoestringData.events[t];if(a&&a.length){var s,i,r=[];for(s=0,i=a.length;s<i;s++)e&&e!==a[s].namespace||void 0!==n&&n!==a[s].originalCallback||(this.removeEventListener(t,a[s].callback,!1),r.push(s));for(s=0,i=r.length;s<i;s++)this.shoestringData.events[t].splice(s,1)}}function f(t,e){for(var n in this.shoestringData.events)d.call(this,n,t,e)}return c.fn.text=function(){return u(this)},c.fn.val=function(r){var t;return void 0!==r?this.each(function(){if("SELECT"===this.tagName){var t,e,n,a=this.options,s=[],i=a.length;for(s[0]=r;i--;)((e=a[i]).selected=0<=c.inArray(e.value,s))&&(t=!0,n=i);this.selectedIndex=t?n:-1}else this.value=r}):"SELECT"===(t=this[0]).tagName?t.selectedIndex<0?"":t.options[t.selectedIndex].value:t.value},c._dimension=function(t,e,n){var a;return void 0===n?(a=e.replace(/^[a-z]/,function(t){return t.toUpperCase()}),t[0]["offset"+a]):(n="string"==typeof n?n:n+"px",t.each(function(){this.style[e]=n}))},c.fn.width=function(t){return c._dimension(this,"width",t)},c.fn.wrapInner=function(e){return this.each(function(){var t=this.innerHTML;this.innerHTML="",c(this).append(c(e).html(t))})},c.fn.bind=function(t,r,f){"function"==typeof r&&(f=r,r=null);var p=t.split(" ");function b(t,e,n){var a;if(!t._namespace||t._namespace===e){t.data=r,t.namespace=t._namespace;var s=function(){return!0};t.isDefaultPrevented=function(){return!1};var i=t.preventDefault;return t.target=n||t.target||t.srcElement,t.preventDefault=i?function(){t.isDefaultPrevented=s,i.call(t)}:function(){t.isDefaultPrevented=s,t.returnValue=!1},t.stopPropagation=t.stopPropagation||function(){t.cancelBubble=!0},!1===(a=f.apply(this,[t].concat(t._args)))&&(t.preventDefault(),t.stopPropagation()),a}}return this.each(function(){for(var t,e,n,a,s,i,r,o=this,l=0,c=p.length;l<c;l++){var h=p[l].split("."),u=h[0],d=0<h.length?h[1]:null;t=function(t){return o.ssEventTrigger&&(t._namespace=o.ssEventTrigger._namespace,t._args=o.ssEventTrigger._args,o.ssEventTrigger=null),b.call(o,t,d)},null,r=u,(i=this).shoestringData||(i.shoestringData={}),i.shoestringData.events||(i.shoestringData.events={}),i.shoestringData.loop||(i.shoestringData.loop={}),i.shoestringData.events[r]||(i.shoestringData.events[r]=[]),this.addEventListener(u,t,!1),e=this,n=u,s=void 0,(s={}).isCustomEvent=(a={callfunc:t,isCustomEvent:!1,customEventLoop:null,originalCallback:f,namespace:d}).isCustomEvent,s.callback=a.callfunc,s.originalCallback=a.originalCallback,s.namespace=a.namespace,e.shoestringData.events[n].push(s),a.customEventLoop&&(e.shoestringData.loop[n]=a.customEventLoop)}})},c.fn.on=c.fn.bind,c.fn.unbind=function(t,i){var r=t?t.split(" "):[];return this.each(function(){if(this.shoestringData&&this.shoestringData.events)if(r.length)for(var t,e,n,a=0,s=r.length;a<s;a++)e=(t=r[a].split("."))[0],n=0<t.length?t[1]:null,e?d.call(this,e,n,i):f.call(this,n,i);else f.call(this)})},c.fn.off=c.fn.unbind,c.fn.one=function(t,i){var r=t.split(" ");return this.each(function(){for(var t,a={},e=c(this),n=0,s=r.length;n<s;n++)t=r[n],a[t]=function(t){var e=c(this);for(var n in a)e.unbind(n,a[n]);return i.apply(this,[t].concat(t._args))},e.bind(t,a[t])})},c.fn.triggerHandler=function(t,e){var n,a=t.split(" ")[0],s=this[0];if(l.createEvent&&s.shoestringData&&s.shoestringData.events&&s.shoestringData.events[a]){var i=s.shoestringData.events[a];for(var r in i)i.hasOwnProperty(r)&&((t=l.createEvent("Event")).initEvent(a,!0,!0),(t._args=e).unshift(t),n=i[r].originalCallback.apply(t.target,e))}return n},c.fn.trigger=function(t,r){var o=t.split(" ");return this.each(function(){for(var t,e,n,a=0,s=o.length;a<s;a++){if(e=(t=o[a].split("."))[0],n=0<t.length?t[1]:null,"click"===e&&"INPUT"===this.tagName&&"checkbox"===this.type&&this.click)return this.click(),!1;if(l.createEvent){var i=l.createEvent("Event");i.initEvent(e,!0,!0),i._args=r,i._namespace=n,this.dispatchEvent(i)}}})},c}),function(e,n){"function"==typeof define&&define.amd?define(["shoestring"],function(t){return e.Tablesaw=n(t,e)}):"object"==typeof exports?module.exports=n(require("shoestring"),e):e.Tablesaw=n(shoestring,e)}("undefined"!=typeof window?window:this,function(N,D){"use strict";var S=D.document,e=/complete|loaded/.test(S.readyState);S.addEventListener("DOMContentLoaded",function(){e=!0});var t,a,s,n,i,r,o,l,c,b,h,u,d,A={i18n:{modeStack:"Stack",modeSwipe:"Swipe",modeToggle:"Toggle",modeSwitchColumnsAbbreviated:"Cols",modeSwitchColumns:"Columns",columnToggleButton:"Columns",columnToggleError:"No eligible columns.",sort:"Sort",swipePreviousColumn:"Previous column",swipeNextColumn:"Next column"},mustard:"head"in S&&(!D.blackberry||D.WebKitPoint)&&!D.operamini,$:N,_init:function(t){A.$(t||S).trigger("enhance.tablesaw")},init:function(t){(e=e||/complete|loaded/.test(S.readyState))?A._init(t):"addEventListener"in S&&S.addEventListener("DOMContentLoaded",function(){A._init(t)})}};return N(S).on("enhance.tablesaw",function(){"undefined"!=typeof TablesawConfig&&TablesawConfig.i18n&&(A.i18n=N.extend(A.i18n,TablesawConfig.i18n||{})),A.i18n.modes=[A.i18n.modeStack,A.i18n.modeSwipe,A.i18n.modeToggle]}),A.mustard&&N(S.documentElement).addClass("tablesaw-enhanced"),function(){var n="tablesaw",a="tablesaw-bar",e={create:"tablesawcreate",destroy:"tablesawdestroy",refresh:"tablesawrefresh",resize:"tablesawresize"},s={};A.events=e;var t=function(t){if(!t)throw new Error("Tablesaw requires an element.");this.table=t,this.$table=N(t),this.$thead=this.$table.children().filter("thead").eq(0),this.$tbody=this.$table.children().filter("tbody"),this.mode=this.$table.attr("data-tablesaw-mode")||"stack",this.$toolbar=null,this.attributes={subrow:"data-tablesaw-subrow",ignorerow:"data-tablesaw-ignorerow"},this.init()};t.prototype.init=function(){if(!this.$thead.length)throw new Error("tablesaw: a <thead> is required, but none was found.");if(!this.$thead.find("th").length)throw new Error("tablesaw: no header cells found. Are you using <th> inside of <thead>?");this.$table.attr("id")||this.$table.attr("id",n+"-"+Math.round(1e4*Math.random())),this.createToolbar(),this._initCells(),this.$table.data(n,this),this.$table.trigger(e.create,[this])},t.prototype.getConfig=function(t){var e=N.extend(s,t||{});return N.extend(e,"undefined"!=typeof TablesawConfig?TablesawConfig:{})},t.prototype._getPrimaryHeaderRow=function(){return this._getHeaderRows().eq(0)},t.prototype._getHeaderRows=function(){return this.$thead.children().filter("tr").filter(function(){return!N(this).is("[data-tablesaw-ignorerow]")})},t.prototype._getRowIndex=function(t){return t.prevAll().length},t.prototype._getHeaderRowIndeces=function(){var t=this,e=[];return this._getHeaderRows().each(function(){e.push(t._getRowIndex(N(this)))}),e},t.prototype._getPrimaryHeaderCells=function(t){return(t||this._getPrimaryHeaderRow()).find("th")},t.prototype._$getCells=function(t){var a=this;return N(t).add(t.cells).filter(function(){var t=N(this),e=t.parent(),n=t.is("[colspan]");return!(e.is("["+a.attributes.subrow+"]")||e.is("["+a.attributes.ignorerow+"]")&&n)})},t.prototype._getVisibleColspan=function(){var e=0;return this._getPrimaryHeaderCells().each(function(){var t=N(this);"none"!==t.css("display")&&(e+=parseInt(t.attr("colspan"),10)||1)}),e},t.prototype.getColspanForCell=function(t){var e=this._getVisibleColspan(),n=0;return t.closest("tr").data("tablesaw-rowspanned")&&n++,t.siblings().each(function(){var t=N(this),e=parseInt(t.attr("colspan"),10)||1;"none"!==t.css("display")&&(n+=e)}),e-n},t.prototype.isCellInColumn=function(t,e){return N(t).add(t.cells).filter(function(){return this===e}).length},t.prototype.updateColspanCells=function(a,s,i){var r=this,t=r._getPrimaryHeaderRow();this.$table.find("[rowspan][data-tablesaw-priority]").each(function(){var t=N(this);if("persist"===t.attr("data-tablesaw-priority")){var e=t.closest("tr"),n=parseInt(t.attr("rowspan"),10);1<n&&((e=e.next()).data("tablesaw-rowspanned",!0),n--)}}),this.$table.find("[colspan],[data-tablesaw-maxcolspan]").filter(function(){return N(this).closest("tr")[0]!==t[0]}).each(function(){var t=N(this);if(void 0===i||r.isCellInColumn(s,this)){var e=r.getColspanForCell(t);a&&void 0!==i&&t[0===e?"addClass":"removeClass"](a);var n=parseInt(t.attr("data-tablesaw-maxcolspan"),10);n?n<e&&(e=n):t.attr("data-tablesaw-maxcolspan",t.attr("colspan")),t.attr("colspan",e)}})},t.prototype._findPrimaryHeadersForCell=function(t){for(var e=this._getPrimaryHeaderRow(),n=this._getRowIndex(e),a=[],s=0;s<this.headerMapping.length;s++)if(s!==n)for(var i=0;i<this.headerMapping[s].length;i++)this.headerMapping[s][i]===t&&a.push(this.headerMapping[n][i]);return a},t.prototype.getRows=function(){var t=this;return this.$table.find("tr").filter(function(){return N(this).closest("table").is(t.$table)})},t.prototype.getBodyRows=function(t){return(t?N(t):this.$tbody).children().filter("tr")},t.prototype.getHeaderCellIndex=function(t){for(var e=this.headerMapping[0],n=0;n<e.length;n++)if(e[n]===t)return n;return-1},t.prototype._initCells=function(){this.$table.find("[data-tablesaw-maxcolspan]").each(function(){var t=N(this);t.attr("colspan",t.attr("data-tablesaw-maxcolspan"))});var t=this.getRows(),r=[];t.each(function(t){r[t]=[]}),t.each(function(s){var i=0;N(this).children().each(function(){for(var t=parseInt(this.getAttribute("data-tablesaw-maxcolspan")||this.getAttribute("colspan"),10),e=parseInt(this.getAttribute("rowspan"),10);r[s][i];)i++;if(r[s][i]=this,t)for(var n=0;n<t-1;n++)i++,r[s][i]=this;if(e)for(var a=1;a<e;a++)r[s+a][i]=this;i++})});for(var e=this._getHeaderRowIndeces(),n=0;n<r[0].length;n++)for(var a=0,s=e.length;a<s;a++){var i,o=r[e[a]][n],l=e[a];for(o.cells||(o.cells=[]);l<r.length;)o!==(i=r[l][n])&&o.cells.push(i),l++}this.headerMapping=r},t.prototype.refresh=function(){this._initCells(),this.$table.trigger(e.refresh,[this])},t.prototype._getToolbarAnchor=function(){var t=this.$table.parent();return t.is(".tablesaw-overflow")?t:this.$table},t.prototype._getToolbar=function(t){return t||(t=this._getToolbarAnchor()),t.prev().filter("."+a)},t.prototype.createToolbar=function(){var t=this._getToolbarAnchor(),e=this._getToolbar(t);e.length||(e=N("<div>").addClass(a).insertBefore(t)),this.$toolbar=e,this.mode&&this.$toolbar.addClass("tablesaw-mode-"+this.mode)},t.prototype.destroy=function(){this._getToolbar().each(function(){this.className=this.className.replace(/\btablesaw-mode\-\w*\b/gi,"")});var t=this.$table.attr("id");N(S).off("."+t),N(D).off("."+t),this.$table.trigger(e.destroy,[this]),this.$table.removeData(n)},N.fn[n]=function(){return this.each(function(){N(this).data(n)||new t(this)})};var i=N(S);i.on("enhance.tablesaw",function(t){if(A.mustard){var e=N(t.target);e.parent().length&&(e=e.parent()),e.find("table").filter("[data-tablesaw],[data-tablesaw-mode],[data-tablesaw-sortable]")[n]()}});var r,o,l=!1;i.on("scroll.tablesaw",function(){l=!0,D.clearTimeout(r),r=D.setTimeout(function(){l=!1},300)}),N(D).on("resize",function(){l||(D.clearTimeout(o),o=D.setTimeout(function(){i.trigger(e.resize)},150))}),A.Table=t}(),a="tablesaw-cell-label",s="tablesaw-cell-content",n=t="tablesaw-stack",i="data-tablesaw-no-labels",r="data-tablesaw-hide-empty",(o=function(t,e){this.tablesaw=e,this.$table=N(t),this.labelless=this.$table.is("["+i+"]"),this.hideempty=this.$table.is("["+r+"]"),this.$table.data(n,this)}).prototype.init=function(){if(this.$table.addClass(t),!this.labelless){var n=this;this.$table.find("th, td").filter(function(){return!N(this).closest("thead").length}).filter(function(){return!(N(this).is("["+i+"]")||N(this).closest("tr").is("["+i+"]")||n.hideempty&&!N(this).html())}).each(function(){var r=N(S.createElement("b")).addClass(a),t=N(this);N(n.tablesaw._findPrimaryHeadersForCell(this)).each(function(t){var e=N(this.cloneNode(!0)),n=e.find(".tablesaw-sortable-btn");e.find(".tablesaw-sortable-arrow").remove();var a=e.find("[data-tablesaw-checkall]");if(a.closest("label").remove(),a.length)r=N([]);else{0<t&&r.append(S.createTextNode(", "));for(var s,i=n.length?n[0]:e[0];s=i.firstChild;)r[0].appendChild(s)}}),r.length&&!t.find("."+s).length&&t.wrapInner("<span class='"+s+"'></span>");var e=t.find("."+a);e.length?e.replaceWith(r):(t.prepend(S.createTextNode(" ")),t.prepend(r))})}},o.prototype.destroy=function(){this.$table.removeClass(t),this.$table.find("."+a).remove(),this.$table.find("."+s).each(function(){N(this).replaceWith(N(this.childNodes))})},N(S).on(A.events.create,function(t,e){"stack"===e.mode&&new o(e.table,e).init()}).on(A.events.refresh,function(t,e){"stack"===e.mode&&N(e.table).data(n).init()}).on(A.events.destroy,function(t,e){"stack"===e.mode&&N(e.table).data(n).destroy()}),A.Stack=o,l="tablesawbtn",c={_create:function(){return N(this).each(function(){N(this).trigger("beforecreate."+l)[l]("_init").trigger("create."+l)})},_init:function(){var t=N(this),e=this.getElementsByTagName("select")[0];return e&&N(this).addClass("btn-select tablesaw-btn-select")[l]("_select",e),t},_select:function(t){var e=function(t,e){var n,a,s=N(e).find("option"),i=S.createElement("span"),r=!1;if(i.setAttribute("aria-hidden","true"),i.innerHTML="&#160;",s.each(function(){this.selected&&(i.innerHTML=this.text)}),a=t.childNodes,0<s.length){for(var o=0,l=a.length;o<l;o++)(n=a[o])&&"SPAN"===n.nodeName.toUpperCase()&&(t.replaceChild(i,n),r=!0);r||t.insertBefore(i,t.firstChild)}};e(this,t),N(this).on("change refresh",function(){e(this,t)})}},N.fn[l]=function(t,e,n,a){return this.each(function(){return t&&"string"==typeof t?N.fn[l].prototype[t].call(this,e,n,a):N(this).data(l+"active")?N(this):(N(this).data(l+"active",!0),void N.fn[l].prototype._create.call(this))})},N.extend(N.fn[l].prototype,c),b="tablesaw-coltoggle",(h=function(t){this.$table=N(t),this.$table.length&&(this.tablesaw=this.$table.data("tablesaw"),this.attributes={btnTarget:"data-tablesaw-columntoggle-btn-target",set:"data-tablesaw-columntoggle-set"},this.classes={columnToggleTable:"tablesaw-columntoggle",columnBtnContain:"tablesaw-columntoggle-btnwrap tablesaw-advance",columnBtn:"tablesaw-columntoggle-btn tablesaw-nav-btn down",popup:"tablesaw-columntoggle-popup",priorityPrefix:"tablesaw-priority-"},this.set=[],this.$headers=this.tablesaw._getPrimaryHeaderCells(),this.$table.data(b,this))}).prototype.initSet=function(){var t=this.$table.attr(this.attributes.set);if(t){var e=this.$table[0];this.set=N("table["+this.attributes.set+"='"+t+"']").filter(function(){return this!==e}).get()}},h.prototype.init=function(){if(this.$table.length){var e,t,n,a,s,i,r=this,o=this.tablesaw.getConfig({getColumnToggleLabelTemplate:function(t){return"<label><input type='checkbox' checked>"+t+"</label>"}});this.$table.addClass(this.classes.columnToggleTable),t=(e=this.$table.attr("id"))+"-popup",i=N("<div class='"+this.classes.columnBtnContain+"'></div>"),n=N("<a href='#"+t+"' class='btn tablesaw-btn btn-micro "+this.classes.columnBtn+"' data-popup-link><span>"+A.i18n.columnToggleButton+"</span></a>"),a=N("<div class='"+this.classes.popup+"' id='"+t+"'></div>"),s=N("<div class='tablesaw-btn-group'></div>"),this.$popup=a;var l=!1;this.$headers.each(function(){var t=N(this),e=t.attr("data-tablesaw-priority"),n=r.tablesaw._$getCells(this);e&&"persist"!==e&&(n.addClass(r.classes.priorityPrefix+e),N(o.getColumnToggleLabelTemplate(t.text())).appendTo(s).find('input[type="checkbox"]').data("tablesaw-header",this),l=!0)}),l||s.append("<label>"+A.i18n.columnToggleError+"</label>"),s.appendTo(a),s.find('input[type="checkbox"]').on("change",function(e){var n;f(e.target),r.set.length&&(N(r.$popup).find("input[type='checkbox']").each(function(t){if(this===e.target)return n=t,!1}),N(r.set).each(function(){var t=N(this).data(b).$popup.find("input[type='checkbox']").get(n);t&&(t.checked=e.target.checked,f(t))}))}),n.appendTo(i);var c,h=N(this.$table.attr(this.attributes.btnTarget));i.appendTo(h.length?h:this.tablesaw.$toolbar),n.on("click.tablesaw",function(t){t.preventDefault(),i.is(".visible")?p():(i.addClass("visible"),n.removeClass("down").addClass("up"),N(S).off("click."+e,p),D.clearTimeout(c),c=D.setTimeout(function(){N(S).on("click."+e,p)},15))}),a.appendTo(i),this.$menu=s;var u,d=this.$table.closest(".tablesaw-overflow");d.css("-webkit-overflow-scrolling")&&d.on("scroll",function(){var t=N(this);D.clearTimeout(u),u=D.setTimeout(function(){t.css("-webkit-overflow-scrolling","auto"),D.setTimeout(function(){t.css("-webkit-overflow-scrolling","touch")},0)},100)}),N(D).on(A.events.resize+"."+e,function(){r.refreshToggle()}),this.initSet(),this.refreshToggle()}function f(t){var e=t.checked,n=r.getHeaderFromCheckbox(t),a=r.tablesaw._$getCells(n);a[e?"removeClass":"addClass"]("tablesaw-toggle-cellhidden"),a[e?"addClass":"removeClass"]("tablesaw-toggle-cellvisible"),r.updateColspanCells(n,e),r.$table.trigger("tablesawcolumns")}function p(t){t&&N(t.target).closest("."+r.classes.popup).length||(N(S).off("click."+e),n.removeClass("up").addClass("down"),i.removeClass("visible"))}},h.prototype.getHeaderFromCheckbox=function(t){return N(t).data("tablesaw-header")},h.prototype.refreshToggle=function(){var e=this;this.$menu.find("input").each(function(){var t=e.getHeaderFromCheckbox(this);this.checked="table-cell"===e.tablesaw._$getCells(t).eq(0).css("display")}),this.updateColspanCells()},h.prototype.updateColspanCells=function(t,e){this.tablesaw.updateColspanCells("tablesaw-toggle-cellhidden",t,e)},h.prototype.destroy=function(){this.$table.removeClass(this.classes.columnToggleTable),this.$table.find("th, td").each(function(){N(this).removeClass("tablesaw-toggle-cellhidden").removeClass("tablesaw-toggle-cellvisible"),this.className=this.className.replace(/\bui\-table\-priority\-\d\b/g,"")})},N(S).on(A.events.create,function(t,e){"columntoggle"===e.mode&&new h(e.table).init()}),N(S).on(A.events.destroy,function(t,e){"columntoggle"===e.mode&&N(e.table).data(b).destroy()}),N(S).on(A.events.refresh,function(t,e){"columntoggle"===e.mode&&N(e.table).data(b).refreshToggle()}),A.ColumnToggle=h,function(){function p(t){var e=[];return N(t.childNodes).each(function(){var t=N(this);t.is("input, select")?e.push(t.val()):t.is(".tablesaw-cell-label")||e.push((t.text()||"").replace(/^\s+|\s+$/g,""))}),e.join("")}var u="tablesaw-sortable",o="data-tablesaw-sortable-col",h="data-tablesaw-sortable-default-col",b="data-tablesaw-sortable-numeric",g="data-tablesaw-subrow",v="data-tablesaw-ignorerow",d={head:u+"-head",ascend:u+"-ascending",descend:u+"-descending",switcher:u+"-switch",tableToolbar:"tablesaw-bar-section",sortButton:u+"-btn"},t={_create:function(t){return N(this).each(function(){if(N(this).data(u+"-init"))return!1;N(this).data(u+"-init",!0).trigger("beforecreate."+u)[u]("_init",t).trigger("create."+u)})},_init:function(){var s,i,t,e,a,n,r=N(this),l=r.data("tablesaw");function c(t){N.each(t,function(t,e){var n=N(e);n.removeAttr(h),n.removeClass(d.ascend),n.removeClass(d.descend)})}r.addClass(u),s=r.children().filter("thead").find("th["+o+"]"),t=s,N.each(t,function(t,e){N(e).addClass(d.head)}),e=s,a=function(t){if(!N(t.target).is("a[href]")){t.stopPropagation();var e=N(t.target).closest("["+o+"]"),n=t.data.col,a=s.index(e[0]);c(e.closest("thead").find("th").filter(function(){return this!==e[0]})),e.is("."+d.descend)||!e.is("."+d.ascend)?(r[u]("sortBy",n,!0),a+="_asc"):(r[u]("sortBy",n),a+="_desc"),i&&i.find("select").val(a).trigger("refresh"),t.preventDefault()}},N.each(e,function(t,e){var n=N("<button class='"+d.sortButton+"'/>");n.on("click",{col:e},a),N(e).wrapInner(n).find("button").append("<span class='tablesaw-sortable-arrow'>")}),n=s,N.each(n,function(t,e){var n=N(e);n.is("["+h+"]")&&(n.is("."+d.descend)||n.addClass(d.ascend))}),r.is("[data-tablesaw-sortable-switch]")&&function(n){i=N("<div>").addClass(d.switcher).addClass(d.tableToolbar);var o=["<label>"+A.i18n.sort+":"];o.push('<span class="btn tablesaw-btn"><select>'),n.each(function(t){var e=N(this),n=e.is("["+h+"]"),a=e.is("."+d.descend),s=e.is("["+b+"]"),i=0;N(this.cells.slice(0,5)).each(function(){isNaN(parseInt(p(this),10))||i++});var r=5===i;s||e.attr(b,r?"":"false"),o.push("<option"+(n&&!a?" selected":"")+' value="'+t+'_asc">'+e.text()+" "+(r?"&#x2191;":"(A-Z)")+"</option>"),o.push("<option"+(n&&a?" selected":"")+' value="'+t+'_desc">'+e.text()+" "+(r?"&#x2193;":"(Z-A)")+"</option>")}),o.push("</select></span></label>"),i.html(o.join(""));var t=l.$toolbar.children().eq(0);t.length?i.insertBefore(t):i.appendTo(l.$toolbar),i.find(".tablesaw-btn").tablesawbtn(),i.find("select").on("change",function(){var t=N(this).val().split("_"),e=n.eq(t[0]);c(e.siblings()),r[u]("sortBy",e.get(0),"asc"===t[1])})}(s)},sortRows:function(t,e,n,a,s){var i,r,o,l,c,h,u,d=(r=a.cells,o=s,l=[],N.each(r,function(t,e){for(var n=e.parentNode,a=N(n),s=[],i=a.next();i.is("["+g+"]");)s.push(i[0]),i=i.next();var r=n.parentNode;a.is("["+g+"]")||r===o&&l.push({element:e,cell:p(e),row:n,subrows:s.length?s:null,ignored:a.is("["+v+"]")})}),l),f=N(a).data("tablesaw-sort");return i=!(!f||"function"!=typeof f)&&f(n)||(c=n,h=N(a).is("["+b+"]")&&!N(a).is("["+b+'="false"]'),u=/[^\-\+\d\.]/g,c?function(t,e){return t.ignored||e.ignored?0:h?parseFloat(t.cell.replace(u,""))-parseFloat(e.cell.replace(u,"")):t.cell.toLowerCase()>e.cell.toLowerCase()?1:-1}:function(t,e){return t.ignored||e.ignored?0:h?parseFloat(e.cell.replace(u,""))-parseFloat(t.cell.replace(u,"")):t.cell.toLowerCase()<e.cell.toLowerCase()?1:-1}),function(t){var e,n,a=[];for(e=0,n=t.length;e<n;e++)a.push(t[e].row),t[e].subrows&&a.push(t[e].subrows);return a}(d.sort(i))},makeColDefault:function(t,e){var n=N(t);n.attr(h,"true"),e?(n.removeClass(d.descend),n.addClass(d.ascend)):(n.removeClass(d.ascend),n.addClass(d.descend))},sortBy:function(r,o){var l,c=N(this),h=c.data("tablesaw");h.$tbody.each(function(){var t,e,n,a=N(this),s=h.getBodyRows(this),i=h.headerMapping[0];for(e=0,n=i.length;e<n;e++)if(i[e]===r){l=e;break}for(e=0,n=(t=c[u]("sortRows",s,l,o,r,this)).length;e<n;e++)a.append(t[e])}),c[u]("makeColDefault",r,o),c.trigger("tablesaw-sorted")}};N.fn[u]=function(t){var e,n=Array.prototype.slice.call(arguments,1);return t&&"string"==typeof t?void 0!==(e=N.fn[u].prototype[t].apply(this[0],n))?e:N(this):(N(this).data(u+"-active")||(N(this).data(u+"-active",!0),N.fn[u].prototype._create.call(this,t)),N(this))},N.extend(N.fn[u].prototype,t),N(S).on(A.events.create,function(t,e){e.$table.is("table[data-tablesaw-sortable]")&&e.$table[u]()})}(),function(){var T="disabled",$="tablesaw-fix-persist",k="tablesaw-swipe-cellhidden",x="tablesaw-swipe-cellpersist",_="tablesaw-all-cols-visible",E="data-tablesaw-no-touch";function n(c,o){var l=o.data("tablesaw"),t=N("<div class='tablesaw-advance'></div>"),n=N("<a href='#' class='btn tablesaw-nav-btn tablesaw-btn btn-micro left'>"+A.i18n.swipePreviousColumn+"</a>").appendTo(t),a=N("<a href='#' class='btn tablesaw-nav-btn tablesaw-btn btn-micro right'>"+A.i18n.swipeNextColumn+"</a>").appendTo(t),h=c._getPrimaryHeaderCells(),i=h.not('[data-tablesaw-priority="persist"]'),u=[],r=N(S.head||"head"),d=o.attr("id");if(!h.length)throw new Error("tablesaw swipe: no header cells found.");function e(){o.css({width:"1px"}),o.find("."+k).removeClass(k),u=[],h.each(function(){u.push(this.offsetWidth)}),o.css({width:""})}function f(t){l._$getCells(t).removeClass(k)}function p(t){l._$getCells(t).addClass(k)}function b(){o.removeClass($),N("#"+d+"-persist").remove()}function s(){var t,n="#"+d+".tablesaw-swipe ",a=[],s=o.width(),i=[];if(h.each(function(t){var e;(function(t){return N(t).is('[data-tablesaw-priority="persist"]')})(this)&&(e=this.offsetWidth)<.75*s&&(i.push(t+"-"+e),a.push(n+" ."+x+":nth-child("+(t+1)+") { width: "+e+"px; }"))}),t=i.join("_"),a.length){o.addClass($);var e=N("#"+d+"-persist");e.length&&e.data("tablesaw-hash")===t||(e.remove(),N("<style>"+a.join("\n")+"</style>").attr("id",d+"-persist").data("tablesaw-hash",t).appendTo(r))}}function g(){var a,s=[];return i.each(function(t){var e=N(this),n="none"===e.css("display")||e.is("."+k);if(n||a){if(n&&a)return s[1]=t,!1}else a=!0,s[0]=t}),s}function v(){var t=g();return[t[1]-1,t[0]-1]}function w(t){return-1<t[1]&&t[1]<i.length}function m(){if(function(){var t=o.attr("data-tablesaw-swipe-media");return!t||"matchMedia"in D&&D.matchMedia(t).matches}()){var n=o.parent().width(),a=[],s=0,i=[],r=h.length;h.each(function(t){var e=N(this).is('[data-tablesaw-priority="persist"]');a.push(e),s+=u[t],i.push(s),(e||n<s)&&r--});var e=0===r;h.each(function(t){i[t]>n&&p(this)}),h.each(function(t){a[t]?function(t){l._$getCells(t).addClass(x)}(this):(i[t]<=n||e)&&(e=!1,f(this),l.updateColspanCells(k,this,!0))}),b(),o.trigger("tablesawcolumns")}}function y(t){var e=function(t){return t?g():v()}(t);w(e)&&(isNaN(e[0])&&(e[0]=t?0:i.length-1),s(),p(i.get(e[0])),l.updateColspanCells(k,i.get(e[0]),!1),f(i.get(e[1])),l.updateColspanCells(k,i.get(e[1]),!0),o.trigger("tablesawcolumns"))}function C(t,e){return(t.touches||t.originalEvent.touches)[0][e]}o.addClass("tablesaw-swipe"),e(),t.appendTo(l.$toolbar),d||(d="tableswipe-"+Math.round(1e4*Math.random()),o.attr("id",d)),n.add(a).on("click",function(t){y(!!N(t.target).closest(a).length),t.preventDefault()}),o.is("["+E+"]")||o.on("touchstart.swipetoggle",function(t){var s,i,r=C(t,"pageX"),o=C(t,"pageY"),l=D.pageYOffset;N(D).off(A.events.resize,m),N(this).on("touchmove.swipetoggle",function(t){s=C(t,"pageX"),i=C(t,"pageY")}).on("touchend.swipetoggle",function(){var t=c.getConfig({swipeHorizontalThreshold:30,swipeVerticalThreshold:30}),e=t.swipe?t.swipe.verticalThreshold:t.swipeVerticalThreshold,n=t.swipe?t.swipe.horizontalThreshold:t.swipeHorizontalThreshold,a=Math.abs(D.pageYOffset-l)>=e;Math.abs(i-o)>=e||a||(s-r<-1*n&&y(!0),n<s-r&&y(!1)),D.setTimeout(function(){N(D).on(A.events.resize,m)},300),N(this).off("touchmove.swipetoggle touchend.swipetoggle")})}),o.on("tablesawcolumns.swipetoggle",function(){var t=w(v()),e=w(g());n[t?"removeClass":"addClass"](T),a[e?"removeClass":"addClass"](T),l.$toolbar[t||e?"removeClass":"addClass"](_)}).on("tablesawnext.swipetoggle",function(){y(!0)}).on("tablesawprev.swipetoggle",function(){y(!1)}).on(A.events.destroy+".swipetoggle",function(){var t=N(this);t.removeClass("tablesaw-swipe"),l.$toolbar.find(".tablesaw-advance").remove(),N(D).off(A.events.resize,m),t.off(".swipetoggle")}).on(A.events.refresh,function(){b(),e(),m()}),m(),N(D).on(A.events.resize,m)}N(S).on(A.events.create,function(t,e){"swipe"===e.mode&&n(e,e.$table)})}(),u={attr:{init:"data-tablesaw-minimap"},show:function(t){var e=t.getAttribute(u.attr.init);return""===e||!!(e&&"matchMedia"in D)&&D.matchMedia(e).matches}},N(S).on(A.events.create,function(t,e){"swipe"!==e.mode&&"columntoggle"!==e.mode||!e.$table.is("[ "+u.attr.init+"]")||function(t){var e=t.data("tablesaw"),n=N('<div class="tablesaw-advance minimap">'),a=N('<ul class="tablesaw-advance-dots">').appendTo(n),s="tablesaw-advance-dots-hide";function i(){if(u.show(t[0])){n.css("display","block");var e=a.find("li").removeClass(s);t.find("thead th").each(function(t){"none"===N(this).css("display")&&e.eq(t).addClass(s)})}else n.css("display","none")}t.data("tablesaw")._getPrimaryHeaderCells().each(function(){a.append("<li><i></i></li>")}),n.appendTo(e.$toolbar),i(),N(D).on(A.events.resize,i),t.on("tablesawcolumns.minimap",function(){i()}).on(A.events.destroy+".minimap",function(){var t=N(this);e.$toolbar.find(".tablesaw-advance").remove(),N(D).off(A.events.resize,i),t.off(".minimap")})}(e.$table)}),A.MiniMap=u,d={selectors:{init:"table[data-tablesaw-mode-switch]"},attributes:{excludeMode:"data-tablesaw-mode-exclude"},classes:{main:"tablesaw-modeswitch",toolbar:"tablesaw-bar-section"},modes:["stack","swipe","columntoggle"],init:function(e){var t,n=N(e),a=n.data("tablesaw"),s=n.attr(d.attributes.excludeMode),i=a.$toolbar,r=N("<div>").addClass(d.classes.main+" "+d.classes.toolbar),o=['<label><span class="abbreviated">'+A.i18n.modeSwitchColumnsAbbreviated+'</span><span class="longform">'+A.i18n.modeSwitchColumns+"</span>:"],l=n.attr("data-tablesaw-mode");o.push('<span class="btn tablesaw-btn"><select>');for(var c=0,h=d.modes.length;c<h;c++)s&&s.toLowerCase()===d.modes[c]||(t=l===d.modes[c],o.push("<option"+(t?" selected":"")+' value="'+d.modes[c]+'">'+A.i18n.modes[c]+"</option>"));o.push("</select></span></label>"),r.html(o.join(""));var u=i.find(".tablesaw-advance").eq(0);u.length?r.insertBefore(u):r.appendTo(i),r.find(".tablesaw-btn").tablesawbtn(),r.find("select").on("change",function(t){return d.onModeChange.call(e,t,N(this).val())})},onModeChange:function(t,e){var n=N(this),a=n.data("tablesaw");a.$toolbar.find("."+d.classes.main).remove(),a.destroy(),n.attr("data-tablesaw-mode",e),n.tablesaw()}},N(S).on(A.events.create,function(t,e){e.$table.is(d.selectors.init)&&d.init(e.table)}),function(){var i="tablesawCheckAll";function n(t){this.tablesaw=t,this.$table=t.$table,this.attr="data-tablesaw-checkall",this.checkAllSelector="["+this.attr+"]",this.forceCheckedSelector="["+this.attr+"-checked]",this.forceUncheckedSelector="["+this.attr+"-unchecked]",this.checkboxSelector='input[type="checkbox"]',this.$triggers=null,this.$checkboxes=null,this.$table.data(i)||(this.$table.data(i,this),this.init())}n.prototype._filterCells=function(t){return t.filter(function(){return!N(this).closest("tr").is("[data-tablesaw-subrow],[data-tablesaw-ignorerow]")}).find(this.checkboxSelector).not(this.checkAllSelector)},n.prototype.getCheckboxesForButton=function(t){return this._filterCells(N(N(t).attr(this.attr)))},n.prototype.getCheckboxesForCheckbox=function(t){return this._filterCells(N(N(t).closest("th")[0].cells))},n.prototype.init=function(){var t=this;this.$table.find(this.checkAllSelector).each(function(){N(this).is(t.checkboxSelector)?t.addCheckboxEvents(this):t.addButtonEvents(this)})},n.prototype.addButtonEvents=function(t){var s=this;N(t).on("click",function(t){t.preventDefault();var e,n=s.getCheckboxesForButton(this),a=!0;n.each(function(){this.checked||(a=!1)}),e=!!N(this).is(s.forceCheckedSelector)||!N(this).is(s.forceUncheckedSelector)&&!a,n.each(function(){this.checked=e,N(this).trigger("change."+i)})})},n.prototype.addCheckboxEvents=function(n){var e=this;N(n).on("change",function(){var t=this.checked;e.getCheckboxesForCheckbox(this).each(function(){this.checked=t})});var a=e.getCheckboxesForCheckbox(n);a.on("change."+i,function(){var t=0;a.each(function(){this.checked&&t++});var e=t===a.length;n.checked=e,n.indeterminate=0!==t&&!e})},N(S).on(A.events.create,function(t,e){new n(e)}),A.CheckAll=n}(),A}),function(t){"use strict";if(!("Tablesaw"in t))throw new Error("Tablesaw library not found.");if(!("init"in Tablesaw))throw new Error("Your tablesaw-init.js is newer than the core Tablesaw version.");Tablesaw.init()}("undefined"!=typeof window?window:this);
//# sourceMappingURL=tablesaw.js.map
