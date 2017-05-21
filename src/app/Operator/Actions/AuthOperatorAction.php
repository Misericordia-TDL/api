<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will be in charge of the operator authentication.
 */

namespace App\Operator\Actions;

use App\Auth\Auth;
use App\Operator\Repository\OperatorRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class AuthOperatorAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class AuthOperatorAction
{
    /**
     * @var Auth
     */
    protected $auth;
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * @var RouterInterface
     */
    protected $router;

    /** @var Messages */
    protected $flash;
    /**
     * @var OperatorRepository
     */
    private $operatorRepository;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Auth $auth
     * @param Validator $validator
     * @param OperatorRepository $operatorRepository
     * @param Messages $flash
     */
    function __construct(
        RouterInterface $router,
        Auth $auth,
        Validator $validator,
        OperatorRepository $operatorRepository,
        Messages $flash
    )
    {
        $this->auth = $auth;
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
        $this->operatorRepository = $operatorRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        //check email is valid and password matches the operator
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->emailValid($this->operatorRepository),
            'password' => v::noWhitespace()->notEmpty()->passwordValid($request->getParam('email'), $this->auth),
        ]);

        //return to loing page with error messages in the view
        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Login failed. Wrong Credentials');
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $response->withRedirect($this->router->pathFor('home-loggedin'));
    }
}