<?php
namespace Configs\Router;
use Contracts\Router;
class Route implements Router{
    private $handlers;
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private const METHOD_PUT = 'PUT';
    private const METHOD_DELETE = 'DELETE';

    public function __construct() {
        $this->validateOrigin();
    }

    private function validateOrigin(): void
    {
        header("Access-Control-Allow-Origin: ".FRONTEND_URL);
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
    
    public function get(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }
    public function post(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }
    public function put(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_PUT, $path, $handler);
    }
    public function delete(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_DELETE, $path, $handler);
    }
    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }
    
    private function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method.$path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }
    
    public function run()
    {
        $requestUrl = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUrl['path'];
        $requestMethod =  $_SERVER["REQUEST_METHOD"];

        if(!isset($this->handlers[$requestMethod.$requestPath])){
            if(!empty($this->notFoundHandler)){
                $callback = $this->notFoundHandler;
            }
        }
        else{

            $calledHandler = $this->handlers[$requestMethod.$requestPath];
            $callback = $calledHandler['handler'];
        }
        if(is_string($callback)){
            $parts = explode('::', $callback);
            if(is_array($parts)){
                $className = array_shift($parts);
                $methodName = array_shift($parts);
                
                $callback = [new $className, $methodName];
            }
        }
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}