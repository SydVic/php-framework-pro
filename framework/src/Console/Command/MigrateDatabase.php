<?php

namespace SydVic\Framework\Console\Command;

class MigrateDatabase implements CommandInterface
{
    private string $name = 'database:migrations:migrate';
    public function execute(array $params = []): int
    {
        echo 'Executing MigrateDatabase command' . PHP_EOL;

        return 0;
    }
}