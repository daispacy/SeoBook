
CKEDITOR.dialog.add( 'googlemapsIcons', function( editor )
{
	"use strict";

	var MarkerColors = editor.config.googleMaps_markerColors || ['green', 'purple', 'yellow', 'blue', 'orange', 'red'],
		columns = MarkerColors.length,
		images = [],
		dialog;

	for (var i=0; i<columns; i++ )
	{
		var name=MarkerColors[i];
		images.push({name:name, src:'//maps.gstatic.com/mapfiles/ms/micons/' + name + '-dot.png'} );
	}

	var icons = editor.config.googleMaps_Icons;
	if (icons)
	{
		for(name in icons)
		{
			var icon = icons[ name ];
			images.push( {name:name, src:icon.marker.image} );
		}
		columns = Math.min( 10, images.length );
	}

	/**
	 * Simulate "this" of a dialog for non-dialog events.
	 * @type {CKEDITOR.dialog}
	 */
	var onClick = function( evt )
	{
		var target = evt.data.getTarget(),
			targetName = target.getName();

		if ( targetName == 'a' )
			target = target.getChild( 0 );
		else if ( targetName != 'img' )
			return;

		var name = target.getAttribute( 'data-name' );

		dialog.onSelect( name );

		dialog.hide();
		evt.data.preventDefault();
	};

	var onKeydown = CKEDITOR.tools.addFunction( function( ev, element )
	{
		ev = new CKEDITOR.dom.event( ev );
		element = new CKEDITOR.dom.element( element );
		var relative, nodeToMove;

		var keystroke = ev.getKeystroke();
		var rtl = editor.lang.dir == 'rtl';
		switch ( keystroke )
		{
			// UP-ARROW
			case 38 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( [element.getParent().getIndex(), 0] );
					nodeToMove.focus();
				}
				ev.preventDefault();
				break;
			// DOWN-ARROW
			case 40 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [element.getParent().getIndex(), 0] );
					if ( nodeToMove )
						nodeToMove.focus();
				}
				ev.preventDefault();
				break;
			// ENTER
			// SPACE
			case 32 :
				onClick( { data: ev } );
				ev.preventDefault();
				break;

			// RIGHT-ARROW
			case rtl ? 37 : 39 :
			// TAB
			case 9 :
				// relative is TD
				if ( ( relative = element.getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault(true);
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [0, 0] );
					if ( nodeToMove )
						nodeToMove.focus();
					ev.preventDefault(true);
				}
				break;

			// LEFT-ARROW
			case rtl ? 39 : 37 :
			// SHIFT + TAB
			case CKEDITOR.SHIFT + 9 :
				// relative is TD
				if ( ( relative = element.getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault(true);
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getLast().getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault(true);
				}
				break;
			default :
				// Do not stop not handled events.
				return;
		}
	});

	var buildHtml = function() {
		// Build the HTML for the images table.
		var html =
		[
			'<table style="width:100%;height:100%" cellspacing="2" cellpadding="2"',
			CKEDITOR.env.ie && CKEDITOR.env.quirks ? ' style="position:absolute;"' : '',
			'><tbody>'
		];

		for ( i = 0 ; i < images.length ; i++ )
		{
			if ( i % columns === 0 )
				html.push( '<tr>' );

			var image = images[ i ];
			html.push(
				'<td class="cke_centered" style="vertical-align: middle;">' +
					'<a href="javascript:void(0)"',
						' class="cke_hand" tabindex="-1" onkeydown="CKEDITOR.tools.callFunction( ', onKeydown, ', event, this );">',
						'<img class="cke_hand" ' +
							' src="', image.src , '"',
							' data-name="', image.name, '"',
							// IE BUG: Below is a workaround to an IE image loading bug to ensure the image sizes are correct.
							( CKEDITOR.env.ie ? ' onload="this.setAttribute(\'width\', 2); this.removeAttribute(\'width\');" ' : '' ),
						'>' +
					'</a>',
				'</td>' );

			if ( i % columns == columns - 1 )
				html.push( '</tr>' );
		}

		if ( i < columns - 1 )
		{
			for ( ; i < columns - 1 ; i++ )
				html.push( '<td></td>' );
			html.push( '</tr>' );
		}

		html.push( '</tbody></table>' );
		return html.join( '' );
	};

	var imagesSelector =
	{
		type : 'html',
		html : '<div>' + buildHtml() + '</div>',
		id : 'imagesSelector',
		onLoad : function( event )
		{
			dialog = event.sender;
		},
		focus : function()
 		{
			var size = images.length,
				i;
			for ( i = 0 ; i < size ; i++ )
			{
				if (images[i].name == dialog.initialName)
					break;
			}
			var initialImage = this.getElement().getElementsByTag( 'a' ).getItem( i );
			initialImage.focus();
 		},
		onClick : onClick,
		style : 'width: 100%; border-collapse: separate;'
	};

	function resolveUrl(url)
	{
		// Resolve the url so it becomes a full URL including the host
		var img = document.createElement("IMG");
		img.src = url;
		url = img.src;
		img = null;
		return url;
	}

	return {
		title : editor.lang.googlemaps.selectIcon,
		minWidth : 270,
		minHeight : 80,
		contents : [
			{
				id : 'Info',
				label : '',
				title : '',
				padding : 0,
				elements : [
						imagesSelector,
						{
							type:'hbox',
								children:
							[
								{
									type : 'button',
									id : 'browse',
									style : 'margin-top:4px;margin-bottom:2px; display:inline-block;',
									label : editor.lang.common.browseServer,
									filebrowser :
									{
										action : 'Browse',
										target: 'Info:txtUrl',
										url: editor.config.filebrowserIconBrowseUrl || editor.config.filebrowserImageBrowseUrl || editor.config.filebrowserBrowseUrl
									}
								},
								{
									type:'text',
									hidden:true,
									id:'txtUrl',
									onChange: function() {
										// Add new icon and select it:
										var value = resolveUrl(this.getValue()),
											nameParts = value.match(/([^\/]+)\.[^\/]*$/) || value.match(/([^\/]+)[^\/]*$/),
											name = nameParts && nameParts[1] || value,
											dialog = this.getDialog(),
											resized = false;

										// clean up
										name = name.replace(/[^\w]/g, '');

										// Initialize the object if it doesn't exist
										if (!editor.config.googleMaps_Icons)
											editor.config.googleMaps_Icons = {};

										// Add the image if it isn't available in the set
										if (!editor.config.googleMaps_Icons[ name ])
										{
											// Push the new marker
											var marker = { marker : { image: value }},
												shadow = editor.config.googleMaps_shadowMarker;
											if (shadow)
											{
												if (typeof shadow != "String")
													shadow = shadow( value );
												marker.shadow = {image: shadow};
											}
											editor.config.googleMaps_Icons[ name ] = marker;

											images.push( {name:name, src:value} );
											var contents = dialog.parts.contents,
												contentTable = contents.getFirst().getFirst().$,
												initial = {width:contentTable.offsetWidth, height: contentTable.offsetHeight};

											// rebuild the table so it shows correctly when the dialog opens again
											dialog.getContentElement('Info', 'imagesSelector').getElement().setHtml( buildHtml() );

											// Check if we need to resize the dialog
											if (contentTable.offsetWidth>initial.width || contentTable.offsetHeight>initial.height)
											{
												resized=true;
												dialog.resize( contentTable.offsetWidth, contentTable.offsetHeight);
											}
										}

										// select it
										dialog.onSelect( name );

										if ( !resized || !CKEDITOR.env.ie || CKEDITOR.env.ie9Compat )
											dialog.hide();
										else
										{
											// In some skins there's a function executed on a timeout after a dialog resize,
											// so we must delay the hide until it's performed.
											setTimeout( function() { dialog.hide(); }, ( editor.lang.dir == 'rtl' ? 1001 : 101) );
										}
									}
								}
							]
						}
					]
			}
		],

		buttons : [ CKEDITOR.dialog.cancelButton ]
	};
} );
