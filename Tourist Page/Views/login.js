// Get elements
const loginContainer = document.querySelector('.login-container');
const registrationForm = document.querySelector('.registration');

// Hide registration form initially
registrationForm.style.display = 'none';

// Add event listener to register link
const registerLink = document.querySelector('.register a');
registerLink.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default link behavior
    loginContainer.style.display = 'none'; // Hide login form container
    registrationForm.style.display = 'block'; // Display registration form
});
