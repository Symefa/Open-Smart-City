/**
*	Copyright Smalarobotics 2015
*	Cybernature Project
*	Alifa Izzan
*/

$(function(){
				var map = new GMap2(document.getElementById('map'));
				//var SMAN5 = new GLatLng(-7.256629, 112.750294);
				//map.setCenter(SMAN5, 18);
				var bounds = new GLatLngBounds();
				var geo = new GClientGeocoder(); 
				var sometext = null;
				//error handler
				var reasons=[];
				reasons[G_GEO_SUCCESS]            = "Success";
				reasons[G_GEO_MISSING_ADDRESS]    = "Missing Address";
				reasons[G_GEO_UNKNOWN_ADDRESS]    = "Unknown Address.";
				reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Unavailable Address";
				reasons[G_GEO_BAD_KEY]            = "Bad API Key";
				reasons[G_GEO_TOO_MANY_QUERIES]   = "Too Many Queries";
				reasons[G_GEO_SERVER_ERROR]       = "Server error";
				
				// load data maps
				$.getJSON("index.php?action=listpoints", function(json) {
					if (json.Locations.length > 0) {
						for (i=0; i<json.Locations.length; i++) {
							var location = json.Locations[i];
							addLocation(location);
						}
						zoomToBounds();
					}
				});
				
				$("#add-point").submit(function(){
					geoEncode();
					return false;
				});
				
				function savePoint(geocode) {
					var data = $("#add-point :input").serializeArray();
					data[data.length] = { name: "lng", value: geocode[0] };
					data[data.length] = { name: "lat", value: geocode[1] };
					$.post($("#add-point").attr('action'), data, function(json){
						$("#add-point .error").fadeOut();
						if (json.status == "fail") {
							$("#add-point .error").html(json.message).fadeIn();
						}
						if (json.status == "success") {
							$("#add-point :input[name!=action]").val("");
							var location = json.data;
							addLocation(location);
							zoomToBounds();
						}
					}, "json");
				}
				
				function geoEncode() {
					var address = $("#add-point input[name=address]").val();
					geo.getLocations(address, function (result){
						if (result.Status.code == G_GEO_SUCCESS) {
							geocode = result.Placemark[0].Point.coordinates;
							savePoint(geocode);
						} else {
							var reason="Code "+result.Status.code;
							if (reasons[result.Status.code]) {
								reason = reasons[result.Status.code]
							} 
							$("#add-point .error").html(reason).fadeIn();
							geocode = false;
						}
					});
				}
				
				function addLocation(location) {
					var point = new GLatLng(location.lat, location.lng);		
					var marker = new GMarker(point);
					map.addOverlay(marker);
					bounds.extend(marker.getPoint());
					
					$("<li/>")
						.html(location.name)
						.attr('id','a'+location.id)
						.click(function(){
							showMessage(marker, location);
							/* //show
							 $(this).next().slideToggle('fast');
							 //Hide
							 $(".normal").not($(this).next()).slideUp('fast');*/
							 $(this).toggleClass('toggled').siblings('.toggled').removeClass('toggled');
							 })
						.appendTo("#list");
					//$("<span class="+"normal"+"/>")
					//   .html(location.keluhan).appendTo("#list");
					GEvent.addListener(marker, "click", function(){
						document.getElementById('a'+location.id).click();
					});
				}
				
				function zoomToBounds() {
					map.setCenter(bounds.getCenter());
					map.setZoom(map.getBoundsZoomLevel(bounds)-1);
				}
				
				$("#message").appendTo( map.getPane(G_MAP_FLOAT_SHADOW_PANE) );
				
				function showMessage(marker, location){
					if (sometext == location.name){
						sometext = null;
						$("#message").fadeOut();
						zoomToBounds();
						
					}
					else {
				    var PointS = new GLatLng(marker.getPoint().lat(),marker.getPoint().lng());
					map.setCenter(PointS, 18);
					map.setZoom(map.getBoundsZoomLevel(bounds)-1);
					var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());
					$("#message").hide().fadeIn()
						.css({ top:markerOffset.y, left:markerOffset.x })
						.html(location.name);
						$("<span id="+"normal"+"/>").html(location.keluhan).appendTo("#message");
						sometext = location.name;
					}
				}
			});