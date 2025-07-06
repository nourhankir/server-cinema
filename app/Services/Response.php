<?php
class Response{
    public static function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public static function error(string $message, int $status = 400): void {
        self::json(['error' => $message], $status);
    }



}



?>