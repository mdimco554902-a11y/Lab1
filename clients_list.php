<?php
include "../db.php";
include "../nav.php";
?>
<h2>Client List</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <tr style="background-color: #eee;">
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM clients");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['client_id']}</td>
                <td>{$row['full_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
              </tr>";
    }
    ?>
</table>
