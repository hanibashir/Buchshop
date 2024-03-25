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
        if ($this->request->post) {
            $data = [
                "userType" => $this->request->post["userType"],
                "first_name" => $this->request->post["first_name"],
                "last_name" => $this->request->post["last_name"],
                "email" => $this->request->post["email"],
                "password" => $this->request->post["password"],
                "confirm_password" => $this->request->post["confirm_password"],
                "street" => $this->request->post["street"],
                "house_no" => $this->request->post["house_no"],
                "post_code" => $this->request->post["post_code"],
                "city" => $this->request->post["city"],
                "phone" => $this->request->post["phone"],
                "check_bill_address" => isset($this->request->post["check_bill_address"]) ? 1 : 0,
                "bill_street" =>
                    empty($this->request->post["bill_street"]) ? "" : $this->request->post["bill_street"],
                "bill_house_no" =>
                    empty($this->request->post["bill_house_no"]) ? "" : $this->request->post["bill_house_no"],
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