(function ($) {
	"use strict";
	$(window).on("load", function () {
		//Preloader
		$("#status").fadeOut();
		$("#preloader").delay(350).fadeOut("slow");
	});
	
	//Cookiebar
	$(function(){
		$.cookieBar({
			message: 'This website uses cookies to ensure you get the best experience on our website.', //Message displayed on bar
			acceptButton: true, //Set to true to show accept/enable button
			acceptText: 'I Understand', //Text on accept/enable button
			acceptFunction: function(cookieValue){if(cookieValue!='enabled' && cookieValue!='accepted') window.location = window.location.href;}, //Function to run after accept
			declineButton: true, //Set to true to show decline/disable button
			declineText: 'Disable Cookies', //Text on decline/disable button
			declineFunction: function(cookieValue){if(cookieValue=='enabled' || cookieValue=='accepted') window.location = window.location.href;}, //Function to run after decline
			policyButton: false, //Set to true to show Privacy Policy button
			policyText: 'Privacy Policy', //Text on Privacy Policy button
			policyURL: '/privacy-policy/', //URL of Privacy Policy
			autoEnable: true, //Set to true for cookies to be accepted automatically. Banner still shows
			acceptOnContinue: false, //Set to true to accept cookies when visitor moves to another page
			acceptOnScroll: false, //Set to true to accept cookies when visitor scrolls X pixels up or down
			acceptAnyClick: false, //Set to true to accept cookies when visitor clicks anywhere on the page
			expireDays: 365, //Number of days for cookieBar cookie to be stored for
			renewOnVisit: false, //Renew the cookie upon revisit to website
			forceShow: false, //Force cookieBar to show regardless of user cookie preference
			effect: 'slide', //Options: slide, fade, hide
			element: 'body', //Element to append/prepend cookieBar to. Remember "." for class or "#" for id.
			append: false, //Set to true for cookieBar HTML to be placed at base of website. Actual position may change according to CSS
			fixed: true, //Set to true to add the class "fixed" to the cookie bar. Default CSS should fix the position
			bottom: true //Force CSS when fixed, so bar appears at bottom of website
		});
	});
	
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
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
	});

	//Waypoints
	function onScrollInit(items, trigger) {
		items.each(function () {
			var osElement = $(this),
				osAnimationClass = osElement.attr('data-os-animation'),
				osAnimationDelay = osElement.attr('data-os-animation-delay');

			osElement.css({
				'-webkit-animation-delay': osAnimationDelay,
				'-moz-animation-delay': osAnimationDelay,
				'animation-delay': osAnimationDelay
			});

			var osTrigger = (trigger) ? trigger : osElement;

			osTrigger.waypoint(function () {
				osElement.addClass('animated').addClass(osAnimationClass);
			}, {
				triggerOnce: true,
				offset: '90%'
			});
		});
	}

	onScrollInit($('.os-animation'));
	onScrollInit($('.staggered-animation'), $('.staggered-animation-container'));

	//Dropdown menu
	$(function () {
		$(".dropdown").hover(
			function () {
				$('.dropdown-menu', this).stop(true, true).delay(200).fadeIn(500);
				$(this).toggleClass('open');
				$('b', this).toggleClass("caret caret-up");
			},
			function () {
				$('.dropdown-menu', this).stop(true, true).delay(200).fadeOut(500);
				$(this).toggleClass('open');
				$('b', this).toggleClass("caret caret-up");
			});
	});
	
    //Back To Top
	$(function () {
		// Show or hide the sticky footer button
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('.go-top').fadeIn(500);
			} else {
				$('.go-top').fadeOut(500);
			}
		});

		// Animate the scroll to top
		$('.go-top').click(function (event) {
			event.preventDefault();

			$('html, body').animate({
				scrollTop: 0
			}, 1000);
		})
	});

})(jQuery);