<?php

require_once(__DIR__ . '/../Core/Model.php');


class Payment extends Model {
    protected static string $table = 'payments';
    protected static string $primaryKey = 'id';
   
}




?>