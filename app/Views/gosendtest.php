<!DOCTYPE html>

<head>
    <title>GoSend Notification</title>
</head>

<body>
    <p><strong>Booking ID:</strong> <?= $payload->booking_id; ?> </p>
    <p><strong>Status:</strong> <?= $payload->status; ?> </p>
    <p><strong>Driver Name:</strong> <?= $payload->driver_name; ?> </p>
    <p><strong>Driver Phone:</strong> <?= $payload->driver_phone; ?> </p>
    <p><strong>Receiver Name:</strong> <?= $payload->receiver_name; ?> </p>
    <p><strong>Pickup Eta:</strong> <?= $payload->pickup_eta; ?> </p>
    <p><strong>Delivery Eta:</strong> <?= $payload->delivery_eta; ?> </p>
    <p><strong>Cancellation Reason:</strong> <?= $payload->cancellation_reason; ?> </span></p>
    <p><strong>Live Tracking URL:</strong> <?= $payload->liveTrackingUrl; ?> </p>
</body>

</html>