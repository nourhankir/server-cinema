<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Movie.php';

class MovieController extends Controller {
    public function index($request) {
        try {
            $movies = Movie::all($this->db); // pass the PDO connection
            $this->response($movies);
        } catch (PDOException $e) {
            $this->error("Failed to fetch movies.", 500);
        }
    }
    public function show($request) {
    $id = $request->get('id');

    if (!$id) {
        return $this->error("Movie ID is required", 400);
    }

    $movie = Movie::find($this->db, (int)$id);

    if ($movie) {
        $this->response($movie);
    } else {
        $this->error("Movie not found", 404);
    }
}

}
