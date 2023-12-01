<?php

namespace SydVic\Framework\Tests;

class DependencyClass
{
    public function __construct(private SubDependencyClass $subDependency)
    {
    }

    public function getSubDependency(): SubDependencyClass
    {
        return $this->subDependency;
    }
}