<?php

namespace SydVic\Framework\Authentication;

use SydVic\Framework\Session\SessionInterface;

class SessionAuthentication implements SessionAuthInterface
{
    private AuthUserInterface $user;
    public function __construct(
        private AuthRepositoryInterface $authRepository,
        private SessionInterface $session
    )
    {
    }

    public function authenticate(string $username, string $password): bool
    {
        // query db for user using username
        $user = $this->authRepository->findByUsername($username);

        if (!$user) {
            return false;
        }

        // does the user hashed password match the hash of the attempted password
        if (password_verify($password, $user->getPassword())) {
            // if yes, log the user in
            $this->login($user);

            // return true
            return true;
        }

        // return false
        return false;
    }

    public function login(AuthUserInterface $user)
    {
        // start a session
        $this->session->start();

        // log the user in
        $this->session->set('auth_id', $user->getAuthId());

        // set the user
        $this->user = $user;
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }

    public function getUser(): AuthUserInterface
    {
        return $this->user;
    }
}