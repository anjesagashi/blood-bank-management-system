const userModal = document.getElementById("userModal");
const editModal = document.getElementById("editUserModal");

function openUserModal() {
  userModal.style.display = "block";
}
function openEditModal() {
  editModal.style.display = "block";
}
function closeUserModal() {
  userModal.style.display = "none";
  document.getElementById("userForm").reset();
}
function closeEditModal() {
  editModal.style.display = "none";
  document.getElementById("editUserForm").reset();
}
