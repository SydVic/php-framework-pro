<?php

use PHPUnit\Framework\TestCase;
use SydVic\Framework\Session\Session;

class SessionTest extends TestCase
{
    // generally discouraged setting against the session, better to mock up the session
    protected function setUp(): void
    {
        unset($_SESSION);
    }

    public function testSetAndGetFlash(): void
    {
        $session = new Session();
        $session->setFlash('success', 'Great job!');
        $session->setFlash('error', 'Bad job!');
        $this->assertTrue($session->hasFlash('success'));
        $this->assertTrue($session->hasFlash('error'));
        $this->assertEquals(['Great job!'], $session->getFlash('success'));
        $this->assertEquals(['Bad job!'], $session->getFlash('error'));
        $this->assertEquals([], $session->getFlash('warning'));
    }
}