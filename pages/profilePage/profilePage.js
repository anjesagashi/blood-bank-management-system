const editBtn = document.getElementById("editBtn");
const cancelBtn = document.getElementById("cancelBtn");
const saveBtn = document.querySelector(".saveBtn");
const inputs = document.querySelectorAll(
  ".profileForm input, .profileForm select"
);

editBtn.addEventListener("click", () => {
  inputs.forEach((input) => (input.disabled = false));
  saveBtn.disabled = false;
  cancelBtn.disabled = false;
});

cancelBtn.addEventListener("click", () => {
  inputs.forEach((input) => (input.disabled = true));
  saveBtn.disabled = true;
  cancelBtn.disabled = true;
});
