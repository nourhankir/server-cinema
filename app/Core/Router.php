<?php
require('Request.php');
class Router{
    protected array $routes = [];
    public function get(string $uri, callable $action) {
        $this->addRoute('GET', $uri, $action);
    }
    public function post(string $uri, callable $action) {
        $this->addRoute('POST', $uri, $action);
    }
    protected function addRoute(string $method, string $uri, callable $action) {
        $this->routes[$method][$uri] =$action;
    }
    public function dispatch(){

        $request=new Request();
        $method=$request->method();
        $uri=$request->uri();
        

        if(isset($this->routes[$method][$uri])){
            call_user_func($this->routes[$method][$uri], $request);
        }
        else {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
        }


    }




}



?>