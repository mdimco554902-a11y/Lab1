<?php
include "../db.php";
include "../nav.php";
?>
<h2>Bookings Overview</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <tr style="background-color: #eee;">
        <th>Booking ID</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM bookings");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['booking_id']}</td>
                <td>{$row['status']}</td>
                <td>{$row['booking_date']}</td>
              </tr>";
    }
    ?>
</table>
