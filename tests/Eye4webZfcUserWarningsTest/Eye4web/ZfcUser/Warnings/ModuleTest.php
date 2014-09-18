<?php

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings;

use Zend\Mvc\MvcEvent;
use Eye4web\ZfcUser\Warnings\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    protected $module;

    public function setUp()
    {
        $this->module = new Module;
    }

    public function testConfig()
    {
        $config = $this->module->getConfig();

        $this->assertTrue(is_array($config));
    }
}
