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
const regLastname = document.getElementById("regLastname");
const regEmail = document.getElementById("regEmail");
const regbirthdate = document.getElementById("regBirthdate");
const regBlood = document.getElementById("regBlood");
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

/* LOGIN VALIDIM */
loginForm.addEventListener("submit", (e) => {
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

  if (!valid) {
    e.preventDefault(); // ❗ vetëm kur ka gabime
  }
});

/* REGISTER VALIDIM */
registerForm.addEventListener("submit", (e) => {
  let valid = true;

  if (regUsername.value.trim() === "") {
    showError(regUsername, "Username is required");
    valid = false;
  } else {
    showSuccess(regUsername);
  }

  if (regLastname.value.trim() === "") {
    showError(regLastname, "Lastname is required");
    valid = false;
  } else {
    showSuccess(regLastname);
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

  if (regBlood.value === "") {
    showError(regBlood, "Select blood group");
    valid = false;
  } else {
    showSuccess(regBlood);
  }

  if (regbirthdate.value === "") {
    showError(regbirthdate, "Birthdate is required");
    valid = false;
  } else {
    const selectedDate = new Date(regbirthdate.value);
    const maxDate = new Date(regbirthdate.max);

    if (selectedDate > maxDate) {
      showError(regbirthdate, "You must be at least 16 years old");
      valid = false;
    } else {
      showSuccess(regbirthdate);
    }
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

  // ❗ Nëse ka gabime → ndalo submit
  if (!valid) {
    e.preventDefault();
  }
});

/* Birthdate max 16 vjet */
const today = new Date();
today.setFullYear(today.getFullYear() - 16);
regbirthdate.max = today.toISOString().split("T")[0];
