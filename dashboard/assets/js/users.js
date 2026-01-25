const userModal = document.getElementById("userModal");
const editModal = document.getElementById("editUserModal");

function openUserModal() {
  userModal.style.display = "block";
}
function openEditModal(donorId) {
  const currentUrl = window.location.pathname + window.location.search;
  window.location.href = currentUrl + "&edit_id=" + donorId;
}
function closeUserModal() {
  userModal.style.display = "none";
  document.getElementById("userForm").reset();
}
function closeEditModal() {
  editModal.style.display = "none";
  document.getElementById("editUserForm").reset();
  window.location.href = "index.php?page=donors";
}
function confirmDelete(donorId) {
  
    const currentUrl = window.location.pathname + window.location.search;
    window.location.href = currentUrl + "&delete_id=" + donorId;
  
}
