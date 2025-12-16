const container = document.querySelector(".container");
const registerBtn = document.querySelector(".registerBtn");
const loginBtn = document.querySelector(".loginBtn");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");

const loginUsername = document.getElementById("loginUsername");
const loginPassword = document.getElementById("loginPassword");

const regUsername = document.getElementById("regUsername");
const regEmail = document.getElementById("regEmail");
const regPassword = document.getElementById("regPassword");

function showError(input, message) {
  const inputBox = input.parentElement;
  const errorSpan = inputBox.querySelector(".errorMessage");

  errorSpan.innerText = message;
  input.classList.add("inputError");
  input.classList.remove("inputSuccess");
}

function showSuccess(input) {
  const inputBox = input.parentElement;
  const errorSpan = inputBox.querySelector(".errorMessage");

  errorSpan.innerText = "";
  input.classList.remove("inputError");
  input.classList.add("inputSuccess");
}

loginForm.addEventListener("submit", (e) => {
  e.preventDefault();
  let valid = true;

  if (loginUsername.value.trim() === "") {
    showError(loginUsername, "Username is required");
    valid = false;
  } else {
    showSuccess(loginUsername);
  }

  if (loginPassword.value.trim() === "") {
    showError(loginPassword, "Password is required");
    valid = false;
  } else if (loginPassword.value.length < 6) {
    showError(loginPassword, "Min 6 characters");
    valid = false;
  } else {
    showSuccess(loginPassword);
  }

  if (valid) {
    console.log("Login successful");
    window.location.href = "../../pages/homePage/homePage.html";
  }
});

registerForm.addEventListener("submit", (e) => {
  e.preventDefault();
  let valid = true;

  if (regUsername.value.trim() === "") {
    showError(regUsername, "Username is required");
    valid = false;
  } else {
    showSuccess(regUsername);
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (regEmail.value.trim() === "") {
    showError(regEmail, "Email is required");
    valid = false;
  } else if (!emailRegex.test(regEmail.value)) {
    showError(regEmail, "Invalid email");
    valid = false;
  } else {
    showSuccess(regEmail);
  }

  if (regPassword.value.trim() === "") {
    showError(regPassword, "Password is required");
    valid = false;
  } else if (regPassword.value.length < 6) {
    showError(regPassword, "Min 6 characters");
    valid = false;
  } else {
    showSuccess(regPassword);
  }

  if (valid) {
    console.log("Registration successful");
    registerForm.reset();
  }
});
