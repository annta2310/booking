<?php
// bookings_handler.php
require_once 'db_connection.php';

function getAllBookings() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM Bookings');
    return $stmt->fetchAll();
}

function getBooking($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM Bookings WHERE bookingID = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createBooking($roomID, $customerID, $checkin, $checkout, $contact, $extra = null) {
    global $pdo;
    $sql = 'INSERT INTO Bookings (roomID, customerID, checkin_date, checkout_date, contact_number, booking_extra) 
            VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$roomID, $customerID, $checkin, $checkout, $contact, $extra]);
    return $pdo->lastInsertId();
}

function updateBooking($id, $checkin, $checkout, $contact, $extra = null) {
    global $pdo;
    $sql = 'UPDATE Bookings SET checkin_date = ?, checkout_date = ?, contact_number = ?, booking_extra = ? 
            WHERE bookingID = ?';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$checkin, $checkout, $contact, $extra, $id]);
}

function deleteBooking($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM Bookings WHERE bookingID = ?');
    return $stmt->execute([$id]);
}
?>