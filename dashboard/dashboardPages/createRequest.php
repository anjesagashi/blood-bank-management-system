
<style>
    <?php 
     include "assets/css/createRequest.css"; 
    ?>
</style>
<div class="requestContainer">
    <div class="headerSection">
        <h1>Create New Blood Request</h1>
        <p>Complete form to request blood from donors.</p>
    </div>

    <div class="formCard">
        <form action="#" method="POST" class="bloodRequestForm">
            
            <div class="formRow">
                <div class="formGroup">
                    <label for="bloodGroup">Blood Group Needed</label>
                    <select name="blood_group_id" id="bloodGroup" required>
                        <option value="">Select Group</option>
                        <option value="1">A+</option>
                        <option value="2">A-</option>
                        <option value="3">B+</option>
                        <option value="4">B-</option>
                        <option value="5">AB+</option>
                        <option value="6">AB-</option>
                        <option value="7">O+</option>
                        <option value="8">O-</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="urgency">Request Urgency</label>
                    <select name="request_urgency" id="urgency" required class="urgencySelect">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High (Urgent)</option>
                    </select>
                </div>
            </div>

            <div class="formRow">
                <div class="formGroup">
                    <label for="neededAmount">Amount Needed (Bags/Units)</label>
                    <input type="number" name="needed_amount" id="neededAmount" min="1" placeholder="E.g. 10" required>
                </div>

                <div class="formGroup">
                    <label for="collected">Already Collected (Optional)</label>
                    <input type="number" name="collected_amount" id="collected" value="0" min="0">
                </div>
            </div>

           
                <button type="submit" class="btnSubmit">Publish Request</button>
            
        </form>
    </div>
</div>
