<?php
// cinema-server/models/Movie.php

require_once 'model.php';

class BookedSeat extends Model {
    protected static $table = 'booked_seats';
}