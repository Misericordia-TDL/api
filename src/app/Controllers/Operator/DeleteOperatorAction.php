<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Auth\Auth;
use App\Repository\OperatorRepository;
use App\Models\OperatorLevel;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteOperatorAction
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
     * @var Messages
     */
    private $flash;
    /**
     * @var Auth
     */
    private $auth;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Auth $auth
     * @param OperatorRepository $operatorRepository
     * @param Messages $flash
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Auth $auth,
        OperatorRepository $operatorRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->operatorRepository = $operatorRepository;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        if ($this->auth->currentUserId() == $id) {
            $this->flash->addMessage('error', 'You can\'t delete yourself');
            return $response->withRedirect($this->router->pathFor('list-operator'));
        }

        try {

            if ($this->operatorRepository->delete($id)) {
                $this->flash->addMessage('info', 'Operator disabled correctly');
            } else {
                $this->flash->addMessage('error', 'Operator not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Operator not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-operator'));
    }
}