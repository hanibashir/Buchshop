<?php

declare(strict_types=1);

namespace Framework;

class Response
{
    private int $status_code = 0;
    private array $headers = [];
    private string $body = "";

    public function setStatusCode($code): void
    {
        $this->status_code = $code;
    }

    public function redirect(string $url): void
    {
        $this->setHeaders("Location: $url");
    }

    private function setHeaders(string $header): void
    {
        // append
        $this->headers[] = $header;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function send(): void
    {
        if ($this->status_code) {
            http_response_code($this->status_code);
        }

        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->body;
    }

}