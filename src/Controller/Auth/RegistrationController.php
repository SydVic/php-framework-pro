<?php

namespace App\Controller\Auth;

use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\Response;

class RegistrationController extends AbstractController
{
    public function create(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    public function store(): Response
    {
        dd($this->request);
    }
}