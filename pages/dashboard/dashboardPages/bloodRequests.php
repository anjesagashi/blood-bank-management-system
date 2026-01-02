<style>
    <?php
    include "assets/css/bloodRequests.css"; 
    ?>
</style>
<div class="bloodRequestContainer">
    <h2 >Active Center Requests (Appeals)</h2>
    
    <table class="styledTable">
        <thead>
            <tr>
                <th>Center Name</th>
                <th>Blood Needed</th>
                <th>Target Quantity</th>
                <th>Progress Status</th>
                <th>Urgency</th>
                <th>Admin Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Prishtina Blood Center</strong></td>
                <td><span class="bloodBadge">O-</span></td>
                <td>5 Liters</td>
                <td>
                    <div class="progressContainer">
                        <div class="progressBar">40%</div>
                    </div>
                </td>
                <td><span class="urgencyHigh">Critical</span></td>
                <td>
                    <button class="btnView">View Donors</button>
                    <button class="btnStop">Stop Call</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
