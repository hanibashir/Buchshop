<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Framework\Response;

class Register extends Controller
{
    public function __construct(private readonly User $model)
    {
    }

    public function index(): Response
    {
        return $this->view("Auth/register.bbq.php");

    }

    public function create(): Response
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
         *
         * CREATE TABLE `typen_konten` (
         * `typ_id` int(11) NOT NULL,
         * `typ_name` varchar(100) NOT NULL
         * )
         * CREATE TABLE `lieferadressen`(
         * `lieferadressen_id` int(11) NOT NULL,
         * `kunden_id` int(11) DEFAULT NULL,
         * `straße` varchar(255) DEFAULT NULL,
         * `hausnr` int(11) NOT NULL,
         * `adresszeile` varchar(255) DEFAULT NULL,
         * `stadt` varchar(100) DEFAULT NULL,
         * `postleitzahl` varchar(20) DEFAULT NULL,
         * `land` varchar(100) DEFAULT NULL
         * )
         * CREATE TABLE `rechnung_adressen`(
         * `rechnungsadressen_id` int(11) NOT NULL,
         * `kunden_id` int(11) DEFAULT NULL,
         * `straße` varchar(255) DEFAULT NULL,
         * `hausnr` int(11) NOT NULL,
         * `adresszeile` varchar(255) DEFAULT NULL,
         * `stadt` varchar(100) DEFAULT NULL,
         * `postleitzahl` varchar(20) DEFAULT NULL,
         * `land` varchar(100) DEFAULT NULL
         * )
         */
        if ($this->request->post) {
            $data = [
                "userType" => $this->request->post["userType"],
                "first_name" => $this->request->post["first_name"],
                "last_name" => $this->request->post["last_name"],
                "email" => $this->request->post["email"],
                "password" => $this->request->post["password"],
                "confirm_password" => $this->request->post["confirm_password"],
                "street_house_no" => $this->request->post["street_house_no"],
                "post_code" => $this->request->post["post_code"],
                "city" => $this->request->post["city"],
                "phone" => $this->request->post["phone"],
                "check_bill_address" => isset($this->request->post["check_bill_address"]) ? 1 : 0,
                "bill_street_house_no" =>
                    empty($this->request->post["bill_street_house_no"]) ? "" : $this->request->post["bill_street_house_no"],
                "bill_post_code" =>
                    empty($this->request->post["bill_post_code"]) ? "" : $this->request->post["bill_post_code"],
                "bill_city" =>
                    empty($this->request->post["bill_city"]) ? "" : $this->request->post["bill_city"]
            ];
            if ($this->model->insert($data)) {
                return $this->redirect("/login");
            } else {

                return $this->view("Auth/register.bbq.php", [
                    "errors" => $this->model->getErrors(),
                    "input" => $data
                ]);
            }

        } else { // GET request
            return $this->redirect("/register");
        }
    }

}