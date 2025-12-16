const form = document.getElementById("donorForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("fullName");
  const email = document.getElementById("email");
  const blood = document.getElementById("bloodGroup");

  let valid = true;

  document.querySelectorAll(".error").forEach((e) => (e.textContent = ""));

  if (name.value.trim().length < 3) {
    document.getElementById("nameError").textContent =
      "Name must be at least 3 characters";
    valid = false;
  }

  if (!email.value.includes("@")) {
    document.getElementById("emailError").textContent =
      "Please enter a valid email";
    valid = false;
  }

  if (blood.value === "") {
    document.getElementById("bloodError").textContent =
      "Please select blood group";
    valid = false;
  }

  if (valid) {
    alert("Thank you for becoming a donor ❤️");
    form.reset();
  }
});
