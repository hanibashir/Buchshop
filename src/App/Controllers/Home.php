<?php

declare(strict_types=1);

namespace App\Controllers;
use Framework\Request;
use Framework\Viewer;

class Home extends Controller
{
    public function index(): void
    {
        echo $this->viewer->render("Home/index.bbq.php");
    }
}