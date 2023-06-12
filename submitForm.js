$document.ready(function() {
  $('#contactForm').success(function(e) {
    e.preventDefault();

    // Here, call your validateForm function. If the form is valid, continue with the AJAX call.
    if (validateForm()) {
      $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
          // You can handle what happens after successful form submission here.
          alert('Form submitted successfully!');
          reset(); // Call your form reset function here, if it's still needed.
        },
        error: function() {
          // You can handle what happens if there's an error with the form submission here.
          alert('There was an error submitting the form.');
        }
      });
    }
  });
});
