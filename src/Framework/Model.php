<?php

declare(strict_types=1);

namespace Framework;

use App\Database;
use PDO;
use PDOStatement;

abstract class Model
{
    protected $table_name;
    protected array $errors = [];

    protected function getTable(): string
    {
        if ($this->table_name !== null) {
            return $this->table_name;
        }
        /**
         * $this::class return the subclass path e.g. App\Models\Book for Book Model Class.
         * @method explode() generates an array of the string by using '\' as a separator between the elements.
         * @method array_pop() will pop elements from an array and return the last popped element.
         */
        $parts = explode("\\", $this::class);
        return strtolower(array_pop($parts));
    }

    public function __construct(protected readonly Database $database)
    {
    }

    public function findAll(): array
    {

        $stmt = $this->database->getConnection()->query("SELECT * FROM {$this->getTable()} ORDER BY id DESC");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function find(string $id): array|bool
    {
        $sql = "SELECT * FROM {$this->getTable()} WHERE id = :id";
        $stmt = $this->database->getConnection()->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(array $data): bool
    {
        $data = $this->validate($data);

        if (!empty($this->errors)) {
            return false;
        }
        $columns = implode(", ", array_keys($data));

        $value_placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO {$this->getTable()} ($columns) VALUES ($value_placeholders)";


        return $this->preparePDOStatement($sql, $data)->execute();
    }

    public function update(string $id, array $data): bool
    {
        $this->validate($data);
        if (!empty($this->errors)) {

            return false;
        }

        $sql = "UPDATE {$this->getTable()} "; // e.g. "UPDATE product "

        unset($data["id"]); // remove id element
        $assignments = array_keys($data); // submitted form input names to array elements

        array_walk($assignments, function (&$value) {
            // e.g. name will be: name = ? and description will be: description = ?
            $value = "$value = ?";
        });

        // e.g. "UPDATE product SET name = ?, description = ? WHERE id = ?"
        $sql .= "SET " . implode(", ", $assignments) . " WHERE id = ?";

        return $this->preparePDOStatement($sql, $data, $id)->execute();


    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM {$this->getTable()} WHERE `id` = :id";
        return $this->preparePDOStatement($sql, null, $id)->execute();
    }

    // fill the errors array
    protected function addError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getInsertedID(): false|string
    {
        return $this->database->getConnection()->lastInsertId();

    }

    // to overridden by subclasses
    protected function validate(array $data): array
    {
        return [];
    }

    private function preparePDOStatement(string $sql, array $data = null, string $id = null): false|PDOStatement
    {
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare($sql);

        if ($data !== null) {
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

            if ($id !== null) {
                $stmt->bindValue($i, $id, PDO::PARAM_INT);
            }
        } else {
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        }
        return $stmt;
    }


    protected function executeStatement($data, false|PDOStatement $stmt): bool
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