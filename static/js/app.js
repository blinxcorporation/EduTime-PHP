//Toggle Show/Hide Password
const togglePassword = document.querySelector("#togglePasswordCheckBox");
// console.log(togglePassword);

const password = document.querySelector("#password");
// console.log(password);

togglePassword.addEventListener("click", () => {
  // Toggle the type attribute using
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";

  password.setAttribute("type", type);
});

//validate password
// Get the password input element and the messages elements
var passwordInput = document.getElementById("password");
var messageLength = document.getElementById("message-length");
var messageUppercase = document.getElementById("message-uppercase");
var messageLowercase = document.getElementById("message-lowercase");
var messageNumber = document.getElementById("message-number");
var messageSpecialChar = document.getElementById("message-special-char");

// Add an input event listener to the password input element
passwordInput.addEventListener("input", function () {
  // Get the current password value from the input field
  var password = passwordInput.value;

  // Validate the password and show validation messages for each requirement
  if (password.length < 8) {
    messageLength.textContent = "Password must be at least 8 characters long.";
    messageLength.style.color = "red";
  } else {
    messageLength.textContent = "";
  }

  if (!/[A-Z]/.test(password)) {
    messageUppercase.textContent = "Password must include an uppercase letter.";
    messageUppercase.style.color = "red";
  } else {
    messageUppercase.textContent = "";
  }

  if (!/[a-z]/.test(password)) {
    messageLowercase.textContent = "Password must include a lowercase letter.";
    messageLowercase.style.color = "red";
  } else {
    messageLowercase.textContent = "";
  }

  if (!/\d/.test(password)) {
    messageNumber.textContent = "Password must include a number.";
    messageNumber.style.color = "red";
  } else {
    messageNumber.textContent = "";
  }

  if (!/[\W_]/.test(password)) {
    messageSpecialChar.textContent =
      "Password must include a special character.";
    messageSpecialChar.style.color = "red";
  } else {
    messageSpecialChar.textContent = "";
  }
});
