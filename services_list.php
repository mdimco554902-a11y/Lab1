<?php
include "../db.php";
include "../nav.php";
?>
<h2>Our Services</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <tr style="background-color: #eee;">
        <th>Service Name</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM services");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['service_name']}</td>
                <td>{$row['description']}</td>
                <td>₱" . number_format($row['price'], 2) . "</td>
              </tr>";
    }
    ?>
</table>
