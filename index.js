
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
  function validateForm() {
    var name = document.getElementById("FormControlInput1").value;
    var email = document.getElementById("FormControlInput2").value;
    var message = document.getElementById("FormControlTextarea1").value;

    if (name.trim() === "") {
      alert("Name must be filled out");
      return false;
    }

    if (email.trim() === "") {
      alert("Email must be filled out");
      return false;
    }

    if (!validateEmail(email)) {
      document.getElementById("emailError").textContent = "Invalid email address";
      return false;
    }

    if (message.trim() === "") {
      alert("Message must be filled out");
      return false;
    }

    return true;
  }

  function validateEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
