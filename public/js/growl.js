/**
 * Created by Iván on 2/07/2016.
 */
/**
 Call script
 <script type="text/javascript">
 $.growl({ title: "Growl", message: "The kitten is awake!" });
 $.growl.error({ message: "The kitten is attacking!" });
 $.growl.notice({ message: "The kitten is cute!" });
 $.growl.warning({ message: "The kitten is ugly!" });
 </script>
 **/
(function() {
    "use strict";
    var $, Animation, Growl,
        bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

    $ = jQuery;

    Animation = (function() {
        function Animation() {}

        Animation.transitions = {
            "webkitTransition": "webkitTransitionEnd",
            "mozTransition": "mozTransitionEnd",
            "oTransition": "oTransitionEnd",
            "transition": "transitionend"
        };

        Animation.transition = function($el) {
            var el, ref, result, type;
            el = $el[0];
            ref = this.transitions;
            for (type in ref) {
                result = ref[type];
                if (el.style[type] != null) {
                    return result;
                }
            }
        };

        return Animation;

    })();

    Growl = (function() {
        Growl.settings = {
            namespace: 'alert',
            duration: 8000,
            close: "&times;",
            location: "growl",
            style: "success",
            size: "medium"
        };

        Growl.growl = function(settings) {
            if (settings == null) {
                settings = {};
            }
            this.initialize();
            return new Growl(settings);
        };

        Growl.initialize = function() {
            return $("body:not(:has(#growls))").append('<div id="growls" />');
        };

        function Growl(settings) {
            if (settings == null) {
                settings = {};
            }
            this.container = bind(this.container, this);
            this.content = bind(this.content, this);
            this.html = bind(this.html, this);
            this.$growl = bind(this.$growl, this);
            this.$growls = bind(this.$growls, this);
            this.animate = bind(this.animate, this);
            this.remove = bind(this.remove, this);
            this.dismiss = bind(this.dismiss, this);
            this.present = bind(this.present, this);
            this.cycle = bind(this.cycle, this);
            this.close = bind(this.close, this);
            this.click = bind(this.click, this);
            this.unbind = bind(this.unbind, this);
            this.bind = bind(this.bind, this);
            this.render = bind(this.render, this);
            this.settings = $.extend({}, Growl.settings, settings);
            this.$growls().attr('class', this.settings.location);
            this.render();
        }

        Growl.prototype.render = function() {
            var $growl;
            $growl = this.$growl();
            this.$growls().append($growl);
            if (this.settings.fixed) {
                this.present();
            } else {
                this.cycle();
            }
        };

        Growl.prototype.bind = function($growl) {
            if ($growl == null) {
                $growl = this.$growl();
            }
            $growl.on("click", this.click);
            return $growl.on("contextmenu", this.close).find(".close").on("click", this.close);
        };

        Growl.prototype.unbind = function($growl) {
            if ($growl == null) {
                $growl = this.$growl();
            }
            $growl.off("click", this.click);
            return $growl.off("contextmenu", this.close).find(".close").off("click", this.close);
        };

        Growl.prototype.click = function(event) {
            if (this.settings.url != null) {
                event.preventDefault();
                event.stopPropagation();
                return window.open(this.settings.url);
            }
        };

        Growl.prototype.close = function(event) {
            var $growl;
            event.preventDefault();
            event.stopPropagation();
            $growl = this.$growl();
            return $growl.stop().queue(this.dismiss).queue(this.remove);
        };

        Growl.prototype.cycle = function() {
            var $growl;
            $growl = this.$growl();
            return $growl.queue(this.present).delay(this.settings.duration).queue(this.dismiss).queue(this.remove);
        };

        Growl.prototype.present = function(callback) {
            var $growl;
            $growl = this.$growl();
            this.bind($growl);
            return this.animate($growl, this.settings.namespace + "-incoming", 'out', callback);
        };

        Growl.prototype.dismiss = function(callback) {
            var $growl;
            $growl = this.$growl();
            this.unbind($growl);
            return this.animate($growl, this.settings.namespace + "-outgoing", 'in', callback);
        };

        Growl.prototype.remove = function(callback) {
            this.$growl().remove();
            return callback();
        };

        Growl.prototype.animate = function($element, name, direction, callback) {
            var transition;
            if (direction == null) {
                direction = 'in';
            }
            transition = Animation.transition($element);
            $element[direction === 'in' ? 'removeClass' : 'addClass'](name);
            $element.offset().position;
            $element[direction === 'in' ? 'addClass' : 'removeClass'](name);
            if (callback == null) {
                return;
            }
            if (transition != null) {
                $element.one(transition, callback);
            } else {
                callback();
            }
        };
        /** Div principal **/
        Growl.prototype.$growls = function() {
            return this.$_growls != null ? this.$_growls : this.$_growls = $('#growls');
        };
        /** Agregar Grow dentro del div principal **/
        Growl.prototype.$growl = function() {
            return this.$_growl != null ? this.$_growl : this.$_growl = $(this.html());
        };

        Growl.prototype.html = function() {
            return this.container(this.content());
        };

        Growl.prototype.content = function() {
            var titleContent = '';
            if(this.settings.title != null)
                titleContent = "<strong>\n<h4 class='text-"+ this.settings.style +"'> "+this.settings.title +"</h4>\n</strong>\n";
            return "<div class='col-xs-2'>\n<span class='fa fa-check-circle fa-2x'></span>\n</div>\n" +
                "<div class='col-xs-10'> \n" +
                "<div class='close'>" + this.settings.close + "</div>\n" +
                titleContent +
                "<p>" + this.settings.message + "</p>" +
                "</div>";
        };

        Growl.prototype.container = function(content) {
            return "<div class='" + this.settings.namespace + " " + this.settings.namespace + "-" + this.settings.style + " row " +  "'>\n  " + content + "\n</div>";
        };
        return Growl;
    })();

    this.Growl = Growl;

    $.growl = function(options) {
        if (options == null) {
            options = {};
        }
        return Growl.growl(options);
    };

    $.growl.error = function(options) {
        var settings;
        if (options == null) {
            options = {};
        }
        settings = {
            style: "danger"
        };
        return $.growl($.extend(settings, options));
    };

    $.growl.notice = function(options) {
        var settings;
        if (options == null) {
            options = {};
        }
        settings = {
            style: "info"
        };
        return $.growl($.extend(settings, options));
    };

    $.growl.warning = function(options) {
        var settings;
        if (options == null) {
            options = {};
        }
        settings = {
            style: "warning"
        };
        return $.growl($.extend(settings, options));
    };

}).call(this);
