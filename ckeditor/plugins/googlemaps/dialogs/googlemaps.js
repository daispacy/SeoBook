
CKEDITOR.dialog.add( 'googlemaps', function( editor )
{
	"use strict";

	var numbering = function( id ){ return id + CKEDITOR.tools.getNextNumber(); },
		GMapPreview = numbering( 'GMapPreview' ),
		mapDiv,
		COLORS = editor.config.googleMaps_overlayColors || ["#880000", "#008800", "#000088","#888800", "#880088", "#008888", "#000000", "#888888"] ,
		colorIndex_ = -1 ,
		MarkerColors = editor.config.googleMaps_markerColors || ['green', 'purple', 'yellow', 'blue', 'orange', 'red'] ,
		iconColorIndex_ = -1 ,
		custom_Icons = editor.config.googleMaps_Icons,
		markers = [], lines = [], areas = [], texts = [], circles = [],
		activeMarker = null, KmlOverlay = null, Mode = '',
		map = null,
		drawingManager,
		geocoder,
		overlayMapper,
		allMapTypes,
		oParsedMap,
		oFakeImage,
		theDialog,
		weatherLayer,
		currentPath = "Default",
		trafficLayer,
		transitLayer,
		bicycleLayer,
		lang = editor.lang.googlemaps,
		internalUpdate = true; // true until the map is ready: no sync between dialog and map. A Mutex afterwards

	if (typeof custom_Icons == "undefined")
	{
		editor.config.googleMaps_Icons = {};
		custom_Icons = editor.config.googleMaps_Icons;
	}

	// FIX problems due to the CKEditor reset stylesheet
	var node = CKEDITOR.document.getHead().append( 'style' );
	node.setAttribute( "type", "text/css" );
	var content = "";
	content += "#" + GMapPreview + " * {white-space:normal; cursor:inherit; text-align:inherit;}";
	content += "#" + GMapPreview + " .Input_Text {cursor:text; border-style:inset; border-width:2px; margin-left:1em;}";
	content += "#" + GMapPreview + " .Input_Button {border-style:outset; border-width:2px; margin:0 1em;}";
	content += "#" + GMapPreview + " .Gmaps_Buttons {clear:both; text-align:center; margin-top:4px;}";
	content += "#" + GMapPreview + " .Gmaps_Options td {clear:both}";
	content += "#" + GMapPreview + " a {cursor:pointer}";
	// fix issues with Bootstrap
	content += "#" + GMapPreview + " img {max-width: none;}";
	content += '.GMapsButton {cursor:pointer; background:url("' + editor.plugins.googlemaps.path + 'images/sprite.png") no-repeat top left; width: 24px; height: 24px;}';
	content += '.GMapsButtonActive {outline:1px solid #316AC5; background-color:#C1D2EE;}';
	content += '.GMapsButton:hover {outline:1px solid #316AC5;}';
	content += '.pac-container {z-index:12000;}';

	if (CKEDITOR.env.ie && CKEDITOR.env.version>=9)
	{
		// The CKEditor reset of width and size causes a bug in the rendering of lines and areas as they aren't drawn with the correct size
		// http://code.google.com/p/gmaps-api-issues/issues/detail?id=4343
		content += "#" + GMapPreview + " canvas { width:256px; height:256px; }";
	}

	if (CKEDITOR.env.ie && CKEDITOR.env.version<11)
		node.$.styleSheet.cssText = content;
	else
		node.$.innerHTML = content;


	// Define the overlay, derived from google.maps.OverlayView
	function Label(opt_options)
	{
		// Initialization
		this.setValues(opt_options);

		var marker = opt_options.marker;
		if (marker)
		{
			this.setValues({map:marker.getMap()});
			this.bindTo('position', marker);
			this.bindTo('title', marker);
		}

		// Label specific
		var span = this.span_ = document.createElement('span');
		span.style.cssText = 'white-space:nowrap; border:1px solid #999; padding:2px; background-color:white';
		if (opt_options.className)
			span.className = opt_options.className;

		var div = this.div_ = document.createElement('div');
		div.appendChild(span);
		div.style.cssText = 'position: absolute; display: none';
	}

	function InitializeLabels()
	{
		Label.prototype = new google.maps.OverlayView;

		// Implement onAdd
		Label.prototype.onAdd = function() {
		 var pane = this.getPanes().overlayLayer;
		 pane.appendChild(this.div_);

		 // Ensures the label is redrawn if the title or position is changed.
		 var me = this;
		 this.listeners_ = [
			 google.maps.event.addListener(this, 'position_changed',
					 function() { me.draw(); }),
			 google.maps.event.addListener(this, 'title_changed',
					 function() { me.draw(); })
		 ];
		};

		// Implement onRemove
		Label.prototype.onRemove = function() {
		 this.div_.parentNode.removeChild(this.div_);

		 // Label is removed from the map, stop updating its position/text.
		 for (var i = 0, I = this.listeners_.length; i < I; ++i) {
			 google.maps.event.removeListener(this.listeners_[i]);
		 }
		};

		// Implement draw
		Label.prototype.draw = function() {
			var projection = this.getProjection(),
				position = projection.fromLatLngToDivPixel(this.get('position')),
				div = this.div_,
				title = this.get('title');

			div.style.left = position.x + 'px';
			div.style.top = position.y + 'px';
			div.style.display = 'block';

			if (title)
				this.span_.innerHTML = title.toString();
		};
	}

	function initLoader()
	{
		if (window.google)
		{
			if (window.google.maps && google.maps.drawing && google.maps.geometry && google.maps.weather)
			{
				initializeMaps();
				return;
			}
			if( window.google.load)
			{
				loadMaps();
				return;
			}
		}

		window['CKE_googleMaps_callback'] = function() { initializeMaps(); };

		// The Google AJAX loader seems to require an API key.
		// So we can't use client location
		var script = document.createElement("script");
		var protocol = "";
		if (location.protocol=="file:")
			protocol = "http:";

		script.src = protocol + "//maps.googleapis.com/maps/api/js?sensor=false&libraries=drawing,geometry,places,weather&callback=CKE_googleMaps_callback";
		if (oParsedMap.key)
			script.src += "&key=" + oParsedMap.key;

		script.type = "text/javascript";
		document.getElementsByTagName("head")[0].appendChild(script);
	}

	function loadMaps()
	{
		var key="";
		if (oParsedMap.key)
			key = "&key=" + oParsedMap.key;

		window.google.load("maps", "3",  {callback:initializeMaps, other_params:"sensor=false&libraries=drawing,geometry,places,weather" + key});
	}

	function initializeMaps()
	{
		window['CKE_googleMaps_callback'] = null;

		InitializeLabels();

		mapDiv = document.getElementById( GMapPreview );
		UpdateDimensions();

		allMapTypes = [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.TERRAIN];

		internalUpdate = true;

		var myLatlng = new google.maps.LatLng( oParsedMap.centerLat, oParsedMap.centerLon );
		var myOptions = {
			zoom: parseInt(oParsedMap.zoom, 10),
			center: myLatlng,
			mapTypeId: allMapTypes[ oParsedMap.mapType ],
			heading : oParsedMap.heading,
			tilt: oParsedMap.tilt
		};
		map = new google.maps.Map(mapDiv, myOptions);

		if (oParsedMap.panorama)
		{
			var pan = oParsedMap.panorama;
			var panorama = map.getStreetView();
			panorama.setVisible(true);
			panorama.setPov( {heading: pan.heading, pitch: pan.pitch, zoom: pan.zoom});
			panorama.setPosition( new google.maps.LatLng(pan.lat, pan.lng) );
		}

        // Creates a drawing manager attached to the map that allows the user to draw
        // markers, lines, and shapes.
		var polyOptions = {editable: true};
        drawingManager = new google.maps.drawing.DrawingManager({
			drawingControl:false,
			polylineOptions: polyOptions,
			rectangleOptions: polyOptions,
			circleOptions: polyOptions,
			polygonOptions: polyOptions,
			map: map
		});

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {

			if (e.type == google.maps.drawing.OverlayType.POLYLINE)
			{
				var polyline = e.overlay;
				polyline.OverlayType = 'polyline';
				lines.push(polyline);
			}
			if (e.type == google.maps.drawing.OverlayType.POLYGON)
			{
				var polygon = e.overlay;
				polygon.OverlayType = 'polygon';
				areas.push(polygon);
			}

            FinishEditOverlay();
        });

		setMapTypeControl(theDialog.getContentElement('Options', 'cmbMapTypes') );
		setZoomControl(theDialog.getContentElement('Options', 'cmbZoomControl') );
		setScaleControl(theDialog.getContentElement('Options', 'chkScale') );
		setOverviewControl(theDialog.getContentElement('Options', 'chkOverviewMap') );
		setOverviewControlOptions( oParsedMap.overviewMapControlOpened );
		setWeather(theDialog.getContentElement('Options', 'chkWeather') );
		setPath(theDialog.getContentElement('Options','cmbPathType'));
		// Load the data
		var i, markerPoints, point, linesData, line, polyline, areasData, area, circlesData, circle, polygon, textsData,
				points, aLinePoints, j, values;

		markers = []; lines = []; areas = []; texts = []; circles = [];
		activeMarker = null; KmlOverlay = null; Mode = '';

		markerPoints = oParsedMap.markerPoints;
		for (i=0; i<markerPoints.length; i++)
		{
			var marker = markerPoints[i];
			point = new google.maps.LatLng(parseFloat(marker.lat), parseFloat(marker.lon));
			AddMarkerAtPoint(point, marker.text, marker.color, marker.title, marker.maxWidth, false, marker.open);
		}

		textsData = oParsedMap.textsData;
		for (i=0; i<textsData.length; i++)
		{
			point = new google.maps.LatLng(parseFloat(textsData[i].lat), parseFloat(textsData[i].lon));
			AddTextAtPoint(point, textsData[i].title, textsData[i].className, false);
		}

		linesData = oParsedMap.linesData;
		for (i=0; i<linesData.length; i++)
		{
			line = linesData[i];
			if (line.points)
				aLinePoints = google.maps.geometry.encoding.decodePath(line.points);
			else
			{
				// parsed from static:
				points = line.PointsData.split("|");
				aLinePoints = [];
				for(j=1; j<points.length; j++)
				{
					values = points[j].split(",");
					aLinePoints.push(new google.maps.LatLng(parseFloat(values[0]), parseFloat(values[1])) );
				}
			}
			polyline = new google.maps.Polyline( {map:map, path: aLinePoints, strokeColor: line.color, strokeOpacity: line.opacity, strokeWeight: line.weight, clickable:false} );

			polyline.OverlayType = 'polyline';
			lines.push(polyline);
		}

		areasData = oParsedMap.areasData;
		for (i=0; i<areasData.length; i++)
		{
			area = areasData[i];
			line = area.polylines[0];
			polygon = new google.maps.Polygon( {map:map, paths: google.maps.geometry.encoding.decodePath(line.points), strokeColor: line.color, strokeOpacity: line.opacity, strokeWeight: line.weight, fillColor:area.color, fillOpacity:area.opacity, clickable:false} );
			polygon.OverlayType = 'polygon';
			areas.push(polygon);
		}

		circlesData = oParsedMap.circlesData;
		for (i=0; i<circlesData.length; i++)
		{
			var circleData = circlesData[i];
			point = new google.maps.LatLng(parseFloat(circleData.lat), parseFloat(circleData.lon));

			circle = new google.maps.Circle( {map:map, center: point, radius: parseInt(circleData.radius, 10),
				strokeColor: circleData.color, strokeOpacity: circleData.opacity, strokeWeight: circleData.weight,
				fillColor:circleData.fillColor, fillOpacity:circleData.fillOpacity, clickable:false} );
			circle.OverlayType = 'circle';
			circles.push(circle);
		}

		onKmlChange();

		google.maps.event.addListener(map, 'click', function(point)
		{
			if (Mode == 'EditLine')
			{
				FinishEditOverlay();
				return;
			}

			if (Mode == 'AddMarker')
				AddMarkerAtPoint( point.latLng, editor.config.googleMaps_MarkerText || lang.defaultMarkerText, getIconColor(), lang.defaultTitle, 200, true );

			if (Mode == 'AddText')
				AddTextAtPoint( point.latLng, lang.defaultTitle, 'MarkerTitle', true );

			if (Mode == 'AddCircle')
			{
				var radius = 250 * Math.pow(2, 15) / Math.pow(2, map.getZoom() );
				var circleOptions = drawingManager.get('circleOptions');
				circleOptions.strokeColor = getColor( google.maps.drawing.OverlayType.CIRCLE );
				circleOptions.strokeOpacity = 0.7;
				circleOptions.strokeWeight = 2;
				circleOptions.fillColor = circleOptions.strokeColor;
				circleOptions.fillOpacity = 0.2;

				circleOptions.center = point.latLng;
				circleOptions.radius = radius;
				circleOptions.map = map;
				var circle = new google.maps.Circle( circleOptions );
				circle.OverlayType = 'circle';

				circles.push( circle );
				FinishEditOverlay();
			}
		});

		google.maps.event.addListener(map,'projection_changed',function(){
			overlayMapper = new google.maps.OverlayView();
			overlayMapper.draw = function () {};
			overlayMapper.setMap(map);
		});

		var input = theDialog.getContentElement('Info', 'searchDirection').getInputElement().$;

		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			searchAddress();
		});

		internalUpdate = false;

		if (CKEDITOR.env.ie7Compat)
			fixIE7display();

		if (CKEDITOR.env.ie6Compat)
			fixIE6display();
	}

	// IE in quirks mode puts the map behind the controls
	function fixIE6display()
	{
		var w = document.getElementById(GMapPreview);
		w.style.position = "relative";
		w.style.top = "80px";
	}

	// In IE7 or IE8 with compatibility mode, the content just dissapears on initial load, as well as
	// while hovering the dialog buttons.
	function fixIE7display()
	{
		var w = document.getElementById(GMapPreview);
		w.style.position = "";
		w.parentNode.style.position = "relative";
		window.setTimeout( function() { w.style.position = "relative"; w.parentNode.style.position = "";}, 0);
	}

	function UpdateDimensions()
	{
		mapDiv.style.width = theDialog.getValueOf( 'Info', 'txtWidth') + 'px';
		mapDiv.style.height = theDialog.getValueOf( 'Info', 'txtHeight') + 'px';

		if (map)
			google.maps.event.trigger(map, 'resize');
	}

	function setMapTypeControl(obj)
	{
		var style;
		switch (obj.getValue())
		{
			case 'None':
				style = 'None';
				break;
			case 'Default':
				style = google.maps.MapTypeControlStyle.DEFAULT;
				break;
			case 'Full':
				style = google.maps.MapTypeControlStyle.HORIZONTAL_BAR;
				break;
			case 'Menu':
				style = google.maps.MapTypeControlStyle.DROPDOWN_MENU;
				break;
		}

		if (style=='None')
			map.setOptions({ mapTypeControl:false });
		else
			map.setOptions({ mapTypeControl:true, mapTypeControlOptions : {style: style} });
	}

	function setZoomControl(obj)
	{
		var style;
		switch (obj.getValue())
		{
			case 'None':
				style = 'None';
				break;
			case 'Default':
				style = google.maps.ZoomControlStyle.DEFAULT;
				break;
			case 'Full':
				style = google.maps.ZoomControlStyle.ZOOM_PAN;
				break;
			case 'Small':
				style = google.maps.ZoomControlStyle.SMALL;
				break;
		}

		if (style=='None')
			map.setOptions({ zoomControl:false, panControl:false, streetViewControl:false, rotateControl:false });
		else
			map.setOptions({ zoomControl:true, panControl:true, streetViewControl:true, rotateControl:true, zoomControlOptions : {style: style} });
	}

	function setWeather(obj)
	{
        if ( !weatherLayer )
		{
			var wopts={};
			if (oParsedMap.weatherUsaUnits)
			{
				wopts = {
					temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT,
					windSpeedUnits: google.maps.weather.WindSpeedUnit.MILES_PER_HOUR
			  };
			}
			weatherLayer = new google.maps.weather.WeatherLayer(wopts);
		}
		weatherLayer.setMap( obj.getValue() ? map : null );
	}


	function setPath(obj)
	{
		switch (currentPath)
		{
			case 'Default':
				break;
			case 'Traffic':
				trafficLayer.setMap( null );
				break;
			case 'Transit':
				transitLayer.setMap( null );
				break;
			case 'Bicycle':
				bicycleLayer.setMap( null );
				break;

		}
		currentPath = obj.getValue();

		switch (currentPath)
		{
			case 'Default':
				break;
			case 'Traffic':
				if ( !trafficLayer )
					trafficLayer = new google.maps.TrafficLayer();
				trafficLayer.setMap( map );
				break;
			case 'Transit':
				if ( !transitLayer )
					transitLayer = new google.maps.TransitLayer();
				transitLayer.setMap( map );
				break;
			case 'Bicycle':
				if ( !bicycleLayer )
					bicycleLayer = new google.maps.BicyclingLayer();
				bicycleLayer.setMap( map );
				break;
		}
	}


	function setScaleControl(obj)
	{
		map.setOptions({ scaleControl: obj.getValue() });
	}

	function setOverviewControl(obj)
	{
		map.setOptions({ overviewMapControl: obj.getValue() });
	}

	function setOverviewControlOptions( opened )
	{
		map.setOptions({ overviewMapControlOptions: {opened: opened} });
	}

	function getMapTypeIndex()
	{
		return CKEDITOR.tools.indexOf( allMapTypes, map.getMapTypeId() );
	}

	function searchAddress()
	{
		var address = theDialog.getValueOf('Info', 'searchDirection');

		if (!geocoder)
			geocoder = new google.maps.Geocoder();

		geocoder.geocode( {'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK)
			{
				map.setCenter( results[0].geometry.location );
				AddMarkerAtPoint( results[0].geometry.location, address, getIconColor(), lang.defaultTitle, 200, false );
			}
			else
			  alert("Geocode was not successful for the following reason: " + status);
	  });
	}

	function getColor( type )
	{
		if ( editor.config.googleMaps_newOverlayColor )
		{
			if (typeof editor.config.googleMaps_newOverlayColor == "String")
				return editor.config.googleMaps_newOverlayColor;

			// else it is a function
			return editor.config.googleMaps_newOverlayColor( type );
		}

		colorIndex_ += 1;
		return COLORS[colorIndex_ % COLORS.length];
	}

	function getIconColor()
	{
		if ( editor.config.googleMaps_newMarkerColor )
		{
			if (typeof editor.config.googleMaps_newMarkerColor == "String")
				return editor.config.googleMaps_newMarkerColor;

			// else it is a function
			return editor.config.googleMaps_newMarkerColor();
		}

		iconColorIndex_ += 1;
		return MarkerColors[iconColorIndex_ % MarkerColors.length];
	}

	function getIcon( color )
	{
		var data = custom_Icons && custom_Icons[ color ];
		if (!data)
			return "//maps.gstatic.com/mapfiles/ms/micons/" + color + "-dot.png";

		return data.marker.image;
	}

	function getTextIcon()
	{
		return editor.plugins.googlemaps.path + 'images/TextIcon.png';
	}

	// Change mode to enable addition of new elements.
	function setMode( newMode )
	{
		var currentMode=Mode;
		FinishEditOverlay();

		// toggle
		if ( currentMode == newMode )
		{
			Mode = '';
			return;
		}

		Mode = newMode;
		switch (Mode)
		{
			case 'AddMarker':
				changeImage( 'btnAddNewMarker', true );

				// Change cursor type
				setMapCursor('crosshair');
				break;
			case 'AddLine':
				changeImage( 'btnAddNewLine', true );

				var polylineOptions = drawingManager.get('polylineOptions');
				polylineOptions.strokeColor = getColor( google.maps.drawing.OverlayType.POLYLINE );
				polylineOptions.strokeOpacity = 0.8;
				polylineOptions.strokeWeight = 4;
				drawingManager.set('polylineOptions', polylineOptions);

				drawingManager.setDrawingMode( google.maps.drawing.OverlayType.POLYLINE );
				break;

			case 'AddArea':
				changeImage( 'btnAddNewArea', true );

				var polygonOptions = drawingManager.get('polygonOptions');
				polygonOptions.strokeColor = getColor( google.maps.drawing.OverlayType.POLYGON );
				polygonOptions.strokeOpacity = 0.7;
				polygonOptions.strokeWeight = 2;
				polygonOptions.fillColor = polygonOptions.strokeColor;
				polygonOptions.fillOpacity = 0.2;
				drawingManager.set('polygonOptions', polygonOptions);

				drawingManager.setDrawingMode( google.maps.drawing.OverlayType.POLYGON );
				break;

			case 'AddCircle':
				changeImage( 'btnAddNewCircle', true );

				// Change cursor type
				setMapCursor('crosshair');
				break;

			case 'AddText':
				changeImage( 'btnAddNewText', true );
				// Change cursor type
				setMapCursor('crosshair');
				break;
		}

	}

	var selectedShape;
	function clearSelection()
	{
        if (selectedShape) {
			selectedShape.setEditable(false);
			selectedShape = null;
		}
	}

	// polylines and polygons. Check the OverlayType property.
	function EnableOverlayEditing(overlay)
	{
		overlay.setOptions( {clickable: true} );

		google.maps.event.addListener(overlay, "mouseover", function()
		{
			if ( Mode === '' && overlay != selectedShape )
			{
				setMode('EditLine');
				selectedShape = overlay;
				overlay.setEditable(true);
			}
		});

		google.maps.event.addListener(overlay, "click", function( latlng )
		{
			if (Mode.substr(0,3) == 'Add')
			{
				google.maps.event.trigger(map, 'click', latlng);
				return;
			}

			activeMarker = overlay;

			editor.openNestedDialog( 'googlemapsLine',
				function (dialog)
				{
					var obj = activeMarker;
					var data = {strokeColor: obj.strokeColor, strokeOpacity: obj.strokeOpacity.toFixed(1), strokeWeight: obj.strokeWeight};
					if (activeMarker.OverlayType=='polygon' || activeMarker.OverlayType=='circle')
					{
						data.fillColor = obj.fillColor;
						data.fillOpacity = obj.fillOpacity.toFixed(1);
					}
					dialog.setValues( data );
					dialog.onRemoveOverlay = DeleteCurrentOverlay;
				},

				function (dialog)
				{
					var data = dialog.getValues();
					activeMarker.setOptions( data );
				}
			);
		});


		// Remove vertex with right click on the polygon
		if (overlay.OverlayType=='polygon' || overlay.OverlayType=='polyline')
		{
			google.maps.event.addListener(overlay ,'rightclick', function deleteNode( ev ) {
				 if (ev.vertex != null) {
					// if only 2 points left, remove the line.
					var min = (overlay.OverlayType == 'polyline') ? 2 : 3;
					if (overlay.getPath().getLength() == min)
					{
						activeMarker = overlay;
						DeleteCurrentOverlay();
						return;
					}

					overlay.getPath().removeAt(ev.vertex);
				  }
			});
		}
	}

	function DisableOverlayEditing(overlay)
	{
		overlay.setOptions( {clickable: false} );
		google.maps.event.clearListeners(overlay, "click");
		google.maps.event.clearListeners(overlay, "rightclick");
		google.maps.event.clearListeners(overlay, "mouseover");
	}

	function setMapCursor(cursor)
	{
		map.setOptions({draggableCursor:cursor});
	}

	function AddMarkerAtPoint( point, text, color, title, maxWidth, interactive, open )
	{
		var marker = new google.maps.Marker( {position:point, map:map, title: title, icon: getIcon(color), draggable: true }) ,
			label;
		marker.text = text;
		marker.color = color;
		marker.maxWidth = maxWidth;

		if ( title !== "" )
		{
			label = new Label({marker:marker, className: 'MarkerTitle'});
			marker.label = label;
		}

		google.maps.event.addListener(marker, 'click', function() {
			EditMarker(this);
		});

		markers.push( marker );
		FinishEditOverlay();

		if (interactive)
			EditMarker( marker );
		else
		{
			marker.setOptions( {draggable:false} );
			if (open)
				EditMarker( marker );
		}
	}

	function OpenInfoWindow( obj, text )
	{
		if (!obj._infoWindow)
		{
			obj._infoWindow = new google.maps.InfoWindow({maxWidth:obj.maxWidth});
		}

		obj._infoWindow.setContent( text );
		obj._infoWindow.open(map, obj);
	}

	function EditMarker( obj )
	{
		if (!obj.getDraggable())
		{
			if (obj.text)
				OpenInfoWindow(obj, '<div class="InfoContent">' + obj.text + '</div>');

			return;
		}

		// We are really editing.
		activeMarker = obj;
		Mode = 'EditMarker';

		editor.openNestedDialog( 'googlemapsMarker', prepareMarkerTextsDialog, readMarkerTextsDialog );
	}

	function prepareMarkerTextsDialog( dialog )
	{
		dialog.setValues( activeMarker );
		dialog.onRemoveMarker = DeleteCurrentMarker;
	}

	function readMarkerTextsDialog( dialog )
	{
		var data = dialog.getValues();

		activeMarker.text = data.text;
		activeMarker.maxWidth = data.maxWidth;

		var title = data.title,
			label = activeMarker.label;
		activeMarker.setTitle( title );

		activeMarker.color = data.color;
		activeMarker.setIcon( getIcon(data.color) );

		if ( title !== "" )
		{
			if ( !label )
			{
				label = new Label({marker:activeMarker, className: 'MarkerTitle'});
				activeMarker.label = label;
			}
		}
		else
		{
			if ( label )
			{
				label.setMap( null );
				activeMarker.label = null;
			}
		}
	}

	function DeleteCurrentMarker()
	{
		// Remove it from the global array
		for ( var j = 0; j < markers.length; j++ )
		{
			if ( markers[j] == activeMarker)
			{
				markers.splice(j, 1);
				break;
			}
		}
		if ( activeMarker.label )
		{
			activeMarker.label.setMap( null );
			activeMarker.label = null;
		}
		// Remove it from the map
		activeMarker.setMap( null );

		// this will reset activeMarker
		FinishedEditing();
	}


	function DeleteCurrentOverlay()
	{
		var group;
		switch (activeMarker.OverlayType)
		{
			case 'polyline':
				group = lines;
				break;
			case 'polygon':
				group = areas;
				break;
			case 'circle':
				group = circles;
				break;
		}

		// Remove it from the global array
		for ( var j = 0; j < group.length; j++ )
		{
			if ( group[j] == activeMarker)
			{
				group.splice(j, 1);
				break;
			}
		}

		DisableOverlayEditing(activeMarker);

		// Remove it from the map
		activeMarker.setMap( null );

		// this will reset activeMarker
		FinishedEditing();
	}

	function FinishedEditing()
	{
		Mode = '';
		activeMarker = null;
	}

	function AddTextAtPoint( point, text, className, interactive )
	{
		var marker = new google.maps.Marker( {position:point, map:map, title: text, icon: getTextIcon(), draggable: true }) ,
			label;
		marker.className = className;

		if ( text !== "" )
		{
			label = new Label({marker:marker, className: className});
			marker.label = label;
		}

		google.maps.event.addListener(marker, 'click', function() {
			EditText(this);
		});

		texts.push( marker );
		FinishEditOverlay();

		if (interactive)
			EditText( marker );
		else
			marker.setVisible(false);
	}

	function EditText(obj)
	{
		if (!obj.getDraggable())
			return;

		// We are really editing.
		activeMarker = obj;
		Mode = 'EditText';

		editor.openNestedDialog( 'googlemapsText',
			function (dialog) { dialog.setValues( {title:obj.get("title")});},
			updateTextMarker );
	}

	function updateTextMarker( dialog )
	{
		var data = dialog.getValues();

		var title = data.title,
			label = activeMarker.label;
		activeMarker.setTitle( title );

		if ( title !== "" )
		{
			if ( !label )
			{
				label = new Label( {marker:activeMarker, className: 'MarkerTitle'} );
				activeMarker.label = label;
			}
		}
		else
		{
			DeleteCurrentText();
		}

		FinishedEditing();
	}

	function DeleteCurrentText()
	{
		// Remove it from the global array
		for ( var j = 0; j < texts.length; j++ )
		{
			if ( texts[j] == activeMarker)
			{
					texts.splice(j, 1);
					break;
			}
		}
		if ( activeMarker.label )
		{
			activeMarker.label.setMap( null  );
			activeMarker.label = null;
		}
		// Remove it from the map
		activeMarker.setMap( null );
	}


	function changeImage(id, active)
	{
		theDialog.getContentElement('Elements', id).getElement()[ active ? 'addClass' : 'removeClass']( 'GMapsButtonActive' );
	}

	function FinishEditOverlay()
	{
		// Switch back to non-drawing mode after drawing a shape.
		if (drawingManager) drawingManager.setDrawingMode(null);
		clearSelection();

		if (Mode==='')
			return;

		var line, area, circle;
		switch (Mode)
		{
			case 'AddLine':
				changeImage( 'btnAddNewLine', false);
				line = lines[lines.length - 1];
				if (line)
				{
					line.setEditable(false);
					EnableOverlayEditing(line);
				}
				Mode = '';
				break;

			case 'AddArea':
				changeImage( 'btnAddNewArea', false);
				area = areas[areas.length - 1];
				if (area)
				{
					area.setEditable(false);
					EnableOverlayEditing(area);
				}
				Mode = '';
				break;

			case 'AddMarker':
				changeImage( 'btnAddNewMarker', false);
				// Change cursor type
				setMapCursor('');

				break;

			case 'AddCircle':
				changeImage( 'btnAddNewCircle', false);
				circle = circles[circles.length - 1];
				if (circle)
				{
					circle.setEditable(false);
					EnableOverlayEditing(circle);
				}
				Mode = '';

				// Change cursor type
				setMapCursor('');
				break;

			case 'AddText':
				changeImage( 'btnAddNewText', false);
				// Change cursor type
				setMapCursor('');
				break;

			case 'EditMarker':
				FinishedEditing();
				break;

			case 'EditText':
				FinishedEditing();
				break;

			case 'EditLine':
				FinishedEditing();
				break;

			default:
				break;
		}
	}

	function DisableEditing()
	{
		var i;
		for(i=0; i<markers.length; i++)
			markers[i].setOptions({draggable:false});

		for(i=0; i<texts.length; i++)
			texts[i].setVisible(false);

		for(i=0; i<lines.length; i++)
			DisableOverlayEditing( lines[i] );

		for(i=0; i<areas.length; i++)
			DisableOverlayEditing( areas[i] );

		for(i=0; i<circles.length; i++)
			DisableOverlayEditing( circles[i] );
	}

	function EnableEditing()
	{
		var i;

		for(i=0; i<markers.length; i++)
			markers[i].setOptions({draggable:true});

		for(i=0; i<texts.length; i++)
			texts[i].setVisible(true);

		for(i=0; i<lines.length; i++)
			EnableOverlayEditing( lines[i] );

		for(i=0; i<areas.length; i++)
			EnableOverlayEditing( areas[i] );

		for(i=0; i<circles.length; i++)
			EnableOverlayEditing( circles[i] );
	}

	function EncodeLineData(polyline, forArea)
	{
		var o = {color : polyline.strokeColor, opacity : polyline.strokeOpacity, weight : polyline.strokeWeight},
			path = polyline.getPath(),
			length = path.getLength();

		if (length<2)
			return null;

		// Static areas by default are created with just the "minimum" points, and they are properly closed on a live map
		// but they appear with the last segment missing on the static image, so let's copy the first point in this case
		if ( forArea )
		{
			var first = path.getAt(0),
				last = path.getAt(length-1);
			if (!first.equals(last))
				path.push(first);
		}

		o.points = google.maps.geometry.encoding.encodePath(path);
		return o;
	}

	function resolveUrl(url)
	{
		// Resolve the url so it becomes a full URL including the host
		var img = document.createElement("IMG");
		img.src = url;
		url = img.src;
		img = null;
		return url;
	}

	function onKmlChange(fileUrl, data)
	{
		var oKmlUrl = theDialog.getContentElement('Elements', 'txtKMLUrl');
		if (!oKmlUrl)
			return;

		var url = (fileUrl && typeof(fileUrl)=="string") ? fileUrl : oKmlUrl.getValue();
		if (oKmlUrl.lastUrl == url)
			return;

		oKmlUrl.lastUrl = url;

		if (KmlOverlay)
		{
			if (KmlOverlay.url == url)
				return;

			KmlOverlay.setMap( null );
			KmlOverlay = null;
		}
		if ( !url )
			return;

		var match = /:\/\/(.*?)\//.exec(url),
			newUrl;
		if (!match)
		{
			url = resolveUrl(url);
			newUrl = true;
			match = /:\/\/(.*?)\//.exec(url);
		}
		if (match[1].indexOf('.')==-1)
		{
			// The function is called while CKFinder is open, so we have to delay it
			window.setTimeout( function() {
				alert("Error: You must provide a public server in the url of KML files.");
			}, 500);
			oKmlUrl.lastUrl = "";
			return false;
		}
		KmlOverlay = new google.maps.KmlLayer(url, {map:map});
		if (newUrl)
		{
			oKmlUrl.lastUrl = url;
			oKmlUrl.setValue( url );

			theDialog.showPage('Elements');
			var div = theDialog.getContentElement('Elements', 'KMLContainer').getElement();
			div.show();
		}
	}

	function RefreshSize()
	{
		var contents = theDialog.parts.contents,
			Wrapper = document.getElementById("Wrapper" + GMapPreview);

		Wrapper.style.width = contents.$.style.width;
		Wrapper.style.height = (parseInt(contents.$.style.height, 10) - 90) + "px";
	}

	return {
		title : lang.title,
		minWidth : 500,
		minHeight : 460,
		onLoad : function()
		{
			theDialog = this;

			// Act on tab switching
			theDialog.on('selectPage', function (e)
				{
					if (CKEDITOR.env.ie7Compat)
						fixIE7display();

					if (e.data.page=='Elements')
					{
						EnableEditing();
					}
					else
					{
						FinishEditOverlay();
						DisableEditing();
					}
				});
			theDialog.on('resize', RefreshSize);

			// Adjust the contents so they take only the top of the dialog and add a bottom div
			// that will show the map in all the tabs
			var contents = this.parts.contents;
			var children = contents.getChildren();
			for(var i=children.count()-1; i>=0; i--)
			{
				var div = children.getItem(i);
				div.$.style.height = '64px';
			}
			contents.appendHtml('<div id="Wrapper' + GMapPreview + '" style="width:500px; height:370px; overflow:auto;"><div id="' + GMapPreview + '" style="outline:0;"></div></div>');

			// It flickers, but at least the map doesn't go away
			// I can't find any other solution for the moment.
			if (CKEDITOR.env.ie7Compat)
			{
				this.parts.footer.on( 'mousemove', fixIE7display);
				this.parts.footer.on( 'mouseleave', function() { window.setTimeout(fixIE7display, 0);} );
			}
		},
		onShow : function()
		{
			Mode = '';
			internalUpdate = true;
			oFakeImage = null;
			oParsedMap = null;
			var handler = editor.plugins.googleMapsHandler;

			// Try to detect a map
			var fakeImage = this.getSelectedElement();

			if ( fakeImage )
			{
				oFakeImage = fakeImage.$;
				var mapNumber = oFakeImage.getAttribute( 'mapnumber' );
				if ( mapNumber )
				{
					oParsedMap = handler.getMap( mapNumber );
					oParsedMap && oParsedMap.updateDimensions( oFakeImage );
				}
				if (!oParsedMap)
				{
					if (!handler.isStaticImage( oFakeImage ))
						oFakeImage = null;
					else
					{
						oParsedMap = handler.createNew();
						oParsedMap.parseStaticMap2( oFakeImage );
						// this way it will be recreated,
						// first we select the first div that we usually create and select.
						// then on OK the structure will be recreated overwriting the existing one
						if (oFakeImage.parentNode.nodeName=='DIV' && !oFakeImage.previousSibling && !oFakeImage.nextSibling)
						{
							oFakeImage = oFakeImage.parentNode;
							if (editor.config.googleMaps_WrapperClass && oFakeImage.parentNode.nodeName=='DIV' && oFakeImage.parentNode.className==editor.config.googleMaps_WrapperClass)
								oFakeImage = oFakeImage.parentNode;

							editor.getSelection().selectElement( new CKEDITOR.dom.element( oFakeImage ) );
						}
						oFakeImage = null;
					}
				}
			}

			if ( !oParsedMap )
			{
				oParsedMap = handler.createNew();

				// Try W3C Geolocation if we are creating a new map and no default has been set
				if (navigator.geolocation && !editor.config.googleMaps_CenterLat)
				{
					// Request location only once. Next time use the localstorage
					if (localStorage.mapsCenter)
					{
						var point = JSON.parse(localStorage.mapsCenter);

						oParsedMap.centerLat = point.lat;
						oParsedMap.centerLon = point.lng;
					}
					else {
						navigator.geolocation.getCurrentPosition( function(position) {
							oParsedMap.centerLat = position.coords.latitude.toFixed(5);
							oParsedMap.centerLon = position.coords.longitude.toFixed(5);

							localStorage.mapsCenter = JSON.stringify({ lat: oParsedMap.centerLat, lng: oParsedMap.centerLon });

							if (!map)
								return;
							map.setCenter( new google.maps.LatLng(oParsedMap.centerLat, oParsedMap.centerLon) );
						});
					}
				}
			}

			theDialog.setValueOf( 'Info', 'txtWidth', oParsedMap.width);
			theDialog.setValueOf( 'Info', 'txtHeight', oParsedMap.height);

			theDialog.setValueOf( 'Options', 'cmbGeneratedType', oParsedMap.generatedType);
			theDialog.setValueOf( 'Options', 'cmbZoomControl', oParsedMap.zoomControl);
			theDialog.setValueOf( 'Options', 'cmbMapTypes', oParsedMap.mapTypeControl);
			theDialog.setValueOf( 'Options', 'chkScale', oParsedMap.scaleControl);
			theDialog.setValueOf( 'Options', 'chkOverviewMap', oParsedMap.overviewMapControl);

			theDialog.setValueOf( 'Options', 'chkWeather', oParsedMap.weather);

			theDialog.setValueOf( 'Options', 'cmbPathType', oParsedMap.pathType);

			var oKmlUrl = theDialog.getContentElement('Elements', 'txtKMLUrl');
			if (oKmlUrl)
				oKmlUrl.setValue( oParsedMap.kmlOverlay);

			// Init the map
			initLoader();
		},
		onOk : function()
		{
			oParsedMap.width = theDialog.getValueOf('Info', 'txtWidth');
			oParsedMap.height = theDialog.getValueOf('Info', 'txtHeight');

			oParsedMap.zoom = map.getZoom();

			var point = map.getCenter();
			oParsedMap.centerLat = point.lat().toFixed(5);
			oParsedMap.centerLon = point.lng().toFixed(5);
			oParsedMap.tilt = map.getTilt();
			oParsedMap.heading = map.getHeading();

			oParsedMap.mapType = getMapTypeIndex();

			oParsedMap.generatedType = parseInt(theDialog.getValueOf('Options', 'cmbGeneratedType'), 10);
			oParsedMap.zoomControl = theDialog.getValueOf('Options', 'cmbZoomControl');
			oParsedMap.mapTypeControl = theDialog.getValueOf('Options', 'cmbMapTypes');
			oParsedMap.scaleControl = theDialog.getValueOf('Options', 'chkScale');

			oParsedMap.overviewMapControl = theDialog.getValueOf('Options', 'chkOverviewMap');
			oParsedMap.overviewMapControlOpened = map.overviewMapControlOptions.opened;

			oParsedMap.weather = theDialog.getValueOf('Options', 'chkWeather');
			oParsedMap.pathType = theDialog.getValueOf('Options', 'cmbPathType');

			var panorama = map.getStreetView();
			if (panorama.getVisible())
			{
				var oPan = {};
				point = panorama.getPosition();
				oPan.lat = point.lat().toFixed(7);
				oPan.lng = point.lng().toFixed(7);
				var pov = panorama.getPov();
				oPan.heading = pov.heading;
				oPan.pitch = pov.pitch;
				oPan.zoom = pov.zoom;

				oParsedMap.panorama  = oPan;
			}
			else
				oParsedMap.panorama = null;

			var markerPoints = [],
				textsData = [],
				linesData = [], line,
				areasData = [], area,
				circlesData = [], circle,
				i;

			for (i=0; i<markers.length; i++)
			{
				var marker = markers[i];
				point = marker.getPosition();
				markerPoints.push({lat: point.lat().toFixed(5), lon: point.lng().toFixed(5),
					text:marker.text, color:marker.color, title:marker.get("title"), maxWidth:marker.maxWidth,
					open:(marker._infoWindow && marker._infoWindow.map)});
			}
			oParsedMap.markerPoints = markerPoints;

			for (i=0; i<texts.length; i++)
			{
				point = texts[i].getPosition();
				textsData.push({lat: point.lat().toFixed(5), lon: point.lng().toFixed(5), title:texts[i].get("title"), className:texts[i].className});
			}
			oParsedMap.textsData = textsData;

			for (i=0; i<lines.length; i++)
			{
				line = EncodeLineData( lines[i], false );
				if (line)
					linesData.push( line );
			}
			oParsedMap.linesData = linesData;

			for (i=0; i<areas.length; i++)
			{
				area = {polylines:[]};
				// find polylines
				area.polylines.push( EncodeLineData( areas[i], true ) );
				if (area.polylines[0])
				{
					area.color = areas[i].fillColor;
					area.opacity = areas[i].fillOpacity;
					areasData.push( area );
				}
			}
			oParsedMap.areasData = areasData;

			for (i=0; i<circles.length; i++)
			{
				circle = circles[i];
				circlesData.push( {
					color : circle.strokeColor,
					opacity : circle.strokeOpacity,
					weight : circle.strokeWeight,
					fillColor : circle.fillColor,
					fillOpacity : circle.fillOpacity,
					radius : circle.radius.toFixed(0),
					lat: circle.center.lat().toFixed(5),
					lon: circle.center.lng().toFixed(5)
				} );
			}
			oParsedMap.circlesData = circlesData;

			var oKmlUrl = theDialog.getContentElement('Elements', 'txtKMLUrl');
			if (oKmlUrl)
				oParsedMap.kmlOverlay = oKmlUrl.getValue();

			if ( !oFakeImage )
				oFakeImage = oParsedMap.createHtmlElement();

			oParsedMap.updateHTMLElement( oFakeImage );
		},

		onHide : function()
		{
			var i, marker;
			// Destroy map. V3 doesn't have a "map.unload()"
			for (i=0; i<markers.length; i++)
			{
				marker = markers[i];
				marker.setMap( null );
				if (marker.label)
				{
					marker.label.setMap(null);
					marker.label = null;
				}
			}

			for (i=0; i<texts.length; i++)
			{
				marker = texts[i];
				marker.setMap( null );
				if (marker.label)
				{
					marker.label.setMap(null);
					marker.label = null;
				}
			}

			for (i=0; i<lines.length; i++)
			{
				lines[i].setMap( null );
			}

			for (i=0; i<areas.length; i++)
			{
				areas[i].setMap( null );
			}

			if (KmlOverlay)
			{
				KmlOverlay.setMap( null );
				KmlOverlay = null;
			}

			google.maps.event.clearInstanceListeners( map );
			map = null;

			internalUpdate = true;
		},

		contents : [
			{
				id : 'Info',
				label : lang.map,
				elements :
				[
					{
						type : 'hbox',
						widths : [ '115px', '115px', '240px' ],
						children :
						[
							{
								id : 'txtWidth',
								type : 'text',
									widths : [ '55px', '60px'],
									width: '40px',
								labelLayout : 'horizontal',
								label : lang.width,
								onBlur : UpdateDimensions,
								required : true
							},
							{
								id : 'txtHeight',
								type : 'text',
									widths : [ '55px', '60px'],
									width: '40px',
								labelLayout : 'horizontal',
								label : lang.height,
								onBlur : UpdateDimensions,
								required : true
							},
							{ // Padding at the right
								type : 'html',
								html : '<div> </div>'
							}
						]
					},
					{
						type : 'hbox',
						widths : [ '340px', '100px', '' ],
						children :
						[
							{
								id : 'searchDirection',
								type : 'text',
								label : lang.searchDirection,
								labelLayout : 'horizontal',
								onKeyup: function( evt )
								{
									if ( evt.data.getKeystroke() == 13 )
									{
										searchAddress();
										evt.stop();
										return false;
									}
								},
								// extra code due to #7516
								onKeydown: function( evt )
								{
									if ( evt.data.getKeystroke() == 13 )
									{
										evt.stop();
										evt.data.preventDefault( true );
										evt.data.stopPropagation();
										return false;
									}
								}
							},
							{
								id : 'btnSearch',
								type : 'button',
								align : 'center',
								label : lang.search,
								onClick : searchAddress
							}
						]
					}
				]
			},
			{
				id : 'Options',
				label : lang.options,
				elements :
				[
					{
						type : 'hbox',
						widths : [ '180px', '100px', '100px', '0' ],
						children :
						[
							{
								id : 'cmbGeneratedType',
								type : 'select',
								labelLayout : 'horizontal',
								label : lang.loadMap,
								items :
								[
									[ lang.onlyStatic, '1'],
									[ lang.onClick, '2'],
									[ lang.onLoad, '3'],
									[ lang.byScript, '4']
								]
							},
							{
								id : 'chkScale',
								type : 'checkbox',
								labelLayout : 'horizontal',
								label : lang.scale,
								onChange : function(o) {
									if (internalUpdate)
										return;

									setScaleControl(this);
								}
							},
							{
								id : 'chkOverviewMap',
								type : 'checkbox',
								labelLayout : 'horizontal',
								label : lang.overview,
								onChange : function(o) {
									if (internalUpdate)
										return;

									setOverviewControl(this);
								}
							},
							{
								id : 'cmbMapTypes',
								hidden: true,
								type : 'select',
								labelLayout : 'horizontal',
								label : lang.mapTypes,
								onChange : function(o) {
									if (internalUpdate)
										return;
									internalUpdate = true;

									setMapTypeControl(this);

									internalUpdate = false;
								},
								items :
								[
									[ lang.none, 'None'],
									[ lang.Default, 'Default'],
									[ lang.mapTypesFull, 'Full'],
									[ lang.mapTypesMenu, 'Menu']
								]
							}
						]
					},
					{
						type : 'hbox',
						widths : [ '180px', '100px', '100px', '0' ],
						children :
						[
							{
								id : 'cmbPathType',
								type : 'select',
								labelLayout : 'horizontal',
								label : lang.paths,
								onChange : function(o) {
									if (internalUpdate)
										return;
									internalUpdate = true;

									setPath(this);

									internalUpdate = false;
								},
								items :
								[
									[ lang.Default, 'Default'],
									[ lang.traffic, 'Traffic'],
									[ lang.transit, 'Transit'],
									[ lang.bicycle, 'Bicycle']
								]
							},
							{
								id : 'chkWeather',
								type : 'checkbox',
								labelLayout : 'horizontal',
								label : lang.weather,
								onChange : function(o) {
									if (internalUpdate)
										return;

									setWeather(this);
								}
							},
							{
								id : 'cmbZoomControl',
								hidden: true,
								type : 'select',
								labelLayout : 'horizontal',
								label : lang.zoomControl + ' ',
								items :
								[
									[ lang.none, 'None'],
									[ lang.Default, 'Default'],
									[ lang.smallZoom, 'Small'],
									[ lang.fullZoom, 'Full']
								],
								onChange : function(o) {
									if (internalUpdate)
										return;
									internalUpdate = true;

									setZoomControl(this);

									internalUpdate = false;
								}							},
							{ // Padding at the right
								type : 'html',
								html : '<div> </div>'
							}
						]
					}
				]
			},
			{
				id : 'Elements',
				label : lang.elements,
				elements :
				[
					{
						type : 'hbox',
						widths : [ '26px', '26px', '26px', '26px', '26px', '338px' ],
						children :
						[
							{
								type : 'html',
								id : 'btnAddNewMarker',
								onClick: function() { setMode('AddMarker'); },
								html : '<div tabindex="-1" title="' + lang.addMarker + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 -50px;">' +
									'</div>'
							},
							{
								type : 'html',
								id : 'btnAddNewLine',
								onClick: function() { setMode('AddLine'); },
								html : '<div tabindex="-1" title="' + lang.addLine + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 -25px;">' +
									'</div>'
							},
							{
								type : 'html',
								id : 'btnAddNewArea',
								onClick: function() { setMode('AddArea'); },
								html : '<div tabindex="-1" title="' + lang.addArea + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 0;">' +
									'</div>'
							},
							{
								type : 'html',
								id : 'btnAddNewCircle',
								onClick: function() { setMode('AddCircle'); },
								html : '<div tabindex="-1" title="' + lang.addCircle + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 -125px;">' +
									'</div>'
							},
							{
								type : 'html',
								id : 'btnAddNewText',
								onClick: function() { setMode('AddText'); },
								html : '<div tabindex="-1" title="' + lang.addText + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 -75px;">' +
									'</div>'
							},
							{
								type : 'html',
								id : 'btnKmlToggle',
								onClick: function() {
									// Toggle visibility
									var div = theDialog.getContentElement('Elements', 'KMLContainer').getElement();

									if (div.$.style.display == 'none' )
										div.show();
									else
										div.hide();
								},
								html : '<div tabindex="-1" title="' + lang.addKML + '"' +
									' class="GMapsButton"' +
									' style="background-position: 0 -100px;">' +
									'</div>'
							},
							{ //padding at the right
								type : 'html',
								html : '<div>&nbsp;</div>'
							}
						]
					},
					{
						id : 'KMLContainer',
						type : 'hbox',
						widths : [ '370px' ],
						hidden : true,
						children :
						[
							{
								id : 'txtKMLUrl',
								type : 'text',
								labelLayout : 'horizontal',
								label : lang.kmlUrl,
								onBlur: onKmlChange,
								onKeyup: function( evt )
								{
									if ( evt.data.getKeystroke() == 13 )
									{
										onKmlChange();
										evt.stop();
										return false;
									}
								},
								// extra code due to #7516
								onKeydown: function( evt )
								{
									if ( evt.data.getKeystroke() == 13 )
									{
										evt.stop();
										evt.data.preventDefault( true );
										evt.data.stopPropagation();
										return false;
									}
								},
								validate: function()
								{
									var url = this.getValue();

									if ( !url )
										return true;

									var match = /:\/\/(.*?)\//.exec(url);
									if (!match || match[1].indexOf('.')==-1)
									{
										alert("Error: You must provide a public server in the url of KML files.");
										return false;
									}
								}
							},
							{
								type : 'button',
								id : 'browse',
								hidden : true,
								filebrowser :
								{
									action : 'Browse',
									target: 'Elements:txtKMLUrl',
									url: editor.config.filebrowserKmlBrowseUrl || editor.config.filebrowserBrowseUrl,
									onSelect : onKmlChange
								},
								label : editor.lang.common.browseServer
							}
						]
					}
				]
			}
		]
	};
} );
