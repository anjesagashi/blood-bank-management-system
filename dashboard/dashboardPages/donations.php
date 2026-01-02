<style>
    <?php include "assets/css/donations.css"; ?>
</style>
<div class="donationContainer">
    <div class="pageHeader">
        <h2 class="mainTitle">Blood Donations Management</h2>
    </div>

    <div class="card">
        <div class="cardHeader">
            <h3>New Donation Requests</h3>
            <p>Users have selected their preferred center. Please set the date.</p>
        </div>
        <table class="styledTable">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Blood Type</th>
                    <th>Requested Center</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Agon Berisha</strong></td>
                    <td><span class="bloodBadge">O+</span></td>
                    <td>Qendra në Prishtinë</td> <td>
                        <input type="date" class="inputField">
                    </td>
                    <td><button class="btn confirm">Approve & Schedule</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="cardHeader">
            <h3>Donation History</h3>
        </div>
        <table class="styledTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Donor Name</th>
                    <th>Center</th>
                    <th>Scheduled Date</th>
                    <th>Amount(ml)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1024</td>
                    <td>Filan Fisteku</td>
                    <td>Qendra Prishtinë</td>
                    <td>15/01/2025</td>
                    <td>450</td>
                </tr>
                <tr>
                    <td>#1020</td>
                    <td>Ana Murati</td>
                    <td>Qendra Pejë</td>
                    <td>05/12/2024</td>
                    <td>500</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
