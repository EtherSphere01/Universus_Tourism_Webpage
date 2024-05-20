<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Panel</title>
    <link rel="stylesheet" href="test.css">
</head>

<body>
    <div class="notification-panel">
        <div class="panel-header">
            <h2>Notifications</h2>
            <div class="panel-icons">
                <span class="icon"><!-- 🔍 --> </span>
                <span class="icon">⚙️</span>
            </div>
        </div>

        <div class="notification-list">
            <?php
            require_once('../Controllers/testController.php');
            $notification = get_notification();
            while ($row = mysqli_fetch_assoc($notification)) {
                $transaction_id = $row['transaction'];
                $short_transaction_id = substr($transaction_id, 0, 10) . '...' . substr($transaction_id, -4);
            ?>
                <div class="notification-item">
                    <img src="./UserImage/image-template.png" alt="Avatar" class="avatar">
                    <div class="notification-content">
                        <p><strong><?php echo $row['name'] ?></strong></p>
                        <p class="time"><?php echo $short_transaction_id ?></p>
                        <p class="time">Amount: <?php echo $row['amount'] ?></p>
                        <p class="time">Order ID: <?php echo $row['orderid'] ?></p>
                        <p class="time">Date: <?php echo $row['date'] ?></p>
                    </div>
                    <div class="notification-time">
                        <p>Network: <strong><?php echo $row['network'] ?></strong></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="panel-footer" id="clickableDiv3" data-url="https://dashboard.stripe.com/test/payments" role="button" tabindex="0">
            <button id="seeAllActivity">SEE ALL ACTIVITY</button>
        </div>
    </div>
    <script src="http://localhost/Naimur/Views/test.js"></script>
</body>

</html>