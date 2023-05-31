// Get the sign-in and sign-up button elements
var signInButton = document.getElementById('signin-btn');
var signUpButton = document.getElementById('signup-btn');

// Add click event listener to the sign-in button
signInButton.addEventListener('click', function() {
  // Navigate to another file or URL for sign in
  window.location.href = 'signin.html'; // Replace 'signin.html' with the desired file or URL
});

// Add click event listener to the sign-up button
signUpButton.addEventListener('click', function() {
  // Navigate to another file or URL for sign up
  window.location.href = 'signup.html'; // Replace 'signup.html' with the desired file or URL
});