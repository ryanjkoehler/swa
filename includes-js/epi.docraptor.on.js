var epi = epi || {};

epi.docraptor = {
	/**
	 * Load an iframe and execute a callback once it's loaded
	 * @param  {string}   url      The URL to load in the iframe
	 * @param  {function} callback The callback to execute once the iframe is done loading
	 * @return
	 */
	loadIframe: function( url, deferred ){

		var $iframe = $('<iframe></iframe>');

		$iframe.attr({ id: 'printiframe' });
		$iframe.attr({ src: url });
		$iframe.hide().appendTo('body');

		// Execute the callback
		$iframe.load( function(){

			// Get the content
			var content = $iframe.contents().find('html').clone();

			// Remove the iFrame
			$iframe.remove();

			// Resolve the deferred and return the content
			return deferred.resolve( content );	

		});

	},

	cleanContent: function(content){
		// Check if we have content
		if ( ! content ) {
			console.log( 'Warning: No content to clean!' );
			return;
		}

		// If the content isn't a jQuery object, jQuerify it
		if ( ! content instanceof jQuery ) {
			content = $(content);
		}

		var myHTML = content; // @todo this can be changed


		// If content has no head element, we will borrow one from the current webpage
		// @todo prevent this if we're generating an Excel from Docraptor
		if ( ! myHTML.find('head').length ) {
			console.log('This content has no head element, so we will borrow one from this webpage');
			var wrapper = $('html').clone();
			wrapper.find('body > *').remove();
			wrapper.find('body').append( myHTML );
			myHTML = wrapper;
		}



		// Remove scripts
		// myHTML.find('script:not([prince*="include"])').remove();
		// // myHTML.find('link:not([prince*="include"])').remove();

		// Remove Front-End Editor
		myHTML.find('[class^="ext-"], [class^="aloha-"], [class^="fee-"], .x-toolbar, .x-tip, #pasteContainer, #aloha-floatingmenu-shadow, .x-tab-panel, .fee-hover-edit, .fee-hover-border').remove();
		myHTML.find('script[src*="aloha"], link[href*="aloha"], script:contains("FrontEndEditor"), script:contains("Aloha"), script:contains("front-end-editor")').remove();

		myHTML.find('#querylist').remove();
		
		// Remove ShareThis
		myHTML.find('script[src*="sharethis"], link[href*="sharethis"], #stSegmentFrame, .stwrapper, script:contains("stLight")').remove();
		
		// Remove AddThis
		myHTML.find('script[src*="addthis"], link[href*="addthis"], #_atssh').remove();

		// Remove Admin stuff
		myHTML.find('.admin-only, #wpadminbar, style:contains("AdBlock"), style[style*="display: none !important"], link:contains("admin-bar")').remove();

		// Remove unwanted scripts and styles
		myHTML.find('script[src*="l10n"], script[src*="pro-player"], script[src*="proplayer"], script[src*="colorbox"], script:contains("colorbox"), script:contains("thickboxL10n"), script:contains("Chartbeat"), script:contains("analytics"), script[src*="analytics"], style:contains("AdBlock"), style[style*="display: none !important"], script:contains("thickbox")').remove();

		// Remove NewRelic?
		myHTML.find('script:contains("NREUMQ"), script:contains("var request, b")').remove();
		myHTML.find('script[async]').remove();

		// Google Analyticator plugin
		myHTML.find('script[src*="google-analyticator"], script:contains("analyticsFileTypes"), script:contains("_atc")').remove();

		// Royal Slider		
		myHTML.find('script:contains(royalSlider)').remove();


		// Wrap it in HTML tags and declare a doctype
		var content = "<!DOCTYPE html><html>" +  myHTML.html() + "</html>";

		// Intercept the content (for debugging)
		content = prompt('Content returned from hey.docraptor.html', content);

		return content;
	}, 

	setOptions: function( options ) {

		options = options || {};

		var settings = $.extend({
			  test: true
			, document_type: 'pdf'
			, name: 'epi_doc'
			, strict: 'none'
			, javascript: true
			, http_user: "economics"
			, http_password: "economics"

			, postID: null
			, savepdf: false

		}, options);


		return settings;

	},


	submit: function ( content, options ){

		// var content = hey.docraptor.html(content);
		// var content = '';

		var data = {
		  doc: {
		      test: options.test
		    , document_type: options.document_type
		    , name: options.name
		    , document_content: content
		    , strict: options.strict
			, javascript: options.javascript
			, prince_options: {
				http_user: options.http_user,
				http_password: options.http_password
			}
		  },
		  user_credentials: '6SW81duqCdvAR5K3NgYZ'
		};

		// Create a hidden form to submit our content to DocRaptor
	    $('<form style="display: none !important;" id="dr_submission" action="http://docraptor.com/docs.xls" method="post"></form>').appendTo('body');

	    // Set credentials
	    $('form#dr_submission').append('<textarea name="user_credentials"></textarea>');
	    $('form#dr_submission textarea[name=user_credentials]').val(data.user_credentials);

	    // Set doc values
	    for(var key in data.doc) {
	    	if (key === 'prince_options') {
	    		for (var key in data.doc['prince_options']) {
	    			$('form#dr_submission').append('<textarea name="doc[prince_options]['+key+']"></textarea>');
	    			$('form#dr_submission textarea[name="doc[prince_options]['+key+']"]').val(data.doc[key]);
	    		}
	    	} else {
	    		$('form#dr_submission').append('<textarea name="doc['+key+']"></textarea>');
	    		$('form#dr_submission textarea[name="doc['+key+']"]').val(data.doc[key]);
	    	}
	    }

	    // Submit the form
	    if(confirm("Press OK to generate a PDF via DocRaptor.")) {
	    	$('form#dr_submission').submit().remove(); 
	    }
	},


	loadContent: function(content) {

		var loadStatus = $.Deferred();

		// Check what type of content is being passed in
		var isUrl = typeof content === 'string' && content.indexOf('://') > -1;
		var isJquery = content instanceof jQuery;

		// If it's a URL, load an iFrame
		if ( isUrl ) {
			this.loadIframe(content, loadStatus);
		}

		// If it's a jQuery object, use it as is
		if ( isJquery ) {
			loadStatus.resolve( content );
		}

		// Otherwise, put it in a jQuery wrapper — this should work for both HTML strings and selectors
		if ( !isUrl && !isJquery ) {
			loadStatus.resolve( $(content) );
		}

		return loadStatus.promise();

	},



	/**
	 * Generate a PDF from Docraptor
	 * @param  {[type]} content [description]
	 * @param  {[type]} options [description]
	 * @return {[type]}         [description]
	 */
	generate: function(content, options) {

		var options = epi.docraptor.setOptions(options);

		$.when( this.loadContent(content) )
		 .then( function(data){
		 	var cleanContent = epi.docraptor.cleanContent(data);
		 	epi.docraptor.submit(cleanContent, options);
		 } );
	}, 

	generateAjax: function(content, options) {

		var options = epi.docraptor.setOptions(options);

		$.when( this.loadContent(content) )
		 .then( function(data){
		 	var cleanContent = epi.docraptor.cleanContent(data);
		 	epi.docraptor.ajaxSave(cleanContent, options);
		 } );
	}, 


	ajaxSave: function ( content, options ){

		console.log('options', options);
		// var url = options.ajaxurl;
		// var url = '/wp-content/themes/epi-boilerplate/functions/ajax.docraptor.php';
		var url = '/wp-content/themes/swa-clone/functions/ajax.docraptor.php';

		var data = {
				savepdf: options.savepdf,			
				postID: options.postID, // Get the post ID?
				doc: {
					test: options.test,
					document_type: options.document_type,
					name: options.name,
					document_content: content,
					strict: options.strict,
					javascript: options.javascript
				},
			  	user_credentials: '6SW81duqCdvAR5K3NgYZ'
			};
		
	    $.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			beforeSend: function(){ 
			  // setTimeout(function(){
			  // 	$("#docraptor-ajax-reply").html('<span class="blinking"><span class="loading10x"><img src="http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading10x.gif"></span> Sending to DocRaptor...</span>');
			  // }, 2000);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert("There was an error. Refresh the page and try again. Let me know the text you see below.\n\n[jqXHR]: "+jqXHR+"\n[jqXHR.responseText]: "+jqXHR.responseText+"\n[jqXHR.status]: "+jqXHR.status+"\n[textStatus]: "+textStatus+"\n[errorThrown]: "+errorThrown+"\n[errorThrown.message]: "+errorThrown.message+"\n[errorThrown.sourceURL]: "+errorThrown.sourceURL);
				console.log("[jqXHR]: ",jqXHR,"[textStatus]: ",textStatus,"[errorThrown]: ",errorThrown);
			},
			success: function( reply ) {
			    if( reply.success ){

			    	alert('Success: ' + reply.url );
			  		// hey.ui.loadingGraphic.stop('#docraptor-ajax-reply');
			    // 		$("#docraptor-ajax-reply").html('<div>&#10004; Success! Click here to view PDF: <a href="' + reply.url + '" target="_blank">'+ reply.url +'</a></div>').fadeIn();
			  		
			  		// if(options.savepdf) {
			  		// 	$('#pdf_url').val(reply.url);
			  		// }
			    } else {

			    	alert('DOCRAPTOR ERROR: ' + reply.error);
			  		// $('#dr-loading').hide();
			  		// $("#docraptor-ajax-reply").html('<div>Problem creating PDF: ' + reply.error + '</div>').fadeIn();
			    }
			}
	    });
	},
};




























var hey = hey || {};

jQuery(function ($) {

hey.ui = {
	loadingGraphic: { 
		start: function( selector ) {
			// http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading-smallgreencircle.gif
			// http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading-barsmall.gif
			$( selector ).append('<img class="dr-loading" src="http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading-smallgreencircle.gif">').fadeIn();
		},

		stop: function( selector ) {
			$( selector ).find('.dr-loading').hide();
		}
	}
},


hey.docraptor = {
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// formerly callIframe(url, callback)
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// iframe: function(url, isTest) {
	// 	// Set a default value of false for isTest (whether this is a test PDF)
	// 	isTest = typeof(isTest) != 'undefined' ? isTest : false;
	//     $(document.body).append('<iframe id="printiframe"></iframe>');
	//     $('iframe#printiframe').attr('src', url);
	//     $('iframe#printiframe').load(function() {
	// 		hey.docraptor.download( isTest, '#printiframe' );			
	//     });
	// }, // end of method

	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// formerly docraptorHTML( source )
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	html: function ( source ) {
		
		var myHTML;
		
		// If the source isn't defined, use the page's html
		if ( typeof(source) == 'undefined' ) {
			myHTML = $('html').clone();
		} else {
			
			/***************************************************/
			// If the source is a URL:

			if (source.indexOf('http://') === 0 ) {
				// this doesn't work -- it needs to be redone with $.deferred or something
				console.log('The source is a URL. THIS WON\'T WORK!', myHTML );
   				$(document.body).append('<iframe id="printiframe" src="'+source+'"></iframe>');				
			    $('#printiframe').load(function() {
					return hey.docraptor.html('#printiframe');
			    });
			} 
			
			/***************************************************/			
			// If the source is an iframe:
			
			else if ( $(source).is('iframe') ) {
				myHTML = $(source).contents().find('html').clone();
				// console.log('The source is an iFrame.', myHTML );
			} 

			/***************************************************/			
			// Otherwise:

			else {
				myHTML = $(source).clone();
				// console.log('The source is HTML, not an iFrame or a URL.', myHTML );
			}	
		}
		
		// Remove scripts
			// myHTML.find('script:not([prince*="include"])').remove();
			// // myHTML.find('link:not([prince*="include"])').remove();


			// Remove Front-End Editor
			myHTML.find('[class^="ext-"], [class^="aloha-"], [class^="fee-"], .x-toolbar, .x-tip, #pasteContainer, #aloha-floatingmenu-shadow, .x-tab-panel, .fee-hover-edit, .fee-hover-border').remove();
			myHTML.find('script[src*="aloha"], link[href*="aloha"], script:contains("FrontEndEditor"), script:contains("Aloha"), script:contains("front-end-editor")').remove();

			myHTML.find('#querylist').remove();
			
			// Remove ShareThis
			myHTML.find('#stSegmentFrame, .stwrapper, script[src*="sharethis"], script:contains("stLight")').remove();
			
			// Remove AddThis
			myHTML.find('script[src*="addthis"]').remove();

			// Remove Admin stuff
			myHTML.find('.admin-only, #wpadminbar, style:contains("AdBlock"), style[style*="display: none !important"], link:contains("admin-bar")').remove();

			// Remove unwanted scripts and styles
			myHTML.find('script[src*="l10n"], script[src*="pro-player"], script[src*="proplayer"], script[src*="colorbox"], script:contains("colorbox"), script:contains("thickboxL10n"), script:contains("Chartbeat"), script:contains("analytics"), script[src*="analytics"], style:contains("AdBlock"), style[style*="display: none !important"], script:contains("thickbox")').remove();

			// Remove NewRelic?
			myHTML.find('script:contains("NREUMQ"), script:contains("var request, b")').remove();

			// Google Analyticator plugin
			myHTML.find('script[src*="google-analyticator"], script:contains("analyticsFileTypes"), script:contains("_atc")').remove();




			// myHTML.find('link').not('[href*="print-factsheet.css"]').each(function(){
			// 	console.log( 'Removed:'+ $(this).attr('href') );
			// 	$(this).remove();
			// });
			// // myHTML.find('script:not([src])').remove();
			myHTML.find('script[async]').remove();
			myHTML.find('script:contains(royalSlider)').remove();






			var content = "<!DOCTYPE html><html>" +  myHTML.html() + "</html>";
			// console.log('Content returned from hey.docraptor.html:', content);


			// Intercept the content (for debugging)
			content = prompt('Content returned from hey.docraptor.html', content);
			


			return content;

	}, // end of method
	
		
		//////////////////////////////////////////////////////
		//////////////////////////////////////////////////////
		//////////////////////////////////////////////////////
		getHTML: function ( source ) {
		// Accepts a jQuery selector. Also handles iframes.
			
			var myHTML;
			
			if ( typeof(source) == 'undefined' ) {
				myHTML = $('html').clone();
				hey.docraptor.processHTML( myHTML );
			} else if ( $(source).is('iframe') ) {
				myHTML = $(source).contents().find('html').clone();
				hey.docraptor.processHTML( myHTML );
			} else if (source.indexOf('http://') === 0 ) {
				  $.ajax({
				      // type: "POST",
				      url: source,
				      // data: data,
				      dataType: "html",
					  beforeSend: function(){ 
						},
				      success: function( myHTML ) {
						// alert('myHTML is '+myHTML );
						hey.docraptor.processHTML( myHTML );
				      } // end of success function
			      });
			} else {
				myHTML = $(source).clone();
			}
		}, // end of method		
		//////////////////////////////////////////////////////
		//////////////////////////////////////////////////////
		processHTML: function ( myHTML ) {
		
		// alert ( 'Passed into processHTML(): ' + myHTML );
		
		// myHTML.replace('<!DOCTYPE html>', '<!DOCTYPE html><html>');
		// myHTML = $(myHTML).wrap('<div />').parent();
		myHTML = $(myHTML);
		
		// alert(myHTML.html());
		
		// alert ( 'new myHTML: ' + myHTML.html() );
		
		// if ( myHTML instanceof HTMLElement ) { myHTML = $(myHTML); }
		
		// myHTML.find('script').remove();
			myHTML.find('script:not([prince*="include"])').remove();
			myHTML.find('link:not([prince*="include"])').remove();
			myHTML.find('#querylist, .x-toolbar, #stSegmentFrame, .x-tip, .stwrapper, .stLframe, #stOverlay, #pasteContainer, #aloha-floatingmenu-shadow, .x-tab-panel, .fee-hover-edit, .fee-hover-border').remove();
			myHTML.find('.admin-only, #wpadminbar, style:contains("AdBlock"), style[style*="display: none !important"], link:contains("admin-bar")').remove();
			myHTML.find('script[src*="aloha"], script[src*="l10n"], link[href*="aloha"], script[src*="pro-player"], script[src*="proplayer"], script[src*="colorbox"], script[src*="sharethis"], script:contains("Aloha"), script:contains("colorbox"), script:contains("thickboxL10n"), script:contains("Chartbeat"), script:contains("FrontEndEditor"), script:contains("analytics"), script[src*="analytics"], script:contains("stLight"), style:contains("AdBlock"), style[style*="display: none !important"], script:contains("front-end-editor"), script:contains("thickbox"), link:contains("admin-bar")').remove();

			var content = "<!DOCTYPE html><html>" +  myHTML.html() + "</html>";

			return content;

			
		}, // end of method
		
		
	

	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// formerly docraptorDownload( isTest )
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// download: function ( isTest, content, url ){
	download: function ( options ){

		// var content = docraptorHTML('#printiframe');
		var content = hey.docraptor.html(content);

		// Set a default value of false for isTest (whether this is a test PDF)
		var isTest = (options.test === undefined ) ? true : options.test;
		
		// Set a default value for the URL to post to (allows us to send the form to our own PHP script)
		var url = typeof(url) != 'undefined' ? url : 'http://docraptor.com/docs.xls';
		
		var data = {
		  doc: {
		    test: isTest,
		    document_type: 'pdf',
		    name: 'adoc', 
		    // name: jQuery('h1').text(), 
		    document_content: content,
		    strict: 'none',
			javascript: true,

			prince_options: {
			  http_user: "economics",
			  http_password: "economics"
			}

		  },
		  user_credentials: '6SW81duqCdvAR5K3NgYZ'
		};

		  if( url && data ){ 
				
		    jQuery('<form style="display: none !important;" id="dr_submission" action="' + url
		           // + '" method="' + (method||'post') + '">'
		           + '" method="' + 'post' + '">'
		           + '</form>').appendTo('body');
		    //credentials
		    jQuery('form#dr_submission').append('<textarea name="user_credentials"></textarea>');
		    jQuery('form#dr_submission textarea[name=user_credentials]').val(data.user_credentials);

		    //doc values
		    for(var key in data.doc) {
		    	if (key === 'prince_options') {
		    		for (var key in data.doc['prince_options']) {
		    			jQuery('form#dr_submission').append('<textarea name="doc[prince_options]['+key+']"></textarea>');
		    			jQuery('form#dr_submission textarea[name="doc[prince_options]['+key+']"]').val(data.doc[key]);
		    		}
		    	} else {
		    		jQuery('form#dr_submission').append('<textarea name="doc['+key+']"></textarea>');
		    		jQuery('form#dr_submission textarea[name="doc['+key+']"]').val(data.doc[key]);
		    	}
		    }

		    // confirm( $('form#dr_submission').serialize() );

		    //submit the form
		    if(confirm("Press OK to generate a PDF via DocRaptor.")) {jQuery('form#dr_submission').submit().remove(); }
		  };
		}, // end of method

	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	// ajax: function ( isTest, content, url ){
	ajax: function ( options ){
		
		options.title = 'epi';
		// var filename = prompt('What would you like this file to be called?');
		// data.doc.name = filename ? filename : 'pdf';
		// data.doc.name = 'epi'; // future: set a default for this based on a custom field?

		// Set a default value for the URL to post to (allows us to send the form to our own PHP script)
		// var url = typeof(url) != 'undefined' ? url : 'http://www.epi.org/wp-content/themes/epi-boilerplate/functions/ajax.docraptor.php';
		
		var url = options.ajaxurl;
		url = typeof(url) != 'undefined' ? url : '/wp-content/themes/epi-boilerplate/functions/ajax.docraptor.php';

		console.log('ajaxurl: ',url);

		var data = {
			savepdf: options.savepdf,			
			postID: options.postID, // Get the post ID?
			doc: {
				test: options.test,
				document_type: 'pdf',
				name: options.title,
				document_content: options.content,
				strict: 'none',
				// name: jQuery('h1').text(),
				javascript: true
			},
		  	user_credentials: '6SW81duqCdvAR5K3NgYZ'
		};
			
		      $.ajax({
				type: "POST",
				url: url,
				data: data,
				dataType: "json",
				beforeSend: function(){ 
				  // hey.ui.loadingGraphic.start('#docraptor-ajax-reply');
				  setTimeout(function(){
				  	$("#docraptor-ajax-reply").html('<span class="blinking"><span class="loading10x"><img src="http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading10x.gif"></span> Sending to DocRaptor...</span>');
				  }, 2000);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert("There was an error. Refresh the page and try again. Let me know the text you see below.\n\n[jqXHR]: "+jqXHR+"\n[textStatus]: "+textStatus+"\n[errorThrown]: "+errorThrown);
					console.log("[jqXHR]: ",jqXHR,"[textStatus]: ",textStatus,"[errorThrown]: ",errorThrown);
				},
				success: function( reply ) {
				    if( reply.success ){
				  		hey.ui.loadingGraphic.stop('#docraptor-ajax-reply');
				    		$("#docraptor-ajax-reply").html('<div>&#10004; Success! Click here to view PDF: <a href="' + reply.url + '" target="_blank">'+ reply.url +'</a></div>').fadeIn();
				  		
				  		if(options.savepdf) {
				  			$('#pdf_url').val(reply.url);
				  		}
				
				  		// window.open( reply.url, 'pdfwindow', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1680,height=1050');
				    } else {
				  		$('#dr-loading').hide();
				  		$("#docraptor-ajax-reply").html('<div>Problem creating PDF: ' + reply.error + '</div>').fadeIn();
				    }
				} // end of success function
		      });
		}, // end of method


		//////////////////////////////////////////////////////
		//////////////////////////////////////////////////////
		/**
		 * [iframe2 description]
		 * @param {object} options 
		 *        test:
		 *        ajaxurl: 
		 *        content: (this can be a URL)
		 *        savepdf:
		 *        postID:
		 */
		iframe2: function( options ) {
			
			var url = options.content;
			
			// hey.ui.loadingGraphic.start('#docraptor-ajax-reply');
			$("#docraptor-ajax-reply").html('<span class="loading10x"><img src="http://www.epi.org/wp-content/themes/epi-boilerplate/img/loading10x.gif"></span> Loading content...');
			
		    // $(document.body).append('<iframe id="printiframe" style="display:none;"></iframe>');
		    $(document.body).prepend('<iframe id="printiframe" style="display:nonee;"></iframe>');
		    $('iframe#printiframe').attr('src', url);
		    $('iframe#printiframe').load(function() {
				$("#docraptor-ajax-reply").html('Preparing to send...');
				// hey.ui.loadingGraphic.stop('#docraptor-ajax-reply');
				// hey.docraptor.ajax( {content: url } );
				var newHTML = hey.docraptor.html( '#printiframe' );
				hey.docraptor.ajax({
					content: newHTML, 
					test: options.test, 
					postID: options.postID,
					savepdf: options.savepdf,
					ajaxurl: options.ajaxurl
				});
				$('#printiframe').remove();
		    });
		}, // end of method


	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	ajax2: function ( options ){
		
		// var content = hey.docraptor.html(content);
		// var content = hey.docraptor.html(options.content);
		
		if (options.content.indexOf('http://') === 0 ) {
			  $.ajax({
			      url: options.content,
			      dataType: "html",
			      success: function( myHTML ) {
					// alert( myHTML );
					var $myHTML = $(myHTML);

					// alert('$(myHTML) is this: '+$myHTML);
					
					// alert('$("<div>Test</div>") is this: ' + $("<div>Test</div>") );
					
					var newHTML = hey.docraptor.processHTML( myHTML );
					// alert('newHTML is ' + newHTML);
					
					// hey.docraptor.ajax ( {content: hey.docraptor.processHTML( myHTML )} );
			      } // end of success function
		      });
		} else {

		}
	} // end of method



} // end of hey.docraptor namespace


});
