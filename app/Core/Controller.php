<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Services/Response.php';
class Controller{
    protected PDO $db;
    public function __construct(){
        $this->db=Database::connect();

    }
    public function response($data, $status = 200) {
        Response::json($data, $status);
    }
    public function error(string $message, int $status = 400) {
        Response::error($message, $status);
    }

}



?>