<?php
class Request{

    public function get(string $id,$default=null){
        return $_GET[$id] ?? $default;
    }
    public function post(string $id,$default=null){
        return $_POST[$id] ?? $default;
    }
    public function input():array{
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }
    public function method():string{
        return $_SERVER['REQUEST_METHOD'] ;
    }
    public function uri(): string {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = dirname($_SERVER['SCRIPT_NAME']); // e.g., /cinema-server/public
    return trim(str_replace($base, '', $uri), '/');
}

}



?>