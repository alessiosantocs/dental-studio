(function( root, $, undefined ) {
	"use strict";

	$(function () {
		// DOM ready, take it away

		$("li.dropdown>a").attr("data-toggle", "dropdown").dropdown();

		var activeMenusLength = $(".navbar-dental-studio-site-areas li.current_page_item, .navbar-dental-studio-site-areas li.current-menu-item, .navbar-dental-studio-site-areas li.current-page-ancestor, .navbar-dental-studio-site-areas li.current-menu-ancestor, .navbar-dental-studio-site-areas li.current-menu-parent, .navbar-dental-studio-site-areas li.current-page-parent, .navbar-dental-studio-site-areas li.current_page_parent, .navbar-dental-studio-site-areas li.current_page_ancestor").length;
		var aMenuIsActive = activeMenusLength > 0;

		if(activeMenusLength > 1){
			$(".navbar-dental-studio-site-areas li").removeClass("current_page_item current-menu-item	current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent	current_page_parent current_page_ancestor");
			$(".navbar-dental-studio > div > nav > ul > li").removeClass("current_page_item current-menu-item current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor");

			aMenuIsActive = false;
		}


		// if no menu is selected
		if(!aMenuIsActive){
			if (site_area !== undefined && $(".navbar-dental-studio-site-areas li."+site_area).length > 0) {
				$(".navbar-dental-studio-site-areas li."+site_area).addClass("current_page_item");
				$(".navbar-dental-studio li."+site_area).addClass("current_page_item");
			}else{
				// Select a default one
				$(".navbar-dental-studio-site-areas li:first").addClass("current_page_item");
				$(".navbar-dental-studio li:first").addClass("current_page_item");
			}
		}


		var userTime = new Date();
		var hours = userTime.getHours();
		if (hours >= 8 && hours <= 23) {
			$(".dental-studio-check-open-now").addClass("open");
		}

		$(".no-touch .btn-phone").css({
			"cursor": "default"
		});
		$(".no-touch .btn-phone").click(function(e){
			e.preventDefault();
		});


		// Portrait animation on interaction
		// How many dancing fotograms
		var dancingSteps = 4;
		// Calculate the span of each action
		var actionSpan = 100 / dancingSteps;
		// randomPortraitDance interval
		var randomDanceInterval = 300;

		var updateClassName = function(dom, newClass){
			$(dom).removeClass(function (index, css) {
			  return (css.match (/(^|\s)dance\d+/g) || []).join(" ");
			});
			$(dom).addClass(newClass);
		};

		$(".portrait").bind("mousemove", function(event){
			var portrait = this;
			var mouseX = event.offsetX + 20;
			var width = $(portrait).width();

			// Mouse percentage
			var mousePercX = mouseX / width * 100;

			var danceClass = "dance1";
			for (var i = 1; i < dancingSteps; i++) {
				var ii = i+1;
				var upperActionLimit = ii * actionSpan;

				if (mousePercX > upperActionLimit) {
					danceClass = "dance" + ii;
				}
			}

			updateClassName(portrait, danceClass);

		}).bind("mouseout", function(){
			updateClassName(this, "");
		});


		window.randomPortraitDanceIntervalId = null;
		window.randomPortraitDance = function(){
			var portraits = $(".portrait");

			randomPortraitDanceIntervalId = window.setInterval(function(){

				// For each portrait
				portraits.each(function(){
					var portrait = this;
					var randomDanceMove = Math.floor((Math.random() * dancingSteps) + 1);
					var danceClass = "dance" + randomDanceMove;

					updateClassName(portrait, danceClass);
				});

			}, randomDanceInterval);
			return randomPortraitDanceIntervalId;
		};

		window.stopRandomPortraitDance = function(){
			window.clearInterval(randomPortraitDanceIntervalId);

			$(".portrait").removeClass(function (index, css) {
			  return (css.match (/(^|\s)dance\d+/g) || []).join(" ");
			});
		};


		// Special navbar links
		$("li.sl").click(function(event){
			var liTag = $(this);
			var aTag = liTag.find("a");
			var aHref = aTag.attr("href");
			var newHref = aHref;
			var hasParams = /\?/.test(aHref);
			var hasHash = /\#/.test(aHref);
			var match;

			var newParam = (hasParams) ? "&sl=" : "?sl=";

			if ((match = liTag.attr("class").match(/\s?sl-([\w]+)\s?/)).length == 2) {
				newParam += match[1];
			}

			if (hasHash) {
				var base = newHref.split("#")[0];
				var hash = newHref.split("#")[1];
				newHref = base + newParam + "#" + hash;
			}else{
				newHref += newParam;
			}

			console.log(liTag);
			aTag.attr("href", newHref);
			// event.preventDefault();
			// return false;
		});

		$(".wpcf7-form").submit(function(){
			var id = $(this).find("input[name=_wpcf7]").val();

			if (window.fbq !== undefined) {
				window.fbq('track', 'Form Submit', {form_id: id});
			}
		});

		$(".form-control.privacy").css('cursor', 'default');
		$(".form-control.privacy").click(function(){
			var checkbox = $(this).find('input[type=checkbox]');
			checkbox.prop('checked', !checkbox.prop('checked'));
		});

		$('.wpcf7-form .btn-confirm-privacy').click(function(event){
			event.preventDefault();

			var checkbox = $("<input type='checkbox' name='accept_privacy_policy' id='accept_privacy_js' />");
			var newButton = $("<label for='accept_privacy_js' class='btn btn-primary'>Accetta e invia</label>");
			newButton.prepend(checkbox);
			$(this).parent().append(newButton);
			$(this).hide();


			return false;
		});
	});
	// Document ready ends

} ( this, jQuery ));
