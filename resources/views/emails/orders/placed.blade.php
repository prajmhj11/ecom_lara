<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        This is an email being sent out.
    </p>
    Order Id: {{ $order->id }} <br>
    Order Email: {{ $order->billing_email }} <br>
    Order Billing Name: {{ $order->billing_name }} <br>
    Order Total: {{ presentPrice($order->billing_total) }} <br>
</body>
</html>
