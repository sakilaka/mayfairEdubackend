/* -------------------------------------------------------------------------- */
/*                                 Form setup                                 */
/* -------------------------------------------------------------------------- */

//DOM elements
var DOMstrings = {
    stepsBtnClass: "multisteps-form__progress-btn",
    stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
    stepsBar: document.querySelector(".multisteps-form__progress"),
    stepsForm: document.querySelector(".multisteps-form__form"),
    stepsFormTextareas: document.querySelectorAll(".multisteps-form__textarea"),
    stepFormPanelClass: "multisteps-form__panel",
    stepFormPanels: document.querySelectorAll(".multisteps-form__panel"),
    stepPrevBtnClass: "js-btn-prev",
    stepNextBtnClass: "js-btn-next",
};
const resetForm = () => {
    DOMstrings = {
        stepsBtnClass: "multisteps-form__progress-btn",
        stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
        stepsBar: document.querySelector(".multisteps-form__progress"),
        stepsForm: document.querySelector(".multisteps-form__form"),
        stepsFormTextareas: document.querySelectorAll(
            ".multisteps-form__textarea"
        ),
        stepFormPanelClass: "multisteps-form__panel",
        stepFormPanels: document.querySelectorAll(".multisteps-form__panel"),
        stepPrevBtnClass: "js-btn-prev",
        stepNextBtnClass: "js-btn-next",
    };
};

//remove class from a set of items
const removeClasses = (elemSet, className) => {
    elemSet.forEach((elem) => {
        elem.classList.remove(className);
    });
};

//return exect parent node of the element
const findParent = (elem, parentClass) => {
    let currentNode = elem;

    while (!currentNode.classList.contains(parentClass)) {
        currentNode = currentNode.parentNode;
    }

    return currentNode;
};

//get active button step number
const getActiveStep = (elem) => {
    return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

//set all steps before clicked (and clicked too) to active
const setActiveStep = (activeStepNum) => {
    //remove active state from all the state
    removeClasses(DOMstrings.stepsBtns, "js-active");

    //set picked items to active
    DOMstrings.stepsBtns.forEach((elem, index) => {
        if (index <= activeStepNum) {
            elem.classList.add("js-active");
        }
    });
};

//get active panel
const getActivePanel = () => {
    let activePanel;

    DOMstrings.stepFormPanels.forEach((elem) => {
        if (elem.classList.contains("js-active")) {
            activePanel = elem;
        }
    });

    return activePanel;
};

//open active panel (and close unactive panels)
const setActivePanel = (activePanelNum) => {
    //remove active class from all the panels
    removeClasses(DOMstrings.stepFormPanels, "js-active");

    //show active panel
    DOMstrings.stepFormPanels.forEach((elem, index) => {
        if (index === activePanelNum) {
            elem.classList.add("js-active");

            setFormHeight(elem);
        }
    });
};

//set form height equal to current panel height
const formHeight = (activePanel) => {
    const activePanelHeight = activePanel.offsetHeight;

    DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
};

const setFormHeight = () => {
    const activePanel = getActivePanel();
    formHeight(activePanel);
    // window.scrollTo(0, 0);
};

//STEPS BAR CLICK FUNCTION
DOMstrings.stepsBar.addEventListener("click", (e) => {

    //check if click target is a step button
    const eventTarget = e.target;

    if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
        return;
    }

    //get active button step number
    const activeStep = getActiveStep(eventTarget);

    //set all steps before clicked (and clicked too) to active
    setActiveStep(activeStep);

    //open active panel
    setActivePanel(activeStep);
});

//PREV/NEXT BTNS CLICK
DOMstrings.stepsForm.addEventListener("click", (e) => {
    const eventTarget = e.target;

    //check if we clicked on `PREV` or NEXT` buttons
    if (
        !(
            eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) ||
            eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)
        )
    ) {
        return false;
    }

    //find active panel
    const activePanel = findParent(
        eventTarget,
        `${DOMstrings.stepFormPanelClass}`
    );

    let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(
        activePanel
    );

    //set active step and active panel onclick
    if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
        activePanelNum--;
    } else {
        activePanelNum++;
    }

    setActiveStep(activePanelNum);
    setActivePanel(activePanelNum);
});

//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener("load", setFormHeight, false);

//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener("resize", setFormHeight, false);

//SETTING PROPER FORM HEIGHT WHEN EDUCATION AND WORK is Changed
window.addEventListener("updateDynamicField", setFormHeight, false);

/* -------------------------------------------------------------------------- */
/*                                    Utils                                   */
/* -------------------------------------------------------------------------- */

/**
 * @author David Ticona Saravia
 * @param {jQuery} $ jQuery object
 * */
(function ($) {
    var methods = {
        inArray: function (val, array) {
            for (var i = 0, len = array.length; i < len; i++) {
                if (array[i] == val) {
                    return true;
                }
            }
            return false;
        },
    };

    $.fn.checkInput = function (name, values) {
        var $el = this.find("[name='" + name + "']");
        var data = values;
        if (typeof values === "string") {
            data = JSON.parse(values);
        }
        if ($.isArray(data)) {
            var selector = "[name='" + name + "\\[\\]']";
            $el = this.find(selector);
            $el.each(function () {
                var val = $(this).val();
                var state = methods.inArray(val, data);
                $(this).prop("checked", state);
            });
        } else {
            var state = data == $el.val();
            $el.prop("checked", state);
        }
    };

    $.fn.checkAll = function (name, checked) {
        if (checked instanceof jQuery) {
            jQuery.propHooks.checked = {
                set: function (el, value) {
                    if (el.checked !== value) {
                        el.checked = value;
                        $(el).trigger("change");
                    }
                },
            };
            var $chkAll = checked;
            var $container = this;
            var $check = this.find("[name='" + name + "\\[\\]']");
            $chkAll.click(function () {
                var state = $(this).prop("checked");
                $container
                    .find("[name='" + name + "\\[\\]']")
                    .prop("checked", state);
            });
            $check.change(function () {
                if (
                    $check.length ===
                    $container.find("[name='" + name + "\\[\\]']:checked")
                        .length
                )
                    $chkAll.prop("checked", true);
                else $chkAll.prop("checked", false);
            });
            return this;
        }
        this.find("[name='" + name + "\\[\\]']").prop("checked", checked);
    };

    /**
     * @param {mixed} values The values in JSON format (Javascript object or string)
     * */
    $.fn.populateForm = function (values) {
        if (values === "") return;
        var $form = this;
        var data = values;
        if ($.type(values) === "string") {
            data = JSON.parse(values);
        }
        $.each(data, function (name, val) {
            var $el = $form.find("[name='" + name + "']");
            var isSelect = $el.is("select");
            if ($.isArray(val)) {
                var selector = "[name='" + name + "\\[\\]']";
                $el = $form.find(selector);
            }
            var type = isSelect ? "select" : $el.attr("type");
            switch (type) {
                case "checkbox":
                    if ($.isArray(val)) {
                        $el.each(function () {
                            var state = methods.inArray($(this).val(), val);
                            $(this).prop("checked", state);
                        });
                    } else {
                        $el.prop("checked", true);
                    }
                    break;
                case "radio":
                    $el.filter('[value="' + val + '"]').prop("checked", true);
                    break;
                case "select":
                    if ($.isArray(val)) {
                        $el.children("option").each(function () {
                            var state = methods.inArray($(this).val(), val);
                            $(this).prop("selected", state);
                        });
                    } else {
                        $el.val(val);
                    }
                    break;
                default:
                    $el.val(val);
            }
        });
        return this;
    };
    /**
     *
     * @param {string} action URL
     * @param {mixed} select2 The select target. (jQuery object or the selector string)
     * @param {object} options (Optional) The options
     * */
    $.fn.chainedSelect = function (action, select2, options) {
        var settings = $.extend(
            { keyAsValue: true, data: {}, debug: false },
            options
        );
        var $sel2 = select2 instanceof jQuery ? select2 : $(select2);
        var key = this.attr("name");
        function formatOption(obj) {
            var type = $.type(obj),
                opt = { value: "", text: "" };
            if (type === "string" || type === "number") {
                opt.value = obj;
                opt.text = obj;
                return opt;
            }
            if (!$.isPlainObject(obj)) {
                return opt;
            }
            for (var k in obj) {
                opt.value = settings.keyAsValue ? k : obj[k];
                opt.text = obj[k];
                break;
            }
            return opt;
        }
        this.change(function () {
            var data = settings.data;
            data[key] = $(this).val();
            $.post(action, data)
                .done(function (result) {
                    $sel2.empty();
                    $.each(result, function (k, v) {
                        var $opt = $("<option>");
                        var item = formatOption(v);
                        $opt.val(item.value).append(item.text);
                        $sel2.append($opt);
                    });
                    // if (settings.debug) console.log(result);
                })
                .fail(function (e) {
                    if (settings.debug) console.log("Error: " + e.statusText);
                });
        });
        return $sel2;
    };

    $.fn.submitAjax = function (options) {
        var settings = $.extend(
            {
                classButtonDisabled: "disabled",
                before: function () { },
                after: function () { },
                onSuccess: function () { },
                onError: function () { },
                onFail: function () { },
            },
            options
        );
        var action = this.attr("action");
        var method = this.attr("method");
        var data = this.serializeArray();
        var $form = this;
        var $btnSubmit = $form
            .find("[type=submit]")
            .prop("disabled", true)
            .attr("disabled", true)
            .addClass(settings.classButtonDisabled);
        settings.before($form, $btnSubmit);
        var $xhr = $.ajax({
            type: method,
            url: action,
            data: data,
            dataType: "json",
        });
        $xhr.done(function (result) {
            if (result.hasOwnProperty("error")) {
                settings.onError(result);
            } else {
                settings.onSuccess(result);
            }
        });
        $xhr.always(function (r) {
            $btnSubmit
                .prop("disabled", false)
                .removeAttr("disabled")
                .removeClass(settings.classButtonDisabled);
            settings.after($form, $btnSubmit);
        });
        $xhr.fail(function (e) {
            settings.onFail(e);
        });
    };

    /**
     * Submit all data attributes from a clickable element (anchor, button, etc.)
     * Options:
     * ignore: Array with data attributes to ignore on submit
     * method: (Default: 'post')
     * @param {object} options
     * */
    $.fn.clickSubmit = function (options) {
        var settings = $.extend(
            { ignore: [], addData: {}, method: "post", action: "" },
            options
        );
        this.click(function (e) {
            e.preventDefault();
            $(this).prop("disabled", true).addClass("disabled");
            var dataaction = $(this).data("action");
            var action =
                dataaction === "undefined" ? $(this).attr("href") : dataaction;
            if (action === "undefined" || action === "") {
                action = settings.action;
            }
            $(this).removeData("action").removeAttr("data-action");
            var data = $(this).data();
            var $f = $("<form>")
                .attr({ method: settings.method, action: action })
                .hide();
            for (var key in data) {
                if ($.inArray(key, settings.ignore) === -1) {
                    var $h = $("<input>")
                        .attr({ type: "hidden", name: key })
                        .val(data[key]);
                    $f.append($h);
                }
            }
            for (var key in settings.addData) {
                var $h = $("<input>")
                    .attr({ type: "hidden", name: key })
                    .val(settings.addData[key]);
                $f.append($h);
            }
            $(this).after($f);
            $f.submit();
        });
    };
    /**
     * Send an Ajax Post Request with all data attributes from a clickable element.
     * Options:
     * ========
     * dataType: Default is 'text'
     * ignore: Ignore data attributes
     * addData: Add data to send in request
     * done: callback function
     * fail: callback function
     * @param {object} options
     * */
    $.fn.clickAjax = function (options) {
        var settings = $.extend(
            {
                ignore: [],
                addData: {},
                method: "post",
                action: "",
                dataType: "text",
                start: null,
                done: null,
                fail: null,
            },
            options
        );
        var $btnTarget = null;
        this.click(function (e) {
            e.preventDefault();
            $btnTarget = $(this);
            var dataaction = $(this).data("action");
            var action =
                dataaction === "undefined" ? $(this).attr("href") : dataaction;
            if (action === "undefined" || action === "") {
                action = settings.action;
            }
            $(this).removeData("action").removeAttr("data-action");
            var fdata = $(this).data();
            var data = {};
            for (var key in fdata) {
                if ($.inArray(key, settings.ignore) === -1) {
                    data[key] = fdata[key];
                }
            }
            $(this).data("action", action);
            $.extend(data, settings.addData);
            $(this).prop("disabled", true).addClass("disabled");
            if (typeof settings.start === "function") {
                settings.start();
            }
            var $xhr = $.ajax({
                type: settings.method,
                url: action,
                data: data,
                success: success,
                dataType: settings.dataType,
            });
            if (typeof settings.fail === "function") $xhr.fail(settings.fail);
            $xhr.always(function () {
                $btnTarget.removeClass("disabled").removeProp("disabled");
            });
        });
        var success = function (res) {
            if (typeof settings.done === "function") {
                settings.done(res);
            }
        };
        this.start = function (func) {
            settings.start = func;
        };
        this.fail = function (func) {
            settings.fail = func;
        };
        this.done = function (func) {
            settings.done = func;
        };
        return this;
    };
})(jQuery);

//Convert json response to form
$.fn.jsonToForm = function (data, callbacks) {
    var formInstance = this;

    var options = {
        data: data || null,
        callbacks: callbacks,
    };

    if (options.data != null) {
        $.each(options.data, function (k, v) {
            if (
                options.callbacks != null &&
                options.callbacks.hasOwnProperty(k)
            ) {
                options.callbacks[k](v);
            } else {
                $('[name="' + k + '"]', formInstance).val(v);
            }
        });
    }
};

/*!
  SerializeJSON jQuery plugin.
  https://github.com/marioizquierdo/jquery.serializeJSON
  version 2.9.0 (Jan, 2018)

  Copyright (c) 2012-2018 Mario Izquierdo
  Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
  and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
*/
!(function (e) {
    if ("function" == typeof define && define.amd) define(["jquery"], e);
    else if ("object" == typeof exports) {
        var n = require("jquery");
        module.exports = e(n);
    } else e(window.jQuery || window.Zepto || window.$);
})(function (e) {
    "use strict";
    (e.fn.serializeJSON = function (n) {
        var r, s, t, i, a, u, l, o, p, c, d, f, y;
        return (
            (r = e.serializeJSON),
            (s = this),
            (t = r.setupOpts(n)),
            (i = s.serializeArray()),
            r.readCheckboxUncheckedValues(i, t, s),
            (a = {}),
            e.each(i, function (e, n) {
                (u = n.name),
                    (l = n.value),
                    (p = r.extractTypeAndNameWithNoType(u)),
                    (c = p.nameWithNoType),
                    (d = p.type) ||
                    (d = r.attrFromInputWithName(s, u, "data-value-type")),
                    r.validateType(u, d, t),
                    "skip" !== d &&
                    ((f = r.splitInputNameIntoKeysArray(c)),
                        (o = r.parseValue(l, u, d, t)),
                        (y = !o && r.shouldSkipFalsy(s, u, c, d, t)) ||
                        r.deepSet(a, f, o, t));
            }),
            a
        );
    }),
        (e.serializeJSON = {
            defaultOptions: {
                checkboxUncheckedValue: void 0,
                parseNumbers: !1,
                parseBooleans: !1,
                parseNulls: !1,
                parseAll: !1,
                parseWithFunction: null,
                skipFalsyValuesForTypes: [],
                skipFalsyValuesForFields: [],
                customTypes: {},
                defaultTypes: {
                    string: function (e) {
                        return String(e);
                    },
                    number: function (e) {
                        return Number(e);
                    },
                    boolean: function (e) {
                        return (
                            -1 ===
                            ["false", "null", "undefined", "", "0"].indexOf(e)
                        );
                    },
                    null: function (e) {
                        return -1 ===
                            ["false", "null", "undefined", "", "0"].indexOf(e)
                            ? e
                            : null;
                    },
                    array: function (e) {
                        return JSON.parse(e);
                    },
                    object: function (e) {
                        return JSON.parse(e);
                    },
                    auto: function (n) {
                        return e.serializeJSON.parseValue(n, null, null, {
                            parseNumbers: !0,
                            parseBooleans: !0,
                            parseNulls: !0,
                        });
                    },
                    skip: null,
                },
                useIntKeysAsArrayIndex: !1,
            },
            setupOpts: function (n) {
                var r, s, t, i, a, u;
                (u = e.serializeJSON),
                    null == n && (n = {}),
                    (t = u.defaultOptions || {}),
                    (s = [
                        "checkboxUncheckedValue",
                        "parseNumbers",
                        "parseBooleans",
                        "parseNulls",
                        "parseAll",
                        "parseWithFunction",
                        "skipFalsyValuesForTypes",
                        "skipFalsyValuesForFields",
                        "customTypes",
                        "defaultTypes",
                        "useIntKeysAsArrayIndex",
                    ]);
                for (r in n)
                    if (-1 === s.indexOf(r))
                        throw new Error(
                            "serializeJSON ERROR: invalid option '" +
                            r +
                            "'. Please use one of " +
                            s.join(", ")
                        );
                return (
                    (i = function (e) {
                        return !1 !== n[e] && "" !== n[e] && (n[e] || t[e]);
                    }),
                    (a = i("parseAll")),
                    {
                        checkboxUncheckedValue: i("checkboxUncheckedValue"),
                        parseNumbers: a || i("parseNumbers"),
                        parseBooleans: a || i("parseBooleans"),
                        parseNulls: a || i("parseNulls"),
                        parseWithFunction: i("parseWithFunction"),
                        skipFalsyValuesForTypes: i("skipFalsyValuesForTypes"),
                        skipFalsyValuesForFields: i("skipFalsyValuesForFields"),
                        typeFunctions: e.extend(
                            {},
                            i("defaultTypes"),
                            i("customTypes")
                        ),
                        useIntKeysAsArrayIndex: i("useIntKeysAsArrayIndex"),
                    }
                );
            },
            parseValue: function (n, r, s, t) {
                var i, a;
                return (
                    (i = e.serializeJSON),
                    (a = n),
                    t.typeFunctions && s && t.typeFunctions[s]
                        ? (a = t.typeFunctions[s](n))
                        : t.parseNumbers && i.isNumeric(n)
                            ? (a = Number(n))
                            : !t.parseBooleans || ("true" !== n && "false" !== n)
                                ? t.parseNulls && "null" == n
                                    ? (a = null)
                                    : t.typeFunctions &&
                                    t.typeFunctions.string &&
                                    (a = t.typeFunctions.string(n))
                                : (a = "true" === n),
                    t.parseWithFunction &&
                    !s &&
                    (a = t.parseWithFunction(a, r)),
                    a
                );
            },
            isObject: function (e) {
                return e === Object(e);
            },
            isUndefined: function (e) {
                return void 0 === e;
            },
            isValidArrayIndex: function (e) {
                return /^[0-9]+$/.test(String(e));
            },
            isNumeric: function (e) {
                return e - parseFloat(e) >= 0;
            },
            optionKeys: function (e) {
                if (Object.keys) return Object.keys(e);
                var n,
                    r = [];
                for (n in e) r.push(n);
                return r;
            },
            readCheckboxUncheckedValues: function (n, r, s) {
                var t, i, a;
                null == r && (r = {}),
                    e.serializeJSON,
                    (t =
                        "input[type=checkbox][name]:not(:checked):not([disabled])"),
                    s
                        .find(t)
                        .add(s.filter(t))
                        .each(function (s, t) {
                            if (
                                ((i = e(t)),
                                    null == (a = i.attr("data-unchecked-value")) &&
                                    (a = r.checkboxUncheckedValue),
                                    null != a)
                            ) {
                                if (t.name && -1 !== t.name.indexOf("[]["))
                                    throw new Error(
                                        "serializeJSON ERROR: checkbox unchecked values are not supported on nested arrays of objects like '" +
                                        t.name +
                                        "'. See https://github.com/marioizquierdo/jquery.serializeJSON/issues/67"
                                    );
                                n.push({ name: t.name, value: a });
                            }
                        });
            },
            extractTypeAndNameWithNoType: function (e) {
                var n;
                return (n = e.match(/(.*):([^:]+)$/))
                    ? { nameWithNoType: n[1], type: n[2] }
                    : { nameWithNoType: e, type: null };
            },
            shouldSkipFalsy: function (n, r, s, t, i) {
                var a = e.serializeJSON.attrFromInputWithName(
                    n,
                    r,
                    "data-skip-falsy"
                );
                if (null != a) return "false" !== a;
                var u = i.skipFalsyValuesForFields;
                if (u && (-1 !== u.indexOf(s) || -1 !== u.indexOf(r)))
                    return !0;
                var l = i.skipFalsyValuesForTypes;
                return (
                    null == t && (t = "string"), !(!l || -1 === l.indexOf(t))
                );
            },
            attrFromInputWithName: function (e, n, r) {
                var s, t;
                return (
                    (s = n.replace(/(:|\.|\[|\]|\s)/g, "\\$1")),
                    (t = '[name="' + s + '"]'),
                    e.find(t).add(e.filter(t)).attr(r)
                );
            },
            validateType: function (n, r, s) {
                var t, i;
                if (
                    ((i = e.serializeJSON),
                        (t = i.optionKeys(
                            s ? s.typeFunctions : i.defaultOptions.defaultTypes
                        )),
                        r && -1 === t.indexOf(r))
                )
                    throw new Error(
                        "serializeJSON ERROR: Invalid type " +
                        r +
                        " found in input name '" +
                        n +
                        "', please use one of " +
                        t.join(", ")
                    );
                return !0;
            },
            splitInputNameIntoKeysArray: function (n) {
                var r;
                return (
                    e.serializeJSON,
                    (r = n.split("[")),
                    "" ===
                    (r = e.map(r, function (e) {
                        return e.replace(/\]/g, "");
                    }))[0] && r.shift(),
                    r
                );
            },
            deepSet: function (n, r, s, t) {
                var i, a, u, l, o, p;
                if (
                    (null == t && (t = {}),
                        (p = e.serializeJSON).isUndefined(n))
                )
                    throw new Error(
                        "ArgumentError: param 'o' expected to be an object or array, found undefined"
                    );
                if (!r || 0 === r.length)
                    throw new Error(
                        "ArgumentError: param 'keys' expected to be an array with least one element"
                    );
                (i = r[0]),
                    1 === r.length
                        ? "" === i
                            ? n.push(s)
                            : (n[i] = s)
                        : ((a = r[1]),
                            "" === i &&
                            ((o = n[(l = n.length - 1)]),
                                (i =
                                    p.isObject(o) &&
                                        (p.isUndefined(o[a]) || r.length > 2)
                                        ? l
                                        : l + 1)),
                            "" === a
                                ? (!p.isUndefined(n[i]) && e.isArray(n[i])) ||
                                (n[i] = [])
                                : t.useIntKeysAsArrayIndex &&
                                    p.isValidArrayIndex(a)
                                    ? (!p.isUndefined(n[i]) && e.isArray(n[i])) ||
                                    (n[i] = [])
                                    : (!p.isUndefined(n[i]) && p.isObject(n[i])) ||
                                    (n[i] = {}),
                            (u = r.slice(1)),
                            p.deepSet(n[i], u, s, t));
            },
        });
});

//jquery-repeater https://github.com/vijaybajrot/jquery-repeater
jQuery.fn.extend({
    createRepeater: function (options = {}) {
        var hasOption = function (optionKey) {
            return options.hasOwnProperty(optionKey);
        };

        var option = function (optionKey) {
            return options[optionKey];
        };

        var generateId = function (string) {
            return string.replace(/\[/g, "_").replace(/\]/g, "").toLowerCase();
        };

        var addItem = function (items, key, fresh = true) {

            var itemContent = items;
            var group = itemContent.data("group");
            var item = itemContent;
            var input = item.find("input,select");

            input.each(function (index, el) {
                var attrName = $(el).data("name");
                var skipName = $(el).data("skip-name");
                if (skipName != true) {
                    $(el).attr(
                        "name",
                        group + "[" + key + "]" + "[" + attrName + "]"
                    );
                } else {
                    if (attrName != "undefined") {
                        $(el).attr("name", attrName);
                    }
                }
                if (fresh == true) {
                    $(el).attr("value", "");
                }

                $(el).attr("id", generateId($(el).attr("name")));
                $(el)
                    .parent()
                    .find("label")
                    .attr("for", generateId($(el).attr("name")));
            });

            var itemClone = items;

            /* Handling remove btn */
            var removeButton = itemClone.find(".remove-btn");

            removeButton.attr("disabled", false);

            removeButton.attr("onclick", "$(this).parents('.items').remove()");

            var newItem = $(
                "<div class='items'>" + itemClone.html() + "<div/>"
            );
            newItem.attr("data-index", key);

            $(document).trigger("repetted");
            newItem.appendTo(repeater);
        };

        /* find elements */
        var repeater = this;
        var items = repeater.find(".items");
        var key = 0;
        var addButton = repeater.find(".repeater-add-btn");

        items.each(function (index, item) {
            items.remove();

            if (
                hasOption("showFirstItemToDefault") &&
                option("showFirstItemToDefault") == true
            ) {
                addItem($(item), key);
                key++;
            } else {
                if (items.length > 1) {
                    addItem($(item), key);
                    key++;
                }
            }
        });

        /* handle click and add items */
        addButton.on("click", function () {
            addItem($(items[0]), key);
            key++;
        });
    },
});

var isoCountries = [
    { id: "AF", text: "Afghanistan" },
    { id: "AX", text: "Aland Islands" },
    { id: "AL", text: "Albania" },
    { id: "DZ", text: "Algeria" },
    { id: "AS", text: "American Samoa" },
    { id: "AD", text: "Andorra" },
    { id: "AO", text: "Angola" },
    { id: "AI", text: "Anguilla" },
    { id: "AQ", text: "Antarctica" },
    { id: "AG", text: "Antigua And Barbuda" },
    { id: "AR", text: "Argentina" },
    { id: "AM", text: "Armenia" },
    { id: "AW", text: "Aruba" },
    { id: "AU", text: "Australia" },
    { id: "AT", text: "Austria" },
    { id: "AZ", text: "Azerbaijan" },
    { id: "BS", text: "Bahamas" },
    { id: "BH", text: "Bahrain" },
    { id: "BD", text: "Bangladesh" },
    { id: "BB", text: "Barbados" },
    { id: "BY", text: "Belarus" },
    { id: "BE", text: "Belgium" },
    { id: "BZ", text: "Belize" },
    { id: "BJ", text: "Benin" },
    { id: "BM", text: "Bermuda" },
    { id: "BT", text: "Bhutan" },
    { id: "BO", text: "Bolivia" },
    { id: "BA", text: "Bosnia And Herzegovina" },
    { id: "BW", text: "Botswana" },
    { id: "BV", text: "Bouvet Island" },
    { id: "BR", text: "Brazil" },
    { id: "IO", text: "British Indian Ocean Territory" },
    { id: "BN", text: "Brunei Darussalam" },
    { id: "BG", text: "Bulgaria" },
    { id: "BF", text: "Burkina Faso" },
    { id: "BI", text: "Burundi" },
    { id: "KH", text: "Cambodia" },
    { id: "CM", text: "Cameroon" },
    { id: "CA", text: "Canada" },
    { id: "CV", text: "Cape Verde" },
    { id: "KY", text: "Cayman Islands" },
    { id: "CF", text: "Central African Republic" },
    { id: "TD", text: "Chad" },
    { id: "CL", text: "Chile" },
    { id: "CN", text: "China" },
    { id: "CX", text: "Christmas Island" },
    { id: "CC", text: "Cocos (Keeling) Islands" },
    { id: "CO", text: "Colombia" },
    { id: "KM", text: "Comoros" },
    { id: "CG", text: "Congo" },
    { id: "CD", text: "Congo, Democratic Republic" },
    { id: "CK", text: "Cook Islands" },
    { id: "CR", text: "Costa Rica" },
    { id: "CI", text: "Cote D'Ivoire" },
    { id: "HR", text: "Croatia" },
    { id: "CU", text: "Cuba" },
    { id: "CY", text: "Cyprus" },
    { id: "CZ", text: "Czech Republic" },
    { id: "DK", text: "Denmark" },
    { id: "DJ", text: "Djibouti" },
    { id: "DM", text: "Dominica" },
    { id: "DO", text: "Dominican Republic" },
    { id: "EC", text: "Ecuador" },
    { id: "EG", text: "Egypt" },
    { id: "SV", text: "El Salvador" },
    { id: "GQ", text: "Equatorial Guinea" },
    { id: "ER", text: "Eritrea" },
    { id: "EE", text: "Estonia" },
    { id: "ET", text: "Ethiopia" },
    { id: "FK", text: "Falkland Islands (Malvinas)" },
    { id: "FO", text: "Faroe Islands" },
    { id: "FJ", text: "Fiji" },
    { id: "FI", text: "Finland" },
    { id: "FR", text: "France" },
    { id: "GF", text: "French Guiana" },
    { id: "PF", text: "French Polynesia" },
    { id: "TF", text: "French Southern Territories" },
    { id: "GA", text: "Gabon" },
    { id: "GM", text: "Gambia" },
    { id: "GE", text: "Georgia" },
    { id: "DE", text: "Germany" },
    { id: "GH", text: "Ghana" },
    { id: "GI", text: "Gibraltar" },
    { id: "GR", text: "Greece" },
    { id: "GL", text: "Greenland" },
    { id: "GD", text: "Grenada" },
    { id: "GP", text: "Guadeloupe" },
    { id: "GU", text: "Guam" },
    { id: "GT", text: "Guatemala" },
    { id: "GG", text: "Guernsey" },
    { id: "GN", text: "Guinea" },
    { id: "GW", text: "Guinea-Bissau" },
    { id: "GY", text: "Guyana" },
    { id: "HT", text: "Haiti" },
    { id: "HM", text: "Heard Island & Mcdonald Islands" },
    { id: "VA", text: "Holy See (Vatican City State)" },
    { id: "HN", text: "Honduras" },
    { id: "HK", text: "Hong Kong, China" },
    { id: "HU", text: "Hungary" },
    { id: "IS", text: "Iceland" },
    { id: "IN", text: "India" },
    { id: "ID", text: "Indonesia" },
    { id: "IR", text: "Iran}, Islamic Republic Of" },
    { id: "IQ", text: "Iraq" },
    { id: "IE", text: "Ireland" },
    { id: "IM", text: "Isle Of Man" },
    { id: "IL", text: "Israel" },
    { id: "IT", text: "Italy" },
    { id: "JM", text: "Jamaica" },
    { id: "JP", text: "Japan" },
    { id: "JE", text: "Jersey" },
    { id: "JO", text: "Jordan" },
    { id: "KZ", text: "Kazakhstan" },
    { id: "KE", text: "Kenya" },
    { id: "KI", text: "Kiribati" },
    { id: "KR", text: "Korea" },
    { id: "KW", text: "Kuwait" },
    { id: "KG", text: "Kyrgyzstan" },
    { id: "LA", text: "Lao People's Democratic Republic" },
    { id: "LV", text: "Latvia" },
    { id: "LB", text: "Lebanon" },
    { id: "LS", text: "Lesotho" },
    { id: "LR", text: "Liberia" },
    { id: "LY", text: "Libyan Arab Jamahiriya" },
    { id: "LI", text: "Liechtenstein" },
    { id: "LT", text: "Lithuania" },
    { id: "LU", text: "Luxembourg" },
    { id: "MO", text: "Macao, China" },
    { id: "MK", text: "Macedonia" },
    { id: "MG", text: "Madagascar" },
    { id: "MW", text: "Malawi" },
    { id: "MY", text: "Malaysia" },
    { id: "MV", text: "Maldives" },
    { id: "ML", text: "Mali" },
    { id: "MT", text: "Malta" },
    { id: "MH", text: "Marshall Islands" },
    { id: "MQ", text: "Martinique" },
    { id: "MR", text: "Mauritania" },
    { id: "MU", text: "Mauritius" },
    { id: "YT", text: "Mayotte" },
    { id: "MX", text: "Mexico" },
    { id: "FM", text: "Micronesia, Federated States Of Micronesia" },
    { id: "MD", text: "Moldova" },
    { id: "MC", text: "Monaco" },
    { id: "MN", text: "Mongolia" },
    { id: "ME", text: "Montenegro" },
    { id: "MS", text: "Montserrat" },
    { id: "MA", text: "Morocco" },
    { id: "MZ", text: "Mozambique" },
    { id: "MM", text: "Myanmar" },
    { id: "NA", text: "Namibia" },
    { id: "NR", text: "Nauru" },
    { id: "NP", text: "Nepal" },
    { id: "NL", text: "Netherlands" },
    { id: "AN", text: "Netherlands Antilles" },
    { id: "NC", text: "New Caledonia" },
    { id: "NZ", text: "New Zealand" },
    { id: "NI", text: "Nicaragua" },
    { id: "NE", text: "Niger" },
    { id: "NG", text: "Nigeria" },
    { id: "NU", text: "Niue" },
    { id: "NF", text: "Norfolk Island" },
    { id: "MP", text: "Northern Mariana Islands" },
    { id: "NO", text: "Norway" },
    { id: "OM", text: "Oman" },
    { id: "PK", text: "Pakistan" },
    { id: "PW", text: "Palau" },
    { id: "PS", text: "Palestinian Territory, Occupied" },
    { id: "PA", text: "Panama" },
    { id: "PG", text: "Papua New Guinea" },
    { id: "PY", text: "Paraguay" },
    { id: "PE", text: "Peru" },
    { id: "PH", text: "Philippines" },
    { id: "PN", text: "Pitcairn" },
    { id: "PL", text: "Poland" },
    { id: "PT", text: "Portugal" },
    { id: "PR", text: "Puerto Rico" },
    { id: "QA", text: "Qatar" },
    { id: "RE", text: "Reunion" },
    { id: "RO", text: "Romania" },
    { id: "RU", text: "Russian Federation" },
    { id: "RW", text: "Rwanda" },
    { id: "BL", text: "Saint Barthelemy" },
    { id: "SH", text: "Saint Helena" },
    { id: "KN", text: "Saint Kitts And Nevis" },
    { id: "LC", text: "Saint Lucia" },
    { id: "MF", text: "Saint Martin" },
    { id: "PM", text: "Saint Pierre And Miquelon" },
    { id: "VC", text: "Saint Vincent And Grenadines" },
    { id: "WS", text: "Samoa" },
    { id: "SM", text: "San Marino" },
    { id: "ST", text: "Sao Tome And Principe" },
    { id: "SA", text: "Saudi Arabia" },
    { id: "SN", text: "Senegal" },
    { id: "RS", text: "Serbia" },
    { id: "SC", text: "Seychelles" },
    { id: "SL", text: "Sierra Leone" },
    { id: "SG", text: "Singapore" },
    { id: "SK", text: "Slovakia" },
    { id: "SI", text: "Slovenia" },
    { id: "SB", text: "Solomon Islands" },
    { id: "SO", text: "Somalia" },
    { id: "ZA", text: "South Africa" },
    { id: "GS", text: "South Georgia And Sandwich Isl." },
    { id: "ES", text: "Spain" },
    { id: "LK", text: "Sri Lanka" },
    { id: "SD", text: "Sudan" },
    { id: "SS", text: "South Sudan" },
    { id: "SR", text: "Suriname" },
    { id: "SJ", text: "Svalbard And Jan Mayen" },
    { id: "SZ", text: "Swaziland" },
    { id: "SE", text: "Sweden" },
    { id: "CH", text: "Switzerland" },
    { id: "SY", text: "Syrian Arab Republic" },
    { id: "TW", text: "Taiwan, China" },
    { id: "TJ", text: "Tajikistan" },
    { id: "TZ", text: "Tanzania" },
    { id: "TH", text: "Thailand" },
    { id: "TL", text: "Timor-Leste" },
    { id: "TG", text: "Togo" },
    { id: "TK", text: "Tokelau" },

    { id: "TO", text: "Tonga" },
    { id: "TT", text: "Trinidad And Tobago" },
    { id: "TN", text: "Tunisia" },
    { id: "TR", text: "Turkey" },
    { id: "TM", text: "Turkmenistan" },
    { id: "TC", text: "Turks And Caicos Islands" },
    { id: "TV", text: "Tuvalu" },
    { id: "UG", text: "Uganda" },
    { id: "UA", text: "Ukraine" },
    { id: "AE", text: "United Arab Emirates" },
    { id: "GB", text: "United Kingdom" },
    { id: "US", text: "United States" },
    { id: "UM", text: "United States Outlying Islands" },
    { id: "UY", text: "Uruguay" },
    { id: "UZ", text: "Uzbekistan" },
    { id: "VU", text: "Vanuatu" },
    { id: "VE", text: "Venezuela" },
    { id: "VN", text: "Viet Nam" },
    { id: "VG", text: "Virgin Islands, British" },
    { id: "VI", text: "Virgin Islands, U.S." },
    { id: "WF", text: "Wallis And Futuna" },
    { id: "EH", text: "Western Sahara" },
    { id: "YE", text: "Yemen" },
    { id: "ZM", text: "Zambia" },
    { id: "ZW", text: "Zimbabwe" },
];
