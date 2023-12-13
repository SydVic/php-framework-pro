<?php

namespace App\Controller\Auth;

use SydVic\Framework\Authentication\SessionAuthentication;
use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\Response;

class LoginController extends AbstractController
{
    public function __construct(
        private SessionAuthentication $authComponent
    )
    {
    }

    public function index(): Response
    {
        return $this->render('/auth/login.html.twig');
    }

    public function login(): Response
    {
        // attempt to authenticate the user using a security component (bool)
        // create a session for the user
        $userIsAuthenticated = $this->authComponent->authenticate(
            $this->request->input('username'),
            $this->request->input('password')
        );

        // if successful, retrieve the user

        // redirect the user to intended location
    }
}