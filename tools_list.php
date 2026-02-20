<?php
include "../db.php";
include "../nav.php";
?>
<h2>Equipment & Tools</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <tr style="background-color: #eee;">
        <th>Tool Name</th>
        <th>Status</th>
    </tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM tools");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['tool_name']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
    ?>
</table>
