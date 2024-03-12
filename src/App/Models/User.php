<?php

namespace App\Models;

use Framework\Model;

class User extends Model
{
    protected function validate(array $data): void
    {

        if (empty($data["name"])) {
            $this->addError("name", "Name is required");
        }
    }
}