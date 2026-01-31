<?php
include "../config.php";
include "../crud/inventory/inventoryLogic.php";
$db = new Database();
$inventoryObj = new Inventory($db->getConnection());

$stats = $inventoryObj->getInventoryStats();
$inventoryData = $inventoryObj->getFullInventory();
?>

<style>
    <?php include "assets/css/bloodInventory.css"; ?>
</style>

<div class="inventoryWrapper">
    <div class="inventoryHeader">
        <h2>Blood Inventory Management</h2>
    </div>

    <div class="inventoryStats">
        <div class="invStatCard">
            <h4>Total Volume</h4>
            <p><?php echo $stats['total_volume'] ?? 0; ?> <span>ml</span></p>
        </div>
        <div class="invStatCard warning">
            <h4>Low Stock Alerts</h4>
            <p><?php echo $stats['low_stock_count'] ?? 0; ?> <span>Groups</span></p>
        </div>
        <div class="invStatCard info">
            <h4>Total Centers</h4>
            <p><?php echo $stats['total_centers'] ?? 0; ?> <span>Active</span></p>
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
                <?php if (!empty($inventoryData)): ?>
                    <?php foreach ($inventoryData as $row): ?>
                        <tr>
                            <td><?php echo $row['center_name']; ?></td>
                            <td>
                                <span class="bloodBadge"><?php echo $row['group_name']; ?></span>
                            </td>
                            <td>
                                <input type="text" class="inlineInput" value="<?php echo $row['quantity_ml']; ?>" readonly>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No blood inventory records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>