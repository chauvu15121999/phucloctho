! function(a, b, c) {
    a.fn.simplyScroll = function(b) {
		$("head").append("<style>.vert.simply-scroll-container{overflow:hidden}.vert .simply-scroll-clip{height:auto !important}</style>");
        return this.each(function() {
            new a.simplyScroll(this, b)
        })
    };
    var d = {
        customClass: "simply-scroll",
        frameRate: 24,
        speed: 1,
        orientation: "horizontal",
        auto: !0,
        autoMode: "loop",
        manualMode: "end",
        direction: "forwards",
        pauseOnHover: !0,
        pauseOnTouch: !0,
        pauseButton: !1,
        startOnLoad: !1
    };
    a.simplyScroll = function(c, e) {
        var f = this;
        this.o = a.extend({}, d, e || {}), this.isAuto = !1 !== this.o.auto && null !== this.o.autoMode.match(/^loop|bounce$/), this.isHorizontal = null !== this.o.orientation.match(/^horizontal|vertical$/) && this.o.orientation == d.orientation, this.isRTL = this.isHorizontal && "rtl" == a("html").attr("dir"), this.isForwards = !this.isAuto || this.isAuto && null !== this.o.direction.match(/^forwards|backwards$/) && this.o.direction == d.direction && !this.isRTL, this.isLoop = this.isAuto && "loop" == this.o.autoMode || !this.isAuto && "loop" == this.o.manualMode, this.supportsTouch = "createTouch" in document, this.events = this.supportsTouch ? {
            start: "touchstart MozTouchDown",
            move: "touchmove MozTouchMove",
            end: "touchend touchcancel MozTouchRelease"
        } : {
            start: "mouseenter",
            end: "mouseleave"
        }, this.$list = a(c);
        var g = this.$list.children();
        if (this.$list.addClass("simply-scroll-list").wrap('<div class="simply-scroll-clip"></div>').parent().wrap('<div class="' + this.o.customClass + ' simply-scroll-container"></div>'), this.isAuto ? this.o.pauseButton && (this.$list.parent().parent().prepend('<div class="simply-scroll-btn simply-scroll-btn-pause"></div>'), this.o.pauseOnHover = !1) : this.$list.parent().parent().prepend('<div class="simply-scroll-forward"></div>').prepend('<div class="simply-scroll-back"></div>'), g.length > 1) {
            var h = !1,
                i = 0;
            this.isHorizontal ? (g.each(function() {
                i += a(this).outerWidth(!0)
            }), h = g.eq(0).outerWidth(!0) * g.length !== i) : (g.each(function() {
                i += a(this).outerHeight(!0)
            }), h = g.eq(0).outerHeight(!0) * g.length !== i), h && (this.$list = this.$list.wrap("<div></div>").parent().addClass("simply-scroll-list"), this.isHorizontal ? this.$list.children().css({
                float: "left",
                width: i + "px"
            }) : this.$list.children().css({
                height: i + "px"
            }))
        }
        this.o.startOnLoad ? a(b).load(function() {
            f.init()
        }) : this.init()
    }, a.simplyScroll.fn = a.simplyScroll.prototype = {}, a.simplyScroll.fn.extend = a.simplyScroll.extend = a.extend, a.simplyScroll.fn.extend({
        init: function() {
            function g() {
                return !1 === f.paused ? (f.paused = !0, f.funcMovePause()) : (f.paused = !1, f.funcMoveResume()), f.paused
            }
            this.$items = this.$list.children(), this.$clip = this.$list.parent(), this.$container = this.$clip.parent(), this.$btnBack = a(".simply-z-back", this.$container), this.$btnForward = a(".simply-scroll-forward", this.$container), this.isHorizontal ? (this.itemMax = this.$items.eq(0).outerWidth(!0), this.clipMax = this.$clip.width(), this.dimension = "width", this.moveBackClass = "simply-scroll-btn-left", this.moveForwardClass = "simply-scroll-btn-right", this.scrollPos = "Left") : (this.itemMax = this.$items.eq(0).outerHeight(!0), this.clipMax = this.$clip.height(), this.dimension = "height", this.moveBackClass = "simply-scroll-btn-up", this.moveForwardClass = "simply-scroll-btn-down", this.scrollPos = "Top"), this.posMin = 0, this.posMax = this.$items.length * this.itemMax;
            var b = Math.ceil(this.clipMax / this.itemMax);
            if (this.isAuto && "loop" == this.o.autoMode) this.$list.css(this.dimension, this.posMax + this.itemMax * b + "px"), this.posMax += this.clipMax - this.o.speed, this.isForwards ? (this.$items.slice(0, b).clone(!0).appendTo(this.$list), this.resetPosition = 0) : (this.$items.slice(-b).clone(!0).prependTo(this.$list), this.resetPosition = this.$items.length * this.itemMax, this.isRTL && (this.$clip[0].dir = "ltr", this.$items.css("float", "right")));
            else if (this.isAuto || "loop" != this.o.manualMode) this.$list.css(this.dimension, this.posMax + "px"), this.isForwards ? this.resetPosition = 0 : (this.resetPosition = this.$items.length * this.itemMax, this.isRTL && (this.$clip[0].dir = "ltr", this.$items.css("float", "right")));
            else {
                this.posMax += this.itemMax * b, this.$list.css(this.dimension, this.posMax + this.itemMax * b + "px"), this.posMax += this.clipMax - this.o.speed;
                this.$items.slice(0, b).clone(!0).appendTo(this.$list), this.$items.slice(-b).clone(!0).prependTo(this.$list);
                this.resetPositionForwards = this.resetPosition = b * this.itemMax, this.resetPositionBackwards = this.$items.length * this.itemMax;
                var f = this;
                this.$btnBack.bind(this.events.start, function() {
                    f.isForwards = !1, f.resetPosition = f.resetPositionBackwards
                }), this.$btnForward.bind(this.events.start, function() {
                    f.isForwards = !0, f.resetPosition = f.resetPositionForwards
                })
            }
            if (this.resetPos(), this.interval = null, this.intervalDelay = Math.floor(1e3 / this.o.frameRate), this.isAuto || "end" != this.o.manualMode)
                for (; this.itemMax % this.o.speed != 0;)
                    if (0 === --this.o.speed) {
                        this.o.speed = 1;
                        break
                    } var f = this;
            if (this.trigger = null, this.funcMoveBack = function(a) {
                    a !== c && a.preventDefault(), f.trigger = f.isAuto || "end" != f.o.manualMode ? null : this, f.isAuto ? f.isForwards ? f.moveBack() : f.moveForward() : f.moveBack()
                }, this.funcMoveForward = function(a) {
                    a !== c && a.preventDefault(), f.trigger = f.isAuto || "end" != f.o.manualMode ? null : this, f.isAuto ? f.isForwards ? f.moveForward() : f.moveBack() : f.moveForward()
                }, this.funcMovePause = function() {
                    f.movePause()
                }, this.funcMoveStop = function() {
                    f.moveStop()
                }, this.funcMoveResume = function() {
                    f.moveResume()
                }, this.isAuto) {
                if (this.paused = !1, this.supportsTouch && this.$items.find("a").length && (this.supportsTouch = !1), this.isAuto && this.o.pauseOnHover && !this.supportsTouch) this.$clip.bind(this.events.start, this.funcMovePause).bind(this.events.end, this.funcMoveResume);
                else if (this.isAuto && this.o.pauseOnTouch && !this.o.pauseButton && this.supportsTouch) {
                    var h, i;
                    this.$clip.bind(this.events.start, function(a) {
                        g();
                        var b = a.originalEvent.touches[0];
                        h = f.isHorizontal ? b.pageX : b.pageY, i = f.$clip[0]["scroll" + f.scrollPos], a.stopPropagation(), a.preventDefault()
                    }).bind(this.events.move, function(a) {
                        a.stopPropagation(), a.preventDefault();
                        var b = a.originalEvent.touches[0],
                            c = f.isHorizontal ? b.pageX : b.pageY,
                            d = h - c + i;
                        d < 0 ? d = 0 : d > f.posMax && (d = f.posMax), f.$clip[0]["scroll" + f.scrollPos] = d, f.funcMovePause(), f.paused = !0
                    })
                } else this.o.pauseButton && (this.$btnPause = a(".simply-scroll-btn-pause", this.$container).bind("click", function(b) {
                    b.preventDefault(), g() ? a(this).addClass("active") : a(this).removeClass("active")
                }));
                this.funcMoveForward()
            } else this.$btnBack.addClass("simply-scroll-btn " + this.moveBackClass).bind(this.events.start, this.funcMoveBack).bind(this.events.end, this.funcMoveStop), this.$btnForward.addClass("simply-scroll-btn " + this.moveForwardClass).bind(this.events.start, this.funcMoveForward).bind(this.events.end, this.funcMoveStop), "end" == this.o.manualMode && (this.isRTL ? this.$btnForward.addClass("disabled") : this.$btnBack.addClass("disabled"))
        },
        moveForward: function() {
            var a = this;
			
            this.movement = "forward", null !== this.trigger && this.$btnBack.removeClass("disabled"), a.interval = setInterval(function() {
				//console.log(a.$clip[0]["scroll" + a.scrollPos]);
				 
				 var obj = $(a.$clip[0]);
				 var transformMatrix = obj.css("-webkit-transform") ||
				   obj.css("-moz-transform")    ||
				   obj.css("-ms-transform")     ||
				   obj.css("-o-transform")      ||
				   obj.css("transform");
				 var matrix = transformMatrix.replace(/[^0-9\-.,]/g, '').split(',');
				 var x = parseInt(matrix[12] || matrix[4]);
				 var y = parseInt(matrix[13] || matrix[5]);
				 $t = "translateY";
				 if(a.scrollPos!="Top"){
					 y = x;
					 $t = "translateX";
					 
				 }
				if(isNaN(y)){
					y = 1;
				}	
				
				
				ny = (y<0)?y*-1:y;
				$w = "100%";
				if(a.scrollPos!="Top"){
					
					$w = "calc(100% + "+((y-a.o.speed)*-1)+"px)";
					
				}
				
				ny < a.posMax - a.clipMax ? $(a.$clip[0]).css({transform:$t+"("+parseInt(y-a.o.speed)+"px","width":$w}) : a.isLoop ? a.resetPos() : a.moveStop(a.movement)
				//return;
            }, a.intervalDelay)
        },
        moveBack: function() {
            var a = this;
            this.movement = "back", null !== this.trigger && this.$btnForward.removeClass("disabled"), a.interval = setInterval(function() {
				
				 var obj = $(a.$clip[0]);
				 var transformMatrix = obj.css("-webkit-transform") ||
				   obj.css("-moz-transform")    ||
				   obj.css("-ms-transform")     ||
				   obj.css("-o-transform")      ||
				   obj.css("transform");
				 var matrix = transformMatrix.replace(/[^0-9\-.,]/g, '').split(',');
				 var x = parseInt(matrix[12] || matrix[4]);
				 var y = parseInt(matrix[13] || matrix[5]);
				 $t = "translateY";
				 if(a.scrollPos!="Top"){
					 y = x;
					 $t = "translateX";
				 }
				if(isNaN(y)){
					y = 1;
				}			
				ny = (y<0)?y*-1:y;
				
				
                ny > a.posMin ? $(a.$clip[0]).css({transform:$t+"("+parseInt(y+a.o.speed)+"px"}) : a.isLoop ? a.resetPos() : a.moveStop(a.movement)
            }, a.intervalDelay)
        },
        movePause: function() {
            clearInterval(this.interval)
        },
        moveStop: function(b) {
            this.movePause(), null !== this.trigger && (void 0 !== b && a(this.trigger).addClass("disabled"), this.trigger = null), this.isAuto && "bounce" == this.o.autoMode && ("forward" == b ? this.moveBack() : this.moveForward())
        },
        moveResume: function() {
            "forward" == this.movement ? this.moveForward() : this.moveBack()
        },
        resetPos: function() {
            $(this.$clip[0]).css({transform:"translateY(0px"})
        }
    })
}(jQuery, window);