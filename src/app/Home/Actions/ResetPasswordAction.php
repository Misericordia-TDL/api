<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Actions;

use App\Email\EmailService;
use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

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
     * @var View
     */
    private $view;
    /**
     * @var EmailService
     */
    private $emailService;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param OperatorRepository $operatorRepository
     * @param Messages $flash
     * @param View $view
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        OperatorRepository $operatorRepository,
        Messages $flash,
        View $view,
        EmailService $emailService

    )
    {
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
        $this->operatorRepository = $operatorRepository;
        $this->view = $view;
        $this->emailService = $emailService;
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
            $resetToken = sha1(uniqid());

            $originalOperator->update(['password_reset_token' => $resetToken]);

            //render email message with operator data
            $operatorName = $originalOperator->name;
            $operatorFullName = $operatorName . ' ' . $originalOperator->surname;

            $data = [
                'email' => $email,
                'name' => $operatorName,
                'token' => $resetToken
            ];

            $emailBody = $this->view->fetch('emails/reset-password.twig', $data);
            //send email with link to enter new password page
            $this->emailService->sendResetPasswordEmail($emailBody, $email, $operatorFullName);

            $this->flash->addMessage('info', 'If ' . $email . ' exists in the system, we will send an email with ' .
                'reset password instructions');

        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('info', 'If ' . $email . ' exists in the system, we will send an email with ' .
                'reset password instructions');
        }catch (\LogicException $e) {
            $this->flash->addMessage('error', 'Email was not sent due to an email service error');
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }
}