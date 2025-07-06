<?php

require_once(__DIR__ . '/../Core/Model.php');


class Movie extends Model {
    protected static string $table = 'movies';
    protected static string $primaryKey = 'id';
   
}




?>