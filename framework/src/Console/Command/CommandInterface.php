<?php

namespace SydVic\Framework\Console\Command;

interface CommandInterface
{
    public function execute(array $params = []): int;
}