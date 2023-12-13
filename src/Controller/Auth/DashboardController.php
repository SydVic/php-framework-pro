<?php

namespace App\Controller\Auth;

use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\Response;

class DashboardController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('/auth/dashboard.html.twig');
    }
}