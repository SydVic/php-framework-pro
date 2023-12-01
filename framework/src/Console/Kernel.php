<?php

namespace SydVic\Framework\Console;

use Psr\Container\ContainerInterface;
use SydVic\Framework\Console\Command\CommandInterface;

final class Kernel
{
    public function __construct(
        private ContainerInterface $container,
        private Application $application
    )
    {
    }

    public function handle(): int
    {
        // register commands with the container
        $this->registerCommands();

        // run the console application, returning a status code
        $status = $this->application->run();

        // return the status code
        return 0;
    }

    private function registerCommands(): void
    {
        // === register all built in commands ===
        // get all files in the Command folder
        $commandFiles = new \DirectoryIterator(__DIR__ . '/Command');

        $namespace = $this->container->get('base-commands-namespace');

        // loop over all files in the Command folder
        foreach ($commandFiles as $commandFile) {

            if (!$commandFiles->isFile()) {
                continue;
            }

            // get the Command class name. Using psr4 this will be same as filename
            $command = $namespace.pathinfo($commandFile, PATHINFO_FILENAME);

            // if it is a subclass of CommandInterface
            if (is_subclass_of($command, CommandInterface::class)) {
                // add the container, using the name as the ID e.g. $container->add('database:migrations:migrate', MigrateDatabase::class)
                $commandName = (new \ReflectionClass($command))->getProperty('name')->getDefaultValue();

                $this->container->add($commandName, $command);
            }
        }
        // === register all user-defined commands (@TODO) ===
    }
}