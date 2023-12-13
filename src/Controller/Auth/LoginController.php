<?php

namespace App\Controller\Auth;

use SydVic\Framework\Authentication\SessionAuthentication;
use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\RedirectResponse;
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

    public function login(): RedirectResponse
    {
        // attempt to authenticate the user using a security component (bool)
        // create a session for the user
        $userIsAuthenticated = $this->authComponent->authenticate(
            $this->request->input('username'),
            $this->request->input('password')
        );

        // if successful, retrieve the user
        if (!$userIsAuthenticated) {
            $this->request->getSession()->setFlash('error', 'Bad creds');
            return new RedirectResponse('/login');
        }

        $user = $this->authComponent->getUser();

        $this->request->getSession()->setFlash('success', 'You are now logged in');

        // redirect the user to intended location
        return new RedirectResponse('/dashboard');
    }
}