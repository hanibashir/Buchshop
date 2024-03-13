<?php
declare(strict_types=1);

namespace App\Controllers;

use Framework\Request;
use Framework\Response;
use Framework\TemplateViewerInterface;

abstract class Controller
{

    protected Request $request;
    protected Response $response;

    protected TemplateViewerInterface $viewer;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function setViewer(TemplateViewerInterface $viewer): void
    {
        $this->viewer = $viewer;
    }

    public function view(string $template, array $data = []): Response
    {
        $this->response->setBody($this->viewer->render($template, $data));

        return $this->response;
    }

    protected function redirect(string $url): Response
    {
        $this->response->redirect($url);

        return $this->response;
    }

}