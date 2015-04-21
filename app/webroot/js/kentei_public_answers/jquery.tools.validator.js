/*!
 * jQuery Tools v1.2.6 - The missing UI library for the Web
 * 
 * validator/validator.js
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/
 * 
 */
(function (a) {
    a.tools = a.tools || {
        version: "v1.2.6"
    };
    var b = /\[type=([a-z]+)\]/,
        c = /^-?[0-9]*(\.[0-9]+)?$/,
        d = a.tools.dateinput,
        e = /^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,6})$/i,
        f = /^(https?:\/\/)?[\da-z\.\-]+\.[a-z\.]{2,6}[#&+_\?\/\w \.\-=]*$/i,
        g;
    g = a.tools.validator = {
        conf: {
            grouped: !1,
            effect: "default",
            errorClass: "invalid",
            inputEvent: null,
            errorInputEvent: "keyup",
            formEvent: "submit",
            lang: "en",
            message: "<div/>",
            messageAttr: "data-message",
            messageClass: "error",
            offset: [0, 0],
            position: "center right",
            singleError: !1,
            speed: "normal"
        },
        messages: {
            "*": {
                en: "Please correct this value"
            }
        },
        localize: function (b, c) {
            a.each(c, function (a, c) {
                g.messages[a] = g.messages[a] || {}, g.messages[a][b] = c
            })
        },
        localizeFn: function (b, c) {
            g.messages[b] = g.messages[b] || {}, a.extend(g.messages[b], c)
        },
        fn: function (c, d, e) {
            a.isFunction(d) ? e = d : (typeof d == "string" && (d = {
                en: d
            }), this.messages[c.key || c] = d);
            var f = b.exec(c);
            f && (c = i(f[1])), j.push([c, e])
        },
        addEffect: function (a, b, c) {
            k[a] = [b, c]
        }
    };

    function h(b, c, d) {
        var e = b.offset().top,
            f = b.offset().left,
            g = d.position.split(/,?\s+/),
            h = g[0],
            i = g[1];
        e -= c.outerHeight() - d.offset[0], f += b.outerWidth() + d.offset[1], /iPad/i.test(navigator.userAgent) && (e -= a(window).scrollTop());
        var j = c.outerHeight() + b.outerHeight();
        h == "center" && (e += j / 2), h == "bottom" && (e += j);
        var k = b.outerWidth();
        i == "center" && (f -= (k + c.outerWidth()) / 2), i == "left" && (f -= k);
        return {
            top: e,
            left: f
        }
    }
    function i(a) {
        function b() {
            return this.getAttribute("type") == a
        }
        b.key = "[type=" + a + "]";
        return b
    }
    var j = [],
        k = {
            "default": [function (b) {
                var c = this.getConf();
                a.each(b, function (b, d) {
                    var e = d.input;
                    e.addClass(c.errorClass);
                    var f = e.data("msg.el");
                    f || (f = a(c.message).addClass(c.messageClass).appendTo(document.body), e.data("msg.el", f)), f.css({
                        visibility: "hidden"
                    }).find("p").remove(), a.each(d.messages, function (b, c) {
                        a("<p/>").html(c).appendTo(f)
                    }), f.outerWidth() == f.parent().width() && f.add(f.find("p")).css({
                        display: "inline"
                    });
                    var g = h(e, f, c);
                    f.css({
                        visibility: "visible",
                        position: "absolute",
                        top: g.top,
                        left: g.left
                    }).fadeIn(c.speed)
                })
            }, function (b) {
                var c = this.getConf();
                b.removeClass(c.errorClass).each(function () {
                    var b = a(this).data("msg.el");
                    b && b.css({
                        visibility: "hidden"
                    })
                })
            }]
        };
    a.each("email,url,number".split(","), function (b, c) {
        a.expr[":"][c] = function (a) {
            return a.getAttribute("type") === c
        }
    }), a.fn.oninvalid = function (a) {
        return this[a ? "bind" : "trigger"]("OI", a)
    }, g.fn(":email", "Please enter a valid email address", function (a, b) {
        return !b || e.test(b)
    }), g.fn(":url", "Please enter a valid URL", function (a, b) {
        return !b || f.test(b)
    }), g.fn(":number", "Please enter a numeric value.", function (a, b) {
        return c.test(b)
    }), g.fn("[max]", "Please enter a value no larger than $1", function (a, b) {
        if (b === "" || d && a.is(":date")) return !0;
        var c = a.attr("max");
        return parseFloat(b) <= parseFloat(c) ? !0 : [c]
    }), g.fn("[min]", "Please enter a value of at least $1", function (a, b) {
        if (b === "" || d && a.is(":date")) return !0;
        var c = a.attr("min");
        return parseFloat(b) >= parseFloat(c) ? !0 : [c]
    }), g.fn("[required]", "Please complete this mandatory field.", function (a, b) {
        if (a.is(":checkbox")) return a.is(":checked");
        return b
    }), g.fn("[pattern]", function (a) {
        var b = new RegExp("^" + a.attr("pattern") + "$");
        return b.test(a.val())
    });

    function l(b, c, e) {
        var f = this,
            i = c.add(f);
        b = b.not(":button, :image, :reset, :submit"), c.attr("novalidate", "novalidate");

        function l(b, c, d) {
            if (e.grouped || !b.length) {
                var f;
                if (d === !1 || a.isArray(d)) {
                    f = g.messages[c.key || c] || g.messages["*"], f = f[e.lang] || g.messages["*"].en;
                    var h = f.match(/\$\d/g);
                    h && a.isArray(d) && a.each(h, function (a) {
                        f = f.replace(this, d[a])
                    })
                } else f = d[e.lang] || d;
                b.push(f)
            }
        }
        a.extend(f, {
            getConf: function () {
                return e
            },
            getForm: function () {
                return c
            },
            getInputs: function () {
                return b
            },
            reflow: function () {
                b.each(function () {
                    var b = a(this),
                        c = b.data("msg.el");
                    if (c) {
                        var d = h(b, c, e);
                        c.css({
                            top: d.top,
                            left: d.left
                        })
                    }
                });
                return f
            },
            invalidate: function (c, d) {
                if (!d) {
                    var g = [];
                    a.each(c, function (a, c) {
                        var d = b.filter("[name='" + a + "']");
                        d.length && (d.trigger("OI", [c]), g.push({
                            input: d,
                            messages: [c]
                        }))
                    }), c = g, d = a.Event()
                }
                d.type = "onFail", i.trigger(d, [c]), d.isDefaultPrevented() || k[e.effect][0].call(f, c, d);
                return f
            },
            reset: function (c) {
                c = c || b, c.removeClass(e.errorClass).each(function () {
                    var b = a(this).data("msg.el");
                    b && (b.remove(), a(this).data("msg.el", null))
                }).unbind(e.errorInputEvent || "");
                return f
            },
            destroy: function () {
                c.unbind(e.formEvent + ".V").unbind("reset.V"), b.unbind(e.inputEvent + ".V").unbind("change.V");
                return f.reset()
            },
            checkValidity: function (c, g) {
                c = c || b, c = c.not(":disabled");
                if (!c.length) return !0;
                g = g || a.Event(), g.type = "onBeforeValidate", i.trigger(g, [c]);
                if (g.isDefaultPrevented()) return g.result;
                var h = [];
                c.not(":radio:not(:checked)").each(function () {
                    var b = [],
                        c = a(this).data("messages", b),
                        k = d && c.is(":date") ? "onHide.v" : e.errorInputEvent + ".v";
                    c.unbind(k), a.each(j, function () {
                        var a = this,
                            d = a[0];
                        if (c.filter(d).length) {
                            var h = a[1].call(f, c, c.val());
                            if (h !== !0) {
                                g.type = "onBeforeFail", i.trigger(g, [c, d]);
                                if (g.isDefaultPrevented()) return !1;
                                var j = c.attr(e.messageAttr);
                                if (j) {
                                    b = [j];
                                    return !1
                                }
                                l(b, d, h)
                            }
                        }
                    }), b.length && (h.push({
                        input: c,
                        messages: b
                    }), c.trigger("OI", [b]), e.errorInputEvent && c.bind(k, function (a) {
                        f.checkValidity(c, a)
                    }));
                    if (e.singleError && h.length) return !1
                });
                var m = k[e.effect];
                if (!m) throw "Validator: cannot find effect \"" + e.effect + "\"";
                if (h.length) {
                    f.invalidate(h, g);
                    return !1
                }
                m[1].call(f, c, g), g.type = "onSuccess", i.trigger(g, [c]), c.unbind(e.errorInputEvent + ".v");
                return !0
            }
        }), a.each("onBeforeValidate,onBeforeFail,onFail,onSuccess".split(","), function (b, c) {
            a.isFunction(e[c]) && a(f).bind(c, e[c]), f[c] = function (b) {
                b && a(f).bind(c, b);
                return f
            }
        }), e.formEvent && c.bind(e.formEvent + ".V", function (a) {
            if (!f.checkValidity(null, a)) return a.preventDefault();
            a.target = c, a.type = e.formEvent
        }), c.bind("reset.V", function () {
            f.reset()
        }), b[0] && b[0].validity && b.each(function () {
            this.oninvalid = function () {
                return !1
            }
        }), c[0] && (c[0].checkValidity = f.checkValidity), e.inputEvent && b.bind(e.inputEvent + ".V", function (b) {
            f.checkValidity(a(this), b)
        }), b.filter(":checkbox, select").filter("[required]").bind("change.V", function (b) {
            var c = a(this);
            (this.checked || c.is("select") && a(this).val()) && k[e.effect][1].call(f, c, b)
        });
        var m = b.filter(":radio").change(function (a) {
            f.checkValidity(m, a)
        });
        a(window).resize(function () {
            f.reflow()
        })
    }
    a.fn.validator = function (b) {
        var c = this.data("validator");
        c && (c.destroy(), this.removeData("validator")), b = a.extend(!0, {}, g.conf, b);
        if (this.is("form")) return this.each(function () {
            var d = a(this);
            c = new l(d.find(":input"), d, b), d.data("validator", c)
        });
        c = new l(this, this.eq(0).closest("form"), b);
        return this.data("validator", c)
    }
})(jQuery);