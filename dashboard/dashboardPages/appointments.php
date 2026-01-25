<style>
    <?php
    include "assets/css/appointments.css"; 
    ?>
</style>
<div class="appointmentsContainer">
    <div class="headerSection">
            <h1>Today's Appointments</h1>
            <p>Processing donors for: <strong><?php echo date('d-m-Y'); ?></strong></p>
    </div>

    <table class="styledTable">
        <thead>
            <tr>
                <th>Time</th>
                <th>Donor Name</th>
                <th>Blood Type</th>
                <th>Mark Process</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>09:00 AM</td>
                <td><strong>Lirim Krasniqi</strong></td>
                <td><span class="bloodType">AB+</span></td>
                <td>
                    <select class="statusSelect">
                        <option value="approved" selected>Awaiting Arrival</option>
                        <option value="completed">Mark as Completed</option>
                        <option value="rejected">Medical Rejection</option>
                        <option value="cancelled">No Show / Cancelled</option>
                    </select>
                </td>
               
            </tr>

            <tr>
                <td>10:30 AM</td>
                <td><strong>Dafina Zeqiri</strong></td>
                <td><span class="bloodType">O-</span></td>
                <td>
                    <select class="statusSelect">
                        <option value="approved" selected>Awaiting Arrival</option>
                        <option value="completed">Mark as Completed</option>
                        <option value="rejected">Medical Rejection</option>
                        <option value="cancelled">No Show / Cancelled</option>
                    </select>
                </td>
                
            </tr>
        </tbody>
    </table>
</div>
