/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/webpack/buildin/amd-options.js":
/***/ (function(module, exports) {

/* WEBPACK VAR INJECTION */(function(__webpack_amd_options__) {/* globals __webpack_amd_options__ */
module.exports = __webpack_amd_options__;

/* WEBPACK VAR INJECTION */}.call(exports, {}))

/***/ }),

/***/ "./resources/assets/js/bootstrap.min.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
 * Bootstrap v3.1.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");+function (a) {
  "use strict";
  function b() {
    var a = document.createElement("bootstrap"),
        b = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd otransitionend", transition: "transitionend" };for (var c in b) {
      if (void 0 !== a.style[c]) return { end: b[c] };
    }return !1;
  }a.fn.emulateTransitionEnd = function (b) {
    var c = !1,
        d = this;a(this).one(a.support.transition.end, function () {
      c = !0;
    });var e = function e() {
      c || a(d).trigger(a.support.transition.end);
    };return setTimeout(e, b), this;
  }, a(function () {
    a.support.transition = b();
  });
}(jQuery), +function (a) {
  "use strict";
  var b = '[data-dismiss="alert"]',
      c = function c(_c) {
    a(_c).on("click", b, this.close);
  };c.prototype.close = function (b) {
    function c() {
      f.trigger("closed.bs.alert").remove();
    }var d = a(this),
        e = d.attr("data-target");e || (e = d.attr("href"), e = e && e.replace(/.*(?=#[^\s]*$)/, ""));var f = a(e);b && b.preventDefault(), f.length || (f = d.hasClass("alert") ? d : d.parent()), f.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one(a.support.transition.end, c).emulateTransitionEnd(150) : c());
  };var d = a.fn.alert;a.fn.alert = function (b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.alert");e || d.data("bs.alert", e = new c(this)), "string" == typeof b && e[b].call(d);
    });
  }, a.fn.alert.Constructor = c, a.fn.alert.noConflict = function () {
    return a.fn.alert = d, this;
  }, a(document).on("click.bs.alert.data-api", b, c.prototype.close);
}(jQuery), +function (a) {
  "use strict";
  var b = function b(c, d) {
    this.$element = a(c), this.options = a.extend({}, b.DEFAULTS, d), this.isLoading = !1;
  };b.DEFAULTS = { loadingText: "loading..." }, b.prototype.setState = function (b) {
    var c = "disabled",
        d = this.$element,
        e = d.is("input") ? "val" : "html",
        f = d.data();b += "Text", f.resetText || d.data("resetText", d[e]()), d[e](f[b] || this.options[b]), setTimeout(a.proxy(function () {
      "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c));
    }, this), 0);
  }, b.prototype.toggle = function () {
    var a = !0,
        b = this.$element.closest('[data-toggle="buttons"]');if (b.length) {
      var c = this.$element.find("input");"radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change");
    }a && this.$element.toggleClass("active");
  };var c = a.fn.button;a.fn.button = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.button"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;e || d.data("bs.button", e = new b(this, f)), "toggle" == c ? e.toggle() : c && e.setState(c);
    });
  }, a.fn.button.Constructor = b, a.fn.button.noConflict = function () {
    return a.fn.button = c, this;
  }, a(document).on("click.bs.button.data-api", "[data-toggle^=button]", function (b) {
    var c = a(b.target);c.hasClass("btn") || (c = c.closest(".btn")), c.button("toggle"), b.preventDefault();
  });
}(jQuery), +function (a) {
  "use strict";
  var b = function b(_b, c) {
    this.$element = a(_b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = this.sliding = this.interval = this.$active = this.$items = null, "hover" == this.options.pause && this.$element.on("mouseenter", a.proxy(this.pause, this)).on("mouseleave", a.proxy(this.cycle, this));
  };b.DEFAULTS = { interval: 5e3, pause: "hover", wrap: !0 }, b.prototype.cycle = function (b) {
    return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this;
  }, b.prototype.getActiveIndex = function () {
    return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active);
  }, b.prototype.to = function (b) {
    var c = this,
        d = this.getActiveIndex();return b > this.$items.length - 1 || 0 > b ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
      c.to(b);
    }) : d == b ? this.pause().cycle() : this.slide(b > d ? "next" : "prev", a(this.$items[b]));
  }, b.prototype.pause = function (b) {
    return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this;
  }, b.prototype.next = function () {
    return this.sliding ? void 0 : this.slide("next");
  }, b.prototype.prev = function () {
    return this.sliding ? void 0 : this.slide("prev");
  }, b.prototype.slide = function (b, c) {
    var d = this.$element.find(".item.active"),
        e = c || d[b](),
        f = this.interval,
        g = "next" == b ? "left" : "right",
        h = "next" == b ? "first" : "last",
        i = this;if (!e.length) {
      if (!this.options.wrap) return;e = this.$element.find(".item")[h]();
    }if (e.hasClass("active")) return this.sliding = !1;var j = a.Event("slide.bs.carousel", { relatedTarget: e[0], direction: g });return this.$element.trigger(j), j.isDefaultPrevented() ? void 0 : (this.sliding = !0, f && this.pause(), this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid.bs.carousel", function () {
      var b = a(i.$indicators.children()[i.getActiveIndex()]);b && b.addClass("active");
    })), a.support.transition && this.$element.hasClass("slide") ? (e.addClass(b), e[0].offsetWidth, d.addClass(g), e.addClass(g), d.one(a.support.transition.end, function () {
      e.removeClass([b, g].join(" ")).addClass("active"), d.removeClass(["active", g].join(" ")), i.sliding = !1, setTimeout(function () {
        i.$element.trigger("slid.bs.carousel");
      }, 0);
    }).emulateTransitionEnd(1e3 * d.css("transition-duration").slice(0, -1))) : (d.removeClass("active"), e.addClass("active"), this.sliding = !1, this.$element.trigger("slid.bs.carousel")), f && this.cycle(), this);
  };var c = a.fn.carousel;a.fn.carousel = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.carousel"),
          f = a.extend({}, b.DEFAULTS, d.data(), "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c),
          g = "string" == typeof c ? c : f.slide;e || d.data("bs.carousel", e = new b(this, f)), "number" == typeof c ? e.to(c) : g ? e[g]() : f.interval && e.pause().cycle();
    });
  }, a.fn.carousel.Constructor = b, a.fn.carousel.noConflict = function () {
    return a.fn.carousel = c, this;
  }, a(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", function (b) {
    var c,
        d = a(this),
        e = a(d.attr("data-target") || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "")),
        f = a.extend({}, e.data(), d.data()),
        g = d.attr("data-slide-to");g && (f.interval = !1), e.carousel(f), (g = d.attr("data-slide-to")) && e.data("bs.carousel").to(g), b.preventDefault();
  }), a(window).on("load", function () {
    a('[data-ride="carousel"]').each(function () {
      var b = a(this);b.carousel(b.data());
    });
  });
}(jQuery), +function (a) {
  "use strict";
  var b = function b(c, d) {
    this.$element = a(c), this.options = a.extend({}, b.DEFAULTS, d), this.transitioning = null, this.options.parent && (this.$parent = a(this.options.parent)), this.options.toggle && this.toggle();
  };b.DEFAULTS = { toggle: !0 }, b.prototype.dimension = function () {
    var a = this.$element.hasClass("width");return a ? "width" : "height";
  }, b.prototype.show = function () {
    if (!this.transitioning && !this.$element.hasClass("in")) {
      var b = a.Event("show.bs.collapse");if (this.$element.trigger(b), !b.isDefaultPrevented()) {
        var c = this.$parent && this.$parent.find("> .panel > .in");if (c && c.length) {
          var d = c.data("bs.collapse");if (d && d.transitioning) return;c.collapse("hide"), d || c.data("bs.collapse", null);
        }var e = this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[e](0), this.transitioning = 1;var f = function f() {
          this.$element.removeClass("collapsing").addClass("collapse in")[e]("auto"), this.transitioning = 0, this.$element.trigger("shown.bs.collapse");
        };if (!a.support.transition) return f.call(this);var g = a.camelCase(["scroll", e].join("-"));this.$element.one(a.support.transition.end, a.proxy(f, this)).emulateTransitionEnd(350)[e](this.$element[0][g]);
      }
    }
  }, b.prototype.hide = function () {
    if (!this.transitioning && this.$element.hasClass("in")) {
      var b = a.Event("hide.bs.collapse");if (this.$element.trigger(b), !b.isDefaultPrevented()) {
        var c = this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1;var d = function d() {
          this.transitioning = 0, this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse");
        };return a.support.transition ? void this.$element[c](0).one(a.support.transition.end, a.proxy(d, this)).emulateTransitionEnd(350) : d.call(this);
      }
    }
  }, b.prototype.toggle = function () {
    this[this.$element.hasClass("in") ? "hide" : "show"]();
  };var c = a.fn.collapse;a.fn.collapse = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.collapse"),
          f = a.extend({}, b.DEFAULTS, d.data(), "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c);!e && f.toggle && "show" == c && (c = !c), e || d.data("bs.collapse", e = new b(this, f)), "string" == typeof c && e[c]();
    });
  }, a.fn.collapse.Constructor = b, a.fn.collapse.noConflict = function () {
    return a.fn.collapse = c, this;
  }, a(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", function (b) {
    var c,
        d = a(this),
        e = d.attr("data-target") || b.preventDefault() || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, ""),
        f = a(e),
        g = f.data("bs.collapse"),
        h = g ? "toggle" : d.data(),
        i = d.attr("data-parent"),
        j = i && a(i);g && g.transitioning || (j && j.find('[data-toggle=collapse][data-parent="' + i + '"]').not(d).addClass("collapsed"), d[f.hasClass("in") ? "addClass" : "removeClass"]("collapsed")), f.collapse(h);
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    a(d).remove(), a(e).each(function () {
      var d = c(a(this)),
          e = { relatedTarget: this };d.hasClass("open") && (d.trigger(b = a.Event("hide.bs.dropdown", e)), b.isDefaultPrevented() || d.removeClass("open").trigger("hidden.bs.dropdown", e));
    });
  }function c(b) {
    var c = b.attr("data-target");c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));var d = c && a(c);return d && d.length ? d : b.parent();
  }var d = ".dropdown-backdrop",
      e = "[data-toggle=dropdown]",
      f = function f(b) {
    a(b).on("click.bs.dropdown", this.toggle);
  };f.prototype.toggle = function (d) {
    var e = a(this);if (!e.is(".disabled, :disabled")) {
      var f = c(e),
          g = f.hasClass("open");if (b(), !g) {
        "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click", b);var h = { relatedTarget: this };if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;f.toggleClass("open").trigger("shown.bs.dropdown", h), e.focus();
      }return !1;
    }
  }, f.prototype.keydown = function (b) {
    if (/(38|40|27)/.test(b.keyCode)) {
      var d = a(this);if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
        var f = c(d),
            g = f.hasClass("open");if (!g || g && 27 == b.keyCode) return 27 == b.which && f.find(e).focus(), d.click();var h = " li:not(.divider):visible a",
            i = f.find("[role=menu]" + h + ", [role=listbox]" + h);if (i.length) {
          var j = i.index(i.filter(":focus"));38 == b.keyCode && j > 0 && j--, 40 == b.keyCode && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).focus();
        }
      }
    }
  };var g = a.fn.dropdown;a.fn.dropdown = function (b) {
    return this.each(function () {
      var c = a(this),
          d = c.data("bs.dropdown");d || c.data("bs.dropdown", d = new f(this)), "string" == typeof b && d[b].call(c);
    });
  }, a.fn.dropdown.Constructor = f, a.fn.dropdown.noConflict = function () {
    return a.fn.dropdown = g, this;
  }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
    a.stopPropagation();
  }).on("click.bs.dropdown.data-api", e, f.prototype.toggle).on("keydown.bs.dropdown.data-api", e + ", [role=menu], [role=listbox]", f.prototype.keydown);
}(jQuery), +function (a) {
  "use strict";
  var b = function b(_b2, c) {
    this.options = c, this.$element = a(_b2), this.$backdrop = this.isShown = null, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
      this.$element.trigger("loaded.bs.modal");
    }, this));
  };b.DEFAULTS = { backdrop: !0, keyboard: !0, show: !0 }, b.prototype.toggle = function (a) {
    return this[this.isShown ? "hide" : "show"](a);
  }, b.prototype.show = function (b) {
    var c = this,
        d = a.Event("show.bs.modal", { relatedTarget: b });this.$element.trigger(d), this.isShown || d.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.backdrop(function () {
      var d = a.support.transition && c.$element.hasClass("fade");c.$element.parent().length || c.$element.appendTo(document.body), c.$element.show().scrollTop(0), d && c.$element[0].offsetWidth, c.$element.addClass("in").attr("aria-hidden", !1), c.enforceFocus();var e = a.Event("shown.bs.modal", { relatedTarget: b });d ? c.$element.find(".modal-dialog").one(a.support.transition.end, function () {
        c.$element.focus().trigger(e);
      }).emulateTransitionEnd(300) : c.$element.focus().trigger(e);
    }));
  }, b.prototype.hide = function (b) {
    b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one(a.support.transition.end, a.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal());
  }, b.prototype.enforceFocus = function () {
    a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
      this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.focus();
    }, this));
  }, b.prototype.escape = function () {
    this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", a.proxy(function (a) {
      27 == a.which && this.hide();
    }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal");
  }, b.prototype.hideModal = function () {
    var a = this;this.$element.hide(), this.backdrop(function () {
      a.removeBackdrop(), a.$element.trigger("hidden.bs.modal");
    });
  }, b.prototype.removeBackdrop = function () {
    this.$backdrop && this.$backdrop.remove(), this.$backdrop = null;
  }, b.prototype.backdrop = function (b) {
    var c = this.$element.hasClass("fade") ? "fade" : "";if (this.isShown && this.options.backdrop) {
      var d = a.support.transition && c;if (this.$backdrop = a('<div class="modal-backdrop ' + c + '" />').appendTo(document.body), this.$element.on("click.dismiss.bs.modal", a.proxy(function (a) {
        a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this));
      }, this)), d && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;d ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b();
    } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b()) : b && b();
  };var c = a.fn.modal;a.fn.modal = function (c, d) {
    return this.each(function () {
      var e = a(this),
          f = e.data("bs.modal"),
          g = a.extend({}, b.DEFAULTS, e.data(), "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c);f || e.data("bs.modal", f = new b(this, g)), "string" == typeof c ? f[c](d) : g.show && f.show(d);
    });
  }, a.fn.modal.Constructor = b, a.fn.modal.noConflict = function () {
    return a.fn.modal = c, this;
  }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (b) {
    var c = a(this),
        d = c.attr("href"),
        e = a(c.attr("data-target") || d && d.replace(/.*(?=#[^\s]+$)/, "")),
        f = e.data("bs.modal") ? "toggle" : a.extend({ remote: !/#/.test(d) && d }, e.data(), c.data());c.is("a") && b.preventDefault(), e.modal(f, this).one("hide", function () {
      c.is(":visible") && c.focus();
    });
  }), a(document).on("show.bs.modal", ".modal", function () {
    a(document.body).addClass("modal-open");
  }).on("hidden.bs.modal", ".modal", function () {
    a(document.body).removeClass("modal-open");
  });
}(jQuery), +function (a) {
  "use strict";
  var b = function b(a, _b3) {
    this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, _b3);
  };b.DEFAULTS = { animation: !0, placement: "top", selector: !1, template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>', trigger: "hover focus", title: "", delay: 0, html: !1, container: !1 }, b.prototype.init = function (b, c, d) {
    this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d);for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
      var g = e[f];if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));else if ("manual" != g) {
        var h = "hover" == g ? "mouseenter" : "focusin",
            i = "hover" == g ? "mouseleave" : "focusout";this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this));
      }
    }this.options.selector ? this._options = a.extend({}, this.options, { trigger: "manual", selector: "" }) : this.fixTitle();
  }, b.prototype.getDefaults = function () {
    return b.DEFAULTS;
  }, b.prototype.getOptions = function (b) {
    return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = { show: b.delay, hide: b.delay }), b;
  }, b.prototype.getDelegateOptions = function () {
    var b = {},
        c = this.getDefaults();return this._options && a.each(this._options, function (a, d) {
      c[a] != d && (b[a] = d);
    }), b;
  }, b.prototype.enter = function (b) {
    var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);return clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void (c.timeout = setTimeout(function () {
      "in" == c.hoverState && c.show();
    }, c.options.delay.show)) : c.show();
  }, b.prototype.leave = function (b) {
    var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);return clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void (c.timeout = setTimeout(function () {
      "out" == c.hoverState && c.hide();
    }, c.options.delay.hide)) : c.hide();
  }, b.prototype.show = function () {
    var b = a.Event("show.bs." + this.type);if (this.hasContent() && this.enabled) {
      if (this.$element.trigger(b), b.isDefaultPrevented()) return;var c = this,
          d = this.tip();this.setContent(), this.options.animation && d.addClass("fade");var e = "function" == typeof this.options.placement ? this.options.placement.call(this, d[0], this.$element[0]) : this.options.placement,
          f = /\s?auto?\s?/i,
          g = f.test(e);g && (e = e.replace(f, "") || "top"), d.detach().css({ top: 0, left: 0, display: "block" }).addClass(e), this.options.container ? d.appendTo(this.options.container) : d.insertAfter(this.$element);var h = this.getPosition(),
          i = d[0].offsetWidth,
          j = d[0].offsetHeight;if (g) {
        var k = this.$element.parent(),
            l = e,
            m = document.documentElement.scrollTop || document.body.scrollTop,
            n = "body" == this.options.container ? window.innerWidth : k.outerWidth(),
            o = "body" == this.options.container ? window.innerHeight : k.outerHeight(),
            p = "body" == this.options.container ? 0 : k.offset().left;e = "bottom" == e && h.top + h.height + j - m > o ? "top" : "top" == e && h.top - m - j < 0 ? "bottom" : "right" == e && h.right + i > n ? "left" : "left" == e && h.left - i < p ? "right" : e, d.removeClass(l).addClass(e);
      }var q = this.getCalculatedOffset(e, h, i, j);this.applyPlacement(q, e), this.hoverState = null;var r = function r() {
        c.$element.trigger("shown.bs." + c.type);
      };a.support.transition && this.$tip.hasClass("fade") ? d.one(a.support.transition.end, r).emulateTransitionEnd(150) : r();
    }
  }, b.prototype.applyPlacement = function (b, c) {
    var d,
        e = this.tip(),
        f = e[0].offsetWidth,
        g = e[0].offsetHeight,
        h = parseInt(e.css("margin-top"), 10),
        i = parseInt(e.css("margin-left"), 10);isNaN(h) && (h = 0), isNaN(i) && (i = 0), b.top = b.top + h, b.left = b.left + i, a.offset.setOffset(e[0], a.extend({ using: function using(a) {
        e.css({ top: Math.round(a.top), left: Math.round(a.left) });
      } }, b), 0), e.addClass("in");var j = e[0].offsetWidth,
        k = e[0].offsetHeight;if ("top" == c && k != g && (d = !0, b.top = b.top + g - k), /bottom|top/.test(c)) {
      var l = 0;b.left < 0 && (l = -2 * b.left, b.left = 0, e.offset(b), j = e[0].offsetWidth, k = e[0].offsetHeight), this.replaceArrow(l - f + j, j, "left");
    } else this.replaceArrow(k - g, k, "top");d && e.offset(b);
  }, b.prototype.replaceArrow = function (a, b, c) {
    this.arrow().css(c, a ? 50 * (1 - a / b) + "%" : "");
  }, b.prototype.setContent = function () {
    var a = this.tip(),
        b = this.getTitle();a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right");
  }, b.prototype.hide = function () {
    function b() {
      "in" != c.hoverState && d.detach(), c.$element.trigger("hidden.bs." + c.type);
    }var c = this,
        d = this.tip(),
        e = a.Event("hide.bs." + this.type);return this.$element.trigger(e), e.isDefaultPrevented() ? void 0 : (d.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? d.one(a.support.transition.end, b).emulateTransitionEnd(150) : b(), this.hoverState = null, this);
  }, b.prototype.fixTitle = function () {
    var a = this.$element;(a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "");
  }, b.prototype.hasContent = function () {
    return this.getTitle();
  }, b.prototype.getPosition = function () {
    var b = this.$element[0];return a.extend({}, "function" == typeof b.getBoundingClientRect ? b.getBoundingClientRect() : { width: b.offsetWidth, height: b.offsetHeight }, this.$element.offset());
  }, b.prototype.getCalculatedOffset = function (a, b, c, d) {
    return "bottom" == a ? { top: b.top + b.height, left: b.left + b.width / 2 - c / 2 } : "top" == a ? { top: b.top - d, left: b.left + b.width / 2 - c / 2 } : "left" == a ? { top: b.top + b.height / 2 - d / 2, left: b.left - c } : { top: b.top + b.height / 2 - d / 2, left: b.left + b.width };
  }, b.prototype.getTitle = function () {
    var a,
        b = this.$element,
        c = this.options;return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title);
  }, b.prototype.tip = function () {
    return this.$tip = this.$tip || a(this.options.template);
  }, b.prototype.arrow = function () {
    return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow");
  }, b.prototype.validate = function () {
    this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null);
  }, b.prototype.enable = function () {
    this.enabled = !0;
  }, b.prototype.disable = function () {
    this.enabled = !1;
  }, b.prototype.toggleEnabled = function () {
    this.enabled = !this.enabled;
  }, b.prototype.toggle = function (b) {
    var c = b ? a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;c.tip().hasClass("in") ? c.leave(c) : c.enter(c);
  }, b.prototype.destroy = function () {
    clearTimeout(this.timeout), this.hide().$element.off("." + this.type).removeData("bs." + this.type);
  };var c = a.fn.tooltip;a.fn.tooltip = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.tooltip"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;(e || "destroy" != c) && (e || d.data("bs.tooltip", e = new b(this, f)), "string" == typeof c && e[c]());
    });
  }, a.fn.tooltip.Constructor = b, a.fn.tooltip.noConflict = function () {
    return a.fn.tooltip = c, this;
  };
}(jQuery), +function (a) {
  "use strict";
  var b = function b(a, _b4) {
    this.init("popover", a, _b4);
  };if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");b.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, { placement: "right", trigger: "click", content: "", template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' }), b.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), b.prototype.constructor = b, b.prototype.getDefaults = function () {
    return b.DEFAULTS;
  }, b.prototype.setContent = function () {
    var a = this.tip(),
        b = this.getTitle(),
        c = this.getContent();a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content")[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide();
  }, b.prototype.hasContent = function () {
    return this.getTitle() || this.getContent();
  }, b.prototype.getContent = function () {
    var a = this.$element,
        b = this.options;return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content);
  }, b.prototype.arrow = function () {
    return this.$arrow = this.$arrow || this.tip().find(".arrow");
  }, b.prototype.tip = function () {
    return this.$tip || (this.$tip = a(this.options.template)), this.$tip;
  };var c = a.fn.popover;a.fn.popover = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.popover"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;(e || "destroy" != c) && (e || d.data("bs.popover", e = new b(this, f)), "string" == typeof c && e[c]());
    });
  }, a.fn.popover.Constructor = b, a.fn.popover.noConflict = function () {
    return a.fn.popover = c, this;
  };
}(jQuery), +function (a) {
  "use strict";
  function b(c, d) {
    var e,
        f = a.proxy(this.process, this);this.$element = a(a(c).is("body") ? window : c), this.$body = a("body"), this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", f), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || (e = a(c).attr("href")) && e.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a", this.offsets = a([]), this.targets = a([]), this.activeTarget = null, this.refresh(), this.process();
  }b.DEFAULTS = { offset: 10 }, b.prototype.refresh = function () {
    var b = this.$element[0] == window ? "offset" : "position";this.offsets = a([]), this.targets = a([]);{
      var c = this;this.$body.find(this.selector).map(function () {
        var d = a(this),
            e = d.data("target") || d.attr("href"),
            f = /^#./.test(e) && a(e);return f && f.length && f.is(":visible") && [[f[b]().top + (!a.isWindow(c.$scrollElement.get(0)) && c.$scrollElement.scrollTop()), e]] || null;
      }).sort(function (a, b) {
        return a[0] - b[0];
      }).each(function () {
        c.offsets.push(this[0]), c.targets.push(this[1]);
      });
    }
  }, b.prototype.process = function () {
    var a,
        b = this.$scrollElement.scrollTop() + this.options.offset,
        c = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
        d = c - this.$scrollElement.height(),
        e = this.offsets,
        f = this.targets,
        g = this.activeTarget;if (b >= d) return g != (a = f.last()[0]) && this.activate(a);if (g && b <= e[0]) return g != (a = f[0]) && this.activate(a);for (a = e.length; a--;) {
      g != f[a] && b >= e[a] && (!e[a + 1] || b <= e[a + 1]) && this.activate(f[a]);
    }
  }, b.prototype.activate = function (b) {
    this.activeTarget = b, a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
        d = a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy");
  };var c = a.fn.scrollspy;a.fn.scrollspy = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.scrollspy"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]();
    });
  }, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
    return a.fn.scrollspy = c, this;
  }, a(window).on("load", function () {
    a('[data-spy="scroll"]').each(function () {
      var b = a(this);b.scrollspy(b.data());
    });
  });
}(jQuery), +function (a) {
  "use strict";
  var b = function b(_b5) {
    this.element = a(_b5);
  };b.prototype.show = function () {
    var b = this.element,
        c = b.closest("ul:not(.dropdown-menu)"),
        d = b.data("target");if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
      var e = c.find(".active:last a")[0],
          f = a.Event("show.bs.tab", { relatedTarget: e });if (b.trigger(f), !f.isDefaultPrevented()) {
        var g = a(d);this.activate(b.parent("li"), c), this.activate(g, g.parent(), function () {
          b.trigger({ type: "shown.bs.tab", relatedTarget: e });
        });
      }
    }
  }, b.prototype.activate = function (b, c, d) {
    function e() {
      f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), b.addClass("active"), g ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active"), d && d();
    }var f = c.find("> .active"),
        g = d && a.support.transition && f.hasClass("fade");g ? f.one(a.support.transition.end, e).emulateTransitionEnd(150) : e(), f.removeClass("in");
  };var c = a.fn.tab;a.fn.tab = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.tab");e || d.data("bs.tab", e = new b(this)), "string" == typeof c && e[c]();
    });
  }, a.fn.tab.Constructor = b, a.fn.tab.noConflict = function () {
    return a.fn.tab = c, this;
  }, a(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function (b) {
    b.preventDefault(), a(this).tab("show");
  });
}(jQuery), +function (a) {
  "use strict";
  var b = function b(c, d) {
    this.options = a.extend({}, b.DEFAULTS, d), this.$window = a(window).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(c), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition();
  };b.RESET = "affix affix-top affix-bottom", b.DEFAULTS = { offset: 0 }, b.prototype.getPinnedOffset = function () {
    if (this.pinnedOffset) return this.pinnedOffset;this.$element.removeClass(b.RESET).addClass("affix");var a = this.$window.scrollTop(),
        c = this.$element.offset();return this.pinnedOffset = c.top - a;
  }, b.prototype.checkPositionWithEventLoop = function () {
    setTimeout(a.proxy(this.checkPosition, this), 1);
  }, b.prototype.checkPosition = function () {
    if (this.$element.is(":visible")) {
      var c = a(document).height(),
          d = this.$window.scrollTop(),
          e = this.$element.offset(),
          f = this.options.offset,
          g = f.top,
          h = f.bottom;"top" == this.affixed && (e.top += d), "object" != (typeof f === "undefined" ? "undefined" : _typeof(f)) && (h = g = f), "function" == typeof g && (g = f.top(this.$element)), "function" == typeof h && (h = f.bottom(this.$element));var i = null != this.unpin && d + this.unpin <= e.top ? !1 : null != h && e.top + this.$element.height() >= c - h ? "bottom" : null != g && g >= d ? "top" : !1;if (this.affixed !== i) {
        this.unpin && this.$element.css("top", "");var j = "affix" + (i ? "-" + i : ""),
            k = a.Event(j + ".bs.affix");this.$element.trigger(k), k.isDefaultPrevented() || (this.affixed = i, this.unpin = "bottom" == i ? this.getPinnedOffset() : null, this.$element.removeClass(b.RESET).addClass(j).trigger(a.Event(j.replace("affix", "affixed"))), "bottom" == i && this.$element.offset({ top: c - h - this.$element.height() }));
      }
    }
  };var c = a.fn.affix;a.fn.affix = function (c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.affix"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;e || d.data("bs.affix", e = new b(this, f)), "string" == typeof c && e[c]();
    });
  }, a.fn.affix.Constructor = b, a.fn.affix.noConflict = function () {
    return a.fn.affix = c, this;
  }, a(window).on("load", function () {
    a('[data-spy="affix"]').each(function () {
      var b = a(this),
          c = b.data();c.offset = c.offset || {}, c.offsetBottom && (c.offset.bottom = c.offsetBottom), c.offsetTop && (c.offset.top = c.offsetTop), b.affix(c);
    });
  });
}(jQuery);

/***/ }),

/***/ "./resources/assets/js/bxslider.js":
/***/ (function(module, exports) {

/**
 * bxSlider v4.2.12
 * Copyright 2013-2015 Steven Wanderski
 * Written while drinking Belgian ales and listening to jazz
 * Licensed under MIT (http://opensource.org/licenses/MIT)
 */
!function (t) {
  var e = { mode: "horizontal", slideSelector: "", infiniteLoop: !0, hideControlOnEnd: !1, speed: 500, easing: null, slideMargin: 0, startSlide: 0, randomStart: !1, captions: !1, ticker: !1, tickerHover: !1, adaptiveHeight: !1, adaptiveHeightSpeed: 500, video: !1, useCSS: !0, preloadImages: "visible", responsive: !0, slideZIndex: 50, wrapperClass: "bx-wrapper", touchEnabled: !0, swipeThreshold: 50, oneToOneTouch: !0, preventDefaultSwipeX: !0, preventDefaultSwipeY: !1, ariaLive: !0, ariaHidden: !0, keyboardEnabled: !1, pager: !0, pagerType: "full", pagerShortSeparator: " / ", pagerSelector: null, buildPager: null, pagerCustom: null, controls: !0, nextText: "Next", prevText: "Prev", nextSelector: null, prevSelector: null, autoControls: !1, startText: "Start", stopText: "Stop", autoControlsCombine: !1, autoControlsSelector: null, auto: !1, pause: 4e3, autoStart: !0, autoDirection: "next", stopAutoOnClick: !1, autoHover: !1, autoDelay: 0, autoSlideForOnePage: !1, minSlides: 1, maxSlides: 1, moveSlides: 0, slideWidth: 0, shrinkItems: !1, onSliderLoad: function onSliderLoad() {
      return !0;
    }, onSlideBefore: function onSlideBefore() {
      return !0;
    }, onSlideAfter: function onSlideAfter() {
      return !0;
    }, onSlideNext: function onSlideNext() {
      return !0;
    }, onSlidePrev: function onSlidePrev() {
      return !0;
    }, onSliderResize: function onSliderResize() {
      return !0;
    }, onAutoChange: function onAutoChange() {
      return !0;
    } };t.fn.bxSlider = function (n) {
    if (0 === this.length) return this;if (this.length > 1) return this.each(function () {
      t(this).bxSlider(n);
    }), this;var s = {},
        o = this,
        r = t(window).width(),
        a = t(window).height();if (!t(o).data("bxSlider")) {
      var l = function l() {
        t(o).data("bxSlider") || (s.settings = t.extend({}, e, n), s.settings.slideWidth = parseInt(s.settings.slideWidth), s.children = o.children(s.settings.slideSelector), s.children.length < s.settings.minSlides && (s.settings.minSlides = s.children.length), s.children.length < s.settings.maxSlides && (s.settings.maxSlides = s.children.length), s.settings.randomStart && (s.settings.startSlide = Math.floor(Math.random() * s.children.length)), s.active = { index: s.settings.startSlide }, s.carousel = s.settings.minSlides > 1 || s.settings.maxSlides > 1, s.carousel && (s.settings.preloadImages = "all"), s.minThreshold = s.settings.minSlides * s.settings.slideWidth + (s.settings.minSlides - 1) * s.settings.slideMargin, s.maxThreshold = s.settings.maxSlides * s.settings.slideWidth + (s.settings.maxSlides - 1) * s.settings.slideMargin, s.working = !1, s.controls = {}, s.interval = null, s.animProp = "vertical" === s.settings.mode ? "top" : "left", s.usingCSS = s.settings.useCSS && "fade" !== s.settings.mode && function () {
          for (var t = document.createElement("div"), e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"], i = 0; i < e.length; i++) {
            if (void 0 !== t.style[e[i]]) return s.cssPrefix = e[i].replace("Perspective", "").toLowerCase(), s.animProp = "-" + s.cssPrefix + "-transform", !0;
          }return !1;
        }(), "vertical" === s.settings.mode && (s.settings.maxSlides = s.settings.minSlides), o.data("origStyle", o.attr("style")), o.children(s.settings.slideSelector).each(function () {
          t(this).data("origStyle", t(this).attr("style"));
        }), d());
      },
          d = function d() {
        var e = s.children.eq(s.settings.startSlide);o.wrap('<div class="' + s.settings.wrapperClass + '"><div class="bx-viewport"></div></div>'), s.viewport = o.parent(), s.settings.ariaLive && !s.settings.ticker && s.viewport.attr("aria-live", "polite"), s.loader = t('<div class="bx-loading" />'), s.viewport.prepend(s.loader), o.css({ width: "horizontal" === s.settings.mode ? 1e3 * s.children.length + 215 + "%" : "auto", position: "relative" }), s.usingCSS && s.settings.easing ? o.css("-" + s.cssPrefix + "-transition-timing-function", s.settings.easing) : s.settings.easing || (s.settings.easing = "swing"), s.viewport.css({ width: "100%", overflow: "hidden", position: "relative" }), s.viewport.parent().css({ maxWidth: u() }), s.children.css({ float: "horizontal" === s.settings.mode ? "left" : "none", listStyle: "none", position: "relative" }), s.children.css("width", h()), "horizontal" === s.settings.mode && s.settings.slideMargin > 0 && s.children.css("marginRight", s.settings.slideMargin), "vertical" === s.settings.mode && s.settings.slideMargin > 0 && s.children.css("marginBottom", s.settings.slideMargin), "fade" === s.settings.mode && (s.children.css({ position: "absolute", zIndex: 0, display: "none" }), s.children.eq(s.settings.startSlide).css({ zIndex: s.settings.slideZIndex, display: "block" })), s.controls.el = t('<div class="bx-controls" />'), s.settings.captions && P(), s.active.last = s.settings.startSlide === f() - 1, s.settings.video && o.fitVids(), ("all" === s.settings.preloadImages || s.settings.ticker) && (e = s.children), s.settings.ticker ? s.settings.pager = !1 : (s.settings.controls && C(), s.settings.auto && s.settings.autoControls && T(), s.settings.pager && w(), (s.settings.controls || s.settings.autoControls || s.settings.pager) && s.viewport.after(s.controls.el)), c(e, g);
      },
          c = function c(e, i) {
        var n = e.find('img:not([src=""]), iframe').length,
            s = 0;if (0 === n) return void i();e.find('img:not([src=""]), iframe').each(function () {
          t(this).one("load error", function () {
            ++s === n && i();
          }).each(function () {
            (this.complete || "" == this.src) && t(this).trigger("load");
          });
        });
      },
          g = function g() {
        if (s.settings.infiniteLoop && "fade" !== s.settings.mode && !s.settings.ticker) {
          var e = "vertical" === s.settings.mode ? s.settings.minSlides : s.settings.maxSlides,
              i = s.children.slice(0, e).clone(!0).addClass("bx-clone"),
              n = s.children.slice(-e).clone(!0).addClass("bx-clone");s.settings.ariaHidden && (i.attr("aria-hidden", !0), n.attr("aria-hidden", !0)), o.append(i).prepend(n);
        }s.loader.remove(), m(), "vertical" === s.settings.mode && (s.settings.adaptiveHeight = !0), s.viewport.height(p()), o.redrawSlider(), s.settings.onSliderLoad.call(o, s.active.index), s.initialized = !0, s.settings.responsive && t(window).bind("resize", U), s.settings.auto && s.settings.autoStart && (f() > 1 || s.settings.autoSlideForOnePage) && L(), s.settings.ticker && O(), s.settings.pager && I(s.settings.startSlide), s.settings.controls && D(), s.settings.touchEnabled && !s.settings.ticker && Y(), s.settings.keyboardEnabled && !s.settings.ticker && t(document).keydown(X);
      },
          p = function p() {
        var e = 0,
            n = t();if ("vertical" === s.settings.mode || s.settings.adaptiveHeight) {
          if (s.carousel) {
            var o = 1 === s.settings.moveSlides ? s.active.index : s.active.index * x();for (n = s.children.eq(o), i = 1; i <= s.settings.maxSlides - 1; i++) {
              n = o + i >= s.children.length ? n.add(s.children.eq(i - 1)) : n.add(s.children.eq(o + i));
            }
          } else n = s.children.eq(s.active.index);
        } else n = s.children;return "vertical" === s.settings.mode ? (n.each(function (i) {
          e += t(this).outerHeight();
        }), s.settings.slideMargin > 0 && (e += s.settings.slideMargin * (s.settings.minSlides - 1))) : e = Math.max.apply(Math, n.map(function () {
          return t(this).outerHeight(!1);
        }).get()), "border-box" === s.viewport.css("box-sizing") ? e += parseFloat(s.viewport.css("padding-top")) + parseFloat(s.viewport.css("padding-bottom")) + parseFloat(s.viewport.css("border-top-width")) + parseFloat(s.viewport.css("border-bottom-width")) : "padding-box" === s.viewport.css("box-sizing") && (e += parseFloat(s.viewport.css("padding-top")) + parseFloat(s.viewport.css("padding-bottom"))), e;
      },
          u = function u() {
        var t = "100%";return s.settings.slideWidth > 0 && (t = "horizontal" === s.settings.mode ? s.settings.maxSlides * s.settings.slideWidth + (s.settings.maxSlides - 1) * s.settings.slideMargin : s.settings.slideWidth), t;
      },
          h = function h() {
        var t = s.settings.slideWidth,
            e = s.viewport.width();if (0 === s.settings.slideWidth || s.settings.slideWidth > e && !s.carousel || "vertical" === s.settings.mode) t = e;else if (s.settings.maxSlides > 1 && "horizontal" === s.settings.mode) {
          if (e > s.maxThreshold) return t;e < s.minThreshold ? t = (e - s.settings.slideMargin * (s.settings.minSlides - 1)) / s.settings.minSlides : s.settings.shrinkItems && (t = Math.floor((e + s.settings.slideMargin) / Math.ceil((e + s.settings.slideMargin) / (t + s.settings.slideMargin)) - s.settings.slideMargin));
        }return t;
      },
          v = function v() {
        var t = 1,
            e = null;return "horizontal" === s.settings.mode && s.settings.slideWidth > 0 ? s.viewport.width() < s.minThreshold ? t = s.settings.minSlides : s.viewport.width() > s.maxThreshold ? t = s.settings.maxSlides : (e = s.children.first().width() + s.settings.slideMargin, t = Math.floor((s.viewport.width() + s.settings.slideMargin) / e) || 1) : "vertical" === s.settings.mode && (t = s.settings.minSlides), t;
      },
          f = function f() {
        var t = 0,
            e = 0,
            i = 0;if (s.settings.moveSlides > 0) {
          if (!s.settings.infiniteLoop) {
            for (; e < s.children.length;) {
              ++t, e = i + v(), i += s.settings.moveSlides <= v() ? s.settings.moveSlides : v();
            }return i;
          }t = Math.ceil(s.children.length / x());
        } else t = Math.ceil(s.children.length / v());return t;
      },
          x = function x() {
        return s.settings.moveSlides > 0 && s.settings.moveSlides <= v() ? s.settings.moveSlides : v();
      },
          m = function m() {
        var t, e, i;s.children.length > s.settings.maxSlides && s.active.last && !s.settings.infiniteLoop ? "horizontal" === s.settings.mode ? (e = s.children.last(), t = e.position(), S(-(t.left - (s.viewport.width() - e.outerWidth())), "reset", 0)) : "vertical" === s.settings.mode && (i = s.children.length - s.settings.minSlides, t = s.children.eq(i).position(), S(-t.top, "reset", 0)) : (t = s.children.eq(s.active.index * x()).position(), s.active.index === f() - 1 && (s.active.last = !0), void 0 !== t && ("horizontal" === s.settings.mode ? S(-t.left, "reset", 0) : "vertical" === s.settings.mode && S(-t.top, "reset", 0)));
      },
          S = function S(e, i, n, r) {
        var a, l;s.usingCSS ? (l = "vertical" === s.settings.mode ? "translate3d(0, " + e + "px, 0)" : "translate3d(" + e + "px, 0, 0)", o.css("-" + s.cssPrefix + "-transition-duration", n / 1e3 + "s"), "slide" === i ? (o.css(s.animProp, l), 0 !== n ? o.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function (e) {
          t(e.target).is(o) && (o.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), A());
        }) : A()) : "reset" === i ? o.css(s.animProp, l) : "ticker" === i && (o.css("-" + s.cssPrefix + "-transition-timing-function", "linear"), o.css(s.animProp, l), 0 !== n ? o.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function (e) {
          t(e.target).is(o) && (o.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), S(r.resetValue, "reset", 0), F());
        }) : (S(r.resetValue, "reset", 0), F()))) : (a = {}, a[s.animProp] = e, "slide" === i ? o.animate(a, n, s.settings.easing, function () {
          A();
        }) : "reset" === i ? o.css(s.animProp, e) : "ticker" === i && o.animate(a, n, "linear", function () {
          S(r.resetValue, "reset", 0), F();
        }));
      },
          b = function b() {
        for (var e = "", i = "", n = f(), o = 0; o < n; o++) {
          i = "", s.settings.buildPager && t.isFunction(s.settings.buildPager) || s.settings.pagerCustom ? (i = s.settings.buildPager(o), s.pagerEl.addClass("bx-custom-pager")) : (i = o + 1, s.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + o + '" class="bx-pager-link">' + i + "</a></div>";
        }s.pagerEl.html(e);
      },
          w = function w() {
        s.settings.pagerCustom ? s.pagerEl = t(s.settings.pagerCustom) : (s.pagerEl = t('<div class="bx-pager" />'), s.settings.pagerSelector ? t(s.settings.pagerSelector).html(s.pagerEl) : s.controls.el.addClass("bx-has-pager").append(s.pagerEl), b()), s.pagerEl.on("click touchend", "a", z);
      },
          C = function C() {
        s.controls.next = t('<a class="bx-next" href="">' + s.settings.nextText + "</a>"), s.controls.prev = t('<a class="bx-prev" href="">' + s.settings.prevText + "</a>"), s.controls.next.bind("click touchend", k), s.controls.prev.bind("click touchend", E), s.settings.nextSelector && t(s.settings.nextSelector).append(s.controls.next), s.settings.prevSelector && t(s.settings.prevSelector).append(s.controls.prev), s.settings.nextSelector || s.settings.prevSelector || (s.controls.directionEl = t('<div class="bx-controls-direction" />'), s.controls.directionEl.append(s.controls.prev).append(s.controls.next), s.controls.el.addClass("bx-has-controls-direction").append(s.controls.directionEl));
      },
          T = function T() {
        s.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + s.settings.startText + "</a></div>"), s.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + s.settings.stopText + "</a></div>"), s.controls.autoEl = t('<div class="bx-controls-auto" />'), s.controls.autoEl.on("click", ".bx-start", M), s.controls.autoEl.on("click", ".bx-stop", y), s.settings.autoControlsCombine ? s.controls.autoEl.append(s.controls.start) : s.controls.autoEl.append(s.controls.start).append(s.controls.stop), s.settings.autoControlsSelector ? t(s.settings.autoControlsSelector).html(s.controls.autoEl) : s.controls.el.addClass("bx-has-controls-auto").append(s.controls.autoEl), q(s.settings.autoStart ? "stop" : "start");
      },
          P = function P() {
        s.children.each(function (e) {
          var i = t(this).find("img:first").attr("title");void 0 !== i && ("" + i).length && t(this).append('<div class="bx-caption"><span>' + i + "</span></div>");
        });
      },
          k = function k(t) {
        t.preventDefault(), s.controls.el.hasClass("disabled") || (s.settings.auto && s.settings.stopAutoOnClick && o.stopAuto(), o.goToNextSlide());
      },
          E = function E(t) {
        t.preventDefault(), s.controls.el.hasClass("disabled") || (s.settings.auto && s.settings.stopAutoOnClick && o.stopAuto(), o.goToPrevSlide());
      },
          M = function M(t) {
        o.startAuto(), t.preventDefault();
      },
          y = function y(t) {
        o.stopAuto(), t.preventDefault();
      },
          z = function z(e) {
        var i, n;e.preventDefault(), s.controls.el.hasClass("disabled") || (s.settings.auto && s.settings.stopAutoOnClick && o.stopAuto(), i = t(e.currentTarget), void 0 !== i.attr("data-slide-index") && (n = parseInt(i.attr("data-slide-index"))) !== s.active.index && o.goToSlide(n));
      },
          I = function I(e) {
        var i = s.children.length;if ("short" === s.settings.pagerType) return s.settings.maxSlides > 1 && (i = Math.ceil(s.children.length / s.settings.maxSlides)), void s.pagerEl.html(e + 1 + s.settings.pagerShortSeparator + i);s.pagerEl.find("a").removeClass("active"), s.pagerEl.each(function (i, n) {
          t(n).find("a").eq(e).addClass("active");
        });
      },
          A = function A() {
        if (s.settings.infiniteLoop) {
          var t = "";0 === s.active.index ? t = s.children.eq(0).position() : s.active.index === f() - 1 && s.carousel ? t = s.children.eq((f() - 1) * x()).position() : s.active.index === s.children.length - 1 && (t = s.children.eq(s.children.length - 1).position()), t && ("horizontal" === s.settings.mode ? S(-t.left, "reset", 0) : "vertical" === s.settings.mode && S(-t.top, "reset", 0));
        }s.working = !1, s.settings.onSlideAfter.call(o, s.children.eq(s.active.index), s.oldIndex, s.active.index);
      },
          q = function q(t) {
        s.settings.autoControlsCombine ? s.controls.autoEl.html(s.controls[t]) : (s.controls.autoEl.find("a").removeClass("active"), s.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"));
      },
          D = function D() {
        1 === f() ? (s.controls.prev.addClass("disabled"), s.controls.next.addClass("disabled")) : !s.settings.infiniteLoop && s.settings.hideControlOnEnd && (0 === s.active.index ? (s.controls.prev.addClass("disabled"), s.controls.next.removeClass("disabled")) : s.active.index === f() - 1 ? (s.controls.next.addClass("disabled"), s.controls.prev.removeClass("disabled")) : (s.controls.prev.removeClass("disabled"), s.controls.next.removeClass("disabled")));
      },
          H = function H() {
        o.startAuto();
      },
          W = function W() {
        o.stopAuto();
      },
          L = function L() {
        if (s.settings.autoDelay > 0) {
          setTimeout(o.startAuto, s.settings.autoDelay);
        } else o.startAuto(), t(window).focus(H).blur(W);s.settings.autoHover && o.hover(function () {
          s.interval && (o.stopAuto(!0), s.autoPaused = !0);
        }, function () {
          s.autoPaused && (o.startAuto(!0), s.autoPaused = null);
        });
      },
          O = function O() {
        var e,
            i,
            n,
            r,
            a,
            l,
            d,
            c,
            g = 0;"next" === s.settings.autoDirection ? o.append(s.children.clone().addClass("bx-clone")) : (o.prepend(s.children.clone().addClass("bx-clone")), e = s.children.first().position(), g = "horizontal" === s.settings.mode ? -e.left : -e.top), S(g, "reset", 0), s.settings.pager = !1, s.settings.controls = !1, s.settings.autoControls = !1, s.settings.tickerHover && (s.usingCSS ? (r = "horizontal" === s.settings.mode ? 4 : 5, s.viewport.hover(function () {
          i = o.css("-" + s.cssPrefix + "-transform"), n = parseFloat(i.split(",")[r]), S(n, "reset", 0);
        }, function () {
          c = 0, s.children.each(function (e) {
            c += "horizontal" === s.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0);
          }), a = s.settings.speed / c, l = "horizontal" === s.settings.mode ? "left" : "top", d = a * (c - Math.abs(parseInt(n))), F(d);
        })) : s.viewport.hover(function () {
          o.stop();
        }, function () {
          c = 0, s.children.each(function (e) {
            c += "horizontal" === s.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0);
          }), a = s.settings.speed / c, l = "horizontal" === s.settings.mode ? "left" : "top", d = a * (c - Math.abs(parseInt(o.css(l)))), F(d);
        })), F();
      },
          F = function F(t) {
        var e,
            i,
            n,
            r = t ? t : s.settings.speed,
            a = { left: 0, top: 0 },
            l = { left: 0, top: 0 };"next" === s.settings.autoDirection ? a = o.find(".bx-clone").first().position() : l = s.children.first().position(), e = "horizontal" === s.settings.mode ? -a.left : -a.top, i = "horizontal" === s.settings.mode ? -l.left : -l.top, n = { resetValue: i }, S(e, "ticker", r, n);
      },
          N = function N(e) {
        var i = t(window),
            n = { top: i.scrollTop(), left: i.scrollLeft() },
            s = e.offset();return n.right = n.left + i.width(), n.bottom = n.top + i.height(), s.right = s.left + e.outerWidth(), s.bottom = s.top + e.outerHeight(), !(n.right < s.left || n.left > s.right || n.bottom < s.top || n.top > s.bottom);
      },
          X = function X(t) {
        var e = document.activeElement.tagName.toLowerCase();if (null == new RegExp(e, ["i"]).exec("input|textarea") && N(o)) {
          if (39 === t.keyCode) return k(t), !1;if (37 === t.keyCode) return E(t), !1;
        }
      },
          Y = function Y() {
        s.touch = { start: { x: 0, y: 0 }, end: { x: 0, y: 0 } }, s.viewport.bind("touchstart MSPointerDown pointerdown", V), s.viewport.on("click", ".bxslider a", function (t) {
          s.viewport.hasClass("click-disabled") && (t.preventDefault(), s.viewport.removeClass("click-disabled"));
        });
      },
          V = function V(t) {
        if (s.controls.el.addClass("disabled"), s.working) t.preventDefault(), s.controls.el.removeClass("disabled");else {
          s.touch.originalPos = o.position();var e = t.originalEvent,
              i = void 0 !== e.changedTouches ? e.changedTouches : [e];s.touch.start.x = i[0].pageX, s.touch.start.y = i[0].pageY, s.viewport.get(0).setPointerCapture && (s.pointerId = e.pointerId, s.viewport.get(0).setPointerCapture(s.pointerId)), s.viewport.bind("touchmove MSPointerMove pointermove", Z), s.viewport.bind("touchend MSPointerUp pointerup", B), s.viewport.bind("MSPointerCancel pointercancel", R);
        }
      },
          R = function R(t) {
        S(s.touch.originalPos.left, "reset", 0), s.controls.el.removeClass("disabled"), s.viewport.unbind("MSPointerCancel pointercancel", R), s.viewport.unbind("touchmove MSPointerMove pointermove", Z), s.viewport.unbind("touchend MSPointerUp pointerup", B), s.viewport.get(0).releasePointerCapture && s.viewport.get(0).releasePointerCapture(s.pointerId);
      },
          Z = function Z(t) {
        var e = t.originalEvent,
            i = void 0 !== e.changedTouches ? e.changedTouches : [e],
            n = Math.abs(i[0].pageX - s.touch.start.x),
            o = Math.abs(i[0].pageY - s.touch.start.y),
            r = 0,
            a = 0;3 * n > o && s.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * o > n && s.settings.preventDefaultSwipeY && t.preventDefault(), "fade" !== s.settings.mode && s.settings.oneToOneTouch && ("horizontal" === s.settings.mode ? (a = i[0].pageX - s.touch.start.x, r = s.touch.originalPos.left + a) : (a = i[0].pageY - s.touch.start.y, r = s.touch.originalPos.top + a), S(r, "reset", 0));
      },
          B = function B(t) {
        s.viewport.unbind("touchmove MSPointerMove pointermove", Z), s.controls.el.removeClass("disabled");var e = t.originalEvent,
            i = void 0 !== e.changedTouches ? e.changedTouches : [e],
            n = 0,
            r = 0;s.touch.end.x = i[0].pageX, s.touch.end.y = i[0].pageY, "fade" === s.settings.mode ? (r = Math.abs(s.touch.start.x - s.touch.end.x)) >= s.settings.swipeThreshold && (s.touch.start.x > s.touch.end.x ? o.goToNextSlide() : o.goToPrevSlide(), o.stopAuto()) : ("horizontal" === s.settings.mode ? (r = s.touch.end.x - s.touch.start.x, n = s.touch.originalPos.left) : (r = s.touch.end.y - s.touch.start.y, n = s.touch.originalPos.top), !s.settings.infiniteLoop && (0 === s.active.index && r > 0 || s.active.last && r < 0) ? S(n, "reset", 200) : Math.abs(r) >= s.settings.swipeThreshold ? (r < 0 ? o.goToNextSlide() : o.goToPrevSlide(), o.stopAuto()) : S(n, "reset", 200)), s.viewport.unbind("touchend MSPointerUp pointerup", B), s.viewport.get(0).releasePointerCapture && s.viewport.get(0).releasePointerCapture(s.pointerId);
      },
          U = function U(e) {
        if (s.initialized) if (s.working) window.setTimeout(U, 10);else {
          var i = t(window).width(),
              n = t(window).height();r === i && a === n || (r = i, a = n, o.redrawSlider(), s.settings.onSliderResize.call(o, s.active.index));
        }
      },
          j = function j(t) {
        var e = v();s.settings.ariaHidden && !s.settings.ticker && (s.children.attr("aria-hidden", "true"), s.children.slice(t, t + e).attr("aria-hidden", "false"));
      },
          Q = function Q(t) {
        return t < 0 ? s.settings.infiniteLoop ? f() - 1 : s.active.index : t >= f() ? s.settings.infiniteLoop ? 0 : s.active.index : t;
      };return o.goToSlide = function (e, i) {
        var n,
            r,
            a,
            l,
            d = !0,
            c = 0,
            g = { left: 0, top: 0 },
            u = null;if (s.oldIndex = s.active.index, s.active.index = Q(e), !s.working && s.active.index !== s.oldIndex) {
          if (s.working = !0, void 0 !== (d = s.settings.onSlideBefore.call(o, s.children.eq(s.active.index), s.oldIndex, s.active.index)) && !d) return s.active.index = s.oldIndex, void (s.working = !1);"next" === i ? s.settings.onSlideNext.call(o, s.children.eq(s.active.index), s.oldIndex, s.active.index) || (d = !1) : "prev" === i && (s.settings.onSlidePrev.call(o, s.children.eq(s.active.index), s.oldIndex, s.active.index) || (d = !1)), s.active.last = s.active.index >= f() - 1, (s.settings.pager || s.settings.pagerCustom) && I(s.active.index), s.settings.controls && D(), "fade" === s.settings.mode ? (s.settings.adaptiveHeight && s.viewport.height() !== p() && s.viewport.animate({ height: p() }, s.settings.adaptiveHeightSpeed), s.children.filter(":visible").fadeOut(s.settings.speed).css({ zIndex: 0 }), s.children.eq(s.active.index).css("zIndex", s.settings.slideZIndex + 1).fadeIn(s.settings.speed, function () {
            t(this).css("zIndex", s.settings.slideZIndex), A();
          })) : (s.settings.adaptiveHeight && s.viewport.height() !== p() && s.viewport.animate({ height: p() }, s.settings.adaptiveHeightSpeed), !s.settings.infiniteLoop && s.carousel && s.active.last ? "horizontal" === s.settings.mode ? (u = s.children.eq(s.children.length - 1), g = u.position(), c = s.viewport.width() - u.outerWidth()) : (n = s.children.length - s.settings.minSlides, g = s.children.eq(n).position()) : s.carousel && s.active.last && "prev" === i ? (r = 1 === s.settings.moveSlides ? s.settings.maxSlides - x() : (f() - 1) * x() - (s.children.length - s.settings.maxSlides), u = o.children(".bx-clone").eq(r), g = u.position()) : "next" === i && 0 === s.active.index ? (g = o.find("> .bx-clone").eq(s.settings.maxSlides).position(), s.active.last = !1) : e >= 0 && (l = e * parseInt(x()), g = s.children.eq(l).position()), void 0 !== g && (a = "horizontal" === s.settings.mode ? -(g.left - c) : -g.top, S(a, "slide", s.settings.speed)), s.working = !1), s.settings.ariaHidden && j(s.active.index * x());
        }
      }, o.goToNextSlide = function () {
        if ((s.settings.infiniteLoop || !s.active.last) && 1 != s.working) {
          var t = parseInt(s.active.index) + 1;o.goToSlide(t, "next");
        }
      }, o.goToPrevSlide = function () {
        if ((s.settings.infiniteLoop || 0 !== s.active.index) && 1 != s.working) {
          var t = parseInt(s.active.index) - 1;o.goToSlide(t, "prev");
        }
      }, o.startAuto = function (t) {
        s.interval || (s.interval = setInterval(function () {
          "next" === s.settings.autoDirection ? o.goToNextSlide() : o.goToPrevSlide();
        }, s.settings.pause), s.settings.onAutoChange.call(o, !0), s.settings.autoControls && t !== !0 && q("stop"));
      }, o.stopAuto = function (t) {
        s.interval && (clearInterval(s.interval), s.interval = null, s.settings.onAutoChange.call(o, !1), s.settings.autoControls && t !== !0 && q("start"));
      }, o.getCurrentSlide = function () {
        return s.active.index;
      }, o.getCurrentSlideElement = function () {
        return s.children.eq(s.active.index);
      }, o.getSlideElement = function (t) {
        return s.children.eq(t);
      }, o.getSlideCount = function () {
        return s.children.length;
      }, o.isWorking = function () {
        return s.working;
      }, o.redrawSlider = function () {
        s.children.add(o.find(".bx-clone")).outerWidth(h()), s.viewport.css("height", p()), s.settings.ticker || m(), s.active.last && (s.active.index = f() - 1), s.active.index >= f() && (s.active.last = !0), s.settings.pager && !s.settings.pagerCustom && (b(), I(s.active.index)), s.settings.ariaHidden && j(s.active.index * x());
      }, o.destroySlider = function () {
        s.initialized && (s.initialized = !1, t(".bx-clone", this).remove(), s.children.each(function () {
          void 0 !== t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style");
        }), void 0 !== t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), s.controls.el && s.controls.el.remove(), s.controls.next && s.controls.next.remove(), s.controls.prev && s.controls.prev.remove(), s.pagerEl && s.settings.controls && !s.settings.pagerCustom && s.pagerEl.remove(), t(".bx-caption", this).remove(), s.controls.autoEl && s.controls.autoEl.remove(), clearInterval(s.interval), s.settings.responsive && t(window).unbind("resize", U), s.settings.keyboardEnabled && t(document).unbind("keydown", X), t(this).removeData("bxSlider"), t(window).off("blur", W).off("focus", H));
      }, o.reloadSlider = function (e) {
        void 0 !== e && (n = e), o.destroySlider(), l(), t(o).data("bxSlider", this);
      }, l(), t(o).data("bxSlider", this), this;
    }
  };
}(jQuery);

/***/ }),

/***/ "./resources/assets/js/common-scripts.js":
/***/ (function(module, exports) {

var Script = function () {

	//    tool tips

	$('.tooltips').tooltip();

	//    popovers

	$('.popovers').popover();

	//    bxslider

	// $('.bxslider').show();
	// $('.bxslider').bxSlider({
	//     minSlides: 4,
	//     maxSlides: 4,
	//     slideWidth: 276,
	//     slideMargin: 20
	// });
}();

(function () {

	$('<i id="back-to-top"></i>').appendTo($('body'));

	$(window).scroll(function () {

		if ($(this).scrollTop() != 0) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	$('#back-to-top').click(function () {
		$('body,html').animate({ scrollTop: 0 }, 600);
	});
})();

/***/ }),

/***/ "./resources/assets/js/hover-dropdown.js":
/***/ (function(module, exports) {

/*
 * Project: Twitter Bootstrap Hover Dropdown
 * Author: Cameron Spear
 * Contributors: Mattia Larentis
 *
 * Dependencies?: Twitter Bootstrap's Dropdown plugin
 *
 * A simple plugin to enable twitter bootstrap dropdowns to active on hover and provide a nice user experience.
 *
 * No license, do what you want. I'd love credit or a shoutout, though.
 *
 * http://cameronspear.com/blog/twitter-bootstrap-dropdown-on-hover-plugin/
 */
;(function ($, window, undefined) {
    // outside the scope of the jQuery plugin to
    // keep track of all dropdowns
    var $allDropdowns = $();

    // if instantlyCloseOthers is true, then it will instantly
    // shut other nav items when a new one is hovered over
    $.fn.dropdownHover = function (options) {

        // the element we really care about
        // is the dropdown-toggle's parent
        $allDropdowns = $allDropdowns.add(this.parent());

        return this.each(function () {
            var $this = $(this),
                $parent = $this.parent(),
                defaults = {
                delay: 500,
                instantlyCloseOthers: true
            },
                data = {
                delay: $(this).data('delay'),
                instantlyCloseOthers: $(this).data('close-others')
            },
                settings = $.extend(true, {}, defaults, options, data),
                timeout;

            $parent.hover(function (event) {
                // so a neighbor can't open the dropdown
                if (!$parent.hasClass('open') && !$this.is(event.target)) {
                    return true;
                }

                if (shouldHover) {
                    if (settings.instantlyCloseOthers === true) $allDropdowns.removeClass('open');

                    window.clearTimeout(timeout);
                    $parent.addClass('open');
                }
            }, function () {
                if (shouldHover) {
                    timeout = window.setTimeout(function () {
                        $parent.removeClass('open');
                    }, settings.delay);
                }
            });

            // this helps with button groups!
            $this.hover(function () {
                if (shouldHover) {
                    if (settings.instantlyCloseOthers === true) $allDropdowns.removeClass('open');

                    window.clearTimeout(timeout);
                    $parent.addClass('open');
                }
            });

            // handle submenus
            $parent.find('.dropdown-submenu').each(function () {
                var $this = $(this);
                var subTimeout;
                $this.hover(function () {
                    if (shouldHover) {
                        window.clearTimeout(subTimeout);
                        $this.children('.dropdown-menu').show();
                        // always close submenu siblings instantly
                        $this.siblings().children('.dropdown-menu').hide();
                    }
                }, function () {
                    var $submenu = $this.children('.dropdown-menu');
                    if (shouldHover) {
                        subTimeout = window.setTimeout(function () {
                            $submenu.hide();
                        }, settings.delay);
                    } else {
                        // emulate Twitter Bootstrap's default behavior
                        $submenu.hide();
                    }
                });
            });
        });
    };

    // helper variables to guess if they are using a mouse
    var shouldHover = false,
        mouse_info = {
        hits: 0,
        x: null,
        y: null
    };
    $(document).ready(function () {
        // apply dropdownHover to all elements with the data-hover="dropdown" attribute
        $('[data-hover="dropdown"]').dropdownHover();

        // if the mouse movements are "smooth" or there are more than 20, they probably have a real mouse
        $(document).mousemove(function (e) {
            mouse_info.hits++;
            if (mouse_info.hits > 20 || Math.abs(e.pageX - mouse_info.x) + Math.abs(e.pageY - mouse_info.y) < 4) {
                $(this).unbind(e);
                shouldHover = true;
            } else {
                mouse_info.x = e.pageX;
                mouse_info.y = e.pageY;
            }
        });
    });

    // for the submenu to close on delay, we need to override Bootstrap's CSS in this case
    var css = '.dropdown-submenu:hover>.dropdown-menu{display:none}';
    var style = document.createElement('style');
    style.type = 'text/css';
    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }
    $('head')[0].appendChild(style);
})(jQuery, this);

/***/ }),

/***/ "./resources/assets/js/jquery-1.8.3.min.js":
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*! jQuery v1.8.3 jquery.com | jquery.org/license */
(function (e, t) {
  function _(e) {
    var t = M[e] = {};return v.each(e.split(y), function (e, n) {
      t[n] = !0;
    }), t;
  }function H(e, n, r) {
    if (r === t && e.nodeType === 1) {
      var i = "data-" + n.replace(P, "-$1").toLowerCase();r = e.getAttribute(i);if (typeof r == "string") {
        try {
          r = r === "true" ? !0 : r === "false" ? !1 : r === "null" ? null : +r + "" === r ? +r : D.test(r) ? v.parseJSON(r) : r;
        } catch (s) {}v.data(e, n, r);
      } else r = t;
    }return r;
  }function B(e) {
    var t;for (t in e) {
      if (t === "data" && v.isEmptyObject(e[t])) continue;if (t !== "toJSON") return !1;
    }return !0;
  }function et() {
    return !1;
  }function tt() {
    return !0;
  }function ut(e) {
    return !e || !e.parentNode || e.parentNode.nodeType === 11;
  }function at(e, t) {
    do {
      e = e[t];
    } while (e && e.nodeType !== 1);return e;
  }function ft(e, t, n) {
    t = t || 0;if (v.isFunction(t)) return v.grep(e, function (e, r) {
      var i = !!t.call(e, r, e);return i === n;
    });if (t.nodeType) return v.grep(e, function (e, r) {
      return e === t === n;
    });if (typeof t == "string") {
      var r = v.grep(e, function (e) {
        return e.nodeType === 1;
      });if (it.test(t)) return v.filter(t, r, !n);t = v.filter(t, r);
    }return v.grep(e, function (e, r) {
      return v.inArray(e, t) >= 0 === n;
    });
  }function lt(e) {
    var t = ct.split("|"),
        n = e.createDocumentFragment();if (n.createElement) while (t.length) {
      n.createElement(t.pop());
    }return n;
  }function Lt(e, t) {
    return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t));
  }function At(e, t) {
    if (t.nodeType !== 1 || !v.hasData(e)) return;var n,
        r,
        i,
        s = v._data(e),
        o = v._data(t, s),
        u = s.events;if (u) {
      delete o.handle, o.events = {};for (n in u) {
        for (r = 0, i = u[n].length; r < i; r++) {
          v.event.add(t, n, u[n][r]);
        }
      }
    }o.data && (o.data = v.extend({}, o.data));
  }function Ot(e, t) {
    var n;if (t.nodeType !== 1) return;t.clearAttributes && t.clearAttributes(), t.mergeAttributes && t.mergeAttributes(e), n = t.nodeName.toLowerCase(), n === "object" ? (t.parentNode && (t.outerHTML = e.outerHTML), v.support.html5Clone && e.innerHTML && !v.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : n === "input" && Et.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : n === "option" ? t.selected = e.defaultSelected : n === "input" || n === "textarea" ? t.defaultValue = e.defaultValue : n === "script" && t.text !== e.text && (t.text = e.text), t.removeAttribute(v.expando);
  }function Mt(e) {
    return typeof e.getElementsByTagName != "undefined" ? e.getElementsByTagName("*") : typeof e.querySelectorAll != "undefined" ? e.querySelectorAll("*") : [];
  }function _t(e) {
    Et.test(e.type) && (e.defaultChecked = e.checked);
  }function Qt(e, t) {
    if (t in e) return t;var n = t.charAt(0).toUpperCase() + t.slice(1),
        r = t,
        i = Jt.length;while (i--) {
      t = Jt[i] + n;if (t in e) return t;
    }return r;
  }function Gt(e, t) {
    return e = t || e, v.css(e, "display") === "none" || !v.contains(e.ownerDocument, e);
  }function Yt(e, t) {
    var n,
        r,
        i = [],
        s = 0,
        o = e.length;for (; s < o; s++) {
      n = e[s];if (!n.style) continue;i[s] = v._data(n, "olddisplay"), t ? (!i[s] && n.style.display === "none" && (n.style.display = ""), n.style.display === "" && Gt(n) && (i[s] = v._data(n, "olddisplay", nn(n.nodeName)))) : (r = Dt(n, "display"), !i[s] && r !== "none" && v._data(n, "olddisplay", r));
    }for (s = 0; s < o; s++) {
      n = e[s];if (!n.style) continue;if (!t || n.style.display === "none" || n.style.display === "") n.style.display = t ? i[s] || "" : "none";
    }return e;
  }function Zt(e, t, n) {
    var r = Rt.exec(t);return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t;
  }function en(e, t, n, r) {
    var i = n === (r ? "border" : "content") ? 4 : t === "width" ? 1 : 0,
        s = 0;for (; i < 4; i += 2) {
      n === "margin" && (s += v.css(e, n + $t[i], !0)), r ? (n === "content" && (s -= parseFloat(Dt(e, "padding" + $t[i])) || 0), n !== "margin" && (s -= parseFloat(Dt(e, "border" + $t[i] + "Width")) || 0)) : (s += parseFloat(Dt(e, "padding" + $t[i])) || 0, n !== "padding" && (s += parseFloat(Dt(e, "border" + $t[i] + "Width")) || 0));
    }return s;
  }function tn(e, t, n) {
    var r = t === "width" ? e.offsetWidth : e.offsetHeight,
        i = !0,
        s = v.support.boxSizing && v.css(e, "boxSizing") === "border-box";if (r <= 0 || r == null) {
      r = Dt(e, t);if (r < 0 || r == null) r = e.style[t];if (Ut.test(r)) return r;i = s && (v.support.boxSizingReliable || r === e.style[t]), r = parseFloat(r) || 0;
    }return r + en(e, t, n || (s ? "border" : "content"), i) + "px";
  }function nn(e) {
    if (Wt[e]) return Wt[e];var t = v("<" + e + ">").appendTo(i.body),
        n = t.css("display");t.remove();if (n === "none" || n === "") {
      Pt = i.body.appendChild(Pt || v.extend(i.createElement("iframe"), { frameBorder: 0, width: 0, height: 0 }));if (!Ht || !Pt.createElement) Ht = (Pt.contentWindow || Pt.contentDocument).document, Ht.write("<!doctype html><html><body>"), Ht.close();t = Ht.body.appendChild(Ht.createElement(e)), n = Dt(t, "display"), i.body.removeChild(Pt);
    }return Wt[e] = n, n;
  }function fn(e, t, n, r) {
    var i;if (v.isArray(t)) v.each(t, function (t, i) {
      n || sn.test(e) ? r(e, i) : fn(e + "[" + ((typeof i === "undefined" ? "undefined" : _typeof(i)) == "object" ? t : "") + "]", i, n, r);
    });else if (!n && v.type(t) === "object") for (i in t) {
      fn(e + "[" + i + "]", t[i], n, r);
    } else r(e, t);
  }function Cn(e) {
    return function (t, n) {
      typeof t != "string" && (n = t, t = "*");var r,
          i,
          s,
          o = t.toLowerCase().split(y),
          u = 0,
          a = o.length;if (v.isFunction(n)) for (; u < a; u++) {
        r = o[u], s = /^\+/.test(r), s && (r = r.substr(1) || "*"), i = e[r] = e[r] || [], i[s ? "unshift" : "push"](n);
      }
    };
  }function kn(e, n, r, i, s, o) {
    s = s || n.dataTypes[0], o = o || {}, o[s] = !0;var u,
        a = e[s],
        f = 0,
        l = a ? a.length : 0,
        c = e === Sn;for (; f < l && (c || !u); f++) {
      u = a[f](n, r, i), typeof u == "string" && (!c || o[u] ? u = t : (n.dataTypes.unshift(u), u = kn(e, n, r, i, u, o)));
    }return (c || !u) && !o["*"] && (u = kn(e, n, r, i, "*", o)), u;
  }function Ln(e, n) {
    var r,
        i,
        s = v.ajaxSettings.flatOptions || {};for (r in n) {
      n[r] !== t && ((s[r] ? e : i || (i = {}))[r] = n[r]);
    }i && v.extend(!0, e, i);
  }function An(e, n, r) {
    var i,
        s,
        o,
        u,
        a = e.contents,
        f = e.dataTypes,
        l = e.responseFields;for (s in l) {
      s in r && (n[l[s]] = r[s]);
    }while (f[0] === "*") {
      f.shift(), i === t && (i = e.mimeType || n.getResponseHeader("content-type"));
    }if (i) for (s in a) {
      if (a[s] && a[s].test(i)) {
        f.unshift(s);break;
      }
    }if (f[0] in r) o = f[0];else {
      for (s in r) {
        if (!f[0] || e.converters[s + " " + f[0]]) {
          o = s;break;
        }u || (u = s);
      }o = o || u;
    }if (o) return o !== f[0] && f.unshift(o), r[o];
  }function On(e, t) {
    var n,
        r,
        i,
        s,
        o = e.dataTypes.slice(),
        u = o[0],
        a = {},
        f = 0;e.dataFilter && (t = e.dataFilter(t, e.dataType));if (o[1]) for (n in e.converters) {
      a[n.toLowerCase()] = e.converters[n];
    }for (; i = o[++f];) {
      if (i !== "*") {
        if (u !== "*" && u !== i) {
          n = a[u + " " + i] || a["* " + i];if (!n) for (r in a) {
            s = r.split(" ");if (s[1] === i) {
              n = a[u + " " + s[0]] || a["* " + s[0]];if (n) {
                n === !0 ? n = a[r] : a[r] !== !0 && (i = s[0], o.splice(f--, 0, i));break;
              }
            }
          }if (n !== !0) if (n && e["throws"]) t = n(t);else try {
            t = n(t);
          } catch (l) {
            return { state: "parsererror", error: n ? l : "No conversion from " + u + " to " + i };
          }
        }u = i;
      }
    }return { state: "success", data: t };
  }function Fn() {
    try {
      return new e.XMLHttpRequest();
    } catch (t) {}
  }function In() {
    try {
      return new e.ActiveXObject("Microsoft.XMLHTTP");
    } catch (t) {}
  }function $n() {
    return setTimeout(function () {
      qn = t;
    }, 0), qn = v.now();
  }function Jn(e, t) {
    v.each(t, function (t, n) {
      var r = (Vn[t] || []).concat(Vn["*"]),
          i = 0,
          s = r.length;for (; i < s; i++) {
        if (r[i].call(e, t, n)) return;
      }
    });
  }function Kn(e, t, n) {
    var r,
        i = 0,
        s = 0,
        o = Xn.length,
        u = v.Deferred().always(function () {
      delete a.elem;
    }),
        a = function a() {
      var t = qn || $n(),
          n = Math.max(0, f.startTime + f.duration - t),
          r = n / f.duration || 0,
          i = 1 - r,
          s = 0,
          o = f.tweens.length;for (; s < o; s++) {
        f.tweens[s].run(i);
      }return u.notifyWith(e, [f, i, n]), i < 1 && o ? n : (u.resolveWith(e, [f]), !1);
    },
        f = u.promise({ elem: e, props: v.extend({}, t), opts: v.extend(!0, { specialEasing: {} }, n), originalProperties: t, originalOptions: n, startTime: qn || $n(), duration: n.duration, tweens: [], createTween: function createTween(t, n, r) {
        var i = v.Tween(e, f.opts, t, n, f.opts.specialEasing[t] || f.opts.easing);return f.tweens.push(i), i;
      }, stop: function stop(t) {
        var n = 0,
            r = t ? f.tweens.length : 0;for (; n < r; n++) {
          f.tweens[n].run(1);
        }return t ? u.resolveWith(e, [f, t]) : u.rejectWith(e, [f, t]), this;
      } }),
        l = f.props;Qn(l, f.opts.specialEasing);for (; i < o; i++) {
      r = Xn[i].call(f, e, l, f.opts);if (r) return r;
    }return Jn(f, l), v.isFunction(f.opts.start) && f.opts.start.call(e, f), v.fx.timer(v.extend(a, { anim: f, queue: f.opts.queue, elem: e })), f.progress(f.opts.progress).done(f.opts.done, f.opts.complete).fail(f.opts.fail).always(f.opts.always);
  }function Qn(e, t) {
    var n, r, i, s, o;for (n in e) {
      r = v.camelCase(n), i = t[r], s = e[n], v.isArray(s) && (i = s[1], s = e[n] = s[0]), n !== r && (e[r] = s, delete e[n]), o = v.cssHooks[r];if (o && "expand" in o) {
        s = o.expand(s), delete e[r];for (n in s) {
          n in e || (e[n] = s[n], t[n] = i);
        }
      } else t[r] = i;
    }
  }function Gn(e, t, n) {
    var r,
        i,
        s,
        o,
        u,
        a,
        f,
        l,
        c,
        h = this,
        p = e.style,
        d = {},
        m = [],
        g = e.nodeType && Gt(e);n.queue || (l = v._queueHooks(e, "fx"), l.unqueued == null && (l.unqueued = 0, c = l.empty.fire, l.empty.fire = function () {
      l.unqueued || c();
    }), l.unqueued++, h.always(function () {
      h.always(function () {
        l.unqueued--, v.queue(e, "fx").length || l.empty.fire();
      });
    })), e.nodeType === 1 && ("height" in t || "width" in t) && (n.overflow = [p.overflow, p.overflowX, p.overflowY], v.css(e, "display") === "inline" && v.css(e, "float") === "none" && (!v.support.inlineBlockNeedsLayout || nn(e.nodeName) === "inline" ? p.display = "inline-block" : p.zoom = 1)), n.overflow && (p.overflow = "hidden", v.support.shrinkWrapBlocks || h.done(function () {
      p.overflow = n.overflow[0], p.overflowX = n.overflow[1], p.overflowY = n.overflow[2];
    }));for (r in t) {
      s = t[r];if (Un.exec(s)) {
        delete t[r], a = a || s === "toggle";if (s === (g ? "hide" : "show")) continue;m.push(r);
      }
    }o = m.length;if (o) {
      u = v._data(e, "fxshow") || v._data(e, "fxshow", {}), "hidden" in u && (g = u.hidden), a && (u.hidden = !g), g ? v(e).show() : h.done(function () {
        v(e).hide();
      }), h.done(function () {
        var t;v.removeData(e, "fxshow", !0);for (t in d) {
          v.style(e, t, d[t]);
        }
      });for (r = 0; r < o; r++) {
        i = m[r], f = h.createTween(i, g ? u[i] : 0), d[i] = u[i] || v.style(e, i), i in u || (u[i] = f.start, g && (f.end = f.start, f.start = i === "width" || i === "height" ? 1 : 0));
      }
    }
  }function Yn(e, t, n, r, i) {
    return new Yn.prototype.init(e, t, n, r, i);
  }function Zn(e, t) {
    var n,
        r = { height: e },
        i = 0;t = t ? 1 : 0;for (; i < 4; i += 2 - t) {
      n = $t[i], r["margin" + n] = r["padding" + n] = e;
    }return t && (r.opacity = r.width = e), r;
  }function tr(e) {
    return v.isWindow(e) ? e : e.nodeType === 9 ? e.defaultView || e.parentWindow : !1;
  }var n,
      r,
      i = e.document,
      s = e.location,
      o = e.navigator,
      u = e.jQuery,
      a = e.$,
      f = Array.prototype.push,
      l = Array.prototype.slice,
      c = Array.prototype.indexOf,
      h = Object.prototype.toString,
      p = Object.prototype.hasOwnProperty,
      d = String.prototype.trim,
      v = function v(e, t) {
    return new v.fn.init(e, t, n);
  },
      m = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,
      g = /\S/,
      y = /\s+/,
      b = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
      w = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,
      E = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
      S = /^[\],:{}\s]*$/,
      x = /(?:^|:|,)(?:\s*\[)+/g,
      T = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
      N = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,
      C = /^-ms-/,
      k = /-([\da-z])/gi,
      L = function L(e, t) {
    return (t + "").toUpperCase();
  },
      A = function A() {
    i.addEventListener ? (i.removeEventListener("DOMContentLoaded", A, !1), v.ready()) : i.readyState === "complete" && (i.detachEvent("onreadystatechange", A), v.ready());
  },
      O = {};v.fn = v.prototype = { constructor: v, init: function init(e, n, r) {
      var s, o, u, a;if (!e) return this;if (e.nodeType) return this.context = this[0] = e, this.length = 1, this;if (typeof e == "string") {
        e.charAt(0) === "<" && e.charAt(e.length - 1) === ">" && e.length >= 3 ? s = [null, e, null] : s = w.exec(e);if (s && (s[1] || !n)) {
          if (s[1]) return n = n instanceof v ? n[0] : n, a = n && n.nodeType ? n.ownerDocument || n : i, e = v.parseHTML(s[1], a, !0), E.test(s[1]) && v.isPlainObject(n) && this.attr.call(e, n, !0), v.merge(this, e);o = i.getElementById(s[2]);if (o && o.parentNode) {
            if (o.id !== s[2]) return r.find(e);this.length = 1, this[0] = o;
          }return this.context = i, this.selector = e, this;
        }return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e);
      }return v.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), v.makeArray(e, this));
    }, selector: "", jquery: "1.8.3", length: 0, size: function size() {
      return this.length;
    }, toArray: function toArray() {
      return l.call(this);
    }, get: function get(e) {
      return e == null ? this.toArray() : e < 0 ? this[this.length + e] : this[e];
    }, pushStack: function pushStack(e, t, n) {
      var r = v.merge(this.constructor(), e);return r.prevObject = this, r.context = this.context, t === "find" ? r.selector = this.selector + (this.selector ? " " : "") + n : t && (r.selector = this.selector + "." + t + "(" + n + ")"), r;
    }, each: function each(e, t) {
      return v.each(this, e, t);
    }, ready: function ready(e) {
      return v.ready.promise().done(e), this;
    }, eq: function eq(e) {
      return e = +e, e === -1 ? this.slice(e) : this.slice(e, e + 1);
    }, first: function first() {
      return this.eq(0);
    }, last: function last() {
      return this.eq(-1);
    }, slice: function slice() {
      return this.pushStack(l.apply(this, arguments), "slice", l.call(arguments).join(","));
    }, map: function map(e) {
      return this.pushStack(v.map(this, function (t, n) {
        return e.call(t, n, t);
      }));
    }, end: function end() {
      return this.prevObject || this.constructor(null);
    }, push: f, sort: [].sort, splice: [].splice }, v.fn.init.prototype = v.fn, v.extend = v.fn.extend = function () {
    var e,
        n,
        r,
        i,
        s,
        o,
        u = arguments[0] || {},
        a = 1,
        f = arguments.length,
        l = !1;typeof u == "boolean" && (l = u, u = arguments[1] || {}, a = 2), (typeof u === "undefined" ? "undefined" : _typeof(u)) != "object" && !v.isFunction(u) && (u = {}), f === a && (u = this, --a);for (; a < f; a++) {
      if ((e = arguments[a]) != null) for (n in e) {
        r = u[n], i = e[n];if (u === i) continue;l && i && (v.isPlainObject(i) || (s = v.isArray(i))) ? (s ? (s = !1, o = r && v.isArray(r) ? r : []) : o = r && v.isPlainObject(r) ? r : {}, u[n] = v.extend(l, o, i)) : i !== t && (u[n] = i);
      }
    }return u;
  }, v.extend({ noConflict: function noConflict(t) {
      return e.$ === v && (e.$ = a), t && e.jQuery === v && (e.jQuery = u), v;
    }, isReady: !1, readyWait: 1, holdReady: function holdReady(e) {
      e ? v.readyWait++ : v.ready(!0);
    }, ready: function ready(e) {
      if (e === !0 ? --v.readyWait : v.isReady) return;if (!i.body) return setTimeout(v.ready, 1);v.isReady = !0;if (e !== !0 && --v.readyWait > 0) return;r.resolveWith(i, [v]), v.fn.trigger && v(i).trigger("ready").off("ready");
    }, isFunction: function isFunction(e) {
      return v.type(e) === "function";
    }, isArray: Array.isArray || function (e) {
      return v.type(e) === "array";
    }, isWindow: function isWindow(e) {
      return e != null && e == e.window;
    }, isNumeric: function isNumeric(e) {
      return !isNaN(parseFloat(e)) && isFinite(e);
    }, type: function type(e) {
      return e == null ? String(e) : O[h.call(e)] || "object";
    }, isPlainObject: function isPlainObject(e) {
      if (!e || v.type(e) !== "object" || e.nodeType || v.isWindow(e)) return !1;try {
        if (e.constructor && !p.call(e, "constructor") && !p.call(e.constructor.prototype, "isPrototypeOf")) return !1;
      } catch (n) {
        return !1;
      }var r;for (r in e) {}return r === t || p.call(e, r);
    }, isEmptyObject: function isEmptyObject(e) {
      var t;for (t in e) {
        return !1;
      }return !0;
    }, error: function error(e) {
      throw new Error(e);
    }, parseHTML: function parseHTML(e, t, n) {
      var r;return !e || typeof e != "string" ? null : (typeof t == "boolean" && (n = t, t = 0), t = t || i, (r = E.exec(e)) ? [t.createElement(r[1])] : (r = v.buildFragment([e], t, n ? null : []), v.merge([], (r.cacheable ? v.clone(r.fragment) : r.fragment).childNodes)));
    }, parseJSON: function parseJSON(t) {
      if (!t || typeof t != "string") return null;t = v.trim(t);if (e.JSON && e.JSON.parse) return e.JSON.parse(t);if (S.test(t.replace(T, "@").replace(N, "]").replace(x, ""))) return new Function("return " + t)();v.error("Invalid JSON: " + t);
    }, parseXML: function parseXML(n) {
      var r, i;if (!n || typeof n != "string") return null;try {
        e.DOMParser ? (i = new DOMParser(), r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n));
      } catch (s) {
        r = t;
      }return (!r || !r.documentElement || r.getElementsByTagName("parsererror").length) && v.error("Invalid XML: " + n), r;
    }, noop: function noop() {}, globalEval: function globalEval(t) {
      t && g.test(t) && (e.execScript || function (t) {
        e.eval.call(e, t);
      })(t);
    }, camelCase: function camelCase(e) {
      return e.replace(C, "ms-").replace(k, L);
    }, nodeName: function nodeName(e, t) {
      return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
    }, each: function each(e, n, r) {
      var i,
          s = 0,
          o = e.length,
          u = o === t || v.isFunction(e);if (r) {
        if (u) {
          for (i in e) {
            if (n.apply(e[i], r) === !1) break;
          }
        } else for (; s < o;) {
          if (n.apply(e[s++], r) === !1) break;
        }
      } else if (u) {
        for (i in e) {
          if (n.call(e[i], i, e[i]) === !1) break;
        }
      } else for (; s < o;) {
        if (n.call(e[s], s, e[s++]) === !1) break;
      }return e;
    }, trim: d && !d.call("\uFEFF\xA0") ? function (e) {
      return e == null ? "" : d.call(e);
    } : function (e) {
      return e == null ? "" : (e + "").replace(b, "");
    }, makeArray: function makeArray(e, t) {
      var n,
          r = t || [];return e != null && (n = v.type(e), e.length == null || n === "string" || n === "function" || n === "regexp" || v.isWindow(e) ? f.call(r, e) : v.merge(r, e)), r;
    }, inArray: function inArray(e, t, n) {
      var r;if (t) {
        if (c) return c.call(t, e, n);r = t.length, n = n ? n < 0 ? Math.max(0, r + n) : n : 0;for (; n < r; n++) {
          if (n in t && t[n] === e) return n;
        }
      }return -1;
    }, merge: function merge(e, n) {
      var r = n.length,
          i = e.length,
          s = 0;if (typeof r == "number") for (; s < r; s++) {
        e[i++] = n[s];
      } else while (n[s] !== t) {
        e[i++] = n[s++];
      }return e.length = i, e;
    }, grep: function grep(e, t, n) {
      var r,
          i = [],
          s = 0,
          o = e.length;n = !!n;for (; s < o; s++) {
        r = !!t(e[s], s), n !== r && i.push(e[s]);
      }return i;
    }, map: function map(e, n, r) {
      var i,
          s,
          o = [],
          u = 0,
          a = e.length,
          f = e instanceof v || a !== t && typeof a == "number" && (a > 0 && e[0] && e[a - 1] || a === 0 || v.isArray(e));if (f) for (; u < a; u++) {
        i = n(e[u], u, r), i != null && (o[o.length] = i);
      } else for (s in e) {
        i = n(e[s], s, r), i != null && (o[o.length] = i);
      }return o.concat.apply([], o);
    }, guid: 1, proxy: function proxy(e, n) {
      var r, i, s;return typeof n == "string" && (r = e[n], n = e, e = r), v.isFunction(e) ? (i = l.call(arguments, 2), s = function s() {
        return e.apply(n, i.concat(l.call(arguments)));
      }, s.guid = e.guid = e.guid || v.guid++, s) : t;
    }, access: function access(e, n, r, i, s, o, u) {
      var a,
          f = r == null,
          l = 0,
          c = e.length;if (r && (typeof r === "undefined" ? "undefined" : _typeof(r)) == "object") {
        for (l in r) {
          v.access(e, n, l, r[l], 1, o, i);
        }s = 1;
      } else if (i !== t) {
        a = u === t && v.isFunction(i), f && (a ? (a = n, n = function n(e, t, _n2) {
          return a.call(v(e), _n2);
        }) : (n.call(e, i), n = null));if (n) for (; l < c; l++) {
          n(e[l], r, a ? i.call(e[l], l, n(e[l], r)) : i, u);
        }s = 1;
      }return s ? e : f ? n.call(e) : c ? n(e[0], r) : o;
    }, now: function now() {
      return new Date().getTime();
    } }), v.ready.promise = function (t) {
    if (!r) {
      r = v.Deferred();if (i.readyState === "complete") setTimeout(v.ready, 1);else if (i.addEventListener) i.addEventListener("DOMContentLoaded", A, !1), e.addEventListener("load", v.ready, !1);else {
        i.attachEvent("onreadystatechange", A), e.attachEvent("onload", v.ready);var n = !1;try {
          n = e.frameElement == null && i.documentElement;
        } catch (s) {}n && n.doScroll && function o() {
          if (!v.isReady) {
            try {
              n.doScroll("left");
            } catch (e) {
              return setTimeout(o, 50);
            }v.ready();
          }
        }();
      }
    }return r.promise(t);
  }, v.each("Boolean Number String Function Array Date RegExp Object".split(" "), function (e, t) {
    O["[object " + t + "]"] = t.toLowerCase();
  }), n = v(i);var M = {};v.Callbacks = function (e) {
    e = typeof e == "string" ? M[e] || _(e) : v.extend({}, e);var n,
        r,
        i,
        s,
        o,
        u,
        a = [],
        f = !e.once && [],
        l = function l(t) {
      n = e.memory && t, r = !0, u = s || 0, s = 0, o = a.length, i = !0;for (; a && u < o; u++) {
        if (a[u].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
          n = !1;break;
        }
      }i = !1, a && (f ? f.length && l(f.shift()) : n ? a = [] : c.disable());
    },
        c = { add: function add() {
        if (a) {
          var t = a.length;(function r(t) {
            v.each(t, function (t, n) {
              var i = v.type(n);i === "function" ? (!e.Acme || !c.has(n)) && a.push(n) : n && n.length && i !== "string" && r(n);
            });
          })(arguments), i ? o = a.length : n && (s = t, l(n));
        }return this;
      }, remove: function remove() {
        return a && v.each(arguments, function (e, t) {
          var n;while ((n = v.inArray(t, a, n)) > -1) {
            a.splice(n, 1), i && (n <= o && o--, n <= u && u--);
          }
        }), this;
      }, has: function has(e) {
        return v.inArray(e, a) > -1;
      }, empty: function empty() {
        return a = [], this;
      }, disable: function disable() {
        return a = f = n = t, this;
      }, disabled: function disabled() {
        return !a;
      }, lock: function lock() {
        return f = t, n || c.disable(), this;
      }, locked: function locked() {
        return !f;
      }, fireWith: function fireWith(e, t) {
        return t = t || [], t = [e, t.slice ? t.slice() : t], a && (!r || f) && (i ? f.push(t) : l(t)), this;
      }, fire: function fire() {
        return c.fireWith(this, arguments), this;
      }, fired: function fired() {
        return !!r;
      } };return c;
  }, v.extend({ Deferred: function Deferred(e) {
      var t = [["resolve", "done", v.Callbacks("once memory"), "resolved"], ["reject", "fail", v.Callbacks("once memory"), "rejected"], ["notify", "progress", v.Callbacks("memory")]],
          n = "pending",
          r = { state: function state() {
          return n;
        }, always: function always() {
          return i.done(arguments).fail(arguments), this;
        }, then: function then() {
          var e = arguments;return v.Deferred(function (n) {
            v.each(t, function (t, r) {
              var s = r[0],
                  o = e[t];i[r[1]](v.isFunction(o) ? function () {
                var e = o.apply(this, arguments);e && v.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[s + "With"](this === i ? n : this, [e]);
              } : n[s]);
            }), e = null;
          }).promise();
        }, promise: function promise(e) {
          return e != null ? v.extend(e, r) : r;
        } },
          i = {};return r.pipe = r.then, v.each(t, function (e, s) {
        var o = s[2],
            u = s[3];r[s[1]] = o.add, u && o.add(function () {
          n = u;
        }, t[e ^ 1][2].disable, t[2][2].lock), i[s[0]] = o.fire, i[s[0] + "With"] = o.fireWith;
      }), r.promise(i), e && e.call(i, i), i;
    }, when: function when(e) {
      var t = 0,
          n = l.call(arguments),
          r = n.length,
          i = r !== 1 || e && v.isFunction(e.promise) ? r : 0,
          s = i === 1 ? e : v.Deferred(),
          o = function o(e, t, n) {
        return function (r) {
          t[e] = this, n[e] = arguments.length > 1 ? l.call(arguments) : r, n === u ? s.notifyWith(t, n) : --i || s.resolveWith(t, n);
        };
      },
          u,
          a,
          f;if (r > 1) {
        u = new Array(r), a = new Array(r), f = new Array(r);for (; t < r; t++) {
          n[t] && v.isFunction(n[t].promise) ? n[t].promise().done(o(t, f, n)).fail(s.reject).progress(o(t, a, u)) : --i;
        }
      }return i || s.resolveWith(f, n), s.promise();
    } }), v.support = function () {
    var t,
        n,
        r,
        s,
        o,
        u,
        a,
        f,
        l,
        c,
        h,
        p = i.createElement("div");p.setAttribute("className", "t"), p.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = p.getElementsByTagName("*"), r = p.getElementsByTagName("a")[0];if (!n || !r || !n.length) return {};s = i.createElement("select"), o = s.appendChild(i.createElement("option")), u = p.getElementsByTagName("input")[0], r.style.cssText = "top:1px;float:left;opacity:.5", t = { leadingWhitespace: p.firstChild.nodeType === 3, tbody: !p.getElementsByTagName("tbody").length, htmlSerialize: !!p.getElementsByTagName("link").length, style: /top/.test(r.getAttribute("style")), hrefNormalized: r.getAttribute("href") === "/a", opacity: /^0.5/.test(r.style.opacity), cssFloat: !!r.style.cssFloat, checkOn: u.value === "on", optSelected: o.selected, getSetAttribute: p.className !== "t", enctype: !!i.createElement("form").enctype, html5Clone: i.createElement("nav").cloneNode(!0).outerHTML !== "<:nav></:nav>", boxModel: i.compatMode === "CSS1Compat", submitBubbles: !0, changeBubbles: !0, focusinBubbles: !1, deleteExpando: !0, noCloneEvent: !0, inlineBlockNeedsLayout: !1, shrinkWrapBlocks: !1, reliableMarginRight: !0, boxSizingReliable: !0, pixelPosition: !1 }, u.checked = !0, t.noCloneChecked = u.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !o.disabled;try {
      delete p.test;
    } catch (d) {
      t.deleteExpando = !1;
    }!p.addEventListener && p.attachEvent && p.fireEvent && (p.attachEvent("onclick", h = function h() {
      t.noCloneEvent = !1;
    }), p.cloneNode(!0).fireEvent("onclick"), p.detachEvent("onclick", h)), u = i.createElement("input"), u.value = "t", u.setAttribute("type", "radio"), t.radioValue = u.value === "t", u.setAttribute("checked", "checked"), u.setAttribute("name", "t"), p.appendChild(u), a = i.createDocumentFragment(), a.appendChild(p.lastChild), t.checkClone = a.cloneNode(!0).cloneNode(!0).lastChild.checked, t.appendChecked = u.checked, a.removeChild(u), a.appendChild(p);if (p.attachEvent) for (l in { submit: !0, change: !0, focusin: !0 }) {
      f = "on" + l, c = f in p, c || (p.setAttribute(f, "return;"), c = typeof p[f] == "function"), t[l + "Bubbles"] = c;
    }return v(function () {
      var n,
          r,
          s,
          o,
          u = "padding:0;margin:0;border:0;display:block;overflow:hidden;",
          a = i.getElementsByTagName("body")[0];if (!a) return;n = i.createElement("div"), n.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px", a.insertBefore(n, a.firstChild), r = i.createElement("div"), n.appendChild(r), r.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", s = r.getElementsByTagName("td"), s[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = s[0].offsetHeight === 0, s[0].style.display = "", s[1].style.display = "none", t.reliableHiddenOffsets = c && s[0].offsetHeight === 0, r.innerHTML = "", r.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = r.offsetWidth === 4, t.doesNotIncludeMarginInBodyOffset = a.offsetTop !== 1, e.getComputedStyle && (t.pixelPosition = (e.getComputedStyle(r, null) || {}).top !== "1%", t.boxSizingReliable = (e.getComputedStyle(r, null) || { width: "4px" }).width === "4px", o = i.createElement("div"), o.style.cssText = r.style.cssText = u, o.style.marginRight = o.style.width = "0", r.style.width = "1px", r.appendChild(o), t.reliableMarginRight = !parseFloat((e.getComputedStyle(o, null) || {}).marginRight)), typeof r.style.zoom != "undefined" && (r.innerHTML = "", r.style.cssText = u + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = r.offsetWidth === 3, r.style.display = "block", r.style.overflow = "visible", r.innerHTML = "<div></div>", r.firstChild.style.width = "5px", t.shrinkWrapBlocks = r.offsetWidth !== 3, n.style.zoom = 1), a.removeChild(n), n = r = s = o = null;
    }), a.removeChild(p), n = r = s = o = u = a = p = null, t;
  }();var D = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
      P = /([A-Z])/g;v.extend({ cache: {}, deletedIds: [], uuid: 0, expando: "jQuery" + (v.fn.jquery + Math.random()).replace(/\D/g, ""), noData: { embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0 }, hasData: function hasData(e) {
      return e = e.nodeType ? v.cache[e[v.expando]] : e[v.expando], !!e && !B(e);
    }, data: function data(e, n, r, i) {
      if (!v.acceptData(e)) return;var s,
          o,
          u = v.expando,
          a = typeof n == "string",
          f = e.nodeType,
          l = f ? v.cache : e,
          c = f ? e[u] : e[u] && u;if ((!c || !l[c] || !i && !l[c].data) && a && r === t) return;c || (f ? e[u] = c = v.deletedIds.pop() || v.guid++ : c = u), l[c] || (l[c] = {}, f || (l[c].toJSON = v.noop));if ((typeof n === "undefined" ? "undefined" : _typeof(n)) == "object" || typeof n == "function") i ? l[c] = v.extend(l[c], n) : l[c].data = v.extend(l[c].data, n);return s = l[c], i || (s.data || (s.data = {}), s = s.data), r !== t && (s[v.camelCase(n)] = r), a ? (o = s[n], o == null && (o = s[v.camelCase(n)])) : o = s, o;
    }, removeData: function removeData(e, t, n) {
      if (!v.acceptData(e)) return;var r,
          i,
          s,
          o = e.nodeType,
          u = o ? v.cache : e,
          a = o ? e[v.expando] : v.expando;if (!u[a]) return;if (t) {
        r = n ? u[a] : u[a].data;if (r) {
          v.isArray(t) || (t in r ? t = [t] : (t = v.camelCase(t), t in r ? t = [t] : t = t.split(" ")));for (i = 0, s = t.length; i < s; i++) {
            delete r[t[i]];
          }if (!(n ? B : v.isEmptyObject)(r)) return;
        }
      }if (!n) {
        delete u[a].data;if (!B(u[a])) return;
      }o ? v.cleanData([e], !0) : v.support.deleteExpando || u != u.window ? delete u[a] : u[a] = null;
    }, _data: function _data(e, t, n) {
      return v.data(e, t, n, !0);
    }, acceptData: function acceptData(e) {
      var t = e.nodeName && v.noData[e.nodeName.toLowerCase()];return !t || t !== !0 && e.getAttribute("classid") === t;
    } }), v.fn.extend({ data: function data(e, n) {
      var r,
          i,
          s,
          o,
          u,
          a = this[0],
          f = 0,
          l = null;if (e === t) {
        if (this.length) {
          l = v.data(a);if (a.nodeType === 1 && !v._data(a, "parsedAttrs")) {
            s = a.attributes;for (u = s.length; f < u; f++) {
              o = s[f].name, o.indexOf("data-") || (o = v.camelCase(o.substring(5)), H(a, o, l[o]));
            }v._data(a, "parsedAttrs", !0);
          }
        }return l;
      }return (typeof e === "undefined" ? "undefined" : _typeof(e)) == "object" ? this.each(function () {
        v.data(this, e);
      }) : (r = e.split(".", 2), r[1] = r[1] ? "." + r[1] : "", i = r[1] + "!", v.access(this, function (n) {
        if (n === t) return l = this.triggerHandler("getData" + i, [r[0]]), l === t && a && (l = v.data(a, e), l = H(a, e, l)), l === t && r[1] ? this.data(r[0]) : l;r[1] = n, this.each(function () {
          var t = v(this);t.triggerHandler("setData" + i, r), v.data(this, e, n), t.triggerHandler("changeData" + i, r);
        });
      }, null, n, arguments.length > 1, null, !1));
    }, removeData: function removeData(e) {
      return this.each(function () {
        v.removeData(this, e);
      });
    } }), v.extend({ queue: function queue(e, t, n) {
      var r;if (e) return t = (t || "fx") + "queue", r = v._data(e, t), n && (!r || v.isArray(n) ? r = v._data(e, t, v.makeArray(n)) : r.push(n)), r || [];
    }, dequeue: function dequeue(e, t) {
      t = t || "fx";var n = v.queue(e, t),
          r = n.length,
          i = n.shift(),
          s = v._queueHooks(e, t),
          o = function o() {
        v.dequeue(e, t);
      };i === "inprogress" && (i = n.shift(), r--), i && (t === "fx" && n.unshift("inprogress"), delete s.stop, i.call(e, o, s)), !r && s && s.empty.fire();
    }, _queueHooks: function _queueHooks(e, t) {
      var n = t + "queueHooks";return v._data(e, n) || v._data(e, n, { empty: v.Callbacks("once memory").add(function () {
          v.removeData(e, t + "queue", !0), v.removeData(e, n, !0);
        }) });
    } }), v.fn.extend({ queue: function queue(e, n) {
      var r = 2;return typeof e != "string" && (n = e, e = "fx", r--), arguments.length < r ? v.queue(this[0], e) : n === t ? this : this.each(function () {
        var t = v.queue(this, e, n);v._queueHooks(this, e), e === "fx" && t[0] !== "inprogress" && v.dequeue(this, e);
      });
    }, dequeue: function dequeue(e) {
      return this.each(function () {
        v.dequeue(this, e);
      });
    }, delay: function delay(e, t) {
      return e = v.fx ? v.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
        var r = setTimeout(t, e);n.stop = function () {
          clearTimeout(r);
        };
      });
    }, clearQueue: function clearQueue(e) {
      return this.queue(e || "fx", []);
    }, promise: function promise(e, n) {
      var r,
          i = 1,
          s = v.Deferred(),
          o = this,
          u = this.length,
          a = function a() {
        --i || s.resolveWith(o, [o]);
      };typeof e != "string" && (n = e, e = t), e = e || "fx";while (u--) {
        r = v._data(o[u], e + "queueHooks"), r && r.empty && (i++, r.empty.add(a));
      }return a(), s.promise(n);
    } });var j,
      F,
      I,
      q = /[\t\r\n]/g,
      R = /\r/g,
      U = /^(?:button|input)$/i,
      z = /^(?:button|input|object|select|textarea)$/i,
      W = /^a(?:rea|)$/i,
      X = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
      V = v.support.getSetAttribute;v.fn.extend({ attr: function attr(e, t) {
      return v.access(this, v.attr, e, t, arguments.length > 1);
    }, removeAttr: function removeAttr(e) {
      return this.each(function () {
        v.removeAttr(this, e);
      });
    }, prop: function prop(e, t) {
      return v.access(this, v.prop, e, t, arguments.length > 1);
    }, removeProp: function removeProp(e) {
      return e = v.propFix[e] || e, this.each(function () {
        try {
          this[e] = t, delete this[e];
        } catch (n) {}
      });
    }, addClass: function addClass(e) {
      var t, n, r, i, s, o, u;if (v.isFunction(e)) return this.each(function (t) {
        v(this).addClass(e.call(this, t, this.className));
      });if (e && typeof e == "string") {
        t = e.split(y);for (n = 0, r = this.length; n < r; n++) {
          i = this[n];if (i.nodeType === 1) if (!i.className && t.length === 1) i.className = e;else {
            s = " " + i.className + " ";for (o = 0, u = t.length; o < u; o++) {
              s.indexOf(" " + t[o] + " ") < 0 && (s += t[o] + " ");
            }i.className = v.trim(s);
          }
        }
      }return this;
    }, removeClass: function removeClass(e) {
      var n, r, i, s, o, u, a;if (v.isFunction(e)) return this.each(function (t) {
        v(this).removeClass(e.call(this, t, this.className));
      });if (e && typeof e == "string" || e === t) {
        n = (e || "").split(y);for (u = 0, a = this.length; u < a; u++) {
          i = this[u];if (i.nodeType === 1 && i.className) {
            r = (" " + i.className + " ").replace(q, " ");for (s = 0, o = n.length; s < o; s++) {
              while (r.indexOf(" " + n[s] + " ") >= 0) {
                r = r.replace(" " + n[s] + " ", " ");
              }
            }i.className = e ? v.trim(r) : "";
          }
        }
      }return this;
    }, toggleClass: function toggleClass(e, t) {
      var n = typeof e === "undefined" ? "undefined" : _typeof(e),
          r = typeof t == "boolean";return v.isFunction(e) ? this.each(function (n) {
        v(this).toggleClass(e.call(this, n, this.className, t), t);
      }) : this.each(function () {
        if (n === "string") {
          var i,
              s = 0,
              o = v(this),
              u = t,
              a = e.split(y);while (i = a[s++]) {
            u = r ? u : !o.hasClass(i), o[u ? "addClass" : "removeClass"](i);
          }
        } else if (n === "undefined" || n === "boolean") this.className && v._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : v._data(this, "__className__") || "";
      });
    }, hasClass: function hasClass(e) {
      var t = " " + e + " ",
          n = 0,
          r = this.length;for (; n < r; n++) {
        if (this[n].nodeType === 1 && (" " + this[n].className + " ").replace(q, " ").indexOf(t) >= 0) return !0;
      }return !1;
    }, val: function val(e) {
      var n,
          r,
          i,
          s = this[0];if (!arguments.length) {
        if (s) return n = v.valHooks[s.type] || v.valHooks[s.nodeName.toLowerCase()], n && "get" in n && (r = n.get(s, "value")) !== t ? r : (r = s.value, typeof r == "string" ? r.replace(R, "") : r == null ? "" : r);return;
      }return i = v.isFunction(e), this.each(function (r) {
        var s,
            o = v(this);if (this.nodeType !== 1) return;i ? s = e.call(this, r, o.val()) : s = e, s == null ? s = "" : typeof s == "number" ? s += "" : v.isArray(s) && (s = v.map(s, function (e) {
          return e == null ? "" : e + "";
        })), n = v.valHooks[this.type] || v.valHooks[this.nodeName.toLowerCase()];if (!n || !("set" in n) || n.set(this, s, "value") === t) this.value = s;
      });
    } }), v.extend({ valHooks: { option: { get: function get(e) {
          var t = e.attributes.value;return !t || t.specified ? e.value : e.text;
        } }, select: { get: function get(e) {
          var t,
              n,
              r = e.options,
              i = e.selectedIndex,
              s = e.type === "select-one" || i < 0,
              o = s ? null : [],
              u = s ? i + 1 : r.length,
              a = i < 0 ? u : s ? i : 0;for (; a < u; a++) {
            n = r[a];if ((n.selected || a === i) && (v.support.optDisabled ? !n.disabled : n.getAttribute("disabled") === null) && (!n.parentNode.disabled || !v.nodeName(n.parentNode, "optgroup"))) {
              t = v(n).val();if (s) return t;o.push(t);
            }
          }return o;
        }, set: function set(e, t) {
          var n = v.makeArray(t);return v(e).find("option").each(function () {
            this.selected = v.inArray(v(this).val(), n) >= 0;
          }), n.length || (e.selectedIndex = -1), n;
        } } }, attrFn: {}, attr: function attr(e, n, r, i) {
      var s,
          o,
          u,
          a = e.nodeType;if (!e || a === 3 || a === 8 || a === 2) return;if (i && v.isFunction(v.fn[n])) return v(e)[n](r);if (typeof e.getAttribute == "undefined") return v.prop(e, n, r);u = a !== 1 || !v.isXMLDoc(e), u && (n = n.toLowerCase(), o = v.attrHooks[n] || (X.test(n) ? F : j));if (r !== t) {
        if (r === null) {
          v.removeAttr(e, n);return;
        }return o && "set" in o && u && (s = o.set(e, r, n)) !== t ? s : (e.setAttribute(n, r + ""), r);
      }return o && "get" in o && u && (s = o.get(e, n)) !== null ? s : (s = e.getAttribute(n), s === null ? t : s);
    }, removeAttr: function removeAttr(e, t) {
      var n,
          r,
          i,
          s,
          o = 0;if (t && e.nodeType === 1) {
        r = t.split(y);for (; o < r.length; o++) {
          i = r[o], i && (n = v.propFix[i] || i, s = X.test(i), s || v.attr(e, i, ""), e.removeAttribute(V ? i : n), s && n in e && (e[n] = !1));
        }
      }
    }, attrHooks: { type: { set: function set(e, t) {
          if (U.test(e.nodeName) && e.parentNode) v.error("type property can't be changed");else if (!v.support.radioValue && t === "radio" && v.nodeName(e, "input")) {
            var n = e.value;return e.setAttribute("type", t), n && (e.value = n), t;
          }
        } }, value: { get: function get(e, t) {
          return j && v.nodeName(e, "button") ? j.get(e, t) : t in e ? e.value : null;
        }, set: function set(e, t, n) {
          if (j && v.nodeName(e, "button")) return j.set(e, t, n);e.value = t;
        } } }, propFix: { tabindex: "tabIndex", readonly: "readOnly", "for": "htmlFor", "class": "className", maxlength: "maxLength", cellspacing: "cellSpacing", cellpadding: "cellPadding", rowspan: "rowSpan", colspan: "colSpan", usemap: "useMap", frameborder: "frameBorder", contenteditable: "contentEditable" }, prop: function prop(e, n, r) {
      var i,
          s,
          o,
          u = e.nodeType;if (!e || u === 3 || u === 8 || u === 2) return;return o = u !== 1 || !v.isXMLDoc(e), o && (n = v.propFix[n] || n, s = v.propHooks[n]), r !== t ? s && "set" in s && (i = s.set(e, r, n)) !== t ? i : e[n] = r : s && "get" in s && (i = s.get(e, n)) !== null ? i : e[n];
    }, propHooks: { tabIndex: { get: function get(e) {
          var n = e.getAttributeNode("tabindex");return n && n.specified ? parseInt(n.value, 10) : z.test(e.nodeName) || W.test(e.nodeName) && e.href ? 0 : t;
        } } } }), F = { get: function get(e, n) {
      var r,
          i = v.prop(e, n);return i === !0 || typeof i != "boolean" && (r = e.getAttributeNode(n)) && r.nodeValue !== !1 ? n.toLowerCase() : t;
    }, set: function set(e, t, n) {
      var r;return t === !1 ? v.removeAttr(e, n) : (r = v.propFix[n] || n, r in e && (e[r] = !0), e.setAttribute(n, n.toLowerCase())), n;
    } }, V || (I = { name: !0, id: !0, coords: !0 }, j = v.valHooks.button = { get: function get(e, n) {
      var r;return r = e.getAttributeNode(n), r && (I[n] ? r.value !== "" : r.specified) ? r.value : t;
    }, set: function set(e, t, n) {
      var r = e.getAttributeNode(n);return r || (r = i.createAttribute(n), e.setAttributeNode(r)), r.value = t + "";
    } }, v.each(["width", "height"], function (e, t) {
    v.attrHooks[t] = v.extend(v.attrHooks[t], { set: function set(e, n) {
        if (n === "") return e.setAttribute(t, "auto"), n;
      } });
  }), v.attrHooks.contenteditable = { get: j.get, set: function set(e, t, n) {
      t === "" && (t = "false"), j.set(e, t, n);
    } }), v.support.hrefNormalized || v.each(["href", "src", "width", "height"], function (e, n) {
    v.attrHooks[n] = v.extend(v.attrHooks[n], { get: function get(e) {
        var r = e.getAttribute(n, 2);return r === null ? t : r;
      } });
  }), v.support.style || (v.attrHooks.style = { get: function get(e) {
      return e.style.cssText.toLowerCase() || t;
    }, set: function set(e, t) {
      return e.style.cssText = t + "";
    } }), v.support.optSelected || (v.propHooks.selected = v.extend(v.propHooks.selected, { get: function get(e) {
      var t = e.parentNode;return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null;
    } })), v.support.enctype || (v.propFix.enctype = "encoding"), v.support.checkOn || v.each(["radio", "checkbox"], function () {
    v.valHooks[this] = { get: function get(e) {
        return e.getAttribute("value") === null ? "on" : e.value;
      } };
  }), v.each(["radio", "checkbox"], function () {
    v.valHooks[this] = v.extend(v.valHooks[this], { set: function set(e, t) {
        if (v.isArray(t)) return e.checked = v.inArray(v(e).val(), t) >= 0;
      } });
  });var $ = /^(?:textarea|input|select)$/i,
      J = /^([^\.]*|)(?:\.(.+)|)$/,
      K = /(?:^|\s)hover(\.\S+|)\b/,
      Q = /^key/,
      G = /^(?:mouse|contextmenu)|click/,
      Y = /^(?:focusinfocus|focusoutblur)$/,
      Z = function Z(e) {
    return v.event.special.hover ? e : e.replace(K, "mouseenter$1 mouseleave$1");
  };v.event = { add: function add(e, n, r, i, s) {
      var o, _u, a, f, l, c, h, p, d, m, g;if (e.nodeType === 3 || e.nodeType === 8 || !n || !r || !(o = v._data(e))) return;r.handler && (d = r, r = d.handler, s = d.selector), r.guid || (r.guid = v.guid++), a = o.events, a || (o.events = a = {}), _u = o.handle, _u || (o.handle = _u = function u(e) {
        return typeof v == "undefined" || !!e && v.event.triggered === e.type ? t : v.event.dispatch.apply(_u.elem, arguments);
      }, _u.elem = e), n = v.trim(Z(n)).split(" ");for (f = 0; f < n.length; f++) {
        l = J.exec(n[f]) || [], c = l[1], h = (l[2] || "").split(".").sort(), g = v.event.special[c] || {}, c = (s ? g.delegateType : g.bindType) || c, g = v.event.special[c] || {}, p = v.extend({ type: c, origType: l[1], data: i, handler: r, guid: r.guid, selector: s, needsContext: s && v.expr.match.needsContext.test(s), namespace: h.join(".") }, d), m = a[c];if (!m) {
          m = a[c] = [], m.delegateCount = 0;if (!g.setup || g.setup.call(e, i, h, _u) === !1) e.addEventListener ? e.addEventListener(c, _u, !1) : e.attachEvent && e.attachEvent("on" + c, _u);
        }g.add && (g.add.call(e, p), p.handler.guid || (p.handler.guid = r.guid)), s ? m.splice(m.delegateCount++, 0, p) : m.push(p), v.event.global[c] = !0;
      }e = null;
    }, global: {}, remove: function remove(e, t, n, r, i) {
      var s,
          o,
          u,
          a,
          f,
          l,
          c,
          h,
          p,
          d,
          m,
          g = v.hasData(e) && v._data(e);if (!g || !(h = g.events)) return;t = v.trim(Z(t || "")).split(" ");for (s = 0; s < t.length; s++) {
        o = J.exec(t[s]) || [], u = a = o[1], f = o[2];if (!u) {
          for (u in h) {
            v.event.remove(e, u + t[s], n, r, !0);
          }continue;
        }p = v.event.special[u] || {}, u = (r ? p.delegateType : p.bindType) || u, d = h[u] || [], l = d.length, f = f ? new RegExp("(^|\\.)" + f.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null;for (c = 0; c < d.length; c++) {
          m = d[c], (i || a === m.origType) && (!n || n.guid === m.guid) && (!f || f.test(m.namespace)) && (!r || r === m.selector || r === "**" && m.selector) && (d.splice(c--, 1), m.selector && d.delegateCount--, p.remove && p.remove.call(e, m));
        }d.length === 0 && l !== d.length && ((!p.teardown || p.teardown.call(e, f, g.handle) === !1) && v.removeEvent(e, u, g.handle), delete h[u]);
      }v.isEmptyObject(h) && (delete g.handle, v.removeData(e, "events", !0));
    }, customEvent: { getData: !0, setData: !0, changeData: !0 }, trigger: function trigger(n, r, s, o) {
      if (!s || s.nodeType !== 3 && s.nodeType !== 8) {
        var u,
            a,
            f,
            l,
            c,
            h,
            p,
            d,
            m,
            g,
            y = n.type || n,
            b = [];if (Y.test(y + v.event.triggered)) return;y.indexOf("!") >= 0 && (y = y.slice(0, -1), a = !0), y.indexOf(".") >= 0 && (b = y.split("."), y = b.shift(), b.sort());if ((!s || v.event.customEvent[y]) && !v.event.global[y]) return;n = (typeof n === "undefined" ? "undefined" : _typeof(n)) == "object" ? n[v.expando] ? n : new v.Event(y, n) : new v.Event(y), n.type = y, n.isTrigger = !0, n.exclusive = a, n.namespace = b.join("."), n.namespace_re = n.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, h = y.indexOf(":") < 0 ? "on" + y : "";if (!s) {
          u = v.cache;for (f in u) {
            u[f].events && u[f].events[y] && v.event.trigger(n, r, u[f].handle.elem, !0);
          }return;
        }n.result = t, n.target || (n.target = s), r = r != null ? v.makeArray(r) : [], r.unshift(n), p = v.event.special[y] || {};if (p.trigger && p.trigger.apply(s, r) === !1) return;m = [[s, p.bindType || y]];if (!o && !p.noBubble && !v.isWindow(s)) {
          g = p.delegateType || y, l = Y.test(g + y) ? s : s.parentNode;for (c = s; l; l = l.parentNode) {
            m.push([l, g]), c = l;
          }c === (s.ownerDocument || i) && m.push([c.defaultView || c.parentWindow || e, g]);
        }for (f = 0; f < m.length && !n.isPropagationStopped(); f++) {
          l = m[f][0], n.type = m[f][1], d = (v._data(l, "events") || {})[n.type] && v._data(l, "handle"), d && d.apply(l, r), d = h && l[h], d && v.acceptData(l) && d.apply && d.apply(l, r) === !1 && n.preventDefault();
        }return n.type = y, !o && !n.isDefaultPrevented() && (!p._default || p._default.apply(s.ownerDocument, r) === !1) && (y !== "click" || !v.nodeName(s, "a")) && v.acceptData(s) && h && s[y] && (y !== "focus" && y !== "blur" || n.target.offsetWidth !== 0) && !v.isWindow(s) && (c = s[h], c && (s[h] = null), v.event.triggered = y, s[y](), v.event.triggered = t, c && (s[h] = c)), n.result;
      }return;
    }, dispatch: function dispatch(n) {
      n = v.event.fix(n || e.event);var r,
          i,
          s,
          o,
          u,
          a,
          f,
          c,
          h,
          p,
          d = (v._data(this, "events") || {})[n.type] || [],
          m = d.delegateCount,
          g = l.call(arguments),
          y = !n.exclusive && !n.namespace,
          b = v.event.special[n.type] || {},
          w = [];g[0] = n, n.delegateTarget = this;if (b.preDispatch && b.preDispatch.call(this, n) === !1) return;if (m && (!n.button || n.type !== "click")) for (s = n.target; s != this; s = s.parentNode || this) {
        if (s.disabled !== !0 || n.type !== "click") {
          u = {}, f = [];for (r = 0; r < m; r++) {
            c = d[r], h = c.selector, u[h] === t && (u[h] = c.needsContext ? v(h, this).index(s) >= 0 : v.find(h, this, null, [s]).length), u[h] && f.push(c);
          }f.length && w.push({ elem: s, matches: f });
        }
      }d.length > m && w.push({ elem: this, matches: d.slice(m) });for (r = 0; r < w.length && !n.isPropagationStopped(); r++) {
        a = w[r], n.currentTarget = a.elem;for (i = 0; i < a.matches.length && !n.isImmediatePropagationStopped(); i++) {
          c = a.matches[i];if (y || !n.namespace && !c.namespace || n.namespace_re && n.namespace_re.test(c.namespace)) n.data = c.data, n.handleObj = c, o = ((v.event.special[c.origType] || {}).handle || c.handler).apply(a.elem, g), o !== t && (n.result = o, o === !1 && (n.preventDefault(), n.stopPropagation()));
        }
      }return b.postDispatch && b.postDispatch.call(this, n), n.result;
    }, props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks: {}, keyHooks: { props: "char charCode key keyCode".split(" "), filter: function filter(e, t) {
        return e.which == null && (e.which = t.charCode != null ? t.charCode : t.keyCode), e;
      } }, mouseHooks: { props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function filter(e, n) {
        var r,
            s,
            o,
            u = n.button,
            a = n.fromElement;return e.pageX == null && n.clientX != null && (r = e.target.ownerDocument || i, s = r.documentElement, o = r.body, e.pageX = n.clientX + (s && s.scrollLeft || o && o.scrollLeft || 0) - (s && s.clientLeft || o && o.clientLeft || 0), e.pageY = n.clientY + (s && s.scrollTop || o && o.scrollTop || 0) - (s && s.clientTop || o && o.clientTop || 0)), !e.relatedTarget && a && (e.relatedTarget = a === e.target ? n.toElement : a), !e.which && u !== t && (e.which = u & 1 ? 1 : u & 2 ? 3 : u & 4 ? 2 : 0), e;
      } }, fix: function fix(e) {
      if (e[v.expando]) return e;var t,
          n,
          r = e,
          s = v.event.fixHooks[e.type] || {},
          o = s.props ? this.props.concat(s.props) : this.props;e = v.Event(r);for (t = o.length; t;) {
        n = o[--t], e[n] = r[n];
      }return e.target || (e.target = r.srcElement || i), e.target.nodeType === 3 && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, s.filter ? s.filter(e, r) : e;
    }, special: { load: { noBubble: !0 }, focus: { delegateType: "focusin" }, blur: { delegateType: "focusout" }, beforeunload: { setup: function setup(e, t, n) {
          v.isWindow(this) && (this.onbeforeunload = n);
        }, teardown: function teardown(e, t) {
          this.onbeforeunload === t && (this.onbeforeunload = null);
        } } }, simulate: function simulate(e, t, n, r) {
      var i = v.extend(new v.Event(), n, { type: e, isSimulated: !0, originalEvent: {} });r ? v.event.trigger(i, null, t) : v.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault();
    } }, v.event.handle = v.event.dispatch, v.removeEvent = i.removeEventListener ? function (e, t, n) {
    e.removeEventListener && e.removeEventListener(t, n, !1);
  } : function (e, t, n) {
    var r = "on" + t;e.detachEvent && (typeof e[r] == "undefined" && (e[r] = null), e.detachEvent(r, n));
  }, v.Event = function (e, t) {
    if (!(this instanceof v.Event)) return new v.Event(e, t);e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? tt : et) : this.type = e, t && v.extend(this, t), this.timeStamp = e && e.timeStamp || v.now(), this[v.expando] = !0;
  }, v.Event.prototype = { preventDefault: function preventDefault() {
      this.isDefaultPrevented = tt;var e = this.originalEvent;if (!e) return;e.preventDefault ? e.preventDefault() : e.returnValue = !1;
    }, stopPropagation: function stopPropagation() {
      this.isPropagationStopped = tt;var e = this.originalEvent;if (!e) return;e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0;
    }, stopImmediatePropagation: function stopImmediatePropagation() {
      this.isImmediatePropagationStopped = tt, this.stopPropagation();
    }, isDefaultPrevented: et, isPropagationStopped: et, isImmediatePropagationStopped: et }, v.each({ mouseenter: "mouseover", mouseleave: "mouseout" }, function (e, t) {
    v.event.special[e] = { delegateType: t, bindType: t, handle: function handle(e) {
        var n,
            r = this,
            i = e.relatedTarget,
            s = e.handleObj,
            o = s.selector;if (!i || i !== r && !v.contains(r, i)) e.type = s.origType, n = s.handler.apply(this, arguments), e.type = t;return n;
      } };
  }), v.support.submitBubbles || (v.event.special.submit = { setup: function setup() {
      if (v.nodeName(this, "form")) return !1;v.event.add(this, "click._submit keypress._submit", function (e) {
        var n = e.target,
            r = v.nodeName(n, "input") || v.nodeName(n, "button") ? n.form : t;r && !v._data(r, "_submit_attached") && (v.event.add(r, "submit._submit", function (e) {
          e._submit_bubble = !0;
        }), v._data(r, "_submit_attached", !0));
      });
    }, postDispatch: function postDispatch(e) {
      e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && v.event.simulate("submit", this.parentNode, e, !0));
    }, teardown: function teardown() {
      if (v.nodeName(this, "form")) return !1;v.event.remove(this, "._submit");
    } }), v.support.changeBubbles || (v.event.special.change = { setup: function setup() {
      if ($.test(this.nodeName)) {
        if (this.type === "checkbox" || this.type === "radio") v.event.add(this, "propertychange._change", function (e) {
          e.originalEvent.propertyName === "checked" && (this._just_changed = !0);
        }), v.event.add(this, "click._change", function (e) {
          this._just_changed && !e.isTrigger && (this._just_changed = !1), v.event.simulate("change", this, e, !0);
        });return !1;
      }v.event.add(this, "beforeactivate._change", function (e) {
        var t = e.target;$.test(t.nodeName) && !v._data(t, "_change_attached") && (v.event.add(t, "change._change", function (e) {
          this.parentNode && !e.isSimulated && !e.isTrigger && v.event.simulate("change", this.parentNode, e, !0);
        }), v._data(t, "_change_attached", !0));
      });
    }, handle: function handle(e) {
      var t = e.target;if (this !== t || e.isSimulated || e.isTrigger || t.type !== "radio" && t.type !== "checkbox") return e.handleObj.handler.apply(this, arguments);
    }, teardown: function teardown() {
      return v.event.remove(this, "._change"), !$.test(this.nodeName);
    } }), v.support.focusinBubbles || v.each({ focus: "focusin", blur: "focusout" }, function (e, t) {
    var n = 0,
        r = function r(e) {
      v.event.simulate(t, e.target, v.event.fix(e), !0);
    };v.event.special[t] = { setup: function setup() {
        n++ === 0 && i.addEventListener(e, r, !0);
      }, teardown: function teardown() {
        --n === 0 && i.removeEventListener(e, r, !0);
      } };
  }), v.fn.extend({ on: function on(e, n, r, i, s) {
      var o, u;if ((typeof e === "undefined" ? "undefined" : _typeof(e)) == "object") {
        typeof n != "string" && (r = r || n, n = t);for (u in e) {
          this.on(u, n, r, e[u], s);
        }return this;
      }r == null && i == null ? (i = n, r = n = t) : i == null && (typeof n == "string" ? (i = r, r = t) : (i = r, r = n, n = t));if (i === !1) i = et;else if (!i) return this;return s === 1 && (o = i, i = function i(e) {
        return v().off(e), o.apply(this, arguments);
      }, i.guid = o.guid || (o.guid = v.guid++)), this.each(function () {
        v.event.add(this, e, i, r, n);
      });
    }, one: function one(e, t, n, r) {
      return this.on(e, t, n, r, 1);
    }, off: function off(e, n, r) {
      var i, s;if (e && e.preventDefault && e.handleObj) return i = e.handleObj, v(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;if ((typeof e === "undefined" ? "undefined" : _typeof(e)) == "object") {
        for (s in e) {
          this.off(s, n, e[s]);
        }return this;
      }if (n === !1 || typeof n == "function") r = n, n = t;return r === !1 && (r = et), this.each(function () {
        v.event.remove(this, e, r, n);
      });
    }, bind: function bind(e, t, n) {
      return this.on(e, null, t, n);
    }, unbind: function unbind(e, t) {
      return this.off(e, null, t);
    }, live: function live(e, t, n) {
      return v(this.context).on(e, this.selector, t, n), this;
    }, die: function die(e, t) {
      return v(this.context).off(e, this.selector || "**", t), this;
    }, delegate: function delegate(e, t, n, r) {
      return this.on(t, e, n, r);
    }, undelegate: function undelegate(e, t, n) {
      return arguments.length === 1 ? this.off(e, "**") : this.off(t, e || "**", n);
    }, trigger: function trigger(e, t) {
      return this.each(function () {
        v.event.trigger(e, t, this);
      });
    }, triggerHandler: function triggerHandler(e, t) {
      if (this[0]) return v.event.trigger(e, t, this[0], !0);
    }, toggle: function toggle(e) {
      var t = arguments,
          n = e.guid || v.guid++,
          r = 0,
          i = function i(n) {
        var i = (v._data(this, "lastToggle" + e.guid) || 0) % r;return v._data(this, "lastToggle" + e.guid, i + 1), n.preventDefault(), t[i].apply(this, arguments) || !1;
      };i.guid = n;while (r < t.length) {
        t[r++].guid = n;
      }return this.click(i);
    }, hover: function hover(e, t) {
      return this.mouseenter(e).mouseleave(t || e);
    } }), v.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
    v.fn[t] = function (e, n) {
      return n == null && (n = e, e = null), arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t);
    }, Q.test(t) && (v.event.fixHooks[t] = v.event.keyHooks), G.test(t) && (v.event.fixHooks[t] = v.event.mouseHooks);
  }), function (e, t) {
    function nt(e, t, n, r) {
      n = n || [], t = t || g;var i,
          s,
          a,
          f,
          l = t.nodeType;if (!e || typeof e != "string") return n;if (l !== 1 && l !== 9) return [];a = o(t);if (!a && !r) if (i = R.exec(e)) if (f = i[1]) {
        if (l === 9) {
          s = t.getElementById(f);if (!s || !s.parentNode) return n;if (s.id === f) return n.push(s), n;
        } else if (t.ownerDocument && (s = t.ownerDocument.getElementById(f)) && u(t, s) && s.id === f) return n.push(s), n;
      } else {
        if (i[2]) return S.apply(n, x.call(t.getElementsByTagName(e), 0)), n;if ((f = i[3]) && Z && t.getElementsByClassName) return S.apply(n, x.call(t.getElementsByClassName(f), 0)), n;
      }return vt(e.replace(j, "$1"), t, n, r, a);
    }function rt(e) {
      return function (t) {
        var n = t.nodeName.toLowerCase();return n === "input" && t.type === e;
      };
    }function it(e) {
      return function (t) {
        var n = t.nodeName.toLowerCase();return (n === "input" || n === "button") && t.type === e;
      };
    }function st(e) {
      return N(function (t) {
        return t = +t, N(function (n, r) {
          var i,
              s = e([], n.length, t),
              o = s.length;while (o--) {
            n[i = s[o]] && (n[i] = !(r[i] = n[i]));
          }
        });
      });
    }function ot(e, t, n) {
      if (e === t) return n;var r = e.nextSibling;while (r) {
        if (r === t) return -1;r = r.nextSibling;
      }return 1;
    }function ut(e, t) {
      var n,
          r,
          s,
          o,
          u,
          a,
          f,
          l = L[d][e + " "];if (l) return t ? 0 : l.slice(0);u = e, a = [], f = i.preFilter;while (u) {
        if (!n || (r = F.exec(u))) r && (u = u.slice(r[0].length) || u), a.push(s = []);n = !1;if (r = I.exec(u)) s.push(n = new m(r.shift())), u = u.slice(n.length), n.type = r[0].replace(j, " ");for (o in i.filter) {
          (r = J[o].exec(u)) && (!f[o] || (r = f[o](r))) && (s.push(n = new m(r.shift())), u = u.slice(n.length), n.type = o, n.matches = r);
        }if (!n) break;
      }return t ? u.length : u ? nt.error(e) : L(e, a).slice(0);
    }function at(e, t, r) {
      var i = t.dir,
          s = r && t.dir === "parentNode",
          o = w++;return t.first ? function (t, n, r) {
        while (t = t[i]) {
          if (s || t.nodeType === 1) return e(t, n, r);
        }
      } : function (t, r, u) {
        if (!u) {
          var a,
              f = b + " " + o + " ",
              l = f + n;while (t = t[i]) {
            if (s || t.nodeType === 1) {
              if ((a = t[d]) === l) return t.sizset;if (typeof a == "string" && a.indexOf(f) === 0) {
                if (t.sizset) return t;
              } else {
                t[d] = l;if (e(t, r, u)) return t.sizset = !0, t;t.sizset = !1;
              }
            }
          }
        } else while (t = t[i]) {
          if (s || t.nodeType === 1) if (e(t, r, u)) return t;
        }
      };
    }function ft(e) {
      return e.length > 1 ? function (t, n, r) {
        var i = e.length;while (i--) {
          if (!e[i](t, n, r)) return !1;
        }return !0;
      } : e[0];
    }function lt(e, t, n, r, i) {
      var s,
          o = [],
          u = 0,
          a = e.length,
          f = t != null;for (; u < a; u++) {
        if (s = e[u]) if (!n || n(s, r, i)) o.push(s), f && t.push(u);
      }return o;
    }function ct(e, t, n, r, i, s) {
      return r && !r[d] && (r = ct(r)), i && !i[d] && (i = ct(i, s)), N(function (s, o, u, a) {
        var f,
            l,
            c,
            h = [],
            p = [],
            d = o.length,
            v = s || dt(t || "*", u.nodeType ? [u] : u, []),
            m = e && (s || !t) ? lt(v, h, e, u, a) : v,
            g = n ? i || (s ? e : d || r) ? [] : o : m;n && n(m, g, u, a);if (r) {
          f = lt(g, p), r(f, [], u, a), l = f.length;while (l--) {
            if (c = f[l]) g[p[l]] = !(m[p[l]] = c);
          }
        }if (s) {
          if (i || e) {
            if (i) {
              f = [], l = g.length;while (l--) {
                (c = g[l]) && f.push(m[l] = c);
              }i(null, g = [], f, a);
            }l = g.length;while (l--) {
              (c = g[l]) && (f = i ? T.call(s, c) : h[l]) > -1 && (s[f] = !(o[f] = c));
            }
          }
        } else g = lt(g === o ? g.splice(d, g.length) : g), i ? i(null, o, g, a) : S.apply(o, g);
      });
    }function ht(e) {
      var t,
          n,
          r,
          s = e.length,
          o = i.relative[e[0].type],
          u = o || i.relative[" "],
          a = o ? 1 : 0,
          f = at(function (e) {
        return e === t;
      }, u, !0),
          l = at(function (e) {
        return T.call(t, e) > -1;
      }, u, !0),
          h = [function (e, n, r) {
        return !o && (r || n !== c) || ((t = n).nodeType ? f(e, n, r) : l(e, n, r));
      }];for (; a < s; a++) {
        if (n = i.relative[e[a].type]) h = [at(ft(h), n)];else {
          n = i.filter[e[a].type].apply(null, e[a].matches);if (n[d]) {
            r = ++a;for (; r < s; r++) {
              if (i.relative[e[r].type]) break;
            }return ct(a > 1 && ft(h), a > 1 && e.slice(0, a - 1).join("").replace(j, "$1"), n, a < r && ht(e.slice(a, r)), r < s && ht(e = e.slice(r)), r < s && e.join(""));
          }h.push(n);
        }
      }return ft(h);
    }function pt(e, t) {
      var r = t.length > 0,
          s = e.length > 0,
          o = function o(u, a, f, l, h) {
        var p,
            d,
            v,
            m = [],
            y = 0,
            w = "0",
            x = u && [],
            T = h != null,
            N = c,
            C = u || s && i.find.TAG("*", h && a.parentNode || a),
            k = b += N == null ? 1 : Math.E;T && (c = a !== g && a, n = o.el);for (; (p = C[w]) != null; w++) {
          if (s && p) {
            for (d = 0; v = e[d]; d++) {
              if (v(p, a, f)) {
                l.push(p);break;
              }
            }T && (b = k, n = ++o.el);
          }r && ((p = !v && p) && y--, u && x.push(p));
        }y += w;if (r && w !== y) {
          for (d = 0; v = t[d]; d++) {
            v(x, m, a, f);
          }if (u) {
            if (y > 0) while (w--) {
              !x[w] && !m[w] && (m[w] = E.call(l));
            }m = lt(m);
          }S.apply(l, m), T && !u && m.length > 0 && y + t.length > 1 && nt.AcmeSort(l);
        }return T && (b = k, c = N), x;
      };return o.el = 0, r ? N(o) : o;
    }function dt(e, t, n) {
      var r = 0,
          i = t.length;for (; r < i; r++) {
        nt(e, t[r], n);
      }return n;
    }function vt(e, t, n, r, s) {
      var o,
          u,
          f,
          l,
          c,
          h = ut(e),
          p = h.length;if (!r && h.length === 1) {
        u = h[0] = h[0].slice(0);if (u.length > 2 && (f = u[0]).type === "ID" && t.nodeType === 9 && !s && i.relative[u[1].type]) {
          t = i.find.ID(f.matches[0].replace($, ""), t, s)[0];if (!t) return n;e = e.slice(u.shift().length);
        }for (o = J.POS.test(e) ? -1 : u.length - 1; o >= 0; o--) {
          f = u[o];if (i.relative[l = f.type]) break;if (c = i.find[l]) if (r = c(f.matches[0].replace($, ""), z.test(u[0].type) && t.parentNode || t, s)) {
            u.splice(o, 1), e = r.length && u.join("");if (!e) return S.apply(n, x.call(r, 0)), n;break;
          }
        }
      }return a(e, h)(r, t, s, n, z.test(e)), n;
    }function mt() {}var n,
        r,
        i,
        s,
        o,
        u,
        a,
        f,
        l,
        c,
        h = !0,
        p = "undefined",
        d = ("sizcache" + Math.random()).replace(".", ""),
        m = String,
        g = e.document,
        y = g.documentElement,
        b = 0,
        w = 0,
        E = [].pop,
        S = [].push,
        x = [].slice,
        T = [].indexOf || function (e) {
      var t = 0,
          n = this.length;for (; t < n; t++) {
        if (this[t] === e) return t;
      }return -1;
    },
        N = function N(e, t) {
      return e[d] = t == null || t, e;
    },
        C = function C() {
      var e = {},
          t = [];return N(function (n, r) {
        return t.push(n) > i.cacheLength && delete e[t.shift()], e[n + " "] = r;
      }, e);
    },
        k = C(),
        L = C(),
        A = C(),
        O = "[\\x20\\t\\r\\n\\f]",
        M = "(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+",
        _ = M.replace("w", "w#"),
        D = "([*^$|!~]?=)",
        P = "\\[" + O + "*(" + M + ")" + O + "*(?:" + D + O + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + _ + ")|)|)" + O + "*\\]",
        H = ":(" + M + ")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:" + P + ")|[^:]|\\\\.)*|.*))\\)|)",
        B = ":(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + O + "*((?:-\\d)?\\d*)" + O + "*\\)|)(?=[^-]|$)",
        j = new RegExp("^" + O + "+|((?:^|[^\\\\])(?:\\\\.)*)" + O + "+$", "g"),
        F = new RegExp("^" + O + "*," + O + "*"),
        I = new RegExp("^" + O + "*([\\x20\\t\\r\\n\\f>+~])" + O + "*"),
        q = new RegExp(H),
        R = /^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/,
        U = /^:not/,
        z = /[\x20\t\r\n\f]*[+~]/,
        W = /:not\($/,
        X = /h\d/i,
        V = /input|select|textarea|button/i,
        $ = /\\(?!\\)/g,
        J = { ID: new RegExp("^#(" + M + ")"), CLASS: new RegExp("^\\.(" + M + ")"), NAME: new RegExp("^\\[name=['\"]?(" + M + ")['\"]?\\]"), TAG: new RegExp("^(" + M.replace("w", "w*") + ")"), ATTR: new RegExp("^" + P), PSEUDO: new RegExp("^" + H), POS: new RegExp(B, "i"), CHILD: new RegExp("^:(only|nth|first|last)-child(?:\\(" + O + "*(even|odd|(([+-]|)(\\d*)n|)" + O + "*(?:([+-]|)" + O + "*(\\d+)|))" + O + "*\\)|)", "i"), needsContext: new RegExp("^" + O + "*[>+~]|" + B, "i") },
        K = function K(e) {
      var t = g.createElement("div");try {
        return e(t);
      } catch (n) {
        return !1;
      } finally {
        t = null;
      }
    },
        Q = K(function (e) {
      return e.appendChild(g.createComment("")), !e.getElementsByTagName("*").length;
    }),
        G = K(function (e) {
      return e.innerHTML = "<a href='#'></a>", e.firstChild && _typeof(e.firstChild.getAttribute) !== p && e.firstChild.getAttribute("href") === "#";
    }),
        Y = K(function (e) {
      e.innerHTML = "<select></select>";var t = _typeof(e.lastChild.getAttribute("multiple"));return t !== "boolean" && t !== "string";
    }),
        Z = K(function (e) {
      return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", !e.getElementsByClassName || !e.getElementsByClassName("e").length ? !1 : (e.lastChild.className = "e", e.getElementsByClassName("e").length === 2);
    }),
        et = K(function (e) {
      e.id = d + 0, e.innerHTML = "<a name='" + d + "'></a><div name='" + d + "'></div>", y.insertBefore(e, y.firstChild);var t = g.getElementsByName && g.getElementsByName(d).length === 2 + g.getElementsByName(d + 0).length;return r = !g.getElementById(d), y.removeChild(e), t;
    });try {
      x.call(y.childNodes, 0)[0].nodeType;
    } catch (tt) {
      x = function x(e) {
        var t,
            n = [];for (; t = this[e]; e++) {
          n.push(t);
        }return n;
      };
    }nt.matches = function (e, t) {
      return nt(e, null, null, t);
    }, nt.matchesSelector = function (e, t) {
      return nt(t, null, null, [e]).length > 0;
    }, s = nt.getText = function (e) {
      var t,
          n = "",
          r = 0,
          i = e.nodeType;if (i) {
        if (i === 1 || i === 9 || i === 11) {
          if (typeof e.textContent == "string") return e.textContent;for (e = e.firstChild; e; e = e.nextSibling) {
            n += s(e);
          }
        } else if (i === 3 || i === 4) return e.nodeValue;
      } else for (; t = e[r]; r++) {
        n += s(t);
      }return n;
    }, o = nt.isXML = function (e) {
      var t = e && (e.ownerDocument || e).documentElement;return t ? t.nodeName !== "HTML" : !1;
    }, u = nt.contains = y.contains ? function (e, t) {
      var n = e.nodeType === 9 ? e.documentElement : e,
          r = t && t.parentNode;return e === r || !!(r && r.nodeType === 1 && n.contains && n.contains(r));
    } : y.compareDocumentPosition ? function (e, t) {
      return t && !!(e.compareDocumentPosition(t) & 16);
    } : function (e, t) {
      while (t = t.parentNode) {
        if (t === e) return !0;
      }return !1;
    }, nt.attr = function (e, t) {
      var n,
          r = o(e);return r || (t = t.toLowerCase()), (n = i.attrHandle[t]) ? n(e) : r || Y ? e.getAttribute(t) : (n = e.getAttributeNode(t), n ? typeof e[t] == "boolean" ? e[t] ? t : null : n.specified ? n.value : null : null);
    }, i = nt.selectors = { cacheLength: 50, createPseudo: N, match: J, attrHandle: G ? {} : { href: function href(e) {
          return e.getAttribute("href", 2);
        }, type: function type(e) {
          return e.getAttribute("type");
        } }, find: { ID: r ? function (e, t, n) {
          if (_typeof(t.getElementById) !== p && !n) {
            var r = t.getElementById(e);return r && r.parentNode ? [r] : [];
          }
        } : function (e, n, r) {
          if (_typeof(n.getElementById) !== p && !r) {
            var i = n.getElementById(e);return i ? i.id === e || _typeof(i.getAttributeNode) !== p && i.getAttributeNode("id").value === e ? [i] : t : [];
          }
        }, TAG: Q ? function (e, t) {
          if (_typeof(t.getElementsByTagName) !== p) return t.getElementsByTagName(e);
        } : function (e, t) {
          var n = t.getElementsByTagName(e);if (e === "*") {
            var r,
                i = [],
                s = 0;for (; r = n[s]; s++) {
              r.nodeType === 1 && i.push(r);
            }return i;
          }return n;
        }, NAME: et && function (e, t) {
          if (_typeof(t.getElementsByName) !== p) return t.getElementsByName(name);
        }, CLASS: Z && function (e, t, n) {
          if (_typeof(t.getElementsByClassName) !== p && !n) return t.getElementsByClassName(e);
        } }, relative: { ">": { dir: "parentNode", first: !0 }, " ": { dir: "parentNode" }, "+": { dir: "previousSibling", first: !0 }, "~": { dir: "previousSibling" } }, preFilter: { ATTR: function ATTR(e) {
          return e[1] = e[1].replace($, ""), e[3] = (e[4] || e[5] || "").replace($, ""), e[2] === "~=" && (e[3] = " " + e[3] + " "), e.slice(0, 4);
        }, CHILD: function CHILD(e) {
          return e[1] = e[1].toLowerCase(), e[1] === "nth" ? (e[2] || nt.error(e[0]), e[3] = +(e[3] ? e[4] + (e[5] || 1) : 2 * (e[2] === "even" || e[2] === "odd")), e[4] = +(e[6] + e[7] || e[2] === "odd")) : e[2] && nt.error(e[0]), e;
        }, PSEUDO: function PSEUDO(e) {
          var t, n;if (J.CHILD.test(e[0])) return null;if (e[3]) e[2] = e[3];else if (t = e[4]) q.test(t) && (n = ut(t, !0)) && (n = t.indexOf(")", t.length - n) - t.length) && (t = t.slice(0, n), e[0] = e[0].slice(0, n)), e[2] = t;return e.slice(0, 3);
        } }, filter: { ID: r ? function (e) {
          return e = e.replace($, ""), function (t) {
            return t.getAttribute("id") === e;
          };
        } : function (e) {
          return e = e.replace($, ""), function (t) {
            var n = _typeof(t.getAttributeNode) !== p && t.getAttributeNode("id");return n && n.value === e;
          };
        }, TAG: function TAG(e) {
          return e === "*" ? function () {
            return !0;
          } : (e = e.replace($, "").toLowerCase(), function (t) {
            return t.nodeName && t.nodeName.toLowerCase() === e;
          });
        }, CLASS: function CLASS(e) {
          var t = k[d][e + " "];return t || (t = new RegExp("(^|" + O + ")" + e + "(" + O + "|$)")) && k(e, function (e) {
            return t.test(e.className || _typeof(e.getAttribute) !== p && e.getAttribute("class") || "");
          });
        }, ATTR: function ATTR(e, t, n) {
          return function (r, i) {
            var s = nt.attr(r, e);return s == null ? t === "!=" : t ? (s += "", t === "=" ? s === n : t === "!=" ? s !== n : t === "^=" ? n && s.indexOf(n) === 0 : t === "*=" ? n && s.indexOf(n) > -1 : t === "$=" ? n && s.substr(s.length - n.length) === n : t === "~=" ? (" " + s + " ").indexOf(n) > -1 : t === "|=" ? s === n || s.substr(0, n.length + 1) === n + "-" : !1) : !0;
          };
        }, CHILD: function CHILD(e, t, n, r) {
          return e === "nth" ? function (e) {
            var t,
                i,
                s = e.parentNode;if (n === 1 && r === 0) return !0;if (s) {
              i = 0;for (t = s.firstChild; t; t = t.nextSibling) {
                if (t.nodeType === 1) {
                  i++;if (e === t) break;
                }
              }
            }return i -= r, i === n || i % n === 0 && i / n >= 0;
          } : function (t) {
            var n = t;switch (e) {case "only":case "first":
                while (n = n.previousSibling) {
                  if (n.nodeType === 1) return !1;
                }if (e === "first") return !0;n = t;case "last":
                while (n = n.nextSibling) {
                  if (n.nodeType === 1) return !1;
                }return !0;}
          };
        }, PSEUDO: function PSEUDO(e, t) {
          var n,
              r = i.pseudos[e] || i.setFilters[e.toLowerCase()] || nt.error("unsupported pseudo: " + e);return r[d] ? r(t) : r.length > 1 ? (n = [e, e, "", t], i.setFilters.hasOwnProperty(e.toLowerCase()) ? N(function (e, n) {
            var i,
                s = r(e, t),
                o = s.length;while (o--) {
              i = T.call(e, s[o]), e[i] = !(n[i] = s[o]);
            }
          }) : function (e) {
            return r(e, 0, n);
          }) : r;
        } }, pseudos: { not: N(function (e) {
          var t = [],
              n = [],
              r = a(e.replace(j, "$1"));return r[d] ? N(function (e, t, n, i) {
            var s,
                o = r(e, null, i, []),
                u = e.length;while (u--) {
              if (s = o[u]) e[u] = !(t[u] = s);
            }
          }) : function (e, i, s) {
            return t[0] = e, r(t, null, s, n), !n.pop();
          };
        }), has: N(function (e) {
          return function (t) {
            return nt(e, t).length > 0;
          };
        }), contains: N(function (e) {
          return function (t) {
            return (t.textContent || t.innerText || s(t)).indexOf(e) > -1;
          };
        }), enabled: function enabled(e) {
          return e.disabled === !1;
        }, disabled: function disabled(e) {
          return e.disabled === !0;
        }, checked: function checked(e) {
          var t = e.nodeName.toLowerCase();return t === "input" && !!e.checked || t === "option" && !!e.selected;
        }, selected: function selected(e) {
          return e.parentNode && e.parentNode.selectedIndex, e.selected === !0;
        }, parent: function parent(e) {
          return !i.pseudos.empty(e);
        }, empty: function empty(e) {
          var t;e = e.firstChild;while (e) {
            if (e.nodeName > "@" || (t = e.nodeType) === 3 || t === 4) return !1;e = e.nextSibling;
          }return !0;
        }, header: function header(e) {
          return X.test(e.nodeName);
        }, text: function text(e) {
          var t, n;return e.nodeName.toLowerCase() === "input" && (t = e.type) === "text" && ((n = e.getAttribute("type")) == null || n.toLowerCase() === t);
        }, radio: rt("radio"), checkbox: rt("checkbox"), file: rt("file"), password: rt("password"), image: rt("image"), submit: it("submit"), reset: it("reset"), button: function button(e) {
          var t = e.nodeName.toLowerCase();return t === "input" && e.type === "button" || t === "button";
        }, input: function input(e) {
          return V.test(e.nodeName);
        }, focus: function focus(e) {
          var t = e.ownerDocument;return e === t.activeElement && (!t.hasFocus || t.hasFocus()) && !!(e.type || e.href || ~e.tabIndex);
        }, active: function active(e) {
          return e === e.ownerDocument.activeElement;
        }, first: st(function () {
          return [0];
        }), last: st(function (e, t) {
          return [t - 1];
        }), eq: st(function (e, t, n) {
          return [n < 0 ? n + t : n];
        }), even: st(function (e, t) {
          for (var n = 0; n < t; n += 2) {
            e.push(n);
          }return e;
        }), odd: st(function (e, t) {
          for (var n = 1; n < t; n += 2) {
            e.push(n);
          }return e;
        }), lt: st(function (e, t, n) {
          for (var r = n < 0 ? n + t : n; --r >= 0;) {
            e.push(r);
          }return e;
        }), gt: st(function (e, t, n) {
          for (var r = n < 0 ? n + t : n; ++r < t;) {
            e.push(r);
          }return e;
        }) } }, f = y.compareDocumentPosition ? function (e, t) {
      return e === t ? (l = !0, 0) : (!e.compareDocumentPosition || !t.compareDocumentPosition ? e.compareDocumentPosition : e.compareDocumentPosition(t) & 4) ? -1 : 1;
    } : function (e, t) {
      if (e === t) return l = !0, 0;if (e.sourceIndex && t.sourceIndex) return e.sourceIndex - t.sourceIndex;var n,
          r,
          i = [],
          s = [],
          o = e.parentNode,
          u = t.parentNode,
          a = o;if (o === u) return ot(e, t);if (!o) return -1;if (!u) return 1;while (a) {
        i.unshift(a), a = a.parentNode;
      }a = u;while (a) {
        s.unshift(a), a = a.parentNode;
      }n = i.length, r = s.length;for (var f = 0; f < n && f < r; f++) {
        if (i[f] !== s[f]) return ot(i[f], s[f]);
      }return f === n ? ot(e, s[f], -1) : ot(i[f], t, 1);
    }, [0, 0].sort(f), h = !l, nt.AcmeSort = function (e) {
      var t,
          n = [],
          r = 1,
          i = 0;l = h, e.sort(f);if (l) {
        for (; t = e[r]; r++) {
          t === e[r - 1] && (i = n.push(r));
        }while (i--) {
          e.splice(n[i], 1);
        }
      }return e;
    }, nt.error = function (e) {
      throw new Error("Syntax error, unrecognized expression: " + e);
    }, a = nt.compile = function (e, t) {
      var n,
          r = [],
          i = [],
          s = A[d][e + " "];if (!s) {
        t || (t = ut(e)), n = t.length;while (n--) {
          s = ht(t[n]), s[d] ? r.push(s) : i.push(s);
        }s = A(e, pt(i, r));
      }return s;
    }, g.querySelectorAll && function () {
      var e,
          t = vt,
          n = /'|\\/g,
          r = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
          i = [":focus"],
          s = [":active"],
          u = y.matchesSelector || y.mozMatchesSelector || y.webkitMatchesSelector || y.oMatchesSelector || y.msMatchesSelector;K(function (e) {
        e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || i.push("\\[" + O + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || i.push(":checked");
      }), K(function (e) {
        e.innerHTML = "<p test=''></p>", e.querySelectorAll("[test^='']").length && i.push("[*^$]=" + O + "*(?:\"\"|'')"), e.innerHTML = "<input type='hidden'/>", e.querySelectorAll(":enabled").length || i.push(":enabled", ":disabled");
      }), i = new RegExp(i.join("|")), vt = function vt(e, r, s, o, u) {
        if (!o && !u && !i.test(e)) {
          var a,
              f,
              l = !0,
              c = d,
              h = r,
              p = r.nodeType === 9 && e;if (r.nodeType === 1 && r.nodeName.toLowerCase() !== "object") {
            a = ut(e), (l = r.getAttribute("id")) ? c = l.replace(n, "\\$&") : r.setAttribute("id", c), c = "[id='" + c + "'] ", f = a.length;while (f--) {
              a[f] = c + a[f].join("");
            }h = z.test(e) && r.parentNode || r, p = a.join(",");
          }if (p) try {
            return S.apply(s, x.call(h.querySelectorAll(p), 0)), s;
          } catch (v) {} finally {
            l || r.removeAttribute("id");
          }
        }return t(e, r, s, o, u);
      }, u && (K(function (t) {
        e = u.call(t, "div");try {
          u.call(t, "[test!='']:sizzle"), s.push("!=", H);
        } catch (n) {}
      }), s = new RegExp(s.join("|")), nt.matchesSelector = function (t, n) {
        n = n.replace(r, "='$1']");if (!o(t) && !s.test(n) && !i.test(n)) try {
          var a = u.call(t, n);if (a || e || t.document && t.document.nodeType !== 11) return a;
        } catch (f) {}return nt(n, null, null, [t]).length > 0;
      });
    }(), i.pseudos.nth = i.pseudos.eq, i.filters = mt.prototype = i.pseudos, i.setFilters = new mt(), nt.attr = v.attr, v.find = nt, v.expr = nt.selectors, v.expr[":"] = v.expr.pseudos, v.Acme = nt.AcmeSort, v.text = nt.getText, v.isXMLDoc = nt.isXML, v.contains = nt.contains;
  }(e);var nt = /Until$/,
      rt = /^(?:parents|prev(?:Until|All))/,
      it = /^.[^:#\[\.,]*$/,
      st = v.expr.match.needsContext,
      ot = { children: !0, contents: !0, next: !0, prev: !0 };v.fn.extend({ find: function find(e) {
      var t,
          n,
          r,
          i,
          s,
          o,
          u = this;if (typeof e != "string") return v(e).filter(function () {
        for (t = 0, n = u.length; t < n; t++) {
          if (v.contains(u[t], this)) return !0;
        }
      });o = this.pushStack("", "find", e);for (t = 0, n = this.length; t < n; t++) {
        r = o.length, v.find(e, this[t], o);if (t > 0) for (i = r; i < o.length; i++) {
          for (s = 0; s < r; s++) {
            if (o[s] === o[i]) {
              o.splice(i--, 1);break;
            }
          }
        }
      }return o;
    }, has: function has(e) {
      var t,
          n = v(e, this),
          r = n.length;return this.filter(function () {
        for (t = 0; t < r; t++) {
          if (v.contains(this, n[t])) return !0;
        }
      });
    }, not: function not(e) {
      return this.pushStack(ft(this, e, !1), "not", e);
    }, filter: function filter(e) {
      return this.pushStack(ft(this, e, !0), "filter", e);
    }, is: function is(e) {
      return !!e && (typeof e == "string" ? st.test(e) ? v(e, this.context).index(this[0]) >= 0 : v.filter(e, this).length > 0 : this.filter(e).length > 0);
    }, closest: function closest(e, t) {
      var n,
          r = 0,
          i = this.length,
          s = [],
          o = st.test(e) || typeof e != "string" ? v(e, t || this.context) : 0;for (; r < i; r++) {
        n = this[r];while (n && n.ownerDocument && n !== t && n.nodeType !== 11) {
          if (o ? o.index(n) > -1 : v.find.matchesSelector(n, e)) {
            s.push(n);break;
          }n = n.parentNode;
        }
      }return s = s.length > 1 ? v.Acme(s) : s, this.pushStack(s, "closest", e);
    }, index: function index(e) {
      return e ? typeof e == "string" ? v.inArray(this[0], v(e)) : v.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.prevAll().length : -1;
    }, add: function add(e, t) {
      var n = typeof e == "string" ? v(e, t) : v.makeArray(e && e.nodeType ? [e] : e),
          r = v.merge(this.get(), n);return this.pushStack(ut(n[0]) || ut(r[0]) ? r : v.Acme(r));
    }, addBack: function addBack(e) {
      return this.add(e == null ? this.prevObject : this.prevObject.filter(e));
    } }), v.fn.andSelf = v.fn.addBack, v.each({ parent: function parent(e) {
      var t = e.parentNode;return t && t.nodeType !== 11 ? t : null;
    }, parents: function parents(e) {
      return v.dir(e, "parentNode");
    }, parentsUntil: function parentsUntil(e, t, n) {
      return v.dir(e, "parentNode", n);
    }, next: function next(e) {
      return at(e, "nextSibling");
    }, prev: function prev(e) {
      return at(e, "previousSibling");
    }, nextAll: function nextAll(e) {
      return v.dir(e, "nextSibling");
    }, prevAll: function prevAll(e) {
      return v.dir(e, "previousSibling");
    }, nextUntil: function nextUntil(e, t, n) {
      return v.dir(e, "nextSibling", n);
    }, prevUntil: function prevUntil(e, t, n) {
      return v.dir(e, "previousSibling", n);
    }, siblings: function siblings(e) {
      return v.sibling((e.parentNode || {}).firstChild, e);
    }, children: function children(e) {
      return v.sibling(e.firstChild);
    }, contents: function contents(e) {
      return v.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : v.merge([], e.childNodes);
    } }, function (e, t) {
    v.fn[e] = function (n, r) {
      var i = v.map(this, t, n);return nt.test(e) || (r = n), r && typeof r == "string" && (i = v.filter(r, i)), i = this.length > 1 && !ot[e] ? v.Acme(i) : i, this.length > 1 && rt.test(e) && (i = i.reverse()), this.pushStack(i, e, l.call(arguments).join(","));
    };
  }), v.extend({ filter: function filter(e, t, n) {
      return n && (e = ":not(" + e + ")"), t.length === 1 ? v.find.matchesSelector(t[0], e) ? [t[0]] : [] : v.find.matches(e, t);
    }, dir: function dir(e, n, r) {
      var i = [],
          s = e[n];while (s && s.nodeType !== 9 && (r === t || s.nodeType !== 1 || !v(s).is(r))) {
        s.nodeType === 1 && i.push(s), s = s[n];
      }return i;
    }, sibling: function sibling(e, t) {
      var n = [];for (; e; e = e.nextSibling) {
        e.nodeType === 1 && e !== t && n.push(e);
      }return n;
    } });var ct = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
      ht = / jQuery\d+="(?:null|\d+)"/g,
      pt = /^\s+/,
      dt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
      vt = /<([\w:]+)/,
      mt = /<tbody/i,
      gt = /<|&#?\w+;/,
      yt = /<(?:script|style|link)/i,
      bt = /<(?:script|object|embed|option|style)/i,
      wt = new RegExp("<(?:" + ct + ")[\\s/>]", "i"),
      Et = /^(?:checkbox|radio)$/,
      St = /checked\s*(?:[^=]|=\s*.checked.)/i,
      xt = /\/(java|ecma)script/i,
      Tt = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,
      Nt = { option: [1, "<select multiple='multiple'>", "</select>"], legend: [1, "<fieldset>", "</fieldset>"], thead: [1, "<table>", "</table>"], tr: [2, "<table><tbody>", "</tbody></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], area: [1, "<map>", "</map>"], _default: [0, "", ""] },
      Ct = lt(i),
      kt = Ct.appendChild(i.createElement("div"));Nt.optgroup = Nt.option, Nt.tbody = Nt.tfoot = Nt.colgroup = Nt.caption = Nt.thead, Nt.th = Nt.td, v.support.htmlSerialize || (Nt._default = [1, "X<div>", "</div>"]), v.fn.extend({ text: function text(e) {
      return v.access(this, function (e) {
        return e === t ? v.text(this) : this.empty().append((this[0] && this[0].ownerDocument || i).createTextNode(e));
      }, null, e, arguments.length);
    }, wrapAll: function wrapAll(e) {
      if (v.isFunction(e)) return this.each(function (t) {
        v(this).wrapAll(e.call(this, t));
      });if (this[0]) {
        var t = v(e, this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
          var e = this;while (e.firstChild && e.firstChild.nodeType === 1) {
            e = e.firstChild;
          }return e;
        }).append(this);
      }return this;
    }, wrapInner: function wrapInner(e) {
      return v.isFunction(e) ? this.each(function (t) {
        v(this).wrapInner(e.call(this, t));
      }) : this.each(function () {
        var t = v(this),
            n = t.contents();n.length ? n.wrapAll(e) : t.append(e);
      });
    }, wrap: function wrap(e) {
      var t = v.isFunction(e);return this.each(function (n) {
        v(this).wrapAll(t ? e.call(this, n) : e);
      });
    }, unwrap: function unwrap() {
      return this.parent().each(function () {
        v.nodeName(this, "body") || v(this).replaceWith(this.childNodes);
      }).end();
    }, append: function append() {
      return this.domManip(arguments, !0, function (e) {
        (this.nodeType === 1 || this.nodeType === 11) && this.appendChild(e);
      });
    }, prepend: function prepend() {
      return this.domManip(arguments, !0, function (e) {
        (this.nodeType === 1 || this.nodeType === 11) && this.insertBefore(e, this.firstChild);
      });
    }, before: function before() {
      if (!ut(this[0])) return this.domManip(arguments, !1, function (e) {
        this.parentNode.insertBefore(e, this);
      });if (arguments.length) {
        var e = v.clean(arguments);return this.pushStack(v.merge(e, this), "before", this.selector);
      }
    }, after: function after() {
      if (!ut(this[0])) return this.domManip(arguments, !1, function (e) {
        this.parentNode.insertBefore(e, this.nextSibling);
      });if (arguments.length) {
        var e = v.clean(arguments);return this.pushStack(v.merge(this, e), "after", this.selector);
      }
    }, remove: function remove(e, t) {
      var n,
          r = 0;for (; (n = this[r]) != null; r++) {
        if (!e || v.filter(e, [n]).length) !t && n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), v.cleanData([n])), n.parentNode && n.parentNode.removeChild(n);
      }return this;
    }, empty: function empty() {
      var e,
          t = 0;for (; (e = this[t]) != null; t++) {
        e.nodeType === 1 && v.cleanData(e.getElementsByTagName("*"));while (e.firstChild) {
          e.removeChild(e.firstChild);
        }
      }return this;
    }, clone: function clone(e, t) {
      return e = e == null ? !1 : e, t = t == null ? e : t, this.map(function () {
        return v.clone(this, e, t);
      });
    }, html: function html(e) {
      return v.access(this, function (e) {
        var n = this[0] || {},
            r = 0,
            i = this.length;if (e === t) return n.nodeType === 1 ? n.innerHTML.replace(ht, "") : t;if (typeof e == "string" && !yt.test(e) && (v.support.htmlSerialize || !wt.test(e)) && (v.support.leadingWhitespace || !pt.test(e)) && !Nt[(vt.exec(e) || ["", ""])[1].toLowerCase()]) {
          e = e.replace(dt, "<$1></$2>");try {
            for (; r < i; r++) {
              n = this[r] || {}, n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), n.innerHTML = e);
            }n = 0;
          } catch (s) {}
        }n && this.empty().append(e);
      }, null, e, arguments.length);
    }, replaceWith: function replaceWith(e) {
      return ut(this[0]) ? this.length ? this.pushStack(v(v.isFunction(e) ? e() : e), "replaceWith", e) : this : v.isFunction(e) ? this.each(function (t) {
        var n = v(this),
            r = n.html();n.replaceWith(e.call(this, t, r));
      }) : (typeof e != "string" && (e = v(e).detach()), this.each(function () {
        var t = this.nextSibling,
            n = this.parentNode;v(this).remove(), t ? v(t).before(e) : v(n).append(e);
      }));
    }, detach: function detach(e) {
      return this.remove(e, !0);
    }, domManip: function domManip(e, n, r) {
      e = [].concat.apply([], e);var i,
          s,
          o,
          u,
          a = 0,
          f = e[0],
          l = [],
          c = this.length;if (!v.support.checkClone && c > 1 && typeof f == "string" && St.test(f)) return this.each(function () {
        v(this).domManip(e, n, r);
      });if (v.isFunction(f)) return this.each(function (i) {
        var s = v(this);e[0] = f.call(this, i, n ? s.html() : t), s.domManip(e, n, r);
      });if (this[0]) {
        i = v.buildFragment(e, this, l), o = i.fragment, s = o.firstChild, o.childNodes.length === 1 && (o = s);if (s) {
          n = n && v.nodeName(s, "tr");for (u = i.cacheable || c - 1; a < c; a++) {
            r.call(n && v.nodeName(this[a], "table") ? Lt(this[a], "tbody") : this[a], a === u ? o : v.clone(o, !0, !0));
          }
        }o = s = null, l.length && v.each(l, function (e, t) {
          t.src ? v.ajax ? v.ajax({ url: t.src, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0 }) : v.error("no ajax") : v.globalEval((t.text || t.textContent || t.innerHTML || "").replace(Tt, "")), t.parentNode && t.parentNode.removeChild(t);
        });
      }return this;
    } }), v.buildFragment = function (e, n, r) {
    var s,
        o,
        u,
        a = e[0];return n = n || i, n = !n.nodeType && n[0] || n, n = n.ownerDocument || n, e.length === 1 && typeof a == "string" && a.length < 512 && n === i && a.charAt(0) === "<" && !bt.test(a) && (v.support.checkClone || !St.test(a)) && (v.support.html5Clone || !wt.test(a)) && (o = !0, s = v.fragments[a], u = s !== t), s || (s = n.createDocumentFragment(), v.clean(e, n, s, r), o && (v.fragments[a] = u && s)), { fragment: s, cacheable: o };
  }, v.fragments = {}, v.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function (e, t) {
    v.fn[e] = function (n) {
      var r,
          i = 0,
          s = [],
          o = v(n),
          u = o.length,
          a = this.length === 1 && this[0].parentNode;if ((a == null || a && a.nodeType === 11 && a.childNodes.length === 1) && u === 1) return o[t](this[0]), this;for (; i < u; i++) {
        r = (i > 0 ? this.clone(!0) : this).get(), v(o[i])[t](r), s = s.concat(r);
      }return this.pushStack(s, e, o.selector);
    };
  }), v.extend({ clone: function clone(e, t, n) {
      var r, i, s, o;v.support.html5Clone || v.isXMLDoc(e) || !wt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (kt.innerHTML = e.outerHTML, kt.removeChild(o = kt.firstChild));if ((!v.support.noCloneEvent || !v.support.noCloneChecked) && (e.nodeType === 1 || e.nodeType === 11) && !v.isXMLDoc(e)) {
        Ot(e, o), r = Mt(e), i = Mt(o);for (s = 0; r[s]; ++s) {
          i[s] && Ot(r[s], i[s]);
        }
      }if (t) {
        At(e, o);if (n) {
          r = Mt(e), i = Mt(o);for (s = 0; r[s]; ++s) {
            At(r[s], i[s]);
          }
        }
      }return r = i = null, o;
    }, clean: function clean(e, t, n, r) {
      var s,
          o,
          u,
          a,
          f,
          l,
          c,
          h,
          p,
          d,
          m,
          g,
          y = t === i && Ct,
          b = [];if (!t || typeof t.createDocumentFragment == "undefined") t = i;for (s = 0; (u = e[s]) != null; s++) {
        typeof u == "number" && (u += "");if (!u) continue;if (typeof u == "string") if (!gt.test(u)) u = t.createTextNode(u);else {
          y = y || lt(t), c = t.createElement("div"), y.appendChild(c), u = u.replace(dt, "<$1></$2>"), a = (vt.exec(u) || ["", ""])[1].toLowerCase(), f = Nt[a] || Nt._default, l = f[0], c.innerHTML = f[1] + u + f[2];while (l--) {
            c = c.lastChild;
          }if (!v.support.tbody) {
            h = mt.test(u), p = a === "table" && !h ? c.firstChild && c.firstChild.childNodes : f[1] === "<table>" && !h ? c.childNodes : [];for (o = p.length - 1; o >= 0; --o) {
              v.nodeName(p[o], "tbody") && !p[o].childNodes.length && p[o].parentNode.removeChild(p[o]);
            }
          }!v.support.leadingWhitespace && pt.test(u) && c.insertBefore(t.createTextNode(pt.exec(u)[0]), c.firstChild), u = c.childNodes, c.parentNode.removeChild(c);
        }u.nodeType ? b.push(u) : v.merge(b, u);
      }c && (u = c = y = null);if (!v.support.appendChecked) for (s = 0; (u = b[s]) != null; s++) {
        v.nodeName(u, "input") ? _t(u) : typeof u.getElementsByTagName != "undefined" && v.grep(u.getElementsByTagName("input"), _t);
      }if (n) {
        m = function m(e) {
          if (!e.type || xt.test(e.type)) return r ? r.push(e.parentNode ? e.parentNode.removeChild(e) : e) : n.appendChild(e);
        };for (s = 0; (u = b[s]) != null; s++) {
          if (!v.nodeName(u, "script") || !m(u)) n.appendChild(u), typeof u.getElementsByTagName != "undefined" && (g = v.grep(v.merge([], u.getElementsByTagName("script")), m), b.splice.apply(b, [s + 1, 0].concat(g)), s += g.length);
        }
      }return b;
    }, cleanData: function cleanData(e, t) {
      var n,
          r,
          i,
          s,
          o = 0,
          u = v.expando,
          a = v.cache,
          f = v.support.deleteExpando,
          l = v.event.special;for (; (i = e[o]) != null; o++) {
        if (t || v.acceptData(i)) {
          r = i[u], n = r && a[r];if (n) {
            if (n.events) for (s in n.events) {
              l[s] ? v.event.remove(i, s) : v.removeEvent(i, s, n.handle);
            }a[r] && (delete a[r], f ? delete i[u] : i.removeAttribute ? i.removeAttribute(u) : i[u] = null, v.deletedIds.push(r));
          }
        }
      }
    } }), function () {
    var e, t;v.uaMatch = function (e) {
      e = e.toLowerCase();var t = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || e.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];return { browser: t[1] || "", version: t[2] || "0" };
    }, e = v.uaMatch(o.userAgent), t = {}, e.browser && (t[e.browser] = !0, t.version = e.version), t.chrome ? t.webkit = !0 : t.webkit && (t.safari = !0), v.browser = t, v.sub = function () {
      function e(t, n) {
        return new e.fn.init(t, n);
      }v.extend(!0, e, this), e.superclass = this, e.fn = e.prototype = this(), e.fn.constructor = e, e.sub = this.sub, e.fn.init = function (r, i) {
        return i && i instanceof v && !(i instanceof e) && (i = e(i)), v.fn.init.call(this, r, i, t);
      }, e.fn.init.prototype = e.fn;var t = e(i);return e;
    };
  }();var Dt,
      Pt,
      Ht,
      Bt = /alpha\([^)]*\)/i,
      jt = /opacity=([^)]*)/,
      Ft = /^(top|right|bottom|left)$/,
      It = /^(none|table(?!-c[ea]).+)/,
      qt = /^margin/,
      Rt = new RegExp("^(" + m + ")(.*)$", "i"),
      Ut = new RegExp("^(" + m + ")(?!px)[a-z%]+$", "i"),
      zt = new RegExp("^([-+])=(" + m + ")", "i"),
      Wt = { BODY: "block" },
      Xt = { position: "absolute", visibility: "hidden", display: "block" },
      Vt = { letterSpacing: 0, fontWeight: 400 },
      $t = ["Top", "Right", "Bottom", "Left"],
      Jt = ["Webkit", "O", "Moz", "ms"],
      Kt = v.fn.toggle;v.fn.extend({ css: function css(e, n) {
      return v.access(this, function (e, n, r) {
        return r !== t ? v.style(e, n, r) : v.css(e, n);
      }, e, n, arguments.length > 1);
    }, show: function show() {
      return Yt(this, !0);
    }, hide: function hide() {
      return Yt(this);
    }, toggle: function toggle(e, t) {
      var n = typeof e == "boolean";return v.isFunction(e) && v.isFunction(t) ? Kt.apply(this, arguments) : this.each(function () {
        (n ? e : Gt(this)) ? v(this).show() : v(this).hide();
      });
    } }), v.extend({ cssHooks: { opacity: { get: function get(e, t) {
          if (t) {
            var n = Dt(e, "opacity");return n === "" ? "1" : n;
          }
        } } }, cssNumber: { fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0 }, cssProps: { "float": v.support.cssFloat ? "cssFloat" : "styleFloat" }, style: function style(e, n, r, i) {
      if (!e || e.nodeType === 3 || e.nodeType === 8 || !e.style) return;var s,
          o,
          u,
          a = v.camelCase(n),
          f = e.style;n = v.cssProps[a] || (v.cssProps[a] = Qt(f, a)), u = v.cssHooks[n] || v.cssHooks[a];if (r === t) return u && "get" in u && (s = u.get(e, !1, i)) !== t ? s : f[n];o = typeof r === "undefined" ? "undefined" : _typeof(r), o === "string" && (s = zt.exec(r)) && (r = (s[1] + 1) * s[2] + parseFloat(v.css(e, n)), o = "number");if (r == null || o === "number" && isNaN(r)) return;o === "number" && !v.cssNumber[a] && (r += "px");if (!u || !("set" in u) || (r = u.set(e, r, i)) !== t) try {
        f[n] = r;
      } catch (l) {}
    }, css: function css(e, n, r, i) {
      var s,
          o,
          u,
          a = v.camelCase(n);return n = v.cssProps[a] || (v.cssProps[a] = Qt(e.style, a)), u = v.cssHooks[n] || v.cssHooks[a], u && "get" in u && (s = u.get(e, !0, i)), s === t && (s = Dt(e, n)), s === "normal" && n in Vt && (s = Vt[n]), r || i !== t ? (o = parseFloat(s), r || v.isNumeric(o) ? o || 0 : s) : s;
    }, swap: function swap(e, t, n) {
      var r,
          i,
          s = {};for (i in t) {
        s[i] = e.style[i], e.style[i] = t[i];
      }r = n.call(e);for (i in t) {
        e.style[i] = s[i];
      }return r;
    } }), e.getComputedStyle ? Dt = function Dt(t, n) {
    var r,
        i,
        s,
        o,
        u = e.getComputedStyle(t, null),
        a = t.style;return u && (r = u.getPropertyValue(n) || u[n], r === "" && !v.contains(t.ownerDocument, t) && (r = v.style(t, n)), Ut.test(r) && qt.test(n) && (i = a.width, s = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = r, r = u.width, a.width = i, a.minWidth = s, a.maxWidth = o)), r;
  } : i.documentElement.currentStyle && (Dt = function Dt(e, t) {
    var n,
        r,
        i = e.currentStyle && e.currentStyle[t],
        s = e.style;return i == null && s && s[t] && (i = s[t]), Ut.test(i) && !Ft.test(t) && (n = s.left, r = e.runtimeStyle && e.runtimeStyle.left, r && (e.runtimeStyle.left = e.currentStyle.left), s.left = t === "fontSize" ? "1em" : i, i = s.pixelLeft + "px", s.left = n, r && (e.runtimeStyle.left = r)), i === "" ? "auto" : i;
  }), v.each(["height", "width"], function (e, t) {
    v.cssHooks[t] = { get: function get(e, n, r) {
        if (n) return e.offsetWidth === 0 && It.test(Dt(e, "display")) ? v.swap(e, Xt, function () {
          return tn(e, t, r);
        }) : tn(e, t, r);
      }, set: function set(e, n, r) {
        return Zt(e, n, r ? en(e, t, r, v.support.boxSizing && v.css(e, "boxSizing") === "border-box") : 0);
      } };
  }), v.support.opacity || (v.cssHooks.opacity = { get: function get(e, t) {
      return jt.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : "";
    }, set: function set(e, t) {
      var n = e.style,
          r = e.currentStyle,
          i = v.isNumeric(t) ? "alpha(opacity=" + t * 100 + ")" : "",
          s = r && r.filter || n.filter || "";n.zoom = 1;if (t >= 1 && v.trim(s.replace(Bt, "")) === "" && n.removeAttribute) {
        n.removeAttribute("filter");if (r && !r.filter) return;
      }n.filter = Bt.test(s) ? s.replace(Bt, i) : s + " " + i;
    } }), v(function () {
    v.support.reliableMarginRight || (v.cssHooks.marginRight = { get: function get(e, t) {
        return v.swap(e, { display: "inline-block" }, function () {
          if (t) return Dt(e, "marginRight");
        });
      } }), !v.support.pixelPosition && v.fn.position && v.each(["top", "left"], function (e, t) {
      v.cssHooks[t] = { get: function get(e, n) {
          if (n) {
            var r = Dt(e, t);return Ut.test(r) ? v(e).position()[t] + "px" : r;
          }
        } };
    });
  }), v.expr && v.expr.filters && (v.expr.filters.hidden = function (e) {
    return e.offsetWidth === 0 && e.offsetHeight === 0 || !v.support.reliableHiddenOffsets && (e.style && e.style.display || Dt(e, "display")) === "none";
  }, v.expr.filters.visible = function (e) {
    return !v.expr.filters.hidden(e);
  }), v.each({ margin: "", padding: "", border: "Width" }, function (e, t) {
    v.cssHooks[e + t] = { expand: function expand(n) {
        var r,
            i = typeof n == "string" ? n.split(" ") : [n],
            s = {};for (r = 0; r < 4; r++) {
          s[e + $t[r] + t] = i[r] || i[r - 2] || i[0];
        }return s;
      } }, qt.test(e) || (v.cssHooks[e + t].set = Zt);
  });var rn = /%20/g,
      sn = /\[\]$/,
      on = /\r?\n/g,
      un = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
      an = /^(?:select|textarea)/i;v.fn.extend({ serialize: function serialize() {
      return v.param(this.serializeArray());
    }, serializeArray: function serializeArray() {
      return this.map(function () {
        return this.elements ? v.makeArray(this.elements) : this;
      }).filter(function () {
        return this.name && !this.disabled && (this.checked || an.test(this.nodeName) || un.test(this.type));
      }).map(function (e, t) {
        var n = v(this).val();return n == null ? null : v.isArray(n) ? v.map(n, function (e, n) {
          return { name: t.name, value: e.replace(on, "\r\n") };
        }) : { name: t.name, value: n.replace(on, "\r\n") };
      }).get();
    } }), v.param = function (e, n) {
    var r,
        i = [],
        s = function s(e, t) {
      t = v.isFunction(t) ? t() : t == null ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t);
    };n === t && (n = v.ajaxSettings && v.ajaxSettings.traditional);if (v.isArray(e) || e.jquery && !v.isPlainObject(e)) v.each(e, function () {
      s(this.name, this.value);
    });else for (r in e) {
      fn(r, e[r], n, s);
    }return i.join("&").replace(rn, "+");
  };var ln,
      cn,
      hn = /#.*$/,
      pn = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg,
      dn = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,
      vn = /^(?:GET|HEAD)$/,
      mn = /^\/\//,
      gn = /\?/,
      yn = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
      bn = /([?&])_=[^&]*/,
      wn = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
      En = v.fn.load,
      Sn = {},
      xn = {},
      Tn = ["*/"] + ["*"];try {
    cn = s.href;
  } catch (Nn) {
    cn = i.createElement("a"), cn.href = "", cn = cn.href;
  }ln = wn.exec(cn.toLowerCase()) || [], v.fn.load = function (e, n, r) {
    if (typeof e != "string" && En) return En.apply(this, arguments);if (!this.length) return this;var i,
        s,
        o,
        u = this,
        a = e.indexOf(" ");return a >= 0 && (i = e.slice(a, e.length), e = e.slice(0, a)), v.isFunction(n) ? (r = n, n = t) : n && (typeof n === "undefined" ? "undefined" : _typeof(n)) == "object" && (s = "POST"), v.ajax({ url: e, type: s, dataType: "html", data: n, complete: function complete(e, t) {
        r && u.each(r, o || [e.responseText, t, e]);
      } }).done(function (e) {
      o = arguments, u.html(i ? v("<div>").append(e.replace(yn, "")).find(i) : e);
    }), this;
  }, v.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (e, t) {
    v.fn[t] = function (e) {
      return this.on(t, e);
    };
  }), v.each(["get", "post"], function (e, n) {
    v[n] = function (e, r, i, s) {
      return v.isFunction(r) && (s = s || i, i = r, r = t), v.ajax({ type: n, url: e, data: r, success: i, dataType: s });
    };
  }), v.extend({ getScript: function getScript(e, n) {
      return v.get(e, t, n, "script");
    }, getJSON: function getJSON(e, t, n) {
      return v.get(e, t, n, "json");
    }, ajaxSetup: function ajaxSetup(e, t) {
      return t ? Ln(e, v.ajaxSettings) : (t = e, e = v.ajaxSettings), Ln(e, t), e;
    }, ajaxSettings: { url: cn, isLocal: dn.test(ln[1]), global: !0, type: "GET", contentType: "application/x-www-form-urlencoded; charset=UTF-8", processData: !0, async: !0, accepts: { xml: "application/xml, text/xml", html: "text/html", text: "text/plain", json: "application/json, text/javascript", "*": Tn }, contents: { xml: /xml/, html: /html/, json: /json/ }, responseFields: { xml: "responseXML", text: "responseText" }, converters: { "* text": e.String, "text html": !0, "text json": v.parseJSON, "text xml": v.parseXML }, flatOptions: { context: !0, url: !0 } }, ajaxPrefilter: Cn(Sn), ajaxTransport: Cn(xn), ajax: function ajax(e, n) {
      function T(e, n, s, a) {
        var l,
            y,
            b,
            w,
            S,
            T = n;if (E === 2) return;E = 2, u && clearTimeout(u), o = t, i = a || "", x.readyState = e > 0 ? 4 : 0, s && (w = An(c, x, s));if (e >= 200 && e < 300 || e === 304) c.ifModified && (S = x.getResponseHeader("Last-Modified"), S && (v.lastModified[r] = S), S = x.getResponseHeader("Etag"), S && (v.etag[r] = S)), e === 304 ? (T = "notmodified", l = !0) : (l = On(c, w), T = l.state, y = l.data, b = l.error, l = !b);else {
          b = T;if (!T || e) T = "error", e < 0 && (e = 0);
        }x.status = e, x.statusText = (n || T) + "", l ? d.resolveWith(h, [y, T, x]) : d.rejectWith(h, [x, T, b]), x.statusCode(g), g = t, f && p.trigger("ajax" + (l ? "Success" : "Error"), [x, c, l ? y : b]), m.fireWith(h, [x, T]), f && (p.trigger("ajaxComplete", [x, c]), --v.active || v.event.trigger("ajaxStop"));
      }(typeof e === "undefined" ? "undefined" : _typeof(e)) == "object" && (n = e, e = t), n = n || {};var r,
          i,
          s,
          o,
          u,
          a,
          f,
          l,
          c = v.ajaxSetup({}, n),
          h = c.context || c,
          p = h !== c && (h.nodeType || h instanceof v) ? v(h) : v.event,
          d = v.Deferred(),
          m = v.Callbacks("once memory"),
          g = c.statusCode || {},
          b = {},
          w = {},
          E = 0,
          S = "canceled",
          x = { readyState: 0, setRequestHeader: function setRequestHeader(e, t) {
          if (!E) {
            var n = e.toLowerCase();e = w[n] = w[n] || e, b[e] = t;
          }return this;
        }, getAllResponseHeaders: function getAllResponseHeaders() {
          return E === 2 ? i : null;
        }, getResponseHeader: function getResponseHeader(e) {
          var n;if (E === 2) {
            if (!s) {
              s = {};while (n = pn.exec(i)) {
                s[n[1].toLowerCase()] = n[2];
              }
            }n = s[e.toLowerCase()];
          }return n === t ? null : n;
        }, overrideMimeType: function overrideMimeType(e) {
          return E || (c.mimeType = e), this;
        }, abort: function abort(e) {
          return e = e || S, o && o.abort(e), T(0, e), this;
        } };d.promise(x), x.success = x.done, x.error = x.fail, x.complete = m.add, x.statusCode = function (e) {
        if (e) {
          var t;if (E < 2) for (t in e) {
            g[t] = [g[t], e[t]];
          } else t = e[x.status], x.always(t);
        }return this;
      }, c.url = ((e || c.url) + "").replace(hn, "").replace(mn, ln[1] + "//"), c.dataTypes = v.trim(c.dataType || "*").toLowerCase().split(y), c.crossDomain == null && (a = wn.exec(c.url.toLowerCase()), c.crossDomain = !(!a || a[1] === ln[1] && a[2] === ln[2] && (a[3] || (a[1] === "http:" ? 80 : 443)) == (ln[3] || (ln[1] === "http:" ? 80 : 443)))), c.data && c.processData && typeof c.data != "string" && (c.data = v.param(c.data, c.traditional)), kn(Sn, c, n, x);if (E === 2) return x;f = c.global, c.type = c.type.toUpperCase(), c.hasContent = !vn.test(c.type), f && v.active++ === 0 && v.event.trigger("ajaxStart");if (!c.hasContent) {
        c.data && (c.url += (gn.test(c.url) ? "&" : "?") + c.data, delete c.data), r = c.url;if (c.cache === !1) {
          var N = v.now(),
              C = c.url.replace(bn, "$1_=" + N);c.url = C + (C === c.url ? (gn.test(c.url) ? "&" : "?") + "_=" + N : "");
        }
      }(c.data && c.hasContent && c.contentType !== !1 || n.contentType) && x.setRequestHeader("Content-Type", c.contentType), c.ifModified && (r = r || c.url, v.lastModified[r] && x.setRequestHeader("If-Modified-Since", v.lastModified[r]), v.etag[r] && x.setRequestHeader("If-None-Match", v.etag[r])), x.setRequestHeader("Accept", c.dataTypes[0] && c.accepts[c.dataTypes[0]] ? c.accepts[c.dataTypes[0]] + (c.dataTypes[0] !== "*" ? ", " + Tn + "; q=0.01" : "") : c.accepts["*"]);for (l in c.headers) {
        x.setRequestHeader(l, c.headers[l]);
      }if (!c.beforeSend || c.beforeSend.call(h, x, c) !== !1 && E !== 2) {
        S = "abort";for (l in { success: 1, error: 1, complete: 1 }) {
          x[l](c[l]);
        }o = kn(xn, c, n, x);if (!o) T(-1, "No Transport");else {
          x.readyState = 1, f && p.trigger("ajaxSend", [x, c]), c.async && c.timeout > 0 && (u = setTimeout(function () {
            x.abort("timeout");
          }, c.timeout));try {
            E = 1, o.send(b, T);
          } catch (k) {
            if (!(E < 2)) throw k;T(-1, k);
          }
        }return x;
      }return x.abort();
    }, active: 0, lastModified: {}, etag: {} });var Mn = [],
      _n = /\?/,
      Dn = /(=)\?(?=&|$)|\?\?/,
      Pn = v.now();v.ajaxSetup({ jsonp: "callback", jsonpCallback: function jsonpCallback() {
      var e = Mn.pop() || v.expando + "_" + Pn++;return this[e] = !0, e;
    } }), v.ajaxPrefilter("json jsonp", function (n, r, i) {
    var s,
        o,
        u,
        a = n.data,
        f = n.url,
        l = n.jsonp !== !1,
        c = l && Dn.test(f),
        h = l && !c && typeof a == "string" && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Dn.test(a);if (n.dataTypes[0] === "jsonp" || c || h) return s = n.jsonpCallback = v.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, o = e[s], c ? n.url = f.replace(Dn, "$1" + s) : h ? n.data = a.replace(Dn, "$1" + s) : l && (n.url += (_n.test(f) ? "&" : "?") + n.jsonp + "=" + s), n.converters["script json"] = function () {
      return u || v.error(s + " was not called"), u[0];
    }, n.dataTypes[0] = "json", e[s] = function () {
      u = arguments;
    }, i.always(function () {
      e[s] = o, n[s] && (n.jsonpCallback = r.jsonpCallback, Mn.push(s)), u && v.isFunction(o) && o(u[0]), u = o = t;
    }), "script";
  }), v.ajaxSetup({ accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" }, contents: { script: /javascript|ecmascript/ }, converters: { "text script": function textScript(e) {
        return v.globalEval(e), e;
      } } }), v.ajaxPrefilter("script", function (e) {
    e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1);
  }), v.ajaxTransport("script", function (e) {
    if (e.crossDomain) {
      var n,
          r = i.head || i.getElementsByTagName("head")[0] || i.documentElement;return { send: function send(s, o) {
          n = i.createElement("script"), n.async = "async", e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function (e, i) {
            if (i || !n.readyState || /loaded|complete/.test(n.readyState)) n.onload = n.onreadystatechange = null, r && n.parentNode && r.removeChild(n), n = t, i || o(200, "success");
          }, r.insertBefore(n, r.firstChild);
        }, abort: function abort() {
          n && n.onload(0, 1);
        } };
    }
  });var Hn,
      Bn = e.ActiveXObject ? function () {
    for (var e in Hn) {
      Hn[e](0, 1);
    }
  } : !1,
      jn = 0;v.ajaxSettings.xhr = e.ActiveXObject ? function () {
    return !this.isLocal && Fn() || In();
  } : Fn, function (e) {
    v.extend(v.support, { ajax: !!e, cors: !!e && "withCredentials" in e });
  }(v.ajaxSettings.xhr()), v.support.ajax && v.ajaxTransport(function (n) {
    if (!n.crossDomain || v.support.cors) {
      var _r;return { send: function send(i, s) {
          var o,
              u,
              a = n.xhr();n.username ? a.open(n.type, n.url, n.async, n.username, n.password) : a.open(n.type, n.url, n.async);if (n.xhrFields) for (u in n.xhrFields) {
            a[u] = n.xhrFields[u];
          }n.mimeType && a.overrideMimeType && a.overrideMimeType(n.mimeType), !n.crossDomain && !i["X-Requested-With"] && (i["X-Requested-With"] = "XMLHttpRequest");try {
            for (u in i) {
              a.setRequestHeader(u, i[u]);
            }
          } catch (f) {}a.send(n.hasContent && n.data || null), _r = function r(e, i) {
            var u, f, l, c, h;try {
              if (_r && (i || a.readyState === 4)) {
                _r = t, o && (a.onreadystatechange = v.noop, Bn && delete Hn[o]);if (i) a.readyState !== 4 && a.abort();else {
                  u = a.status, l = a.getAllResponseHeaders(), c = {}, h = a.responseXML, h && h.documentElement && (c.xml = h);try {
                    c.text = a.responseText;
                  } catch (p) {}try {
                    f = a.statusText;
                  } catch (p) {
                    f = "";
                  }!u && n.isLocal && !n.crossDomain ? u = c.text ? 200 : 404 : u === 1223 && (u = 204);
                }
              }
            } catch (d) {
              i || s(-1, d);
            }c && s(u, f, c, l);
          }, n.async ? a.readyState === 4 ? setTimeout(_r, 0) : (o = ++jn, Bn && (Hn || (Hn = {}, v(e).unload(Bn)), Hn[o] = _r), a.onreadystatechange = _r) : _r();
        }, abort: function abort() {
          _r && _r(0, 1);
        } };
    }
  });var qn,
      Rn,
      Un = /^(?:toggle|show|hide)$/,
      zn = new RegExp("^(?:([-+])=|)(" + m + ")([a-z%]*)$", "i"),
      Wn = /queueHooks$/,
      Xn = [Gn],
      Vn = { "*": [function (e, t) {
      var n,
          r,
          i = this.createTween(e, t),
          s = zn.exec(t),
          o = i.cur(),
          u = +o || 0,
          a = 1,
          f = 20;if (s) {
        n = +s[2], r = s[3] || (v.cssNumber[e] ? "" : "px");if (r !== "px" && u) {
          u = v.css(i.elem, e, !0) || n || 1;do {
            a = a || ".5", u /= a, v.style(i.elem, e, u + r);
          } while (a !== (a = i.cur() / o) && a !== 1 && --f);
        }i.unit = r, i.start = u, i.end = s[1] ? u + (s[1] + 1) * n : n;
      }return i;
    }] };v.Animation = v.extend(Kn, { tweener: function tweener(e, t) {
      v.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");var n,
          r = 0,
          i = e.length;for (; r < i; r++) {
        n = e[r], Vn[n] = Vn[n] || [], Vn[n].unshift(t);
      }
    }, prefilter: function prefilter(e, t) {
      t ? Xn.unshift(e) : Xn.push(e);
    } }), v.Tween = Yn, Yn.prototype = { constructor: Yn, init: function init(e, t, n, r, i, s) {
      this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = s || (v.cssNumber[n] ? "" : "px");
    }, cur: function cur() {
      var e = Yn.propHooks[this.prop];return e && e.get ? e.get(this) : Yn.propHooks._default.get(this);
    }, run: function run(e) {
      var t,
          n = Yn.propHooks[this.prop];return this.options.duration ? this.pos = t = v.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : Yn.propHooks._default.set(this), this;
    } }, Yn.prototype.init.prototype = Yn.prototype, Yn.propHooks = { _default: { get: function get(e) {
        var t;return e.elem[e.prop] == null || !!e.elem.style && e.elem.style[e.prop] != null ? (t = v.css(e.elem, e.prop, !1, ""), !t || t === "auto" ? 0 : t) : e.elem[e.prop];
      }, set: function set(e) {
        v.fx.step[e.prop] ? v.fx.step[e.prop](e) : e.elem.style && (e.elem.style[v.cssProps[e.prop]] != null || v.cssHooks[e.prop]) ? v.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now;
      } } }, Yn.propHooks.scrollTop = Yn.propHooks.scrollLeft = { set: function set(e) {
      e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
    } }, v.each(["toggle", "show", "hide"], function (e, t) {
    var n = v.fn[t];v.fn[t] = function (r, i, s) {
      return r == null || typeof r == "boolean" || !e && v.isFunction(r) && v.isFunction(i) ? n.apply(this, arguments) : this.animate(Zn(t, !0), r, i, s);
    };
  }), v.fn.extend({ fadeTo: function fadeTo(e, t, n, r) {
      return this.filter(Gt).css("opacity", 0).show().end().animate({ opacity: t }, e, n, r);
    }, animate: function animate(e, t, n, r) {
      var i = v.isEmptyObject(e),
          s = v.speed(t, n, r),
          o = function o() {
        var t = Kn(this, v.extend({}, e), s);i && t.stop(!0);
      };return i || s.queue === !1 ? this.each(o) : this.queue(s.queue, o);
    }, stop: function stop(e, n, r) {
      var i = function i(e) {
        var t = e.stop;delete e.stop, t(r);
      };return typeof e != "string" && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function () {
        var t = !0,
            n = e != null && e + "queueHooks",
            s = v.timers,
            o = v._data(this);if (n) o[n] && o[n].stop && i(o[n]);else for (n in o) {
          o[n] && o[n].stop && Wn.test(n) && i(o[n]);
        }for (n = s.length; n--;) {
          s[n].elem === this && (e == null || s[n].queue === e) && (s[n].anim.stop(r), t = !1, s.splice(n, 1));
        }(t || !r) && v.dequeue(this, e);
      });
    } }), v.each({ slideDown: Zn("show"), slideUp: Zn("hide"), slideToggle: Zn("toggle"), fadeIn: { opacity: "show" }, fadeOut: { opacity: "hide" }, fadeToggle: { opacity: "toggle" } }, function (e, t) {
    v.fn[e] = function (e, n, r) {
      return this.animate(t, e, n, r);
    };
  }), v.speed = function (e, t, n) {
    var r = e && (typeof e === "undefined" ? "undefined" : _typeof(e)) == "object" ? v.extend({}, e) : { complete: n || !n && t || v.isFunction(e) && e, duration: e, easing: n && t || t && !v.isFunction(t) && t };r.duration = v.fx.off ? 0 : typeof r.duration == "number" ? r.duration : r.duration in v.fx.speeds ? v.fx.speeds[r.duration] : v.fx.speeds._default;if (r.queue == null || r.queue === !0) r.queue = "fx";return r.old = r.complete, r.complete = function () {
      v.isFunction(r.old) && r.old.call(this), r.queue && v.dequeue(this, r.queue);
    }, r;
  }, v.easing = { linear: function linear(e) {
      return e;
    }, swing: function swing(e) {
      return .5 - Math.cos(e * Math.PI) / 2;
    } }, v.timers = [], v.fx = Yn.prototype.init, v.fx.tick = function () {
    var e,
        n = v.timers,
        r = 0;qn = v.now();for (; r < n.length; r++) {
      e = n[r], !e() && n[r] === e && n.splice(r--, 1);
    }n.length || v.fx.stop(), qn = t;
  }, v.fx.timer = function (e) {
    e() && v.timers.push(e) && !Rn && (Rn = setInterval(v.fx.tick, v.fx.interval));
  }, v.fx.interval = 13, v.fx.stop = function () {
    clearInterval(Rn), Rn = null;
  }, v.fx.speeds = { slow: 600, fast: 200, _default: 400 }, v.fx.step = {}, v.expr && v.expr.filters && (v.expr.filters.animated = function (e) {
    return v.grep(v.timers, function (t) {
      return e === t.elem;
    }).length;
  });var er = /^(?:body|html)$/i;v.fn.offset = function (e) {
    if (arguments.length) return e === t ? this : this.each(function (t) {
      v.offset.setOffset(this, e, t);
    });var n,
        r,
        i,
        s,
        o,
        u,
        a,
        f = { top: 0, left: 0 },
        l = this[0],
        c = l && l.ownerDocument;if (!c) return;return (r = c.body) === l ? v.offset.bodyOffset(l) : (n = c.documentElement, v.contains(n, l) ? (typeof l.getBoundingClientRect != "undefined" && (f = l.getBoundingClientRect()), i = tr(c), s = n.clientTop || r.clientTop || 0, o = n.clientLeft || r.clientLeft || 0, u = i.pageYOffset || n.scrollTop, a = i.pageXOffset || n.scrollLeft, { top: f.top + u - s, left: f.left + a - o }) : f);
  }, v.offset = { bodyOffset: function bodyOffset(e) {
      var t = e.offsetTop,
          n = e.offsetLeft;return v.support.doesNotIncludeMarginInBodyOffset && (t += parseFloat(v.css(e, "marginTop")) || 0, n += parseFloat(v.css(e, "marginLeft")) || 0), { top: t, left: n };
    }, setOffset: function setOffset(e, t, n) {
      var r = v.css(e, "position");r === "static" && (e.style.position = "relative");var i = v(e),
          s = i.offset(),
          o = v.css(e, "top"),
          u = v.css(e, "left"),
          a = (r === "absolute" || r === "fixed") && v.inArray("auto", [o, u]) > -1,
          f = {},
          l = {},
          c,
          h;a ? (l = i.position(), c = l.top, h = l.left) : (c = parseFloat(o) || 0, h = parseFloat(u) || 0), v.isFunction(t) && (t = t.call(e, n, s)), t.top != null && (f.top = t.top - s.top + c), t.left != null && (f.left = t.left - s.left + h), "using" in t ? t.using.call(e, f) : i.css(f);
    } }, v.fn.extend({ position: function position() {
      if (!this[0]) return;var e = this[0],
          t = this.offsetParent(),
          n = this.offset(),
          r = er.test(t[0].nodeName) ? { top: 0, left: 0 } : t.offset();return n.top -= parseFloat(v.css(e, "marginTop")) || 0, n.left -= parseFloat(v.css(e, "marginLeft")) || 0, r.top += parseFloat(v.css(t[0], "borderTopWidth")) || 0, r.left += parseFloat(v.css(t[0], "borderLeftWidth")) || 0, { top: n.top - r.top, left: n.left - r.left };
    }, offsetParent: function offsetParent() {
      return this.map(function () {
        var e = this.offsetParent || i.body;while (e && !er.test(e.nodeName) && v.css(e, "position") === "static") {
          e = e.offsetParent;
        }return e || i.body;
      });
    } }), v.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function (e, n) {
    var r = /Y/.test(n);v.fn[e] = function (i) {
      return v.access(this, function (e, i, s) {
        var o = tr(e);if (s === t) return o ? n in o ? o[n] : o.document.documentElement[i] : e[i];o ? o.scrollTo(r ? v(o).scrollLeft() : s, r ? s : v(o).scrollTop()) : e[i] = s;
      }, e, i, arguments.length, null);
    };
  }), v.each({ Height: "height", Width: "width" }, function (e, n) {
    v.each({ padding: "inner" + e, content: n, "": "outer" + e }, function (r, i) {
      v.fn[i] = function (i, s) {
        var o = arguments.length && (r || typeof i != "boolean"),
            u = r || (i === !0 || s === !0 ? "margin" : "border");return v.access(this, function (n, r, i) {
          var s;return v.isWindow(n) ? n.document.documentElement["client" + e] : n.nodeType === 9 ? (s = n.documentElement, Math.max(n.body["scroll" + e], s["scroll" + e], n.body["offset" + e], s["offset" + e], s["client" + e])) : i === t ? v.css(n, r, i, u) : v.style(n, r, i, u);
        }, n, o ? i : t, o, null);
      };
    });
  }), e.jQuery = e.$ = v, "function" == "function" && __webpack_require__("./node_modules/webpack/buildin/amd-options.js") && __webpack_require__("./node_modules/webpack/buildin/amd-options.js").jQuery && !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = function () {
    return v;
  }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
})(window);

/***/ }),

/***/ "./resources/assets/js/jquery.easing.min.js":
/***/ (function(module, exports) {

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright �� 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

jQuery.easing.jswing = jQuery.easing.swing;jQuery.extend(jQuery.easing, { def: "easeOutQuad", swing: function swing(e, f, a, h, g) {
    return jQuery.easing[jQuery.easing.def](e, f, a, h, g);
  }, easeInQuad: function easeInQuad(e, f, a, h, g) {
    return h * (f /= g) * f + a;
  }, easeOutQuad: function easeOutQuad(e, f, a, h, g) {
    return -h * (f /= g) * (f - 2) + a;
  }, easeInOutQuad: function easeInOutQuad(e, f, a, h, g) {
    if ((f /= g / 2) < 1) {
      return h / 2 * f * f + a;
    }return -h / 2 * (--f * (f - 2) - 1) + a;
  }, easeInCubic: function easeInCubic(e, f, a, h, g) {
    return h * (f /= g) * f * f + a;
  }, easeOutCubic: function easeOutCubic(e, f, a, h, g) {
    return h * ((f = f / g - 1) * f * f + 1) + a;
  }, easeInOutCubic: function easeInOutCubic(e, f, a, h, g) {
    if ((f /= g / 2) < 1) {
      return h / 2 * f * f * f + a;
    }return h / 2 * ((f -= 2) * f * f + 2) + a;
  }, easeInQuart: function easeInQuart(e, f, a, h, g) {
    return h * (f /= g) * f * f * f + a;
  }, easeOutQuart: function easeOutQuart(e, f, a, h, g) {
    return -h * ((f = f / g - 1) * f * f * f - 1) + a;
  }, easeInOutQuart: function easeInOutQuart(e, f, a, h, g) {
    if ((f /= g / 2) < 1) {
      return h / 2 * f * f * f * f + a;
    }return -h / 2 * ((f -= 2) * f * f * f - 2) + a;
  }, easeInQuint: function easeInQuint(e, f, a, h, g) {
    return h * (f /= g) * f * f * f * f + a;
  }, easeOutQuint: function easeOutQuint(e, f, a, h, g) {
    return h * ((f = f / g - 1) * f * f * f * f + 1) + a;
  }, easeInOutQuint: function easeInOutQuint(e, f, a, h, g) {
    if ((f /= g / 2) < 1) {
      return h / 2 * f * f * f * f * f + a;
    }return h / 2 * ((f -= 2) * f * f * f * f + 2) + a;
  }, easeInSine: function easeInSine(e, f, a, h, g) {
    return -h * Math.cos(f / g * (Math.PI / 2)) + h + a;
  }, easeOutSine: function easeOutSine(e, f, a, h, g) {
    return h * Math.sin(f / g * (Math.PI / 2)) + a;
  }, easeInOutSine: function easeInOutSine(e, f, a, h, g) {
    return -h / 2 * (Math.cos(Math.PI * f / g) - 1) + a;
  }, easeInExpo: function easeInExpo(e, f, a, h, g) {
    return f == 0 ? a : h * Math.pow(2, 10 * (f / g - 1)) + a;
  }, easeOutExpo: function easeOutExpo(e, f, a, h, g) {
    return f == g ? a + h : h * (-Math.pow(2, -10 * f / g) + 1) + a;
  }, easeInOutExpo: function easeInOutExpo(e, f, a, h, g) {
    if (f == 0) {
      return a;
    }if (f == g) {
      return a + h;
    }if ((f /= g / 2) < 1) {
      return h / 2 * Math.pow(2, 10 * (f - 1)) + a;
    }return h / 2 * (-Math.pow(2, -10 * --f) + 2) + a;
  }, easeInCirc: function easeInCirc(e, f, a, h, g) {
    return -h * (Math.sqrt(1 - (f /= g) * f) - 1) + a;
  }, easeOutCirc: function easeOutCirc(e, f, a, h, g) {
    return h * Math.sqrt(1 - (f = f / g - 1) * f) + a;
  }, easeInOutCirc: function easeInOutCirc(e, f, a, h, g) {
    if ((f /= g / 2) < 1) {
      return -h / 2 * (Math.sqrt(1 - f * f) - 1) + a;
    }return h / 2 * (Math.sqrt(1 - (f -= 2) * f) + 1) + a;
  }, easeInElastic: function easeInElastic(f, h, e, l, k) {
    var i = 1.70158;var j = 0;var g = l;if (h == 0) {
      return e;
    }if ((h /= k) == 1) {
      return e + l;
    }if (!j) {
      j = k * 0.3;
    }if (g < Math.abs(l)) {
      g = l;var i = j / 4;
    } else {
      var i = j / (2 * Math.PI) * Math.asin(l / g);
    }return -(g * Math.pow(2, 10 * (h -= 1)) * Math.sin((h * k - i) * (2 * Math.PI) / j)) + e;
  }, easeOutElastic: function easeOutElastic(f, h, e, l, k) {
    var i = 1.70158;var j = 0;var g = l;if (h == 0) {
      return e;
    }if ((h /= k) == 1) {
      return e + l;
    }if (!j) {
      j = k * 0.3;
    }if (g < Math.abs(l)) {
      g = l;var i = j / 4;
    } else {
      var i = j / (2 * Math.PI) * Math.asin(l / g);
    }return g * Math.pow(2, -10 * h) * Math.sin((h * k - i) * (2 * Math.PI) / j) + l + e;
  }, easeInOutElastic: function easeInOutElastic(f, h, e, l, k) {
    var i = 1.70158;var j = 0;var g = l;if (h == 0) {
      return e;
    }if ((h /= k / 2) == 2) {
      return e + l;
    }if (!j) {
      j = k * (0.3 * 1.5);
    }if (g < Math.abs(l)) {
      g = l;var i = j / 4;
    } else {
      var i = j / (2 * Math.PI) * Math.asin(l / g);
    }if (h < 1) {
      return -0.5 * (g * Math.pow(2, 10 * (h -= 1)) * Math.sin((h * k - i) * (2 * Math.PI) / j)) + e;
    }return g * Math.pow(2, -10 * (h -= 1)) * Math.sin((h * k - i) * (2 * Math.PI) / j) * 0.5 + l + e;
  }, easeInBack: function easeInBack(e, f, a, i, h, g) {
    if (g == undefined) {
      g = 1.70158;
    }return i * (f /= h) * f * ((g + 1) * f - g) + a;
  }, easeOutBack: function easeOutBack(e, f, a, i, h, g) {
    if (g == undefined) {
      g = 1.70158;
    }return i * ((f = f / h - 1) * f * ((g + 1) * f + g) + 1) + a;
  }, easeInOutBack: function easeInOutBack(e, f, a, i, h, g) {
    if (g == undefined) {
      g = 1.70158;
    }if ((f /= h / 2) < 1) {
      return i / 2 * (f * f * (((g *= 1.525) + 1) * f - g)) + a;
    }return i / 2 * ((f -= 2) * f * (((g *= 1.525) + 1) * f + g) + 2) + a;
  }, easeInBounce: function easeInBounce(e, f, a, h, g) {
    return h - jQuery.easing.easeOutBounce(e, g - f, 0, h, g) + a;
  }, easeOutBounce: function easeOutBounce(e, f, a, h, g) {
    if ((f /= g) < 1 / 2.75) {
      return h * (7.5625 * f * f) + a;
    } else {
      if (f < 2 / 2.75) {
        return h * (7.5625 * (f -= 1.5 / 2.75) * f + 0.75) + a;
      } else {
        if (f < 2.5 / 2.75) {
          return h * (7.5625 * (f -= 2.25 / 2.75) * f + 0.9375) + a;
        } else {
          return h * (7.5625 * (f -= 2.625 / 2.75) * f + 0.984375) + a;
        }
      }
    }
  }, easeInOutBounce: function easeInOutBounce(e, f, a, h, g) {
    if (f < g / 2) {
      return jQuery.easing.easeInBounce(e, f * 2, 0, h, g) * 0.5 + a;
    }return jQuery.easing.easeOutBounce(e, f * 2 - g, 0, h, g) * 0.5 + h * 0.5 + a;
  } });

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright �� 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */

/***/ }),

/***/ "./resources/assets/js/jquery.flexslider.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*
 * jQuery FlexSlider v2.1
 * http://www.woothemes.com/flexslider/
 *
 * Copyright 2012 WooThemes
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Contributing author: Tyler Smith (@mbmufffin)
 */

;(function ($) {

  //FlexSlider: Object Instance
  $.flexslider = function (el, options) {
    var slider = $(el),
        vars = $.extend({}, $.flexslider.defaults, options),
        namespace = vars.namespace,
        touch = "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch,
        eventType = touch ? "touchend" : "click",
        vertical = vars.direction === "vertical",
        reverse = vars.reverse,
        carousel = vars.itemWidth > 0,
        fade = vars.animation === "fade",
        asNav = vars.asNavFor !== "",
        methods = {};

    // Store a reference to the slider object
    $.data(el, "flexslider", slider);

    // Privat slider methods
    methods = {
      init: function init() {
        slider.animating = false;
        slider.currentSlide = vars.startAt;
        slider.animatingTo = slider.currentSlide;
        slider.atEnd = slider.currentSlide === 0 || slider.currentSlide === slider.last;
        slider.containerSelector = vars.selector.substr(0, vars.selector.search(' '));
        slider.slides = $(vars.selector, slider);
        slider.container = $(slider.containerSelector, slider);
        slider.count = slider.slides.length;
        // SYNC:
        slider.syncExists = $(vars.sync).length > 0;
        // SLIDE:
        if (vars.animation === "slide") vars.animation = "swing";
        slider.prop = vertical ? "top" : "marginLeft";
        slider.args = {};
        // SLIDESHOW:
        slider.manualPause = false;
        // TOUCH/USECSS:
        slider.transitions = !vars.video && !fade && vars.useCSS && function () {
          var obj = document.createElement('div'),
              props = ['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
          for (var i in props) {
            if (obj.style[props[i]] !== undefined) {
              slider.pfx = props[i].replace('Perspective', '').toLowerCase();
              slider.prop = "-" + slider.pfx + "-transform";
              return true;
            }
          }
          return false;
        }();
        // CONTROLSCONTAINER:
        if (vars.controlsContainer !== "") slider.controlsContainer = $(vars.controlsContainer).length > 0 && $(vars.controlsContainer);
        // MANUAL:
        if (vars.manualControls !== "") slider.manualControls = $(vars.manualControls).length > 0 && $(vars.manualControls);

        // RANDOMIZE:
        if (vars.randomize) {
          slider.slides.sort(function () {
            return Math.round(Math.random()) - 0.5;
          });
          slider.container.empty().append(slider.slides);
        }

        slider.doMath();

        // ASNAV:
        if (asNav) methods.asNav.setup();

        // INIT
        slider.setup("init");

        // CONTROLNAV:
        if (vars.controlNav) methods.controlNav.setup();

        // DIRECTIONNAV:
        if (vars.directionNav) methods.directionNav.setup();

        // KEYBOARD:
        if (vars.keyboard && ($(slider.containerSelector).length === 1 || vars.multipleKeyboard)) {
          $(document).bind('keyup', function (event) {
            var keycode = event.keyCode;
            if (!slider.animating && (keycode === 39 || keycode === 37)) {
              var target = keycode === 39 ? slider.getTarget('next') : keycode === 37 ? slider.getTarget('prev') : false;
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
        }
        // MOUSEWHEEL:
        if (vars.mousewheel) {
          slider.bind('mousewheel', function (event, delta, deltaX, deltaY) {
            event.preventDefault();
            var target = delta < 0 ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
        }

        // PAUSEPLAY
        if (vars.pausePlay) methods.pausePlay.setup();

        // SLIDSESHOW
        if (vars.slideshow) {
          if (vars.pauseOnHover) {
            slider.hover(function () {
              if (!slider.manualPlay && !slider.manualPause) slider.pause();
            }, function () {
              if (!slider.manualPause && !slider.manualPlay) slider.play();
            });
          }
          // initialize animation
          vars.initDelay > 0 ? setTimeout(slider.play, vars.initDelay) : slider.play();
        }

        // TOUCH
        if (touch && vars.touch) methods.touch();

        // FADE&&SMOOTHHEIGHT || SLIDE:
        if (!fade || fade && vars.smoothHeight) $(window).bind("resize focus", methods.resize);

        // API: start() Callback
        setTimeout(function () {
          vars.start(slider);
        }, 200);
      },
      asNav: {
        setup: function setup() {
          slider.asNav = true;
          slider.animatingTo = Math.floor(slider.currentSlide / slider.move);
          slider.currentItem = slider.currentSlide;
          slider.slides.removeClass(namespace + "active-slide").eq(slider.currentItem).addClass(namespace + "active-slide");
          slider.slides.click(function (e) {
            e.preventDefault();
            var $slide = $(this),
                target = $slide.index();
            if (!$(vars.asNavFor).data('flexslider').animating && !$slide.hasClass('active')) {
              slider.direction = slider.currentItem < target ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction, false, true, true);
            }
          });
        }
      },
      controlNav: {
        setup: function setup() {
          if (!slider.manualControls) {
            methods.controlNav.setupPaging();
          } else {
            // MANUALCONTROLS:
            methods.controlNav.setupManual();
          }
        },
        setupPaging: function setupPaging() {
          var type = vars.controlNav === "thumbnails" ? 'control-thumbs' : 'control-paging',
              j = 1,
              item;

          slider.controlNavScaffold = $('<ol class="' + namespace + 'control-nav ' + namespace + type + '"></ol>');

          if (slider.pagingCount > 1) {
            for (var i = 0; i < slider.pagingCount; i++) {
              item = vars.controlNav === "thumbnails" ? '<img src="' + slider.slides.eq(i).attr("data-thumb") + '"/>' : '<a>' + j + '</a>';
              slider.controlNavScaffold.append('<li>' + item + '</li>');
              j++;
            }
          }

          // CONTROLSCONTAINER:
          slider.controlsContainer ? $(slider.controlsContainer).append(slider.controlNavScaffold) : slider.append(slider.controlNavScaffold);
          methods.controlNav.set();

          methods.controlNav.active();

          slider.controlNavScaffold.delegate('a, img', eventType, function (event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);

            if (!$this.hasClass(namespace + 'active')) {
              slider.direction = target > slider.currentSlide ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNavScaffold.delegate('a', "click touchstart", function (event) {
              event.preventDefault();
            });
          }
        },
        setupManual: function setupManual() {
          slider.controlNav = slider.manualControls;
          methods.controlNav.active();

          slider.controlNav.live(eventType, function (event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);

            if (!$this.hasClass(namespace + 'active')) {
              target > slider.currentSlide ? slider.direction = "next" : slider.direction = "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNav.live("click touchstart", function (event) {
              event.preventDefault();
            });
          }
        },
        set: function set() {
          var selector = vars.controlNav === "thumbnails" ? 'img' : 'a';
          slider.controlNav = $('.' + namespace + 'control-nav li ' + selector, slider.controlsContainer ? slider.controlsContainer : slider);
        },
        active: function active() {
          slider.controlNav.removeClass(namespace + "active").eq(slider.animatingTo).addClass(namespace + "active");
        },
        update: function update(action, pos) {
          if (slider.pagingCount > 1 && action === "add") {
            slider.controlNavScaffold.append($('<li><a>' + slider.count + '</a></li>'));
          } else if (slider.pagingCount === 1) {
            slider.controlNavScaffold.find('li').remove();
          } else {
            slider.controlNav.eq(pos).closest('li').remove();
          }
          methods.controlNav.set();
          slider.pagingCount > 1 && slider.pagingCount !== slider.controlNav.length ? slider.update(pos, action) : methods.controlNav.active();
        }
      },
      directionNav: {
        setup: function setup() {
          var directionNavScaffold = $('<ul class="' + namespace + 'direction-nav"><li><a class="' + namespace + 'prev" href="#">' + vars.prevText + '</a></li><li><a class="' + namespace + 'next" href="#">' + vars.nextText + '</a></li></ul>');

          // CONTROLSCONTAINER:
          if (slider.controlsContainer) {
            $(slider.controlsContainer).append(directionNavScaffold);
            slider.directionNav = $('.' + namespace + 'direction-nav li a', slider.controlsContainer);
          } else {
            slider.append(directionNavScaffold);
            slider.directionNav = $('.' + namespace + 'direction-nav li a', slider);
          }

          methods.directionNav.update();

          slider.directionNav.bind(eventType, function (event) {
            event.preventDefault();
            var target = $(this).hasClass(namespace + 'next') ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.directionNav.bind("click touchstart", function (event) {
              event.preventDefault();
            });
          }
        },
        update: function update() {
          var disabledClass = namespace + 'disabled';
          if (slider.pagingCount === 1) {
            slider.directionNav.addClass(disabledClass);
          } else if (!vars.animationLoop) {
            if (slider.animatingTo === 0) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "prev").addClass(disabledClass);
            } else if (slider.animatingTo === slider.last) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "next").addClass(disabledClass);
            } else {
              slider.directionNav.removeClass(disabledClass);
            }
          } else {
            slider.directionNav.removeClass(disabledClass);
          }
        }
      },
      pausePlay: {
        setup: function setup() {
          var pausePlayScaffold = $('<div class="' + namespace + 'pauseplay"><a></a></div>');

          // CONTROLSCONTAINER:
          if (slider.controlsContainer) {
            slider.controlsContainer.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider.controlsContainer);
          } else {
            slider.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider);
          }

          methods.pausePlay.update(vars.slideshow ? namespace + 'pause' : namespace + 'play');

          slider.pausePlay.bind(eventType, function (event) {
            event.preventDefault();
            if ($(this).hasClass(namespace + 'pause')) {
              slider.manualPause = true;
              slider.manualPlay = false;
              slider.pause();
            } else {
              slider.manualPause = false;
              slider.manualPlay = true;
              slider.play();
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.pausePlay.bind("click touchstart", function (event) {
              event.preventDefault();
            });
          }
        },
        update: function update(state) {
          state === "play" ? slider.pausePlay.removeClass(namespace + 'pause').addClass(namespace + 'play').text(vars.playText) : slider.pausePlay.removeClass(namespace + 'play').addClass(namespace + 'pause').text(vars.pauseText);
        }
      },
      touch: function touch() {
        var startX,
            startY,
            offset,
            cwidth,
            dx,
            startT,
            scrolling = false;

        el.addEventListener('touchstart', onTouchStart, false);
        function onTouchStart(e) {
          if (slider.animating) {
            e.preventDefault();
          } else if (e.touches.length === 1) {
            slider.pause();
            // CAROUSEL:
            cwidth = vertical ? slider.h : slider.w;
            startT = Number(new Date());
            // CAROUSEL:
            offset = carousel && reverse && slider.animatingTo === slider.last ? 0 : carousel && reverse ? slider.limit - (slider.itemW + vars.itemMargin) * slider.move * slider.animatingTo : carousel && slider.currentSlide === slider.last ? slider.limit : carousel ? (slider.itemW + vars.itemMargin) * slider.move * slider.currentSlide : reverse ? (slider.last - slider.currentSlide + slider.cloneOffset) * cwidth : (slider.currentSlide + slider.cloneOffset) * cwidth;
            startX = vertical ? e.touches[0].pageY : e.touches[0].pageX;
            startY = vertical ? e.touches[0].pageX : e.touches[0].pageY;

            el.addEventListener('touchmove', onTouchMove, false);
            el.addEventListener('touchend', onTouchEnd, false);
          }
        }

        function onTouchMove(e) {
          dx = vertical ? startX - e.touches[0].pageY : startX - e.touches[0].pageX;
          scrolling = vertical ? Math.abs(dx) < Math.abs(e.touches[0].pageX - startY) : Math.abs(dx) < Math.abs(e.touches[0].pageY - startY);

          if (!scrolling || Number(new Date()) - startT > 500) {
            e.preventDefault();
            if (!fade && slider.transitions) {
              if (!vars.animationLoop) {
                dx = dx / (slider.currentSlide === 0 && dx < 0 || slider.currentSlide === slider.last && dx > 0 ? Math.abs(dx) / cwidth + 2 : 1);
              }
              slider.setProps(offset + dx, "setTouch");
            }
          }
        }

        function onTouchEnd(e) {
          // finish the touch by undoing the touch session
          el.removeEventListener('touchmove', onTouchMove, false);

          if (slider.animatingTo === slider.currentSlide && !scrolling && !(dx === null)) {
            var updateDx = reverse ? -dx : dx,
                target = updateDx > 0 ? slider.getTarget('next') : slider.getTarget('prev');

            if (slider.canAdvance(target) && (Number(new Date()) - startT < 550 && Math.abs(updateDx) > 50 || Math.abs(updateDx) > cwidth / 2)) {
              slider.flexAnimate(target, vars.pauseOnAction);
            } else {
              if (!fade) slider.flexAnimate(slider.currentSlide, vars.pauseOnAction, true);
            }
          }
          el.removeEventListener('touchend', onTouchEnd, false);
          startX = null;
          startY = null;
          dx = null;
          offset = null;
        }
      },
      resize: function resize() {
        if (!slider.animating && slider.is(':visible')) {
          if (!carousel) slider.doMath();

          if (fade) {
            // SMOOTH HEIGHT:
            methods.smoothHeight();
          } else if (carousel) {
            //CAROUSEL:
            slider.slides.width(slider.computedW);
            slider.update(slider.pagingCount);
            slider.setProps();
          } else if (vertical) {
            //VERTICAL:
            slider.viewport.height(slider.h);
            slider.setProps(slider.h, "setTotal");
          } else {
            // SMOOTH HEIGHT:
            if (vars.smoothHeight) methods.smoothHeight();
            slider.newSlides.width(slider.computedW);
            slider.setProps(slider.computedW, "setTotal");
          }
        }
      },
      smoothHeight: function smoothHeight(dur) {
        if (!vertical || fade) {
          var $obj = fade ? slider : slider.viewport;
          dur ? $obj.animate({ "height": slider.slides.eq(slider.animatingTo).height() }, dur) : $obj.height(slider.slides.eq(slider.animatingTo).height());
        }
      },
      sync: function sync(action) {
        var $obj = $(vars.sync).data("flexslider"),
            target = slider.animatingTo;

        switch (action) {
          case "animate":
            $obj.flexAnimate(target, vars.pauseOnAction, false, true);break;
          case "play":
            if (!$obj.playing && !$obj.asNav) {
              $obj.play();
            }break;
          case "pause":
            $obj.pause();break;
        }
      }

      // public methods
    };slider.flexAnimate = function (target, pause, override, withSync, fromNav) {

      if (asNav && slider.pagingCount === 1) slider.direction = slider.currentItem < target ? "next" : "prev";

      if (!slider.animating && (slider.canAdvance(target, fromNav) || override) && slider.is(":visible")) {
        if (asNav && withSync) {
          var master = $(vars.asNavFor).data('flexslider');
          slider.atEnd = target === 0 || target === slider.count - 1;
          master.flexAnimate(target, true, false, true, fromNav);
          slider.direction = slider.currentItem < target ? "next" : "prev";
          master.direction = slider.direction;

          if (Math.ceil((target + 1) / slider.visible) - 1 !== slider.currentSlide && target !== 0) {
            slider.currentItem = target;
            slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide");
            target = Math.floor(target / slider.visible);
          } else {
            slider.currentItem = target;
            slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide");
            return false;
          }
        }

        slider.animating = true;
        slider.animatingTo = target;
        // API: before() animation Callback
        vars.before(slider);

        // SLIDESHOW:
        if (pause) slider.pause();

        // SYNC:
        if (slider.syncExists && !fromNav) methods.sync("animate");

        // CONTROLNAV
        if (vars.controlNav) methods.controlNav.active();

        // !CAROUSEL:
        // CANDIDATE: slide active class (for add/remove slide)
        if (!carousel) slider.slides.removeClass(namespace + 'active-slide').eq(target).addClass(namespace + 'active-slide');

        // INFINITE LOOP:
        // CANDIDATE: atEnd
        slider.atEnd = target === 0 || target === slider.last;

        // DIRECTIONNAV:
        if (vars.directionNav) methods.directionNav.update();

        if (target === slider.last) {
          // API: end() of cycle Callback
          vars.end(slider);
          // SLIDESHOW && !INFINITE LOOP:
          if (!vars.animationLoop) slider.pause();
        }

        // SLIDE:
        if (!fade) {
          var dimension = vertical ? slider.slides.filter(':first').height() : slider.computedW,
              margin,
              slideString,
              calcNext;

          // INFINITE LOOP / REVERSE:
          if (carousel) {
            margin = vars.itemWidth > slider.w ? vars.itemMargin * 2 : vars.itemMargin;
            calcNext = (slider.itemW + margin) * slider.move * slider.animatingTo;
            slideString = calcNext > slider.limit && slider.visible !== 1 ? slider.limit : calcNext;
          } else if (slider.currentSlide === 0 && target === slider.count - 1 && vars.animationLoop && slider.direction !== "next") {
            slideString = reverse ? (slider.count + slider.cloneOffset) * dimension : 0;
          } else if (slider.currentSlide === slider.last && target === 0 && vars.animationLoop && slider.direction !== "prev") {
            slideString = reverse ? 0 : (slider.count + 1) * dimension;
          } else {
            slideString = reverse ? (slider.count - 1 - target + slider.cloneOffset) * dimension : (target + slider.cloneOffset) * dimension;
          }
          slider.setProps(slideString, "", vars.animationSpeed);
          if (slider.transitions) {
            if (!vars.animationLoop || !slider.atEnd) {
              slider.animating = false;
              slider.currentSlide = slider.animatingTo;
            }
            slider.container.unbind("webkitTransitionEnd transitionend");
            slider.container.bind("webkitTransitionEnd transitionend", function () {
              slider.wrapup(dimension);
            });
          } else {
            slider.container.animate(slider.args, vars.animationSpeed, vars.easing, function () {
              slider.wrapup(dimension);
            });
          }
        } else {
          // FADE:
          if (!touch) {
            slider.slides.eq(slider.currentSlide).fadeOut(vars.animationSpeed, vars.easing);
            slider.slides.eq(target).fadeIn(vars.animationSpeed, vars.easing, slider.wrapup);
          } else {
            slider.slides.eq(slider.currentSlide).css({ "opacity": 0, "zIndex": 1 });
            slider.slides.eq(target).css({ "opacity": 1, "zIndex": 2 });

            slider.slides.unbind("webkitTransitionEnd transitionend");
            slider.slides.eq(slider.currentSlide).bind("webkitTransitionEnd transitionend", function () {
              // API: after() animation Callback
              vars.after(slider);
            });

            slider.animating = false;
            slider.currentSlide = slider.animatingTo;
          }
        }
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight(vars.animationSpeed);
      }
    };
    slider.wrapup = function (dimension) {
      // SLIDE:
      if (!fade && !carousel) {
        if (slider.currentSlide === 0 && slider.animatingTo === slider.last && vars.animationLoop) {
          slider.setProps(dimension, "jumpEnd");
        } else if (slider.currentSlide === slider.last && slider.animatingTo === 0 && vars.animationLoop) {
          slider.setProps(dimension, "jumpStart");
        }
      }
      slider.animating = false;
      slider.currentSlide = slider.animatingTo;
      // API: after() animation Callback
      vars.after(slider);
    };

    // SLIDESHOW:
    slider.animateSlides = function () {
      if (!slider.animating) slider.flexAnimate(slider.getTarget("next"));
    };
    // SLIDESHOW:
    slider.pause = function () {
      clearInterval(slider.animatedSlides);
      slider.playing = false;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("play");
      // SYNC:
      if (slider.syncExists) methods.sync("pause");
    };
    // SLIDESHOW:
    slider.play = function () {
      slider.animatedSlides = setInterval(slider.animateSlides, vars.slideshowSpeed);
      slider.playing = true;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("pause");
      // SYNC:
      if (slider.syncExists) methods.sync("play");
    };
    slider.canAdvance = function (target, fromNav) {
      // ASNAV:
      var last = asNav ? slider.pagingCount - 1 : slider.last;
      return fromNav ? true : asNav && slider.currentItem === slider.count - 1 && target === 0 && slider.direction === "prev" ? true : asNav && slider.currentItem === 0 && target === slider.pagingCount - 1 && slider.direction !== "next" ? false : target === slider.currentSlide && !asNav ? false : vars.animationLoop ? true : slider.atEnd && slider.currentSlide === 0 && target === last && slider.direction !== "next" ? false : slider.atEnd && slider.currentSlide === last && target === 0 && slider.direction === "next" ? false : true;
    };
    slider.getTarget = function (dir) {
      slider.direction = dir;
      if (dir === "next") {
        return slider.currentSlide === slider.last ? 0 : slider.currentSlide + 1;
      } else {
        return slider.currentSlide === 0 ? slider.last : slider.currentSlide - 1;
      }
    };

    // SLIDE:
    slider.setProps = function (pos, special, dur) {
      var target = function () {
        var posCheck = pos ? pos : (slider.itemW + vars.itemMargin) * slider.move * slider.animatingTo,
            posCalc = function () {
          if (carousel) {
            return special === "setTouch" ? pos : reverse && slider.animatingTo === slider.last ? 0 : reverse ? slider.limit - (slider.itemW + vars.itemMargin) * slider.move * slider.animatingTo : slider.animatingTo === slider.last ? slider.limit : posCheck;
          } else {
            switch (special) {
              case "setTotal":
                return reverse ? (slider.count - 1 - slider.currentSlide + slider.cloneOffset) * pos : (slider.currentSlide + slider.cloneOffset) * pos;
              case "setTouch":
                return reverse ? pos : pos;
              case "jumpEnd":
                return reverse ? pos : slider.count * pos;
              case "jumpStart":
                return reverse ? slider.count * pos : pos;
              default:
                return pos;
            }
          }
        }();
        return posCalc * -1 + "px";
      }();

      if (slider.transitions) {
        target = vertical ? "translate3d(0," + target + ",0)" : "translate3d(" + target + ",0,0)";
        dur = dur !== undefined ? dur / 1000 + "s" : "0s";
        slider.container.css("-" + slider.pfx + "-transition-duration", dur);
      }

      slider.args[slider.prop] = target;
      if (slider.transitions || dur === undefined) slider.container.css(slider.args);
    };

    slider.setup = function (type) {
      // SLIDE:
      if (!fade) {
        var sliderOffset, arr;

        if (type === "init") {
          slider.viewport = $('<div class="' + namespace + 'viewport"></div>').css({ "overflow": "hidden", "position": "relative" }).appendTo(slider).append(slider.container);
          // INFINITE LOOP:
          slider.cloneCount = 0;
          slider.cloneOffset = 0;
          // REVERSE:
          if (reverse) {
            arr = $.makeArray(slider.slides).reverse();
            slider.slides = $(arr);
            slider.container.empty().append(slider.slides);
          }
        }
        // INFINITE LOOP && !CAROUSEL:
        if (vars.animationLoop && !carousel) {
          slider.cloneCount = 2;
          slider.cloneOffset = 1;
          // clear out old clones
          if (type !== "init") slider.container.find('.clone').remove();
          slider.container.append(slider.slides.first().clone().addClass('clone')).prepend(slider.slides.last().clone().addClass('clone'));
        }
        slider.newSlides = $(vars.selector, slider);

        sliderOffset = reverse ? slider.count - 1 - slider.currentSlide + slider.cloneOffset : slider.currentSlide + slider.cloneOffset;
        // VERTICAL:
        if (vertical && !carousel) {
          slider.container.height((slider.count + slider.cloneCount) * 200 + "%").css("position", "absolute").width("100%");
          setTimeout(function () {
            slider.newSlides.css({ "display": "block" });
            slider.doMath();
            slider.viewport.height(slider.h);
            slider.setProps(sliderOffset * slider.h, "init");
          }, type === "init" ? 100 : 0);
        } else {
          slider.container.width((slider.count + slider.cloneCount) * 200 + "%");
          slider.setProps(sliderOffset * slider.computedW, "init");
          setTimeout(function () {
            slider.doMath();
            slider.newSlides.css({ "width": slider.computedW, "float": "left", "display": "block" });
            // SMOOTH HEIGHT:
            if (vars.smoothHeight) methods.smoothHeight();
          }, type === "init" ? 100 : 0);
        }
      } else {
        // FADE:
        slider.slides.css({ "width": "100%", "float": "left", "marginRight": "-100%", "position": "relative" });
        if (type === "init") {
          if (!touch) {
            slider.slides.eq(slider.currentSlide).fadeIn(vars.animationSpeed, vars.easing);
          } else {
            slider.slides.css({ "opacity": 0, "display": "block", "webkitTransition": "opacity " + vars.animationSpeed / 1000 + "s ease", "zIndex": 1 }).eq(slider.currentSlide).css({ "opacity": 1, "zIndex": 2 });
          }
        }
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight();
      }
      // !CAROUSEL:
      // CANDIDATE: active slide
      if (!carousel) slider.slides.removeClass(namespace + "active-slide").eq(slider.currentSlide).addClass(namespace + "active-slide");
    };

    slider.doMath = function () {
      var slide = slider.slides.first(),
          slideMargin = vars.itemMargin,
          minItems = vars.minItems,
          maxItems = vars.maxItems;

      slider.w = slider.width();
      slider.h = slide.height();
      slider.boxPadding = slide.outerWidth() - slide.width();

      // CAROUSEL:
      if (carousel) {
        slider.itemT = vars.itemWidth + slideMargin;
        slider.minW = minItems ? minItems * slider.itemT : slider.w;
        slider.maxW = maxItems ? maxItems * slider.itemT : slider.w;
        slider.itemW = slider.minW > slider.w ? (slider.w - slideMargin * minItems) / minItems : slider.maxW < slider.w ? (slider.w - slideMargin * maxItems) / maxItems : vars.itemWidth > slider.w ? slider.w : vars.itemWidth;
        slider.visible = Math.floor(slider.w / (slider.itemW + slideMargin));
        slider.move = vars.move > 0 && vars.move < slider.visible ? vars.move : slider.visible;
        slider.pagingCount = Math.ceil((slider.count - slider.visible) / slider.move + 1);
        slider.last = slider.pagingCount - 1;
        slider.limit = slider.pagingCount === 1 ? 0 : vars.itemWidth > slider.w ? (slider.itemW + slideMargin * 2) * slider.count - slider.w - slideMargin : (slider.itemW + slideMargin) * slider.count - slider.w - slideMargin;
      } else {
        slider.itemW = slider.w;
        slider.pagingCount = slider.count;
        slider.last = slider.count - 1;
      }
      slider.computedW = slider.itemW - slider.boxPadding;
    };

    slider.update = function (pos, action) {
      slider.doMath();

      // update currentSlide and slider.animatingTo if necessary
      if (!carousel) {
        if (pos < slider.currentSlide) {
          slider.currentSlide += 1;
        } else if (pos <= slider.currentSlide && pos !== 0) {
          slider.currentSlide -= 1;
        }
        slider.animatingTo = slider.currentSlide;
      }

      // update controlNav
      if (vars.controlNav && !slider.manualControls) {
        if (action === "add" && !carousel || slider.pagingCount > slider.controlNav.length) {
          methods.controlNav.update("add");
        } else if (action === "remove" && !carousel || slider.pagingCount < slider.controlNav.length) {
          if (carousel && slider.currentSlide > slider.last) {
            slider.currentSlide -= 1;
            slider.animatingTo -= 1;
          }
          methods.controlNav.update("remove", slider.last);
        }
      }
      // update directionNav
      if (vars.directionNav) methods.directionNav.update();
    };

    slider.addSlide = function (obj, pos) {
      var $obj = $(obj);

      slider.count += 1;
      slider.last = slider.count - 1;

      // append new slide
      if (vertical && reverse) {
        pos !== undefined ? slider.slides.eq(slider.count - pos).after($obj) : slider.container.prepend($obj);
      } else {
        pos !== undefined ? slider.slides.eq(pos).before($obj) : slider.container.append($obj);
      }

      // update currentSlide, animatingTo, controlNav, and directionNav
      slider.update(pos, "add");

      // update slider.slides
      slider.slides = $(vars.selector + ':not(.clone)', slider);
      // re-setup the slider to accomdate new slide
      slider.setup();

      //FlexSlider: added() Callback
      vars.added(slider);
    };
    slider.removeSlide = function (obj) {
      var pos = isNaN(obj) ? slider.slides.index($(obj)) : obj;

      // update count
      slider.count -= 1;
      slider.last = slider.count - 1;

      // remove slide
      if (isNaN(obj)) {
        $(obj, slider.slides).remove();
      } else {
        vertical && reverse ? slider.slides.eq(slider.last).remove() : slider.slides.eq(obj).remove();
      }

      // update currentSlide, animatingTo, controlNav, and directionNav
      slider.doMath();
      slider.update(pos, "remove");

      // update slider.slides
      slider.slides = $(vars.selector + ':not(.clone)', slider);
      // re-setup the slider to accomdate new slide
      slider.setup();

      // FlexSlider: removed() Callback
      vars.removed(slider);
    };

    //FlexSlider: Initialize
    methods.init();
  };

  //FlexSlider: Default Settings
  $.flexslider.defaults = {
    namespace: "flex-", //{NEW} String: Prefix string attached to the class of every element generated by the plugin
    selector: ".slides > li", //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
    animation: "fade", //String: Select your animation type, "fade" or "slide"
    easing: "swing", //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
    direction: "horizontal", //String: Select the sliding direction, "horizontal" or "vertical"
    reverse: false, //{NEW} Boolean: Reverse the animation direction
    animationLoop: true, //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
    smoothHeight: false, //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
    startAt: 0, //Integer: The slide that the slider should start on. Array notation (0 = first slide)
    slideshow: true, //Boolean: Animate slider automatically
    slideshowSpeed: 7000, //Integer: Set the speed of the slideshow cycling, in milliseconds
    animationSpeed: 600, //Integer: Set the speed of animations, in milliseconds
    initDelay: 0, //{NEW} Integer: Set an initialization delay, in milliseconds
    randomize: false, //Boolean: Randomize slide order

    // Usability features
    pauseOnAction: true, //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
    pauseOnHover: false, //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
    useCSS: true, //{NEW} Boolean: Slider will use CSS3 transitions if available
    touch: true, //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
    video: false, //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

    // Primary Controls
    controlNav: true, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
    directionNav: true, //Boolean: Create navigation for previous/next navigation? (true/false)
    prevText: "Previous", //String: Set the text for the "previous" directionNav item
    nextText: "Next", //String: Set the text for the "next" directionNav item

    // Secondary Navigation
    keyboard: true, //Boolean: Allow slider navigating via keyboard left/right keys
    multipleKeyboard: false, //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
    mousewheel: false, //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
    pausePlay: false, //Boolean: Create pause/play dynamic element
    pauseText: "Pause", //String: Set the text for the "pause" pausePlay item
    playText: "Play", //String: Set the text for the "play" pausePlay item

    // Special properties
    controlsContainer: "", //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
    manualControls: "", //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
    sync: "", //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
    asNavFor: "", //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider

    // Carousel Options
    itemWidth: 0, //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
    itemMargin: 0, //{NEW} Integer: Margin between carousel items.
    minItems: 0, //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
    maxItems: 0, //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
    move: 0, //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.

    // Callback API
    start: function start() {}, //Callback: function(slider) - Fires when the slider loads the first slide
    before: function before() {}, //Callback: function(slider) - Fires asynchronously with each slider animation
    after: function after() {}, //Callback: function(slider) - Fires after each slider animation completes
    end: function end() {}, //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
    added: function added() {}, //{NEW} Callback: function(slider) - Fires after a slide is added
    removed: function removed() {} //{NEW} Callback: function(slider) - Fires after a slide is removed


    //FlexSlider: Plugin Function
  };$.fn.flexslider = function (options) {
    if (options === undefined) options = {};

    if ((typeof options === "undefined" ? "undefined" : _typeof(options)) === "object") {
      return this.each(function () {
        var $this = $(this),
            selector = options.selector ? options.selector : ".slides > li",
            $slides = $this.find(selector);

        if ($slides.length === 1) {
          $slides.fadeIn(400);
          if (options.start) options.start($this);
        } else if ($this.data('flexslider') == undefined) {
          new $.flexslider(this, options);
        }
      });
    } else {
      // Helper strings to quickly perform functions on the slider
      var $slider = $(this).data('flexslider');
      switch (options) {
        case "play":
          $slider.play();break;
        case "pause":
          $slider.pause();break;
        case "next":
          $slider.flexAnimate($slider.getTarget("next"), true);break;
        case "prev":
        case "previous":
          $slider.flexAnimate($slider.getTarget("prev"), true);break;
        default:
          if (typeof options === "number") $slider.flexAnimate(options, true);
      }
    }
  };
})(jQuery);

/***/ }),

/***/ "./resources/assets/js/jquery.parallax-1.1.3.js":
/***/ (function(module, exports) {

/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function (xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it		
		$this.each(function () {
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function getHeight(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function getHeight(jqo) {
				return jqo.height();
			};
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		function update() {
			var pos = $window.scrollTop();

			$this.each(function () {
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);

/***/ }),

/***/ "./resources/assets/js/link-hover.js":
/***/ (function(module, exports) {

;
(function ($, window, document, undefined) {
    var pluginName = 'mateHover',
        defaults = {
        autoSize: 'off',
        inhiritPadding: 'on',
        position: 'y',
        overlayStyle: 'classic',
        rollingPosition: 'top',
        doublePosition: 'vertical',
        fourSpeedIn0: 200,
        fourSpeedOut0: 200,
        fourSpeedIn1: 800,
        fourSpeedOut1: 800,
        fourSpeedIn2: 300,
        fourSpeedOut2: 300,
        fourSpeedIn3: 800,
        fourSpeedOut3: 800,
        overlayBg: '#000',
        overlaySpeedIn: 500,
        overlaySpeedOut: 500,
        overlayOpacity: 0.4,
        overlayEasing: 'linear',
        popupSpeedIn: 1000,
        popupSpeedOut: 500,
        popupEasing: 'swing',
        between: 10,
        popup2SpeedIn: 800,
        popup2SpeedOut: 800,
        popup2Easing: 'swing'
    };

    function Mate(element, options) {
        this.element = $(element);
        var ele = this;
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init(ele);
    };
    Mate.prototype.onResize = function () {
        var ele = this;
        this.img = this.element.children('img');
        this.popup = this.element.find('[data-zl-popup]');
        this.imgWidth = this.img.innerWidth();
        this.imgHeight = this.img.innerHeight();
        if (this.options.autoSize === 'on') {
            this.element.css({
                'width': this.imgWidth,
                'height': this.imgHeight
            });
        };
        if (this.options.inhiritPadding === 'on') {
            this.divWidth = this.element.innerWidth();
            this.divHeight = this.element.innerHeight();
        } else {
            this.divWidth = this.element.width();
            this.divHeight = this.element.height();
        };
        this.calDivWidth = this.divWidth * 2;
        this.calDivHeight = this.divHeight * 2;
        this.divCalWidth = this.divWidth / 2;
        this.divCalHeight = this.divHeight / 2;
        this.divCalWidth2 = this.divWidth / 4;
        this.divCalHeight2 = this.divHeight / 4;
        this.popupWidth = this.popup.outerWidth();
        this.popupHeight = this.popup.outerHeight();
        this.calPopWidth = this.popupWidth * 2;
        this.calPopHeight = this.popupHeight * 2;
        this.coorW = this.divCalWidth - this.popupWidth / 2;
        this.coorH = this.divCalHeight - this.popupHeight / 2;
        this.count_pop = this.popup.length;
        this.count_pop_label = 0;
        if (this.count_pop > 1) {
            this.count_pop_label = 1;
            this.popup1 = this.popup.eq(0);
            this.popup2 = this.popup.eq(1);
            this.popup1Width = this.popup1.outerWidth();
            this.popup2Width = this.popup2.outerWidth();
            this.popup1Height = this.popup1.outerHeight();
            this.popup2Height = this.popup2.outerHeight();
            this.calPop1Width = this.popup1Width * 2;
            this.calPop1Height = this.popup1Height * 2;
            this.calPop2Width = this.popup2Width * 2;
            this.calPop2Height = this.popup2Height * 2;
            this.coor1W = this.divCalWidth - this.popup1Width / 2 - this.popup2Width / 2 - this.options.between;
            this.coor1H = this.divCalHeight - this.popup1Height / 2;
            this.coor2W = this.divCalWidth - this.popup2Width / 2 - this.popup1Width / 2 - this.options.between;
            this.coor2H = this.divCalHeight - this.popup2Height / 2;
        };
        this.over_pos = {
            plus: {},
            minus: {}
        };
        this.over_pos.plus[this.options.rollingPosition] = this.options.rollingPosition === 'top' || this.options.rollingPosition === 'bottom' ? -this.divHeight - 10 : -this.divWidth - 10;
        this.over_pos.minus[this.options.rollingPosition] = 0;
        this.over_double_pos = {
            position0: {},
            position1: {},
            minus: {},
            fly_coor: {
                top_left: {},
                bottom_right: {}
            }
        };
        this.over_fly_out = {
            fly_coor: {
                top_left: {},
                bottom_right: {}
            }
        };
        if (this.options.doublePosition === 'vertical') {
            this.over_double_pos.position0['top'] = -this.divHeight;
            this.over_double_pos.position1['bottom'] = -this.divHeight;
            this.over_double_pos.minus['left'] = 0;
            this.over_double_pos.position0['height'] = '50%';
            this.over_double_pos.position0['width'] = '100%';
            this.over_double_pos.position1['height'] = '50%';
            this.over_double_pos.position1['width'] = '100%';
            this.over_double_pos.fly_coor.top_left['top'] = 0;
            this.over_double_pos.fly_coor.bottom_right['bottom'] = 0;
            this.over_fly_out.fly_coor.top_left['top'] = -this.divHeight;
            this.over_fly_out.fly_coor.bottom_right['bottom'] = -this.divHeight;
        } else {
            this.over_double_pos.position0['left'] = -this.divWidth;
            this.over_double_pos.position1['right'] = -this.divWidth;
            this.over_double_pos.minus['top'] = 0;
            this.over_double_pos.position0['height'] = '100%';
            this.over_double_pos.position0['width'] = '50%';
            this.over_double_pos.position1['height'] = '100%';
            this.over_double_pos.position1['width'] = '50%';
            this.over_double_pos.fly_coor.top_left['left'] = 0;
            this.over_double_pos.fly_coor.bottom_right['right'] = 0;
            this.over_fly_out.fly_coor.top_left['left'] = -this.divWidth;
            this.over_fly_out.fly_coor.bottom_right['right'] = -this.divWidth;
        };if (this.options.overlayStyle === 'four') {
            this.over_four = {
                inn: {},
                out: {}
            };
            for (var speed_count_inout = 0; speed_count_inout <= 3; speed_count_inout++) {
                this.over_four.inn['speed' + speed_count_inout] = this.options['fourSpeedIn' + speed_count_inout];
                this.over_four.out['speed' + speed_count_inout] = this.options['fourSpeedOut' + speed_count_inout];
            }
        };
        switch (this.options.position) {
            case 'y':
                this.startPosition('y', this.count_pop_label);
                break;
            case 'y-reverse':
                this.startPosition('y-reverse', this.count_pop_label);
                break;
            case 'x':
                this.startPosition('x', this.count_pop_label);
                break;
            case 'x-reverse':
                this.startPosition('x-reverse', this.count_pop_label);
                break;
            case 'y+i':
                this.startPosition('y+i', this.count_pop_label);
                break;
            case 'y+i-reverse':
                this.startPosition('y+i-reverse', this.count_pop_label);
                break;
            case 'x+i':
                this.startPosition('x+i', this.count_pop_label);
                break;
            case 'x+i-reverse':
                this.startPosition('x+i-reverse', this.count_pop_label);
                break;
            default:
                console.log('Wrong position properties(START POPUP POSITION)');
                break;
        };
        this.pos = {};
        switch (this.options.position) {
            case 'y':
                this.flyPosition('y', this.count_pop_label);
                break;
            case 'y-reverse':
                this.flyPosition('y-reverse', this.count_pop_label);
                break;
            case 'y+i':
                this.flyPosition('y+i', this.count_pop_label);
                break;
            case 'y+i-reverse':
                this.flyPosition('y+i-reverse', this.count_pop_label);
                break;
            case 'x':
                this.flyPosition('x', this.count_pop_label);
                break;
            case 'x+i':
                this.flyPosition('x+i', this.count_pop_label);
                break;
            case 'x-reverse':
                this.flyPosition('x-reverse', this.count_pop_label);
                break;
            case 'x+i-reverse':
                this.flyPosition('x+i-reverse', this.count_pop_label);
                break;
            default:
                console.log('Wrong position properties(FLY POPUP POSITION)');
                break;
        };
        var general_overlay, left_or_top, left_or_top_double;
        this.options.rollingPosition === 'top' || this.options.rollingPosition === 'bottom' ? left_or_top = 'left' : left_or_top = 'top';
        this.options.doublePosition === 'vertical' ? left_or_top_double = 'left' : left_or_top_double = 'top';
        this.element.find('[data-zl-overlay],[data-zl-ovrolling],[data-zl-ovdouble0],[data-zl-ovdouble1],[data-zl-ovzoom0],[data-zl-ovzoom1],[data-zl-ovzoom2],[data-zl-ovzoom3]').remove();
        switch (this.options.overlayStyle) {
            case 'classic':
                general_overlay = $('<div data-zl-overlay="zl_overlay_' + ele.element.attr('data-zlname') + '"></div>').css('background', ele.options.overlayBg);
                ele.element.prepend(general_overlay);
                break;
            case 'four':
                for (var overlay_count = 0; overlay_count <= 3; overlay_count++) {
                    general_overlay = $('<div data-zl-ovzoom' + overlay_count + '="zl_overlay_' + ele.element.attr('data-zlname') + '"></div>').css({
                        'background': ele.options.overlayBg,
                        'top': -this.divHeight,
                        'left': this.divCalWidth2 * overlay_count
                    }).fadeTo(100, this.options.overlayOpacity);
                    ele.element.prepend(general_overlay);
                };
                break;
            case 'rolling':
                general_overlay = $('<div data-zl-ovrolling="zl_overlay_' + ele.element.attr('data-zlname') + '" style="background:' + ele.options.overlayBg + ';' + left_or_top + ':0;"></div>').css(this.over_pos.plus).fadeTo(100, this.options.overlayOpacity);
                ele.element.prepend(general_overlay);
                break;
            case 'double':
                for (var overlay_count_d = 0; overlay_count_d <= 1; overlay_count_d++) {
                    general_overlay = $('<div data-zl-ovdouble' + overlay_count_d + '="zl_overlay_' + ele.element.attr('data-zlname') + '" style="background:' + ele.options.overlayBg + ';' + left_or_top_double + ':0;"></div>').css(this.over_double_pos['position' + overlay_count_d]).fadeTo(100, this.options.overlayOpacity);
                    ele.element.prepend(general_overlay);
                };
                break;
        }
    };
    Mate.prototype.startPosition = function (x_or_y, count_pop_label) {
        if (x_or_y === 'y' && count_pop_label === 0 || x_or_y === 'y+i' && count_pop_label === 0) {
            this.popup.css({
                'left': this.coorW,
                'top': -this.calPopHeight
            });
        } else if (x_or_y === 'y-reverse' && count_pop_label === 0 || x_or_y === 'y+i-reverse' && count_pop_label === 0) {
            this.popup.css({
                'left': this.coorW,
                'bottom': -this.calPopHeight
            });
        } else if (x_or_y === 'x-reverse' && count_pop_label === 0 || x_or_y === 'x+i-reverse' && count_pop_label === 0) {
            this.popup.css({
                'top': this.coorH,
                'right': -this.calPopWidth
            });
        } else if (x_or_y === 'x' && count_pop_label === 0 || x_or_y === 'x+i' && count_pop_label === 0) {
            this.popup.css({
                'top': this.coorH,
                'left': -this.calPopWidth
            });
        } else if (x_or_y === 'y' && count_pop_label === 1 || x_or_y === 'y+i' && count_pop_label === 1) {
            this.popup1.css({
                'left': this.coor1W,
                'top': -this.calPop1Height
            });
            this.popup2.css({
                'right': this.coor2W,
                'top': -this.calPop2Height
            });
        } else if (x_or_y === 'y-reverse' && count_pop_label === 1 || x_or_y === 'y+i-reverse' && count_pop_label === 1) {
            this.popup1.css({
                'left': this.coor1W,
                'bottom': -this.calPop1Height
            });
            this.popup2.css({
                'right': this.coor2W,
                'bottom': -this.calPop2Height
            });
        } else if (x_or_y === 'x-reverse' && count_pop_label === 1 || x_or_y === 'x+i-reverse' && count_pop_label === 1) {
            this.popup1.css({
                'top': this.coor1H,
                'right': -this.calPop1Width
            });
            this.popup2.css({
                'top': this.coor2H,
                'left': -this.calPop2Width
            });
        } else if (x_or_y === 'x' && count_pop_label === 1 || x_or_y === 'x+i' && count_pop_label === 1) {
            this.popup1.css({
                'top': this.coor1H,
                'left': -this.calPop1Width
            });
            this.popup2.css({
                'top': this.coor2H,
                'right': -this.calPop2Width
            });
        }
    };
    Mate.prototype.flyPosition = function (x_or_y, count_pop_label) {
        if (x_or_y === 'y' && count_pop_label === 0) {
            this.pos.anime_enter = {
                top: this.coorH
            }, this.pos.anime_leave = {
                top: -this.calPopHeight
            }, this.pos.back_css = {
                'display': 'none',
                'top': -this.calPopHeight
            };
        } else if (x_or_y === 'y-reverse' && count_pop_label === 0) {
            this.pos.anime_enter = {
                bottom: this.coorH
            }, this.pos.anime_leave = {
                bottom: -this.calPopHeight
            }, this.pos.back_css = {
                'display': 'none',
                'bottom': -this.calPopHeight
            };
        } else if (x_or_y === 'y+i-reverse' && count_pop_label === 0) {
            this.pos.anime_enter = {
                bottom: this.coorH
            }, this.pos.anime_leave = {
                bottom: this.calDivHeight
            }, this.pos.back_css = {
                'display': 'none',
                'bottom': -this.calPopHeight
            };
        } else if (x_or_y === 'y+i' && count_pop_label === 0) {
            this.pos.anime_enter = {
                top: this.coorH
            }, this.pos.anime_leave = {
                top: this.calDivHeight
            }, this.pos.back_css = {
                'display': 'none',
                'top': -this.calPopHeight
            };
        } else if (x_or_y === 'x' && count_pop_label === 0) {
            this.pos.anime_enter = {
                left: this.coorW
            }, this.pos.anime_leave = {
                left: -this.calPopWidth
            }, this.pos.back_css = {
                'display': 'none',
                'left': -this.calPopWidth
            };
        } else if (x_or_y === 'x+i' && count_pop_label === 0) {
            this.pos.anime_enter = {
                left: this.coorW
            }, this.pos.anime_leave = {
                left: this.calDivWidth
            }, this.pos.back_css = {
                'display': 'none',
                'left': -this.calPopWidth
            };
        } else if (x_or_y === 'x-reverse' && count_pop_label === 0) {
            this.pos.anime_enter = {
                right: this.coorW
            }, this.pos.anime_leave = {
                right: -this.calPopWidth
            }, this.pos.back_css = {
                'display': 'none',
                'right': -this.calPopWidth
            };
        } else if (x_or_y === 'x+i-reverse' && count_pop_label === 0) {
            this.pos.anime_enter = {
                right: this.coorW
            }, this.pos.anime_leave = {
                right: this.calDivWidth
            }, this.pos.back_css = {
                'display': 'none',
                'right': -this.calPopWidth
            };
        } else if (x_or_y === 'y' && count_pop_label === 1) {
            this.pos.anime_enter = {
                top: this.coor1H
            }, this.pos.anime_leave = {
                top: -this.calPop1Height
            }, this.pos.back_css = {
                'display': 'none',
                'top': -this.calPop1Height
            };
            this.pos.anime_enter2 = {
                top: this.coor2H
            }, this.pos.anime_leave2 = {
                top: -this.calPop2Height
            }, this.pos.back_css2 = {
                'display': 'none',
                'top': -this.calPop2Height
            };
        } else if (x_or_y === 'y-reverse' && count_pop_label === 1) {
            this.pos.anime_enter = {
                bottom: this.coor1H
            }, this.pos.anime_leave = {
                bottom: -this.calPop1Height
            }, this.pos.back_css = {
                'display': 'none',
                'bottom': -this.calPop1Height
            };
            this.pos.anime_enter2 = {
                bottom: this.coor2H
            }, this.pos.anime_leave2 = {
                bottom: -this.calPop2Height
            }, this.pos.back_css2 = {
                'display': 'none',
                'bottom': -this.calPop2Height
            };
        } else if (x_or_y === 'y+i-reverse' && count_pop_label === 1) {
            this.pos.anime_enter = {
                bottom: this.coor1H
            }, this.pos.anime_leave = {
                bottom: this.calDivHeight
            }, this.pos.back_css = {
                'display': 'none',
                'bottom': -this.calPop1Height
            };
            this.pos.anime_enter2 = {
                bottom: this.coor2H
            }, this.pos.anime_leave2 = {
                bottom: this.calDivHeight
            }, this.pos.back_css2 = {
                'display': 'none',
                'bottom': -this.calPop2Height
            };
        } else if (x_or_y === 'y+i' && count_pop_label === 1) {
            this.pos.anime_enter = {
                top: this.coor1H
            }, this.pos.anime_leave = {
                top: this.calDivHeight
            }, this.pos.back_css = {
                'display': 'none',
                'top': -this.calPop1Height
            };
            this.pos.anime_enter2 = {
                top: this.coor2H
            }, this.pos.anime_leave2 = {
                top: this.calDivHeight
            }, this.pos.back_css2 = {
                'display': 'none',
                'top': -this.calPop2Height
            };
        } else if (x_or_y === 'x' && count_pop_label === 1) {
            this.pos.anime_enter = {
                left: this.coor1W
            }, this.pos.anime_leave = {
                left: -this.calPop1Width
            }, this.pos.back_css = {
                'display': 'none',
                'left': -this.calPop1Width
            };
            this.pos.anime_enter2 = {
                right: this.coor2W
            }, this.pos.anime_leave2 = {
                right: -this.calPop2Width
            }, this.pos.back_css2 = {
                'display': 'none',
                'right': -this.calPop2Width
            };
        } else if (x_or_y === 'x-reverse' && count_pop_label === 1) {
            this.pos.anime_enter = {
                right: this.coor1W
            }, this.pos.anime_leave = {
                right: -this.calPop1Width
            }, this.pos.back_css = {
                'display': 'none',
                'right': -this.calPop1Width
            };
            this.pos.anime_enter2 = {
                left: this.coor2W
            }, this.pos.anime_leave2 = {
                left: -this.calPop2Width
            }, this.pos.back_css2 = {
                'display': 'none',
                'left': -this.calPop2Width
            };
        } else if (x_or_y === 'x+i' && count_pop_label === 1) {
            this.pos.anime_enter = {
                left: this.coor1W
            }, this.pos.anime_leave = {
                left: this.calDivWidth
            }, this.pos.back_css = {
                'display': 'none',
                'left': -this.calPop1Width
            };
            this.pos.anime_enter2 = {
                right: this.coor2W
            }, this.pos.anime_leave2 = {
                right: this.calDivWidth
            }, this.pos.back_css2 = {
                'display': 'none',
                'right': -this.calPop2Width
            };
        } else if (x_or_y === 'x+i-reverse' && count_pop_label === 1) {
            this.pos.anime_enter = {
                right: this.coor1W
            }, this.pos.anime_leave = {
                right: this.calDivWidth
            }, this.pos.back_css = {
                'display': 'none',
                'right': -this.calPop1Width
            };
            this.pos.anime_enter2 = {
                left: this.coor2W
            }, this.pos.anime_leave2 = {
                left: this.calDivWidth
            }, this.pos.back_css2 = {
                'display': 'none',
                'left': -this.calPop2Width
            };
        }
    };
    Mate.prototype.overlayGet = function (ele, overlayStyle, speed, opacity, over_pos) {
        switch (overlayStyle) {
            case 'classic':
                ele.element.children('[data-zl-overlay]').stop(true).fadeTo(speed, opacity, ele.options.overlayEasing);
                break;
            case 'four':
                var obj_count = 0;
                for (var obj_proper in speed) {
                    ele.element.children('[data-zl-ovzoom' + obj_count + ']').stop(true).animate({
                        top: over_pos
                    }, speed[obj_proper], ele.options.overlayEasing);
                    obj_count++;
                };
                break;
            case 'rolling':
                ele.element.children('[data-zl-ovrolling]').css('display', 'block').stop(true).animate(over_pos, speed, ele.options.overlayEasing);
                break;
            case 'double':
                ele.element.children('[data-zl-ovdouble0]').css('display', 'block').stop(true).animate(over_pos.top_left, speed, ele.options.overlayEasing);
                ele.element.children('[data-zl-ovdouble1]').css('display', 'block').stop(true).animate(over_pos.bottom_right, speed, ele.options.overlayEasing);
                break;
        }
    };
    Mate.prototype.hover = function (ele, count_pop_label) {
        this.element.on({
            mouseenter: function mouseenter() {
                switch (count_pop_label) {
                    case 0:
                        ele.popup.css(ele.pos.back_css).css('display', 'block').stop(true).animate(ele.pos.anime_enter, ele.options.popupSpeedIn, ele.options.popupEasing);
                        switch (ele.options.overlayStyle) {
                            case 'classic':
                                ele.overlayGet(ele, 'classic', ele.options.overlaySpeedIn, ele.options.overlayOpacity, 0);
                                break;
                            case 'four':
                                ele.overlayGet(ele, 'four', ele.over_four.inn, 0, ele.divHeight);
                                break;
                            case 'rolling':
                                ele.overlayGet(ele, 'rolling', ele.options.overlaySpeedIn, ele.options.overlayOpacity, ele.over_pos.minus);
                                break;
                            case 'double':
                                ele.overlayGet(ele, 'double', ele.options.overlaySpeedIn, ele.options.overlayOpacity, ele.over_double_pos.fly_coor);
                                break;
                        };
                        break;
                    case 1:
                        ele.popup1.css(ele.pos.back_css).css('display', 'block').stop(true).animate(ele.pos.anime_enter, ele.options.popupSpeedIn, ele.options.popupEasing).siblings('[data-zl-popup]').css(ele.pos.back_css2).css('display', 'block').stop(true).animate(ele.pos.anime_enter2, ele.options.popup2SpeedIn, ele.options.popup2Easing);
                        switch (ele.options.overlayStyle) {
                            case 'classic':
                                ele.overlayGet(ele, 'classic', ele.options.overlaySpeedIn, ele.options.overlayOpacity, 0);
                                break;
                            case 'four':
                                ele.overlayGet(ele, 'four', ele.over_four.inn, 0, ele.divHeight);
                                break;
                            case 'rolling':
                                ele.overlayGet(ele, 'rolling', ele.options.overlaySpeedIn, ele.options.overlayOpacity, ele.over_pos.minus);
                                break;
                            case 'double':
                                ele.overlayGet(ele, 'double', ele.options.overlaySpeedIn, ele.options.overlayOpacity, ele.over_double_pos.fly_coor);
                                break;
                        };
                        break;
                }
            },
            mouseleave: function mouseleave() {
                switch (count_pop_label) {
                    case 0:
                        ele.popup.stop(true).animate(ele.pos.anime_leave, ele.options.popupSpeedOut, ele.options.popupEasing).children('input').blur();
                        switch (ele.options.overlayStyle) {
                            case 'classic':
                                ele.overlayGet(ele, 'classic', ele.options.overlaySpeedOut, 0, 0);
                                break;
                            case 'four':
                                ele.overlayGet(ele, 'four', ele.over_four.out, 0, -ele.divHeight);
                                break;
                            case 'rolling':
                                ele.overlayGet(ele, 'rolling', ele.options.overlaySpeedOut, 0, ele.over_pos.plus);
                                break;
                            case 'double':
                                ele.overlayGet(ele, 'double', ele.options.overlaySpeedOut, 0, ele.over_fly_out.fly_coor);
                                break;
                        };
                        break;
                    case 1:
                        ele.popup1.stop(true, true).animate(ele.pos.anime_leave, ele.options.popupSpeedOut, ele.options.popupEasing).children('input').blur().end().siblings('[data-zl-popup]').stop(true, true).animate(ele.pos.anime_leave2, ele.options.popup2SpeedOut, ele.options.popup2Easing).children('input').blur();
                        switch (ele.options.overlayStyle) {
                            case 'classic':
                                ele.overlayGet(ele, 'classic', ele.options.overlaySpeedOut, 0, 0);
                                break;
                            case 'four':
                                ele.overlayGet(ele, 'four', ele.over_four.out, 0, -ele.divHeight);
                                break;
                            case 'rolling':
                                ele.overlayGet(ele, 'rolling', ele.options.overlaySpeedOut, 0, ele.over_pos.plus);
                                break;
                            case 'double':
                                ele.overlayGet(ele, 'double', ele.options.overlaySpeedOut, 0, ele.over_fly_out.fly_coor);
                                break;
                        };
                        break;
                }
            }
        });
    };
    Mate.prototype.init = function (ele) {
        $(window).resize($.proxy(this, 'onResize'));
        this.onResize();
        this.hover(ele, this.count_pop_label);
    };
    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Mate(this, options));
            }
        });
    };
})(jQuery, window, document);

/***/ }),

/***/ "./resources/assets/js/scrolling-nav.js":
/***/ (function(module, exports) {

//jQuery to collapse the navbar on scroll
$(window).scroll(function () {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function () {
    $(document).on('click', 'a.page-scroll', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 70

        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

/***/ }),

/***/ "./resources/assets/js/seq-slider/jquery.sequence-min.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
Sequence.js (http://www.sequencejs.com)
Version: 1.0.1.2
Author: Ian Lunn @IanLunn
Author URL: http://www.ianlunn.co.uk/
Github: https://github.com/IanLunn/Sequence

This is a FREE script and is available under a MIT License:
http://www.opensource.org/licenses/mit-license.php

Sequence.js and its dependencies are (c) Ian Lunn Design 2012 unless otherwise stated.

Sequence also relies on the following open source scripts:

- jQuery imagesLoaded 2.1.0 (http://github.com/desandro/imagesloaded)
	Paul Irish et al
	Available under a MIT License: http://www.opensource.org/licenses/mit-license.php

- jQuery TouchWipe 1.1.1 (http://www.netcu.de/jquery-touchwipe-iphone-ipad-library)
	Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
	Available under a MIT License: http://www.opensource.org/licenses/mit-license.php

- Modernizr 2.6.1 Custom Build (http://modernizr.com/) (Named Modernizr for Sequence to prevent conflicts)
	Copyright (c) Faruk Ates, Paul Irish, Alex Sexton
	Available under the BSD and MIT licenses: www.modernizr.com/license/
	*/

!function (a) {
	function b(b, d, e) {
		function f() {
			j.afterLoaded(), j.settings.hideFramesUntilPreloaded && void 0 !== j.settings.preloader && j.settings.preloader !== !1 && j.frames.show(), void 0 !== j.settings.preloader && j.settings.preloader !== !1 ? j.settings.hidePreloaderUsingCSS && j.transitionsSupported ? (j.prependPreloadingCompleteTo = j.settings.prependPreloadingComplete === !0 ? j.settings.preloader : a(j.settings.prependPreloadingComplete), j.prependPreloadingCompleteTo.addClass("preloading-complete"), setTimeout(i, j.settings.hidePreloaderDelay)) : j.settings.preloader.fadeOut(j.settings.hidePreloaderDelay, function () {
				clearInterval(j.defaultPreloader), i();
			}) : i();
		}function g(b, c) {
			var d = [];if (c) for (var e = b; e > 0; e--) {
				d.push(a("body").find('img[src="' + j.settings.preloadTheseImages[e - 1] + '"]'));
			} else for (var f = b; f > 0; f--) {
				j.frames.eq(j.settings.preloadTheseFrames[f - 1] - 1).find("img").each(function () {
					d.push(a(this)[0]);
				});
			}return d;
		}function h(b, c) {
			function d() {
				var b = a(l),
				    d = a(m);h && (m.length ? h.reject(j, b, d) : h.resolve(j)), a.isFunction(c) && c.call(g, j, b, d);
			}function e(b, c) {
				b.src !== f && -1 === a.inArray(b, k) && (k.push(b), c ? m.push(b) : l.push(b), a.data(b, "imagesLoaded", { isBroken: c, src: b.src }), i && h.notifyWith(a(b), [c, j, a(l), a(m)]), j.length === k.length && (setTimeout(d), j.unbind(".imagesLoaded")));
			}var f = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",
			    g = b,
			    h = a.isFunction(a.Deferred) ? a.Deferred() : 0,
			    i = a.isFunction(h.notify),
			    j = g.find("img").add(g.filter("img")),
			    k = [],
			    l = [],
			    m = [];a.isPlainObject(c) && a.each(c, function (a, b) {
				"callback" === a ? c = b : h && h[a](b);
			}), j.length ? j.bind("load.imagesLoaded error.imagesLoaded", function (a) {
				e(a.target, "error" === a.type);
			}).each(function (b, c) {
				var d = c.src,
				    g = a.data(c, "imagesLoaded");return g && g.src === d ? void e(c, g.isBroken) : c.complete && void 0 !== c.naturalWidth ? void e(c, 0 === c.naturalWidth || 0 === c.naturalHeight) : void ((c.readyState || c.complete) && (c.src = f, c.src = d));
			}) : d();
		}function i() {
			function b(a, b) {
				var c, d;for (d in b) {
					c = "left" === d || "right" === d ? f[d] : d, a === parseFloat(c) && j._initCustomKeyEvent(b[d]);
				}
			}function c() {
				j.canvas.on("touchmove.sequence", d), g = null, i = !1;
			}function d(a) {
				if (j.settings.swipePreventsDefault && a.preventDefault(), i) {
					var b = a.originalEvent.touches[0].pageX,
					    d = a.originalEvent.touches[0].pageY,
					    e = g - b,
					    f = h - d;Math.abs(e) >= j.settings.swipeThreshold ? (c(), j._initCustomKeyEvent(e > 0 ? j.settings.swipeEvents.left : j.settings.swipeEvents.right)) : Math.abs(f) >= j.settings.swipeThreshold && (c(), j._initCustomKeyEvent(f > 0 ? j.settings.swipeEvents.down : j.settings.swipeEvents.up));
				}
			}function e(a) {
				1 === a.originalEvent.touches.length && (g = a.originalEvent.touches[0].pageX, h = a.originalEvent.touches[0].pageY, i = !0, j.canvas.on("touchmove.sequence", d));
			}if (a(j.settings.preloader).remove(), j.nextButton = j._renderUiElements(j.settings.nextButton, ".sequence-next"), j.prevButton = j._renderUiElements(j.settings.prevButton, ".sequence-prev"), j.pauseButton = j._renderUiElements(j.settings.pauseButton, ".sequence-pause"), j.pagination = j._renderUiElements(j.settings.pagination, ".sequence-pagination"), void 0 !== j.nextButton && j.nextButton !== !1 && j.settings.showNextButtonOnInit === !0 && j.nextButton.show(), void 0 !== j.prevButton && j.prevButton !== !1 && j.settings.showPrevButtonOnInit === !0 && j.prevButton.show(), void 0 !== j.pauseButton && j.pauseButton !== !1 && j.settings.showPauseButtonOnInit === !0 && j.pauseButton.show(), j.settings.pauseIcon !== !1 ? (j.pauseIcon = j._renderUiElements(j.settings.pauseIcon, ".sequence-pause-icon"), void 0 !== j.pauseIcon && j.pauseIcon.hide()) : j.pauseIcon = void 0, void 0 !== j.pagination && j.pagination !== !1 && (j.paginationLinks = j.pagination.children(), j.paginationLinks.on("click.sequence", function () {
				var b = a(this).index() + 1;j.goTo(b);
			}), j.settings.showPaginationOnInit === !0 && j.pagination.show()), j.nextFrameID = j.settings.startingFrameID, j.settings.hashTags === !0 && (j.frames.each(function () {
				j.frameHashID.push(a(this).prop(j.getHashTagFrom));
			}), j.currentHashTag = location.hash.replace("#", ""), void 0 === j.currentHashTag || "" === j.currentHashTag ? j.nextFrameID = j.settings.startingFrameID : (j.frameHashIndex = a.inArray(j.currentHashTag, j.frameHashID), j.nextFrameID = -1 !== j.frameHashIndex ? j.frameHashIndex + 1 : j.settings.startingFrameID)), j.nextFrame = j.frames.eq(j.nextFrameID - 1), j.nextFrameChildren = j.nextFrame.children(), void 0 !== j.pagination && a(j.paginationLinks[j.settings.startingFrameID - 1]).addClass("current"), j.transitionsSupported ? j.settings.animateStartingFrameIn ? j.settings.reverseAnimationsWhenNavigatingBackwards && j.settings.autoPlayDirection - 1 && j.settings.animateStartingFrameIn ? (j._resetElements(j.transitionPrefix, j.nextFrameChildren, "0s"), j.nextFrame.addClass("animate-out"), j.goTo(j.nextFrameID, -1, !0)) : j.goTo(j.nextFrameID, 1, !0) : (j.currentFrameID = j.nextFrameID, j.settings.moveActiveFrameToTop && j.nextFrame.css("z-index", j.numberOfFrames), j._resetElements(j.transitionPrefix, j.nextFrameChildren, "0s"), j.nextFrame.addClass("animate-in"), j.settings.hashTags && j.settings.hashChangesOnFirstFrame && (j.currentHashTag = j.nextFrame.prop(j.getHashTagFrom), document.location.hash = "#" + j.currentHashTag), setTimeout(function () {
				j._resetElements(j.transitionPrefix, j.nextFrameChildren, "");
			}, 100), j._resetAutoPlay(!0, j.settings.autoPlayDelay)) : (j.container.addClass("sequence-fallback"), j.currentFrameID = j.nextFrameID, j.settings.hashTags && j.settings.hashChangesOnFirstFrame && (j.currentHashTag = j.nextFrame.prop(j.getHashTagFrom), document.location.hash = "#" + j.currentHashTag), j.frames.addClass("animate-in"), j.frames.not(":eq(" + (j.nextFrameID - 1) + ")").css({ display: "none", opacity: 0 }), j._resetAutoPlay(!0, j.settings.autoPlayDelay)), void 0 !== j.nextButton && j.nextButton.bind("click.sequence", function () {
				j.next();
			}), void 0 !== j.prevButton && j.prevButton.bind("click.sequence", function () {
				j.prev();
			}), void 0 !== j.pauseButton && j.pauseButton.bind("click.sequence", function () {
				j.pause(!0);
			}), j.settings.keyNavigation) {
				var f = { left: 37, right: 39 };a(document).bind("keydown.sequence", function (a) {
					var c = String.fromCharCode(a.keyCode);c > 0 && c <= j.numberOfFrames && j.settings.numericKeysGoToFrames && (j.nextFrameID = c, j.goTo(j.nextFrameID)), b(a.keyCode, j.settings.keyEvents), b(a.keyCode, j.settings.customKeyEvents);
				});
			}if (j.canvas.on({ "mouseenter.sequence": function mouseenterSequence() {
					j.settings.pauseOnHover && j.settings.autoPlay && !j.hasTouch && (j.isBeingHoveredOver = !0, j.isHardPaused || j.pause());
				}, "mouseleave.sequence": function mouseleaveSequence() {
					j.settings.pauseOnHover && j.settings.autoPlay && !j.hasTouch && (j.isBeingHoveredOver = !1, j.isHardPaused || j.unpause());
				} }), j.settings.hashTags && a(window).bind("hashchange.sequence", function () {
				var b = location.hash.replace("#", "");j.currentHashTag !== b && (j.currentHashTag = b, j.frameHashIndex = a.inArray(j.currentHashTag, j.frameHashID), -1 !== j.frameHashIndex && (j.nextFrameID = j.frameHashIndex + 1, j.goTo(j.nextFrameID)));
			}), j.settings.swipeNavigation && j.hasTouch) {
				var g,
				    h,
				    i = !1;j.canvas.on("touchstart.sequence", e);
			}
		}var j = this;j.container = a(b), j.canvas = j.container.children(".sequence-canvas"), j.frames = j.canvas.children("li"), j._modernizrForSequence();var k = { WebkitTransition: "-webkit-", WebkitAnimation: "-webkit-", MozTransition: "-moz-", "MozAnimation ": "-moz-", OTransition: "-o-", OAnimation: "-o-", msTransition: "-ms-", msAnimation: "-ms-", transition: "", animation: "" },
		    l = { WebkitTransition: "webkitTransitionEnd.sequence", WebkitAnimation: "webkitAnimationEnd.sequence", MozTransition: "transitionend.sequence", MozAnimation: "animationend.sequence", OTransition: "otransitionend.sequence", OAnimation: "oanimationend.sequence", msTransition: "MSTransitionEnd.sequence", msAnimation: "MSAnimationEnd.sequence", transition: "transitionend.sequence", animation: "animationend.sequence" };j.transitionPrefix = k[ModernizrForSequence.prefixed("transition")], j.animationPrefix = k[ModernizrForSequence.prefixed("animation")], j.transitionProperties = {}, j.transitionEnd = l[ModernizrForSequence.prefixed("transition")] + " " + l[ModernizrForSequence.prefixed("animation")], j.numberOfFrames = j.frames.length, j.transitionsSupported = void 0 !== j.transitionPrefix ? !0 : !1, j.hasTouch = "ontouchstart" in window ? !0 : !1, j.isPaused = !1, j.isBeingHoveredOver = !1, j.container.removeClass("sequence-destroyed"), j.paused = function () {}, j.unpaused = function () {}, j.beforeNextFrameAnimatesIn = function () {}, j.afterNextFrameAnimatesIn = function () {}, j.beforeCurrentFrameAnimatesOut = function () {}, j.afterCurrentFrameAnimatesOut = function () {}, j.afterLoaded = function () {}, j.destroyed = function () {}, j.settings = a.extend({}, e, d), j.settings.preloader = j._renderUiElements(j.settings.preloader, ".sequence-preloader"), j.isStartingFrame = j.settings.animateStartingFrameIn ? !0 : !1, j.settings.unpauseDelay = null === j.settings.unpauseDelay ? j.settings.autoPlayDelay : j.settings.unpauseDelay, j.getHashTagFrom = j.settings.hashDataAttribute ? "data-sequence-hashtag" : "id", j.frameHashID = [], j.direction = j.settings.autoPlayDirection, j.settings.hideFramesUntilPreloaded && void 0 !== j.settings.preloader && j.settings.preloader !== !1 && j.frames.hide(), "-o-" === j.transitionPrefix && (j.transitionsSupported = j._operaTest()), j.frames.removeClass("animate-in");var m = j.settings.preloadTheseFrames.length,
		    n = j.settings.preloadTheseImages.length;if (j.settings.windowLoaded === !0 && (c = j.settings.windowLoaded), void 0 === j.settings.preloader || j.settings.preloader === !1 || 0 === m && 0 === n) c === !0 ? (f(), a(this).unbind("load.sequence")) : a(window).bind("load.sequence", function () {
			f(), a(this).unbind("load.sequence");
		});else {
			var o = g(m),
			    p = g(n, !0),
			    q = a(o.concat(p));h(q, f);
		}
	}var c = !1;a(window).bind("load", function () {
		c = !0;
	}), b.prototype = { startAutoPlay: function startAutoPlay(a) {
			var b = this;a = void 0 === a ? b.settings.autoPlayDelay : a, b.unpause(), b._resetAutoPlay(), b.autoPlayTimer = setTimeout(function () {
				1 === b.settings.autoPlayDirection ? b.next() : b.prev();
			}, a);
		}, stopAutoPlay: function stopAutoPlay() {
			var a = this;a.pause(!0), clearTimeout(a.autoPlayTimer);
		}, pause: function pause(a) {
			var b = this;b.isSoftPaused ? b.unpause() : (void 0 !== b.pauseButton && (b.pauseButton.addClass("paused"), void 0 !== b.pauseIcon && b.pauseIcon.show()), b.paused(), b.isSoftPaused = !0, b.isHardPaused = a ? !0 : !1, b.isPaused = !0, b._resetAutoPlay());
		}, unpause: function unpause(a) {
			var b = this;void 0 !== b.pauseButton && (b.pauseButton.removeClass("paused"), void 0 !== b.pauseIcon && b.pauseIcon.hide()), b.isSoftPaused = !1, b.isHardPaused = !1, b.isPaused = !1, b.active ? b.delayUnpause = !0 : (a !== !1 && b.unpaused(), b._resetAutoPlay(!0, b.settings.unpauseDelay));
		}, next: function next() {
			var a = this;id = a.currentFrameID !== a.numberOfFrames ? a.currentFrameID + 1 : 1, a.active === !1 || void 0 === a.active ? a.goTo(id, 1) : a.goTo(id, 1, !0);
		}, prev: function prev() {
			var a = this;id = 1 === a.currentFrameID ? a.numberOfFrames : a.currentFrameID - 1, a.active === !1 || void 0 === a.active ? a.goTo(id, -1) : a.goTo(id, -1, !0);
		}, goTo: function goTo(b, c, d) {
			function e() {
				f._setHashTag(), f.active = !1, f._resetAutoPlay(!0, f.settings.autoPlayDelay);
			}var f = this;f.nextFrameID = parseFloat(b);var g = d === !0 ? 0 : f.settings.transitionThreshold;if (f.nextFrameID === f.currentFrameID || f.settings.navigationSkip && f.navigationSkipThresholdActive || !f.settings.navigationSkip && f.active || !f.transitionsSupported && f.active || !f.settings.cycle && 1 === c && f.currentFrameID === f.numberOfFrames || !f.settings.cycle && -1 === c && 1 === f.currentFrameID || f.settings.preventReverseSkipping && f.direction !== c && f.active) return !1;if (f.settings.navigationSkip && f.active && (f.navigationSkipThresholdActive = !0, f.settings.fadeFrameWhenSkipped && f.nextFrame.stop().animate({ opacity: 0 }, f.settings.fadeFrameTime), clearTimeout(f.transitionThresholdTimer), setTimeout(function () {
				f.navigationSkipThresholdActive = !1;
			}, f.settings.navigationSkipThreshold)), !f.active || f.settings.navigationSkip) {
				if (f.active = !0, f._resetAutoPlay(), f.direction = void 0 === c ? f.nextFrameID > f.currentFrameID ? 1 : -1 : c, f.currentFrame = f.canvas.children(".animate-in"), f.nextFrame = f.frames.eq(f.nextFrameID - 1), f.currentFrameChildren = f.currentFrame.children(), f.nextFrameChildren = f.nextFrame.children(), void 0 !== f.pagination && (f.paginationLinks.removeClass("current"), a(f.paginationLinks[f.nextFrameID - 1]).addClass("current")), f.transitionsSupported) void 0 !== f.currentFrame.length ? (f.beforeCurrentFrameAnimatesOut(), f.settings.moveActiveFrameToTop && f.currentFrame.css("z-index", 1), f._resetElements(f.transitionPrefix, f.nextFrameChildren, "0s"), f.settings.reverseAnimationsWhenNavigatingBackwards && 1 !== f.direction ? f.settings.reverseAnimationsWhenNavigatingBackwards && -1 === f.direction && (f.nextFrame.addClass("animate-out"), f._reverseTransitionProperties()) : (f.nextFrame.removeClass("animate-out"), f._resetElements(f.transitionPrefix, f.currentFrameChildren, ""))) : f.isStartingFrame = !1, f.active = !0, f.currentFrame.unbind(f.transitionEnd), f.nextFrame.unbind(f.transitionEnd), f.settings.fadeFrameWhenSkipped && f.settings.navigationSkip && f.nextFrame.css("opacity", 1), f.beforeNextFrameAnimatesIn(), f.settings.moveActiveFrameToTop && f.nextFrame.css("z-index", f.numberOfFrames), f.settings.reverseAnimationsWhenNavigatingBackwards && 1 !== f.direction ? f.settings.reverseAnimationsWhenNavigatingBackwards && -1 === f.direction && (setTimeout(function () {
					f._resetElements(f.transitionPrefix, f.currentFrameChildren, ""), f._resetElements(f.transitionPrefix, f.nextFrameChildren, ""), f._reverseTransitionProperties(), f._waitForAnimationsToComplete(f.nextFrame, f.nextFrameChildren, "in"), ("function () {}" !== f.afterCurrentFrameAnimatesOut || f.settings.transitionThreshold === !0 && d !== !0) && f._waitForAnimationsToComplete(f.currentFrame, f.currentFrameChildren, "out", !0, -1);
				}, 50), setTimeout(function () {
					f.settings.transitionThreshold === !1 || 0 === f.settings.transitionThreshold || d === !0 ? (f.currentFrame.removeClass("animate-in"), f.nextFrame.toggleClass("animate-out animate-in")) : (f.currentFrame.removeClass("animate-in"), f.settings.transitionThreshold !== !0 && (f.transitionThresholdTimer = setTimeout(function () {
						f.nextFrame.toggleClass("animate-out animate-in");
					}, g)));
				}, 50)) : (setTimeout(function () {
					f._resetElements(f.transitionPrefix, f.nextFrameChildren, ""), f._waitForAnimationsToComplete(f.nextFrame, f.nextFrameChildren, "in"), ("function () {}" !== f.afterCurrentFrameAnimatesOut || f.settings.transitionThreshold === !0 && d !== !0) && f._waitForAnimationsToComplete(f.currentFrame, f.currentFrameChildren, "out", !0, 1);
				}, 50), setTimeout(function () {
					f.settings.transitionThreshold === !1 || 0 === f.settings.transitionThreshold || d === !0 ? (f.currentFrame.toggleClass("animate-out animate-in"), f.nextFrame.addClass("animate-in")) : (f.currentFrame.toggleClass("animate-out animate-in"), f.settings.transitionThreshold !== !0 && (f.transitionThresholdTimer = setTimeout(function () {
						f.nextFrame.addClass("animate-in");
					}, g)));
				}, 50));else switch (f.settings.fallback.theme) {case "fade":
						f.frames.css({ position: "relative" }), f.beforeCurrentFrameAnimatesOut(), f.currentFrame = f.frames.eq(f.currentFrameID - 1), f.currentFrame.animate({ opacity: 0 }, f.settings.fallback.speed, function () {
							f.currentFrame.css({ display: "none", "z-index": "1" }), f.afterCurrentFrameAnimatesOut(), f.beforeNextFrameAnimatesIn(), f.nextFrame.css({ display: "block", "z-index": f.numberOfFrames }).animate({ opacity: 1 }, 500, function () {
								f.afterNextFrameAnimatesIn();
							}), e();
						}), f.frames.css({ position: "relative" });break;case "slide":default:
						var h = {},
						    i = {},
						    j = {};1 === f.direction ? (h.left = "-100%", i.left = "100%") : (h.left = "100%", i.left = "-100%"), j.left = "0", j.opacity = 1, f.currentFrame = f.frames.eq(f.currentFrameID - 1), f.beforeCurrentFrameAnimatesOut(), f.currentFrame.animate(h, f.settings.fallback.speed, function () {
							f.currentFrame.css({ display: "none", "z-index": "1" }), f.afterCurrentFrameAnimatesOut();
						}), f.beforeNextFrameAnimatesIn(), f.nextFrame.show().css(i), f.nextFrame.css({ display: "block", "z-index": f.numberOfFrames }).animate(j, f.settings.fallback.speed, function () {
							e(), f.afterNextFrameAnimatesIn();
						});}f.currentFrameID = f.nextFrameID;
			}
		}, destroy: function destroy(b) {
			var c = this;c.container.addClass("sequence-destroyed"), void 0 !== c.nextButton && c.nextButton.unbind("click.sequence"), void 0 !== c.prevButton && c.prevButton.unbind("click.sequence"), void 0 !== c.pauseButton && c.pauseButton.unbind("click.sequence"), void 0 !== c.pagination && c.paginationLinks.unbind("click.sequence"), a(document).unbind("keydown.sequence"), c.canvas.unbind("mouseenter.sequence, mouseleave.sequence, touchstart.sequence, touchmove.sequence"), a(window).unbind("hashchange.sequence"), c.stopAutoPlay(), clearTimeout(c.transitionThresholdTimer), c.canvas.children("li").remove(), c.canvas.prepend(c.frames), c.frames.removeClass("animate-in animate-out").removeAttr("style"), c.frames.eq(c.currentFrameID - 1).addClass("animate-in"), void 0 !== c.nextButton && c.nextButton !== !1 && c.nextButton.hide(), void 0 !== c.prevButton && c.prevButton !== !1 && c.prevButton.hide(), void 0 !== c.pauseButton && c.pauseButton !== !1 && c.pauseButton.hide(), void 0 !== c.pauseIcon && c.pauseIcon !== !1 && c.pauseIcon.hide(), void 0 !== c.pagination && c.pagination !== !1 && c.pagination.hide(), void 0 !== b && b(), c.destroyed(), c.container.removeData();
		}, _initCustomKeyEvent: function _initCustomKeyEvent(a) {
			var b = this;switch (a) {case "next":
					b.next();break;case "prev":
					b.prev();break;case "pause":
					b.pause(!0);}
		}, _resetElements: function _resetElements(a, b, c) {
			var d = this;b.css(d._prefixCSS(a, { "transition-duration": c, "transition-delay": c, "transition-timing-function": "" }));
		}, _reverseTransitionProperties: function _reverseTransitionProperties() {
			var b = this,
			    c = [],
			    d = [];b.currentFrameChildren.each(function () {
				c.push(parseFloat(a(this).css(b.transitionPrefix + "transition-duration").replace("s", "")) + parseFloat(a(this).css(b.transitionPrefix + "transition-delay").replace("s", "")));
			}), b.nextFrameChildren.each(function () {
				d.push(parseFloat(a(this).css(b.transitionPrefix + "transition-duration").replace("s", "")) + parseFloat(a(this).css(b.transitionPrefix + "transition-delay").replace("s", "")));
			});var e = Math.max.apply(Math, c),
			    f = Math.max.apply(Math, d),
			    g = e - f,
			    h = 0,
			    i = 0;0 > g && !b.settings.preventDelayWhenReversingAnimations ? h = Math.abs(g) : g > 0 && (i = Math.abs(g));var j = function j(c, d, e, f) {
				function g(a) {
					a = a.split(",")[0];var b = { linear: "cubic-bezier(0.0,0.0,1.0,1.0)", ease: "cubic-bezier(0.25, 0.1, 0.25, 1.0)", "ease-in": "cubic-bezier(0.42, 0.0, 1.0, 1.0)", "ease-in-out": "cubic-bezier(0.42, 0.0, 0.58, 1.0)", "ease-out": "cubic-bezier(0.0, 0.0, 0.58, 1.0)" };return a.indexOf("cubic-bezier") < 0 && (a = b[a]), a;
				}d.each(function () {
					var d = parseFloat(a(this).css(b.transitionPrefix + "transition-duration").replace("s", "")),
					    h = parseFloat(a(this).css(b.transitionPrefix + "transition-delay").replace("s", "")),
					    i = a(this).css(b.transitionPrefix + "transition-timing-function");if (-1 === i.indexOf("cubic")) var i = g(i);if (b.settings.reverseEaseWhenNavigatingBackwards) {
						var j = i.replace("cubic-bezier(", "").replace(")", "").split(",");a.each(j, function (a, b) {
							j[a] = parseFloat(b);
						});var k = [1 - j[2], 1 - j[3], 1 - j[0], 1 - j[1]];i = "cubic-bezier(" + k + ")";
					}var l = d + h;c["transition-duration"] = d + "s", c["transition-delay"] = e - l + f + "s", c["transition-timing-function"] = i, a(this).css(b._prefixCSS(b.transitionPrefix, c));
				});
			};j(b.transitionProperties, b.currentFrameChildren, e, h), j(b.transitionProperties, b.nextFrameChildren, f, i);
		}, _prefixCSS: function _prefixCSS(a, b) {
			var c = {};for (var d in b) {
				c[a + d] = b[d];
			}return c;
		}, _resetAutoPlay: function _resetAutoPlay(a, b) {
			var c = this;a === !0 ? c.settings.autoPlay && !c.isSoftPaused && (clearTimeout(c.autoPlayTimer), c.autoPlayTimer = setTimeout(function () {
				1 === c.settings.autoPlayDirection ? c.next() : c.prev();
			}, b)) : clearTimeout(c.autoPlayTimer);
		}, _renderUiElements: function _renderUiElements(b, c) {
			var d = this;switch (b) {case !1:
					return void 0;case !0:
					return ".sequence-preloader" === c && d._defaultPreloader(d.container, d.transitionsSupported, d.animationPrefix), a(c, d.container);default:
					return a(b, d.container);}
		}, _waitForAnimationsToComplete: function _waitForAnimationsToComplete(b, c, d, e, f) {
			var g = this;if ("out" === d) var h = function h() {
				g.afterCurrentFrameAnimatesOut(), g.settings.transitionThreshold === !0 && (1 === f ? g.nextFrame.addClass("animate-in") : -1 === f && g.nextFrame.toggleClass("animate-out animate-in"));
			};else if ("in" === d) var h = function h() {
				g.afterNextFrameAnimatesIn(), g._setHashTag(), g.active = !1, g.isHardPaused || g.isBeingHoveredOver || (g.delayUnpause ? (g.delayUnpause = !1, g.unpause()) : g.unpause(!1));
			};c.data("animationEnded", !1), b.bind(g.transitionEnd, function (d) {
				a(d.target).data("animationEnded", !0);var e = !0;c.each(function () {
					return a(this).data("animationEnded") === !1 ? (e = !1, !1) : void 0;
				}), e && (b.unbind(g.transitionEnd), h());
			});
		}, _setHashTag: function _setHashTag() {
			var b = this;b.settings.hashTags && (b.currentHashTag = b.nextFrame.prop(b.getHashTagFrom), b.frameHashIndex = a.inArray(b.currentHashTag, b.frameHashID), -1 === b.frameHashIndex || !b.settings.hashChangesOnFirstFrame && b.isStartingFrame && b.transitionsSupported ? (b.nextFrameID = b.settings.startingFrameID, b.isStartingFrame = !1) : (b.nextFrameID = b.frameHashIndex + 1, document.location.hash = "#" + b.currentHashTag));
		}, _modernizrForSequence: function _modernizrForSequence() {
			window.ModernizrForSequence = function (a, b, c) {
				function d(a) {
					r.cssText = a;
				}function e(a, b) {
					return (typeof a === "undefined" ? "undefined" : _typeof(a)) === b;
				}function f(a, b) {
					return !!~("" + a).indexOf(b);
				}function g(a, b) {
					for (var d in a) {
						var e = a[d];if (!f(e, "-") && r[e] !== c) return "pfx" == b ? e : !0;
					}return !1;
				}function h(a, b, d) {
					for (var f in a) {
						var g = b[a[f]];if (g !== c) return d === !1 ? a[f] : e(g, "function") ? g.bind(d || b) : g;
					}return !1;
				}function i(a, b, c) {
					var d = a.charAt(0).toUpperCase() + a.slice(1),
					    f = (a + " " + t.join(d + " ") + d).split(" ");return e(b, "string") || e(b, "undefined") ? g(f, b) : (f = (a + " " + u.join(d + " ") + d).split(" "), h(f, b, c));
				}var j,
				    k,
				    l,
				    m = "2.6.1",
				    n = {},
				    o = b.documentElement,
				    p = "modernizrForSequence",
				    q = b.createElement(p),
				    r = q.style,
				    s = ({}.toString, "Webkit Moz O ms"),
				    t = s.split(" "),
				    u = s.toLowerCase().split(" "),
				    v = { svg: "http://www.w3.org/2000/svg" },
				    w = {},
				    x = [],
				    y = x.slice,
				    z = {}.hasOwnProperty;l = e(z, "undefined") || e(z.call, "undefined") ? function (a, b) {
					return b in a && e(a.constructor.prototype[b], "undefined");
				} : function (a, b) {
					return z.call(a, b);
				}, Function.prototype.bind || (Function.prototype.bind = function (a) {
					var b = self;if ("function" != typeof b) throw new TypeError();var c = y.call(arguments, 1),
					    d = function d() {
						if (self instanceof d) {
							var e = function e() {};e.prototype = b.prototype;var f = new e(),
							    g = b.apply(f, c.concat(y.call(arguments)));return Object(g) === g ? g : f;
						}return b.apply(a, c.concat(y.call(arguments)));
					};return d;
				}), w.svg = function () {
					return !!b.createElementNS && !!b.createElementNS(v.svg, "svg").createSVGRect;
				};for (var A in w) {
					l(w, A) && (k = A.toLowerCase(), n[k] = w[A](), x.push((n[k] ? "" : "no-") + k));
				}return n.addTest = function (a, b) {
					if ("object" == (typeof a === "undefined" ? "undefined" : _typeof(a))) for (var d in a) {
						l(a, d) && n.addTest(d, a[d]);
					} else {
						if (a = a.toLowerCase(), n[a] !== c) return n;b = "function" == typeof b ? b() : b, enableClasses && (o.className += " " + (b ? "" : "no-") + a), n[a] = b;
					}return n;
				}, d(""), q = j = null, n._version = m, n._domPrefixes = u, n._cssomPrefixes = t, n.testProp = function (a) {
					return g([a]);
				}, n.testAllProps = i, n.prefixed = function (a, b, c) {
					return b ? i(a, b, c) : i(a, "pfx");
				}, n;
			}(self, self.document);
		}, _defaultPreloader: function _defaultPreloader(b, c, d) {
			var e = '<div class="sequence-preloader"><svg class="preloading" xmlns="http://www.w3.org/2000/svg"><circle class="circle" cx="6" cy="6" r="6" /><circle class="circle" cx="22" cy="6" r="6" /><circle class="circle" cx="38" cy="6" r="6" /></svg></div>';a("head").append("<style>.sequence-preloader{height: 100%;position: absolute;width: 100%;z-index: 999999;}@" + d + "keyframes preload{0%{opacity: 1;}50%{opacity: 0;}100%{opacity: 1;}}.sequence-preloader .preloading .circle{fill: #ff9442;display: inline-block;height: 12px;position: relative;top: -50%;width: 12px;" + d + "animation: preload 1s infinite; animation: preload 1s infinite;}.preloading{display:block;height: 12px;margin: 0 auto;top: 50%;margin-top:-6px;position: relative;width: 48px;}.sequence-preloader .preloading .circle:nth-child(2){" + d + "animation-delay: .15s; animation-delay: .15s;}.sequence-preloader .preloading .circle:nth-child(3){" + d + "animation-delay: .3s; animation-delay: .3s;}.preloading-complete{opacity: 0;visibility: hidden;" + d + "transition-duration: 1s; transition-duration: 1s;}div.inline{background-color: #ff9442; margin-right: 4px; float: left;}</style>"), b.prepend(e), ModernizrForSequence.svg || c ? c || setInterval(function () {
				a(".sequence-preloader").fadeToggle(500);
			}, 500) : (a(".sequence-preloader").prepend('<div class="preloading"><div class="circle inline"></div><div class="circle inline"></div><div class="circle inline"></div></div>'), setInterval(function () {
				a(".sequence-preloader .circle").fadeToggle(500);
			}, 500));
		}, _operaTest: function _operaTest() {
			a("body").append('<span id="sequence-opera-test"></span>');var b = a("#sequence-opera-test");return b.css("-o-transition", "1s"), "1s" !== b.css("-o-transition") ? (b.remove(), !1) : (b.remove(), !0);
		} };var d = { startingFrameID: 1, cycle: !0, animateStartingFrameIn: !1, transitionThreshold: !1, reverseAnimationsWhenNavigatingBackwards: !0, reverseEaseWhenNavigatingBackwards: !0, preventDelayWhenReversingAnimations: !1, moveActiveFrameToTop: !0, windowLoaded: !1, autoPlay: !1, autoPlayDirection: 1, autoPlayDelay: 5e3, navigationSkip: !0, navigationSkipThreshold: 250, fadeFrameWhenSkipped: !0, fadeFrameTime: 150, preventReverseSkipping: !1, nextButton: !1, showNextButtonOnInit: !0, prevButton: !1, showPrevButtonOnInit: !0, pauseButton: !1, unpauseDelay: null, pauseOnHover: !0, pauseIcon: !1, showPauseButtonOnInit: !0, pagination: !1, showPaginationOnInit: !0, preloader: !1, preloadTheseFrames: [1], preloadTheseImages: [], hideFramesUntilPreloaded: !0, prependPreloadingComplete: !0, hidePreloaderUsingCSS: !0, hidePreloaderDelay: 0, keyNavigation: !0, numericKeysGoToFrames: !0, keyEvents: { left: "prev", right: "next" }, customKeyEvents: {}, swipeNavigation: !0, swipeThreshold: 20, swipePreventsDefault: !1, swipeEvents: { left: "prev", right: "next", up: !1, down: !1 }, hashTags: !1, hashDataAttribute: !1, hashChangesOnFirstFrame: !1, fallback: { theme: "slide", speed: 500 } };a.fn.sequence = function (c) {
		return this.each(function () {
			a.data(this, "sequence") || a.data(this, "sequence", new b(a(this), c, d));
		});
	};
}(jQuery);

/***/ }),

/***/ "./resources/assets/js/seq-slider/sequencejs-options.apple-style.js":
/***/ (function(module, exports) {

$(document).ready(function () {
    $status = $(".status");
    var options = {
        autoPlay: true,
        autoPlayDelay: 4000,
        pauseOnHover: false,
        hidePreloaderDelay: 500,
        nextButton: true,
        prevButton: true,
        pauseButton: true,
        preloader: true,
        hidePreloaderUsingCSS: false,
        animateStartingFrameIn: true,
        navigationSkipThreshold: 750,
        preventDelayWhenReversingAnimations: true,
        customKeyEvents: {
            80: "pause"
        }
    };

    var sequence = $("#sequence").sequence(options).data("sequence");

    sequence.afterNextFrameAnimatesIn = function () {
        if (sequence.settings.autoPlay && !sequence.hardPaused && !sequence.isPaused) {
            $status.addClass("active").css("opacity", 1);
        }
        $(".prev, .next").css("cursor", "pointer").animate({ "opacity": 1 }, 500);
    };
    sequence.beforeCurrentFrameAnimatesOut = function () {
        if (sequence.settings.autoPlay && !sequence.hardPaused) {
            $status.css({ "opacity": 0 }, 500).removeClass("active");
        }
        $(".prev, .next").css("cursor", "auto").animate({ "opacity": .7 }, 500);
    };
    sequence.paused = function () {
        $status.css({ "opacity": 0 }).removeClass("active").addClass("paused");
    };
    sequence.unpaused = function () {
        if (!sequence.hardPaused) {
            $status.removeClass("paused").addClass("active").css("opacity", 1);
        }
    };
});

/***/ }),

/***/ "./resources/assets/js/wow.min.js":
/***/ (function(module, exports) {

/*! WOW - v0.1.8 - 2014-05-09
 * Copyright (c) 2014 Matthieu Aussaguel; Licensed MIT */
(function () {
    var a,
        b = function b(a, _b) {
        return function () {
            return a.apply(_b, arguments);
        };
    };
    a = function () {
        function a() {}
        return a.prototype.extend = function (a, b) {
            var c, d;
            for (c in a) {
                d = a[c], null != d && (b[c] = d);
            }return b;
        }, a.prototype.isMobile = function (a) {
            return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)
            );
        }, a;
    }(), this.WOW = function () {
        function c(a) {
            null == a && (a = {}), this.scrollCallback = b(this.scrollCallback, this), this.scrollHandler = b(this.scrollHandler, this), this.start = b(this.start, this), this.scrolled = !0, this.config = this.util().extend(a, this.defaults);
        }
        return c.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0
        }, c.prototype.init = function () {
            var a;
            return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : document.addEventListener("DOMContentLoaded", this.start);
        }, c.prototype.start = function () {
            var a, b, c, d;
            if (this.boxes = this.element.getElementsByClassName(this.config.boxClass), this.boxes.length) {
                if (this.disabled()) return this.resetStyle();
                for (d = this.boxes, b = 0, c = d.length; c > b; b++) {
                    a = d[b], this.applyStyle(a, !0);
                }return window.addEventListener("scroll", this.scrollHandler, !1), window.addEventListener("resize", this.scrollHandler, !1), this.interval = setInterval(this.scrollCallback, 50);
            }
        }, c.prototype.stop = function () {
            return window.removeEventListener("scroll", this.scrollHandler, !1), window.removeEventListener("resize", this.scrollHandler, !1), null != this.interval ? clearInterval(this.interval) : void 0;
        }, c.prototype.show = function (a) {
            return this.applyStyle(a), a.className = "" + a.className + " " + this.config.animateClass;
        }, c.prototype.applyStyle = function (a, b) {
            var c, d, e;
            return d = a.getAttribute("data-wow-duration"), c = a.getAttribute("data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate(function (f) {
                return function () {
                    return f.customStyle(a, b, d, c, e);
                };
            }(this));
        }, c.prototype.animate = function () {
            return "requestAnimationFrame" in window ? function (a) {
                return window.requestAnimationFrame(a);
            } : function (a) {
                return a();
            };
        }(), c.prototype.resetStyle = function () {
            var a, b, c, d, e;
            for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) {
                a = d[b], e.push(a.setAttribute("style", "visibility: visible;"));
            }return e;
        }, c.prototype.customStyle = function (a, b, c, d, e) {
            return a.style.visibility = b ? "hidden" : "visible", b && (a.dataset.wowAnimationName = this.animationName(a)), c && this.vendorSet(a.style, {
                animationDuration: c
            }), d && this.vendorSet(a.style, {
                animationDelay: d
            }), e && this.vendorSet(a.style, {
                animationIterationCount: e
            }), this.vendorSet(a.style, {
                animationName: b ? "none" : a.dataset.wowAnimationName
            }), a;
        }, c.prototype.vendors = ["moz", "webkit"], c.prototype.vendorSet = function (a, b) {
            var c, d, e, f;
            f = [];
            for (c in b) {
                d = b[c], a["" + c] = d, f.push(function () {
                    var b, f, g, h;
                    for (g = this.vendors, h = [], b = 0, f = g.length; f > b; b++) {
                        e = g[b], h.push(a["" + e + c.charAt(0).toUpperCase() + c.substr(1)] = d);
                    }return h;
                }.call(this));
            }return f;
        }, c.prototype.vendorCSS = function (a, b) {
            var c, d, e, f, g, h;
            for (d = window.getComputedStyle(a), c = d.getPropertyCSSValue(b), h = this.vendors, f = 0, g = h.length; g > f; f++) {
                e = h[f], c = c || d.getPropertyCSSValue("-" + e + "-" + b);
            }return c;
        }, c.prototype.animationName = function (a) {
            var b;
            try {
                return null != (b = this.vendorCSS(a, "animation-name")) ? b.cssText : void 0;
            } catch (c) {
                return window.getComputedStyle(a).getPropertyValue("animation-name") || "none";
            }
        }, c.prototype.scrollHandler = function () {
            return this.scrolled = !0;
        }, c.prototype.scrollCallback = function () {
            var a;
            return this.scrolled && (this.scrolled = !1, this.boxes = function () {
                var b, c, d, e;
                for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) {
                    a = d[b], a && (this.isVisible(a) ? this.show(a) : e.push(a));
                }return e;
            }.call(this), !this.boxes.length) ? this.stop() : void 0;
        }, c.prototype.offsetTop = function (a) {
            var b;
            for (b = a.offsetTop; a = a.offsetParent;) {
                b += a.offsetTop;
            }return b;
        }, c.prototype.isVisible = function (a) {
            var b, c, d, e, f;
            return c = a.getAttribute("data-wow-offset") || this.config.offset, f = window.pageYOffset, e = f + this.element.clientHeight - c, d = this.offsetTop(a), b = d + a.clientHeight, e >= d && b >= f;
        }, c.prototype.util = function () {
            return this._util || (this._util = new a());
        }, c.prototype.disabled = function () {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent);
        }, c;
    }();
}).call(this);

/***/ }),

/***/ "./resources/assets/sass/rtl.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/jquery-1.8.3.min.js");
__webpack_require__("./resources/assets/js/jquery.easing.min.js");
__webpack_require__("./resources/assets/js/jquery.flexslider.js");
__webpack_require__("./resources/assets/js/jquery.parallax-1.1.3.js");
__webpack_require__("./resources/assets/js/bootstrap.min.js");
__webpack_require__("./resources/assets/js/hover-dropdown.js");
__webpack_require__("./resources/assets/js/link-hover.js");
__webpack_require__("./resources/assets/js/common-scripts.js");
__webpack_require__("./resources/assets/js/scrolling-nav.js");
__webpack_require__("./resources/assets/js/bxslider.js");
__webpack_require__("./resources/assets/js/wow.min.js");
__webpack_require__("./resources/assets/js/seq-slider/jquery.sequence-min.js");
__webpack_require__("./resources/assets/js/seq-slider/sequencejs-options.apple-style.js");
module.exports = __webpack_require__("./resources/assets/sass/rtl.scss");


/***/ })

/******/ });