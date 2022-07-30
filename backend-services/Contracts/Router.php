<?php
namespace Contracts;
interface Router{
    public function get(string $path, $handler): void;
    public function post(string $path, $handler): void;
    public function put(string $path, $handler): void;
    public function delete(string $path, $handler): void;
    public function addNotFoundHandler($handler): void;
    public function run();
}
?>