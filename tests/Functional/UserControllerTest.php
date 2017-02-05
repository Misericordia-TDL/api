<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

namespace Tests\Functional;

/**
 * Class HomepageTest
 * @package Tests\Functional
 */
class UserControllerTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response with 200 status code and valid json response
     */
    public function testGetValidHomePage()
    {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    }
}