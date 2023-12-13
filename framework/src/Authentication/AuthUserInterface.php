<?php

namespace SydVic\Framework\Authentication;

interface AuthUserInterface
{
    public function getUsername(): string;

    public function getPassword(): string;
}