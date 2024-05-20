<?php
    require_once('config.php');
?>


<form method="post" action="submit.php">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $publishableKey; ?>"
        data-amount="5000"
        data-name="Universus Tourism"
        data-description="Booking Payment"
        data-image="https://i.ibb.co/WfdSsCY/logo.jpg"
        data-currency="usd"
        data-email = "universuswebtech@gmail.com"
        >
    </script>
</form>
