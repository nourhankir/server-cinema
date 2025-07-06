
<?php

require_once(__DIR__ . '/../Core/Model.php');
class BookedSeat extends Model {
    protected static string $table = 'booked_seats';
    protected static string $primaryKey = 'id';
}







?>