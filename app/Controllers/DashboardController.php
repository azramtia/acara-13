<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

class DashboardController extends BaseController
{
    public function index()
    {
        AuthMiddleware::handle();

        $this->view('dashboard/index');
    }
}
