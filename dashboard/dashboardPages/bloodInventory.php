<style>
    <?php 
    include "assets/css/bloodInventory.css"?>
</style>
<div class="inventoryWrapper">
    <div class="inventoryHeader">
        <h2>Blood Inventory Management</h2>
    </div>

    <div class="inventoryStats">
        <div class="invStatCard">
            <h4>Total Volume</h4>
            <p>18,450 <span>ml</span></p>
        </div>
        <div class="invStatCard warning">
            <h4>Low Stock Alerts</h4>
            <p>3 <span>Groups</span></p>
        </div>
        <div class="invStatCard info">
            <h4>Total Centers</h4>
            <p>7 <span>Active</span></p>
        </div>
    </div>

    <div class="tableContainer">
        <table class="styledTable">
            <thead>
                <tr>
                    <th>Center Name</th>
                    <th>Blood Group</th>
                    <th>Quantity (ml)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prishtina</td>
                   
                    <td>
                        <select class="inlineSelect bloodType">
                            <option value="A+">A+</option>
                            <option value="A-" selected>A-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="inlineInput" value="4500">
                    </td>
                </tr>

                <tr>
                   <td>Gjilan</td>
                    <td>
                        <select class="inlineSelect bloodType">
                            <option value="O-">O-</option>
                            <option value="AB-" selected>AB-</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="inlineInput" value="250">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>