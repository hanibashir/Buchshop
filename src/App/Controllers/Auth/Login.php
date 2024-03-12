<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;

class Login extends Controller
{
    public function index()
    {
        echo $this->viewer->render("Auth/login.bbq.php");

    }

}