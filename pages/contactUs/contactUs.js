document.getElementById("contactForm").addEventListener("submit", function (e) {
  

  const subject = document.getElementById("subject");
  const message = document.getElementById("message");

  const subjectError = document.getElementById("subjectError");
  const messageError = document.getElementById("messageError");

  // Reset errors
  subjectError.textContent = "";
  messageError.textContent = "";

  let isValid = true;

  if (subject.value.trim() === "") {
    subjectError.textContent = "Subject cannot be empty";
    isValid = false;
  }

  if (message.value.trim() === "") {
    messageError.textContent = "Message cannot be empty";
    isValid = false;
  }

  if (!isValid) {
   
    e.preventDefault();
  }
});
