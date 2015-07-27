/* global script */
$(function() {
  
    var mapOptions = {
    center: { lat: -7.256629, lng: 112.750294},
    zoom: 9,
    streetViewControl: false,
    panControlOptions: {
      position: google.maps.ControlPosition.RIGHT_CENTER
    },
    zoomControlOptions: {
      position: google.maps.ControlPosition.RIGHT_CENTER
    },
    mapTypeControlOptions: {
      position: google.maps.ControlPosition.RIGHT_BOTTOM
    }
  }

  var sometext = null;
  var map = new GMap2(document.querySelector('#map-canvas'), mapOptions)
  var bounds = new GLatLngBounds();
  var geo = new GClientGeocoder(); 

  $.getJSON("listpoints", function(json) {
        if (json.Locations.length > 0) {
            for (i=0; i<json.Locations.length; i++) {
                
                var location = json.Locations[i];
                
                addLocation(location);
            }
            zoomToBounds();
        }
    });

function addLocation(location) {
    var point = new GLatLng(location.lat, location.lng);    
    var marker = new GMarker(point);
    map.addOverlay(marker);
    bounds.extend(marker.getPoint());
    
    var container = document.createElement('div');
    var title = document.createElement('h3');
    var details = document.createElement('p');

    title.innerHTML = location.name;
    details.innerHTML = location.keluhan;

    container.appendChild(title);
    container.appendChild(details);
    container.setAttribute('class', 'item pointer');
    container.setAttribute('id', 'item' + location.id);
   
    container.addEventListener('click',function(e){
    showmessage(marker, location);
    });
    document.getElementsByClassName("list pure-u-1-5")[0].appendChild(container);
    GEvent.addListener(marker, "click", function(){
            document.getElementById('item'+location.id).click();
        });
  }

function zoomToBounds() {
    map.setCenter(bounds.getCenter());
    map.setZoom(map.getBoundsZoomLevel(bounds)-1);
    }

$("#message").appendTo( map.getPane(G_MAP_FLOAT_SHADOW_PANE) );

function showmessage(marker, location){
     if (sometext == location.name){
            sometext = null;
            $("#message").fadeOut();
            zoomToBounds();
        }
        else {

            var PointS = new GLatLng(marker.getPoint().lat(),marker.getPoint().lng());
            var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());

            map.setCenter(PointS, 18);
            map.setZoom(map.getBoundsZoomLevel(bounds)-1);

            sometext = location.name;

            $("#message").hide().fadeIn()
                .css({ top:markerOffset.y, left:markerOffset.x })
                .html(location.name);

            $("<span id="+"normal"+"/>")
                .html(location.keluhan).appendTo("#message");
              }
      }
});