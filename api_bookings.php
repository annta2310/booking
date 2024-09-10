<?php
// api_bookings.php
header('Content-Type: application/json');
require_once 'bookings_handler.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

switch($method) {
    case 'GET':
        if(isset($request[0]) && is_numeric($request[0])) {
            $booking = getBooking($request[0]);
            echo json_encode($booking);
        } else {
            $bookings = getAllBookings();
            echo json_encode($bookings);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $newBookingId = createBooking($data['roomID'], $data['customerID'], $data['checkin'], $data['checkout'], $data['contact'], $data['extra'] ?? null);
        echo json_encode(['id' => $newBookingId]);
        break;
    case 'PUT':
        if(isset($request[0]) && is_numeric($request[0])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $success = updateBooking($request[0], $data['checkin'], $data['checkout'], $data['contact'], $data['extra'] ?? null);
            echo json_encode(['success' => $success]);
        }
        break;
    case 'DELETE':
        if(isset($request[0]) && is_numeric($request[0])) {
            $success = deleteBooking($request[0]);
            echo json_encode(['success' => $success]);
        }
        break;
}
?>