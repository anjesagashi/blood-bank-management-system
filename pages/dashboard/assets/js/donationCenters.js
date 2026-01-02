const modal = document.getElementById("centerModal");
const editModal = document.getElementById("editCenterModal");
function openCenterModal() {
  modal.style.display = "block";
}
function openEditCenterModal() {
  editModal.style.display = "block";
}
function closeCenterModal() {
  modal.style.display = "none";
  document.getElementById("centerForm").reset();
}
function closeEditCenterModal() {
  editModal.style.display = "none";
  document.getElementById("centerForm").reset();
}
