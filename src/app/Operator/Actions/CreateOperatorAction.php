<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new operator. If validation fails
 * Request will be redirected to EnterOperatorDataAction with the validation error messages
 * in its views.
 */

namespace App\Operator\Actions;

use App\Core\Model\Exception\EmptyDataSetException;
use App\Operator\Repository\OperatorRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class createOperator
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class CreateOperatorAction
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
        $this->operatorRepository = $operatorRepository;
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        //validate rules for a new operator
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailNotTaken(),
            'password' => v::noWhitespace()->notEmpty(),
            'name' => v::notEmpty()->alpha()->length(2, 20),
            'surname' => v::notEmpty()->alpha()->length(2, 20),
            'phonenumber' => v::noWhitespace()->notEmpty()->numeric()->phone(),
            'operator_level_id' => v::noWhitespace()->notEmpty()->OperatorLevelValid(),
        ]);

        //check if validation passes
        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Operator data is not correct');
            return $response->withRedirect($this->router->pathFor('enter-operator-data'));
        }

        //Try to insert data into operator collection and in case
        //There's an error, a flash message in the view will inform the user what went wrong.
        try {
            $this->operatorRepository->insert($request->getParams());
            $this->flash->addMessage('info', 'Operator created correctly');

        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Operator not found. Could not perform deletion.');
        } catch (EmptyDataSetException $e) {
            $this->flash->addMessage('error', $e->getMessage());
        }


        return $response->withRedirect($this->router->pathFor('list-operator'));
    }
}