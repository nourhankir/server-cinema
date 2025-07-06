<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Booking.php';
require_once __DIR__ . '/../Models/BookedSeat.php';
require_once __DIR__ . '/../Models/Payment.php';

class BookingController extends Controller {
    public function finalize($request) {
        $input = $request->input();

        $userId = $input['user_id'] ?? null;
        $showtimeId = $input['showtime_id'] ?? null;
        $seatIds = $input['seat_ids'] ?? [];
        $pricePaid = $input['price_paid'] ?? 0;
        $paymentMethod = $input['payment_method'] ?? null;

        if (!$userId || !$showtimeId || empty($seatIds) || !$paymentMethod) {
            return $this->error('Missing required fields', 400);
        }

        try {
            $this->db->beginTransaction();

            // Insert booking
            $bookingId = Booking::create([
                'user_id' => $userId,
                'showtime_id' => $showtimeId,
                'booking_time' => date('Y-m-d H:i:s'),
            ], $this->db);

            // Insert booked seats
            foreach ($seatIds as $seatId) {
                BookedSeat::create([
                    'booking_id' => $bookingId,
                    'showtime_id' => $showtimeId,
                    'seat_id' => $seatId
                ], $this->db);
            }

            // Insert payment
            Payment::create([
                'booking_id' => $bookingId,
                'amount' => $pricePaid,
                'payment_method' => $paymentMethod,
                'paid_at' => date('Y-m-d H:i:s')
            ], $this->db);

            $this->db->commit();
            $this->response(['success' => true, 'booking_id' => $bookingId]);
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->error('Transaction failed: ' . $e->getMessage(), 500);
        }
    }
}
