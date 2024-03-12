<?php

declare(strict_types=1);

namespace App\Controllers;

class Dashboard extends Controller
{
    public function index()
    {
        echo "Hello from dashboard controller index";
    }

    public function profile()
    {
        echo "Hello from dashboard controller profile";
    }

}