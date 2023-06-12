
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

  // An array of the 24 known email domains
  var knownDomains = [
    'gmail.com',
    'yahoo.com',
    'hotmail.com',
    'aol.com',
    'protonmail.com',
    'outlook.com',
    'icloud.com',
    'zoho.com',
    'mail.com',
    'gmx.com',
    'fastmail.com',
    'hushmail.com',
    'inbox.com',
    'blueyonder.co.uk',
    'lycos.com',
    'rediffmail.com',
    'sina.com',
    '123.com',
    'runbox.com',
    'yandex.com',
    'libero.it',
    'wanadoo.fr',
    'gmx.de',
    'web.de'
  ];

  // A simple regular expression for basic email validation
  var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if (!regex.test(email)) {
    // The email is not valid
    document.getElementById('emailError').textContent = 'Invalid email address.';
    e.preventDefault();
  } else {
    // Get the domain of the entered email
    var emailDomain = email.split('@')[1];

    // Check if the email domain is in the known domains list
    if (!knownDomains.includes(emailDomain)) {
      document.getElementById('emailError').textContent = 'Please use a known email provider.';
      e.preventDefault();
    }
  }
});

//create a function to validate the form
function validateForm() {
  var name = document.getElementById('FormControlInput1').value;
  var email = document.getElementById('FormControlInput2').value;
  var message = document.getElementById('FormControlTextarea1').value;

  if (name.trim() === '') {
    alert('Name must be filled out');
    return false;
  }
  if (email.trim() === '') {
    alert('Email must be filled out');
    return false;
  }
  if (message.trim() === '') {
    alert('Message must be filled out');
    return false;
  }

  return true; // Return true to allow form submission
}
