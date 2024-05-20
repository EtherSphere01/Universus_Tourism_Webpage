<?php
    require('stripe-php-master/init.php');

    $publishableKey ="pk_test_51PCNuAEmnwaokyZKaRKZ0ptvhsTbPiuEdxr6iqmHTVf5hTHSTtgqcaAIJDCRIszhsOtr2CohrkGobcKzg0D8cR3R00MxMVGyFE";
    $secretKey ="sk_test_51PCNuAEmnwaokyZKC8TLuBv43mx1EXsOGUPwip4VxYpGReyWDpXzOUA3imuSoOkyjBoCMmmsrAqoENdHBSLoPOeH00wObbCvsd";

    \Stripe\Stripe::setApiKey($secretKey);
    
?>