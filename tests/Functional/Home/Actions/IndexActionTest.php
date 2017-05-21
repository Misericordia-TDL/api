<?php

namespace Tests\Home\Actions;

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
            'Misericordia Accoglienza',
            (string)$response->getBody(),
            'Home Index is not working as expected'
        );
        $this->assertContains(
            'Please sign in',
            (string)$response->getBody()
        );
        $this->assertContains(
            'Reset password',
            (string)$response->getBody()
        );
        $this->assertNotContains(
            'error',
            (string)$response->getBody()
        );
    }
}
