<?php

namespace SydVic\Framework\Authentication;

interface AuthRepositoryInterface
{
    public function findByUsername(string $username): ?AuthUserInterface;
}