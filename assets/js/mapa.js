var geocoder;
var map;
var marker;
 
function initialize() {
    return false;
    var latitude= $("#latitude").val();
    var longitude= $("#longitude").val();
   
    if ( latitude =="" && longitude ==""){
        latitude= '-22.9127365';
        longitude='-43.174781199999984';
    }
       // var latlng = new google.maps.LatLng(-22.9127365, -43.174781199999984);
     var latlng = new google.maps.LatLng(latitude, longitude);
    var options = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    map = new google.maps.Map(document.getElementById("mapa"), options);
 
    geocoder = new google.maps.Geocoder();
 
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });
 
    marker.setPosition(latlng);
}
 
$(document).ready(function () {
    initialize();
});