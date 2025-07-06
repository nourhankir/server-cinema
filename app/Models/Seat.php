<?php

require_once(__DIR__ . '/../Core/Model.php');


class Seat extends Model {
    protected static string $table = 'seats';
    protected static string $primaryKey = 'id';
}




?>