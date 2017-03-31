<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Actions;

use App\Operator\Repository\OperatorRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EnterNewPasswordAction
 * @package App\Home\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterNewPasswordAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var OperatorRepository
     */
    private $operatorRepository;
    /**
     * @var Messages
     */
    private $flash;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param OperatorRepository $operatorRepository
     * @param Messages $flash
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        OperatorRepository $operatorRepository,
        Messages $flash,
        RouterInterface $router
    )
    {
        $this->view = $view;
        $this->operatorRepository = $operatorRepository;
        $this->flash = $flash;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        try {
            $token = $request->getAttribute('token');

            //we get the operator by the token
            //if is not valid, exception will be captured
            $operator = $this->operatorRepository->findByResetToken($token);

            $data = [
                'token' => $token,
                'fullName' => $operator->name
            ];
            return $this->view->render($response, 'partials/home/enter-new-password.twig', $data);
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'The reset password link is not valid.');
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }
}