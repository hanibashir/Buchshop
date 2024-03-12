<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;

class Register extends Controller
{
    public function index(): void
    {
        echo $this->viewer->render("Auth/register.bbq.php");

    }

    public function create()
    {
        /**
         * CREATE TABLE `kunden` (
         * `kunden_id` int(11) NOT NULL,
         * `kd_vorname` varchar(255) DEFAULT NULL,
         * `kd_nachname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
         * `email` varchar(255) DEFAULT NULL,
         * `telefonnummer` varchar(20) DEFAULT NULL,
         * `typ_id` int(11) DEFAULT NULL,
         * `konto_id` int(11) DEFAULT NULL
         * )
         */
        if ($this->request->post) {
            # TODO
            echo "create";
        }
    }

}