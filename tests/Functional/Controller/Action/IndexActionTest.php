<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Tests\Controller\Action;
use Tests\Functional\BaseTestCase;

/**
 * Class HomepageTest
 * @package Tests\Functional
 */
class IndexActionTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response with 200 status code and valid response
     */
    public function testGetValidHomePage()
    {
        $response = $this->runApp(
            'GET',
            '/'
        );
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertContains(
            'Misericordia Index',
            (string)$response->getBody(),
            'Home Index is not working as expected'
        );
    }
}