
// This is the JavaScript file for the Google Map on the contact page.
function initMap() {
        // The location of Atlanta
        var atlanta = { lat: 33.748995, lng: -84.387982 };

        // The map, centered at Atlanta
        var map = new google.maps.Map(
          document.querySelector('.googlemap'), { zoom: 15, center: atlanta });

        // The marker, positioned at Atlanta
        var marker = new google.maps.Marker({ position: atlanta, map: map });
      }