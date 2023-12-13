<?php

namespace SydVic\Framework\Authentication;

class SessionAuthentication implements SessionAuthInterface
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
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
        // TODO: Implement login() method.
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }

    public function getUser(): AuthUserInterface
    {
        // TODO: Implement getUser() method.
    }
}