/* Author: 
*/


jQuery(function ($) {	


	$(document).ready(function(){

	/* 
	Home Page Feature Slider - Start
	*/

	//Get all the home page feature slides. Add a class of active to the first slide. Insert a button into each slide.
	$('#slides>li').each(function(index){
		if ($(this).hasClass('static-slide')) {
			$(this).addClass('active');
		}
	    $(this).prepend($('<a id="slide-button-'+(index+1)+'" class="slide-button" href="#"></a>'));
	});

	//On slide button click tigger animation and color change on button
	$('.slide-button').click(function(e){
		e.preventDefault();
		var $parent = $(this).parent();
		if($('#slides>li:animated').length) return;
		
		if($parent.hasClass('left') || $parent.hasClass('static-slide')) {
			$parent.nextAll('.left').removeClass('active').animate({left:'+=705px'}).removeClass('left');
			$parent.addClass('active');
		} 
		else 
		{
			$parent.addClass('active left').animate({left:'-=705px'});
			$parent.prevAll().removeClass('active').not('.left, .static-slide').animate({left:'-=705px'}).addClass('left');
		}
	});

	/* 
	Home Page Feature Slider - END
	*/


	//Move the nav list from below the pagination up into the article body on the feature landing page.
	if($('.feature-landing').length) {
		$('.feature-nav').insertAfter('.detail h1').addClass('moved-feature-nav');
	}

	//Tests for ie6
	function testIE6() {
		var isIE6 = false;
		if( $.browser.msie && $.browser.version == 6 ) {
			isIE6 = true;
		}
		return isIE6;
	}

	isIE6 = testIE6();

	//Runs ieSixEnhance function if ie6 is detected
	if( isIE6 ) {
		ieSixEnhance();
	}

	//Runs placeholder patch
	insertPlaceholder('.search-text');

	//load infinite scroll
	infinite_scroll();

	//Runs add print link
	addPrintLink(); 

	//Runs add embed link
	addEmbedLink();

	//Move the nav list from below the pagination up into the article body on the feature landing page.
	moveNav();

	});// End on document ready function

	//Embed functionality
	function addEmbedLink() {
		if( $('.embed-feature' ).length) {
			$( '<a class="embed" href="#embed-code">Embed</a>').appendTo( $('.embed-feature') );
			$( '.embed-feature a.embed' ).click( function() {
				//check to see if the window is currently open
				if($('.boxy-wrapper').is(':visible') == false)
				{
					// var embedContent = $( '#embed-code' ).html();
					var imgurl = $( 'a.hires' ).attr('href');
					var imgalt = $( '.chart h1' ).text();
					var embedContent = '<a href="'+document.URL+'"><img src="http://www.stateofworkingamerica.org/m/?src='+imgurl+'&w=540" alt="'+imgalt+'"></a>';

					// embedContent = embedContent.wrap('<textarea />');
					embedContent = '<textarea>'+embedContent+'</textarea>';

					new Boxy( embedContent, {title: "Embed Code"});
					return false;
				}
			});
		}
	}

	//Adding :first-child and :hover pseudo-class functionality to ie6
	function ieSixEnhance() {	
		$( "#nav .dd").hover(
		  function () {
		    $(this).addClass("hovered");
		  }, 
		  function () {
		    $(this).removeClass("hovered");
		  }
		);
		$( "#nav li:first-child").addClass("first-child");
		$( "#nav .dd ul li:first-child").addClass("first-child");
		$( "#EPI-info li:first-child").addClass("first-child");
		$( ".chart-list li li:first-child").addClass("first-child");
		$( ".callout-nav li:first-child").addClass("first-child");
		$( "#utility-nav li:first-child").addClass("first-child");
		$( ".download-share li:first-child").addClass("first-child");
		$( ".pagination a:first-child").addClass("first-child");
	}

	//validate explore our charts form
	function validate_form(thisform)
	{
		var valid = false;
		//hide error message
		$('.error').hide();
		//if subject has been selected set valid to true
		if($('#ExploreSubject').val() != '0')
		{
			valid = true;
		}
		//if demographic has been selected set valid to true
		if($('#ExploreDemographic').val() != '0')
		{
			valid = true;
		}
		if(valid)
		{
			return true;
		}
		//if there was an error return false
		else
		{
			$('.error').show();
			return false;
		}	
	}

	//infinite scroll results
	function infinite_scroll()
	{
		//load infinite scroll for result pages
		if($('.results').length) {
			var pageCnt = 0;
			if($('.chart-list').attr('class'))
			{
				pageCnt = $('.chart-list').attr('class').split('pagecount-')['1'];
			}
			var intro = $('#intro').attr('class').split('-');
			var query = intro['1'];
			var sid = intro['3'];
			var did = intro['5'];
			$(window).infinitescroll({
				url: window.location.href,  // the url to get the new content
				appendTo: $('.more'),       // the div to load the content to	 
				container: $('.wrapper'),  // the div where when the end reach, will load new content to .more
				pages: pageCnt, //pages count
				query: query, //query
				sid: sid, //subject id
				did: did //demographic id
		   });
		}
	}

	//Print page functionality
	function addPrintLink() {
		if($('.print-feature').length){
			$('<a class="print" href="#">Print Page</a>').appendTo($('.print-feature'));
			$('.print').click(function(){
				window.print();
				return false;
			}) 	
		}
	}

	//Move the nav list from below the pagination up into the article body on the feature landing page.
	function moveNav(){
		if($('.feature-landing').length) {
			$('.feature-nav').insertAfter('.detail h1').addClass('moved-feature-nav');
		}
	}

	//A patch for the HTML 5 Placeholder attribute found in the search input
	function testPlaceholder() {
		var i = document.createElement('input');
		return 'placeholder' in i;
	}

	function insertPlaceholder(el) {
		var hasPlaceholder = testPlaceholder();
		if (hasPlaceholder) {
			return;
		} else {
			$(el).each(function() {
				var helpTxt = $(this).attr("placeholder");
	    
				$(this).val(helpTxt);
	    
				$(this).blur(function () {
					if($(this).val() == '') { $(this).val(helpTxt) }
				});
				$(this).focus(function() {
					if($(this).val() == helpTxt) { $(this).val("") }
				});
			});
		}
	}

});
