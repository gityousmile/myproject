var Zepto = function() {
    function t(t) {
        return null == t ? t + "": V[B.call(t)] || "object"
    }
    function e(e) {
        return "function" == t(e)
    }
    function n(t) {
        return null != t && t == t.window
    }
    function i(t) {
        return null != t && t.nodeType == t.DOCUMENT_NODE
    }
    function r(e) {
        return "object" == t(e)
    }
    function o(t) {
        return r(t) && !n(t) && Object.getPrototypeOf(t) == Object.prototype
    }
    function a(t) {
        return "number" == typeof t.length
    }
    function s(t) {
        return O.call(t,
            function(t) {
                return null != t
            })
    }
    function u(t) {
        return t.length > 0 ? T.fn.concat.apply([], t) : t
    }
    function c(t) {
        return t.replace(/::/g, "/").replace(/([A-Z]+)([A-Z][a-z])/g, "$1_$2").replace(/([a-z\d])([A-Z])/g, "$1_$2").replace(/_/g, "-").toLowerCase()
    }
    function l(t) {
        return t in M ? M[t] : M[t] = RegExp("(^|\\s)" + t + "(\\s|$)")
    }
    function f(t, e) {
        return "number" != typeof e || Z[c(t)] ? e: e + "px"
    }
    function h(t) {
        var e, n;
        return D[t] || (e = A.createElement(t), A.body.appendChild(e), n = getComputedStyle(e, "").getPropertyValue("display"), e.parentNode.removeChild(e), "none" == n && (n = "block"), D[t] = n),
        D[t]
    }
    function p(t) {
        return "children" in t ? P.call(t.children) : T.map(t.childNodes,
            function(t) {
                return 1 == t.nodeType ? t: b
            })
    }
    function d(t, e, n) {
        for (E in e) {
            n && (o(e[E]) || W(e[E])) ? (o(e[E]) && !o(t[E]) && (t[E] = {}), W(e[E]) && !W(t[E]) && (t[E] = []), d(t[E], e[E], n)) : e[E] !== b && (t[E] = e[E])
        }
    }
    function m(t, e) {
        return null == e ? T(t) : T(t).filter(e)
    }
    function g(t, n, i, r) {
        return e(n) ? n.call(t, i, r) : n
    }
    function v(t, e, n) {
        null == n ? t.removeAttribute(e) : t.setAttribute(e, n)
    }
    function y(t, e) {
        var n = t.className || "",
        i = n && n.baseVal !== b;
        return e === b ? i ? n.baseVal: n: (i ? n.baseVal = e: t.className = e, b)
    }
    function x(t) {
        var e;
        try {
            return t ? "true" == t || ("false" == t ? !1 : "null" == t ? null: /^0/.test(t) || isNaN(e = Number(t)) ? /^[\[\{]/.test(t) ? T.parseJSON(t) : t: e) : t
        } catch(n) {
            return t
        }
    }
    function w(t, e) {
        e(t);
        for (var n = 0,
            i = t.childNodes.length; i > n; n++) {
            w(t.childNodes[n], e)
        }
    }
    var b, E, T, j, C, N, S = [],
    P = S.slice,
    O = S.filter,
    A = window.document,
    D = {},
    M = {},
    Z = {
        "column-count": 1,
        columns: 1,
        "font-weight": 1,
        "line-height": 1,
        opacity: 1,
        "z-index": 1,
        zoom: 1
    },
    L = /^\s*<(\w+|!)[^>]*>/,
    $ = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
    _ = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
    R = /^(?:body|html)$/i,
    k = /([A-Z])/g,
    z = ["val", "css", "html", "text", "data", "width", "height", "offset"],
    q = ["after", "prepend", "before", "append"],
    F = A.createElement("table"),
    I = A.createElement("tr"),
    H = {
        tr: A.createElement("tbody"),
        tbody: F,
        thead: F,
        tfoot: F,
        td: I,
        th: I,
        "*": A.createElement("div")
    },
    U = /complete|loaded|interactive/,
    X = /^[\w-]*$/,
    V = {},
    B = V.toString,
    Y = {},
    G = A.createElement("div"),
    J = {
        tabindex: "tabIndex",
        readonly: "readOnly",
        "for": "htmlFor",
        "class": "className",
        maxlength: "maxLength",
        cellspacing: "cellSpacing",
        cellpadding: "cellPadding",
        rowspan: "rowSpan",
        colspan: "colSpan",
        usemap: "useMap",
        frameborder: "frameBorder",
        contenteditable: "contentEditable"
    },
    W = Array.isArray ||
    function(t) {
        return t instanceof Array
    };
    return Y.matches = function(t, e) {
        if (!e || !t || 1 !== t.nodeType) {
            return ! 1
        }
        var n = t.webkitMatchesSelector || t.mozMatchesSelector || t.oMatchesSelector || t.matchesSelector;
        if (n) {
            return n.call(t, e)
        }
        var i, r = t.parentNode,
        o = !r;
        return o && (r = G).appendChild(t),
        i = ~Y.qsa(r, e).indexOf(t),
        o && G.removeChild(t),
        i
    },
    C = function(t) {
        return t.replace(/-+(.)?/g,
            function(t, e) {
                return e ? e.toUpperCase() : ""
            })
    },
    N = function(t) {
        return O.call(t,
            function(e, n) {
                return t.indexOf(e) == n
            })
    },
    Y.fragment = function(t, e, n) {
        var i, r, a;
        return $.test(t) && (i = T(A.createElement(RegExp.$1))),
        i || (t.replace && (t = t.replace(_, "<$1></$2>")), e === b && (e = L.test(t) && RegExp.$1), e in H || (e = "*"), a = H[e], a.innerHTML = "" + t, i = T.each(P.call(a.childNodes),
            function() {
                a.removeChild(this)
            })),
        o(n) && (r = T(i), T.each(n,
            function(t, e) {
                z.indexOf(t) > -1 ? r[t](e) : r.attr(t, e)
            })),
        i
    },
    Y.Z = function(t, e) {
        return t = t || [],
        t.__proto__ = T.fn,
        t.selector = e || "",
        t
    },
    Y.isZ = function(t) {
        return t instanceof Y.Z
    },
    Y.init = function(t, n) {
        var i;
        if (!t) {
            return Y.Z()
        }
        if ("string" == typeof t) {
            if (t = t.trim(), "<" == t[0] && L.test(t)) {
                i = Y.fragment(t, RegExp.$1, n),
                t = null
            }
            else {
                if (n !== b) {
                    return T(n).find(t)
                }
                i = Y.qsa(A, t)
            }
        } else {
            if (e(t)) {
                return T(A).ready(t)
            }
            if (Y.isZ(t)) {
                return t
            }
            if (W(t)) {
                i = s(t)
            } else {
                if (r(t)) {
                    i = [t],
                    t = null
                } else {
                    if (L.test(t)) {
                        i = Y.fragment(t.trim(), RegExp.$1, n),
                        t = null
                    } else {
                        if (n !== b) {
                            return T(n).find(t)
                        }
                        i = Y.qsa(A, t)
                    }
                }
            }
        }
        return Y.Z(i, t)
    },
    T = function(t, e) {
        return Y.init(t, e)
    },
    T.extend = function(t) {
        var e, n = P.call(arguments, 1);
        return "boolean" == typeof t && (e = t, t = n.shift()),
        n.forEach(function(n) {
            d(t, n, e)
        }),
        t
    },
    Y.qsa = function(t, e) {
        var n, r = "#" == e[0],
        o = !r && "." == e[0],
        a = r || o ? e.slice(1) : e,
        s = X.test(a);
        return i(t) && s && r ? (n = t.getElementById(a)) ? [n] : [] : 1 !== t.nodeType && 9 !== t.nodeType ? [] : P.call(s && !r ? o ? t.getElementsByClassName(a) : t.getElementsByTagName(e) : t.querySelectorAll(e))
    },
    T.contains = A.documentElement.contains ?
    function(t, e) {
        return t !== e && t.contains(e)
    }: function(t, e) {
        for (; e && (e = e.parentNode);) {
            if (e === t) {
                return ! 0
            }
        }
        return ! 1
    },
    T.type = t,
    T.isFunction = e,
    T.isWindow = n,
    T.isArray = W,
    T.isPlainObject = o,
    T.isEmptyObject = function(t) {
        var e;
        for (e in t) {
            return ! 1
        }
        return ! 0
    },
    T.inArray = function(t, e, n) {
        return S.indexOf.call(e, t, n)
    },
    T.camelCase = C,
    T.trim = function(t) {
        return null == t ? "": String.prototype.trim.call(t)
    },
    T.uuid = 0,
    T.support = {},
    T.expr = {},
    T.map = function(t, e) {
        var n, i, r, o = [];
        if (a(t)) {
            for (i = 0; t.length > i; i++) {
                n = e(t[i], i),
                null != n && o.push(n)
            }
        } else {
            for (r in t) {
                n = e(t[r], r),
                null != n && o.push(n)
            }
        }
        return u(o)
    },
    T.each = function(t, e) {
        var n, i;
        if (a(t)) {
            for (n = 0; t.length > n; n++) {
                if (e.call(t[n], n, t[n]) === !1) {
                    return t
                }
            }
        } else {
            for (i in t) {
                if (e.call(t[i], i, t[i]) === !1) {
                    return t
                }
            }
        }
        return t
    },
    T.grep = function(t, e) {
        return O.call(t, e)
    },
    window.JSON && (T.parseJSON = JSON.parse),
    T.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),
        function(t, e) {
            V["[object " + e + "]"] = e.toLowerCase()
        }),
    T.fn = {
        forEach: S.forEach,
        reduce: S.reduce,
        push: S.push,
        sort: S.sort,
        indexOf: S.indexOf,
        concat: S.concat,
        map: function(t) {
            return T(T.map(this,
                function(e, n) {
                    return t.call(e, n, e)
                }))
        },
        slice: function() {
            return T(P.apply(this, arguments))
        },
        ready: function(t) {
            return U.test(A.readyState) && A.body ? t(T) : A.addEventListener("DOMContentLoaded",
                function() {
                    t(T)
                },
                !1),
            this
        },
        get: function(t) {
            return t === b ? P.call(this) : this[t >= 0 ? t: t + this.length]
        },
        toArray: function() {
            return this.get()
        },
        size: function() {
            return this.length
        },
        remove: function() {
            return this.each(function() {
                null != this.parentNode && this.parentNode.removeChild(this)
            })
        },
        each: function(t) {
            return S.every.call(this,
                function(e, n) {
                    return t.call(e, n, e) !== !1
                }),
            this
        },
        filter: function(t) {
            return e(t) ? this.not(this.not(t)) : T(O.call(this,
                function(e) {
                    return Y.matches(e, t)
                }))
        },
        add: function(t, e) {
            return T(N(this.concat(T(t, e))))
        },
        is: function(t) {
            return this.length > 0 && Y.matches(this[0], t)
        },
        not: function(t) {
            var n = [];
            if (e(t) && t.call !== b) {
                this.each(function(e) {
                    t.call(this, e) || n.push(this)
                })
            } else {
                var i = "string" == typeof t ? this.filter(t) : a(t) && e(t.item) ? P.call(t) : T(t);
                this.forEach(function(t) {
                    0 > i.indexOf(t) && n.push(t)
                })
            }
            return T(n)
        },
        has: function(t) {
            return this.filter(function() {
                return r(t) ? T.contains(this, t) : T(this).find(t).size()
            })
        },
        eq: function(t) {
            return - 1 === t ? this.slice(t) : this.slice(t, +t + 1)
        },
        first: function() {
            var t = this[0];
            return t && !r(t) ? t: T(t)
        },
        last: function() {
            var t = this[this.length - 1];
            return t && !r(t) ? t: T(t)
        },
        find: function(t) {
            var e, n = this;
            return e = t ? "object" == typeof t ? T(t).filter(function() {
                var t = this;
                return S.some.call(n,
                    function(e) {
                        return T.contains(e, t)
                    })
            }) : 1 == this.length ? T(Y.qsa(this[0], t)) : this.map(function() {
                return Y.qsa(this, t)
            }) : []
        },
        closest: function(t, e) {
            var n = this[0],
            r = !1;
            for ("object" == typeof t && (r = T(t)); n && !(r ? r.indexOf(n) >= 0 : Y.matches(n, t));) {
                n = n !== e && !i(n) && n.parentNode
            }
            return T(n)
        },
        parents: function(t) {
            for (var e = [], n = this; n.length > 0;) {
                n = T.map(n,
                    function(t) {
                        return (t = t.parentNode) && !i(t) && 0 > e.indexOf(t) ? (e.push(t), t) : b
                    })
            }
            return m(e, t)
        },
        parent: function(t) {
            return m(N(this.pluck("parentNode")), t)
        },
        children: function(t) {
            return m(this.map(function() {
                return p(this)
            }), t)
        },
        contents: function() {
            return this.map(function() {
                return P.call(this.childNodes)
            })
        },
        siblings: function(t) {
            return m(this.map(function(t, e) {
                return O.call(p(e.parentNode),
                    function(t) {
                        return t !== e
                    })
            }), t)
        },
        empty: function() {
            return this.each(function() {
                this.innerHTML = ""
            })
        },
        pluck: function(t) {
            return T.map(this,
                function(e) {
                    return e[t]
                })
        },
        show: function() {
            return this.each(function() {
                "none" == this.style.display && (this.style.display = ""),
                "none" == getComputedStyle(this, "").getPropertyValue("display") && (this.style.display = h(this.nodeName))
            })
        },
        replaceWith: function(t) {
            return this.before(t).remove()
        },
        wrap: function(t) {
            var n = e(t);
            if (this[0] && !n) {
                var i = T(t).get(0),
                r = i.parentNode || this.length > 1
            }
            return this.each(function(e) {
                T(this).wrapAll(n ? t.call(this, e) : r ? i.cloneNode(!0) : i)
            })
        },
        wrapAll: function(t) {
            if (this[0]) {
                T(this[0]).before(t = T(t));
                for (var e; (e = t.children()).length;) {
                    t = e.first()
                }
                T(t).append(this)
            }
            return this
        },
        wrapInner: function(t) {
            var n = e(t);
            return this.each(function(e) {
                var i = T(this),
                r = i.contents(),
                o = n ? t.call(this, e) : t;
                r.length ? r.wrapAll(o) : i.append(o)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                T(this).replaceWith(T(this).children())
            }),
            this
        },
        clone: function() {
            return this.map(function() {
                return this.cloneNode(!0)
            })
        },
        hide: function() {
            return this.css("display", "none")
        },
        toggle: function(t) {
            return this.each(function() {
                var e = T(this);
                (t === b ? "none" == e.css("display") : t) ? e.show() : e.hide()
            })
        },
        prev: function(t) {
            return T(this.pluck("previousElementSibling")).filter(t || "*")
        },
        next: function(t) {
            return T(this.pluck("nextElementSibling")).filter(t || "*")
        },
        html: function(t) {
            return 0 in arguments ? this.each(function(e) {
                var n = this.innerHTML;
                T(this).empty().append(g(this, t, e, n))
            }) : 0 in this ? this[0].innerHTML: null
        },
        text: function(t) {
            return 0 in arguments ? this.each(function(e) {
                var n = g(this, t, e, this.textContent);
                this.textContent = null == n ? "": "" + n
            }) : 0 in this ? this[0].textContent: null
        },
        attr: function(t, e) {
            var n;
            return "string" != typeof t || 1 in arguments ? this.each(function(n) {
                if (1 === this.nodeType) {
                    if (r(t)) {
                        for (E in t) {
                            v(this, E, t[E])
                        }
                    } else {
                        v(this, t, g(this, e, n, this.getAttribute(t)))
                    }
                }
            }) : this.length && 1 === this[0].nodeType ? !(n = this[0].getAttribute(t)) && t in this[0] ? this[0][t] : n: b
        },
        removeAttr: function(t) {
            return this.each(function() {
                1 === this.nodeType && v(this, t)
            })
        },
        prop: function(t, e) {
            return t = J[t] || t,
            1 in arguments ? this.each(function(n) {
                this[t] = g(this, e, n, this[t])
            }) : this[0] && this[0][t]
        },
        data: function(t, e) {
            var n = "data-" + t.replace(k, "-$1").toLowerCase(),
            i = 1 in arguments ? this.attr(n, e) : this.attr(n);
            return null !== i ? x(i) : b
        },
        val: function(t) {
            return 0 in arguments ? this.each(function(e) {
                this.value = g(this, t, e, this.value)
            }) : this[0] && (this[0].multiple ? T(this[0]).find("option").filter(function() {
                return this.selected
            }).pluck("value") : this[0].value)
        },
        offset: function(t) {
            if (t) {
                return this.each(function(e) {
                    var n = T(this),
                    i = g(this, t, e, n.offset()),
                    r = n.offsetParent().offset(),
                    o = {
                        top: i.top - r.top,
                        left: i.left - r.left
                    };
                    "static" == n.css("position") && (o.position = "relative"),
                    n.css(o)
                })
            }
            if (!this.length) {
                return null
            }
            var e = this[0].getBoundingClientRect();
            return {
                left: e.left + window.pageXOffset,
                top: e.top + window.pageYOffset,
                width: Math.round(e.width),
                height: Math.round(e.height)
            }
        },
        css: function(e, n) {
            if (2 > arguments.length) {
                var i = this[0],
                r = getComputedStyle(i, "");
                if (!i) {
                    return
                }
                if ("string" == typeof e) {
                    return i.style[C(e)] || r.getPropertyValue(e)
                }
                if (W(e)) {
                    var o = {};
                    return T.each(e,
                        function(t, e) {
                            o[e] = i.style[C(e)] || r.getPropertyValue(e)
                        }),
                    o
                }
            }
            var a = "";
            if ("string" == t(e)) {
                n || 0 === n ? a = c(e) + ":" + f(e, n) : this.each(function() {
                    this.style.removeProperty(c(e))
                })
            } else {
                for (E in e) {
                    e[E] || 0 === e[E] ? a += c(E) + ":" + f(E, e[E]) + ";": this.each(function() {
                        this.style.removeProperty(c(E))
                    })
                }
            }
            return this.each(function() {
                this.style.cssText += ";" + a
            })
        },
        index: function(t) {
            return t ? this.indexOf(T(t)[0]) : this.parent().children().indexOf(this[0])
        },
        hasClass: function(t) {
            return t ? S.some.call(this,
                function(t) {
                    return this.test(y(t))
                },
                l(t)) : !1
        },
        addClass: function(t) {
            return t ? this.each(function(e) {
                if ("className" in this) {
                    j = [];
                    var n = y(this),
                    i = g(this, t, e, n);
                    i.split(/\s+/g).forEach(function(t) {
                        T(this).hasClass(t) || j.push(t)
                    },
                    this),
                    j.length && y(this, n + (n ? " ": "") + j.join(" "))
                }
            }) : this
        },
        removeClass: function(t) {
            return this.each(function(e) {
                if ("className" in this) {
                    if (t === b) {
                        return y(this, "")
                    }
                    j = y(this),
                    g(this, t, e, j).split(/\s+/g).forEach(function(t) {
                        j = j.replace(l(t), " ")
                    }),
                    y(this, j.trim())
                }
            })
        },
        toggleClass: function(t, e) {
            return t ? this.each(function(n) {
                var i = T(this),
                r = g(this, t, n, y(this));
                r.split(/\s+/g).forEach(function(t) {
                    (e === b ? !i.hasClass(t) : e) ? i.addClass(t) : i.removeClass(t)
                })
            }) : this
        },
        scrollTop: function(t) {
            if (this.length) {
                var e = "scrollTop" in this[0];
                return t === b ? e ? this[0].scrollTop: this[0].pageYOffset: this.each(e ?
                    function() {
                        this.scrollTop = t
                    }: function() {
                        this.scrollTo(this.scrollX, t)
                    })
            }
        },
        scrollLeft: function(t) {
            if (this.length) {
                var e = "scrollLeft" in this[0];
                return t === b ? e ? this[0].scrollLeft: this[0].pageXOffset: this.each(e ?
                    function() {
                        this.scrollLeft = t
                    }: function() {
                        this.scrollTo(t, this.scrollY)
                    })
            }
        },
        position: function() {
            if (this.length) {
                var t = this[0],
                e = this.offsetParent(),
                n = this.offset(),
                i = R.test(e[0].nodeName) ? {
                    top: 0,
                    left: 0
                }: e.offset();
                return n.top -= parseFloat(T(t).css("margin-top")) || 0,
                n.left -= parseFloat(T(t).css("margin-left")) || 0,
                i.top += parseFloat(T(e[0]).css("border-top-width")) || 0,
                i.left += parseFloat(T(e[0]).css("border-left-width")) || 0,
                {
                    top: n.top - i.top,
                    left: n.left - i.left
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var t = this.offsetParent || A.body; t && !R.test(t.nodeName) && "static" == T(t).css("position");) {
                    t = t.offsetParent
                }
                return t
            })
        }
    },
    T.fn.detach = T.fn.remove,
    ["width", "height"].forEach(function(t) {
        var e = t.replace(/./,
            function(t) {
                return t[0].toUpperCase()
            });
        T.fn[t] = function(r) {
            var o, a = this[0];
            return r === b ? n(a) ? a["inner" + e] : i(a) ? a.documentElement["scroll" + e] : (o = this.offset()) && o[t] : this.each(function(e) {
                a = T(this),
                a.css(t, g(this, r, e, a[t]()))
            })
        }
    }),
    q.forEach(function(e, n) {
        var i = n % 2;
        T.fn[e] = function() {
            var e, r, o = T.map(arguments,
                function(n) {
                    return e = t(n),
                    "object" == e || "array" == e || null == n ? n: Y.fragment(n)
                }),
            a = this.length > 1;
            return 1 > o.length ? this: this.each(function(t, e) {
                r = i ? e: e.parentNode,
                e = 0 == n ? e.nextSibling: 1 == n ? e.firstChild: 2 == n ? e: null;
                var s = T.contains(A.documentElement, r);
                o.forEach(function(t) {
                    if (a) {
                        t = t.cloneNode(!0)
                    } else {
                        if (!r) {
                            return T(t).remove()
                        }
                    }
                    r.insertBefore(t, e),
                    s && w(t,
                        function(t) {
                            null == t.nodeName || "SCRIPT" !== t.nodeName.toUpperCase() || t.type && "text/javascript" !== t.type || t.src || window.eval.call(window, t.innerHTML)
                        })
                })
            })
        },
        T.fn[i ? e + "To": "insert" + (n ? "Before": "After")] = function(t) {
            return T(t)[e](this),
            this
        }
    }),
    Y.Z.prototype = T.fn,
    Y.uniq = N,
    Y.deserializeValue = x,
    T.zepto = Y,
    T
} ();
window.Zepto = Zepto,
    void 0 === window.$ && (window.$ = Zepto),
    function(t) {
        function e(e, n, i) {
            var r = t.Event(n);
            return t(e).trigger(r, i),
            !r.isDefaultPrevented()
        }
        function n(t, n, i, r) {
            return t.global ? e(n || y, i, r) : void 0
        }
        function i(e) {
            e.global && 0 === t.active++&&n(e, null, "ajaxStart")
        }
        function r(e) {
            e.global && !--t.active && n(e, null, "ajaxStop")
        }
        function o(t, e) {
            var i = e.context;
            return e.beforeSend.call(i, t, e) === !1 || n(e, i, "ajaxBeforeSend", [t, e]) === !1 ? !1 : (n(e, i, "ajaxSend", [t, e]), void 0)
        }
        function a(t, e, i, r) {
            var o = i.context,
            a = "success";
            i.success.call(o, t, a, e),
            r && r.resolveWith(o, [t, a, e]),
            n(i, o, "ajaxSuccess", [e, i, t]),
            u(a, e, i)
        }
        function s(t, e, i, r, o) {
            var a = r.context;
            r.error.call(a, i, e, t),
            o && o.rejectWith(a, [i, e, t]),
            n(r, a, "ajaxError", [i, r, t || e]),
            u(e, i, r)
        }
        function u(t, e, i) {
            var o = i.context;
            i.complete.call(o, e, t),
            n(i, o, "ajaxComplete", [e, i]),
            r(i)
        }
        function c() {}
        function l(t) {
            return t && (t = t.split(";", 2)[0]),
            t && (t == T ? "html": t == E ? "json": w.test(t) ? "script": b.test(t) && "xml") || "text"
        }
        function f(t, e) {
            return "" == e ? t: (t + "&" + e).replace(/[&?]{1,2}/, "?")
        }
        function h(e) {
            e.processData && e.data && "string" != t.type(e.data) && (e.data = t.param(e.data, e.traditional)),
            !e.data || e.type && "GET" != e.type.toUpperCase() || (e.url = f(e.url, e.data), e.data = void 0)
        }
        function p(e, n, i, r) {
            return t.isFunction(n) && (r = i, i = n, n = void 0),
            t.isFunction(i) || (r = i, i = void 0),
            {
                url: e,
                data: n,
                success: i,
                dataType: r
            }
        }
        function d(e, n, i, r) {
            var o, a = t.isArray(n),
            s = t.isPlainObject(n);
            t.each(n,
                function(n, u) {
                    o = t.type(u),
                    r && (n = i ? r: r + "[" + (s || "object" == o || "array" == o ? n: "") + "]"),
                    !r && a ? e.add(u.name, u.value) : "array" == o || !i && "object" == o ? d(e, u, i, n) : e.add(n, u)
                })
        }
        var m, g, v = 0,
        y = window.document,
        x = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
        w = /^(?:text|application)\/javascript/i,
        b = /^(?:text|application)\/xml/i,
        E = "application/json",
        T = "text/html",
        j = /^\s*$/;
        t.active = 0,
        t.ajaxJSONP = function(e, n) {
            if (! ("type" in e)) {
                return t.ajax(e)
            }
            var i, r, u = e.jsonpCallback,
            c = (t.isFunction(u) ? u() : u) || "jsonp" + ++v,
            l = y.createElement("script"),
            f = window[c],
            h = function(e) {
                t(l).triggerHandler("error", e || "abort")
            },
            p = {
                abort: h
            };
            return n && n.promise(p),
            t(l).on("load error",
                function(o, u) {
                    clearTimeout(r),
                    t(l).off().remove(),
                    "error" != o.type && i ? a(i[0], p, e, n) : s(null, u || "error", p, e, n),
                    window[c] = f,
                    i && t.isFunction(f) && f(i[0]),
                    f = i = void 0
                }),
            o(p, e) === !1 ? (h("abort"), p) : (window[c] = function() {
                i = arguments
            },
            l.src = e.url.replace(/\?(.+)=\?/, "?$1=" + c), y.head.appendChild(l), e.timeout > 0 && (r = setTimeout(function() {
                h("timeout")
            },
            e.timeout)), p)
        },
        t.ajaxSettings = {
            type: "GET",
            beforeSend: c,
            success: c,
            error: c,
            complete: c,
            context: null,
            global: !0,
            xhr: function() {
                return new window.XMLHttpRequest
            },
            accepts: {
                script: "text/javascript, application/javascript, application/x-javascript",
                json: E,
                xml: "application/xml, text/xml",
                html: T,
                text: "text/plain"
            },
            crossDomain: !1,
            timeout: 0,
            processData: !0,
            cache: !0
        },
        t.ajax = function(e) {
            var n = t.extend({},
                e || {}),
            r = t.Deferred && t.Deferred();
            for (m in t.ajaxSettings) {
                void 0 === n[m] && (n[m] = t.ajaxSettings[m])
            }
            i(n),
            n.crossDomain || (n.crossDomain = /^([\w-]+:)?\/\/([^\/]+)/.test(n.url) && RegExp.$2 != window.location.host),
            n.url || (n.url = "" + window.location),
            h(n);
            var u = n.dataType,
            p = /\?.+=\?/.test(n.url);
            if (p && (u = "jsonp"), n.cache !== !1 && (e && e.cache === !0 || "script" != u && "jsonp" != u) || (n.url = f(n.url, "_=" + Date.now())), "jsonp" == u) {
                return p || (n.url = f(n.url, n.jsonp ? n.jsonp + "=?": n.jsonp === !1 ? "": "callback=?")),
                t.ajaxJSONP(n, r)
            }
            var d, v = n.accepts[u],
            y = {},
            x = function(t, e) {
                y[t.toLowerCase()] = [t, e]
            },
            w = /^([\w-]+:)\/\//.test(n.url) ? RegExp.$1: window.location.protocol,
            b = n.xhr(),
            E = b.setRequestHeader;
            if (r && r.promise(b), n.crossDomain || x("X-Requested-With", "XMLHttpRequest"), x("Accept", v || "*/*"), (v = n.mimeType || v) && (v.indexOf(",") > -1 && (v = v.split(",", 2)[0]), b.overrideMimeType && b.overrideMimeType(v)), (n.contentType || n.contentType !== !1 && n.data && "GET" != n.type.toUpperCase()) && x("Content-Type", n.contentType || "application/x-www-form-urlencoded"), n.headers) {
                for (g in n.headers) {
                    x(g, n.headers[g])
                }
            }
            if (b.setRequestHeader = x, b.onreadystatechange = function() {
                if (4 == b.readyState) {
                    b.onreadystatechange = c,
                    clearTimeout(d);
                    var e, i = !1;
                    if (b.status >= 200 && 300 > b.status || 304 == b.status || 0 == b.status && "file:" == w) {
                        u = u || l(n.mimeType || b.getResponseHeader("content-type")),
                        e = b.responseText;
                        try {
                            "script" == u ? (1, eval)(e) : "xml" == u ? e = b.responseXML: "json" == u && (e = j.test(e) ? null: t.parseJSON(e))
                        } catch(o) {
                            i = o
                        }
                        i ? s(i, "parsererror", b, n, r) : a(e, b, n, r)
                    } else {
                        s(b.statusText || null, b.status ? "error": "abort", b, n, r)
                    }
                }
            },
            o(b, n) === !1) {
                return b.abort(),
                s(null, "abort", b, n, r),
                b
            }
            if (n.xhrFields) {
                for (g in n.xhrFields) {
                    b[g] = n.xhrFields[g]
                }
            }
            var T = "async" in n ? n.async: !0;
            b.open(n.type, n.url, T, n.username, n.password);
            for (g in y) {
                E.apply(b, y[g])
            }
            return n.timeout > 0 && (d = setTimeout(function() {
                b.onreadystatechange = c,
                b.abort(),
                s(null, "timeout", b, n, r)
            },
            n.timeout)),
            b.send(n.data ? n.data: null),
            b
        },
        t.get = function() {
            return t.ajax(p.apply(null, arguments))
        },
        t.post = function() {
            var e = p.apply(null, arguments);
            return e.type = "POST",
            t.ajax(e)
        },
        t.getJSON = function() {
            var e = p.apply(null, arguments);
            return e.dataType = "json",
            t.ajax(e)
        },
        t.fn.load = function(e, n, i) {
            if (!this.length) {
                return this
            }
            var r, o = this,
            a = e.split(/\s/),
            s = p(e, n, i),
            u = s.success;
            return a.length > 1 && (s.url = a[0], r = a[1]),
            s.success = function(e) {
                o.html(r ? t("<div>").html(e.replace(x, "")).find(r) : e),
                u && u.apply(o, arguments)
            },
            t.ajax(s),
            this
        };
        var C = encodeURIComponent;
        t.param = function(t, e) {
            var n = [];
            return n.add = function(t, e) {
                this.push(C(t) + "=" + C(e))
            },
            d(n, t, e),
            n.join("&").replace(/%20/g, "+")
        }
    } (Zepto),
    function(t) {
        var e, n = [];
        t.fn.remove = function() {
            return this.each(function() {
                this.parentNode && ("IMG" === this.tagName && (n.push(this), this.src = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=", e && clearTimeout(e), e = setTimeout(function() {
                    n = []
                },
                60000)), this.parentNode.removeChild(this))
            })
        }
    } (Zepto),
    function(t) {
        function e(e, i) {
            var u = e[s],
            c = u && r[u];
            if (void 0 === i) {
                return c || n(e)
            }
            if (c) {
                if (i in c) {
                    return c[i]
                }
                var l = a(i);
                if (l in c) {
                    return c[l]
                }
            }
            return o.call(t(e), i)
        }
        function n(e, n, o) {
            var u = e[s] || (e[s] = ++t.uuid),
            c = r[u] || (r[u] = i(e));
            return void 0 !== n && (c[a(n)] = o),
            c
        }
        function i(e) {
            var n = {};
            return t.each(e.attributes || u,
                function(e, i) {
                    0 == i.name.indexOf("data-") && (n[a(i.name.replace("data-", ""))] = t.zepto.deserializeValue(i.value))
                }),
            n
        }
        var r = {},
        o = t.fn.data,
        a = t.camelCase,
        s = t.expando = "Zepto" + +new Date,
        u = [];
        t.fn.data = function(i, r) {
            return void 0 === r ? t.isPlainObject(i) ? this.each(function(e, r) {
                t.each(i,
                    function(t, e) {
                        n(r, t, e)
                    })
            }) : 0 in this ? e(this[0], i) : void 0 : this.each(function() {
                n(this, i, r)
            })
        },
        t.fn.removeData = function(e) {
            return "string" == typeof e && (e = e.split(/\s+/)),
            this.each(function() {
                var n = this[s],
                i = n && r[n];
                i && t.each(e || i,
                    function(t) {
                        delete i[e ? a(this) : t]
                    })
            })
        },
        ["remove", "empty"].forEach(function(e) {
            var n = t.fn[e];
            t.fn[e] = function() {
                var t = this.find("*");
                return "remove" === e && (t = t.add(this)),
                t.removeData(),
                n.call(this)
            }
        })
    } (Zepto),
    function(t) {
        function e(t) {
            return t._zid || (t._zid = h++)
        }
        function n(t, n, o, a) {
            if (n = i(n), n.ns) {
                var s = r(n.ns)
            }
            return (g[e(t)] || []).filter(function(t) {
                return ! (!t || n.e && t.e != n.e || n.ns && !s.test(t.ns) || o && e(t.fn) !== e(o) || a && t.sel != a)
            })
        }
        function i(t) {
            var e = ("" + t).split(".");
            return {
                e: e[0],
                ns: e.slice(1).sort().join(" ")
            }
        }
        function r(t) {
            return RegExp("(?:^| )" + t.replace(" ", " .* ?") + "(?: |$)")
        }
        function o(t, e) {
            return t.del && !y && t.e in x || !!e
        }
        function a(t) {
            return w[t] || y && x[t] || t
        }
        function s(n, r, s, u, l, h, p) {
            var d = e(n),
            m = g[d] || (g[d] = []);
            r.split(/\s/).forEach(function(e) {
                if ("ready" == e) {
                    return t(document).ready(s)
                }
                var r = i(e);
                r.fn = s,
                r.sel = l,
                r.e in w && (s = function(e) {
                    var n = e.relatedTarget;
                    return ! n || n !== this && !t.contains(this, n) ? r.fn.apply(this, arguments) : f
                }),
                r.del = h;
                var d = h || s;
                r.proxy = function(t) {
                    if (t = c(t), !t.isImmediatePropagationStopped()) {
                        t.data = u;
                        var e = d.apply(n, t._args == f ? [t] : [t].concat(t._args));
                        return e === !1 && (t.preventDefault(), t.stopPropagation()),
                        e
                    }
                },
                r.i = m.length,
                m.push(r),
                "addEventListener" in n && n.addEventListener(a(r.e), r.proxy, o(r, p))
            })
        }
        function u(t, i, r, s, u) {
            var c = e(t);
            (i || "").split(/\s/).forEach(function(e) {
                n(t, e, r, s).forEach(function(e) {
                    delete g[c][e.i],
                    "removeEventListener" in t && t.removeEventListener(a(e.e), e.proxy, o(e, u))
                })
            })
        }
        function c(e, n) {
            return (n || !e.isDefaultPrevented) && (n || (n = e), t.each(j,
                function(t, i) {
                    var r = n[t];
                    e[t] = function() {
                        return this[i] = b,
                        r && r.apply(n, arguments)
                    },
                    e[i] = E
                }), (n.defaultPrevented !== f ? n.defaultPrevented: "returnValue" in n ? n.returnValue === !1 : n.getPreventDefault && n.getPreventDefault()) && (e.isDefaultPrevented = b)),
            e
        }
        function l(t) {
            var e, n = {
                originalEvent: t
            };
            for (e in t) {
                T.test(e) || t[e] === f || (n[e] = t[e])
            }
            return c(n, t)
        }
        var f, h = 1,
        p = Array.prototype.slice,
        d = t.isFunction,
        m = function(t) {
            return "string" == typeof t
        },
        g = {},
        v = {},
        y = "onfocusin" in window,
        x = {
            focus: "focusin",
            blur: "focusout"
        },
        w = {
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        };
        v.click = v.mousedown = v.mouseup = v.mousemove = "MouseEvents",
        t.event = {
            add: s,
            remove: u
        },
        t.proxy = function(n, i) {
            var r = 2 in arguments && p.call(arguments, 2);
            if (d(n)) {
                var o = function() {
                    return n.apply(i, r ? r.concat(p.call(arguments)) : arguments)
                };
                return o._zid = e(n),
                o
            }
            if (m(i)) {
                return r ? (r.unshift(n[i], n), t.proxy.apply(null, r)) : t.proxy(n[i], n)
            }
            throw new TypeError("expected function")
        },
        t.fn.bind = function(t, e, n) {
            return this.on(t, e, n)
        },
        t.fn.unbind = function(t, e) {
            return this.off(t, e)
        },
        t.fn.one = function(t, e, n, i) {
            return this.on(t, e, n, i, 1)
        };
        var b = function() {
            return ! 0
        },
        E = function() {
            return ! 1
        },
        T = /^([A-Z]|returnValue$|layer[XY]$)/,
        j = {
            preventDefault: "isDefaultPrevented",
            stopImmediatePropagation: "isImmediatePropagationStopped",
            stopPropagation: "isPropagationStopped"
        };
        t.fn.delegate = function(t, e, n) {
            return this.on(e, t, n)
        },
        t.fn.undelegate = function(t, e, n) {
            return this.off(e, t, n)
        },
        t.fn.live = function(e, n) {
            return t(document.body).delegate(this.selector, e, n),
            this
        },
        t.fn.die = function(e, n) {
            return t(document.body).undelegate(this.selector, e, n),
            this
        },
        t.fn.on = function(e, n, i, r, o) {
            var a, c, h = this;
            return e && !m(e) ? (t.each(e,
                function(t, e) {
                    h.on(t, n, i, e, o)
                }), h) : (m(n) || d(r) || r === !1 || (r = i, i = n, n = f), (d(i) || i === !1) && (r = i, i = f), r === !1 && (r = E), h.each(function(h, d) {
                o && (a = function(t) {
                    return u(d, t.type, r),
                    r.apply(this, arguments)
                }),
                n && (c = function(e) {
                    var i, o = t(e.target).closest(n, d).get(0);
                    return o && o !== d ? (i = t.extend(l(e), {
                        currentTarget: o,
                        liveFired: d
                    }), (a || r).apply(o, [i].concat(p.call(arguments, 1)))) : f
                }),
                s(d, e, r, i, n, c || a)
            }))
        },
        t.fn.off = function(e, n, i) {
            var r = this;
            return e && !m(e) ? (t.each(e,
                function(t, e) {
                    r.off(t, n, e)
                }), r) : (m(n) || d(i) || i === !1 || (i = n, n = f), i === !1 && (i = E), r.each(function() {
                u(this, e, i, n)
            }))
        },
        t.fn.trigger = function(e, n) {
            return e = m(e) || t.isPlainObject(e) ? t.Event(e) : c(e),
            e._args = n,
            this.each(function() {
                "dispatchEvent" in this ? this.dispatchEvent(e) : t(this).triggerHandler(e, n)
            })
        },
        t.fn.triggerHandler = function(e, i) {
            var r, o;
            return this.each(function(a, s) {
                r = l(m(e) ? t.Event(e) : e),
                r._args = i,
                r.target = s,
                t.each(n(s, e.type || e),
                    function(t, e) {
                        return o = e.proxy(r),
                        r.isImmediatePropagationStopped() ? !1 : f
                    })
            }),
            o
        },
        "focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function(e) {
            t.fn[e] = function(t) {
                return t ? this.bind(e, t) : this.trigger(e)
            }
        }),
        ["focus", "blur"].forEach(function(e) {
            t.fn[e] = function(t) {
                return t ? this.bind(e, t) : this.each(function() {
                    try {
                        this[e]()
                    } catch(t) {}
                }),
                this
            }
        }),
        t.Event = function(t, e) {
            m(t) || (e = t, t = e.type);
            var n = document.createEvent(v[t] || "Events"),
            i = !0;
            if (e) {
                for (var r in e) {
                    "bubbles" == r ? i = !!e[r] : n[r] = e[r]
                }
            }
            return n.initEvent(t, i, !0),
            c(n)
        }
    } (Zepto),
    function(t) {
        t.fn.serializeArray = function() {
            var e, n, i = [];
            return t([].slice.call(this.get(0).elements)).each(function() {
                e = t(this),
                n = e.attr("type"),
                this.name && "fieldset" != this.nodeName.toLowerCase() && !this.disabled && "submit" != n && "reset" != n && "button" != n && ("radio" != n && "checkbox" != n || this.checked) && i.push({
                    name: e.attr("name"),
                    value: e.val()
                })
            }),
            i
        },
        t.fn.serialize = function() {
            var t = [];
            return this.serializeArray().forEach(function(e) {
                t.push(encodeURIComponent(e.name) + "=" + encodeURIComponent(e.value))
            }),
            t.join("&")
        },
        t.fn.submit = function(e) {
            if (e) {
                this.bind("submit", e)
            } else {
                if (this.length) {
                    var n = t.Event("submit");
                    this.eq(0).trigger(n),
                    n.isDefaultPrevented() || this.get(0).submit()
                }
            }
            return this
        }
    } (Zepto),
    function(t, e) {
        function n(t) {
            return t.replace(/([a-z])([A-Z])/, "$1-$2").toLowerCase()
        }
        function i(t) {
            return r ? r + t: t.toLowerCase()
        }
        var r, o, a, s, u, c, l, f, h, p, d = "",
        m = {
            Webkit: "webkit",
            Moz: "",
            O: "o"
        },
        g = window.document,
        v = g.createElement("div"),
        y = /^((translate|rotate|scale)(X|Y|Z|3d)?|matrix(3d)?|perspective|skew(X|Y)?)$/i,
        x = {};
        t.each(m,
            function(t, n) {
                return v.style[t + "TransitionProperty"] !== e ? (d = "-" + t.toLowerCase() + "-", r = n, !1) : e
            }),
        o = d + "transform",
        x[a = d + "transition-property"] = x[s = d + "transition-duration"] = x[c = d + "transition-delay"] = x[u = d + "transition-timing-function"] = x[l = d + "animation-name"] = x[f = d + "animation-duration"] = x[p = d + "animation-delay"] = x[h = d + "animation-timing-function"] = "",
        t.fx = {
            off: r === e && v.style.transitionProperty === e,
            speeds: {
                _default: 400,
                fast: 200,
                slow: 600
            },
            cssPrefix: d,
            transitionEnd: i("TransitionEnd"),
            animationEnd: i("AnimationEnd")
        },
        t.fn.animate = function(n, i, r, o, a) {
            return t.isFunction(i) && (o = i, r = e, i = e),
            t.isFunction(r) && (o = r, r = e),
            t.isPlainObject(i) && (r = i.easing, o = i.complete, a = i.delay, i = i.duration),
            i && (i = ("number" == typeof i ? i: t.fx.speeds[i] || t.fx.speeds._default) / 1000),
            a && (a = parseFloat(a) / 1000),
            this.anim(n, i, r, o, a)
        },
        t.fn.anim = function(i, r, d, m, g) {
            var v, w, b, E = {},
            T = "",
            j = this,
            C = t.fx.transitionEnd,
            N = !1;
            if (r === e && (r = t.fx.speeds._default / 1000), g === e && (g = 0), t.fx.off && (r = 0), "string" == typeof i) {
                E[l] = i,
                E[f] = r + "s",
                E[p] = g + "s",
                E[h] = d || "linear",
                C = t.fx.animationEnd
            } else {
                w = [];
                for (v in i) {
                    y.test(v) ? T += v + "(" + i[v] + ") ": (E[v] = i[v], w.push(n(v)))
                }
                T && (E[o] = T, w.push(o)),
                r > 0 && "object" == typeof i && (E[a] = w.join(", "), E[s] = r + "s", E[c] = g + "s", E[u] = d || "linear")
            }
            return b = function(n) {
                if (n !== e) {
                    if (n.target !== n.currentTarget) {
                        return
                    }
                    t(n.target).unbind(C, b)
                } else {
                    t(this).unbind(C, b)
                }
                N = !0,
                t(this).css(x),
                m && m.call(this)
            },
            r > 0 && (this.bind(C, b), setTimeout(function() {
                N || b.call(j)
            },
            1000 * r + 25)),
            this.size() && this.get(0).clientLeft,
            this.css(E),
            0 >= r && setTimeout(function() {
                j.each(function() {
                    b.call(this)
                })
            },
            0),
            this
        },
        v = null
    } (Zepto),
    function(t, e) {
        function n(n, i, r, o, a) {
            "function" != typeof i || a || (a = i, i = e);
            var s = {
                opacity: r
            };
            return o && (s.scale = o, n.css(t.fx.cssPrefix + "transform-origin", "0 0")),
            n.animate(s, i, null, a)
        }
        function i(e, i, r, o) {
            return n(e, i, 0, r,
                function() {
                    a.call(t(this)),
                    o && o.call(this)
                })
        }
        var r = window.document,
        o = (r.documentElement, t.fn.show),
        a = t.fn.hide,
        s = t.fn.toggle;
        t.fn.show = function(t, i) {
            return o.call(this),
            t === e ? t = 0 : this.css("opacity", 0),
            n(this, t, 1, "1,1", i)
        },
        t.fn.hide = function(t, n) {
            return t === e ? a.call(this) : i(this, t, "0,0", n)
        },
        t.fn.toggle = function(n, i) {
            return n === e || "boolean" == typeof n ? s.call(this, n) : this.each(function() {
                var e = t(this);
                e["none" == e.css("display") ? "show": "hide"](n, i)
            })
        },
        t.fn.fadeTo = function(t, e, i) {
            return n(this, t, e, null, i)
        },
        t.fn.fadeIn = function(t, e) {
            var n = this.css("opacity");
            return n > 0 ? this.css("opacity", 0) : n = 1,
            o.call(this).fadeTo(t, n, e)
        },
        t.fn.fadeOut = function(t, e) {
            return i(this, t, null, e)
        },
        t.fn.fadeToggle = function(e, n) {
            return this.each(function() {
                var i = t(this);
                i[0 == i.css("opacity") || "none" == i.css("display") ? "fadeIn": "fadeOut"](e, n)
            })
        }
    } (Zepto),
    function(t) {
        "__proto__" in {} || t.extend(t.zepto, {
            Z: function(e, n) {
                return e = e || [],
                t.extend(e, t.fn),
                e.selector = n || "",
                e.__Z = !0,
                e
            },
            isZ: function(e) {
                return "array" === t.type(e) && "__Z" in e
            }
        });
        try {
            getComputedStyle(void 0)
        } catch(e) {
            var n = getComputedStyle;
            window.getComputedStyle = function(t) {
                try {
                    return n(t)
                } catch(e) {
                    return null
                }
            }
        }
    } (Zepto),
    function(t) {
        function e(e) {
            return e = t(e),
            !(!e.width() && !e.height()) && "none" !== e.css("display")
        }
        function n(t, e) {
            t = t.replace(/=#\]/g, '="#"]');
            var n, i, r = s.exec(t);
            if (r && r[2] in a && (n = a[r[2]], i = r[3], t = r[1], i)) {
                var o = Number(i);
                i = isNaN(o) ? i.replace(/^["']|["']$/g, "") : o
            }
            return e(t, n, i)
        }
        var i = t.zepto,
        r = i.qsa,
        o = i.matches,
        a = t.expr[":"] = {
            visible: function() {
                return e(this) ? this: void 0
            },
            hidden: function() {
                return e(this) ? void 0 : this
            },
            selected: function() {
                return this.selected ? this: void 0
            },
            checked: function() {
                return this.checked ? this: void 0
            },
            parent: function() {
                return this.parentNode
            },
            first: function(t) {
                return 0 === t ? this: void 0
            },
            last: function(t, e) {
                return t === e.length - 1 ? this: void 0
            },
            eq: function(t, e, n) {
                return t === n ? this: void 0
            },
            contains: function(e, n, i) {
                return t(this).text().indexOf(i) > -1 ? this: void 0
            },
            has: function(t, e, n) {
                return i.qsa(this, n).length ? this: void 0
            }
        },
        s = RegExp("(.*):(\\w+)(?:\\(([^)]+)\\))?$\\s*"),
        u = /^\s*>/,
        c = "Zepto" + +new Date;
        i.qsa = function(e, o) {
            return n(o,
                function(n, a, s) {
                    try {
                        var l;
                        ! n && a ? n = "*": u.test(n) && (l = t(e).addClass(c), n = "." + c + " " + n);
                        var f = r(e, n)
                    } catch(h) {
                        throw console.error("error performing selector: %o", o),
                        h
                    } finally {
                        l && l.removeClass(c)
                    }
                    return a ? i.uniq(t.map(f,
                        function(t, e) {
                            return a.call(t, e, f, s)
                        })) : f
                })
        },
        i.matches = function(t, e) {
            return n(e,
                function(e, n, i) {
                    return ! (e && !o(t, e) || n && n.call(t, null, i) !== t)
                })
        }
    } (Zepto),
    function(t) {
        function e(t, e, n, i) {
            return Math.abs(t - e) >= Math.abs(n - i) ? t - e > 0 ? "Left": "Right": n - i > 0 ? "Up": "Down"
        }
        function n() {
            l = null,
            h.last && (h.el.trigger("longTap"), h = {})
        }
        function i() {
            l && clearTimeout(l),
            l = null
        }
        function r() {
            s && clearTimeout(s),
            u && clearTimeout(u),
            c && clearTimeout(c),
            l && clearTimeout(l),
            s = u = c = l = null,
            h = {}
        }
        function o(t) {
            return ("touch" == t.pointerType || t.pointerType == t.MSPOINTER_TYPE_TOUCH) && t.isPrimary
        }
        function a(t, e) {
            return t.type == "pointer" + e || t.type.toLowerCase() == "mspointer" + e
        }
        var s, u, c, l, f, h = {},
        p = 750;
        t(document).ready(function() {
            var d, m, g, v, y = 0,
            x = 0;
            "MSGesture" in window && (f = new MSGesture, f.target = document.body),
            t(document).bind("MSGestureEnd",
                function(t) {
                    var e = t.velocityX > 1 ? "Right": -1 > t.velocityX ? "Left": t.velocityY > 1 ? "Down": -1 > t.velocityY ? "Up": null;
                    e && (h.el.trigger("swipe"), h.el.trigger("swipe" + e))
                }).on("touchstart MSPointerDown pointerdown",
                function(e) {
                    (!(v = a(e, "down")) || o(e)) && (g = v ? e: e.touches[0], e.touches && 1 === e.touches.length && h.x2 && (h.x2 = void 0, h.y2 = void 0), d = Date.now(), m = d - (h.last || d), h.el = t("tagName" in g.target ? g.target: g.target.parentNode), s && clearTimeout(s), h.x1 = g.pageX, h.y1 = g.pageY, m > 0 && 250 >= m && (h.isDoubleTap = !0), h.last = d, l = setTimeout(n, p), f && v && f.addPointer(e.pointerId))
                }).on("touchmove MSPointerMove pointermove",
                function(t) {
                    (!(v = a(t, "move")) || o(t)) && (g = v ? t: t.touches[0], i(), h.x2 = g.pageX, h.y2 = g.pageY, y += Math.abs(h.x1 - h.x2), x += Math.abs(h.y1 - h.y2))
                }).on("touchend MSPointerUp pointerup",
                function(n) {
                    (!(v = a(n, "up")) || o(n)) && (i(), h.x2 && Math.abs(h.x1 - h.x2) > 30 || h.y2 && Math.abs(h.y1 - h.y2) > 30 ? c = setTimeout(function() {
                        h.el.trigger("swipe"),
                        h.el.trigger("swipe" + e(h.x1, h.x2, h.y1, h.y2)),
                        h = {}
                    },
                    0) : "last" in h && (30 > y && 30 > x ? u = setTimeout(function() {
                        var e = t.Event("tap");
                        e.cancelTouch = r,
                        h.el.trigger(e),
                        h.isDoubleTap ? (h.el && h.el.trigger("doubleTap"), h = {}) : s = setTimeout(function() {
                            s = null,
                            h.el && h.el.trigger("singleTap"),
                            h = {}
                        },
                        250)
                    },
                    0) : h = {}), y = x = 0)
                }).on("touchcancel MSPointerCancel pointercancel", r),
            t(window).on("scroll", r)
        }),
        ["swipe", "swipeLeft", "swipeRight", "swipeUp", "swipeDown", "doubleTap", "tap", "singleTap", "longTap"].forEach(function(e) {
            t.fn[e] = function(t) {
                return this.on(e, t)
            }
        })
    } (Zepto);
var Province = [{
    "code": "110000",
    "name": "北京市"
},
{
    "code": "120000",
    "name": "天津市"
},
{
    "code": "130000",
    "name": "河北省"
},
{
    "code": "140000",
    "name": "山西省"
},
{
    "code": "150000",
    "name": "内蒙古自治区"
},
{
    "code": "210000",
    "name": "辽宁省"
},
{
    "code": "220000",
    "name": "吉林省"
},
{
    "code": "230000",
    "name": "黑龙江省"
},
{
    "code": "310000",
    "name": "上海市"
},
{
    "code": "320000",
    "name": "江苏省"
},
{
    "code": "330000",
    "name": "浙江省"
},
{
    "code": "340000",
    "name": "安徽省"
},
{
    "code": "350000",
    "name": "福建省"
},
{
    "code": "360000",
    "name": "江西省"
},
{
    "code": "370000",
    "name": "山东省"
},
{
    "code": "410000",
    "name": "河南省"
},
{
    "code": "420000",
    "name": "湖北省"
},
{
    "code": "430000",
    "name": "湖南省"
},
{
    "code": "440000",
    "name": "广东省"
},
{
    "code": "450000",
    "name": "广西壮族自治区"
},
{
    "code": "460000",
    "name": "海南省"
},
{
    "code": "500000",
    "name": "重庆市"
},
{
    "code": "510000",
    "name": "四川省"
},
{
    "code": "520000",
    "name": "贵州省"
},
{
    "code": "530000",
    "name": "云南省"
},
{
    "code": "540000",
    "name": "西藏自治区"
},
{
    "code": "610000",
    "name": "陕西省"
},
{
    "code": "620000",
    "name": "甘肃省"
},
{
    "code": "630000",
    "name": "青海省"
},
{
    "code": "640000",
    "name": "宁夏回族自治区"
},
{
    "code": "650000",
    "name": "新疆维吾尔自治区"
},
{
    "code": "710000",
    "name": "台湾省"
},
{
    "code": "810000",
    "name": "香港特别行政区"
},
{
    "code": "820000",
    "name": "澳门特别行政区"
}];
var City = Array();
City[110000] = [{
    "code": "110000",
    "name": "北京市"
}];
City[120000] = [{
    "code": "120000",
    "name": "天津市"
}];
City[130000] = [{
    "code": "130100",
    "name": "石家庄市"
},
{
    "code": "130200",
    "name": "唐山市"
},
{
    "code": "130300",
    "name": "秦皇岛市"
},
{
    "code": "130400",
    "name": "邯郸市"
},
{
    "code": "130500",
    "name": "邢台市"
},
{
    "code": "130600",
    "name": "保定市"
},
{
    "code": "130700",
    "name": "张家口市"
},
{
    "code": "130800",
    "name": "承德市"
},
{
    "code": "130900",
    "name": "沧州市"
},
{
    "code": "131000",
    "name": "廊坊市"
},
{
    "code": "131100",
    "name": "衡水市"
}];
City[140000] = [{
    "code": "140100",
    "name": "太原市"
},
{
    "code": "140200",
    "name": "大同市"
},
{
    "code": "140300",
    "name": "阳泉市"
},
{
    "code": "140400",
    "name": "长治市"
},
{
    "code": "140500",
    "name": "晋城市"
},
{
    "code": "140600",
    "name": "朔州市"
},
{
    "code": "140700",
    "name": "晋中市"
},
{
    "code": "140800",
    "name": "运城市"
},
{
    "code": "140900",
    "name": "忻州市"
},
{
    "code": "141000",
    "name": "临汾市"
},
{
    "code": "141100",
    "name": "吕梁市"
}];
City[150000] = [{
    "code": "150100",
    "name": "呼和浩特市"
},
{
    "code": "150200",
    "name": "包头市"
},
{
    "code": "150300",
    "name": "乌海市"
},
{
    "code": "150400",
    "name": "赤峰市"
},
{
    "code": "150500",
    "name": "通辽市"
},
{
    "code": "150600",
    "name": "鄂尔多斯市"
},
{
    "code": "150700",
    "name": "呼伦贝尔市"
},
{
    "code": "150800",
    "name": "巴彦淖尔市"
},
{
    "code": "150900",
    "name": "乌兰察布市"
},
{
    "code": "152200",
    "name": "兴安盟"
},
{
    "code": "152500",
    "name": "锡林郭勒盟"
},
{
    "code": "152900",
    "name": "阿拉善盟"
}];
City[210000] = [{
    "code": "210100",
    "name": "沈阳市"
},
{
    "code": "210200",
    "name": "大连市"
},
{
    "code": "210300",
    "name": "鞍山市"
},
{
    "code": "210400",
    "name": "抚顺市"
},
{
    "code": "210500",
    "name": "本溪市"
},
{
    "code": "210600",
    "name": "丹东市"
},
{
    "code": "210700",
    "name": "锦州市"
},
{
    "code": "210800",
    "name": "营口市"
},
{
    "code": "210900",
    "name": "阜新市"
},
{
    "code": "211000",
    "name": "辽阳市"
},
{
    "code": "211100",
    "name": "盘锦市"
},
{
    "code": "211200",
    "name": "铁岭市"
},
{
    "code": "211300",
    "name": "朝阳市"
},
{
    "code": "211400",
    "name": "葫芦岛市"
}];
City[220000] = [{
    "code": "220100",
    "name": "长春市"
},
{
    "code": "220200",
    "name": "吉林市"
},
{
    "code": "220300",
    "name": "四平市"
},
{
    "code": "220400",
    "name": "辽源市"
},
{
    "code": "220500",
    "name": "通化市"
},
{
    "code": "220600",
    "name": "白山市"
},
{
    "code": "220700",
    "name": "松原市"
},
{
    "code": "220800",
    "name": "白城市"
},
{
    "code": "222400",
    "name": "延边朝鲜族自治州"
}];
City[230000] = [{
    "code": "230100",
    "name": "哈尔滨市"
},
{
    "code": "230200",
    "name": "齐齐哈尔市"
},
{
    "code": "230300",
    "name": "鸡西市"
},
{
    "code": "230400",
    "name": "鹤岗市"
},
{
    "code": "230500",
    "name": "双鸭山市"
},
{
    "code": "230600",
    "name": "大庆市"
},
{
    "code": "230700",
    "name": "伊春市"
},
{
    "code": "230800",
    "name": "佳木斯市"
},
{
    "code": "230900",
    "name": "七台河市"
},
{
    "code": "231000",
    "name": "牡丹江市"
},
{
    "code": "231100",
    "name": "黑河市"
},
{
    "code": "231200",
    "name": "绥化市"
},
{
    "code": "232700",
    "name": "大兴安岭地区"
}];
City[310000] = [{
    "code": "310000",
    "name": "上海市"
}];
City[320000] = [{
    "code": "320100",
    "name": "南京市"
},
{
    "code": "320200",
    "name": "无锡市"
},
{
    "code": "320300",
    "name": "徐州市"
},
{
    "code": "320400",
    "name": "常州市"
},
{
    "code": "320500",
    "name": "苏州市"
},
{
    "code": "320600",
    "name": "南通市"
},
{
    "code": "320700",
    "name": "连云港市"
},
{
    "code": "320800",
    "name": "淮安市"
},
{
    "code": "320900",
    "name": "盐城市"
},
{
    "code": "321000",
    "name": "扬州市"
},
{
    "code": "321100",
    "name": "镇江市"
},
{
    "code": "321200",
    "name": "泰州市"
},
{
    "code": "321300",
    "name": "宿迁市"
}];
City[330000] = [{
    "code": "330100",
    "name": "杭州市"
},
{
    "code": "330200",
    "name": "宁波市"
},
{
    "code": "330300",
    "name": "温州市"
},
{
    "code": "330400",
    "name": "嘉兴市"
},
{
    "code": "330500",
    "name": "湖州市"
},
{
    "code": "330600",
    "name": "绍兴市"
},
{
    "code": "330700",
    "name": "金华市"
},
{
    "code": "330800",
    "name": "衢州市"
},
{
    "code": "330900",
    "name": "舟山市"
},
{
    "code": "331000",
    "name": "台州市"
},
{
    "code": "331100",
    "name": "丽水市"
}];
City[340000] = [{
    "code": "340100",
    "name": "合肥市"
},
{
    "code": "340200",
    "name": "芜湖市"
},
{
    "code": "340300",
    "name": "蚌埠市"
},
{
    "code": "340400",
    "name": "淮南市"
},
{
    "code": "340500",
    "name": "马鞍山市"
},
{
    "code": "340600",
    "name": "淮北市"
},
{
    "code": "340700",
    "name": "铜陵市"
},
{
    "code": "340800",
    "name": "安庆市"
},
{
    "code": "341000",
    "name": "黄山市"
},
{
    "code": "341100",
    "name": "滁州市"
},
{
    "code": "341200",
    "name": "阜阳市"
},
{
    "code": "341300",
    "name": "宿州市"
},
{
    "code": "341400",
    "name": "巢湖市"
},
{
    "code": "341500",
    "name": "六安市"
},
{
    "code": "341600",
    "name": "亳州市"
},
{
    "code": "341700",
    "name": "池州市"
},
{
    "code": "341800",
    "name": "宣城市"
}];
City[350000] = [{
    "code": "350100",
    "name": "福州市"
},
{
    "code": "350200",
    "name": "厦门市"
},
{
    "code": "350300",
    "name": "莆田市"
},
{
    "code": "350400",
    "name": "三明市"
},
{
    "code": "350500",
    "name": "泉州市"
},
{
    "code": "350600",
    "name": "漳州市"
},
{
    "code": "350700",
    "name": "南平市"
},
{
    "code": "350800",
    "name": "龙岩市"
},
{
    "code": "350900",
    "name": "宁德市"
}];
City[360000] = [{
    "code": "360100",
    "name": "南昌市"
},
{
    "code": "360200",
    "name": "景德镇市"
},
{
    "code": "360300",
    "name": "萍乡市"
},
{
    "code": "360400",
    "name": "九江市"
},
{
    "code": "360500",
    "name": "新余市"
},
{
    "code": "360600",
    "name": "鹰潭市"
},
{
    "code": "360700",
    "name": "赣州市"
},
{
    "code": "360800",
    "name": "吉安市"
},
{
    "code": "360900",
    "name": "宜春市"
},
{
    "code": "361000",
    "name": "抚州市"
},
{
    "code": "361100",
    "name": "上饶市"
}];
City[370000] = [{
    "code": "370100",
    "name": "济南市"
},
{
    "code": "370200",
    "name": "青岛市"
},
{
    "code": "370300",
    "name": "淄博市"
},
{
    "code": "370400",
    "name": "枣庄市"
},
{
    "code": "370500",
    "name": "东营市"
},
{
    "code": "370600",
    "name": "烟台市"
},
{
    "code": "370700",
    "name": "潍坊市"
},
{
    "code": "370800",
    "name": "济宁市"
},
{
    "code": "370900",
    "name": "泰安市"
},
{
    "code": "371000",
    "name": "威海市"
},
{
    "code": "371100",
    "name": "日照市"
},
{
    "code": "371200",
    "name": "莱芜市"
},
{
    "code": "371300",
    "name": "临沂市"
},
{
    "code": "371400",
    "name": "德州市"
},
{
    "code": "371500",
    "name": "聊城市"
},
{
    "code": "371600",
    "name": "滨州市"
},
{
    "code": "371700",
    "name": "荷泽市"
}];
City[410000] = [{
    "code": "410100",
    "name": "郑州市"
},
{
    "code": "410200",
    "name": "开封市"
},
{
    "code": "410300",
    "name": "洛阳市"
},
{
    "code": "410400",
    "name": "平顶山市"
},
{
    "code": "410500",
    "name": "安阳市"
},
{
    "code": "410600",
    "name": "鹤壁市"
},
{
    "code": "410700",
    "name": "新乡市"
},
{
    "code": "410800",
    "name": "焦作市"
},
{
    "code": "410900",
    "name": "濮阳市"
},
{
    "code": "411000",
    "name": "许昌市"
},
{
    "code": "411100",
    "name": "漯河市"
},
{
    "code": "411200",
    "name": "三门峡市"
},
{
    "code": "411300",
    "name": "南阳市"
},
{
    "code": "411400",
    "name": "商丘市"
},
{
    "code": "411500",
    "name": "信阳市"
},
{
    "code": "411600",
    "name": "周口市"
},
{
    "code": "411700",
    "name": "驻马店市"
}];
City[420000] = [{
    "code": "420100",
    "name": "武汉市"
},
{
    "code": "420200",
    "name": "黄石市"
},
{
    "code": "420300",
    "name": "十堰市"
},
{
    "code": "420500",
    "name": "宜昌市"
},
{
    "code": "420600",
    "name": "襄樊市"
},
{
    "code": "420700",
    "name": "鄂州市"
},
{
    "code": "420800",
    "name": "荆门市"
},
{
    "code": "420900",
    "name": "孝感市"
},
{
    "code": "421000",
    "name": "荆州市"
},
{
    "code": "421100",
    "name": "黄冈市"
},
{
    "code": "421200",
    "name": "咸宁市"
},
{
    "code": "421300",
    "name": "随州市"
},
{
    "code": "422800",
    "name": "恩施土家族苗族自治州"
},
{
    "code": "429000",
    "name": "省直辖行政单位"
}];
City[430000] = [{
    "code": "430100",
    "name": "长沙市"
},
{
    "code": "430200",
    "name": "株洲市"
},
{
    "code": "430300",
    "name": "湘潭市"
},
{
    "code": "430400",
    "name": "衡阳市"
},
{
    "code": "430500",
    "name": "邵阳市"
},
{
    "code": "430600",
    "name": "岳阳市"
},
{
    "code": "430700",
    "name": "常德市"
},
{
    "code": "430800",
    "name": "张家界市"
},
{
    "code": "430900",
    "name": "益阳市"
},
{
    "code": "431000",
    "name": "郴州市"
},
{
    "code": "431100",
    "name": "永州市"
},
{
    "code": "431200",
    "name": "怀化市"
},
{
    "code": "431300",
    "name": "娄底市"
},
{
    "code": "433100",
    "name": "湘西土家族苗族自治州"
}];
City[440000] = [{
    "code": "440100",
    "name": "广州市"
},
{
    "code": "440200",
    "name": "韶关市"
},
{
    "code": "440300",
    "name": "深圳市"
},
{
    "code": "440400",
    "name": "珠海市"
},
{
    "code": "440500",
    "name": "汕头市"
},
{
    "code": "440600",
    "name": "佛山市"
},
{
    "code": "440700",
    "name": "江门市"
},
{
    "code": "440800",
    "name": "湛江市"
},
{
    "code": "440900",
    "name": "茂名市"
},
{
    "code": "441200",
    "name": "肇庆市"
},
{
    "code": "441300",
    "name": "惠州市"
},
{
    "code": "441400",
    "name": "梅州市"
},
{
    "code": "441500",
    "name": "汕尾市"
},
{
    "code": "441600",
    "name": "河源市"
},
{
    "code": "441700",
    "name": "阳江市"
},
{
    "code": "441800",
    "name": "清远市"
},
{
    "code": "441900",
    "name": "东莞市"
},
{
    "code": "442000",
    "name": "中山市"
},
{
    "code": "445100",
    "name": "潮州市"
},
{
    "code": "445200",
    "name": "揭阳市"
},
{
    "code": "445300",
    "name": "云浮市"
}];
City[450000] = [{
    "code": "450100",
    "name": "南宁市"
},
{
    "code": "450200",
    "name": "柳州市"
},
{
    "code": "450300",
    "name": "桂林市"
},
{
    "code": "450400",
    "name": "梧州市"
},
{
    "code": "450500",
    "name": "北海市"
},
{
    "code": "450600",
    "name": "防城港市"
},
{
    "code": "450700",
    "name": "钦州市"
},
{
    "code": "450800",
    "name": "贵港市"
},
{
    "code": "450900",
    "name": "玉林市"
},
{
    "code": "451000",
    "name": "百色市"
},
{
    "code": "451100",
    "name": "贺州市"
},
{
    "code": "451200",
    "name": "河池市"
},
{
    "code": "451300",
    "name": "来宾市"
},
{
    "code": "451400",
    "name": "崇左市"
}];
City[460000] = [{
    "code": "460100",
    "name": "海口市"
},
{
    "code": "460200",
    "name": "三亚市"
},
{
    "code": "469000",
    "name": "省直辖县级行政单位"
}];
City[500000] = [{
    "code": "500000",
    "name": "重庆市"
}];
City[510000] = [{
    "code": "510100",
    "name": "成都市"
},
{
    "code": "510300",
    "name": "自贡市"
},
{
    "code": "510400",
    "name": "攀枝花市"
},
{
    "code": "510500",
    "name": "泸州市"
},
{
    "code": "510600",
    "name": "德阳市"
},
{
    "code": "510700",
    "name": "绵阳市"
},
{
    "code": "510800",
    "name": "广元市"
},
{
    "code": "510900",
    "name": "遂宁市"
},
{
    "code": "511000",
    "name": "内江市"
},
{
    "code": "511100",
    "name": "乐山市"
},
{
    "code": "511300",
    "name": "南充市"
},
{
    "code": "511400",
    "name": "眉山市"
},
{
    "code": "511500",
    "name": "宜宾市"
},
{
    "code": "511600",
    "name": "广安市"
},
{
    "code": "511700",
    "name": "达州市"
},
{
    "code": "511800",
    "name": "雅安市"
},
{
    "code": "511900",
    "name": "巴中市"
},
{
    "code": "512000",
    "name": "资阳市"
},
{
    "code": "513200",
    "name": "阿坝藏族羌族自治州"
},
{
    "code": "513300",
    "name": "甘孜藏族自治州"
},
{
    "code": "513400",
    "name": "凉山彝族自治州"
}];
City[520000] = [{
    "code": "520100",
    "name": "贵阳市"
},
{
    "code": "520200",
    "name": "六盘水市"
},
{
    "code": "520300",
    "name": "遵义市"
},
{
    "code": "520400",
    "name": "安顺市"
},
{
    "code": "522200",
    "name": "铜仁地区"
},
{
    "code": "522300",
    "name": "黔西南布依族苗族自治州"
},
{
    "code": "522400",
    "name": "毕节地区"
},
{
    "code": "522600",
    "name": "黔东南苗族侗族自治州"
},
{
    "code": "522700",
    "name": "黔南布依族苗族自治州"
}];
City[530000] = [{
    "code": "530100",
    "name": "昆明市"
},
{
    "code": "530300",
    "name": "曲靖市"
},
{
    "code": "530400",
    "name": "玉溪市"
},
{
    "code": "530500",
    "name": "保山市"
},
{
    "code": "530600",
    "name": "昭通市"
},
{
    "code": "530700",
    "name": "丽江市"
},
{
    "code": "530800",
    "name": "思茅市"
},
{
    "code": "530900",
    "name": "临沧市"
},
{
    "code": "532300",
    "name": "楚雄彝族自治州"
},
{
    "code": "532500",
    "name": "红河哈尼族彝族自治州"
},
{
    "code": "532600",
    "name": "文山壮族苗族自治州"
},
{
    "code": "532800",
    "name": "西双版纳傣族自治州"
},
{
    "code": "532900",
    "name": "大理白族自治州"
},
{
    "code": "533100",
    "name": "德宏傣族景颇族自治州"
},
{
    "code": "533300",
    "name": "怒江傈僳族自治州"
},
{
    "code": "533400",
    "name": "迪庆藏族自治州"
}];
City[540000] = [{
    "code": "540100",
    "name": "拉萨市"
},
{
    "code": "542100",
    "name": "昌都地区"
},
{
    "code": "542200",
    "name": "山南地区"
},
{
    "code": "542300",
    "name": "日喀则地区"
},
{
    "code": "542400",
    "name": "那曲地区"
},
{
    "code": "542500",
    "name": "阿里地区"
},
{
    "code": "542600",
    "name": "林芝地区"
}];
City[610000] = [{
    "code": "610100",
    "name": "西安市"
},
{
    "code": "610200",
    "name": "铜川市"
},
{
    "code": "610300",
    "name": "宝鸡市"
},
{
    "code": "610400",
    "name": "咸阳市"
},
{
    "code": "610500",
    "name": "渭南市"
},
{
    "code": "610600",
    "name": "延安市"
},
{
    "code": "610700",
    "name": "汉中市"
},
{
    "code": "610800",
    "name": "榆林市"
},
{
    "code": "610900",
    "name": "安康市"
},
{
    "code": "611000",
    "name": "商洛市"
}];
City[620000] = [{
    "code": "620100",
    "name": "兰州市"
},
{
    "code": "620200",
    "name": "嘉峪关市"
},
{
    "code": "620300",
    "name": "金昌市"
},
{
    "code": "620400",
    "name": "白银市"
},
{
    "code": "620500",
    "name": "天水市"
},
{
    "code": "620600",
    "name": "武威市"
},
{
    "code": "620700",
    "name": "张掖市"
},
{
    "code": "620800",
    "name": "平凉市"
},
{
    "code": "620900",
    "name": "酒泉市"
},
{
    "code": "621000",
    "name": "庆阳市"
},
{
    "code": "621100",
    "name": "定西市"
},
{
    "code": "621200",
    "name": "陇南市"
},
{
    "code": "622900",
    "name": "临夏回族自治州"
},
{
    "code": "623000",
    "name": "甘南藏族自治州"
}];
City[630000] = [{
    "code": "630100",
    "name": "西宁市"
},
{
    "code": "632100",
    "name": "海东地区"
},
{
    "code": "632200",
    "name": "海北藏族自治州"
},
{
    "code": "632300",
    "name": "黄南藏族自治州"
},
{
    "code": "632500",
    "name": "海南藏族自治州"
},
{
    "code": "632600",
    "name": "果洛藏族自治州"
},
{
    "code": "632700",
    "name": "玉树藏族自治州"
},
{
    "code": "632800",
    "name": "海西蒙古族藏族自治州"
}];
City[640000] = [{
    "code": "640100",
    "name": "银川市"
},
{
    "code": "640200",
    "name": "石嘴山市"
},
{
    "code": "640300",
    "name": "吴忠市"
},
{
    "code": "640400",
    "name": "固原市"
},
{
    "code": "640500",
    "name": "中卫市"
}];
City[650000] = [{
    "code": "650100",
    "name": "乌鲁木齐市"
},
{
    "code": "650200",
    "name": "克拉玛依市"
},
{
    "code": "652100",
    "name": "吐鲁番地区"
},
{
    "code": "652200",
    "name": "哈密地区"
},
{
    "code": "652300",
    "name": "昌吉回族自治州"
},
{
    "code": "652700",
    "name": "博尔塔拉蒙古自治州"
},
{
    "code": "652800",
    "name": "巴音郭楞蒙古自治州"
},
{
    "code": "652900",
    "name": "阿克苏地区"
},
{
    "code": "653000",
    "name": "克孜勒苏柯尔克孜自治州"
},
{
    "code": "653100",
    "name": "喀什地区"
},
{
    "code": "653200",
    "name": "和田地区"
},
{
    "code": "654000",
    "name": "伊犁哈萨克自治州"
},
{
    "code": "654200",
    "name": "塔城地区"
},
{
    "code": "654300",
    "name": "阿勒泰地区"
},
{
    "code": "659000",
    "name": "省直辖行政单位"
}];
City[710000] = [{
    "code": "710000",
    "name": "台湾省"
}];
City[810000] = [{
    "code": "810000",
    "name": "香港特别行政区"
}];
City[820000] = [{
    "code": "820000",
    "name": "澳门特别行政区"
}];
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break
        }
    }
    return flag
}
function randomString(len) {
    len = len || 32;
    var $chars = "ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678";
    var maxPos = $chars.length;
    var pwd = "";
    for (i = 0; i < len; i++) {
        pwd += $chars.charAt(Math.floor(Math.random() * maxPos))
    }
    return pwd
}
var regexEnum = {
    "email": /^(?:[a-zA-Z0-9]+[_\-\+\.]?)*[a-zA-Z0-9]+@(?:([a-zA-Z0-9]+[_\-]?)*[a-zA-Z0-9]+\.)+([a-zA-Z]{2,})+$/,
    "mobile": "^(13|15|18)[0-9]{9}$",
    "ip4": "/^([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]).([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]).([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]).([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$/",
    "color": "^[a-fA-F0-9]{6}$",
    "url": '/^http://([A-Za-z0-9]+.)?[A-Za-z0-9]+[/=?%-&_~`@[]\':+!]*([^<>""])*$/',
    "chinese": "^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$",
    "ascii": "^[\\x00-\\xFF]+$",
    "zipcode": "^\\d{6}$",
    "mobile": "^(13|14|15|17|18)[0-9]{9}$",
    "ip4": "^(\\d{1,2}|1\\d\\d|2[0-4]\\d|25[0-5]).(\\d{1,2}|1\\d\\d|2[0-4]\\d|25[0-5]).(d{1,2}|1\\d\\d|2[0-4]\\d|25[0-5]).(\\d{1,2}|1\\d\\d|2[0-4]\\d|25[0-5])$",
    "notempty": "^\\S+$",
    "picture": "(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",
    "rar": "(.*)\\.(rar|zip|7zip|tgz)$",
    "date": "^\\d{4}(\\-|\\/|.)\\d{1,2}\\1\\d{1,2}$",
    "qq": "^[1-9]*[1-9][0-9]*$",
    "tel": "(\\d{3}-|\\d{4}-)?(\\d{8}|\\d{7})",
    "username": "^\\w+$",
    "letter": "^[A-Za-z]+$",
    "letter_u": "^[A-Z]+$",
    "letter_l": "^[a-z]+$",
    "idcard": "^[1-9]([0-9]{14}|[0-9]{17})$",
    "money": "^([1-9][\\d]{0,7}|0)(.[\\d]{1,2})?$",
    "int": "^-?[1-9]\\d*$"
};
function check_date(date, type) {
    var reg = new RegExp(regexEnum[type]);
    if (reg.test(date)) {
        return true
    } else {
        return false
    }
}

function show_loading() {
    var vwidth = $(window).width();
    var vheight = $(window).height();
    var dheight = $(document.body).height();
    var height = 0;
    if (vheight > dheight) {
        height = vheight
    } else {
        height = dheight
    }
    var html = '<div name="masker" id="masker_container" style="z-index:100;position:absolute;left:0px;top:0px;filter:alpha(opacity=80);-moz-opacity:0.8;opacity:0.8;background:black;width:' + vwidth + "px;height:" + height + 'px;display:none;" ></div>';
    html += '<div name="masker" style="z-index:101;position:fixed;top:50%;left:50%;padding:10px 30px 10px 30px;margin-top:-93px;margin-left:-63px;display:none;background:white;text-align:center;border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;" ><img src="../images/143.gif" style="width:32px;" /></div>';
    $(document.body).append(html);
    $("div[name='masker']").bind("click",
        function() {
            close_loading()
        });
    $("div[name='masker']").fadeIn(50)
}
function close_loading() {
    $("div[name='masker']").fadeOut(50,
        function() {
            $("div[name='masker']").remove()
        })
}
function show_tips(msg) {
    var vwidth = $(window).width();
    var vheight = $(window).height();
    var dheight = $(document.body).height();
    var height = 0;
    if (vheight > dheight) {
        height = vheight
    } else {
        height = dheight
    }
    var html = '<div name="myTips" id="tips_container" style="z-index:100;position:absolute;left:0px;top:0px;filter:alpha(opacity=80);-moz-opacity:0.8;opacity:0.8;background:black;width:' + vwidth + "px;height:" + height + 'px;display:none;" ></div>';
    html += '<div name="myTips" style="width:200px;z-index:101;position:fixed;top:50%;left:50%;padding:10px 0px 10px 0px;margin-top:-60px;margin-left:-100px;display:none;background:white;text-align:center;border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;" >';
    html += '<div style="font-size:16px;text-align:left;border-bottom:1px solid #CCC;height:30px;line-height:30px;" ><strong style="margin-left:10px;" >提示</strong></div>';
    html += '<div style="margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;" >' + msg + "</div></div>";
    setTimeout(function(){
        $(document.body).append(html);
        $("div[name='myTips']").fadeIn(50,
            function() {
                window.setTimeout(close_tips, 2000)
            });
    },30);
}

function show_tips_for_login(msg) {
    var vwidth = $(window).width();
    var vheight = $(window).height();
    var dheight = $(document.body).height();
    var height = 0;
    if (vheight > dheight) {
        height = vheight
    } else {
        height = dheight
    }
    var html = '<div name="myTips" id="tips_container" style="z-index:100;position:absolute;left:0px;top:0px;filter:alpha(opacity=80);-moz-opacity:0.8;opacity:0.8;background:black;width:' + vwidth + "px;height:" + height + 'px;display:none;" ></div>';
    html += '<div name="myTips" style="width:200px;z-index:101;position:fixed;top:50%;left:50%;padding:10px 0px 10px 0px;margin-top:-60px;margin-left:-100px;display:none;background:white;text-align:center;border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;" >';
    html += '<div style="font-size:16px;text-align:left;border-bottom:1px solid #CCC;height:30px;line-height:30px;" ><strong style="margin-left:10px;" >提示</strong></div>';
    html += '<div style="margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;" >' + msg + "</div></div>";
    setTimeout(function(){
        $(document.body).append(html);
        $("div[name='myTips']").fadeIn(50,
            function() {
                window.setTimeout(close_tips, 5000)
            });
    },30);
}

function show_unc_tips(msg) {
    var vwidth = $(window).width();
    var vheight = $(window).height();
    var dheight = $(document.body).height();
    var height = 0;
    if (vheight > dheight) {
        height = vheight
    } else {
        height = dheight
    }
    var html = '<div name="myTips" id="tips_container" style="z-index:100;position:absolute;left:0px;top:0px;filter:alpha(opacity=80);-moz-opacity:0.8;opacity:0.8;background:black;width:' + vwidth + "px;height:" + height + 'px;display:none;" ></div>';
    html += '<div name="myTips" style="width:200px;z-index:101;position:fixed;top:50%;left:50%;padding:10px 0px 10px 0px;margin-top:-60px;margin-left:-100px;display:none;background:white;text-align:center;border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;" >';
    html += '<div style="font-size:16px;text-align:left;border-bottom:1px solid #CCC;height:30px;line-height:30px;" ><strong style="margin-left:10px;" >提示</strong><strong style=\"color:red;float:right;\" ><a href=\"javascript:void(0);\" onclick=\"close_tips()\" style=\"padding: 10px 10px;\">关闭</a></strong></div>';
    html += '<div style="margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;" >' + msg + "</div></div>";
    setTimeout(function(){
        $(document.body).append(html);
        $("div[name='myTips']").fadeIn(50);
    },30);
}
function close_tips() {
    $("div[name='myTips']").fadeOut(50,
        function() {
            $("div[name='myTips']").remove()
        });
}
            
Element.prototype.hasClass = function (className) {
    return this.className && new RegExp('(^|\\s)' + className + '(\\s|$)').test(this.className);
};
            
$(document).ready(function(){
    $('.collapse-main-page').on('click', function(){
        var body = $(this).siblings('.panel-collapse');
        body.toggle(220);
    });
});

var time_span=199;		//每隔60秒后才能再次发送验证码
var interval;			//定时器
var run_id;
function run()
{
    //定时执行的操作
    time_span-=1;										//减1秒
    $('#'+run_id).val(time_span+'秒后重发手机验证码');
    if(time_span==0)
    {
        time_span=199;
        $('#'+run_id).removeAttr("disabled").val('获取验证码');
        clearInterval(interval);
    }
}

function getyzm(obj,global_domain,mobile,user_id){
    $.post(global_domain+'/user/server/send_yzm.php', {
        mobile:mobile,
        user_id:user_id
    }, function(response){
        var json = response;
        var stat = json.stat;
        if(stat!="1"){
            alert(json.msg);
        }
    });
    $(obj).attr("disabled", "disabled");
    run_id = $(obj).attr("id");
    run();
    interval=setInterval(run,1000);			//开启定时器
}

function tjToPyq(){
    if($("#shareDivBg").length==0){
        var html = "<div name=\"tips\" id=\"shareDivBg\" onclick=\"tjToPyq()\" style=\"z-index:10001; width:100%; height:100%; position:fixed; top: 0px;left:0px;background:black;text-align: right;filter:alpha(Opacity=80);-moz-opacity:0.8;opacity: 0.8;\"></div>";
        html += "<div name=\"tips\" id=\"shareDivTop\" onclick=\"tjToPyq()\" style=\"z-index:10002;position:fixed;top:0px;right:0px;text-align:right;width:100%;\" ><img src=\"image/collect.png\" style=\"width:100%;\" /></div>";
        $(document.body).append(html);
    }else{
        $("div[name='tips']").hide().remove();
    }
} 

function get_screen(){
    if (/Android\s(\d+\.\d+)/.test(navigator.userAgent)) {
        var version = parseFloat(RegExp.$1);
        if (version > 2.3) {
            var phoneScale = parseInt(window.screen.width) / 640;
            document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
        } else {
            document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
        }
    } else {
        document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
    }
}

function show_control(field1,field2,action){
    var fields1 = $("#v_"+field1);
    var fields2 = $("#v_"+field2);
    $(fields1).removeClass();
    $(fields2).removeClass();
    $(fields2).addClass("btn btn-default btn-lg");
    $(fields1).addClass("btn btn-danger btn-lg");
    $("#item_"+field1).show();
    $("#item_"+field2).hide();
    if(action == 'act'){
        act = field1;
    }else if(action == 'input'){
        $("input[name='act']").val(field1);
    }else if(action == 'check_tips'){
        check_tips();
    }
}
        
function arch_from_click(obj){
    $("#arch_from").text($(obj).find("a").text());
    if($(obj).attr("value") == 1){
        show_control('unuserself','userself','input');
    }else{
        show_control('userself','unuserself','input');
    }
    $("#arch_from_list").removeClass("show");
    $("#arch_from_list").addClass("hide");
}

function show_statics(arch_collect_id,global_domain,ref_id){
    var vwidth = $(window).width();
    var vheight = $(window).height();
    var dheight = $(document.body).height();
    var height = 0;
    var state = '';
    if(vheight>dheight){
        height = vheight;
    }else{
        height = dheight;
    }
            
    $.get(global_domain+'/user/server/write_arch.php',{
        arch_collect_id:arch_collect_id,
        act:"getcollect"
    },function(json){
        if(json.stat>0){
            var btn1 = "",btn2 = "",btn3 = "",btn4 = "",btn5 = "",view="";
            var pv = 0;
            var style = "";
            if (json.state == 3) {
                state = "通过";
                view = "(点击查看文章效果)";
            } else if(json.state == 0) {
                state = "拒绝";
            }else {
                state = "待审";
            }
            if(!IsPC()){
                style = "overflow-y:auto;height:400px;";
            }
            
            if(json.state != 0){
                if(json.pay_1w <1 && json.pv>9999){
                    btn1 += "<a href=\"javascript:void(0)\" onclick=\"get_pay("+json.arch_collect_id+",1)\">1元领取奖励</a>";
                }else if(json.pay_1w>0){
                    btn1 += "<span style=\"color:grey;\">1元领取奖励</span><span style=\"color:red;\">（已领奖）</span>";
                }else{
                    btn1 += "<span style=\"color:grey;\">1元领取奖励</span>";
                }
                if(json.pay_5w <1&&json.pv>49999){
                    btn2 += "<a href=\"javascript:void(0)\" onclick=\"get_pay("+json.arch_collect_id+",2)\">10元领取奖励</a>";
                }else if(json.pay_5w>0){
                    btn2 += "<span style=\"color:grey;\">10元领取奖励</span><span style=\"color:red;\">（已领奖）</span>";
                }else{
                    btn2 += "<span style=\"color:grey;\">10元领取奖励</span>";
                }
                if(json.pay_10w <1&&json.pv>99999){
                    btn3 += "<a href=\"javascript:void(0)\" onclick=\"get_pay("+json.arch_collect_id+",3)\">30元领取奖励</a>";
                }else if(json.pay_10w>0){
                    btn3 += "<span style=\"color:grey;\">30元领取奖励</span><span style=\"color:red;\">（已领奖）</span>";
                }else{
                    btn3 += "<span style=\"color:grey;\">30元领取奖励</span>";
                }
                if(json.pay_50w <1&&json.pv>499999){
                    btn4 += "<a href=\"javascript:void(0)\" onclick=\"get_pay("+json.arch_collect_id+",4)\">200元领取奖励</a>";
                }else if(json.pay_50w>0){
                    btn4 += "<span style=\"color:grey;\">200元领取奖励</span><span style=\"color:red;\">（已领奖）</span>";
                }else{
                    btn4 += "<span style=\"color:grey;\">200元领取奖励</span>";
                }
                if(json.pay_100w <1&&json.pv>999999){
                    btn5 += "<a href=\"javascript:void(0)\" onclick=\"get_pay("+json.arch_collect_id+",5)\">500元领取奖励</a>";
                }else if(json.pay_100w>0){
                    btn5 += "<span style=\"color:grey;\">500元领取奖励</span><span style=\"color:red;\">（已领奖）</span>";
                }else{
                    btn5 += "<span style=\"color:grey;\">500元领取奖励</span>";
                }
            }else{
                btn1 = "不符合资格";
            }
            
            if(json.pv){
                pv = json.pv;
            }
            var html = "<div name=\"myTips\" id=\"tips_container\" style=\"z-index:100;position:absolute;left:0px;top:0px;filter:alpha(opacity=90);-moz-opacity:0.8;opacity:0.8;background:black;width:"+vwidth+"px;height:"+height+"px;display:none;\" ></div>";
            html +="<div name=\"myTips\" style=\""+style+"width:300px;z-index:101;position:fixed;top:50%;left:50%;padding:10px 0px 10px 0px;margin-top:-200px;margin-left:-150px;display:none;background:white;text-align:center;border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;\" >";
            html +="<div style=\"font-size:16px;text-align:left;border-bottom:1px solid #CCC;height:30px;line-height:30px;\" ><strong style=\"margin-left:10px;float:left;\" >明细</strong><strong style=\"color:red;float:right;\" ><a href=\"javascript:void(0);\" onclick=\"close_tips()\" style=\"padding: 10px 10px;\">关闭</a></strong></div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >编号："+json.arch_collect_id+"<a style=\"padding-left:20px;\" href=\"http://www.wei266.com/mob/detail.php?arch_id="+json.arch_id+"&ref_id="+json.app_user_id+"\" target=\"_blank\" >"+view+"</a></div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >标题："+json.title+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >栏目："+json.cate_name+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >阅读量："+pv+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >状态："+state+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:10px;margin-bottom:20px;\" >领取："+btn1+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:52px;margin-bottom:20px;\" >      "+btn2+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:52px;margin-bottom:20px;\" >      "+btn3+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:52px;margin-bottom:20px;\" >      "+btn4+"</div>";
            html += "<div style=\"margin-top:10px;text-align:left;margin-left:52px;margin-bottom:20px;\" >      "+btn5+"</div></div>";
            $(document.body).append(html);	
            $("div[name='myTips']").fadeIn(50,function(){});    
        }else{
            show_tips(json.msg);
            window.location.href = global_domain+"/user/index.php?ref_id="+ref_id;
        }
    },'json');
}

function first_click(field1,field2,fields1,fields2,flag1,flag2){
    $("#"+field1).bind("click",function(){
        if($("#"+fields1).hasClass("hide") || flag1){
            $("#"+fields1).removeClass("hide");
            $("#"+fields1).addClass("show");
        }
        else{
            $("#"+fields1).removeClass("show");
            $("#"+fields1).addClass("hide");
        }
        flag1 = false;
    });
    $("#"+field2).bind("click",function(){
        if($("#"+fields2).hasClass("hide") || flag2){
            $("#"+fields2).removeClass("hide");
            $("#"+fields2).addClass("show");
        }else{
            $("#"+fields2).removeClass("show");
            $("#"+fields2).addClass("hide");
        }
        flag2 = false;
    });
}

function select_click(obj,field,type){
    $("#"+field).text($(obj).find("a").text());
    $("#"+field).attr("value",$(obj).attr("value"));
    if(type){
        $("input[name='"+field+"']").attr("value",$(obj).attr("value"));
    }
    $("#"+field+"_list").removeClass("show");
    $("#"+field+"_list").addClass("hide");
}

function z_yc(state){
    $("#fg1").css("display",state);
}

function check_password(old_password,new_password,confirm_password){
    if(!old_password){
        show_tips("请填写旧密码");
        return false;
    }
    if(!new_password){
        show_tips("请填写新密码");
        return false;
    }
    if(!confirm_password){
        show_tips("请再次填写新密码");
        return false;
    }
    if(new_password!==confirm_password){
        show_tips("新密码和确认密码不一致");
        return false;
    }
    return true;
}

function check_info(alipay,alipay_confirm,name,name_confirm){
    if(!name){
        show_tips("请填写您的支付宝真实姓名");
        return false;
    }
    if(!name_confirm){
        show_tips("请再次填写您的支付宝真实姓名");
        return false;
    }
    if(name!=name_confirm){
        show_tips("填写的支付宝收款人名字请保持一致");
        return false;
    }
    if(!alipay){
        show_tips("请填写您的支付宝帐号");
        return false;
    }
    if(!alipay_confirm){
        show_tips("请再次填写您的支付宝账号");
        return false;
    }
    if(alipay!=alipay_confirm){
        show_tips("填写的支付宝账号请保持一致");
        return false;
    }
    if(!check_date(alipay,"mobile") && !check_date(alipay,"email")){
        show_tips("支付宝账号填写有误");
        return false;
    }
    return true;
}

function check_mobile(mobile,mobile_confirm){
    if(!mobile){
        show_tips("请填写您的手机号码");
        return false;
    }
    if(!mobile_confirm){
        show_tips("请再次填写您的手机号码");
        return false;
    }
    if(mobile!==mobile_confirm){
        show_tips("填写的手机号码不一致");
        return false;
    }
    if(!check_date(mobile,"mobile")){
        show_tips("填写的手机号码不正确");
        return false;
    }
    return true;
}

function sel(o){
    var btns = $(".btn-default");
    var items = $(".item");
    for(i=0;i<btns.length;i++){
        $(btns[i]).removeClass("btn-danger");
        $(items[i]).hide();
        if(o === btns[i]){
            $(btns[i]).addClass("btn-danger");
            $(items[i]).show();
        }
    }
}

function sucess_callback(response){
    var json = response;
    var stat = json.stat;
    var ref_id = json.ref_id;
    show_tips(json.msg);
    setTimeout(function(){
        if(stat>1){
            window.location.href = "/user/self_center.php?ref_id="+ref_id+"&from=write_arch";
        }else if(stat<0){
            window.location.href = "/user/index.php?ref_id="+ref_id;
        }else{
            window.location.href = "/user/write_arch.php?ref_id="+ref_id;
        }
    },2000);
}