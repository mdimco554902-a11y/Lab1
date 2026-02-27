<?php
include "../db.php";
$message = "";

if (isset($_POST['save'])) {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);

  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address)
            VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Client</title></head>
<body>
<div class="container">
    <?php include "../nav.php"; ?>
    
    <h2>Add Client</h2>
    <?php if($message): ?>
        <p style="background:#fee2e2; color:#ef4444; padding:10px; border-radius:4px;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form method="post">
      <label>Full Name*</label>
      <input type="text" name="full_name" required>
    
      <label>Email*</label>
      <input type="email" name="email" required>
    
      <label>Phone</label>
      <input type="text" name="phone">
    
      <label>Address</label>
      <textarea name="address" rows="3"></textarea>
    
      <button type="submit" name="save">Save Client</button>
    </form>
</div>
</body>
</html>