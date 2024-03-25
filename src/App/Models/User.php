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

        $type_name = "";
        if ($data["userType"] === 'customer')
            $type_name = "kunden";

        $conn = $this->database->getConnection();


        $this->insertIntoAccount($data["password"], $conn);


        $account_id = $conn->lastInsertId();

        $account_type = $this->getAccountType($conn, $type_name)->fetch();

        $this->insertUser($data, $account_type["typ_id"], $account_id, $conn);

        $user_id = $conn->lastInsertId();

        if ($data['check_bill_address']) {
            $this->insertUserBillingAddress($data, $user_id, $conn);
        }

        return $this->insertUserAddress($data, $user_id, $conn);
    }

    protected function validate(array $data): array
    {


        if (!$data['check_bill_address']) {
            unset($data['check_bill_address']);
            unset($data['bill_street']);
            unset($data['bill_house_no']);
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
    public function insertUser(array $data, $typ_id, false|string $account_id, PDO $conn): bool
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
     * @param array $data
     * @param string $user_id
     * @param $conn
     * @return bool
     */

    private function insertUserAddress(array $data, string $user_id, $conn): bool
    {
        $user_address['kunden_id'] = $user_id;
        $user_address['straße'] = $data['street'];
        $user_address['hausnr'] = $data['house_no'];
        $user_address['adresszeile'] = ''; // TODO
        $user_address['postleitzahl'] = $data['post_code'];
        $user_address['stadt'] = $data['city'];
        $user_address['land'] = 'Deutschland'; // TODO


        $value_placeholders = implode(", ", array_fill(0, count($user_address), "?"));

        $address_table_sql =
            "INSERT INTO `lieferadressen` (`kunden_id`, `straße`, `hausnr`, `adresszeile`, `stadt`, `postleitzahl`, `land`) " .
            "VALUES ($value_placeholders)";

        $stmt = $conn->prepare($address_table_sql);

        return $this->executeStatement($user_address, $stmt);
    }

    /**
     * @param array $data
     * @param string $user_id
     * @param $conn
     * @return void
     */

    private function insertUserBillingAddress(array $data, $user_id, $conn): void
    {
        $user_address['kunden_id'] = $user_id;
        $user_address['straße'] = $data['bill_street'];
        $user_address['hausnr'] = $data['bill_house_no'];
        $user_address['adresszeile'] = ''; // TODO
        $user_address['postleitzahl'] = $data['bill_post_code'];
        $user_address['stadt'] = $data['bill_city'];
        $user_address['land'] = 'Deutschland'; // TODO

        $value_placeholders = implode(", ", array_fill(0, count($user_address), "?"));

        $address_table_sql =
            "INSERT INTO `rechnung_adressen` (`kunden_id`, `straße`, `hausnr`, `adresszeile`, `stadt`, `postleitzahl`, `land`) " .
            "VALUES ($value_placeholders)";

        $stmt = $conn->prepare($address_table_sql);

        $this->executeStatement($user_address, $stmt);

    }

}