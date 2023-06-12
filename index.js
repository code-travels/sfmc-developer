
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




// This is the JavaScript file for the email validation on the contact page.
document.getElementById('contactForm').addEventListener('submit', function(e) {
  var email = document.getElementById('FormControlInput2').value;

  

  // A simple regular expression for basic email validation
  var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if ("email".match(regex) === null) {
    document.getElementById('emailError').textContent = 'Please enter a valid email address.';
    e.preventDefault();
  } else if (email === '') {
    document.getElementById('emailError').textContent = 'Please enter your email address.';
    e.preventDefault();
  } else if (knownDomains.indexOf(email.split('@')[1]) === -1) {
     document.getElementById('emailError').textContent = 'Please enter a valid email address.';
    e.preventDefault();
  }});
