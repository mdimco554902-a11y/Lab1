<?php
include "../db.php";
 
 
$booking_id = $_GET['booking_id'];
 
 
$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
 
 
$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];
 
 
$balance = $booking['total_cost'] - $total_paid;
$message = "";
 
 
if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];
 
 
  if ($amount <= 0) {
    $message = "Invalid amount!";
  } else if ($amount > $balance) {
    $message = "Amount exceeds balance!";
  } else {
 
 
    // 1) Insert payment
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
      VALUES ($booking_id, $amount, '$method')");
 
 
    // 2) Recompute total paid (after insert)
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];
 
 
    // 3) Recompute new balance
    $new_balance = $booking['total_cost'] - $total_paid2;
 
 
    // 4) If fully paid, update booking status to PAID
    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }
 
 
    header("Location: bookings_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Process Payment</title></head>
<body>
<?php include "../nav.php"; ?>
 
 
<h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>
 
 
<p>Total Cost: ₱<?php echo number_format($booking['total_cost'],2); ?></p>
<p>Total Paid: ₱<?php echo number_format($total_paid,2); ?></p>
<p><b>Balance: ₱<?php echo number_format($balance,2); ?></b></p>
 
 
<p style="color:red;"><?php echo $message; ?></p>
 
 
<form method="post">
  <label>Amount Paid</label><br>
  <input type="number" name="amount_paid" step="0.01"><br><br>
 
 
  <label>Method</label><br>
  <select name="method">
    <option value="CASH">CASH</option>
    <option value="GCASH">GCASH</option>
    <option value="CARD">CARD</option>
  </select><br><br>
 
 
  <button type="submit" name="pay">Save Payment</button>
</form>
 
 
</body>
</html>
 
pages/payments_list.php
 
<?php
include "../db.php";
 
$sql = "
SELECT p.*, b.booking_date, c.full_name
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
JOIN clients c ON b.client_id = c.client_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payments</title></head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Payments</h2>
 
<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Client</th><th>Booking ID</th><th>Amount</th><th>Method</th><th>Date</th>
  </tr>
  <?php while($p = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $p['payment_id']; ?></td>
      <td><?php echo $p['full_name']; ?></td>
      <td><?php echo $p['booking_id']; ?></td>
      <td>₱<?php echo number_format($p['amount_paid'],2); ?></td>
      <td><?php echo $p['method']; ?></td>
      <td><?php echo $p['payment_date']; ?></td>
    </tr>
  <?php } ?>
</table>
 
</body>
</html>