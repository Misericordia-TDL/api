<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Auth\Auth;
use App\Models\Operator;
use App\Models\OperatorLevel;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Respect\Validation\Validator as v;

/**
 * Class DeleteOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteOperatorAction
{
    /**
     * @var Operator
     */
    protected $operatorModel;
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
     * @var OperatorLevel
     */
    private $operatorLevel;
    /**
     * @var Auth
     */
    private $auth;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Auth $auth
     * @param Operator $operatorModel
     * @param Messages $flash
     * @param OperatorLevel $operatorLevel
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Auth $auth,
        Operator $operatorModel,
        Messages $flash,
        OperatorLevel $operatorLevel
    )
    {
        $this->operatorModel = $operatorModel;
        $this->router = $router;
        $this->flash = $flash;
        $this->operatorLevel = $operatorLevel;
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

        $operator = $this->operatorModel->delete($id);

        if ($operator->active == 0) {
            $this->flash->addMessage('info', 'Operator disabled correctly');
        } else {
            $this->flash->addMessage('error', 'Operator not disabled correctly');

        }

        return $response->withRedirect($this->router->pathFor('list-operator'));
    }
}