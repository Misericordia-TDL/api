<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Tests\Home\Actions;

use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;
use Tests\Functional\BaseTestCase;

/**
 * Class HomepageTest
 * @package Tests\Functional
 */
class AuthOperatorActionTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response with 200 status code and valid response
     */
    public function testPostLoginPage()
    {
        $operatorRepository = $this->getMockBuilder(OperatorRepository::class)
            ->setMethods(['findByEmail'])
            ->disableOriginalConstructor()
            ->getMock();


        $operator = new Operator([
            'id' => 1,
            'name' => 'test1',
            'email' => 'pepe@as.com',
            'password' => password_hash('test', PASSWORD_DEFAULT)
        ]);

        $operatorRepository->expects($this->exactly(2))
            ->method('findByEmail')
            ->with('pepe@as.com')
            ->willReturn($operator);

        $response = $this->runApp(
            'POST',
            '/auth-operator',
            [
                'email' => 'pepe@as.com',
                'password' => 'testa'
            ],
            $operatorRepository
        );
        $this->assertEquals(302,$response->getStatusCode());

        $response = $this->runApp(
            'GET',
            '/',
            [
                'email' => 'pepe@as.com',
                'password' => 'testa'
            ],
            $operatorRepository
        );
        $this->assertContains(
            'Hello test1',
            (string)$response->getBody(),
            'Home Index is not working as expected'
        );
    }
}
