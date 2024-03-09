<?php

declare(strict_types=1);

namespace Framework;

class Viewer
{

    public function render(string $template, array $data = []): false|string
    {
        /**
         * data contains an associative array e.g. [ "products" => $products] where $products is also an array
         * @method extract() will extract the string key "products" as a variable and assign $products value to it
         */
        extract($data, EXTR_SKIP);

        ob_start();

        require dirname(__DIR__, 2) . "/views/$template";
        return ob_get_clean();
    }
}