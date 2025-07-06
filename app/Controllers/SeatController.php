<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Seat.php';
require_once __DIR__ . '/../Models/Showtime.php';
require_once __DIR__ . '/../Models/BookedSeat.php';

class SeatController extends Controller {
    public function byShowtime($request) {
        $showtimeId = $request->get('showtime_id');

        if (!$showtimeId) {
            return $this->error("Missing showtime_id", 400);
        }

        $showtime = Showtime::find($this->db, (int)$showtimeId);
        if (!$showtime) {
            return $this->error("Showtime not found", 404);
        }

        $auditoriumId = $showtime['auditorium_id'];

        
        $seats = Seat::all($this->db);

        
        $bookedSeats = BookedSeat::where($this->db, 'showtime_id' , $showtimeId);
        $bookedSeatIds = array_column($bookedSeats, 'seat_id');

        
        foreach ($seats as &$seat) {
            $seat['is_booked'] = in_array($seat['id'], $bookedSeatIds);
        }

        $this->response($seats);
    }
}
