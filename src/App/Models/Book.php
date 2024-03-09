<?php

namespace App\Models;

use Framework\Model;

class Book extends Model
{
    /**
     * @param array $data
     * @return void
     */
    protected function validate(array $data): void
    {
        /** SQL Structure:
         * `buch_id` int(11) NOT NULL,
         * `titel` varchar(255) DEFAULT NULL,
         * `autor_id` int(11) DEFAULT NULL,
         * `sprache_id` int(11) DEFAULT NULL,
         * `kategorie_id` int(11) DEFAULT NULL,
         * `preis` double NOT NULL,
         * `verlag_id` int(11) DEFAULT NULL,
         * `ISBN` varchar(100) NOT NULL,
         * `kurzbeschreibung` text DEFAULT NULL
         */
        if (empty($data["title"])) {
            $this->addError("title", "Book name is required");
        }
    }
}