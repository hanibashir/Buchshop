<?php
declare(strict_types=1);

namespace App\Controllers;

use Framework\Request;
use Framework\TemplateViewerInterface;

abstract class Controller
{

    protected Request $request;

    protected TemplateViewerInterface $viewer;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setViewer(TemplateViewerInterface $viewer): void
    {
        $this->viewer = $viewer;
    }

}