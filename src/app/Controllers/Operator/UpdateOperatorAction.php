<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

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
 * Class UpdateOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateOperatorAction
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
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param Operator $operatorModel
     * @param Messages $flash
     * @param OperatorLevel $operatorLevel
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        Operator $operatorModel,
        Messages $flash,
        OperatorLevel $operatorLevel
    )
    {
        $this->operatorModel = $operatorModel;
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
        $this->operatorLevel = $operatorLevel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');
        $originalOperator = $this->operatorModel->findById($id);

        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->EmailEditable($this->operatorModel,$originalOperator->email),
            'name' => v::noWhitespace()->notEmpty()->alpha()->length(2, 20),
            'surname' => v::noWhitespace()->notEmpty()->alpha()->length(2, 20),
            'phonenumber' => v::noWhitespace()->notEmpty()->numeric()->phone(),
            'operator_level' => v::noWhitespace()->notEmpty()->OperatorLevelValid($this->operatorLevel),
        ]);

        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Operator data is not correct');
            return $response->withRedirect($this->router->pathFor('edit-operator', ['id' => $id]));
        }

        $operatorData = $request->getParams();
        unset(
            $operatorData['csrf_name'],
            $operatorData['csrf_value']
        );

        $operatorData['_id'] = $id;

        $this->operatorModel->update($operatorData);

        return $response->withRedirect($this->router->pathFor('list-operator'));
    }
}