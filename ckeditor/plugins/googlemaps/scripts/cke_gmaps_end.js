/* CK googlemapsEnd v3.6 */
(function() {
"use strict";

window.initGmapsLoader = function(e)
{
	if (e)
	{
		var obj = e.target || e.srcElement;
		if (obj) obj.onclick=null;
	}

	if (window.google)
	{
		if (window.google.maps && (!window.gmapsGeometry || google.maps.geometry) && (!window.gmapsWeather || google.maps.weather))
		{
			initializeMaps();
			return;
		}
		if (window.google.load)
		{
			google.load("maps", "3", {"callback":initializeMaps,other_params:"sensor=false" + getMapsLibraries()});
			return;
		}
	}
	if (document.getElementById("gmapsLoader")) return;

	var script = document.createElement("script");
	script.src = "//maps.googleapis.com/maps/api/js?sensor=false" + getMapsLibraries() + "&callback=initializeMaps";
	script.type = "text/javascript";
	script.id = "gmapsLoader";
	document.getElementsByTagName("head")[0].appendChild(script);
};

function getMapsLibraries()
{
	var libraries="";
	if (window.gmapsGeometry) libraries="geometry";
	if (window.gmapsWeather) libraries+=( !libraries ? "" : ",") + "weather";
	if (libraries) libraries="&libraries=" + libraries;
	if (window.gmapsKey) libraries+="&key=" + window.gmapsKey;
	return libraries;
}
window.initializeMaps = function()
{
	if (!Label.prototype.onAdd)
		InitializeLabels();

	window.loadedGMaps=[];

	for(var i=0; i<gmapsLoaders.length; i++)
		gmapsLoaders[i]();

	gmapsLoaders=[];
	if (window.onLoadedGMaps)
		window.onLoadedGMaps()
};

window.CKEMap = function(div, options)
{
	var allMapTypes = [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.TERRAIN];
	var myOptions = {
		zoom: options.zoom,
		center: new google.maps.LatLng(options.center[0], options.center[1]),
		mapTypeId: allMapTypes[ options.mapType ],
		heading: options.heading,
		tilt: options.tilt,
		scaleControl: options.scaleControl,
		overviewMapControl: options.overviewMapControl,
		overviewMapControlOptions: options.overviewMapControlOptions
	};
	switch (options.zoomControl)
	{
		case "None":
			myOptions.zoomControl = false;
			myOptions.panControl = false;
			myOptions.streetViewControl = false;
			myOptions.rotateControl = false;
			break;
		case "Default":
			myOptions.zoomControl = true;
			break;
		case "Small":
			myOptions.zoomControl = true;
			myOptions.zoomControlOptions = {style: google.maps.ZoomControlStyle.SMALL};
			break;
		case "Full":
			myOptions.zoomControl = true;
			myOptions.zoomControlOptions = {style: google.maps.ZoomControlStyle.ZOOM_PAN};
			break;
	}
	switch (options.mapsControl)
	{
		case "None":
			myOptions.mapTypeControl = false;
			break;
		case "Default":
			myOptions.mapTypeControl = true;
			break;
		case "Full":
			myOptions.mapTypeControl = true;
			myOptions.mapTypeControlOptions = {style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR};
			break;
		case "Menu":
			myOptions.mapTypeControl = true;
			myOptions.mapTypeControlOptions = {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU};
			break;
	}
	this.map = new google.maps.Map(div, myOptions);
	if (options.weather) {
		var wopts = { map: this.map};
		if (options.weatherUsaUnits)
		{
			wopts.temperatureUnits = google.maps.weather.TemperatureUnit.FAHRENHEIT;
			wopts.windSpeedUnits = google.maps.weather.WindSpeedUnit.MILES_PER_HOUR;
		}
		var weatherLayer = new google.maps.weather.WeatherLayer( wopts );
	}
	/* old version*/
	if (options.traffic) {
		this.pathsLayer = new google.maps.TrafficLayer();
		this.pathsLayer.setMap( this.map );
	}
	if (options.transit) {
		this.pathsLayer = new google.maps.TransitLayer();
		this.pathsLayer.setMap( this.map );
	}
	/* new version*/
	switch (options.pathType)
	{
		case 'Default':
			break;
		case 'Traffic':
			this.pathsLayer = new google.maps.TrafficLayer();
			this.pathsLayer.setMap( this.map );
			break;
		case 'Transit':
			this.pathsLayer = new google.maps.TransitLayer();
			this.pathsLayer.setMap( this.map );
			break;
		case 'Bicycle':
			this.pathsLayer = new google.maps.BicyclingLayer();
			this.pathsLayer.setMap( this.map );
			break;
	}

	loadedGMaps.push(this);

	if (options.panorama)
	{
		var pan = options.panorama;
		var panorama = this.map.getStreetView();
		panorama.setVisible(true);
		panorama.setPov( {heading: pan.pov1, pitch: pan.pov2, zoom: pan.pov3});
		panorama.setPosition( new google.maps.LatLng(pan.lat, pan.lng) );
	}

	return this;
};
CKEMap.prototype.AddMarkers = function(aPoints)
{
	function getIcon(marker)
	{
		var data = window.googleMaps_Icons && googleMaps_Icons[ marker.color ];
		if (!data)
			return {url:"//maps.gstatic.com/mapfiles/ms/micons/" + marker.color + "-dot.png"};
		return {url:data.marker.image};
	}
	function getShadow(marker)
	{
		var data = window.googleMaps_Icons && googleMaps_Icons[ marker.color ];
		if (!data)
		{
			return new google.maps.MarkerImage("//maps.gstatic.com/mapfiles/ms/micons/msmarker.shadow.png", null, null, new google.maps.Point(15, 32));
		}
		if (!data.shadow || !data.shadow.image)
			return null;

		return new google.maps.MarkerImage(data.shadow.image);
	}

	function createMarker(map, data) {
		var icon,
			clickable=(!!data.text),
			point=new google.maps.LatLng(data.lat, data.lon),
			marker = new google.maps.Marker( {position:point, map:map, title:data.title, icon: getIcon(data), clickable:clickable});

		var shadow = getShadow(data);
		if (shadow)
			marker.setShadow(shadow);

		if (data.title)
			new Label({ position:point, text:marker.title, map:map});
		if (clickable) google.maps.event.addListener(marker, "click", function() {
			if (!marker._infoWindow)
				marker._infoWindow =  new google.maps.InfoWindow({
					content: "<div class='InfoContent'>" + data.text + "</div>",
					maxWidth:data.maxWidth
				});
			 marker._infoWindow.open(map, marker);
		});

		if (data.open)
			google.maps.event.trigger(marker, "click");

		marker.data = data;
		return marker;
	}
	this.markers = [];
	for (var i=0; i<aPoints.length; i++)
		this.markers.push(createMarker(this.map, aPoints[i]));
};
CKEMap.prototype.AddTexts = function(aPoints)
{
	this.texts = [];
	for (var i=0; i<aPoints.length; i++)
	{
		var data=aPoints[i];
		if (data.title)
			this.texts.push(new Label({ position:new google.maps.LatLng(data.lat, data.lon), text: "<span>" + data.title + "</span>", map: this.map, className:data.className}));
	}
};
CKEMap.prototype.AddLines = function( aLines )
{
	this.lines = [];
	for (var i=0; i<aLines.length; i++)
	{
		var line = aLines[i],
			l = new google.maps.Polyline( {map:this.map, path: google.maps.geometry.encoding.decodePath(line.points), strokeColor: line.color, strokeOpacity: line.opacity, strokeWeight: line.weight, clickable:false} );
		this.lines.push(l);
	}
};
CKEMap.prototype.AddAreas = function( aAreas )
{
	this.areas = [];
	for (var i=0; i<aAreas.length; i++)
	{
		var area = aAreas[i],
			line = area.polylines[0],
			a = new google.maps.Polygon( {map:this.map, paths: google.maps.geometry.encoding.decodePath(line.points), strokeColor: line.color, strokeOpacity: line.opacity, strokeWeight: line.weight, fillColor:area.color, fillOpacity:area.opacity, clickable:false} );
		this.areas.push(area);
	}
};
CKEMap.prototype.AddCircles = function( aCircles )
{
	this.circles = [];
	for (var i=0; i<aCircles.length; i++)
	{
		var circle = aCircles[i],
			point=new google.maps.LatLng(circle.lat, circle.lon),
			c = new google.maps.Circle( {map:this.map, center: point, radius: circle.radius, strokeColor: circle.color, strokeOpacity: circle.opacity, strokeWeight: circle.weight, fillColor:circle.fillColor, fillOpacity:circle.fillOpacity, clickable:false} );
		this.circles.push(c);
	}
};
CKEMap.prototype.AddKml = function( url )
{
	this.kml = new google.maps.KmlLayer(url, {map:this.map});
};

if (window.gmapsAutoload) {
	if (document.readyState && document.readyState == "complete")
	{
		initGmapsLoader();
	}
	else
	{
		if (window.addEventListener) {
			window.addEventListener("load", initGmapsLoader, false);
		} else {
			window.attachEvent("onload", initGmapsLoader);
		}
	}
}

// ELabel
// http://blog.mridey.com/2009/09/label-overlay-example-for-google-maps.html
function Label(b){this.setValues(b);var a=this.span_=document.createElement("span");a.style.cssText="white-space:nowrap; border:1px solid #999; padding:2px; background-color:white";if(b.className) a.className=b.className;var c=this.div_=document.createElement("div");c.appendChild(a); c.style.cssText="position: absolute; display: none"}
function InitializeLabels(){Label.prototype=new google.maps.OverlayView;Label.prototype.onAdd=function(){var b=this.getPanes().overlayLayer;b.appendChild(this.div_)};Label.prototype.onRemove=function(){this.div_.parentNode.removeChild(this.div_);for(var b=0,a=this.listeners_.length;b<a;++b){google.maps.event.removeListener(this.listeners_[b])}};Label.prototype.draw=function(){var b=this.getProjection(),a=b.fromLatLngToDivPixel(this.get("position")),c=this.div_;c.style.left=a.x+"px";c.style.top=a.y+"px";c.style.display="block";this.span_.innerHTML=this.get("text").toString()}}
})();


