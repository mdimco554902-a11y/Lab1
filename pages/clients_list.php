<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id ASC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Clients</title></head>
<body>
<div class="container">
    <?php include "../nav.php"; ?>
    
    <h2>Clients Directory</h2>
    <a href="clients_add.php" class="btn-add">+ Add New Client</a>
    
    <table>
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['client_id']; ?></td>
          <td><strong><?php echo $row['full_name']; ?></strong></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td>
            <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>" class="edit-link">Edit</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
</div>
</body>
</html>