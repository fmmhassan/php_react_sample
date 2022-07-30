<?php
use Configs\Router\Route;
use App\Controllers\ExpenseController;
use App\Controllers\NotFoundController;

$router = new Route();
$router->post('/expense/import', ExpenseController::class.'::import');
$router->post('/expense/export', ExpenseController::class.'::export');
$router->get('/expense/summary', ExpenseController::class.'::getExpensesSummary');

$router->addNotFoundHandler(NotFoundController::class.'::pageNotFound');

$router->run();