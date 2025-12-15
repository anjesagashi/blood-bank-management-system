document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();

  
  const name = document.getElementById("name");
  const email = document.getElementById("email");
  const subject = document.getElementById("subject");
  const message = document.getElementById("message");

  
  const nameError = document.getElementById("nameError");
  const emailError = document.getElementById("emailError");
  const subjectError = document.getElementById("subjectError");
  const messageError = document.getElementById("messageError");

  
  nameError.textContent = "";
  emailError.textContent = "";
  subjectError.textContent = "";
  messageError.textContent = "";

  let isValid = true;

  
  const nameRegex = /^[A-Za-zA-z\s]{2,30}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  const subjectRegex = /^[A-Za-z0-9A-z\s]{3,50}$/;
  const messageRegex = /^.{10,500}$/;

 
  if (!nameRegex.test(name.value.trim())) {
    nameError.textContent = "Name must be 2–30 letters only";
    isValid = false;
  }


  if (!emailRegex.test(email.value.trim())) {
    emailError.textContent = "Enter a valid email address";
    isValid = false;
  }


  if (!subjectRegex.test(subject.value.trim())) {
    subjectError.textContent = "Subject must be 3–50 characters";
    isValid = false;
  }

 
  if (!messageRegex.test(message.value.trim())) {
    messageError.textContent = "Message must be at least 10 characters";
    isValid = false;
  }

  
  if (isValid) {
    alert("✅ Message sent successfully!");
    document.getElementById("contactForm").reset();
  }
});
