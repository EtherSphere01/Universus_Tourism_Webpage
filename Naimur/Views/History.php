<!DOCTYPE html>

<?php

require_once('../../Naimur/Controllers/HistoryController.php');

$r = takehistorydata();

if (isset($_POST['complete'])) {

  $r = update_complete_tour($_POST['complete']);
  if ($r) {
    header("Location: History.php");
  }
}

if (isset($_POST['paid'])) {

  $r = update_paid_tour($_POST['paid']);
  if ($r) {
    header("Location: History.php");
  }
}

if (isset($_POST['cancle'])) {

  $r = update_cancle_tour($_POST['cancle']);
  if ($r) {
    header("Location: History.php");
  }
}






?>






<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Domain Pricing Table</title>
  <link rel="stylesheet" href="./History.css" />
</head>

<div class="body">
  <form method="post">
    <div class="table-container">
      <table class="pricing-table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Payment Status</th>
            <th>Complete Status</th>
            <th>Complete Payment</th>
            <th>Cancle Order</th>
          </tr>
        </thead>
        <tbody>

          <?php
          while ($row = $r->fetch_assoc()) {
          ?>
            <tr>
              <td data-label="Order-ID"><?php echo $row['orderid']; ?></td>
              <td data-label="Product-Name"><?php echo $row['productname']; ?></td>
              <td data-label="Amount"><?php echo $row['amount']; ?></td>
              <td data-label="Status"><?php echo $row['status']; ?></td>
              <td data-label="Payment Status"><?php echo $row['pstatus']; ?></td>
              <td data-label="Complete-status">
                <button class="sign-up-btn" name="complete" value="<?php echo $row['orderid']; ?>">Complete</button>
              </td>
              <td data-label="Complete-Payment">
                <button class="sign-up-btn" name="paid" value="<?php echo $row['orderid']; ?>">Paid</button>
              </td>

              <td data-label="Cancle Order">
                <button class="sign-up-btn" name="cancle" value="<?php echo $row['orderid']; ?>">Cancle</button>
              </td>

            </tr>
          <?php
          }
          ?>

          <!-- <tr>
            <td data-label="Order-ID">56</td>
            <td data-label="Product-Name">Coxs-bazar</td>
            <td data-label="Amount">5600</td>
            <td data-label="Status">Pending</td>
            <td data-label="Payment Status">Paid</td>
            <td data-label="Complete-status">
              <button class="sign-up-btn">Complete</button>
            </td>
            <td data-label="Complete-Payment">
              <button class="sign-up-btn">Paid</button>
            </td>
          </tr> -->

        </tbody>
      </table>
    </div>
  </form>
</div>

</html>