<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Browser;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;

class HomePageTest extends \PHPUnit_Framework_TestCase
{

    /** @var $driver RemoteWebDriver */
    protected $driver;
    protected $browser;

    public function testGoogle()
    {
        $this->driver->get('http://www.google.com');
        self::assertEquals('Google', $this->driver->getTitle());
    }

    protected function setUp()
    {
        $this->browser = getenv('BROWSER') ? getenv('BROWSER') : 'firefox';
        $this->driver = RemoteWebDriver::create('http://hub:4444/wd/hub', array(
            WebDriverCapabilityType::BROWSER_NAME => $this->browser
        ));
    }

    protected function tearDown()
    {
        $this->driver->close();
    }
}