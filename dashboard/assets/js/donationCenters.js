const modal = document.getElementById("centerModal");
const editModal = document.getElementById("editCenterModal");
function openCenterModal() {
  modal.style.display = "block";
}
function openEditCenterModal(centerId) {
  const currentUrl = window.location.pathname + window.location.search;
  window.location.href = currentUrl + "&edit_id=" + centerId;
}
function closeCenterModal() {
  modal.style.display = "none";
  document.getElementById("centerForm").reset();
}
function closeEditCenterModal() {
  editModal.style.display = "none";
  document.getElementById("editCenterForm").reset();
  window.location.href = "index.php?page=donationCenters";
}
function confirmDelete(centerId) {
  const currentUrl = window.location.pathname + window.location.search;
  window.location.href = currentUrl + "&delete_id=" + centerId;
}
