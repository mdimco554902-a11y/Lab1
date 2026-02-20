<?php
include "../db.php";
include "../nav.php";
?>
<h2>Payment History</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <tr style="background-color: #eee;">
        <th>Booking ID</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM payments");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['booking_id']}</td>
                <td>₱" . number_format($row['amount_paid'], 2) . "</td>
                <td>{$row['payment_date']}</td>
              </tr>";
    }
    ?>
</table>
