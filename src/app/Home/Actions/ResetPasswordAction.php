<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Actions;

use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class ResetPasswordAction
 * @package App\Home\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ResetPasswordAction
{
    /**
     * @var OperatorRepository
     */
    protected $operatorRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var Messages
     */
    private $flash;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param OperatorRepository $operatorRepository
     * @param Messages $flash
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        OperatorRepository $operatorRepository,
        Messages $flash
    )
    {
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

        //get id from url
        $email = $request->getParam('email');
        try {
            /** @var  Operator $originalOperator */
            $originalOperator = $this->operatorRepository->findByEmail($email);

            $originalOperator->update(['password_reset_token' => sha1(uniqid())]);

            //send email with link to enter new password page

            $this->flash->addMessage('info', 'If ' . $email . ' entered exists in the system, we will send an email with ' .
                'reset password instructions');

            return $response->withRedirect($this->router->pathFor('home'));
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('info', 'If ' . $email . ' entered exists in the system, we will send an email with ' .
                'reset password instructions');
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }
}