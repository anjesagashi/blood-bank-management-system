<style>
    .bloodCenterContainer {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .headerContainer{
        display: flex;
       justify-content: space-between;
    }
</style>
<div class="bloodCenterContainer">
    <div class="headerContainer">
        <h2>Manage Blood Centers</h2>
        <button class="btnAdd" onclick="openCenterModal()">+ Add New Center</button>
    </div>

    <table class="styledTable">
        <thead>
            <tr>
                <th>Center Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Doha Medical Emergency</td>
                <td>Prishtine, Kosove</td>
                <td>+383 44 123 456</td>
                <td class="actionsColumn">
                    <button class="btn" onclick="openEditCenterModal()"><img src="../images/svg/editIcon.svg" alt="Edit"></button>
                    <button class="btn"><img src="../images/svg/deleteIcon.svg" alt="Delete"></button>
                </td>
            </tr>
            <tr>
                <td>Doha Medical Emergency</td>
                <td>Prishtine, Kosove</td>
                <td>+383 44 123 456</td>
                <td class="actionsColumn">
                    <button class="btn" onclick="openEditCenterModal()"><img src="../images/svg/editIcon.svg" alt="Edit"></button>
                    <button class="btn"><img src="../images/svg/deleteIcon.svg" alt="Delete"></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Add Center Modal -->
<div id="centerModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3 id="modalTitle">Add New Blood Center</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeCenterModal()" alt="Close Icon">
        </div>
        <form id="centerForm" novalidate>
            <div class="formGrid">
                 <div class="inputGroup">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                <div class="inputGroup">
                    <label>Center Name</label>
                    <input type="text" id="name" placeholder="Center Name" required>
                </div>
                <div class="inputGroup">
                    <label>Location (City)</label>
                    <input type="text" id="location" placeholder="City" required>
                </div>
                <div class="inputGroup">
                    <label>Phone Number</label>
                    <input type="text" id="phone" placeholder="+383 44 123 456">
                </div>
                <div class="inputGroup fullWidth">
                    <label>Description (Bio)</label>
                    <textarea id="desc" rows="3" placeholder="About Center..."></textarea>
                </div>
                <div class="inputGroup fullWidth">
                    <label>Google Maps Iframe Link (src only)</label>
                    <input type="text" id="map_link" placeholder="Attach source from Google Maps">
                </div>
            </div>
            <div class="modalFooter">
                <button type="button" onclick="closeCenterModal()" class="btnCancel">Cancel</button>
                <button type="submit" class="btnSave">Save Center</button>
            </div>
        </form>
    </div>
</div>
<!-- Edit Center Modal -->
 <div id="editCenterModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Edit Blood Center</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeEditCenterModal()" alt="Close Icon">
        </div>
        <form id="editCenterForm" novalidate>
            <input type="hidden" id="edit_id">
            
            <div class="formGrid">
                <div class="inputGroup">
                    <label>Center Name</label>
                    <input type="text" id="edit_name" required>
                </div>
                <div class="inputGroup">
                    <label>Location (City)</label>
                    <input type="text" id="edit_location" required>
                </div>
                <div class="inputGroup">
                    <label>Phone Number</label>
                    <input type="text" id="edit_phone">
                </div>
                <div class="inputGroup">
                    <label>Working Hours</label>
                    <input type="text" id="edit_hours">
                </div>
                <div class="inputGroup fullWidth">
                    <label>Description (Bio)</label>
                    <textarea id="edit_desc" rows="3"></textarea>
                </div>
                <div class="inputGroup fullWidth">
                    <label>Google Maps Iframe Link</label>
                    <input type="text" id="edit_map_link">
                </div>
            </div>
            <div class="modalFooter">
                <button type="button" onclick="closeEditCenterModal()" class="btnCancel">Cancel</button>
                <button type="submit" class="btnSave">Update Center</button>
            </div>
        </form>
    </div>
</div>
<script>
   <?php 
   include "assets/js/donationCenters.js"
   ?>
</script>