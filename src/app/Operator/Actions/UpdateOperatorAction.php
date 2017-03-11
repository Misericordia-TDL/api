<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will update the data from an operator
 */

namespace App\Operator\Actions;

use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class UpdateOperatorAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateOperatorAction
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

        try {
            //get id from url
            $id = $request->getAttribute('id');
            /** @var  Operator $originalOperator */
            $originalOperator = $this->operatorRepository->findById($id);


            $validation = $this->validator->validate($request, [
                'email' => v::noWhitespace()->notEmpty()->email()->EmailEditable($originalOperator->email),
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'surname' => v::notEmpty()->alpha()->length(2, 20),
                'phonenumber' => v::noWhitespace()->notEmpty()->numeric()->phone(),
                'operator_level' => v::noWhitespace()->notEmpty()->OperatorLevelValid(),
            ]);

            //If validation fails, return to edit form with error messages embeded in the view
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Operator data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-operator', ['id' => $id]));
            }

            $originalOperator->update($request->getParams());

            $this->flash->addMessage('info', 'Operator updated correctly');

            return $response->withRedirect($this->router->pathFor('list-operator'));
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-operator'));
        }
    }
}