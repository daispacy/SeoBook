// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
/*! http://mths.be/placeholder v2.0.8 by @mathias */
;(function(window, document, $) {

    var isOperaMini = Object.prototype.toString.call(window.operamini) == '[object OperaMini]';
    var isInputSupported = 'placeholder' in document.createElement('input') && !isOperaMini;
    var isTextareaSupported = 'placeholder' in document.createElement('textarea') && !isOperaMini;
    var prototype = $.fn;
    var valHooks = $.valHooks;
    var propHooks = $.propHooks;
    var hooks;
    var placeholder;

    if (isInputSupported && isTextareaSupported) {

        placeholder = prototype.placeholder = function() {
            return this;
        };

        placeholder.input = placeholder.textarea = true;

    } else {

        placeholder = prototype.placeholder = function() {
            var $this = this;
            $this
                .filter((isInputSupported ? 'textarea' : ':input') + '[placeholder]')
                .not('.placeholder')
                .bind({
                    'focus.placeholder': clearPlaceholder,
                    'blur.placeholder': setPlaceholder
                })
                .data('placeholder-enabled', true)
                .trigger('blur.placeholder');
            return $this;
        };

        placeholder.input = isInputSupported;
        placeholder.textarea = isTextareaSupported;

        hooks = {
            'get': function(element) {
                var $element = $(element);

                var $passwordInput = $element.data('placeholder-password');
                if ($passwordInput) {
                    return $passwordInput[0].value;
                }

                return $element.data('placeholder-enabled') && $element.hasClass('placeholder') ? '' : element.value;
            },
            'set': function(element, value) {
                var $element = $(element);

                var $passwordInput = $element.data('placeholder-password');
                if ($passwordInput) {
                    return $passwordInput[0].value = value;
                }

                if (!$element.data('placeholder-enabled')) {
                    return element.value = value;
                }
                if (value == '') {
                    element.value = value;
                    // Issue #56: Setting the placeholder causes problems if the element continues to have focus.
                    if (element != safeActiveElement()) {
                        // We can't use `triggerHandler` here because of dummy text/password inputs :(
                        setPlaceholder.call(element);
                    }
                } else if ($element.hasClass('placeholder')) {
                    clearPlaceholder.call(element, true, value) || (element.value = value);
                } else {
                    element.value = value;
                }
                // `set` can not return `undefined`; see http://jsapi.info/jquery/1.7.1/val#L2363
                return $element;
            }
        };

        if (!isInputSupported) {
            valHooks.input = hooks;
            propHooks.value = hooks;
        }
        if (!isTextareaSupported) {
            valHooks.textarea = hooks;
            propHooks.value = hooks;
        }

        $(function() {
            // Look for forms
            $(document).delegate('form', 'submit.placeholder', function() {
                // Clear the placeholder values so they don't get submitted
                var $inputs = $('.placeholder', this).each(clearPlaceholder);
                setTimeout(function() {
                    $inputs.each(setPlaceholder);
                }, 10);
            });
        });

        // Clear placeholder values upon page reload
        $(window).bind('beforeunload.placeholder', function() {
            $('.placeholder').each(function() {
                this.value = '';
            });
        });

    }

    function args(elem) {
        // Return an object of element attributes
        var newAttrs = {};
        var rinlinejQuery = /^jQuery\d+$/;
        $.each(elem.attributes, function(i, attr) {
            if (attr.specified && !rinlinejQuery.test(attr.name)) {
                newAttrs[attr.name] = attr.value;
            }
        });
        return newAttrs;
    }

    function clearPlaceholder(event, value) {
        var input = this;
        var $input = $(input);
        if (input.value == $input.attr('placeholder') && $input.hasClass('placeholder')) {
            if ($input.data('placeholder-password')) {
                $input = $input.hide().next().show().attr('id', $input.removeAttr('id').data('placeholder-id'));
                // If `clearPlaceholder` was called from `$.valHooks.input.set`
                if (event === true) {
                    return $input[0].value = value;
                }
                $input.focus();
            } else {
                input.value = '';
                $input.removeClass('placeholder');
                input == safeActiveElement() && input.select();
            }
        }
    }

    function setPlaceholder() {
        var $replacement;
        var input = this;
        var $input = $(input);
        var id = this.id;
        if (input.value == '') {
            if (input.type == 'password') {
                if (!$input.data('placeholder-textinput')) {
                    try {
                        $replacement = $input.clone().attr({ 'type': 'text' });
                    } catch(e) {
                        $replacement = $('<input>').attr($.extend(args(this), { 'type': 'text' }));
                    }
                    $replacement
                        .removeAttr('name')
                        .data({
                            'placeholder-password': $input,
                            'placeholder-id': id
                        })
                        .bind('focus.placeholder', clearPlaceholder);
                    $input
                        .data({
                            'placeholder-textinput': $replacement,
                            'placeholder-id': id
                        })
                        .before($replacement);
                }
                $input = $input.removeAttr('id').hide().prev().attr('id', id).show();
                // Note: `$input[0] != input` now!
            }
            $input.addClass('placeholder');
            $input[0].value = $input.attr('placeholder');
        } else {
            $input.removeClass('placeholder');
        }
    }

    function safeActiveElement() {
        // Avoid IE9 `document.activeElement` of death
        // https://github.com/mathiasbynens/jquery-placeholder/pull/99
        try {
            return document.activeElement;
        } catch (err) {}
    }

}(this, document, jQuery));
/*jquery.mousewheel.js
/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *  
 * Version: 3.1.9
 *
 * Requires: jQuery 1.2.2+
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.9',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
        },

        getLineHeight: function(elem) {
            return parseInt($(elem)['offsetParent' in $.fn ? 'offsetParent' : 'parent']().css('fontSize'), 10);
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));


/*!
 * jScrollPane - v2.0.19 - 2013-11-16
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2013 Kelvin Luck
 * Dual licensed under the MIT or GPL licenses.
 */

// Script: jScrollPane - cross browser customisable scrollbars
//
// *Version: 2.0.19, Last updated: 2013-11-16*
//
// Project Home - http://jscrollpane.kelvinluck.com/
// GitHub       - http://github.com/vitch/jScrollPane
// Source       - http://github.com/vitch/jScrollPane/raw/master/script/jquery.jscrollpane.js
// (Minified)   - http://github.com/vitch/jScrollPane/raw/master/script/jquery.jscrollpane.min.js
//
// About: License
//
// Copyright (c) 2013 Kelvin Luck
// Dual licensed under the MIT or GPL Version 2 licenses.
// http://jscrollpane.kelvinluck.com/MIT-LICENSE.txt
// http://jscrollpane.kelvinluck.com/GPL-LICENSE.txt
//
// About: Examples
//
// All examples and demos are available through the jScrollPane example site at:
// http://jscrollpane.kelvinluck.com/
//
// About: Support and Testing
//
// This plugin is tested on the browsers below and has been found to work reliably on them. If you run
// into a problem on one of the supported browsers then please visit the support section on the jScrollPane
// website (http://jscrollpane.kelvinluck.com/) for more information on getting support. You are also
// welcome to fork the project on GitHub if you can contribute a fix for a given issue. 
//
// jQuery Versions - tested in 1.4.2+ - reported to work in 1.3.x
// Browsers Tested - Firefox 3.6.8, Safari 5, Opera 10.6, Chrome 5.0, IE 6, 7, 8
//
// About: Release History
//
// 2.0.19 - (2013-11-16) Changes for more reliable scroll amount with latest mousewheel plugin (thanks @brandonaaron)
// 2.0.18 - (2013-10-23) Fix for issue with gutters and scrollToElement (thanks @Dubiy)
// 2.0.17 - (2013-08-17) Working correctly when box-sizing is set to border-box (thanks @pieht)
// 2.0.16 - (2013-07-30) Resetting left position when scroll is removed. Fixes #189
// 2.0.15 - (2013-07-29) Fixed issue with scrollToElement where the destX and destY are undefined.
// 2.0.14 - (2013-05-01) Updated to most recent mouse wheel plugin (see #106) and related changes for sensible scroll speed
// 2.0.13 - (2013-05-01) Switched to semver compatible version name
// 2.0.0beta12 - (2012-09-27) fix for jQuery 1.8+
// 2.0.0beta11 - (2012-05-14)
// 2.0.0beta10 - (2011-04-17) cleaner required size calculation, improved keyboard support, stickToBottom/Left, other small fixes
// 2.0.0beta9 - (2011-01-31) new API methods, bug fixes and correct keyboard support for FF/OSX
// 2.0.0beta8 - (2011-01-29) touchscreen support, improved keyboard support
// 2.0.0beta7 - (2011-01-23) scroll speed consistent (thanks Aivo Paas)
// 2.0.0beta6 - (2010-12-07) scrollToElement horizontal support
// 2.0.0beta5 - (2010-10-18) jQuery 1.4.3 support, various bug fixes
// 2.0.0beta4 - (2010-09-17) clickOnTrack support, bug fixes
// 2.0.0beta3 - (2010-08-27) Horizontal mousewheel, mwheelIntent, keyboard support, bug fixes
// 2.0.0beta2 - (2010-08-21) Bug fixes
// 2.0.0beta1 - (2010-08-17) Rewrite to follow modern best practices and enable horizontal scrolling, initially hidden
//                           elements and dynamically sized elements.
// 1.x - (2006-12-31 - 2010-07-31) Initial version, hosted at googlecode, deprecated

(function (plugin, window) {
    var factory = function($){
        return plugin($, window);
    }
  if ( typeof define === 'function' && define.amd ) {
      // AMD. Register as an anonymous module.
      define(['jquery'], factory);
  } else if (typeof exports === 'object') {
      // Node/CommonJS style for Browserify
      module.exports = factory;
  } else {
      // Browser globals
      factory(jQuery);
  }
}(function($,window,undefined){

    $.fn.jScrollPane = function(settings)
    {
        // JScrollPane "class" - public methods are available through $('selector').data('jsp')
        function JScrollPane(elem, s)
        {
            var settings, jsp = this, pane, paneWidth, paneHeight, container, contentWidth, contentHeight,
                percentInViewH, percentInViewV, isScrollableV, isScrollableH, verticalDrag, dragMaxY,
                verticalDragPosition, horizontalDrag, dragMaxX, horizontalDragPosition,
                verticalBar, verticalTrack, scrollbarWidth, verticalTrackHeight, verticalDragHeight, arrowUp, arrowDown,
                horizontalBar, horizontalTrack, horizontalTrackWidth, horizontalDragWidth, arrowLeft, arrowRight,
                reinitialiseInterval, originalPadding, originalPaddingTotalWidth, previousContentWidth,
                wasAtTop = true, wasAtLeft = true, wasAtBottom = false, wasAtRight = false,
                originalElement = elem.clone(false, false).empty(),
                mwEvent = $.fn.mwheelIntent ? 'mwheelIntent.jsp' : 'mousewheel.jsp';

            if (elem.css('box-sizing') === 'border-box') {
                originalPadding = 0;
                originalPaddingTotalWidth = 0;
            } else {
                originalPadding = elem.css('paddingTop') + ' ' +
                                    elem.css('paddingRight') + ' ' +
                                    elem.css('paddingBottom') + ' ' +
                                    elem.css('paddingLeft');    
                originalPaddingTotalWidth = (parseInt(elem.css('paddingLeft'), 10) || 0) +
                                            (parseInt(elem.css('paddingRight'), 10) || 0);
            }

            function initialise(s)
            {

                var /*firstChild, lastChild, */isMaintainingPositon, lastContentX, lastContentY,
                        hasContainingSpaceChanged, originalScrollTop, originalScrollLeft,
                        maintainAtBottom = false, maintainAtRight = false;

                settings = s;

                if (pane === undefined) {
                    originalScrollTop = elem.scrollTop();
                    originalScrollLeft = elem.scrollLeft();

                    elem.css(
                        {
                            overflow: 'hidden',
                            padding: 0
                        }
                    );
                    // TODO: Deal with where width/ height is 0 as it probably means the element is hidden and we should
                    // come back to it later and check once it is unhidden...
                    paneWidth = elem.innerWidth() + originalPaddingTotalWidth;
                    paneHeight = elem.innerHeight();
                    paneHeight = parseInt(elem.css('max-height'));
                    elem.width(paneWidth);
                    
                    pane = $('<div class="jspPane" />').css('padding', originalPadding).append(elem.children());
                    container = $('<div class="jspContainer" />')
                        .css({
                            'width': paneWidth + 'px',
                            'height': paneHeight + 'px'
                        }
                    ).append(pane).appendTo(elem);

                    /*
                    // Move any margins from the first and last children up to the container so they can still
                    // collapse with neighbouring elements as they would before jScrollPane 
                    firstChild = pane.find(':first-child');
                    lastChild = pane.find(':last-child');
                    elem.css(
                        {
                            'margin-top': firstChild.css('margin-top'),
                            'margin-bottom': lastChild.css('margin-bottom')
                        }
                    );
                    firstChild.css('margin-top', 0);
                    lastChild.css('margin-bottom', 0);
                    */
                } else {
                    elem.css('width', '');

                    maintainAtBottom = settings.stickToBottom && isCloseToBottom();
                    maintainAtRight  = settings.stickToRight  && isCloseToRight();

                    hasContainingSpaceChanged = elem.innerWidth() + originalPaddingTotalWidth != paneWidth || elem.outerHeight() != paneHeight;

                    if (hasContainingSpaceChanged) {
                        paneWidth = elem.innerWidth() + originalPaddingTotalWidth;
                        paneHeight = elem.innerHeight();
                        container.css({
                            width: paneWidth + 'px',
                            height: paneHeight + 'px'
                        });
                    }

                    // If nothing changed since last check...
                    if (!hasContainingSpaceChanged && previousContentWidth == contentWidth && pane.outerHeight() == contentHeight) {
                        elem.width(paneWidth);
                        return;
                    }
                    previousContentWidth = contentWidth;
                    
                    pane.css('width', '');
                    elem.width(paneWidth);

                    container.find('>.jspVerticalBar,>.jspHorizontalBar').remove().end();
                }

                pane.css('overflow', 'auto');
                if (s.contentWidth) {
                    contentWidth = s.contentWidth;
                } else {
                    contentWidth = pane[0].scrollWidth;
                }
                contentHeight = pane[0].scrollHeight;
                pane.css('overflow', '');

                percentInViewH = contentWidth / paneWidth;
                percentInViewV = contentHeight / paneHeight;
                isScrollableV = percentInViewV > 1;

                isScrollableH = percentInViewH > 1;

                //console.log(paneWidth, paneHeight, contentWidth, contentHeight, percentInViewH, percentInViewV, isScrollableH, isScrollableV);
                if (!(isScrollableH || isScrollableV)) {

                    elem.removeClass('jspScrollable');
                    pane.css({
            top: 0,
            left: 0,
                        width: container.width() - originalPaddingTotalWidth
                    });
                    removeMousewheel();
                    removeFocusHandler();
                    removeKeyboardNav();
                    removeClickOnTrack();
                    

                } else {

                    elem.addClass('jspScrollable');

                    isMaintainingPositon = settings.maintainPosition && (verticalDragPosition || horizontalDragPosition);
                    if (isMaintainingPositon) {
                        lastContentX = contentPositionX();
                        lastContentY = contentPositionY();
                    }

                    initialiseVerticalScroll();
                    initialiseHorizontalScroll();
                    resizeScrollbars();

                    if (isMaintainingPositon) {
                        scrollToX(maintainAtRight  ? (contentWidth  - paneWidth ) : lastContentX, false);
                        scrollToY(maintainAtBottom ? (contentHeight - paneHeight) : lastContentY, false);
                    }

                    initFocusHandler();
                    initMousewheel();
                    initTouch();
                    
                    if (settings.enableKeyboardNavigation) {
                        initKeyboardNav();
                    }
                    if (settings.clickOnTrack) {
                        initClickOnTrack();
                    }
                    
                    observeHash();
                    if (settings.hijackInternalLinks) {
                        hijackInternalLinks();
                    }
                }
                if(!isScrollableV) {
                    container.find('>.jspVerticalBar,>.jspHorizontalBar').hide();
                    container.css('height', pane.height());
                } else {
                    container.find('>.jspVerticalBar,>.jspHorizontalBar').show();
                }
                if (settings.autoReinitialise && !reinitialiseInterval) {
                    reinitialiseInterval = setInterval(
                        function()
                        {
                            initialise(settings);
                        },
                        settings.autoReinitialiseDelay
                    );
                } else if (!settings.autoReinitialise && reinitialiseInterval) {
                    clearInterval(reinitialiseInterval);
                }

                originalScrollTop && elem.scrollTop(0) && scrollToY(originalScrollTop, false);
                originalScrollLeft && elem.scrollLeft(0) && scrollToX(originalScrollLeft, false);

                elem.trigger('jsp-initialised', [isScrollableH || isScrollableV]);
            }

            function initialiseVerticalScroll()
            {
                if (isScrollableV) {

                    container.append(
                        $('<div class="jspVerticalBar" />').append(
                            $('<div class="jspCap jspCapTop" />'),
                            $('<div class="jspTrack" />').append(
                                $('<div class="jspDrag" />').append(
                                    $('<div class="jspDragTop" />'),
                                    $('<div class="jspDragBottom" />')
                                )
                            ),
                            $('<div class="jspCap jspCapBottom" />')
                        )
                    );

                    verticalBar = container.find('>.jspVerticalBar');
                    verticalTrack = verticalBar.find('>.jspTrack');
                    verticalDrag = verticalTrack.find('>.jspDrag');

                    if (settings.showArrows) {
                        arrowUp = $('<a class="jspArrow jspArrowUp" />').bind(
                            'mousedown.jsp', getArrowScroll(0, -1)
                        ).bind('click.jsp', nil);
                        arrowDown = $('<a class="jspArrow jspArrowDown" />').bind(
                            'mousedown.jsp', getArrowScroll(0, 1)
                        ).bind('click.jsp', nil);
                        if (settings.arrowScrollOnHover) {
                            arrowUp.bind('mouseover.jsp', getArrowScroll(0, -1, arrowUp));
                            arrowDown.bind('mouseover.jsp', getArrowScroll(0, 1, arrowDown));
                        }

                        appendArrows(verticalTrack, settings.verticalArrowPositions, arrowUp, arrowDown);
                    }

                    verticalTrackHeight = paneHeight;
                    container.find('>.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow').each(
                        function()
                        {
                            verticalTrackHeight -= $(this).outerHeight();
                        }
                    );


                    verticalDrag.hover(
                        function()
                        {
                            verticalDrag.addClass('jspHover');
                        },
                        function()
                        {
                            verticalDrag.removeClass('jspHover');
                        }
                    ).bind(
                        'mousedown.jsp',
                        function(e)
                        {
                            // Stop IE from allowing text selection
                            $('html').bind('dragstart.jsp selectstart.jsp', nil);

                            verticalDrag.addClass('jspActive');

                            var startY = e.pageY - verticalDrag.position().top;

                            $('html').bind(
                                'mousemove.jsp',
                                function(e)
                                {
                                    positionDragY(e.pageY - startY, false);
                                }
                            ).bind('mouseup.jsp mouseleave.jsp', cancelDrag);
                            return false;
                        }
                    );
                    sizeVerticalScrollbar();
                }
            }

            function sizeVerticalScrollbar()
            {
                verticalTrack.height(verticalTrackHeight + 'px');
                verticalDragPosition = 0;
                scrollbarWidth = settings.verticalGutter + verticalTrack.outerWidth();

                // Make the pane thinner to allow for the vertical scrollbar
                pane.width(paneWidth - scrollbarWidth - originalPaddingTotalWidth);

                // Add margin to the left of the pane if scrollbars are on that side (to position
                // the scrollbar on the left or right set it's left or right property in CSS)
                try {
                    if (verticalBar.position().left === 0) {
                        pane.css('margin-left', scrollbarWidth + 'px');
                    }
                } catch (err) {
                }
            }

            function initialiseHorizontalScroll()
            {
                if (isScrollableH) {

                    container.append(
                        $('<div class="jspHorizontalBar" />').append(
                            $('<div class="jspCap jspCapLeft" />'),
                            $('<div class="jspTrack" />').append(
                                $('<div class="jspDrag" />').append(
                                    $('<div class="jspDragLeft" />'),
                                    $('<div class="jspDragRight" />')
                                )
                            ),
                            $('<div class="jspCap jspCapRight" />')
                        )
                    );

                    horizontalBar = container.find('>.jspHorizontalBar');
                    horizontalTrack = horizontalBar.find('>.jspTrack');
                    horizontalDrag = horizontalTrack.find('>.jspDrag');

                    if (settings.showArrows) {
                        arrowLeft = $('<a class="jspArrow jspArrowLeft" />').bind(
                            'mousedown.jsp', getArrowScroll(-1, 0)
                        ).bind('click.jsp', nil);
                        arrowRight = $('<a class="jspArrow jspArrowRight" />').bind(
                            'mousedown.jsp', getArrowScroll(1, 0)
                        ).bind('click.jsp', nil);
                        if (settings.arrowScrollOnHover) {
                            arrowLeft.bind('mouseover.jsp', getArrowScroll(-1, 0, arrowLeft));
                            arrowRight.bind('mouseover.jsp', getArrowScroll(1, 0, arrowRight));
                        }
                        appendArrows(horizontalTrack, settings.horizontalArrowPositions, arrowLeft, arrowRight);
                    }

                    horizontalDrag.hover(
                        function()
                        {
                            horizontalDrag.addClass('jspHover');
                        },
                        function()
                        {
                            horizontalDrag.removeClass('jspHover');
                        }
                    ).bind(
                        'mousedown.jsp',
                        function(e)
                        {
                            // Stop IE from allowing text selection
                            $('html').bind('dragstart.jsp selectstart.jsp', nil);

                            horizontalDrag.addClass('jspActive');

                            var startX = e.pageX - horizontalDrag.position().left;

                            $('html').bind(
                                'mousemove.jsp',
                                function(e)
                                {
                                    positionDragX(e.pageX - startX, false);
                                }
                            ).bind('mouseup.jsp mouseleave.jsp', cancelDrag);
                            return false;
                        }
                    );
                    horizontalTrackWidth = container.innerWidth();
                    sizeHorizontalScrollbar();
                }
            }

            function sizeHorizontalScrollbar()
            {
                container.find('>.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow').each(
                    function()
                    {
                        horizontalTrackWidth -= $(this).outerWidth();
                    }
                );

                horizontalTrack.width(horizontalTrackWidth + 'px');
                horizontalDragPosition = 0;
            }

            function resizeScrollbars()
            {
                if (isScrollableH && isScrollableV) {
                    var horizontalTrackHeight = horizontalTrack.outerHeight(),
                        verticalTrackWidth = verticalTrack.outerWidth();
                    verticalTrackHeight -= horizontalTrackHeight;
                    $(horizontalBar).find('>.jspCap:visible,>.jspArrow').each(
                        function()
                        {
                            horizontalTrackWidth += $(this).outerWidth();
                        }
                    );
                    horizontalTrackWidth -= verticalTrackWidth;
                    paneHeight -= verticalTrackWidth;
                    paneWidth -= horizontalTrackHeight;
                    horizontalTrack.parent().append(
                        $('<div class="jspCorner" />').css('width', horizontalTrackHeight + 'px')
                    );
                    sizeVerticalScrollbar();
                    sizeHorizontalScrollbar();
                }
                // reflow content
                if (isScrollableH) {
                    pane.width((container.outerWidth() - originalPaddingTotalWidth) + 'px');
                }
                contentHeight = pane.outerHeight();
                percentInViewV = contentHeight / paneHeight;

                if (isScrollableH) {
                    horizontalDragWidth = Math.ceil(1 / percentInViewH * horizontalTrackWidth);
                    if (horizontalDragWidth > settings.horizontalDragMaxWidth) {
                        horizontalDragWidth = settings.horizontalDragMaxWidth;
                    } else if (horizontalDragWidth < settings.horizontalDragMinWidth) {
                        horizontalDragWidth = settings.horizontalDragMinWidth;
                    }
                    horizontalDrag.width(horizontalDragWidth + 'px');
                    dragMaxX = horizontalTrackWidth - horizontalDragWidth;
                    _positionDragX(horizontalDragPosition); // To update the state for the arrow buttons
                }
                if (isScrollableV) {
                    verticalDragHeight = Math.ceil(1 / percentInViewV * verticalTrackHeight);
                    if (verticalDragHeight > settings.verticalDragMaxHeight) {
                        verticalDragHeight = settings.verticalDragMaxHeight;
                    } else if (verticalDragHeight < settings.verticalDragMinHeight) {
                        verticalDragHeight = settings.verticalDragMinHeight;
                    }
                    verticalDrag.height(verticalDragHeight + 'px');
                    dragMaxY = verticalTrackHeight - verticalDragHeight;
                    _positionDragY(verticalDragPosition); // To update the state for the arrow buttons
                }
            }

            function appendArrows(ele, p, a1, a2)
            {
                var p1 = "before", p2 = "after", aTemp;
                
                // Sniff for mac... Is there a better way to determine whether the arrows would naturally appear
                // at the top or the bottom of the bar?
                if (p == "os") {
                    p = /Mac/.test(navigator.platform) ? "after" : "split";
                }
                if (p == p1) {
                    p2 = p;
                } else if (p == p2) {
                    p1 = p;
                    aTemp = a1;
                    a1 = a2;
                    a2 = aTemp;
                }

                ele[p1](a1)[p2](a2);
            }

            function getArrowScroll(dirX, dirY, ele)
            {
                return function()
                {
                    arrowScroll(dirX, dirY, this, ele);
                    this.blur();
                    return false;
                };
            }

            function arrowScroll(dirX, dirY, arrow, ele)
            {
                arrow = $(arrow).addClass('jspActive');

                var eve,
                    scrollTimeout,
                    isFirst = true,
                    doScroll = function()
                    {
                        if (dirX !== 0) {
                            jsp.scrollByX(dirX * settings.arrowButtonSpeed);
                        }
                        if (dirY !== 0) {
                            jsp.scrollByY(dirY * settings.arrowButtonSpeed);
                        }
                        scrollTimeout = setTimeout(doScroll, isFirst ? settings.initialDelay : settings.arrowRepeatFreq);
                        isFirst = false;
                    };

                doScroll();

                eve = ele ? 'mouseout.jsp' : 'mouseup.jsp';
                ele = ele || $('html');
                ele.bind(
                    eve,
                    function()
                    {
                        arrow.removeClass('jspActive');
                        scrollTimeout && clearTimeout(scrollTimeout);
                        scrollTimeout = null;
                        ele.unbind(eve);
                    }
                );
            }

            function initClickOnTrack()
            {
                removeClickOnTrack();
                if (isScrollableV) {
                    verticalTrack.bind(
                        'mousedown.jsp',
                        function(e)
                        {
                            if (e.originalTarget === undefined || e.originalTarget == e.currentTarget) {
                                var clickedTrack = $(this),
                                    offset = clickedTrack.offset(),
                                    direction = e.pageY - offset.top - verticalDragPosition,
                                    scrollTimeout,
                                    isFirst = true,
                                    doScroll = function()
                                    {
                                        var offset = clickedTrack.offset(),
                                            pos = e.pageY - offset.top - verticalDragHeight / 2,
                                            contentDragY = paneHeight * settings.scrollPagePercent,
                                            dragY = dragMaxY * contentDragY / (contentHeight - paneHeight);
                                        if (direction < 0) {
                                            if (verticalDragPosition - dragY > pos) {
                                                jsp.scrollByY(-contentDragY);
                                            } else {
                                                positionDragY(pos);
                                            }
                                        } else if (direction > 0) {
                                            if (verticalDragPosition + dragY < pos) {
                                                jsp.scrollByY(contentDragY);
                                            } else {
                                                positionDragY(pos);
                                            }
                                        } else {
                                            cancelClick();
                                            return;
                                        }
                                        scrollTimeout = setTimeout(doScroll, isFirst ? settings.initialDelay : settings.trackClickRepeatFreq);
                                        isFirst = false;
                                    },
                                    cancelClick = function()
                                    {
                                        scrollTimeout && clearTimeout(scrollTimeout);
                                        scrollTimeout = null;
                                        $(document).unbind('mouseup.jsp', cancelClick);
                                    };
                                doScroll();
                                $(document).bind('mouseup.jsp', cancelClick);
                                return false;
                            }
                        }
                    );
                }
                
                if (isScrollableH) {
                    horizontalTrack.bind(
                        'mousedown.jsp',
                        function(e)
                        {
                            if (e.originalTarget === undefined || e.originalTarget == e.currentTarget) {
                                var clickedTrack = $(this),
                                    offset = clickedTrack.offset(),
                                    direction = e.pageX - offset.left - horizontalDragPosition,
                                    scrollTimeout,
                                    isFirst = true,
                                    doScroll = function()
                                    {
                                        var offset = clickedTrack.offset(),
                                            pos = e.pageX - offset.left - horizontalDragWidth / 2,
                                            contentDragX = paneWidth * settings.scrollPagePercent,
                                            dragX = dragMaxX * contentDragX / (contentWidth - paneWidth);
                                        if (direction < 0) {
                                            if (horizontalDragPosition - dragX > pos) {
                                                jsp.scrollByX(-contentDragX);
                                            } else {
                                                positionDragX(pos);
                                            }
                                        } else if (direction > 0) {
                                            if (horizontalDragPosition + dragX < pos) {
                                                jsp.scrollByX(contentDragX);
                                            } else {
                                                positionDragX(pos);
                                            }
                                        } else {
                                            cancelClick();
                                            return;
                                        }
                                        scrollTimeout = setTimeout(doScroll, isFirst ? settings.initialDelay : settings.trackClickRepeatFreq);
                                        isFirst = false;
                                    },
                                    cancelClick = function()
                                    {
                                        scrollTimeout && clearTimeout(scrollTimeout);
                                        scrollTimeout = null;
                                        $(document).unbind('mouseup.jsp', cancelClick);
                                    };
                                doScroll();
                                $(document).bind('mouseup.jsp', cancelClick);
                                return false;
                            }
                        }
                    );
                }
            }

            function removeClickOnTrack()
            {
                if (horizontalTrack) {
                    horizontalTrack.unbind('mousedown.jsp');
                }
                if (verticalTrack) {
                    verticalTrack.unbind('mousedown.jsp');
                }
            }

            function cancelDrag()
            {
                $('html').unbind('dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp');

                if (verticalDrag) {
                    verticalDrag.removeClass('jspActive');
                }
                if (horizontalDrag) {
                    horizontalDrag.removeClass('jspActive');
                }
            }

            function positionDragY(destY, animate)
            {
                if (!isScrollableV) {
                    return;
                }
                if (destY < 0) {
                    destY = 0;
                } else if (destY > dragMaxY) {
                    destY = dragMaxY;
                }

                // can't just check if(animate) because false is a valid value that could be passed in...
                if (animate === undefined) {
                    animate = settings.animateScroll;
                }
                if (animate) {
                    jsp.animate(verticalDrag, 'top', destY, _positionDragY);
                } else {
                    verticalDrag.css('top', destY);
                    _positionDragY(destY);
                }

            }

            function _positionDragY(destY)
            {
                if (destY === undefined) {
                    destY = verticalDrag.position().top;
                }

                container.scrollTop(0);
                verticalDragPosition = destY;

                var isAtTop = verticalDragPosition === 0,
                    isAtBottom = verticalDragPosition == dragMaxY,
                    percentScrolled = destY/ dragMaxY,
                    destTop = -percentScrolled * (contentHeight - paneHeight);

                if (wasAtTop != isAtTop || wasAtBottom != isAtBottom) {
                    wasAtTop = isAtTop;
                    wasAtBottom = isAtBottom;
                    elem.trigger('jsp-arrow-change', [wasAtTop, wasAtBottom, wasAtLeft, wasAtRight]);
                }
                
                updateVerticalArrows(isAtTop, isAtBottom);
                pane.css('top', destTop);
                elem.trigger('jsp-scroll-y', [-destTop, isAtTop, isAtBottom]).trigger('scroll');
            }

            function positionDragX(destX, animate)
            {
                if (!isScrollableH) {
                    return;
                }
                if (destX < 0) {
                    destX = 0;
                } else if (destX > dragMaxX) {
                    destX = dragMaxX;
                }

                if (animate === undefined) {
                    animate = settings.animateScroll;
                }
                if (animate) {
                    jsp.animate(horizontalDrag, 'left', destX,  _positionDragX);
                } else {
                    horizontalDrag.css('left', destX);
                    _positionDragX(destX);
                }
            }

            function _positionDragX(destX)
            {
                if (destX === undefined) {
                    destX = horizontalDrag.position().left;
                }

                container.scrollTop(0);
                horizontalDragPosition = destX;

                var isAtLeft = horizontalDragPosition === 0,
                    isAtRight = horizontalDragPosition == dragMaxX,
                    percentScrolled = destX / dragMaxX,
                    destLeft = -percentScrolled * (contentWidth - paneWidth);

                if (wasAtLeft != isAtLeft || wasAtRight != isAtRight) {
                    wasAtLeft = isAtLeft;
                    wasAtRight = isAtRight;
                    elem.trigger('jsp-arrow-change', [wasAtTop, wasAtBottom, wasAtLeft, wasAtRight]);
                }
                
                updateHorizontalArrows(isAtLeft, isAtRight);
                pane.css('left', destLeft);
                elem.trigger('jsp-scroll-x', [-destLeft, isAtLeft, isAtRight]).trigger('scroll');
            }

            function updateVerticalArrows(isAtTop, isAtBottom)
            {
                if (settings.showArrows) {
                    arrowUp[isAtTop ? 'addClass' : 'removeClass']('jspDisabled');
                    arrowDown[isAtBottom ? 'addClass' : 'removeClass']('jspDisabled');
                }
            }

            function updateHorizontalArrows(isAtLeft, isAtRight)
            {
                if (settings.showArrows) {
                    arrowLeft[isAtLeft ? 'addClass' : 'removeClass']('jspDisabled');
                    arrowRight[isAtRight ? 'addClass' : 'removeClass']('jspDisabled');
                }
            }

            function scrollToY(destY, animate)
            {
                var percentScrolled = destY / (contentHeight - paneHeight);
                positionDragY(percentScrolled * dragMaxY, animate);
            }

            function scrollToX(destX, animate)
            {
                var percentScrolled = destX / (contentWidth - paneWidth);
                positionDragX(percentScrolled * dragMaxX, animate);
            }

            function scrollToElement(ele, stickToTop, animate)
            {
                var e, eleHeight, eleWidth, eleTop = 0, eleLeft = 0, viewportTop, viewportLeft, maxVisibleEleTop, maxVisibleEleLeft, destY, destX;

                // Legal hash values aren't necessarily legal jQuery selectors so we need to catch any
                // errors from the lookup...
                try {
                    e = $(ele);
                } catch (err) {
                    return;
                }
                eleHeight = e.outerHeight();
                eleWidth= e.outerWidth();

                container.scrollTop(0);
                container.scrollLeft(0);
                
                // loop through parents adding the offset top of any elements that are relatively positioned between
                // the focused element and the jspPane so we can get the true distance from the top
                // of the focused element to the top of the scrollpane...
                while (!e.is('.jspPane')) {
                    eleTop += e.position().top;
                    eleLeft += e.position().left;
                    e = e.offsetParent();
                    if (/^body|html$/i.test(e[0].nodeName)) {
                        // we ended up too high in the document structure. Quit!
                        return;
                    }
                }

                viewportTop = contentPositionY();
                maxVisibleEleTop = viewportTop + paneHeight;
                if (eleTop < viewportTop || stickToTop) { // element is above viewport
                    destY = eleTop - settings.horizontalGutter;
                } else if (eleTop + eleHeight > maxVisibleEleTop) { // element is below viewport
                    destY = eleTop - paneHeight + eleHeight + settings.horizontalGutter;
                }
                if (!isNaN(destY)) {
                    scrollToY(destY, animate);
                }
                
                viewportLeft = contentPositionX();
                maxVisibleEleLeft = viewportLeft + paneWidth;
                if (eleLeft < viewportLeft || stickToTop) { // element is to the left of viewport
                    destX = eleLeft - settings.horizontalGutter;
                } else if (eleLeft + eleWidth > maxVisibleEleLeft) { // element is to the right viewport
                    destX = eleLeft - paneWidth + eleWidth + settings.horizontalGutter;
                }
                if (!isNaN(destX)) {
                    scrollToX(destX, animate);
                }

            }

            function contentPositionX()
            {
                return -pane.position().left;
            }

            function contentPositionY()
            {
                return -pane.position().top;
            }

            function isCloseToBottom()
            {
                var scrollableHeight = contentHeight - paneHeight;
                return (scrollableHeight > 20) && (scrollableHeight - contentPositionY() < 10);
            }

            function isCloseToRight()
            {
                var scrollableWidth = contentWidth - paneWidth;
                return (scrollableWidth > 20) && (scrollableWidth - contentPositionX() < 10);
            }

            function initMousewheel()
            {
                container.unbind(mwEvent).bind(
                    mwEvent,
                    function (event, delta, deltaX, deltaY) {
                        var dX = horizontalDragPosition, dY = verticalDragPosition, factor = event.deltaFactor || settings.mouseWheelSpeed;
                        jsp.scrollBy(deltaX * factor, -deltaY * factor, false);
                        // return true if there was no movement so rest of screen can scroll
                        return dX == horizontalDragPosition && dY == verticalDragPosition;
                    }
                );
            }

            function removeMousewheel()
            {
                container.unbind(mwEvent);
            }

            function nil()
            {
                return false;
            }

            function initFocusHandler()
            {
                pane.find(':input,a').unbind('focus.jsp').bind(
                    'focus.jsp',
                    function(e)
                    {
                        scrollToElement(e.target, false);
                    }
                );
            }

            function removeFocusHandler()
            {
                pane.find(':input,a').unbind('focus.jsp');
            }
            
            function initKeyboardNav()
            {
                var keyDown, elementHasScrolled, validParents = [];
                isScrollableH && validParents.push(horizontalBar[0]);
                isScrollableV && validParents.push(verticalBar[0]);
                
                // IE also focuses elements that don't have tabindex set.
                pane.focus(
                    function()
                    {
                        elem.focus();
                    }
                );
                
                elem.attr('tabindex', 0)
                    .unbind('keydown.jsp keypress.jsp')
                    .bind(
                        'keydown.jsp',
                        function(e)
                        {
                            if (e.target !== this && !(validParents.length && $(e.target).closest(validParents).length)){
                                return;
                            }
                            var dX = horizontalDragPosition, dY = verticalDragPosition;
                            switch(e.keyCode) {
                                case 40: // down
                                case 38: // up
                                case 34: // page down
                                case 32: // space
                                case 33: // page up
                                case 39: // right
                                case 37: // left
                                    keyDown = e.keyCode;
                                    keyDownHandler();
                                    break;
                                case 35: // end
                                    scrollToY(contentHeight - paneHeight);
                                    keyDown = null;
                                    break;
                                case 36: // home
                                    scrollToY(0);
                                    keyDown = null;
                                    break;
                            }

                            elementHasScrolled = e.keyCode == keyDown && dX != horizontalDragPosition || dY != verticalDragPosition;
                            return !elementHasScrolled;
                        }
                    ).bind(
                        'keypress.jsp', // For FF/ OSX so that we can cancel the repeat key presses if the JSP scrolls...
                        function(e)
                        {
                            if (e.keyCode == keyDown) {
                                keyDownHandler();
                            }
                            return !elementHasScrolled;
                        }
                    );
                
                if (settings.hideFocus) {
                    elem.css('outline', 'none');
                    if ('hideFocus' in container[0]){
                        elem.attr('hideFocus', true);
                    }
                } else {
                    elem.css('outline', '');
                    if ('hideFocus' in container[0]){
                        elem.attr('hideFocus', false);
                    }
                }
                
                function keyDownHandler()
                {
                    var dX = horizontalDragPosition, dY = verticalDragPosition;
                    switch(keyDown) {
                        case 40: // down
                            jsp.scrollByY(settings.keyboardSpeed, false);
                            break;
                        case 38: // up
                            jsp.scrollByY(-settings.keyboardSpeed, false);
                            break;
                        case 34: // page down
                        case 32: // space
                            jsp.scrollByY(paneHeight * settings.scrollPagePercent, false);
                            break;
                        case 33: // page up
                            jsp.scrollByY(-paneHeight * settings.scrollPagePercent, false);
                            break;
                        case 39: // right
                            jsp.scrollByX(settings.keyboardSpeed, false);
                            break;
                        case 37: // left
                            jsp.scrollByX(-settings.keyboardSpeed, false);
                            break;
                    }

                    elementHasScrolled = dX != horizontalDragPosition || dY != verticalDragPosition;
                    return elementHasScrolled;
                }
            }
            
            function removeKeyboardNav()
            {
                elem.attr('tabindex', '-1')
                    .removeAttr('tabindex')
                    .unbind('keydown.jsp keypress.jsp');
            }

            function observeHash()
            {
                if (location.hash && location.hash.length > 1) {
                    var e,
                        retryInt,
                        hash = escape(location.hash.substr(1)) // hash must be escaped to prevent XSS
                        ;
                    try {
                        e = $('#' + hash + ', a[name="' + hash + '"]');
                    } catch (err) {
                        return;
                    }

                    if (e.length && pane.find(hash)) {
                        // nasty workaround but it appears to take a little while before the hash has done its thing
                        // to the rendered page so we just wait until the container's scrollTop has been messed up.
                        if (container.scrollTop() === 0) {
                            retryInt = setInterval(
                                function()
                                {
                                    if (container.scrollTop() > 0) {
                                        scrollToElement(e, true);
                                        $(document).scrollTop(container.position().top);
                                        clearInterval(retryInt);
                                    }
                                },
                                50
                            );
                        } else {
                            scrollToElement(e, true);
                            $(document).scrollTop(container.position().top);
                        }
                    }
                }
            }

            function hijackInternalLinks()
            {
                // only register the link handler once
                if ($(document.body).data('jspHijack')) {
                    return;
                }

                // remember that the handler was bound
                $(document.body).data('jspHijack', true);

                // use live handler to also capture newly created links
                $(document.body).delegate('a[href*=#]', 'click', function(event) {
                    // does the link point to the same page?
                    // this also takes care of cases with a <base>-Tag or Links not starting with the hash #
                    // e.g. <a href="index.html#test"> when the current url already is index.html
                    var href = this.href.substr(0, this.href.indexOf('#')),
                        locationHref = location.href,
                        hash,
                        element,
                        container,
                        jsp,
                        scrollTop,
                        elementTop;
                    if (location.href.indexOf('#') !== -1) {
                        locationHref = location.href.substr(0, location.href.indexOf('#'));
                    }
                    if (href !== locationHref) {
                        // the link points to another page
                        return;
                    }

                    // check if jScrollPane should handle this click event
                    hash = escape(this.href.substr(this.href.indexOf('#') + 1));

                    // find the element on the page
                    element;
                    try {
                        element = $('#' + hash + ', a[name="' + hash + '"]');
                    } catch (e) {
                        // hash is not a valid jQuery identifier
                        return;
                    }

                    if (!element.length) {
                        // this link does not point to an element on this page
                        return;
                    }

                    container = element.closest('.jspScrollable');
                    jsp = container.data('jsp');

                    // jsp might be another jsp instance than the one, that bound this event
                    // remember: this event is only bound once for all instances.
                    jsp.scrollToElement(element, true);

                    if (container[0].scrollIntoView) {
                        // also scroll to the top of the container (if it is not visible)
                        scrollTop = $(window).scrollTop();
                        elementTop = element.offset().top;
                        if (elementTop < scrollTop || elementTop > scrollTop + $(window).height()) {
                            container[0].scrollIntoView();
                        }
                    }

                    // jsp handled this event, prevent the browser default (scrolling :P)
                    event.preventDefault();
                });
            }
            
            // Init touch on iPad, iPhone, iPod, Android
            function initTouch()
            {
                var startX,
                    startY,
                    touchStartX,
                    touchStartY,
                    moved,
                    moving = false;
  
                container.unbind('touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick').bind(
                    'touchstart.jsp',
                    function(e)
                    {
                        var touch = e.originalEvent.touches[0];
                        startX = contentPositionX();
                        startY = contentPositionY();
                        touchStartX = touch.pageX;
                        touchStartY = touch.pageY;
                        moved = false;
                        moving = true;
                    }
                ).bind(
                    'touchmove.jsp',
                    function(ev)
                    {
                        if(!moving) {
                            return;
                        }
                        
                        var touchPos = ev.originalEvent.touches[0],
                            dX = horizontalDragPosition, dY = verticalDragPosition;
                        
                        jsp.scrollTo(startX + touchStartX - touchPos.pageX, startY + touchStartY - touchPos.pageY);
                        
                        moved = moved || Math.abs(touchStartX - touchPos.pageX) > 5 || Math.abs(touchStartY - touchPos.pageY) > 5;
                        
                        // return true if there was no movement so rest of screen can scroll
                        return dX == horizontalDragPosition && dY == verticalDragPosition;
                    }
                ).bind(
                    'touchend.jsp',
                    function(e)
                    {
                        moving = false;
                        /*if(moved) {
                            return false;
                        }*/
                    }
                ).bind(
                    'click.jsp-touchclick',
                    function(e)
                    {
                        if(moved) {
                            moved = false;
                            return false;
                        }
                    }
                );
            }
            
            function destroy(){
                var currentY = contentPositionY(),
                    currentX = contentPositionX();
                elem.removeClass('jspScrollable').unbind('.jsp');
                elem.replaceWith(originalElement.append(pane.children()));
                originalElement.scrollTop(currentY);
                originalElement.scrollLeft(currentX);

                // clear reinitialize timer if active
                if (reinitialiseInterval) {
                    clearInterval(reinitialiseInterval);
                }
            }

            // Public API
            $.extend(
                jsp,
                {
                    // Reinitialises the scroll pane (if it's internal dimensions have changed since the last time it
                    // was initialised). The settings object which is passed in will override any settings from the
                    // previous time it was initialised - if you don't pass any settings then the ones from the previous
                    // initialisation will be used.
                    reinitialise: function(s)
                    {
                        s = $.extend({}, settings, s);
                        initialise(s);
                    },
                    // Scrolls the specified element (a jQuery object, DOM node or jQuery selector string) into view so
                    // that it can be seen within the viewport. If stickToTop is true then the element will appear at
                    // the top of the viewport, if it is false then the viewport will scroll as little as possible to
                    // show the element. You can also specify if you want animation to occur. If you don't provide this
                    // argument then the animateScroll value from the settings object is used instead.
                    scrollToElement: function(ele, stickToTop, animate)
                    {
                        scrollToElement(ele, stickToTop, animate);
                    },
                    // Scrolls the pane so that the specified co-ordinates within the content are at the top left
                    // of the viewport. animate is optional and if not passed then the value of animateScroll from
                    // the settings object this jScrollPane was initialised with is used.
                    scrollTo: function(destX, destY, animate)
                    {
                        scrollToX(destX, animate);
                        scrollToY(destY, animate);
                    },
                    // Scrolls the pane so that the specified co-ordinate within the content is at the left of the
                    // viewport. animate is optional and if not passed then the value of animateScroll from the settings
                    // object this jScrollPane was initialised with is used.
                    scrollToX: function(destX, animate)
                    {
                        scrollToX(destX, animate);
                    },
                    // Scrolls the pane so that the specified co-ordinate within the content is at the top of the
                    // viewport. animate is optional and if not passed then the value of animateScroll from the settings
                    // object this jScrollPane was initialised with is used.
                    scrollToY: function(destY, animate)
                    {
                        scrollToY(destY, animate);
                    },
                    // Scrolls the pane to the specified percentage of its maximum horizontal scroll position. animate
                    // is optional and if not passed then the value of animateScroll from the settings object this
                    // jScrollPane was initialised with is used.
                    scrollToPercentX: function(destPercentX, animate)
                    {
                        scrollToX(destPercentX * (contentWidth - paneWidth), animate);
                    },
                    // Scrolls the pane to the specified percentage of its maximum vertical scroll position. animate
                    // is optional and if not passed then the value of animateScroll from the settings object this
                    // jScrollPane was initialised with is used.
                    scrollToPercentY: function(destPercentY, animate)
                    {
                        scrollToY(destPercentY * (contentHeight - paneHeight), animate);
                    },
                    // Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then
                    // the value of animateScroll from the settings object this jScrollPane was initialised with is used.
                    scrollBy: function(deltaX, deltaY, animate)
                    {
                        jsp.scrollByX(deltaX, animate);
                        jsp.scrollByY(deltaY, animate);
                    },
                    // Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then
                    // the value of animateScroll from the settings object this jScrollPane was initialised with is used.
                    scrollByX: function(deltaX, animate)
                    {
                        var destX = contentPositionX() + Math[deltaX<0 ? 'floor' : 'ceil'](deltaX),
                            percentScrolled = destX / (contentWidth - paneWidth);
                        positionDragX(percentScrolled * dragMaxX, animate);
                    },
                    // Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then
                    // the value of animateScroll from the settings object this jScrollPane was initialised with is used.
                    scrollByY: function(deltaY, animate)
                    {
                        var destY = contentPositionY() + Math[deltaY<0 ? 'floor' : 'ceil'](deltaY),
                            percentScrolled = destY / (contentHeight - paneHeight);
                        positionDragY(percentScrolled * dragMaxY, animate);
                    },
                    // Positions the horizontal drag at the specified x position (and updates the viewport to reflect
                    // this). animate is optional and if not passed then the value of animateScroll from the settings
                    // object this jScrollPane was initialised with is used.
                    positionDragX: function(x, animate)
                    {
                        positionDragX(x, animate);
                    },
                    // Positions the vertical drag at the specified y position (and updates the viewport to reflect
                    // this). animate is optional and if not passed then the value of animateScroll from the settings
                    // object this jScrollPane was initialised with is used.
                    positionDragY: function(y, animate)
                    {
                        positionDragY(y, animate);
                    },
                    // This method is called when jScrollPane is trying to animate to a new position. You can override
                    // it if you want to provide advanced animation functionality. It is passed the following arguments:
                    //  * ele          - the element whose position is being animated
                    //  * prop         - the property that is being animated
                    //  * value        - the value it's being animated to
                    //  * stepCallback - a function that you must execute each time you update the value of the property
                    // You can use the default implementation (below) as a starting point for your own implementation.
                    animate: function(ele, prop, value, stepCallback)
                    {
                        var params = {};
                        params[prop] = value;
                        ele.animate(
                            params,
                            {
                                'duration'  : settings.animateDuration,
                                'easing'    : settings.animateEase,
                                'queue'     : false,
                                'step'      : stepCallback
                            }
                        );
                    },
                    // Returns the current x position of the viewport with regards to the content pane.
                    getContentPositionX: function()
                    {
                        return contentPositionX();
                    },
                    // Returns the current y position of the viewport with regards to the content pane.
                    getContentPositionY: function()
                    {
                        return contentPositionY();
                    },
                    // Returns the width of the content within the scroll pane.
                    getContentWidth: function()
                    {
                        return contentWidth;
                    },
                    // Returns the height of the content within the scroll pane.
                    getContentHeight: function()
                    {
                        return contentHeight;
                    },
                    // Returns the horizontal position of the viewport within the pane content.
                    getPercentScrolledX: function()
                    {
                        return contentPositionX() / (contentWidth - paneWidth);
                    },
                    // Returns the vertical position of the viewport within the pane content.
                    getPercentScrolledY: function()
                    {
                        return contentPositionY() / (contentHeight - paneHeight);
                    },
                    // Returns whether or not this scrollpane has a horizontal scrollbar.
                    getIsScrollableH: function()
                    {
                        return isScrollableH;
                    },
                    // Returns whether or not this scrollpane has a vertical scrollbar.
                    getIsScrollableV: function()
                    {
                        return isScrollableV;
                    },
                    // Gets a reference to the content pane. It is important that you use this method if you want to
                    // edit the content of your jScrollPane as if you access the element directly then you may have some
                    // problems (as your original element has had additional elements for the scrollbars etc added into
                    // it).
                    getContentPane: function()
                    {
                        return pane;
                    },
                    // Scrolls this jScrollPane down as far as it can currently scroll. If animate isn't passed then the
                    // animateScroll value from settings is used instead.
                    scrollToBottom: function(animate)
                    {
                        positionDragY(dragMaxY, animate);
                    },
                    // Hijacks the links on the page which link to content inside the scrollpane. If you have changed
                    // the content of your page (e.g. via AJAX) and want to make sure any new anchor links to the
                    // contents of your scroll pane will work then call this function.
                    hijackInternalLinks: $.noop,
                    // Removes the jScrollPane and returns the page to the state it was in before jScrollPane was
                    // initialised.
                    destroy: function()
                    {
                            destroy();
                    }
                }
            );
            
            initialise(s);
        }

        // Pluginifying code...
        settings = $.extend({}, $.fn.jScrollPane.defaults, settings);
        
        // Apply default speed
        $.each(['arrowButtonSpeed', 'trackClickSpeed', 'keyboardSpeed'], function() {
            settings[this] = settings[this] || settings.speed;
        });

        return this.each(
            function()
            {
                var elem = $(this), jspApi = elem.data('jsp');
                if (jspApi) {
                    jspApi.reinitialise(settings);
                } else {
                    $("script",elem).filter('[type="text/javascript"],:not([type])').remove();
                    jspApi = new JScrollPane(elem, settings);
                    elem.data('jsp', jspApi);
                }
            }
        );
    };

    $.fn.jScrollPane.defaults = {
        showArrows                  : false,
        maintainPosition            : true,
        stickToBottom               : false,
        stickToRight                : false,
        clickOnTrack                : true,
        autoReinitialise            : false,
        autoReinitialiseDelay       : 500,
        verticalDragMinHeight       : 0,
        verticalDragMaxHeight       : 99999,
        horizontalDragMinWidth      : 0,
        horizontalDragMaxWidth      : 99999,
        contentWidth                : undefined,
        animateScroll               : false,
        animateDuration             : 300,
        animateEase                 : 'linear',
        hijackInternalLinks         : false,
        verticalGutter              : 4,
        horizontalGutter            : 4,
        mouseWheelSpeed             : 3,
        arrowButtonSpeed            : 0,
        arrowRepeatFreq             : 50,
        arrowScrollOnHover          : false,
        trackClickSpeed             : 0,
        trackClickRepeatFreq        : 70,
        verticalArrowPositions      : 'split',
        horizontalArrowPositions    : 'split',
        enableKeyboardNavigation    : true,
        hideFocus                   : false,
        keyboardSpeed               : 0,
        initialDelay                : 300,        // Delay before starting repeating
        speed                       : 30,       // Default speed when others falsey
        scrollPagePercent           : .8        // Percent of visible area scrolled when pageUp/Down or track area pressed
    };

},this));
/*
 * jQuery Nivo Slider v3.2
 * http://nivo.dev7studios.com
 *
 * Copyright 2012, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

(function(e){var t=function(t,n){var r=e.extend({},e.fn.nivoSlider.defaults,n);var i={currentSlide:0,currentImage:"",totalSlides:0,running:false,paused:false,stop:false,controlNavEl:false};var s=e(t);s.data("nivo:vars",i).addClass("nivoSlider");var o=s.children();o.each(function(){var t=e(this);var n="";if(!t.is("img")){if(t.is("a")){t.addClass("nivo-imageLink");n=t}t=t.find("img:first")}var r=r===0?t.attr("width"):t.width(),s=s===0?t.attr("height"):t.height();if(n!==""){n.css("display","none")}t.css("display","none");i.totalSlides++});if(r.randomStart){r.startSlide=Math.floor(Math.random()*i.totalSlides)}if(r.startSlide>0){if(r.startSlide>=i.totalSlides){r.startSlide=i.totalSlides-1}i.currentSlide=r.startSlide}if(e(o[i.currentSlide]).is("img")){i.currentImage=e(o[i.currentSlide])}else{i.currentImage=e(o[i.currentSlide]).find("img:first")}if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}var u=e("<img/>").addClass("nivo-main-image");u.attr("src",i.currentImage.attr("src")).show();s.append(u);e(window).resize(function(){s.children("img").width(s.width());u.attr("src",i.currentImage.attr("src"));u.stop().height("auto");e(".nivo-slice").remove();e(".nivo-box").remove()});s.append(e('<div class="nivo-caption"></div>'));var a=function(t){var n=e(".nivo-caption",s);if(i.currentImage.attr("title")!=""&&i.currentImage.attr("title")!=undefined){var r=i.currentImage.attr("title");if(r.substr(0,1)=="#")r=e(r).html();if(n.css("display")=="block"){setTimeout(function(){n.html(r)},t.animSpeed)}else{n.html(r);n.stop().fadeIn(t.animSpeed)}}else{n.stop().fadeOut(t.animSpeed)}};a(r);var f=0;if(!r.manualAdvance&&o.length>1){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}if(r.directionNav){s.append('<div class="nivo-directionNav"><a class="nivo-prevNav">'+r.prevText+'</a><a class="nivo-nextNav">'+r.nextText+"</a></div>");e(s).on("click","a.nivo-prevNav",function(){if(i.running){return false}clearInterval(f);f="";i.currentSlide-=2;d(s,o,r,"prev")});e(s).on("click","a.nivo-nextNav",function(){if(i.running){return false}clearInterval(f);f="";d(s,o,r,"next")})}if(r.controlNav){i.controlNavEl=e('<div class="nivo-controlNav"></div>');s.after(i.controlNavEl);for(var l=0;l<o.length;l++){if(r.controlNavThumbs){i.controlNavEl.addClass("nivo-thumbs-enabled");var c=o.eq(l);if(!c.is("img")){c=c.find("img:first")}if(c.attr("data-thumb"))i.controlNavEl.append('<a class="nivo-control" rel="'+l+'"><img src="'+c.attr("data-thumb")+'" alt="" /></a>')}else{i.controlNavEl.append('<a class="nivo-control" rel="'+l+'">'+(l+1)+"</a>")}}e("a:eq("+i.currentSlide+")",i.controlNavEl).addClass("active");e("a",i.controlNavEl).bind("click",function(){if(i.running)return false;if(e(this).hasClass("active"))return false;clearInterval(f);f="";u.attr("src",i.currentImage.attr("src"));i.currentSlide=e(this).attr("rel")-1;d(s,o,r,"control")})}if(r.pauseOnHover){s.hover(function(){i.paused=true;clearInterval(f);f=""},function(){i.paused=false;if(f===""&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}})}s.bind("nivo:animFinished",function(){u.attr("src",i.currentImage.attr("src"));i.running=false;e(o).each(function(){if(e(this).is("a")){e(this).css("display","none")}});if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}if(f===""&&!i.paused&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}r.afterChange.call(this)});var h=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().is("a")?e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().height():e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height();for(var s=0;s<n.slices;s++){var o=Math.round(t.width()/n.slices);if(s===n.slices-1){t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:t.width()-o*s+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}else{t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:o+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}}e(".nivo-slice",t).height(i);u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var p=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=Math.round(t.width()/n.boxCols),s=Math.round(e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height()/n.boxRows);for(var o=0;o<n.boxRows;o++){for(var a=0;a<n.boxCols;a++){if(a===n.boxCols-1){t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:t.width()-i*a+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}else{t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:i+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}}}u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var d=function(t,n,r,i){var s=t.data("nivo:vars");if(s&&s.currentSlide===s.totalSlides-1){r.lastSlide.call(this)}if((!s||s.stop)&&!i){return false}r.beforeChange.call(this);if(!i){u.attr("src",s.currentImage.attr("src"))}else{if(i==="prev"){u.attr("src",s.currentImage.attr("src"))}if(i==="next"){u.attr("src",s.currentImage.attr("src"))}}s.currentSlide++;if(s.currentSlide===s.totalSlides){s.currentSlide=0;r.slideshowEnd.call(this)}if(s.currentSlide<0){s.currentSlide=s.totalSlides-1}if(e(n[s.currentSlide]).is("img")){s.currentImage=e(n[s.currentSlide])}else{s.currentImage=e(n[s.currentSlide]).find("img:first")}if(r.controlNav){e("a",s.controlNavEl).removeClass("active");e("a:eq("+s.currentSlide+")",s.controlNavEl).addClass("active")}a(r);e(".nivo-slice",t).remove();e(".nivo-box",t).remove();var o=r.effect,f="";if(r.effect==="random"){f=new Array("sliceDownRight","sliceDownLeft","sliceUpRight","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");o=f[Math.floor(Math.random()*(f.length+1))];if(o===undefined){o="fade"}}if(r.effect.indexOf(",")!==-1){f=r.effect.split(",");o=f[Math.floor(Math.random()*f.length)];if(o===undefined){o="fade"}}if(s.currentImage.attr("data-transition")){o=s.currentImage.attr("data-transition")}s.running=true;var l=0,c=0,d="",m="",g="",y="";if(o==="sliceDown"||o==="sliceDownRight"||o==="sliceDownLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({top:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUp"||o==="sliceUpRight"||o==="sliceUpLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceUpLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({bottom:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUpDown"||o==="sliceUpDownRight"||o==="sliceUpDownLeft"){h(t,r,s);l=0;c=0;var b=0;d=e(".nivo-slice",t);if(o==="sliceUpDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);if(c===0){n.css("top","0px");c++}else{n.css("bottom","0px");c=0}if(b===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;b++})}else if(o==="fold"){h(t,r,s);l=0;c=0;e(".nivo-slice",t).each(function(){var n=e(this);var i=n.width();n.css({top:"0px",width:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="fade"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:t.width()+"px"});m.animate({opacity:"1.0"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInRight"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInLeft"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1",left:"",right:"0px"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){m.css({left:"0px",right:""});t.trigger("nivo:animFinished")})}else if(o==="boxRandom"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;y=v(e(".nivo-box",t));y.each(function(){var n=e(this);if(c===g-1){setTimeout(function(){n.animate({opacity:"1"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1"},r.animSpeed)},100+l)}l+=20;c++})}else if(o==="boxRain"||o==="boxRainReverse"||o==="boxRainGrow"||o==="boxRainGrowReverse"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;var w=0;var E=0;var S=[];S[w]=[];y=e(".nivo-box",t);if(o==="boxRainReverse"||o==="boxRainGrowReverse"){y=e(".nivo-box",t)._reverse()}y.each(function(){S[w][E]=e(this);E++;if(E===r.boxCols){w++;E=0;S[w]=[]}});for(var x=0;x<r.boxCols*2;x++){var T=x;for(var N=0;N<r.boxRows;N++){if(T>=0&&T<r.boxCols){(function(n,i,s,u,a){var f=e(S[n][i]);var l=f.width();var c=f.height();if(o==="boxRainGrow"||o==="boxRainGrowReverse"){f.width(0).height(0)}if(u===a-1){setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3,"",function(){t.trigger("nivo:animFinished")})},100+s)}else{setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3)},100+s)}})(N,T,l,c,g);c++}T--}l+=100}}};var v=function(e){for(var t,n,r=e.length;r;t=parseInt(Math.random()*r,10),n=e[--r],e[r]=e[t],e[t]=n);return e};var m=function(e){if(this.console&&typeof console.log!=="undefined"){console.log(e)}};this.stop=function(){if(!e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=true;m("Stop Slider")}};this.start=function(){if(e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=false;m("Start Slider")}};r.afterLoad.call(this);return this};e.fn.nivoSlider=function(n){return this.each(function(r,i){var s=e(this);if(s.data("nivoslider")){return s.data("nivoslider")}var o=new t(this,n);s.data("nivoslider",o)})};e.fn.nivoSlider.defaults={effect:"random",slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3e3,startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,manualAdvance:false,prevText:"Prev",nextText:"Next",randomStart:false,beforeChange:function(){},afterChange:function(){},slideshowEnd:function(){},lastSlide:function(){},afterLoad:function(){}};e.fn._reverse=[].reverse})(jQuery);

/*
* vertical news ticker
* Tadas Juozapaitis ( kasp3rito [eta] gmail (dot) com )
* http://www.jugbit.com/jquery-vticker-vertical-news-ticker/
*/
(function(e){e.fn.vTicker=function(t){var n={speed:700,pause:4e3,showItems:3,animation:"",mousePause:true,isPaused:false,direction:"up",height:0};var t=e.extend(n,t);moveUp=function(t,n,r){if(r.isPaused)return;var i=t.children("ul");var s=i.children("li:first").clone(true);if(r.height>0){n=i.children("li:first").height()}i.animate({top:"-="+n+"px"},r.speed,function(){e(this).children("li:first").remove();e(this).css("top","0px")});if(r.animation=="fade"){i.children("li:first").fadeOut(r.speed);if(r.height==0){i.children("li:eq("+r.showItems+")").hide().fadeIn(r.speed).show()}}s.appendTo(i)};moveDown=function(t,n,r){if(r.isPaused)return;var i=t.children("ul");var s=i.children("li:last").clone(true);if(r.height>0){n=i.children("li:first").height()}i.css("top","-"+n+"px").prepend(s);i.animate({top:0},r.speed,function(){e(this).children("li:last").remove()});if(r.animation=="fade"){if(r.height==0){i.children("li:eq("+r.showItems+")").fadeOut(r.speed)}i.children("li:first").hide().fadeIn(r.speed).show()}};return this.each(function(){var n=e(this);var r=0;n.css({overflow:"hidden",position:"relative"}).children("ul").css({position:"absolute",margin:0,padding:0}).children("li").css({margin:0,padding:0});if(t.height==0){n.children("ul").children("li").each(function(){if(e(this).height()>r){r=e(this).height()}});n.children("ul").children("li").each(function(){e(this).height(r)});n.height(r*t.showItems)}else{n.height(t.height)}var i=setInterval(function(){if(t.direction=="up"){moveUp(n,r,t)}else{moveDown(n,r,t)}},t.pause);if(t.mousePause){n.bind("mouseenter",function(){t.isPaused=true}).bind("mouseleave",function(){t.isPaused=false})}})}})(jQuery);

/*!
    Slimbox v2.04 - The ultimate lightweight Lightbox clone for jQuery
    (c) 2007-2010 Christophe Beyls <http://www.digitalia.be>
    MIT-style license.
*/

(function($) {

    // Global variables, accessible to Slimbox only
    var win = $(window), options, images, activeImage = -1, activeURL, prevImage, nextImage, compatibleOverlay, middle, centerWidth, centerHeight,
        ie6 = !window.XMLHttpRequest, hiddenElements = [], documentElement = document.documentElement,

    // Preload images
    preload = {}, preloadPrev = new Image(), preloadNext = new Image(),

    // DOM elements
    overlay, center, image, sizer, prevLink, nextLink, bottomContainer, bottom, caption, number;

    /*
        Initialization
    */

    $(function() {
        // Append the Slimbox HTML code at the bottom of the document
        $("body").append(
            $([
                overlay = $('<div id="lbOverlay" />')[0],
                center = $('<div id="lbCenter" />')[0],
                bottomContainer = $('<div id="lbBottomContainer" />')[0]
            ]).css("display", "none")
        );

        image = $('<div id="lbImage" />').appendTo(center).append(
            sizer = $('<div style="position: relative;" />').append([
                prevLink = $('<a id="lbPrevLink" href="#" />').click(previous)[0],
                nextLink = $('<a id="lbNextLink" href="#" />').click(next)[0]
            ])[0]
        )[0];

        bottom = $('<div id="lbBottom" />').appendTo(bottomContainer).append([
            $('<a id="lbCloseLink" href="#" />').click(close)[0],
            caption = $('<div id="lbCaption" />')[0],
            number = $('<div id="lbNumber" />')[0],
            $('<div style="clear: both;" />')[0]
        ])[0];

        $('#lbOverlay').bind('click', function(){
            close();
        });
    });


    /*
        API
    */

    // Open Slimbox with the specified parameters
    $.slimbox = function(_images, startImage, _options) {
        options = $.extend({
            loop: false,                // Allows to navigate between first and last images
            overlayOpacity: 0.8,            // 1 is opaque, 0 is completely transparent (change the color in the CSS file)
            overlayFadeDuration: 400,       // Duration of the overlay fade-in and fade-out animations (in milliseconds)
            resizeDuration: 400,            // Duration of each of the box resize animations (in milliseconds)
            resizeEasing: "swing",          // "swing" is jQuery's default easing
            initialWidth: 250,          // Initial width of the box (in pixels)
            initialHeight: 250,         // Initial height of the box (in pixels)
            imageFadeDuration: 400,         // Duration of the image fade-in animation (in milliseconds)
            captionAnimationDuration: 400,      // Duration of the caption animation (in milliseconds)
            counterText: "Image {x} of {y}",    // Translate or change as you wish, or set it to false to disable counter text for image groups
            closeKeys: [27, 88, 67],        // Array of keycodes to close Slimbox, default: Esc (27), 'x' (88), 'c' (67)
            previousKeys: [37, 80],         // Array of keycodes to navigate to the previous image, default: Left arrow (37), 'p' (80)
            nextKeys: [39, 78]          // Array of keycodes to navigate to the next image, default: Right arrow (39), 'n' (78)
        }, _options);

        // The function is called for a single image, with URL and Title as first two arguments
        if (typeof _images == "string") {
            _images = [[_images, startImage]];
            startImage = 0;
        }

        middle = win.scrollTop() + (win.height() / 2);
        centerWidth = options.initialWidth;
        centerHeight = options.initialHeight;
        $(center).css({top: Math.max(0, middle - (centerHeight / 2)), width: centerWidth, height: centerHeight, marginLeft: -centerWidth/2}).show();
        compatibleOverlay = ie6 || (overlay.currentStyle && (overlay.currentStyle.position != "fixed"));
        if (compatibleOverlay) overlay.style.position = "absolute";
        $(overlay).css("opacity", options.overlayOpacity).fadeIn(options.overlayFadeDuration);
        position();
        setup(1);

        images = _images;
        options.loop = options.loop && (images.length > 1);
        return changeImage(startImage);
    };

    /*
        options:    Optional options object, see jQuery.slimbox()
        linkMapper: Optional function taking a link DOM element and an index as arguments and returning an array containing 2 elements:
                the image URL and the image caption (may contain HTML)
        linksFilter:    Optional function taking a link DOM element and an index as arguments and returning true if the element is part of
                the image collection that will be shown on click, false if not. "this" refers to the element that was clicked.
                This function must always return true when the DOM element argument is "this".
    */
    $.fn.slimbox = function(_options, linkMapper, linksFilter) {
        linkMapper = linkMapper || function(el) {
            return [el.href, el.title];
        };

        linksFilter = linksFilter || function() {
            return true;
        };

        var links = this;

        return links.unbind("click").click(function() {
            // Build the list of images that will be displayed
            var link = this, startIndex = 0, filteredLinks, i = 0, length;
            filteredLinks = $.grep(links, function(el, i) {
                return linksFilter.call(link, el, i);
            });

            // We cannot use jQuery.map() because it flattens the returned array
            for (length = filteredLinks.length; i < length; ++i) {
                if (filteredLinks[i] == link) startIndex = i;
                filteredLinks[i] = linkMapper(filteredLinks[i], i);
            }

            return $.slimbox(filteredLinks, startIndex, _options);
        });
    };


    /*
        Internal functions
    */

    function position() {
        var l = win.scrollLeft(), w = win.width();
        $([center, bottomContainer]).css("left", l + (w / 2));
        if (compatibleOverlay) $(overlay).css({left: l, top: win.scrollTop(), width: w, height: win.height()});
    }

    function setup(open) {
        if (open) {
            $("object").add(ie6 ? "select" : "embed").each(function(index, el) {
                hiddenElements[index] = [el, el.style.visibility];
                el.style.visibility = "hidden";
            });
        } else {
            $.each(hiddenElements, function(index, el) {
                el[0].style.visibility = el[1];
            });
            hiddenElements = [];
        }
        var fn = open ? "bind" : "unbind";
        win[fn]("scroll resize", position);
        $(document)[fn]("keydown", keyDown);
    }

    function keyDown(event) {
        var code = event.keyCode, fn = $.inArray;
        // Prevent default keyboard action (like navigating inside the page)
        return (fn(code, options.closeKeys) >= 0) ? close()
            : (fn(code, options.nextKeys) >= 0) ? next()
            : (fn(code, options.previousKeys) >= 0) ? previous()
            : false;
    }

    function previous() {
        return changeImage(prevImage);
    }

    function next() {
        return changeImage(nextImage);
    }

    function changeImage(imageIndex) {
        if (imageIndex >= 0) {
            activeImage = imageIndex;
            activeURL = images[activeImage][0];
            prevImage = (activeImage || (options.loop ? images.length : 0)) - 1;
            nextImage = ((activeImage + 1) % images.length) || (options.loop ? 0 : -1);

            stop();
            center.className = "lbLoading";

            preload = new Image();
            preload.onload = animateBox;
            preload.src = activeURL;
        }

        return false;
    }

    function animateBox() {
        center.className = "";
        $(image).css({backgroundImage: "url(" + activeURL + ")", visibility: "hidden", display: ""});
        $(sizer).width(preload.width);
        $([sizer, prevLink, nextLink]).height(preload.height);

        $(caption).html(images[activeImage][1] || "");
        $(number).html((((images.length > 1) && options.counterText) || "").replace(/{x}/, activeImage + 1).replace(/{y}/, images.length));

        if (prevImage >= 0) preloadPrev.src = images[prevImage][0];
        if (nextImage >= 0) preloadNext.src = images[nextImage][0];

        centerWidth = image.offsetWidth;
        centerHeight = image.offsetHeight;
        var top = Math.max(0, middle - (centerHeight / 2));
        if (center.offsetHeight != centerHeight) {
            $(center).animate({height: centerHeight, top: top}, options.resizeDuration, options.resizeEasing);
        }
        if (center.offsetWidth != centerWidth) {
            $(center).animate({width: centerWidth, marginLeft: -centerWidth/2}, options.resizeDuration, options.resizeEasing);
        }
        $(center).queue(function() {
            $(bottomContainer).css({width: centerWidth, top: top + centerHeight, marginLeft: -centerWidth/2, visibility: "hidden", display: ""});
            $(image).css({display: "none", visibility: "", opacity: ""}).fadeIn(options.imageFadeDuration, animateCaption);
        });
    }

    function animateCaption() {
        if (prevImage >= 0) $(prevLink).show();
        if (nextImage >= 0) $(nextLink).show();
        $(bottom).css("marginTop", -bottom.offsetHeight).animate({marginTop: 0}, options.captionAnimationDuration);
        bottomContainer.style.visibility = "";
    }

    function stop() {
        preload.onload = null;
        preload.src = preloadPrev.src = preloadNext.src = activeURL;
        $([center, image, bottom]).stop(true);
        $([prevLink, nextLink, image, bottomContainer]).hide();
    }

    function close() {
        if (activeImage >= 0) {
            stop();
            activeImage = prevImage = nextImage = -1;
            $(center).hide();
            $(overlay).stop().fadeOut(options.overlayFadeDuration, setup);
        }

        return false;
    }

})(jQuery);
function zvertgallerysync(gal, info){
    var jelm = $j(gal);
    
    if(!jelm.length){
        return;
    }
    
    var jdispimg = jelm.find(info.dispimg),
        jthumbwarp = jelm.find(info.thumbwarp),
        jthumbitems = jthumbwarp.children(),
        jnext = jelm.find(info.next),
        jprev = jelm.find(info.prev);
        
        
    if(jthumbitems.length < 1){
        return;
    }
    
    var visible = 3,
        curitem = 0,
        preitem = 0,
        curview = 0,
        nitem = jthumbitems.length,
        itemheight = jthumbitems.eq(0).outerHeight(true),
        maxview = nitem - visible,
        ndup = Math.round(visible / 2) + 1,
        iidauto = null,
        animend = true;
        
    for(var i = 0; i < nitem; i++){
        if(jthumbitems.eq(i).hasClass('current')){
            curitem = i;
        }
        
        jthumbitems[i]._idx = i;
    };
    
    jthumbitems.removeClass('current');
    
    for(var i = 0; i < ndup; i++){
        jthumbitems.eq(i).clone(true).appendTo(jthumbwarp)[0]._idx = jthumbitems[i]._idx;
        jthumbitems.eq(nitem - i - 1).clone(true).prependTo(jthumbwarp)[0]._idx = jthumbitems[nitem - i - 1]._idx;
    }
    
    jthumbitems.eq(curitem).addClass('current');
    
    jthumbwarp.css({
        height: (nitem + ndup * 2) * itemheight,
        marginTop: -(curitem + ndup) * itemheight
    });
    
    function next(){
        if(!animend){
            return false;
        }
        clearInterval(iidauto);
        
        animend = false;
        
        preitem = curitem;
        curitem++;
        
        jthumbwarp.stop(true).animate({
            marginTop: -(curitem + ndup) * itemheight
        }, function(){
            animend = true;
            
            if(curitem > nitem -1){
                curitem = 0;
                jthumbwarp.css('marginTop', -(curitem + ndup) * itemheight);
            }
        });
        
        var titem = curitem > nitem -1 ? 0 : curitem;
        
        jthumbwarp.children().removeClass('current').filter(function(){
            if(this._idx == titem){
                $j(this).addClass('current');
            }
        });
        
        jdispimg.find('img').stop().fadeTo(700, 0.3, function(){
            $j(this).attr('src', jthumbitems.eq((curitem > nitem -1 ? 0 : curitem)).find('a:first').attr('rel')).fadeTo(500, 1);
        });
        
        autorun(false);
        
        return false;
    };
    
    function prev(){
        if(!animend){
            return false;
        }
        
        clearInterval(iidauto);
        
        animend = false;
        
        preitem = curitem;
        curitem--;
        
        jthumbwarp.stop(true).animate({
            marginTop: -(curitem + ndup) * itemheight
        }, function(){
            animend = true;
            
            if(curitem < 0){
                curitem = nitem -1;
                jthumbwarp.css('marginTop', -(curitem + ndup) * itemheight);
            }
            
            preitem = curitem;
        });
        
        var titem = curitem < 0 ? nitem -1 : curitem;
        
        jthumbwarp.children().removeClass('current').filter(function(){
            if(this._idx == titem){
                $j(this).addClass('current');
            }
        });
        
        jdispimg.find('img').stop().fadeTo(700, 0.3, function(){
            $j(this).attr('src', jthumbitems.eq(curitem < 0 ? nitem -1 : curitem).find('a:first').attr('rel')).fadeTo(500, 1);
        });
        
        autorun(true);
        
        return false;
    };
    //alert(jnext.length);  
    jnext.click(next);
    jprev.click(prev);
    
    function autorun(back){
        clearInterval(iidauto);
        iidauto = setInterval((back? prev : next), info.duration);
    }
    
    autorun(false);
};

var $j = jQuery.noConflict(); // Use jQuery via $j(...)
/////////////////
function zhorzgallerysync(gal, info){
    var jelm = $j(gal);
    
    if(!jelm.length){
        return;
    }
    
    var jdispimg = jelm.find(info.dispimg),
        jthumbwarp = jelm.find(info.thumbwarp),
        jthumbitems = jthumbwarp.children();
    var jnext = jelm.find(info.next),
        jprev = jelm.find(info.prev);       
    
    if(jthumbitems.length < 1){
        return;
    }
    
    var visible = 2,
        curitem = 0,
        curview = 0,
        nitem = jthumbitems.length,
        itemwidth = jthumbitems.eq(0).outerWidth(true),
        maxview = Math.max(0, nitem - visible -1);
        
    jthumbwarp.css('width', nitem * itemwidth);
    
    for(var i = 0; i < nitem; i++){
        if(jthumbitems.eq(i).hasClass('current')){
            curitem = i;
            break;
        }
    };
    
        
    function next(){
        if(curitem >= nitem - 1){
            return false;
        }
        
        jthumbitems.eq(curitem + 1).find('a').triggerHandler('click.zhgs');
        
        return false;
    };
    
    function prev(){
        if(curitem <= 0){
            return false;
        }
        
        jthumbitems.eq(curitem - 1).find('a').triggerHandler('click.zhgs');
        
        return false;
    };
    
    var images = [];
    
    jthumbitems.each(function(idx){
        $j(this).find('a').bind('click.zhgs', function(){
            
            jthumbitems.eq(curitem).removeClass('current');
            curitem = idx;
            jthumbitems.eq(curitem).addClass('current');
            
            curview = Math.min(maxview, Math.max(0, curitem - visible / 2));
            
            jthumbwarp.stop(true).animate({marginLeft: -curview * itemwidth});
            
            jdispimg.find('img').attr('src', jthumbitems.eq(curitem).find('a').attr('href'));
            jdispimg.find('a').attr('href', jthumbitems.eq(curitem).find('a').attr('href'));
            // $('.cloud-zoom').CloudZoom({
            //     zoomWidth: '335',
            //     zoomHeight: '335',
            //     lensOpacity: 1,
            //     adjustX: 20,
            //     adjustY: 10
            // }); 
            return false; 
        });
        
        images.push([$j(this).find('a').attr('href'), $j(this).find('a').attr('title')]);
        
    });
    
    jnext.click(next);
    jprev.click(prev);
    
    jdispimg.click(function(){
        jQuery.slimbox(images, curitem);
        
        return false;
    });
    // $('.cloud-zoom').CloudZoom({
         
    // }); 
    jQuery(jQuery(jthumbitems[0]).find('a')).trigger('click');
}

/*
 * jQuery FlexSlider v2.0
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
  $.flexslider = function(el, options) {
    var slider = $(el),
        vars = $.extend({}, $.flexslider.defaults, options),
        namespace = vars.namespace,
        touch = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        eventType = (touch) ? "touchend" : "click",
        vertical = vars.direction === "vertical",
        reverse = vars.reverse,
        carousel = (vars.itemWidth > 0),
        fade = vars.animation === "fade",
        asNav = vars.asNavFor !== "",
        methods = {};
    
    // Store a reference to the slider object
    $.data(el, "flexslider", slider);
    
    // Privat slider methods
    methods = {
      init: function() {
        slider.animating = false;
        slider.currentSlide = vars.startAt;
        slider.animatingTo = slider.currentSlide;
        slider.atEnd = (slider.currentSlide === 0 || slider.currentSlide === slider.last);
        slider.containerSelector = vars.selector.substr(0,vars.selector.search(' '));
        slider.slides = $(vars.selector, slider);
        slider.container = $(slider.containerSelector, slider);
        slider.count = slider.slides.length;
        // SYNC:
        slider.syncExists = $(vars.sync).length > 0;
        // SLIDE:
        if (vars.animation === "slide") vars.animation = "swing";
        slider.prop = (vertical) ? "top" : "marginLeft";
        slider.args = {};
        // SLIDESHOW:
        slider.manualPause = false;
        // TOUCH/USECSS:
        slider.transitions = !vars.video && !fade && vars.useCSS && (function() {
          var obj = document.createElement('div'),
              props = ['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
          for (var i in props) {
            if ( obj.style[ props[i] ] !== undefined ) {
              slider.pfx = props[i].replace('Perspective','').toLowerCase();
              slider.prop = "-" + slider.pfx + "-transform";
              return true;
            }
          }
          return false;
        }());
        // CONTROLSCONTAINER:
        if (vars.controlsContainer !== "") slider.controlsContainer = $(vars.controlsContainer).length > 0 && $(vars.controlsContainer);
        // MANUAL:
        if (vars.manualControls !== "") slider.manualControls = $(vars.manualControls).length > 0 && $(vars.manualControls);
        
        // RANDOMIZE:
        if (vars.randomize) {
          slider.slides.sort(function() { return (Math.round(Math.random())-0.5); });
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
          $(document).bind('keyup', function(event) {
            var keycode = event.keyCode;
            if (!slider.animating && (keycode === 39 || keycode === 37)) {
              var target = (keycode === 39) ? slider.getTarget('next') :
                           (keycode === 37) ? slider.getTarget('prev') : false;
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
        }
        // MOUSEWHEEL:
        if (vars.mousewheel) {
          slider.bind('mousewheel', function(event, delta, deltaX, deltaY) {
            event.preventDefault();
            var target = (delta < 0) ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
        }
        
        // PAUSEPLAY
        if (vars.pausePlay) methods.pausePlay.setup();
        
        // SLIDSESHOW
        if (vars.slideshow) {
          if (vars.pauseOnHover) {
            slider.hover(function() {
              slider.pause();
            }, function() {
              if (!slider.manualPause) slider.play();
            });
          }
          // initialize animation
          (vars.initDelay > 0) ? setTimeout(slider.play, vars.initDelay) : slider.play();
        }
        
        // TOUCH
        if (touch && vars.touch) methods.touch();
        
        // FADE&&SMOOTHHEIGHT || SLIDE:
        if (!fade || (fade && vars.smoothHeight)) $(window).bind("resize focus", methods.resize);
        
        
        // API: start() Callback
        setTimeout(function(){
          vars.start(slider);
        }, 200);
      },
      asNav: {
        setup: function() {
          slider.asNav = true;
          slider.animatingTo = Math.floor(slider.currentSlide/slider.move);
          slider.currentItem = slider.currentSlide;
          slider.slides.removeClass(namespace + "active-slide").eq(slider.currentItem).addClass(namespace + "active-slide");
          slider.slides.click(function(e){
            e.preventDefault();
            var $slide = $(this),
                target = $slide.index();
            if (!$(vars.asNavFor).data('flexslider').animating && !$slide.hasClass('active')) {
              slider.direction = (slider.currentItem < target) ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction, false, true, true);
            }
          });
        }
      },
      controlNav: {
        setup: function() {
          if (!slider.manualControls) {
            methods.controlNav.setupPaging();
          } else { // MANUALCONTROLS:
            methods.controlNav.setupManual();
          }
        },
        setupPaging: function() {
          var type = (vars.controlNav === "thumbnails") ? 'control-thumbs' : 'control-paging',
              j = 1,
              item;
          
          slider.controlNavScaffold = $('<ol class="'+ namespace + 'control-nav ' + namespace + type + '"></ol>');
          
          if (slider.pagingCount > 1) {
            for (var i = 0; i < slider.pagingCount; i++) {
              item = (vars.controlNav === "thumbnails") ? '<img src="' + slider.slides.eq(i).attr("data-thumb") + '"/>' : '<a>' + j + '</a>';
              slider.controlNavScaffold.append('<li>' + item + '</li>');
              j++;
            }
          }
          
          // CONTROLSCONTAINER:
          (slider.controlsContainer) ? $(slider.controlsContainer).append(slider.controlNavScaffold) : slider.append(slider.controlNavScaffold);
          methods.controlNav.set();
          
          methods.controlNav.active();
        
          slider.controlNavScaffold.delegate('a, img', eventType, function(event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);

            if (!$this.hasClass(namespace + 'active')) {
              slider.direction = (target > slider.currentSlide) ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNavScaffold.delegate('a', "click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        setupManual: function() {
          slider.controlNav = slider.manualControls;
          methods.controlNav.active();
          
          slider.controlNav.live(eventType, function(event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);
                
            if (!$this.hasClass(namespace + 'active')) {
              (target > slider.currentSlide) ? slider.direction = "next" : slider.direction = "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNav.live("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        set: function() {
          var selector = (vars.controlNav === "thumbnails") ? 'img' : 'a';
          slider.controlNav = $('.' + namespace + 'control-nav li ' + selector, (slider.controlsContainer) ? slider.controlsContainer : slider);
        },
        active: function() {
          slider.controlNav.removeClass(namespace + "active").eq(slider.animatingTo).addClass(namespace + "active");
        },
        update: function(action, pos) {
          if (slider.pagingCount > 1 && action === "add") {
            slider.controlNavScaffold.append($('<li><a>' + slider.count + '</a></li>'));
          } else if (slider.pagingCount === 1) {
            slider.controlNavScaffold.find('li').remove();
          } else {
            slider.controlNav.eq(pos).closest('li').remove();
          }
          methods.controlNav.set();
          (slider.pagingCount > 1 && slider.pagingCount !== slider.controlNav.length) ? slider.update(pos, action) : methods.controlNav.active();
        }
      },
      directionNav: {
        setup: function() {
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
        
          slider.directionNav.bind(eventType, function(event) {
            event.preventDefault();
            var target = ($(this).hasClass(namespace + 'next')) ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.directionNav.bind("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        update: function() {
          var disabledClass = namespace + 'disabled';
          if (!vars.animationLoop) {
            if (slider.pagingCount === 1) {
             slider.directionNav.addClass(disabledClass);
            } else if (slider.animatingTo === 0) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "prev").addClass(disabledClass);
            } else if (slider.animatingTo === slider.last) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "next").addClass(disabledClass);
            } else {
              slider.directionNav.removeClass(disabledClass);
            }
          }
        }
      },
      pausePlay: {
        setup: function() {
          var pausePlayScaffold = $('<div class="' + namespace + 'pauseplay"><a></a></div>');
        
          // CONTROLSCONTAINER:
          if (slider.controlsContainer) {
            slider.controlsContainer.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider.controlsContainer);
          } else {
            slider.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider);
          }
        
          // slider.pausePlay.addClass(pausePlayState).text((pausePlayState == 'pause') ? vars.pauseText : vars.playText);
          methods.pausePlay.update((vars.slideshow) ? namespace + 'pause' : namespace + 'play');
        
          slider.pausePlay.bind(eventType, function(event) {
            event.preventDefault();
            if ($(this).hasClass(namespace + 'pause')) {
              slider.pause();
              slider.manualPause = true;
            } else {
              slider.play();
              slider.manualPause = false;
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.pausePlay.bind("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        update: function(state) {
          (state === "play") ? slider.pausePlay.removeClass(namespace + 'pause').addClass(namespace + 'play').text(vars.playText) : slider.pausePlay.removeClass(namespace + 'play').addClass(namespace + 'pause').text(vars.pauseText);
        }
      },
      touch: function() {
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
            cwidth = (vertical) ? slider.h : slider. w;
            startT = Number(new Date());
            // CAROUSEL:
            offset = (carousel && reverse && slider.animatingTo === slider.last) ? 0 :
                     (carousel && reverse) ? slider.limit - (((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo) :
                     (carousel && slider.currentSlide === slider.last) ? slider.limit :
                     (carousel) ? ((slider.itemW + vars.itemMargin) * slider.move) * slider.currentSlide : 
                     (reverse) ? (slider.last - slider.currentSlide + slider.cloneOffset) * cwidth : (slider.currentSlide + slider.cloneOffset) * cwidth;
            startX = (vertical) ? e.touches[0].pageY : e.touches[0].pageX;
            startY = (vertical) ? e.touches[0].pageX : e.touches[0].pageY;

            el.addEventListener('touchmove', onTouchMove, false);
            el.addEventListener('touchend', onTouchEnd, false);
          }
        }

        function onTouchMove(e) {
          dx = (vertical) ? startX - e.touches[0].pageY : startX - e.touches[0].pageX;
          scrolling = (vertical) ? (Math.abs(dx) < Math.abs(e.touches[0].pageX - startY)) : (Math.abs(dx) < Math.abs(e.touches[0].pageY - startY));
          
          if (!scrolling || Number(new Date()) - startT > 500) {
            e.preventDefault();
            if (!fade && slider.transitions) {
              if (!vars.animationLoop) {
                dx = dx/((slider.currentSlide === 0 && dx < 0 || slider.currentSlide === slider.last && dx > 0) ? (Math.abs(dx)/cwidth+2) : 1);
              }
              slider.setProps(offset + dx, "setTouch");
            }
          }
        }
        
        function onTouchEnd(e) {
          if (slider.animatingTo === slider.currentSlide && !scrolling && !(dx === null)) {
            var updateDx = (reverse) ? -dx : dx,
                target = (updateDx > 0) ? slider.getTarget('next') : slider.getTarget('prev');
            
            if (slider.canAdvance(target) && (Number(new Date()) - startT < 550 && Math.abs(updateDx) > 20 || Math.abs(updateDx) > cwidth/2)) {
              slider.flexAnimate(target, vars.pauseOnAction);
            } else {
              slider.flexAnimate(slider.currentSlide, vars.pauseOnAction, true);
            }
          }
          // finish the touch by undoing the touch session
          el.removeEventListener('touchmove', onTouchMove, false);
          el.removeEventListener('touchend', onTouchEnd, false);
          startX = null;
          startY = null;
          dx = null;
          offset = null;
        }
      },
      resize: function() {
        if (!slider.animating && slider.is(':visible')) {
          if (!carousel) slider.doMath();
          
          if (fade) {
            // SMOOTH HEIGHT:
            methods.smoothHeight();
          } else if (carousel) { //CAROUSEL:
            slider.slides.width(slider.computedW);
            slider.update(slider.pagingCount);
            slider.setProps();
          }
          else if (vertical) { //VERTICAL:
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
      smoothHeight: function(dur) {
        if (!vertical || fade) {
          var $obj = (fade) ? slider : slider.viewport;
          (dur) ? $obj.animate({"height": slider.slides.eq(slider.animatingTo).height()}, dur) : $obj.height(slider.slides.eq(slider.animatingTo).height());
        }
      },
      sync: function(action) {
        var $obj = $(vars.sync).data("flexslider"),
            target = slider.animatingTo;
        
        switch (action) {
          case "animate": $obj.flexAnimate(target, vars.pauseOnAction, false, true); break;
          case "play": if (!$obj.playing && !$obj.asNav) { $obj.play(); } break;
          case "pause": $obj.pause(); break;
        }
      }
    }
    
    // public methods
    slider.flexAnimate = function(target, pause, override, withSync, fromNav) {
      if (!slider.animating && (slider.canAdvance(target) || override) && slider.is(":visible")) {
        if (asNav && withSync) {
          var master = $(vars.asNavFor).data('flexslider');
          slider.atEnd = target === 0 || target === slider.count - 1;
          master.flexAnimate(target, true, false, true, fromNav);
          slider.direction = (slider.currentItem < target) ? "next" : "prev";
          master.direction = slider.direction;
          
          if (Math.ceil((target + 1)/slider.visible) - 1 !== slider.currentSlide && target !== 0) {
            slider.currentItem = target;
            slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide");
            target = Math.floor(target/slider.visible);
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
          var dimension = (vertical) ? slider.slides.filter(':first').height() : slider.computedW,
              margin, slideString, calcNext;
          
          // INFINITE LOOP / REVERSE:
          if (carousel) {
            margin = (vars.itemWidth > slider.w) ? vars.itemMargin * 2 : vars.itemMargin;
            calcNext = ((slider.itemW + margin) * slider.move) * slider.animatingTo;
            slideString = (calcNext > slider.limit && slider.visible !== 1) ? slider.limit : calcNext;
          } else if (slider.currentSlide === 0 && target === slider.count - 1 && vars.animationLoop && slider.direction !== "next") {
            slideString = (reverse) ? (slider.count + slider.cloneOffset) * dimension : 0;
          } else if (slider.currentSlide === slider.last && target === 0 && vars.animationLoop && slider.direction !== "prev") {
            slideString = (reverse) ? 0 : (slider.count + 1) * dimension;
          } else {
            slideString = (reverse) ? ((slider.count - 1) - target + slider.cloneOffset) * dimension : (target + slider.cloneOffset) * dimension;
          }
          slider.setProps(slideString, "", vars.animationSpeed);
          if (slider.transitions) {
            if (!vars.animationLoop || !slider.atEnd) {
              slider.animating = false;
              slider.currentSlide = slider.animatingTo;
            }
            slider.container.unbind("webkitTransitionEnd transitionend");
            slider.container.bind("webkitTransitionEnd transitionend", function() {
              slider.wrapup(dimension);
            });
          } else {
            slider.container.animate(slider.args, vars.animationSpeed, vars.easing, function(){
              slider.wrapup(dimension);
            });
          }
        } else { // FADE:
          slider.slides.eq(slider.currentSlide).fadeOut(vars.animationSpeed, vars.easing);
          slider.slides.eq(target).fadeIn(vars.animationSpeed, vars.easing, slider.wrapup);
        }
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight(vars.animationSpeed);
      }
    } 
    slider.wrapup = function(dimension) {
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
    }
    
    // SLIDESHOW:
    slider.animateSlides = function() {
      if (!slider.animating) slider.flexAnimate(slider.getTarget("next"));
    }
    // SLIDESHOW:
    slider.pause = function() {
      clearInterval(slider.animatedSlides);
      slider.playing = false;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("play");
      // SYNC:
      if (slider.syncExists) methods.sync("pause");
    }
    // SLIDESHOW:
    slider.play = function() {
      slider.animatedSlides = setInterval(slider.animateSlides, vars.slideshowSpeed);
      slider.playing = true;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("pause");
      // SYNC:
      if (slider.syncExists) methods.sync("play");
    }
    slider.canAdvance = function(target) {
      // ASNAV:
      var last = (asNav) ? slider.pagingCount - 1 : slider.last;
      return (asNav && slider.currentItem === 0 && target === slider.pagingCount - 1 && slider.direction !== "next") ? false :
             (target === slider.currentSlide && !asNav) ? false :
             (vars.animationLoop) ? true :
             (slider.atEnd && slider.currentSlide === 0 && target === last && slider.direction !== "next") ? false :
             (slider.atEnd && slider.currentSlide === last && target === 0 && slider.direction === "next") ? false :
             true;
    }
    slider.getTarget = function(dir) {
      slider.direction = dir; 
      if (dir === "next") {
        return (slider.currentSlide === slider.last) ? 0 : slider.currentSlide + 1;
      } else {
        return (slider.currentSlide === 0) ? slider.last : slider.currentSlide - 1;
      }
    }
    
    // SLIDE:
    slider.setProps = function(pos, special, dur) {
      var target = (function() {
        var posCheck = (pos) ? pos : ((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo,
            posCalc = (function() {
              if (carousel) {
                return (special === "setTouch") ? pos :
                       (reverse && slider.animatingTo === slider.last) ? 0 :
                       (reverse) ? slider.limit - (((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo) :
                       (slider.animatingTo === slider.last) ? slider.limit : posCheck;
              } else {
                switch (special) {
                  case "setTotal": return (reverse) ? ((slider.count - 1) - slider.currentSlide + slider.cloneOffset) * pos : (slider.currentSlide + slider.cloneOffset) * pos;
                  case "setTouch": return (reverse) ? pos : pos;
                  case "jumpEnd": return (reverse) ? pos : slider.count * pos;
                  case "jumpStart": return (reverse) ? slider.count * pos : pos;
                  default: return pos;
                }
              }
            }());
            return (posCalc * -1) + "px";
          }());

      if (slider.transitions) {
        target = (vertical) ? "translate3d(0," + target + ",0)" : "translate3d(" + target + ",0,0)";
        dur = (dur !== undefined) ? (dur/1000) + "s" : "0s";
        slider.container.css("-" + slider.pfx + "-transition-duration", dur);
      }
      
      slider.args[slider.prop] = target;
      if (slider.transitions || dur === undefined) slider.container.css(slider.args);
    }
    
    slider.setup = function(type) {
      // SLIDE:
      if (!fade) {
        var sliderOffset, arr;
            
        if (type === "init") {
          slider.viewport = $('<div class="flex-viewport"></div>').css({"overflow": "hidden", "position": "relative"}).appendTo(slider).append(slider.container);
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
        
        sliderOffset = (reverse) ? slider.count - 1 - slider.currentSlide + slider.cloneOffset : slider.currentSlide + slider.cloneOffset;
        // VERTICAL:
        if (vertical && !carousel) {
          slider.container.height((slider.count + slider.cloneCount) * 200 + "%").css("position", "absolute").width("100%");
          setTimeout(function(){
            slider.newSlides.css({"display": "block"});
            slider.doMath();
            slider.viewport.height(slider.h);
            slider.setProps(sliderOffset * slider.h, "init");
          }, (type === "init") ? 100 : 0);
        } else {
          slider.container.width((slider.count + slider.cloneCount) * 200 + "%");
          slider.setProps(sliderOffset * slider.computedW, "init");
          setTimeout(function(){
            slider.doMath();
            slider.newSlides.css({"width": slider.computedW, "float": "left", "display": "block"});
            // SMOOTH HEIGHT:
            if (vars.smoothHeight) methods.smoothHeight();
          }, (type === "init") ? 100 : 0);
        }
      } else { // FADE: 
        slider.slides.css({"width": "100%", "float": "left", "marginRight": "-100%", "position": "relative"});
        if (type === "init") slider.slides.eq(slider.currentSlide).fadeIn(vars.animationSpeed, vars.easing);
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight();
      }
      // !CAROUSEL:
      // CANDIDATE: active slide
      if (!carousel) slider.slides.removeClass(namespace + "active-slide").eq(slider.currentSlide).addClass(namespace + "active-slide");
    }
    
    slider.doMath = function() {
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
        slider.minW = (minItems) ? minItems * slider.itemT : slider.w;
        slider.maxW = (maxItems) ? maxItems * slider.itemT : slider.w;
        slider.itemW = (slider.minW > slider.w) ? (slider.w - (slideMargin * minItems))/minItems :
                       (slider.maxW < slider.w) ? (slider.w - (slideMargin * maxItems))/maxItems :
                       (vars.itemWidth > slider.w) ? slider.w : vars.itemWidth;
        slider.visible = Math.floor(slider.w/(slider.itemW + slideMargin));
        slider.move = (vars.move > 0 && vars.move < slider.visible ) ? vars.move : slider.visible;
        slider.pagingCount = Math.ceil(((slider.count - slider.visible)/slider.move) + 1);
        slider.last =  slider.pagingCount - 1;
        slider.limit = (slider.pagingCount === 1) ? 0 :
                       (vars.itemWidth > slider.w) ? ((slider.itemW + (slideMargin * 2)) * slider.count) - slider.w - slideMargin : ((slider.itemW + slideMargin) * slider.count) - slider.w;
      } else {
        slider.itemW = slider.w;
        slider.pagingCount = slider.count;
        slider.last = slider.count - 1;
      }
      slider.computedW = slider.itemW - slider.boxPadding;
    }
    
    slider.update = function(pos, action) {
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
        if ((action === "add" && !carousel) || slider.pagingCount > slider.controlNav.length) {
          methods.controlNav.update("add");
        } else if ((action === "remove" && !carousel) || slider.pagingCount < slider.controlNav.length) {
          if (carousel && slider.currentSlide > slider.last) {
            slider.currentSlide -= 1;
            slider.animatingTo -= 1;
          }
          methods.controlNav.update("remove", slider.last);
        }
      }
      // update directionNav
      if (vars.directionNav) methods.directionNav.update();
      
    }
    
    slider.addSlide = function(obj, pos) {
      var $obj = $(obj);
      
      slider.count += 1;
      slider.last = slider.count - 1;
      
      // append new slide
      if (vertical && reverse) {
        (pos !== undefined) ? slider.slides.eq(slider.count - pos).after($obj) : slider.container.prepend($obj);
      } else {
        (pos !== undefined) ? slider.slides.eq(pos).before($obj) : slider.container.append($obj);
      }
      
      // update currentSlide, animatingTo, controlNav, and directionNav
      slider.update(pos, "add");
      
      // update slider.slides
      slider.slides = $(vars.selector + ':not(.clone)', slider);
      // re-setup the slider to accomdate new slide
      slider.setup();
      
      //FlexSlider: added() Callback
      vars.added(slider);
    }
    slider.removeSlide = function(obj) {
      var pos = (isNaN(obj)) ? slider.slides.index($(obj)) : obj;
      
      // update count
      slider.count -= 1;
      slider.last = slider.count - 1;
      
      // remove slide
      if (isNaN(obj)) {
        $(obj, slider.slides).remove();
      } else {
        (vertical && reverse) ? slider.slides.eq(slider.last).remove() : slider.slides.eq(obj).remove();
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
    }
    
    //FlexSlider: Initialize
    methods.init();
  }
  
  //FlexSlider: Default Settings
  $.flexslider.defaults = {
    namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
    selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
    animation: "fade",              //String: Select your animation type, "fade" or "slide"
    easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
    direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
    reverse: false,                 //{NEW} Boolean: Reverse the animation direction
    animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
    smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode  
    startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
    slideshow: true,                //Boolean: Animate slider automatically
    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
    animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
    initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
    randomize: false,               //Boolean: Randomize slide order
    
    // Usability features
    pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
    pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
    useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
    touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
    video: false,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
    
    // Primary Controls
    controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
    directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
    prevText: "Previous",           //String: Set the text for the "previous" directionNav item
    nextText: "Next",               //String: Set the text for the "next" directionNav item
    
    // Secondary Navigation
    keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
    multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
    mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
    pausePlay: false,               //Boolean: Create pause/play dynamic element
    pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
    playText: "Play",               //String: Set the text for the "play" pausePlay item
    
    // Special properties
    controlsContainer: "",          //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
    manualControls: "",             //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
    sync: "",                       //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
    asNavFor: "",                   //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
    
    // Carousel Options
    itemWidth: 0,                   //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
    itemMargin: 0,                  //{NEW} Integer: Margin between carousel items.
    minItems: 0,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
    maxItems: 0,                    //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
    move: 0,                        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
                                    
    // Callback API
    start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
    before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
    after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
    end: function(){},              //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
    added: function(){},            //{NEW} Callback: function(slider) - Fires after a slide is added
    removed: function(){}           //{NEW} Callback: function(slider) - Fires after a slide is removed
  }


  //FlexSlider: Plugin Function
  $.fn.flexslider = function(options) {
    options = options || {};
    if (typeof options === "object") {
      return this.each(function() {
        var $this = $(this),
            selector = (options.selector) ? options.selector : ".slides > li",
            $slides = $this.find(selector);

        if ($slides.length === 1) {
          $slides.fadeIn(400);
          if (options.start) options.start($this);
        } else if ($this.data('flexslider') === undefined) {
          new $.flexslider(this, options);
        }
      });
    } else {
      // Helper strings to quickly perform functions on the slider
      var $slider = $(this).data('flexslider');
      switch (options) {
        case "play": $slider.play(); break;
        case "pause": $slider.pause(); break;
        case "next": $slider.flexAnimate($slider.getTarget("next"), true); break;
        case "prev":
        case "previous": $slider.flexAnimate($slider.getTarget("prev"), true); break;
        default: if (typeof options === "number") $slider.flexAnimate(options, true);
      }
    }
  }  

})(jQuery);

/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape...
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }

        try {
            // Replace server-side written pluses with spaces.
            // If we can't decode the cookie, ignore it, it's unusable.
            // If we can't parse the cookie, ignore it, it's unusable.
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch(e) {}
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }

    var config = $.cookie = function (key, value, options) {

        // Write

        if (value !== undefined && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setTime(+t + days * 864e+5);
            }

            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // Read

        var result = key ? undefined : {};

        // To prevent the for loop in the first place assign an empty array
        // in case there are no cookies at all. Also prevents odd result when
        // calling $.cookie().
        var cookies = document.cookie ? document.cookie.split('; ') : [];

        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');

            if (key && key === name) {
                // If second argument (value) is a function it's a converter...
                result = read(cookie, value);
                break;
            }

            // Prevent storing a cookie that we couldn't decode.
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) === undefined) {
            return false;
        }

        // Must not alter options, thus extending a fresh object...
        $.cookie(key, '', $.extend({}, options, { expires: -1 }));
        return !$.cookie(key);
    };

}));
