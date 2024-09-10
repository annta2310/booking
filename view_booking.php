<?php
// view_booking.php
require_once 'db_connection.php';

$bookingId = $_GET['id'] ?? null;

if ($bookingId) {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE bookingID = ?");
    $stmt->execute([$bookingId]);
    $booking = $stmt->fetch();
}

if (!$booking) {
    echo "No booking found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking</title>
</head>
<body>
    <h1>Booking Details</h1>
    <h2>
        <a href="current_bookings.php">[Back to Booking List]</a>
        <a href="index.php">[Back to Main Page]</a>
    </h2>
    <form>
        <fieldset>
            <legend>Room Details #<?= $booking['roomID']; ?></legend>
            <p>
                Room Name: <br><?= htmlspecialchars($booking['roomName']); ?><br>
                CheckIn Date: <br><?= htmlspecialchars($booking['checkin']); ?><br>
                CheckOut Date: <br><?= htmlspecialchars($booking['checkout']); ?><br>
                Contact Number: <br><?= htmlspecialchars($booking['contact']); ?><br>
                Extras: <br><?= htmlspecialchars($booking['extras']); ?><br>
                Room Review: <br><?= htmlspecialchars($booking['review']); ?><br>
            </p>
        </fieldset>
    </form>
</body>
</html>