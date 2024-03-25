<?php

namespace App\Models;

use Framework\Model;
use PDO;
use PDOStatement;

class User extends Model
{
    // override model table name
    protected $table_name;


    // overriding parent class function
    protected function setUserTableName(array $data): string
    {
        switch ($data['userType']) {
            case 'customer':
                $this->table_name = "kunden";
                break;
            case 'business':
                $this->table_name = "unternehmen";
                break;
        }
        return $this->table_name;
    }

    public function insert(array $data): bool
    {
        $data = $this->validate($data);

        if (!empty($this->errors)) {
            return false;
        }

        // kunden, angestellte oder unternehmen
        $this->setUserTableName($data);

        /**
         * [userType] => customer
         * [first_name] => hani
         * [last_name] => bashir
         * [email] => example@example.com
         * [password] => 123
         * [confirm_password] => 123
         * [street_house_no] => any
         * [post_code] => 22589
         * [city] => hh
         * [phone] => 0158963333
         */


        $type_name = "";
        if ($data["userType"] === 'customer')
            $type_name = "kunden";

        $conn = $this->database->getConnection();


        $this->insertIntoAccount($data["password"], $conn);


        $account_id = $conn->lastInsertId();

        $account_type = $this->getAccountType($conn, $type_name)->fetch();

        return $this->insertUser($data, $account_type["typ_id"], $account_id, $conn);
    }

    protected function validate(array $data): array
    {


        if (!$data['check_bill_address']) {
            unset($data['check_bill_address']);
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
        return $data;
    }

    private function inputName(string $name): string
    {
        $arr = explode("_", $name);

        return ucfirst(implode(" ", $arr));
    }

    /**
     * @param PDO $conn
     * @param string $type_name
     * @return false|PDOStatement
     */
    public function getAccountType(PDO $conn, string $type_name): false|PDOStatement
    {
        $stmt = $conn->prepare("SELECT * FROM typen_konten WHERE `typ_name` = ?");
        $stmt->bindValue(1, $type_name);
        $stmt->execute();
        return $stmt;
    }

    /**
     * @param $password
     * @param PDO $conn
     * @return bool
     */
    public function insertIntoAccount($password, PDO $conn): bool
    {
        $user_account["erstellt_datum"] = date("Y-m-d H:i:s");
        $user_account["last_datum"] = date("Y-m-d H:i:s");
        $user_account["benutzname"] = "No username";
        $user_account["passwort_hash"] = $password;

        $value_placeholders = implode(", ", array_fill(0, count($user_account), "?"));

        $konto_table_sql = "INSERT INTO `konten` (`erstellt_datum`, `last_datum`, `benutzname`, `passwort_hash`) VALUES ($value_placeholders)";

        $stmt = $conn->prepare($konto_table_sql);

        return $this->executeStatement($user_account, $stmt);
    }

    /**
     * @param array $data
     * @param $typ_id
     * @param false|string $account_id
     * @param PDO $conn
     * @return bool
     */
    public function insertUser(array $data, $typ_id, $account_id, PDO $conn): bool
    {
        $user_data["kd_vorname"] = $data["first_name"];
        $user_data["kd_nachname"] = $data["last_name"];
        $user_data["email"] = $data["email"];
        $user_data["telefonnummer"] = $data["phone"];
        $user_data["typ_id"] = $typ_id;
        $user_data["konto_id"] = $account_id;

        $value_placeholders = implode(", ", array_fill(0, count($user_data), "?"));


        $user_table_sql = "INSERT INTO {$this->getTable()} (kd_vorname, kd_nachname, email, telefonnummer, typ_id, konto_id) VALUES ($value_placeholders)";

        $stmt = $conn->prepare($user_table_sql);

        return $this->executeStatement($user_data, $stmt);
    }

    /**
     * @param $data
     * @param false|PDOStatement $stmt
     * @return bool
     */
    public function executeStatement($data, false|PDOStatement $stmt): bool
    {
        $i = 1;
        foreach ($data as $value) {
            $type = match (gettype($value)) {
                "boolean" => PDO::PARAM_BOOL,
                "integer" => PDO::PARAM_INT,
                "NULL" => PDO::PARAM_NULL,
                default => PDO::PARAM_STR
            };
            $stmt->bindValue($i++, $value, $type);
        }

        return $stmt->execute();
    }
}