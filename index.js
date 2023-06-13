
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

// This is the JavaScript file for the form validation on the contact page.
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
      document.getElementById("emailError").textContent = "Invalid email domain";
      return false;
    }

    if (message.trim() === "") {
      alert("Message must be filled out");
      return false;
    }

    alert("Email form created successfully!");
    return true;
  }

 function validateEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }

  function sendEmail(event) {
      event.preventDefault();

      var name = document.getElementById("FormControlInput1").value;
      var email = document.getElementById("FormControlInput2").value;
      var message = document.getElementById("FormControlTextarea1").value;

      if (!validateForm()) return false; // stop here if the form validation fails

      var subject = "Contact Form Submission";
      var body = "Preferred Name: " + name + "\Secondary Email: " + email + "\n\n\n" + message;

      var mailtoLink = "mailto:nasirwatts@outlook.com" + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);

      var link = document.createElement("a");
      link.href = mailtoLink;
      link.target = "_blank";
      link.style.display = "none";

      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

       // The form should be reset after the email sending action is complete
          setTimeout(function () {
            document.getElementById('contactForm').reset();
          }, 0);
        }

        // Attach the 'sendEmail' function to the form's submit event
        // document.getElementById('contactForm').addEventListener('submit', sendEmail);
