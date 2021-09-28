"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

let div = document.createElement('div');
div.style.overflowY = 'scroll';
div.style.width = '50px';
div.style.height = '50px'; // мы должны вставить элемент в документ, иначе размеры будут равны 0

document.body.append(div);
let scrollWidth = div.offsetWidth - div.clientWidth;
let root = document.documentElement;
root.style.setProperty('--spacing-end', scrollWidth + 'px');
div.remove();
const JSCCommon = {
	btnToggleMenuMobile: [].slice.call(document.querySelectorAll(".toggle-menu-mobile--js")),
	menuMobile: document.querySelector(".menu-mobile--js"),
	menuMobileLink: [].slice.call(document.querySelectorAll(".menu-mobile--js ul li a")),

	modalCall() {
		const link = ".link-modal-js";
		Fancybox.bind(link, {
			autoFocus: false,
			// arrows: false,
			// infobar: false,
			// touch: false,
			// infinite: false,
			// dragToClose: false,
			type: 'inline'
		}); // $(link).fancybox({
		// });

		$(".modal-close-js").click(function () {
			Fancybox.close();
		}); // fancybox.defaults.backFocus = false;

		const linkModal = document.querySelectorAll(link);

		function addData() {
			linkModal.forEach(element => {
				element.addEventListener('click', () => {
					let modal = document.querySelector(element.getAttribute("href"));
					const data = element.dataset;

					function setValue(val, elem) {
						if (elem && val) {
							const el = modal.querySelector(elem);
							el.tagName == "INPUT" ? el.value = val : el.innerHTML = val; // console.log(modal.querySelector(elem).tagName)
						}
					}

					setValue(data.title, '.ttu');
					setValue(data.text, '.after-headline');
					setValue(data.btn, '.btn');
					setValue(data.order, '.order');
				});
			});
		}

		if (linkModal) addData();
	},

	// /modalCall
	toggleMenu() {
		const toggle = this.btnToggleMenuMobile;
		const menu = this.menuMobile;
		document.addEventListener("click", function (event) {
			const toggleEv = event.target.closest(".toggle-menu-mobile--js");
			if (!toggleEv) return;
			toggle.forEach(el => el.classList.toggle("on"));
			menu.classList.toggle("active");
			[document.body, document.querySelector('html')].forEach(el => el.classList.toggle("fixed"));
		}, {
			passive: true
		});
	},

	closeMenu() {
		let menu = this.menuMobile;
		if (!menu) return;

		if (menu.classList.contains("active")) {
			this.btnToggleMenuMobile.forEach(element => element.classList.remove("on"));
			this.menuMobile.classList.remove("active");
			[document.body, document.querySelector('html')].forEach(el => el.classList.remove("fixed"));
		}
	},

	mobileMenu() {
		if (!this.menuMobileLink) return;
		this.toggleMenu();
		document.addEventListener('mouseup', event => {
			let container = event.target.closest(".menu-mobile--js.active"); // (1)

			let link = event.target.closest(".menu-mobile .menu a"); // (1)

			let toggle = event.target.closest('.toggle-menu-mobile--js.on'); // (1)

			if (!container && !toggle) this.closeMenu();
		}, {
			passive: true
		});
		window.addEventListener('resize', () => {
			if (window.matchMedia("(min-width: 992px)").matches) this.closeMenu();
		}, {
			passive: true
		});
	},

	// /mobileMenu
	// tabs  .
	tabscostume(tab) {
		const tabs = document.querySelectorAll(tab); // const indexOf = element => Array.from(element.parentNode.children).indexOf(element);
		// tabs.forEach(element => {
		// 	let tabs = element;
		// 	const tabsCaption = tabs.querySelector(".tabs__caption");
		// 	const tabsBtn = tabsCaption.querySelectorAll(".tabs__btn");
		// 	const tabsWrap = tabs.querySelector(".tabs__wrap");
		// 	const tabsContent = tabsWrap.querySelectorAll(".tabs__content");
		// 	const random = Math.trunc(Math.random() * 1000);
		// 	tabsBtn.forEach((el, index) => {
		// 		const data = `tab-content-${random}-${index}`;
		// 		el.dataset.tabBtn = data;
		// 		const content = tabsContent[index];
		// 		content.dataset.tabContent = data;
		// 		if (!content.dataset.tabContent == data) return;
		// 		const active = content.classList.contains('active') ? 'active' : '';
		// 		// console.log(el.innerHTML);
		// 		content.insertAdjacentHTML("beforebegin", `<div class="tabs__btn-accordion  btn btn-primary  mb-1 ${active}" data-tab-btn="${data}">${el.innerHTML}</div>`)
		// 	})
		// 	tabs.addEventListener('click', function (element) {
		// 		const btn = element.target.closest(`[data-tab-btn]:not(.active)`);
		// 		if (!btn) return;
		// 		const data = btn.dataset.tabBtn;
		// 		const tabsAllBtn = this.querySelectorAll(`[data-tab-btn`);
		// 		const content = this.querySelectorAll(`[data-tab-content]`);
		// 		tabsAllBtn.forEach(element => {
		// 			element.dataset.tabBtn == data
		// 				? element.classList.add('active')
		// 				: element.classList.remove('active')
		// 		});
		// 		content.forEach(element => {
		// 			element.dataset.tabContent == data
		// 				? (element.classList.add('active'), element.previousSibling.classList.add('active'))
		// 				: element.classList.remove('active')
		// 		});
		// 	})
		// })

		$('.' + tab + '__caption').on('click', '.' + tab + '__btn:not(.active)', function (e) {
			$(this).addClass('active').siblings().removeClass('active').closest('.' + tab).find('.' + tab + '__content').hide().removeClass('active').eq($(this).index()).fadeIn().addClass('active');
		});
	},

	// /tabs
	inputMask() {
		// mask for input
		let InputTel = [].slice.call(document.querySelectorAll('input[type="tel"]'));
		InputTel.forEach(element => element.setAttribute("pattern", "[+][0-9]{1}[(][0-9]{3}[)][0-9]{3}-[0-9]{2}-[0-9]{2}"));
		Inputmask("+9(999)999-99-99").mask(InputTel);
	},

	// /inputMask
	ifie() {
		var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;

		if (isIE11) {
			document.body.insertAdjacentHTML("beforeend", '<div class="browsehappy">	<p class=" container">К сожалению, вы используете устаревший браузер. Пожалуйста, <a href="http://browsehappy.com/" target="_blank">обновите ваш браузер</a>, чтобы улучшить производительность, качество отображаемого материала и повысить безопасность.</p></div>');
		}
	},

	heightwindow() {
		// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
		let vh = window.innerHeight * 0.01; // Then we set the value in the --vh custom property to the root of the document

		document.documentElement.style.setProperty('--vh', "".concat(vh, "px")); // We listen to the resize event

		window.addEventListener('resize', () => {
			// We execute the same script as before
			let vh = window.innerHeight * 0.01;
			document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
		}, {
			passive: true
		});
	},

	animateScroll() {
		$(document).on('click', " .menu li a, .scroll-link", function () {
			const elementClick = $(this).attr("href");

			if (!document.querySelector(elementClick)) {
				$(this).attr("href", '/' + elementClick);
			} else {
				let destination = $(elementClick).offset().top;
				$('html, body').animate({
					scrollTop: destination - 80
				}, 0);
				return false;
			}
		});
	},

	getCurrentYear(el) {
		let now = new Date();
		let currentYear = document.querySelector(el);
		if (currentYear) currentYear.innerText = now.getFullYear();
	},

	toggleShow(toggle, drop) {
		let catalogDrop = drop;
		let catalogToggle = toggle;
		$(document).on('click', catalogToggle, function () {
			$(this).toggleClass('active');
			$(catalogDrop).slideToggle('fast', function () {
				$(this).toggleClass("active");
			});
		});
		document.addEventListener('mouseup', event => {
			let container = event.target.closest(catalogDrop + ".active"); // (1)

			let link = event.target.closest(catalogToggle); // (1)

			if (!container && $(catalogDrop)[0].classList.contains('active') && !link) {
				// console.log(catalogDrop);
				$(catalogDrop).removeClass('active').slideUp();
				$(catalogToggle).removeClass('active');
			}

			;
		}, {
			passive: true
		});
	}

};
const $ = jQuery;

function eventHandler() {
	// JSCCommon.ifie();
	JSCCommon.modalCall();
	JSCCommon.tabscostume('tabs');
	JSCCommon.mobileMenu();
	JSCCommon.inputMask(); // JSCCommon.sendForm();
	// JSCCommon.heightwindow();

	JSCCommon.toggleShow(".toggle-contact-mobile--js", '.header__contact-dropdown--js'); // JSCCommon.animateScroll();
	// JSCCommon.CustomInputFile(); 

	var x = window.location.host;
	let screenName;
	screenName = document.body.dataset.bg;

	if (screenName && x.includes("localhost:30")) {
		document.body.insertAdjacentHTML("beforeend", "<div class=\"pixel-perfect\" style=\"background-image: url(screen/".concat(screenName, ");\"></div>"));
	}

	function setFixedNav() {
		let topNav = document.querySelector('.top-nav  ');
		if (!topNav) return;
		window.scrollY > 0 ? topNav.classList.add('fixed') : topNav.classList.remove('fixed');
	}

	function whenResize() {
		setFixedNav();
	}

	window.addEventListener('scroll', () => {
		setFixedNav();
	}, {
		passive: true
	});
	window.addEventListener('resize', () => {
		whenResize();
	}, {
		passive: true
	});
	whenResize();
	let defaultSl = {
		spaceBetween: 0,
		lazy: {
			loadPrevNext: true
		},
		watchOverflow: true,
		spaceBetween: 0,
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev'
		},
		pagination: {
			el: ' .swiper-pagination',
			type: 'bullets',
			clickable: true // renderBullet: function (index, className) {
			// 	return '<span class="' + className + '">' + (index + 1) + '</span>';
			// }

		}
	};
	const swiper4 = new Swiper('.sBanners__slider--js', _objectSpread(_objectSpread({}, defaultSl), {}, {
		slidesPerView: 'auto',
		freeMode: true,
		loopFillGroupWithBlank: true,
		touchRatio: 0.2,
		slideToClickedSlide: true,
		freeModeMomentum: true
	}));
	const sSimilarSlider = new Swiper('.sSimilar__slider--js', _objectSpread(_objectSpread({}, defaultSl), {}, {
		slidesPerView: 2,
		spaceBetween: 12,
		// slidesPerView: 'auto',
		// freeMode: true,
		loopFillGroupWithBlank: true,
		touchRatio: 0.5,
		slideToClickedSlide: true,
		// freeModeMomentum: true,
		navigation: {
			nextEl: '.section-title__arrows .swiper-button-next',
			prevEl: '.section-title__arrows .swiper-button-prev'
		},
		breakpoints: {
			768: {
				slidesPerView: 3,
				spaceBetween: 24
			},
			992: {
				slidesPerView: 3,
				spaceBetween: 16
			},
			1200: {
				slidesPerView: 3,
				spaceBetween: 20
			}
		}
	}));
	var sCardSliderThumbs = new Swiper(".sCard__slider-thumbs--js", {
		spaceBetween: 10,
		direction: "vertical",
		slidesPerView: 5,
		watchOverflow: true,
		// freeMode: true,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		lazy: {
			loadPrevNext: true
		},
		breakpoints: {
			768: {
				direction: "horizontal"
			}
		}
	});
	var sCardSlider = new Swiper(".sCard__slider--js", {
		spaceBetween: 10,
		watchOverflow: true,
		lazy: {
			loadPrevNext: true
		},
		thumbs: {
			swiper: sCardSliderThumbs,
			watchOverflow: true
		}
	});
	var breadcrumbSlider = new Swiper(".breadcrumb-slider--js", {
		slidesPerView: 'auto'
	});
	var tabsSlider = new Swiper(".tabs__slider--js", {
		slidesPerView: 'auto',
		spaceBetween: 18
	});
	$(".sCard .btn-more").click(function () {
		let th = $(this);

		if (th.text() == "Показать еще") {
			$(".sCard__row-item:hidden").slideDown().addClass("shown");
			th.text("Свернуть");
		} else {
			$(".sCard__row-item.shown").slideUp().removeClass("shown");
			th.text("Показать еще");
		}

		;
	});
	$(".sReadMore__text").readall({
		showheight: null,
		showrows: 8,
		btnTextShowmore: 'Показать еще',
		btnTextShowless: 'Свернуть',
		btnClassShowmore: 'btn-more',
		btnClassShowless: 'btn-more'
	});
	$(".modal-cookies__is-close").click(function () {
		$(this).parent().hide();
	});
	$(".btn-primary, .btn-js").each(function () {
		var B = $(this);
		var A, C, z, D;
		setInterval(function () {
			if (B.find(".animate-js").length === 0) {
				B.prepend("<span class='animate-js'></span>");
			}

			A = B.find(".animate-js");
			A.removeClass("btn_animate");

			if (!A.height() && !A.width()) {
				C = Math.max(B.outerWidth(), B.outerHeight());
				A.css({
					height: C,
					width: C
				});
			}

			z = Math.round(Math.random() * A.width() - A.width() / 2);
			D = Math.round(Math.random() * A.height() - A.height() / 2);
			A.css({
				top: D + "px",
				left: z + "px"
			}).addClass("btn_animate");
		}, 3000);
	});
	var Sticky = new hcSticky('.list-block', {
		stickTo: '.container--main',
		top: 20
	});
	var Sticky2 = new hcSticky('.page-body04__help', {
		stickTo: '.page-body04 .col--help',
		top: 20
	});
	$('.btn-close-js').click(function () {
		$(this).parent().find('.input-search').val(" ");
	});
}

;

if (document.readyState !== 'loading') {
	eventHandler();
} else {
	document.addEventListener('DOMContentLoaded', eventHandler);
}

sessionStorage.setItem('key', 1); // Получение данных из sessionStorage

var data = sessionStorage.getItem('key'); // document.body.classList.add('loaded_hiding');

window.onload = function () {
	if (!data == 1) {
		window.setTimeout(function () {
			document.body.classList.add('loaded');
			var wow = new WOW({
				mobile: false,
				animateClass: 'animate__animated'
			});
			wow.init();
		}, 500);
	} else {
		document.body.classList.remove('loaded_hiding');
		var wow = new WOW({
			mobile: false,
			animateClass: 'animate__animated'
		});
		wow.init();
	}
};

if (document.querySelector("#map")) {
	ymaps.ready(function () {
		var myMap = new ymaps.Map('map', {
			center: [55.724555, 52.444616],
			zoom: 14,
			controls: ['zoomControl']
		}, {//searchControlProvider: 'yandex#search'
		}),
				// Создаём макет содержимого.
		// MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
		// 		'<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
		// ),
		myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
			hintContent: 'Собственный значок метки',
			balloonContent: 'Это красивая метка'
		}, {
			// Опции.
			// Необходимо указать данный тип макета.
			iconLayout: 'default#image',
			// Своё изображение иконки метки.
			iconImageHref: 'img/svg/mark.svg',
			// Размеры метки.
			iconImageSize: [30, 42],
			// Смещение левого верхнего угла иконки относительно
			// её "ножки" (точки привязки).
			iconImageOffset: [-5, -38]
		});
		myMap.behaviors.disable('scrollZoom'); //на мобильных устройствах... (проверяем по userAgent браузера)

		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			//... отключаем перетаскивание карты
			myMap.behaviors.disable('drag');
		}

		myMap.geoObjects.add(myPlacemark);
	});
}