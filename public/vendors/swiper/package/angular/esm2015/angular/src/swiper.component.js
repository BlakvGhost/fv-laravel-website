import { ChangeDetectionStrategy, ChangeDetectorRef, Component, ContentChildren, ElementRef, EventEmitter, HostBinding, Input, NgZone, Output, ViewChild, ViewEncapsulation, } from '@angular/core';
import Swiper from 'swiper/core';
import { of, Subject } from 'rxjs';
import { getParams } from './utils/get-params';
import { SwiperSlideDirective } from './swiper-slide.directive';
import { extend, isObject, setProperty, ignoreNgOnChanges } from './utils/utils';
export class SwiperComponent {
    constructor(zone, elementRef, _changeDetectorRef) {
        this.zone = zone;
        this.elementRef = elementRef;
        this._changeDetectorRef = _changeDetectorRef;
        this.init = true;
        this.slideClass = 'swiper-slide';
        this.wrapperClass = 'swiper-wrapper';
        this.showNavigation = true;
        this.showPagination = true;
        this.showScrollbar = true;
        // prettier-ignore
        this.s__beforeBreakpoint = new EventEmitter();
        // prettier-ignore
        this.s__containerClasses = new EventEmitter();
        // prettier-ignore
        this.s__slideClass = new EventEmitter();
        // prettier-ignore
        this.s__swiper = new EventEmitter();
        // prettier-ignore
        this.s_activeIndexChange = new EventEmitter();
        // prettier-ignore
        this.s_afterInit = new EventEmitter();
        // prettier-ignore
        this.s_autoplay = new EventEmitter();
        // prettier-ignore
        this.s_autoplayStart = new EventEmitter();
        // prettier-ignore
        this.s_autoplayStop = new EventEmitter();
        // prettier-ignore
        this.s_beforeDestroy = new EventEmitter();
        // prettier-ignore
        this.s_beforeInit = new EventEmitter();
        // prettier-ignore
        this.s_beforeLoopFix = new EventEmitter();
        // prettier-ignore
        this.s_beforeResize = new EventEmitter();
        // prettier-ignore
        this.s_beforeSlideChangeStart = new EventEmitter();
        // prettier-ignore
        this.s_beforeTransitionStart = new EventEmitter();
        // prettier-ignore
        this.s_breakpoint = new EventEmitter();
        // prettier-ignore
        this.s_changeDirection = new EventEmitter();
        // prettier-ignore
        this.s_click = new EventEmitter();
        // prettier-ignore
        this.s_doubleTap = new EventEmitter();
        // prettier-ignore
        this.s_doubleClick = new EventEmitter();
        // prettier-ignore
        this.s_destroy = new EventEmitter();
        // prettier-ignore
        this.s_fromEdge = new EventEmitter();
        // prettier-ignore
        this.s_hashChange = new EventEmitter();
        // prettier-ignore
        this.s_hashSet = new EventEmitter();
        // prettier-ignore
        this.s_imagesReady = new EventEmitter();
        // prettier-ignore
        this.s_init = new EventEmitter();
        // prettier-ignore
        this.s_keyPress = new EventEmitter();
        // prettier-ignore
        this.s_lazyImageLoad = new EventEmitter();
        // prettier-ignore
        this.s_lazyImageReady = new EventEmitter();
        // prettier-ignore
        this.s_loopFix = new EventEmitter();
        // prettier-ignore
        this.s_momentumBounce = new EventEmitter();
        // prettier-ignore
        this.s_navigationHide = new EventEmitter();
        // prettier-ignore
        this.s_navigationShow = new EventEmitter();
        // prettier-ignore
        this.s_observerUpdate = new EventEmitter();
        // prettier-ignore
        this.s_orientationchange = new EventEmitter();
        // prettier-ignore
        this.s_paginationHide = new EventEmitter();
        // prettier-ignore
        this.s_paginationRender = new EventEmitter();
        // prettier-ignore
        this.s_paginationShow = new EventEmitter();
        // prettier-ignore
        this.s_paginationUpdate = new EventEmitter();
        // prettier-ignore
        this.s_progress = new EventEmitter();
        // prettier-ignore
        this.s_reachBeginning = new EventEmitter();
        // prettier-ignore
        this.s_reachEnd = new EventEmitter();
        // prettier-ignore
        this.s_realIndexChange = new EventEmitter();
        // prettier-ignore
        this.s_resize = new EventEmitter();
        // prettier-ignore
        this.s_scroll = new EventEmitter();
        // prettier-ignore
        this.s_scrollbarDragEnd = new EventEmitter();
        // prettier-ignore
        this.s_scrollbarDragMove = new EventEmitter();
        // prettier-ignore
        this.s_scrollbarDragStart = new EventEmitter();
        // prettier-ignore
        this.s_setTransition = new EventEmitter();
        // prettier-ignore
        this.s_setTranslate = new EventEmitter();
        // prettier-ignore
        this.s_slideChange = new EventEmitter();
        // prettier-ignore
        this.s_slideChangeTransitionEnd = new EventEmitter();
        // prettier-ignore
        this.s_slideChangeTransitionStart = new EventEmitter();
        // prettier-ignore
        this.s_slideNextTransitionEnd = new EventEmitter();
        // prettier-ignore
        this.s_slideNextTransitionStart = new EventEmitter();
        // prettier-ignore
        this.s_slidePrevTransitionEnd = new EventEmitter();
        // prettier-ignore
        this.s_slidePrevTransitionStart = new EventEmitter();
        // prettier-ignore
        this.s_slideResetTransitionStart = new EventEmitter();
        // prettier-ignore
        this.s_slideResetTransitionEnd = new EventEmitter();
        // prettier-ignore
        this.s_sliderMove = new EventEmitter();
        // prettier-ignore
        this.s_sliderFirstMove = new EventEmitter();
        // prettier-ignore
        this.s_slidesLengthChange = new EventEmitter();
        // prettier-ignore
        this.s_slidesGridLengthChange = new EventEmitter();
        // prettier-ignore
        this.s_snapGridLengthChange = new EventEmitter();
        // prettier-ignore
        this.s_snapIndexChange = new EventEmitter();
        // prettier-ignore
        this.s_tap = new EventEmitter();
        // prettier-ignore
        this.s_toEdge = new EventEmitter();
        // prettier-ignore
        this.s_touchEnd = new EventEmitter();
        // prettier-ignore
        this.s_touchMove = new EventEmitter();
        // prettier-ignore
        this.s_touchMoveOpposite = new EventEmitter();
        // prettier-ignore
        this.s_touchStart = new EventEmitter();
        // prettier-ignore
        this.s_transitionEnd = new EventEmitter();
        // prettier-ignore
        this.s_transitionStart = new EventEmitter();
        // prettier-ignore
        this.s_update = new EventEmitter();
        // prettier-ignore
        this.s_zoomChange = new EventEmitter();
        // prettier-ignore
        this.s_swiper = new EventEmitter();
        this.indexChange = new EventEmitter();
        this._activeSlides = new Subject();
        this.containerClasses = 'swiper-container';
        this.slidesChanges = (val) => {
            var _a;
            this.slides = val.map((slide, index) => {
                slide.slideIndex = index;
                slide.classNames = this.slideClass;
                return slide;
            });
            if (this.loop && !this.loopedSlides) {
                this.calcLoopedSlides();
            }
            if (!this.virtual) {
                this.prependSlides = of(this.slides.slice(this.slides.length - this.loopedSlides));
                this.appendSlides = of(this.slides.slice(0, this.loopedSlides));
            }
            this._changeDetectorRef.detectChanges();
            (_a = this.swiperRef) === null || _a === void 0 ? void 0 : _a.update();
        };
        this.style = null;
    }
    set navigation(val) {
        var _a, _b, _c, _d;
        const currentNext = typeof this._navigation !== 'boolean' ? (_a = this._navigation) === null || _a === void 0 ? void 0 : _a.nextEl : null;
        const currentPrev = typeof this._navigation !== 'boolean' ? (_b = this._navigation) === null || _b === void 0 ? void 0 : _b.prevEl : null;
        this._navigation = setProperty(val, {
            nextEl: currentNext || null,
            prevEl: currentPrev || null,
        });
        if (typeof this._navigation !== 'boolean' &&
            (typeof ((_c = this._navigation) === null || _c === void 0 ? void 0 : _c.nextEl) === 'string' || typeof ((_d = this._navigation) === null || _d === void 0 ? void 0 : _d.prevEl) === 'string')) {
            this.showNavigation = false;
        }
    }
    get navigation() {
        return this._navigation;
    }
    set pagination(val) {
        var _a, _b;
        const current = typeof this._pagination !== 'boolean' ? (_a = this._pagination) === null || _a === void 0 ? void 0 : _a.el : null;
        this._pagination = setProperty(val, {
            el: current || null,
        });
        if (typeof this._pagination !== 'boolean' && typeof ((_b = this._pagination) === null || _b === void 0 ? void 0 : _b.el) === 'string') {
            this.showPagination = false;
        }
    }
    get pagination() {
        return this._pagination;
    }
    set scrollbar(val) {
        var _a, _b;
        const current = typeof this._scrollbar !== 'boolean' ? (_a = this._scrollbar) === null || _a === void 0 ? void 0 : _a.el : null;
        this._scrollbar = setProperty(val, {
            el: current || null,
        });
        if (typeof this._scrollbar !== 'boolean' && typeof ((_b = this._scrollbar) === null || _b === void 0 ? void 0 : _b.el) === 'string') {
            this.showScrollbar = false;
        }
    }
    get scrollbar() {
        return this._scrollbar;
    }
    set virtual(val) {
        this._virtual = setProperty(val);
    }
    get virtual() {
        return this._virtual;
    }
    set index(index) {
        this.setIndex(index);
    }
    set config(val) {
        this.updateSwiper(val);
        const { params } = getParams(val);
        Object.assign(this, params);
    }
    set prevElRef(el) {
        this._setElement(el, this.navigation, 'navigation', 'prevEl');
    }
    set nextElRef(el) {
        this._setElement(el, this.navigation, 'navigation', 'nextEl');
    }
    set scrollbarElRef(el) {
        this._setElement(el, this.scrollbar, 'scrollbar');
    }
    set paginationElRef(el) {
        this._setElement(el, this.pagination, 'pagination');
    }
    get activeSlides() {
        if (this.virtual) {
            return this._activeSlides;
        }
        return of(this.slides);
    }
    get zoomContainerClass() {
        return typeof this.zoom !== 'boolean' ? this.zoom.containerClass : 'swiper-zoom-container';
    }
    _setElement(el, ref, update, key = 'el') {
        if (!el || !ref) {
            return;
        }
        if (ref && el.nativeElement) {
            if (ref[key] === el.nativeElement) {
                return;
            }
            ref[key] = el.nativeElement;
        }
        const updateObj = {};
        updateObj[update] = true;
        this.updateInitSwiper(updateObj);
    }
    ngOnInit() {
        const { params } = getParams(this);
        Object.assign(this, params);
    }
    ngAfterViewInit() {
        this.childrenSlidesInit();
        if (this.init) {
            this.initSwiper();
            this._changeDetectorRef.detectChanges();
        }
    }
    childrenSlidesInit() {
        this.slidesChanges(this.slidesEl);
        this.slidesEl.changes.subscribe(this.slidesChanges);
    }
    get isSwiperActive() {
        return this.swiperRef && !this.swiperRef.destroyed;
    }
    initSwiper() {
        const { params: swiperParams, passedParams } = getParams(this);
        Object.assign(this, swiperParams);
        swiperParams.onAny = (event, ...args) => {
            const emitter = this[`s_${event}`];
            if (emitter) {
                emitter.emit(...args);
            }
        };
        Object.assign(swiperParams.on, {
            slideChange: () => {
                this.indexChange.emit(this.swiperRef.realIndex);
            },
            _containerClasses(swiper, classes) {
                this.containerClasses = classes;
            },
            _swiper: (swiper) => {
                this.swiperRef = swiper;
                this.s_swiper.emit(this.swiperRef);
                swiper.loopCreate = () => { };
                swiper.loopDestroy = () => { };
                if (swiperParams.loop) {
                    swiper.loopedSlides = this.loopedSlides;
                }
                if (swiper.virtual && swiper.params.virtual.enabled) {
                    swiper.virtual.slides = this.slides;
                    const extendWith = {
                        cache: false,
                        renderExternal: (data) => {
                            this.updateVirtualSlides(data);
                        },
                        renderExternalUpdate: false,
                    };
                    extend(swiper.params.virtual, extendWith);
                    extend(swiper.originalParams.virtual, extendWith);
                }
                this._changeDetectorRef.detectChanges();
            },
            _slideClasses: (_, updated) => {
                updated.forEach(({ slideEl, classNames }, index) => {
                    const slideIndex = parseInt(slideEl.getAttribute('data-swiper-slide-index')) || index;
                    if (this.virtual) {
                        const virtualSlide = this.slides.find((item) => {
                            return item.virtualIndex && item.virtualIndex === slideIndex;
                        });
                        if (virtualSlide) {
                            virtualSlide.classNames = classNames;
                            return;
                        }
                    }
                    if (this.slides[slideIndex]) {
                        this.slides[slideIndex].classNames = classNames;
                    }
                });
                this._changeDetectorRef.detectChanges();
            },
        });
        new Swiper(this.elementRef.nativeElement, swiperParams);
    }
    updateVirtualSlides(virtualData) {
        // TODO: type virtualData
        if (!this.swiperRef ||
            (this.currentVirtualData &&
                this.currentVirtualData.from === virtualData.from &&
                this.currentVirtualData.to === virtualData.to &&
                this.currentVirtualData.offset === virtualData.offset)) {
            return;
        }
        this.style = this.swiperRef.isHorizontal()
            ? {
                [this.swiperRef.rtlTranslate ? 'right' : 'left']: `${virtualData.offset}px`,
            }
            : {
                top: `${virtualData.offset}px`,
            };
        this.currentVirtualData = virtualData;
        this._activeSlides.next(virtualData.slides);
        this._changeDetectorRef.detectChanges();
        this.swiperRef.updateSlides();
        this.swiperRef.updateProgress();
        this.swiperRef.updateSlidesClasses();
        if (this.swiperRef.lazy && this.swiperRef.params.lazy['enabled']) {
            this.swiperRef.lazy.load();
        }
        this.swiperRef.virtual.update(true);
        return;
    }
    ngOnChanges(changedParams) {
        this.updateSwiper(changedParams);
        this._changeDetectorRef.detectChanges();
    }
    updateInitSwiper(changedParams) {
        if (!(changedParams && this.swiperRef && !this.swiperRef.destroyed)) {
            return;
        }
        const { params: currentParams, pagination, navigation, scrollbar, virtual, thumbs, } = this.swiperRef;
        if (changedParams.pagination) {
            if (this.pagination &&
                typeof this.pagination !== 'boolean' &&
                this.pagination.el &&
                pagination &&
                !pagination.el) {
                this.updateParameter('pagination', this.pagination);
                pagination.init();
                pagination.render();
                pagination.update();
            }
            else {
                pagination.destroy();
                pagination.el = null;
            }
        }
        if (changedParams.scrollbar) {
            if (this.scrollbar &&
                typeof this.scrollbar !== 'boolean' &&
                this.scrollbar.el &&
                scrollbar &&
                !scrollbar.el) {
                this.updateParameter('scrollbar', this.scrollbar);
                scrollbar.init();
                scrollbar.updateSize();
                scrollbar.setTranslate();
            }
            else {
                scrollbar.destroy();
                scrollbar.el = null;
            }
        }
        if (changedParams.navigation) {
            if (this.navigation &&
                typeof this.navigation !== 'boolean' &&
                this.navigation.prevEl &&
                this.navigation.nextEl &&
                navigation &&
                !navigation.prevEl &&
                !navigation.nextEl) {
                this.updateParameter('navigation', this.navigation);
                navigation.init();
                navigation.update();
            }
            else if (navigation.prevEl && navigation.nextEl) {
                navigation.destroy();
                navigation.nextEl = null;
                navigation.prevEl = null;
            }
        }
        if (changedParams.thumbs && this.thumbs && this.thumbs.swiper) {
            this.updateParameter('thumbs', this.thumbs);
            const initialized = thumbs.init();
            if (initialized)
                thumbs.update(true);
        }
        if (changedParams.controller && this.controller && this.controller.control) {
            this.swiperRef.controller.control = this.controller.control;
        }
        this.swiperRef.update();
    }
    updateSwiper(changedParams) {
        var _a, _b;
        if (changedParams.config) {
            return;
        }
        if (!(changedParams && this.swiperRef && !this.swiperRef.destroyed)) {
            return;
        }
        for (const key in changedParams) {
            if (ignoreNgOnChanges.indexOf(key) >= 0) {
                continue;
            }
            const newValue = (_b = (_a = changedParams[key]) === null || _a === void 0 ? void 0 : _a.currentValue) !== null && _b !== void 0 ? _b : changedParams[key];
            this.updateParameter(key, newValue);
        }
        if (changedParams.allowSlideNext) {
            this.swiperRef.allowSlideNext = this.allowSlideNext;
        }
        if (changedParams.allowSlidePrev) {
            this.swiperRef.allowSlidePrev = this.allowSlidePrev;
        }
        if (changedParams.direction) {
            this.swiperRef.changeDirection(this.direction, false);
        }
        if (changedParams.breakpoints) {
            if (this.loop && !this.loopedSlides) {
                this.calcLoopedSlides();
            }
            this.swiperRef.currentBreakpoint = null;
            this.swiperRef.setBreakpoint();
        }
        this.swiperRef.update();
    }
    calcLoopedSlides() {
        if (!this.loop) {
            return;
        }
        let slidesPerViewParams = this.slidesPerView;
        if (this.breakpoints) {
            const breakpoint = Swiper.prototype.getBreakpoint(this.breakpoints);
            const breakpointOnlyParams = breakpoint in this.breakpoints ? this.breakpoints[breakpoint] : undefined;
            if (breakpointOnlyParams && breakpointOnlyParams.slidesPerView) {
                slidesPerViewParams = breakpointOnlyParams.slidesPerView;
            }
        }
        if (slidesPerViewParams === 'auto') {
            this.loopedSlides = this.slides.length;
            return this.slides.length;
        }
        let loopedSlides = this.loopedSlides || slidesPerViewParams;
        loopedSlides += this.loopAdditionalSlides;
        if (loopedSlides > this.slides.length) {
            loopedSlides = this.slides.length;
        }
        this.loopedSlides = loopedSlides;
        return loopedSlides;
    }
    updateParameter(key, value) {
        if (!(this.swiperRef && !this.swiperRef.destroyed)) {
            return;
        }
        const _key = key.replace(/^_/, '');
        if (Object.keys(this.swiperRef.modules).indexOf(_key) >= 0) {
            extend(value, this.swiperRef.modules[_key].params[_key]);
        }
        if (isObject(this.swiperRef.params[_key]) && isObject(value)) {
            extend(this.swiperRef.params[_key], value);
        }
        else {
            this.swiperRef.params[_key] = value;
        }
    }
    setIndex(index, speed, silent) {
        if (!this.isSwiperActive) {
            this.initialSlide = index;
            return;
        }
        if (index === this.swiperRef.activeIndex) {
            return;
        }
        this.zone.runOutsideAngular(() => {
            if (this.loop) {
                this.swiperRef.slideToLoop(index, speed, !silent);
            }
            else {
                this.swiperRef.slideTo(index, speed, !silent);
            }
        });
    }
    ngOnDestroy() {
        var _a;
        (_a = this.swiperRef) === null || _a === void 0 ? void 0 : _a.destroy();
    }
}
SwiperComponent.decorators = [
    { type: Component, args: [{
                selector: 'swiper, [swiper]',
                template: "<ng-content select=\"[slot=container-start]\"></ng-content>\n<ng-container *ngIf=\"navigation && showNavigation\">\n  <div class=\"swiper-button-prev\" #prevElRef></div>\n  <div class=\"swiper-button-next\" #nextElRef></div>\n</ng-container>\n<div *ngIf=\"scrollbar && showScrollbar\" class=\"swiper-scrollbar\" #scrollbarElRef></div>\n<div *ngIf=\"pagination && showPagination\" class=\"swiper-pagination\" #paginationElRef></div>\n<div [ngClass]=\"wrapperClass\">\n  <ng-content select=\"[slot=wrapper-start]\"></ng-content>\n  <ng-template\n    *ngTemplateOutlet=\"\n      slidesTemplate;\n      context: {\n        loopSlides: prependSlides,\n        key: 'prepend'\n      }\n    \"\n  ></ng-template>\n  <ng-template\n    *ngTemplateOutlet=\"\n      slidesTemplate;\n      context: {\n        loopSlides: activeSlides,\n        key: ''\n      }\n    \"\n  ></ng-template>\n  <ng-template\n    *ngTemplateOutlet=\"\n      slidesTemplate;\n      context: {\n        loopSlides: appendSlides,\n        key: 'append'\n      }\n    \"\n  ></ng-template>\n  <ng-content select=\"[slot=wrapper-end]\"></ng-content>\n</div>\n<ng-content select=\"[slot=container-end]\"></ng-content>\n\n<ng-template #slidesTemplate let-loopSlides=\"loopSlides\" let-slideKey=\"key\">\n  <div\n    *ngFor=\"let slide of loopSlides | async\"\n    [ngClass]=\"\n      (slide.class ? slide.class + ' ' : '') +\n      slideClass +\n      (slideKey !== '' ? ' ' + slideDuplicateClass : '')\n    \"\n    [attr.data-swiper-slide-index]=\"slide.virtualIndex ? slide.virtualIndex : slide.slideIndex\"\n    [style]=\"style\"\n    [ngSwitch]=\"slide.zoom\"\n  >\n    <div *ngSwitchCase=\"true\" [ngClass]=\"zoomContainerClass\">\n      <ng-template\n        [ngTemplateOutlet]=\"slide.template\"\n        [ngTemplateOutletContext]=\"{\n          $implicit: slide.slideData\n        }\"\n      ></ng-template>\n    </div>\n    <ng-container *ngSwitchDefault>\n      <ng-template\n        [ngTemplateOutlet]=\"slide.template\"\n        [ngTemplateOutletContext]=\"{\n          $implicit: slide.slideData\n        }\"\n      ></ng-template>\n    </ng-container>\n  </div>\n</ng-template>\n",
                changeDetection: ChangeDetectionStrategy.OnPush,
                encapsulation: ViewEncapsulation.None,
                styles: [`
      swiper {
        display: block;
      }
    `]
            },] }
];
SwiperComponent.ctorParameters = () => [
    { type: NgZone },
    { type: ElementRef },
    { type: ChangeDetectorRef }
];
SwiperComponent.propDecorators = {
    init: [{ type: Input }],
    direction: [{ type: Input }],
    touchEventsTarget: [{ type: Input }],
    initialSlide: [{ type: Input }],
    speed: [{ type: Input }],
    cssMode: [{ type: Input }],
    updateOnWindowResize: [{ type: Input }],
    nested: [{ type: Input }],
    width: [{ type: Input }],
    height: [{ type: Input }],
    preventInteractionOnTransition: [{ type: Input }],
    userAgent: [{ type: Input }],
    url: [{ type: Input }],
    edgeSwipeDetection: [{ type: Input }],
    edgeSwipeThreshold: [{ type: Input }],
    freeMode: [{ type: Input }],
    freeModeMomentum: [{ type: Input }],
    freeModeMomentumRatio: [{ type: Input }],
    freeModeMomentumBounce: [{ type: Input }],
    freeModeMomentumBounceRatio: [{ type: Input }],
    freeModeMomentumVelocityRatio: [{ type: Input }],
    freeModeSticky: [{ type: Input }],
    freeModeMinimumVelocity: [{ type: Input }],
    autoHeight: [{ type: Input }],
    setWrapperSize: [{ type: Input }],
    virtualTranslate: [{ type: Input }],
    effect: [{ type: Input }],
    breakpoints: [{ type: Input }],
    spaceBetween: [{ type: Input }],
    slidesPerView: [{ type: Input }],
    slidesPerColumn: [{ type: Input }],
    slidesPerColumnFill: [{ type: Input }],
    slidesPerGroup: [{ type: Input }],
    slidesPerGroupSkip: [{ type: Input }],
    centeredSlides: [{ type: Input }],
    centeredSlidesBounds: [{ type: Input }],
    slidesOffsetBefore: [{ type: Input }],
    slidesOffsetAfter: [{ type: Input }],
    normalizeSlideIndex: [{ type: Input }],
    centerInsufficientSlides: [{ type: Input }],
    watchOverflow: [{ type: Input }],
    roundLengths: [{ type: Input }],
    touchRatio: [{ type: Input }],
    touchAngle: [{ type: Input }],
    simulateTouch: [{ type: Input }],
    shortSwipes: [{ type: Input }],
    longSwipes: [{ type: Input }],
    longSwipesRatio: [{ type: Input }],
    longSwipesMs: [{ type: Input }],
    followFinger: [{ type: Input }],
    allowTouchMove: [{ type: Input }],
    threshold: [{ type: Input }],
    touchMoveStopPropagation: [{ type: Input }],
    touchStartPreventDefault: [{ type: Input }],
    touchStartForcePreventDefault: [{ type: Input }],
    touchReleaseOnEdges: [{ type: Input }],
    uniqueNavElements: [{ type: Input }],
    resistance: [{ type: Input }],
    resistanceRatio: [{ type: Input }],
    watchSlidesProgress: [{ type: Input }],
    watchSlidesVisibility: [{ type: Input }],
    grabCursor: [{ type: Input }],
    preventClicks: [{ type: Input }],
    preventClicksPropagation: [{ type: Input }],
    slideToClickedSlide: [{ type: Input }],
    preloadImages: [{ type: Input }],
    updateOnImagesReady: [{ type: Input }],
    loop: [{ type: Input }],
    loopAdditionalSlides: [{ type: Input }],
    loopedSlides: [{ type: Input }],
    loopFillGroupWithBlank: [{ type: Input }],
    loopPreventsSlide: [{ type: Input }],
    allowSlidePrev: [{ type: Input }],
    allowSlideNext: [{ type: Input }],
    swipeHandler: [{ type: Input }],
    noSwiping: [{ type: Input }],
    noSwipingClass: [{ type: Input }],
    noSwipingSelector: [{ type: Input }],
    passiveListeners: [{ type: Input }],
    containerModifierClass: [{ type: Input }],
    slideClass: [{ type: Input }],
    slideBlankClass: [{ type: Input }],
    slideActiveClass: [{ type: Input }],
    slideDuplicateActiveClass: [{ type: Input }],
    slideVisibleClass: [{ type: Input }],
    slideDuplicateClass: [{ type: Input }],
    slideNextClass: [{ type: Input }],
    slideDuplicateNextClass: [{ type: Input }],
    slidePrevClass: [{ type: Input }],
    slideDuplicatePrevClass: [{ type: Input }],
    wrapperClass: [{ type: Input }],
    runCallbacksOnInit: [{ type: Input }],
    a11y: [{ type: Input }],
    autoplay: [{ type: Input }],
    controller: [{ type: Input }],
    coverflowEffect: [{ type: Input }],
    cubeEffect: [{ type: Input }],
    fadeEffect: [{ type: Input }],
    flipEffect: [{ type: Input }],
    hashNavigation: [{ type: Input }],
    history: [{ type: Input }],
    keyboard: [{ type: Input }],
    lazy: [{ type: Input }],
    mousewheel: [{ type: Input }],
    parallax: [{ type: Input }],
    thumbs: [{ type: Input }],
    zoom: [{ type: Input }],
    navigation: [{ type: Input }],
    pagination: [{ type: Input }],
    scrollbar: [{ type: Input }],
    virtual: [{ type: Input }],
    index: [{ type: Input }],
    config: [{ type: Input }],
    s__beforeBreakpoint: [{ type: Output, args: ['_beforeBreakpoint',] }],
    s__containerClasses: [{ type: Output, args: ['_containerClasses',] }],
    s__slideClass: [{ type: Output, args: ['_slideClass',] }],
    s__swiper: [{ type: Output, args: ['_swiper',] }],
    s_activeIndexChange: [{ type: Output, args: ['activeIndexChange',] }],
    s_afterInit: [{ type: Output, args: ['afterInit',] }],
    s_autoplay: [{ type: Output, args: ['autoplay',] }],
    s_autoplayStart: [{ type: Output, args: ['autoplayStart',] }],
    s_autoplayStop: [{ type: Output, args: ['autoplayStop',] }],
    s_beforeDestroy: [{ type: Output, args: ['beforeDestroy',] }],
    s_beforeInit: [{ type: Output, args: ['beforeInit',] }],
    s_beforeLoopFix: [{ type: Output, args: ['beforeLoopFix',] }],
    s_beforeResize: [{ type: Output, args: ['beforeResize',] }],
    s_beforeSlideChangeStart: [{ type: Output, args: ['beforeSlideChangeStart',] }],
    s_beforeTransitionStart: [{ type: Output, args: ['beforeTransitionStart',] }],
    s_breakpoint: [{ type: Output, args: ['breakpoint',] }],
    s_changeDirection: [{ type: Output, args: ['changeDirection',] }],
    s_click: [{ type: Output, args: ['click',] }],
    s_doubleTap: [{ type: Output, args: ['doubleTap',] }],
    s_doubleClick: [{ type: Output, args: ['doubleClick',] }],
    s_destroy: [{ type: Output, args: ['destroy',] }],
    s_fromEdge: [{ type: Output, args: ['fromEdge',] }],
    s_hashChange: [{ type: Output, args: ['hashChange',] }],
    s_hashSet: [{ type: Output, args: ['hashSet',] }],
    s_imagesReady: [{ type: Output, args: ['imagesReady',] }],
    s_init: [{ type: Output, args: ['init',] }],
    s_keyPress: [{ type: Output, args: ['keyPress',] }],
    s_lazyImageLoad: [{ type: Output, args: ['lazyImageLoad',] }],
    s_lazyImageReady: [{ type: Output, args: ['lazyImageReady',] }],
    s_loopFix: [{ type: Output, args: ['loopFix',] }],
    s_momentumBounce: [{ type: Output, args: ['momentumBounce',] }],
    s_navigationHide: [{ type: Output, args: ['navigationHide',] }],
    s_navigationShow: [{ type: Output, args: ['navigationShow',] }],
    s_observerUpdate: [{ type: Output, args: ['observerUpdate',] }],
    s_orientationchange: [{ type: Output, args: ['orientationchange',] }],
    s_paginationHide: [{ type: Output, args: ['paginationHide',] }],
    s_paginationRender: [{ type: Output, args: ['paginationRender',] }],
    s_paginationShow: [{ type: Output, args: ['paginationShow',] }],
    s_paginationUpdate: [{ type: Output, args: ['paginationUpdate',] }],
    s_progress: [{ type: Output, args: ['progress',] }],
    s_reachBeginning: [{ type: Output, args: ['reachBeginning',] }],
    s_reachEnd: [{ type: Output, args: ['reachEnd',] }],
    s_realIndexChange: [{ type: Output, args: ['realIndexChange',] }],
    s_resize: [{ type: Output, args: ['resize',] }],
    s_scroll: [{ type: Output, args: ['scroll',] }],
    s_scrollbarDragEnd: [{ type: Output, args: ['scrollbarDragEnd',] }],
    s_scrollbarDragMove: [{ type: Output, args: ['scrollbarDragMove',] }],
    s_scrollbarDragStart: [{ type: Output, args: ['scrollbarDragStart',] }],
    s_setTransition: [{ type: Output, args: ['setTransition',] }],
    s_setTranslate: [{ type: Output, args: ['setTranslate',] }],
    s_slideChange: [{ type: Output, args: ['slideChange',] }],
    s_slideChangeTransitionEnd: [{ type: Output, args: ['slideChangeTransitionEnd',] }],
    s_slideChangeTransitionStart: [{ type: Output, args: ['slideChangeTransitionStart',] }],
    s_slideNextTransitionEnd: [{ type: Output, args: ['slideNextTransitionEnd',] }],
    s_slideNextTransitionStart: [{ type: Output, args: ['slideNextTransitionStart',] }],
    s_slidePrevTransitionEnd: [{ type: Output, args: ['slidePrevTransitionEnd',] }],
    s_slidePrevTransitionStart: [{ type: Output, args: ['slidePrevTransitionStart',] }],
    s_slideResetTransitionStart: [{ type: Output, args: ['slideResetTransitionStart',] }],
    s_slideResetTransitionEnd: [{ type: Output, args: ['slideResetTransitionEnd',] }],
    s_sliderMove: [{ type: Output, args: ['sliderMove',] }],
    s_sliderFirstMove: [{ type: Output, args: ['sliderFirstMove',] }],
    s_slidesLengthChange: [{ type: Output, args: ['slidesLengthChange',] }],
    s_slidesGridLengthChange: [{ type: Output, args: ['slidesGridLengthChange',] }],
    s_snapGridLengthChange: [{ type: Output, args: ['snapGridLengthChange',] }],
    s_snapIndexChange: [{ type: Output, args: ['snapIndexChange',] }],
    s_tap: [{ type: Output, args: ['tap',] }],
    s_toEdge: [{ type: Output, args: ['toEdge',] }],
    s_touchEnd: [{ type: Output, args: ['touchEnd',] }],
    s_touchMove: [{ type: Output, args: ['touchMove',] }],
    s_touchMoveOpposite: [{ type: Output, args: ['touchMoveOpposite',] }],
    s_touchStart: [{ type: Output, args: ['touchStart',] }],
    s_transitionEnd: [{ type: Output, args: ['transitionEnd',] }],
    s_transitionStart: [{ type: Output, args: ['transitionStart',] }],
    s_update: [{ type: Output, args: ['update',] }],
    s_zoomChange: [{ type: Output, args: ['zoomChange',] }],
    s_swiper: [{ type: Output, args: ['swiper',] }],
    indexChange: [{ type: Output }],
    prevElRef: [{ type: ViewChild, args: ['prevElRef', { static: false },] }],
    nextElRef: [{ type: ViewChild, args: ['nextElRef', { static: false },] }],
    scrollbarElRef: [{ type: ViewChild, args: ['scrollbarElRef', { static: false },] }],
    paginationElRef: [{ type: ViewChild, args: ['paginationElRef', { static: false },] }],
    slidesEl: [{ type: ContentChildren, args: [SwiperSlideDirective, { descendants: true, emitDistinctChangesOnly: true },] }],
    containerClasses: [{ type: HostBinding, args: ['class',] }]
};
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoic3dpcGVyLmNvbXBvbmVudC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIi4uLy4uLy4uLy4uLy4uL3NyYy9hbmd1bGFyL3NyYy9zd2lwZXIuY29tcG9uZW50LnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLE9BQU8sRUFDTCx1QkFBdUIsRUFDdkIsaUJBQWlCLEVBQ2pCLFNBQVMsRUFDVCxlQUFlLEVBQ2YsVUFBVSxFQUNWLFlBQVksRUFDWixXQUFXLEVBQ1gsS0FBSyxFQUNMLE1BQU0sRUFFTixNQUFNLEVBR04sU0FBUyxFQUNULGlCQUFpQixHQUNsQixNQUFNLGVBQWUsQ0FBQztBQUN2QixPQUFPLE1BQU0sTUFBTSxhQUFhLENBQUM7QUFDakMsT0FBTyxFQUFjLEVBQUUsRUFBRSxPQUFPLEVBQUUsTUFBTSxNQUFNLENBQUM7QUFDL0MsT0FBTyxFQUFFLFNBQVMsRUFBRSxNQUFNLG9CQUFvQixDQUFDO0FBQy9DLE9BQU8sRUFBRSxvQkFBb0IsRUFBRSxNQUFNLDBCQUEwQixDQUFDO0FBQ2hFLE9BQU8sRUFBRSxNQUFNLEVBQUUsUUFBUSxFQUFFLFdBQVcsRUFBRSxpQkFBaUIsRUFBRSxNQUFNLGVBQWUsQ0FBQztBQXNCakYsTUFBTSxPQUFPLGVBQWU7SUFxWDFCLFlBQ1UsSUFBWSxFQUNaLFVBQXNCLEVBQ3RCLGtCQUFxQztRQUZyQyxTQUFJLEdBQUosSUFBSSxDQUFRO1FBQ1osZUFBVSxHQUFWLFVBQVUsQ0FBWTtRQUN0Qix1QkFBa0IsR0FBbEIsa0JBQWtCLENBQW1CO1FBdlh0QyxTQUFJLEdBQTBCLElBQUksQ0FBQztRQWdGbkMsZUFBVSxHQUFnQyxjQUFjLENBQUM7UUFVekQsaUJBQVksR0FBa0MsZ0JBQWdCLENBQUM7UUFvQ3hFLG1CQUFjLEdBQVksSUFBSSxDQUFDO1FBZ0IvQixtQkFBYyxHQUFZLElBQUksQ0FBQztRQWdCL0Isa0JBQWEsR0FBWSxJQUFJLENBQUM7UUFxQjlCLGtCQUFrQjtRQUNXLHdCQUFtQixHQUFvRCxJQUFJ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QUUsRUFBRSxNQUFNLEVBQUUsS0FBSyxFQUFFO3dCQUl4QyxTQUFTLFNBQUMsV0FBVyxFQUFFLEVBQUUsTUFBTSxFQUFFLEtBQUssRUFBRTs2QkFJeEMsU0FBUyxTQUFDLGdCQUFnQixFQUFFLEVBQUUsTUFBTSxFQUFFLEtBQUssRUFBRTs4QkFJN0MsU0FBUyxTQUFDLGlCQUFpQixFQUFFLEVBQUUsTUFBTSxFQUFFLEtBQUssRUFBRTt1QkFJOUMsZUFBZSxTQUFDLG9CQUFvQixFQUFFLEVBQUUsV0FBVyxFQUFFLElBQUksRUFBRSx1QkFBdUIsRUFBRSxJQUFJLEVBQUU7K0JBcUIxRixXQUFXLFNBQUMsT0FBTyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7XG4gIENoYW5nZURldGVjdGlvblN0cmF0ZWd5LFxuICBDaGFuZ2VEZXRlY3RvclJlZixcbiAgQ29tcG9uZW50LFxuICBDb250ZW50Q2hpbGRyZW4sXG4gIEVsZW1lbnRSZWYsXG4gIEV2ZW50RW1pdHRlcixcbiAgSG9zdEJpbmRpbmcsXG4gIElucHV0LFxuICBOZ1pvbmUsXG4gIE9uSW5pdCxcbiAgT3V0cHV0LFxuICBRdWVyeUxpc3QsXG4gIFNpbXBsZUNoYW5nZXMsXG4gIFZpZXdDaGlsZCxcbiAgVmlld0VuY2Fwc3VsYXRpb24sXG59IGZyb20gJ0Bhbmd1bGFyL2NvcmUnO1xuaW1wb3J0IFN3aXBlciBmcm9tICdzd2lwZXIvY29yZSc7XG5pbXBvcnQgeyBPYnNlcnZhYmxlLCBvZiwgU3ViamVjdCB9IGZyb20gJ3J4anMnO1xuaW1wb3J0IHsgZ2V0UGFyYW1zIH0gZnJvbSAnLi91dGlscy9nZXQtcGFyYW1zJztcbmltcG9ydCB7IFN3aXBlclNsaWRlRGlyZWN0aXZlIH0gZnJvbSAnLi9zd2lwZXItc2xpZGUuZGlyZWN0aXZlJztcbmltcG9ydCB7IGV4dGVuZCwgaXNPYmplY3QsIHNldFByb3BlcnR5LCBpZ25vcmVOZ09uQ2hhbmdlcyB9IGZyb20gJy4vdXRpbHMvdXRpbHMnO1xuaW1wb3J0IHtcbiAgU3dpcGVyT3B0aW9ucyxcbiAgU3dpcGVyRXZlbnRzLFxuICBOYXZpZ2F0aW9uT3B0aW9ucyxcbiAgUGFnaW5hdGlvbk9wdGlvbnMsXG4gIFNjcm9sbGJhck9wdGlvbnMsXG4gIFZpcnR1YWxPcHRpb25zLFxufSBmcm9tICdzd2lwZXIvdHlwZXMnO1xuQENvbXBvbmVudCh7XG4gIHNlbGVjdG9yOiAnc3dpcGVyLCBbc3dpcGVyXScsXG4gIHRlbXBsYXRlVXJsOiAnLi9zd2lwZXIuY29tcG9uZW50Lmh0bWwnLFxuICBjaGFuZ2VEZXRlY3Rpb246IENoYW5nZURldGVjdGlvblN0cmF0ZWd5Lk9uUHVzaCxcbiAgZW5jYXBzdWxhdGlvbjogVmlld0VuY2Fwc3VsYXRpb24uTm9uZSxcbiAgc3R5bGVzOiBbXG4gICAgYFxuICAgICAgc3dpcGVyIHtcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XG4gICAgICB9XG4gICAgYCxcbiAgXSxcbn0pXG5leHBvcnQgY2xhc3MgU3dpcGVyQ29tcG9uZW50IGltcGxlbWVudHMgT25Jbml0IHtcbiAgQElucHV0KCkgaW5pdDogU3dpcGVyT3B0aW9uc1snaW5pdCddID0gdHJ1ZTtcbiAgQElucHV0KCkgZGlyZWN0aW9uOiBTd2lwZXJPcHRpb25zWydkaXJlY3Rpb24nXTtcbiAgQElucHV0KCkgdG91Y2hFdmVudHNUYXJnZXQ6IFN3aXBlck9wdGlvbnNbJ3RvdWNoRXZlbnRzVGFyZ2V0J107XG4gIEBJbnB1dCgpIGluaXRpYWxTbGlkZTogU3dpcGVyT3B0aW9uc1snaW5pdGlhbFNsaWRlJ107XG4gIEBJbnB1dCgpIHNwZWVkOiBTd2lwZXJPcHRpb25zWydzcGVlZCddO1xuICBASW5wdXQoKSBjc3NNb2RlOiBTd2lwZXJPcHRpb25zWydjc3NNb2RlJ107XG4gIEBJbnB1dCgpIHVwZGF0ZU9uV2luZG93UmVzaXplOiBTd2lwZXJPcHRpb25zWyd1cGRhdGVPbldpbmRvd1Jlc2l6ZSddO1xuICBASW5wdXQoKSBuZXN0ZWQ6IFN3aXBlck9wdGlvbnNbJ25lc3RlZCddO1xuICBASW5wdXQoKSB3aWR0aDogU3dpcGVyT3B0aW9uc1snd2lkdGgnXTtcbiAgQElucHV0KCkgaGVpZ2h0OiBTd2lwZXJPcHRpb25zWydoZWlnaHQnXTtcbiAgQElucHV0KCkgcHJldmVudEludGVyYWN0aW9uT25UcmFuc2l0aW9uOiBTd2lwZXJPcHRpb25zWydwcmV2ZW50SW50ZXJhY3Rpb25PblRyYW5zaXRpb24nXTtcbiAgQElucHV0KCkgdXNlckFnZW50OiBTd2lwZXJPcHRpb25zWyd1c2VyQWdlbnQnXTtcbiAgQElucHV0KCkgdXJsOiBTd2lwZXJPcHRpb25zWyd1cmwnXTtcbiAgQElucHV0KCkgZWRnZVN3aXBlRGV0ZWN0aW9uOiBib29sZWFuIHwgc3RyaW5nO1xuICBASW5wdXQoKSBlZGdlU3dpcGVUaHJlc2hvbGQ6IG51bWJlcjtcbiAgQElucHV0KCkgZnJlZU1vZGU6IFN3aXBlck9wdGlvbnNbJ2ZyZWVNb2RlJ107XG4gIEBJbnB1dCgpIGZyZWVNb2RlTW9tZW50dW06IFN3aXBlck9wdGlvbnNbJ2ZyZWVNb2RlTW9tZW50dW0nXTtcbiAgQElucHV0KCkgZnJlZU1vZGVNb21lbnR1bVJhdGlvOiBTd2lwZXJPcHRpb25zWydmcmVlTW9kZU1vbWVudHVtUmF0aW8nXTtcbiAgQElucHV0KCkgZnJlZU1vZGVNb21lbnR1bUJvdW5jZTogU3dpcGVyT3B0aW9uc1snZnJlZU1vZGVNb21lbnR1bUJvdW5jZSddO1xuICBASW5wdXQoKSBmcmVlTW9kZU1vbWVudHVtQm91bmNlUmF0aW86IFN3aXBlck9wdGlvbnNbJ2ZyZWVNb2RlTW9tZW50dW1Cb3VuY2VSYXRpbyddO1xuICBASW5wdXQoKSBmcmVlTW9kZU1vbWVudHVtVmVsb2NpdHlSYXRpbzogU3dpcGVyT3B0aW9uc1snZnJlZU1vZGVNb21lbnR1bVZlbG9jaXR5UmF0aW8nXTtcbiAgQElucHV0KCkgZnJlZU1vZGVTdGlja3k6IFN3aXBlck9wdGlvbnNbJ2ZyZWVNb2RlU3RpY2t5J107XG4gIEBJbnB1dCgpIGZyZWVNb2RlTWluaW11bVZlbG9jaXR5OiBTd2lwZXJPcHRpb25zWydmcmVlTW9kZU1pbmltdW1WZWxvY2l0eSddO1xuICBASW5wdXQoKSBhdXRvSGVpZ2h0OiBTd2lwZXJPcHRpb25zWydhdXRvSGVpZ2h0J107XG4gIEBJbnB1dCgpIHNldFdyYXBwZXJTaXplOiBTd2lwZXJPcHRpb25zWydzZXRXcmFwcGVyU2l6ZSddO1xuICBASW5wdXQoKSB2aXJ0dWFsVHJhbnNsYXRlOiBTd2lwZXJPcHRpb25zWyd2aXJ0dWFsVHJhbnNsYXRlJ107XG4gIEBJbnB1dCgpIGVmZmVjdDogU3dpcGVyT3B0aW9uc1snZWZmZWN0J107XG4gIEBJbnB1dCgpIGJyZWFrcG9pbnRzOiBTd2lwZXJPcHRpb25zWydicmVha3BvaW50cyddO1xuICBASW5wdXQoKSBzcGFjZUJldHdlZW46IFN3aXBlck9wdGlvbnNbJ3NwYWNlQmV0d2VlbiddO1xuICBASW5wdXQoKSBzbGlkZXNQZXJWaWV3OiBTd2lwZXJPcHRpb25zWydzbGlkZXNQZXJWaWV3J107XG4gIEBJbnB1dCgpIHNsaWRlc1BlckNvbHVtbjogU3dpcGVyT3B0aW9uc1snc2xpZGVzUGVyQ29sdW1uJ107XG4gIEBJbnB1dCgpIHNsaWRlc1BlckNvbHVtbkZpbGw6IFN3aXBlck9wdGlvbnNbJ3NsaWRlc1BlckNvbHVtbkZpbGwnXTtcbiAgQElucHV0KCkgc2xpZGVzUGVyR3JvdXA6IFN3aXBlck9wdGlvbnNbJ3NsaWRlc1Blckdyb3VwJ107XG4gIEBJbnB1dCgpIHNsaWRlc1Blckdyb3VwU2tpcDogU3dpcGVyT3B0aW9uc1snc2xpZGVzUGVyR3JvdXBTa2lwJ107XG4gIEBJbnB1dCgpIGNlbnRlcmVkU2xpZGVzOiBTd2lwZXJPcHRpb25zWydjZW50ZXJlZFNsaWRlcyddO1xuICBASW5wdXQoKSBjZW50ZXJlZFNsaWRlc0JvdW5kczogU3dpcGVyT3B0aW9uc1snY2VudGVyZWRTbGlkZXNCb3VuZHMnXTtcbiAgQElucHV0KCkgc2xpZGVzT2Zmc2V0QmVmb3JlOiBTd2lwZXJPcHRpb25zWydzbGlkZXNPZmZzZXRCZWZvcmUnXTtcbiAgQElucHV0KCkgc2xpZGVzT2Zmc2V0QWZ0ZXI6IFN3aXBlck9wdGlvbnNbJ3NsaWRlc09mZnNldEFmdGVyJ107XG4gIEBJbnB1dCgpIG5vcm1hbGl6ZVNsaWRlSW5kZXg6IFN3aXBlck9wdGlvbnNbJ25vcm1hbGl6ZVNsaWRlSW5kZXgnXTtcbiAgQElucHV0KCkgY2VudGVySW5zdWZmaWNpZW50U2xpZGVzOiBTd2lwZXJPcHRpb25zWydjZW50ZXJJbnN1ZmZpY2llbnRTbGlkZXMnXTtcbiAgQElucHV0KCkgd2F0Y2hPdmVyZmxvdzogU3dpcGVyT3B0aW9uc1snd2F0Y2hPdmVyZmxvdyddO1xuICBASW5wdXQoKSByb3VuZExlbmd0aHM6IFN3aXBlck9wdGlvbnNbJ3JvdW5kTGVuZ3RocyddO1xuICBASW5wdXQoKSB0b3VjaFJhdGlvOiBTd2lwZXJPcHRpb25zWyd0b3VjaFJhdGlvJ107XG4gIEBJbnB1dCgpIHRvdWNoQW5nbGU6IFN3aXBlck9wdGlvbnNbJ3RvdWNoQW5nbGUnXTtcbiAgQElucHV0KCkgc2ltdWxhdGVUb3VjaDogU3dpcGVyT3B0aW9uc1snc2ltdWxhdGVUb3VjaCddO1xuICBASW5wdXQoKSBzaG9ydFN3aXBlczogU3dpcGVyT3B0aW9uc1snc2hvcnRTd2lwZXMnXTtcbiAgQElucHV0KCkgbG9uZ1N3aXBlczogU3dpcGVyT3B0aW9uc1snbG9uZ1N3aXBlcyddO1xuICBASW5wdXQoKSBsb25nU3dpcGVzUmF0aW86IFN3aXBlck9wdGlvbnNbJ2xvbmdTd2lwZXNSYXRpbyddO1xuICBASW5wdXQoKSBsb25nU3dpcGVzTXM6IFN3aXBlck9wdGlvbnNbJ2xvbmdTd2lwZXNNcyddO1xuICBASW5wdXQoKSBmb2xsb3dGaW5nZXI6IFN3aXBlck9wdGlvbnNbJ2ZvbGxvd0ZpbmdlciddO1xuICBASW5wdXQoKSBhbGxvd1RvdWNoTW92ZTogU3dpcGVyT3B0aW9uc1snYWxsb3dUb3VjaE1vdmUnXTtcbiAgQElucHV0KCkgdGhyZXNob2xkOiBTd2lwZXJPcHRpb25zWyd0aHJlc2hvbGQnXTtcbiAgQElucHV0KCkgdG91Y2hNb3ZlU3RvcFByb3BhZ2F0aW9uOiBTd2lwZXJPcHRpb25zWyd0b3VjaE1vdmVTdG9wUHJvcGFnYXRpb24nXTtcbiAgQElucHV0KCkgdG91Y2hTdGFydFByZXZlbnREZWZhdWx0OiBTd2lwZXJPcHRpb25zWyd0b3VjaFN0YXJ0UHJldmVudERlZmF1bHQnXTtcbiAgQElucHV0KCkgdG91Y2hTdGFydEZvcmNlUHJldmVudERlZmF1bHQ6IFN3aXBlck9wdGlvbnNbJ3RvdWNoU3RhcnRGb3JjZVByZXZlbnREZWZhdWx0J107XG4gIEBJbnB1dCgpIHRvdWNoUmVsZWFzZU9uRWRnZXM6IFN3aXBlck9wdGlvbnNbJ3RvdWNoUmVsZWFzZU9uRWRnZXMnXTtcbiAgQElucHV0KCkgdW5pcXVlTmF2RWxlbWVudHM6IFN3aXBlck9wdGlvbnNbJ3VuaXF1ZU5hdkVsZW1lbnRzJ107XG4gIEBJbnB1dCgpIHJlc2lzdGFuY2U6IFN3aXBlck9wdGlvbnNbJ3Jlc2lzdGFuY2UnXTtcbiAgQElucHV0KCkgcmVzaXN0YW5jZVJhdGlvOiBTd2lwZXJPcHRpb25zWydyZXNpc3RhbmNlUmF0aW8nXTtcbiAgQElucHV0KCkgd2F0Y2hTbGlkZXNQcm9ncmVzczogU3dpcGVyT3B0aW9uc1snd2F0Y2hTbGlkZXNQcm9ncmVzcyddO1xuICBASW5wdXQoKSB3YXRjaFNsaWRlc1Zpc2liaWxpdHk6IFN3aXBlck9wdGlvbnNbJ3dhdGNoU2xpZGVzVmlzaWJpbGl0eSddO1xuICBASW5wdXQoKSBncmFiQ3Vyc29yOiBTd2lwZXJPcHRpb25zWydncmFiQ3Vyc29yJ107XG4gIEBJbnB1dCgpIHByZXZlbnRDbGlja3M6IFN3aXBlck9wdGlvbnNbJ3ByZXZlbnRDbGlja3MnXTtcbiAgQElucHV0KCkgcHJldmVudENsaWNrc1Byb3BhZ2F0aW9uOiBTd2lwZXJPcHRpb25zWydwcmV2ZW50Q2xpY2tzUHJvcGFnYXRpb24nXTtcbiAgQElucHV0KCkgc2xpZGVUb0NsaWNrZWRTbGlkZTogU3dpcGVyT3B0aW9uc1snc2xpZGVUb0NsaWNrZWRTbGlkZSddO1xuICBASW5wdXQoKSBwcmVsb2FkSW1hZ2VzOiBTd2lwZXJPcHRpb25zWydwcmVsb2FkSW1hZ2VzJ107XG4gIEBJbnB1dCgpIHVwZGF0ZU9uSW1hZ2VzUmVhZHk6IFN3aXBlck9wdGlvbnNbJ3VwZGF0ZU9uSW1hZ2VzUmVhZHknXTtcbiAgQElucHV0KCkgbG9vcDogU3dpcGVyT3B0aW9uc1snbG9vcCddO1xuICBASW5wdXQoKSBsb29wQWRkaXRpb25hbFNsaWRlczogU3dpcGVyT3B0aW9uc1snbG9vcEFkZGl0aW9uYWxTbGlkZXMnXTtcbiAgQElucHV0KCkgbG9vcGVkU2xpZGVzOiBTd2lwZXJPcHRpb25zWydsb29wZWRTbGlkZXMnXTtcbiAgQElucHV0KCkgbG9vcEZpbGxHcm91cFdpdGhCbGFuazogU3dpcGVyT3B0aW9uc1snbG9vcEZpbGxHcm91cFdpdGhCbGFuayddO1xuICBASW5wdXQoKSBsb29wUHJldmVudHNTbGlkZTogU3dpcGVyT3B0aW9uc1snbG9vcFByZXZlbnRzU2xpZGUnXTtcbiAgQElucHV0KCkgYWxsb3dTbGlkZVByZXY6IFN3aXBlck9wdGlvbnNbJ2FsbG93U2xpZGVQcmV2J107XG4gIEBJbnB1dCgpIGFsbG93U2xpZGVOZXh0OiBTd2lwZXJPcHRpb25zWydhbGxvd1NsaWRlTmV4dCddO1xuICBASW5wdXQoKSBzd2lwZUhhbmRsZXI6IFN3aXBlck9wdGlvbnNbJ3N3aXBlSGFuZGxlciddO1xuICBASW5wdXQoKSBub1N3aXBpbmc6IFN3aXBlck9wdGlvbnNbJ25vU3dpcGluZyddO1xuICBASW5wdXQoKSBub1N3aXBpbmdDbGFzczogU3dpcGVyT3B0aW9uc1snbm9Td2lwaW5nQ2xhc3MnXTtcbiAgQElucHV0KCkgbm9Td2lwaW5nU2VsZWN0b3I6IFN3aXBlck9wdGlvbnNbJ25vU3dpcGluZ1NlbGVjdG9yJ107XG4gIEBJbnB1dCgpIHBhc3NpdmVMaXN0ZW5lcnM6IFN3aXBlck9wdGlvbnNbJ3Bhc3NpdmVMaXN0ZW5lcnMnXTtcbiAgQElucHV0KCkgY29udGFpbmVyTW9kaWZpZXJDbGFzczogU3dpcGVyT3B0aW9uc1snY29udGFpbmVyTW9kaWZpZXJDbGFzcyddO1xuICBASW5wdXQoKSBzbGlkZUNsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZUNsYXNzJ10gPSAnc3dpcGVyLXNsaWRlJztcbiAgQElucHV0KCkgc2xpZGVCbGFua0NsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZUJsYW5rQ2xhc3MnXTtcbiAgQElucHV0KCkgc2xpZGVBY3RpdmVDbGFzczogU3dpcGVyT3B0aW9uc1snc2xpZGVBY3RpdmVDbGFzcyddO1xuICBASW5wdXQoKSBzbGlkZUR1cGxpY2F0ZUFjdGl2ZUNsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZUR1cGxpY2F0ZUFjdGl2ZUNsYXNzJ107XG4gIEBJbnB1dCgpIHNsaWRlVmlzaWJsZUNsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZVZpc2libGVDbGFzcyddO1xuICBASW5wdXQoKSBzbGlkZUR1cGxpY2F0ZUNsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZUR1cGxpY2F0ZUNsYXNzJ107XG4gIEBJbnB1dCgpIHNsaWRlTmV4dENsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZU5leHRDbGFzcyddO1xuICBASW5wdXQoKSBzbGlkZUR1cGxpY2F0ZU5leHRDbGFzczogU3dpcGVyT3B0aW9uc1snc2xpZGVEdXBsaWNhdGVOZXh0Q2xhc3MnXTtcbiAgQElucHV0KCkgc2xpZGVQcmV2Q2xhc3M6IFN3aXBlck9wdGlvbnNbJ3NsaWRlUHJldkNsYXNzJ107XG4gIEBJbnB1dCgpIHNsaWRlRHVwbGljYXRlUHJldkNsYXNzOiBTd2lwZXJPcHRpb25zWydzbGlkZUR1cGxpY2F0ZVByZXZDbGFzcyddO1xuICBASW5wdXQoKSB3cmFwcGVyQ2xhc3M6IFN3aXBlck9wdGlvbnNbJ3dyYXBwZXJDbGFzcyddID0gJ3N3aXBlci13cmFwcGVyJztcbiAgQElucHV0KCkgcnVuQ2FsbGJhY2tzT25Jbml0OiBTd2lwZXJPcHRpb25zWydydW5DYWxsYmFja3NPbkluaXQnXTtcbiAgQElucHV0KCkgYTExeTogU3dpcGVyT3B0aW9uc1snYTExeSddO1xuICBASW5wdXQoKSBhdXRvcGxheTogU3dpcGVyT3B0aW9uc1snYXV0b3BsYXknXTtcbiAgQElucHV0KCkgY29udHJvbGxlcjogU3dpcGVyT3B0aW9uc1snY29udHJvbGxlciddO1xuICBASW5wdXQoKSBjb3ZlcmZsb3dFZmZlY3Q6IFN3aXBlck9wdGlvbnNbJ2NvdmVyZmxvd0VmZmVjdCddO1xuICBASW5wdXQoKSBjdWJlRWZmZWN0OiBTd2lwZXJPcHRpb25zWydjdWJlRWZmZWN0J107XG4gIEBJbnB1dCgpIGZhZGVFZmZlY3Q6IFN3aXBlck9wdGlvbnNbJ2ZhZGVFZmZlY3QnXTtcbiAgQElucHV0KCkgZmxpcEVmZmVjdDogU3dpcGVyT3B0aW9uc1snZmxpcEVmZmVjdCddO1xuICBASW5wdXQoKSBoYXNoTmF2aWdhdGlvbjogU3dpcGVyT3B0aW9uc1snaGFzaE5hdmlnYXRpb24nXTtcbiAgQElucHV0KCkgaGlzdG9yeTogU3dpcGVyT3B0aW9uc1snaGlzdG9yeSddO1xuICBASW5wdXQoKSBrZXlib2FyZDogU3dpcGVyT3B0aW9uc1sna2V5Ym9hcmQnXTtcbiAgQElucHV0KCkgbGF6eTogU3dpcGVyT3B0aW9uc1snbGF6eSddO1xuICBASW5wdXQoKSBtb3VzZXdoZWVsOiBTd2lwZXJPcHRpb25zWydtb3VzZXdoZWVsJ107XG4gIEBJbnB1dCgpIHBhcmFsbGF4OiBTd2lwZXJPcHRpb25zWydwYXJhbGxheCddO1xuICBASW5wdXQoKSB0aHVtYnM6IFN3aXBlck9wdGlvbnNbJ3RodW1icyddO1xuICBASW5wdXQoKSB6b29tOiBTd2lwZXJPcHRpb25zWyd6b29tJ107XG4gIEBJbnB1dCgpXG4gIHNldCBuYXZpZ2F0aW9uKHZhbCkge1xuICAgIGNvbnN0IGN1cnJlbnROZXh0ID0gdHlwZW9mIHRoaXMuX25hdmlnYXRpb24gIT09ICdib29sZWFuJyA/IHRoaXMuX25hdmlnYXRpb24/Lm5leHRFbCA6IG51bGw7XG4gICAgY29uc3QgY3VycmVudFByZXYgPSB0eXBlb2YgdGhpcy5fbmF2aWdhdGlvbiAhPT0gJ2Jvb2xlYW4nID8gdGhpcy5fbmF2aWdhdGlvbj8ucHJldkVsIDogbnVsbDtcbiAgICB0aGlzLl9uYXZpZ2F0aW9uID0gc2V0UHJvcGVydHkodmFsLCB7XG4gICAgICBuZXh0RWw6IGN1cnJlbnROZXh0IHx8IG51bGwsXG4gICAgICBwcmV2RWw6IGN1cnJlbnRQcmV2IHx8IG51bGwsXG4gICAgfSk7XG4gICAgaWYgKFxuICAgICAgdHlwZW9mIHRoaXMuX25hdmlnYXRpb24gIT09ICdib29sZWFuJyAmJlxuICAgICAgKHR5cGVvZiB0aGlzLl9uYXZpZ2F0aW9uPy5uZXh0RWwgPT09ICdzdHJpbmcnIHx8IHR5cGVvZiB0aGlzLl9uYXZpZ2F0aW9uPy5wcmV2RWwgPT09ICdzdHJpbmcnKVxuICAgICkge1xuICAgICAgdGhpcy5zaG93TmF2aWdhdGlvbiA9IGZhbHNlO1xuICAgIH1cbiAgfVxuICBnZXQgbmF2aWdhdGlvbigpIHtcbiAgICByZXR1cm4gdGhpcy5fbmF2aWdhdGlvbjtcbiAgfVxuICBwcml2YXRlIF9uYXZpZ2F0aW9uOiBOYXZpZ2F0aW9uT3B0aW9ucyB8IGJvb2xlYW47XG4gIHNob3dOYXZpZ2F0aW9uOiBib29sZWFuID0gdHJ1ZTtcblxuICBASW5wdXQoKVxuICBzZXQgcGFnaW5hdGlvbih2YWwpIHtcbiAgICBjb25zdCBjdXJyZW50ID0gdHlwZW9mIHRoaXMuX3BhZ2luYXRpb24gIT09ICdib29sZWFuJyA/IHRoaXMuX3BhZ2luYXRpb24/LmVsIDogbnVsbDtcbiAgICB0aGlzLl9wYWdpbmF0aW9uID0gc2V0UHJvcGVydHkodmFsLCB7XG4gICAgICBlbDogY3VycmVudCB8fCBudWxsLFxuICAgIH0pO1xuICAgIGlmICh0eXBlb2YgdGhpcy5fcGFnaW5hdGlvbiAhPT0gJ2Jvb2xlYW4nICYmIHR5cGVvZiB0aGlzLl9wYWdpbmF0aW9uPy5lbCA9PT0gJ3N0cmluZycpIHtcbiAgICAgIHRoaXMuc2hvd1BhZ2luYXRpb24gPSBmYWxzZTtcbiAgICB9XG4gIH1cbiAgZ2V0IHBhZ2luYXRpb24oKSB7XG4gICAgcmV0dXJuIHRoaXMuX3BhZ2luYXRpb247XG4gIH1cbiAgcHJpdmF0ZSBfcGFnaW5hdGlvbjogUGFnaW5hdGlvbk9wdGlvbnMgfCBib29sZWFuO1xuICBzaG93UGFnaW5hdGlvbjogYm9vbGVhbiA9IHRydWU7XG5cbiAgQElucHV0KClcbiAgc2V0IHNjcm9sbGJhcih2YWwpIHtcbiAgICBjb25zdCBjdXJyZW50ID0gdHlwZW9mIHRoaXMuX3Njcm9sbGJhciAhPT0gJ2Jvb2xlYW4nID8gdGhpcy5fc2Nyb2xsYmFyPy5lbCA6IG51bGw7XG4gICAgdGhpcy5fc2Nyb2xsYmFyID0gc2V0UHJvcGVydHkodmFsLCB7XG4gICAgICBlbDogY3VycmVudCB8fCBudWxsLFxuICAgIH0pO1xuICAgIGlmICh0eXBlb2YgdGhpcy5fc2Nyb2xsYmFyICE9PSAnYm9vbGVhbicgJiYgdHlwZW9mIHRoaXMuX3Njcm9sbGJhcj8uZWwgPT09ICdzdHJpbmcnKSB7XG4gICAgICB0aGlzLnNob3dTY3JvbGxiYXIgPSBmYWxzZTtcbiAgICB9XG4gIH1cbiAgZ2V0IHNjcm9sbGJhcigpIHtcbiAgICByZXR1cm4gdGhpcy5fc2Nyb2xsYmFyO1xuICB9XG4gIHByaXZhdGUgX3Njcm9sbGJhcjogU2Nyb2xsYmFyT3B0aW9ucyB8IGJvb2xlYW47XG4gIHNob3dTY3JvbGxiYXI6IGJvb2xlYW4gPSB0cnVlO1xuXG4gIEBJbnB1dCgpXG4gIHNldCB2aXJ0dWFsKHZhbCkge1xuICAgIHRoaXMuX3ZpcnR1YWwgPSBzZXRQcm9wZXJ0eSh2YWwpO1xuICB9XG4gIGdldCB2aXJ0dWFsKCkge1xuICAgIHJldHVybiB0aGlzLl92aXJ0dWFsO1xuICB9XG4gIHByaXZhdGUgX3ZpcnR1YWw6IFZpcnR1YWxPcHRpb25zIHwgYm9vbGVhbjtcblxuICBASW5wdXQoKVxuICBzZXQgaW5kZXgoaW5kZXg6IG51bWJlcikge1xuICAgIHRoaXMuc2V0SW5kZXgoaW5kZXgpO1xuICB9XG4gIEBJbnB1dCgpXG4gIHNldCBjb25maWcodmFsOiBTd2lwZXJPcHRpb25zKSB7XG4gICAgdGhpcy51cGRhdGVTd2lwZXIodmFsKTtcbiAgICBjb25zdCB7IHBhcmFtcyB9ID0gZ2V0UGFyYW1zKHZhbCk7XG4gICAgT2JqZWN0LmFzc2lnbih0aGlzLCBwYXJhbXMpO1xuICB9XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdfYmVmb3JlQnJlYWtwb2ludCcpIHNfX2JlZm9yZUJyZWFrcG9pbnQ6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ19iZWZvcmVCcmVha3BvaW50J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdfY29udGFpbmVyQ2xhc3NlcycpIHNfX2NvbnRhaW5lckNsYXNzZXM6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ19jb250YWluZXJDbGFzc2VzJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdfc2xpZGVDbGFzcycpIHNfX3NsaWRlQ2xhc3M6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ19zbGlkZUNsYXNzJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdfc3dpcGVyJykgc19fc3dpcGVyOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydfc3dpcGVyJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdhY3RpdmVJbmRleENoYW5nZScpIHNfYWN0aXZlSW5kZXhDaGFuZ2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2FjdGl2ZUluZGV4Q2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdhZnRlckluaXQnKSBzX2FmdGVySW5pdDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snYWZ0ZXJJbml0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdhdXRvcGxheScpIHNfYXV0b3BsYXk6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2F1dG9wbGF5J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdhdXRvcGxheVN0YXJ0Jykgc19hdXRvcGxheVN0YXJ0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydhdXRvcGxheVN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdhdXRvcGxheVN0b3AnKSBzX2F1dG9wbGF5U3RvcDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snYXV0b3BsYXlTdG9wJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVEZXN0cm95Jykgc19iZWZvcmVEZXN0cm95OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydiZWZvcmVEZXN0cm95J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVJbml0Jykgc19iZWZvcmVJbml0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydiZWZvcmVJbml0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVMb29wRml4Jykgc19iZWZvcmVMb29wRml4OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydiZWZvcmVMb29wRml4J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVSZXNpemUnKSBzX2JlZm9yZVJlc2l6ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snYmVmb3JlUmVzaXplJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVTbGlkZUNoYW5nZVN0YXJ0Jykgc19iZWZvcmVTbGlkZUNoYW5nZVN0YXJ0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydiZWZvcmVTbGlkZUNoYW5nZVN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdiZWZvcmVUcmFuc2l0aW9uU3RhcnQnKSBzX2JlZm9yZVRyYW5zaXRpb25TdGFydDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snYmVmb3JlVHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdicmVha3BvaW50Jykgc19icmVha3BvaW50OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydicmVha3BvaW50J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdjaGFuZ2VEaXJlY3Rpb24nKSBzX2NoYW5nZURpcmVjdGlvbjogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snY2hhbmdlRGlyZWN0aW9uJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdjbGljaycpIHNfY2xpY2s6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2NsaWNrJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdkb3VibGVUYXAnKSBzX2RvdWJsZVRhcDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snZG91YmxlVGFwJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdkb3VibGVDbGljaycpIHNfZG91YmxlQ2xpY2s6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2RvdWJsZUNsaWNrJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdkZXN0cm95Jykgc19kZXN0cm95OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydkZXN0cm95J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdmcm9tRWRnZScpIHNfZnJvbUVkZ2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2Zyb21FZGdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdoYXNoQ2hhbmdlJykgc19oYXNoQ2hhbmdlOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydoYXNoQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdoYXNoU2V0Jykgc19oYXNoU2V0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydoYXNoU2V0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdpbWFnZXNSZWFkeScpIHNfaW1hZ2VzUmVhZHk6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2ltYWdlc1JlYWR5J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdpbml0Jykgc19pbml0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydpbml0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdrZXlQcmVzcycpIHNfa2V5UHJlc3M6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2tleVByZXNzJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdsYXp5SW1hZ2VMb2FkJykgc19sYXp5SW1hZ2VMb2FkOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydsYXp5SW1hZ2VMb2FkJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdsYXp5SW1hZ2VSZWFkeScpIHNfbGF6eUltYWdlUmVhZHk6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ2xhenlJbWFnZVJlYWR5J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdsb29wRml4Jykgc19sb29wRml4OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydsb29wRml4J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdtb21lbnR1bUJvdW5jZScpIHNfbW9tZW50dW1Cb3VuY2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ21vbWVudHVtQm91bmNlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCduYXZpZ2F0aW9uSGlkZScpIHNfbmF2aWdhdGlvbkhpZGU6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ25hdmlnYXRpb25IaWRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCduYXZpZ2F0aW9uU2hvdycpIHNfbmF2aWdhdGlvblNob3c6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ25hdmlnYXRpb25TaG93J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdvYnNlcnZlclVwZGF0ZScpIHNfb2JzZXJ2ZXJVcGRhdGU6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ29ic2VydmVyVXBkYXRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdvcmllbnRhdGlvbmNoYW5nZScpIHNfb3JpZW50YXRpb25jaGFuZ2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ29yaWVudGF0aW9uY2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdwYWdpbmF0aW9uSGlkZScpIHNfcGFnaW5hdGlvbkhpZGU6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3BhZ2luYXRpb25IaWRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdwYWdpbmF0aW9uUmVuZGVyJykgc19wYWdpbmF0aW9uUmVuZGVyOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydwYWdpbmF0aW9uUmVuZGVyJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdwYWdpbmF0aW9uU2hvdycpIHNfcGFnaW5hdGlvblNob3c6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3BhZ2luYXRpb25TaG93J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdwYWdpbmF0aW9uVXBkYXRlJykgc19wYWdpbmF0aW9uVXBkYXRlOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydwYWdpbmF0aW9uVXBkYXRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdwcm9ncmVzcycpIHNfcHJvZ3Jlc3M6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3Byb2dyZXNzJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdyZWFjaEJlZ2lubmluZycpIHNfcmVhY2hCZWdpbm5pbmc6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3JlYWNoQmVnaW5uaW5nJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdyZWFjaEVuZCcpIHNfcmVhY2hFbmQ6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3JlYWNoRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdyZWFsSW5kZXhDaGFuZ2UnKSBzX3JlYWxJbmRleENoYW5nZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sncmVhbEluZGV4Q2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdyZXNpemUnKSBzX3Jlc2l6ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sncmVzaXplJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzY3JvbGwnKSBzX3Njcm9sbDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2Nyb2xsJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzY3JvbGxiYXJEcmFnRW5kJykgc19zY3JvbGxiYXJEcmFnRW5kOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzY3JvbGxiYXJEcmFnRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzY3JvbGxiYXJEcmFnTW92ZScpIHNfc2Nyb2xsYmFyRHJhZ01vdmU6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3Njcm9sbGJhckRyYWdNb3ZlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzY3JvbGxiYXJEcmFnU3RhcnQnKSBzX3Njcm9sbGJhckRyYWdTdGFydDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2Nyb2xsYmFyRHJhZ1N0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzZXRUcmFuc2l0aW9uJykgc19zZXRUcmFuc2l0aW9uOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzZXRUcmFuc2l0aW9uJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzZXRUcmFuc2xhdGUnKSBzX3NldFRyYW5zbGF0ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2V0VHJhbnNsYXRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZUNoYW5nZScpIHNfc2xpZGVDaGFuZ2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3NsaWRlQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZUNoYW5nZVRyYW5zaXRpb25FbmQnKSBzX3NsaWRlQ2hhbmdlVHJhbnNpdGlvbkVuZDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2xpZGVDaGFuZ2VUcmFuc2l0aW9uRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZUNoYW5nZVRyYW5zaXRpb25TdGFydCcpIHNfc2xpZGVDaGFuZ2VUcmFuc2l0aW9uU3RhcnQ6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3NsaWRlQ2hhbmdlVHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZU5leHRUcmFuc2l0aW9uRW5kJykgc19zbGlkZU5leHRUcmFuc2l0aW9uRW5kOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzbGlkZU5leHRUcmFuc2l0aW9uRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZU5leHRUcmFuc2l0aW9uU3RhcnQnKSBzX3NsaWRlTmV4dFRyYW5zaXRpb25TdGFydDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2xpZGVOZXh0VHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZVByZXZUcmFuc2l0aW9uRW5kJykgc19zbGlkZVByZXZUcmFuc2l0aW9uRW5kOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzbGlkZVByZXZUcmFuc2l0aW9uRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZVByZXZUcmFuc2l0aW9uU3RhcnQnKSBzX3NsaWRlUHJldlRyYW5zaXRpb25TdGFydDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2xpZGVQcmV2VHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZVJlc2V0VHJhbnNpdGlvblN0YXJ0Jykgc19zbGlkZVJlc2V0VHJhbnNpdGlvblN0YXJ0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzbGlkZVJlc2V0VHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZVJlc2V0VHJhbnNpdGlvbkVuZCcpIHNfc2xpZGVSZXNldFRyYW5zaXRpb25FbmQ6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3NsaWRlUmVzZXRUcmFuc2l0aW9uRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZXJNb3ZlJykgc19zbGlkZXJNb3ZlOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzbGlkZXJNb3ZlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZXJGaXJzdE1vdmUnKSBzX3NsaWRlckZpcnN0TW92ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2xpZGVyRmlyc3RNb3ZlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZXNMZW5ndGhDaGFuZ2UnKSBzX3NsaWRlc0xlbmd0aENoYW5nZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc2xpZGVzTGVuZ3RoQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbGlkZXNHcmlkTGVuZ3RoQ2hhbmdlJykgc19zbGlkZXNHcmlkTGVuZ3RoQ2hhbmdlOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWydzbGlkZXNHcmlkTGVuZ3RoQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbmFwR3JpZExlbmd0aENoYW5nZScpIHNfc25hcEdyaWRMZW5ndGhDaGFuZ2U6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3NuYXBHcmlkTGVuZ3RoQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzbmFwSW5kZXhDaGFuZ2UnKSBzX3NuYXBJbmRleENoYW5nZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1snc25hcEluZGV4Q2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0YXAnKSBzX3RhcDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sndGFwJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0b0VkZ2UnKSBzX3RvRWRnZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sndG9FZGdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0b3VjaEVuZCcpIHNfdG91Y2hFbmQ6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3RvdWNoRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0b3VjaE1vdmUnKSBzX3RvdWNoTW92ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sndG91Y2hNb3ZlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0b3VjaE1vdmVPcHBvc2l0ZScpIHNfdG91Y2hNb3ZlT3Bwb3NpdGU6IEV2ZW50RW1pdHRlcjxTd2lwZXJFdmVudHNbJ3RvdWNoTW92ZU9wcG9zaXRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0b3VjaFN0YXJ0Jykgc190b3VjaFN0YXJ0OiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWyd0b3VjaFN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0cmFuc2l0aW9uRW5kJykgc190cmFuc2l0aW9uRW5kOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWyd0cmFuc2l0aW9uRW5kJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd0cmFuc2l0aW9uU3RhcnQnKSBzX3RyYW5zaXRpb25TdGFydDogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sndHJhbnNpdGlvblN0YXJ0J10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd1cGRhdGUnKSBzX3VwZGF0ZTogRXZlbnRFbWl0dGVyPFN3aXBlckV2ZW50c1sndXBkYXRlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCd6b29tQ2hhbmdlJykgc196b29tQ2hhbmdlOiBFdmVudEVtaXR0ZXI8U3dpcGVyRXZlbnRzWyd6b29tQ2hhbmdlJ10+ID0gbmV3IEV2ZW50RW1pdHRlcjxhbnk+KCk7XG4gIC8vIHByZXR0aWVyLWlnbm9yZVxuICBAT3V0cHV0KCdzd2lwZXInKSBzX3N3aXBlcjogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyPGFueT4oKTtcblxuICBAT3V0cHV0KCkgaW5kZXhDaGFuZ2UgPSBuZXcgRXZlbnRFbWl0dGVyPG51bWJlcj4oKTtcblxuICBAVmlld0NoaWxkKCdwcmV2RWxSZWYnLCB7IHN0YXRpYzogZmFsc2UgfSlcbiAgc2V0IHByZXZFbFJlZihlbDogRWxlbWVudFJlZikge1xuICAgIHRoaXMuX3NldEVsZW1lbnQoZWwsIHRoaXMubmF2aWdhdGlvbiwgJ25hdmlnYXRpb24nLCAncHJldkVsJyk7XG4gIH1cbiAgQFZpZXdDaGlsZCgnbmV4dEVsUmVmJywgeyBzdGF0aWM6IGZhbHNlIH0pXG4gIHNldCBuZXh0RWxSZWYoZWw6IEVsZW1lbnRSZWYpIHtcbiAgICB0aGlzLl9zZXRFbGVtZW50KGVsLCB0aGlzLm5hdmlnYXRpb24sICduYXZpZ2F0aW9uJywgJ25leHRFbCcpO1xuICB9XG4gIEBWaWV3Q2hpbGQoJ3Njcm9sbGJhckVsUmVmJywgeyBzdGF0aWM6IGZhbHNlIH0pXG4gIHNldCBzY3JvbGxiYXJFbFJlZihlbDogRWxlbWVudFJlZikge1xuICAgIHRoaXMuX3NldEVsZW1lbnQoZWwsIHRoaXMuc2Nyb2xsYmFyLCAnc2Nyb2xsYmFyJyk7XG4gIH1cbiAgQFZpZXdDaGlsZCgncGFnaW5hdGlvbkVsUmVmJywgeyBzdGF0aWM6IGZhbHNlIH0pXG4gIHNldCBwYWdpbmF0aW9uRWxSZWYoZWw6IEVsZW1lbnRSZWYpIHtcbiAgICB0aGlzLl9zZXRFbGVtZW50KGVsLCB0aGlzLnBhZ2luYXRpb24sICdwYWdpbmF0aW9uJyk7XG4gIH1cbiAgQENvbnRlbnRDaGlsZHJlbihTd2lwZXJTbGlkZURpcmVjdGl2ZSwgeyBkZXNjZW5kYW50czogdHJ1ZSwgZW1pdERpc3RpbmN0Q2hhbmdlc09ubHk6IHRydWUgfSlcbiAgc2xpZGVzRWw6IFF1ZXJ5TGlzdDxTd2lwZXJTbGlkZURpcmVjdGl2ZT47XG4gIHByaXZhdGUgc2xpZGVzOiBTd2lwZXJTbGlkZURpcmVjdGl2ZVtdO1xuXG4gIHByZXBlbmRTbGlkZXM6IE9ic2VydmFibGU8U3dpcGVyU2xpZGVEaXJlY3RpdmVbXT47XG4gIGFwcGVuZFNsaWRlczogT2JzZXJ2YWJsZTxTd2lwZXJTbGlkZURpcmVjdGl2ZVtdPjtcblxuICBzd2lwZXJSZWY6IFN3aXBlcjtcbiAgcmVhZG9ubHkgX2FjdGl2ZVNsaWRlcyA9IG5ldyBTdWJqZWN0PFN3aXBlclNsaWRlRGlyZWN0aXZlW10+KCk7XG5cbiAgZ2V0IGFjdGl2ZVNsaWRlcygpIHtcbiAgICBpZiAodGhpcy52aXJ0dWFsKSB7XG4gICAgICByZXR1cm4gdGhpcy5fYWN0aXZlU2xpZGVzO1xuICAgIH1cbiAgICByZXR1cm4gb2YodGhpcy5zbGlkZXMpO1xuICB9XG5cbiAgZ2V0IHpvb21Db250YWluZXJDbGFzcygpIHtcbiAgICByZXR1cm4gdHlwZW9mIHRoaXMuem9vbSAhPT0gJ2Jvb2xlYW4nID8gdGhpcy56b29tLmNvbnRhaW5lckNsYXNzIDogJ3N3aXBlci16b29tLWNvbnRhaW5lcic7XG4gIH1cblxuICBASG9zdEJpbmRpbmcoJ2NsYXNzJykgY29udGFpbmVyQ2xhc3NlcyA9ICdzd2lwZXItY29udGFpbmVyJztcbiAgY29uc3RydWN0b3IoXG4gICAgcHJpdmF0ZSB6b25lOiBOZ1pvbmUsXG4gICAgcHJpdmF0ZSBlbGVtZW50UmVmOiBFbGVtZW50UmVmLFxuICAgIHByaXZhdGUgX2NoYW5nZURldGVjdG9yUmVmOiBDaGFuZ2VEZXRlY3RvclJlZixcbiAgKSB7fVxuXG4gIHByaXZhdGUgX3NldEVsZW1lbnQoZWw6IEVsZW1lbnRSZWYsIHJlZjogYW55LCB1cGRhdGU6IHN0cmluZywga2V5ID0gJ2VsJykge1xuICAgIGlmICghZWwgfHwgIXJlZikge1xuICAgICAgcmV0dXJuO1xuICAgIH1cbiAgICBpZiAocmVmICYmIGVsLm5hdGl2ZUVsZW1lbnQpIHtcbiAgICAgIGlmIChyZWZba2V5XSA9PT0gZWwubmF0aXZlRWxlbWVudCkge1xuICAgICAgICByZXR1cm47XG4gICAgICB9XG4gICAgICByZWZba2V5XSA9IGVsLm5hdGl2ZUVsZW1lbnQ7XG4gICAgfVxuICAgIGNvbnN0IHVwZGF0ZU9iaiA9IHt9O1xuICAgIHVwZGF0ZU9ialt1cGRhdGVdID0gdHJ1ZTtcbiAgICB0aGlzLnVwZGF0ZUluaXRTd2lwZXIodXBkYXRlT2JqKTtcbiAgfVxuICBuZ09uSW5pdCgpOiB2b2lkIHtcbiAgICBjb25zdCB7IHBhcmFtcyB9ID0gZ2V0UGFyYW1zKHRoaXMpO1xuICAgIE9iamVjdC5hc3NpZ24odGhpcywgcGFyYW1zKTtcbiAgfVxuXG4gIG5nQWZ0ZXJWaWV3SW5pdCgpIHtcbiAgICB0aGlzLmNoaWxkcmVuU2xpZGVzSW5pdCgpO1xuICAgIGlmICh0aGlzLmluaXQpIHtcbiAgICAgIHRoaXMuaW5pdFN3aXBlcigpO1xuICAgICAgdGhpcy5fY2hhbmdlRGV0ZWN0b3JSZWYuZGV0ZWN0Q2hhbmdlcygpO1xuICAgIH1cbiAgfVxuXG4gIHByaXZhdGUgY2hpbGRyZW5TbGlkZXNJbml0KCkge1xuICAgIHRoaXMuc2xpZGVzQ2hhbmdlcyh0aGlzLnNsaWRlc0VsKTtcbiAgICB0aGlzLnNsaWRlc0VsLmNoYW5nZXMuc3Vic2NyaWJlKHRoaXMuc2xpZGVzQ2hhbmdlcyk7XG4gIH1cblxuICBwcml2YXRlIHNsaWRlc0NoYW5nZXMgPSAodmFsOiBRdWVyeUxpc3Q8U3dpcGVyU2xpZGVEaXJlY3RpdmU+KSA9PiB7XG4gICAgdGhpcy5zbGlkZXMgPSB2YWwubWFwKChzbGlkZTogU3dpcGVyU2xpZGVEaXJlY3RpdmUsIGluZGV4OiBudW1iZXIpID0+IHtcbiAgICAgIHNsaWRlLnNsaWRlSW5kZXggPSBpbmRleDtcbiAgICAgIHNsaWRlLmNsYXNzTmFtZXMgPSB0aGlzLnNsaWRlQ2xhc3M7XG4gICAgICByZXR1cm4gc2xpZGU7XG4gICAgfSk7XG4gICAgaWYgKHRoaXMubG9vcCAmJiAhdGhpcy5sb29wZWRTbGlkZXMpIHtcbiAgICAgIHRoaXMuY2FsY0xvb3BlZFNsaWRlcygpO1xuICAgIH1cbiAgICBpZiAoIXRoaXMudmlydHVhbCkge1xuICAgICAgdGhpcy5wcmVwZW5kU2xpZGVzID0gb2YodGhpcy5zbGlkZXMuc2xpY2UodGhpcy5zbGlkZXMubGVuZ3RoIC0gdGhpcy5sb29wZWRTbGlkZXMpKTtcbiAgICAgIHRoaXMuYXBwZW5kU2xpZGVzID0gb2YodGhpcy5zbGlkZXMuc2xpY2UoMCwgdGhpcy5sb29wZWRTbGlkZXMpKTtcbiAgICB9XG4gICAgdGhpcy5fY2hhbmdlRGV0ZWN0b3JSZWYuZGV0ZWN0Q2hhbmdlcygpO1xuICAgIHRoaXMuc3dpcGVyUmVmPy51cGRhdGUoKTtcbiAgfTtcblxuICBnZXQgaXNTd2lwZXJBY3RpdmUoKSB7XG4gICAgcmV0dXJuIHRoaXMuc3dpcGVyUmVmICYmICF0aGlzLnN3aXBlclJlZi5kZXN0cm95ZWQ7XG4gIH1cblxuICBpbml0U3dpcGVyKCkge1xuICAgIGNvbnN0IHsgcGFyYW1zOiBzd2lwZXJQYXJhbXMsIHBhc3NlZFBhcmFtcyB9ID0gZ2V0UGFyYW1zKHRoaXMpO1xuICAgIE9iamVjdC5hc3NpZ24odGhpcywgc3dpcGVyUGFyYW1zKTtcbiAgICBzd2lwZXJQYXJhbXMub25BbnkgPSAoZXZlbnQsIC4uLmFyZ3MpID0+IHtcbiAgICAgIGNvbnN0IGVtaXR0ZXIgPSB0aGlzW2BzXyR7ZXZlbnR9YF0gYXMgRXZlbnRFbWl0dGVyPGFueT47XG4gICAgICBpZiAoZW1pdHRlcikge1xuICAgICAgICBlbWl0dGVyLmVtaXQoLi4uYXJncyk7XG4gICAgICB9XG4gICAgfTtcblxuICAgIE9iamVjdC5hc3NpZ24oc3dpcGVyUGFyYW1zLm9uLCB7XG4gICAgICBzbGlkZUNoYW5nZTogKCkgPT4ge1xuICAgICAgICB0aGlzLmluZGV4Q2hhbmdlLmVtaXQodGhpcy5zd2lwZXJSZWYucmVhbEluZGV4KTtcbiAgICAgIH0sXG4gICAgICBfY29udGFpbmVyQ2xhc3Nlcyhzd2lwZXIsIGNsYXNzZXMpIHtcbiAgICAgICAgdGhpcy5jb250YWluZXJDbGFzc2VzID0gY2xhc3NlcztcbiAgICAgIH0sXG4gICAgICBfc3dpcGVyOiAoc3dpcGVyKSA9PiB7XG4gICAgICAgIHRoaXMuc3dpcGVyUmVmID0gc3dpcGVyO1xuICAgICAgICB0aGlzLnNfc3dpcGVyLmVtaXQodGhpcy5zd2lwZXJSZWYpO1xuICAgICAgICBzd2lwZXIubG9vcENyZWF0ZSA9ICgpID0+IHt9O1xuICAgICAgICBzd2lwZXIubG9vcERlc3Ryb3kgPSAoKSA9PiB7fTtcbiAgICAgICAgaWYgKHN3aXBlclBhcmFtcy5sb29wKSB7XG4gICAgICAgICAgc3dpcGVyLmxvb3BlZFNsaWRlcyA9IHRoaXMubG9vcGVkU2xpZGVzO1xuICAgICAgICB9XG4gICAgICAgIGlmIChzd2lwZXIudmlydHVhbCAmJiBzd2lwZXIucGFyYW1zLnZpcnR1YWwuZW5hYmxlZCkge1xuICAgICAgICAgIHN3aXBlci52aXJ0dWFsLnNsaWRlcyA9IHRoaXMuc2xpZGVzO1xuICAgICAgICAgIGNvbnN0IGV4dGVuZFdpdGggPSB7XG4gICAgICAgICAgICBjYWNoZTogZmFsc2UsXG4gICAgICAgICAgICByZW5kZXJFeHRlcm5hbDogKGRhdGEpID0+IHtcbiAgICAgICAgICAgICAgdGhpcy51cGRhdGVWaXJ0dWFsU2xpZGVzKGRhdGEpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHJlbmRlckV4dGVybmFsVXBkYXRlOiBmYWxzZSxcbiAgICAgICAgICB9O1xuICAgICAgICAgIGV4dGVuZChzd2lwZXIucGFyYW1zLnZpcnR1YWwsIGV4dGVuZFdpdGgpO1xuICAgICAgICAgIGV4dGVuZChzd2lwZXIub3JpZ2luYWxQYXJhbXMudmlydHVhbCwgZXh0ZW5kV2l0aCk7XG4gICAgICAgIH1cbiAgICAgICAgdGhpcy5fY2hhbmdlRGV0ZWN0b3JSZWYuZGV0ZWN0Q2hhbmdlcygpO1xuICAgICAgfSxcbiAgICAgIF9zbGlkZUNsYXNzZXM6IChfLCB1cGRhdGVkKSA9PiB7XG4gICAgICAgIHVwZGF0ZWQuZm9yRWFjaCgoeyBzbGlkZUVsLCBjbGFzc05hbWVzIH0sIGluZGV4KSA9PiB7XG4gICAgICAgICAgY29uc3Qgc2xpZGVJbmRleCA9IHBhcnNlSW50KHNsaWRlRWwuZ2V0QXR0cmlidXRlKCdkYXRhLXN3aXBlci1zbGlkZS1pbmRleCcpKSB8fCBpbmRleDtcbiAgICAgICAgICBpZiAodGhpcy52aXJ0dWFsKSB7XG4gICAgICAgICAgICBjb25zdCB2aXJ0dWFsU2xpZGUgPSB0aGlzLnNsaWRlcy5maW5kKChpdGVtKSA9PiB7XG4gICAgICAgICAgICAgIHJldHVybiBpdGVtLnZpcnR1YWxJbmRleCAmJiBpdGVtLnZpcnR1YWxJbmRleCA9PT0gc2xpZGVJbmRleDtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgaWYgKHZpcnR1YWxTbGlkZSkge1xuICAgICAgICAgICAgICB2aXJ0dWFsU2xpZGUuY2xhc3NOYW1lcyA9IGNsYXNzTmFtZXM7XG4gICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG5cbiAgICAgICAgICBpZiAodGhpcy5zbGlkZXNbc2xpZGVJbmRleF0pIHtcbiAgICAgICAgICAgIHRoaXMuc2xpZGVzW3NsaWRlSW5kZXhdLmNsYXNzTmFtZXMgPSBjbGFzc05hbWVzO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgIHRoaXMuX2NoYW5nZURldGVjdG9yUmVmLmRldGVjdENoYW5nZXMoKTtcbiAgICAgIH0sXG4gICAgfSk7XG4gICAgbmV3IFN3aXBlcih0aGlzLmVsZW1lbnRSZWYubmF0aXZlRWxlbWVudCwgc3dpcGVyUGFyYW1zKTtcbiAgfVxuXG4gIHN0eWxlOiBhbnkgPSBudWxsO1xuICBjdXJyZW50VmlydHVhbERhdGE6IGFueTsgLy8gVE9ETzogdHlwZSB2aXJ0dWFsRGF0YTtcbiAgcHJpdmF0ZSB1cGRhdGVWaXJ0dWFsU2xpZGVzKHZpcnR1YWxEYXRhOiBhbnkpIHtcbiAgICAvLyBUT0RPOiB0eXBlIHZpcnR1YWxEYXRhXG4gICAgaWYgKFxuICAgICAgIXRoaXMuc3dpcGVyUmVmIHx8XG4gICAgICAodGhpcy5jdXJyZW50VmlydHVhbERhdGEgJiZcbiAgICAgICAgdGhpcy5jdXJyZW50VmlydHVhbERhdGEuZnJvbSA9PT0gdmlydHVhbERhdGEuZnJvbSAmJlxuICAgICAgICB0aGlzLmN1cnJlbnRWaXJ0dWFsRGF0YS50byA9PT0gdmlydHVhbERhdGEudG8gJiZcbiAgICAgICAgdGhpcy5jdXJyZW50VmlydHVhbERhdGEub2Zmc2V0ID09PSB2aXJ0dWFsRGF0YS5vZmZzZXQpXG4gICAgKSB7XG4gICAgICByZXR1cm47XG4gICAgfVxuICAgIHRoaXMuc3R5bGUgPSB0aGlzLnN3aXBlclJlZi5pc0hvcml6b250YWwoKVxuICAgICAgPyB7XG4gICAgICAgICAgW3RoaXMuc3dpcGVyUmVmLnJ0bFRyYW5zbGF0ZSA/ICdyaWdodCcgOiAnbGVmdCddOiBgJHt2aXJ0dWFsRGF0YS5vZmZzZXR9cHhgLFxuICAgICAgICB9XG4gICAgICA6IHtcbiAgICAgICAgICB0b3A6IGAke3ZpcnR1YWxEYXRhLm9mZnNldH1weGAsXG4gICAgICAgIH07XG4gICAgdGhpcy5jdXJyZW50VmlydHVhbERhdGEgPSB2aXJ0dWFsRGF0YTtcbiAgICB0aGlzLl9hY3RpdmVTbGlkZXMubmV4dCh2aXJ0dWFsRGF0YS5zbGlkZXMpO1xuICAgIHRoaXMuX2NoYW5nZURldGVjdG9yUmVmLmRldGVjdENoYW5nZXMoKTtcbiAgICB0aGlzLnN3aXBlclJlZi51cGRhdGVTbGlkZXMoKTtcbiAgICB0aGlzLnN3aXBlclJlZi51cGRhdGVQcm9ncmVzcygpO1xuICAgIHRoaXMuc3dpcGVyUmVmLnVwZGF0ZVNsaWRlc0NsYXNzZXMoKTtcbiAgICBpZiAodGhpcy5zd2lwZXJSZWYubGF6eSAmJiB0aGlzLnN3aXBlclJlZi5wYXJhbXMubGF6eVsnZW5hYmxlZCddKSB7XG4gICAgICB0aGlzLnN3aXBlclJlZi5sYXp5LmxvYWQoKTtcbiAgICB9XG4gICAgdGhpcy5zd2lwZXJSZWYudmlydHVhbC51cGRhdGUodHJ1ZSk7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgbmdPbkNoYW5nZXMoY2hhbmdlZFBhcmFtczogU2ltcGxlQ2hhbmdlcykge1xuICAgIHRoaXMudXBkYXRlU3dpcGVyKGNoYW5nZWRQYXJhbXMpO1xuICAgIHRoaXMuX2NoYW5nZURldGVjdG9yUmVmLmRldGVjdENoYW5nZXMoKTtcbiAgfVxuXG4gIHVwZGF0ZUluaXRTd2lwZXIoY2hhbmdlZFBhcmFtcykge1xuICAgIGlmICghKGNoYW5nZWRQYXJhbXMgJiYgdGhpcy5zd2lwZXJSZWYgJiYgIXRoaXMuc3dpcGVyUmVmLmRlc3Ryb3llZCkpIHtcbiAgICAgIHJldHVybjtcbiAgICB9XG4gICAgY29uc3Qge1xuICAgICAgcGFyYW1zOiBjdXJyZW50UGFyYW1zLFxuICAgICAgcGFnaW5hdGlvbixcbiAgICAgIG5hdmlnYXRpb24sXG4gICAgICBzY3JvbGxiYXIsXG4gICAgICB2aXJ0dWFsLFxuICAgICAgdGh1bWJzLFxuICAgIH0gPSB0aGlzLnN3aXBlclJlZjtcblxuICAgIGlmIChjaGFuZ2VkUGFyYW1zLnBhZ2luYXRpb24pIHtcbiAgICAgIGlmIChcbiAgICAgICAgdGhpcy5wYWdpbmF0aW9uICYmXG4gICAgICAgIHR5cGVvZiB0aGlzLnBhZ2luYXRpb24gIT09ICdib29sZWFuJyAmJlxuICAgICAgICB0aGlzLnBhZ2luYXRpb24uZWwgJiZcbiAgICAgICAgcGFnaW5hdGlvbiAmJlxuICAgICAgICAhcGFnaW5hdGlvbi5lbFxuICAgICAgKSB7XG4gICAgICAgIHRoaXMudXBkYXRlUGFyYW1ldGVyKCdwYWdpbmF0aW9uJywgdGhpcy5wYWdpbmF0aW9uKTtcbiAgICAgICAgcGFnaW5hdGlvbi5pbml0KCk7XG4gICAgICAgIHBhZ2luYXRpb24ucmVuZGVyKCk7XG4gICAgICAgIHBhZ2luYXRpb24udXBkYXRlKCk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICBwYWdpbmF0aW9uLmRlc3Ryb3koKTtcbiAgICAgICAgcGFnaW5hdGlvbi5lbCA9IG51bGw7XG4gICAgICB9XG4gICAgfVxuXG4gICAgaWYgKGNoYW5nZWRQYXJhbXMuc2Nyb2xsYmFyKSB7XG4gICAgICBpZiAoXG4gICAgICAgIHRoaXMuc2Nyb2xsYmFyICYmXG4gICAgICAgIHR5cGVvZiB0aGlzLnNjcm9sbGJhciAhPT0gJ2Jvb2xlYW4nICYmXG4gICAgICAgIHRoaXMuc2Nyb2xsYmFyLmVsICYmXG4gICAgICAgIHNjcm9sbGJhciAmJlxuICAgICAgICAhc2Nyb2xsYmFyLmVsXG4gICAgICApIHtcbiAgICAgICAgdGhpcy51cGRhdGVQYXJhbWV0ZXIoJ3Njcm9sbGJhcicsIHRoaXMuc2Nyb2xsYmFyKTtcbiAgICAgICAgc2Nyb2xsYmFyLmluaXQoKTtcbiAgICAgICAgc2Nyb2xsYmFyLnVwZGF0ZVNpemUoKTtcbiAgICAgICAgc2Nyb2xsYmFyLnNldFRyYW5zbGF0ZSgpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgc2Nyb2xsYmFyLmRlc3Ryb3koKTtcbiAgICAgICAgc2Nyb2xsYmFyLmVsID0gbnVsbDtcbiAgICAgIH1cbiAgICB9XG5cbiAgICBpZiAoY2hhbmdlZFBhcmFtcy5uYXZpZ2F0aW9uKSB7XG4gICAgICBpZiAoXG4gICAgICAgIHRoaXMubmF2aWdhdGlvbiAmJlxuICAgICAgICB0eXBlb2YgdGhpcy5uYXZpZ2F0aW9uICE9PSAnYm9vbGVhbicgJiZcbiAgICAgICAgdGhpcy5uYXZpZ2F0aW9uLnByZXZFbCAmJlxuICAgICAgICB0aGlzLm5hdmlnYXRpb24ubmV4dEVsICYmXG4gICAgICAgIG5hdmlnYXRpb24gJiZcbiAgICAgICAgIW5hdmlnYXRpb24ucHJldkVsICYmXG4gICAgICAgICFuYXZpZ2F0aW9uLm5leHRFbFxuICAgICAgKSB7XG4gICAgICAgIHRoaXMudXBkYXRlUGFyYW1ldGVyKCduYXZpZ2F0aW9uJywgdGhpcy5uYXZpZ2F0aW9uKTtcbiAgICAgICAgbmF2aWdhdGlvbi5pbml0KCk7XG4gICAgICAgIG5hdmlnYXRpb24udXBkYXRlKCk7XG4gICAgICB9IGVsc2UgaWYgKG5hdmlnYXRpb24ucHJldkVsICYmIG5hdmlnYXRpb24ubmV4dEVsKSB7XG4gICAgICAgIG5hdmlnYXRpb24uZGVzdHJveSgpO1xuICAgICAgICBuYXZpZ2F0aW9uLm5leHRFbCA9IG51bGw7XG4gICAgICAgIG5hdmlnYXRpb24ucHJldkVsID0gbnVsbDtcbiAgICAgIH1cbiAgICB9XG4gICAgaWYgKGNoYW5nZWRQYXJhbXMudGh1bWJzICYmIHRoaXMudGh1bWJzICYmIHRoaXMudGh1bWJzLnN3aXBlcikge1xuICAgICAgdGhpcy51cGRhdGVQYXJhbWV0ZXIoJ3RodW1icycsIHRoaXMudGh1bWJzKTtcbiAgICAgIGNvbnN0IGluaXRpYWxpemVkID0gdGh1bWJzLmluaXQoKTtcbiAgICAgIGlmIChpbml0aWFsaXplZCkgdGh1bWJzLnVwZGF0ZSh0cnVlKTtcbiAgICB9XG5cbiAgICBpZiAoY2hhbmdlZFBhcmFtcy5jb250cm9sbGVyICYmIHRoaXMuY29udHJvbGxlciAmJiB0aGlzLmNvbnRyb2xsZXIuY29udHJvbCkge1xuICAgICAgdGhpcy5zd2lwZXJSZWYuY29udHJvbGxlci5jb250cm9sID0gdGhpcy5jb250cm9sbGVyLmNvbnRyb2w7XG4gICAgfVxuXG4gICAgdGhpcy5zd2lwZXJSZWYudXBkYXRlKCk7XG4gIH1cblxuICB1cGRhdGVTd2lwZXIoY2hhbmdlZFBhcmFtczogU2ltcGxlQ2hhbmdlcyB8IGFueSkge1xuICAgIGlmIChjaGFuZ2VkUGFyYW1zLmNvbmZpZykge1xuICAgICAgcmV0dXJuO1xuICAgIH1cbiAgICBpZiAoIShjaGFuZ2VkUGFyYW1zICYmIHRoaXMuc3dpcGVyUmVmICYmICF0aGlzLnN3aXBlclJlZi5kZXN0cm95ZWQpKSB7XG4gICAgICByZXR1cm47XG4gICAgfVxuICAgIGZvciAoY29uc3Qga2V5IGluIGNoYW5nZWRQYXJhbXMpIHtcbiAgICAgIGlmIChpZ25vcmVOZ09uQ2hhbmdlcy5pbmRleE9mKGtleSkgPj0gMCkge1xuICAgICAgICBjb250aW51ZTtcbiAgICAgIH1cbiAgICAgIGNvbnN0IG5ld1ZhbHVlID0gY2hhbmdlZFBhcmFtc1trZXldPy5jdXJyZW50VmFsdWUgPz8gY2hhbmdlZFBhcmFtc1trZXldO1xuICAgICAgdGhpcy51cGRhdGVQYXJhbWV0ZXIoa2V5LCBuZXdWYWx1ZSk7XG4gICAgfVxuXG4gICAgaWYgKGNoYW5nZWRQYXJhbXMuYWxsb3dTbGlkZU5leHQpIHtcbiAgICAgIHRoaXMuc3dpcGVyUmVmLmFsbG93U2xpZGVOZXh0ID0gdGhpcy5hbGxvd1NsaWRlTmV4dDtcbiAgICB9XG4gICAgaWYgKGNoYW5nZWRQYXJhbXMuYWxsb3dTbGlkZVByZXYpIHtcbiAgICAgIHRoaXMuc3dpcGVyUmVmLmFsbG93U2xpZGVQcmV2ID0gdGhpcy5hbGxvd1NsaWRlUHJldjtcbiAgICB9XG4gICAgaWYgKGNoYW5nZWRQYXJhbXMuZGlyZWN0aW9uKSB7XG4gICAgICB0aGlzLnN3aXBlclJlZi5jaGFuZ2VEaXJlY3Rpb24odGhpcy5kaXJlY3Rpb24sIGZhbHNlKTtcbiAgICB9XG4gICAgaWYgKGNoYW5nZWRQYXJhbXMuYnJlYWtwb2ludHMpIHtcbiAgICAgIGlmICh0aGlzLmxvb3AgJiYgIXRoaXMubG9vcGVkU2xpZGVzKSB7XG4gICAgICAgIHRoaXMuY2FsY0xvb3BlZFNsaWRlcygpO1xuICAgICAgfVxuICAgICAgdGhpcy5zd2lwZXJSZWYuY3VycmVudEJyZWFrcG9pbnQgPSBudWxsO1xuICAgICAgdGhpcy5zd2lwZXJSZWYuc2V0QnJlYWtwb2ludCgpO1xuICAgIH1cbiAgICB0aGlzLnN3aXBlclJlZi51cGRhdGUoKTtcbiAgfVxuXG4gIGNhbGNMb29wZWRTbGlkZXMoKSB7XG4gICAgaWYgKCF0aGlzLmxvb3ApIHtcbiAgICAgIHJldHVybjtcbiAgICB9XG4gICAgbGV0IHNsaWRlc1BlclZpZXdQYXJhbXMgPSB0aGlzLnNsaWRlc1BlclZpZXc7XG4gICAgaWYgKHRoaXMuYnJlYWtwb2ludHMpIHtcbiAgICAgIGNvbnN0IGJyZWFrcG9pbnQgPSBTd2lwZXIucHJvdG90eXBlLmdldEJyZWFrcG9pbnQodGhpcy5icmVha3BvaW50cyk7XG4gICAgICBjb25zdCBicmVha3BvaW50T25seVBhcmFtcyA9XG4gICAgICAgIGJyZWFrcG9pbnQgaW4gdGhpcy5icmVha3BvaW50cyA/IHRoaXMuYnJlYWtwb2ludHNbYnJlYWtwb2ludF0gOiB1bmRlZmluZWQ7XG4gICAgICBpZiAoYnJlYWtwb2ludE9ubHlQYXJhbXMgJiYgYnJlYWtwb2ludE9ubHlQYXJhbXMuc2xpZGVzUGVyVmlldykge1xuICAgICAgICBzbGlkZXNQZXJWaWV3UGFyYW1zID0gYnJlYWtwb2ludE9ubHlQYXJhbXMuc2xpZGVzUGVyVmlldztcbiAgICAgIH1cbiAgICB9XG4gICAgaWYgKHNsaWRlc1BlclZpZXdQYXJhbXMgPT09ICdhdXRvJykge1xuICAgICAgdGhpcy5sb29wZWRTbGlkZXMgPSB0aGlzLnNsaWRlcy5sZW5ndGg7XG4gICAgICByZXR1cm4gdGhpcy5zbGlkZXMubGVuZ3RoO1xuICAgIH1cbiAgICBsZXQgbG9vcGVkU2xpZGVzID0gdGhpcy5sb29wZWRTbGlkZXMgfHwgc2xpZGVzUGVyVmlld1BhcmFtcztcblxuICAgIGxvb3BlZFNsaWRlcyArPSB0aGlzLmxvb3BBZGRpdGlvbmFsU2xpZGVzO1xuXG4gICAgaWYgKGxvb3BlZFNsaWRlcyA+IHRoaXMuc2xpZGVzLmxlbmd0aCkge1xuICAgICAgbG9vcGVkU2xpZGVzID0gdGhpcy5zbGlkZXMubGVuZ3RoO1xuICAgIH1cbiAgICB0aGlzLmxvb3BlZFNsaWRlcyA9IGxvb3BlZFNsaWRlcztcbiAgICByZXR1cm4gbG9vcGVkU2xpZGVzO1xuICB9XG5cbiAgdXBkYXRlUGFyYW1ldGVyKGtleSwgdmFsdWUpIHtcbiAgICBpZiAoISh0aGlzLnN3aXBlclJlZiAmJiAhdGhpcy5zd2lwZXJSZWYuZGVzdHJveWVkKSkge1xuICAgICAgcmV0dXJuO1xuICAgIH1cbiAgICBjb25zdCBfa2V5ID0ga2V5LnJlcGxhY2UoL15fLywgJycpO1xuICAgIGlmIChPYmplY3Qua2V5cyh0aGlzLnN3aXBlclJlZi5tb2R1bGVzKS5pbmRleE9mKF9rZXkpID49IDApIHtcbiAgICAgIGV4dGVuZCh2YWx1ZSwgdGhpcy5zd2lwZXJSZWYubW9kdWxlc1tfa2V5XS5wYXJhbXNbX2tleV0pO1xuICAgIH1cbiAgICBpZiAoaXNPYmplY3QodGhpcy5zd2lwZXJSZWYucGFyYW1zW19rZXldKSAmJiBpc09iamVjdCh2YWx1ZSkpIHtcbiAgICAgIGV4dGVuZCh0aGlzLnN3aXBlclJlZi5wYXJhbXNbX2tleV0sIHZhbHVlKTtcbiAgICB9IGVsc2Uge1xuICAgICAgdGhpcy5zd2lwZXJSZWYucGFyYW1zW19rZXldID0gdmFsdWU7XG4gICAgfVxuICB9XG5cbiAgc2V0SW5kZXgoaW5kZXg6IG51bWJlciwgc3BlZWQ/OiBudW1iZXIsIHNpbGVudD86IGJvb2xlYW4pOiB2b2lkIHtcbiAgICBpZiAoIXRoaXMuaXNTd2lwZXJBY3RpdmUpIHtcbiAgICAgIHRoaXMuaW5pdGlhbFNsaWRlID0gaW5kZXg7XG4gICAgICByZXR1cm47XG4gICAgfVxuICAgIGlmIChpbmRleCA9PT0gdGhpcy5zd2lwZXJSZWYuYWN0aXZlSW5kZXgpIHtcbiAgICAgIHJldHVybjtcbiAgICB9XG4gICAgdGhpcy56b25lLnJ1bk91dHNpZGVBbmd1bGFyKCgpID0+IHtcbiAgICAgIGlmICh0aGlzLmxvb3ApIHtcbiAgICAgICAgdGhpcy5zd2lwZXJSZWYuc2xpZGVUb0xvb3AoaW5kZXgsIHNwZWVkLCAhc2lsZW50KTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIHRoaXMuc3dpcGVyUmVmLnNsaWRlVG8oaW5kZXgsIHNwZWVkLCAhc2lsZW50KTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfVxuXG4gIG5nT25EZXN0cm95KCkge1xuICAgIHRoaXMuc3dpcGVyUmVmPy5kZXN0cm95KCk7XG4gIH1cbn1cbiJdfQ==