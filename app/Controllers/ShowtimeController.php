<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Showtime.php';

class ShowtimeController extends Controller {
    public function index($request) {
        try {
            $showtimes = Showtime::all($this->db); 
            $this->response($showtimes);
        } catch (PDOException $e) {
            $this->error("Failed to fetch showtimes.", 500);
        }
    }
    public function byMovie($request) {
    $movie_id = $request->get('movie_id');

    if (!$movie_id) {
        return $this->error("movie_id is required", 400);
    }

    try {
        $results = Showtime::getByMovieId($this->db, (int)$movie_id);
        $this->response($results);
    } catch (PDOException $e) {
        $this->error("Failed to fetch showtimes for movie", 500);
    }
}


}
