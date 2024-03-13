<?php

namespace App\Models;

use Framework\Model;

class User extends Model
{
    // override model table name
    protected $table_name = "kunden";

    protected function validate(array $data): void
    {
        /**+
         * $data = [
         * "userType" => $this->request->post["userType"],
         * "first_name" => $this->request->post["first_name"],
         * "last_name" => $this->request->post["last_name"],
         * "email" => $this->request->post["email"],
         * "password" => $this->request->post["password"],
         * "confirm_password" => $this->request->post["confirm_password"],
         * "street_house_no" => $this->request->post["street_house_no"],
         * "post_code" => $this->request->post["post_code"],
         * "city" => $this->request->post["city"],
         * "phone" => $this->request->post["phone"],
         * "bill_street_house_no" =>
         * empty($this->request->post["bill_street_house_no"]) ? "" : $this->request->post["bill_street_house_no"],
         * "bill_post_code" =>
         * empty($this->request->post["bill_post_code"]) ? "" : $this->request->post["bill_post_code"],
         * "bill_city" =>
         * empty($this->request->post["bill_city"]) ? "" : $this->request->post["bill_city"]
         * ];
         */


        if (!$data['check_bill_address']) {
            unset($data['bill_street_house_no']);
            unset($data['bill_post_code']);
            unset($data['bill_city']);

        }

        foreach (array_keys($data) as $key) {
            if (empty($data[$key])) {
                if ($key === "phone") continue;
                $this->addError($key, "{$this->inputName($key)} is required");
            }
        }

        if ($data["password"] !== $data["confirm_password"]) {
            $this->addError(
                "confirm_password",
                "{$this->inputName("confirm_password")} doesn't match the password"
            );
        }
    }

    private function inputName(string $name): string
    {
        $arr = explode("_", $name);

        return ucfirst(implode(" ", $arr));
    }

}