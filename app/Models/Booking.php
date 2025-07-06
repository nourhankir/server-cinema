<?php

require_once(__DIR__ . '/../Core/Model.php');


class Booking extends Model {
    protected static string $table = 'bookings';
    protected static string $primaryKey = 'id';
   
}




?>