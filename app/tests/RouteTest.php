<?php

/**
 * Tests routes
 */
class RouteTest extends TestCase
{

    /**
     * Main site route
     */
    public function testMainSite()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
    }

    /**
     * Generate site route
     */
    public function testGenerate()
    {
        $this->call('GET', '/generate');
        $this->assertResponseOk();
    }

    /**
     * Results site route
     */
    public function testResults()
    {
        $this->call('GET', '/results');
        $this->assertRedirectedTo('/start');
    }

    /**
     * Start site route
     */
    public function testStart()
    {
        $this->call('GET', '/start');
        $this->assertRedirectedTo('/generate');
    }
}
