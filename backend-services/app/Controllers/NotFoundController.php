<?php
namespace App\Controllers;

class NotFoundController{
    public function pageNotFound()
    {
        return response('Page Not Found',404);
    }
}