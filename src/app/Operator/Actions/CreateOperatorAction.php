<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new operator. If validation fails
 * Request will be redirected to EnterOperatorDataAction with the validation error messages
 * in its views.
 */

namespace App\Operator\Actions;

use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class createOperator
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class CreateOperatorAction extends CreateAction
{
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
            $this->repository->insert($request->getParams());
            $this->flash->addMessage('info', 'Operator created correctly');

        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Operator not found. Could not perform deletion.');
        } catch (EmptyDataSetException $e) {
            $this->flash->addMessage('error', $e->getMessage());
        }


        return $response->withRedirect($this->router->pathFor('list-operator'));
    }
}